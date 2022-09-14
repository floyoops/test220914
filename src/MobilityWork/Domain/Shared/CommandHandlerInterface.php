<?php

declare(strict_types=1);

namespace MobilityWork\Domain\Shared;

use MobilityWork\Domain\Shared\CommandInterface;

interface CommandHandlerInterface
{
    public function handle(CommandInterface $command): bool;
}
