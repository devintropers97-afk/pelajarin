<?php
/**
 * Database Configuration
 *
 * DUAL PRICING SYSTEM SUPPORT:
 * Database credentials untuk production (sesuai user requirements)
 *
 * @package SITUNEO
 * @subpackage Config
 */

// Prevent direct access
defined('SITUNEO_ACCESS') or die('Direct access not permitted');

// =============================================================================
// DATABASE CREDENTIALS - PRODUCTION
// =============================================================================

define('DB_HOST', 'localhost');
define('DB_USER', 'nrrskfvk_user_situneo_digital');
define('DB_PASS', 'Devin1922$');
define('DB_NAME', 'nrrskfvk_situneo_digital');
define('DB_CHARSET', 'utf8mb4');
define('DB_COLLATE', 'utf8mb4_unicode_ci');

// =============================================================================
// DATABASE OPTIONS
// =============================================================================

define('DB_PREFIX', '');  // Table prefix (kosong sesuai schema)
define('DB_ENGINE', 'InnoDB');
define('DB_PERSISTENT', false);  // Persistent connection (false untuk shared hosting)
define('DB_ERROR_MODE', 'EXCEPTION');  // PDO error mode

// =============================================================================
// CONNECTION SETTINGS
// =============================================================================

define('DB_TIMEOUT', 30);  // Connection timeout in seconds
define('DB_RETRY_ATTEMPTS', 3);  // Number of retry attempts on connection failure
define('DB_RETRY_DELAY', 1);  // Delay between retries in seconds

// =============================================================================
// QUERY SETTINGS
// =============================================================================

define('DB_CACHE_QUERIES', true);  // Enable query caching
define('DB_LOG_QUERIES', false);  // Log all queries (disable in production)
define('DB_SLOW_QUERY_TIME', 2);  // Log queries slower than X seconds

// =============================================================================
// BACKUP SETTINGS
// =============================================================================

define('DB_BACKUP_PATH', dirname(__DIR__) . '/backups/database/');
define('DB_AUTO_BACKUP', true);  // Enable automatic daily backup
define('DB_BACKUP_RETENTION', 30);  // Days to keep backups

// =============================================================================
// PDO OPTIONS
// =============================================================================

$pdo_options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
    PDO::ATTR_PERSISTENT         => DB_PERSISTENT,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES " . DB_CHARSET . " COLLATE " . DB_COLLATE,
    PDO::ATTR_TIMEOUT            => DB_TIMEOUT,
];

// Export for use in Database class
if (!defined('PDO_OPTIONS')) {
    define('PDO_OPTIONS', serialize($pdo_options));
}
