<?php
/**
 * ========================================
 * SITUNEO DIGITAL - Login Process
 * Handle user login authentication
 * ========================================
 */

require_once __DIR__ . '/../../includes/session.php';
require_once __DIR__ . '/../../includes/auth.php';
require_once __DIR__ . '/../../includes/functions/user.php';
require_once __DIR__ . '/../../includes/functions/validation.php';

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /auth/login.php');
    exit();
}

// Verify CSRF token
if (!validateCSRFFormToken()) {
    setFlashMessage('error', 'Invalid request. Please try again.');
    header('Location: /auth/login.php');
    exit();
}

// Get language
$lang = $_SESSION['lang'] ?? 'id';

// Get form data
$email = sanitizeInput($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$rememberMe = isset($_POST['remember_me']) && $_POST['remember_me'] == '1';

// Validate input
$errors = [];

if (empty($email)) {
    $errors[] = $lang === 'id' ? 'Email wajib diisi' : 'Email is required';
}

if (empty($password)) {
    $errors[] = $lang === 'id' ? 'Kata sandi wajib diisi' : 'Password is required';
}

if (!empty($errors)) {
    setFlashMessage('error', implode(', ', $errors));
    header('Location: /auth/login.php');
    exit();
}

// Rate limiting check
$ipAddress = $_SERVER['REMOTE_ADDR'];
if (!checkLoginRateLimit($ipAddress)) {
    setFlashMessage('error', $lang === 'id'
        ? 'Terlalu banyak percobaan login. Silakan coba lagi dalam 15 menit.'
        : 'Too many login attempts. Please try again in 15 minutes.');
    header('Location: /auth/login.php');
    exit();
}

// Get user by email
$user = getUserByEmail($email);

if (!$user) {
    // Log failed attempt
    logActivity(0, 'login_failed', 'Failed login attempt for email: ' . $email, $ipAddress);

    setFlashMessage('error', $lang === 'id'
        ? 'Email atau kata sandi salah'
        : 'Incorrect email or password');
    header('Location: /auth/login.php');
    exit();
}

// Verify password
if (!verifyPassword($password, $user['password'])) {
    // Log failed attempt
    logActivity($user['id'], 'login_failed', 'Failed login attempt - wrong password', $ipAddress);

    setFlashMessage('error', $lang === 'id'
        ? 'Email atau kata sandi salah'
        : 'Incorrect email or password');
    header('Location: /auth/login.php');
    exit();
}

// Check if account is active
if ($user['status'] !== 'active') {
    setFlashMessage('error', $lang === 'id'
        ? 'Akun Anda tidak aktif. Silakan hubungi support.'
        : 'Your account is not active. Please contact support.');
    header('Location: /auth/login.php');
    exit();
}

// Check if password needs rehash (security upgrade)
if (needsRehash($user['password'])) {
    updateUserPassword($user['id'], $password);
}

// Handle remember me
if ($rememberMe) {
    $rememberToken = generateSecureToken(32);
    setRememberToken($user['id'], $rememberToken);
    setRememberMeCookie($user['id'], $rememberToken);
}

// Create session
createUserSession($user);

// Log successful login
logActivity($user['id'], 'user_login', 'User logged in successfully', $ipAddress);

// Set success message
setFlashMessage('success', $lang === 'id'
    ? 'Selamat datang kembali, ' . $user['full_name'] . '!'
    : 'Welcome back, ' . $user['full_name'] . '!');

// Redirect to appropriate dashboard
$redirectUrl = $_GET['redirect'] ?? getDashboardUrl();
header('Location: ' . $redirectUrl);
exit();
