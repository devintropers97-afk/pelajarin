<!-- Premium Navigation -->
<nav class="navbar-premium" id="navbar">
    <div class="container">
        <div class="nav-wrapper">
            <!-- Logo -->
            <a href="index-new.php" class="nav-logo">
                <i class="fas fa-globe"></i>
                <span>SITUNEO</span>
            </a>

            <!-- Desktop Menu -->
            <ul class="nav-menu" id="navMenu">
                <li><a href="index-new.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'index-new.php') ? 'active' : ''; ?>"><?php echo $t['nav_home'] ?? 'Beranda'; ?></a></li>
                <li><a href="about-new.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'about-new.php') ? 'active' : ''; ?>"><?php echo $t['nav_about'] ?? 'Tentang'; ?></a></li>
                <li><a href="services-new.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'services-new.php') ? 'active' : ''; ?>"><?php echo $t['nav_services'] ?? 'Layanan'; ?></a></li>
                <li><a href="portfolio-new.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'portfolio-new.php') ? 'active' : ''; ?>"><?php echo $t['nav_portfolio'] ?? 'Portfolio'; ?></a></li>
                <li><a href="pricing-new.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'pricing-new.php') ? 'active' : ''; ?>"><?php echo $t['nav_pricing'] ?? 'Harga'; ?></a></li>
                <li><a href="blog-new.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'blog-new.php') ? 'active' : ''; ?>"><?php echo $t['nav_blog'] ?? 'Blog'; ?></a></li>
                <li><a href="contact-new.php" class="nav-link <?php echo (basename($_SERVER['PHP_SELF']) == 'contact-new.php') ? 'active' : ''; ?>"><?php echo $t['nav_contact'] ?? 'Kontak'; ?></a></li>
            </ul>

            <!-- Right Actions -->
            <div class="nav-actions">
                <!-- Language Switcher -->
                <div class="lang-switcher">
                    <button class="lang-btn <?php echo $lang === 'id' ? 'active' : ''; ?>" onclick="switchLanguage('id')">
                        <span class="flag">🇮🇩</span> ID
                    </button>
                    <button class="lang-btn <?php echo $lang === 'en' ? 'active' : ''; ?>" onclick="switchLanguage('en')">
                        <span class="flag">🇺🇸</span> EN
                    </button>
                </div>

                <!-- CTA Button -->
                <a href="auth/login.php" class="btn-primary-nav">
                    <i class="fas fa-user"></i>
                    <span><?php echo $t['nav_login'] ?? 'Masuk'; ?></span>
                </a>

                <!-- Mobile Menu Toggle -->
                <button class="mobile-menu-toggle" id="mobileMenuToggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </div>
</nav>

<!-- NIB Badge (RED gradient with pulse) -->
<div class="nib-badge">
    <div class="nib-badge-content">
        <i class="fas fa-certificate"></i>
        <div class="nib-badge-text">
            <div class="nib-label"><?php echo $t['nib_label'] ?? 'NIB Terdaftar'; ?></div>
            <div class="nib-number">1234567890123</div>
        </div>
    </div>
    <div class="nib-pulse"></div>
</div>

<script>
// Language Switcher Function
function switchLanguage(newLang) {
    const currentUrl = window.location.href;
    const url = new URL(currentUrl);
    url.searchParams.set('lang', newLang);
    window.location.href = url.toString();
}

// Mobile Menu Toggle
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuToggle = document.getElementById('mobileMenuToggle');
    const navMenu = document.getElementById('navMenu');

    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener('click', function() {
            this.classList.toggle('active');
            navMenu.classList.toggle('active');
            document.body.classList.toggle('menu-open');
        });
    }

    // Close menu when clicking outside
    document.addEventListener('click', function(event) {
        const navbar = document.querySelector('.navbar-premium');
        if (!navbar.contains(event.target) && navMenu.classList.contains('active')) {
            mobileMenuToggle.classList.remove('active');
            navMenu.classList.remove('active');
            document.body.classList.remove('menu-open');
        }
    });
});
</script>
