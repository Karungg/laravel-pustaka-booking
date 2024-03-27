<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Book;
use App\Models\Borrow;
use App\Models\BorrowItem;

class BorrowItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BorrowItem::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'borrow_id' => Borrow::factory(),
            'book_id' => Book::factory(),
            'fine' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
