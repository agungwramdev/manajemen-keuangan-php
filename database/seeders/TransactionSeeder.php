<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the demo user (John Doe)
        $user = User::where('email', 'john@example.com')->first();

        if (!$user) {
            return;
        }

        // Get user's categories
        $categories = $user->categories()->get()->keyBy('name');

        // Income transactions - banyak data untuk setiap kategori
        $incomeTransactions = [
            // Salary
            ['category' => 'Salary', 'title' => 'Gaji Bulan November', 'description' => 'Gaji dari perusahaan', 'amount' => 5000000, 'type' => 'income', 'payment_method' => 'Bank Transfer', 'days_ago' => 5],
            ['category' => 'Salary', 'title' => 'Gaji Bulan Oktober', 'description' => 'Gaji dari perusahaan', 'amount' => 5000000, 'type' => 'income', 'payment_method' => 'Bank Transfer', 'days_ago' => 35],
            ['category' => 'Salary', 'title' => 'Gaji Bulan September', 'description' => 'Gaji dari perusahaan', 'amount' => 5000000, 'type' => 'income', 'payment_method' => 'Bank Transfer', 'days_ago' => 65],
            // Freelance
            ['category' => 'Freelance', 'title' => 'Proyek Website Design', 'description' => 'Pembayaran proyek freelance', 'amount' => 2500000, 'type' => 'income', 'payment_method' => 'Bank Transfer', 'days_ago' => 10],
            ['category' => 'Freelance', 'title' => 'Proyek Mobile App', 'description' => 'Pembayaran proyek freelance', 'amount' => 3000000, 'type' => 'income', 'payment_method' => 'Bank Transfer', 'days_ago' => 20],
            ['category' => 'Freelance', 'title' => 'Konsultasi IT', 'description' => 'Pembayaran konsultasi', 'amount' => 1500000, 'type' => 'income', 'payment_method' => 'Bank Transfer', 'days_ago' => 40],
            ['category' => 'Freelance', 'title' => 'Proyek Database', 'description' => 'Pembayaran proyek freelance', 'amount' => 2000000, 'type' => 'income', 'payment_method' => 'Bank Transfer', 'days_ago' => 55],
            // Investment
            ['category' => 'Investment', 'title' => 'Dividen Saham A', 'description' => 'Return dari investasi saham', 'amount' => 1500000, 'type' => 'income', 'payment_method' => 'Bank Transfer', 'days_ago' => 15],
            ['category' => 'Investment', 'title' => 'Dividen Saham B', 'description' => 'Return dari investasi saham', 'amount' => 1200000, 'type' => 'income', 'payment_method' => 'Bank Transfer', 'days_ago' => 30],
            ['category' => 'Investment', 'title' => 'Return Reksadana', 'description' => 'Return dari reksadana', 'amount' => 800000, 'type' => 'income', 'payment_method' => 'Bank Transfer', 'days_ago' => 50],
            // Bonus
            ['category' => 'Bonus', 'title' => 'Bonus Performa Q4', 'description' => 'Bonus akhir tahun', 'amount' => 3000000, 'type' => 'income', 'payment_method' => 'Bank Transfer', 'days_ago' => 20],
            ['category' => 'Bonus', 'title' => 'Bonus Tahunan', 'description' => 'Bonus tahunan perusahaan', 'amount' => 5000000, 'type' => 'income', 'payment_method' => 'Bank Transfer', 'days_ago' => 60],
            // Other Income
            ['category' => 'Other Income', 'title' => 'Penjualan Item Lama', 'description' => 'Penjualan barang second', 'amount' => 500000, 'type' => 'income', 'payment_method' => 'Cash', 'days_ago' => 8],
            ['category' => 'Other Income', 'title' => 'Penjualan Motor Bekas', 'description' => 'Penjualan barang second', 'amount' => 8000000, 'type' => 'income', 'payment_method' => 'Bank Transfer', 'days_ago' => 25],
            ['category' => 'Other Income', 'title' => 'Cashback Belanja', 'description' => 'Cashback dari aplikasi', 'amount' => 250000, 'type' => 'income', 'payment_method' => 'Cash', 'days_ago' => 18],
        ];

        // Expense transactions - banyak data untuk setiap kategori
        $expenseTransactions = [
            // Food & Drink
            ['category' => 'Food & Drink', 'title' => 'Makan Siang', 'description' => 'Makan di restoran', 'amount' => 75000, 'type' => 'expense', 'payment_method' => 'Cash', 'days_ago' => 1],
            ['category' => 'Food & Drink', 'title' => 'Makan Malam', 'description' => 'Makan di restoran', 'amount' => 120000, 'type' => 'expense', 'payment_method' => 'Cash', 'days_ago' => 1],
            ['category' => 'Food & Drink', 'title' => 'Groceries', 'description' => 'Belanja kebutuhan rumah tangga', 'amount' => 500000, 'type' => 'expense', 'payment_method' => 'Debit Card', 'days_ago' => 3],
            ['category' => 'Food & Drink', 'title' => 'Kopi Pagi', 'description' => 'Kopi setiap hari', 'amount' => 30000, 'type' => 'expense', 'payment_method' => 'Cash', 'days_ago' => 2],
            ['category' => 'Food & Drink', 'title' => 'Makan Siang Kantor', 'description' => 'Makan di kantin', 'amount' => 50000, 'type' => 'expense', 'payment_method' => 'Cash', 'days_ago' => 4],
            ['category' => 'Food & Drink', 'title' => 'Pizza Delivery', 'description' => 'Pesan pizza', 'amount' => 200000, 'type' => 'expense', 'payment_method' => 'Debit Card', 'days_ago' => 5],
            ['category' => 'Food & Drink', 'title' => 'Snack & Jajanan', 'description' => 'Snack di toko', 'amount' => 100000, 'type' => 'expense', 'payment_method' => 'Cash', 'days_ago' => 6],
            // Transportation
            ['category' => 'Transportation', 'title' => 'Bensin Mobil', 'description' => 'Isi bensin bulanan', 'amount' => 300000, 'type' => 'expense', 'payment_method' => 'Debit Card', 'days_ago' => 2],
            ['category' => 'Transportation', 'title' => 'Parkir', 'description' => 'Parkir di mall', 'amount' => 15000, 'type' => 'expense', 'payment_method' => 'Cash', 'days_ago' => 1],
            ['category' => 'Transportation', 'title' => 'Tol', 'description' => 'Biaya tol', 'amount' => 50000, 'type' => 'expense', 'payment_method' => 'Cash', 'days_ago' => 3],
            ['category' => 'Transportation', 'title' => 'Uber', 'description' => 'Transportasi online', 'amount' => 75000, 'type' => 'expense', 'payment_method' => 'Debit Card', 'days_ago' => 4],
            ['category' => 'Transportation', 'title' => 'Servis Mobil', 'description' => 'Perawatan mobil', 'amount' => 500000, 'type' => 'expense', 'payment_method' => 'Debit Card', 'days_ago' => 8],
            // Utilities
            ['category' => 'Utilities', 'title' => 'Listrik', 'description' => 'Tagihan listrik bulan November', 'amount' => 450000, 'type' => 'expense', 'payment_method' => 'Bank Transfer', 'days_ago' => 7],
            ['category' => 'Utilities', 'title' => 'Air', 'description' => 'Tagihan air bulan November', 'amount' => 150000, 'type' => 'expense', 'payment_method' => 'Bank Transfer', 'days_ago' => 7],
            ['category' => 'Utilities', 'title' => 'Internet', 'description' => 'Tagihan internet', 'amount' => 200000, 'type' => 'expense', 'payment_method' => 'Bank Transfer', 'days_ago' => 10],
            ['category' => 'Utilities', 'title' => 'Telepon', 'description' => 'Tagihan telepon', 'amount' => 100000, 'type' => 'expense', 'payment_method' => 'Bank Transfer', 'days_ago' => 10],
            // Entertainment
            ['category' => 'Entertainment', 'title' => 'Nonton Bioskop', 'description' => 'Tiket bioskop 2 orang', 'amount' => 100000, 'type' => 'expense', 'payment_method' => 'Debit Card', 'days_ago' => 4],
            ['category' => 'Entertainment', 'title' => 'Bermain Game', 'description' => 'Beli game di steam', 'amount' => 250000, 'type' => 'expense', 'payment_method' => 'Credit Card', 'days_ago' => 6],
            ['category' => 'Entertainment', 'title' => 'Netflix', 'description' => 'Langganan netflix', 'amount' => 60000, 'type' => 'expense', 'payment_method' => 'Debit Card', 'days_ago' => 8],
            ['category' => 'Entertainment', 'title' => 'Spotify Premium', 'description' => 'Langganan musik', 'amount' => 54000, 'type' => 'expense', 'payment_method' => 'Debit Card', 'days_ago' => 9],
            // Shopping
            ['category' => 'Shopping', 'title' => 'Baju Baru', 'description' => 'Belanja pakaian di mall', 'amount' => 800000, 'type' => 'expense', 'payment_method' => 'Credit Card', 'days_ago' => 5],
            ['category' => 'Shopping', 'title' => 'Sepatu', 'description' => 'Belanja sepatu olahraga', 'amount' => 600000, 'type' => 'expense', 'payment_method' => 'Debit Card', 'days_ago' => 9],
            ['category' => 'Shopping', 'title' => 'Tas Branded', 'description' => 'Belanja tas', 'amount' => 1200000, 'type' => 'expense', 'payment_method' => 'Credit Card', 'days_ago' => 12],
            ['category' => 'Shopping', 'title' => 'Elektronik', 'description' => 'Beli elektronik', 'amount' => 2000000, 'type' => 'expense', 'payment_method' => 'Credit Card', 'days_ago' => 18],
            ['category' => 'Shopping', 'title' => 'Furniture', 'description' => 'Beli furniture rumah', 'amount' => 3000000, 'type' => 'expense', 'payment_method' => 'Bank Transfer', 'days_ago' => 25],
            // Health
            ['category' => 'Health', 'title' => 'Apotek', 'description' => 'Beli obat di apotek', 'amount' => 150000, 'type' => 'expense', 'payment_method' => 'Cash', 'days_ago' => 3],
            ['category' => 'Health', 'title' => 'Pemeriksaan Dokter', 'description' => 'Konsultasi dokter gigi', 'amount' => 300000, 'type' => 'expense', 'payment_method' => 'Debit Card', 'days_ago' => 8],
            ['category' => 'Health', 'title' => 'Gym', 'description' => 'Biaya langganan gym', 'amount' => 200000, 'type' => 'expense', 'payment_method' => 'Debit Card', 'days_ago' => 11],
            ['category' => 'Health', 'title' => 'Vitamin', 'description' => 'Beli vitamin', 'amount' => 100000, 'type' => 'expense', 'payment_method' => 'Cash', 'days_ago' => 15],
            // Education
            ['category' => 'Education', 'title' => 'Kursus Online', 'description' => 'Langganan kursus programming', 'amount' => 200000, 'type' => 'expense', 'payment_method' => 'Credit Card', 'days_ago' => 12],
            ['category' => 'Education', 'title' => 'Buku Programming', 'description' => 'Beli buku coding', 'amount' => 250000, 'type' => 'expense', 'payment_method' => 'Debit Card', 'days_ago' => 14],
            ['category' => 'Education', 'title' => 'Workshop IT', 'description' => 'Biaya workshop', 'amount' => 500000, 'type' => 'expense', 'payment_method' => 'Bank Transfer', 'days_ago' => 20],
            // Rent
            ['category' => 'Rent', 'title' => 'Sewa Rumah', 'description' => 'Sewa rumah bulan November', 'amount' => 3000000, 'type' => 'expense', 'payment_method' => 'Bank Transfer', 'days_ago' => 1],
            ['category' => 'Rent', 'title' => 'Sewa Rumah', 'description' => 'Sewa rumah bulan Oktober', 'amount' => 3000000, 'type' => 'expense', 'payment_method' => 'Bank Transfer', 'days_ago' => 31],
            ['category' => 'Rent', 'title' => 'Sewa Rumah', 'description' => 'Sewa rumah bulan September', 'amount' => 3000000, 'type' => 'expense', 'payment_method' => 'Bank Transfer', 'days_ago' => 61],
            // Insurance
            ['category' => 'Insurance', 'title' => 'Asuransi Kesehatan', 'description' => 'Premi asuransi kesehatan', 'amount' => 500000, 'type' => 'expense', 'payment_method' => 'Bank Transfer', 'days_ago' => 11],
            ['category' => 'Insurance', 'title' => 'Asuransi Mobil', 'description' => 'Premi asuransi mobil', 'amount' => 800000, 'type' => 'expense', 'payment_method' => 'Bank Transfer', 'days_ago' => 22],
            ['category' => 'Insurance', 'title' => 'Asuransi Hidup', 'description' => 'Premi asuransi hidup', 'amount' => 1000000, 'type' => 'expense', 'payment_method' => 'Bank Transfer', 'days_ago' => 40],
            // Other Expense
            ['category' => 'Other Expense', 'title' => 'Hadiah Ulang Tahun', 'description' => 'Beli hadiah teman', 'amount' => 400000, 'type' => 'expense', 'payment_method' => 'Debit Card', 'days_ago' => 6],
            ['category' => 'Other Expense', 'title' => 'Sumbangan', 'description' => 'Sumbangan ke organisasi', 'amount' => 250000, 'type' => 'expense', 'payment_method' => 'Bank Transfer', 'days_ago' => 16],
            ['category' => 'Other Expense', 'title' => 'Perbaikan AC', 'description' => 'Biaya perbaikan AC', 'amount' => 1500000, 'type' => 'expense', 'payment_method' => 'Bank Transfer', 'days_ago' => 28],
        ];

        // Create income transactions
        foreach ($incomeTransactions as $data) {
            $categoryName = $data['category'];
            $daysAgo = $data['days_ago'];
            unset($data['category']);
            unset($data['days_ago']);

            $category = $categories->get($categoryName);
            if ($category) {
                Transaction::create([
                    'user_id' => $user->id,
                    'category_id' => $category->id,
                    'transaction_date' => now()->subDays($daysAgo),
                    ...$data,
                ]);
            }
        }

        // Create expense transactions
        foreach ($expenseTransactions as $data) {
            $categoryName = $data['category'];
            $daysAgo = $data['days_ago'];
            unset($data['category']);
            unset($data['days_ago']);

            $category = $categories->get($categoryName);
            if ($category) {
                Transaction::create([
                    'user_id' => $user->id,
                    'category_id' => $category->id,
                    'transaction_date' => now()->subDays($daysAgo),
                    ...$data,
                ]);
            }
        }
    }
}
