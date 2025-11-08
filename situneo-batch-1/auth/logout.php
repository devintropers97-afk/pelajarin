<?php
/**
 * ========================================
 * SITUNEO DIGITAL - Logout
 * Destroy session and redirect to login
 * ========================================
 */

require_once __DIR__ . '/../includes/session.php';
require_once __DIR__ . '/../includes/auth.php';

// Log activity before destroying session
if (isLoggedIn()) {
    $userId = $_SESSION['user_id'] ?? null;
    if ($userId) {
        logActivity($userId, 'user_logout', 'User logged out');
    }

    // Delete remember me cookie if exists
    deleteRememberMeCookie();
}

// Destroy session
destroySession();

// Set flash message for login page
session_start();
$_SESSION['lang'] = $_GET['lang'] ?? 'id';
setFlashMessage('success', $_SESSION['lang'] === 'id' ? 'Anda telah berhasil keluar.' : 'You have successfully logged out.');

// Redirect to login page
header('Location: /auth/login.php');
exit();
