<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Keuangan App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center">
        <div class="w-full max-w-md">
            <!-- Logo Section -->
            <div class="text-center mb-8">
                <div class="inline-flex items-center justify-center w-16 h-16 gradient-bg rounded-full mb-4">
                    <i class="fas fa-wallet text-white text-2xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-900">Keuangan</h1>
                <p class="text-gray-600 mt-2">Manage Your Finances</p>
            </div>

            <!-- Login Card -->
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Welcome Back</h2>

                @if ($errors->any())
                    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                        <p class="font-semibold mb-2">There were some errors:</p>
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <!-- Login (Username or Email) -->
                    <div class="mb-4">
                        <label for="login" class="block text-sm font-semibold text-gray-700 mb-2">Username atau Email</label>
                        <input type="text" name="login" id="login"
                               value="{{ old('login') }}"
                               placeholder="username atau user@email.com"
                               class="w-full px-4 py-2 border @error('login') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               required autofocus>
                        @error('login')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">Password</label>
                        <input type="password" name="password" id="password"
                               placeholder="••••••••"
                               class="w-full px-4 py-2 border @error('password') border-red-500 @else border-gray-300 @enderror rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               required>
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="mb-6 flex items-center">
                        <input type="checkbox" name="remember" id="remember"
                               class="w-4 h-4 text-blue-600 rounded focus:ring-blue-500">
                        <label for="remember" class="ml-2 text-sm text-gray-600">Remember me</label>
                    </div>

                    <!-- Login Button -->
                    <button type="submit"
                            class="w-full gradient-bg text-white font-bold py-2 px-4 rounded-lg hover:opacity-90 transition mb-4">
                        <i class="fas fa-sign-in-alt mr-2"></i>Login
                    </button>
                </form>

                <!-- Links -->
                <div class="text-center space-y-2">
                    <p class="text-sm text-gray-600">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="text-blue-600 hover:underline font-semibold">Register here</a>
                    </p>
                    <p class="text-sm">
                        <a href="{{ route('password.request') }}" class="text-blue-600 hover:underline">Forgot password?</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
