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
            ['type' => 'income', 'name' => 'Gaji', 'color' => '#10B981', 'icon' => 'briefcase'],
            ['type' => 'income', 'name' => 'Freelance', 'color' => '#8B5CF6', 'icon' => 'laptop'],
            ['type' => 'income', 'name' => 'Investasi', 'color' => '#3B82F6', 'icon' => 'chart-line'],
            ['type' => 'income', 'name' => 'Bonus', 'color' => '#F59E0B', 'icon' => 'gift'],
            ['type' => 'income', 'name' => 'Pemasukan Lainnya', 'color' => '#6B7280', 'icon' => 'plus-circle'],

            // Expense categories
            ['type' => 'expense', 'name' => 'Makanan & Minuman', 'color' => '#EC4899', 'icon' => 'utensils'],
            ['type' => 'expense', 'name' => 'Transportasi', 'color' => '#EF4444', 'icon' => 'car'],
            ['type' => 'expense', 'name' => 'Utilitas', 'color' => '#14B8A6', 'icon' => 'lightbulb'],
            ['type' => 'expense', 'name' => 'Hiburan', 'color' => '#F97316', 'icon' => 'film'],
            ['type' => 'expense', 'name' => 'Belanja', 'color' => '#D946EF', 'icon' => 'shopping-bag'],
            ['type' => 'expense', 'name' => 'Kesehatan', 'color' => '#06B6D4', 'icon' => 'heart'],
            ['type' => 'expense', 'name' => 'Pendidikan', 'color' => '#0EA5E9', 'icon' => 'book'],
            ['type' => 'expense', 'name' => 'Sewa', 'color' => '#6366F1', 'icon' => 'home'],
            ['type' => 'expense', 'name' => 'Asuransi', 'color' => '#8B5CF6', 'icon' => 'shield'],
            ['type' => 'expense', 'name' => 'Pengeluaran Lainnya', 'color' => '#78716C', 'icon' => 'minus-circle'],
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
