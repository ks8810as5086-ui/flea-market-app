<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Item>
 */
class ItemFactory extends Factory
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
            'name' => fake()->word(),
            'image_path' => 'dummy.jpg',
            'brand_name' => fake()->company(),
            'description' => fake()->text(255),
            'condition' => fake()->numberBetween(1, 4),
            'price' => fake()->numberBetween(100, 10000),
        ];
    }
}
