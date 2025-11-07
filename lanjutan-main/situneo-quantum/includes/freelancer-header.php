<?php
// Load dependencies
require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/security.php';
require_once __DIR__ . '/session.php';

// Freelancer-only access
requireLogin();

$current_user = getCurrentUser();
if ($current_user['role'] !== 'freelancer') {
    header('Location: /');
    exit;
}

$page_id = isset($page_id) ? $page_id : '';

// Get freelancer tier and stats (demo data)
$freelancer_stats = [
    'tier' => 2, // Tier 1, 2, or 3
    'tier_name' => 'PRO', // STARTER, PRO, EXPERT
    'commission_rate' => 40, // 30%, 40%, or 50%
    'monthly_orders' => 15,
    'total_earnings' => 12500000,
    'pending_withdrawal' => 2500000,
    'active_projects' => 3,
];

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? $pageTitle : 'Freelancer Dashboard - SITUNEO DIGITAL' ?></title>
    <meta name="description" content="<?= isset($pageDescription) ? $pageDescription : 'Freelancer dashboard SITUNEO DIGITAL' ?>">

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
                <p class="text-muted small mb-0">Freelancer Panel</p>
            </div>

            <!-- Tier Badge -->
            <div class="card bg-dark p-3 mb-3 mx-3">
                <div class="text-center">
                    <?php
                    // Tier badge (PHP 7.4 compatible)
                    if ($freelancer_stats['tier'] == 1) {
                        echo '<span class="badge bg-secondary">STARTER</span>';
                    } elseif ($freelancer_stats['tier'] == 2) {
                        echo '<span class="badge bg-info">PRO</span>';
                    } elseif ($freelancer_stats['tier'] == 3) {
                        echo '<span class="badge bg-success">EXPERT</span>';
                    } else {
                        echo '<span class="badge bg-secondary">-</span>';
                    }
                    ?>
                    <h4 class="text-gold my-2"><?= $freelancer_stats['commission_rate'] ?>%</h4>
                    <small class="text-muted">Commission Rate</small>
                    <div class="progress mt-2" style="height: 5px;">
                        <?php
                        $progress = min(100, ($freelancer_stats['monthly_orders'] / 50) * 100);
                        ?>
                        <div class="progress-bar bg-gold" style="width: <?= $progress ?>%"></div>
                    </div>
                    <small class="text-muted"><?= $freelancer_stats['monthly_orders'] ?>/50 orders this month</small>
                </div>
            </div>

            <ul class="sidebar-menu">
                <li>
                    <a href="/freelancer/dashboard" class="<?= $page_id === 'dashboard' ? 'active' : '' ?>">
                        <i class="bi bi-speedometer2"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="menu-section">
                    <span class="text-muted small">REFERRAL & CLIENTS</span>
                </li>

                <li>
                    <a href="/freelancer/referrals" class="<?= $page_id === 'referrals' ? 'active' : '' ?>">
                        <i class="bi bi-person-hearts"></i>
                        <span>My Referrals</span>
                    </a>
                </li>

                <li>
                    <a href="/freelancer/demo-request" class="<?= $page_id === 'demo-request' ? 'active' : '' ?>">
                        <i class="bi bi-file-earmark-text"></i>
                        <span>Request Demo</span>
                    </a>
                </li>

                <li>
                    <a href="/freelancer/services" class="<?= $page_id === 'services' ? 'active' : '' ?>">
                        <i class="bi bi-grid-3x3-gap"></i>
                        <span>Katalog Layanan</span>
                    </a>
                </li>

                <li class="menu-section">
                    <span class="text-muted small">KOMISI & EARNINGS</span>
                </li>

                <li>
                    <a href="/freelancer/tier" class="<?= $page_id === 'tier' ? 'active' : '' ?>">
                        <i class="bi bi-trophy"></i>
                        <span>Tier & Komisi</span>
                    </a>
                </li>

                <li>
                    <a href="/freelancer/withdrawals" class="<?= $page_id === 'withdrawals' ? 'active' : '' ?>">
                        <i class="bi bi-cash-coin"></i>
                        <span>Penarikan Komisi</span>
                    </a>
                </li>

                <li class="menu-section">
                    <span class="text-muted small">TOOLS & ANALYTICS</span>
                </li>

                <li>
                    <a href="/freelancer/tools" class="<?= $page_id === 'tools' ? 'active' : '' ?>">
                        <i class="bi bi-tools"></i>
                        <span>Referral Tools</span>
                    </a>
                </li>

                <li>
                    <a href="/freelancer/analytics" class="<?= $page_id === 'analytics' ? 'active' : '' ?>">
                        <i class="bi bi-graph-up"></i>
                        <span>Analytics</span>
                    </a>
                </li>

                <li class="menu-section">
                    <span class="text-muted small">ACCOUNT</span>
                </li>

                <li>
                    <a href="/freelancer/profile" class="<?= $page_id === 'profile' ? 'active' : '' ?>">
                        <i class="bi bi-person"></i>
                        <span>My Profile</span>
                    </a>
                </li>

                <li>
                    <a href="/services" target="_blank" class="<?= $page_id === 'all-services' ? 'active' : '' ?>">
                        <i class="bi bi-box-arrow-up-right"></i>
                        <span>My Portfolio</span>
                    </a>
                </li>

                <li>
                    <a href="/freelancer/skills" class="<?= $page_id === 'skills' ? 'active' : '' ?>">
                        <i class="bi bi-tools"></i>
                        <span>Skills & Rates</span>
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
                        <!-- Earnings Quick View -->
                        <div class="card bg-dark px-3 py-2">
                            <small class="text-muted">Total Earnings</small>
                            <strong class="text-gold"><?= formatRupiah($freelancer_stats['total_earnings']) ?></strong>
                        </div>

                        <!-- Notifications -->
                        <div class="dropdown">
                            <button class="btn btn-outline-gold btn-sm position-relative" data-bs-toggle="dropdown">
                                <i class="bi bi-bell"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    3
                                </span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><h6 class="dropdown-header">Notifications</h6></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-check-circle me-2 text-success"></i>New project assigned</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-cash me-2 text-warning"></i>Payment received</a></li>
                                <li><a class="dropdown-item" href="#"><i class="bi bi-trophy me-2 text-gold"></i>Tier upgraded!</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item text-center" href="#">View All</a></li>
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
                                <li><a class="dropdown-item" href="/freelancer/profile"><i class="bi bi-person me-2"></i>Profile</a></li>
                                <li><a class="dropdown-item" href="/freelancer/portfolio"><i class="bi bi-briefcase me-2"></i>Portfolio</a></li>
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
