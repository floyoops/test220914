<?php

declare(strict_types=1);

namespace MobilityWork\App\Command\CreateATicketHotel;

use MobilityWork\Domain\Model\LanguageInterface;
use MobilityWork\Domain\Shared\CommandInterface;

class CreateATicketHotelCommand implements CommandInterface
{
    private ?string $gender;
    private string $firstName;
    private string $lastName;
    private string $country;
    private string $phoneNumber;
    private string $email;
    private string $city;
    private string $website;
    private string $hotelName;
    private string $subject;
    private string $message;
    private LanguageInterface $language;

    public function __construct(
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
    )
    {

        $this->gender = $gender;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->country = $country;
        $this->phoneNumber = $phoneNumber;
        $this->email = $email;
        $this->city = $city;
        $this->website = $website;
        $this->hotelName = $hotelName;
        $this->subject = $subject;
        $this->message = $message;
        $this->language = $language;
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

    public function getCountry(): string
    {
        return $this->country;
    }

    public function getPhoneNumber(): string
    {
        return $this->phoneNumber;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function getWebsite(): string
    {
        return $this->website;
    }

    public function getHotelName(): string
    {
        return $this->hotelName;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getLanguage(): LanguageInterface
    {
        return $this->language;
    }

    public function getVersion(): int
    {
        return 1;
    }
}
