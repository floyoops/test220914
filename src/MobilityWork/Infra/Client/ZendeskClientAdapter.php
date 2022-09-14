<?php
declare(strict_types=1);

namespace MobilityWork\Infra\Client;

use MobilityWork\Domain\Client\Dto\CreateOrUpdateUserInput;
use MobilityWork\Domain\Client\Dto\CreateTicketInput;

class ZendeskClientAdapter
{
    // CustomFields ZenDesk.
    const TYPE = '80924888';
    const RESERVATION_NUMBER = '80531327';
    const HOTEL_CONTACT_EMAIL = '80531267';
    const NAME = '80918668';
    const ADDRESS = '80918648';
    const ROOM_NAME = '80531287';
    const BOOKED_DATE = '80531307';
    const ROOM_PRICE = '80924568';
    const BOOKED_START_TIME = '80918728';
    const LANGUAGE = '80918708';

    // At create on ZenDesk.
    const GENDER = '111111111';
    const COUNTRY = '222222222';
    const SUBJECT = '333333333';

    // User fields.
    const PRESS_MEDIA = 'press_media';
    const WEBSITE = 'website';

    public static function customFields(CreateTicketInput $input): array
    {
        $customFields = [];
        $customFields[self::TYPE] = $input->getType();
        $customFields[self::GENDER] = $input->getGender();

        if ($input->getReservationNumber()) $customFields[self::RESERVATION_NUMBER] = $input->getReservationNumber();
        if ($input->getName()) $customFields[self::NAME] = $input->getName();
        if ($input->getCity()) $customFields[self::ADDRESS] = $input->getCity();
        if ($input->getCountry()) $customFields[self::COUNTRY] = $input->getCountry();

        $hotel = $input->getHotel();
        if ($hotel !== null) {
            $hotelContact = $input->getHotelContact();
            $customFields[self::HOTEL_CONTACT_EMAIL] = $hotelContact?->getEmail();
            $customFields[self::NAME] = $hotel->getName();
            $customFields[self::ADDRESS] = $hotel->getAddress();
        }

        $reservation = $input->getReservation();
        if ($reservation !== null) {
            $roomName = $reservation->getRoom()->getName() . ' ('.$reservation->getRoom()->getType().')';
            $customFields[self::ROOM_NAME] = $roomName;
            $customFields[self::BOOKED_DATE] = $reservation->getBookedDate()->format('Y-m-d');
            $customFields[self::ROOM_PRICE] = $reservation->getRoomPrice() . ' ZendeskService.php' .$reservation->getHotel()->getCurrency()->getCode();
            $customFields[self::BOOKED_START_TIME] = $reservation->getBookedStartTime()->format('H:i').' - '.$reservation->getBookedEndTime()->format('H:i');
        }

        $customFields[self::LANGUAGE] = $input->getLanguage()->getName();

        return $customFields;
    }

    public static function userFields(CreateOrUpdateUserInput $input) : array
    {
        $userFields = [];
        if ($input->getPressMedia()) $userFields[self::PRESS_MEDIA] = $input->getPressMedia();
        if ($input->getWebsite()) $userFields[self::WEBSITE] = $input->getWebsite();

        return $userFields;
    }
}
