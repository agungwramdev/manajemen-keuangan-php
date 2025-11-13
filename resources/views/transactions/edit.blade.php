@extends('layouts.app')

@section('title', 'Edit Transaction')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Edit Transaction</h1>
        <p class="text-gray-600 mt-1">Update transaction details</p>
    </div>

    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow-md p-8">
            <form action="{{ route('transactions.update', $transaction) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Type Selection -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Type *</label>
                    <div class="grid grid-cols-2 gap-4">
                        <label class="relative flex items-center p-4 border-2 rounded-lg cursor-pointer @error('type') border-red-500 @else border-gray-300 @enderror"
                               id="type-income">
                            <input type="radio" name="type" value="income" class="hidden"
                                   @if($transaction->type === 'income') checked @endif>
                            <span class="flex-1">
                                <span class="block text-lg font-bold text-green-600">
                                    <i class="fas fa-arrow-up mr-2"></i>Income
                                </span>
                                <span class="text-sm text-gray-600">Money coming in</span>
                            </span>
                        </label>

                        <label class="relative flex items-center p-4 border-2 rounded-lg cursor-pointer @error('type') border-red-500 @else border-gray-300 @enderror"
                               id="type-expense">
                            <input type="radio" name="type" value="expense" class="hidden"
                                   @if($transaction->type === 'expense') checked @endif>
                            <span class="flex-1">
                                <span class="block text-lg font-bold text-red-600">
                                    <i class="fas fa-arrow-down mr-2"></i>Expense
                                </span>
                                <span class="text-sm text-gray-600">Money going out</span>
                            </span>
                        </label>
                    </div>
                    @error('type')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Category -->
                <div class="mb-6">
                    <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-2">Category *</label>
                    <select name="category_id" id="category_id"
                            class="w-full px-4 py-2 border @error('category_id') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            required>
                        <option value="">-- Select Category --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                    data-type="{{ $category->type }}"
                                    @if($transaction->category_id == $category->id) selected @endif>
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
                    <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Title *</label>
                    <input type="text" name="title" id="title"
                           value="{{ old('title', $transaction->title) }}"
                           placeholder="e.g., Monthly Salary"
                           class="w-full px-4 py-2 border @error('title') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           required>
                    @error('title')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Description -->
                <div class="mb-6">
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                    <textarea name="description" id="description" rows="4"
                              placeholder="Add any additional notes about this transaction..."
                              class="w-full px-4 py-2 border @error('description') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('description', $transaction->description) }}</textarea>
                    @error('description')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Amount -->
                <div class="mb-6">
                    <label for="amount" class="block text-sm font-semibold text-gray-700 mb-2">Amount *</label>
                    <div class="relative">
                        <span class="absolute left-4 top-2 text-gray-500 font-semibold">Rp</span>
                        <input type="number" name="amount" id="amount"
                               value="{{ old('amount', $transaction->amount) }}"
                               step="0.01" min="0"
                               placeholder="0.00"
                               class="w-full pl-10 pr-4 py-2 border @error('amount') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               required>
                    </div>
                    @error('amount')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Transaction Date -->
                <div class="mb-6">
                    <label for="transaction_date" class="block text-sm font-semibold text-gray-700 mb-2">Date *</label>
                    <input type="date" name="transaction_date" id="transaction_date"
                           value="{{ old('transaction_date', $transaction->transaction_date->format('Y-m-d')) }}"
                           class="w-full px-4 py-2 border @error('transaction_date') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           required>
                    @error('transaction_date')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Payment Method -->
                <div class="mb-6">
                    <label for="payment_method" class="block text-sm font-semibold text-gray-700 mb-2">Payment Method *</label>
                    <select name="payment_method" id="payment_method"
                            class="w-full px-4 py-2 border @error('payment_method') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            required>
                        <option value="">-- Select Payment Method --</option>
                        <option value="cash" @if($transaction->payment_method === 'cash') selected @endif>Cash</option>
                        <option value="credit_card" @if($transaction->payment_method === 'credit_card') selected @endif>Credit Card</option>
                        <option value="debit_card" @if($transaction->payment_method === 'debit_card') selected @endif>Debit Card</option>
                        <option value="bank_transfer" @if($transaction->payment_method === 'bank_transfer') selected @endif>Bank Transfer</option>
                        <option value="e_wallet" @if($transaction->payment_method === 'e_wallet') selected @endif>E-Wallet</option>
                        <option value="check" @if($transaction->payment_method === 'check') selected @endif>Check</option>
                    </select>
                    @error('payment_method')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Buttons -->
                <div class="flex gap-4 pt-6 border-t">
                    <a href="{{ route('transactions.show', $transaction) }}"
                       class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg text-center transition">
                        <i class="fas fa-times mr-2"></i>Cancel
                    </a>
                    <button type="submit"
                            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition">
                        <i class="fas fa-save mr-2"></i>Update Transaction
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

        function updateCategories() {
            const selectedType = Array.from(typeRadios).find(r => r.checked).value;
            const currentValue = categorySelect.value;

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
            radio.addEventListener('change', updateCategories);
        });

        // Initial update
        updateCategories();
    </script>
@endsection
