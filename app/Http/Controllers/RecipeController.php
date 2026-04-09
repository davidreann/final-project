<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $recipes = Recipe::query()
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                             ->orWhere('description', 'like', "%{$search}%");
            })
            // Logic: High rating first, then most feedback count
            ->orderByDesc('rating')
            ->orderByDesc('feedback_count') 
            ->take(20)
            ->get();

        return view('recipes.browse', compact('recipes'));
    }

    public function show($id)
    {
        $recipe = Recipe::findOrFail($id);
        return view('recipes.show', compact('recipe'));
    }
}