<?php

declare(strict_types=1);

namespace MobilityWork\Domain\Model;

interface ReservationInterface
{
    public function getHotel(): HotelInterface;

    public function getRoom(): RoomInterface;

    public function getBookedDate(): \DateTime;

    public function getRoomPrice(): float;

    public function getBookedStartTime(): \DateTime;

    public function getBookedEndTime(): \DateTime;

    public function getCustomer(): CustomerInterface;
}
