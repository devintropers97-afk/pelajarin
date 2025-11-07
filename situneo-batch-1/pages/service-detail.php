<?php
/**
 * ========================================
 * SITUNEO DIGITAL - Service Detail Page
 * Detail Layanan - Individual Service Page
 * ========================================
 */

require_once dirname(__DIR__) . '/config/init.php';

// Page variables
$current_page = 'service-detail';
$service_id = $_GET['id'] ?? 1;

// Sample service details
$services = [
    1 => [
        'title' => 'Company Profile Modern',
        'category' => 'Company Profile',
        'price' => 'Rp 350K',
        'icon' => 'bi-building',
        'overview' => 'Website company profile profesional dengan desain modern dan responsive. Sempurna untuk menampilkan profil perusahaan, visi misi, tim, dan portofolio bisnis Anda.',
        'features' => [
            'Responsive Design - Tampil sempurna di semua perangkat',
            'Contact Form - Form komunikasi dari pengunjung',
            'Gallery - Showcase foto dan proyek bisnis',
            'Team Section - Tampilkan profil tim Anda',
            'SEO Optimized - Built-in SEO tools',
            'Fast Loading - Optimasi kecepatan tinggi',
            'SSL Certificate Gratis - Keamanan maksimal',
            'Hosting & Domain - Included dalam paket'
        ],
        'description' => 'Solusi website lengkap untuk perusahaan yang ingin memiliki kehadiran digital profesional dan terpercaya.'
    ],
    2 => [
        'title' => 'Toko Online Lengkap',
        'category' => 'E-Commerce',
        'price' => 'Rp 500K',
        'icon' => 'bi-cart-check',
        'overview' => 'Platform e-commerce lengkap dengan fitur toko online profesional. Dilengkapi payment gateway, inventory management, dan sistem order otomatis.',
        'features' => [
            'Product Catalog - Kelola ribuan produk dengan mudah',
            'Shopping Cart - Sistem keranjang belanja yang smooth',
            'Payment Gateway - Integrasi berbagai metode pembayaran',
            'Inventory Management - Kelola stok produk otomatis',
            'Order Tracking - Pelanggan bisa tracking pesanan',
            'Discount System - Buat promo dan diskon menarik',
            'Email Notification - Notifikasi otomatis untuk order',
            'Mobile Responsive - Belanja dari smartphone lancar'
        ],
        'description' => 'Toko online profesional yang siap meningkatkan penjualan Anda dengan teknologi terkini.'
    ]
];

// Get service data
$service = $services[$service_id] ?? $services[1];
$page_title = $service['title'] . ' - SITUNEO Digital';
$page_description = $service['overview'];
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
                    <li class="breadcrumb-item"><a href="<?php echo SITE_URL; ?>/pages/services.php">Layanan</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo htmlspecialchars($service['title']); ?></li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Service Header Section -->
    <section class="service-header-section py-5" style="background: linear-gradient(135deg, rgba(13,110,253,0.1), rgba(220,182,35,0.1));">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-6" data-aos="fade-right">
                    <span class="badge bg-gradient-gold mb-3">
                        <i class="bi bi-tag me-1"></i>
                        <?php echo htmlspecialchars($service['category']); ?>
                    </span>
                    <h1 class="display-4 mb-3">
                        <?php echo htmlspecialchars($service['title']); ?>
                    </h1>
                    <p class="lead text-muted mb-4">
                        <?php echo htmlspecialchars($service['overview']); ?>
                    </p>
                    <div class="d-flex gap-3 flex-wrap">
                        <h3 class="text-gradient-gold mb-0">
                            <i class="bi bi-tag me-2"></i>
                            <?php echo htmlspecialchars($service['price']); ?>
                        </h3>
                        <a href="<?php echo SITE_URL; ?>/pages/contact.php" class="btn btn-gradient-gold btn-lg">
                            <i class="bi bi-chat-dots me-2"></i>
                            Konsultasi Gratis
                        </a>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="service-icon-large">
                        <i class="bi <?php echo htmlspecialchars($service['icon']); ?>"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Service Content Section -->
    <section class="section section-gray">
        <div class="container">
            <!-- Tabs Navigation -->
            <ul class="nav nav-tabs nav-fill mb-4" role="tablist" data-aos="fade-up">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview"
                            type="button" role="tab" aria-controls="overview" aria-selected="true">
                        <i class="bi bi-file-text me-2"></i>Overview
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="features-tab" data-bs-toggle="tab" data-bs-target="#features"
                            type="button" role="tab" aria-controls="features" aria-selected="false">
                        <i class="bi bi-lightning-charge me-2"></i>Fitur
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pricing-tab" data-bs-toggle="tab" data-bs-target="#pricing"
                            type="button" role="tab" aria-controls="pricing" aria-selected="false">
                        <i class="bi bi-wallet me-2"></i>Harga
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="faq-tab" data-bs-toggle="tab" data-bs-target="#faq"
                            type="button" role="tab" aria-controls="faq" aria-selected="false">
                        <i class="bi bi-question-circle me-2"></i>FAQ
                    </button>
                </li>
            </ul>

            <!-- Tab Content -->
            <div class="tab-content">
                <!-- Overview Tab -->
                <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                    <div class="row g-4">
                        <div class="col-lg-8" data-aos="fade-up">
                            <div class="card">
                                <div class="card-body p-4">
                                    <h3 class="card-title mb-3">Tentang Layanan Ini</h3>
                                    <p class="card-text mb-3">
                                        <?php echo htmlspecialchars($service['description']); ?>
                                    </p>
                                    <p class="card-text text-muted">
                                        Layanan kami dirancang dengan mempertimbangkan kebutuhan bisnis modern Anda.
                                        Dengan teknologi terkini dan dukungan penuh dari tim expert kami, website Anda
                                        akan berkembang pesat dan memberikan ROI maksimal.
                                    </p>

                                    <h4 class="mt-4 mb-3">Mengapa Memilih Layanan Ini?</h4>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="d-flex gap-3">
                                                <div class="flex-shrink-0">
                                                    <i class="bi bi-check-circle-fill text-success" style="font-size: 1.5rem;"></i>
                                                </div>
                                                <div>
                                                    <h6>Desain Profesional</h6>
                                                    <p class="small text-muted">Template dirancang oleh designer berpengalaman</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex gap-3">
                                                <div class="flex-shrink-0">
                                                    <i class="bi bi-check-circle-fill text-success" style="font-size: 1.5rem;"></i>
                                                </div>
                                                <div>
                                                    <h6>SEO Ready</h6>
                                                    <p class="small text-muted">Optimasi untuk ranking Google tinggi</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex gap-3">
                                                <div class="flex-shrink-0">
                                                    <i class="bi bi-check-circle-fill text-success" style="font-size: 1.5rem;"></i>
                                                </div>
                                                <div>
                                                    <h6>Mobile Friendly</h6>
                                                    <p class="small text-muted">Responsif di semua ukuran layar</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="d-flex gap-3">
                                                <div class="flex-shrink-0">
                                                    <i class="bi bi-check-circle-fill text-success" style="font-size: 1.5rem;"></i>
                                                </div>
                                                <div>
                                                    <h6>Support Lengkap</h6>
                                                    <p class="small text-muted">Tim support siap membantu 24/7</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Gallery Section -->
                            <div class="card mt-4">
                                <div class="card-body p-4">
                                    <h4 class="card-title mb-3">Screenshot & Demo</h4>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <img src="<?php echo SITE_URL; ?>/assets/images/service-screenshot-1.jpg"
                                                 alt="Screenshot 1" class="img-fluid rounded"
                                                 onerror="this.src='<?php echo SITE_URL; ?>/assets/images/placeholder.jpg'">
                                        </div>
                                        <div class="col-md-6">
                                            <img src="<?php echo SITE_URL; ?>/assets/images/service-screenshot-2.jpg"
                                                 alt="Screenshot 2" class="img-fluid rounded"
                                                 onerror="this.src='<?php echo SITE_URL; ?>/assets/images/placeholder.jpg'">
                                        </div>
                                    </div>
                                    <p class="text-muted mt-3 mb-0">
                                        <i class="bi bi-info-circle me-2"></i>
                                        Klik pada gambar untuk melihat demo langsung atau minta akses demo dari tim kami.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Sidebar -->
                        <div class="col-lg-4">
                            <!-- Request Demo Form -->
                            <div class="card sticky-top" data-aos="fade-left">
                                <div class="card-body p-4">
                                    <h5 class="card-title mb-3">
                                        <i class="bi bi-play-circle me-2"></i>
                                        Minta Demo
                                    </h5>
                                    <form id="demoForm">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" placeholder="Nama Anda" required>
                                        </div>
                                        <div class="mb-3">
                                            <input type="email" class="form-control" placeholder="Email Anda" required>
                                        </div>
                                        <div class="mb-3">
                                            <input type="tel" class="form-control" placeholder="No. WhatsApp" required>
                                        </div>
                                        <button type="submit" class="btn btn-gradient-gold w-100">
                                            <i class="bi bi-send me-2"></i>Kirim Request
                                        </button>
                                    </form>
                                    <p class="text-muted small mt-3 mb-0">
                                        Tim kami akan menghubungi Anda dalam 24 jam.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Features Tab -->
                <div class="tab-pane fade" id="features" role="tabpanel" aria-labelledby="features-tab">
                    <div class="card">
                        <div class="card-body p-4">
                            <h3 class="card-title mb-4">Fitur yang Termasuk</h3>
                            <div class="row g-4">
                                <?php foreach ($service['features'] as $index => $feature): ?>
                                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="<?php echo ($index % 2) * 100; ?>">
                                        <div class="d-flex gap-3">
                                            <div class="flex-shrink-0">
                                                <i class="bi bi-check2-circle text-success" style="font-size: 1.5rem;"></i>
                                            </div>
                                            <div>
                                                <h6><?php echo htmlspecialchars(explode(' - ', $feature)[0]); ?></h6>
                                                <p class="small text-muted mb-0">
                                                    <?php echo htmlspecialchars(explode(' - ', $feature)[1] ?? ''); ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pricing Tab -->
                <div class="tab-pane fade" id="pricing" role="tabpanel" aria-labelledby="pricing-tab">
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="card text-center">
                                <div class="card-body p-4">
                                    <h5 class="card-title mb-3">Beli Putus</h5>
                                    <h2 class="text-gradient-gold mb-3"><?php echo htmlspecialchars($service['price']); ?></h2>
                                    <p class="text-muted mb-4">Sekali bayar, selamanya milik Anda</p>
                                    <ul class="list-unstyled text-start mb-4">
                                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Full Source Code</li>
                                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Milik Anda Selamanya</li>
                                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Free Update 1 Tahun</li>
                                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Dokumentasi Lengkap</li>
                                    </ul>
                                    <a href="<?php echo SITE_URL; ?>/pages/contact.php" class="btn btn-gradient-gold w-100">
                                        <i class="bi bi-bag-check me-2"></i>Beli Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card text-center">
                                <div class="card-body p-4">
                                    <h5 class="card-title mb-3">Sewa Bulanan</h5>
                                    <h2 class="text-gradient-blue mb-3">Rp 150K<small style="font-size: 0.6em;">/bulan</small></h2>
                                    <p class="text-muted mb-4">Tanpa biaya setup, gratis maintenance</p>
                                    <ul class="list-unstyled text-start mb-4">
                                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Domain & Hosting</li>
                                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Maintenance & Update</li>
                                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Support 24/7</li>
                                        <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Backup Otomatis</li>
                                    </ul>
                                    <a href="<?php echo SITE_URL; ?>/pages/contact.php" class="btn btn-gradient-blue w-100">
                                        <i class="bi bi-calendar-month me-2"></i>Sewa Sekarang
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FAQ Tab -->
                <div class="tab-pane fade" id="faq" role="tabpanel" aria-labelledby="faq-tab">
                    <div class="card">
                        <div class="card-body p-4">
                            <h3 class="card-title mb-4">Pertanyaan yang Sering Diajukan</h3>
                            <div class="accordion" id="serviceFaqAccordion">
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqService1">
                                            Berapa lama proses implementasi layanan ini?
                                        </button>
                                    </h2>
                                    <div id="faqService1" class="accordion-collapse collapse show" data-bs-parent="#serviceFaqAccordion">
                                        <div class="accordion-body">
                                            Waktu implementasi biasanya 1-2 minggu tergantung kompleksitas customization.
                                            Untuk layanan standar, website Anda bisa langsung online dalam beberapa hari.
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqService2">
                                            Apakah bisa customize sesuai brand saya?
                                        </button>
                                    </h2>
                                    <div id="faqService2" class="accordion-collapse collapse" data-bs-parent="#serviceFaqAccordion">
                                        <div class="accordion-body">
                                            Tentu! Kami menyediakan berbagai opsi customization. Untuk kebutuhan custom khusus,
                                            silakan hubungi tim kami untuk mendiskusikan biaya customization.
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqService3">
                                            Bagaimana dengan support setelah website jadi?
                                        </button>
                                    </h2>
                                    <div id="faqService3" class="accordion-collapse collapse" data-bs-parent="#serviceFaqAccordion">
                                        <div class="accordion-body">
                                            Support penuh sesuai paket yang Anda pilih. Untuk paket sewa, support 24/7 unlimited.
                                            Untuk beli putus, support premium selama 1 tahun, dan extended support berbayar setelahnya.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Services Section -->
    <section class="section">
        <div class="container">
            <div class="section-header">
                <p class="section-subtitle">LAYANAN TERKAIT</p>
                <h2 class="section-title">Layanan Lainnya Yang Mungkin Anda Butuhkan</h2>
            </div>

            <div class="row g-4">
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="card">
                        <div class="card-icon">
                            <i class="bi bi-cart-check"></i>
                        </div>
                        <h5 class="card-title">E-Commerce</h5>
                        <p class="card-text">Toko online lengkap dengan payment gateway</p>
                        <a href="<?php echo SITE_URL; ?>/pages/service-detail.php?id=2" class="btn btn-outline-blue btn-sm w-100">
                            Lihat Detail
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="card">
                        <div class="card-icon">
                            <i class="bi bi-rocket-takeoff"></i>
                        </div>
                        <h5 class="card-title">Landing Page</h5>
                        <p class="card-text">Landing page optimized untuk konversi tinggi</p>
                        <a href="#" class="btn btn-outline-blue btn-sm w-100">
                            Lihat Detail
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="card">
                        <div class="card-icon">
                            <i class="bi bi-image"></i>
                        </div>
                        <h5 class="card-title">Portfolio</h5>
                        <p class="card-text">Website showcase portfolio profesional</p>
                        <a href="#" class="btn btn-outline-blue btn-sm w-100">
                            Lihat Detail
                        </a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="card">
                        <div class="card-icon">
                            <i class="bi bi-mortarboard"></i>
                        </div>
                        <h5 class="card-title">E-Learning</h5>
                        <p class="card-text">Platform pendidikan online yang lengkap</p>
                        <a href="#" class="btn btn-outline-blue btn-sm w-100">
                            Lihat Detail
                        </a>
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
                        Siap Memulai?
                    </h2>
                    <p class="lead mb-5">
                        Hubungi tim kami sekarang untuk mendiskusikan detail lebih lanjut
                        dan dapatkan penawaran khusus untuk layanan ini.
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

<style>
.service-icon-large {
    font-size: 10rem;
    color: var(--color-secondary);
    opacity: 0.1;
    text-align: center;
    display: flex;
    align-items: center;
    justify-content: center;
}

.nav-tabs .nav-link {
    color: var(--color-primary);
}

.nav-tabs .nav-link.active {
    background: linear-gradient(135deg, var(--color-secondary), var(--color-secondary));
    color: white;
}

.sticky-top {
    top: 80px;
}

@media (max-width: 991px) {
    .sticky-top {
        position: relative;
        top: auto;
    }
}
</style>

<script>
document.getElementById('demoForm').addEventListener('submit', function(e) {
    e.preventDefault();
    alert('Request demo Anda telah dikirim! Tim kami akan menghubungi Anda segera.');
});
</script>

<?php
// Include footer
include __DIR__ . '/../components/layout/footer.php';
?>
