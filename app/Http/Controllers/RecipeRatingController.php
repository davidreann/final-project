<?php
namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\RecipeRating;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 * Handles recipe rating submissions.
 *
 * Route (inside auth + verified middleware):
 *   POST /recipes/{recipe}/rate → recipe.rate
 */
class RecipeRatingController extends Controller
{
    /**
     * Store or update the authenticated user's rating for a recipe.
     * Edge cases handled:
     *  - Unauthenticated users → blocked by middleware (auth)
     *  - Rating own recipe → rejected with error message
     *  - Invalid value (not 1–5) → rejected by validation
     *  - Duplicate rating → updateOrCreate handles it silently
     */
    public function store(Request $request, Recipe $recipe): RedirectResponse
    {
        // Prevent rating your own recipe
        if ($recipe->user_id === auth()->id()) {
            return back()->with('error', 'You cannot rate your own recipe.');
        }

        // Validate rating value
        $validated = $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
        ]);

        // updateOrCreate: update if they already rated, otherwise insert
        RecipeRating::updateOrCreate(
            ['user_id' => auth()->id(), 'recipe_id' => $recipe->id],
            ['rating'  => $validated['rating']]
        );

        return back()->with('success', 'Your rating has been saved!');
    }
}
