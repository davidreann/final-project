<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Recipe extends Model
{
    /** @use HasFactory<\Database\Factories\RecipeFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'ingredients',
        'steps',
        'closing',
        'prep_time',
        'is_draft',
        'image',
        'category',
        'user_id',
    ];

    // Added casts to ensure database values are strictly converted to boolean
    // This prevents type mismatch errors on existing database entries
    protected $casts = [
        'is_draft' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function savedByUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'saved_recipes')
            ->withTimestamps();
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('is_draft', false);
    }

    public function scopeSearch(Builder $query, ?string $search): Builder
    {
        $search = trim((string) $search);

        if (blank($search)) {
            return $query;
        }

        return $query->where(function (Builder $subQuery) use ($search) {
            $subQuery->where('title', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%")
                ->orWhere('ingredients', 'like', "%{$search}%")
                ->orWhere('steps', 'like', "%{$search}%")
                ->orWhere('closing', 'like', "%{$search}%");
        });
    }

    public function scopeByCategory(Builder $query, ?string $category): Builder
    {
        if (blank($category)) {
            return $query;
        }

        return $query->where('category', $category);
    }

    public function scopeRecent(Builder $query): Builder
    {
        return $query->orderByDesc('created_at');
    }

    /** All star ratings for this recipe */
public function ratings(): HasMany
{
    return $this->hasMany(RecipeRating::class);
}

/** Average star rating, rounded to 1 decimal. Returns null if unrated. */
public function averageRating(): ?float
{
    $avg = $this->ratings()->avg('rating');
    return $avg ? round($avg, 1) : null;
}

/** Total number of ratings */
public function ratingCount(): int
{
    return $this->ratings()->count();
}

/** The authenticated user's own rating, or null */
public function userRating(): ?int
{
    if (! auth()->check()) return null;
    return $this->ratings()
                ->where('user_id', auth()->id())
                ->value('rating');
}

}

