<?php
/**
 * ========================================
 * SITUNEO DIGITAL - Reset Password Process
 * Handle password reset with token
 * ========================================
 */

require_once __DIR__ . '/../../includes/session.php';
require_once __DIR__ . '/../../includes/auth.php';
require_once __DIR__ . '/../../includes/functions/user.php';
require_once __DIR__ . '/../../includes/functions/email.php';
require_once __DIR__ . '/../../includes/functions/validation.php';

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /auth/forgot-password.php');
    exit();
}

// Verify CSRF token
if (!validateCSRFFormToken()) {
    setFlashMessage('error', 'Invalid request. Please try again.');
    header('Location: /auth/forgot-password.php');
    exit();
}

// Get language
$lang = $_SESSION['lang'] ?? 'id';

// Get form data
$token = sanitizeInput($_POST['token'] ?? '');
$password = $_POST['password'] ?? '';
$confirmPassword = $_POST['confirm_password'] ?? '';

// Validate token
if (empty($token) || !validateToken($token)) {
    setFlashMessage('error', $lang === 'id'
        ? 'Token reset tidak valid'
        : 'Invalid reset token');
    header('Location: /auth/forgot-password.php');
    exit();
}

// Validate password
$passwordErrors = validatePassword($password, $confirmPassword);
if (!empty($passwordErrors)) {
    setFlashMessage('error', implode(', ', $passwordErrors));
    header('Location: /auth/reset-password.php?token=' . urlencode($token));
    exit();
}

// Reset password
$result = resetPasswordWithToken($token, $password);

if (!$result['success']) {
    setFlashMessage('error', $lang === 'id'
        ? 'Gagal mereset password. Link mungkin sudah kedaluwarsa.'
        : 'Failed to reset password. The link may have expired.');
    header('Location: /auth/forgot-password.php');
    exit();
}

// Get user info to send confirmation email
$userData = verifyPasswordResetToken($token);
if ($userData) {
    sendPasswordChangedEmail($userData['email'], $userData['full_name']);
}

// Success
setFlashMessage('success', $lang === 'id'
    ? 'Password berhasil direset! Silakan login dengan password baru Anda.'
    : 'Password successfully reset! Please login with your new password.');

header('Location: /auth/login.php');
exit();
