<?php

declare(strict_types=1);

namespace MobilityWork\Domain\Model;

interface CustomerInterface
{
    public function getSimplePhoneNumber(): string;
}
