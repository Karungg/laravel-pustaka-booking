<?php

namespace App\Services\Borrow;

use Illuminate\Support\Facades\DB;

class BorrowServiceImpl implements BorrowService
{
    public function borrowProcess()
    {
        $booking =  DB::table('booking_items')
            ->join('bookings', 'booking_id', 'bookings.id')
            ->where('bookings.user_id', auth()->id())
            ->get();

        foreach ($booking as $data) {
        }
    }
}
