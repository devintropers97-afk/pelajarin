<?php
/**
 * Common Helper Functions
 *
 * General utility functions used throughout the application
 *
 * @package SITUNEO
 * @subpackage Helpers
 */

// Prevent direct access
defined('SITUNEO_ACCESS') or die('Direct access not permitted');

/**
 * Dump and die (for debugging)
 */
function dd(...$vars) {
    echo '<pre style="background: #1e1e1e; color: #fff; padding: 20px; border-radius: 5px; margin: 20px; font-family: monospace;">';
    foreach ($vars as $var) {
        var_dump($var);
        echo "\n\n";
    }
    echo '</pre>';
    die();
}

/**
 * Dump variable
 */
function dump(...$vars) {
    echo '<pre style="background: #1e1e1e; color: #fff; padding: 20px; border-radius: 5px; margin: 20px; font-family: monospace;">';
    foreach ($vars as $var) {
        var_dump($var);
        echo "\n\n";
    }
    echo '</pre>';
}

/**
 * Get environment variable
 */
function env($key, $default = null) {
    $value = getenv($key);
    return $value !== false ? $value : $default;
}

/**
 * Check if value is empty (0 and '0' are not considered empty)
 */
function is_blank($value) {
    if (is_null($value)) {
        return true;
    }

    if (is_string($value) && trim($value) === '') {
        return true;
    }

    if (is_array($value) && empty($value)) {
        return true;
    }

    return false;
}

/**
 * Get value from array with dot notation
 */
function array_get($array, $key, $default = null) {
    if (!is_array($array)) {
        return $default;
    }

    if (array_key_exists($key, $array)) {
        return $array[$key];
    }

    foreach (explode('.', $key) as $segment) {
        if (!is_array($array) || !array_key_exists($segment, $array)) {
            return $default;
        }
        $array = $array[$segment];
    }

    return $array;
}

/**
 * Set value in array with dot notation
 */
function array_set(&$array, $key, $value) {
    $keys = explode('.', $key);

    while (count($keys) > 1) {
        $key = array_shift($keys);

        if (!isset($array[$key]) || !is_array($array[$key])) {
            $array[$key] = [];
        }

        $array = &$array[$key];
    }

    $array[array_shift($keys)] = $value;
}

/**
 * Check if array has key with dot notation
 */
function array_has($array, $key) {
    if (!is_array($array)) {
        return false;
    }

    if (array_key_exists($key, $array)) {
        return true;
    }

    foreach (explode('.', $key) as $segment) {
        if (!is_array($array) || !array_key_exists($segment, $array)) {
            return false;
        }
        $array = $array[$segment];
    }

    return true;
}

/**
 * Get only specified keys from array
 */
function array_only($array, $keys) {
    return array_intersect_key($array, array_flip((array) $keys));
}

/**
 * Get all except specified keys from array
 */
function array_except($array, $keys) {
    return array_diff_key($array, array_flip((array) $keys));
}

/**
 * Redirect to URL
 */
function redirect($url, $code = 302) {
    Router::redirect($url, $code);
}

/**
 * Redirect back
 */
function back() {
    Router::back();
}

/**
 * Generate URL
 */
function url($path = '') {
    return SITE_URL . '/' . ltrim($path, '/');
}

/**
 * Get current URL
 */
function current_url() {
    return Router::currentUrl();
}

/**
 * Get old input value (for form repopulation)
 */
function old($key, $default = '') {
    return Session::old($key, $default);
}

/**
 * Get flash message
 */
function flash($key) {
    return Session::flash($key);
}

/**
 * Get success flash message
 */
function flash_success() {
    return Session::getSuccess();
}

/**
 * Get error flash message
 */
function flash_error() {
    return Session::getError();
}

/**
 * Get warning flash message
 */
function flash_warning() {
    return Session::getWarning();
}

/**
 * Get info flash message
 */
function flash_info() {
    return Session::getInfo();
}

/**
 * Get current user
 */
function user() {
    return Auth::user();
}

/**
 * Get current user ID
 */
function user_id() {
    return Auth::id();
}

/**
 * Check if user is logged in
 */
function is_logged_in() {
    return Auth::check();
}

/**
 * Check if user is admin
 */
function is_admin() {
    return Auth::isAdmin();
}

/**
 * Check if user is client
 */
function is_client() {
    return Auth::isClient();
}

/**
 * Check if user is freelancer
 */
function is_freelancer() {
    return Auth::isFreelancer();
}

/**
 * Escape HTML
 */
function e($string) {
    return Security::escape($string);
}

/**
 * Escape for JavaScript
 */
function ejs($string) {
    return Security::escapeJS($string);
}

/**
 * Generate CSRF field
 */
function csrf_field() {
    return Security::csrfField();
}

/**
 * Generate CSRF token
 */
function csrf_token() {
    return Security::getCSRFToken();
}

/**
 * Sanitize input
 */
function sanitize($input, $type = 'string') {
    return Security::sanitize($input, $type);
}

/**
 * Get config value
 */
function config($key, $default = null) {
    return Config::get($key, $default);
}

/**
 * Truncate string
 */
function str_limit($string, $limit = 100, $end = '...') {
    if (mb_strlen($string) <= $limit) {
        return $string;
    }

    return mb_substr($string, 0, $limit) . $end;
}

/**
 * Generate slug
 */
function str_slug($string) {
    return Security::generateSlug($string);
}

/**
 * Convert string to title case
 */
function str_title($string) {
    return ucwords(strtolower($string));
}

/**
 * Check if string starts with
 */
function str_starts_with($haystack, $needle) {
    return strpos($haystack, $needle) === 0;
}

/**
 * Check if string ends with
 */
function str_ends_with($haystack, $needle) {
    return substr($haystack, -strlen($needle)) === $needle;
}

/**
 * Check if string contains
 */
function str_contains($haystack, $needle) {
    return strpos($haystack, $needle) !== false;
}

/**
 * Generate random string
 */
function str_random($length = 16) {
    return Security::randomString($length);
}

/**
 * Get file size in human readable format
 */
function format_bytes($bytes, $precision = 2) {
    $units = ['B', 'KB', 'MB', 'GB', 'TB'];

    for ($i = 0; $bytes > 1024; $i++) {
        $bytes /= 1024;
    }

    return round($bytes, $precision) . ' ' . $units[$i];
}

/**
 * Get time ago format
 */
function time_ago($datetime) {
    $timestamp = is_numeric($datetime) ? $datetime : strtotime($datetime);
    $diff = time() - $timestamp;

    if ($diff < 60) {
        return $diff . ' detik yang lalu';
    } elseif ($diff < 3600) {
        return floor($diff / 60) . ' menit yang lalu';
    } elseif ($diff < 86400) {
        return floor($diff / 3600) . ' jam yang lalu';
    } elseif ($diff < 604800) {
        return floor($diff / 86400) . ' hari yang lalu';
    } elseif ($diff < 2592000) {
        return floor($diff / 604800) . ' minggu yang lalu';
    } elseif ($diff < 31536000) {
        return floor($diff / 2592000) . ' bulan yang lalu';
    } else {
        return floor($diff / 31536000) . ' tahun yang lalu';
    }
}

/**
 * Check if request is AJAX
 */
function is_ajax() {
    return Security::isAjax();
}

/**
 * Check if request is POST
 */
function is_post() {
    return Security::isPost();
}

/**
 * Check if request is GET
 */
function is_get() {
    return Security::isGet();
}

/**
 * Get request input
 */
function request($key = null, $default = null) {
    if ($key === null) {
        return $_REQUEST;
    }

    return $_REQUEST[$key] ?? $default;
}

/**
 * Get POST input
 */
function post($key = null, $default = null) {
    if ($key === null) {
        return $_POST;
    }

    return $_POST[$key] ?? $default;
}

/**
 * Get GET input
 */
function get_input($key = null, $default = null) {
    if ($key === null) {
        return $_GET;
    }

    return $_GET[$key] ?? $default;
}

/**
 * Get client IP
 */
function get_ip() {
    return Security::getClientIP();
}

/**
 * Log message
 */
function log_message($message, $level = 'info') {
    if (!LOG_ENABLED) {
        return;
    }

    $log_file = LOG_PATH . date('Y-m-d') . '.log';
    $timestamp = date('Y-m-d H:i:s');
    $log_entry = "[{$timestamp}] [{$level}] {$message}\n";

    @file_put_contents($log_file, $log_entry, FILE_APPEND);
}

/**
 * Include view file
 */
function view($file, $data = []) {
    extract($data);

    $file_path = PUBLIC_PATH . $file;

    if (!str_ends_with($file_path, '.php')) {
        $file_path .= '.php';
    }

    if (file_exists($file_path)) {
        require $file_path;
    } else {
        die("View not found: {$file}");
    }
}

/**
 * Include partial file
 */
function partial($file, $data = []) {
    extract($data);

    $file_path = INCLUDES_PATH . $file;

    if (!str_ends_with($file_path, '.php')) {
        $file_path .= '.php';
    }

    if (file_exists($file_path)) {
        require $file_path;
    }
}

/**
 * Get asset URL
 */
function asset($path) {
    return ASSETS_URL . ltrim($path, '/');
}

/**
 * Get upload URL
 */
function upload($path) {
    return UPLOADS_URL . ltrim($path, '/');
}

/**
 * Check if current route matches
 */
function is_route($pattern) {
    return Router::is($pattern);
}

/**
 * Get active class if route matches
 */
function active($pattern, $class = 'active') {
    return is_route($pattern) ? $class : '';
}

/**
 * Generate UUID
 */
function uuid() {
    return Security::generateUUID();
}

/**
 * Generate unique order number
 */
function generate_order_number() {
    return 'ORD-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
}

/**
 * Generate unique invoice number
 */
function generate_invoice_number() {
    return 'INV-' . date('Ymd') . '-' . strtoupper(substr(uniqid(), -6));
}

/**
 * Check if in production
 */
function is_production() {
    return ENVIRONMENT === 'production';
}

/**
 * Check if in development
 */
function is_development() {
    return ENVIRONMENT === 'development';
}

/**
 * Abort with HTTP error
 */
function abort($code = 404, $message = null) {
    http_response_code($code);

    if ($message) {
        echo $message;
    } else {
        switch ($code) {
            case 403:
                echo 'Forbidden';
                break;
            case 404:
                echo 'Not Found';
                break;
            case 500:
                echo 'Internal Server Error';
                break;
            default:
                echo 'Error ' . $code;
        }
    }

    exit;
}

/**
 * Return JSON response
 */
function json_response($data, $code = 200) {
    http_response_code($code);
    header('Content-Type: application/json');
    echo json_encode($data, JSON_PRETTY_PRINT);
    exit;
}

/**
 * Return success JSON
 */
function json_success($message, $data = []) {
    json_response([
        'success' => true,
        'message' => $message,
        'data' => $data
    ]);
}

/**
 * Return error JSON
 */
function json_error($message, $errors = [], $code = 400) {
    json_response([
        'success' => false,
        'message' => $message,
        'errors' => $errors
    ], $code);
}

/**
 * Get order status color for badges
 */
function order_status_color($status) {
    return match($status) {
        'pending' => 'warning',
        'processing', 'in_progress' => 'info',
        'completed' => 'success',
        'cancelled', 'failed' => 'danger',
        'refunded' => 'secondary',
        default => 'secondary'
    };
}

/**
 * Get activity icon based on action
 */
function activity_icon($action) {
    return match($action) {
        'login' => 'box-arrow-in-right',
        'logout' => 'box-arrow-right',
        'register' => 'person-plus',
        'update_profile' => 'person-gear',
        'create_order' => 'cart-plus',
        'update_order' => 'cart-check',
        'create_service' => 'plus-circle',
        'update_service' => 'pencil',
        'update_settings' => 'gear',
        'update_page_content' => 'file-text',
        'password_reset' => 'key',
        default => 'circle-fill'
    };
}

/**
 * Convert timestamp to "time ago" format
 */
function time_ago($timestamp) {
    $time = strtotime($timestamp);
    $diff = time() - $time;

    if ($diff < 60) {
        return $diff . ' detik yang lalu';
    } elseif ($diff < 3600) {
        return floor($diff / 60) . ' menit yang lalu';
    } elseif ($diff < 86400) {
        return floor($diff / 3600) . ' jam yang lalu';
    } elseif ($diff < 604800) {
        return floor($diff / 86400) . ' hari yang lalu';
    } else {
        return date('d M Y H:i', $time);
    }
}

/**
 * Check if current URL matches the given path
 */
function is_current_url($path, $exact = false) {
    $current = trim(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH), '/');
    $check = trim($path, '/');

    if ($exact) {
        return $current === $check;
    }

    return strpos($current, $check) === 0;
}

/**
 * Create URL-friendly slug from string
 */
function slugify($text) {
    // Replace non-alphanumeric characters with hyphens
    $text = preg_replace('/[^a-z0-9]+/i', '-', $text);

    // Remove leading and trailing hyphens
    $text = trim($text, '-');

    // Convert to lowercase
    $text = strtolower($text);

    return $text;
}
