<?php

namespace App\Livewire;

use Livewire\Component;

class BookItem extends Component
{
    public $book;

    public function mount($book)
    {
        $this->book = $book;
    }

    public function render()
    {
        return view('livewire.book-item');
    }
}
