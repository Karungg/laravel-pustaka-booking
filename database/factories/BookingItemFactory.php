<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Book;
use App\Models\Booking;
use App\Models\BookingItem;

class BookingItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BookingItem::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'booking_id' => Booking::factory(),
            'book_id' => Book::factory(),
        ];
    }
}
