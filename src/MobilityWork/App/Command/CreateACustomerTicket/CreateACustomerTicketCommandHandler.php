<?php

declare(strict_types=1);

namespace MobilityWork\App\Command\CreateACustomerTicket;

use Exception;
use MobilityWork\Domain\Client\ClientApiTicketingInterface;
use MobilityWork\Domain\Client\Dto\CreateOrUpdateUserInput;
use MobilityWork\Domain\Client\Dto\CreateTicketInput;
use MobilityWork\Domain\Model\HotelContactInterface;
use MobilityWork\Domain\Model\HotelInterface;
use MobilityWork\Domain\Model\ReservationInterface;
use MobilityWork\Domain\Repository\ReservationRepositoryInterface;
use MobilityWork\Domain\Service\HotelContactServiceInterface;
use MobilityWork\Domain\Shared\CommandHandlerInterface;
use MobilityWork\Domain\Shared\CommandInterface;
use MobilityWork\Domain\ValueObject\ZendeskVO;

class CreateACustomerTicketCommandHandler implements CommandHandlerInterface
{
    private ReservationRepositoryInterface $reservationRepository;
    private HotelContactServiceInterface $hotelContactService;
    private ClientApiTicketingInterface $clientApiTicketing;

    public function __construct(
        ReservationRepositoryInterface $reservationRepository,
        HotelContactServiceInterface $hotelContactService,
        ClientApiTicketingInterface $clientApiTicketing,
    )
    {
        $this->reservationRepository = $reservationRepository;
        $this->hotelContactService = $hotelContactService;
        $this->clientApiTicketing = $clientApiTicketing;
    }

    public function handle(CreateACustomerTicketCommand|CommandInterface $command): bool
    {
        $reservation = $this->getReservationOrException($command->getReservationNumber());
        $hotel = ZendeskVO::getHotelFromReservationIfNotDeclared($reservation, $command->getHotel());
        $hotelContact = $this->getHotelContact($hotel);

        // Post user.
        $createOrUpdateUserInput = $this->getCreateOrUpdateUserInput($command, $reservation);
        $userIdTicket = $this->createOrUpdateUserOrException($createOrUpdateUserInput);

        // Post ticket.
        $createTicketInput = $this->getCreateTicketInput($userIdTicket, $command, $hotel, $hotelContact, $reservation);
        $this->createTicketOrException($createTicketInput);

        return true;
    }

    private function createTicketOrException(CreateTicketInput $createTicketInput): void
    {
        try {
            $this->clientApiTicketing->createTicket($createTicketInput);
        } catch (Exception $e) {
            throw new CreateACustomerTicketException(
                sprintf("Error on createTicket for user '%s' on CreateACustomerTicketCommandHandler, previous: %s",
                    $createTicketInput->getUserId(),
                    $e->getMessage()
                )
            );
        }
    }

    private function createOrUpdateUserOrException(CreateOrUpdateUserInput $createOrUpdateUserInput): string {
        try {
            return $this->clientApiTicketing->createOrUpdateUser($createOrUpdateUserInput);
        } catch (Exception $e) {
            throw new CreateACustomerTicketException(
                sprintf("Error on createOrUpdateUser for email '%s' on CreateACustomerTicketCommandHandler, previous: %s",
                    $createOrUpdateUserInput->getEmail(),
                    $e->getMessage()
                )
            );
        }
    }

    private function getCreateOrUpdateUserInput(
        CreateACustomerTicketCommand $command,
        ReservationInterface $reservation): CreateOrUpdateUserInput
    {
        return (new CreateOrUpdateUserInput($command->getEmail()))
            ->setFirstName($command->getFirstName())
            ->setLastName($command->getLastName())
            ->setPhoneNumber(ZendeskVO::getPhoneNumberInReservationIfNotDeclared($command->getPhoneNumber(), $reservation))
            ->setRole(ZendeskVO::ROLE_USER_DEFAULT);
    }

    private function getCreateTicketInput(
        string $userId,
        CreateACustomerTicketCommand $command,
        HotelInterface $hotel,
        HotelContactInterface $hotelContact,
        ReservationInterface $reservation,
    ): CreateTicketInput {
        return (new CreateTicketInput($userId, ZendeskVO::TYPE_CUSTOMER))
            ->setGender($command->getGender())
            ->setMessage($command->getMessage())
            ->setReservationNumber($command->getReservationNumber())
            ->setHotel($hotel)
            ->setHotelContact($hotelContact)
            ->setReservation($reservation)
            ->setLanguage($command->getLanguage());
    }

    private function getHotelContact(?HotelInterface $hotel): ?HotelContactInterface
    {
        if ($hotel === null) return null;
        return $this->hotelContactService->getMainHotelContact($hotel);
    }

    private function getReservationOrException(?string $reservationNumber): ?ReservationInterface
    {
        if ($reservationNumber === null) return null;
        try {
            $reservation = $this->reservationRepository->getByRef($reservationNumber);
        } catch (Exception $e) {
            throw new CreateACustomerTicketException(
                sprintf("Error on getByRef reservation '%s' on CreateACustomerTicketCommandHandler, previous: %s",
                    $reservationNumber,
                    $e->getMessage()
                )
            );
        }

        return  $reservation;
    }
}
