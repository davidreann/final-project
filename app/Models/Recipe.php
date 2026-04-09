<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    /** @use HasFactory<\Database\Factories\RecipeFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image_url',
        'rating',
        'feedback_count',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
