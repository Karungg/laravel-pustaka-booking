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
            'take_limit' => now()->addDays(3)
        ]);

        foreach ($temps as $temp) {
            DB::table('booking_items')->insert([
                'booking_id' => $booking,
                'book_id' => $temp->book_id
            ]);

            DB::table('books')->where('id', $temp->book_id)
                ->update([
                    'stocks' => DB::raw('stocks-1'),
                    'booked' => DB::raw('booked+1')
                ]);
        }

        DB::table('temps')
            ->where('user_id', auth()->id())
            ->delete();
    }
}
