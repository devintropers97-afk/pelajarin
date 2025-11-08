<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- SEO Meta Tags -->
    <title><?= $page_title ?? 'SITUNEO DIGITAL - Website Era Baru' ?></title>
    <meta name="description" content="<?= $page_description ?? 'Digital agency terlengkap di Indonesia dengan 232+ layanan, dual pricing system, dan 50 demo website production-ready' ?>">
    <meta name="keywords" content="website murah, jasa website, web development, digital marketing, SEO, beli putus, sewa website, UMKM">
    <meta name="author" content="SITUNEO DIGITAL">
    <meta name="robots" content="index, follow">

    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="<?= $page_title ?? 'SITUNEO DIGITAL' ?>">
    <meta property="og:description" content="<?= $page_description ?? 'Solusi Digital Terlengkap' ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= current_url() ?>">
    <meta property="og:image" content="<?= asset('images/og-image.jpg') ?>">

    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= $page_title ?? 'SITUNEO DIGITAL' ?>">
    <meta name="twitter:description" content="<?= $page_description ?? 'Solusi Digital Terlengkap' ?>">
    <meta name="twitter:image" content="<?= asset('images/og-image.jpg') ?>">

    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="<?= asset('images/favicon-32x32.png') ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= asset('images/favicon-16x16.png') ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= asset('images/apple-touch-icon.png') ?>">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= asset('css/main.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/responsive.css') ?>">

    <?php if (isset($additional_css)): ?>
        <?= $additional_css ?>
    <?php endif; ?>

    <!-- CSRF Token for AJAX -->
    <meta name="csrf-token" content="<?= csrf_token() ?>">

    <!-- Structured Data (JSON-LD) -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Organization",
        "name": "SITUNEO DIGITAL",
        "description": "Digital agency terlengkap di Indonesia",
        "url": "<?= SITE_URL ?>",
        "logo": "<?= asset('images/logo.png') ?>",
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "<?= COMPANY_WHATSAPP ?>",
            "contactType": "Customer Service",
            "availableLanguage": ["Indonesian"]
        },
        "sameAs": [
            "<?= COMPANY_INSTAGRAM ?? '' ?>",
            "<?= COMPANY_FACEBOOK ?? '' ?>",
            "<?= COMPANY_TIKTOK ?? '' ?>"
        ],
        "address": {
            "@type": "PostalAddress",
            "addressCountry": "ID",
            "addressLocality": "<?= COMPANY_CITY ?? 'Indonesia' ?>"
        }
    }
    </script>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark sticky-top" id="mainNavbar">
    <div class="container">
        <a class="navbar-brand" href="<?= url('/') ?>">
            <img src="<?= asset('images/logo-white.png') ?>" alt="SITUNEO DIGITAL" height="40">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link <?= active('/') ?>" href="<?= url('/') ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= active('services') ?>" href="<?= url('services') ?>">Layanan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= active('pricing') ?>" href="<?= url('pricing') ?>">Harga</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= active('portfolio') ?>" href="<?= url('portfolio') ?>">Portfolio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= active('demo') ?>" href="<?= url('demo') ?>">
                        <i class="bi bi-gift"></i> Free Demo
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= active('about') ?>" href="<?= url('about') ?>">Tentang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= active('contact') ?>" href="<?= url('contact') ?>">Kontak</a>
                </li>

                <?php if (is_logged_in()): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i> <?= e(user()['username'] ?? user()['email']) ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <?php if (is_admin()): ?>
                                <li><a class="dropdown-item" href="<?= url('admin') ?>"><i class="bi bi-speedometer2"></i> Admin Panel</a></li>
                            <?php elseif (is_client()): ?>
                                <li><a class="dropdown-item" href="<?= url('client') ?>"><i class="bi bi-grid"></i> Dashboard</a></li>
                            <?php elseif (is_freelancer()): ?>
                                <li><a class="dropdown-item" href="<?= url('freelancer') ?>"><i class="bi bi-briefcase"></i> Dashboard</a></li>
                            <?php endif; ?>
                            <li><a class="dropdown-item" href="<?= url('profile') ?>"><i class="bi bi-person"></i> Profil</a></li>
                            <li><a class="dropdown-item" href="<?= url('orders') ?>"><i class="bi bi-bag"></i> Pesanan</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="<?= url('logout') ?>"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= url('login') ?>">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-primary btn-sm ms-2" href="<?= url('register') ?>">Daftar Gratis</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Flash Messages -->
<?php if ($success = flash_success()): ?>
<div class="alert alert-success alert-dismissible fade show m-3" role="alert">
    <i class="bi bi-check-circle"></i> <?= $success ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<?php if ($error = flash_error()): ?>
<div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
    <i class="bi bi-exclamation-triangle"></i> <?= $error ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<?php if ($warning = flash_warning()): ?>
<div class="alert alert-warning alert-dismissible fade show m-3" role="alert">
    <i class="bi bi-exclamation-circle"></i> <?= $warning ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<?php if ($info = flash_info()): ?>
<div class="alert alert-info alert-dismissible fade show m-3" role="alert">
    <i class="bi bi-info-circle"></i> <?= $info ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<!-- Main Content Start -->
<main>
