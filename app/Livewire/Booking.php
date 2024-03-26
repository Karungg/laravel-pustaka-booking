<?php

namespace App\Livewire;

use App\Models\Booking as ModelsBooking;
use App\Models\BookingItem;
use App\Services\Booking\BookingService;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Masmerise\Toaster\Toastable;

#[Layout('layouts.app')]
class Booking extends Component
{
    use Toastable;

    private BookingService $bookingService;

    public function boot(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    #[Computed()]
    public function bookings()
    {
        return $this->bookingService->getAll();
    }

    public function checkout(BookingService $bookingService)
    {
        if ($bookingService->getBookingById()) {
            $this->error('Please complete your booking');
        } else {
            $this->dispatch('checkout');
            return $bookingService->checkout();
        }
    }

    public function destroy(BookingService $bookingService, $bookId)
    {
        if ($bookingService->destroy($bookId) > 0) {
            $this->info('Book successfully deleted!');
            $this->dispatch('book-deleted');
        }
    }

    public function render()
    {
        return view('booking.index');
    }
}
