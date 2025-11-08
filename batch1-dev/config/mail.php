<?php
/**
 * Email Configuration
 *
 * SMTP and email settings for SITUNEO
 * Can be overridden by database settings
 *
 * @package SITUNEO
 * @subpackage Config
 */

// Prevent direct access
defined('SITUNEO_ACCESS') or die('Direct access not permitted');

// =============================================================================
// SMTP CONFIGURATION
// =============================================================================

define('SMTP_HOST', 'mail.situneo.my.id');  // SMTP server
define('SMTP_PORT', 587);  // 587 for TLS, 465 for SSL, 25 for non-secure
define('SMTP_ENCRYPTION', 'tls');  // tls | ssl | none
define('SMTP_USER', 'noreply@situneo.my.id');
define('SMTP_PASS', '');  // Password untuk email (akan di-set di production)
define('SMTP_AUTH', true);  // Enable SMTP authentication
define('SMTP_TIMEOUT', 30);  // Connection timeout in seconds

// =============================================================================
// EMAIL FROM SETTINGS
// =============================================================================

define('MAIL_FROM_EMAIL', 'noreply@situneo.my.id');
define('MAIL_FROM_NAME', 'SITUNEO DIGITAL');
define('MAIL_REPLY_TO', 'admin@situneo.my.id');
define('MAIL_REPLY_TO_NAME', 'SITUNEO Support');

// =============================================================================
// EMAIL CONTENT SETTINGS
// =============================================================================

define('MAIL_CHARSET', 'UTF-8');
define('MAIL_CONTENT_TYPE', 'text/html');  // text/html | text/plain
define('MAIL_PRIORITY', 3);  // 1 = High, 3 = Normal, 5 = Low
define('MAIL_WORD_WRAP', 70);  // Character wrap limit

// =============================================================================
// EMAIL TEMPLATE SETTINGS
// =============================================================================

define('MAIL_USE_TEMPLATES', true);
define('MAIL_TEMPLATE_PATH', dirname(__DIR__) . '/templates/email/');
define('MAIL_DEFAULT_TEMPLATE', 'default.html');
define('MAIL_LOGO_URL', SITE_URL . '/assets/images/logo.png');

// Template variables yang selalu tersedia
define('MAIL_TEMPLATE_VARS', serialize([
    'site_name' => SITE_NAME,
    'site_url' => SITE_URL,
    'company_name' => COMPANY_NAME,
    'company_phone' => COMPANY_PHONE,
    'company_email' => COMPANY_EMAIL,
    'year' => date('Y'),
]));

// =============================================================================
// EMAIL TYPES & SUBJECTS
// =============================================================================

$email_subjects = [
    // Authentication
    'welcome' => 'Selamat Datang di SITUNEO DIGITAL',
    'verify_email' => 'Verifikasi Email Anda - SITUNEO',
    'reset_password' => 'Reset Password - SITUNEO',
    'password_changed' => 'Password Berhasil Diubah - SITUNEO',

    // Orders
    'order_confirmation' => 'Order Confirmation #{{order_number}} - SITUNEO',
    'order_processing' => 'Order Anda Sedang Diproses #{{order_number}}',
    'order_completed' => 'Order Selesai #{{order_number}} - SITUNEO',
    'order_cancelled' => 'Order Dibatalkan #{{order_number}} - SITUNEO',

    // Payments
    'payment_received' => 'Pembayaran Diterima - Invoice #{{invoice_number}}',
    'payment_reminder' => 'Reminder: Invoice #{{invoice_number}} Menunggu Pembayaran',
    'payment_verified' => 'Pembayaran Terverifikasi - Invoice #{{invoice_number}}',

    // Invoices
    'new_invoice' => 'Invoice Baru #{{invoice_number}} - SITUNEO',
    'invoice_overdue' => 'Invoice Jatuh Tempo #{{invoice_number}}',

    // Freelancers
    'freelancer_approved' => 'Akun Freelancer Disetujui - SITUNEO',
    'freelancer_rejected' => 'Update Status Pendaftaran Freelancer',
    'commission_available' => 'Komisi Tersedia untuk Penarikan - SITUNEO',
    'withdrawal_approved' => 'Penarikan Komisi Disetujui - SITUNEO',
    'withdrawal_rejected' => 'Update Penarikan Komisi - SITUNEO',

    // Subscriptions
    'subscription_created' => 'Subscription Aktif - SITUNEO',
    'subscription_renewal' => 'Reminder: Renewal Subscription #{{subscription_id}}',
    'subscription_cancelled' => 'Subscription Dibatalkan - SITUNEO',
    'subscription_payment_failed' => 'Pembayaran Subscription Gagal - Action Required',

    // Demo Requests
    'demo_request_received' => 'Demo Request Diterima - SITUNEO',
    'demo_ready' => 'Demo Website Anda Sudah Siap! - SITUNEO',

    // Support
    'ticket_created' => 'Support Ticket #{{ticket_id}} Dibuat - SITUNEO',
    'ticket_reply' => 'Reply Baru pada Ticket #{{ticket_id}} - SITUNEO',
    'ticket_resolved' => 'Ticket #{{ticket_id}} Resolved - SITUNEO',

    // Notifications
    'notification' => 'Notifikasi Baru - SITUNEO',
    'newsletter' => '{{subject}} - SITUNEO Newsletter',

    // Admin
    'admin_alert' => 'Admin Alert: {{alert_type}} - SITUNEO',
];

define('EMAIL_SUBJECTS', serialize($email_subjects));

// =============================================================================
// EMAIL QUEUE SETTINGS
// =============================================================================

define('MAIL_USE_QUEUE', true);  // Queue emails for batch sending
define('MAIL_QUEUE_TABLE', 'email_queue');
define('MAIL_QUEUE_RETRY_LIMIT', 3);  // Max retry attempts
define('MAIL_QUEUE_RETRY_DELAY', 300);  // 5 minutes between retries

// =============================================================================
// EMAIL RATE LIMITING
// =============================================================================

define('MAIL_RATE_LIMIT', 100);  // Max emails per hour
define('MAIL_PER_USER_LIMIT', 10);  // Max emails per user per hour
define('MAIL_THROTTLE_DELAY', 1);  // Delay between emails in seconds

// =============================================================================
// NOTIFICATION SETTINGS
// =============================================================================

define('NOTIFY_ADMIN_NEW_ORDER', true);
define('NOTIFY_ADMIN_NEW_USER', true);
define('NOTIFY_ADMIN_NEW_PAYMENT', true);
define('NOTIFY_ADMIN_NEW_TICKET', true);
define('NOTIFY_ADMIN_DEMO_REQUEST', true);

define('NOTIFY_USER_ORDER_STATUS', true);
define('NOTIFY_USER_PAYMENT_STATUS', true);
define('NOTIFY_USER_TICKET_REPLY', true);

define('NOTIFY_FREELANCER_COMMISSION', true);
define('NOTIFY_FREELANCER_WITHDRAWAL', true);
define('NOTIFY_FREELANCER_NEW_REFERRAL', true);

// =============================================================================
// EMAIL LOGGING
// =============================================================================

define('MAIL_LOG_ENABLED', true);
define('MAIL_LOG_PATH', dirname(__DIR__) . '/logs/email.log');
define('MAIL_LOG_LEVEL', 'all');  // all | errors | none

// =============================================================================
// TESTING & DEBUG
// =============================================================================

define('MAIL_DEBUG_MODE', false);  // Enable debug output
define('MAIL_TEST_MODE', false);  // Don't actually send, just log
define('MAIL_TEST_EMAIL', 'test@situneo.my.id');  // Send all emails here when testing

// =============================================================================
// ALTERNATIVE MAIL DRIVERS
// =============================================================================

// Sendmail
define('SENDMAIL_PATH', '/usr/sbin/sendmail -bs');

// Mailgun (optional)
define('MAILGUN_DOMAIN', '');
define('MAILGUN_API_KEY', '');

// SendGrid (optional)
define('SENDGRID_API_KEY', '');

// =============================================================================
// EMAIL SIGNATURES
// =============================================================================

define('EMAIL_SIGNATURE', '
<br><br>
<hr style="border: 0; border-top: 1px solid #eee;">
<p style="color: #666; font-size: 12px;">
    <strong>SITUNEO DIGITAL</strong><br>
    Website Era Baru - Solusi Digital Terlengkap<br>
    Email: admin@situneo.my.id | WhatsApp: +62 831-7386-8915<br>
    Website: <a href="https://situneo.my.id">situneo.my.id</a>
</p>
');

// =============================================================================
// UNSUBSCRIBE SETTINGS
// =============================================================================

define('MAIL_INCLUDE_UNSUBSCRIBE', true);
define('UNSUBSCRIBE_URL', SITE_URL . '/unsubscribe');
define('UNSUBSCRIBE_TEXT', 'Jika Anda tidak ingin menerima email ini lagi, klik <a href="{{unsubscribe_url}}">unsubscribe</a>.');
