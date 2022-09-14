<?php

declare(strict_types=1);

namespace MobilityWork\Infra\Client;

use Exception;
use MobilityWork\Domain\Client\ClientApiTicketingInterface;
use MobilityWork\Domain\Client\Dto\CreateOrUpdateUserInput;
use MobilityWork\Domain\Client\Dto\CreateTicketInput;

class ZendeskClient implements ClientApiTicketingInterface
{
    private ZendeskAPI $client;

    public function __construct(
        string $zendeskConfigSubDomain,
        string $zendeskConfigUsername,
        string $zendeskConfigToken,
    )
    {
        $this->client = new ZendeskAPI($zendeskConfigSubDomain);
        $this->client->setAuth('basic', ['username' => $zendeskConfigUsername, 'token' => $zendeskConfigToken]);
    }

    public function createOrUpdateUser(CreateOrUpdateUserInput $input): string
    {
        $post = [
            'email' => $input->getEmail(),
            'name' => $input->getFirstName() . ' ' . strtoupper($input->getLastName()),
            'phone' => $input->getPhoneNumber(),
            'role' => $input->getRole() !== null ? $input->getRole() : 'end-user',
            'user_fields' => ZendeskClientAdapter::userFields($input),
        ];

        try {
            $response = $this->client->users()->createOrUpdate($post);
        } catch (Exception $e) {
            throw new ZendeskClientException(sprintf('error zendeskClient on createOrUpdateUser, previous: %s', $e->getMessage()));
        }

        return $response->user->id;
    }

    public function createTicket(CreateTicketInput $input): bool
    {
        $post = [
            'requester_id' => $input->getUserId(),
            'subject' => strlen($input->getMessage()) > 50 ? substr($input->getMessage(), 0, 50) . '...' : $input->getMessage(),
            'comment' =>
                [
                    'body' => $input->getMessage()
                ],
            'priority' => 'normal',
            'type' => 'question',
            'status' => 'new',
            'custom_fields' => ZendeskClientAdapter::customFields($input)
        ];

        try {
            $this->client->tickets()->create($post);
        } catch (Exception $e) {
            throw new ZendeskClientException(sprintf('error zendeskClient on createTicket, previous: %s', $e->getMessage()));
        }

        return true;
    }
}
