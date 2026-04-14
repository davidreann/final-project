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
        $search = $request->input('search');

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