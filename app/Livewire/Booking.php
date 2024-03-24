<?php

namespace App\Livewire;

use App\Services\Booking\BookingService;
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
