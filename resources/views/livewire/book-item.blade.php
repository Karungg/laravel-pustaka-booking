<div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
    <img class="hover:grow hover:shadow-lg rounded-md" src="{{ $book->getThumbnailUrl() }}">
    <div class="pt-3 flex items-center justify-between">
        <p class="pt-1 text-gray-900">By : {{ $book->author }}</p>
    </div>
    <p class="">{{ $book->title }}</p>
    <div class="flex justify-end mt-3">
        <x-button wire:click.prevent='storeBook({{ $book->id }})'>
            {{ __('Booking') }}
        </x-button>
    </div>
</div>
