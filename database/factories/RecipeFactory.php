<?php

namespace Database\Factories;

use App\Models\User;
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
            'user_id' => User::factory(),
            'title' => fake()->words(3, true),
            'description' => fake()->paragraph(2),
            'ingredients' => collect(fake()->sentences(6))
                ->map(fn ($line) => '- ' . $line)
                ->implode("\n"),
            'steps' => collect(fake()->sentences(5))
                ->map(fn ($line, $index) => ($index + 1) . '. ' . $line)
                ->implode("\n"),
            'prep_time' => fake()->numberBetween(15, 120),
            'image' => null,
            'category' => fake()->randomElement(['main_dish', 'appetizer', 'side_dish', 'dessert']),
        ];
    }
}