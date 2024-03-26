<?php

namespace App\Livewire;

use App\Services\Booking\BookingService;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class History extends Component
{
    private BookingService $bookingService;

    public function mount(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    #[Computed()]
    public function bookings()
    {
        return $this->bookingService->getBookings();
    }

    public function render()
    {
        return view('livewire.booking.history');
    }
}
