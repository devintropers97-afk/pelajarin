<?php
/**
 * SITUNEO DIGITAL - Main Entry Point
 *
 * Front controller untuk semua requests
 * Handles routing untuk public, admin, client, dan freelancer areas
 *
 * @package SITUNEO
 * @version 2.0 (Batch 2)
 */

// Define access constant
define('SITUNEO_ACCESS', true);

// Load bootstrap (loads all configs and core classes)
require_once __DIR__ . '/config/bootstrap.php';

// Attempt remember me login if not logged in
if (!Auth::check()) {
    Auth::attemptRememberMe();
}

// ============================================================================
// DEFINE ROUTES
// ============================================================================

// Initialize router
Router::init();

// ============================================================================
// PUBLIC ROUTES
// ============================================================================

// Homepage
Router::get('/', function() {
    require PUBLIC_PATH . 'index.php';
});

Router::get('/home', function() {
    Router::redirect('/');
});

// About
Router::get('/about', function() {
    require PUBLIC_PATH . 'about.php';
});

// Services
Router::get('/services', function() {
    require PUBLIC_PATH . 'services.php';
});

Router::get('/services/{slug}', function($slug) {
    require PUBLIC_PATH . 'service-detail.php';
});

// Pricing
Router::get('/pricing', function() {
    require PUBLIC_PATH . 'pricing.php';
});

Router::get('/calculator', function() {
    require PUBLIC_PATH . 'calculator.php';
});

// Portfolio
Router::get('/portfolio', function() {
    require PUBLIC_PATH . 'portfolio.php';
});

Router::get('/portfolio/{slug}', function($slug) {
    require PUBLIC_PATH . 'portfolio-detail.php';
});

// Blog
Router::get('/blog', function() {
    require PUBLIC_PATH . 'blog.php';
});

Router::get('/blog/{slug}', function($slug) {
    require PUBLIC_PATH . 'blog-detail.php';
});

// Contact
Router::get('/contact', function() {
    require PUBLIC_PATH . 'contact.php';
});

Router::post('/contact', function() {
    require PUBLIC_PATH . 'contact-submit.php';
});

// Demo Request
Router::get('/demo', function() {
    require PUBLIC_PATH . 'demo-request.php';
});

Router::post('/demo', function() {
    require PUBLIC_PATH . 'demo-submit.php';
});

// ============================================================================
// AUTH ROUTES
// ============================================================================

// Login
Router::get('/login', function() {
    if (Auth::check()) {
        // Redirect based on role
        if (Auth::isAdmin()) {
            Router::redirect('/admin');
        } elseif (Auth::isFreelancer()) {
            Router::redirect('/freelancer');
        } else {
            Router::redirect('/client');
        }
    }
    require PUBLIC_PATH . 'auth/login.php';
});

Router::post('/login', function() {
    require PUBLIC_PATH . 'auth/login-submit.php';
});

// Register
Router::get('/register', function() {
    if (Auth::check()) {
        Router::redirect('/');
    }
    require PUBLIC_PATH . 'auth/register.php';
});

Router::post('/register', function() {
    require PUBLIC_PATH . 'auth/register-submit.php';
});

// Register Freelancer
Router::get('/register/freelancer', function() {
    if (Auth::check()) {
        Router::redirect('/');
    }
    require PUBLIC_PATH . 'auth/register-freelancer.php';
});

// Logout
Router::get('/logout', function() {
    Auth::logout();
    Session::flashSuccess('Anda telah logout');
    Router::redirect('/');
});

// Email Verification
Router::get('/verify/{token}', function($token) {
    if (Auth::verifyEmail($token)) {
        Session::flashSuccess('Email berhasil diverifikasi. Silakan login.');
    } else {
        Session::flashError('Link verifikasi tidak valid atau sudah kadaluarsa.');
    }
    Router::redirect('/login');
});

// Forgot Password
Router::get('/forgot-password', function() {
    require PUBLIC_PATH . 'auth/forgot-password.php';
});

Router::post('/forgot-password', function() {
    require PUBLIC_PATH . 'auth/forgot-password-submit.php';
});

// Reset Password
Router::get('/reset-password/{token}', function($token) {
    require PUBLIC_PATH . 'auth/reset-password.php';
});

Router::post('/reset-password', function() {
    require PUBLIC_PATH . 'auth/reset-password-submit.php';
});

// ============================================================================
// CLIENT DASHBOARD ROUTES
// ============================================================================

Router::get('/client', function() {
    Auth::requireRole(Auth::ROLE_CLIENT);
    require CLIENT_PATH . 'index.php';
});

Router::get('/client/orders', function() {
    Auth::requireRole(Auth::ROLE_CLIENT);
    require CLIENT_PATH . 'orders.php';
});

Router::get('/client/orders/{id}', function($id) {
    Auth::requireRole(Auth::ROLE_CLIENT);
    require CLIENT_PATH . 'order-detail.php';
});

Router::get('/client/invoices', function() {
    Auth::requireRole(Auth::ROLE_CLIENT);
    require CLIENT_PATH . 'invoices.php';
});

Router::get('/client/profile', function() {
    Auth::requireRole(Auth::ROLE_CLIENT);
    require CLIENT_PATH . 'profile.php';
});

// ============================================================================
// FREELANCER DASHBOARD ROUTES
// ============================================================================

Router::get('/freelancer', function() {
    Auth::requireRole(Auth::ROLE_FREELANCER);
    require FREELANCER_PATH . 'index.php';
});

Router::get('/freelancer/referrals', function() {
    Auth::requireRole(Auth::ROLE_FREELANCER);
    require FREELANCER_PATH . 'referrals.php';
});

Router::get('/freelancer/commissions', function() {
    Auth::requireRole(Auth::ROLE_FREELANCER);
    require FREELANCER_PATH . 'commissions.php';
});

Router::get('/freelancer/withdraw', function() {
    Auth::requireRole(Auth::ROLE_FREELANCER);
    require FREELANCER_PATH . 'withdraw.php';
});

Router::get('/freelancer/profile', function() {
    Auth::requireRole(Auth::ROLE_FREELANCER);
    require FREELANCER_PATH . 'profile.php';
});

// ============================================================================
// ADMIN ROUTES
// ============================================================================

Router::get('/admin', function() {
    Auth::requireAdmin();
    require ADMIN_PATH . 'index.php';
});

Router::get('/admin/services', function() {
    Auth::requireAdmin();
    require ADMIN_PATH . 'services.php';
});

Router::get('/admin/orders', function() {
    Auth::requireAdmin();
    require ADMIN_PATH . 'orders.php';
});

Router::get('/admin/users', function() {
    Auth::requireAdmin();
    require ADMIN_PATH . 'users.php';
});

Router::get('/admin/settings', function() {
    Auth::requireAdmin();
    require ADMIN_PATH . 'settings.php';
});

// ============================================================================
// API ROUTES (Optional)
// ============================================================================

Router::get('/api/services', function() {
    try {
        $db = Database::getInstance();
        $services = $db->select('services', '*', 'is_active = 1');
        json_success('Services retrieved', $services);
    } catch (Exception $e) {
        json_error('Failed to retrieve services', [], 500);
    }
});

// ============================================================================
// DISPATCH ROUTER
// ============================================================================

Router::dispatch();
