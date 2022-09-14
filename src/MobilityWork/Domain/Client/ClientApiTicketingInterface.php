<?php

declare(strict_types=1);

namespace MobilityWork\Domain\Client;

use MobilityWork\Domain\Client\Dto\CreateOrUpdateUserInput;
use MobilityWork\Domain\Client\Dto\CreateTicketInput;

interface ClientApiTicketingInterface
{
    public function createOrUpdateUser(CreateOrUpdateUserInput $input): string;

    public function createTicket(CreateTicketInput $input): bool;
}
