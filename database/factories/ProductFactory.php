<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'category_id' => Category::inRandomOrder()->first()->id,
            'name' => fake()->words(2, true),
            'price' => fake()->numberBetween(10000, 500000),
            'stock' => fake()->numberBetween(1, 100),
        ];
    }
}