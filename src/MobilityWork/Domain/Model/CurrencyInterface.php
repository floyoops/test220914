<?php

declare(strict_types=1);

namespace MobilityWork\Domain\Model;

interface CurrencyInterface
{
    public function getCode(): string;
}
