-- ========================================
-- SITUNEO DIGITAL - Freelancer Tiers VERSION 2
-- Updated Commission Structure: 30% - 55%
-- BATCH 4
-- ========================================
--
-- COMMISSION UPGRADE VERSION 2:
-- Previous: 15% - 50%
-- New: 30% - 55% (Increased base and max)
--
-- Tier Progression System:
-- - Tier 1 (Bronze): 30% - Starting tier
-- - Tier 2 (Silver): 40% - Requires 10 total orders
-- - Tier 3 (Gold): 50% - Requires 25 total orders
-- - Tier 3+ (Diamond): 55% - Requires 75 total orders (MAXIMUM!)
--
-- Maintenance Requirements:
-- - Tier 2: Min 10 orders/month to maintain
-- - Tier 3: Min 50 orders/month to maintain
-- - Tier 3+: Min 75 orders/month to maintain
--
-- ========================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Clear existing tiers
TRUNCATE TABLE `freelancer_tiers`;

-- ========================================
-- INSERT VERSION 2 TIERS (30%-55%)
-- ========================================

INSERT INTO `freelancer_tiers` (`tier_name`, `tier_level`, `min_orders_total`, `min_orders_monthly`, `commission_percentage`, `benefits`, `requirements`, `is_active`, `created_at`) VALUES

-- TIER 1: Bronze (30%)
('tier_1', 1, 0, 0, 30.00,
'["30% komisi dari setiap order", "Akses dashboard partner", "Referral link & QR code unik", "Training basic digital marketing", "Marketing materials (PDF, images)", "Email & WhatsApp support", "Payment 2x sebulan", "Withdrawal minimum Rp 50,000"]',
'["Daftar sebagai partner", "Verifikasi identitas (KTP)", "Setup bank account", "Setujui terms & conditions"]',
1, NOW()),

-- TIER 2: Silver (40%)
('tier_2', 2, 10, 10, 40.00,
'["40% komisi dari setiap order (naik 10%!)", "Priority support (response < 2 jam)", "Marketing kit lengkap (Canva template)", "Monthly webinar & training", "Product update newsletter", "Dedicated WhatsApp group", "Performance dashboard advanced", "Bonus incentive per 20 orders"]',
'["Total 10 orders sejak bergabung", "Maintain min 10 orders per bulan", "Rating minimal 4.0/5.0", "Response time < 24 jam"]',
1, NOW()),

-- TIER 3: Gold (50%)
('tier_3', 3, 25, 50, 50.00,
'["50% komisi dari setiap order (naik 20% dari awal!)", "Dedicated account manager", "Co-branding opportunity (logo partner di materials)", "Exclusive promo code untuk customer Anda", "Early access produk & promo baru", "Weekly performance review call", "Custom landing page untuk referral", "Top performer badge", "Invitation ke partner gathering"]',
'["Total 25 orders sejak bergabung", "Maintain min 50 orders per bulan", "Rating minimal 4.5/5.0", "Zero complaint/dispute", "Response time < 12 jam"]',
1, NOW()),

-- TIER 3+: Diamond (55% MAXIMUM!)
('tier_3_plus', 4, 75, 75, 55.00,
'["55% MAXIMUM komisi (tertinggi!)", "Extra 5% bonus achievement", "VIP treatment & priority in everything", "Partnership consultation 1-on-1", "Custom solutions & flexibility", "Featured partner di website SITUNEO", "Exclusive event invitation", "Revenue sharing discussion", "API access untuk integration", "White-label opportunity discussion"]',
'["Total 75 orders sejak bergabung", "Maintain min 75 orders per bulan", "Rating 4.8/5.0 atau lebih", "Zero complaint/dispute", "Response time < 6 jam", "Active content creator (review, testimonial, case study)"]',
1, NOW());


-- ========================================
-- TIER PROGRESSION NOTES
-- ========================================
--
-- Auto Upgrade Rules:
-- - Partner otomatis naik tier ketika mencapai min_orders_total
-- - Upgrade terjadi pada awal bulan berikutnya
-- - Email notification sent upon upgrade
--
-- Auto Downgrade Rules:
-- - Jika tidak maintain min_orders_monthly selama 2 bulan berturut-turut
-- - Downgrade ke tier sebelumnya
-- - Warning email sent 1 minggu sebelum downgrade
-- - Grace period: 1 bulan untuk recover
--
-- Re-Upgrade Rules:
-- - Untuk naik lagi setelah downgrade, harus capai total orders requirement lagi
-- - Contoh: Turun dari Silver ke Bronze, harus capai 10 total orders lagi (dari waktu downgrade)
-- - Counter orders untuk re-upgrade di-reset saat downgrade
--
-- ========================================

-- ========================================
-- COMMISSION CALCULATION EXAMPLES
-- ========================================
--
-- Contoh perhitungan komisi:
--
-- 1. Landing Page (Rp 350,000 setup + Rp 150,000/bulan)
--    - Tier 1 (30%): Rp 105,000 + Rp 45,000/bulan = Rp 150,000 total (bulan pertama)
--    - Tier 2 (40%): Rp 140,000 + Rp 60,000/bulan = Rp 200,000 total (bulan pertama)
--    - Tier 3 (50%): Rp 175,000 + Rp 75,000/bulan = Rp 250,000 total (bulan pertama)
--    - Tier 3+ (55%): Rp 192,500 + Rp 82,500/bulan = Rp 275,000 total (bulan pertama)
--
-- 2. E-Commerce (Rp 1,500,000 setup + Rp 350,000/bulan)
--    - Tier 1 (30%): Rp 450,000 + Rp 105,000/bulan = Rp 555,000 total (bulan pertama)
--    - Tier 2 (40%): Rp 600,000 + Rp 140,000/bulan = Rp 740,000 total (bulan pertama)
--    - Tier 3 (50%): Rp 750,000 + Rp 175,000/bulan = Rp 925,000 total (bulan pertama)
--    - Tier 3+ (55%): Rp 825,000 + Rp 192,500/bulan = Rp 1,017,500 total (bulan pertama)
--
-- 3. Website AI (Rp 2,500,000 setup + Rp 450,000/bulan)
--    - Tier 1 (30%): Rp 750,000 + Rp 135,000/bulan = Rp 885,000 total (bulan pertama)
--    - Tier 2 (40%): Rp 1,000,000 + Rp 180,000/bulan = Rp 1,180,000 total (bulan pertama)
--    - Tier 3 (50%): Rp 1,250,000 + Rp 225,000/bulan = Rp 1,475,000 total (bulan pertama)
--    - Tier 3+ (55%): Rp 1,375,000 + Rp 247,500/bulan = Rp 1,622,500 total (bulan pertama)
--
-- Recurring Commission (Monthly):
-- - Partner dapat komisi recurring setiap bulan selama client tetap berlangganan
-- - Commission tier mengikuti tier partner saat transaksi terjadi
-- - Jika tier naik/turun, komisi untuk order baru yang berbeda, order lama tetap dengan tier lama
--
-- ========================================

-- ========================================
-- NON-COMMISSIONABLE ITEMS (0%)
-- ========================================
--
-- Items yang TIDAK mendapat komisi karena third-party:
-- 1. Domain registration (.com, .id, .net, dll)
-- 2. Hosting (shared, cloud, VPS)
-- 3. SSL Certificate
-- 4. Google Workspace / Email hosting third-party
-- 5. Premium plugins/themes dari third-party
--
-- Reasoning: Items ini adalah pass-through service dengan margin tipis
-- Partner tetap dapat komisi dari service lain dalam paket
--
-- ========================================

-- ========================================
-- WITHDRAWAL POLICY
-- ========================================
--
-- Minimum Withdrawal: Rp 50,000
-- Payment Schedule: Twice monthly (tanggal 10 & 25)
-- Processing Time: 1x24 jam (hari kerja)
-- Payment Method: Bank transfer (BCA, Mandiri, BNI, BRI)
--
-- Auto-withdrawal option (coming soon):
-- - Partner dapat set auto withdrawal setiap balance >= threshold
-- - Threshold minimum: Rp 100,000
--
-- ========================================

COMMIT;

-- ========================================
-- END OF FREELANCER TIERS VERSION 2
--
-- SUMMARY:
-- ========================================
-- Total Tiers: 4 (Bronze, Silver, Gold, Diamond)
-- Commission Range: 30% - 55% (increased from 15%-50%)
-- Base commission increased: +15% (from 15% to 30%)
-- Maximum commission increased: +5% (from 50% to 55%)
--
-- Benefits:
-- - More attractive for new partners (30% vs 15%)
-- - Better retention with higher max commission
-- - Clear progression path with achievable milestones
-- - Competitive with market standards
--
-- Implementation:
-- - Update partner dashboard to show new tiers
-- - Email existing partners about commission increase
-- - Update marketing materials
-- - Update partner agreement/terms
-- ========================================
