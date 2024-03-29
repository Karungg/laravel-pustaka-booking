<?php

namespace App\Livewire;

use App\Services\Booking\BookingService;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\LaravelPdf\Facades\Pdf;

#[Layout('layouts.app')]
class History extends Component
{
    use WithPagination;

    private BookingService $bookingService;

    public function boot(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    }

    #[Computed()]
    public function history()
    {
        return $this->bookingService->getHistory();
    }

    public function render()
    {
        return view('livewire.booking.history');
    }
}
