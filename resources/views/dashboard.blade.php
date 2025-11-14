@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <!-- Dashboard Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Selamat Datang, {{ Auth::user()->name }}! 👋</h1>
        <p class="text-gray-600">Berikut adalah ringkasan keuangan Anda untuk {{ now()->format('F Y') }}</p>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Income Card -->
        <div class="bg-white rounded-lg shadow-md p-6 card-hover">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 font-semibold text-sm mb-1">Total Pemasukan</p>
                    <h3 class="text-3xl font-bold text-green-600">Rp {{ number_format($totalIncome, 0, ',', '.') }}</h3>
                    <p class="text-gray-400 text-xs mt-2">Bulan ini</p>
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
                    <p class="text-gray-500 font-semibold text-sm mb-1">Total Pengeluaran</p>
                    <h3 class="text-3xl font-bold text-red-600">Rp {{ number_format($totalExpense, 0, ',', '.') }}</h3>
                    <p class="text-gray-400 text-xs mt-2">Bulan ini</p>
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
                    <p class="text-white opacity-80 font-semibold text-sm mb-1">Saldo</p>
                    <h3 class="text-3xl font-bold">Rp {{ number_format($balance, 0, ',', '.') }}</h3>
                    <p class="text-white opacity-70 text-xs mt-2">
                        @if($balance >= 0)
                            <i class="fas fa-smile text-yellow-300"></i> Surplus
                        @else
                            <i class="fas fa-frown text-red-300"></i> Defisit
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
                <i class="fas fa-pie-chart text-purple-600 mr-2"></i>Pengeluaran per Kategori
            </h2>
            @if($expenseByCategory->count() > 0)
                <canvas id="expenseChart"></canvas>
            @else
                <div class="text-center py-8 text-gray-400">
                    <i class="fas fa-inbox text-4xl mb-2"></i>
                    <p>Belum ada data pengeluaran</p>
                </div>
            @endif
        </div>

        <!-- Income by Category -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">
                <i class="fas fa-pie-chart text-green-600 mr-2"></i>Pemasukan per Kategori
            </h2>
            @if($incomeByCategory->count() > 0)
                <canvas id="incomeChart"></canvas>
            @else
                <div class="text-center py-8 text-gray-400">
                    <i class="fas fa-inbox text-4xl mb-2"></i>
                    <p>Belum ada data pemasukan</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Recent Transactions -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold text-gray-900">
                <i class="fas fa-history text-blue-600 mr-2"></i>Transaksi Terbaru
            </h2>
            <a href="{{ route('transactions.index') }}" class="text-blue-600 hover:text-blue-800 font-semibold">Lihat Semua</a>
        </div>

        @if($recentTransactions->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Deskripsi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tipe</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah</th>
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
                                            <i class="fas fa-arrow-up"></i> Pemasukan
                                        </span>
                                    @else
                                        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                            <i class="fas fa-arrow-down"></i> Pengeluaran
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
                <p>Belum ada transaksi. <a href="{{ route('transactions.create') }}" class="text-blue-600 hover:underline">Buat transaksi</a></p>
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
<!-- test view -->
<!-- test dashboard change -->
