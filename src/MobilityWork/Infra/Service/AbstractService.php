<?php

declare(strict_types=1);

namespace MobilityWork\Infra\Service;

use MobilityWork\Domain\Model\HotelInterface;
use MobilityWork\Domain\Model\LanguageInterface;

abstract class AbstractService
{
    abstract public function createCustomerTicket(
        ?string           $gender,
        string            $firstName,
        string            $lastName,
        string            $phoneNumber,
        string            $email,
        string            $message,
        ?string            $reservationNumber,
        HotelInterface    $hotel,
        LanguageInterface $language
    ): bool;

    abstract public function createHotelTicket(
        ?string           $gender,
        string            $firstName,
        string            $lastName,
        string            $country,
        string            $phoneNumber,
        string            $email,
        string            $city,
        string            $website,
        string            $hotelName,
        string            $subject,
        string            $message,
        LanguageInterface $language,
    ): bool;

    abstract public function createPressTicket(
        ?string           $gender,
        string            $firstName,
        string            $lastName,
        string            $country,
        string            $phoneNumber,
        string            $email,
        string            $city,
        string            $media,
        string            $subject,
        string            $message,
        LanguageInterface $language,
    ): bool;
}
