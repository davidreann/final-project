<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * * Fields added for Whisklist features:
     * - title: For recipe names and search keywords
     * - description: Detailed instructions/ingredients
     * - prep_time: For filtering by duration
     * - rating: For the 5-star rating feature
     * - author: For user account profile identification
     */
    public function up(): void
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->integer('prep_time')->default(0);
            $table->integer('rating')->default(0);
            $table->string('author')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};