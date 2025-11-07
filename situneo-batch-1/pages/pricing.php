<?php
/**
 * ========================================
 * SITUNEO DIGITAL - Pricing Page
 * Harga - Detailed Pricing & Comparison
 * ========================================
 */

require_once dirname(__DIR__) . '/config/init.php';

// Page variables
$current_page = 'pricing';
$page_title = 'Harga SITUNEO - Paket Beli Putus & Sewa Website';
$page_description = 'Lihat paket harga lengkap SITUNEO. Beli Putus Rp 350K atau Sewa Rp 150K/bulan. Bandingkan fitur, bonus, dan dukungan di antara kedua paket.';
$lang = $_GET['lang'] ?? 'id';

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
                    <li class="breadcrumb-item active" aria-current="page">Harga</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content text-center">
                <p class="hero-subtitle">PAKET HARGA</p>
                <h1 class="hero-title">
                    Pilih Paket<br>
                    yang Sesuai <span class="text-gradient-gold">Budget Anda</span>
                </h1>
                <p class="hero-description">
                    Dua pilihan pembayaran yang fleksibel: Beli Putus atau Sewa Bulanan.
                    Pilih yang paling sesuai dengan kebutuhan dan budget Anda.
                </p>
            </div>
        </div>
    </section>

    <!-- Pricing Comparison Section -->
    <section class="section section-gray">
        <div class="container">
            <div class="section-header">
                <p class="section-subtitle">BANDINGKAN PAKET</p>
                <h2 class="section-title">Sewa vs Beli Putus</h2>
            </div>

            <div class="row g-4 justify-content-center">
                <!-- Sewa Package -->
                <div class="col-lg-5 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="card pricing-card">
                        <div class="card-body p-4">
                            <div class="mb-3 text-center">
                                <i class="bi bi-calendar-month" style="font-size: 3rem; color: var(--color-primary);"></i>
                            </div>
                            <h3 class="card-title text-center mb-3">Paket Sewa</h3>
                            <div class="text-center mb-4">
                                <h2 class="text-gradient-blue mb-0">
                                    Rp 150K
                                    <small class="text-muted" style="font-size: 0.8rem;">/bulan</small>
                                </h2>
                                <p class="text-success fw-bold mt-2">
                                    <i class="bi bi-check-circle-fill me-1"></i>
                                    TANPA BIAYA SETUP
                                </p>
                                <p class="text-muted small">Minimum 12 bulan</p>
                            </div>

                            <h5 class="mb-3">Fitur Termasuk:</h5>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-2">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    <strong>1 Website Pilihan</strong>
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
                                    Backup Otomatis
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    Support 24/7
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    Email Account (5)
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    CDN & Cache Optimization
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-x-circle-fill text-danger me-2"></i>
                                    <span class="text-muted">Source Code Anda Tidak Diberikan</span>
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-x-circle-fill text-danger me-2"></i>
                                    <span class="text-muted">Bergantung pada Platform</span>
                                </li>
                            </ul>

                            <a href="https://wa.me/<?php echo str_replace(['+', '-', ' '], '', '62821xxxx'); ?>?text=<?php echo urlencode('Saya tertarik dengan paket Sewa'); ?>"
                               target="_blank"
                               class="btn btn-gradient-blue w-100">
                                <i class="bi bi-whatsapp me-2"></i>
                                Pesan Sekarang
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Beli Putus Package -->
                <div class="col-lg-5 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="card pricing-card" style="border: 3px solid var(--color-secondary);">
                        <div class="position-absolute top-0 start-50 translate-middle">
                            <span class="badge bg-warning text-dark px-4 py-2">
                                <i class="bi bi-star-fill me-1"></i>
                                PALING POPULER
                            </span>
                        </div>
                        <div class="card-body p-4">
                            <div class="mb-3 text-center">
                                <i class="bi bi-bag-check" style="font-size: 3rem; color: var(--color-secondary);"></i>
                            </div>
                            <h3 class="card-title text-center mb-3">Beli Putus</h3>
                            <div class="text-center mb-4">
                                <h2 class="text-gradient-gold mb-0">Rp 350K</h2>
                                <p class="text-primary fw-bold mt-2">
                                    <i class="bi bi-infinity me-1"></i>
                                    SEKALI BAYAR SELAMANYA
                                </p>
                                <p class="text-muted small">Tanpa komitmen jangka panjang</p>
                            </div>

                            <h5 class="mb-3">Fitur Termasuk:</h5>
                            <ul class="list-unstyled mb-4">
                                <li class="mb-2">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    <strong>1 Website Pilihan</strong>
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    <strong>Full Source Code</strong>
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    <strong>Milik Anda Selamanya</strong>
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
                                    Support Premium 1 Tahun
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    Email Account (10)
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    SEO Optimization
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    <span class="text-success">Custom Domain 1 Tahun</span>
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                                    <span class="text-success">Unlimited Storage</span>
                                </li>
                            </ul>

                            <a href="https://wa.me/<?php echo str_replace(['+', '-', ' '], '', '62821xxxx'); ?>?text=<?php echo urlencode('Saya tertarik dengan paket Beli Putus'); ?>"
                               target="_blank"
                               class="btn btn-gradient-gold w-100">
                                <i class="bi bi-whatsapp me-2"></i>
                                Beli Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="300">
                <p class="text-muted mb-3">Masih ragu memilih paket mana?</p>
                <a href="<?php echo SITE_URL; ?>/pages/calculator.php" class="btn btn-outline-blue">
                    <i class="bi bi-calculator me-2"></i>
                    Gunakan Kalkulator Harga
                </a>
            </div>
        </div>
    </section>

    <!-- Feature Comparison Table -->
    <section class="section">
        <div class="container">
            <div class="section-header">
                <p class="section-subtitle">PERBANDINGAN DETAIL</p>
                <h2 class="section-title">Tabel Perbandingan Fitur</h2>
            </div>

            <div class="table-responsive" data-aos="fade-up">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th style="width: 30%;">Fitur</th>
                            <th class="text-center" style="width: 35%;">
                                <i class="bi bi-calendar-month me-1"></i> Paket Sewa
                            </th>
                            <th class="text-center" style="width: 35%;">
                                <i class="bi bi-bag-check me-1"></i> Beli Putus
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Harga</strong></td>
                            <td class="text-center">Rp 150K/bulan</td>
                            <td class="text-center"><strong class="text-success">Rp 350K (Sekali)</strong></td>
                        </tr>
                        <tr>
                            <td><strong>Biaya Setup</strong></td>
                            <td class="text-center">Gratis</td>
                            <td class="text-center">Gratis</td>
                        </tr>
                        <tr>
                            <td><strong>Source Code</strong></td>
                            <td class="text-center"><i class="bi bi-x-lg text-danger"></i></td>
                            <td class="text-center"><i class="bi bi-check-lg text-success"></i></td>
                        </tr>
                        <tr>
                            <td><strong>Domain & Hosting</strong></td>
                            <td class="text-center"><i class="bi bi-check-lg text-success"></i></td>
                            <td class="text-center">Kustomisasi</td>
                        </tr>
                        <tr>
                            <td><strong>Support</strong></td>
                            <td class="text-center">24/7 (Unlimited)</td>
                            <td class="text-center">1 Tahun Premium</td>
                        </tr>
                        <tr>
                            <td><strong>Update & Maintenance</strong></td>
                            <td class="text-center"><i class="bi bi-check-lg text-success"></i></td>
                            <td class="text-center">1 Tahun Gratis</td>
                        </tr>
                        <tr>
                            <td><strong>Komitmen</strong></td>
                            <td class="text-center">Min. 12 bulan</td>
                            <td class="text-center">Tidak ada</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="section section-gray">
        <div class="container">
            <div class="section-header">
                <p class="section-subtitle">PERTANYAAN UMUM</p>
                <h2 class="section-title">FAQ Tentang Harga</h2>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="accordion" id="faqAccordion" data-aos="fade-up">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    Apa perbedaan paket Sewa dan Beli Putus?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Paket Sewa adalah layanan bulanan di mana kami menyediakan hosting, domain, dan maintenance.
                                    Beli Putus adalah pembelian satu kali yang memberikan Anda full source code dan kepemilikan website.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    Apakah ada biaya setup atau biaya tersembunyi?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Tidak ada biaya setup atau biaya tersembunyi. Harga yang kami tampilkan adalah harga final yang Anda bayarkan.
                                    Semua fitur dan bonus sudah termasuk dalam paket.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    Bisakah saya upgrade paket setelah membeli?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Ya, Anda bisa upgrade atau menambahkan fitur kapan saja. Hubungi tim support kami untuk details lebih lanjut
                                    tentang opsi upgrade yang tersedia.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                    Apakah ada diskon untuk kontrak tahunan pada paket Sewa?
                                </button>
                            </h2>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Ya, untuk kontrak tahunan pada paket Sewa, kami memberikan diskon khusus. Hubungi kami untuk mendapatkan
                                    penawaran terbaik sesuai dengan kebutuhan Anda.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                                    Bagaimana jika saya ingin custom design atau fitur tambahan?
                                </button>
                            </h2>
                            <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Kami menyediakan layanan custom design dan pengembangan fitur tambahan. Harga akan disesuaikan dengan
                                    kompleksitas dan scope pekerjaan. Silakan hubungi kami untuk konsultasi gratis.
                                </div>
                            </div>
                        </div>
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
                        Siap Memilih Paket?
                    </h2>
                    <p class="lead mb-5">
                        Jangan ragu untuk menghubungi kami. Tim kami siap membantu Anda memilih paket
                        yang paling sesuai dengan kebutuhan dan budget bisnis Anda.
                    </p>
                    <div class="d-flex gap-3 justify-content-center flex-wrap">
                        <a href="<?php echo SITE_URL; ?>/pages/contact.php" class="btn btn-gradient-gold btn-lg">
                            <i class="bi bi-chat-dots me-2"></i>
                            Konsultasi Gratis
                        </a>
                        <a href="<?php echo SITE_URL; ?>/pages/calculator.php" class="btn btn-outline-gold btn-lg">
                            <i class="bi bi-calculator me-2"></i>
                            Hitung Biaya
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<?php
// Include footer
include __DIR__ . '/../components/layout/footer.php';
?>
