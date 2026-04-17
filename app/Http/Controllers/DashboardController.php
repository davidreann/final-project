<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Fetch the currently authenticated user
        $user = $request->user();

        // Safety fallback: prevents the dashboard from crashing if the user isn't fully authenticated
        if (!$user) {
            return redirect()->route('login');
        }

        // We now query the Recipe model directly. 
        // This resolves any "Call to undefined method User::recipes()" errors
        // while safely taking advantage of the eloquent scopes you built in your Recipe model.
        $publishedRecipes = Recipe::where('user_id', $user->id)
            ->published() // Uses scopePublished()
            ->recent()    // Uses scopeRecent() to replace latest()
            ->get();

        $draftRecipes = Recipe::where('user_id', $user->id)
            ->where('is_draft', true)
            ->recent()
            ->get();

        return view('dashboard', compact('publishedRecipes', 'draftRecipes'));
    }
}