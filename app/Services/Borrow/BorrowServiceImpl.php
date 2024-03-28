<?php

namespace App\Services\Borrow;

use App\Enums\BookingStatus;
use App\Enums\BorrowStatus;
use Illuminate\Support\Facades\DB;

class BorrowServiceImpl implements BorrowService
{
    public function borrowProcess()
    {
        $booking = DB::table('bookings')
            ->where('user_id', auth()->id())
            ->where('status', BookingStatus::Pending)
            ->first();

        $bookingItems = DB::table('booking_items')
            ->join('bookings', 'booking_id', 'bookings.id')
            ->where('bookings.user_id', auth()->id())
            ->where('booking_id', $booking->id)
            ->get();

        $borrow = DB::table('borrows')
            ->insertGetId([
                'booking_id' => $booking->id,
                'user_id' => auth()->id(),
                'return_date' => $booking->take_limit,
                'status' => BorrowStatus::Borrowed,
                'total_fine' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ]);

        foreach ($bookingItems as $item) {
            DB::table('borrow_items')
                ->insert([
                    'borrow_id' => $borrow,
                    'book_id' => $item->book_id,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
        }

        DB::table('bookings')
            ->where('user_id', auth()->id())
            ->where('status', BookingStatus::Pending)
            ->update([
                'status' => BookingStatus::Accepted
            ]);

        redirect(route('filament.admin.resources.bookings.index'));
    }
}
