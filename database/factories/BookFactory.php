<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Book;
use App\Models\Category;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'slug' => $this->faker->slug(),
            'description' => $this->faker->text(),
            'category_id' => Category::factory(),
            'author' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'publisher' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'publication_date' => $this->faker->date(),
            'number_of_pages' => $this->faker->regexify('[A-Za-z0-9]{4}'),
            'heavy' => $this->faker->randomFloat(0, 0, 9999999999.),
            'wide' => $this->faker->randomFloat(0, 0, 9999999999.),
            'long' => $this->faker->randomFloat(0, 0, 9999999999.),
            'languange' => $this->faker->regexify('[A-Za-z0-9]{128}'),
            'isbn' => $this->faker->regexify('[A-Za-z0-9]{64}'),
            'stocks' => $this->faker->numberBetween(-10000, 10000),
            'borrowed' => $this->faker->numberBetween(-10000, 10000),
            'booked' => $this->faker->numberBetween(-10000, 10000),
            'image' => $this->faker->word(),
        ];
    }
}
