<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecipeRequest;
use App\Http\Requests\UpdateRecipeRequest;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    public function index(Request $request)
    {
        $recipes = Recipe::query()
            ->published()
            ->search($request->input('search'))
            ->orderByDesc('created_at')
            ->take(20)
            ->get();

        return view('recipes.browse', compact('recipes'));
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

        $recipe->update([
            'title' => $validated['title'] ?? '',
            'description' => $validated['description'] ?? null,
            'ingredients' => $validated['ingredients'] ?? '',
            'steps' => $steps->implode("\n"),
            'closing' => $validated['closing'] ?? null,
            'prep_time' => $validated['prep_time'] ?? 0,
            'is_draft' => $isDraft,
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