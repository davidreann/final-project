<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecipeRequest;
use App\Http\Requests\UpdateRecipeRequest;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RecipeController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->input('search', ''));
        $search = $search !== '' ? $search : null;

        $topRecipes = Recipe::query()
            ->published()
            ->search($search)
            ->orderByDesc('created_at')
            ->take(20)
            ->get();

        $newRecipes = Recipe::query()
            ->published()
            ->search($search)
                ->recent()
            ->take(20)
            ->get();

        $mainDishRecipes = Recipe::query()
            ->published()
            ->search($search)
            ->byCategory('main_dish')
                ->recent()
            ->take(20)
            ->get();

        $appetizerRecipes = Recipe::query()
            ->published()
            ->search($search)
            ->byCategory('appetizer')
                ->recent()
            ->take(20)
            ->get();

        $sideDishRecipes = Recipe::query()
            ->published()
            ->search($search)
            ->byCategory('side_dish')
                ->recent()
            ->take(20)
            ->get();

        $dessertRecipes = Recipe::query()
            ->published()
            ->search($search)
            ->byCategory('dessert')
                ->recent()
            ->take(20)
            ->get();

        return view('recipes.browse', compact(
            'topRecipes',
            'newRecipes',
            'mainDishRecipes',
            'appetizerRecipes',
            'sideDishRecipes',
            'dessertRecipes',
            'search'
        ));
    }

    public function create()
    {
        return view('recipes.create');
    }

    public function section(Request $request, string $section)
    {
        $search = trim((string) $request->input('search', ''));
        $search = $search !== '' ? $search : null;

        $sections = [
            'top-recipes' => [
                'title' => 'Top 20 Recipes',
                'subtitle' => 'The most loved recipes in the Whisklist community.',
                'recipes' => Recipe::query()
                    ->published()
                    ->search($search)
                    ->orderByDesc('created_at')
                    ->take(20)
                    ->get(),
            ],
            'new-recipes' => [
                'title' => 'New Recipes',
                'subtitle' => 'Fresh recipes just added to our collection.',
                'recipes' => Recipe::query()
                    ->published()
                    ->search($search)
                    ->recent()
                    ->get(),
            ],
            'main-dish' => [
                'title' => 'Main Dish',
                'subtitle' => 'Hearty and satisfying main course recipes.',
                'recipes' => Recipe::query()
                    ->published()
                    ->search($search)
                    ->byCategory('main_dish')
                    ->recent()
                    ->get(),
            ],
            'appetizer' => [
                'title' => 'Appetizer',
                'subtitle' => 'Start your meal with these delightful starters.',
                'recipes' => Recipe::query()
                    ->published()
                    ->search($search)
                    ->byCategory('appetizer')
                    ->recent()
                    ->get(),
            ],
            'side-dish' => [
                'title' => 'Side Dish',
                'subtitle' => 'Perfect sides to complement your main course.',
                'recipes' => Recipe::query()
                    ->published()
                    ->search($search)
                    ->byCategory('side_dish')
                    ->recent()
                    ->get(),
            ],
            'dessert' => [
                'title' => 'Dessert',
                'subtitle' => 'Sweet treats to satisfy your cravings.',
                'recipes' => Recipe::query()
                    ->published()
                    ->search($search)
                    ->byCategory('dessert')
                    ->recent()
                    ->get(),
            ],
        ];

        abort_unless(array_key_exists($section, $sections), 404);

        return view('recipes.section', [
            'title' => $sections[$section]['title'],
            'subtitle' => $sections[$section]['subtitle'],
            'recipes' => $sections[$section]['recipes'],
            'search' => $search,
        ]);
    }

    public function store(StoreRecipeRequest $request)
    {
        $isDraft = $request->input('intent') === 'draft';
        $validated = $request->validated();

        $steps = $this->normalizeSteps($validated['steps'] ?? []);
        $imagePath = $request->hasFile('image')
            ? $request->file('image')->store('recipes', 'public')
            : null;

        if (! $isDraft && $steps->isEmpty()) {
            return back()
                ->withErrors(['steps' => 'Please add at least one step.'])
                ->withInput();
        }

        $recipe = Recipe::create([
            'title' => $validated['title'] ?? '',
            'description' => $validated['description'] ?? null,
            'ingredients' => $validated['ingredients'] ?? '',
            'steps' => $steps->implode("\n"),
            'closing' => $validated['closing'] ?? null,
            'prep_time' => $validated['prep_time'] ?? 0,
            'is_draft' => $isDraft,
            'image' => $imagePath,
            'category' => $validated['category'] ?? null,
            'user_id' => Auth::id(),
        ]);

        if ($isDraft) {
            return redirect()
                ->route('dashboard')
                ->with('status', 'Draft saved successfully.');
        }

        return redirect()
            ->route('recipes.show', $recipe->id)
            ->with('status', 'Recipe posted successfully. Let\'s get cooking!');
    }

    public function edit(Recipe $recipe)
    {
        $this->authorize('update', $recipe);

        return view('recipes.edit', compact('recipe'));
    }

    public function update(UpdateRecipeRequest $request, Recipe $recipe)
    {
        $this->authorize('update', $recipe);

        $isDraft = $request->input('intent') === 'draft';
        $validated = $request->validated();
        $steps = $this->normalizeSteps($validated['steps'] ?? []);

        if (! $isDraft && $steps->isEmpty()) {
            return back()
                ->withErrors(['steps' => 'Please add at least one step.'])
                ->withInput();
        }

        $imagePath = $recipe->image;

        if ($request->hasFile('image')) {
            if (! empty($recipe->image)) {
                Storage::disk('public')->delete($recipe->image);
            }

            $imagePath = $request->file('image')->store('recipes', 'public');
        }

        $recipe->update([
            'title' => $validated['title'] ?? '',
            'description' => $validated['description'] ?? null,
            'ingredients' => $validated['ingredients'] ?? '',
            'steps' => $steps->implode("\n"),
            'closing' => $validated['closing'] ?? null,
            'prep_time' => $validated['prep_time'] ?? 0,
            'is_draft' => $isDraft,
            'image' => $imagePath,
            'category' => $validated['category'] ?? null,
        ]);

        if ($isDraft) {
            return redirect()
                ->route('dashboard')
                ->with('status', 'Draft saved successfully.');
        }

        return redirect()
            ->route('recipes.show', $recipe->id)
            ->with('status', 'Recipe updated successfully.');
    }

    public function show(Recipe $recipe)
    {
        $this->authorize('view', $recipe);

        return view('recipes.show', compact('recipe'));
    }

    public function save(Request $request, Recipe $recipe)
    {
        $this->authorize('view', $recipe);

        if ($recipe->is_draft) {
            return back()->with('status', 'Only published recipes can be saved.');
        }

        $user = $request->user();

        if (! $user) {
            return redirect()->route('login');
        }

        $user->savedRecipes()->syncWithoutDetaching([$recipe->id]);

        return back()->with('status', 'Recipe saved to your dashboard.');
    }

    public function destroy(Recipe $recipe)
    {
        $this->authorize('delete', $recipe);

        $recipe->delete();

        return redirect()
            ->route('dashboard')
            ->with('status', 'Recipe deleted successfully.');
    }

    private function normalizeSteps(?array $steps)
    {
        return collect($steps ?? [])
            ->map(fn ($step) => trim($step))
            ->filter()
            ->values();
    }
}