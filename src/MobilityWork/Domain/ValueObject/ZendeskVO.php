<?php

declare(strict_types=1);

namespace MobilityWork\Domain\ValueObject;

use MobilityWork\Domain\Model\HotelInterface;
use MobilityWork\Domain\Model\ReservationInterface;

class ZendeskVO
{
    const ROLE_USER_DEFAULT = 'end-user';
    const TYPE_CUSTOMER = 'customer';
    const TYPE_HOTEL = 'hotel';
    const TYPE_PRESS = 'press';
    const TYPE_PARTNER = 'partner';

    public static function getHotelFromReservationIfNotDeclared(ReservationInterface $reservation, ?HotelInterface $hotel): ?HotelInterface
    {
        if ($hotel !== null) return $hotel;
        return $reservation?->getHotel();
    }

    public static function getPhoneNumberInReservationIfNotDeclared(?string $phoneNumber, ?ReservationInterface $reservation): string
    {
        if ($phoneNumber !== null) return $phoneNumber;
        return $reservation !== null ? $reservation->getCustomer()->getSimplePhoneNumber() : '';
    }
}
