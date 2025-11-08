<?php
// Set page title
$pageTitle = 'SITUNEO DIGITAL - Sewa Website Profesional Mulai 150rb/Bulan | FREE DEMO 24 JAM';
$pageDescription = 'Sewa website profesional mulai Rp 150rb/bulan. FREE DEMO 24 JAM - Lihat dulu, bayar kalau cocok! NIB Resmi. 500+ client puas.';

// Include header
include __DIR__ . '/../includes/header.php';

// Multi-language text
$text = [
    'id' => [
        'hero_title' => 'Mau Bikin Website?',
        'hero_title_subtitle' => 'Bingung Mulai Dari Mana?',
        'hero_title_highlight' => 'Tenang... Kami Bantu Sampai Jadi!',
        'hero_subtitle' => 'Gak perlu ngerti teknologi. Ceritain aja bisnis Anda apa, kami kasih tau website yang cocok + berapa harganya.',
        'hero_desc' => 'Partner digital terpercaya sejak 2020. Sudah bantu 500+ bisnis dari berbagai industri. Sewa mulai 150rb/bulan atau beli putus!',
        'btn_pilih_bisnis' => 'PILIH BISNIS ANDA',
        'btn_demo' => 'COBA DEMO GRATIS',
        'btn_whatsapp' => 'CHAT ADMIN',
        'section_pilih_bisnis' => 'Pilih Bisnis Anda Di Bawah',
        'section_about' => 'Kenapa SITUNEO?',
        'section_services' => '232+ Layanan Digital Lengkap',
        'section_packages' => 'Paket Hemat Bundling',
        'section_portfolio' => 'Contoh Website Yang Udah Jadi',
        'section_testimonial' => 'Kata Customer Kami',
        'section_faq' => 'Pertanyaan Yang Sering Ditanya',
        'section_cta' => 'Siap Bikin Website Impian Anda?',
    ],
    'en' => [
        'hero_title' => 'Want To Build A Website?',
        'hero_title_subtitle' => 'Confused Where To Start?',
        'hero_title_highlight' => 'Relax... We Help Until It\'s Done!',
        'hero_subtitle' => 'No need to understand technology. Just tell us your business, we\'ll recommend the right website + pricing.',
        'hero_desc' => 'Trusted digital partner since 2020. Helped 500+ businesses from various industries. Rent from 150k/month or buy outright!',
        'btn_pilih_bisnis' => 'CHOOSE YOUR BUSINESS',
        'btn_demo' => 'TRY FREE DEMO',
        'btn_whatsapp' => 'CHAT ADMIN',
        'section_pilih_bisnis' => 'Choose Your Business Below',
        'section_about' => 'Why SITUNEO?',
        'section_services' => '232+ Complete Digital Services',
        'section_packages' => 'Bundle Packages',
        'section_portfolio' => 'Portfolio Showcase',
        'section_testimonial' => 'What Clients Say',
        'section_faq' => 'FAQ',
        'section_cta' => 'Ready to Build Your Dream Website?',
    ]
];

$t = $text[$lang];
?>

<!-- HERO SECTION -->
<section class="hero-section" id="home">
    <div class="container">
        <div class="hero-content" data-aos="fade-up">
            <div class="hero-badge">
                <i class="bi bi-patch-check-fill me-2"></i>
                NIB Resmi: <?= COMPANY_NIB ?>
            </div>

            <h1 class="hero-title">
                <?= $t['hero_title'] ?><br>
                <span style="font-size: 0.7em; opacity: 0.9;"><?= $t['hero_title_subtitle'] ?></span><br>
                <span class="highlight"><?= $t['hero_title_highlight'] ?></span>
            </h1>

            <p class="hero-description">
                <?= $t['hero_subtitle'] ?>
            </p>

            <p class="text-light" style="opacity: 0.8; margin-bottom: 40px;">
                <?= $t['hero_desc'] ?>
            </p>

            <div class="hero-buttons">
                <a href="/pages/pilih-bisnis" class="btn btn-gold btn-lg">
                    <i class="bi bi-grid-3x3 me-2"></i>
                    <?= $t['btn_pilih_bisnis'] ?>
                </a>
                <a href="/client/demo-request" class="btn btn-outline-gold btn-lg">
                    <i class="bi bi-rocket-takeoff me-2"></i>
                    <?= $t['btn_demo'] ?>
                </a>
                <a href="https://wa.me/<?= SITE_WHATSAPP ?>?text=Halo%20SITUNEO,%20saya%20mau%20konsultasi"
                   class="btn btn-outline-gold btn-lg" target="_blank">
                    <i class="bi bi-whatsapp me-2"></i>
                    <?= $t['btn_whatsapp'] ?>
                </a>
            </div>

            <!-- Trust Badges -->
            <div class="trust-badges">
                <div class="trust-badge">
                    <i class="bi bi-shield-check text-success" style="font-size: 1.5rem;"></i>
                    <span>NIB Resmi</span>
                </div>
                <div class="trust-badge">
                    <i class="bi bi-people text-gold" style="font-size: 1.5rem;"></i>
                    <span>500+ Clients</span>
                </div>
                <div class="trust-badge">
                    <i class="bi bi-headset text-info" style="font-size: 1.5rem;"></i>
                    <span>Support 24/7</span>
                </div>
                <div class="trust-badge">
                    <i class="bi bi-arrow-return-left text-warning" style="font-size: 1.5rem;"></i>
                    <span>Garansi 7 Hari</span>
                </div>
            </div>

            <div class="hero-stats">
                <div class="hero-stat-item" data-aos="fade-up" data-aos-delay="100">
                    <span class="hero-stat-number" data-count="500">500</span>
                    <span class="hero-stat-label">+ Clients</span>
                </div>
                <div class="hero-stat-item" data-aos="fade-up" data-aos-delay="200">
                    <span class="hero-stat-number" data-count="1200">1200</span>
                    <span class="hero-stat-label">+ Projects</span>
                </div>
                <div class="hero-stat-item" data-aos="fade-up" data-aos-delay="300">
                    <span class="hero-stat-number" data-count="98">98</span>
                    <span class="hero-stat-label">% Satisfaction</span>
                </div>
                <div class="hero-stat-item" data-aos="fade-up" data-aos-delay="400">
                    <span class="hero-stat-number" data-count="5">5</span>
                    <span class="hero-stat-label">+ Years Experience</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ABOUT SECTION -->
<section class="about-section" id="about">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up"><?= $t['section_about'] ?></h2>

        <p class="section-subtitle" data-aos="fade-up">
            Kami bukan asal bikin website. Kami bantu bisnis Anda tumbuh dengan solusi digital terpadu!
        </p>

        <div class="about-features">
            <div class="about-feature-item card-premium" data-aos="fade-up" data-aos-delay="100">
                <div class="about-feature-icon">
                    <i class="bi bi-shield-fill-check"></i>
                </div>
                <h4>NIB Resmi & Legal</h4>
                <p>Perusahaan terdaftar resmi dengan NIB, NPWP, dan legalitas lengkap</p>
            </div>

            <div class="about-feature-item card-premium" data-aos="fade-up" data-aos-delay="200">
                <div class="about-feature-icon">
                    <i class="bi bi-clock-history"></i>
                </div>
                <h4>FREE DEMO 24 Jam</h4>
                <p>Lihat hasil demo dulu sebelum bayar. Puas baru lanjut!</p>
            </div>

            <div class="about-feature-item card-premium" data-aos="fade-up" data-aos-delay="300">
                <div class="about-feature-icon">
                    <i class="bi bi-currency-dollar"></i>
                </div>
                <h4>Harga Terjangkau</h4>
                <p>Sewa mulai Rp 150rb/bulan. Bisa juga beli putus, paket bundling lebih hemat!</p>
            </div>

            <div class="about-feature-item card-premium" data-aos="fade-up" data-aos-delay="400">
                <div class="about-feature-icon">
                    <i class="bi bi-headset"></i>
                </div>
                <h4>Support 24/7</h4>
                <p>WhatsApp support nonstop. Masalah langsung dibantu!</p>
            </div>

            <div class="about-feature-item card-premium" data-aos="fade-up" data-aos-delay="500">
                <div class="about-feature-icon">
                    <i class="bi bi-star-fill"></i>
                </div>
                <h4>500+ Client Puas</h4>
                <p>Rating 4.9/5.0 dari ratusan client di seluruh Indonesia</p>
            </div>

            <div class="about-feature-item card-premium" data-aos="fade-up" data-aos-delay="600">
                <div class="about-feature-icon">
                    <i class="bi bi-rocket-takeoff-fill"></i>
                </div>
                <h4>Technology Terkini</h4>
                <p>AI, chatbot, SEO, payment gateway - semua ada!</p>
            </div>
        </div>
    </div>
</section>

<!-- SERVICES SECTION -->
<section id="services">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up"><?= $t['section_services'] ?></h2>

        <p class="section-subtitle" data-aos="fade-up">
            Dari website sampai digital marketing, semua ada di sini!
        </p>

        <div class="services-grid">
            <?php
            $featured_services = [
                ['icon' => 'globe', 'name' => 'Jasa Website', 'price' => 350000, 'desc' => 'Website profesional responsive, cepat loading, dan SEO friendly'],
                ['icon' => 'cart', 'name' => 'Toko Online', 'price' => 2000000, 'desc' => 'E-commerce lengkap dengan cart, payment gateway, dan admin'],
                ['icon' => 'search', 'name' => 'SEO & Google Ranking', 'price' => 1000000, 'desc' => 'Optimasi website biar nongol di halaman 1 Google'],
                ['icon' => 'megaphone', 'name' => 'Google Ads & Meta Ads', 'price' => 350000, 'desc' => 'Iklan digital di Google, Facebook, Instagram'],
                ['icon' => 'robot', 'name' => 'Chatbot AI WhatsApp', 'price' => 200000, 'desc' => 'Robot pintar yang bales chat otomatis 24/7'],
                ['icon' => 'palette', 'name' => 'Branding & Desain', 'price' => 500000, 'desc' => 'Logo, banner, brosur, dan semua kebutuhan desain'],
                ['icon' => 'bar-chart', 'name' => 'Digital Marketing', 'price' => 800000, 'desc' => 'Social media, content creation, email marketing'],
                ['icon' => 'speedometer', 'name' => 'Dashboard Analytics', 'price' => 1500000, 'desc' => 'Dashboard canggih untuk pantau bisnis real-time'],
            ];

            $delay = 100;
            foreach ($featured_services as $service):
            ?>
            <div class="card-premium service-card" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
                <div class="service-card-icon">
                    <i class="bi bi-<?= $service['icon'] ?>"></i>
                </div>
                <h3><?= $service['name'] ?></h3>
                <p class="text-light"><?= $service['desc'] ?></p>
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <div class="text-gold fw-bold">Mulai <?= formatRupiah($service['price']) ?></div>
                    <a href="/services#<?= slugify($service['name']) ?>" class="btn btn-sm btn-outline-gold">
                        Detail <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                </div>
            </div>
            <?php
            $delay += 100;
            endforeach;
            ?>
        </div>

        <div class="text-center mt-5" data-aos="fade-up">
            <a href="/services" class="btn btn-gold btn-lg">
                Lihat Semua 232+ Layanan <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- PACKAGES SECTION -->
<section id="packages" class="about-section">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up"><?= $t['section_packages'] ?></h2>

        <p class="section-subtitle" data-aos="fade-up">
            Hemat hingga 50%! Pilih paket yang sesuai kebutuhan bisnis Anda
        </p>

        <div class="pricing-table">
            <?php
            $packages = [
                [
                    'name' => 'STARTER',
                    'tagline' => 'Buat UMKM & Bisnis Kecil',
                    'price_original' => 3500000,
                    'price_promo' => 2500000,
                    'popular' => false,
                    'features' => [
                        'Website 5 halaman',
                        'Domain .com gratis 1 tahun',
                        'Hosting 1 tahun',
                        'SSL (website aman)',
                        'Desain logo GRATIS',
                        '5 artikel SEO',
                        'Support 1 bulan',
                        'Responsive mobile',
                        'SEO dasar'
                    ]
                ],
                [
                    'name' => 'BUSINESS',
                    'tagline' => 'PALING LAKU!',
                    'price_original' => 6000000,
                    'price_promo' => 4000000,
                    'popular' => true,
                    'features' => [
                        'Website 8 halaman',
                        'SEO canggih',
                        'Siap toko online',
                        'Payment gateway',
                        'Domain gratis 2 tahun',
                        'Hosting 2 tahun',
                        'Logo + brosur GRATIS',
                        '10 artikel SEO',
                        'Support 3 bulan',
                        'Dashboard admin',
                        'Live chat'
                    ]
                ],
                [
                    'name' => 'PREMIUM',
                    'tagline' => 'Fitur Lengkap Seperti Perusahaan Besar',
                    'price_original' => 10000000,
                    'price_promo' => 6500000,
                    'popular' => false,
                    'features' => [
                        'Website 10 halaman',
                        'SEO full (dijamin ranking)',
                        '2 bahasa (ID + EN)',
                        'Dashboard super canggih',
                        'Domain gratis 3 tahun',
                        'Hosting 3 tahun',
                        'Semua design GRATIS',
                        '20 artikel SEO',
                        'Support 6 bulan',
                        'Google Ads setup',
                        'WhatsApp Business API',
                        'Email marketing'
                    ]
                ]
            ];

            $delay = 100;
            foreach ($packages as $pkg):
            $discount = round((($pkg['price_original'] - $pkg['price_promo']) / $pkg['price_original']) * 100);
            ?>
            <div class="card-premium pricing-card <?= $pkg['popular'] ? 'pricing-popular' : '' ?>"
                 data-aos="fade-up" data-aos-delay="<?= $delay ?>">

                <?php if ($pkg['popular']): ?>
                <div class="badge badge-popular position-absolute top-0 end-0 m-3">
                    <i class="bi bi-star-fill me-1"></i> TERLARIS
                </div>
                <?php endif; ?>

                <h3 class="text-gold"><?= $pkg['name'] ?></h3>
                <p class="text-light"><?= $pkg['tagline'] ?></p>

                <div class="my-4">
                    <div class="price-original"><?= formatRupiah($pkg['price_original']) ?></div>
                    <div class="price-promo"><?= formatRupiah($pkg['price_promo']) ?></div>
                    <div class="badge badge-gold mt-2">Hemat <?= $discount ?>%</div>
                </div>

                <ul>
                    <?php foreach ($pkg['features'] as $feature): ?>
                    <li>
                        <i class="bi bi-check-circle-fill"></i>
                        <?= $feature ?>
                    </li>
                    <?php endforeach; ?>
                </ul>

                <a href="/pricing" class="btn btn-gold w-100">
                    Pilih Paket Ini <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
            <?php
            $delay += 100;
            endforeach;
            ?>
        </div>

        <div class="text-center mt-5" data-aos="fade-up">
            <a href="/pricing" class="btn btn-outline-gold btn-lg">
                Lihat Semua Paket <i class="bi bi-arrow-right ms-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- CTA SECTION -->
<section id="cta">
    <div class="container text-center">
        <h2 class="section-title" data-aos="fade-up"><?= $t['section_cta'] ?></h2>

        <p class="section-subtitle" data-aos="fade-up">
            Konsultasi GRATIS, dapatkan demo dalam 24 jam!
        </p>

        <div class="hero-buttons" data-aos="fade-up">
            <a href="/client/demo-request" class="btn btn-gold btn-lg">
                <i class="bi bi-rocket-takeoff me-2"></i>
                Request Demo Gratis
            </a>
            <a href="/calculator" class="btn btn-outline-gold btn-lg">
                <i class="bi bi-calculator me-2"></i>
                Hitung Estimasi Harga
            </a>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
