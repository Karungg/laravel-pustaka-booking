<?php

namespace App\Http\Controllers;

use App\Services\Booking\BookingService;
use Illuminate\Http\Request;
use Illuminate\Support\Traits\Dumpable;

class BookingController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(BookingService $bookingService)
    {
        return view('booking.index', [
            'bookings' => $bookingService->getAll(),
        ]);
    }
}
