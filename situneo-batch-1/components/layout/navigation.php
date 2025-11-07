<!-- Navigation Bar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand d-flex align-items-center" href="<?php echo SITE_URL; ?>">
            <div class="logo-wrapper">
                <span class="logo-text">
                    <span class="situ">SITU</span><span class="neo">NEO</span>
                </span>
                <span class="logo-tagline">Website Era Baru</span>
            </div>
        </a>

        <!-- Mobile Toggle Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Menu -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
                <li class="nav-item">
                    <a class="nav-link <?php echo ($current_page ?? '') === 'home' ? 'active' : ''; ?>"
                       href="<?php echo SITE_URL; ?>">
                        <i class="bi bi-house-door me-1"></i> Beranda
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php echo ($current_page ?? '') === 'about' ? 'active' : ''; ?>"
                       href="<?php echo SITE_URL; ?>/pages/about.php">
                        <i class="bi bi-info-circle me-1"></i> Tentang Kami
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle <?php echo in_array($current_page ?? '', ['services', 'service-detail']) ? 'active' : ''; ?>"
                       href="#" id="servicesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-grid-3x3-gap me-1"></i> Layanan
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="servicesDropdown">
                        <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>/pages/services.php">
                            <i class="bi bi-list-ul me-2"></i> Semua Layanan
                        </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>/pages/services.php?category=company-profile">
                            <i class="bi bi-building me-2"></i> Company Profile
                        </a></li>
                        <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>/pages/services.php?category=ecommerce">
                            <i class="bi bi-cart me-2"></i> E-Commerce
                        </a></li>
                        <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>/pages/services.php?category=education">
                            <i class="bi bi-mortarboard me-2"></i> Pendidikan
                        </a></li>
                        <li><a class="dropdown-item" href="<?php echo SITE_URL; ?>/pages/services.php?category=landing-page">
                            <i class="bi bi-rocket me-2"></i> Landing Page
                        </a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php echo ($current_page ?? '') === 'portfolio' ? 'active' : ''; ?>"
                       href="<?php echo SITE_URL; ?>/pages/portfolio.php">
                        <i class="bi bi-briefcase me-1"></i> Portfolio
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php echo ($current_page ?? '') === 'pricing' ? 'active' : ''; ?>"
                       href="<?php echo SITE_URL; ?>/pages/pricing.php">
                        <i class="bi bi-tag me-1"></i> Harga
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php echo ($current_page ?? '') === 'calculator' ? 'active' : ''; ?>"
                       href="<?php echo SITE_URL; ?>/pages/calculator.php">
                        <i class="bi bi-calculator me-1"></i> Kalkulator
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php echo ($current_page ?? '') === 'blog' ? 'active' : ''; ?>"
                       href="<?php echo SITE_URL; ?>/pages/blog.php">
                        <i class="bi bi-journal-text me-1"></i> Blog
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?php echo ($current_page ?? '') === 'contact' ? 'active' : ''; ?>"
                       href="<?php echo SITE_URL; ?>/pages/contact.php">
                        <i class="bi bi-envelope me-1"></i> Kontak
                    </a>
                </li>

                <!-- Language Switcher -->
                <li class="nav-item dropdown ms-lg-2">
                    <a class="nav-link dropdown-toggle lang-switcher" href="#" id="langDropdown"
                       role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-translate me-1"></i>
                        <span class="lang-code"><?php echo strtoupper($lang ?? 'ID'); ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark" aria-labelledby="langDropdown">
                        <li><a class="dropdown-item <?php echo ($lang ?? 'id') === 'id' ? 'active' : ''; ?>"
                               href="?lang=id">
                            <i class="bi bi-flag me-2"></i> Indonesia
                        </a></li>
                        <li><a class="dropdown-item <?php echo ($lang ?? 'id') === 'en' ? 'active' : ''; ?>"
                               href="?lang=en">
                            <i class="bi bi-flag-fill me-2"></i> English
                        </a></li>
                    </ul>
                </li>

                <!-- CTA Button -->
                <li class="nav-item ms-lg-3">
                    <?php if (isLoggedIn()): ?>
                        <a class="btn btn-gradient-gold btn-sm" href="<?php echo SITE_URL; ?>/client/dashboard.php">
                            <i class="bi bi-speedometer2 me-1"></i> Dashboard
                        </a>
                    <?php else: ?>
                        <a class="btn btn-gradient-gold btn-sm" href="<?php echo SITE_URL; ?>/auth/login.php">
                            <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
                        </a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Progress Bar on Scroll -->
<div class="scroll-progress-bar" id="scrollProgressBar"></div>
