<?php

declare(strict_types=1);

namespace MobilityWork\Infra\Service;

use MobilityWork\App\Command\CreateACustomerTicket\CreateACustomerTicketCommand;
use MobilityWork\App\Command\CreateAPartnersTicket\CreateAPartnersTicketCommand;
use MobilityWork\App\Command\CreateAPressTicket\CreateAPressTicketCommand;
use MobilityWork\App\Command\CreateATicketHotel\CreateATicketHotelCommand;
use MobilityWork\Domain\Model\HotelInterface;
use MobilityWork\Domain\Model\LanguageInterface;
use MobilityWork\Domain\Shared\CommandBusInterface;

class ZendeskService extends AbstractService
{
    private CommandBusInterface $commandBus;

    public function __construct(
        CommandBusInterface $commandBus,
    )
    {
        $this->commandBus = $commandBus;
    }

    public function createCustomerTicket(
        ?string           $gender,
        string            $firstName,
        string            $lastName,
        string            $phoneNumber,
        string            $email,
        string            $message,
        ?string           $reservationNumber,
        HotelInterface    $hotel,
        LanguageInterface $language
    ): bool
    {
        $command = new CreateACustomerTicketCommand(
            $gender,
            $firstName,
            $lastName,
            $phoneNumber,
            $email,
            $message,
            $reservationNumber,
            $hotel,
            $language
        );

        // Handle to CreateACustomerTicketCommandHandler.
        return $this->commandBus->handle($command);
    }

    public function createHotelTicket(
        ?string           $gender,
        string            $firstName,
        string            $lastName,
        string            $country,
        string            $phoneNumber,
        string            $email,
        string            $city,
        string            $website,
        string            $hotelName,
        string            $subject,
        string            $message,
        LanguageInterface $language,
    ): bool
    {
        $command = new CreateATicketHotelCommand(
            $gender,
            $firstName,
            $lastName,
            $country,
            $phoneNumber,
            $email,
            $city,
            $website,
            $hotelName,
            $subject,
            $message,
            $language
        );

        // Handle to CreateATicketHotelCommandHandler.
        return $this->commandBus->handle($command);
    }

    public function createPressTicket(
        ?string           $gender,
        string            $firstName,
        string            $lastName,
        string            $country,
        string            $phoneNumber,
        string            $email,
        string            $city,
        string            $media,
        string            $subject,
        string            $message,
        LanguageInterface $language,
    ): bool
    {
        $command = new CreateAPressTicketCommand(
            $gender,
            $firstName,
            $lastName,
            $country,
            $phoneNumber,
            $email,
            $city,
            $media,
            $subject,
            $message,
            $language
        );
        return $this->commandBus->handle($command);
    }

    public function createPartnersTicket(
        ?string           $gender,
        string            $firstName,
        string            $lastName,
        string            $phoneNumber,
        string            $email,
        string            $message,
        LanguageInterface $language
    ): bool
    {
        $command = new CreateAPartnersTicketCommand(
            $gender,
            $firstName,
            $lastName,
            $phoneNumber,
            $email,
            $message,
            $language
        );
        return $this->commandBus->handle($command);
    }
}
