<div>
    <section id="books" class="bg-white py-8">

        <div class="container mx-auto flex items-center flex-wrap pt-4 pb-12">

            @include('partials.nav-store')

            @forelse ($this->books() as $book)
                <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
                    <img class="hover:grow hover:shadow-lg rounded-md" src="{{ $book->getThumbnailUrl() }}">
                    <div class="pt-3 flex items-center justify-between">
                        <p class="pt-1 text-gray-900">By : {{ $book->author }}</p>
                    </div>
                    <p class="">{{ $book->title }}</p>
                    <div class="flex justify-end mt-3">
                        <x-button wire:click='storeBooking'>
                            {{ __('Booking') }}
                        </x-button>
                    </div>
                </div>
            @empty
                <p>No data</p>
            @endforelse

        </div>

        <div class="container mx-auto">
            {{ $this->books()->links(data: ['scrollTo' => '#books']) }}
        </div>

    </section>

</div>
