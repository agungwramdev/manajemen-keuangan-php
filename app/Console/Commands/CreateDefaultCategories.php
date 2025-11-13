<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Category;
use Illuminate\Console\Command;

class CreateDefaultCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-default-categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create default categories for users that don\'t have any';

    /**
     * Execute the console command.
     */
    public function handle()
    {
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

        $users = User::all();
        $createdCount = 0;

        foreach ($users as $user) {
            $categoryCount = $user->categories()->count();

            if ($categoryCount === 0) {
                foreach ($defaultCategories as $category) {
                    $user->categories()->create($category);
                }
                $createdCount++;
                $this->info("✓ Created default categories for user: {$user->name}");
            } else {
                $this->info("⊘ User {$user->name} already has categories (count: {$categoryCount})");
            }
        }

        $this->info("\n✓ Default categories created for {$createdCount} user(s)");
    }
}
