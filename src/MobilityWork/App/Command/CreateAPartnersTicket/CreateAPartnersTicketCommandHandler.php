<?php
declare(strict_types=1);

namespace MobilityWork\App\Command\CreateAPartnersTicket;

use Exception;
use MobilityWork\Domain\Client\ClientApiTicketingInterface;
use MobilityWork\Domain\Client\Dto\CreateOrUpdateUserInput;
use MobilityWork\Domain\Client\Dto\CreateTicketInput;
use MobilityWork\Domain\Shared\CommandHandlerInterface;
use MobilityWork\Domain\Shared\CommandInterface;
use MobilityWork\Domain\ValueObject\ZendeskVO;

class CreateAPartnersTicketCommandHandler implements CommandHandlerInterface
{
    private ClientApiTicketingInterface $clientApiTicketing;

    public function __construct(
        ClientApiTicketingInterface $clientApiTicketing,
    )
    {
        $this->clientApiTicketing = $clientApiTicketing;
    }

    public function handle(CreateAPartnersTicketCommand|CommandInterface $command): bool
    {
        // Post user.
        $createOrUpdateUserInput = $this->getCreateOrUpdateUserInput($command);
        $userIdTicket = $this->createOrUpdateUserOrException($createOrUpdateUserInput);

        // Post ticket.
        $createTicketInput = $this->getCreateTicketInput($userIdTicket, $command);
        $this->createTicketOrException($createTicketInput);

        return true;
    }

    private function createTicketOrException(CreateTicketInput $createTicketInput): void
    {
        try {
            $this->clientApiTicketing->createTicket($createTicketInput);
        } catch (Exception $e) {
            throw new CreateAPartnersTicketException(
                sprintf("Error on createTicket for user '%s' on CreateAPartnersTicketCommandHandler, previous: %s",
                    $createTicketInput->getUserId(),
                    $e->getMessage()
                )
            );
        }
    }

    private function getCreateTicketInput(
        string                       $userId,
        CreateAPartnersTicketCommand $command,
    ): CreateTicketInput
    {
        return (new CreateTicketInput($userId, ZendeskVO::TYPE_PARTNER))
            ->setGender($command->getGender())
            ->setMessage($command->getMessage())
            ->setLanguage($command->getLanguage());
    }

    private function createOrUpdateUserOrException(CreateOrUpdateUserInput $createOrUpdateUserInput): string
    {
        try {
            return $this->clientApiTicketing->createOrUpdateUser($createOrUpdateUserInput);
        } catch (Exception $e) {
            throw new CreateAPartnersTicketException(
                sprintf("Error on createOrUpdateUser for email '%s' on CreateAPartnersTicketCommandHandler, previous: %s",
                    $createOrUpdateUserInput->getEmail(),
                    $e->getMessage()
                )
            );
        }
    }

    private function getCreateOrUpdateUserInput(CreateAPartnersTicketCommand $command): CreateOrUpdateUserInput
    {
        return (new CreateOrUpdateUserInput($command->getEmail()))
            ->setFirstName($command->getFirstName())
            ->setLastName($command->getLastName())
            ->setPhoneNumber($command->getPhoneNumber())
            ->setRole(ZendeskVO::ROLE_USER_DEFAULT);
    }
}
