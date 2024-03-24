<?php

namespace App\Services\Booking;

use App\Services\Booking\BookingService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class BookingServiceImpl implements BookingService
{
    public function getAll(): Collection
    {
        return DB::table('temps')
            ->join('users', 'temps.user_id', 'users.id')
            ->join('books', 'temps.book_id', 'books.id')
            ->select('users.*', 'books.*')
            ->get();
    }

    public function maximumBooks(): int
    {
        return DB::table('temps')
            ->where('user_id', auth()->id())
            ->count();
    }

    public function bookAlreadyExist($bookId): bool
    {
        return DB::table('temps')
            ->where('user_id', auth()->id())
            ->where('book_id', $bookId)
            ->exists();
    }
}
