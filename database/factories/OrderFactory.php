<?php
declare(strict_types=1);
namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use function fake;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_number' => 'ORD-' . Str::upper(Str::random(8)),
            'user_id' => User::factory(),
            'total_price' => fake()->randomFloat(2, 10, 1000), // Random price between 10 and 1000
            'status' => fake()->randomElement(['pending', 'processing', 'shipped', 'completed', 'cancelled']),
            'shipping_address' => fake()->address,
            'payment_address' => fake()->address,
        ];
    }
}
