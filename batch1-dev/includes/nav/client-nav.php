<?php
/**
 * Client Dashboard Navigation Component
 * Reusable navigation for all client pages
 */

if (!defined('SITUNEO_ACCESS')) die('Direct access not permitted');

$current_page = basename($_SERVER['PHP_SELF'], '.php');
$current_dir = basename(dirname($_SERVER['PHP_SELF']));
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="/client/">
            <i class="fas fa-user-circle"></i> Client Dashboard
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#clientNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="clientNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link <?= $current_page === 'index' && $current_dir === 'client' ? 'active' : '' ?>" href="/client/">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $current_dir === 'orders' ? 'active' : '' ?>" href="/client/orders/">
                        <i class="fas fa-shopping-cart"></i> Orders
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $current_dir === 'projects' ? 'active' : '' ?>" href="/client/projects/">
                        <i class="fas fa-folder-open"></i> Projects
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $current_dir === 'payments' ? 'active' : '' ?>" href="/client/payments/">
                        <i class="fas fa-credit-card"></i> Payments
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/services.php">
                        <i class="fas fa-search"></i> Browse Services
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user"></i> <?= esc(Auth::user()['name']) ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="/client/profile/"><i class="fas fa-user-edit"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="/client/settings/"><i class="fas fa-cog"></i> Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/auth/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
