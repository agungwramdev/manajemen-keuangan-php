@extends('layouts.app')

@section('title', 'Buat Transaksi')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Buat Transaksi Baru</h1>
        <p class="text-gray-600 mt-1">Tambahkan pemasukan atau pengeluaran ke akun Anda</p>
    </div>

    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow-md p-8">
            <form action="{{ route('transactions.store') }}" method="POST">
                @csrf

                <!-- Type Selection -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Pilih Tipe Transaksi *</label>
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Income Option -->
                        <label id="income-card"
                               class="relative flex flex-col items-center p-6 border-2 rounded-lg cursor-pointer transition-all duration-300 ease-in-out @error('type') border-red-500 @else border-gray-300 @enderror hover:border-green-400 hover:shadow-lg"
                               onclick="selectType('income')">
                            <input type="radio" name="type" value="income" class="hidden" id="type-radio-income"
                                   @if(old('type') === 'income') checked @endif>

                            <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center mb-3">
                                <i class="fas fa-arrow-up text-green-600 text-3xl"></i>
                            </div>
                            <span class="block text-lg font-bold text-gray-900 text-center">PEMASUKAN</span>
                            <span class="text-sm text-gray-600 text-center mt-2">Uang Masuk</span>
                            <span class="text-xs text-gray-500 text-center mt-1">Gaji, Bonus, Investasi</span>
                        </label>

                        <!-- Expense Option -->
                        <label id="expense-card"
                               class="relative flex flex-col items-center p-6 border-2 rounded-lg cursor-pointer transition-all duration-300 ease-in-out @error('type') border-red-500 @else border-gray-300 @enderror hover:border-red-400 hover:shadow-lg"
                               onclick="selectType('expense')">
                            <input type="radio" name="type" value="expense" class="hidden" id="type-radio-expense"
                                   @if(old('type') === 'expense') checked @endif>

                            <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center mb-3">
                                <i class="fas fa-arrow-down text-red-600 text-3xl"></i>
                            </div>
                            <span class="block text-lg font-bold text-gray-900 text-center">PENGELUARAN</span>
                            <span class="text-sm text-gray-600 text-center mt-2">Uang Keluar</span>
                            <span class="text-xs text-gray-500 text-center mt-1">Makanan, Transport, Belanja</span>
                        </label>
                    </div>
                    @error('type')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                    <input type="hidden" id="type" name="type" value="{{ old('type', 'expense') }}">
                </div>

                <!-- Category -->
                <div class="mb-6">
                    <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-2">Kategori *</label>
                    <select name="category_id" id="category_id"
                            class="w-full px-4 py-2 border @error('category_id') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                    data-type="{{ $category->type }}"
                                    @if(old('category_id') == $category->id) selected @endif>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Title -->
                <div class="mb-6">
                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Judul *</label>
                    <input type="text" name="title" id="title"
                           value="{{ old('title') }}"
                           placeholder="Contoh: Gaji Bulanan"
                           class="w-full px-4 py-2 border @error('title') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           required>
                    @error('title')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="description" id="description" rows="4"
                              placeholder="Tambahkan catatan tentang transaksi ini..."
                              class="w-full px-4 py-2 border @error('description') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Amount -->
                <div class="mb-6">
                    <label for="amount" class="block text-sm font-semibold text-gray-700 mb-2">Jumlah (Rp) *</label>
                    <div class="relative">
                        <span class="absolute left-4 top-3 text-gray-500 font-semibold text-lg">Rp</span>
                        <input type="text" id="amountDisplay"
                               placeholder="0"
                               class="w-full pl-12 pr-4 py-2 border @error('amount') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent font-semibold text-lg"
                               required>
                        <!-- Hidden input untuk menyimpan value raw -->
                        <input type="hidden" name="amount" id="amount" value="{{ old('amount') }}">
                    </div>
                    <p class="text-gray-500 text-xs mt-2">Format: Ketik angka (misal: 50000 untuk Rp 50.000)</p>
                    @error('amount')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Transaction Date -->
                <div class="mb-6">
                    <label for="transaction_date" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal *</label>
                    <input type="date" name="transaction_date" id="transaction_date"
                           value="{{ old('transaction_date', now()->format('Y-m-d')) }}"
                           class="w-full px-4 py-2 border @error('transaction_date') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           required>
                    @error('transaction_date')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Payment Method -->
                <div class="mb-6">
                    <label for="payment_method" class="block text-sm font-semibold text-gray-700 mb-2">Metode Pembayaran *</label>
                    <select name="payment_method" id="payment_method"
                            class="w-full px-4 py-2 border @error('payment_method') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            required>
                        <option value="" disabled selected>-- Pilih Metode Pembayaran --</option>
                        <option value="cash" @if(old('payment_method') === 'cash') selected @endif>Tunai</option>
                        <option value="credit_card" @if(old('payment_method') === 'credit_card') selected @endif>Kartu Kredit</option>
                        <option value="debit_card" @if(old('payment_method') === 'debit_card') selected @endif>Kartu Debit</option>
                        <option value="bank_transfer" @if(old('payment_method') === 'bank_transfer') selected @endif>Transfer Bank</option>
                        <option value="e_wallet" @if(old('payment_method') === 'e_wallet') selected @endif>Dompet Digital</option>
                        <option value="check" @if(old('payment_method') === 'check') selected @endif>Cek</option>
                    </select>
                    @error('payment_method')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex gap-4 pt-6 border-t">
                    <a href="{{ route('transactions.index') }}"
                       class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg text-center transition">
                        <i class="fas fa-times mr-2"></i>Batal
                    </a>
                    <button type="submit"
                            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition">
                        <i class="fas fa-check mr-2"></i>Buat Transaksi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Update category options based on type selection
        const typeRadios = document.querySelectorAll('input[name="type"]');
        const categorySelect = document.getElementById('category_id');
        const categoryOptions = categorySelect.querySelectorAll('option');
        const typeInput = document.getElementById('type-radio-expense'); // Default to expense radio

        function updateCategories() {
            // Get selected type from the checked radio button
            const selectedRadio = document.querySelector('input[name="type"]:checked');
            const selectedType = selectedRadio ? selectedRadio.value : 'expense';

            categorySelect.value = '';

            categoryOptions.forEach(option => {
                if (option.value === '') {
                    option.style.display = 'block';
                } else {
                    const dataType = option.getAttribute('data-type');
                    option.style.display = dataType === selectedType ? 'block' : 'none';
                }
            });
        }

        typeRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                document.getElementById('type').value = this.value;
                updateCategories();
            });
        });

        // Initial update on page load
        window.addEventListener('DOMContentLoaded', function() {
            updateCategories();
        });

        // Function to handle type selection with visual feedback
        function selectType(type) {
            const incomeCard = document.getElementById('income-card');
            const expenseCard = document.getElementById('expense-card');

            document.getElementById('type').value = type;
            document.getElementById('type-radio-' + type).checked = true;

            if (type === 'income') {
                // Style Income card as selected
                incomeCard.classList.remove('border-gray-300', 'hover:border-green-400');
                incomeCard.classList.add('border-green-500', 'bg-green-50', 'shadow-lg', 'ring-2', 'ring-green-200');

                // Style Expense card as unselected
                expenseCard.classList.remove('border-red-500', 'bg-red-50', 'shadow-lg', 'ring-2', 'ring-red-200');
                expenseCard.classList.add('border-gray-300', 'hover:border-red-400');
            } else {
                // Style Expense card as selected
                expenseCard.classList.remove('border-gray-300', 'hover:border-red-400');
                expenseCard.classList.add('border-red-500', 'bg-red-50', 'shadow-lg', 'ring-2', 'ring-red-200');

                // Style Income card as unselected
                incomeCard.classList.remove('border-green-500', 'bg-green-50', 'shadow-lg', 'ring-2', 'ring-green-200');
                incomeCard.classList.add('border-gray-300', 'hover:border-green-400');
            }

            // Update categories based on selected type
            updateCategories();
        }

        // Set initial styling on page load
        document.addEventListener('DOMContentLoaded', function() {
            const currentType = document.getElementById('type').value;
            if (currentType === 'income') {
                selectType('income');
            } else {
                selectType('expense');
            }

            // Initialize amount display jika ada old value
            const amountInput = document.getElementById('amount');
            const amountDisplay = document.getElementById('amountDisplay');
            if (amountInput.value) {
                amountDisplay.value = formatCurrency(amountInput.value);
            }
        });

        // Currency Formatter
        function formatCurrency(value) {
            // Remove semua non-digit characters
            const cleanValue = value.replace(/\D/g, '');
            if (!cleanValue) return '';

            // Format dengan separator titik per 3 digit dari belakang
            return cleanValue.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        // Handle input pada amount display
        const amountDisplay = document.getElementById('amountDisplay');
        const amountInput = document.getElementById('amount');

        amountDisplay.addEventListener('input', function(e) {
            // Get raw value (hanya angka)
            const rawValue = e.target.value.replace(/\D/g, '');

            // Update hidden input dengan value raw
            amountInput.value = rawValue || '';

            // Format dan display
            e.target.value = formatCurrency(rawValue);
        });

        // Handle paste event untuk currency
        amountDisplay.addEventListener('paste', function(e) {
            e.preventDefault();
            const pastedText = (e.clipboardData || window.clipboardData).getData('text');
            const cleanValue = pastedText.replace(/\D/g, '');

            amountInput.value = cleanValue || '';
            amountDisplay.value = formatCurrency(cleanValue);
        });

        // Handle form submit - pastikan value sudah tersimpan
        document.querySelector('form').addEventListener('submit', function() {
            const rawValue = amountDisplay.value.replace(/\D/g, '');
            amountInput.value = rawValue;
        });
    </script>
@endsection
