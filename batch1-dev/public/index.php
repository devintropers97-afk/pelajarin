<?php
/**
 * Homepage - SITUNEO DIGITAL
 *
 * Menampilkan:
 * - Hero section dengan dual pricing highlight
 * - Stats perusahaan
 * - Services preview (232+ layanan)
 * - Pricing comparison
 * - Portfolio demos
 * - Testimonials
 * - CTA
 */

defined('SITUNEO_ACCESS') or die('Direct access not permitted');

// Get featured services
try {
    $db = Database::getInstance();
    $featured_services = $db->query("
        SELECT * FROM services
        WHERE is_featured = 1 AND is_active = 1
        ORDER BY sort_order ASC
        LIMIT 8
    ")->fetchAll();

    // Get service categories
    $categories = $db->query("
        SELECT * FROM service_categories
        WHERE is_active = 1
        ORDER BY sort_order ASC
    ")->fetchAll();

    // Get stats
    $total_services = $db->query("SELECT COUNT(*) as count FROM services WHERE is_active = 1")->fetchColumn();
    $total_categories = $db->query("SELECT COUNT(*) as count FROM service_categories WHERE is_active = 1")->fetchColumn();
    $total_portfolios = $db->query("SELECT COUNT(*) as count FROM portfolios WHERE is_active = 1")->fetchColumn();

} catch (Exception $e) {
    $featured_services = [];
    $categories = [];
    $total_services = 232;
    $total_categories = 10;
    $total_portfolios = 50;
}

$page_title = 'SITUNEO DIGITAL - Website Era Baru | Solusi Digital Terlengkap';
$page_description = 'Digital agency terlengkap di Indonesia dengan 232+ layanan, dual pricing system (Beli Putus & Sewa Bulanan), dan 50 demo website production-ready';

include INCLUDES_PATH . 'header/public-header.php';
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="network-bg" id="networkBg"></div>

    <div class="container">
        <div class="row align-items-center min-vh-100">
            <div class="col-lg-6">
                <div class="hero-content">
                    <div class="nib-badge pulse-animation">
                        <i class="bi bi-shield-check"></i>
                        NIB: <?= COMPANY_NIB ?>
                    </div>

                    <h1 class="hero-title">
                        <span class="text-gradient">SITUNEO DIGITAL</span><br>
                        Website Era Baru
                    </h1>

                    <p class="hero-subtitle">
                        Solusi Digital Terlengkap di Indonesia<br>
                        <strong class="text-primary"><?= format_number($total_services) ?>+ Layanan</strong> |
                        <strong class="text-warning">50+ Demo Website</strong> |
                        <strong class="text-success">2 Sistem Pricing</strong>
                    </p>

                    <div class="pricing-highlight-box">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="pricing-card pricing-onetime">
                                    <div class="pricing-label">
                                        <i class="bi bi-cash-coin"></i> Beli Putus
                                    </div>
                                    <div class="pricing-value">Rp 350K+</div>
                                    <div class="pricing-features">
                                        <i class="bi bi-check-circle-fill"></i> Ownership 100%<br>
                                        <i class="bi bi-check-circle-fill"></i> Source Code<br>
                                        <i class="bi bi-check-circle-fill"></i> No Monthly Fee
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="pricing-card pricing-subscription">
                                    <div class="pricing-label">
                                        <i class="bi bi-arrow-repeat"></i> Sewa Bulanan
                                    </div>
                                    <div class="pricing-value">Rp 150K/bln</div>
                                    <div class="pricing-features">
                                        <i class="bi bi-check-circle-fill"></i> Setup GRATIS<br>
                                        <i class="bi bi-check-circle-fill"></i> Maintenance Included<br>
                                        <i class="bi bi-check-circle-fill"></i> Bisa Berhenti Kapan Saja
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="hero-cta">
                        <a href="<?= url('demo') ?>" class="btn btn-primary btn-lg">
                            <i class="bi bi-play-circle"></i> FREE DEMO 24 JAM
                        </a>
                        <a href="<?= url('pricing') ?>" class="btn btn-outline-light btn-lg">
                            <i class="bi bi-calculator"></i> Lihat Harga
                        </a>
                    </div>

                    <div class="hero-badges">
                        <span class="badge bg-success"><i class="bi bi-check-circle"></i> Terpercaya</span>
                        <span class="badge bg-primary"><i class="bi bi-shield"></i> Aman</span>
                        <span class="badge bg-warning"><i class="bi bi-lightning"></i> Cepat</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="hero-image">
                    <div class="floating-card card-1">
                        <i class="bi bi-code-slash"></i>
                        <span>Web Development</span>
                    </div>
                    <div class="floating-card card-2">
                        <i class="bi bi-phone"></i>
                        <span>Mobile Apps</span>
                    </div>
                    <div class="floating-card card-3">
                        <i class="bi bi-palette"></i>
                        <span>UI/UX Design</span>
                    </div>
                    <div class="floating-card card-4">
                        <i class="bi bi-megaphone"></i>
                        <span>Digital Marketing</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FREE DEMO Banner -->
<div class="demo-banner">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h3><i class="bi bi-gift"></i> FREE DEMO 24 JAM - Lihat Langsung Hasilnya!</h3>
                <p class="mb-0">Mau lihat demo website sesuai bisnis Anda? Request sekarang, kami kirim dalam 24 jam!</p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="<?= url('demo') ?>" class="btn btn-light btn-lg">
                    Request Demo <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Stats Section -->
<section class="stats-section">
    <div class="container">
        <div class="row text-center g-4">
            <div class="col-md-3 col-6">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-gear"></i>
                    </div>
                    <div class="stat-number counter" data-target="<?= $total_services ?>">0</div>
                    <div class="stat-label">Layanan Tersedia</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-grid"></i>
                    </div>
                    <div class="stat-number counter" data-target="<?= $total_categories ?>">0</div>
                    <div class="stat-label">Kategori</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-eye"></i>
                    </div>
                    <div class="stat-number counter" data-target="<?= $total_portfolios ?>">0</div>
                    <div class="stat-label">Demo Website</div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="bi bi-people"></i>
                    </div>
                    <div class="stat-number"><span class="counter" data-target="1500">0</span>+</div>
                    <div class="stat-label">Tipe Website</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Dual Pricing Explanation -->
<section class="pricing-explanation-section">
    <div class="container">
        <div class="section-header text-center">
            <h2 class="section-title">
                <span class="text-gradient">2 Sistem Pricing</span> - Pilih Sesuai Kebutuhan
            </h2>
            <p class="section-subtitle">Kami paham setiap bisnis punya kebutuhan berbeda. Makanya ada 2 pilihan!</p>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-lg-5">
                <div class="pricing-explain-card card-onetime">
                    <div class="card-icon">
                        <i class="bi bi-cash-stack"></i>
                    </div>
                    <h3>Beli Putus (One-Time Payment)</h3>
                    <p class="card-desc">Bayar sekali, website jadi milik Anda 100% selamanya</p>

                    <div class="pricing-details">
                        <div class="price-range">
                            <span class="label">Setup Fee:</span>
                            <span class="value">Rp 350K - 1.5M+</span>
                        </div>
                        <div class="price-range">
                            <span class="label">Monthly Fee:</span>
                            <span class="value text-success">Rp 0 (GRATIS!)</span>
                        </div>
                    </div>

                    <ul class="features-list">
                        <li><i class="bi bi-check-circle-fill"></i> Ownership PENUH (100%)</li>
                        <li><i class="bi bi-check-circle-fill"></i> Source Code Diberikan</li>
                        <li><i class="bi bi-check-circle-fill"></i> Bisa Migrate Hosting Sendiri</li>
                        <li><i class="bi bi-check-circle-fill"></i> Lebih Hemat Jangka Panjang</li>
                        <li><i class="bi bi-check-circle-fill"></i> Bisa Dijual/Transfer</li>
                    </ul>

                    <div class="card-footer">
                        <strong>Cocok untuk:</strong> Bisnis jangka panjang, perusahaan established
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="pricing-explain-card card-subscription featured">
                    <div class="featured-badge">PALING POPULER</div>
                    <div class="card-icon">
                        <i class="bi bi-arrow-repeat"></i>
                    </div>
                    <h3>Sewa Bulanan (Subscription)</h3>
                    <p class="card-desc">Bayar bulanan, tanpa setup fee, bisa berhenti kapan saja</p>

                    <div class="pricing-details">
                        <div class="price-range">
                            <span class="label">Setup Fee:</span>
                            <span class="value text-success">Rp 0 (GRATIS!)</span>
                        </div>
                        <div class="price-range">
                            <span class="label">Monthly Fee:</span>
                            <span class="value">Rp 150K - 350K/bln</span>
                        </div>
                    </div>

                    <ul class="features-list">
                        <li><i class="bi bi-check-circle-fill"></i> TANPA Setup Fee</li>
                        <li><i class="bi bi-check-circle-fill"></i> Maintenance Included GRATIS</li>
                        <li><i class="bi bi-check-circle-fill"></i> Hosting Included</li>
                        <li><i class="bi bi-check-circle-fill"></i> Update Gratis Selamanya</li>
                        <li><i class="bi bi-check-circle-fill"></i> Support 24/7</li>
                    </ul>

                    <div class="card-footer">
                        <strong>Cocok untuk:</strong> UMKM, startup, testing bisnis baru
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="<?= url('pricing') ?>" class="btn btn-primary btn-lg">
                <i class="bi bi-calculator"></i> Bandingkan Harga Lengkap
            </a>
            <a href="<?= whatsapp_link(COMPANY_WHATSAPP, 'Halo, saya mau konsultasi pricing') ?>" class="btn btn-success btn-lg" target="_blank">
                <i class="bi bi-whatsapp"></i> Konsultasi Gratis
            </a>
        </div>
    </div>
</section>

<!-- Services Categories -->
<section class="services-section">
    <div class="container">
        <div class="section-header text-center">
            <h2 class="section-title">
                <span class="text-gradient"><?= format_number($total_services) ?>+ Layanan</span> dalam <?= $total_categories ?> Kategori
            </h2>
            <p class="section-subtitle">Dari website simple sampai sistem enterprise, kami bisa!</p>
        </div>

        <div class="row g-4">
            <?php foreach ($categories as $category): ?>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="<?= url('services?category=' . $category['slug']) ?>" class="category-card">
                    <div class="category-icon" style="color: <?= $category['color'] ?>">
                        <i class="bi <?= $category['icon'] ?>"></i>
                    </div>
                    <h4><?= e($category['name']) ?></h4>
                    <p><?= truncate($category['description'], 80) ?></p>
                    <div class="category-arrow">
                        <i class="bi bi-arrow-right"></i>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-5">
            <a href="<?= url('services') ?>" class="btn btn-outline-primary btn-lg">
                Lihat Semua Layanan <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- WhatsApp Float Button -->
<a href="<?= whatsapp_link(COMPANY_WHATSAPP, 'Halo, saya mau tanya tentang layanan SITUNEO') ?>"
   class="whatsapp-float"
   target="_blank"
   title="Chat WhatsApp">
    <i class="bi bi-whatsapp"></i>
</a>

<?php include INCLUDES_PATH . 'footer/public-footer.php'; ?>
