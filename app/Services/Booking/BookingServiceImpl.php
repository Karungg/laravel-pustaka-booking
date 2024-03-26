<?php

namespace App\Services\Booking;

use App\Models\Booking;
use App\Services\Booking\BookingService;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class BookingServiceImpl implements BookingService
{
    public function getAll(): Collection
    {
        return DB::table('temps')
            ->join('users', 'temps.user_id', 'users.id')
            ->join('books', 'temps.book_id', 'books.id')
            ->join('categories', 'books.category_id', 'categories.id')
            ->select('categories.title as category', 'books.id', 'books.title', 'books.author', 'books.image', 'temps.created_at')
            ->where('users.id', auth()->id())
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

    public function destroy($bookId): int
    {
        return DB::table('temps')
            ->where('user_id', auth()->id())
            ->where('book_id', $bookId)
            ->delete();
    }

    public function getById(): Collection
    {
        return DB::table('temps')
            ->where('user_id', auth()->id())
            ->get();
    }

    public function checkout()
    {
        $temps =  $this->getById();

        $booking = Booking::insertGetId([
            'user_id' => auth()->id(),
            'take_limit' => now()->addDays(3),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        foreach ($temps as $temp) {
            DB::table('booking_items')->insert([
                'booking_id' => $booking,
                'book_id' => $temp->book_id,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            DB::table('books')->where('id', $temp->book_id)
                ->update([
                    'stocks' => DB::raw('stocks-1'),
                    'booked' => DB::raw('booked+1'),
                    'updated_at' => now()
                ]);
        }

        DB::table('temps')
            ->where('user_id', auth()->id())
            ->delete();
    }

    public function getBookingById(): bool
    {
        return DB::table('bookings')
            ->where('user_id', auth()->id())
            ->exists();
    }

    public function getBookings(): Collection
    {
        return DB::table('booking_items')
            ->join('bookings', 'booking_id', 'bookings.id')
            ->join('books', 'booking_items.book_id', 'books.id')
            ->select('bookings.id', 'bookings.user_id', 'bookings.take_limit', 'bookings.created_at', 'booking_items.book_id', 'books.title')
            ->where('bookings.user_id', auth()->id())
            ->get();
    }
}
