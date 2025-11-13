@extends('layouts.app')

@section('title', $transaction->title)

@section('content')
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">{{ $transaction->title }}</h1>
            <p class="text-gray-600 mt-1">Detail Transaksi</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('transactions.edit', $transaction) }}"
               class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg shadow-md flex items-center">
                <i class="fas fa-edit mr-2"></i>Ubah
            </a>
            <form action="{{ route('transactions.destroy', $transaction) }}"
                  method="POST" class="inline"
                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?');">
                @csrf
                @method('DELETE')
                <button type="submit"
                        class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg shadow-md flex items-center">
                    <i class="fas fa-trash mr-2"></i>Hapus
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Details -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-md p-8">
                <!-- Amount Display -->
                <div class="mb-8 pb-8 border-b">
                    <p class="text-gray-600 text-sm font-semibold mb-2">Jumlah</p>
                    <h2 class="text-5xl font-bold @if($transaction->type === 'income') text-green-600 @else text-red-600 @endif">
                        @if($transaction->type === 'income')
                            +Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                        @else
                            -Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                        @endif
                    </h2>
                </div>

                <!-- Details Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <!-- Type -->
                    <div>
                        <p class="text-gray-600 text-sm font-semibold mb-2">Tipe</p>
                        @if($transaction->type === 'income')
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                                <i class="fas fa-arrow-up mr-2"></i>Pemasukan
                            </span>
                        @else
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-red-100 text-red-800">
                                <i class="fas fa-arrow-down mr-2"></i>Pengeluaran
                            </span>
                        @endif
                    </div>

                    <!-- Category -->
                    <div>
                        <p class="text-gray-600 text-sm font-semibold mb-2">Kategori</p>
                        <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold text-white"
                              style="background-color: {{ $transaction->category->color }}">
                            <i class="fas fa-{{ $transaction->category->icon }} mr-2"></i>{{ $transaction->category->name }}
                        </span>
                    </div>

                    <!-- Date -->
                    <div>
                        <p class="text-gray-600 text-sm font-semibold mb-2">Tanggal</p>
                        <p class="text-lg text-gray-900">{{ $transaction->transaction_date->format('d F Y') }}</p>
                    </div>

                    <!-- Payment Method -->
                    <div>
                        <p class="text-gray-600 text-sm font-semibold mb-2">Metode Pembayaran</p>
                        <p class="text-lg text-gray-900 capitalize">{{ str_replace('_', ' ', $transaction->payment_method) }}</p>
                    </div>
                </div>

                <!-- Description -->
                @if($transaction->description)
                    <div class="mb-8 pb-8 border-b">
                        <p class="text-gray-600 text-sm font-semibold mb-2">Deskripsi</p>
                        <p class="text-gray-900 leading-relaxed">{{ $transaction->description }}</p>
                    </div>
                @endif

                <!-- Timestamps -->
                <div class="grid grid-cols-2 gap-6 text-sm text-gray-600">
                    <div>
                        <p class="font-semibold">Dibuat</p>
                        <p>{{ $transaction->created_at->format('d F Y H:i') }}</p>
                    </div>
                    <div>
                        <p class="font-semibold">Terakhir Diperbarui</p>
                        <p>{{ $transaction->updated_at->format('d F Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <!-- Summary Card -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Ringkasan</h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center pb-3 border-b">
                        <span class="text-gray-600">Jumlah</span>
                        <span class="font-semibold @if($transaction->type === 'income') text-green-600 @else text-red-600 @endif">
                            @if($transaction->type === 'income')
                                +Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                            @else
                                -Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                            @endif
                        </span>
                    </div>
                    <div class="flex justify-between items-center pb-3 border-b">
                        <span class="text-gray-600">Kategori</span>
                        <span class="font-semibold text-gray-900">{{ $transaction->category->name }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Status</span>
                        <span class="inline-flex items-center px-2 py-1 rounded text-xs font-semibold bg-green-100 text-green-800">
                            <i class="fas fa-check-circle mr-1"></i>Selesai
                        </span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Aksi</h3>
                <div class="space-y-2">
                    <a href="{{ route('transactions.index') }}"
                       class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition">
                        <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar
                    </a>
                    <a href="{{ route('transactions.edit', $transaction) }}"
                       class="block w-full text-center bg-yellow-600 hover:bg-yellow-700 text-white font-semibold py-2 px-4 rounded-lg transition">
                        <i class="fas fa-edit mr-2"></i>Ubah
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
