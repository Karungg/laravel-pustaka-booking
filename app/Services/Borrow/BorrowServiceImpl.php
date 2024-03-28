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

        foreach ($booking as $data) {
            DB::table('borrows')
                ->insert([
                    'booking_id' => $data->booking_id,
                    'user_id' => auth()->id(),
                    'return_date' => $data->take_limit,
                    'status' => 'borrowed',
                    'total_fine' => 0,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
        }

        DB::table('booking_items')
            ->join('bookings', 'booking_id', 'bookings.id')
            ->where('bookings.user_id', auth()->id())
            ->update([
                'status' => BookingStatus::Accepted
            ]);

        redirect(route('filament.admin.resources.bookings.index'));
    }
}
