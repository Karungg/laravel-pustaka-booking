<?php

namespace App\Services\Booking;

use App\Services\Booking\BookingService;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\select;

class BookingServiceImpl implements BookingService
{
    public function getAll()
    {
        return DB::table('temps')
            ->join('users', 'temps.user_id', 'users.id')
            ->join('books', 'temps.book_id', 'books.id')
            ->select('users.*', 'books.*')
            ->get();
    }
}
