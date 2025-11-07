-- ============================================
-- FREELANCER SYSTEM V2.0 - SCHEMA UPDATES
-- Updated: 2025-11-05
-- Changes: Affiliate/Referral Marketing System
-- ============================================

-- 1. Update freelancer_profiles untuk tier MAX (55%)
ALTER TABLE `freelancer_profiles`
  MODIFY COLUMN `tier_level` ENUM('tier_1','tier_2','tier_3','tier_max') NOT NULL DEFAULT 'tier_1';

-- 2. Update freelancer_commissions untuk tier MAX
ALTER TABLE `freelancer_commissions`
  MODIFY COLUMN `tier_level` ENUM('tier_1','tier_2','tier_3','tier_max') NOT NULL;

-- 3. Update freelancer_tier_history untuk tier MAX
ALTER TABLE `freelancer_tier_history`
  MODIFY COLUMN `previous_tier` ENUM('tier_1','tier_2','tier_3','tier_max') DEFAULT NULL,
  MODIFY COLUMN `new_tier` ENUM('tier_1','tier_2','tier_3','tier_max') NOT NULL;

-- 4. Add referral tracking ke demo_requests (untuk freelancer yang bantu client request demo)
ALTER TABLE `demo_requests`
  ADD COLUMN `freelancer_id` INT(11) DEFAULT NULL AFTER `user_id`,
  ADD COLUMN `referral_code` VARCHAR(20) DEFAULT NULL AFTER `freelancer_id`,
  ADD CONSTRAINT `fk_demo_freelancer` FOREIGN KEY (`freelancer_id`) REFERENCES `users`(`id`) ON DELETE SET NULL;

CREATE INDEX `idx_demo_freelancer` ON `demo_requests`(`freelancer_id`);
CREATE INDEX `idx_demo_referral` ON `demo_requests`(`referral_code`);

-- 5. Create table untuk tracking referral link performance
CREATE TABLE IF NOT EXISTS `referral_link_tracking` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `freelancer_id` INT(11) NOT NULL,
  `referral_code` VARCHAR(20) NOT NULL,
  `event_type` ENUM('click','view','register','order') NOT NULL DEFAULT 'click',
  `ip_address` VARCHAR(45) DEFAULT NULL,
  `user_agent` TEXT DEFAULT NULL,
  `referring_url` VARCHAR(500) DEFAULT NULL,
  `landing_page` VARCHAR(500) DEFAULT NULL,
  `converted_user_id` INT(11) DEFAULT NULL,
  `converted_order_id` INT(11) DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `freelancer_id` (`freelancer_id`),
  KEY `referral_code` (`referral_code`),
  KEY `event_type` (`event_type`),
  KEY `created_at` (`created_at`),
  FOREIGN KEY (`freelancer_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`converted_user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL,
  FOREIGN KEY (`converted_order_id`) REFERENCES `orders`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 6. Create table untuk monthly tier calculations (untuk auto tier adjustment)
CREATE TABLE IF NOT EXISTS `freelancer_monthly_stats` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `freelancer_id` INT(11) NOT NULL,
  `month_year` VARCHAR(7) NOT NULL COMMENT 'Format: 2025-11',
  `total_orders` INT(11) NOT NULL DEFAULT 0,
  `total_revenue` DECIMAL(12,2) NOT NULL DEFAULT 0.00,
  `total_commission` DECIMAL(12,2) NOT NULL DEFAULT 0.00,
  `tier_achieved` ENUM('tier_1','tier_2','tier_3','tier_max') NOT NULL,
  `commission_rate` DECIMAL(5,2) NOT NULL,
  `new_referrals` INT(11) NOT NULL DEFAULT 0,
  `conversion_rate` DECIMAL(5,2) DEFAULT 0.00,
  `rank_position` INT(11) DEFAULT NULL COMMENT 'Leaderboard position',
  `bonus_earned` DECIMAL(12,2) NOT NULL DEFAULT 0.00,
  `calculated_at` DATETIME DEFAULT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_freelancer_month` (`freelancer_id`, `month_year`),
  KEY `freelancer_id` (`freelancer_id`),
  KEY `month_year` (`month_year`),
  KEY `tier_achieved` (`tier_achieved`),
  FOREIGN KEY (`freelancer_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 7. Create table untuk leaderboard & achievements
CREATE TABLE IF NOT EXISTS `freelancer_achievements` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `freelancer_id` INT(11) NOT NULL,
  `achievement_type` VARCHAR(50) NOT NULL COMMENT 'top_performer, tier_upgrade, milestone_orders, etc',
  `achievement_name` VARCHAR(255) NOT NULL,
  `achievement_description` TEXT DEFAULT NULL,
  `badge_icon` VARCHAR(100) DEFAULT NULL,
  `bonus_amount` DECIMAL(12,2) DEFAULT 0.00,
  `awarded_at` DATETIME NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `freelancer_id` (`freelancer_id`),
  KEY `achievement_type` (`achievement_type`),
  KEY `awarded_at` (`awarded_at`),
  FOREIGN KEY (`freelancer_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 8. Create table untuk marketing materials downloads tracking
CREATE TABLE IF NOT EXISTS `freelancer_material_downloads` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `freelancer_id` INT(11) NOT NULL,
  `material_type` VARCHAR(50) NOT NULL COMMENT 'price_list, brochure, template, etc',
  `material_name` VARCHAR(255) NOT NULL,
  `file_path` VARCHAR(500) DEFAULT NULL,
  `download_count` INT(11) NOT NULL DEFAULT 1,
  `last_downloaded_at` DATETIME NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `freelancer_id` (`freelancer_id`),
  KEY `material_type` (`material_type`),
  FOREIGN KEY (`freelancer_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 9. Update orders table untuk better referral tracking
ALTER TABLE `orders`
  ADD COLUMN `freelancer_id` INT(11) DEFAULT NULL AFTER `referral_code` COMMENT 'Freelancer who referred this order',
  ADD CONSTRAINT `fk_order_freelancer` FOREIGN KEY (`freelancer_id`) REFERENCES `users`(`id`) ON DELETE SET NULL;

CREATE INDEX `idx_order_freelancer` ON `orders`(`freelancer_id`);

-- 10. Insert default settings untuk freelancer system
INSERT INTO `settings` (`setting_key`, `setting_value`, `setting_type`, `category`, `description`) VALUES
('freelancer_tier_1_rate', '30.00', 'number', 'freelancer', 'Commission rate for Tier 1 (0-10 orders)'),
('freelancer_tier_2_rate', '40.00', 'number', 'freelancer', 'Commission rate for Tier 2 (10-25 orders)'),
('freelancer_tier_3_rate', '50.00', 'number', 'freelancer', 'Commission rate for Tier 3 (25-50 orders)'),
('freelancer_tier_max_rate', '55.00', 'number', 'freelancer', 'Commission rate for Tier MAX (75+ orders)'),
('freelancer_tier_1_target', '10', 'number', 'freelancer', 'Monthly order target for Tier 1'),
('freelancer_tier_2_target', '25', 'number', 'freelancer', 'Monthly order target for Tier 2'),
('freelancer_tier_3_target', '50', 'number', 'freelancer', 'Monthly order target for Tier 3'),
('freelancer_tier_max_target', '75', 'number', 'freelancer', 'Monthly order target for Tier MAX'),
('freelancer_min_withdrawal', '500000', 'number', 'freelancer', 'Minimum withdrawal amount (Rp)'),
('freelancer_auto_tier_enabled', '1', 'boolean', 'freelancer', 'Enable automatic tier adjustment'),
('freelancer_welcome_bonus', '0', 'number', 'freelancer', 'Welcome bonus for new freelancers'),
('freelancer_referral_cookie_days', '90', 'number', 'freelancer', 'Referral cookie lifetime (days)')
ON DUPLICATE KEY UPDATE `setting_value` = VALUES(`setting_value`);

-- 11. Create view untuk freelancer dashboard stats (untuk performance)
CREATE OR REPLACE VIEW `vw_freelancer_dashboard_stats` AS
SELECT
  f.user_id,
  f.tier_level,
  f.commission_rate,
  f.total_orders,
  f.total_earnings,
  f.available_balance,
  f.withdrawn_balance,
  COUNT(DISTINCT fr.referred_user_id) as total_referrals,
  COUNT(DISTINCT CASE WHEN o.status = 'completed' THEN o.id END) as completed_orders,
  COUNT(DISTINCT CASE WHEN o.status IN ('pending','confirmed','in_progress') THEN o.id END) as active_orders,
  SUM(CASE WHEN MONTH(o.created_at) = MONTH(CURRENT_DATE()) AND YEAR(o.created_at) = YEAR(CURRENT_DATE()) THEN 1 ELSE 0 END) as orders_this_month,
  SUM(CASE WHEN MONTH(fc.created_at) = MONTH(CURRENT_DATE()) AND YEAR(fc.created_at) = YEAR(CURRENT_DATE()) THEN fc.commission_amount ELSE 0 END) as commission_this_month,
  MAX(o.created_at) as last_order_date
FROM freelancer_profiles f
LEFT JOIN freelancer_referrals fr ON f.user_id = fr.freelancer_id
LEFT JOIN orders o ON o.freelancer_id = f.user_id AND o.payment_status = 'paid'
LEFT JOIN freelancer_commissions fc ON fc.freelancer_id = f.user_id
GROUP BY f.user_id, f.tier_level, f.commission_rate, f.total_orders, f.total_earnings, f.available_balance, f.withdrawn_balance;

-- 12. Create view untuk leaderboard
CREATE OR REPLACE VIEW `vw_freelancer_leaderboard` AS
SELECT
  u.id as freelancer_id,
  u.name as freelancer_name,
  u.avatar,
  fp.tier_level,
  fp.commission_rate,
  COUNT(DISTINCT o.id) as total_orders,
  SUM(o.final_amount) as total_revenue,
  SUM(fc.commission_amount) as total_commission,
  COUNT(DISTINCT fr.referred_user_id) as total_referrals,
  RANK() OVER (ORDER BY COUNT(DISTINCT o.id) DESC) as rank_by_orders,
  RANK() OVER (ORDER BY SUM(fc.commission_amount) DESC) as rank_by_commission
FROM users u
INNER JOIN freelancer_profiles fp ON u.id = fp.user_id
LEFT JOIN orders o ON o.freelancer_id = u.id AND o.payment_status = 'paid'
LEFT JOIN freelancer_commissions fc ON fc.freelancer_id = u.id
LEFT JOIN freelancer_referrals fr ON fr.freelancer_id = u.id
WHERE u.role = 'freelancer' AND fp.status = 'active'
GROUP BY u.id, u.name, u.avatar, fp.tier_level, fp.commission_rate
ORDER BY total_orders DESC;

-- 13. Add indexes untuk performance optimization
CREATE INDEX `idx_orders_month_year` ON `orders`(YEAR(`created_at`), MONTH(`created_at`));
CREATE INDEX `idx_commissions_status` ON `freelancer_commissions`(`status`, `freelancer_id`);
CREATE INDEX `idx_referrals_conversion` ON `freelancer_referrals`(`freelancer_id`, `conversion_status`);

-- ============================================
-- END OF SCHEMA UPDATES
-- ============================================
