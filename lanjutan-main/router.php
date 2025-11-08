<?php
/**
 * SITUNEO DIGITAL - Central Router
 * Handles all page routing
 */

// Load configuration
require_once __DIR__ . '/config/app.php';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/config/recaptcha.php';
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/security.php';
require_once __DIR__ . '/includes/session.php';

// Get current language
$lang = $_GET['lang'] ?? $_SESSION['lang'] ?? 'id';
$_SESSION['lang'] = $lang;

// Get requested URI
$request_uri = $_SERVER['REQUEST_URI'];
$uri = parse_url($request_uri, PHP_URL_PATH);
$uri = trim($uri, '/');

// Remove query string
$uri = explode('?', $uri)[0];

// Define routes
$routes = [
    // Public Pages
    '' => 'pages/home.php',
    'home' => 'pages/home.php',
    'about' => 'pages/about.php',
    'services' => 'pages/services.php',
    'portfolio' => 'pages/portfolio.php',
    'pricing' => 'pages/pricing.php',
    'calculator' => 'pages/calculator.php',
    'contact' => 'pages/contact.php',

    // Authentication Pages
    'auth/login' => 'auth/login.php',
    'login' => 'auth/login.php',
    'auth/register' => 'auth/register.php',
    'register' => 'auth/register.php',
    'auth/logout' => 'auth/logout.php',
    'logout' => 'auth/logout.php',
    'auth/forgot-password' => 'auth/forgot-password.php',
    'forgot-password' => 'auth/forgot-password.php',
    'auth/reset-password' => 'auth/reset-password.php',
    'reset-password' => 'auth/reset-password.php',
    'auth/verify-email' => 'auth/verify-email.php',
    'verify-email' => 'auth/verify-email.php',

    // Client Dashboard
    'client' => 'client/dashboard.php',
    'client/dashboard' => 'client/dashboard.php',
    'client/orders' => 'client/orders.php',
    'client/invoices' => 'client/invoices.php',
    'client/payment-upload' => 'client/payment-upload.php',
    'client/demo-request' => 'client/demo-request.php',
    'client/support' => 'client/support.php',
    'client/profile' => 'client/profile.php',

    // Freelancer Dashboard (Affiliate/Sales Agent)
    'freelancer' => 'freelancer/dashboard.php',
    'freelance' => 'freelancer/dashboard.php',
    'freelancer/dashboard' => 'freelancer/dashboard.php',
    'freelancer/referrals' => 'freelancer/referrals.php',
    'freelancer/demo-request' => 'freelancer/demo-request.php',
    'freelancer/services' => 'freelancer/services.php',
    'freelancer/tier' => 'freelancer/tier.php',
    'freelancer/withdrawals' => 'freelancer/withdrawals.php',
    'freelancer/tools' => 'freelancer/tools.php',
    'freelancer/analytics' => 'freelancer/analytics.php',
    'freelancer/profile' => 'client/profile.php', // Reuse client profile

    // Admin Dashboard
    'admin' => 'admin/dashboard.php',
    'admin/login' => 'admin/login.php',
    'admin/dashboard' => 'admin/dashboard.php',
    'admin/users' => 'admin/users.php',
    'admin/orders' => 'admin/orders.php',
    'admin/services' => 'admin/services.php',
    'admin/packages' => 'admin/packages.php',
    'admin/portfolio' => 'admin/portfolio.php',
    'admin/freelancers' => 'admin/freelancers.php',
    'admin/commissions' => 'admin/commissions.php',
    'admin/withdrawals' => 'admin/withdrawals.php',
    'admin/payments' => 'admin/payments.php',
    'admin/demo-requests' => 'admin/demo-requests.php',
    'admin/support' => 'admin/support.php',
    'admin/reviews' => 'admin/reviews.php',
    'admin/contact-messages' => 'admin/contact-messages.php',
    'admin/reports' => 'admin/reports.php',
    'admin/settings' => 'admin/settings.php',
];

// Check for service detail pages (pattern: service/[slug])
if (preg_match('#^service/([a-z0-9-]+)$#', $uri, $matches)) {
    $_GET['service'] = $matches[1];
    $file = __DIR__ . '/pages/service-detail.php';

    if (file_exists($file)) {
        require_once $file;
    } else {
        http_response_code(404);
        echo "404 - Service detail page not found";
    }
}
// Check if route exists
elseif (array_key_exists($uri, $routes)) {
    $file = __DIR__ . '/' . $routes[$uri];

    if (file_exists($file)) {
        require_once $file;
    } else {
        http_response_code(404);
        echo "404 - File not found: " . htmlspecialchars($routes[$uri]);
    }
} else {
    // Try direct file access (for backward compatibility)
    $file = __DIR__ . '/' . $uri . '.php';

    if (file_exists($file)) {
        require_once $file;
    } else {
        http_response_code(404);
        echo "404 - Page not found: " . htmlspecialchars($uri);
    }
}
