<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::where('user_id', auth()->id())
            ->with('category')
            ->orderBy('transaction_date', 'desc')
            ->paginate(15);

        return view('transactions.index', compact('transactions'));
    }

    public function create()
    {
        $categories = Category::where('user_id', auth()->id())
            ->orderBy('type')
            ->orderBy('name')
            ->get();
        return view('transactions.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'type' => 'required|in:income,expense',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0.01',
            'transaction_date' => 'required|date',
            'payment_method' => 'required|string|max:100',
        ]);

        $validated['user_id'] = auth()->id();

        Transaction::create($validated);

        return redirect()->route('transactions.index')->with('success', 'Transaction created successfully!');
    }

    public function show(Transaction $transaction)
    {
        // Check if user owns this transaction
        if ($transaction->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }
        return view('transactions.show', compact('transaction'));
    }

    public function edit(Transaction $transaction)
    {
        // Check if user owns this transaction
        if ($transaction->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }
        $categories = Category::where('user_id', auth()->id())
            ->orderBy('type')
            ->orderBy('name')
            ->get();
        return view('transactions.edit', compact('transaction', 'categories'));
    }

    public function update(Request $request, Transaction $transaction)
    {
        // Check if user owns this transaction
        if ($transaction->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'type' => 'required|in:income,expense',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0.01',
            'transaction_date' => 'required|date',
            'payment_method' => 'required|string|max:100',
        ]);

        $transaction->update($validated);

        return redirect()->route('transactions.show', $transaction)->with('success', 'Transaction updated successfully!');
    }

    public function destroy(Transaction $transaction)
    {
        // Check if user owns this transaction
        if ($transaction->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }

        $transaction->delete();

        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully!');
    }
}
