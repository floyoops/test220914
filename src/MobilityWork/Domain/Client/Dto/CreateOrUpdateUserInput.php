<?php

declare(strict_types=1);

namespace MobilityWork\Domain\Client\Dto;

class CreateOrUpdateUserInput
{

    private string $email;
    private string $firstName;
    private string $lastName;
    private ?string $phoneNumber;
    private ?string $website;
    private ?string $pressMedia;
    private ?string $role;

    public function __construct(
        string $email,
    )
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return CreateOrUpdateUserInput
     */
    public function setEmail(string $email): CreateOrUpdateUserInput
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     * @return CreateOrUpdateUserInput
     */
    public function setFirstName(string $firstName): CreateOrUpdateUserInput
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return CreateOrUpdateUserInput
     */
    public function setLastName(string $lastName): CreateOrUpdateUserInput
    {
        $this->lastName = $lastName;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    /**
     * @param string|null $phoneNumber
     * @return CreateOrUpdateUserInput
     */
    public function setPhoneNumber(?string $phoneNumber): CreateOrUpdateUserInput
    {
        $this->phoneNumber = $phoneNumber;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getWebsite(): ?string
    {
        return $this->website;
    }

    /**
     * @param string|null $website
     * @return CreateOrUpdateUserInput
     */
    public function setWebsite(?string $website): CreateOrUpdateUserInput
    {
        $this->website = $website;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPressMedia(): ?string
    {
        return $this->pressMedia;
    }

    /**
     * @param string|null $pressMedia
     * @return CreateOrUpdateUserInput
     */
    public function setPressMedia(?string $pressMedia): CreateOrUpdateUserInput
    {
        $this->pressMedia = $pressMedia;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getRole(): ?string
    {
        return $this->role;
    }

    /**
     * @param string|null $role
     * @return CreateOrUpdateUserInput
     */
    public function setRole(?string $role): CreateOrUpdateUserInput
    {
        $this->role = $role;
        return $this;
    }
}
