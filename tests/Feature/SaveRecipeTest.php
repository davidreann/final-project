<?php

namespace Tests\Feature;

use App\Models\Recipe;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SaveRecipeTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_save_recipe(): void
    {
        $user = User::factory()->create();
        $recipe = Recipe::factory()->create(['is_draft' => false]);

        $response = $this
            ->actingAs($user)
            ->post(route('recipes.save', $recipe));

        $response
            ->assertRedirect()
            ->assertSessionHas('status', 'Recipe saved to your dashboard.');

        $this->assertDatabaseHas('saved_recipes', [
            'user_id' => $user->id,
            'recipe_id' => $recipe->id,
        ]);
    }

    public function test_saving_same_recipe_twice_does_not_duplicate_rows(): void
    {
        $user = User::factory()->create();
        $recipe = Recipe::factory()->create(['is_draft' => false]);

        $this->actingAs($user)->post(route('recipes.save', $recipe));
        $this->actingAs($user)->post(route('recipes.save', $recipe));

        $this->assertDatabaseCount('saved_recipes', 1);
    }

    public function test_saved_recipe_appears_in_dashboard(): void
    {
        $user = User::factory()->create();
        $recipe = Recipe::factory()->create([
            'title' => 'Saved Kare-Kare',
            'is_draft' => false,
        ]);

        $this->actingAs($user)->post(route('recipes.save', $recipe));

        $response = $this
            ->actingAs($user)
            ->get(route('dashboard'));

        $response
            ->assertOk()
            ->assertSee('Saved Recipes')
            ->assertSee('Saved Kare-Kare');
    }
}
