<?php
/**
 * ========================================
 * SITUNEO DIGITAL - Forgot Password Process
 * Send password reset link to user's email
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
$email = sanitizeInput($_POST['email'] ?? '');

// Validate email
if (empty($email)) {
    setFlashMessage('error', $lang === 'id'
        ? 'Email wajib diisi'
        : 'Email is required');
    header('Location: /auth/forgot-password.php');
    exit();
}

$emailErrors = validateEmail($email);
if (!empty($emailErrors)) {
    setFlashMessage('error', implode(', ', $emailErrors));
    header('Location: /auth/forgot-password.php');
    exit();
}

// Create password reset token
$result = createPasswordResetToken($email);

// Always show success message (security best practice - don't reveal if email exists)
if ($result['success']) {
    // Send password reset email
    $emailResult = sendPasswordResetEmail(
        $email,
        $result['user']['full_name'],
        $result['token']
    );

    if ($emailResult['success']) {
        setFlashMessage('success', $lang === 'id'
            ? 'Link reset password telah dikirim ke email Anda. Silakan cek inbox atau folder spam.'
            : 'Password reset link has been sent to your email. Please check your inbox or spam folder.');
    } else {
        setFlashMessage('error', $lang === 'id'
            ? 'Gagal mengirim email. Silakan coba lagi atau hubungi support.'
            : 'Failed to send email. Please try again or contact support.');
    }
} else {
    // Don't reveal if email doesn't exist - show generic success message
    setFlashMessage('success', $lang === 'id'
        ? 'Jika email tersebut terdaftar, link reset password akan dikirim.'
        : 'If that email is registered, a password reset link will be sent.');
}

// Redirect back to forgot password page
header('Location: /auth/forgot-password.php');
exit();
