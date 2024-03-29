<?php

namespace App\Services\Booking;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Support\Collection;

interface BookingService
{
    public function getTemps(): Collection;

    public function getTempById(): Collection;

    public function getMaxBooks(): int;

    public function isBookAlreadyExist($bookId): bool;

    public function isStockAvaliable($bookId): bool;

    public function destroy($bookId): int;

    public function checkout();

    public function isBookingAlreadyExist(): bool;

    public function getHistory(): Paginator;
}
