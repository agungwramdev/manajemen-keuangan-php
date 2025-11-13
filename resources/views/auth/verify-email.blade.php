<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Email - Keuangan App</title>
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
                    <i class="fas fa-envelope text-white text-2xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-gray-900">Verify Email</h1>
                <p class="text-gray-600 mt-2">Confirm Your Email Address</p>
            </div>

            <!-- Verify Email Card -->
            <div class="bg-white rounded-lg shadow-lg p-8">
                <p class="text-gray-600 mb-6">Thanks for signing up! Please verify your email address by clicking the link we just sent you. If you didn't receive an email, we will gladly send you another.</p>

                @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                        A new verification link has been sent to your email address.
                    </div>
                @endif

                <!-- Resend Email Form -->
                <form action="{{ route('verification.send') }}" method="POST" class="mb-4">
                    @csrf
                    <button type="submit"
                            class="w-full gradient-bg text-white font-bold py-2 px-4 rounded-lg hover:opacity-90 transition">
                        <i class="fas fa-redo mr-2"></i>Resend Verification Email
                    </button>
                </form>

                <!-- Logout Form -->
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="w-full bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded-lg transition">
                        <i class="fas fa-sign-out-alt mr-2"></i>Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
