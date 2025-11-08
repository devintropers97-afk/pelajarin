<?php
/**
 * Pricing Page
 *
 * Halaman perbandingan harga:
 * - Dual pricing system explanation
 * - Pricing calculator
 * - Services pricing table
 * - FAQ pricing
 * - Package comparison
 */

defined('SITUNEO_ACCESS') or die('Direct access not permitted');

$page_title = 'Harga & Paket - Dual Pricing System | SITUNEO DIGITAL';
$page_description = 'Pilih antara Beli Putus (one-time payment) atau Sewa Bulanan (subscription). Harga transparan, tanpa biaya tersembunyi.';

include INCLUDES_PATH . 'header/public-header.php';
?>

<!-- Hero Section -->
<section class="pricing-hero">
    <div class="container text-center">
        <h1 class="hero-title" data-aos="fade-up">
            <span class="text-gradient">Harga Transparan</span><br>
            Dual Pricing System
        </h1>
        <p class="hero-subtitle" data-aos="fade-up" data-aos-delay="100">
            Pilih sistem pembayaran yang sesuai dengan kebutuhan dan budget Anda!<br>
            <strong>Beli Putus</strong> atau <strong>Sewa Bulanan</strong> - Anda yang tentukan!
        </p>
    </div>
</section>

<!-- Pricing System Comparison -->
<section class="pricing-system-section">
    <div class="container">
        <div class="row g-4 justify-content-center">
            <!-- One-Time Payment -->
            <div class="col-lg-5" data-aos="fade-up">
                <div class="pricing-system-card onetime">
                    <div class="system-icon">
                        <i class="bi bi-cash-stack"></i>
                    </div>
                    <h2>Beli Putus</h2>
                    <p class="system-desc">Bayar Sekali, Milik Selamanya</p>

                    <div class="price-range">
                        <div class="price-from">Mulai dari</div>
                        <div class="price-value">Rp 350.000</div>
                        <div class="price-note">One-time payment</div>
                    </div>

                    <div class="system-features">
                        <h4>Yang Anda Dapatkan:</h4>
                        <ul>
                            <li><i class="bi bi-check-circle-fill"></i> <strong>Ownership 100%</strong> - Website milik Anda sepenuhnya</li>
                            <li><i class="bi bi-check-circle-fill"></i> <strong>Source Code</strong> - Semua kode diberikan</li>
                            <li><i class="bi bi-check-circle-fill"></i> <strong>Migrate Hosting</strong> - Pindah hosting kapan saja</li>
                            <li><i class="bi bi-check-circle-fill"></i> <strong>No Monthly Fee</strong> - Tanpa biaya bulanan selamanya</li>
                            <li><i class="bi bi-check-circle-fill"></i> <strong>Bisa Dijual</strong> - Transfer ownership ke pihak lain</li>
                        </ul>
                    </div>

                    <div class="system-best-for">
                        <h4>Cocok Untuk:</h4>
                        <p> Bisnis jangka panjang (>1 tahun)<br>
                         Perusahaan established<br>
                         Yang mau hemat jangka panjang<br>
                         Butuh full control</p>
                    </div>

                    <a href="#pricing-table" class="btn btn-warning btn-lg w-100">
                        Lihat Harga Beli Putus
                    </a>
                </div>
            </div>

            <!-- Subscription -->
            <div class="col-lg-5" data-aos="fade-up" data-aos-delay="100">
                <div class="pricing-system-card subscription featured">
                    <div class="popular-badge">PALING POPULER</div>
                    <div class="system-icon">
                        <i class="bi bi-arrow-repeat"></i>
                    </div>
                    <h2>Sewa Bulanan</h2>
                    <p class="system-desc">Bayar Bulanan, Tanpa Komitmen Panjang</p>

                    <div class="price-range">
                        <div class="price-from">Mulai dari</div>
                        <div class="price-value">Rp 150.000<span>/bln</span></div>
                        <div class="price-note">Monthly subscription</div>
                    </div>

                    <div class="system-features">
                        <h4>Yang Anda Dapatkan:</h4>
                        <ul>
                            <li><i class="bi bi-check-circle-fill"></i> <strong>TANPA Setup Fee</strong> - Langsung jalan tanpa biaya awal</li>
                            <li><i class="bi bi-check-circle-fill"></i> <strong>Maintenance GRATIS</strong> - Kami yang urus semuanya</li>
                            <li><i class="bi bi-check-circle-fill"></i> <strong>Hosting Included</strong> - Sudah termasuk hosting</li>
                            <li><i class="bi bi-check-circle-fill"></i> <strong>Update Selamanya</strong> - Gratis update fitur baru</li>
                            <li><i class="bi bi-check-circle-fill"></i> <strong>Support 24/7</strong> - Tim siap bantu kapan saja</li>
                        </ul>
                    </div>

                    <div class="system-best-for">
                        <h4>Cocok Untuk:</h4>
                        <p> UMKM & startup<br>
                         Testing bisnis baru<br>
                         Budget terbatas (cicil bulanan)<br>
                         Mau praktis tanpa ribet</p>
                    </div>

                    <a href="#pricing-table" class="btn btn-success btn-lg w-100">
                        Lihat Harga Sewa Bulanan
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Savings Calculator -->
<section class="calculator-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="calculator-card" data-aos="fade-up">
                    <h2><i class="bi bi-calculator"></i> Kalkulator Hemat</h2>
                    <p>Hitung mana yang lebih hemat untuk bisnis Anda!</p>

                    <div class="calculator-form">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Harga Beli Putus</label>
                                <input type="number" class="form-control" id="oneTimePrice" value="1000000" min="0">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Harga Sewa/Bulan</label>
                                <input type="number" class="form-control" id="monthlyPrice" value="200000" min="0">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Berapa Bulan?</label>
                                <input type="number" class="form-control" id="months" value="12" min="1">
                            </div>
                        </div>

                        <div class="calculator-result mt-4">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="result-card onetime">
                                        <h4>Beli Putus</h4>
                                        <div class="result-price" id="oneTimeTotalDisplay">Rp 1.000.000</div>
                                        <small>Bayar sekali</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="result-card subscription">
                                        <h4>Sewa Bulanan</h4>
                                        <div class="result-price" id="subscriptionTotalDisplay">Rp 2.400.000</div>
                                        <small id="monthsDisplay">12 bulan × Rp 200.000</small>
                                    </div>
                                </div>
                            </div>

                            <div class="savings-result mt-3" id="savingsResult">
                                <strong>=° Hemat Rp 1.400.000</strong> dengan Beli Putus!
                            </div>

                            <div class="breakeven-info mt-3" id="breakevenInfo">
                                Break even point: <strong>5 bulan</strong>.<br>
                                Setelah 5 bulan, Beli Putus lebih hemat!
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pricing Table -->
<section class="pricing-table-section" id="pricing-table">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">Daftar Harga Lengkap</h2>
            <p class="section-subtitle">Pilih layanan dan sistem pembayaran yang sesuai</p>
        </div>

        <!-- Category Tabs -->
        <div class="pricing-tabs mb-4" data-aos="fade-up">
            <ul class="nav nav-pills justify-content-center">
                <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#all-services">
                        Semua Layanan
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="pill" data-bs-target="#web-dev">
                        Web Development
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="pill" data-bs-target="#mobile-app">
                        Mobile App
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="pill" data-bs-target="#marketing">
                        Digital Marketing
                    </button>
                </li>
            </ul>
        </div>

        <!-- Pricing Table -->
        <div class="tab-content">
            <div class="tab-pane fade show active" id="all-services">
                <div class="table-responsive" data-aos="fade-up">
                    <table class="table pricing-table">
                        <thead>
                            <tr>
                                <th>Layanan</th>
                                <th class="text-center">Beli Putus</th>
                                <th class="text-center">Sewa Bulanan</th>
                                <th class="text-center">Hemat</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <strong>Landing Page Basic</strong><br>
                                    <small class="text-muted">1 halaman responsive</small>
                                </td>
                                <td class="text-center">
                                    <div class="price-cell">Rp 350.000</div>
                                </td>
                                <td class="text-center">
                                    <div class="price-cell">Rp 150.000/bln</div>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success">Break even 3 bln</span>
                                </td>
                                <td class="text-center">
                                    <a href="<?= url('services/landing-page-basic') ?>" class="btn btn-sm btn-primary">Detail</a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Company Profile</strong><br>
                                    <small class="text-muted">5-7 halaman + CMS</small>
                                </td>
                                <td class="text-center">
                                    <div class="price-cell">Rp 1.500.000</div>
                                </td>
                                <td class="text-center">
                                    <div class="price-cell">Rp 250.000/bln</div>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success">Break even 6 bln</span>
                                </td>
                                <td class="text-center">
                                    <a href="<?= url('services/company-profile') ?>" class="btn btn-sm btn-primary">Detail</a>
                                </td>
                            </tr>
                            <tr class="featured-row">
                                <td>
                                    <strong>E-Commerce Complete</strong> <span class="badge bg-warning">Popular</span><br>
                                    <small class="text-muted">Toko online lengkap + payment gateway</small>
                                </td>
                                <td class="text-center">
                                    <div class="price-cell">Rp 3.500.000</div>
                                </td>
                                <td class="text-center">
                                    <div class="price-cell">Rp 350.000/bln</div>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success">Break even 10 bln</span>
                                </td>
                                <td class="text-center">
                                    <a href="<?= url('services/ecommerce-complete') ?>" class="btn btn-sm btn-primary">Detail</a>
                                </td>
                            </tr>
                            <!-- More rows... (simplified for example) -->
                        </tbody>
                    </table>
                </div>

                <div class="text-center mt-4">
                    <a href="<?= url('services') ?>" class="btn btn-primary btn-lg">
                        Lihat Semua 232+ Layanan
                    </a>
                </div>
            </div>
            <!-- Other tabs content... -->
        </div>
    </div>
</section>

<!-- FAQ Pricing -->
<section class="faq-pricing-section">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">Pertanyaan Seputar Harga</h2>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="pricingFaq">
                    <div class="accordion-item" data-aos="fade-up">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                Apa perbedaan Beli Putus dan Sewa Bulanan?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#pricingFaq">
                            <div class="accordion-body">
                                <strong>Beli Putus:</strong> Bayar sekali di depan, website jadi milik Anda 100%. Source code diberikan, bisa migrate hosting, tanpa biaya bulanan.<br><br>
                                <strong>Sewa Bulanan:</strong> Bayar bulanan, tanpa setup fee. Maintenance, hosting, dan update sudah included. Bisa berhenti kapan saja.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item" data-aos="fade-up">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                Mana yang lebih hemat?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#pricingFaq">
                            <div class="accordion-body">
                                Tergantung jangka waktu penggunaan:<br>
                                " <strong>Kurang dari 6 bulan:</strong> Sewa Bulanan lebih hemat<br>
                                " <strong>Lebih dari 1 tahun:</strong> Beli Putus jauh lebih hemat<br>
                                " Gunakan kalkulator di atas untuk menghitung!
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item" data-aos="fade-up">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                Apakah ada biaya tersembunyi?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#pricingFaq">
                            <div class="accordion-body">
                                <strong>TIDAK ADA!</strong> Semua harga sudah transparan:<br>
                                " Beli Putus: Hanya bayar sekali sesuai harga tercantum<br>
                                " Sewa Bulanan: Bayar bulanan sesuai paket, sudah include hosting + maintenance<br>
                                " Domain dan hosting (jika beli putus) bisa Anda urus sendiri atau minta bantuan kami dengan harga transparan
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item" data-aos="fade-up">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                Bisa nego harga?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#pricingFaq">
                            <div class="accordion-body">
                                Harga sudah kami set kompetitif dan fair. Namun untuk project besar atau pemesanan paket bundling, kami bisa diskusikan harga khusus. Hubungi kami untuk konsultasi!
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item" data-aos="fade-up">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                                Metode pembayaran apa yang diterima?
                            </button>
                        </h2>
                        <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#pricingFaq">
                            <div class="accordion-body">
                                Kami menerima:<br>
                                " Transfer Bank (BCA, Mandiri, BRI, BNI)<br>
                                " E-Wallet (GoPay, OVO, DANA)<br>
                                " QRIS<br>
                                " Untuk Sewa Bulanan: Auto-debit available
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="pricing-cta-section">
    <div class="container text-center">
        <h2>Masih Bingung Pilih yang Mana?</h2>
        <p class="lead">Konsultasi GRATIS dengan tim kami untuk menentukan pilihan terbaik!</p>
        <div class="cta-buttons">
            <a href="<?= url('contact') ?>" class="btn btn-light btn-lg">
                <i class="bi bi-envelope"></i> Hubungi Kami
            </a>
            <a href="<?= whatsapp_link(COMPANY_WHATSAPP, 'Halo, saya mau konsultasi pricing') ?>" class="btn btn-success btn-lg" target="_blank">
                <i class="bi bi-whatsapp"></i> Chat WhatsApp
            </a>
        </div>
    </div>
</section>

<?php include INCLUDES_PATH . 'footer/public-footer.php'; ?>

<style>
.pricing-hero {
    background: linear-gradient(135deg, var(--dark) 0%, var(--dark-light) 100%);
    color: var(--white);
    padding: 100px 0 60px;
}

.pricing-system-section {
    padding: 4rem 0;
}

.pricing-system-card {
    background: var(--white);
    border: 3px solid var(--gray-200);
    border-radius: var(--radius-xl);
    padding: 2.5rem;
    height: 100%;
    position: relative;
    transition: var(--transition);
}

.pricing-system-card:hover {
    transform: translateY(-10px);
    box-shadow: var(--shadow-xl);
}

.pricing-system-card.onetime {
    border-color: var(--warning-color);
}

.pricing-system-card.subscription {
    border-color: var(--success-color);
}

.popular-badge {
    position: absolute;
    top: -15px;
    right: 20px;
    background: var(--gradient-success);
    color: var(--white);
    padding: 0.5rem 1.5rem;
    border-radius: var(--radius-lg);
    font-size: 0.75rem;
    font-weight: 700;
}

.system-icon {
    width: 100px;
    height: 100px;
    background: var(--gradient-primary);
    color: var(--white);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    margin: 0 auto 1.5rem;
}

.price-range {
    text-align: center;
    padding: 2rem 0;
    border-top: 2px solid var(--gray-200);
    border-bottom: 2px solid var(--gray-200);
    margin: 1.5rem 0;
}

.price-value {
    font-size: 2.5rem;
    font-weight: 800;
    color: var(--primary-color);
}

.system-features ul {
    list-style: none;
    padding: 0;
}

.system-features li {
    padding: 0.75rem 0;
    border-bottom: 1px solid var(--gray-200);
}

.calculator-section {
    padding: 4rem 0;
    background: var(--gray-50);
}

.calculator-card {
    background: var(--white);
    border-radius: var(--radius-xl);
    padding: 2.5rem;
    box-shadow: var(--shadow-lg);
}

.result-card {
    background: var(--gray-50);
    padding: 1.5rem;
    border-radius: var(--radius-lg);
    border: 2px solid var(--gray-300);
}

.result-price {
    font-size: 2rem;
    font-weight: 800;
    color: var(--primary-color);
    margin: 0.5rem 0;
}

.savings-result {
    background: var(--gradient-success);
    color: var(--white);
    padding: 1rem;
    border-radius: var(--radius-lg);
    text-align: center;
    font-size: 1.25rem;
}

.pricing-table-section {
    padding: 4rem 0;
}

.pricing-table {
    background: var(--white);
    border-radius: var(--radius-lg);
    overflow: hidden;
}

.pricing-table thead {
    background: var(--gradient-primary);
    color: var(--white);
}

.pricing-table .featured-row {
    background: rgba(251, 191, 36, 0.1);
}

.faq-pricing-section {
    padding: 4rem 0;
    background: var(--gray-50);
}

.pricing-cta-section {
    background: var(--gradient-primary);
    color: var(--white);
    padding: 4rem 0;
}

.pricing-cta-section h2 {
    color: var(--white);
}
</style>

<script>
// Calculator
function updateCalculator() {
    const oneTime = parseFloat(document.getElementById('oneTimePrice').value) || 0;
    const monthly = parseFloat(document.getElementById('monthlyPrice').value) || 0;
    const months = parseInt(document.getElementById('months').value) || 1;

    const subscriptionTotal = monthly * months;
    const savings = subscriptionTotal - oneTime;
    const breakEven = Math.ceil(oneTime / monthly);

    document.getElementById('oneTimeTotalDisplay').textContent = 'Rp ' + oneTime.toLocaleString('id-ID');
    document.getElementById('subscriptionTotalDisplay').textContent = 'Rp ' + subscriptionTotal.toLocaleString('id-ID');
    document.getElementById('monthsDisplay').textContent = months + ' bulan × Rp ' + monthly.toLocaleString('id-ID');

    const savingsEl = document.getElementById('savingsResult');
    const breakevenEl = document.getElementById('breakevenInfo');

    if (savings > 0) {
        savingsEl.innerHTML = '<strong>=° Hemat Rp ' + savings.toLocaleString('id-ID') + '</strong> dengan Beli Putus!';
        savingsEl.className = 'savings-result mt-3';
    } else {
        savingsEl.innerHTML = '<strong>=¡ Sewa Bulanan lebih hemat Rp ' + Math.abs(savings).toLocaleString('id-ID') + '</strong> untuk ' + months + ' bulan!';
        savingsEl.className = 'savings-result mt-3';
        savingsEl.style.background = 'var(--gradient-warning)';
    }

    breakevenEl.innerHTML = 'Break even point: <strong>' + breakEven + ' bulan</strong>.<br>Setelah ' + breakEven + ' bulan, Beli Putus lebih hemat!';
}

document.getElementById('oneTimePrice').addEventListener('input', updateCalculator);
document.getElementById('monthlyPrice').addEventListener('input', updateCalculator);
document.getElementById('months').addEventListener('input', updateCalculator);
</script>
