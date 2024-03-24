<?php

namespace App\Services\Booking;

use Illuminate\Support\Collection;

interface BookingService
{
    public function getAll(): Collection;

    public function maximumBooks(): int;

    public function bookAlreadyExist($bookId): bool;

    public function destroy($bookId): int;
}
