@extends('layouts.app')

@section('title', 'Pengaturan Profil')

@section('content')
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Pengaturan Profil</h1>
        <p class="text-gray-600 mt-1">Kelola informasi akun dan keamanan Anda</p>
    </div>

    <div class="max-w-2xl mx-auto">
        <!-- Update Profile Section -->
        <div class="bg-white rounded-lg shadow-md p-8 mb-6">
            <h2 class="text-xl font-bold text-gray-900 mb-6">
                <i class="fas fa-user-circle text-blue-600 mr-2"></i>Informasi Profil
            </h2>

            <form action="{{ route('profile.updateProfile') }}" method="POST">
                @csrf

                <!-- Name -->
                <div class="mb-6">
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap *</label>
                    <input type="text" name="name" id="name"
                           value="{{ old('name', auth()->user()->name) }}"
                           placeholder="Masukkan nama lengkap Anda"
                           class="w-full px-4 py-2 border @error('name') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-6">
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email *</label>
                    <input type="email" name="email" id="email"
                           value="{{ old('email', auth()->user()->email) }}"
                           placeholder="Masukkan email Anda"
                           class="w-full px-4 py-2 border @error('email') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           required>
                    @error('email')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Button -->
                <div class="flex gap-4 pt-6 border-t">
                    <a href="{{ route('dashboard') }}"
                       class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg text-center transition">
                        <i class="fas fa-times mr-2"></i>Batal
                    </a>
                    <button type="submit"
                            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition">
                        <i class="fas fa-save mr-2"></i>Simpan Profil
                    </button>
                </div>
            </form>
        </div>

        <!-- Update Password Section -->
        <div class="bg-white rounded-lg shadow-md p-8">
            <h2 class="text-xl font-bold text-gray-900 mb-6">
                <i class="fas fa-lock text-green-600 mr-2"></i>Ubah Password
            </h2>

            <form action="{{ route('profile.updatePassword') }}" method="POST">
                @csrf

                <!-- Current Password -->
                <div class="mb-6">
                    <label for="current_password" class="block text-sm font-semibold text-gray-700 mb-2">Password Saat Ini *</label>
                    <input type="password" name="current_password" id="current_password"
                           placeholder="Masukkan password saat ini"
                           class="w-full px-4 py-2 border @error('current_password') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           required>
                    @error('current_password')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- New Password -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password Baru *</label>
                    <input type="password" name="password" id="password"
                           placeholder="Masukkan password baru (minimal 8 karakter)"
                           class="w-full px-4 py-2 border @error('password') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           required>
                    @error('password')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                    <p class="text-gray-500 text-xs mt-2">Minimal 8 karakter, gunakan kombinasi huruf, angka, dan simbol untuk keamanan maksimal</p>
                </div>

                <!-- Confirm Password -->
                <div class="mb-6">
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">Konfirmasi Password Baru *</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                           placeholder="Ulangi password baru Anda"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                           required>
                    @error('password_confirmation')
                        <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Button -->
                <div class="flex gap-4 pt-6 border-t">
                    <a href="{{ route('dashboard') }}"
                       class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg text-center transition">
                        <i class="fas fa-times mr-2"></i>Batal
                    </a>
                    <button type="submit"
                            class="flex-1 bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg transition">
                        <i class="fas fa-key mr-2"></i>Ubah Password
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
