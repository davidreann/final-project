<?php

namespace Tests\Feature;

use App\Models\Recipe;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BrowseRecipesSearchTest extends TestCase
{
    use RefreshDatabase;

    public function test_browse_search_filters_recipes_by_keyword(): void
    {
        $matchingRecipe = Recipe::factory()->create([
            'title' => 'Spicy Chicken Adobo',
            'description' => 'Savory and tangy Filipino classic.',
            'is_draft' => false,
            'category' => 'main_dish',
        ]);

        $nonMatchingRecipe = Recipe::factory()->create([
            'title' => 'Mango Float',
            'description' => 'Sweet layered dessert.',
            'is_draft' => false,
            'category' => 'dessert',
        ]);

        Recipe::factory()->create([
            'title' => 'Hidden Draft Adobo',
            'is_draft' => true,
            'category' => 'main_dish',
        ]);

        $response = $this->get(route('recipes.browse', ['search' => 'Adobo']));

        $response
            ->assertOk()
            ->assertSee($matchingRecipe->title)
            ->assertDontSee($nonMatchingRecipe->title)
            ->assertDontSee('Hidden Draft Adobo')
            ->assertSee('Search recipes...');
    }

    public function test_browse_search_trims_whitespace_in_query(): void
    {
        $matchingRecipe = Recipe::factory()->create([
            'title' => 'Garlic Butter Shrimp',
            'is_draft' => false,
            'category' => 'main_dish',
        ]);

        $response = $this->get(route('recipes.browse', ['search' => '   Shrimp   ']));

        $response
            ->assertOk()
            ->assertSee($matchingRecipe->title);
    }

    public function test_browse_see_all_links_use_section_pages(): void
    {
        Recipe::factory()->count(5)->create([
            'category' => 'main_dish',
            'is_draft' => false,
        ]);

        Recipe::factory()->count(5)->create([
            'category' => 'appetizer',
            'is_draft' => false,
        ]);

        Recipe::factory()->count(5)->create([
            'category' => 'side_dish',
            'is_draft' => false,
        ]);

        Recipe::factory()->count(5)->create([
            'category' => 'dessert',
            'is_draft' => false,
        ]);

        $response = $this->get(route('recipes.browse'));

        $response
            ->assertOk()
            ->assertSee(route('recipes.section', ['section' => 'main-dish']), false)
            ->assertSee(route('recipes.section', ['section' => 'appetizer']), false)
            ->assertSee(route('recipes.section', ['section' => 'side-dish']), false)
            ->assertSee(route('recipes.section', ['section' => 'dessert']), false);
    }
}
