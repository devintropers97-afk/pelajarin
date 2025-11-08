# 🚀 SITUNEO DIGITAL - Installation Guide

## 📦 Package: COMPLETE BATCH 1+2+3 (159KB)

**Complete platform dengan:**
- ✅ BATCH 1: Database + Installer + Config
- ✅ BATCH 2: 9 Public Pages (Homepage, About, Services, Portfolio, Pricing, Calculator, Contact, Career, Blog)
- ✅ BATCH 3: Authentication System (Login, Register, Password Reset, Email Verification)

---

## 🔧 CARA INSTALL DI cPANEL

### Step 1: Upload ZIP File

1. Login ke cPanel (https://situneo.my.id:2083)
2. Buka **File Manager**
3. Navigate ke folder `public_html/`
4. Klik **Upload**
5. Upload file `SITUNEO-COMPLETE-BATCH-1-2-3.zip`

### Step 2: Extract ZIP

1. Kembali ke File Manager
2. Klik kanan file `SITUNEO-COMPLETE-BATCH-1-2-3.zip`
3. Pilih **Extract**
4. Extract ke `public_html/`
5. **PENTING:** Pindahkan SEMUA isi folder `situneo-batch-1/` ke root `public_html/`

```bash
# File structure harus seperti ini:
public_html/
├── index.php
├── about.php
├── services.php
├── installer.php
├── auth/
│   ├── login.php
│   ├── register.php
│   └── ...
├── config/
│   ├── database.php
│   └── ...
├── includes/
│   ├── auth.php
│   ├── session.php
│   └── ...
├── components/
│   └── layout/
│       ├── header.php
│       ├── navigation.php
│       └── footer.php
├── assets/
│   ├── css/
│   └── js/
├── database/
├── admin/
├── client/
└── partner/
```

### Step 3: Set Permissions

Jalankan di **Terminal** cPanel:

```bash
cd ~/public_html
chmod 755 auth/
chmod 755 includes/
chmod 755 config/
chmod 644 config/*.php
chmod 777 uploads/
```

### Step 4: Database Setup

**Database sudah dibuat dari BATCH 1:**
- Host: `localhost`
- Database: `nrrskfvk_situneo_digital`
- User: `nrrskfvk_user_situneo_digital`
- Password: `Devin1922$`

**Jika database belum ready:**

1. Buka cPanel → MySQL Databases
2. Verify database exists
3. Run SQL file: `database/schema.sql`
4. Run seed files:
   - `database/seed-users.sql`
   - `database/seed-services.sql`
   - `database/seed-freelancer-tiers.sql`

### Step 5: Update Configuration

**File: `includes/functions/email.php`**

Ubah line 19:
```php
define('SITE_URL', 'https://situneo.my.id'); // ⚠️ UPDATE INI!
```

**Optional - Email SMTP:**

Jika mau pakai SMTP (recommended), update di `includes/functions/email.php`.

### Step 6: Test Installation

**Test Public Pages:**
- Homepage: `https://situneo.my.id/`
- About: `https://situneo.my.id/about.php`
- Services: `https://situneo.my.id/services.php`
- Portfolio: `https://situneo.my.id/portfolio.php`

**Test Auth System:**
- Login: `https://situneo.my.id/auth/login.php` ✅
- Register Client: `https://situneo.my.id/auth/register.php`
- Register Partner: `https://situneo.my.id/auth/register-partner.php`
- Forgot Password: `https://situneo.my.id/auth/forgot-password.php`

**Test Dashboards:**
- Admin: Login dengan role `admin` → redirect ke `/admin/dashboard.php`
- Client: Login dengan role `client` → redirect ke `/client/dashboard.php`
- Partner: Login dengan role `partner` → redirect ke `/partner/dashboard.php`

---

## 🔒 KEAMANAN

**Recommended Settings:**

1. **Force HTTPS** - Add to `.htaccess`:
```apache
RewriteEngine On
RewriteCond %{HTTPS} off
RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]
```

2. **Hide sensitive files** - Already in `.htaccess`:
```apache
<FilesMatch "(database\.php|config\.php|constants\.php)">
    Order allow,deny
    Deny from all
</FilesMatch>
```

3. **Update session security** - Already enabled in `includes/session.php`

---

## 📧 EMAIL TESTING

**Test email sending:**

1. Register akun baru
2. Cek inbox untuk verification email
3. Jika tidak terima:
   - Check spam folder
   - Check server email logs di cPanel
   - Consider using SMTP (Gmail, SendGrid, AWS SES)

---

## 🐛 TROUBLESHOOTING

### Error: "Database connection failed"

**Solusi:**
```bash
# Verify database credentials di config/database.php
# Test connection:
mysql -u nrrskfvk_user_situneo_digital -p nrrskfvk_situneo_digital
```

### Error: "Failed opening required config/database.php"

**Solusi:**
```bash
# Pastikan struktur folder benar
ls -la config/database.php
# Harus return: -rw-r--r-- ... config/database.php
```

### Login tidak redirect ke dashboard

**Solusi:**
```bash
# Cek apakah dashboard files ada:
ls -la admin/dashboard.php
ls -la client/dashboard.php
ls -la partner/dashboard.php
```

### Navigation link ke login error

**Solusi:**
- Sudah di-fix di BATCH ini
- Semua link sekarang menggunakan `$baseURL` variable
- Link akan selalu benar dari halaman manapun

### Email verification tidak diterima

**Solusi:**
1. Check `includes/functions/email.php` - SITE_URL sudah benar?
2. Test PHP mail() di cPanel → Terminal:
```bash
php -r "mail('your@email.com', 'Test', 'Testing');"
```
3. Consider using SMTP

---

## ✅ CHECKLIST SETELAH INSTALL

- [ ] Extract ZIP ke public_html/
- [ ] Pindahkan semua files ke root (bukan di folder situneo-batch-1/)
- [ ] Set permissions (chmod)
- [ ] Update SITE_URL di email.php
- [ ] Test homepage bisa dibuka
- [ ] Test login page bisa dibuka
- [ ] Register user test
- [ ] Login berhasil → redirect ke dashboard
- [ ] Test logout
- [ ] Test forgot password

---

## 📊 FILE STRUCTURE LENGKAP

```
situneo-batch-1/ (159KB)
├── index.php (Homepage)
├── about.php
├── services.php
├── portfolio.php
├── pricing.php
├── calculator.php
├── contact.php
├── career.php
├── blog.php
├── installer.php (BATCH 1 installer)
├── installer-ajax.php
│
├── auth/ (Authentication - BATCH 3)
│   ├── login.php
│   ├── register.php
│   ├── register-partner.php
│   ├── forgot-password.php
│   ├── reset-password.php
│   ├── verify-email.php
│   ├── logout.php
│   └── process/
│       ├── login-process.php
│       ├── register-process.php
│       ├── register-partner-process.php
│       ├── forgot-password-process.php
│       └── reset-password-process.php
│
├── config/ (BATCH 1)
│   ├── database.php (Database connection)
│   ├── constants.php
│   ├── functions.php
│   └── init.php
│
├── includes/ (BATCH 3)
│   ├── session.php (Session management)
│   ├── auth.php (Auth helpers)
│   └── functions/
│       ├── user.php (User CRUD)
│       ├── email.php (Email sending)
│       └── validation.php (Input validation)
│
├── components/ (BATCH 2)
│   └── layout/
│       ├── header.php
│       ├── navigation.php (✅ FIXED - baseURL)
│       ├── footer.php
│       └── whatsapp-float.php
│
├── assets/ (BATCH 2)
│   ├── css/
│   │   └── main.css (31KB - Complete styling)
│   ├── js/
│   │   └── main.js (26KB - Animations)
│   └── images/
│       └── placeholders/
│
├── database/ (BATCH 1)
│   ├── schema.sql (72 tables)
│   ├── seed-users.sql
│   ├── seed-services.sql
│   ├── seed-website-templates.sql
│   ├── seed-business-categories.sql
│   └── seed-freelancer-tiers.sql
│
├── admin/ (BATCH 3 - Placeholder)
│   └── dashboard.php
│
├── client/ (BATCH 3 - Placeholder)
│   └── dashboard.php
│
├── partner/ (BATCH 3 - Placeholder)
│   └── dashboard.php
│
├── pages/ (Future)
│   ├── privacy-policy.php
│   ├── terms-of-service.php
│   └── sitemap.php
│
├── uploads/ (For file uploads)
├── api/ (Future)
├── lang/ (Future)
└── .htaccess (Security rules)
```

---

## 🎯 NEXT BATCHES

**BATCH 4-6: Admin Dashboard** (Coming soon)
- Orders management
- Users management
- Partners management
- Payment verification
- Reports & analytics

**BATCH 7-9: Client Dashboard** (Coming soon)
- Order management
- Invoices
- Payment proof upload
- Support tickets

**BATCH 10-12: Partner Dashboard** (Coming soon)
- Earnings tracking
- Commission system
- Referral management
- Withdrawal requests

---

## 📞 SUPPORT

Jika ada masalah saat instalasi:

1. Check error log di cPanel: `Error Log` menu
2. Check PHP errors: `public_html/error_log`
3. Contact support: vins@situneo.my.id

---

## ✅ STATUS

- **BATCH 1**: Database + Installer ✅ COMPLETE
- **BATCH 2**: Public Pages ✅ COMPLETE
- **BATCH 3**: Auth System ✅ COMPLETE
- **BATCH 4-6**: Admin Dashboard ⏳ PENDING
- **BATCH 7-9**: Client Dashboard ⏳ PENDING
- **BATCH 10-12**: Partner Dashboard ⏳ PENDING

---

**Built for SITUNEO DIGITAL Platform**
**Last Updated: November 8, 2025**
**Package Version: BATCH 1+2+3 Complete**
