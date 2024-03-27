<?php

namespace App\Services\Borrow;

use App\Enums\BookingStatus;
use Illuminate\Support\Facades\DB;

class BorrowServiceImpl implements BorrowService
{
    public function borrowProcess()
    {
        $booking = DB::table('booking_items')
            ->join('bookings', 'booking_id', 'bookings.id')
            ->where('bookings.user_id', auth()->id())
            ->get();

        $bookingId = DB::table('booking_items')
            ->join('bookings', 'booking_id', 'bookings.id')
            ->where('bookings.user_id', auth()->id())
            ->first()->id;

        $takeLimit = DB::table('booking_items')
            ->join('bookings', 'booking_id', 'bookings.id')
            ->where('bookings.user_id', auth()->id())
            ->first()->take_limit;

        DB::table('borrows')
            ->insert([
                'booking_id' => $bookingId,
                'user_id' => auth()->id(),
                'return_date' => $takeLimit,
                'status' => 'borrowed',
                'total_fine' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ]);

        DB::table('booking_items')
            ->join('bookings', 'booking_id', 'bookings.id')
            ->where('bookings.user_id', auth()->id())
            ->update([
                'status' => BookingStatus::Accepted
            ]);

        redirect(route('filament.admin.resources.bookings.index'));
    }
}
