<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        // Get all transactions (not limited to current month)
        $totalIncome = Transaction::where('user_id', $userId)
            ->where('type', 'income')
            ->sum('amount');

        $totalExpense = Transaction::where('user_id', $userId)
            ->where('type', 'expense')
            ->sum('amount');

        $balance = $totalIncome - $totalExpense;

        // Recent transactions
        $recentTransactions = Transaction::where('user_id', $userId)
            ->with('category')
            ->orderBy('transaction_date', 'desc')
            ->limit(5)
            ->get();

        // Expense by category
        $expenseByCategory = Transaction::where('user_id', $userId)
            ->where('type', 'expense')
            ->with('category')
            ->get()
            ->groupBy('category.name')
            ->map(function ($transactions) {
                return $transactions->sum('amount');
            });

        // Income by category
        $incomeByCategory = Transaction::where('user_id', $userId)
            ->where('type', 'income')
            ->with('category')
            ->get()
            ->groupBy('category.name')
            ->map(function ($transactions) {
                return $transactions->sum('amount');
            });

        return view('dashboard', compact(
            'totalIncome',
            'totalExpense',
            'balance',
            'recentTransactions',
            'expenseByCategory',
            'incomeByCategory'
        ));
    }
}
