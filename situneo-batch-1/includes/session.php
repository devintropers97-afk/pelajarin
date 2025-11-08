<?php
/**
 * ========================================
 * SITUNEO DIGITAL - Session Management
 * Secure session handling with security features
 * ========================================
 */

// Start session with security settings
function initializeSecureSession() {
    // Session configuration
    if (session_status() === PHP_SESSION_NONE) {
        // Security settings
        ini_set('session.cookie_httponly', 1);
        ini_set('session.use_only_cookies', 1);
        ini_set('session.cookie_secure', 0); // Set to 1 if using HTTPS
        ini_set('session.cookie_samesite', 'Lax');
        ini_set('session.gc_maxlifetime', 86400); // 24 hours

        session_name('SITUNEO_SESSION');
        session_start();

        // Regenerate session ID on first access
        if (!isset($_SESSION['initiated'])) {
            session_regenerate_id(true);
            $_SESSION['initiated'] = true;
            $_SESSION['created_at'] = time();
        }

        // Check session timeout (24 hours)
        if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 86400)) {
            destroySession();
            header('Location: /auth/login.php?timeout=1');
            exit();
        }

        $_SESSION['last_activity'] = time();

        // Multi-language support
        if (!isset($_SESSION['lang'])) {
            $_SESSION['lang'] = $_GET['lang'] ?? 'id';
        }
        if (isset($_GET['lang']) && in_array($_GET['lang'], ['id', 'en'])) {
            $_SESSION['lang'] = $_GET['lang'];
        }
    }
}

// Create user session after login
function createUserSession($user) {
    // Regenerate session ID for security
    session_regenerate_id(true);

    // Store user data
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_email'] = $user['email'];
    $_SESSION['user_name'] = $user['full_name'];
    $_SESSION['user_role'] = $user['role'];
    $_SESSION['email_verified'] = $user['email_verified'];
    $_SESSION['logged_in'] = true;
    $_SESSION['login_time'] = time();
    $_SESSION['ip_address'] = $_SERVER['REMOTE_ADDR'];

    // Update last login in database
    require_once __DIR__ . '/../config/database.php';
    $db = getDB();
    $stmt = $db->prepare("UPDATE users SET last_login = NOW(), last_ip = ? WHERE id = ?");
    $stmt->execute([$_SERVER['REMOTE_ADDR'], $user['id']]);
}

// Destroy session (logout)
function destroySession() {
    if (session_status() === PHP_SESSION_ACTIVE) {
        $_SESSION = array();

        // Delete session cookie
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        session_destroy();
    }
}

// Get current user data
function getCurrentUser() {
    if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
        return null;
    }

    return [
        'id' => $_SESSION['user_id'] ?? null,
        'email' => $_SESSION['user_email'] ?? null,
        'name' => $_SESSION['user_name'] ?? null,
        'role' => $_SESSION['user_role'] ?? null,
        'email_verified' => $_SESSION['email_verified'] ?? 0
    ];
}

// Generate CSRF token
function generateCSRFToken() {
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// Verify CSRF token
function verifyCSRFToken($token) {
    if (!isset($_SESSION['csrf_token']) || !isset($token)) {
        return false;
    }
    return hash_equals($_SESSION['csrf_token'], $token);
}

// Set remember me cookie
function setRememberMeCookie($userId, $token) {
    // Encode user ID and token
    $cookieValue = base64_encode($userId . ':' . $token);

    // Set cookie for 30 days
    setcookie(
        'remember_me',
        $cookieValue,
        time() + (30 * 24 * 60 * 60), // 30 days
        '/',
        '',
        false, // Set to true if using HTTPS
        true // HTTP only
    );
}

// Check remember me cookie
function checkRememberMeCookie() {
    if (isset($_COOKIE['remember_me'])) {
        $cookieValue = base64_decode($_COOKIE['remember_me']);
        list($userId, $token) = explode(':', $cookieValue, 2);

        // Verify token in database
        require_once __DIR__ . '/../config/database.php';
        require_once __DIR__ . '/functions/user.php';

        $db = getDB();
        $stmt = $db->prepare("SELECT * FROM users WHERE id = ? AND remember_token = ? AND status = 'active'");
        $stmt->execute([$userId, $token]);
        $user = $stmt->fetch();

        if ($user) {
            createUserSession($user);
            return true;
        } else {
            // Invalid token, delete cookie
            deleteRememberMeCookie();
        }
    }
    return false;
}

// Delete remember me cookie
function deleteRememberMeCookie() {
    setcookie('remember_me', '', time() - 3600, '/');

    // Also clear token from database
    if (isset($_SESSION['user_id'])) {
        require_once __DIR__ . '/../config/database.php';
        $db = getDB();
        $stmt = $db->prepare("UPDATE users SET remember_token = NULL WHERE id = ?");
        $stmt->execute([$_SESSION['user_id']]);
    }
}

// Flash message system
function setFlashMessage($type, $message) {
    $_SESSION['flash_message'] = [
        'type' => $type, // success, error, warning, info
        'message' => $message
    ];
}

function getFlashMessage() {
    if (isset($_SESSION['flash_message'])) {
        $flash = $_SESSION['flash_message'];
        unset($_SESSION['flash_message']);
        return $flash;
    }
    return null;
}

// Initialize session on file include
initializeSecureSession();
