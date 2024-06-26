<?php

namespace App\Livewire;

use App\Services\Booking\BookingService;
use Livewire\Attributes\On;
use Livewire\Component;

class BookCount extends Component
{
    public $count;

    #[On('book-stored')]
    #[On('book-deleted')]
    #[On('checkout')]
    public function mount(BookingService $bookingService)
    {
        return $this->count = $bookingService->getMaxBooks();
    }

    public function render()
    {
        return <<<'blade'
        <div>
            Booking {{ $this->count }}
        </div>
        blade;
    }
}
