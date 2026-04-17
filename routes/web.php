<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\RecipeRatingController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/dashboard/section/{section}', [DashboardController::class, 'section'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard.section');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/recipes/create', [RecipeController::class, 'create'])->name('recipes.create');
    Route::post('/recipes', [RecipeController::class, 'store'])->name('recipes.store');
    Route::get('/recipes/{recipe}/edit', [RecipeController::class, 'edit'])->name('recipes.edit');
    Route::patch('/recipes/{recipe}', [RecipeController::class, 'update'])->name('recipes.update');
    Route::delete('/recipes/{recipe}', [RecipeController::class, 'destroy'])->name('recipes.destroy');
    Route::post('/recipes/{recipe}/save', [RecipeController::class, 'save'])->name('recipes.save');
});

// ── Profile Setup ──────────────────────────────────────────────
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/profile',      [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile',      [ProfileController::class, 'update'])->name('profile.update');

    // ── Recipe Rating ──────────────────────────────────────────
    Route::post('/recipes/{recipe}/rate', [RecipeRatingController::class, 'store'])
         ->name('recipe.rate');
});


require __DIR__.'/auth.php';

Route::get('/browse', [RecipeController::class, 'index'])->name('recipes.browse');
Route::get('/browse/section/{section}', [RecipeController::class, 'section'])->name('recipes.section');
Route::get('/recipes/{recipe}', [RecipeController::class, 'show'])->name('recipes.show');