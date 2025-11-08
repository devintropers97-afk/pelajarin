<?php
// Load dependencies
require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/security.php';
require_once __DIR__ . '/session.php';

// Admin-only access
requireLogin();
requireAdmin();

$current_user = getCurrentUser();
$page_id = isset($page_id) ? $page_id : '';

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? $pageTitle : 'Admin Dashboard - SITUNEO DIGITAL' ?></title>
    <meta name="description" content="<?= isset($pageDescription) ? $pageDescription : 'Admin dashboard SITUNEO DIGITAL' ?>">

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
                <p class="text-muted small mb-0">Admin Panel</p>
            </div>

            <ul class="sidebar-menu">
                <li>
                    <a href="/admin/dashboard" class="<?= $page_id === 'dashboard' ? 'active' : '' ?>">
                        <i class="bi bi-speedometer2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="menu-section">
                    <span class="text-muted small">MANAGEMENT</span>
                </li>

                <li>
                    <a href="/admin/users" class="<?= $page_id === 'users' ? 'active' : '' ?>">
                        <i class="bi bi-people"></i>
                        <span>Users</span>
                    </a>
                </li>

                <li>
                    <a href="/admin/orders" class="<?= $page_id === 'orders' ? 'active' : '' ?>">
                        <i class="bi bi-cart-check"></i>
                        <span>Orders</span>
                    </a>
                </li>

                <li>
                    <a href="/admin/payments" class="<?= $page_id === 'payments' ? 'active' : '' ?>">
                        <i class="bi bi-credit-card"></i>
                        <span>Payments</span>
                    </a>
                </li>

                <li>
                    <a href="/admin/demo-requests" class="<?= $page_id === 'demo-requests' ? 'active' : '' ?>">
                        <i class="bi bi-rocket-takeoff"></i>
                        <span>Demo Requests</span>
                    </a>
                </li>

                <li class="menu-section">
                    <span class="text-muted small">CONTENT</span>
                </li>

                <li>
                    <a href="/admin/services" class="<?= $page_id === 'services' ? 'active' : '' ?>">
                        <i class="bi bi-grid"></i>
                        <span>Services</span>
                    </a>
                </li>

                <li>
                    <a href="/admin/packages" class="<?= $page_id === 'packages' ? 'active' : '' ?>">
                        <i class="bi bi-box-seam"></i>
                        <span>Packages</span>
                    </a>
                </li>

                <li>
                    <a href="/admin/portfolio" class="<?= $page_id === 'portfolio' ? 'active' : '' ?>">
                        <i class="bi bi-image"></i>
                        <span>Portfolio</span>
                    </a>
                </li>

                <li class="menu-section">
                    <span class="text-muted small">FREELANCER</span>
                </li>

                <li>
                    <a href="/admin/freelancers" class="<?= $page_id === 'freelancers' ? 'active' : '' ?>">
                        <i class="bi bi-person-badge"></i>
                        <span>Freelancers</span>
                    </a>
                </li>

                <li>
                    <a href="/admin/commissions" class="<?= $page_id === 'commissions' ? 'active' : '' ?>">
                        <i class="bi bi-cash-coin"></i>
                        <span>Commissions</span>
                    </a>
                </li>

                <li>
                    <a href="/admin/withdrawals" class="<?= $page_id === 'withdrawals' ? 'active' : '' ?>">
                        <i class="bi bi-wallet2"></i>
                        <span>Withdrawals</span>
                    </a>
                </li>

                <li class="menu-section">
                    <span class="text-muted small">SUPPORT</span>
                </li>

                <li>
                    <a href="/admin/tickets" class="<?= $page_id === 'tickets' ? 'active' : '' ?>">
                        <i class="bi bi-ticket-detailed"></i>
                        <span>Support Tickets</span>
                    </a>
                </li>

                <li>
                    <a href="/admin/reviews" class="<?= $page_id === 'reviews' ? 'active' : '' ?>">
                        <i class="bi bi-star"></i>
                        <span>Reviews</span>
                    </a>
                </li>

                <li>
                    <a href="/admin/contact-messages" class="<?= $page_id === 'contact-messages' ? 'active' : '' ?>">
                        <i class="bi bi-envelope"></i>
                        <span>Contact Messages</span>
                    </a>
                </li>

                <li class="menu-section">
                    <span class="text-muted small">REPORTS</span>
                </li>

                <li>
                    <a href="/admin/reports" class="<?= $page_id === 'reports' ? 'active' : '' ?>">
                        <i class="bi bi-graph-up"></i>
                        <span>Analytics & Reports</span>
                    </a>
                </li>

                <li class="menu-section">
                    <span class="text-muted small">SETTINGS</span>
                </li>

                <li>
                    <a href="/admin/settings" class="<?= $page_id === 'settings' ? 'active' : '' ?>">
                        <i class="bi bi-gear"></i>
                        <span>Settings</span>
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
                        <!-- Notifications -->
                        <div class="dropdown">
                            <button class="btn btn-outline-gold btn-sm position-relative" data-bs-toggle="dropdown">
                                <i class="bi bi-bell"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    5
                                </span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><h6 class="dropdown-header">Notifications</h6></li>
                                <li><a class="dropdown-item" href="#">New order from John Doe</a></li>
                                <li><a class="dropdown-item" href="#">Payment verified</a></li>
                                <li><a class="dropdown-item" href="#">New demo request</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-center" href="/admin/notifications">View All</a></li>
                            </ul>
                        </div>

                        <!-- User Profile -->
                        <div class="dropdown">
                            <button class="btn btn-outline-gold btn-sm" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-2"></i>
                                <?= htmlspecialchars($current_user['full_name']) ?>
                                <i class="bi bi-chevron-down ms-2"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="/admin/profile"><i class="bi bi-person me-2"></i>Profile</a></li>
                                <li><a class="dropdown-item" href="/admin/settings"><i class="bi bi-gear me-2"></i>Settings</a></li>
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
