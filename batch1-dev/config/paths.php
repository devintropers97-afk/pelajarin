<?php
/**
 * Path Configuration
 *
 * Centralized path definitions for the entire application
 * Makes it easy to relocate files and maintain clean code
 *
 * @package SITUNEO
 * @subpackage Config
 */

// Prevent direct access
defined('SITUNEO_ACCESS') or die('Direct access not permitted');

// =============================================================================
// ROOT PATHS
// =============================================================================

define('ROOT_PATH', dirname(__DIR__) . '/');
define('PUBLIC_PATH', ROOT_PATH . 'public/');
define('ADMIN_PATH', ROOT_PATH . 'admin/');
define('CLIENT_PATH', ROOT_PATH . 'client/');
define('FREELANCER_PATH', ROOT_PATH . 'freelancer/');

// =============================================================================
// CORE PATHS
// =============================================================================

define('CORE_PATH', ROOT_PATH . 'core/');
define('CONFIG_PATH', ROOT_PATH . 'config/');
define('HELPERS_PATH', ROOT_PATH . 'helpers/');
define('INCLUDES_PATH', ROOT_PATH . 'includes/');

// =============================================================================
// INCLUDES SUB-PATHS
// =============================================================================

define('HEADER_PATH', INCLUDES_PATH . 'header/');
define('FOOTER_PATH', INCLUDES_PATH . 'footer/');
define('NAV_PATH', INCLUDES_PATH . 'nav/');
define('WIDGETS_PATH', INCLUDES_PATH . 'widgets/');
define('PARTIALS_PATH', INCLUDES_PATH . 'partials/');

// =============================================================================
// ASSET PATHS
// =============================================================================

define('ASSETS_PATH', ROOT_PATH . 'assets/');
define('CSS_PATH', ASSETS_PATH . 'css/');
define('JS_PATH', ASSETS_PATH . 'js/');
define('IMAGES_PATH', ASSETS_PATH . 'images/');
define('FONTS_PATH', ASSETS_PATH . 'fonts/');
define('VENDOR_PATH', ASSETS_PATH . 'vendor/');

// =============================================================================
// UPLOAD PATHS
// =============================================================================

define('UPLOADS_PATH', ROOT_PATH . 'uploads/');
define('TEMP_UPLOAD_PATH', UPLOADS_PATH . 'temp/');
define('AVATAR_UPLOAD_PATH', UPLOADS_PATH . 'avatars/');
define('DOCUMENT_UPLOAD_PATH', UPLOADS_PATH . 'documents/');
define('MEDIA_UPLOAD_PATH', UPLOADS_PATH . 'media/');
define('PORTFOLIO_UPLOAD_PATH', UPLOADS_PATH . 'portfolio/');
define('BLOG_UPLOAD_PATH', UPLOADS_PATH . 'blog/');
define('INVOICE_UPLOAD_PATH', UPLOADS_PATH . 'invoices/');
define('PAYMENT_PROOF_UPLOAD_PATH', UPLOADS_PATH . 'payment_proofs/');

// =============================================================================
// DATA PATHS
// =============================================================================

define('DATA_PATH', ROOT_PATH . 'data/');
define('LOGS_PATH', ROOT_PATH . 'logs/');
define('CACHE_PATH', ROOT_PATH . 'cache/');
define('BACKUPS_PATH', ROOT_PATH . 'backups/');
define('EXPORTS_PATH', ROOT_PATH . 'exports/');

// =============================================================================
// TEMPLATE PATHS
// =============================================================================

define('TEMPLATES_PATH', ROOT_PATH . 'templates/');
define('EMAIL_TEMPLATES_PATH', TEMPLATES_PATH . 'email/');
define('PDF_TEMPLATES_PATH', TEMPLATES_PATH . 'pdf/');

// =============================================================================
// DATABASE PATHS
// =============================================================================

define('DATABASE_PATH', ROOT_PATH . 'database/');
define('MIGRATIONS_PATH', DATABASE_PATH . 'migrations/');
define('SEEDS_PATH', DATABASE_PATH . 'seeds/');

// =============================================================================
// URL PATHS (untuk frontend)
// =============================================================================

if (!defined('BASE_URL')) {
    define('BASE_URL', SITE_URL . '/');
}

define('ASSETS_URL', BASE_URL . 'assets/');
define('CSS_URL', ASSETS_URL . 'css/');
define('JS_URL', ASSETS_URL . 'js/');
define('IMAGES_URL', ASSETS_URL . 'images/');
define('FONTS_URL', ASSETS_URL . 'fonts/');
define('VENDOR_URL', ASSETS_URL . 'vendor/');

define('UPLOADS_URL', BASE_URL . 'uploads/');
define('AVATAR_URL', UPLOADS_URL . 'avatars/');
define('MEDIA_URL', UPLOADS_URL . 'media/');
define('PORTFOLIO_URL', UPLOADS_URL . 'portfolio/');
define('BLOG_URL', UPLOADS_URL . 'blog/');

// =============================================================================
// PUBLIC URLs (dapat diakses langsung via browser)
// =============================================================================

define('HOME_URL', BASE_URL);
define('ABOUT_URL', BASE_URL . 'about');
define('SERVICES_URL', BASE_URL . 'services');
define('PORTFOLIO_URL_PAGE', BASE_URL . 'portfolio');
define('PRICING_URL', BASE_URL . 'pricing');
define('CALCULATOR_URL', BASE_URL . 'calculator');
define('CONTACT_URL', BASE_URL . 'contact');
define('BLOG_URL_PAGE', BASE_URL . 'blog');

// Auth URLs
define('LOGIN_URL', BASE_URL . 'login');
define('REGISTER_URL', BASE_URL . 'register');
define('LOGOUT_URL', BASE_URL . 'logout');
define('FORGOT_PASSWORD_URL', BASE_URL . 'forgot-password');

// Dashboard URLs
define('ADMIN_URL', BASE_URL . 'admin');
define('CLIENT_URL', BASE_URL . 'client');
define('FREELANCER_URL', BASE_URL . 'freelancer');

// =============================================================================
// FILE PATHS (specific important files)
// =============================================================================

define('HTACCESS_FILE', ROOT_PATH . '.htaccess');
define('INDEX_FILE', ROOT_PATH . 'index.php');
define('FAVICON_FILE', IMAGES_PATH . 'favicon.ico');
define('LOGO_FILE', IMAGES_PATH . 'logo.png');
define('LOGO_WHITE_FILE', IMAGES_PATH . 'logo-white.png');

// =============================================================================
// ENSURE REQUIRED DIRECTORIES EXIST
// =============================================================================

$required_dirs = [
    UPLOADS_PATH,
    TEMP_UPLOAD_PATH,
    AVATAR_UPLOAD_PATH,
    DOCUMENT_UPLOAD_PATH,
    MEDIA_UPLOAD_PATH,
    PORTFOLIO_UPLOAD_PATH,
    BLOG_UPLOAD_PATH,
    INVOICE_UPLOAD_PATH,
    PAYMENT_PROOF_UPLOAD_PATH,
    LOGS_PATH,
    CACHE_PATH,
    BACKUPS_PATH,
    EXPORTS_PATH,
];

foreach ($required_dirs as $dir) {
    if (!file_exists($dir)) {
        @mkdir($dir, 0755, true);
    }
}

// =============================================================================
// HELPER FUNCTIONS FOR PATHS
// =============================================================================

/**
 * Get full path to a file in root directory
 */
function root_path($path = '') {
    return ROOT_PATH . ltrim($path, '/');
}

/**
 * Get full path to a file in public directory
 */
function public_path($path = '') {
    return PUBLIC_PATH . ltrim($path, '/');
}

/**
 * Get full path to a file in includes directory
 */
function includes_path($path = '') {
    return INCLUDES_PATH . ltrim($path, '/');
}

/**
 * Get full path to a file in assets directory
 */
function assets_path($path = '') {
    return ASSETS_PATH . ltrim($path, '/');
}

/**
 * Get full path to a file in uploads directory
 */
function uploads_path($path = '') {
    return UPLOADS_PATH . ltrim($path, '/');
}

/**
 * Get URL to a file in assets directory
 */
function asset_url($path = '') {
    return ASSETS_URL . ltrim($path, '/');
}

/**
 * Get URL to an uploaded file
 */
function upload_url($path = '') {
    return UPLOADS_URL . ltrim($path, '/');
}

/**
 * Get URL to an image
 */
function image_url($path = '') {
    return IMAGES_URL . ltrim($path, '/');
}

/**
 * Get URL to a CSS file
 */
function css_url($path = '') {
    return CSS_URL . ltrim($path, '/');
}

/**
 * Get URL to a JS file
 */
function js_url($path = '') {
    return JS_URL . ltrim($path, '/');
}
