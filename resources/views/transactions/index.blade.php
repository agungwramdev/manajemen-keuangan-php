@extends('layouts.app')

@section('title', 'Transaksi')

@section('content')
    <!-- Header -->
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Transaksi</h1>
            <p class="text-gray-600 mt-1">Kelola semua transaksi keuangan Anda</p>
        </div>
        <a href="{{ route('transactions.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md flex items-center">
            <i class="fas fa-plus mr-2"></i>Transaksi Baru
        </a>
    </div>

    <!-- Filter Section -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <form method="GET" id="filterForm" class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Jenis</label>
                <select name="type" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent filter-input">
                    <option value="">Semua Jenis</option>
                    <option value="income" @selected(request('type') === 'income')>Pemasukan</option>
                    <option value="expense" @selected(request('type') === 'expense')>Pengeluaran</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Cari</label>
                <input type="text" name="search" placeholder="Cari judul..."
                       value="{{ request('search') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent filter-input">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                <input type="date" name="from"
                       value="{{ request('from') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent filter-input">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Akhir</label>
                <input type="date" name="to"
                       value="{{ request('to') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent filter-input">
            </div>
            <div class="flex items-end">
                <a href="{{ route('transactions.index') }}" class="w-full bg-gray-400 hover:bg-gray-500 text-white font-bold py-2 px-4 rounded-lg transition text-center">
                    <i class="fas fa-redo mr-1"></i>Reset
                </a>
            </div>
        </form>
    </div>

    <script>
        // Auto-submit form when filters change
        const filterInputs = document.querySelectorAll('.filter-input');
        filterInputs.forEach(input => {
            input.addEventListener('change', function() {
                document.getElementById('filterForm').submit();
            });
        });
    </script>

    <!-- Transactions Table -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        @if($transactions->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Deskripsi</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kat</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jenis</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Metode</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($transactions as $transaction)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 text-sm text-gray-900 font-medium whitespace-nowrap">
                                    {{ $transaction->transaction_date->format('d M Y') }}
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-900 max-w-xs">
                                    <a href="{{ route('transactions.show', $transaction) }}"
                                       class="text-blue-600 hover:underline font-semibold truncate block">
                                        {{ $transaction->title }}
                                    </a>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <span class="inline-block px-2 py-1 rounded text-xs font-semibold text-white whitespace-nowrap"
                                          style="background-color: {{ $transaction->category->color }}">
                                        {{ Str::limit($transaction->category->name, 8) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm whitespace-nowrap">
                                    @if($transaction->type === 'income')
                                        <span class="inline-flex items-center px-2 py-1 rounded text-xs font-semibold bg-green-100 text-green-800">
                                            <i class="fas fa-arrow-up text-xs"></i>
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-1 rounded text-xs font-semibold bg-red-100 text-red-800">
                                            <i class="fas fa-arrow-down text-xs"></i>
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm font-bold text-right whitespace-nowrap">
                                    <span class="@if($transaction->type === 'income') text-green-600 @else text-red-600 @endif">
                                        @if($transaction->type === 'income')
                                            +Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                                        @else
                                            -Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                                        @endif
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-600 whitespace-nowrap">
                                    <span class="text-xs">{{ Str::limit($transaction->payment_method, 12) }}</span>
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    <div class="flex gap-1 justify-center">
                                        <a href="{{ route('transactions.edit', $transaction) }}"
                                           class="inline-flex items-center px-2 py-1 rounded text-xs font-semibold bg-yellow-100 text-yellow-800 hover:bg-yellow-200 transition"
                                           title="Ubah">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('transactions.destroy', $transaction) }}"
                                              method="POST" class="inline"
                                              onsubmit="return confirm('Hapus transaksi ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="inline-flex items-center px-2 py-1 rounded text-xs font-semibold bg-red-100 text-red-800 hover:bg-red-200 transition"
                                                    title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="bg-white px-6 py-4 border-t border-gray-200">
                {{ $transactions->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <i class="fas fa-inbox text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-lg font-semibold text-gray-700 mb-2">Belum Ada Transaksi</h3>
                <p class="text-gray-600 mb-4">Mulai kelola keuangan Anda dengan membuat transaksi pertama.</p>
                <a href="{{ route('transactions.create') }}"
                   class="inline-flex items-center bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg">
                    <i class="fas fa-plus mr-2"></i>Buat Transaksi
                </a>
            </div>
        @endif
    </div>
@endsection
