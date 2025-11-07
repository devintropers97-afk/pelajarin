<?php
/**
 * ========================================
 * SITUNEO DIGITAL - Services Page
 * Layanan - Semua Jenis Website & Template
 * ========================================
 */

require_once dirname(__DIR__) . '/config/init.php';

// Page variables
$current_page = 'services';
$page_title = 'Layanan Website SITUNEO - 1500+ Template untuk Bisnis Anda';
$page_description = 'Jelajahi 1500+ template website profesional SITUNEO. Dari company profile, e-commerce, landing page hingga portfolio. Mulai dari Rp 350K beli putus atau Rp 150K/bulan.';
$lang = $_GET['lang'] ?? 'id';

// Get category filter from URL
$category = $_GET['category'] ?? 'all';

// Sample services data
$services = [
    ['id' => 1, 'category' => 'company-profile', 'title' => 'Company Profile Modern', 'description' => 'Website profesional untuk perusahaan dengan desain modern dan responsive.', 'icon' => 'bi-building', 'price' => 'Rp 350K'],
    ['id' => 2, 'category' => 'ecommerce', 'title' => 'Toko Online Lengkap', 'description' => 'Platform e-commerce dengan payment gateway dan inventory management.', 'icon' => 'bi-cart-check', 'price' => 'Rp 500K'],
    ['id' => 3, 'category' => 'landing-page', 'title' => 'Landing Page Converter', 'description' => 'Landing page optimized untuk konversi dan sales tinggi.', 'icon' => 'bi-rocket-takeoff', 'price' => 'Rp 300K'],
    ['id' => 4, 'category' => 'portfolio', 'title' => 'Portfolio Kreatif', 'description' => 'Showcase karya dan portfolio dengan gallery yang menawan.', 'icon' => 'bi-image', 'price' => 'Rp 350K'],
    ['id' => 5, 'category' => 'education', 'title' => 'Platform E-Learning', 'description' => 'Website untuk sekolah, kursus, atau platform pembelajaran online.', 'icon' => 'bi-mortarboard', 'price' => 'Rp 400K'],
    ['id' => 6, 'category' => 'blog', 'title' => 'Blog Profesional', 'description' => 'Website blog dengan CMS lengkap dan SEO friendly.', 'icon' => 'bi-journal-text', 'price' => 'Rp 300K'],
    ['id' => 7, 'category' => 'restaurant', 'title' => 'Website Restoran', 'description' => 'Website untuk restoran dengan menu, booking, dan gallery makanan.', 'icon' => 'bi-cup-hot', 'price' => 'Rp 350K'],
    ['id' => 8, 'category' => 'hotel', 'title' => 'Website Hotel & Resort', 'description' => 'Platform hotel dengan sistem booking dan manajemen reservasi.', 'icon' => 'bi-building', 'price' => 'Rp 450K'],
    ['id' => 9, 'category' => 'clinic', 'title' => 'Website Klinik Kesehatan', 'description' => 'Website klinik dengan appointment booking dan patient management.', 'icon' => 'bi-hospital', 'price' => 'Rp 350K'],
    ['id' => 10, 'category' => 'salon', 'title' => 'Website Salon & Spa', 'description' => 'Website untuk salon dengan booking appointment dan treatment showcase.', 'icon' => 'bi-palette', 'price' => 'Rp 300K'],
    ['id' => 11, 'category' => 'realestate', 'title' => 'Website Real Estate', 'description' => 'Platform properti dengan listing lengkap dan fitur pencarian advanced.', 'icon' => 'bi-houses', 'price' => 'Rp 500K'],
    ['id' => 12, 'category' => 'automotive', 'title' => 'Website Showroom Mobil', 'description' => 'Website untuk dealer dengan inventory mobil dan booking test drive.', 'icon' => 'bi-car-front', 'price' => 'Rp 400K'],
];

// Filter services
$filtered_services = $category === 'all' ? $services : array_filter($services, function($s) use ($category) {
    return $s['category'] === $category;
});

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
                    <li class="breadcrumb-item active" aria-current="page">Layanan</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content text-center">
                <p class="hero-subtitle">LAYANAN KAMI</p>
                <h1 class="hero-title">
                    1500+ <span class="text-gradient-gold">Template</span><br>
                    untuk Setiap Bisnis Anda
                </h1>
                <p class="hero-description">
                    Dari company profile hingga e-commerce, kami memiliki solusi website yang tepat
                    untuk kebutuhan bisnis Anda dengan harga terjangkau.
                </p>
            </div>
        </div>
    </section>

    <!-- Search & Filter Section -->
    <section class="section section-gray">
        <div class="container">
            <!-- Search Bar -->
            <div class="row mb-5">
                <div class="col-lg-8 mx-auto" data-aos="fade-up">
                    <div class="input-group input-group-lg">
                        <input type="text" class="form-control" placeholder="Cari template..." id="searchInput">
                        <button class="btn btn-gradient-gold" type="button">
                            <i class="bi bi-search me-1"></i> Cari
                        </button>
                    </div>
                </div>
            </div>

            <!-- Category Filter -->
            <div class="row mb-4">
                <div class="col-12">
                    <div class="d-flex flex-wrap gap-2 justify-content-center" data-aos="fade-up" data-aos-delay="100">
                        <a href="<?php echo SITE_URL; ?>/pages/services.php"
                           class="btn <?php echo $category === 'all' ? 'btn-gradient-gold' : 'btn-outline-gold'; ?>">
                            Semua Layanan
                        </a>
                        <a href="<?php echo SITE_URL; ?>/pages/services.php?category=company-profile"
                           class="btn <?php echo $category === 'company-profile' ? 'btn-gradient-gold' : 'btn-outline-gold'; ?>">
                            Company Profile
                        </a>
                        <a href="<?php echo SITE_URL; ?>/pages/services.php?category=ecommerce"
                           class="btn <?php echo $category === 'ecommerce' ? 'btn-gradient-gold' : 'btn-outline-gold'; ?>">
                            E-Commerce
                        </a>
                        <a href="<?php echo SITE_URL; ?>/pages/services.php?category=landing-page"
                           class="btn <?php echo $category === 'landing-page' ? 'btn-gradient-gold' : 'btn-outline-gold'; ?>">
                            Landing Page
                        </a>
                        <a href="<?php echo SITE_URL; ?>/pages/services.php?category=portfolio"
                           class="btn <?php echo $category === 'portfolio' ? 'btn-gradient-gold' : 'btn-outline-gold'; ?>">
                            Portfolio
                        </a>
                        <a href="<?php echo SITE_URL; ?>/pages/services.php?category=education"
                           class="btn <?php echo $category === 'education' ? 'btn-gradient-gold' : 'btn-outline-gold'; ?>">
                            Pendidikan
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Grid Section -->
    <section class="section">
        <div class="container">
            <div class="row g-4">
                <?php foreach ($filtered_services as $index => $service): ?>
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?php echo ($index % 3) * 100; ?>">
                        <div class="card h-100 service-card">
                            <div class="card-body">
                                <div class="card-icon mb-3">
                                    <i class="bi <?php echo $service['icon']; ?>"></i>
                                </div>
                                <h5 class="card-title"><?php echo htmlspecialchars($service['title']); ?></h5>
                                <p class="card-text text-muted mb-3">
                                    <?php echo htmlspecialchars($service['description']); ?>
                                </p>
                                <div class="mb-3">
                                    <span class="badge bg-light text-dark">
                                        <i class="bi bi-tag me-1"></i>
                                        <?php echo htmlspecialchars($service['price']); ?>
                                    </span>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-top">
                                <a href="<?php echo SITE_URL; ?>/pages/service-detail.php?id=<?php echo $service['id']; ?>"
                                   class="btn btn-outline-blue btn-sm w-100">
                                    <i class="bi bi-arrow-right me-1"></i> Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Pagination Placeholder -->
            <nav aria-label="Page navigation" class="mt-5">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#">Previous</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section section-dark">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-lg-8" data-aos="fade-up">
                    <h2 class="display-4 mb-4">
                        Tidak Menemukan Template Yang Tepat?
                    </h2>
                    <p class="lead mb-5">
                        Kami juga menyediakan layanan custom design sesuai dengan kebutuhan spesifik bisnis Anda.
                        Konsultasikan kebutuhan Anda kepada tim expert kami.
                    </p>
                    <a href="<?php echo SITE_URL; ?>/pages/contact.php" class="btn btn-gradient-gold btn-lg">
                        <i class="bi bi-chat-dots me-2"></i>
                        Konsultasi Gratis
                    </a>
                </div>
            </div>
        </div>
    </section>

</main>

<?php
// Include footer
include __DIR__ . '/../components/layout/footer.php';
?>
