<?php

declare(strict_types=1);

namespace MobilityWork\Domain\Client\Dto;

use MobilityWork\Domain\Model\HotelContactInterface;
use MobilityWork\Domain\Model\HotelInterface;
use MobilityWork\Domain\Model\LanguageInterface;
use MobilityWork\Domain\Model\ReservationInterface;

class CreateTicketInput
{
    private string $userId;
    private string $type;
    private ?string $gender;
    private ?string $subject;
    private ?string $message;
    private ?string $media;
    private ?string $reservationNumber;
    private ?string $country;
    private ?string $city;
    private ?string $phoneNumber;
    private ?string $name;
    private ?HotelInterface $hotel;
    private ?HotelContactInterface $hotelContact;
    private ?ReservationInterface $reservation;
    private ?LanguageInterface $language;


    public function __construct(
        string $userId,
        string $type,

    )
    {
        $this->type = $type;
        $this->userId = $userId;
    }

    public function getUserId(): string
    {
        return $this->userId;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function setGender(?string $gender): CreateTicketInput
    {
        $this->gender = $gender;
        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(?string $subject): CreateTicketInput
    {
        $this->subject = $subject;
        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): CreateTicketInput
    {
        $this->message = $message;
        return $this;
    }

    public function getMedia(): ?string
    {
        return $this->media;
    }

    public function setMedia(?string $media): CreateTicketInput
    {
        $this->media = $media;
        return $this;
    }

    public function getReservationNumber(): ?string
    {
        return $this->reservationNumber;
    }

    public function setReservationNumber(?string $reservationNumber): CreateTicketInput
    {
        $this->reservationNumber = $reservationNumber;
        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): CreateTicketInput
    {
        $this->country = $country;
        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): CreateTicketInput
    {
        $this->city = $city;
        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): CreateTicketInput
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    public function getHotel(): ?HotelInterface
    {
        return $this->hotel;
    }

    public function setHotel(?HotelInterface $hotel): CreateTicketInput
    {
        $this->hotel = $hotel;
        return $this;
    }

    public function getHotelContact(): ?HotelContactInterface
    {
        return $this->hotelContact;
    }

    public function setHotelContact(?HotelContactInterface $hotelContact): CreateTicketInput
    {
        $this->hotelContact = $hotelContact;
        return $this;
    }

    public function getReservation(): ?ReservationInterface
    {
        return $this->reservation;
    }

    public function setReservation(?ReservationInterface $reservation): CreateTicketInput
    {
        $this->reservation = $reservation;
        return $this;
    }

    public function getLanguage(): ?LanguageInterface
    {
        return $this->language;
    }

    public function setLanguage(?LanguageInterface $language): CreateTicketInput
    {
        $this->language = $language;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): CreateTicketInput
    {
        $this->name = $name;
        return $this;
    }
}
