<?php

namespace App\Livewire;

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

    public function storeBook($bookId)
    {
        DB::table('temps')
            ->insert([
                'user_id' => auth()->id(),
                'book_id' => $bookId
            ]);

        $this->success('Book successfully added!');
    }

    public function render()
    {
        return view('livewire.book-item');
    }
}
