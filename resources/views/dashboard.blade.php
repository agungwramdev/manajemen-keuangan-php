@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <!-- Dashboard Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Welcome, {{ Auth::user()->name }}! 👋</h1>
        <p class="text-gray-600">Here's your financial overview for {{ now()->format('F Y') }}</p>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Income Card -->
        <div class="bg-white rounded-lg shadow-md p-6 card-hover">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 font-semibold text-sm mb-1">Total Income</p>
                    <h3 class="text-3xl font-bold text-green-600">Rp {{ number_format($totalIncome, 0, ',', '.') }}</h3>
                    <p class="text-gray-400 text-xs mt-2">This month</p>
                </div>
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-arrow-up text-green-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Expense Card -->
        <div class="bg-white rounded-lg shadow-md p-6 card-hover">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 font-semibold text-sm mb-1">Total Expenses</p>
                    <h3 class="text-3xl font-bold text-red-600">Rp {{ number_format($totalExpense, 0, ',', '.') }}</h3>
                    <p class="text-gray-400 text-xs mt-2">This month</p>
                </div>
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-arrow-down text-red-600 text-2xl"></i>
                </div>
            </div>
        </div>

        <!-- Balance Card -->
        <div class="stat-card rounded-lg shadow-md p-6 card-hover">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-white opacity-80 font-semibold text-sm mb-1">Balance</p>
                    <h3 class="text-3xl font-bold">Rp {{ number_format($balance, 0, ',', '.') }}</h3>
                    <p class="text-white opacity-70 text-xs mt-2">
                        @if($balance >= 0)
                            <i class="fas fa-smile text-yellow-300"></i> Surplus
                        @else
                            <i class="fas fa-frown text-red-300"></i> Deficit
                        @endif
                    </p>
                </div>
                <div class="w-16 h-16 bg-white bg-opacity-30 rounded-full flex items-center justify-center">
                    <i class="fas fa-wallet text-white text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Expense by Category -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">
                <i class="fas fa-pie-chart text-purple-600 mr-2"></i>Expenses by Category
            </h2>
            @if($expenseByCategory->count() > 0)
                <canvas id="expenseChart"></canvas>
            @else
                <div class="text-center py-8 text-gray-400">
                    <i class="fas fa-inbox text-4xl mb-2"></i>
                    <p>No expense data yet</p>
                </div>
            @endif
        </div>

        <!-- Income by Category -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">
                <i class="fas fa-pie-chart text-green-600 mr-2"></i>Income by Category
            </h2>
            @if($incomeByCategory->count() > 0)
                <canvas id="incomeChart"></canvas>
            @else
                <div class="text-center py-8 text-gray-400">
                    <i class="fas fa-inbox text-4xl mb-2"></i>
                    <p>No income data yet</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Recent Transactions -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-gray-900">
                <i class="fas fa-history text-blue-600 mr-2"></i>Recent Transactions
            </h2>
            <a href="{{ route('transactions.index') }}" class="text-blue-600 hover:text-blue-800 font-semibold">View All</a>
        </div>

        @if($recentTransactions->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($recentTransactions as $transaction)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm text-gray-900">{{ $transaction->transaction_date->format('d M Y') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    <a href="{{ route('transactions.show', $transaction) }}" class="text-blue-600 hover:underline">
                                        {{ $transaction->title }}
                                    </a>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold text-white"
                                          style="background-color: {{ $transaction->category->color }}">
                                        {{ $transaction->category->name }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    @if($transaction->type === 'income')
                                        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                            <i class="fas fa-arrow-up"></i> Income
                                        </span>
                                    @else
                                        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                            <i class="fas fa-arrow-down"></i> Expense
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm font-semibold">
                                    <span class="@if($transaction->type === 'income') text-green-600 @else text-red-600 @endif">
                                        @if($transaction->type === 'income')
                                            + Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                                        @else
                                            - Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                                        @endif
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="text-center py-8 text-gray-400">
                <i class="fas fa-inbox text-4xl mb-2"></i>
                <p>No transactions yet. <a href="{{ route('transactions.create') }}" class="text-blue-600 hover:underline">Create one</a></p>
            </div>
        @endif
    </div>

    <script>
        // Expense Chart
        @if($expenseByCategory->count() > 0)
            const expenseCtx = document.getElementById('expenseChart').getContext('2d');
            new Chart(expenseCtx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($expenseByCategory->keys()) !!},
                    datasets: [{
                        data: {!! json_encode($expenseByCategory->values()) !!},
                        backgroundColor: [
                            '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF',
                            '#FF9F40', '#FF6384', '#C9CBCF', '#4BC0C0', '#FF6384'
                        ],
                        borderColor: 'white',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        @endif

        // Income Chart
        @if($incomeByCategory->count() > 0)
            const incomeCtx = document.getElementById('incomeChart').getContext('2d');
            new Chart(incomeCtx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($incomeByCategory->keys()) !!},
                    datasets: [{
                        data: {!! json_encode($incomeByCategory->values()) !!},
                        backgroundColor: [
                            '#10B981', '#34D399', '#6EE7B7', '#A7F3D0', '#D1FAE5',
                            '#10B981', '#34D399', '#6EE7B7', '#A7F3D0', '#D1FAE5'
                        ],
                        borderColor: 'white',
                        borderWidth: 2
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        @endif
    </script>
@endsection
