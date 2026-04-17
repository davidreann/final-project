<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Adds the category column to your existing recipes table
        Schema::table('recipes', function (Blueprint $table) {
            $table->enum('category', ['main_dish', 'appetizer', 'side_dish', 'dessert'])
                  ->nullable()
                  ->after('image');
        });
    }

    public function down(): void
    {
        // Reverts the addition if the migration is rolled back
        Schema::table('recipes', function (Blueprint $table) {
            $table->dropColumn('category');
        });
    }
};