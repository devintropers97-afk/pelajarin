<?php
/**
 * ========================================
 * SITUNEO DIGITAL - Authentication Helpers
 * Functions for checking auth status and permissions
 * ========================================
 */

require_once __DIR__ . '/session.php';
require_once __DIR__ . '/../config/database.php';

// Check if user is logged in
function isLoggedIn() {
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
}

// Require login (redirect if not logged in)
function requireLogin($redirectUrl = '/auth/login.php') {
    if (!isLoggedIn()) {
        header('Location: ' . $redirectUrl . '?redirect=' . urlencode($_SERVER['REQUEST_URI']));
        exit();
    }
}

// Require guest (redirect if already logged in)
function requireGuest($redirectUrl = null) {
    if (isLoggedIn()) {
        if ($redirectUrl === null) {
            $redirectUrl = getDashboardUrl();
        }
        header('Location: ' . $redirectUrl);
        exit();
    }
}

// Get user role
function getUserRole() {
    return $_SESSION['user_role'] ?? null;
}

// Check if user has specific role
function hasRole($role) {
    return getUserRole() === $role;
}

// Require specific role
function requireRole($role, $redirectUrl = '/') {
    requireLogin();

    if (!hasRole($role)) {
        setFlashMessage('error', 'You do not have permission to access this page.');
        header('Location: ' . $redirectUrl);
        exit();
    }
}

// Check if email is verified
function isEmailVerified() {
    return isset($_SESSION['email_verified']) && $_SESSION['email_verified'] == 1;
}

// Require email verification
function requireEmailVerification($redirectUrl = '/auth/verify-email.php') {
    requireLogin();

    if (!isEmailVerified()) {
        setFlashMessage('warning', 'Please verify your email address to continue.');
        header('Location: ' . $redirectUrl);
        exit();
    }
}

// Get dashboard URL based on user role
function getDashboardUrl() {
    $role = getUserRole();

    switch ($role) {
        case 'admin':
            return '/admin/dashboard.php';
        case 'partner':
            return '/partner/dashboard.php';
        case 'client':
            return '/client/dashboard.php';
        default:
            return '/';
    }
}

// Check login attempt rate limiting
function checkLoginRateLimit($identifier) {
    $db = getDB();

    // Check attempts in last 15 minutes
    $stmt = $db->prepare("
        SELECT COUNT(*) as attempts
        FROM activity_logs
        WHERE activity_type = 'login_failed'
        AND ip_address = ?
        AND created_at > DATE_SUB(NOW(), INTERVAL 15 MINUTE)
    ");
    $stmt->execute([$identifier]);
    $result = $stmt->fetch();

    $attempts = $result['attempts'] ?? 0;

    // Max 5 attempts per 15 minutes
    if ($attempts >= 5) {
        return false;
    }

    return true;
}

// Log activity
function logActivity($userId, $activityType, $description, $ipAddress = null) {
    try {
        $db = getDB();

        if ($ipAddress === null) {
            $ipAddress = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
        }

        $stmt = $db->prepare("
            INSERT INTO activity_logs (user_id, activity_type, description, ip_address, created_at)
            VALUES (?, ?, ?, ?, NOW())
        ");

        $stmt->execute([$userId, $activityType, $description, $ipAddress]);

        return true;
    } catch (Exception $e) {
        error_log("Failed to log activity: " . $e->getMessage());
        return false;
    }
}

// Generate secure random token
function generateSecureToken($length = 32) {
    return bin2hex(random_bytes($length));
}

// Hash password
function hashPassword($password) {
    return password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);
}

// Verify password
function verifyPassword($password, $hash) {
    return password_verify($password, $hash);
}

// Check if password needs rehash (security upgrade)
function needsRehash($hash) {
    return password_needs_rehash($hash, PASSWORD_BCRYPT, ['cost' => 12]);
}

// Sanitize output for XSS protection
function sanitizeOutput($data) {
    return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
}

// Generate referral code
function generateReferralCode($length = 10) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $code = '';

    for ($i = 0; $i < $length; $i++) {
        $code .= $characters[random_int(0, strlen($characters) - 1)];
    }

    // Check if code already exists
    $db = getDB();
    $stmt = $db->prepare("SELECT id FROM users WHERE referral_code = ?");
    $stmt->execute([$code]);

    if ($stmt->fetch()) {
        // Code exists, generate new one recursively
        return generateReferralCode($length);
    }

    return $code;
}

// Get user by ID
function getUserById($userId) {
    $db = getDB();
    $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$userId]);
    return $stmt->fetch();
}

// Update user last activity
function updateUserActivity($userId) {
    try {
        $db = getDB();
        $stmt = $db->prepare("UPDATE users SET last_activity = NOW() WHERE id = ?");
        $stmt->execute([$userId]);
        return true;
    } catch (Exception $e) {
        return false;
    }
}
