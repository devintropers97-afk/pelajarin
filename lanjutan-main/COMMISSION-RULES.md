# 💰 ATURAN KOMISI FREELANCER - SITUNEO DIGITAL

## ⚠️ LOGIC UTAMA - WAJIB DIPAHAMI

**Freelancer HANYA dapat komisi ketika ORDER sudah SELESAI 100% dan CLIENT sudah BAYAR 100%**

---

## 📋 Kondisi Komisi Masuk ke Balance Freelancer

### ✅ SYARAT KOMISI DAPAT DITARIK (Available Balance)

Komisi masuk ke **Available Balance** dan **BISA DITARIK** hanya jika:

1. **Order Status = `completed`**
   - Project sudah selesai dikerjakan oleh Situneo
   - Client sudah approve/OK hasil project
   - Sudah DEAL dari segi semuanya

2. **Payment Status = `paid` / `completed`**
   - Client sudah bayar **100% LUNAS**
   - Bukan cuma DP (Down Payment)
   - Semua invoice sudah dibayar

3. **Referral Verified**
   - Order tersebut terdaftar dengan referral code freelancer
   - Client daftar menggunakan link referral freelancer

**Formula:**
```sql
Available Balance = SUM(commission)
WHERE order_status = 'completed'
AND payment_status = 'paid'
AND freelancer_id = [user_id]
```

---

## ⏳ PENDING CLEARANCE (Komisi Belum Bisa Ditarik)

Komisi masuk ke **Pending Clearance** dan **BELUM BISA DITARIK** jika:

1. **Order Status ≠ `completed`**
   - `pending` - Order baru masuk, belum dikerjakan
   - `processing` - Project sedang dikerjakan
   - `on-hold` - Project tertunda
   - `revision` - Client minta revisi

2. **Payment Status ≠ `paid`**
   - `unpaid` - Belum bayar sama sekali
   - `partial` - Baru bayar DP (Down Payment)
   - `pending` - Menunggu konfirmasi pembayaran

**Formula:**
```sql
Pending Clearance = SUM(estimated_commission)
WHERE order_status != 'completed'
OR payment_status != 'paid'
AND freelancer_id = [user_id]
```

---

## ❌ KONDISI TIDAK DAPAT KOMISI

Freelancer **TIDAK** dapat komisi sama sekali jika:

1. **Client Batal Order**
   - Order status = `cancelled`
   - Client refund
   - Project dibatalkan sebelum selesai

2. **Client Tidak Bayar**
   - Payment status = `unpaid` terlalu lama
   - Client kabur/ghost
   - Order expired

3. **Referral Tidak Valid**
   - Client tidak daftar via link referral
   - Client daftar organik (langsung ke website)
   - Referral code tidak match

---

## 📊 TIER CALCULATION

**Tier naik/turun berdasarkan jumlah order COMPLETED + PAID 100%**

### Aturan Hitung Tier:

```sql
SELECT COUNT(*) as completed_orders
FROM orders
WHERE freelancer_id = [user_id]
AND order_status = 'completed'
AND payment_status = 'paid'
AND MONTH(completed_at) = [current_month]
AND YEAR(completed_at) = [current_year]
```

**Tier Levels:**
- **Tier 1:** 0-10 completed orders/bulan → **30% komisi**
- **Tier 2:** 10-25 completed orders/bulan → **40% komisi**
- **Tier 3:** 25-50 completed orders/bulan → **50% komisi**
- **Tier MAX:** 75+ completed orders/bulan → **55% komisi**

**Order yang TIDAK dihitung untuk tier:**
- ❌ Order pending (belum dikerjakan)
- ❌ Order processing (sedang dikerjakan)
- ❌ Order on-hold (tertunda)
- ❌ Order cancelled (dibatalkan)
- ❌ Payment partial (belum lunas 100%)
- ❌ Payment unpaid (belum bayar)

---

## 🔄 FLOW KOMISI - DARI AWAL SAMPAI AKHIR

```
┌─────────────────────────────────────────────────────────┐
│ 1. FREELANCER PROMOSI                                   │
│    - Share link referral ke calon client                │
│    - Buat marketing materials                           │
└─────────────────────────────────────────────────────────┘
                        ↓
┌─────────────────────────────────────────────────────────┐
│ 2. CLIENT DAFTAR VIA REFERRAL                           │
│    - Klik link referral freelancer                      │
│    - Daftar akun dengan referral code                   │
│    - Referral tracking saved in database                │
└─────────────────────────────────────────────────────────┘
                        ↓
┌─────────────────────────────────────────────────────────┐
│ 3. CLIENT ORDER JASA SITUNEO                            │
│    - Pilih paket/layanan                                │
│    - Order status = "pending"                           │
│    - Komisi status = "PENDING CLEARANCE"                │
└─────────────────────────────────────────────────────────┘
                        ↓
┌─────────────────────────────────────────────────────────┐
│ 4. CLIENT BAYAR DP (Optional)                           │
│    - Payment status = "partial"                         │
│    - Order status = "processing"                        │
│    - Komisi status = "PENDING CLEARANCE"                │
└─────────────────────────────────────────────────────────┘
                        ↓
┌─────────────────────────────────────────────────────────┐
│ 5. SITUNEO KERJAKAN PROJECT                             │
│    - Order status = "processing"                        │
│    - Project on-progress                                │
│    - Komisi status = "PENDING CLEARANCE"                │
└─────────────────────────────────────────────────────────┘
                        ↓
┌─────────────────────────────────────────────────────────┐
│ 6. CLIENT APPROVE + BAYAR 100% LUNAS                    │
│    - Order status = "completed"                         │
│    - Payment status = "paid"                            │
│    - Komisi status = "AVAILABLE" ✅                     │
└─────────────────────────────────────────────────────────┘
                        ↓
┌─────────────────────────────────────────────────────────┐
│ 7. FREELANCER TARIK KOMISI                              │
│    - Request withdrawal                                 │
│    - Admin approve                                      │
│    - Transfer ke rekening freelancer                    │
└─────────────────────────────────────────────────────────┘
```

---

## 💡 CONTOH KASUS

### Kasus 1: Komisi DAPAT DITARIK ✅

**Scenario:**
- Client "Budi" daftar via referral freelancer "Andi"
- Budi order paket "Website Company Profile" Rp 5.000.000
- Situneo kerjakan website 2 minggu
- Budi approve hasil website
- Budi bayar 100% lunas (Rp 5.000.000)
- Order status = "completed"
- Payment status = "paid"

**Hasil:**
- Freelancer Andi tier 2 (40% komisi)
- Komisi Andi = Rp 5.000.000 × 40% = **Rp 2.000.000**
- Status: **AVAILABLE BALANCE** → Andi bisa tarik komisi ✅
- Dihitung untuk tier: **YES** ✅

---

### Kasus 2: Komisi PENDING (Belum Bisa Ditarik) ⏳

**Scenario:**
- Client "Siti" daftar via referral freelancer "Budi"
- Siti order paket "Toko Online" Rp 10.000.000
- Siti bayar DP 50% = Rp 5.000.000
- Situneo sedang kerjakan website (masih proses)
- Order status = "processing"
- Payment status = "partial"

**Hasil:**
- Freelancer Budi tier 1 (30% komisi)
- Estimasi komisi Budi = Rp 10.000.000 × 30% = Rp 3.000.000
- Status: **PENDING CLEARANCE** → Budi belum bisa tarik ⏳
- Dihitung untuk tier: **NO** ❌
- Menunggu: Project selesai + Siti bayar sisanya 50%

---

### Kasus 3: Komisi TIDAK DAPAT ❌

**Scenario:**
- Client "Rina" daftar via referral freelancer "Citra"
- Rina order paket "Social Media Marketing" Rp 3.000.000
- Rina bayar DP 30% = Rp 900.000
- Situneo mulai kerjakan
- Tiba-tiba Rina minta cancel order dan refund
- Order status = "cancelled"
- Payment status = "refunded"

**Hasil:**
- Freelancer Citra: **TIDAK DAPAT KOMISI** ❌
- Komisi = Rp 0
- Dihitung untuk tier: **NO** ❌
- Alasan: Order cancelled sebelum completed

---

## 🔐 DATABASE IMPLEMENTATION

### Table: `orders`
```sql
-- Field yang menentukan komisi
order_status ENUM('pending','processing','on-hold','revision','completed','cancelled')
payment_status ENUM('unpaid','partial','pending','paid','refunded')
freelancer_id INT(11) -- referral freelancer
total_price DECIMAL(10,2)
commission_rate DECIMAL(5,2) -- dari tier freelancer saat order
commission_amount DECIMAL(10,2) -- calculated field
commission_status ENUM('pending','available','withdrawn')
completed_at DATETIME -- kapan order selesai
```

### Trigger: Auto Update Commission Status
```sql
-- Ketika order completed + payment paid → update commission_status
UPDATE orders
SET commission_status = 'available'
WHERE order_status = 'completed'
AND payment_status = 'paid'
AND commission_status = 'pending';

-- Ketika order cancelled → hapus commission
UPDATE orders
SET commission_status = 'cancelled',
    commission_amount = 0
WHERE order_status = 'cancelled';
```

---

## 📱 UI/UX DISPLAY

### Dashboard Freelancer - Commission Card

```
┌───────────────────────────────────────────┐
│ 💰 KOMISI ANDA                            │
├───────────────────────────────────────────┤
│                                           │
│  Available Balance                        │
│  Rp 15.400.000                           │
│  ─────────────────────                   │
│  Dari 38 order completed + paid 100%     │
│  [Tarik Komisi]                          │
│                                           │
│  ────────────────────────────────────    │
│                                           │
│  Pending Clearance                        │
│  Rp 2.800.000                            │
│  ─────────────────────                   │
│  Dari 7 order masih on-progress          │
│  (Akan masuk setelah order selesai)      │
│                                           │
└───────────────────────────────────────────┘
```

### Referrals Page - Order Status Detail

```
┌───────────────────────────────────────────────────────┐
│ CLIENT: Budi Santoso                                  │
│ ORDER: Website Company Profile - Rp 5.000.000         │
├───────────────────────────────────────────────────────┤
│ Order Status:    [✅ Completed]                       │
│ Payment Status:  [✅ Paid 100%]                       │
│ Your Commission: Rp 2.000.000 (40%)                   │
│ Commission Status: [✅ AVAILABLE - Bisa Ditarik]      │
└───────────────────────────────────────────────────────┘

┌───────────────────────────────────────────────────────┐
│ CLIENT: Siti Aminah                                   │
│ ORDER: Toko Online - Rp 10.000.000                    │
├───────────────────────────────────────────────────────┤
│ Order Status:    [🔄 Processing]                      │
│ Payment Status:  [⏳ Partial (DP 50%)]                │
│ Est. Commission: Rp 3.000.000 (30%)                   │
│ Commission Status: [⏳ PENDING - Menunggu selesai]    │
└───────────────────────────────────────────────────────┘
```

---

## 🎯 SUMMARY - INGAT INI!

### 3 Kondisi Wajib untuk Komisi Masuk:

1. ✅ **Order Status = `completed`**
2. ✅ **Payment Status = `paid` (100% lunas)**
3. ✅ **Referral Valid**

### Jika salah satu TIDAK terpenuhi:
- ⏳ Komisi masuk **PENDING CLEARANCE**
- ❌ TIDAK BISA ditarik sampai order selesai + bayar 100%
- ❌ TIDAK DIHITUNG untuk naik tier

### Admin Control:
- Admin bisa manual approve/reject komisi
- Admin bisa adjust commission rate per order
- Admin bisa set order status dan payment status
- Freelancer hanya bisa lihat dan tarik (tidak bisa edit)

---

**Last Updated:** 2025-11-05
**Version:** 2.0 (Final with Commission Rules)
