<?php

declare(strict_types=1);

namespace MobilityWork\Domain\Shared;

interface CommandInterface
{
    public function getVersion(): int;
}
