<div>
    <section id="books" class="bg-white py-8">

        <div class="container mx-auto flex items-center flex-wrap pt-4 pb-12">

            @include('partials.nav-store')

            @forelse ($this->books() as $book)
                <livewire:book-item wire:key="{{ $book->id }}" :book="$book" lazy />
            @empty
                <p>No data</p>
            @endforelse

        </div>

        <div class="container mx-auto">
            {{ $this->books()->links() }}
        </div>

    </section>

</div>
