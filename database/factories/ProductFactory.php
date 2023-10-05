<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;

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
    public function definition()
    {
        return [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'price' => $this->faker->numberBetween(0, 500), // Generate a random integer between 100 and 10,000
            'stock' => $this->faker->numberBetween(1, 100),     // Generate a random integer between 1 and 100
            'vat' => $this->faker->numberBetween(5, 21),        // Generate a random integer between 5 and 21 (VAT percentages)
        ];
    }
}
