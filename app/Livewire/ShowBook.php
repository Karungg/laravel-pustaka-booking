<?php

namespace App\Livewire;

use App\Models\Book;
use App\Services\Booking\BookingService;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Masmerise\Toaster\Toastable;

#[Layout('layouts.app')]
class ShowBook extends Component
{
    use Toastable;

    public $book;

    public function mount($slug)
    {
        $this->book = Book::where('slug', $slug)->firstOrFail();
    }

    public function storeBook(BookingService $bookingService, $bookId)
    {
        if (auth()->check()) {
            if ($bookingService->getMaxBooks() >= 3) {
                $this->error('Maximum booking is 3!');
            } elseif ($bookingService->isStockAvaliable($bookId)) {
                $this->error('This book is sold out!');
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
        return view('livewire.book.show-book');
    }
}
