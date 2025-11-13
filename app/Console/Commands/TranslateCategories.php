<?php

namespace App\Console\Commands;

use App\Models\Category;
use Illuminate\Console\Command;

class TranslateCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:translate-categories';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Translate existing categories from English to Indonesian';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Mapping of old names to new Indonesian names
        $translations = [
            // Income
            'Salary' => 'Gaji',
            'Freelance' => 'Freelance',
            'Investment' => 'Investasi',
            'Bonus' => 'Bonus',
            'Other Income' => 'Pemasukan Lainnya',

            // Expense
            'Food & Drink' => 'Makanan & Minuman',
            'Transportation' => 'Transportasi',
            'Utilities' => 'Utilitas',
            'Entertainment' => 'Hiburan',
            'Shopping' => 'Belanja',
            'Health' => 'Kesehatan',
            'Education' => 'Pendidikan',
            'Rent' => 'Sewa',
            'Insurance' => 'Asuransi',
            'Other Expense' => 'Pengeluaran Lainnya',
        ];

        $updatedCount = 0;

        foreach ($translations as $old => $new) {
            $categories = Category::where('name', $old)->get();

            foreach ($categories as $category) {
                $category->update(['name' => $new]);
                $updatedCount++;
                $this->info("✓ Translated: {$old} → {$new}");
            }
        }

        $this->info("\n✓ Total categories translated: {$updatedCount}");
    }
}
