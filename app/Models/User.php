<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Events\Created;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    /**
     * Boot the model and register events.
     */
    protected static function boot()
    {
        parent::boot();

        // Create default categories for new users
        static::created(function ($user) {
            $defaultCategories = [
                // Income categories
                ['type' => 'income', 'name' => 'Salary', 'color' => '#10B981', 'icon' => 'briefcase'],
                ['type' => 'income', 'name' => 'Freelance', 'color' => '#8B5CF6', 'icon' => 'laptop'],
                ['type' => 'income', 'name' => 'Investment', 'color' => '#3B82F6', 'icon' => 'chart-line'],
                ['type' => 'income', 'name' => 'Bonus', 'color' => '#F59E0B', 'icon' => 'gift'],
                ['type' => 'income', 'name' => 'Other Income', 'color' => '#6B7280', 'icon' => 'plus-circle'],

                // Expense categories
                ['type' => 'expense', 'name' => 'Food & Drink', 'color' => '#EC4899', 'icon' => 'utensils'],
                ['type' => 'expense', 'name' => 'Transportation', 'color' => '#EF4444', 'icon' => 'car'],
                ['type' => 'expense', 'name' => 'Utilities', 'color' => '#14B8A6', 'icon' => 'lightbulb'],
                ['type' => 'expense', 'name' => 'Entertainment', 'color' => '#F97316', 'icon' => 'film'],
                ['type' => 'expense', 'name' => 'Shopping', 'color' => '#D946EF', 'icon' => 'shopping-bag'],
                ['type' => 'expense', 'name' => 'Health', 'color' => '#06B6D4', 'icon' => 'heart'],
                ['type' => 'expense', 'name' => 'Education', 'color' => '#0EA5E9', 'icon' => 'book'],
                ['type' => 'expense', 'name' => 'Rent', 'color' => '#6366F1', 'icon' => 'home'],
                ['type' => 'expense', 'name' => 'Insurance', 'color' => '#8B5CF6', 'icon' => 'shield'],
                ['type' => 'expense', 'name' => 'Other Expense', 'color' => '#78716C', 'icon' => 'minus-circle'],
            ];

            foreach ($defaultCategories as $category) {
                $user->categories()->create($category);
            }
        });
    }
}
