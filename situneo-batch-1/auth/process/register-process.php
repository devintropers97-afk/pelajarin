<?php
/**
 * ========================================
 * SITUNEO DIGITAL - Client Registration Process
 * Handle client registration
 * ========================================
 */

require_once __DIR__ . '/../../includes/session.php';
require_once __DIR__ . '/../../includes/auth.php';
require_once __DIR__ . '/../../includes/functions/user.php';
require_once __DIR__ . '/../../includes/functions/email.php';
require_once __DIR__ . '/../../includes/functions/validation.php';

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /auth/register.php');
    exit();
}

// Verify CSRF token
if (!validateCSRFFormToken()) {
    setFlashMessage('error', 'Invalid request. Please try again.');
    header('Location: /auth/register.php');
    exit();
}

// Get language
$lang = $_SESSION['lang'] ?? 'id';

// Get form data
$fullName = sanitizeInput($_POST['full_name'] ?? '');
$email = sanitizeInput($_POST['email'] ?? '');
$phone = sanitizeInput($_POST['phone'] ?? '');
$password = $_POST['password'] ?? '';
$confirmPassword = $_POST['confirm_password'] ?? '';
$agreeTerms = isset($_POST['agree_terms']);

// Validation
$errors = [];

// Validate full name
$nameErrors = validateFullName($fullName);
if (!empty($nameErrors)) {
    $errors = array_merge($errors, $nameErrors);
}

// Validate email
$emailErrors = validateEmail($email, true); // Check unique
if (!empty($emailErrors)) {
    $errors = array_merge($errors, $emailErrors);
}

// Validate phone (optional)
if (!empty($phone)) {
    $phoneErrors = validatePhone($phone);
    if (!empty($phoneErrors)) {
        $errors = array_merge($errors, $phoneErrors);
    }
}

// Validate password
$passwordErrors = validatePassword($password, $confirmPassword);
if (!empty($passwordErrors)) {
    $errors = array_merge($errors, $passwordErrors);
}

// Check terms agreement
if (!$agreeTerms) {
    $errors[] = $lang === 'id'
        ? 'Anda harus menyetujui syarat dan ketentuan'
        : 'You must agree to the terms and conditions';
}

// If there are errors, redirect back
if (!empty($errors)) {
    setFlashMessage('error', implode(', ', $errors));
    header('Location: /auth/register.php');
    exit();
}

// Create user
$userData = [
    'full_name' => $fullName,
    'email' => $email,
    'phone' => $phone,
    'password' => $password,
    'role' => 'client'
];

$result = createUser($userData);

if (!$result['success']) {
    setFlashMessage('error', $result['error']);
    header('Location: /auth/register.php');
    exit();
}

// Send verification email
$emailResult = sendVerificationEmail($email, $fullName, $result['verification_token']);

if ($emailResult['success']) {
    setFlashMessage('success', $lang === 'id'
        ? 'Pendaftaran berhasil! Silakan cek email Anda untuk verifikasi akun.'
        : 'Registration successful! Please check your email to verify your account.');
} else {
    setFlashMessage('success', $lang === 'id'
        ? 'Pendaftaran berhasil! Namun kami gagal mengirim email verifikasi. Silakan hubungi support.'
        : 'Registration successful! However, we failed to send verification email. Please contact support.');
}

// Redirect to login
header('Location: /auth/login.php');
exit();
