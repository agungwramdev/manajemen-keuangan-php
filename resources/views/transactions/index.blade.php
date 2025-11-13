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
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Jenis</label>
                <select name="type" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value="">Semua Jenis</option>
                    <option value="income" @selected(request('type') === 'income')>Pemasukan</option>
                    <option value="expense" @selected(request('type') === 'expense')>Pengeluaran</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Cari</label>
                <input type="text" name="search" placeholder="Cari judul..."
                       value="{{ request('search') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                <input type="date" name="from"
                       value="{{ request('from') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Akhir</label>
                <input type="date" name="to"
                       value="{{ request('to') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>
        </form>
    </div>

    <!-- Transactions Table -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        @if($transactions->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Deskripsi</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jenis</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jumlah</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Metode Pembayaran</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($transactions as $transaction)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 text-sm text-gray-900 font-medium">
                                    {{ $transaction->transaction_date->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">
                                    <a href="{{ route('transactions.show', $transaction) }}"
                                       class="text-blue-600 hover:underline font-semibold">
                                        {{ $transaction->title }}
                                    </a>
                                    @if($transaction->description)
                                        <p class="text-gray-500 text-xs mt-1">{{ Str::limit($transaction->description, 50) }}</p>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold text-white"
                                          style="background-color: {{ $transaction->category->color }}">
                                        {{ $transaction->category->name }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm">
                                    @if($transaction->type === 'income')
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                            <i class="fas fa-arrow-up mr-1"></i>Pemasukan
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                            <i class="fas fa-arrow-down mr-1"></i>Pengeluaran
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm font-bold">
                                    <span class="@if($transaction->type === 'income') text-green-600 @else text-red-600 @endif">
                                        @if($transaction->type === 'income')
                                            +Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                                        @else
                                            -Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                                        @endif
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $transaction->payment_method }}
                                </td>
                                <td class="px-6 py-4 text-sm space-x-2">
                                    <a href="{{ route('transactions.edit', $transaction) }}"
                                       class="inline-flex items-center px-3 py-1 rounded bg-yellow-100 text-yellow-800 hover:bg-yellow-200 transition">
                                        <i class="fas fa-edit mr-1"></i>Ubah
                                    </a>
                                    <form action="{{ route('transactions.destroy', $transaction) }}"
                                          method="POST" class="inline"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center px-3 py-1 rounded bg-red-100 text-red-800 hover:bg-red-200 transition">
                                            <i class="fas fa-trash mr-1"></i>Hapus
                                        </button>
                                    </form>
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
