<?php
/**
 * SITUNEO DIGITAL - Email Configuration
 * SMTP settings untuk cPanel email
 */

// SMTP Configuration (cPanel)
define('SMTP_HOST', 'mail.situneo.my.id'); // Ganti dengan SMTP server cPanel
define('SMTP_PORT', 587); // 587 untuk TLS, 465 untuk SSL
define('SMTP_USERNAME', 'noreply@situneo.my.id'); // Email cPanel
define('SMTP_PASSWORD', ''); // Password email cPanel (isi nanti)
define('SMTP_ENCRYPTION', 'tls'); // tls atau ssl
define('SMTP_FROM_EMAIL', 'noreply@situneo.my.id');
define('SMTP_FROM_NAME', 'SITUNEO DIGITAL');

// Email Templates Path
define('EMAIL_TEMPLATE_PATH', BASE_PATH . '/emails/');

/**
 * Send Email Function menggunakan PHPMailer
 * (PHPMailer akan di-install via composer nanti)
 */
function send_email($to, $subject, $body, $altBody = '') {
    // Jika SMTP belum di-setup, log saja (untuk testing)
    if (DEMO_MODE || empty(SMTP_PASSWORD)) {
        error_log("Email would be sent to: $to");
        error_log("Subject: $subject");
        return true;
    }

    // TODO: Implement PHPMailer here
    // Untuk demo, return true dulu
    return true;
}

/**
 * Load Email Template
 */
function load_email_template($template_name, $variables = []) {
    $template_file = EMAIL_TEMPLATE_PATH . $template_name . '.php';

    if (!file_exists($template_file)) {
        return false;
    }

    // Extract variables
    extract($variables);

    // Start output buffering
    ob_start();
    include $template_file;
    $content = ob_get_clean();

    return $content;
}

/**
 * Send Welcome Email
 */
function send_welcome_email($user) {
    $subject = "Selamat Datang di SITUNEO DIGITAL!";
    $body = load_email_template('welcome', [
        'name' => $user['name'],
        'email' => $user['email']
    ]);

    return send_email($user['email'], $subject, $body);
}

/**
 * Send Email Verification
 */
function send_verification_email($user, $token) {
    $verification_link = SITE_URL . '/auth/verify-email.php?token=' . $token;

    $subject = "Verifikasi Email Anda - SITUNEO DIGITAL";
    $body = load_email_template('email-verification', [
        'name' => $user['name'],
        'verification_link' => $verification_link
    ]);

    return send_email($user['email'], $subject, $body);
}

/**
 * Send Password Reset Email
 */
function send_password_reset_email($user, $token) {
    $reset_link = SITE_URL . '/auth/reset-password.php?token=' . $token;

    $subject = "Reset Password Anda - SITUNEO DIGITAL";
    $body = load_email_template('forgot-password', [
        'name' => $user['name'],
        'reset_link' => $reset_link
    ]);

    return send_email($user['email'], $subject, $body);
}

/**
 * Send Order Confirmation Email
 */
function send_order_confirmation_email($order) {
    $subject = "Pesanan #{$order['order_number']} Berhasil Dibuat";
    $body = load_email_template('order-confirmation', [
        'order' => $order
    ]);

    return send_email($order['user_email'], $subject, $body);
}

/**
 * Send Payment Received Email
 */
function send_payment_received_email($payment) {
    $subject = "Pembayaran Diterima - Order #{$payment['order_number']}";
    $body = load_email_template('payment-received', [
        'payment' => $payment
    ]);

    return send_email($payment['user_email'], $subject, $body);
}

/**
 * Send Order Completed Email
 */
function send_order_completed_email($order) {
    $subject = "Pesanan Selesai - Order #{$order['order_number']}";
    $body = load_email_template('order-completed', [
        'order' => $order
    ]);

    return send_email($order['user_email'], $subject, $body);
}
