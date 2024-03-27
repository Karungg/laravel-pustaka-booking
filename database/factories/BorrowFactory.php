<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Booking;
use App\Models\Borrow;
use App\Models\User;

class BorrowFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Borrow::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'booking_id' => Booking::factory(),
            'user_id' => User::factory(),
            'return_date' => $this->faker->date(),
            'return_of_date' => $this->faker->date(),
            'status' => $this->faker->randomElement(["borrowed","returned"]),
            'total_fine' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
