<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $publishedRecipes = $request->user()
            ->recipes()
            ->where('is_draft', false)
            ->latest()
            ->get();

        $draftRecipes = $request->user()
            ->recipes()
            ->where('is_draft', true)
            ->latest()
            ->get();

        return view('dashboard', compact('publishedRecipes', 'draftRecipes'));
    }
}
