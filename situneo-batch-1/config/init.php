<?php
/**
 * ========================================
 * SITUNEO DIGITAL - Initialization
 * Load all configurations and start session
 * Include this file at the top of every page
 * ========================================
 */

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Load configuration files
require_once __DIR__ . '/database.php';
require_once __DIR__ . '/constants.php';
require_once __DIR__ . '/functions.php';

// Set error reporting (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 0); // Set to 0 in production
ini_set('log_errors', 1);

// Set timezone
date_default_timezone_set(TIMEZONE);

// Auto-logout if session timeout
if (isLoggedIn()) {
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > SESSION_TIMEOUT)) {
        session_unset();
        session_destroy();
        redirect(SITE_URL . '/auth/login.php?timeout=1');
    }
    $_SESSION['last_activity'] = time();
}
