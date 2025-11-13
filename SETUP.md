# Keuangan App - Financial Management System

Aplikasi manajemen keuangan yang indah dan mudah digunakan untuk melacak pemasukan dan pengeluaran Anda.

## 📋 Fitur Utama

- ✅ Dashboard dengan ringkasan keuangan bulanan
- ✅ Manajemen transaksi (Pemasukan & Pengeluaran)
- ✅ Kategorisasi transaksi yang fleksibel
- ✅ Visualisasi data dengan chart
- ✅ Daftar transaksi dengan filter
- ✅ Sistem autentikasi pengguna
- ✅ UI yang responsif dan modern dengan Tailwind CSS

## 🛠️ Setup & Instalasi

### Prerequisites
- PHP 8.4+
- MySQL/MariaDB atau SQLite
- Composer
- Node.js & npm (opsional untuk development)

### Langkah Instalasi

1. **Clone atau buka project folder**
```bash
cd /Users/agungwiramulia/Development/php/keuangan
```

2. **Install dependencies (jika belum)**
```bash
composer install
```

3. **Setup environment file** (Sudah otomatis dibuatkan saat project creation)
```bash
cp .env.example .env
php artisan key:generate
```

4. **Migrate database dan seeding** (Sudah dilakukan)
```bash
php artisan migrate
php artisan db:seed
```

5. **Jalankan development server**
```bash
php artisan serve
```

6. **Akses aplikasi**
```
http://localhost:8000
```

## 👤 Test Account

Untuk testing aplikasi, gunakan akun berikut:
- **Email:** john@example.com
- **Password:** password

## 📚 Struktur Database

### Users Table
- id
- name
- email
- password
- email_verified_at
- timestamps

### Categories Table
- id
- user_id (FK)
- type (income/expense)
- name
- description
- color (hex color for UI)
- icon
- timestamps

### Transactions Table
- id
- user_id (FK)
- category_id (FK)
- type (income/expense)
- title
- description
- amount
- transaction_date
- payment_method
- timestamps

## 🎨 Fitur UI

### Dashboard
- Summary cards untuk total income, expense, dan balance
- Chart pie untuk visualisasi expense dan income by category
- Recent transactions list
- Quick actions untuk membuat transaksi baru

### Transactions List
- Tabel dengan semua transaksi
- Filter berdasarkan type, date range
- Search functionality
- Pagination
- Action buttons (edit, delete)

### Create/Edit Transaction
- Form dengan type selection (Income/Expense)
- Category dropdown yang dinamis berdasarkan tipe
- Input validation
- Date picker
- Payment method selection

### Transaction Detail
- Display lengkap dari transaksi
- Edit dan delete options
- Formatted amount display dengan Rupiah
- Category badge dengan warna custom

## 🔐 Security Features

- User authentication dengan policy
- Authorization checks untuk transaksi
- CSRF protection
- Password hashing dengan bcrypt
- User isolation (setiap user hanya bisa lihat transaksi mereka sendiri)

## 📱 Responsive Design

Aplikasi ini fully responsive dan dapat diakses dari:
- Desktop browsers
- Tablet
- Mobile phones

## 🚀 Deployment Ready

Aplikasi ini sudah siap untuk di-deploy. Pastikan:
1. Set `APP_ENV=production` di .env
2. Set `APP_DEBUG=false` di .env
3. Generate strong `APP_KEY`
4. Setup proper database
5. Configure web server (Apache/Nginx)

## 📞 Support

Untuk bantuan atau pertanyaan, hubungi tim development.

## 📄 Lisensi

MIT License
