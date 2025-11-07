<?php
/**
 * ========================================
 * SITUNEO DIGITAL - Price Calculator Page
 * Kalkulator Harga - Interactive Price Calculator
 * ========================================
 */

require_once dirname(__DIR__) . '/config/init.php';

// Page variables
$current_page = 'calculator';
$page_title = 'Kalkulator Harga SITUNEO - Hitung Biaya Website Anda';
$page_description = 'Gunakan kalkulator harga interaktif SITUNEO untuk menghitung estimasi biaya website Anda. Pilih jenis website, fitur yang dibutuhkan, dan tingkat kompleksitas design.';
$lang = $_GET['lang'] ?? 'id';
$page_js = '/assets/js/calculator.js';

// Include header
include __DIR__ . '/../components/layout/header.php';
?>

<!-- Main Content -->
<main id="main-content">

    <!-- Breadcrumb -->
    <section class="breadcrumb-section">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo SITE_URL; ?>">Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Kalkulator Harga</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content text-center">
                <p class="hero-subtitle">KALKULATOR HARGA</p>
                <h1 class="hero-title">
                    Hitung Biaya<br>
                    Website <span class="text-gradient-gold">Anda</span>
                </h1>
                <p class="hero-description">
                    Masukkan kebutuhan website Anda dan dapatkan estimasi harga akurat
                    berdasarkan jenis website, fitur, dan kompleksitas design.
                </p>
            </div>
        </div>
    </section>

    <!-- Calculator Section -->
    <section class="section section-gray">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="calculator-card" data-aos="zoom-in">
                        <form id="calculatorForm">
                            <!-- Website Type Selection -->
                            <div class="form-group mb-4">
                                <label class="form-label fw-bold">
                                    <i class="bi bi-globe me-2 text-gradient-gold"></i>
                                    Jenis Website
                                </label>
                                <select class="form-select form-select-lg" id="websiteType" name="websiteType" required>
                                    <option value="">Pilih jenis website...</option>
                                    <option value="landing-page" data-price="300000">Landing Page - Rp 300K</option>
                                    <option value="company-profile" data-price="350000">Company Profile - Rp 350K</option>
                                    <option value="portfolio" data-price="350000">Portfolio Website - Rp 350K</option>
                                    <option value="blog" data-price="300000">Blog - Rp 300K</option>
                                    <option value="ecommerce-basic" data-price="500000">E-Commerce Basic - Rp 500K</option>
                                    <option value="ecommerce-advanced" data-price="750000">E-Commerce Advanced - Rp 750K</option>
                                    <option value="education" data-price="400000">Platform Pendidikan - Rp 400K</option>
                                    <option value="saas" data-price="1000000">SaaS Platform - Rp 1M+</option>
                                </select>
                                <small class="form-text text-muted d-block mt-2">
                                    Pilih kategori website yang paling sesuai dengan bisnis Anda
                                </small>
                            </div>

                            <!-- Features Selection -->
                            <div class="form-group mb-4">
                                <label class="form-label fw-bold">
                                    <i class="bi bi-lightning-charge me-2 text-gradient-gold"></i>
                                    Fitur Yang Dibutuhkan
                                </label>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input feature-checkbox" type="checkbox" id="seoOptimized"
                                                   name="features" value="seo" data-price="100000">
                                            <label class="form-check-label" for="seoOptimized">
                                                <i class="bi bi-search me-1"></i>
                                                SEO Optimization <small class="text-danger">+Rp 100K</small>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input feature-checkbox" type="checkbox" id="formSubmission"
                                                   name="features" value="form" data-price="50000">
                                            <label class="form-check-label" for="formSubmission">
                                                <i class="bi bi-pencil-square me-1"></i>
                                                Contact Form <small class="text-danger">+Rp 50K</small>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input feature-checkbox" type="checkbox" id="booking"
                                                   name="features" value="booking" data-price="150000">
                                            <label class="form-check-label" for="booking">
                                                <i class="bi bi-calendar-check me-1"></i>
                                                Booking System <small class="text-danger">+Rp 150K</small>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input feature-checkbox" type="checkbox" id="multiLanguage"
                                                   name="features" value="language" data-price="100000">
                                            <label class="form-check-label" for="multiLanguage">
                                                <i class="bi bi-translate me-1"></i>
                                                Multi-Language <small class="text-danger">+Rp 100K</small>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input feature-checkbox" type="checkbox" id="newsletter"
                                                   name="features" value="newsletter" data-price="75000">
                                            <label class="form-check-label" for="newsletter">
                                                <i class="bi bi-envelope-heart me-1"></i>
                                                Newsletter System <small class="text-danger">+Rp 75K</small>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-check">
                                            <input class="form-check-input feature-checkbox" type="checkbox" id="analytics"
                                                   name="features" value="analytics" data-price="50000">
                                            <label class="form-check-label" for="analytics">
                                                <i class="bi bi-graph-up me-1"></i>
                                                Analytics Integration <small class="text-danger">+Rp 50K</small>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Design Complexity -->
                            <div class="form-group mb-4">
                                <label class="form-label fw-bold">
                                    <i class="bi bi-palette me-2 text-gradient-gold"></i>
                                    Tingkat Kompleksitas Design
                                </label>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <input type="radio" class="btn-check" id="designSimple" name="design"
                                               value="simple" data-price="0" checked>
                                        <label class="btn btn-outline-blue w-100" for="designSimple">
                                            <i class="bi bi-square me-1"></i> Simple
                                        </label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="radio" class="btn-check" id="designModerate" name="design"
                                               value="moderate" data-price="150000">
                                        <label class="btn btn-outline-blue w-100" for="designModerate">
                                            <i class="bi bi-diagram-3 me-1"></i> Moderate
                                        </label>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="radio" class="btn-check" id="designAdvanced" name="design"
                                               value="advanced" data-price="300000">
                                        <label class="btn btn-outline-blue w-100" for="designAdvanced">
                                            <i class="bi bi-palette-fill me-1"></i> Advanced
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Price Breakdown -->
                            <div class="card bg-light mb-4">
                                <div class="card-body">
                                    <h6 class="card-title">Rincian Harga</h6>
                                    <div class="price-breakdown">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Harga Paket Website:</span>
                                            <strong id="basePrice">Rp 0</strong>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Fitur Tambahan:</span>
                                            <strong id="featuresPrice">Rp 0</strong>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Design Complexity:</span>
                                            <strong id="designPrice">Rp 0</strong>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between">
                                            <span class="fw-bold">Total Estimasi:</span>
                                            <h5 id="totalPrice" class="text-gradient-gold mb-0">Rp 0</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Option Selection -->
                            <div class="form-group mb-4">
                                <label class="form-label fw-bold">
                                    <i class="bi bi-wallet2 me-2 text-gradient-gold"></i>
                                    Opsi Pembayaran
                                </label>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <input type="radio" class="btn-check" id="paymentBeli" name="payment"
                                               value="beli" checked>
                                        <label class="btn btn-outline-gold w-100" for="paymentBeli">
                                            <i class="bi bi-bag-check me-1"></i> Beli Putus
                                        </label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="radio" class="btn-check" id="paymentSewa" name="payment"
                                               value="sewa">
                                        <label class="btn btn-outline-gold w-100" for="paymentSewa">
                                            <i class="bi bi-calendar-month me-1"></i> Sewa (Rp 150K/bulan)
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Buttons -->
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-gradient-gold btn-lg">
                                    <i class="bi bi-download me-2"></i>
                                    Download Estimasi
                                </button>
                                <a href="<?php echo SITE_URL; ?>/pages/contact.php" class="btn btn-outline-blue btn-lg">
                                    <i class="bi bi-chat-dots me-2"></i>
                                    Minta Penawaran Resmi
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Info Section -->
    <section class="section">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="card">
                        <div class="card-icon">
                            <i class="bi bi-info-circle"></i>
                        </div>
                        <h5 class="card-title">Estimasi Akurat</h5>
                        <p class="card-text">
                            Kalkulator kami memberikan estimasi harga yang akurat berdasarkan
                            pilihan Anda. Untuk penawaran resmi, hubungi tim kami.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="card">
                        <div class="card-icon">
                            <i class="bi bi-percent"></i>
                        </div>
                        <h5 class="card-title">Harga Transparan</h5>
                        <p class="card-text">
                            Tidak ada biaya tersembunyi. Semua komponen harga ditampilkan dengan jelas
                            sehingga Anda tahu persis apa yang Anda bayar.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="card">
                        <div class="card-icon">
                            <i class="bi bi-hand-thumbs-up"></i>
                        </div>
                        <h5 class="card-title">Fleksibel</h5>
                        <p class="card-text">
                            Pilih paket yang paling sesuai dengan kebutuhan Anda.
                            Anda bisa upgrade atau customize kapan saja.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section section-dark">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-lg-8" data-aos="fade-up">
                    <h2 class="display-4 mb-4">
                        Sudah Tahu Biayanya?
                    </h2>
                    <p class="lead mb-5">
                        Hubungi tim kami sekarang untuk mendiskusikan detail lebih lanjut
                        dan mendapatkan penawaran resmi khusus untuk bisnis Anda.
                    </p>
                    <a href="<?php echo SITE_URL; ?>/pages/contact.php" class="btn btn-gradient-gold btn-lg">
                        <i class="bi bi-telephone me-2"></i>
                        Hubungi Tim Kami
                    </a>
                </div>
            </div>
        </div>
    </section>

</main>

<style>
.calculator-card {
    background: white;
    border-radius: 12px;
    padding: 2rem;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}

.feature-checkbox, .form-check-input {
    cursor: pointer;
}

.price-breakdown {
    font-size: 0.95rem;
}

.form-label {
    color: var(--color-dark);
    margin-bottom: 1rem;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('calculatorForm');
    const websiteType = document.getElementById('websiteType');
    const featureCheckboxes = document.querySelectorAll('.feature-checkbox');
    const designRadios = document.querySelectorAll('input[name="design"]');

    function formatCurrency(value) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0
        }).format(value);
    }

    function calculatePrice() {
        let basePrice = 0;
        let featuresPrice = 0;
        let designPrice = 0;

        // Get base price
        if (websiteType.value) {
            const selectedOption = websiteType.options[websiteType.selectedIndex];
            basePrice = parseInt(selectedOption.getAttribute('data-price')) || 0;
        }

        // Get features price
        featureCheckboxes.forEach(checkbox => {
            if (checkbox.checked) {
                featuresPrice += parseInt(checkbox.getAttribute('data-price')) || 0;
            }
        });

        // Get design price
        const selectedDesign = document.querySelector('input[name="design"]:checked');
        if (selectedDesign) {
            designPrice = parseInt(selectedDesign.getAttribute('data-price')) || 0;
        }

        const total = basePrice + featuresPrice + designPrice;

        // Update display
        document.getElementById('basePrice').textContent = formatCurrency(basePrice);
        document.getElementById('featuresPrice').textContent = formatCurrency(featuresPrice);
        document.getElementById('designPrice').textContent = formatCurrency(designPrice);
        document.getElementById('totalPrice').textContent = formatCurrency(total);
    }

    // Event listeners
    websiteType.addEventListener('change', calculatePrice);
    featureCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', calculatePrice);
    });
    designRadios.forEach(radio => {
        radio.addEventListener('change', calculatePrice);
    });

    // Form submission
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Estimasi akan diunduh. Fitur ini akan diintegrasikan dengan backend untuk mengirim estimasi via email.');
    });

    // Initial calculation
    calculatePrice();
});
</script>

<?php
// Include footer
include __DIR__ . '/../components/layout/footer.php';
?>
