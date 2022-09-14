<?php

declare(strict_types=1);

namespace MobilityWork\App\Command\CreateAPartnersTicket;

use MobilityWork\Domain\Model\LanguageInterface;
use MobilityWork\Domain\Shared\CommandInterface;

class CreateAPartnersTicketCommand implements CommandInterface
{
    private ?string $gender;
    private string $firstName;
    private string $lastName;
    private string $phoneNumber;
    private string $email;
    private string $message;
    private LanguageInterface $language;

    public function __construct(
        ?string           $gender,
        string            $firstName,
        string            $lastName,
        string            $phoneNumber,
        string            $email,
        string            $message,
        LanguageInterface $language
    )
    {

        $this->gender = $gender;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->phoneNumber = $phoneNumber;
        $this->email = $email;
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

    public function getLanguage(): LanguageInterface
    {
        return $this->language;
    }

    public function getVersion(): int
    {
        return 1;
    }
}
