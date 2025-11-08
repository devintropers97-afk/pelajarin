# SITUNEO DIGITAL - BATCH 1
## Panduan Instalasi ke cPanel

**File**: `situneo-batch1.zip` (60KB)
**Dibuat**: 8 November 2025
**Branch**: claude/review-material-qa-process-011CUvU5GMe2BUrPbRZQgyi3

---

## 📦 ISI BATCH 1

### ✅ Yang Sudah Jadi:
1. **Database Schema** (95 tables) - `database/schema-complete.sql`
2. **Seed Data** (232+ services) - `database/seed-services.sql`
3. **Core Configuration** (5 files PHP)
4. **Core Classes** (4 files PHP)
5. **Struktur Folder** lengkap

**Total**: 11 file kode + struktur folder

---

## 🚀 CARA INSTALL DI cPANEL

### STEP 1: Upload File
1. Login ke **cPanel**
2. Buka **File Manager**
3. Masuk ke folder `public_html`
4. **Upload** file `situneo-batch1.zip`
5. Klik kanan → **Extract**
6. Setelah extract, akan ada folder `batch1-dev`

### STEP 2: Setup Database
1. Buka **phpMyAdmin** di cPanel
2. Pilih database: `nrrskfvk_situneo_digital`
3. Klik tab **Import**
4. Upload & jalankan file ini **BERURUTAN**:
   ```
   ✅ PERTAMA: batch1-dev/database/schema-complete.sql
   ✅ KEDUA:   batch1-dev/database/seed-services.sql
   ```

### STEP 3: Set Permission (opsional)
Jika perlu, set permission untuk folder uploads:
```bash
chmod 755 batch1-dev/uploads/
chmod 755 batch1-dev/cache/
chmod 755 batch1-dev/logs/
```

### STEP 4: Cek Kredensial Database
File: `batch1-dev/config/database.php`

Pastikan kredensial sesuai:
```php
DB_HOST = 'localhost'
DB_USER = 'nrrskfvk_user_situneo_digital'
DB_PASS = 'Devin1922$'
DB_NAME = 'nrrskfvk_situneo_digital'
```

✅ **Kredensial sudah benar** (sesuai data yang Anda berikan)

---

## 📁 STRUKTUR FOLDER SETELAH EXTRACT

```
public_html/
└── batch1-dev/
    ├── config/              ← Konfigurasi aplikasi
    │   ├── app.php         (Settings utama)
    │   ├── database.php    (DB credentials)
    │   ├── bootstrap.php   (Inisialisasi)
    │   ├── paths.php       (Path definitions)
    │   └── mail.php        (Email config)
    │
    ├── core/                ← Class utama
    │   ├── Database.php    (PDO wrapper)
    │   ├── Config.php      (Settings manager)
    │   ├── Security.php    (CSRF, XSS, etc)
    │   └── Session.php     (Session handler)
    │
    ├── database/            ← SQL files
    │   ├── schema-complete.sql    (95 tables)
    │   └── seed-services.sql      (232+ services)
    │
    ├── assets/              ← CSS, JS, Images (kosong, siap diisi)
    │   ├── css/
    │   ├── js/
    │   └── images/
    │
    ├── uploads/             ← Upload folder (auto-created)
    │   ├── temp/
    │   ├── avatars/
    │   ├── documents/
    │   └── media/
    │
    ├── public/              ← Halaman public (akan diisi batch selanjutnya)
    ├── admin/               ← Admin panel (akan diisi batch selanjutnya)
    ├── client/              ← Client dashboard (akan diisi batch selanjutnya)
    ├── freelancer/          ← Freelancer dashboard (akan diisi batch selanjutnya)
    └── helpers/             ← Helper functions (akan diisi batch selanjutnya)
```

---

## ✅ SUDAH BERFUNGSI DI BATCH 1

### 1. **Database Layer**
- ✅ 95 tables dengan relasi lengkap
- ✅ Dual pricing system (one_time & subscription)
- ✅ Freelancer commission tracking
- ✅ 232+ services dengan harga lengkap

### 2. **Core System**
- ✅ PDO Database wrapper (aman dari SQL injection)
- ✅ Config management (load dari database)
- ✅ Security layer (CSRF, XSS, encryption)
- ✅ Session management (flash messages, remember me)

### 3. **Configuration**
- ✅ Semua settings tersentralisasi
- ✅ Support database-driven config (admin bisa edit)
- ✅ Path management otomatis
- ✅ Email/SMTP ready

---

## ⏳ BELUM ADA DI BATCH 1 (Batch Selanjutnya)

- ⏳ Router & URL handling
- ⏳ Auth & Login system
- ⏳ Validator & Form handling
- ⏳ Helper functions
- ⏳ Public pages (homepage, services, pricing, dll)
- ⏳ Admin panel
- ⏳ Client dashboard
- ⏳ Freelancer dashboard
- ⏳ Frontend assets (CSS, JS)

---

## 🔧 TROUBLESHOOTING

### Error: "Database connection failed"
- Cek kredensial di `config/database.php`
- Pastikan database `nrrskfvk_situneo_digital` sudah ada
- Cek user punya akses ke database tersebut

### Error: "Permission denied" di folder uploads
```bash
chmod -R 755 batch1-dev/uploads/
chmod -R 755 batch1-dev/cache/
chmod -R 755 batch1-dev/logs/
```

### SQL Import Error
- Import schema dulu, baru seed data
- Jika ada error foreign key, pastikan urutan benar
- Hapus data lama jika perlu (DROP tables)

---

## 📞 SUPPORT

Jika ada error atau butuh bantuan:
1. Screenshot error message
2. Cek error log di cPanel
3. Share error untuk debugging

---

## 🎯 NEXT: BATCH 2

Batch 2 akan berisi:
- Router, Auth, Validator
- Helper functions lengkap
- Public pages dengan dual pricing system
- Frontend assets (CSS, JS, images)

**Status Batch 1**: ✅ SIAP DIPAKAI!

---

**Dibuat oleh**: Claude AI
**Tanggal**: 8 November 2025
**Version**: Batch 1.0
