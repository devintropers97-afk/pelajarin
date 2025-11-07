-- ========================================
-- SITUNEO DIGITAL - Default Settings
-- ========================================

INSERT INTO `settings` (`setting_key`, `setting_value`, `setting_type`, `description`) VALUES
-- Company Information
('company_name', 'SITUNEO DIGITAL', 'string', 'Company name'),
('company_tagline', 'Digital Harmony for a Modern World', 'string', 'Company tagline'),
('company_nib', '20250-9261-4570-4515-5453', 'string', 'NIB number'),
('company_npwp', '90.296.264.6-002.000', 'string', 'NPWP number'),
('company_director', 'Devin Prasetyo Hermawan', 'string', 'Director name'),
('company_email', 'vins@situneo.my.id', 'string', 'Main email'),
('company_email_support', 'support@situneo.my.id', 'string', 'Support email'),
('company_phone', '021-8880-7229', 'string', 'Phone number'),
('company_whatsapp', '6283173868915', 'string', 'WhatsApp number (with country code)'),
('company_address', 'Jl. Bekasi Timur IX Dalam No. 27, RT 002/RW 003, Kel. Rawa Bunga, Kec. Jatinegara, Jakarta Timur 13450, DKI Jakarta', 'string', 'Full address'),
('company_website', 'https://situneo.my.id', 'string', 'Website URL'),

-- Social Media
('social_instagram', 'https://instagram.com/situneodigital', 'string', 'Instagram URL'),
('social_facebook', 'https://facebook.com/situneodigital', 'string', 'Facebook URL'),
('social_linkedin', 'https://linkedin.com/company/situneodigital', 'string', 'LinkedIn URL'),
('social_tiktok', 'https://tiktok.com/@situneodigital', 'string', 'TikTok URL'),

-- Business Statistics
('stat_clients', '500', 'integer', 'Total clients served'),
('stat_projects', '1200', 'integer', 'Total projects completed'),
('stat_satisfaction', '98', 'integer', 'Satisfaction rate percentage'),
('stat_rating', '4.9', 'string', 'Average rating (out of 5)'),

-- Pricing
('base_price_per_page', '350000', 'integer', 'Base price per page (Rp)'),
('demo_free_hours', '24', 'integer', 'Free demo delivery time (hours)'),
('min_withdrawal', '50000', 'integer', 'Minimum withdrawal amount for freelancers'),

-- Email Configuration
('email_from_name', 'SITUNEO DIGITAL', 'string', 'Email sender name'),
('email_from_address', 'noreply@situneo.my.id', 'string', 'Email sender address'),

-- Payment Configuration
('payment_tax_rate', '0', 'integer', 'Tax rate percentage'),
('payment_currency', 'IDR', 'string', 'Currency code'),

-- reCAPTCHA
('recaptcha_site_key', '', 'string', 'reCAPTCHA v3 site key'),
('recaptcha_secret_key', '', 'string', 'reCAPTCHA v3 secret key'),
('recaptcha_enabled', '1', 'boolean', 'Enable reCAPTCHA'),

-- System Settings
('site_maintenance', '0', 'boolean', 'Maintenance mode'),
('registration_enabled', '1', 'boolean', 'Allow new registrations'),
('demo_request_enabled', '1', 'boolean', 'Allow demo requests'),
('multi_language', '1', 'boolean', 'Enable multi-language'),
('default_language', 'id', 'string', 'Default language (id/en)'),

-- SEO
('site_meta_title', 'SITUNEO DIGITAL - Website Rp 350rb/Halaman | FREE DEMO 24 JAM', 'string', 'Default meta title'),
('site_meta_description', 'Bikin website cuma Rp 350rb/halaman! FREE DEMO 24 JAM - Lihat dulu hasilnya, bayar kalau cocok. NIB Resmi. 500+ customer puas!', 'text', 'Default meta description'),
('site_meta_keywords', 'jasa website murah, bikin website 350rb, website jakarta, toko online murah, website profesional, situneo digital', 'text', 'Default meta keywords'),

-- Analytics
('google_analytics_id', '', 'string', 'Google Analytics ID'),
('facebook_pixel_id', '', 'string', 'Facebook Pixel ID');
