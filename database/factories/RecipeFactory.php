<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recipe>
 */
class RecipeFactory extends Factory
{
    /**
     * Define the model's default state for testing Whisklist.
     */
    public function definition(): array
    {
        return [
            'title' => fake()->words(3, true),
            'description' => fake()->paragraph(5),
            'prep_time' => fake()->numberBetween(15, 120),
            'rating' => fake()->numberBetween(1, 5),
            'author' => fake()->name(),
        ];
    }
}