<?php
/**
 * ========================================
 * SITUNEO DIGITAL - About Us Page
 * Tentang Kami - SITUNEO Philosophy & Team
 * ========================================
 */

require_once dirname(__DIR__) . '/config/init.php';

// Page variables
$current_page = 'about';
$page_title = 'Tentang SITUNEO - Website Era Baru untuk Bisnis Digital';
$page_description = 'Pelajari lebih lanjut tentang SITUNEO Digital, misi kami, visi kami, nilai-nilai kami, dan tim profesional yang siap membantu bisnis Anda berkembang.';
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
                    <li class="breadcrumb-item active" aria-current="page">Tentang Kami</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content text-center">
                <p class="hero-subtitle">TENTANG SITUNEO</p>
                <h1 class="hero-title">
                    Website Era Baru<br>
                    untuk Bisnis <span class="text-gradient-gold">Digital</span> Anda
                </h1>
                <p class="hero-description">
                    SITUNEO adalah platform inovatif yang menghadirkan solusi website profesional
                    dengan harga terjangkau dan kualitas tinggi. Kami percaya bahwa setiap bisnis
                    berhak memiliki kehadiran digital yang kuat.
                </p>
            </div>
        </div>
    </section>

    <!-- SITUNEO Philosophy Section -->
    <section class="section section-gray">
        <div class="container">
            <div class="section-header">
                <p class="section-subtitle">FILOSOFI KAMI</p>
                <h2 class="section-title">Makna di Balik SITUNEO</h2>
                <p class="section-description">
                    Nama SITUNEO memiliki makna mendalam yang mencerminkan visi dan misi kami
                </p>
            </div>

            <div class="row g-4 align-items-center">
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="card">
                        <div class="card-body p-4">
                            <h3 class="card-title mb-3">
                                <span class="text-gradient-blue">SITU</span> - Situasi Digital
                            </h3>
                            <p class="card-text mb-3">
                                SITU mewakili "Situasi" - mencerminkan kebutuhan bisnis akan solusi website
                                yang sesuai dengan situasi pasar digital Indonesia saat ini. Kami memahami
                                tantangan unik yang dihadapi bisnis lokal.
                            </p>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Disesuaikan dengan pasar Indonesia</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Memahami kebutuhan bisnis lokal</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Solusi praktis dan efisien</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6" data-aos="fade-left">
                    <div class="card">
                        <div class="card-body p-4">
                            <h3 class="card-title mb-3">
                                <span class="text-gradient-gold">NEO</span> - Neomodernisme Digital
                            </h3>
                            <p class="card-text mb-3">
                                NEO mewakili "Neomodernisme" - inovasi terkini dengan sentuhan modern.
                                Kami menggunakan teknologi terbaru sambil tetap menjaga kesederhanaan
                                dan kemudahan penggunaan.
                            </p>
                            <ul class="list-unstyled">
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Teknologi terkini & modern</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>Inovasi berkelanjutan</li>
                                <li class="mb-2"><i class="bi bi-check-circle-fill text-success me-2"></i>User-friendly design</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission, Vision, Values Section -->
    <section class="section">
        <div class="container">
            <div class="section-header">
                <p class="section-subtitle">FONDASI KAMI</p>
                <h2 class="section-title">Misi, Visi & Nilai-Nilai</h2>
            </div>

            <div class="row g-4">
                <!-- Mission -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="card h-100">
                        <div class="card-icon">
                            <i class="bi bi-target"></i>
                        </div>
                        <h3 class="card-title">Misi Kami</h3>
                        <p class="card-text">
                            Memberikan solusi website profesional yang terjangkau dan mudah digunakan,
                            sehingga setiap bisnis dari semua ukuran dapat memiliki kehadiran digital
                            yang kuat dan efektif.
                        </p>
                    </div>
                </div>

                <!-- Vision -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="card h-100">
                        <div class="card-icon">
                            <i class="bi bi-eye"></i>
                        </div>
                        <h3 class="card-title">Visi Kami</h3>
                        <p class="card-text">
                            Menjadi platform website terdepan di Indonesia yang dipercaya oleh ribuan
                            bisnis untuk mengakselerasi transformasi digital mereka dan mencapai
                            kesuksesan di era modern ini.
                        </p>
                    </div>
                </div>

                <!-- Values -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="card h-100">
                        <div class="card-icon">
                            <i class="bi bi-heart"></i>
                        </div>
                        <h3 class="card-title">Nilai-Nilai Kami</h3>
                        <p class="card-text">
                            Integritas, Inovasi, Kepercayaan, dan Komitmen adalah fondasi dari setiap
                            keputusan dan tindakan kami. Kami memprioritaskan kepuasan klien di atas
                            segalanya.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Us Section -->
    <section class="section section-gray">
        <div class="container">
            <div class="section-header">
                <p class="section-subtitle">KEUNGGULAN KAMI</p>
                <h2 class="section-title">Kenapa Memilih SITUNEO?</h2>
                <p class="section-description">
                    Kami memberikan lebih dari sekadar website - kami memberikan solusi bisnis yang komprehensif
                </p>
            </div>

            <div class="row g-4">
                <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="d-flex gap-3">
                        <div class="flex-shrink-0">
                            <i class="bi bi-check-circle-fill text-success" style="font-size: 1.5rem;"></i>
                        </div>
                        <div>
                            <h5>Harga Terjangkau</h5>
                            <p class="text-muted">Paket beli putus Rp 350K atau sewa Rp 150K/bulan tanpa biaya tersembunyi.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="d-flex gap-3">
                        <div class="flex-shrink-0">
                            <i class="bi bi-check-circle-fill text-success" style="font-size: 1.5rem;"></i>
                        </div>
                        <div>
                            <h5>1500+ Template</h5>
                            <p class="text-muted">Pilihan template premium untuk berbagai jenis bisnis dan industri.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="d-flex gap-3">
                        <div class="flex-shrink-0">
                            <i class="bi bi-check-circle-fill text-success" style="font-size: 1.5rem;"></i>
                        </div>
                        <div>
                            <h5>Support 24/7</h5>
                            <p class="text-muted">Tim support profesional siap membantu Anda kapan saja via berbagai channel.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="d-flex gap-3">
                        <div class="flex-shrink-0">
                            <i class="bi bi-check-circle-fill text-success" style="font-size: 1.5rem;"></i>
                        </div>
                        <div>
                            <h5>Teknologi Terbaru</h5>
                            <p class="text-muted">Menggunakan framework dan tools terkini untuk performa optimal.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="d-flex gap-3">
                        <div class="flex-shrink-0">
                            <i class="bi bi-check-circle-fill text-success" style="font-size: 1.5rem;"></i>
                        </div>
                        <div>
                            <h5>SEO Friendly</h5>
                            <p class="text-muted">Built-in SEO tools untuk meningkatkan visibilitas di search engine.</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6" data-aos="fade-up" data-aos-delay="600">
                    <div class="d-flex gap-3">
                        <div class="flex-shrink-0">
                            <i class="bi bi-check-circle-fill text-success" style="font-size: 1.5rem;"></i>
                        </div>
                        <div>
                            <h5>Keamanan Tinggi</h5>
                            <p class="text-muted">SSL certificate gratis, firewall protection, dan automatic security updates.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="section">
        <div class="container">
            <div class="section-header">
                <p class="section-subtitle">TIM KAMI</p>
                <h2 class="section-title">Profesional Berpengalaman</h2>
                <p class="section-description">
                    Tim ahli yang siap membantu bisnis Anda berkembang di era digital
                </p>
            </div>

            <div class="row g-4">
                <!-- Team Member 1 -->
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="card text-center">
                        <div class="card-img-wrapper position-relative overflow-hidden" style="height: 250px;">
                            <img src="<?php echo SITE_URL; ?>/assets/images/team-1.jpg" alt="Founder" class="w-100 h-100 object-fit-cover">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Adi Pratama</h5>
                            <p class="text-muted mb-3">Founder & CEO</p>
                            <p class="card-text small">
                                Entrepreneur berpengalaman dengan 10+ tahun di industri digital dan web development.
                            </p>
                            <div class="social-links mt-3">
                                <a href="#" class="social-link me-2" title="LinkedIn"><i class="bi bi-linkedin"></i></a>
                                <a href="#" class="social-link me-2" title="Twitter"><i class="bi bi-twitter"></i></a>
                                <a href="#" class="social-link" title="Email"><i class="bi bi-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Team Member 2 -->
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="card text-center">
                        <div class="card-img-wrapper position-relative overflow-hidden" style="height: 250px;">
                            <img src="<?php echo SITE_URL; ?>/assets/images/team-2.jpg" alt="CTO" class="w-100 h-100 object-fit-cover">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Siti Nurhaliza</h5>
                            <p class="text-muted mb-3">Chief Technology Officer</p>
                            <p class="card-text small">
                                Expert dalam web development dan cloud infrastructure dengan sertifikasi internasional.
                            </p>
                            <div class="social-links mt-3">
                                <a href="#" class="social-link me-2" title="LinkedIn"><i class="bi bi-linkedin"></i></a>
                                <a href="#" class="social-link me-2" title="Twitter"><i class="bi bi-twitter"></i></a>
                                <a href="#" class="social-link" title="Email"><i class="bi bi-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Team Member 3 -->
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="card text-center">
                        <div class="card-img-wrapper position-relative overflow-hidden" style="height: 250px;">
                            <img src="<?php echo SITE_URL; ?>/assets/images/team-3.jpg" alt="Design Lead" class="w-100 h-100 object-fit-cover">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Budi Santoso</h5>
                            <p class="text-muted mb-3">Design Lead</p>
                            <p class="card-text small">
                                UI/UX designer profesional dengan portfolio klien dari berbagai industri domestik dan internasional.
                            </p>
                            <div class="social-links mt-3">
                                <a href="#" class="social-link me-2" title="LinkedIn"><i class="bi bi-linkedin"></i></a>
                                <a href="#" class="social-link me-2" title="Twitter"><i class="bi bi-twitter"></i></a>
                                <a href="#" class="social-link" title="Email"><i class="bi bi-envelope"></i></a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Team Member 4 -->
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="card text-center">
                        <div class="card-img-wrapper position-relative overflow-hidden" style="height: 250px;">
                            <img src="<?php echo SITE_URL; ?>/assets/images/team-4.jpg" alt="Support Manager" class="w-100 h-100 object-fit-cover">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">Dewi Lestari</h5>
                            <p class="text-muted mb-3">Customer Support Manager</p>
                            <p class="card-text small">
                                Spesialis customer service dengan track record excellent dalam kepuasan pelanggan dan problem solving.
                            </p>
                            <div class="social-links mt-3">
                                <a href="#" class="social-link me-2" title="LinkedIn"><i class="bi bi-linkedin"></i></a>
                                <a href="#" class="social-link me-2" title="Twitter"><i class="bi bi-twitter"></i></a>
                                <a href="#" class="social-link" title="Email"><i class="bi bi-envelope"></i></a>
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
                        Mari Berkolaborasi Bersama SITUNEO
                    </h2>
                    <p class="lead mb-5">
                        Hubungi tim kami hari ini untuk konsultasi gratis tentang kebutuhan website bisnis Anda.
                    </p>
                    <div class="d-flex gap-3 justify-content-center flex-wrap">
                        <a href="<?php echo SITE_URL; ?>/pages/contact.php" class="btn btn-gradient-gold btn-lg">
                            <i class="bi bi-envelope me-2"></i>
                            Hubungi Kami
                        </a>
                        <a href="<?php echo SITE_URL; ?>/pages/services.php" class="btn btn-outline-gold btn-lg">
                            <i class="bi bi-grid-3x3-gap me-2"></i>
                            Lihat Layanan
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
