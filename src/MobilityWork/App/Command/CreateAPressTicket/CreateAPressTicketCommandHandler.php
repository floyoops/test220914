<?php

declare(strict_types=1);

namespace MobilityWork\App\Command\CreateAPressTicket;

use Exception;
use MobilityWork\App\Command\CreateACustomerTicket\CreateACustomerTicketException;
use MobilityWork\App\Command\CreateATicketHotel\CreateATicketHotelException;
use MobilityWork\Domain\Client\ClientApiTicketingInterface;
use MobilityWork\Domain\Client\Dto\CreateOrUpdateUserInput;
use MobilityWork\Domain\Client\Dto\CreateTicketInput;
use MobilityWork\Domain\Shared\CommandHandlerInterface;
use MobilityWork\Domain\Shared\CommandInterface;
use MobilityWork\Domain\ValueObject\ZendeskVO;

class CreateAPressTicketCommandHandler implements CommandHandlerInterface
{

    private ClientApiTicketingInterface $clientApiTicketing;

    public function __construct(
        ClientApiTicketingInterface $clientApiTicketing,
    )
    {
        $this->clientApiTicketing = $clientApiTicketing;
    }

    public function handle(CreateAPressTicketCommand|CommandInterface $command): bool
    {
        // Post user.
        $createOrUpdateUserInput = $this->getCreateOrUpdateUserInput($command);
        $userIdTicket = $this->createOrUpdateUserOrException($createOrUpdateUserInput);

        // Post ticket.
        $createTicketInput = $this->getCreateTicketInput($userIdTicket, $command);
        $this->createTicketOrException($createTicketInput);

        return true;
    }

    private function getCreateTicketInput(
        string                    $userId,
        CreateAPressTicketCommand $command,
    ): CreateTicketInput
    {
        return (new CreateTicketInput($userId, ZendeskVO::TYPE_PRESS))
            ->setGender($command->getGender())
            ->setCountry($command->getCountry())
            ->setCity($command->getCity())
            ->setMessage($command->getMessage())
            ->setSubject($command->getSubject())
            ->setLanguage($command->getLanguage());
    }

    private function createTicketOrException(CreateTicketInput $createTicketInput): void
    {
        try {
            $this->clientApiTicketing->createTicket($createTicketInput);
        } catch (Exception $e) {
            throw new CreateACustomerTicketException(
                sprintf("Error on createTicket for user '%s' on CreateAPressTicketCommandHandler, previous: %s",
                    $createTicketInput->getUserId(),
                    $e->getMessage()
                )
            );
        }
    }

    private function createOrUpdateUserOrException(CreateOrUpdateUserInput $createOrUpdateUserInput): string
    {
        try {
            return $this->clientApiTicketing->createOrUpdateUser($createOrUpdateUserInput);
        } catch (Exception $e) {
            throw new CreateATicketHotelException(
                sprintf("Error on createOrUpdateUser for email '%s' on CreateAPressTicketCommandHandler, previous: %s",
                    $createOrUpdateUserInput->getEmail(),
                    $e->getMessage()
                )
            );
        }
    }

    private function getCreateOrUpdateUserInput(CreateAPressTicketCommand $command): CreateOrUpdateUserInput
    {
        return (new CreateOrUpdateUserInput($command->getEmail()))
            ->setFirstName($command->getFirstName())
            ->setLastName($command->getLastName())
            ->setPhoneNumber($command->getPhoneNumber())
            ->setPressMedia($command->getMedia())
            ->setRole(ZendeskVO::ROLE_USER_DEFAULT);
    }
}
