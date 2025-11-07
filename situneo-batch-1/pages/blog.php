<?php
/**
 * ========================================
 * SITUNEO DIGITAL - Blog Page
 * Blog - Blog Listing & Articles
 * ========================================
 */

require_once dirname(__DIR__) . '/config/init.php';

// Page variables
$current_page = 'blog';
$page_title = 'Blog SITUNEO - Tips, Tren, dan Tutorial Website';
$page_description = 'Baca artikel terbaru SITUNEO tentang web design, digital marketing, e-commerce tips, dan tutorial pembuatan website. Update rutin setiap minggu.';
$lang = $_GET['lang'] ?? 'id';

// Sample blog data
$blog_posts = [
    [
        'id' => 1,
        'title' => 'Tren Web Design 2024: Apa Yang Sedang Hot?',
        'excerpt' => 'Pelajari tren web design terbaru tahun 2024 yang sedang populer di kalangan desainer profesional...',
        'category' => 'Design',
        'author' => 'Budi Santoso',
        'date' => '7 November 2024',
        'image' => 'blog-1.jpg'
    ],
    [
        'id' => 2,
        'title' => '10 Tips SEO untuk Meningkatkan Ranking Website Anda',
        'excerpt' => 'Strategi SEO praktis yang terbukti meningkatkan ranking website di Google search result...',
        'category' => 'SEO',
        'author' => 'Siti Nurhaliza',
        'date' => '5 November 2024',
        'image' => 'blog-2.jpg'
    ],
    [
        'id' => 3,
        'title' => 'Panduan Lengkap E-Commerce Setup dengan SITUNEO',
        'excerpt' => 'Step-by-step tutorial membuat toko online profesional menggunakan platform SITUNEO...',
        'category' => 'Tutorial',
        'author' => 'Adi Pratama',
        'date' => '3 November 2024',
        'image' => 'blog-3.jpg'
    ],
    [
        'id' => 4,
        'title' => 'Keamanan Website: Best Practices Melindungi Data Pelanggan',
        'excerpt' => 'Panduan keamanan website yang essential untuk melindungi data dan privasi pelanggan Anda...',
        'category' => 'Security',
        'author' => 'Dewi Lestari',
        'date' => '1 November 2024',
        'image' => 'blog-4.jpg'
    ],
    [
        'id' => 5,
        'title' => 'Mobile-First Design: Mengapa Penting untuk Bisnis Anda',
        'excerpt' => 'Mengapa responsive design dan mobile-first approach adalah kunci kesuksesan website modern...',
        'category' => 'Design',
        'author' => 'Budi Santoso',
        'date' => '30 Oktober 2024',
        'image' => 'blog-5.jpg'
    ],
    [
        'id' => 6,
        'title' => 'Meningkatkan Konversi dengan CTA yang Efektif',
        'excerpt' => 'Teknik membuat Call-to-Action yang menarik dan meningkatkan konversi pengunjung...',
        'category' => 'Marketing',
        'author' => 'Siti Nurhaliza',
        'date' => '28 Oktober 2024',
        'image' => 'blog-6.jpg'
    ],
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
                    <li class="breadcrumb-item active" aria-current="page">Blog</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content text-center">
                <p class="hero-subtitle">BLOG SITUNEO</p>
                <h1 class="hero-title">
                    Tips, Tren, dan<br>
                    <span class="text-gradient-gold">Tutorial</span> Website
                </h1>
                <p class="hero-description">
                    Baca artikel terbaru tentang web design, digital marketing, e-commerce,
                    dan tips membuat website profesional. Update setiap minggu!
                </p>
            </div>
        </div>
    </section>

    <!-- Blog Section -->
    <section class="section section-gray">
        <div class="container">
            <div class="row g-4">
                <!-- Main Blog Posts -->
                <div class="col-lg-8">
                    <!-- Search & Filter -->
                    <div class="mb-5" data-aos="fade-up">
                        <div class="input-group input-group-lg mb-4">
                            <input type="text" class="form-control" placeholder="Cari artikel..."
                                   id="blogSearch">
                            <button class="btn btn-gradient-gold" type="button">
                                <i class="bi bi-search me-1"></i> Cari
                            </button>
                        </div>

                        <!-- Category Filter -->
                        <div class="d-flex flex-wrap gap-2">
                            <a href="#" class="btn btn-sm btn-gradient-gold">Semua</a>
                            <a href="#" class="btn btn-sm btn-outline-gold">Design</a>
                            <a href="#" class="btn btn-sm btn-outline-gold">SEO</a>
                            <a href="#" class="btn btn-sm btn-outline-gold">Marketing</a>
                            <a href="#" class="btn btn-sm btn-outline-gold">Tutorial</a>
                            <a href="#" class="btn btn-sm btn-outline-gold">Security</a>
                        </div>
                    </div>

                    <!-- Blog Posts Grid -->
                    <div class="row g-4">
                        <?php foreach ($blog_posts as $index => $post): ?>
                            <div class="col-md-6" data-aos="fade-up" data-aos-delay="<?php echo ($index % 2) * 100; ?>">
                                <article class="card blog-card h-100">
                                    <!-- Blog Image -->
                                    <div class="blog-image position-relative overflow-hidden" style="height: 200px;">
                                        <img src="<?php echo SITE_URL; ?>/assets/images/<?php echo htmlspecialchars($post['image']); ?>"
                                             alt="<?php echo htmlspecialchars($post['title']); ?>"
                                             class="w-100 h-100 object-fit-cover"
                                             onerror="this.src='<?php echo SITE_URL; ?>/assets/images/placeholder.jpg'">
                                        <span class="badge bg-gradient-gold position-absolute top-0 end-0 m-3">
                                            <?php echo htmlspecialchars($post['category']); ?>
                                        </span>
                                    </div>

                                    <div class="card-body d-flex flex-column">
                                        <!-- Meta Information -->
                                        <div class="blog-meta mb-2">
                                            <small class="text-muted">
                                                <i class="bi bi-calendar me-1"></i>
                                                <?php echo htmlspecialchars($post['date']); ?>
                                                <span class="mx-2">•</span>
                                                <i class="bi bi-person me-1"></i>
                                                <?php echo htmlspecialchars($post['author']); ?>
                                            </small>
                                        </div>

                                        <!-- Title -->
                                        <h5 class="card-title">
                                            <a href="<?php echo SITE_URL; ?>/pages/blog-detail.php?id=<?php echo $post['id']; ?>"
                                               class="text-decoration-none text-dark">
                                                <?php echo htmlspecialchars($post['title']); ?>
                                            </a>
                                        </h5>

                                        <!-- Excerpt -->
                                        <p class="card-text text-muted flex-grow-1">
                                            <?php echo htmlspecialchars($post['excerpt']); ?>
                                        </p>

                                        <!-- Read More Button -->
                                        <a href="<?php echo SITE_URL; ?>/pages/blog-detail.php?id=<?php echo $post['id']; ?>"
                                           class="btn btn-outline-blue btn-sm align-self-start">
                                            <i class="bi bi-arrow-right me-1"></i> Baca Selengkapnya
                                        </a>
                                    </div>
                                </article>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Pagination -->
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

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <!-- Featured Post -->
                    <div class="card mb-4" data-aos="fade-left">
                        <div class="card-header bg-gradient-gold text-white">
                            <h5 class="mb-0">
                                <i class="bi bi-star-fill me-2"></i>
                                Artikel Unggulan
                            </h5>
                        </div>
                        <div class="card-body">
                            <img src="<?php echo SITE_URL; ?>/assets/images/blog-featured.jpg"
                                 alt="Featured Article"
                                 class="img-fluid rounded mb-3"
                                 onerror="this.src='<?php echo SITE_URL; ?>/assets/images/placeholder.jpg'">
                            <h6><?php echo htmlspecialchars($blog_posts[0]['title']); ?></h6>
                            <p class="small text-muted mb-3">
                                Artikel paling banyak dibaca minggu ini. Jangan lewatkan!
                            </p>
                            <a href="#" class="btn btn-sm btn-gradient-gold">
                                Baca Artikel <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>

                    <!-- Categories Sidebar -->
                    <div class="card mb-4" data-aos="fade-left" data-aos-delay="100">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">
                                <i class="bi bi-folder me-2"></i>
                                Kategori
                            </h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled">
                                <li class="mb-2"><a href="#" class="text-decoration-none">Design <span class="badge bg-light text-dark float-end">5</span></a></li>
                                <li class="mb-2"><a href="#" class="text-decoration-none">SEO <span class="badge bg-light text-dark float-end">4</span></a></li>
                                <li class="mb-2"><a href="#" class="text-decoration-none">Marketing <span class="badge bg-light text-dark float-end">3</span></a></li>
                                <li class="mb-2"><a href="#" class="text-decoration-none">Tutorial <span class="badge bg-light text-dark float-end">6</span></a></li>
                                <li class="mb-2"><a href="#" class="text-decoration-none">Security <span class="badge bg-light text-dark float-end">2</span></a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Subscribe Sidebar -->
                    <div class="card mb-4" data-aos="fade-left" data-aos-delay="200">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0">
                                <i class="bi bi-envelope-heart me-2"></i>
                                Subscribe
                            </h5>
                        </div>
                        <div class="card-body">
                            <p class="small mb-3">Dapatkan notifikasi artikel terbaru langsung ke email Anda.</p>
                            <form id="blogSubscribe">
                                <div class="mb-2">
                                    <input type="email" class="form-control form-control-sm" placeholder="Email Anda"
                                           required>
                                </div>
                                <button type="submit" class="btn btn-success btn-sm w-100">
                                    <i class="bi bi-send me-1"></i> Subscribe
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Popular Tags -->
                    <div class="card" data-aos="fade-left" data-aos-delay="300">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0">
                                <i class="bi bi-tags me-2"></i>
                                Tag Populer
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex flex-wrap gap-2">
                                <a href="#" class="btn btn-sm btn-outline-secondary">website</a>
                                <a href="#" class="btn btn-sm btn-outline-secondary">design</a>
                                <a href="#" class="btn btn-sm btn-outline-secondary">ecommerce</a>
                                <a href="#" class="btn btn-sm btn-outline-secondary">seo</a>
                                <a href="#" class="btn btn-sm btn-outline-secondary">marketing</a>
                                <a href="#" class="btn btn-sm btn-outline-secondary">digital</a>
                                <a href="#" class="btn btn-sm btn-outline-secondary">tutorial</a>
                                <a href="#" class="btn btn-sm btn-outline-secondary">mobile</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter CTA Section -->
    <section class="section section-dark">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6" data-aos="zoom-in">
                    <div class="text-center">
                        <h2 class="display-5 mb-3">
                            <i class="bi bi-envelope-open-heart me-2"></i>
                            Dapatkan Tips & Tren Terbaru
                        </h2>
                        <p class="lead mb-4">
                            Subscribe newsletter kami untuk mendapatkan artikel, tips, dan promo eksklusif setiap minggu.
                        </p>
                        <form class="input-group input-group-lg">
                            <input type="email" class="form-control" placeholder="Masukkan email Anda..."
                                   required>
                            <button class="btn btn-gradient-gold" type="submit">
                                <i class="bi bi-send me-1"></i> Subscribe
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<style>
.blog-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.blog-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
}

.blog-image {
    position: relative;
}

.bg-gradient-gold {
    background: linear-gradient(135deg, var(--color-secondary), var(--color-secondary));
}
</style>

<script>
document.getElementById('blogSubscribe').addEventListener('submit', function(e) {
    e.preventDefault();
    alert('Terima kasih telah subscribe! Kami akan mengirim artikel terbaru ke email Anda.');
});
</script>

<?php
// Include footer
include __DIR__ . '/../components/layout/footer.php';
?>
