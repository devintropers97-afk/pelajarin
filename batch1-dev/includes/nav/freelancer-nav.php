<?php
/**
 * Freelancer Dashboard Navigation Component
 * Reusable navigation for all freelancer pages
 */

if (!defined('SITUNEO_ACCESS')) die('Direct access not permitted');

$current_page = basename($_SERVER['PHP_SELF'], '.php');
$current_dir = basename(dirname($_SERVER['PHP_SELF']));
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-info sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="/freelancer/">
            <i class="fas fa-briefcase"></i> Freelancer Dashboard
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#freelancerNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="freelancerNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link <?= $current_page === 'index' && $current_dir === 'freelancer' ? 'active' : '' ?>" href="/freelancer/">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $current_dir === 'commissions' ? 'active' : '' ?>" href="/freelancer/commissions/">
                        <i class="fas fa-coins"></i> Commissions
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $current_dir === 'withdrawals' ? 'active' : '' ?>" href="/freelancer/withdrawals/">
                        <i class="fas fa-money-bill-wave"></i> Withdrawals
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $current_dir === 'portfolio' ? 'active' : '' ?>" href="/freelancer/portfolio/">
                        <i class="fas fa-folder-open"></i> Portfolio
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/freelancer/orders/">
                        <i class="fas fa-tasks"></i> My Orders
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user"></i> <?= esc(Auth::user()['name']) ?>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="/freelancer/profile/"><i class="fas fa-user-edit"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="/freelancer/settings/"><i class="fas fa-cog"></i> Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/auth/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
