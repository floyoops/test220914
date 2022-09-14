<?php

declare(strict_types=1);

namespace MobilityWork\Domain\Shared;

interface CommandBusInterface
{
    public function handle(CommandInterface $command): bool;
}
