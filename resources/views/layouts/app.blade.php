<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Keuangan App') - Financial Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .gradient-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px rgba(0, 0, 0, 0.15);
        }
        .stat-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        .sidebar-item {
            transition: all 0.3s ease;
        }
        .sidebar-item:hover {
            background-color: rgba(102, 126, 234, 0.1);
            border-left: 4px solid #667eea;
            padding-left: calc(1.5rem - 4px);
        }
    </style>
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">
    <!-- Navigation -->
    <nav class="gradient-header sticky top-0 z-50 shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center space-x-3">
                    <i class="fas fa-wallet text-white text-2xl"></i>
                    <h1 class="text-white text-xl font-bold">Keuangan</h1>
                </div>

                <div class="flex items-center space-x-4">
                    <a href="{{ route('dashboard') }}" class="text-white hover:bg-white hover:bg-opacity-20 px-3 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-chart-line mr-2"></i>Dashboard
                    </a>
                    <a href="{{ route('transactions.index') }}" class="text-white hover:bg-white hover:bg-opacity-20 px-3 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-list mr-2"></i>Transaksi
                    </a>
                    <a href="{{ route('transactions.create') }}" class="text-white hover:bg-white hover:bg-opacity-20 px-3 py-2 rounded-md text-sm font-medium">
                        <i class="fas fa-plus mr-2"></i>Baru
                    </a>

                    <!-- User Dropdown -->
                    <div class="relative group">
                        <button class="text-white hover:bg-white hover:bg-opacity-20 px-3 py-2 rounded-md text-sm font-medium flex items-center">
                            <i class="fas fa-user mr-2"></i>{{ Auth::user()->name }}
                        </button>
                        <div class="absolute right-0 w-48 bg-white rounded-lg shadow-xl hidden group-hover:block z-50">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-800 hover:bg-gray-100 border-b border-gray-200">
                                <i class="fas fa-cog mr-2"></i>Pengaturan Profil
                            </a>
                            <a href="/" class="block px-4 py-2 text-gray-800 hover:bg-gray-100" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out mr-2"></i>Keluar
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Container -->
    <div class="flex-grow max-w-7xl mx-auto w-full px-4 sm:px-6 lg:px-8 py-8">
        <!-- Flash Messages -->
        @if ($message = Session::get('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg shadow-md">
                <i class="fas fa-check-circle mr-2"></i>
                <strong>Success!</strong> {{ $message }}
                <button type="button" class="ml-auto text-green-700 hover:text-green-900" onclick="this.parentElement.style.display='none';">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        @if ($message = Session::get('error'))
            <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg shadow-md">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <strong>Error!</strong> {{ $message }}
                <button type="button" class="ml-auto text-red-700 hover:text-red-900" onclick="this.parentElement.style.display='none';">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        <!-- Page Content -->
        @yield('content')
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-lg font-bold mb-4">Aplikasi Keuangan</h3>
                    <p class="text-gray-400">Kelola keuangan Anda secara efisien dan efektif.</p>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4">Tautan Cepat</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="{{ route('dashboard') }}" class="hover:text-white">Dashboard</a></li>
                        <li><a href="{{ route('transactions.index') }}" class="hover:text-white">Transaksi</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-lg font-bold mb-4">Dukungan</h3>
                    <p class="text-gray-400">Email: support@keuangan.local</p>
                </div>
            </div>
            <hr class="border-gray-700 my-8">
            <div class="text-center text-gray-400">
                <p>&copy; 2025 Aplikasi Keuangan. Semua hak dilindungi undang-undang.</p>
            </div>
        </div>
    </footer>
</body>
</html>
