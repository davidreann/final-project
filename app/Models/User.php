<?php
namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'username', 'email', 'password',
        'bio', 'avatar', 'location',   // ← new fields
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    // ── Relationships ─────────────────────────────────────
    /** Recipes created by this user */
    public function recipes(): HasMany
    {
        return $this->hasMany(Recipe::class);
    }

    /** Ratings submitted by this user */
    public function ratings(): HasMany
    {
        return $this->hasMany(RecipeRating::class);
    }

    /** Recipes saved by this user */
    public function savedRecipes(): BelongsToMany
    {
        return $this->belongsToMany(Recipe::class, 'saved_recipes')
            ->withTimestamps();
    }

    // ── Helpers ───────────────────────────────────────────
    /** Returns avatar URL or default placeholder */
    public function avatarUrl(): string
    {
        return $this->avatar
            ? asset('storage/' . $this->avatar)
            : asset('images/default-avatar.png');
    }

    /** True when username AND bio are both filled */
    public function hasCompletedProfile(): bool
    {
        return filled($this->username) && filled($this->bio);
    }
}
