# 🚀 Quick Start Guide - Keuangan App

## ⚡ 5 Menit Setup

### 1. Server sudah berjalan di:
```
http://localhost:8000
```

### 2. Login dengan akun test:
```
Email: john@example.com
Password: password
```

### 3. Akses Dashboard:
Setelah login, Anda akan langsung masuk ke dashboard dengan:
- Total Income & Expense bulan ini
- Balance summary
- Recent transactions
- Charts for visualization

## 📱 Cara Menggunakan Aplikasi

### Membuat Transaksi Baru
1. Klik **"New Transaction"** di navbar
2. Pilih **Type** (Income/Expense)
3. Pilih **Category** (akan auto-filter berdasarkan type)
4. Isi **Title**, **Amount**, **Date**, dan **Payment Method**
5. Klik **Create Transaction**

### Melihat Daftar Transaksi
1. Klik **"Transactions"** di navbar
2. Lihat semua transaksi dengan pagination
3. Gunakan filter untuk search/filter
4. Klik transaksi untuk detail
5. Klik **Edit** atau **Delete** sesuai kebutuhan

### Melihat Detail Transaksi
1. Klik nama transaksi di list
2. Lihat semua detail
3. Edit atau delete jika perlu

### Melihat Dashboard
1. Klik **"Dashboard"** di navbar
2. Lihat summary bulanan
3. Lihat charts untuk expense & income by category
4. Lihat recent transactions

## 🔐 Logout
1. Klik nama user di navbar kanan atas
2. Klik **"Logout"**

## 💾 Test Data
Database sudah berisi:
- ✅ 1 User (john@example.com)
- ✅ 15 Categories (5 income + 10 expense)
- ✅ Siap untuk menambah transaksi

## 🎯 Default Categories

### Income (5)
1. Salary
2. Freelance
3. Investment
4. Bonus
5. Other Income

### Expense (10)
1. Food & Drink
2. Transportation
3. Utilities
4. Entertainment
5. Shopping
6. Health
7. Education
8. Rent
9. Insurance
10. Other Expense

## 🌐 Membuat User Baru
1. Buka http://localhost:8000/register
2. Isi form dengan data Anda
3. Klik **"Create Account"**
4. Anda akan auto-login dengan user baru

## ⚙️ Jika Server Mati
Jalankan kembali:
```bash
php artisan serve
```

## 📊 Fitur Utama
- ✅ Dashboard dengan summary & charts
- ✅ CRUD Transaksi (Create, Read, Update, Delete)
- ✅ 15 Categories built-in
- ✅ User authentication & security
- ✅ Beautiful UI dengan Tailwind CSS
- ✅ Responsive design (Mobile-friendly)
- ✅ Data visualization dengan Chart.js

## 🎨 UI Features
- 🌈 Modern gradient design
- 📱 Fully responsive
- ⚡ Smooth animations
- 🎯 Intuitive navigation
- 🔐 Secure forms with validation

## 💡 Tips
- Gunakan **"Remember me"** saat login untuk session yang lebih lama
- Tanggal transaksi dapat di-set ke tanggal apapun (untuk historical data)
- Payment method bisa dipilih dari 6 opsi (Cash, Credit Card, Debit Card, Bank Transfer, E-Wallet, Check)
- Filter transaksi by type, date range untuk analisis lebih baik

## 🐛 Troubleshooting

### Server tidak jalan?
```bash
cd /Users/agungwiramulia/Development/php/keuangan
php artisan serve
```

### Database error?
```bash
php artisan migrate
php artisan db:seed
```

### Clear cache?
```bash
php artisan cache:clear
php artisan config:clear
```

---

**Happy Budgeting! 💰**

Questions? Check README.md untuk dokumentasi lengkap.
