# 🧪 PANDUAN TESTING & VERIFIKASI - SITUNEO DIGITAL

## 📋 DAFTAR ISI
1. [Persiapan Testing](#persiapan-testing)
2. [Testing Database](#testing-database)
3. [Testing Fitur-Fitur Utama](#testing-fitur-fitur-utama)
4. [Checklist Verifikasi](#checklist-verifikasi)
5. [Troubleshooting](#troubleshooting)

---

## 🚀 PERSIAPAN TESTING

### 1. Ekstrak File ZIP
```bash
# Ekstrak file ZIP
unzip SITUNEO-DIGITAL-COMPLETE-v1.0.zip

# Masuk ke folder
cd batch1-dev
```

### 2. Setup Database di cPanel/phpMyAdmin

**A. Buat Database Baru:**
1. Login ke cPanel
2. Buka "MySQL Databases"
3. Buat database baru: `situneo_db`
4. Buat user: `situneo_user`
5. Set password yang kuat
6. Assign user ke database (All Privileges)

**B. Import Database Schema:**
```sql
-- Di phpMyAdmin:
1. Pilih database "situneo_db"
2. Klik tab "Import"
3. Upload file: database/schema-complete.sql
4. Klik "Go"
5. Tunggu sampai selesai (95 tables akan dibuat)
```

**C. Import Data Services:**
```sql
-- Masih di phpMyAdmin:
1. Klik tab "Import" lagi
2. Upload file: database/seed-services.sql
3. Klik "Go"
4. Tunggu sampai selesai (232+ services akan masuk)
```

### 3. Konfigurasi File .env

**Edit file `.env`:**
```bash
# Database Configuration
DB_HOST=localhost
DB_NAME=situneo_db
DB_USER=situneo_user
DB_PASS=your_strong_password_here

# Application
APP_NAME="SITUNEO DIGITAL"
APP_URL=https://yourdomain.com
APP_ENV=production
APP_DEBUG=false

# Security
APP_KEY=generate_random_32_character_key_here

# Midtrans Payment Gateway
MIDTRANS_SERVER_KEY=your_midtrans_server_key
MIDTRANS_CLIENT_KEY=your_midtrans_client_key
MIDTRANS_IS_PRODUCTION=false

# Email Configuration
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your_email@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="SITUNEO DIGITAL"
```

**Generate APP_KEY:**
```bash
# Buka browser, ketik:
https://yourdomain.com/admin/settings
# Atau gunakan:
php -r "echo bin2hex(random_bytes(16));"
```

### 4. Upload ke Server

**Via cPanel File Manager:**
1. Login ke cPanel
2. Buka File Manager
3. Masuk ke `public_html/`
4. Upload semua file dari `batch1-dev/`
5. Extract jika upload dalam bentuk ZIP

**Via FTP (FileZilla):**
```
Host: ftp.yourdomain.com
Username: your_cpanel_username
Password: your_cpanel_password
Port: 21

Upload folder batch1-dev/ ke public_html/
```

---

## 🧪 TESTING DATABASE

### Test 1: Cek Koneksi Database
```bash
# Akses halaman test (buat file test-db.php):
<?php
require_once 'config/database.php';
$db = Database::getInstance();
if ($db) {
    echo "✅ Database Connected!";
} else {
    echo "❌ Database Connection Failed!";
}
?>
```

### Test 2: Verifikasi Tables
```sql
-- Di phpMyAdmin, jalankan query:
SHOW TABLES;

-- Harus menampilkan 95 tables:
✅ users
✅ services
✅ categories
✅ orders
✅ payments
✅ freelancer_profiles
✅ freelancer_commissions
✅ withdrawals
... dan 87 tables lainnya
```

### Test 3: Cek Data Services
```sql
-- Cek jumlah services:
SELECT COUNT(*) FROM services;
-- Result harus: 232 rows

-- Cek beberapa services:
SELECT id, name, category_id, one_time_price, monthly_price
FROM services
LIMIT 10;
```

### Test 4: Create Admin User
```sql
-- Buat admin user manual:
INSERT INTO users (name, email, password, role, is_active, created_at)
VALUES (
    'Admin Situneo',
    'admin@situneo.com',
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', -- password: password
    'admin',
    1,
    NOW()
);
```

---

## 🎯 TESTING FITUR-FITUR UTAMA

### TEST 1: Homepage (Public) ✅

**URL:** `https://yourdomain.com/`

**Yang Harus Dicek:**
- ✅ Hero section muncul dengan baik
- ✅ Search bar berfungsi
- ✅ Featured services tampil (harus ada 232 services)
- ✅ Categories tampil
- ✅ Pricing dual (One-time & Monthly) muncul
- ✅ Footer & header lengkap
- ✅ AOS animations berjalan smooth

**Cara Test:**
1. Buka browser
2. Akses: `https://yourdomain.com/`
3. Scroll ke bawah
4. Cek semua section
5. Test search: ketik "logo design"
6. Klik kategori
7. Klik salah satu service

---

### TEST 2: Login & Authentication ✅

**URL:** `https://yourdomain.com/auth/login`

**Test Admin Login:**
```
Email: admin@situneo.com
Password: password
```

**Yang Harus Dicek:**
- ✅ Form login muncul
- ✅ Input email & password berfungsi
- ✅ Submit login redirect ke dashboard
- ✅ Session tersimpan
- ✅ Logout berfungsi

**Test Register Client:**
1. Buka: `https://yourdomain.com/auth/register`
2. Isi form:
   - Name: Test Client
   - Email: client@test.com
   - Password: password123
   - Role: Client
3. Submit
4. Harus redirect ke /client/index.php

**Test Register Freelancer:**
1. Register dengan role "Freelancer"
2. Harus redirect ke /freelancer/index.php

---

### TEST 3: Admin Dashboard ✅

**URL:** `https://yourdomain.com/admin/`

**Login sebagai Admin, lalu test:**

**A. Dashboard Overview:**
- ✅ Total users count muncul
- ✅ Total services muncul (232+)
- ✅ Total orders muncul
- ✅ Revenue statistics muncul

**B. Services Management:**
```
URL: /admin/services/index.php

Test:
1. ✅ View all services (tabel muncul)
2. ✅ Search service by name
3. ✅ Filter by category
4. ✅ Klik "Edit" service
5. ✅ Update price (one-time & monthly)
6. ✅ Toggle active/inactive
7. ✅ Save changes
```

**C. Orders Management:**
```
URL: /admin/orders/index.php

Test:
1. ✅ View all orders
2. ✅ Update order status
3. ✅ View order details
4. ✅ Update payment status
5. ✅ Assign freelancer ke order
```

**D. Users Management:**
```
URL: /admin/users/index.php

Test:
1. ✅ View all users
2. ✅ Filter by role (admin/client/freelancer)
3. ✅ Edit user info
4. ✅ Activate/Deactivate user
5. ✅ Delete user
```

**E. Website Settings:**
```
URL: /admin/settings/index.php

Test:
1. ✅ Edit site name & tagline
2. ✅ Update contact info
3. ✅ Upload logo
4. ✅ Edit social media links
5. ✅ Update SEO settings
6. ✅ Save changes
```

**F. Content Management:**
```
URL: /admin/content/index.php

Test:
1. ✅ Edit homepage content
2. ✅ Edit about page
3. ✅ Edit contact page
4. ✅ Update FAQ
5. ✅ Save changes
```

---

### TEST 4: Client Dashboard ✅

**URL:** `https://yourdomain.com/client/`

**Login sebagai Client, lalu test:**

**A. Client Dashboard:**
- ✅ Total orders muncul
- ✅ Active projects count
- ✅ Total spent amount
- ✅ Recent orders list

**B. Profile Management:**
```
URL: /client/profile/index.php

Test:
1. ✅ View profile info
2. ✅ Update name, email, phone
3. ✅ Update company info
4. ✅ Update address
5. ✅ Save changes
6. ✅ Upload avatar
```

**C. Orders Page:**
```
URL: /client/orders/index.php

Test:
1. ✅ View all orders
2. ✅ Filter by status
3. ✅ View order details
4. ✅ Track order progress
5. ✅ Download invoice
```

**D. Payments Page:**
```
URL: /client/payments/index.php

Test:
1. ✅ View payment history
2. ✅ See payment method
3. ✅ Check payment status
4. ✅ View transaction ID
```

---

### TEST 5: Freelancer Dashboard ✅

**URL:** `https://yourdomain.com/freelancer/`

**Login sebagai Freelancer, lalu test:**

**A. Freelancer Dashboard:**
- ✅ Total earnings muncul
- ✅ Available balance
- ✅ Pending commission
- ✅ Completed orders count
- ✅ Current tier & commission rate

**B. Commissions Page:**
```
URL: /freelancer/commissions/index.php

Test:
1. ✅ View all commissions
2. ✅ See commission rate per order
3. ✅ Check status (pending/available/withdrawn)
4. ✅ Filter by date
5. ✅ Total commission calculation
```

**C. Withdrawals Page:**
```
URL: /freelancer/withdrawals/index.php

Test:
1. ✅ Request withdrawal form muncul
2. ✅ Input amount
3. ✅ Input bank details:
   - Bank name
   - Account number
   - Account holder name
4. ✅ Submit request
5. ✅ View withdrawal history
6. ✅ Check withdrawal status
```

---

### TEST 6: Order & Payment Flow ✅

**Full E2E Test sebagai Client:**

**Step 1: Browse Services**
```
1. Login sebagai client
2. Buka: /services/index.php
3. Pilih kategori "Logo Design"
4. Klik service "Professional Logo Design"
```

**Step 2: Create Order**
```
URL: /public/order/create.php?service_id=1

Test:
1. ✅ Service details muncul
2. ✅ Pricing options tampil:
   - One-time: Rp 500,000
   - Monthly: Rp 150,000/bulan
3. ✅ Pilih pricing type (One-time)
4. ✅ Isi custom requirements
5. ✅ Klik "Create Order"
6. ✅ Redirect ke payment page
```

**Step 3: Payment Gateway**
```
URL: /public/order/payment.php?order_id=xxx

Test Midtrans (Sandbox):
1. ✅ Order summary muncul
2. ✅ Amount benar
3. ✅ Klik "Pay with Midtrans"
4. ✅ Midtrans Snap popup muncul
5. ✅ Pilih payment method:
   - Credit Card
   - Bank Transfer
   - E-Wallet (GoPay, OVO)
6. ✅ Complete payment
7. ✅ Redirect back ke website
8. ✅ Payment status updated

Test Manual Payment:
1. ✅ Klik "Pay via WhatsApp"
2. ✅ WhatsApp link berfungsi
3. ✅ Order number terkirim
```

**Step 4: Order Tracking**
```
URL: /client/orders/index.php

Test:
1. ✅ Order muncul di list
2. ✅ Status: "Processing"
3. ✅ Payment status: "Paid"
4. ✅ Klik order untuk detail
5. ✅ Progress bar muncul
```

---

### TEST 7: Notification System ✅

**Test sebagai Client:**
```php
// Admin creates notification for client
Notification::create(
    $client_id,
    'Order Confirmed',
    'Your order #12345 has been confirmed!',
    'success',
    '/client/orders/index.php'
);

Check:
1. ✅ Notification badge muncul di header
2. ✅ Click notification icon
3. ✅ Notification list muncul
4. ✅ Click notification
5. ✅ Redirect ke link
6. ✅ Notification marked as read
```

---

### TEST 8: Email System ✅

**Test Email Sending:**
```php
// Test dari admin panel atau create file test-email.php
Email::send(
    'test@example.com',
    'Test Email',
    '<h1>This is a test email</h1><p>From SITUNEO DIGITAL</p>',
    true
);

Check:
1. ✅ Email diterima di inbox
2. ✅ Subject benar
3. ✅ HTML formatting bagus
4. ✅ From address: SITUNEO DIGITAL
```

**Test Order Confirmation Email:**
```
1. Create new order
2. Check email inbox
3. ✅ Order confirmation email diterima
4. ✅ Order details lengkap
5. ✅ Payment link included
```

---

### TEST 9: Performance & Security ✅

**A. Performance Test:**
```bash
# Test page load speed
1. Buka: https://gtmetrix.com
2. Input URL: https://yourdomain.com
3. Run test
4. ✅ Page load < 3 seconds
5. ✅ Performance score > 80%
```

**B. Security Test:**
```
Test CSRF Protection:
1. ✅ Form ada CSRF token
2. ✅ Submit without token = error
3. ✅ Submit with invalid token = error

Test XSS Protection:
1. ✅ Input: <script>alert('XSS')</script>
2. ✅ Data di-escape dengan benar
3. ✅ No script execution

Test SQL Injection:
1. ✅ Input: ' OR '1'='1
2. ✅ Query menggunakan prepared statements
3. ✅ No SQL error muncul

Test Authentication:
1. ✅ Access /admin/ without login = redirect
2. ✅ Access /client/ as freelancer = forbidden
3. ✅ Role-based access berfungsi
```

**C. Browser Compatibility:**
- ✅ Chrome (latest)
- ✅ Firefox (latest)
- ✅ Safari (latest)
- ✅ Edge (latest)
- ✅ Mobile browsers

---

## ✅ CHECKLIST VERIFIKASI LENGKAP

### Database & Setup
- [ ] Database schema imported (95 tables)
- [ ] Seed data imported (232+ services)
- [ ] Admin user created
- [ ] .env configured correctly
- [ ] File permissions set (755 for folders, 644 for files)

### Public Pages
- [ ] Homepage loads correctly
- [ ] Services page shows all 232 services
- [ ] Service detail page works
- [ ] Search functionality works
- [ ] Categories filtering works
- [ ] Contact form sends email
- [ ] About page displays
- [ ] FAQ page displays

### Authentication
- [ ] Register works (Client & Freelancer)
- [ ] Login works (All roles)
- [ ] Logout works
- [ ] Password reset works
- [ ] Session management works
- [ ] Role-based redirect works

### Admin Panel
- [ ] Dashboard statistics accurate
- [ ] Services CRUD works (Create, Read, Update, Delete)
- [ ] Orders management works
- [ ] Users management works
- [ ] Settings update works
- [ ] Content editor works
- [ ] File upload works

### Client Dashboard
- [ ] Dashboard stats display
- [ ] Profile update works
- [ ] Orders list displays
- [ ] Payment history shows
- [ ] Order tracking works

### Freelancer Dashboard
- [ ] Earnings dashboard shows
- [ ] Commission tracking works
- [ ] Withdrawal request works
- [ ] Portfolio management works
- [ ] Commission calculation accurate

### Order & Payment
- [ ] Order creation works
- [ ] Dual pricing (one-time/monthly) works
- [ ] Midtrans payment works (sandbox)
- [ ] Manual WhatsApp payment works
- [ ] Payment status updates
- [ ] Order status updates
- [ ] Invoice generation works

### Advanced Features
- [ ] Notifications create & display
- [ ] Email sending works
- [ ] Analytics tracking works
- [ ] SEO meta tags generated
- [ ] Sitemap generation works
- [ ] Performance optimization active (Gzip, cache)

### Security
- [ ] CSRF protection works
- [ ] XSS protection works
- [ ] SQL injection protected
- [ ] Password hashing works
- [ ] Session security works
- [ ] Role-based access control works

### Performance
- [ ] Page load < 3 seconds
- [ ] Images optimized
- [ ] Gzip compression enabled
- [ ] Browser caching works
- [ ] HTML minification works (if enabled)

### Mobile Responsive
- [ ] Homepage responsive
- [ ] Dashboard responsive
- [ ] Forms work on mobile
- [ ] Navigation mobile-friendly
- [ ] Touch events work

---

## 🔧 TROUBLESHOOTING

### Error: "Database connection failed"
```bash
Solusi:
1. Cek .env file - pastikan credentials benar
2. Cek database exists di cPanel
3. Cek user memiliki privileges
4. Test koneksi manual:
   mysql -u situneo_user -p situneo_db
```

### Error: "Page not found (404)"
```bash
Solusi:
1. Cek .htaccess ada di root folder
2. Pastikan mod_rewrite enabled di server
3. Cek AllowOverride All di Apache config
4. Restart Apache
```

### Error: "Permission denied"
```bash
Solusi:
1. Set folder permissions:
   chmod 755 -R batch1-dev/
2. Set file permissions:
   chmod 644 batch1-dev/*.php
3. Set writable folders:
   chmod 777 batch1-dev/uploads/
   chmod 777 batch1-dev/logs/
```

### Error: "Midtrans payment not working"
```bash
Solusi:
1. Cek Midtrans credentials di .env:
   MIDTRANS_SERVER_KEY=correct_key
   MIDTRANS_CLIENT_KEY=correct_key
2. Pastikan MIDTRANS_IS_PRODUCTION=false (untuk testing)
3. Test di Midtrans Sandbox dulu
4. Cek API error di browser console
```

### Error: "Email not sending"
```bash
Solusi:
1. Cek SMTP credentials di .env
2. Untuk Gmail:
   - Enable "Less secure app access"
   - Or use App Password
3. Test SMTP connection:
   telnet smtp.gmail.com 587
4. Cek firewall tidak block port 587
```

### Error: "Session not working"
```bash
Solusi:
1. Cek session.save_path writable:
   chmod 777 /tmp
2. Cek php.ini:
   session.auto_start = 0
3. Clear browser cookies
4. Test dengan browser lain
```

### Services tidak muncul
```bash
Solusi:
1. Cek database:
   SELECT COUNT(*) FROM services WHERE is_active = 1;
2. Jika 0, import ulang:
   database/seed-services.sql
3. Atau activate manual:
   UPDATE services SET is_active = 1;
```

### Gambar tidak muncul
```bash
Solusi:
1. Cek path di code: /assets/images/
2. Pastikan folder uploads/ writable:
   chmod 777 uploads/
3. Cek .htaccess tidak block image access
4. Upload ulang images
```

---

## 📊 PERFORMANCE BENCHMARKS

**Target Performance:**
- Homepage load: < 2 seconds
- Dashboard load: < 1.5 seconds
- Database query: < 0.5 seconds
- API response: < 1 second

**Optimization Sudah Diterapkan:**
- ✅ Gzip compression
- ✅ Browser caching (24 hours)
- ✅ HTML minification
- ✅ Optimized database queries (indexed)
- ✅ CDN-ready (Bootstrap, jQuery)
- ✅ Lazy loading images (dapat ditambahkan)

---

## 🚀 DEPLOY TO PRODUCTION CHECKLIST

### Pre-Deployment
- [ ] Backup database
- [ ] Test semua fitur di staging
- [ ] Update .env to production settings
- [ ] Set APP_DEBUG=false
- [ ] Set MIDTRANS_IS_PRODUCTION=true
- [ ] Get real Midtrans production keys
- [ ] Setup SSL certificate (HTTPS)
- [ ] Setup SMTP for production emails

### Post-Deployment
- [ ] Test live website
- [ ] Test payment flow (real transaction kecil)
- [ ] Setup monitoring (Uptime Robot)
- [ ] Setup backup automation
- [ ] Setup error logging
- [ ] Submit sitemap ke Google Search Console
- [ ] Setup Google Analytics
- [ ] Test all forms
- [ ] Monitor performance

### Security Hardening
- [ ] Change all default passwords
- [ ] Remove test accounts
- [ ] Disable directory listing
- [ ] Setup rate limiting
- [ ] Enable fail2ban (if available)
- [ ] Regular security updates
- [ ] Setup WAF (Web Application Firewall)

---

## 📞 SUPPORT & DOCUMENTATION

**Dokumentasi Lengkap:**
- `README-COMPLETE.md` - Overview project
- `BATCH1-README.md` - Database & Core
- `BATCH4-5-README.md` - Auth & Admin
- `BATCH6-10-README.md` - Advanced Features
- `README-INSTALLATION.md` - Panduan instalasi detail

**Testing Selesai?**

Jika semua checklist ✅, website SIAP untuk:
1. 🚀 **GO LIVE!**
2. 💰 **Start Earning!**
3. 📈 **Scale & Grow!**

---

**SITUNEO DIGITAL - Production Ready! 🎉**
