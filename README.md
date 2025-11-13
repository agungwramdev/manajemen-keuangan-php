# 💰 Keuangan App - Financial Management System

Aplikasi manajemen keuangan modern dengan tampilan yang indah untuk melacak pemasukan dan pengeluaran Anda.

## 🎯 Fitur Utama

### Dashboard
- 📊 Ringkasan finansial bulanan (Total Income, Total Expense, Balance)
- 📈 Visualisasi data dengan Chart.js (Pie charts untuk income & expense by category)
- 🔄 Daftar transaksi terbaru
- ⚡ Quick actions untuk akses cepat

### Manajemen Transaksi
- ➕ Membuat transaksi baru (Income/Expense)
- ✏️ Edit transaksi yang sudah ada
- 🗑️ Hapus transaksi
- 👁️ View detail transaksi
- 📋 Daftar lengkap dengan pagination
- 🔍 Filter berdasarkan type, tanggal, dan search

### Autentikasi & Keamanan
- 👤 User registration dengan validasi
- 🔐 User login dengan "Remember Me"
- 🔑 Password reset functionality
- ✉️ Email verification
- 🛡️ CSRF protection
- 👥 User isolation

### UI/UX
- 🎨 Tailwind CSS dengan design modern
- 📱 Fully responsive (Desktop, Tablet, Mobile)
- ⚡ Smooth animations dan transitions

## 🛠️ Tech Stack

- **Backend**: Laravel 11, PHP 8.4
- **Database**: SQLite (Development), MySQL Ready
- **Frontend**: Tailwind CSS, Chart.js, Font Awesome 6
- **Authentication**: Laravel Auth System

## 📦 Quick Start

```bash
# Install dependencies
composer install

# Setup database
php artisan migrate
php artisan db:seed

# Start server
php artisan serve
```

Server akan berjalan di: **http://localhost:8000**

## 🔐 Test Account

```
Email: john@example.com
Password: password
```

## 📂 Project Structure

```
keuangan/
├── app/Http/Controllers/
│   ├── Auth/                  # Authentication Controllers
│   ├── DashboardController.php
│   └── TransactionController.php
├── app/Models/
│   ├── User.php
│   ├── Transaction.php
│   └── Category.php
├── resources/views/
│   ├── layouts/app.blade.php
│   ├── auth/                  # Login, Register, etc
│   ├── dashboard.blade.php
│   └── transactions/
├── routes/
│   ├── web.php
│   └── auth.php
└── database/
    ├── migrations/
    └── seeders/
```

## 🎨 Key Features

### Categories
- **5 Income Categories**: Salary, Freelance, Investment, Bonus, Other
- **10 Expense Categories**: Food, Transportation, Utilities, Entertainment, Shopping, Health, Education, Rent, Insurance, Other
- Setiap kategori memiliki color & icon custom

### Charts & Analytics
- Pie chart untuk expense by category
- Pie chart untuk income by category
- Summary statistics for current month

### User Management
- User registration dengan email validation
- Secure password hashing (bcrypt)
- Remember me functionality
- Password reset feature
- User isolation (setiap user hanya akses data mereka)

## 🔐 Security

- ✅ CSRF Protection
- ✅ SQL Injection Prevention (Eloquent ORM)
- ✅ Password Hashing (bcrypt)
- ✅ Authorization Policies
- ✅ User Isolation
- ✅ Input Validation

## 🚀 Deployment Ready

Aplikasi ini production-ready. Setup:

1. Update `.env` untuk production
2. Run migrations: `php artisan migrate --force`
3. Seed data: `php artisan db:seed`
4. Optimize: `php artisan config:cache`

## 📄 License

MIT License

## 👨‍💻 Created with Claude Code

**Happy Budgeting! 💸**

Manage your finances wisely dengan Keuangan App.
