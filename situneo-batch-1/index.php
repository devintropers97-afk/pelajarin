<?php
/**
 * ========================================
 * SITUNEO DIGITAL - Homepage
 * Website Era Baru untuk Bisnis Digital
 * ========================================
 */

require_once 'config/init.php';

// If installer exists and database not set up, redirect to installer
if (file_exists('installer.php') && !file_exists('config/.installed')) {
    try {
        $db = getDB();
        $stmt = $db->query("SHOW TABLES");
        $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);

        if (count($tables) == 0) {
            header('Location: installer.php');
            exit();
        }
    } catch (Exception $e) {
        header('Location: installer.php');
        exit();
    }
}

// Page variables
$current_page = 'home';
$page_title = 'SITUNEO - Website Era Baru untuk Bisnis Digital Anda';
$page_description = 'Platform pembuatan website profesional dengan 1500+ template. Beli Putus Rp 350K atau Sewa Rp 150K/bulan. Website era baru untuk bisnis Anda!';
$lang = $_GET['lang'] ?? 'id';

// Include header
include 'components/layout/header.php';
?>

<!-- Main Content -->
<main id="main-content">

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content">
                <p class="hero-subtitle">SITUNEO Digital</p>
                <h1 class="hero-title">
                    Website Era Baru<br>
                    untuk Bisnis <span class="text-gradient-gold">Digital</span> Anda
                </h1>
                <p class="hero-description">
                    Platform pembuatan website profesional dengan 1500+ template untuk berbagai jenis bisnis.
                    Wujudkan website impian Anda dengan teknologi terkini dan harga terjangkau.
                </p>
                <div class="hero-cta">
                    <a href="<?php echo SITE_URL; ?>/pages/services.php" class="btn btn-gradient-gold btn-lg">
                        <i class="bi bi-rocket-takeoff me-2"></i>
                        Mulai Sekarang
                    </a>
                    <a href="<?php echo SITE_URL; ?>/pages/calculator.php" class="btn btn-outline-gold btn-lg">
                        <i class="bi bi-calculator me-2"></i>
                        Hitung Biaya
                    </a>
                </div>

                <!-- Hero Stats -->
                <div class="hero-stats">
                    <div class="stat-item" data-aos="fade-up" data-aos-delay="100">
                        <span class="stat-number" data-count="1500" data-suffix="+">0+</span>
                        <span class="stat-label">Template Siap Pakai</span>
                    </div>
                    <div class="stat-item" data-aos="fade-up" data-aos-delay="200">
                        <span class="stat-number" data-count="5000" data-suffix="+">0+</span>
                        <span class="stat-label">Website Terpasang</span>
                    </div>
                    <div class="stat-item" data-aos="fade-up" data-aos-delay="300">
                        <span class="stat-number" data-count="98" data-suffix="%">0%</span>
                        <span class="stat-label">Kepuasan Klien</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="section section-gray">
        <div class="container">
            <div class="section-header">
                <p class="section-subtitle">KENAPA PILIH KAMI</p>
                <h2 class="section-title">Fitur Unggulan SITUNEO</h2>
                <p class="section-description">
                    Platform all-in-one untuk kebutuhan website bisnis Anda
                </p>
            </div>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="card">
                        <div class="card-icon">
                            <i class="bi bi-lightning-charge-fill"></i>
                        </div>
                        <h3 class="card-title">Setup Cepat</h3>
                        <p class="card-text">
                            Website Anda bisa online dalam hitungan jam, bukan hari atau minggu. Proses instalasi otomatis dan mudah.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="card">
                        <div class="card-icon">
                            <i class="bi bi-palette-fill"></i>
                        </div>
                        <h3 class="card-title">1500+ Template</h3>
                        <p class="card-text">
                            Pilihan template premium untuk berbagai jenis bisnis. Dari company profile hingga e-commerce.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="card">
                        <div class="card-icon">
                            <i class="bi bi-phone-fill"></i>
                        </div>
                        <h3 class="card-title">Responsive Design</h3>
                        <p class="card-text">
                            Tampil sempurna di semua perangkat - desktop, tablet, dan smartphone. Mobile-first approach.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="card">
                        <div class="card-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>
                        <h3 class="card-title">Keamanan Tinggi</h3>
                        <p class="card-text">
                            SSL certificate gratis, firewall protection, dan automatic security updates untuk melindungi website Anda.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="card">
                        <div class="card-icon">
                            <i class="bi bi-rocket-takeoff-fill"></i>
                        </div>
                        <h3 class="card-title">SEO Optimized</h3>
                        <p class="card-text">
                            Built-in SEO tools untuk meningkatkan ranking di Google. Meta tags, sitemap, schema markup otomatis.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="card">
                        <div class="card-icon">
                            <i class="bi bi-headset"></i>
                        </div>
                        <h3 class="card-title">Support 24/7</h3>
                        <p class="card-text">
                            Tim support siap membantu Anda kapan saja via WhatsApp, email, dan live chat.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Comparison Section -->
    <section class="section">
        <div class="container">
            <div class="section-header">
                <p class="section-subtitle">HARGA TERJANGKAU</p>
                <h2 class="section-title">Pilih Paket Yang Sesuai</h2>
                <p class="section-description">
                    Beli putus atau sewa bulanan? Anda yang tentukan!
                </p>
            </div>

            <div class="row g-4 justify-content-center">
                <!-- Sewa Package -->
                <div class="col-lg-5 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="card text-center">
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <i class="bi bi-calendar-month" style="font-size: 3rem; color: var(--color-primary);"></i>
                            </div>
                            <h3 class="card-title mb-3">Paket Sewa</h3>
                            <div class="mb-4">
                                <h2 class="text-gradient-blue mb-0">
                                    Rp 150K
                                    <small class="text-muted" style="font-size: 1rem;">/bulan</small>
                                </h2>
                                <p class="text-success fw-bold mt-2">
                                    <i class="bi bi-check-circle-fill me-1"></i>
                                    TANPA BIAYA SETUP
                                </p>
                            </div>
                            <ul class="list-unstyled text-start mb-4">
                                <li class="mb-2">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    1 Website Pilihan
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    Domain & Hosting Included
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    SSL Certificate Gratis
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    Maintenance & Update
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    Support 24/7
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    Backup Otomatis
                                </li>
                            </ul>
                            <a href="<?php echo SITE_URL; ?>/pages/pricing.php" class="btn btn-gradient-blue w-100">
                                Pilih Paket Sewa
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Beli Putus Package -->
                <div class="col-lg-5 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="card text-center" style="border: 3px solid var(--color-secondary);">
                        <div class="position-absolute top-0 start-50 translate-middle">
                            <span class="badge bg-warning text-dark px-4 py-2">
                                <i class="bi bi-star-fill me-1"></i>
                                PALING POPULER
                            </span>
                        </div>
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <i class="bi bi-bag-check" style="font-size: 3rem; color: var(--color-secondary);"></i>
                            </div>
                            <h3 class="card-title mb-3">Beli Putus</h3>
                            <div class="mb-4">
                                <h2 class="text-gradient-gold mb-0">Rp 350K</h2>
                                <p class="text-primary fw-bold mt-2">
                                    <i class="bi bi-infinity me-1"></i>
                                    SEKALI BAYAR SELAMANYA
                                </p>
                            </div>
                            <ul class="list-unstyled text-start mb-4">
                                <li class="mb-2">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    1 Website Pilihan
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    <strong>Full Source Code</strong>
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    Milik Anda Selamanya
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    Free Update 1 Tahun
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    Dokumentasi Lengkap
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    Support Premium
                                </li>
                            </ul>
                            <a href="<?php echo SITE_URL; ?>/pages/pricing.php" class="btn btn-gradient-gold w-100">
                                Beli Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="300">
                <p class="text-muted mb-3">Tidak yakin paket mana yang cocok?</p>
                <a href="<?php echo SITE_URL; ?>/pages/calculator.php" class="btn btn-outline-blue">
                    <i class="bi bi-calculator me-2"></i>
                    Gunakan Kalkulator Harga
                </a>
            </div>
        </div>
    </section>

    <!-- Popular Services Preview -->
    <section class="section section-gray">
        <div class="container">
            <div class="section-header">
                <p class="section-subtitle">LAYANAN POPULER</p>
                <h2 class="section-title">Website untuk Setiap Bisnis</h2>
                <p class="section-description">
                    Dari 1500+ template, inilah yang paling banyak dipilih
                </p>
            </div>

            <div class="row g-4">
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="card">
                        <div class="card-icon">
                            <i class="bi bi-building"></i>
                        </div>
                        <h4 class="card-title">Company Profile</h4>
                        <p class="card-text">Website profesional untuk perusahaan Anda</p>
                        <a href="<?php echo SITE_URL; ?>/pages/services.php?category=company-profile" class="btn btn-outline-blue btn-sm w-100">
                            Lihat Template <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="card">
                        <div class="card-icon">
                            <i class="bi bi-cart-check"></i>
                        </div>
                        <h4 class="card-title">E-Commerce</h4>
                        <p class="card-text">Toko online lengkap dengan payment gateway</p>
                        <a href="<?php echo SITE_URL; ?>/pages/services.php?category=ecommerce" class="btn btn-outline-blue btn-sm w-100">
                            Lihat Template <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="card">
                        <div class="card-icon">
                            <i class="bi bi-mortarboard"></i>
                        </div>
                        <h4 class="card-title">Pendidikan</h4>
                        <p class="card-text">Website sekolah, kursus, dan e-learning</p>
                        <a href="<?php echo SITE_URL; ?>/pages/services.php?category=education" class="btn btn-outline-blue btn-sm w-100">
                            Lihat Template <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="card">
                        <div class="card-icon">
                            <i class="bi bi-rocket-takeoff"></i>
                        </div>
                        <h4 class="card-title">Landing Page</h4>
                        <p class="card-text">Convert visitors menjadi customers</p>
                        <a href="<?php echo SITE_URL; ?>/pages/services.php?category=landing-page" class="btn btn-outline-blue btn-sm w-100">
                            Lihat Template <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5" data-aos="fade-up">
                <a href="<?php echo SITE_URL; ?>/pages/services.php" class="btn btn-gradient-gold btn-lg">
                    <i class="bi bi-grid-3x3-gap me-2"></i>
                    Lihat Semua Layanan (1500+)
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section section-dark">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-lg-8" data-aos="fade-up">
                    <h2 class="display-4 mb-4">
                        Siap Wujudkan Website Impian Anda?
                    </h2>
                    <p class="lead mb-5">
                        Bergabunglah dengan 5000+ bisnis yang telah mempercayai SITUNEO untuk solusi website mereka.
                        Mulai sekarang dan rasakan perbedaannya!
                    </p>
                    <div class="d-flex gap-3 justify-content-center flex-wrap">
                        <a href="<?php echo SITE_URL; ?>/pages/services.php" class="btn btn-gradient-gold btn-lg">
                            <i class="bi bi-rocket-takeoff me-2"></i>
                            Mulai Sekarang
                        </a>
                        <a href="<?php echo SITE_URL; ?>/pages/contact.php" class="btn btn-outline-gold btn-lg">
                            <i class="bi bi-chat-dots me-2"></i>
                            Konsultasi Gratis
                        </a>
                        <a href="https://wa.me/<?php echo str_replace(['+', '-', ' '], '', WHATSAPP_NUMBER); ?>?text=<?php echo urlencode('Halo, saya tertarik dengan layanan SITUNEO'); ?>"
                           target="_blank"
                           class="btn btn-success btn-lg">
                            <i class="bi bi-whatsapp me-2"></i>
                            Chat WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<?php
// Include footer
include 'components/layout/footer.php';
?>
