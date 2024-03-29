<?php

namespace App\Services\Borrow;

use App\Enums\BookingStatus;
use App\Enums\BorrowStatus;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class BorrowServiceImpl implements BorrowService
{
    public function borrowProcess($bookingId)
    {
        $booking = Booking::whereHas('user', function (Builder $query) use ($bookingId) {
            $query->where('bookings.id', $bookingId)
                ->where('bookings.status', BookingStatus::Pending);
        })->first();

        $bookingItems = DB::table('booking_items')
            ->join('bookings', 'booking_id', 'bookings.id')
            ->where('bookings.user_id', $booking->user_id)
            ->where('booking_id', $bookingId)
            ->get();

        $borrowId = DB::table('borrows')
            ->insertGetId([
                'booking_id' => $bookingId,
                'user_id' => $booking->user_id,
                'return_date' => $booking->take_limit,
                'status' => BorrowStatus::Borrowed,
                'total_fine' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ]);

        foreach ($bookingItems as $item) {
            DB::table('borrow_items')
                ->insert([
                    'borrow_id' => $borrowId,
                    'book_id' => $item->book_id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

            DB::table('books')
                ->where('id', $item->book_id)
                ->update([
                    'booked' => DB::raw('booked-1'),
                    'borrowed' => DB::raw('borrowed+1')
                ]);
        }

        DB::table('bookings')
            ->where('user_id', $booking->user_id)
            ->where('status', BookingStatus::Pending)
            ->update([
                'status' => BookingStatus::Accepted
            ]);

        redirect(route('filament.admin.resources.bookings.index'));
    }
}
