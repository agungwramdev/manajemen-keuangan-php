<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        if (!$user) {
            return;
        }

        $incomeCategories = [
            ['name' => 'Salary', 'icon' => 'briefcase', 'color' => '#10B981'],
            ['name' => 'Freelance', 'icon' => 'code', 'color' => '#3B82F6'],
            ['name' => 'Investment', 'icon' => 'trending-up', 'color' => '#F59E0B'],
            ['name' => 'Bonus', 'icon' => 'gift', 'color' => '#EC4899'],
            ['name' => 'Other Income', 'icon' => 'plus-circle', 'color' => '#8B5CF6'],
        ];

        $expenseCategories = [
            ['name' => 'Food & Drink', 'icon' => 'utensils', 'color' => '#EF4444'],
            ['name' => 'Transportation', 'icon' => 'car', 'color' => '#F97316'],
            ['name' => 'Utilities', 'icon' => 'zap', 'color' => '#EAB308'],
            ['name' => 'Entertainment', 'icon' => 'film', 'color' => '#EC4899'],
            ['name' => 'Shopping', 'icon' => 'shopping-bag', 'color' => '#F43F5E'],
            ['name' => 'Health', 'icon' => 'heart', 'color' => '#EF4444'],
            ['name' => 'Education', 'icon' => 'book', 'color' => '#3B82F6'],
            ['name' => 'Rent', 'icon' => 'home', 'color' => '#6366F1'],
            ['name' => 'Insurance', 'icon' => 'shield', 'color' => '#0EA5E9'],
            ['name' => 'Other Expense', 'icon' => 'minus-circle', 'color' => '#64748B'],
        ];

        foreach ($incomeCategories as $category) {
            Category::create([
                'user_id' => $user->id,
                'type' => 'income',
                'name' => $category['name'],
                'icon' => $category['icon'],
                'color' => $category['color'],
                'description' => 'Default income category for ' . $category['name'],
            ]);
        }

        foreach ($expenseCategories as $category) {
            Category::create([
                'user_id' => $user->id,
                'type' => 'expense',
                'name' => $category['name'],
                'icon' => $category['icon'],
                'color' => $category['color'],
                'description' => 'Default expense category for ' . $category['name'],
            ]);
        }
    }
}
