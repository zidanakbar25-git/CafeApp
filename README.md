# CafeApp

[![License](https://img.shields.io/badge/license-MIT-green.svg)](LICENSE)
[![PHP Version](https://img.shields.io/badge/PHP-%5E8.3-blue.svg)](https://www.php.net/)
[![Laravel Version](https://img.shields.io/badge/Laravel-%5E13.0-red.svg)](https://laravel.com/)

**CafeApp** adalah aplikasi manajemen kafe yang modern dan efisien, dibangun menggunakan framework Laravel. Aplikasi ini dirancang untuk memudahkan pengelolaan menu, pesanan, dan operasional kafe dengan antarmuka yang user-friendly.

## 📋 Daftar Isi

- [Fitur Utama](#fitur-utama)
- [Teknologi yang Digunakan](#teknologi-yang-digunakan)
- [Prasyarat Instalasi](#prasyarat-instalasi)
- [Instalasi](#instalasi)
- [Struktur Project](#struktur-project)
- [Konfigurasi](#konfigurasi)
- [Penggunaan](#penggunaan)
- [Testing](#testing)
- [Kontribusi](#kontribusi)
- [Lisensi](#lisensi)

## 🎯 Fitur Utama

- **Manajemen Menu Kafe** - Tambah, edit, dan hapus item menu dengan mudah
- **Sistem Pemesanan** - Kelola pesanan pelanggan secara real-time
- **QR Code Generator** - Buat QR code untuk menu digital atau promosi
- **Autentikasi Pengguna** - Sistem login yang aman untuk staff kafe
- **Dashboard Analytics** - Monitor penjualan dan metrik bisnis
- **Responsive Design** - Interface yang bekerja optimal di berbagai perangkat
- **Manajemen Database** - Sistem database yang terstruktur dengan baik
- **Queue Management** - Mengelola antrian pekerjaan background

## 🛠️ Teknologi yang Digunakan

| Teknologi | Versi | Deskripsi |
|-----------|-------|-----------|
| **PHP** | 8.3+ | Bahasa pemrograman backend |
| **Laravel** | 13.0+ | Framework web aplikasi PHP |
| **Blade** | 13.0+ | Template engine untuk views |
| **CSS** | 3 | Styling dan desain responsive |
| **JavaScript** | ES6+ | Interaktivitas frontend |
| **Vite** | Latest | Build tool untuk asset bundling |
| **Composer** | Latest | Package manager untuk PHP |
| **NPM** | Latest | Package manager untuk JavaScript |
| **SQLite/MySQL** | Flexible | Database support |
| **PHPUnit** | 12.5+ | Testing framework |
| **QR Code** | 4.2 | Library untuk generate QR codes |

### Komposisi Kode
- PHP: 48.5%
- Blade: 41.7%
- CSS: 9.5%
- JavaScript: 0.3%

## 📦 Prasyarat Instalasi

Sebelum memulai, pastikan Anda memiliki:

- **PHP** 8.3 atau lebih tinggi
- **Composer** (untuk mengelola dependensi PHP)
- **Node.js** & **npm** (untuk frontend assets)
- **Git** (untuk clone repository)
- **Database** SQLite atau MySQL
- **Terminal/Command Line** familiarity

### Verifikasi Instalasi

```bash
# Cek versi PHP
php --version

# Cek Composer
composer --version

# Cek Node.js dan npm
node --version
npm --version
```

## 📥 Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/zidanakbar25-git/CafeApp.git
cd CafeApp
```

### 2. Setup Otomatis (Recommended)

```bash
composer setup
```

Script setup ini akan otomatis:
- Install PHP dependencies dengan Composer
- Copy `.env.example` ke `.env`
- Generate application key
- Jalankan database migrations
- Install npm dependencies
- Build frontend assets

### 3. Setup Manual

Jika ingin setup secara manual:

```bash
# Install PHP dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate

# Setup database
php artisan migrate

# Install JavaScript dependencies
npm install

# Build frontend assets
npm run build
```

### 4. Jalankan Aplikasi

**Development Mode (dengan hot reload):**
```bash
composer dev
```

**Production Mode:**
```bash
php artisan serve
```

Aplikasi akan berjalan di `http://localhost:8000`

## 📁 Struktur Project

```
CafeApp/
├── app/                          # Application logic
│   ├── Http/                     # Controllers, middleware, requests
│   ├── Models/                   # Eloquent models
│   ├── Services/                 # Business logic services
│   └── Exceptions/               # Custom exceptions
├── bootstrap/                    # Application bootstrapping
│   ├── app.php
│   └── cache/
├── config/                       # Configuration files
│   ├── app.php
│   ├── database.php
│   ├── cache.php
│   ├── queue.php
│   └── ...
├── database/
│   ├── migrations/               # Database migrations
│   ├── seeders/                  # Database seeders
│   └── factories/                # Model factories for testing
├── public/                       # Web root directory
│   ├── index.php
│   ├── css/
│   └── js/
├── resources/
│   ├── views/                    # Blade template files
│   │   ├── components/           # Reusable view components
│   │   ├── layouts/              # Layout templates
│   │   └── ...
│   ├── css/                      # Source CSS files
│   └── js/                       # Source JavaScript files
├── routes/                       # Route definitions
│   ├── web.php                   # Web routes
│   ├── api.php                   # API routes
│   └── console.php               # Console commands
├── storage/                      # Generated files, logs, cache
│   ├── app/
│   ├── logs/
│   └── framework/
├── tests/                        # Test files
│   ├── Feature/                  # Feature tests
│   └── Unit/                     # Unit tests
├── .env                          # Environment variables (local)
├── .env.example                  # Environment variables template
├── .editorconfig                 # Editor configuration
├── .gitignore                    # Git ignore rules
├── .gitattributes                # Git attributes
├── artisan                       # CLI tool
├── composer.json                 # PHP dependencies
├── composer.lock                 # Locked versions of dependencies
├── package.json                  # JavaScript dependencies
├── package-lock.json             # Locked versions of npm packages
├── phpunit.xml                   # PHPUnit configuration
├── vite.config.js                # Vite bundler configuration
└── README.md                     # Documentation (this file)
```

## ⚙️ Konfigurasi

### File .env

Beberapa konfigurasi penting di file `.env`:

```dotenv
# Application
APP_NAME=CafeApp
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

# Database (default: SQLite)
DB_CONNECTION=sqlite

# Atau untuk MySQL:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=cafeapp
# DB_USERNAME=root
# DB_PASSWORD=

# Session
SESSION_DRIVER=database
SESSION_LIFETIME=120

# Cache
CACHE_STORE=database

# Queue
QUEUE_CONNECTION=database

# Mail (optional)
MAIL_MAILER=log
```

### Mengubah Database Driver

Untuk menggunakan MySQL:

```bash
# Update .env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cafeapp
DB_USERNAME=root
DB_PASSWORD=your_password

# Jalankan migrations
php artisan migrate
```

## 🚀 Penggunaan

### Dashboard Utama

Setelah login, Anda akan melihat dashboard dengan:
- Overview penjualan hari ini
- Daftar pesanan terbaru
- Statistik pelanggan
- Menu dengan rating tertinggi

### Mengelola Menu

```bash
# Akses halaman menu melalui dashboard
# Atau buka di browser: http://localhost:8000/menu

# Fitur:
# - Tambah menu baru
# - Edit deskripsi dan harga
# - Hapus menu yang tidak digunakan
# - Generate QR code untuk setiap menu item
```

### Mengelola Pesanan

```bash
# Akses halaman pesanan
# URL: http://localhost:8000/orders

# Fitur:
# - Lihat semua pesanan
# - Update status pesanan
# - Filter berdasarkan status atau tanggal
# - Cetak struk pesanan
```

### Generate QR Code

```php
// Contoh di dalam controller
use SimpleSoftwareIO\QrCode\Facades\QrCode;

// Generate QR code untuk menu
$qrCode = QrCode::size(300)
    ->format('png')
    ->generate('https://cafeapp.com/menu/item-1');

// Generate QR code untuk promosi
$promotionalQr = QrCode::size(300)
    ->format('svg')
    ->generate('https://cafeapp.com/promo/discount-20');
```

### Artisan Commands

```bash
# Membuat model baru dengan migration
php artisan make:model MenuItem -m

# Membuat controller
php artisan make:controller MenuController

# Menjalankan migrations
php artisan migrate

# Membuat seeder
php artisan make:seeder MenuSeeder
php artisan db:seed

# Clear cache
php artisan cache:clear

# Tinker (interactive shell)
php artisan tinker
```

## 🧪 Testing

Jalankan unit tests dan feature tests:

```bash
# Jalankan semua tests
npm run test

# Atau gunakan PHP Unit langsung
./vendor/bin/phpunit

# Jalankan tests dengan report detail
./vendor/bin/phpunit --verbose

# Jalankan tests untuk file tertentu
./vendor/bin/phpunit tests/Feature/MenuTest.php
```

## 👥 Kontribusi

Kami menerima kontribusi dari siapa saja! Untuk berkontribusi pada CafeApp:

### Cara Berkontribusi

1. **Fork** repository ini
   ```bash
   git clone https://github.com/your-username/CafeApp.git
   cd CafeApp
   ```

2. **Buat branch fitur** untuk perubahan Anda
   ```bash
   git checkout -b feature/nama-fitur-anda
   ```

3. **Commit perubahan** dengan pesan yang jelas
   ```bash
   git add .
   git commit -m "Tambah fitur: deskripsi perubahan"
   ```

4. **Push ke branch**
   ```bash
   git push origin feature/nama-fitur-anda
   ```

5. **Buat Pull Request** dengan deskripsi detail:
   - Jelaskan tujuan perubahan
   - Sertakan screenshot jika ada perubahan UI
   - Referensikan issue terkait jika ada

### Guidelines Kontribusi

- Ikuti PSR-12 coding standard untuk PHP
- Gunakan meaningful variable dan function names
- Tambahkan comments untuk logika yang kompleks
- Buat unit tests untuk fitur baru
- Update dokumentasi jika diperlukan
- Jangan push ke branch `main` secara langsung

### Melaporkan Bug

Jika menemukan bug, buat issue dengan format:
- **Judul**: Deskripsi singkat bug
- **Deskripsi**: Penjelasan detail tentang bug
- **Langkah Reproduksi**: Cara mereproduksi bug
- **Expected Behavior**: Perilaku yang diharapkan
- **Actual Behavior**: Perilaku yang terjadi
- **Environment**: OS, PHP version, Laravel version

## 📄 Lisensi

CafeApp dilisensikan di bawah lisensi **MIT**. Lihat file [LICENSE](LICENSE) untuk detail lengkap.

### Ringkasan Lisensi MIT

Anda bebas untuk:
- ✅ Menggunakan software secara komersial
- ✅ Memodifikasi software
- ✅ Mendistribusikan software
- ✅ Menggunakan software secara pribadi

Dengan syarat:
- ⚠️ Menyertakan lisensi dan copyright notice
- ⚠️ Memberikan perubahan yang dilakukan pada kode

Tanpa tanggung jawab untuk:
- ❌ Liability
- ❌ Warranty

```
MIT License

Copyright (c) 2026 zidanakbar25-git

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
```

## 🤝 Support & Bantuan

Jika memiliki pertanyaan atau membutuhkan bantuan:

- 📧 Email: [zidanakbar25@gmail.com](mailto:zidanakbar25@gmail.com)
- 📝 Issues: [Buat issue di GitHub](https://github.com/zidanakbar25-git/CafeApp/issues)
- 💬 Discussions: [GitHub Discussions](https://github.com/zidanakbar25-git/CafeApp/discussions)

## 🙏 Ucapan Terima Kasih

Terima kasih kepada:
- [Laravel Framework](https://laravel.com/) - Amazing PHP framework
- [Simple QR Code](https://github.com/SimpleSoftwareIO/simple-qrcode) - QR code generation
- Semua contributors yang telah membantu proyek ini

---

**Dibuat dengan ❤️ oleh [zidanakbar25-git](https://github.com/zidanakbar25-git)**

*Last updated: 2026*
