<?php

namespace Database\Seeders;

use App\Models\Recipe;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database with 20 sample recipes.
     */
    public function run(): void
    {
        // Generates 20 fake recipes for the Whisklist directory
        Recipe::factory(20)->create();
    }
}