<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?? 'Admin Panel - SITUNEO DIGITAL' ?></title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Main CSS -->
    <link href="<?= url('assets/css/main.css') ?>" rel="stylesheet">

    <!-- Admin Custom CSS -->
    <style>
        :root {
            --admin-sidebar-width: 280px;
            --admin-header-height: 70px;
        }

        .admin-layout {
            display: flex;
            min-height: 100vh;
        }

        .admin-sidebar {
            width: var(--admin-sidebar-width);
            background: linear-gradient(180deg, var(--dark) 0%, var(--dark-light) 100%);
            color: var(--white);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 4px 0 10px rgba(0,0,0,0.1);
        }

        .admin-sidebar .brand {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            text-align: center;
        }

        .admin-sidebar .brand h3 {
            color: var(--white);
            font-weight: 700;
            margin: 0;
            font-size: 1.5rem;
        }

        .admin-sidebar .brand p {
            color: rgba(255,255,255,0.7);
            margin: 0;
            font-size: 0.875rem;
        }

        .admin-nav {
            padding: 1rem 0;
        }

        .admin-nav-section {
            margin-bottom: 1.5rem;
        }

        .admin-nav-label {
            padding: 0.5rem 1.5rem;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255,255,255,0.5);
            font-weight: 600;
        }

        .admin-nav-item {
            display: flex;
            align-items: center;
            padding: 0.875rem 1.5rem;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .admin-nav-item:hover,
        .admin-nav-item.active {
            background: rgba(255,255,255,0.1);
            color: var(--white);
            border-left-color: var(--primary-color);
        }

        .admin-nav-item i {
            font-size: 1.25rem;
            width: 30px;
        }

        .admin-main {
            margin-left: var(--admin-sidebar-width);
            flex: 1;
            background: var(--gray-50);
            min-height: 100vh;
        }

        .admin-topbar {
            background: var(--white);
            height: var(--admin-header-height);
            box-shadow: var(--shadow);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 2rem;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .admin-topbar .topbar-search {
            flex: 1;
            max-width: 400px;
        }

        .admin-topbar .topbar-user {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--gradient-primary);
            color: var(--white);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
        }

        .admin-content {
            padding: 0;
        }

        @media (max-width: 992px) {
            .admin-sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .admin-sidebar.show {
                transform: translateX(0);
            }

            .admin-main {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>

<div class="admin-layout">
    <!-- Sidebar -->
    <aside class="admin-sidebar">
        <div class="brand">
            <h3>SITUNEO</h3>
            <p>Admin Panel</p>
        </div>

        <nav class="admin-nav">
            <!-- Dashboard -->
            <div class="admin-nav-section">
                <div class="admin-nav-label">Dashboard</div>
                <a href="<?= url('admin') ?>" class="admin-nav-item <?= is_current_url('admin') && !is_current_url('admin/', true) ? 'active' : '' ?>">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </div>

            <!-- FULL CONTROL -->
            <div class="admin-nav-section">
                <div class="admin-nav-label">Full Control</div>
                <a href="<?= url('admin/settings') ?>" class="admin-nav-item <?= is_current_url('admin/settings') ? 'active' : '' ?>">
                    <i class="bi bi-gear"></i>
                    <span>Settings Website</span>
                </a>
                <a href="<?= url('admin/content') ?>" class="admin-nav-item <?= is_current_url('admin/content') ? 'active' : '' ?>">
                    <i class="bi bi-file-text"></i>
                    <span>Edit Content Pages</span>
                </a>
            </div>

            <!-- Management -->
            <div class="admin-nav-section">
                <div class="admin-nav-label">Management</div>
                <a href="<?= url('admin/services') ?>" class="admin-nav-item <?= is_current_url('admin/services') ? 'active' : '' ?>">
                    <i class="bi bi-basket"></i>
                    <span>Services & Pricing</span>
                </a>
                <a href="<?= url('admin/portfolios') ?>" class="admin-nav-item <?= is_current_url('admin/portfolios') ? 'active' : '' ?>">
                    <i class="bi bi-image"></i>
                    <span>Portfolios</span>
                </a>
                <a href="<?= url('admin/orders') ?>" class="admin-nav-item <?= is_current_url('admin/orders') ? 'active' : '' ?>">
                    <i class="bi bi-cart-check"></i>
                    <span>Orders</span>
                </a>
                <a href="<?= url('admin/users') ?>" class="admin-nav-item <?= is_current_url('admin/users') ? 'active' : '' ?>">
                    <i class="bi bi-people"></i>
                    <span>Users</span>
                </a>
            </div>

            <!-- Reports & Logs -->
            <div class="admin-nav-section">
                <div class="admin-nav-label">Reports</div>
                <a href="<?= url('admin/reports') ?>" class="admin-nav-item <?= is_current_url('admin/reports') ? 'active' : '' ?>">
                    <i class="bi bi-graph-up"></i>
                    <span>Analytics</span>
                </a>
                <a href="<?= url('admin/activities') ?>" class="admin-nav-item <?= is_current_url('admin/activities') ? 'active' : '' ?>">
                    <i class="bi bi-clock-history"></i>
                    <span>Activity Logs</span>
                </a>
            </div>

            <!-- Logout -->
            <div class="admin-nav-section">
                <a href="<?= url('logout') ?>" class="admin-nav-item">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </a>
            </div>
        </nav>
    </aside>

    <!-- Main Content -->
    <div class="admin-main">
        <!-- Top Bar -->
        <header class="admin-topbar">
            <div class="topbar-search">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="search" class="form-control border-start-0" placeholder="Search...">
                </div>
            </div>

            <div class="topbar-user">
                <a href="<?= url('admin/notifications') ?>" class="btn btn-link position-relative">
                    <i class="bi bi-bell" style="font-size: 1.25rem;"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.65rem;">
                        3
                    </span>
                </a>

                <div class="dropdown">
                    <button class="btn btn-link text-decoration-none d-flex align-items-center gap-2" type="button" data-bs-toggle="dropdown">
                        <div class="user-avatar">
                            <?= strtoupper(substr(Auth::user()['name'] ?? 'A', 0, 1)) ?>
                        </div>
                        <div class="text-start d-none d-md-block">
                            <div class="fw-semibold" style="font-size: 0.875rem;"><?= htmlspecialchars(Auth::user()['name'] ?? 'Admin') ?></div>
                            <small class="text-muted">Administrator</small>
                        </div>
                        <i class="bi bi-chevron-down"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="<?= url('admin/profile') ?>"><i class="bi bi-person"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="<?= url('admin/settings') ?>"><i class="bi bi-gear"></i> Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="<?= url('logout') ?>"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <div class="admin-content">
