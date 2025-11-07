<?php
// Load dependencies
require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/security.php';
require_once __DIR__ . '/session.php';

// Client-only access
requireLogin();

$current_user = getCurrentUser();
if ($current_user['role'] !== 'client') {
    header('Location: /');
    exit;
}

$page_id = isset($page_id) ? $page_id : '';

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? $pageTitle : 'Client Dashboard - SITUNEO DIGITAL' ?></title>
    <meta name="description" content="<?= isset($pageDescription) ? $pageDescription : 'Client dashboard SITUNEO DIGITAL' ?>">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="/assets/css/variables.css">
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/components.css">
    <link rel="stylesheet" href="/assets/css/pages.css">
    <link rel="stylesheet" href="/assets/css/animations.css">
</head>
<body class="dashboard-body">
    <?php displayFlash(); ?>

    <!-- Dashboard Wrapper -->
    <div class="dashboard-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h3 class="text-gold mb-0">SITUNEO</h3>
                <p class="text-muted small mb-0">Client Panel</p>
            </div>

            <ul class="sidebar-menu">
                <li>
                    <a href="/client/dashboard" class="<?= $page_id === 'dashboard' ? 'active' : '' ?>">
                        <i class="bi bi-speedometer2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="menu-section">
                    <span class="text-muted small">ORDERS & REQUESTS</span>
                </li>

                <li>
                    <a href="/client/demo-request" class="<?= $page_id === 'demo-request' ? 'active' : '' ?>">
                        <i class="bi bi-rocket-takeoff"></i>
                        <span>Request Demo</span>
                        <span class="badge badge-gold ms-auto">FREE</span>
                    </a>
                </li>

                <li>
                    <a href="/client/orders" class="<?= $page_id === 'orders' ? 'active' : '' ?>">
                        <i class="bi bi-cart-check"></i>
                        <span>My Orders</span>
                    </a>
                </li>

                <li>
                    <a href="/client/invoices" class="<?= $page_id === 'invoices' ? 'active' : '' ?>">
                        <i class="bi bi-receipt"></i>
                        <span>Invoices</span>
                    </a>
                </li>

                <li class="menu-section">
                    <span class="text-muted small">PAYMENTS</span>
                </li>

                <li>
                    <a href="/client/payment-upload" class="<?= $page_id === 'payment-upload' ? 'active' : '' ?>">
                        <i class="bi bi-upload"></i>
                        <span>Upload Payment</span>
                    </a>
                </li>

                <li class="menu-section">
                    <span class="text-muted small">SUPPORT</span>
                </li>

                <li>
                    <a href="/client/support" class="<?= $page_id === 'support' ? 'active' : '' ?>">
                        <i class="bi bi-headset"></i>
                        <span>Support Tickets</span>
                    </a>
                </li>

                <li>
                    <a href="/client/profile" class="<?= $page_id === 'profile' ? 'active' : '' ?>">
                        <i class="bi bi-person"></i>
                        <span>My Profile</span>
                    </a>
                </li>
            </ul>

            <div class="sidebar-footer">
                <a href="/auth/logout" class="btn btn-outline-gold btn-sm w-100">
                    <i class="bi bi-box-arrow-right me-2"></i>
                    Logout
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="dashboard-content">
            <!-- Top Header -->
            <div class="dashboard-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <button class="btn btn-outline-gold btn-sm me-3" id="sidebarToggle">
                            <i class="bi bi-list"></i>
                        </button>
                        <h4 class="d-inline text-light mb-0"><?= isset($pageHeading) ? $pageHeading : 'Dashboard' ?></h4>
                    </div>

                    <div class="d-flex align-items-center gap-3">
                        <!-- Quick Actions -->
                        <a href="/calculator" class="btn btn-gold btn-sm">
                            <i class="bi bi-calculator me-2"></i>
                            Calculate Price
                        </a>

                        <!-- User Profile -->
                        <div class="dropdown">
                            <button class="btn btn-outline-gold btn-sm" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-2"></i>
                                <?= htmlspecialchars($current_user['full_name']) ?>
                                <i class="bi bi-chevron-down ms-2"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="/client/profile"><i class="bi bi-person me-2"></i>Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="/"><i class="bi bi-house me-2"></i>Visit Site</a></li>
                                <li><a class="dropdown-item" href="/auth/logout"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page Content -->
            <div class="dashboard-page-content">
