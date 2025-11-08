<?php
/**
 * About Page
 *
 * Tentang SITUNEO DIGITAL
 */

defined('SITUNEO_ACCESS') or die('Direct access not permitted');

$page_title = 'Tentang Kami - SITUNEO DIGITAL';
$page_description = 'SITUNEO DIGITAL - Digital agency terlengkap di Indonesia dengan 232+ layanan, dual pricing system, dan 50+ demo production-ready.';

include INCLUDES_PATH . 'header/public-header.php';
?>

<!-- Hero -->
<section class="about-hero">
    <div class="container text-center">
        <h1 class="hero-title" data-aos="fade-up">
            <span class="text-gradient">SITUNEO DIGITAL</span><br>
            Website Era Baru
        </h1>
        <p class="hero-subtitle" data-aos="fade-up" data-aos-delay="100">
            Digital agency terlengkap di Indonesia dengan <strong>232+ layanan</strong>,<br>
            <strong>dual pricing system</strong>, dan <strong>50+ demo production-ready</strong>
        </p>
    </div>
</section>

<!-- Story -->
<section class="story-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6" data-aos="fade-up">
                <h2>Kenapa SITUNEO DIGITAL?</h2>
                <p>Kami hadir untuk memberikan solusi digital yang <strong>terjangkau, berkualitas, dan fleksibel</strong> untuk semua jenis bisnis - dari UMKM hingga enterprise.</p>
                <p>Dengan sistem <strong>dual pricing</strong> (Beli Putus & Sewa Bulanan), Anda bisa pilih cara pembayaran yang paling cocok dengan budget dan kebutuhan bisnis Anda.</p>
                <div class="mt-4">
                    <div class="stat-badge">
                        <i class="bi bi-shield-check"></i>
                        <strong>NIB: <?= COMPANY_NIB ?></strong>
                    </div>
                </div>
            </div>
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                <div class="stats-grid">
                    <div class="stat-box">
                        <h3 class="counter" data-target="232">0</h3>
                        <p>Layanan Digital</p>
                    </div>
                    <div class="stat-box">
                        <h3 class="counter" data-target="50">0</h3>
                        <p>Demo Production-Ready</p>
                    </div>
                    <div class="stat-box">
                        <h3 class="counter" data-target="1500">0</h3>
                        <p>Kombinasi Template</p>
                    </div>
                    <div class="stat-box">
                        <h3>24 Jam</h3>
                        <p>Free Demo Delivery</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Values -->
<section class="values-section">
    <div class="container">
        <h2 class="section-title text-center mb-5">Nilai-Nilai Kami</h2>
        <div class="row g-4">
            <div class="col-lg-3 col-md-6" data-aos="fade-up">
                <div class="value-card">
                    <i class="bi bi-shield-check"></i>
                    <h3>Terpercaya</h3>
                    <p>Legalitas jelas, NIB terdaftar, proses transparan</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="value-card">
                    <i class="bi bi-cash-coin"></i>
                    <h3>Terjangkau</h3>
                    <p>Dual pricing: beli putus atau sewa bulanan</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="value-card">
                    <i class="bi bi-award"></i>
                    <h3>Berkualitas</h3>
                    <p>Production-ready, bukan mockup atau template abal-abal</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="value-card">
                    <i class="bi bi-headset"></i>
                    <h3>Support 24/7</h3>
                    <p>Tim siap bantu kapan saja via WhatsApp</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="about-cta-section">
    <div class="container text-center">
        <h2>Siap Mulai Project Anda?</h2>
        <p class="lead">Konsultasi GRATIS sekarang dan dapatkan free demo dalam 24 jam!</p>
        <div class="cta-buttons">
            <a href="<?= url('demo') ?>" class="btn btn-success btn-lg">
                <i class="bi bi-gift"></i> Request Free Demo
            </a>
            <a href="<?= url('contact') ?>" class="btn btn-light btn-lg">
                <i class="bi bi-envelope"></i> Hubungi Kami
            </a>
        </div>
    </div>
</section>

<?php include INCLUDES_PATH . 'footer/public-footer.php'; ?>

<style>
.about-hero {
    background: linear-gradient(135deg, var(--dark) 0%, var(--dark-light) 100%);
    color: var(--white);
    padding: 100px 0 60px;
}

.story-section {
    padding: 4rem 0;
}

.stat-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 1rem 2rem;
    background: var(--gradient-success);
    color: var(--white);
    border-radius: var(--radius-lg);
    font-size: 1.125rem;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
}

.stat-box {
    background: var(--gray-50);
    padding: 2rem;
    border-radius: var(--radius-lg);
    text-align: center;
}

.stat-box h3 {
    font-size: 3rem;
    font-weight: 800;
    color: var(--primary-color);
    margin-bottom: 0.5rem;
}

.values-section {
    padding: 4rem 0;
    background: var(--gray-50);
}

.value-card {
    background: var(--white);
    padding: 2.5rem 2rem;
    border-radius: var(--radius-lg);
    text-align: center;
    box-shadow: var(--shadow);
    transition: var(--transition);
    height: 100%;
}

.value-card:hover {
    transform: translateY(-10px);
    box-shadow: var(--shadow-xl);
}

.value-card i {
    font-size: 3rem;
    color: var(--primary-color);
    margin-bottom: 1rem;
}

.about-cta-section {
    background: var(--gradient-primary);
    color: var(--white);
    padding: 4rem 0;
}

.about-cta-section h2 {
    color: var(--white);
}
</style>
