<?php
/**
 * Bootstrap File
 *
 * Main initialization file that sets up the entire application
 * This file should be included in every entry point (index.php, admin/index.php, etc.)
 *
 * @package SITUNEO
 * @subpackage Config
 */

// =============================================================================
// SECURITY: Prevent Direct Access
// =============================================================================

if (!defined('SITUNEO_ACCESS')) {
    define('SITUNEO_ACCESS', true);
}

// =============================================================================
// ERROR REPORTING (will be adjusted based on environment)
// =============================================================================

error_reporting(E_ALL);
ini_set('display_errors', '0');
ini_set('display_startup_errors', '0');
ini_set('log_errors', '1');

// =============================================================================
// REQUIRE PHP VERSION CHECK
// =============================================================================

if (version_compare(PHP_VERSION, '7.4.0', '<')) {
    die('SITUNEO requires PHP version 7.4 or higher. Current version: ' . PHP_VERSION);
}

// =============================================================================
// SET DEFAULT TIMEZONE
// =============================================================================

date_default_timezone_set('Asia/Jakarta');

// =============================================================================
// LOAD ENVIRONMENT VARIABLES FROM .env FILE
// =============================================================================

$env_file = dirname(dirname(__FILE__)) . '/.env';
if (file_exists($env_file)) {
    $env_lines = file($env_file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($env_lines as $line) {
        // Skip comments
        if (strpos(trim($line), '#') === 0) continue;

        // Parse key=value pairs
        if (strpos($line, '=') !== false) {
            list($key, $value) = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);

            // Set environment variable
            putenv("$key=$value");
            $_ENV[$key] = $value;
        }
    }
}

// =============================================================================
// LOAD CONFIGURATION FILES
// =============================================================================

$config_path = dirname(__FILE__) . '/';

require_once $config_path . 'app.php';       // Application settings
require_once $config_path . 'database.php';  // Database configuration
require_once $config_path . 'paths.php';     // Path definitions
require_once $config_path . 'mail.php';      // Email settings

// =============================================================================
// ADJUST ERROR REPORTING BASED ON ENVIRONMENT
// =============================================================================

if (ENVIRONMENT === 'development') {
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
} else {
    error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT);
    ini_set('display_errors', '0');
    ini_set('display_startup_errors', '0');
}

ini_set('log_errors', '1');
ini_set('error_log', ERROR_LOG_PATH);

// =============================================================================
// SET PHP SETTINGS
// =============================================================================

ini_set('session.cookie_httponly', '1');
ini_set('session.use_only_cookies', '1');
ini_set('session.cookie_secure', SESSION_SECURE ? '1' : '0');
ini_set('session.cookie_samesite', SESSION_SAMESITE);
ini_set('session.gc_maxlifetime', SESSION_LIFETIME);

// Upload settings
ini_set('upload_max_filesize', UPLOAD_MAX_SIZE);
ini_set('post_max_size', UPLOAD_MAX_SIZE * 2);
ini_set('max_execution_time', '300');  // 5 minutes
ini_set('max_input_time', '300');
ini_set('memory_limit', '256M');

// =============================================================================
// LOAD CORE CLASSES
// =============================================================================

require_once CORE_PATH . 'Database.php';
require_once CORE_PATH . 'Config.php';
require_once CORE_PATH . 'Security.php';
require_once CORE_PATH . 'Session.php';
require_once CORE_PATH . 'Router.php';
require_once CORE_PATH . 'Auth.php';
require_once CORE_PATH . 'Validator.php';

// =============================================================================
// LOAD HELPER FUNCTIONS
// =============================================================================

require_once HELPERS_PATH . 'common.php';
require_once HELPERS_PATH . 'formatting.php';
require_once HELPERS_PATH . 'pricing.php';

// Load optional helper files if they exist
if (file_exists(HELPERS_PATH . 'validation.php')) {
    require_once HELPERS_PATH . 'validation.php';
}
if (file_exists(HELPERS_PATH . 'security.php')) {
    require_once HELPERS_PATH . 'security.php';
}
if (file_exists(HELPERS_PATH . 'email.php')) {
    require_once HELPERS_PATH . 'email.php';
}

// =============================================================================
// INITIALIZE DATABASE CONNECTION
// =============================================================================

try {
    $db = Database::getInstance();
    define('DB_CONNECTED', true);
} catch (Exception $e) {
    if (DEBUG_MODE) {
        die('Database connection failed: ' . $e->getMessage());
    } else {
        die('Database connection failed. Please try again later.');
    }
}

// =============================================================================
// LOAD DATABASE SETTINGS (override config file defaults)
// =============================================================================

if (AUTO_LOAD_DB_SETTINGS && DB_CONNECTED) {
    Config::loadFromDatabase();
}

// =============================================================================
// START SESSION
// =============================================================================

Session::start();

// =============================================================================
// SECURITY: CSRF Token
// =============================================================================

if (!Session::has(CSRF_TOKEN_NAME)) {
    Session::set(CSRF_TOKEN_NAME, Security::generateToken());
}

// =============================================================================
// CHECK MAINTENANCE MODE
// =============================================================================

if (MAINTENANCE_MODE && !in_array($_SERVER['REMOTE_ADDR'] ?? '', unserialize(MAINTENANCE_ALLOWED_IPS))) {
    // Check if not admin
    if (!Auth::isAdmin()) {
        http_response_code(503);
        require_once INCLUDES_PATH . 'maintenance.php';
        exit;
    }
}

// =============================================================================
// SET GLOBAL VARIABLES
// =============================================================================

$GLOBALS['db'] = $db;
$GLOBALS['user'] = Auth::user();
$GLOBALS['is_logged_in'] = Auth::check();

// =============================================================================
// AUTOLOAD CLASSES (for future use)
// =============================================================================

spl_autoload_register(function ($class) {
    $class_file = CORE_PATH . $class . '.php';
    if (file_exists($class_file)) {
        require_once $class_file;
        return true;
    }

    // Try helpers
    $helper_file = HELPERS_PATH . $class . '.php';
    if (file_exists($helper_file)) {
        require_once $helper_file;
        return true;
    }

    return false;
});

// =============================================================================
// CUSTOM ERROR HANDLER (optional)
// =============================================================================

if (ERROR_LOGGING) {
    set_error_handler(function($errno, $errstr, $errfile, $errline) {
        if (!(error_reporting() & $errno)) {
            return false;
        }

        $error_types = [
            E_ERROR             => 'ERROR',
            E_WARNING           => 'WARNING',
            E_PARSE             => 'PARSE',
            E_NOTICE            => 'NOTICE',
            E_CORE_ERROR        => 'CORE_ERROR',
            E_CORE_WARNING      => 'CORE_WARNING',
            E_COMPILE_ERROR     => 'COMPILE_ERROR',
            E_COMPILE_WARNING   => 'COMPILE_WARNING',
            E_USER_ERROR        => 'USER_ERROR',
            E_USER_WARNING      => 'USER_WARNING',
            E_USER_NOTICE       => 'USER_NOTICE',
            E_STRICT            => 'STRICT',
            E_RECOVERABLE_ERROR => 'RECOVERABLE_ERROR',
            E_DEPRECATED        => 'DEPRECATED',
            E_USER_DEPRECATED   => 'USER_DEPRECATED',
        ];

        $type = $error_types[$errno] ?? 'UNKNOWN';
        $message = sprintf("[%s] %s in %s on line %d", $type, $errstr, $errfile, $errline);

        error_log($message);

        return true;
    });
}

// =============================================================================
// REGISTER SHUTDOWN FUNCTION
// =============================================================================

register_shutdown_function(function() {
    // Close database connection
    if (isset($GLOBALS['db'])) {
        $GLOBALS['db'] = null;
    }

    // Log fatal errors
    $error = error_get_last();
    if ($error && in_array($error['type'], [E_ERROR, E_CORE_ERROR, E_COMPILE_ERROR, E_PARSE])) {
        $message = sprintf(
            "[FATAL] %s in %s on line %d",
            $error['message'],
            $error['file'],
            $error['line']
        );
        error_log($message);
    }
});

// =============================================================================
// COMPRESSION (GZIP)
// =============================================================================

if (ENABLE_GZIP && !ob_get_level()) {
    ob_start('ob_gzhandler');
}

// =============================================================================
// LOAD COMPLETE
// =============================================================================

define('BOOTSTRAP_LOADED', true);
