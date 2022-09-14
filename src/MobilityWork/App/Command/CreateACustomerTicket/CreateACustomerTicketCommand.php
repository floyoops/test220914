<?php

declare(strict_types=1);

namespace MobilityWork\App\Command\CreateACustomerTicket;

use MobilityWork\Domain\Model\HotelInterface;
use MobilityWork\Domain\Model\LanguageInterface;
use MobilityWork\Domain\Shared\CommandInterface;

class CreateACustomerTicketCommand implements CommandInterface
{
    private ?string $gender;
    private string $firstName;
    private string $lastName;
    private string $phoneNumber;
    private string $email;
    private string $message;
    private ?string $reservationNumber;
    private ?HotelInterface $hotel;
    private LanguageInterface $language;

    public function __construct(
        ?string           $gender,
        string            $firstName,
        string            $lastName,
        string            $phoneNumber,
        string            $email,
        string            $message,
        ?string           $reservationNumber,
        ?HotelInterface   $hotel,
        LanguageInterface $language,
    )
    {
        $this->gender = $gender;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->phoneNumber = $phoneNumber;
        $this->email = $email;
        $this->message = $message;
        $this->reservationNumber = $reservationNumber;
        $this->hotel = $hotel;
        $this->language = $language;
    }

    public function getVersion(): int
    {
        return 1;
    }

    public function getGender(): ?string
    {
        return $this->gender;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getReservationNumber(): ?string
    {
        return $this->reservationNumber;
    }

    public function getHotel(): ?HotelInterface
    {
        return $this->hotel;
    }

    public function getLanguage(): LanguageInterface
    {
        return $this->language;
    }
}
