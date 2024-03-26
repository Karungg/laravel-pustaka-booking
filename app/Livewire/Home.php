<?php

namespace App\Livewire;

use App\Models\Book;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class Home extends Component
{
    use WithPagination;

    #[Computed()]
    public function books()
    {
        return Book::simplePaginate(8);
    }

    public function render()
    {
        return view('livewire.home');
    }
}
