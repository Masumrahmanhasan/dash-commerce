<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use function fake;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::factory(),
            'name' => fake()->words(3, true), // This will generate a three-word name,
            'slug' => Str::slug(fake()->words(3, true)).' - '.Str::random(5),
            'description' => fake()->sentence(),
            'price' => fake()->randomFloat(2, 10, 10000),
            'image' => fake()->imageUrl(640, 480, 'products', true, 'Faker'),
            'stock' => fake()->randomDigit(),
        ];
    }
}
