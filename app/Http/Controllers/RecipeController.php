<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    /**
     * Fetch all recipes from the database and pass them to the Blade view.
     * This fulfills the requirement: "Pass data from your model to your Blade views"
     */
    public function index()
    {
        $recipes = Recipe::all();
        return view('recipes.index', compact('recipes'));
    }
}