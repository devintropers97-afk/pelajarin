-- ========================================
-- SITUNEO DIGITAL - Freelancer Tiers Seed Data
-- Commission System: 30% - 55%
-- ========================================

INSERT INTO `freelancer_tiers` (`tier_name`, `min_orders`, `commission_rate`, `benefits`) VALUES
('bronze', 0, 30.00, '["30% komisi per order", "Akses dashboard freelancer", "Marketing materials dasar", "Support via email"]'),
('silver', 10, 40.00, '["40% komisi per order", "Priority support", "Advanced marketing materials", "Monthly performance report", "Badge Silver di profil"]'),
('gold', 25, 50.00, '["50% komisi per order", "Dedicated account manager", "Premium marketing materials", "Prioritas assign order", "Badge Gold di profil", "Bonus quarterly"]'),
('platinum', 50, 55.00, '["55% komisi per order", "VIP support 24/7", "Custom marketing materials", "First priority untuk order premium", "Badge Platinum di profil", "Bonus quarterly + tahunan", "Invitation ke exclusive events"]'),
('diamond', 75, 55.00, '["55% komisi per order + 5% extra", "VIP support dengan hotline", "Full custom marketing kit", "Co-branding opportunities", "Badge Diamond di profil", "Massive bonuses", "Partnership opportunities", "Speaking opportunities di events"]');
