<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        $publishedRecipes = Recipe::where('user_id', $user->id)
            ->published()
            ->recent()
            ->get();

        $draftRecipes = Recipe::where('user_id', $user->id)
            ->where('is_draft', true)
            ->recent()
            ->get();

        $savedRecipes = $user->savedRecipes()
            ->published()
            ->orderByDesc('saved_recipes.created_at')
            ->get();

        return view('dashboard', compact('publishedRecipes', 'draftRecipes', 'savedRecipes'));
    }

    public function section(Request $request, string $section)
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('login');
        }

        $sections = [
            'my-uploaded' => [
                'title' => 'My Uploaded Recipes',
                'subtitle' => 'All recipes you have created and published.',
                'recipes' => Recipe::where('user_id', $user->id)
                    ->published()
                    ->recent()
                    ->get(),
            ],
            'my-drafts' => [
                'title' => 'My Drafts',
                'subtitle' => 'Recipes you are still working on.',
                'recipes' => Recipe::where('user_id', $user->id)
                    ->where('is_draft', true)
                    ->recent()
                    ->get(),
            ],
            'saved-recipes' => [
                'title' => 'Saved Recipes',
                'subtitle' => 'Recipes you bookmarked from the community.',
                'recipes' => $user->savedRecipes()
                    ->published()
                    ->orderByDesc('saved_recipes.created_at')
                    ->get(),
            ],
        ];

        abort_unless(array_key_exists($section, $sections), 404);

        return view('dashboard.section', [
            'title' => $sections[$section]['title'],
            'subtitle' => $sections[$section]['subtitle'],
            'recipes' => $sections[$section]['recipes'],
        ]);
    }
}