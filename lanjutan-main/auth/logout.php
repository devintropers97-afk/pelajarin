<?php
/**
 * SITUNEO DIGITAL - Logout
 * Handle user logout
 */

// Load dependencies
require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/security.php';
require_once __DIR__ . '/../includes/session.php';

// Logout user
if (isLoggedIn()) {
    // Get user info before logout (for log purposes)
    $user = getCurrentUser();
    $user_id = $user['id'];
    $user_email = $user['email'];

    // Delete remember me token if exists
    if (isset($_COOKIE['remember_token'])) {
        $token = $_COOKIE['remember_token'];

        if (!DEMO_MODE && $pdo) {
            try {
                $sql = "DELETE FROM remember_tokens WHERE token = ?";
                db_execute($sql, [$token]);
            } catch (Exception $e) {
                // Silent fail
            }
        }

        // Delete cookie
        setcookie('remember_token', '', time() - 3600, '/', '', true, true);
    }

    // Destroy session
    $_SESSION = [];

    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    session_destroy();

    // Redirect with success message
    header('Location: /?logout=success');
    exit;
} else {
    // Already logged out
    header('Location: /');
    exit;
}
