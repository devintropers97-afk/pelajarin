<?php
/**
 * SITUNEO DIGITAL - Application Configuration
 * Settings umum aplikasi
 */

// Site Information
define('SITE_NAME', 'SITUNEO DIGITAL');
define('SITE_TAGLINE', 'Digital Harmony for a Modern World');
define('SITE_URL', 'https://situneo.my.id');
define('SITE_EMAIL', 'vins@situneo.my.id');
define('SITE_PHONE', '+62 831-7386-8915');
define('SITE_WHATSAPP', '6283173868915');

// Company Information
define('COMPANY_NAME', 'SITUNEO DIGITAL');
define('COMPANY_NIB', '20250926145704515453');
define('COMPANY_NPWP', '90.296.264.6-002.000');
define('COMPANY_DIRECTOR', 'Devin Prasetyo Hermawan');
define('COMPANY_ADDRESS', 'Jl. Bekasi Timur IX Dalam No. 27, RT 002/RW 003, Kel. Rawa Bunga, Kec. Jatinegara, Jakarta Timur 13450');

// Social Media
define('SOCIAL_INSTAGRAM', 'https://instagram.com/situneodigital');
define('SOCIAL_FACEBOOK', 'https://facebook.com/situneodigital');
define('SOCIAL_LINKEDIN', 'https://linkedin.com/company/situneodigital');
define('SOCIAL_TIKTOK', 'https://tiktok.com/@situneodigital');

// Bank Account
define('BANK_NAME', 'BCA');
define('BANK_ACCOUNT_NUMBER', '2750424018');
define('BANK_ACCOUNT_NAME', 'Devin Prasetyo Hermawan');

// Timezone
date_default_timezone_set('Asia/Jakarta');
define('TIMEZONE', 'Asia/Jakarta');

// Paths
define('BASE_PATH', dirname(__DIR__));
define('UPLOAD_PATH', BASE_PATH . '/uploads/');
define('ASSETS_PATH', BASE_PATH . '/assets/');

// URLs
define('BASE_URL', SITE_URL);
define('ASSETS_URL', BASE_URL . '/assets');
define('UPLOADS_URL', BASE_URL . '/uploads');

// File Upload Settings
define('MAX_UPLOAD_SIZE', 5 * 1024 * 1024); // 5MB
define('ALLOWED_IMAGE_TYPES', ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp']);
define('ALLOWED_DOCUMENT_TYPES', ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']);

// Session Settings
define('SESSION_LIFETIME', 7200); // 2 hours
define('SESSION_NAME', 'SITUNEO_SESSION');

// Security
define('CSRF_TOKEN_NAME', 'csrf_token');
define('PASSWORD_MIN_LENGTH', 8);
define('MAX_LOGIN_ATTEMPTS', 5);
define('LOGIN_LOCKOUT_TIME', 900); // 15 minutes

// Pagination
define('ITEMS_PER_PAGE', 20);
define('ADMIN_ITEMS_PER_PAGE', 50);

// Freelancer Tier System
define('TIER_1_MIN_ORDERS', 0);
define('TIER_1_MAX_ORDERS', 10);
define('TIER_1_COMMISSION', 30);

define('TIER_2_MIN_ORDERS', 10);
define('TIER_2_MAX_ORDERS', 25);
define('TIER_2_COMMISSION', 40);

define('TIER_3_MIN_ORDERS', 50);
define('TIER_3_COMMISSION', 50);
define('TIER_3_BONUS', 5);

// Withdrawal Settings
define('MIN_WITHDRAWAL_AMOUNT', 50000); // Rp 50,000

// Calculator Discount
define('DISCOUNT_3_SERVICES', 10); // 10% for 3+ services
define('DISCOUNT_5_SERVICES', 15); // 15% for 5+ services

// Email Settings (akan di-override oleh mail.php)
define('SMTP_ENABLED', true);

// Demo Mode (set false untuk production)
define('DEMO_MODE', true);

// Error Reporting
if (DEMO_MODE) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

// Start session if not started
if (session_status() === PHP_SESSION_NONE) {
    session_name(SESSION_NAME);
    session_start();
}
