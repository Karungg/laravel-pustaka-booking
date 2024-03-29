<?php

namespace App\Services\Booking;

use Illuminate\Support\Collection;

interface BookingService
{
    public function getTemps(): Collection;

    public function getMaxBooks(): int;

    public function isBookAlreadyExist($bookId): bool;

    public function destroy($bookId): int;

    public function getTempById(): Collection;

    public function checkout();

    public function isBookingAlreadyExist(): bool;

    public function getHistory();
}
