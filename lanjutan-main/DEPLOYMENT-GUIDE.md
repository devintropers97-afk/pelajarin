# 📦 SITUNEO DIGITAL - Panduan Deployment ke cPanel

## ✅ Yang Sudah Diperbaiki di Versi 1.1

### 1. **Footer Redesign**
- Footer baru dengan design clean
- Logo, NIB badge, social links terintegrasi
- Styling profesional dengan inline CSS

### 2. **Mobile-First Optimization**
- Semua tampilan dioptimalkan untuk mobile
- Desktop tetap tampil bagus

### 3. **Service Section**
- Title lebih profesional: "Solusi Digital Lengkap & Profesional"
- Icons disederhanakan (tidak menyilaukan mata)
- Ukuran dan warna disesuaikan untuk kenyamanan

### 4. **Calculator Page**
- Search icon dipindah ke kanan
- Tidak tertutup text lagi

### 5. **Text Visibility Fixed**
- **Pricing Page**: Text di comparison table sekarang jelas
- **Contact Page**: Text di bawah icons (WhatsApp, Email, Telepon, Alamat) terlihat jelas
- Global fix untuk `.text-muted` class

### 6. **PHP 7.4 Compatibility**
- Fix parse error di admin dashboard (line 280)
- Fix parse error di freelancer header (line 75)
- Fix parse error di client dashboard
- Semua `match()` diganti dengan `if-else`

### 7. **Demo Mode**
- Login client/freelancer berfungsi tanpa database
- Dashboard accessible untuk testing
- Tidak perlu SQL untuk demo

---

## 📥 Cara Upload ke cPanel

### Metode 1: File Manager (Recommended)

1. **Login ke cPanel**
   - Akses: https://yourdomain.com/cpanel
   - Masukkan username & password cPanel

2. **Buka File Manager**
   - Cari menu "File Manager"
   - Pilih "public_html" atau "www" folder

3. **Backup File Lama (PENTING!)**
   ```
   - Klik kanan folder public_html
   - Pilih "Compress"
   - Beri nama: backup-situneo-[tanggal].zip
   - Download backup ini ke komputer Anda
   ```

4. **Hapus File Lama**
   - Select All files di public_html
   - Delete (kecuali file .htaccess jika ada setting khusus)

5. **Upload ZIP File**
   - Klik "Upload" di File Manager
   - Pilih file: `situneo-digital-final-v1.1.zip`
   - Tunggu upload selesai (313KB, cepat!)

6. **Extract ZIP**
   - Klik kanan file ZIP yang sudah diupload
   - Pilih "Extract"
   - Pilih lokasi: /public_html/
   - Klik "Extract Files"

7. **Hapus ZIP File**
   - Setelah extract selesai
   - Delete file .zip untuk menghemat space

### Metode 2: FTP Client (FileZilla)

1. **Install FileZilla** (jika belum)
   - Download: https://filezilla-project.org/

2. **Connect ke Server**
   ```
   Host: ftp.yourdomain.com
   Username: [cPanel username]
   Password: [cPanel password]
   Port: 21
   ```

3. **Extract ZIP di Komputer**
   - Extract `situneo-digital-final-v1.1.zip` di komputer
   - Akan ada folder dengan semua files

4. **Upload Files**
   - Di FileZilla, masuk ke folder /public_html/
   - Drag & drop semua files dari komputer ke server
   - Tunggu transfer selesai

---

## 🔧 Konfigurasi Setelah Upload

### 1. Set File Permissions

Di cPanel File Manager, set permissions:

```
Folders:
- uploads/             → 755 (drwxr-xr-x)
- uploads/portfolios/  → 755
- uploads/documents/   → 755
- uploads/payments/    → 755
- uploads/profiles/    → 755

Files:
- .htaccess           → 644 (-rw-r--r--)
- config/*.php        → 644
- Semua .php files    → 644
```

### 2. Edit Config Database (Jika Pakai Database)

File: `/config/database.php`

```php
define('DB_HOST', 'localhost');
define('DB_NAME', 'your_database_name');
define('DB_USER', 'your_database_user');
define('DB_PASS', 'your_database_password');
```

### 3. Import Database (Jika Pakai Database)

1. Login ke **phpMyAdmin** di cPanel
2. Create database baru: `situneo_db`
3. Pilih database tersebut
4. Klik tab "Import"
5. Upload file: `/database/schema.sql`
6. Klik "Go"

### 4. Test Demo Mode (Tanpa Database)

File `config/database.php` sudah ada:
```php
define('DEMO_MODE', true);
```

Anda bisa langsung test:
- Login sebagai Client: demo@situneo.my.id / password123
- Login sebagai Freelancer: freelancer@situneo.my.id / password123
- Login sebagai Admin: admin@situneo.my.id / admin123

---

## 🌐 URL Testing

Setelah upload, test halaman-halaman ini:

```
✅ Homepage:        https://situneo.my.id/
✅ Services:        https://situneo.my.id/services
✅ Pricing:         https://situneo.my.id/pricing
✅ Calculator:      https://situneo.my.id/calculator
✅ Portfolio:       https://situneo.my.id/portfolio
✅ Contact:         https://situneo.my.id/contact
✅ About:           https://situneo.my.id/about

✅ Login Client:    https://situneo.my.id/login
✅ Login Admin:     https://situneo.my.id/admin/login
✅ Register:        https://situneo.my.id/register
```

---

## 🐛 Troubleshooting

### Error 500 Internal Server Error

**Penyebab**: Permissions salah atau .htaccess issue

**Solusi**:
1. Check .htaccess file ada dan correct
2. Set folder permissions 755, file permissions 644
3. Check PHP version: Minimum PHP 7.4

### Page Not Found / 404

**Penyebab**: Mod_rewrite tidak aktif

**Solusi**:
1. Di cPanel, pastikan Apache mod_rewrite enabled
2. Check .htaccess file:
```apache
RewriteEngine On
RewriteBase /
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ^(.*)$ /router.php?url=$1 [QSA,L]
```

### CSS/JS Tidak Load

**Penyebab**: Path assets salah

**Solusi**:
1. Clear browser cache (Ctrl+F5)
2. Check folder assets/ ada dan permissions correct
3. Check browser console untuk error

### Demo Login Tidak Bisa

**Penyebab**: DEMO_MODE tidak aktif

**Solusi**:
1. Edit `/config/database.php`
2. Pastikan ada: `define('DEMO_MODE', true);`
3. Save dan refresh browser

---

## 📁 Struktur Folder

```
public_html/
├── admin/              → Admin panel pages
├── assets/
│   ├── css/           → Stylesheets
│   ├── js/            → JavaScript files
│   ├── fonts/         → Custom fonts
│   ├── images/        → Images & icons
│   └── vendor/        → Third-party libraries
├── auth/              → Login, register, logout
├── client/            → Client dashboard
├── config/            → Configuration files
├── database/          → SQL schema
├── freelancer/        → Freelancer dashboard
├── includes/          → Headers, footers, functions
├── pages/             → Public pages
├── uploads/           → User uploads (portfolios, payments, etc)
├── .htaccess          → Apache config
├── index.php          → Entry point
├── router.php         → URL routing
└── README.md          → Documentation
```

---

## 📊 File Sizes

- **Total Package**: 313 KB (compressed)
- **Extracted Size**: ~1.5 MB
- **Database Schema**: 87 KB

---

## 🆘 Support

Jika ada masalah setelah deployment:

1. Check error logs di cPanel → Error Log
2. Enable PHP error reporting temporary:
   ```php
   // Tambahkan di index.php (line 1)
   error_reporting(E_ALL);
   ini_set('display_errors', 1);
   ```
3. Contact hosting support jika masalah terkait server

---

## ✨ Features Included

- ✅ 232+ Services dengan detail pages
- ✅ Service Calculator dengan 232+ layanan
- ✅ Pricing packages (Starter, Business, Premium, Enterprise)
- ✅ Portfolio showcase dengan 42+ demos
- ✅ Multi-language (ID/EN)
- ✅ Client Dashboard
- ✅ Freelancer Dashboard dengan tier system
- ✅ Admin Dashboard
- ✅ Demo Mode (no database required)
- ✅ Mobile-first responsive design
- ✅ Clean & professional UI/UX
- ✅ PHP 7.4+ compatible
- ✅ SEO optimized
- ✅ NIB & NPWP integration

---

**Version**: 1.1 Final
**Updated**: 2025-11-05
**Package**: situneo-digital-final-v1.1.zip
**Ready for Production**: ✅ YES

---

**Selamat Deploy! 🚀**
