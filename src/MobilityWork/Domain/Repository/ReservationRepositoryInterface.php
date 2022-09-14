<?php

declare(strict_types=1);

namespace MobilityWork\Domain\Repository;

use MobilityWork\Domain\Model\ReservationInterface;

interface ReservationRepositoryInterface
{
    public function getByRef(string $reservationNumber): ReservationInterface;
}
