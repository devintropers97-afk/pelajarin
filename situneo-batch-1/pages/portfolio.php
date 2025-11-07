<?php
/**
 * ========================================
 * SITUNEO DIGITAL - Portfolio Page
 * Portfolio Proyek - Showcase Website Terbaik
 * ========================================
 */

require_once dirname(__DIR__) . '/config/init.php';

// Page variables
$current_page = 'portfolio';
$page_title = 'Portfolio SITUNEO - Website Terbaik dari Klien Kami';
$page_description = 'Lihat portfolio website profesional yang telah kami buat untuk berbagai klien dari berbagai industri. Website berkualitas tinggi dengan desain modern dan responsive.';
$lang = $_GET['lang'] ?? 'id';

// Sample portfolio data
$portfolio_items = [
    ['id' => 1, 'title' => 'PT Maju Jaya Company Profile', 'category' => 'Website', 'image' => 'portfolio-1.jpg', 'url' => '#'],
    ['id' => 2, 'title' => 'Toko Fashion Online Store', 'category' => 'E-Commerce', 'image' => 'portfolio-2.jpg', 'url' => '#'],
    ['id' => 3, 'title' => 'Kursus Bahasa Landing Page', 'category' => 'Landing Page', 'image' => 'portfolio-3.jpg', 'url' => '#'],
    ['id' => 4, 'title' => 'Arsitek Portfolio Website', 'category' => 'Portfolio', 'image' => 'portfolio-4.jpg', 'url' => '#'],
    ['id' => 5, 'title' => 'Klinik Kesehatan Website', 'category' => 'Website', 'image' => 'portfolio-5.jpg', 'url' => '#'],
    ['id' => 6, 'title' => 'Restoran Fine Dining E-Commerce', 'category' => 'E-Commerce', 'image' => 'portfolio-6.jpg', 'url' => '#'],
    ['id' => 7, 'title' => 'Startup Tech Landing Page', 'category' => 'Landing Page', 'image' => 'portfolio-7.jpg', 'url' => '#'],
    ['id' => 8, 'title' => 'Sekolah Online E-Learning', 'category' => 'Website', 'image' => 'portfolio-8.jpg', 'url' => '#'],
];

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
                    <li class="breadcrumb-item active" aria-current="page">Portfolio</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content text-center">
                <p class="hero-subtitle">PORTFOLIO KAMI</p>
                <h1 class="hero-title">
                    Website <span class="text-gradient-gold">Berkualitas Tinggi</span><br>
                    untuk Klien Terpercaya
                </h1>
                <p class="hero-description">
                    Lihat contoh website profesional yang telah kami buat untuk berbagai klien
                    dari berbagai industri dan sektor bisnis.
                </p>
            </div>
        </div>
    </section>

    <!-- Filter Buttons Section -->
    <section class="section section-gray">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex flex-wrap gap-2 justify-content-center" data-aos="fade-up">
                        <button class="btn btn-gradient-gold active filter-btn" data-filter="all">
                            <i class="bi bi-grid-3x3 me-1"></i> Semua
                        </button>
                        <button class="btn btn-outline-gold filter-btn" data-filter="Website">
                            <i class="bi bi-globe me-1"></i> Website
                        </button>
                        <button class="btn btn-outline-gold filter-btn" data-filter="E-Commerce">
                            <i class="bi bi-cart me-1"></i> E-Commerce
                        </button>
                        <button class="btn btn-outline-gold filter-btn" data-filter="Landing Page">
                            <i class="bi bi-rocket me-1"></i> Landing Page
                        </button>
                        <button class="btn btn-outline-gold filter-btn" data-filter="Portfolio">
                            <i class="bi bi-briefcase me-1"></i> Portfolio
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Grid Section -->
    <section class="section">
        <div class="container">
            <div class="row g-4">
                <?php foreach ($portfolio_items as $index => $item): ?>
                    <div class="col-lg-6 col-md-6 portfolio-item" data-category="<?php echo htmlspecialchars($item['category']); ?>"
                         data-aos="fade-up" data-aos-delay="<?php echo ($index % 2) * 100; ?>">
                        <div class="portfolio-card">
                            <div class="portfolio-image position-relative overflow-hidden" style="height: 300px;">
                                <img src="<?php echo SITE_URL; ?>/assets/images/<?php echo htmlspecialchars($item['image']); ?>"
                                     alt="<?php echo htmlspecialchars($item['title']); ?>"
                                     class="w-100 h-100 object-fit-cover" onerror="this.src='<?php echo SITE_URL; ?>/assets/images/placeholder.jpg'">
                                <div class="portfolio-overlay">
                                    <div class="portfolio-info">
                                        <h5 class="portfolio-title"><?php echo htmlspecialchars($item['title']); ?></h5>
                                        <p class="portfolio-category"><?php echo htmlspecialchars($item['category']); ?></p>
                                        <div class="portfolio-actions mt-3">
                                            <a href="<?php echo htmlspecialchars($item['url']); ?>" class="btn btn-sm btn-light"
                                               target="_blank" rel="noopener noreferrer">
                                                <i class="bi bi-eye me-1"></i> Lihat Project
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="portfolio-footer">
                                <h5><?php echo htmlspecialchars($item['title']); ?></h5>
                                <p class="text-muted mb-0">
                                    <i class="bi bi-tag me-1"></i>
                                    <?php echo htmlspecialchars($item['category']); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Load More Button -->
            <div class="text-center mt-5" data-aos="fade-up">
                <button class="btn btn-outline-blue btn-lg">
                    <i class="bi bi-plus-circle me-2"></i>
                    Muat Project Lainnya
                </button>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="section section-gray">
        <div class="container">
            <div class="row g-4 text-center">
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="stat-box">
                        <h3 class="stat-number text-gradient-gold" data-count="450" data-suffix="+">0+</h3>
                        <p class="stat-label">Project Diselesaikan</p>
                    </div>
                </div>
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
                    <div class="stat-box">
                        <h3 class="stat-number text-gradient-blue" data-count="150" data-suffix="+">0+</h3>
                        <p class="stat-label">Klien Puas</p>
                    </div>
                </div>
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="300">
                    <div class="stat-box">
                        <h3 class="stat-number text-gradient-gold" data-count="4" data-suffix="">0</h3>
                        <p class="stat-label">Tahun Pengalaman</p>
                    </div>
                </div>
                <div class="col-md-3" data-aos="fade-up" data-aos-delay="400">
                    <div class="stat-box">
                        <h3 class="stat-number text-gradient-blue" data-count="98" data-suffix="%">0%</h3>
                        <p class="stat-label">Kepuasan Klien</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonial Section -->
    <section class="section">
        <div class="container">
            <div class="section-header">
                <p class="section-subtitle">TESTIMONI</p>
                <h2 class="section-title">Apa Kata Klien Kami</h2>
            </div>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="card testimonial-card">
                        <div class="card-body">
                            <div class="stars mb-3">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                            </div>
                            <p class="card-text">
                                "Website yang dibuat SITUNEO sangat profesional dan sesuai dengan kebutuhan bisnis kami.
                                Tim support mereka juga sangat responsif dan membantu."
                            </p>
                            <div class="testimonial-author mt-3">
                                <h6 class="mb-0">Budi Santoso</h6>
                                <small class="text-muted">CEO PT Maju Jaya</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="card testimonial-card">
                        <div class="card-body">
                            <div class="stars mb-3">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                            </div>
                            <p class="card-text">
                                "Harga sangat terjangkau untuk kualitas yang didapatkan. Proses pembuatan website juga
                                cepat dan hasilnya melampaui ekspektasi saya."
                            </p>
                            <div class="testimonial-author mt-3">
                                <h6 class="mb-0">Siti Nurhaliza</h6>
                                <small class="text-muted">Pemilik Toko Fashion Online</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="card testimonial-card">
                        <div class="card-body">
                            <div class="stars mb-3">
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                                <i class="bi bi-star-fill text-warning"></i>
                            </div>
                            <p class="card-text">
                                "Tim SITUNEO sangat profesional dan berpengalaman. Mereka memahami kebutuhan bisnis
                                saya dan memberikan solusi terbaik yang menguntungkan."
                            </p>
                            <div class="testimonial-author mt-3">
                                <h6 class="mb-0">Adi Pratama</h6>
                                <small class="text-muted">Direktur Klinik Kesehatan</small>
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
                        Ingin Website Seperti Ini?
                    </h2>
                    <p class="lead mb-5">
                        Hubungi kami sekarang untuk mendiskusikan kebutuhan website Anda
                        dan dapatkan penawaran terbaik.
                    </p>
                    <a href="<?php echo SITE_URL; ?>/pages/contact.php" class="btn btn-gradient-gold btn-lg">
                        <i class="bi bi-telephone me-2"></i>
                        Hubungi Kami Sekarang
                    </a>
                </div>
            </div>
        </div>
    </section>

</main>

<style>
.portfolio-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.portfolio-card:hover .portfolio-overlay {
    opacity: 1;
}

.portfolio-info {
    text-align: center;
    color: white;
}

.portfolio-item.hidden {
    display: none;
}
</style>

<script>
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        const filter = this.getAttribute('data-filter');

        // Update active button
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('btn-gradient-gold'));
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.add('btn-outline-gold'));
        this.classList.remove('btn-outline-gold');
        this.classList.add('btn-gradient-gold');

        // Filter items
        document.querySelectorAll('.portfolio-item').forEach(item => {
            if (filter === 'all' || item.getAttribute('data-category') === filter) {
                item.classList.remove('hidden');
            } else {
                item.classList.add('hidden');
            }
        });
    });
});
</script>

<?php
// Include footer
include __DIR__ . '/../components/layout/footer.php';
?>
