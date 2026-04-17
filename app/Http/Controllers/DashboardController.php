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
}