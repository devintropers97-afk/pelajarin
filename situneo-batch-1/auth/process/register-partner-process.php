<?php
/**
 * ========================================
 * SITUNEO DIGITAL - Partner Registration Process
 * Handle partner registration
 * ========================================
 */

require_once __DIR__ . '/../../includes/session.php';
require_once __DIR__ . '/../../includes/auth.php';
require_once __DIR__ . '/../../includes/functions/user.php';
require_once __DIR__ . '/../../includes/functions/email.php';
require_once __DIR__ . '/../../includes/functions/validation.php';

// Only accept POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: /auth/register-partner.php');
    exit();
}

// Verify CSRF token
if (!validateCSRFFormToken()) {
    setFlashMessage('error', 'Invalid request. Please try again.');
    header('Location: /auth/register-partner.php');
    exit();
}

// Get language
$lang = $_SESSION['lang'] ?? 'id';

// Get form data
$fullName = sanitizeInput($_POST['full_name'] ?? '');
$email = sanitizeInput($_POST['email'] ?? '');
$phone = sanitizeInput($_POST['phone'] ?? '');
$companyName = sanitizeInput($_POST['company_name'] ?? '');
$referredBy = sanitizeInput(strtoupper($_POST['referred_by'] ?? ''));
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

// Validate phone (required for partners)
$phoneErrors = validatePhone($phone, true);
if (!empty($phoneErrors)) {
    $errors = array_merge($errors, $phoneErrors);
}

// Validate referral code (optional)
if (!empty($referredBy)) {
    $referralErrors = validateReferralCode($referredBy, true); // Check exists
    if (!empty($referralErrors)) {
        $errors = array_merge($errors, $referralErrors);
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
        ? 'Anda harus menyetujui syarat dan ketentuan partner'
        : 'You must agree to the partner terms and conditions';
}

// If there are errors, redirect back
if (!empty($errors)) {
    setFlashMessage('error', implode(', ', $errors));
    header('Location: /auth/register-partner.php');
    exit();
}

// Create user
$userData = [
    'full_name' => $fullName,
    'email' => $email,
    'phone' => $phone,
    'company_name' => $companyName,
    'password' => $password,
    'role' => 'partner',
    'referred_by' => !empty($referredBy) ? $referredBy : null
];

$result = createUser($userData);

if (!$result['success']) {
    setFlashMessage('error', $result['error']);
    header('Location: /auth/register-partner.php');
    exit();
}

// Get the created user to get referral code
$db = getDB();
$stmt = $db->prepare("SELECT referral_code FROM users WHERE id = ?");
$stmt->execute([$result['user_id']]);
$userReferralCode = $stmt->fetchColumn();

// Send verification email
$emailResult = sendVerificationEmail($email, $fullName, $result['verification_token']);

// Send partner welcome email
if ($emailResult['success']) {
    sendPartnerWelcomeEmail($email, $fullName, $userReferralCode);
}

if ($emailResult['success']) {
    setFlashMessage('success', $lang === 'id'
        ? 'Pendaftaran partner berhasil! Kode referral Anda: ' . $userReferralCode . '. Silakan cek email untuk verifikasi.'
        : 'Partner registration successful! Your referral code: ' . $userReferralCode . '. Please check your email for verification.');
} else {
    setFlashMessage('success', $lang === 'id'
        ? 'Pendaftaran partner berhasil! Kode referral: ' . $userReferralCode . '. Namun gagal mengirim email verifikasi.'
        : 'Partner registration successful! Referral code: ' . $userReferralCode . '. However, failed to send verification email.');
}

// Redirect to login
header('Location: /auth/login.php');
exit();
