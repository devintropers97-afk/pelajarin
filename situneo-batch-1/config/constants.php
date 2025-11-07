<?php
/**
 * ========================================
 * SITUNEO DIGITAL - Constants
 * System-wide constants
 * ========================================
 */

// Site URLs
define('SITE_URL', 'https://situneo.my.id');
define('ADMIN_URL', SITE_URL . '/admin');
define('API_URL', SITE_URL . '/api');

// Directories
define('ROOT_DIR', dirname(__DIR__));
define('CONFIG_DIR', ROOT_DIR . '/config');
define('INCLUDES_DIR', ROOT_DIR . '/includes');
define('ASSETS_DIR', ROOT_DIR . '/assets');
define('UPLOADS_DIR', ROOT_DIR . '/uploads');

// Company Information
define('COMPANY_NAME', 'SITUNEO DIGITAL');
define('COMPANY_TAGLINE', 'Digital Harmony for a Modern World');
define('COMPANY_NIB', '20250-9261-4570-4515-5453');
define('COMPANY_NPWP', '90.296.264.6-002.000');
define('COMPANY_DIRECTOR', 'Devin Prasetyo Hermawan');

// Contact Information
define('COMPANY_EMAIL', 'vins@situneo.my.id');
define('COMPANY_SUPPORT_EMAIL', 'support@situneo.my.id');
define('COMPANY_PHONE', '021-8880-7229');
define('COMPANY_WHATSAPP', '6283173868915');
define('COMPANY_WHATSAPP_LINK', 'https://wa.me/6283173868915');
define('COMPANY_ADDRESS', 'Jl. Bekasi Timur IX Dalam No. 27, RT 002/RW 003, Kel. Rawa Bunga, Kec. Jatinegara, Jakarta Timur 13450, DKI Jakarta');

// Social Media
define('SOCIAL_INSTAGRAM', 'https://instagram.com/situneodigital');
define('SOCIAL_FACEBOOK', 'https://facebook.com/situneodigital');
define('SOCIAL_LINKEDIN', 'https://linkedin.com/company/situneodigital');
define('SOCIAL_TIKTOK', 'https://tiktok.com/@situneodigital');

// User Roles
define('ROLE_ADMIN', 'admin');
define('ROLE_CLIENT', 'client');
define('ROLE_FREELANCER', 'freelancer');

// Order Status
define('ORDER_PENDING', 'pending');
define('ORDER_AWAITING_PAYMENT', 'awaiting_payment');
define('ORDER_PAYMENT_UPLOADED', 'payment_uploaded');
define('ORDER_PAYMENT_VERIFIED', 'payment_verified');
define('ORDER_IN_PROGRESS', 'in_progress');
define('ORDER_REVISION', 'revision');
define('ORDER_COMPLETED', 'completed');
define('ORDER_CANCELLED', 'cancelled');
define('ORDER_REFUNDED', 'refunded');

// Payment Status
define('PAYMENT_UNPAID', 'unpaid');
define('PAYMENT_PENDING', 'pending');
define('PAYMENT_PAID', 'paid');
define('PAYMENT_PARTIAL', 'partial');
define('PAYMENT_REFUNDED', 'refunded');

// Freelancer Tiers
define('TIER_BRONZE', 'bronze');
define('TIER_SILVER', 'silver');
define('TIER_GOLD', 'gold');
define('TIER_PLATINUM', 'platinum');
define('TIER_DIAMOND', 'diamond');

// Pricing
define('BASE_PRICE_PER_PAGE', 350000);
define('MIN_WITHDRAWAL', 50000);

// Security
define('SESSION_TIMEOUT', 7200); // 2 hours in seconds
define('MAX_LOGIN_ATTEMPTS', 5);
define('LOGIN_ATTEMPT_TIMEOUT', 900); // 15 minutes

// Email Configuration
define('SMTP_HOST', 'mail.situneo.my.id');
define('SMTP_PORT', 587);
define('SMTP_USERNAME', COMPANY_EMAIL);
define('SMTP_PASSWORD', ''); // Set in production
define('SMTP_ENCRYPTION', 'tls');

// reCAPTCHA
define('RECAPTCHA_SITE_KEY', ''); // Set in production
define('RECAPTCHA_SECRET_KEY', ''); // Set in production

// Pagination
define('ITEMS_PER_PAGE', 20);

// File Upload
define('MAX_UPLOAD_SIZE', 10485760); // 10 MB in bytes
define('ALLOWED_IMAGE_TYPES', ['image/jpeg', 'image/png', 'image/gif', 'image/webp']);
define('ALLOWED_DOC_TYPES', ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']);

// Date/Time
define('TIMEZONE', 'Asia/Jakarta');
date_default_timezone_set(TIMEZONE);

// Language
define('DEFAULT_LANGUAGE', 'id');
define('SUPPORTED_LANGUAGES', ['id', 'en']);

// Demo
define('DEMO_URL_BASE', SITE_URL . '/demo/');
