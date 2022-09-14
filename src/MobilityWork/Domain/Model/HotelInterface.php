<?php

declare(strict_types=1);

namespace MobilityWork\Domain\Model;

interface HotelInterface
{
    public function getName(): string;

    public function getAddress(): string;

    public function getCurrency(): CurrencyInterface;
}
