<?php

namespace App\Livewire;

use App\Services\Booking\BookingService;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Masmerise\Toaster\Toastable;

class BookItem extends Component
{
    use Toastable;

    public $book;

    public function mount($book)
    {
        $this->book = $book;
    }

    public function storeBook(BookingService $bookingService, $bookId)
    {
        if (auth()->check()) {
            if ($bookingService->getMaxBooks() >= 3) {
                $this->error('Maximum booking is 3!');
            } elseif ($bookingService->isBookAlreadyExist($bookId)) {
                $this->error('This book is already exist in your list!');
            } else {
                DB::table('temps')
                    ->insert([
                        'user_id' => auth()->id(),
                        'book_id' => $bookId,
                        'created_at' => now(),
                        'updated_at' => now()
                    ]);

                $this->dispatch('book-stored');
                $this->info('Book successfully added!');
            }
        } else {
            return redirect(route('login'));
        }
    }

    public function render()
    {
        return view('livewire.book.book-item');
    }
}
