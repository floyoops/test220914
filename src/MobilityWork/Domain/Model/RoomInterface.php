<?php

declare(strict_types=1);

namespace MobilityWork\Domain\Model;

interface RoomInterface
{
    public function getName(): string;

    public function getType(): string;
}
