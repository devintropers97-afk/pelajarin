-- ========================================
-- SITUNEO DIGITAL - COMPLETE DATABASE SCHEMA
-- Version: 1.0 - Batch 1
-- Total Tables: 70+
-- NIB: 20250-9261-4570-4515-5453
-- ========================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- ========================================
-- SECTION 1: CORE SYSTEM TABLES (10)
-- ========================================

-- 1. users table (main authentication)
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','client','freelancer') NOT NULL DEFAULT 'client',
  `status` enum('active','inactive','suspended','pending_verification') NOT NULL DEFAULT 'pending_verification',
  `email_verified` tinyint(1) NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `last_login_ip` varchar(45) DEFAULT NULL,
  `login_count` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `role` (`role`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 2. user_profiles table
CREATE TABLE `user_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `whatsapp` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `province` varchar(100) DEFAULT NULL,
  `postal_code` varchar(10) DEFAULT NULL,
  `country` varchar(100) DEFAULT 'Indonesia',
  `company_name` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 3. user_sessions table
CREATE TABLE `user_sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `session_token` varchar(255) NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `expires_at` timestamp NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `session_token` (`session_token`),
  KEY `user_id` (`user_id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 4. password_resets table
CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires_at` timestamp NOT NULL,
  `used` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`),
  KEY `user_id` (`user_id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 5. email_verifications table
CREATE TABLE `email_verifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires_at` timestamp NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token` (`token`),
  KEY `user_id` (`user_id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 6. activity_logs table
CREATE TABLE `activity_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `action` (`action`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 7. login_attempts table
CREATE TABLE `login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `success` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `email` (`email`),
  KEY `ip_address` (`ip_address`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 8. settings table
CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(255) NOT NULL,
  `setting_value` text DEFAULT NULL,
  `setting_type` enum('string','integer','boolean','json','text') NOT NULL DEFAULT 'string',
  `description` text DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `setting_key` (`setting_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 9. user_roles table (future expansion for granular permissions)
CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(100) NOT NULL,
  `role_slug` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `role_slug` (`role_slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 10. user_permissions table
CREATE TABLE `user_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `permission` varchar(255) NOT NULL,
  `granted` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- SECTION 2: SERVICES & PRODUCTS (15 TABLES)
-- ========================================

-- 11. service_templates (10 base templates)
CREATE TABLE `service_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `template_name` varchar(255) NOT NULL,
  `template_slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `base_price_setup` decimal(15,2) NOT NULL DEFAULT 0.00,
  `base_price_monthly` decimal(15,2) NOT NULL DEFAULT 0.00,
  `features` longtext DEFAULT NULL COMMENT 'JSON array of features',
  `tech_stack` longtext DEFAULT NULL COMMENT 'JSON array of technologies',
  `delivery_days` int(11) NOT NULL DEFAULT 7,
  `icon` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `template_slug` (`template_slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 12. business_categories (53+ categories)
CREATE TABLE `business_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `category_slug` varchar(255) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `category_slug` (`category_slug`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 13. business_types (1500+ generated combinations)
CREATE TABLE `business_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `business_name` varchar(255) NOT NULL,
  `business_slug` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `keywords` text DEFAULT NULL COMMENT 'Comma-separated keywords for search',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `business_slug` (`business_slug`),
  KEY `category_id` (`category_id`),
  FULLTEXT KEY `search` (`business_name`, `description`, `keywords`),
  FOREIGN KEY (`category_id`) REFERENCES `business_categories`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 14. template_recommendations (mapping template to business type)
CREATE TABLE `template_recommendations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `business_type_id` int(11) NOT NULL,
  `template_id` int(11) NOT NULL,
  `priority` int(11) NOT NULL DEFAULT 1 COMMENT '1=primary, 2=secondary, 3=tertiary',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `business_type_id` (`business_type_id`),
  KEY `template_id` (`template_id`),
  FOREIGN KEY (`business_type_id`) REFERENCES `business_types`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`template_id`) REFERENCES `service_templates`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 15. industry_features (specific features per industry)
CREATE TABLE `industry_features` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `business_type_id` int(11) NOT NULL,
  `feature_name` varchar(255) NOT NULL,
  `feature_description` text DEFAULT NULL,
  `price_modifier` decimal(10,2) NOT NULL DEFAULT 0.00 COMMENT 'Additional cost for this feature',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `business_type_id` (`business_type_id`),
  FOREIGN KEY (`business_type_id`) REFERENCES `business_types`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 16. generated_services (1500+ auto-generated services)
CREATE TABLE `generated_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_name` varchar(255) NOT NULL,
  `service_slug` varchar(255) NOT NULL,
  `business_type_id` int(11) NOT NULL,
  `template_id` int(11) NOT NULL,
  `short_description` text DEFAULT NULL,
  `full_description` longtext DEFAULT NULL,
  `what_is_it` text DEFAULT NULL COMMENT 'Apa itu? (bahasa awam)',
  `for_whom` text DEFAULT NULL COMMENT 'Untuk siapa?',
  `benefits` longtext DEFAULT NULL COMMENT 'JSON array of benefits',
  `deliverables` longtext DEFAULT NULL COMMENT 'JSON array of what customer gets',
  `use_cases` longtext DEFAULT NULL COMMENT 'JSON array of example uses',
  `price_setup` decimal(15,2) NOT NULL,
  `price_monthly` decimal(15,2) NOT NULL,
  `delivery_days` int(11) NOT NULL DEFAULT 7,
  `features` longtext DEFAULT NULL COMMENT 'JSON array of features',
  `image` varchar(255) DEFAULT NULL,
  `gallery` longtext DEFAULT NULL COMMENT 'JSON array of images',
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `orders` int(11) NOT NULL DEFAULT 0,
  `rating` decimal(3,2) NOT NULL DEFAULT 0.00,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `service_slug` (`service_slug`),
  KEY `business_type_id` (`business_type_id`),
  KEY `template_id` (`template_id`),
  FULLTEXT KEY `search` (`service_name`, `short_description`, `full_description`),
  FOREIGN KEY (`business_type_id`) REFERENCES `business_types`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`template_id`) REFERENCES `service_templates`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 17. service_keywords (for advanced search)
CREATE TABLE `service_keywords` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `weight` int(11) NOT NULL DEFAULT 1 COMMENT 'Search priority weight',
  PRIMARY KEY (`id`),
  KEY `service_id` (`service_id`),
  KEY `keyword` (`keyword`),
  FOREIGN KEY (`service_id`) REFERENCES `generated_services`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 18. service_addons
CREATE TABLE `service_addons` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `addon_name` varchar(255) NOT NULL,
  `addon_slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `price_setup` decimal(15,2) NOT NULL DEFAULT 0.00,
  `price_monthly` decimal(15,2) NOT NULL DEFAULT 0.00,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `addon_slug` (`addon_slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 19. service_faqs
CREATE TABLE `service_faqs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT NULL,
  `question` text NOT NULL,
  `answer` text NOT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `service_id` (`service_id`),
  FOREIGN KEY (`service_id`) REFERENCES `generated_services`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 20. service_reviews
CREATE TABLE `service_reviews` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` >= 1 AND `rating` <= 5),
  `review` text DEFAULT NULL,
  `verified_purchase` tinyint(1) NOT NULL DEFAULT 0,
  `helpful_count` int(11) NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `service_id` (`service_id`),
  KEY `user_id` (`user_id`),
  FOREIGN KEY (`service_id`) REFERENCES `generated_services`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 21. pricing_tiers (untuk bulk discount)
CREATE TABLE `pricing_tiers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tier_name` varchar(255) NOT NULL,
  `min_pages` int(11) NOT NULL,
  `max_pages` int(11) DEFAULT NULL,
  `discount_percentage` decimal(5,2) NOT NULL DEFAULT 0.00,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 22. discounts
CREATE TABLE `discounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `type` enum('percentage','fixed') NOT NULL,
  `value` decimal(15,2) NOT NULL,
  `min_purchase` decimal(15,2) NOT NULL DEFAULT 0.00,
  `max_discount` decimal(15,2) DEFAULT NULL,
  `usage_limit` int(11) DEFAULT NULL,
  `used_count` int(11) NOT NULL DEFAULT 0,
  `starts_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 23. packages (bundling services)
CREATE TABLE `packages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `package_name` varchar(255) NOT NULL,
  `package_slug` varchar(255) NOT NULL,
  `tagline` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price_original` decimal(15,2) NOT NULL,
  `price_promo` decimal(15,2) NOT NULL,
  `savings` decimal(15,2) GENERATED ALWAYS AS (`price_original` - `price_promo`) STORED,
  `popular` tinyint(1) NOT NULL DEFAULT 0,
  `features` longtext DEFAULT NULL COMMENT 'JSON array of features',
  `image` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `package_slug` (`package_slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 24. package_items (services dalam package)
CREATE TABLE `package_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `package_id` int(11) NOT NULL,
  `service_id` int(11) DEFAULT NULL,
  `item_name` varchar(255) DEFAULT NULL COMMENT 'For custom items not in services',
  `quantity` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `package_id` (`package_id`),
  KEY `service_id` (`service_id`),
  FOREIGN KEY (`package_id`) REFERENCES `packages`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`service_id`) REFERENCES `generated_services`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 25. bundles (custom combination by client)
CREATE TABLE `bundles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `bundle_name` varchar(255) DEFAULT NULL,
  `total_price` decimal(15,2) NOT NULL,
  `discount_applied` decimal(15,2) NOT NULL DEFAULT 0.00,
  `final_price` decimal(15,2) NOT NULL,
  `saved_for_later` tinyint(1) NOT NULL DEFAULT 1,
  `converted_to_order` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- SECTION 3: ORDERS & TRANSACTIONS (12 TABLES)
-- ========================================

-- 26. orders
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_number` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `freelancer_id` int(11) DEFAULT NULL COMMENT 'Assigned freelancer',
  `order_type` enum('service','package','custom') NOT NULL DEFAULT 'service',
  `status` enum('pending','awaiting_payment','payment_uploaded','payment_verified','in_progress','revision','completed','cancelled','refunded') NOT NULL DEFAULT 'pending',
  `payment_status` enum('unpaid','pending','paid','partial','refunded') NOT NULL DEFAULT 'unpaid',
  `subtotal` decimal(15,2) NOT NULL,
  `discount_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tax_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total_amount` decimal(15,2) NOT NULL,
  `paid_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `notes` text DEFAULT NULL,
  `admin_notes` text DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_number` (`order_number`),
  KEY `user_id` (`user_id`),
  KEY `freelancer_id` (`freelancer_id`),
  KEY `status` (`status`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`freelancer_id`) REFERENCES `users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 27. order_items
CREATE TABLE `order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `service_id` int(11) DEFAULT NULL,
  `package_id` int(11) DEFAULT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_description` text DEFAULT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price_per_unit` decimal(15,2) NOT NULL,
  `subtotal` decimal(15,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `service_id` (`service_id`),
  KEY `package_id` (`package_id`),
  FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`service_id`) REFERENCES `generated_services`(`id`) ON DELETE SET NULL,
  FOREIGN KEY (`package_id`) REFERENCES `packages`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 28. order_status_history
CREATE TABLE `order_status_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `old_status` varchar(50) DEFAULT NULL,
  `new_status` varchar(50) NOT NULL,
  `changed_by` int(11) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `changed_by` (`changed_by`),
  FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`changed_by`) REFERENCES `users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 29. order_notes
CREATE TABLE `order_notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `note` text NOT NULL,
  `is_internal` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Internal notes visible to admin only',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `user_id` (`user_id`),
  FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 30. order_files (deliverables & attachments)
CREATE TABLE `order_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `uploaded_by` int(11) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_type` varchar(50) DEFAULT NULL,
  `file_size` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_deliverable` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `order_id` (`order_id`),
  KEY `uploaded_by` (`uploaded_by`),
  FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`uploaded_by`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 31. invoices
CREATE TABLE `invoices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_number` varchar(50) NOT NULL,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `invoice_date` date NOT NULL,
  `due_date` date DEFAULT NULL,
  `subtotal` decimal(15,2) NOT NULL,
  `tax_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `discount_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total_amount` decimal(15,2) NOT NULL,
  `paid_amount` decimal(15,2) NOT NULL DEFAULT 0.00,
  `status` enum('draft','sent','paid','partial','overdue','cancelled') NOT NULL DEFAULT 'draft',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `invoice_number` (`invoice_number`),
  KEY `order_id` (`order_id`),
  KEY `user_id` (`user_id`),
  FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 32. invoice_items
CREATE TABLE `invoice_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `price_per_unit` decimal(15,2) NOT NULL,
  `subtotal` decimal(15,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice_id` (`invoice_id`),
  FOREIGN KEY (`invoice_id`) REFERENCES `invoices`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 33. payments
CREATE TABLE `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_number` varchar(50) NOT NULL,
  `order_id` int(11) NOT NULL,
  `invoice_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `payment_method` enum('manual_transfer','midtrans','xendit','cash','other') NOT NULL DEFAULT 'manual_transfer',
  `amount` decimal(15,2) NOT NULL,
  `status` enum('pending','verified','rejected','refunded') NOT NULL DEFAULT 'pending',
  `transaction_id` varchar(255) DEFAULT NULL COMMENT 'Payment gateway transaction ID',
  `proof_image` varchar(255) DEFAULT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `account_name` varchar(255) DEFAULT NULL,
  `transfer_date` date DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `admin_notes` text DEFAULT NULL,
  `verified_by` int(11) DEFAULT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `payment_number` (`payment_number`),
  KEY `order_id` (`order_id`),
  KEY `invoice_id` (`invoice_id`),
  KEY `user_id` (`user_id`),
  KEY `verified_by` (`verified_by`),
  FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`invoice_id`) REFERENCES `invoices`(`id`) ON DELETE SET NULL,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`verified_by`) REFERENCES `users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 34. payment_methods (admin configured)
CREATE TABLE `payment_methods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `method_name` varchar(255) NOT NULL,
  `method_type` enum('bank_transfer','ewallet','payment_gateway','cash') NOT NULL,
  `bank_name` varchar(100) DEFAULT NULL,
  `account_number` varchar(50) DEFAULT NULL,
  `account_name` varchar(255) DEFAULT NULL,
  `instructions` text DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `order` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 35. refunds
CREATE TABLE `refunds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `refund_number` varchar(50) NOT NULL,
  `order_id` int(11) NOT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `reason` text NOT NULL,
  `status` enum('requested','approved','rejected','processed') NOT NULL DEFAULT 'requested',
  `processed_by` int(11) DEFAULT NULL,
  `processed_at` timestamp NULL DEFAULT NULL,
  `admin_notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `refund_number` (`refund_number`),
  KEY `order_id` (`order_id`),
  KEY `payment_id` (`payment_id`),
  KEY `user_id` (`user_id`),
  FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`payment_id`) REFERENCES `payments`(`id`) ON DELETE SET NULL,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 36. transactions (all financial transactions log)
CREATE TABLE `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transaction_type` enum('payment','refund','commission','withdrawal','adjustment') NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `payment_id` int(11) DEFAULT NULL,
  `amount` decimal(15,2) NOT NULL,
  `balance_before` decimal(15,2) NOT NULL DEFAULT 0.00,
  `balance_after` decimal(15,2) NOT NULL DEFAULT 0.00,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `order_id` (`order_id`),
  KEY `payment_id` (`payment_id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`) ON DELETE SET NULL,
  FOREIGN KEY (`payment_id`) REFERENCES `payments`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- SECTION 4: DEMO REQUEST SYSTEM (6 TABLES)
-- ========================================

-- 37. demo_requests (main demo request)
CREATE TABLE `demo_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `request_number` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` enum('pending','approved','rejected','in_progress','completed','delivered') NOT NULL DEFAULT 'pending',
  `priority` enum('low','normal','high','urgent') NOT NULL DEFAULT 'normal',
  `assigned_to` int(11) DEFAULT NULL COMMENT 'Admin/freelancer assigned',
  `demo_url` varchar(255) DEFAULT NULL COMMENT 'URL to generated demo',
  `approved_by` int(11) DEFAULT NULL,
  `approved_at` timestamp NULL DEFAULT NULL,
  `delivered_at` timestamp NULL DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `admin_notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `request_number` (`request_number`),
  KEY `user_id` (`user_id`),
  KEY `assigned_to` (`assigned_to`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`assigned_to`) REFERENCES `users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 38. demo_request_business (business info - Part 1)
CREATE TABLE `demo_request_business` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `demo_request_id` int(11) NOT NULL,
  `business_name` varchar(255) NOT NULL,
  `business_description` text DEFAULT NULL,
  `business_purpose` text DEFAULT NULL COMMENT 'Tujuan pembuatan website',
  `business_category_id` int(11) DEFAULT NULL,
  `business_type_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `demo_request_id` (`demo_request_id`),
  KEY `business_category_id` (`business_category_id`),
  KEY `business_type_id` (`business_type_id`),
  FOREIGN KEY (`demo_request_id`) REFERENCES `demo_requests`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`business_category_id`) REFERENCES `business_categories`(`id`) ON DELETE SET NULL,
  FOREIGN KEY (`business_type_id`) REFERENCES `business_types`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 39. demo_request_design (design preferences - Part 2)
CREATE TABLE `demo_request_design` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `demo_request_id` int(11) NOT NULL,
  `color_preference` varchar(255) DEFAULT NULL COMMENT 'Warna utama yang diinginkan',
  `style_preference` varchar(255) DEFAULT NULL COMMENT 'modern, simpel, elegan, ceria, islami',
  `reference_website` varchar(255) DEFAULT NULL COMMENT 'Contoh website yang disukai',
  `logo_file` varchar(255) DEFAULT NULL,
  `images` longtext DEFAULT NULL COMMENT 'JSON array of uploaded images',
  PRIMARY KEY (`id`),
  UNIQUE KEY `demo_request_id` (`demo_request_id`),
  FOREIGN KEY (`demo_request_id`) REFERENCES `demo_requests`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 40. demo_request_features (features & pages - Part 3 & 4)
CREATE TABLE `demo_request_features` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `demo_request_id` int(11) NOT NULL,
  `pages` text DEFAULT NULL COMMENT 'Halaman yang diinginkan (Home, About, dll)',
  `page_content` longtext DEFAULT NULL COMMENT 'Isi tiap halaman',
  `features` longtext DEFAULT NULL COMMENT 'JSON array of features (WA, form, galeri, login, blog, dll)',
  `multi_language` enum('yes','no','delegate') NOT NULL DEFAULT 'delegate',
  PRIMARY KEY (`id`),
  UNIQUE KEY `demo_request_id` (`demo_request_id`),
  FOREIGN KEY (`demo_request_id`) REFERENCES `demo_requests`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 41. demo_request_content (content & contact - Part 5 & 6)
CREATE TABLE `demo_request_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `demo_request_id` int(11) NOT NULL,
  `opening_text` text DEFAULT NULL COMMENT 'Kalimat pembuka',
  `whatsapp` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `social_media` longtext DEFAULT NULL COMMENT 'JSON object of social media links',
  `seo_keywords` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `demo_request_id` (`demo_request_id`),
  FOREIGN KEY (`demo_request_id`) REFERENCES `demo_requests`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 42. demo_request_timeline (timeline & notes - Part 7)
CREATE TABLE `demo_request_timeline` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `demo_request_id` int(11) NOT NULL,
  `expected_completion` date DEFAULT NULL,
  `additional_notes` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `demo_request_id` (`demo_request_id`),
  FOREIGN KEY (`demo_request_id`) REFERENCES `demo_requests`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- SECTION 5: FREELANCER/PARTNER (10 TABLES)
-- ========================================

-- 43. freelancer_profiles
CREATE TABLE `freelancer_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `tier` enum('bronze','silver','gold','platinum','diamond') NOT NULL DEFAULT 'bronze',
  `commission_rate` decimal(5,2) NOT NULL DEFAULT 30.00 COMMENT 'Current commission percentage',
  `total_earnings` decimal(15,2) NOT NULL DEFAULT 0.00,
  `available_balance` decimal(15,2) NOT NULL DEFAULT 0.00,
  `withdrawn_balance` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total_orders` int(11) NOT NULL DEFAULT 0,
  `completed_orders` int(11) NOT NULL DEFAULT 0,
  `monthly_orders` int(11) NOT NULL DEFAULT 0 COMMENT 'Reset setiap bulan',
  `rating` decimal(3,2) NOT NULL DEFAULT 0.00,
  `referral_code` varchar(50) DEFAULT NULL,
  `status` enum('active','inactive','suspended') NOT NULL DEFAULT 'active',
  `joined_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`),
  UNIQUE KEY `referral_code` (`referral_code`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 44. freelancer_tiers (tier configuration)
CREATE TABLE `freelancer_tiers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tier_name` enum('bronze','silver','gold','platinum','diamond') NOT NULL,
  `min_orders` int(11) NOT NULL COMMENT 'Minimum orders per month to maintain',
  `commission_rate` decimal(5,2) NOT NULL,
  `benefits` longtext DEFAULT NULL COMMENT 'JSON array of benefits',
  PRIMARY KEY (`id`),
  UNIQUE KEY `tier_name` (`tier_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 45. freelancer_tier_history
CREATE TABLE `freelancer_tier_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `freelancer_id` int(11) NOT NULL,
  `old_tier` varchar(20) DEFAULT NULL,
  `new_tier` varchar(20) NOT NULL,
  `reason` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `freelancer_id` (`freelancer_id`),
  FOREIGN KEY (`freelancer_id`) REFERENCES `freelancer_profiles`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 46. freelancer_referrals
CREATE TABLE `freelancer_referrals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `freelancer_id` int(11) NOT NULL,
  `referred_user_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL COMMENT 'First order from this referral',
  `status` enum('pending','converted','expired') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `freelancer_id` (`freelancer_id`),
  KEY `referred_user_id` (`referred_user_id`),
  KEY `order_id` (`order_id`),
  FOREIGN KEY (`freelancer_id`) REFERENCES `freelancer_profiles`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`referred_user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 47. freelancer_referral_clicks
CREATE TABLE `freelancer_referral_clicks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `freelancer_id` int(11) NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `referrer` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `freelancer_id` (`freelancer_id`),
  FOREIGN KEY (`freelancer_id`) REFERENCES `freelancer_profiles`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 48. freelancer_commissions
CREATE TABLE `freelancer_commissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `freelancer_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `order_amount` decimal(15,2) NOT NULL,
  `commission_rate` decimal(5,2) NOT NULL,
  `commission_amount` decimal(15,2) NOT NULL,
  `status` enum('pending','approved','paid') NOT NULL DEFAULT 'pending',
  `paid_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `freelancer_id` (`freelancer_id`),
  KEY `order_id` (`order_id`),
  FOREIGN KEY (`freelancer_id`) REFERENCES `freelancer_profiles`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 49. freelancer_withdrawals
CREATE TABLE `freelancer_withdrawals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `withdrawal_number` varchar(50) NOT NULL,
  `freelancer_id` int(11) NOT NULL,
  `amount` decimal(15,2) NOT NULL,
  `bank_account_id` int(11) NOT NULL,
  `status` enum('pending','approved','rejected','processed') NOT NULL DEFAULT 'pending',
  `processed_by` int(11) DEFAULT NULL,
  `processed_at` timestamp NULL DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `admin_notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `withdrawal_number` (`withdrawal_number`),
  KEY `freelancer_id` (`freelancer_id`),
  KEY `bank_account_id` (`bank_account_id`),
  FOREIGN KEY (`freelancer_id`) REFERENCES `freelancer_profiles`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 50. freelancer_bank_accounts
CREATE TABLE `freelancer_bank_accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `freelancer_id` int(11) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `account_number` varchar(50) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `is_primary` tinyint(1) NOT NULL DEFAULT 0,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `freelancer_id` (`freelancer_id`),
  FOREIGN KEY (`freelancer_id`) REFERENCES `freelancer_profiles`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 51. freelancer_earnings_summary (monthly summary)
CREATE TABLE `freelancer_earnings_summary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `freelancer_id` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `total_orders` int(11) NOT NULL DEFAULT 0,
  `total_sales` decimal(15,2) NOT NULL DEFAULT 0.00,
  `total_commission` decimal(15,2) NOT NULL DEFAULT 0.00,
  `tier` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `freelancer_month` (`freelancer_id`, `year`, `month`),
  FOREIGN KEY (`freelancer_id`) REFERENCES `freelancer_profiles`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 52. freelancer_marketing_materials
CREATE TABLE `freelancer_marketing_materials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `material_name` varchar(255) NOT NULL,
  `material_type` enum('banner','flyer','social_media','email_template','video') NOT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `download_count` int(11) NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- SECTION 6: CONTENT & PORTFOLIO (8 TABLES)
-- ========================================

-- 53. portfolios
CREATE TABLE `portfolios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `client_name` varchar(255) DEFAULT NULL,
  `project_year` year DEFAULT NULL,
  `description` text DEFAULT NULL,
  `features` longtext DEFAULT NULL COMMENT 'JSON array of features',
  `technologies` longtext DEFAULT NULL COMMENT 'JSON array of tech used',
  `url` varchar(255) DEFAULT NULL COMMENT 'Demo URL',
  `image` varchar(255) DEFAULT NULL,
  `gallery` longtext DEFAULT NULL COMMENT 'JSON array of images',
  `views` int(11) NOT NULL DEFAULT 0,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 54. portfolio_categories
CREATE TABLE `portfolio_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `category_slug` varchar(255) NOT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `category_slug` (`category_slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 55. portfolio_images
CREATE TABLE `portfolio_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `portfolio_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `portfolio_id` (`portfolio_id`),
  FOREIGN KEY (`portfolio_id`) REFERENCES `portfolios`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 56. portfolio_features
CREATE TABLE `portfolio_features` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `portfolio_id` int(11) NOT NULL,
  `feature_name` varchar(255) NOT NULL,
  `feature_description` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `portfolio_id` (`portfolio_id`),
  FOREIGN KEY (`portfolio_id`) REFERENCES `portfolios`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 57. blog_posts
CREATE TABLE `blog_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `author_id` int(11) NOT NULL,
  `excerpt` text DEFAULT NULL,
  `content` longtext NOT NULL,
  `featured_image` varchar(255) DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT 0,
  `status` enum('draft','published','archived') NOT NULL DEFAULT 'draft',
  `published_at` timestamp NULL DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `category_id` (`category_id`),
  KEY `author_id` (`author_id`),
  FULLTEXT KEY `search` (`title`, `content`),
  FOREIGN KEY (`author_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 58. blog_categories
CREATE TABLE `blog_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(255) NOT NULL,
  `category_slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `category_slug` (`category_slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 59. blog_tags
CREATE TABLE `blog_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag_name` varchar(100) NOT NULL,
  `tag_slug` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tag_slug` (`tag_slug`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 60. blog_comments
CREATE TABLE `blog_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `author_name` varchar(255) DEFAULT NULL,
  `author_email` varchar(255) DEFAULT NULL,
  `comment` text NOT NULL,
  `status` enum('pending','approved','spam','rejected') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `post_id` (`post_id`),
  KEY `user_id` (`user_id`),
  KEY `parent_id` (`parent_id`),
  FOREIGN KEY (`post_id`) REFERENCES `blog_posts`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- SECTION 7: SUPPORT & COMMUNICATION (5 TABLES)
-- ========================================

-- 61. support_tickets
CREATE TABLE `support_tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_number` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `category` enum('technical','billing','general','complaint','feature_request') NOT NULL DEFAULT 'general',
  `priority` enum('low','normal','high','urgent') NOT NULL DEFAULT 'normal',
  `status` enum('open','in_progress','waiting_response','resolved','closed') NOT NULL DEFAULT 'open',
  `assigned_to` int(11) DEFAULT NULL,
  `resolved_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ticket_number` (`ticket_number`),
  KEY `user_id` (`user_id`),
  KEY `order_id` (`order_id`),
  KEY `assigned_to` (`assigned_to`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`order_id`) REFERENCES `orders`(`id`) ON DELETE SET NULL,
  FOREIGN KEY (`assigned_to`) REFERENCES `users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 62. support_messages
CREATE TABLE `support_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `attachments` longtext DEFAULT NULL COMMENT 'JSON array of file paths',
  `is_internal` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `ticket_id` (`ticket_id`),
  KEY `user_id` (`user_id`),
  FOREIGN KEY (`ticket_id`) REFERENCES `support_tickets`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 63. notifications
CREATE TABLE `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL COMMENT 'order_update, payment_verified, etc',
  `title` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `link` varchar(255) DEFAULT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `read` tinyint(1) NOT NULL DEFAULT 0,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `type` (`type`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 64. notification_settings
CREATE TABLE `notification_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `notification_type` varchar(50) NOT NULL,
  `email_enabled` tinyint(1) NOT NULL DEFAULT 1,
  `push_enabled` tinyint(1) NOT NULL DEFAULT 1,
  `sms_enabled` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_type` (`user_id`, `notification_type`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 65. email_queue
CREATE TABLE `email_queue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `to_email` varchar(255) NOT NULL,
  `to_name` varchar(255) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `body` longtext NOT NULL,
  `template` varchar(100) DEFAULT NULL,
  `template_data` longtext DEFAULT NULL COMMENT 'JSON data for template',
  `status` enum('pending','sent','failed') NOT NULL DEFAULT 'pending',
  `attempts` int(11) NOT NULL DEFAULT 0,
  `last_attempt` timestamp NULL DEFAULT NULL,
  `error_message` text DEFAULT NULL,
  `sent_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- SECTION 8: ANALYTICS & TRACKING (5 TABLES)
-- ========================================

-- 66. page_views
CREATE TABLE `page_views` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `page_url` varchar(255) NOT NULL,
  `page_title` varchar(255) DEFAULT NULL,
  `referrer` varchar(255) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `page_url` (`page_url`),
  KEY `created_at` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 67. conversion_tracking
CREATE TABLE `conversion_tracking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `session_id` varchar(255) DEFAULT NULL,
  `conversion_type` varchar(50) NOT NULL COMMENT 'registration, demo_request, order, etc',
  `value` decimal(15,2) DEFAULT NULL,
  `source` varchar(100) DEFAULT NULL,
  `medium` varchar(100) DEFAULT NULL,
  `campaign` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `conversion_type` (`conversion_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 68. referral_sources
CREATE TABLE `referral_sources` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `source_name` varchar(255) NOT NULL,
  `source_url` varchar(255) DEFAULT NULL,
  `visits` int(11) NOT NULL DEFAULT 0,
  `conversions` int(11) NOT NULL DEFAULT 0,
  `last_visit` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `source_name` (`source_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 69. performance_metrics
CREATE TABLE `performance_metrics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `page_url` varchar(255) DEFAULT NULL,
  `load_time` decimal(10,3) DEFAULT NULL COMMENT 'Page load time in seconds',
  `queries_count` int(11) DEFAULT NULL,
  `memory_usage` int(11) DEFAULT NULL COMMENT 'MB',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `date` (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 70. testimonials
CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `full_name` varchar(255) NOT NULL,
  `company` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` >= 1 AND `rating` <= 5),
  `review` text NOT NULL,
  `order_number` varchar(50) DEFAULT NULL,
  `featured` tinyint(1) NOT NULL DEFAULT 0,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ========================================
-- INDEXES FOR OPTIMIZATION
-- ========================================

-- Additional composite indexes for common queries
ALTER TABLE `orders` ADD INDEX `user_status` (`user_id`, `status`);
ALTER TABLE `orders` ADD INDEX `created_status` (`created_at`, `status`);
ALTER TABLE `payments` ADD INDEX `status_created` (`status`, `created_at`);
ALTER TABLE `generated_services` ADD INDEX `active_featured` (`active`, `featured`);
ALTER TABLE `freelancer_commissions` ADD INDEX `freelancer_status` (`freelancer_id`, `status`);

COMMIT;

-- ========================================
-- END OF SCHEMA
-- Total Tables Created: 70
-- ========================================
