<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Purchase>
 */
class PurchaseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'item_id' => Item::factory(),
            'payment_method' => fake()->numberBetween(1, 2),
            'postal_code' => '000-0000',
            'address' => fake()->address(),
            'building' => null,
        ];
    }
}
