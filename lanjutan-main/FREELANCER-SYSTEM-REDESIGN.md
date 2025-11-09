# 🎯 FREELANCER SYSTEM REDESIGN - SITUNEO DIGITAL

## Konsep yang BENAR

**Freelancer di Situneo = AFFILIATE MARKETER / SALES AGENT**

Mereka adalah orang yang:
- ✅ **JUALAN/PROMOSI** jasa Situneo ke calon client
- ✅ **CARI CLIENT** untuk beli jasa di Situneo
- ✅ **DAPAT KOMISI** dari setiap order via link referral mereka
- ❌ **BUKAN** yang ngerjain project Situneo
- ❌ **BUKAN** karyawan atau pekerja Situneo

---

## Analogi yang Tepat

```
┌─────────────────────────────────────────────────────┐
│  SITUNEO = Toko (Platform)                          │
│  - Semua produk milik Situneo                       │
│  - 232+ layanan digital                             │
│  - Website, Marketing, AI, Branding, dll            │
└─────────────────────────────────────────────────────┘
           │                           │
           ▼                           ▼
    ┌──────────────┐           ┌──────────────┐
    │   CLIENT     │           │  FREELANCER  │
    │  (Pembeli)   │           │  (Marketer)  │
    └──────────────┘           └──────────────┘
           │                           │
           │                           │
           ├───────────────────────────┤
           │   Order via Referral Link │
           └───────────────────────────┘
                      │
                      ▼
            ┌─────────────────────┐
            │ Freelancer Dapat    │
            │ Komisi 30%/40%/50%  │
            └─────────────────────┘
```

**Cara Kerja:**
1. **Freelancer** promosi jasa Situneo pakai link referral
2. **Calon client** klik link referral freelancer
3. **Client** daftar akun menggunakan referral code freelancer
4. **Client** order jasa Situneo (via referral)
5. **Situneo** yang ngerjain project untuk client
6. **Client** bayar 100% + approve hasil project (DEAL selesai)
7. **Freelancer** dapat komisi otomatis masuk ke balance

---

## ⚠️ ATURAN KOMISI - PENTING!

**Freelancer HANYA dapat komisi ketika:**

✅ **Client sudah PAYMENT 100%** (bayar lunas semua tagihan)
✅ **Order sudah COMPLETED** (project selesai & client approved/OK)
✅ **Status order = "completed"** (sudah deal dari segi semuanya)

**Freelancer TIDAK dapat komisi jika:**

❌ Client baru daftar akun (belum order)
❌ Client sudah order tapi belum bayar
❌ Client bayar DP saja (belum lunas 100%)
❌ Project masih on-progress (belum completed)
❌ Client belum approve hasil (belum deal OK)

**Status Komisi:**
- **Pending:** Order masih dikerjakan atau belum lunas 100%
- **Available:** Order completed + payment 100% → bisa ditarik
- **Withdrawn:** Sudah ditarik ke rekening freelancer

**Tier Calculation:**
- Hanya order yang **completed + paid 100%** yang dihitung untuk tier
- Order yang masih pending/processing TIDAK dihitung untuk naik tier

---

## Tier System Freelancer

| Tier | Target Order/Bulan | Komisi | Syarat Naik Tier |
|------|-------------------|--------|------------------|
| **Tier 1** | 0-10 order | **30%** | Capai 10 order/bulan |
| **Tier 2** | 10-25 order | **40%** | Capai 25 order/bulan |
| **Tier 3** | 25-50 order | **50%** | Capai 50 order/bulan |
| **Tier MAX** | 75+ order | **55%** | Capai 75+ order/bulan |

**Aturan Turun Tier:**
- Tier 2 → Tier 1: Jika bulan berikutnya dapat <10 order
- Tier 3 → Tier 2: Jika bulan berikutnya dapat <25 order
- Tier MAX tetap stabil jika maintain 50+ order/bulan

---

## Dashboard Freelancer - Struktur yang BENAR

### 1. **Dashboard Overview** (`/freelancer/dashboard`)

**Metrics:**
```
┌─────────────────────────────────────────────────────┐
│  🎯 Current Tier: TIER 2 (40% Komisi)              │
│  📊 Orders Bulan Ini: 18 / 25 (untuk naik Tier 3)  │
│  💰 Total Komisi Bulan Ini: Rp 7.200.000           │
│  👥 Total Referrals: 42 clients                     │
│  ✅ Total Orders (Lifetime): 156 orders             │
└─────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────┐
│  📈 TIER PROGRESS                                   │
│  ████████████████░░░░░░░░  72% menuju Tier 3       │
│  Butuh 7 order lagi bulan ini!                      │
└─────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────┐
│  💸 KOMISI TERSEDIA                                 │
│  Available Balance: Rp 15.400.000                   │
│    (dari order completed + payment 100%)            │
│  Pending Clearance: Rp 2.800.000                    │
│    (order on-progress / belum lunas 100%)           │
│  [Tarik Komisi]                                     │
└─────────────────────────────────────────────────────┘

NOTE:
- Available Balance = komisi dari order COMPLETED + PAID 100% → BISA DITARIK
- Pending Clearance = komisi dari order masih on-progress → BELUM BISA DITARIK
- Tier dihitung hanya dari order yang COMPLETED + PAID 100%
```

**Quick Actions:**
- 🔗 Copy Referral Link
- 📱 Download QR Code
- 📝 Request Demo untuk Client
- 📊 Lihat Katalog Layanan
- 💰 Tarik Komisi

---

### 2. **My Referrals / Clients** (`/freelancer/referrals`)

**Bukan "My Projects"!** Ini adalah list **client yang order via referral mereka**.

**Table:**
| Client Name | Email | Phone | Order | Status | Komisi | Tanggal |
|-------------|-------|-------|-------|--------|--------|---------|
| Budi Santoso | budi@... | 0812... | Website UMKM | Completed | Rp 750k | 01/11/25 |
| Ani Lestari | ani@... | 0813... | Branding Paket | Processing | Rp 1.6jt | 03/11/25 |
| Toko Jaya | toko@... | 0821... | Toko Online | Pending | Rp 2jt | 05/11/25 |

**Filter:**
- All / Pending / Processing / Completed / Cancelled
- Bulan ini / Bulan lalu / Custom range

**Detail per Client:**
- Nama & kontak client
- Order apa yang mereka beli
- Status pengerjaan (admin Situneo yang update)
- Komisi yang didapat
- History semua order dari client ini

---

### 3. **Request Demo for Client** (`/freelancer/demo-request`)

**Form untuk bantu client request demo:**

```
┌─────────────────────────────────────────────────────┐
│  📝 BANTU CLIENT REQUEST DEMO                       │
│                                                     │
│  Data Client:                                       │
│  - Nama Lengkap: [input]                           │
│  - Email: [input]                                   │
│  - WhatsApp: [input]                                │
│  - Nama Usaha/Project: [input]                      │
│                                                     │
│  Layanan yang Diminati:                             │
│  [dropdown: Website UMKM, Toko Online, Branding,..] │
│                                                     │
│  Budget Range:                                      │
│  [dropdown: <5jt, 5-10jt, 10-20jt, 20jt+]          │
│                                                     │
│  Catatan Tambahan:                                  │
│  [textarea]                                         │
│                                                     │
│  [Submit Request]                                   │
│                                                     │
│  ✅ Referral code otomatis included                │
│  ✅ Admin akan follow-up dalam 24 jam              │
└─────────────────────────────────────────────────────┘
```

**Fitur:**
- Otomatis include referral code freelancer
- Langsung masuk ke dashboard admin
- Freelancer dapat notif saat admin follow-up
- Jika jadi order, komisi otomatis masuk

---

### 4. **Katalog Layanan** (`/freelancer/services`)

**Browse 232+ layanan Situneo untuk dipromosikan:**

```
┌─────────────────────────────────────────────────────┐
│  🔍 Cari Layanan...                                 │
└─────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────┐
│  📂 DIVISI WEB DEVELOPMENT (45 layanan)             │
│                                                     │
│  💼 Website Company Profile                         │
│  Harga: Rp 2.500.000 - Rp 15.000.000               │
│  Komisi Anda (40%): Rp 1.000.000 - Rp 6.000.000    │
│  [Get Referral Link] [Detail]                       │
│                                                     │
│  🛒 Toko Online / E-Commerce                        │
│  Harga: Rp 5.000.000 - Rp 25.000.000               │
│  Komisi Anda (40%): Rp 2.000.000 - Rp 10.000.000   │
│  [Get Referral Link] [Detail]                       │
└─────────────────────────────────────────────────────┘
```

**Fitur per Layanan:**
- ✅ Harga jelas
- ✅ Kalkulasi komisi otomatis sesuai tier
- ✅ Get referral link spesifik per service
- ✅ Download brosur/marketing material
- ✅ FAQ untuk dijawab ke client
- ✅ Sample portfolio

---

### 5. **Tier & Komisi** (`/freelancer/tier`)

**Tracking tier & target:**

```
┌─────────────────────────────────────────────────────┐
│  🏆 TIER STATUS                                     │
│                                                     │
│  Current: TIER 2 (40% Komisi)                       │
│  Member Since: 15 Mei 2025 (6 bulan)               │
│                                                     │
│  Progress Bulan Ini:                                │
│  ████████████████░░░░░░░░  18 / 25 orders         │
│                                                     │
│  Target untuk Naik Tier 3:                          │
│  - Butuh 7 order lagi bulan ini                     │
│  - Reward: Komisi naik jadi 50%                     │
│  - Estimasi tambahan income: +Rp 2jt/bulan         │
└─────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────┐
│  📊 HISTORY TIER                                    │
│                                                     │
│  Nov 2025: TIER 2 (18 orders) - On Track           │
│  Okt 2025: TIER 2 (22 orders) ✅                    │
│  Sep 2025: TIER 1 (12 orders) ⬆️ Promoted          │
│  Agu 2025: TIER 1 (8 orders)                        │
└─────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────┐
│  💰 KOMISI BREAKDOWN                                │
│                                                     │
│  Bulan Ini (Nov):                                   │
│  - 18 orders x avg Rp 400k = Rp 7.200.000          │
│                                                     │
│  Lifetime (6 bulan):                                │
│  - Total Orders: 156                                │
│  - Total Komisi: Rp 62.400.000                      │
│  - Avg per Bulan: Rp 10.400.000                     │
└─────────────────────────────────────────────────────┘
```

---

### 6. **Withdrawals / Penarikan** (`/freelancer/withdrawals`)

**Request penarikan komisi:**

```
┌─────────────────────────────────────────────────────┐
│  💸 SALDO KOMISI                                    │
│                                                     │
│  Available Balance: Rp 15.400.000                   │
│  Pending Clearance: Rp 2.800.000                    │
│  In Process: Rp 0                                   │
│                                                     │
│  Minimum Withdrawal: Rp 500.000                     │
│  [Request Withdrawal]                               │
└─────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────┐
│  📋 WITHDRAWAL HISTORY                              │
│                                                     │
│  05/11/25 - Rp 10.000.000 - Transferred ✅          │
│  28/10/25 - Rp 8.500.000 - Transferred ✅           │
│  15/10/25 - Rp 5.000.000 - Transferred ✅           │
└─────────────────────────────────────────────────────┘
```

**Form Penarikan:**
- Jumlah yang mau ditarik
- Bank account details
- Catatan (optional)
- Submit → admin approve → transfer dalam 1-3 hari kerja

---

### 7. **Referral Tools** (`/freelancer/tools`)

**Marketing tools untuk promosi:**

```
┌─────────────────────────────────────────────────────┐
│  🔗 UNIQUE REFERRAL LINK                            │
│                                                     │
│  https://situneo.my.id/ref/BUDI2025                │
│  [Copy Link] [Generate QR Code]                     │
│                                                     │
│  Klik: 342 | Registrasi: 68 | Order: 42            │
│  Conversion Rate: 12.3% (Bagus! 👍)                 │
└─────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────┐
│  📱 QR CODE                                         │
│  [QR Code Image]                                    │
│  [Download PNG] [Download SVG]                      │
└─────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────┐
│  📄 MARKETING MATERIALS                             │
│                                                     │
│  📊 Price List PDF [Download]                       │
│  🎨 Brosur Digital [Download]                       │
│  📱 Instagram Story Template [Download]             │
│  💼 PowerPoint Presentation [Download]              │
│  📧 Email Template [Download]                       │
│  💬 WhatsApp Message Template [Copy]                │
└─────────────────────────────────────────────────────┘
```

---

### 8. **Analytics** (`/freelancer/analytics`)

**Performance tracking:**

```
┌─────────────────────────────────────────────────────┐
│  📊 PERFORMANCE OVERVIEW                            │
│                                                     │
│  Bulan Ini vs Bulan Lalu:                           │
│  Orders: 18 vs 22 (-18%) ⚠️                        │
│  Komisi: Rp 7.2jt vs Rp 8.8jt (-18%)               │
│  New Clients: 6 vs 8 (-25%)                         │
│  Conversion Rate: 11% vs 13% (-15%)                 │
└─────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────┐
│  🏆 TOP PERFORMING SERVICES                         │
│                                                     │
│  1. Website UMKM (8 orders) - Rp 3.2jt komisi      │
│  2. Toko Online (4 orders) - Rp 2.4jt komisi       │
│  3. Branding Paket (3 orders) - Rp 1.2jt komisi    │
└─────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────┐
│  📈 MONTHLY TREND (6 bulan terakhir)                │
│  [Line Chart: Orders & Komisi per Bulan]            │
└─────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────┐
│  🎯 CLIENT SOURCE                                   │
│  Instagram: 45%                                     │
│  WhatsApp: 30%                                      │
│  Facebook: 15%                                      │
│  Referral: 10%                                      │
└─────────────────────────────────────────────────────┘
```

---

## Database Schema Changes

### New Tables Needed:

#### 1. `freelancer_referrals` (tracking referral clients)
```sql
CREATE TABLE freelancer_referrals (
    id INT PRIMARY KEY AUTO_INCREMENT,
    freelancer_id INT,
    client_id INT,
    referral_code VARCHAR(50),
    referred_at DATETIME,
    first_order_at DATETIME,
    total_orders INT DEFAULT 0,
    total_commission DECIMAL(15,2) DEFAULT 0,
    status ENUM('active', 'inactive'),
    FOREIGN KEY (freelancer_id) REFERENCES users(id),
    FOREIGN KEY (client_id) REFERENCES users(id)
);
```

#### 2. `freelancer_tiers` (tier history)
```sql
CREATE TABLE freelancer_tiers (
    id INT PRIMARY KEY AUTO_INCREMENT,
    freelancer_id INT,
    tier INT, -- 1, 2, 3, 4 (MAX)
    month_year VARCHAR(7), -- '2025-11'
    orders_count INT,
    commission_rate DECIMAL(5,2), -- 30.00, 40.00, 50.00, 55.00
    tier_changed_at DATETIME,
    FOREIGN KEY (freelancer_id) REFERENCES users(id)
);
```

#### 3. `freelancer_commissions` (detail komisi per order)
```sql
CREATE TABLE freelancer_commissions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    freelancer_id INT,
    order_id INT,
    client_id INT,
    order_amount DECIMAL(15,2),
    commission_rate DECIMAL(5,2),
    commission_amount DECIMAL(15,2),
    status ENUM('pending', 'cleared', 'paid'),
    earned_at DATETIME,
    paid_at DATETIME,
    FOREIGN KEY (freelancer_id) REFERENCES users(id),
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (client_id) REFERENCES users(id)
);
```

#### 4. `referral_links` (tracking link performance)
```sql
CREATE TABLE referral_links (
    id INT PRIMARY KEY AUTO_INCREMENT,
    freelancer_id INT,
    referral_code VARCHAR(50) UNIQUE,
    clicks INT DEFAULT 0,
    registrations INT DEFAULT 0,
    orders INT DEFAULT 0,
    conversion_rate DECIMAL(5,2),
    created_at DATETIME,
    last_clicked_at DATETIME,
    FOREIGN KEY (freelancer_id) REFERENCES users(id)
);
```

#### 5. `demo_requests` (update schema untuk include referral)
```sql
-- Add columns to existing demo_requests table
ALTER TABLE demo_requests ADD COLUMN freelancer_id INT;
ALTER TABLE demo_requests ADD COLUMN referral_code VARCHAR(50);
ALTER TABLE demo_requests ADD FOREIGN KEY (freelancer_id) REFERENCES users(id);
```

---

## Admin Dashboard Changes

Admin perlu manage freelancer dengan benar:

### `/admin/freelancers` - Update Konten

**Yang ditampilkan:**
- List all freelancers
- Tier masing-masing
- Total referrals (clients)
- Total orders bulan ini
- Total komisi earned
- Performance metrics

**Actions:**
- View detail freelancer
- Adjust tier manually (if needed)
- View all their referrals
- Block/unblock freelancer
- Download performance report

### `/admin/commissions` - Update Konten

**Yang ditampilkan:**
- Pending commissions (order completed, komisi belum dibayar)
- Commission history
- Total komisi paid per freelancer
- Filter by freelancer/month/status

### `/admin/withdrawals` - Update Konten

**Approve withdrawal requests dari freelancer**

---

## URL Structure - Freelancer Dashboard

| URL | Page | Deskripsi |
|-----|------|-----------|
| `/freelancer` | Dashboard | Overview, stats, tier progress |
| `/freelancer/referrals` | My Referrals | List client yang direfer |
| `/freelancer/demo-request` | Request Demo | Form bantu client request demo |
| `/freelancer/services` | Katalog Layanan | Browse 232+ services Situneo |
| `/freelancer/tier` | Tier & Komisi | Tier status, progress, history |
| `/freelancer/withdrawals` | Penarikan Komisi | Request & history withdrawal |
| `/freelancer/tools` | Referral Tools | Link, QR, marketing materials |
| `/freelancer/analytics` | Analytics | Performance tracking |
| `/freelancer/profile` | Profile Settings | Edit profil, bank account |

---

## Features to Implement

### 1. **Referral System**
- Unique referral code per freelancer
- Track clicks, registrations, orders
- Auto-calculate commission based on tier
- QR code generation

### 2. **Tier Management (Auto)**
- Check monthly orders per freelancer
- Auto promote/demote tier
- Email notification saat tier change
- Progress bar di dashboard

### 3. **Commission Tracking**
- Per order commission calculation
- Pending → Cleared → Paid status
- Auto clear setelah order completed
- Withdrawal system

### 4. **Demo Request System**
- Freelancer submit demo request untuk client
- Include referral code otomatis
- Admin receive & follow-up
- If jadi order, komisi masuk ke freelancer

### 5. **Analytics & Reports**
- Click tracking
- Conversion rate
- Top performing services
- Monthly trends
- Export reports

---

## Implementation Priority

### Phase 1 - Core System (Week 1)
1. ✅ Update database schema (tables above)
2. ✅ Create referral code system
3. ✅ Update freelancer dashboard homepage
4. ✅ Create "My Referrals" page
5. ✅ Update tier calculation logic

### Phase 2 - Commission System (Week 2)
6. ✅ Commission tracking per order
7. ✅ Withdrawal request system
8. ✅ Admin approval workflow
9. ✅ Tier & Komisi page

### Phase 3 - Marketing Tools (Week 3)
10. ✅ Referral tools page (link, QR, materials)
11. ✅ Katalog layanan untuk freelancer
12. ✅ Demo request form dengan referral
13. ✅ Marketing materials download

### Phase 4 - Analytics (Week 4)
14. ✅ Analytics dashboard
15. ✅ Performance tracking
16. ✅ Reports & exports
17. ✅ Email notifications

---

## Notes

- **PENTING:** Freelancer **BUKAN** yang ngerjain project!
- Mereka hanya **SALES/MARKETING** yang cari client
- Dashboard fokus ke: referral tracking, komisi, tier management
- Semua project dikerjakan oleh **Situneo team** (admin manage)

---

**Status:** Ready for Implementation
**Last Updated:** 2025-11-05
**Version:** 2.0 (Complete Redesign)
