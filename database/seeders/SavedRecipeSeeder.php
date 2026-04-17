<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SavedRecipeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('saved_recipes')->insert([
            [
                'user_id' => 1,
                'recipe_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'recipe_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1,
                'recipe_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}