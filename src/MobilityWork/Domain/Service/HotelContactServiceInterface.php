<?php

declare(strict_types=1);

namespace MobilityWork\Domain\Service;

use MobilityWork\Domain\Model\HotelContactInterface;
use MobilityWork\Domain\Model\HotelInterface;

interface HotelContactServiceInterface
{
    public function getMainHotelContact(HotelInterface $hotel): HotelContactInterface;
}
