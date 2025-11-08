<?php
/**
 * SITUNEO DIGITAL - Session Management
 * Manage user sessions
 */

// Start secure session
secureSessionStart();

/**
 * Set Flash Message
 */
function setFlash($type, $message) {
    $_SESSION['flash'][$type] = $message;
}

/**
 * Get Flash Message
 */
function getFlash($type) {
    if (isset($_SESSION['flash'][$type])) {
        $message = $_SESSION['flash'][$type];
        unset($_SESSION['flash'][$type]);
        return $message;
    }
    return null;
}

/**
 * Has Flash Message
 */
function hasFlash($type) {
    return isset($_SESSION['flash'][$type]);
}

/**
 * Display Flash Messages HTML
 */
function displayFlash() {
    $html = '';
    $types = [
        'success' => 'alert-success',
        'error' => 'alert-danger',
        'warning' => 'alert-warning',
        'info' => 'alert-info'
    ];

    foreach ($types as $type => $class) {
        if ($message = getFlash($type)) {
            $icon = $type === 'success' ? 'check-circle' : ($type === 'error' ? 'x-circle' : ($type === 'warning' ? 'exclamation-triangle' : 'info-circle'));
            $html .= '<div class="alert ' . $class . ' alert-dismissible fade show" role="alert"><i class="bi bi-' . $icon . ' me-2"></i>' . htmlspecialchars($message) . '<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>';
        }
    }
    return $html;
}

function setUserSession($user, $remember = false) {
    $_SESSION['user_id'] = $user['user_id'] ?? $user['id'] ?? 1;
    $_SESSION['user_name'] = $user['full_name'] ?? $user['name'] ?? 'Demo User';
    $_SESSION['user_email'] = $user['email'] ?? 'demo@situneo.my.id';
    $_SESSION['user_role'] = $user['role'] ?? 'client';
    $_SESSION['user_avatar'] = $user['avatar'] ?? null;
    $_SESSION['logged_in_at'] = time();

    // Set remember me cookie if requested
    if ($remember) {
        $token = bin2hex(random_bytes(32));
        setcookie('remember_token', $token, time() + (86400 * 30), '/', '', true, true);
    }

    // Log activity only if not in demo mode or if database is available
    if (!defined('DEMO_MODE') || !DEMO_MODE) {
        logActivity($user['user_id'] ?? $user['id'], 'User logged in');
    }
}

function getCurrentUser() {
    if (!isLoggedIn()) return null;

    // DEMO MODE: Return demo user data
    if (defined('DEMO_MODE') && DEMO_MODE) {
        $userId = $_SESSION['user_id'] ?? 1;
        $userName = $_SESSION['user_name'] ?? 'Demo User';
        $role = $_SESSION['user_role'] ?? 'client';

        return [
            'id' => $userId,
            'full_name' => $userName,
            'name' => $userName,
            'email' => $_SESSION['user_email'] ?? 'demo@situneo.my.id',
            'role' => $role,
            'avatar' => $_SESSION['user_avatar'] ?? null,
            'company_name' => 'Demo Company',
            'phone' => '+62 812-3456-7890',
            'is_email_verified' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'referral_code' => strtoupper(substr($userName, 0, 4)) . date('Y'),
            'tier' => 'tier_2',
            'commission_rate' => 40,
        ];
    }

    // Real database query
    global $pdo;
    $sql = "SELECT u.*, up.company_name FROM users u LEFT JOIN user_profiles up ON u.id = up.user_id WHERE u.id = ?";
    return db_fetch($sql, [$_SESSION['user_id']]);
}

function clearUserSession() {
    if (isLoggedIn()) logActivity($_SESSION['user_id'], 'User logged out');
    unset($_SESSION['user_id'], $_SESSION['user_name'], $_SESSION['user_email'], $_SESSION['user_role']);
    secureSessionDestroy();
}

function checkSessionTimeout() {
    if (isLoggedIn() && isset($_SESSION['logged_in_at'])) {
        if (time() - $_SESSION['logged_in_at'] > SESSION_LIFETIME) {
            clearUserSession();
            setFlash('warning', 'Sesi berakhir. Silakan login kembali.');
            redirect('/auth/login.php');
        }
    }
}

/**
 * Check and handle remember me cookie
 */
function checkRememberMe() {
    if (!isLoggedIn() && isset($_COOKIE['remember_token'])) {
        global $pdo;
        $token = $_COOKIE['remember_token'];

        $sql = "SELECT user_id FROM remember_tokens WHERE token = ? AND expires_at > NOW()";
        $result = db_fetch($sql, [$token]);

        if ($result) {
            // Auto login user
            $user = db_fetch("SELECT * FROM users WHERE id = ?", [$result['user_id']]);
            if ($user) {
                setUserSession($user);
            }
        }
    }
}

/**
 * Update last activity timestamp
 */
function updateLastActivity() {
    if (isLoggedIn()) {
        $_SESSION['last_activity'] = time();
    }
}

checkSessionTimeout();
checkRememberMe();
updateLastActivity();
