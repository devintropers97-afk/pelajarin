<?php
// Load reCAPTCHA config if not already loaded
if (!function_exists('get_recaptcha_html')) {
    require_once __DIR__ . '/../config/recaptcha.php';
}
?>
<!DOCTYPE html>
<html lang="<?= $lang ?? 'id' ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title><?= $pageTitle ?? 'SITUNEO DIGITAL - Website Agency Terbaik & Termahal Se-Indonesia' ?></title>
    <meta name="description" content="<?= $pageDescription ?? 'Digital Harmony for a Modern World. Website profesional mulai Rp 350rb/halaman. FREE DEMO 24 JAM!' ?>">
    <meta name="keywords" content="website murah, jasa website, agency digital, situneo digital, website jakarta">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= ASSETS_URL ?>/images/favicon.png">
    <link rel="manifest" href="/manifest.json">

    <!-- Fonts - Quantum Aesthetic Typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Inter:wght@400;500&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= ASSETS_URL ?>/css/variables.css">
    <link rel="stylesheet" href="<?= ASSETS_URL ?>/css/main.css">
    <link rel="stylesheet" href="<?= ASSETS_URL ?>/css/components.css">
    <link rel="stylesheet" href="<?= ASSETS_URL ?>/css/pages.css">
    <link rel="stylesheet" href="<?= ASSETS_URL ?>/css/quantum-pages.css">
    <link rel="stylesheet" href="<?= ASSETS_URL ?>/css/responsive.css">
    <link rel="stylesheet" href="<?= ASSETS_URL ?>/css/animations.css">

    <!-- Quick Fix CSS - LOAD LAST untuk force consistency -->
    <link rel="stylesheet" href="<?= ASSETS_URL ?>/css/quick-fix.css">

    <?php if (isset($customCSS)): ?>
    <link rel="stylesheet" href="<?= ASSETS_URL ?>/css/<?= $customCSS ?>">
    <?php endif; ?>

    <!-- Open Graph Meta -->
    <meta property="og:title" content="<?= $pageTitle ?? 'SITUNEO DIGITAL' ?>">
    <meta property="og:description" content="<?= $pageDescription ?? 'Digital Harmony for a Modern World' ?>">
    <meta property="og:image" content="<?= ASSETS_URL ?>/images/og-image.jpg">
    <meta property="og:url" content="<?= getCurrentURL() ?>">
    <meta property="og:type" content="website">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= $pageTitle ?? 'SITUNEO DIGITAL' ?>">
    <meta name="twitter:description" content="<?= $pageDescription ?? 'Digital Harmony for a Modern World' ?>">
    <meta name="twitter:image" content="<?= ASSETS_URL ?>/images/og-image.jpg">

    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-XXXXXXXXXX"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'G-XXXXXXXXXX');
    </script>

    <?= get_recaptcha_html() ?>
</head>
<body>

<!-- Loading Screen -->
<div class="loading-screen" id="loadingScreen">
    <div class="loader-logo">
        <img src="https://situneo.my.id/logo" alt="SITUNEO DIGITAL" style="width: 120px; height: 120px; border-radius: 20px; margin-bottom: 20px;">
    </div>
    <h3 class="loading-text text-gold mb-3" style="font-weight: 700;">SITUNEO DIGITAL</h3>
    <p class="loading-tagline text-light mb-4" style="font-size: 1.1rem; opacity: 0.9;">Digital Harmony for a Modern World</p>
    <div class="spinner-border text-gold" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>

<!-- Network Background Animation -->
<div class="network-bg" id="networkBg"></div>

<!-- Circuit Pattern Background -->
<div class="circuit-pattern"></div>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-premium fixed-top" id="mainNavbar">
    <div class="container">
        <a class="navbar-brand" href="/">
            <img src="https://situneo.my.id/logo" alt="SITUNEO" height="40" style="border-radius: 8px;">
            <span class="brand-text ms-2">SITUNEO</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <i class="bi bi-list text-white fs-3"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link" href="/">
                        <i class="bi bi-house-door me-1"></i>
                        <?= $lang == 'en' ? 'Home' : 'Beranda' ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/pages/pilih-bisnis" style="background: var(--gradient-gold); color: var(--dark-blue); padding: 8px 16px; border-radius: 20px; font-weight: 700;">
                        <i class="bi bi-grid-3x3 me-1"></i>
                        <?= $lang == 'en' ? 'Choose Business' : 'Pilih Bisnis' ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/pages/semua-jenis-website">
                        <i class="bi bi-list-stars me-1"></i>
                        <span class="badge" style="background: var(--gradient-red); font-size: 0.7rem; padding: 2px 6px; border-radius: 10px; margin-left: 3px;">50+</span>
                        <?= $lang == 'en' ? 'All Types' : 'Semua Jenis' ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/services">
                        <i class="bi bi-grid-3x3-gap me-1"></i>
                        <?= $lang == 'en' ? 'Services' : 'Layanan' ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/portfolio">
                        <i class="bi bi-collection me-1"></i>
                        Portfolio
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/pricing">
                        <i class="bi bi-tags me-1"></i>
                        <?= $lang == 'en' ? 'Pricing' : 'Harga' ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/calculator">
                        <i class="bi bi-calculator me-1"></i>
                        Kalkulator
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/contact">
                        <i class="bi bi-envelope me-1"></i>
                        Kontak
                    </a>
                </li>

                <!-- Language Switcher -->
                <li class="nav-item ms-2">
                    <div class="lang-switcher">
                        <a href="?lang=id" class="lang-btn <?= $lang == 'id' ? 'active' : '' ?>">ID</a>
                        <a href="?lang=en" class="lang-btn <?= $lang == 'en' ? 'active' : '' ?>">EN</a>
                    </div>
                </li>

                <!-- User Menu -->
                <?php if (isLoggedIn()): ?>
                <li class="nav-item dropdown ms-2">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown">
                        <img src="<?= $_SESSION['user_avatar'] ?? ASSETS_URL . '/images/default-avatar.png' ?>" class="rounded-circle me-2" width="35" height="35" alt="User">
                        <span><?= $_SESSION['user_name'] ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <?php if (isAdmin()): ?>
                        <li><a class="dropdown-item" href="/admin"><i class="bi bi-speedometer2 me-2"></i>Dashboard Admin</a></li>
                        <?php elseif (isClient()): ?>
                        <li><a class="dropdown-item" href="/client"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
                        <?php elseif (isFreelancer()): ?>
                        <li><a class="dropdown-item" href="/freelance"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
                        <?php endif; ?>
                        <li><a class="dropdown-item" href="/profile"><i class="bi bi-person me-2"></i>Profil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/auth/logout.php"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                    </ul>
                </li>
                <?php else: ?>
                <li class="nav-item ms-2">
                    <a href="/auth/login" class="btn btn-outline-gold btn-sm">
                        <i class="bi bi-box-arrow-in-right me-1"></i>
                        Login
                    </a>
                </li>
                <li class="nav-item ms-2">
                    <a href="/auth/register" class="btn btn-gold btn-sm">
                        <i class="bi bi-person-plus me-1"></i>
                        Daftar
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Order Notification Popup (Kiri Bawah) -->
<div class="order-notification" id="orderNotification">
    <div class="d-flex align-items-start">
        <div class="notification-icon me-3">
            <img src="https://situneo.my.id/logo" alt="SITUNEO" style="width: 45px; height: 45px; border-radius: 10px; box-shadow: 0 3px 10px rgba(212, 175, 55, 0.3);">
        </div>
        <div class="notification-content flex-grow-1">
            <div class="notification-title fw-bold mb-1">Pesanan Baru!</div>
            <div class="notification-text small"></div>
            <div class="notification-time text-muted small"></div>
        </div>
        <button type="button" class="btn-close btn-close-white btn-sm ms-2" onclick="closeOrderNotification()"></button>
    </div>
</div>

<!-- Floating WhatsApp Button (Kanan Bawah) -->
<a href="https://wa.me/<?= SITE_WHATSAPP ?>?text=Halo%20SITUNEO%20DIGITAL,%20saya%20ingin%20konsultasi"
   class="floating-wa"
   target="_blank"
   title="Chat WhatsApp">
    <i class="bi bi-whatsapp"></i>
</a>

<!-- Back to Top Button -->
<button id="backToTop" onclick="scrollToTop()">
    <i class="bi bi-arrow-up fs-5"></i>
</button>

<!-- Main Content -->
<div class="main-wrapper">
