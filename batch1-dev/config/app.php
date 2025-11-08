<?php
/**
 * Application Configuration
 *
 * Central configuration for SITUNEO DIGITAL website
 * All settings here can be overridden by database settings table
 *
 * @package SITUNEO
 * @subpackage Config
 */

// Prevent direct access
defined('SITUNEO_ACCESS') or die('Direct access not permitted');

// =============================================================================
// SITE INFORMATION
// =============================================================================

define('SITE_NAME', 'SITUNEO DIGITAL');
define('SITE_TAGLINE', 'Website Era Baru - Solusi Digital Terlengkap');
define('SITE_DESCRIPTION', 'Digital agency terlengkap di Indonesia dengan 232+ layanan, dual pricing system (Beli Putus & Sewa Bulanan), dan 50 demo website production-ready');
define('SITE_URL', 'https://situneo.my.id');
define('SITE_EMAIL', 'admin@situneo.my.id');
define('SITE_PHONE', '+62 831-7386-8915');

// =============================================================================
// COMPANY INFORMATION
// =============================================================================

define('COMPANY_NAME', 'SITUNEO DIGITAL');
define('COMPANY_LEGAL_NAME', 'CV SITUNEO DIGITAL INDONESIA');
define('COMPANY_NIB', '20250926145704515453');
define('COMPANY_NPWP', '90.296.264.6-002.000');
define('COMPANY_ADDRESS', 'Indonesia');
define('COMPANY_EMAIL', 'admin@situneo.my.id');
define('COMPANY_PHONE', '+62 831-7386-8915');
define('COMPANY_WHATSAPP', '6283173868915');

// =============================================================================
// DUAL PRICING SYSTEM DEFAULTS
// =============================================================================

define('PRICING_SYSTEM_ENABLED', true);
define('PRICING_ONE_TIME_LABEL', 'Beli Putus');
define('PRICING_SUBSCRIPTION_LABEL', 'Sewa Bulanan');
define('PRICING_DEFAULT_CURRENCY', 'IDR');
define('PRICING_CURRENCY_SYMBOL', 'Rp');
define('PRICING_THOUSAND_SEPARATOR', '.');
define('PRICING_DECIMAL_SEPARATOR', ',');
define('PRICING_DECIMAL_PLACES', 0);

// =============================================================================
// FREELANCER COMMISSION SYSTEM
// =============================================================================

define('COMMISSION_ENABLED', true);
define('COMMISSION_PAYMENT_THRESHOLD', 50000);  // Minimum withdrawal 50K
define('COMMISSION_PAYMENT_STATUS_TRIGGER', 'paid');  // Commission available when order is 'paid'
define('COMMISSION_AUTO_APPROVE_WITHDRAWAL', false);  // Admin must approve

// Tier percentages (akan di-load dari database, ini fallback)
define('COMMISSION_TIER_1_PERCENT', 30.00);
define('COMMISSION_TIER_2_PERCENT', 40.00);
define('COMMISSION_TIER_3_PERCENT', 50.00);
define('COMMISSION_TIER_MAX_PERCENT', 55.00);

// =============================================================================
// ENVIRONMENT SETTINGS
// =============================================================================

define('ENVIRONMENT', 'production');  // development | staging | production
define('DEBUG_MODE', false);  // Set to false in production
define('ERROR_DISPLAY', false);  // Display errors (false in production)
define('ERROR_LOGGING', true);  // Log errors to file
define('ERROR_LOG_PATH', dirname(__DIR__) . '/logs/errors.log');

// =============================================================================
// TIMEZONE & LOCALE
// =============================================================================

define('TIMEZONE', 'Asia/Jakarta');
define('DEFAULT_LANGUAGE', 'id');  // Indonesian
define('AVAILABLE_LANGUAGES', serialize(['id' => 'Bahasa Indonesia', 'en' => 'English']));
define('DATE_FORMAT', 'd F Y');
define('TIME_FORMAT', 'H:i');
define('DATETIME_FORMAT', 'd F Y H:i');

// =============================================================================
// SESSION SETTINGS
// =============================================================================

define('SESSION_NAME', 'SITUNEO_SESSION');
define('SESSION_LIFETIME', 7200);  // 2 hours in seconds
define('SESSION_PATH', '/');
define('SESSION_DOMAIN', '');
define('SESSION_SECURE', true);  // HTTPS only
define('SESSION_HTTPONLY', true);
define('SESSION_SAMESITE', 'Lax');  // Lax | Strict | None

// Remember me settings
define('REMEMBER_ME_ENABLED', true);
define('REMEMBER_ME_DURATION', 2592000);  // 30 days in seconds

// =============================================================================
// SECURITY SETTINGS
// =============================================================================

define('SECURITY_SALT', 'SITUNEO_2025_SECURE_SALT_KEY_CHANGE_IN_PRODUCTION');
define('ENCRYPTION_KEY', 'SITUNEO_ENCRYPTION_KEY_CHANGE_ME');
define('CSRF_TOKEN_NAME', '_csrf_token');
define('CSRF_TOKEN_EXPIRE', 3600);  // 1 hour

// Password requirements
define('PASSWORD_MIN_LENGTH', 8);
define('PASSWORD_REQUIRE_UPPERCASE', true);
define('PASSWORD_REQUIRE_LOWERCASE', true);
define('PASSWORD_REQUIRE_NUMBER', true);
define('PASSWORD_REQUIRE_SPECIAL', false);

// Rate limiting
define('RATE_LIMIT_ENABLED', true);
define('RATE_LIMIT_LOGIN_ATTEMPTS', 5);
define('RATE_LIMIT_LOGIN_WINDOW', 900);  // 15 minutes
define('RATE_LIMIT_API_CALLS', 100);
define('RATE_LIMIT_API_WINDOW', 3600);  // 1 hour

// =============================================================================
// FILE UPLOAD SETTINGS
// =============================================================================

define('UPLOAD_MAX_SIZE', 10485760);  // 10MB in bytes
define('UPLOAD_ALLOWED_TYPES', serialize([
    'image' => ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'],
    'document' => ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt'],
    'archive' => ['zip', 'rar', '7z'],
    'video' => ['mp4', 'avi', 'mov', 'wmv', 'flv', 'webm'],
]));

define('UPLOAD_PATH', dirname(__DIR__) . '/uploads/');
define('UPLOAD_URL', SITE_URL . '/uploads/');

// =============================================================================
// IMAGE PROCESSING
// =============================================================================

define('IMAGE_QUALITY', 85);  // JPEG quality (0-100)
define('IMAGE_MAX_WIDTH', 2000);
define('IMAGE_MAX_HEIGHT', 2000);
define('THUMBNAIL_WIDTH', 300);
define('THUMBNAIL_HEIGHT', 300);
define('IMAGE_WATERMARK_ENABLED', false);

// =============================================================================
// CACHE SETTINGS
// =============================================================================

define('CACHE_ENABLED', true);
define('CACHE_DRIVER', 'file');  // file | memcached | redis
define('CACHE_PATH', dirname(__DIR__) . '/cache/');
define('CACHE_DEFAULT_TTL', 3600);  // 1 hour
define('CACHE_CLEAR_ON_UPDATE', true);

// =============================================================================
// EMAIL SETTINGS (akan di-override dari database)
// =============================================================================

define('MAIL_ENABLED', true);
define('MAIL_DRIVER', 'smtp');  // smtp | sendmail | mail
define('MAIL_FROM_EMAIL', SITE_EMAIL);
define('MAIL_FROM_NAME', SITE_NAME);

// =============================================================================
// PAGINATION SETTINGS
// =============================================================================

define('PAGINATION_PER_PAGE', 20);
define('PAGINATION_MAX_LINKS', 5);
define('ADMIN_PAGINATION_PER_PAGE', 50);

// =============================================================================
// API SETTINGS
// =============================================================================

define('API_ENABLED', true);
define('API_VERSION', 'v1');
define('API_KEY_HEADER', 'X-API-Key');
define('API_RATE_LIMIT', RATE_LIMIT_API_CALLS);

// =============================================================================
// FEATURES TOGGLES
// =============================================================================

define('FEATURE_BLOG', true);
define('FEATURE_PORTFOLIO', true);
define('FEATURE_TESTIMONIALS', true);
define('FEATURE_NEWSLETTER', true);
define('FEATURE_LIVE_CHAT', true);
define('FEATURE_MULTI_LANGUAGE', true);
define('FEATURE_DARK_MODE', true);
define('FEATURE_PWA', false);

// =============================================================================
// THIRD-PARTY INTEGRATIONS
// =============================================================================

// Google Services
define('GOOGLE_ANALYTICS_ID', '');
define('GOOGLE_TAG_MANAGER_ID', '');
define('GOOGLE_RECAPTCHA_SITE_KEY', '');
define('GOOGLE_RECAPTCHA_SECRET_KEY', '');
define('GOOGLE_MAPS_API_KEY', '');

// Social Media
define('FACEBOOK_PAGE_URL', '');
define('INSTAGRAM_URL', '');
define('TWITTER_URL', '');
define('LINKEDIN_URL', '');
define('YOUTUBE_URL', '');
define('TIKTOK_URL', '');

// Payment Gateways (optional - will be loaded from database)
define('MIDTRANS_ENABLED', false);
define('XENDIT_ENABLED', false);

// =============================================================================
// MAINTENANCE MODE
// =============================================================================

define('MAINTENANCE_MODE', false);
define('MAINTENANCE_MESSAGE', 'Website sedang dalam maintenance. Mohon kembali beberapa saat lagi.');
define('MAINTENANCE_ALLOWED_IPS', serialize(['127.0.0.1']));

// =============================================================================
// LOGGING SETTINGS
// =============================================================================

define('LOG_ENABLED', true);
define('LOG_PATH', dirname(__DIR__) . '/logs/');
define('LOG_LEVEL', 'error');  // debug | info | warning | error | critical
define('LOG_MAX_FILES', 30);  // Keep logs for 30 days

// =============================================================================
// PERFORMANCE OPTIMIZATION
// =============================================================================

define('ENABLE_GZIP', true);
define('ENABLE_MINIFICATION', true);
define('ENABLE_CDN', false);
define('CDN_URL', '');

// =============================================================================
// AUTO-LOAD DATABASE SETTINGS
// =============================================================================

// This function will be called to override defaults with database values
// Will be implemented in core/Config.php
define('AUTO_LOAD_DB_SETTINGS', true);
