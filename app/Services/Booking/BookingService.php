<?php

namespace App\Services\Booking;

use Illuminate\Database\Eloquent\Collection;

interface BookingService
{
    public function getAll(): Collection;

    public function maximumBooks(): int;

    public function bookAlreadyExist($bookId): bool;
}
