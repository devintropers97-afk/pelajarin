<?php
// Set page title
$pageTitle = 'Harga Paket Website & Digital Marketing | Hemat Hingga 50% | SITUNEO';
$pageDescription = 'Paket website lengkap mulai Rp 2.5 juta. Hemat hingga 50% dengan paket bundling! Domain, hosting, design GRATIS. FREE DEMO 24 JAM.';

// Include header
include __DIR__ . '/../includes/header.php';

// Multi-language text
$text = [
    'id' => [
        'hero_title' => 'Paket Hemat Bundling',
        'hero_subtitle' => 'Hemat Hingga 50%! Pilih Paket Sesuai Kebutuhan Bisnis',
        'save' => 'Hemat',
        'original_price' => 'Harga Normal',
        'promo_price' => 'Harga Promo',
        'btn_choose' => 'Pilih Paket Ini',
        'btn_compare' => 'Bandingkan Semua Paket',
        'section_packages' => 'Semua Paket Kami',
        'section_compare' => 'Perbandingan Paket',
        'section_custom' => 'Atau Buat Paket Custom Anda',
        'section_guarantee' => 'Jaminan Kami',
    ],
    'en' => [
        'hero_title' => 'Bundle Packages',
        'hero_subtitle' => 'Save Up to 50%! Choose Package for Your Business',
        'save' => 'Save',
        'original_price' => 'Original Price',
        'promo_price' => 'Promo Price',
        'btn_choose' => 'Choose This Package',
        'btn_compare' => 'Compare All Packages',
        'section_packages' => 'All Our Packages',
        'section_compare' => 'Package Comparison',
        'section_custom' => 'Or Create Your Custom Package',
        'section_guarantee' => 'Our Guarantee',
    ]
];

$t = $text[$lang];

// All packages data
$packages = [
    [
        'name' => 'STARTER',
        'tagline' => 'Perfect untuk UMKM & Bisnis Kecil',
        'price_original' => 3500000,
        'price_promo' => 2500000,
        'popular' => false,
        'color' => 'primary',
        'features' => [
            'Website 5 halaman responsive',
            'Domain .com/.id GRATIS 1 tahun',
            'Hosting 5GB (1 tahun)',
            'SSL Certificate (website aman)',
            'Desain logo simple GRATIS',
            '5 artikel SEO friendly',
            'Google My Business setup',
            'Support WhatsApp 1 bulan',
            'Responsive mobile & tablet',
            'SEO dasar (meta tags)',
            'Form kontak & Google Maps',
            '2x revisi design',
        ],
        'not_included' => [
            'Toko online / E-commerce',
            'Payment gateway',
            'Member area',
            'Live chat widget',
        ]
    ],
    [
        'name' => 'BUSINESS',
        'tagline' => '🔥 PALING LARIS! Cocok untuk Bisnis Berkembang',
        'price_original' => 6000000,
        'price_promo' => 4000000,
        'popular' => true,
        'color' => 'gold',
        'features' => [
            'Website 8-10 halaman',
            'Domain GRATIS 2 tahun',
            'Hosting 10GB (2 tahun)',
            'SSL Premium',
            'Logo + Brosur + Banner GRATIS',
            '10 artikel SEO optimized',
            'SEO advanced (on-page)',
            'Google Analytics & Search Console',
            'Toko online basic (opsional)',
            'Payment gateway (1 channel)',
            'Support WhatsApp 3 bulan',
            'Dashboard admin',
            'Live chat widget',
            'Email profesional (5 akun)',
            '5x revisi design',
            'Training admin 1 sesi',
        ],
        'not_included' => [
            'Multi vendor marketplace',
            'Member system advanced',
        ]
    ],
    [
        'name' => 'PREMIUM',
        'tagline' => '💎 Fitur Lengkap Seperti Perusahaan Besar',
        'price_original' => 10000000,
        'price_promo' => 6500000,
        'popular' => false,
        'color' => 'premium',
        'features' => [
            'Website 10-15 halaman',
            'Domain GRATIS 3 tahun',
            'Hosting 20GB (3 tahun)',
            'SSL Premium + Wildcard',
            'Full branding package (logo, CI, stationary)',
            '20 artikel SEO killer',
            'SEO full (on-page + off-page)',
            'Multi bahasa (ID + EN)',
            'Dashboard super canggih',
            'E-commerce lengkap + multi payment',
            'Member system dengan login',
            'Live chat + Chatbot AI basic',
            'Google Ads setup + optimasi',
            'WhatsApp Business API setup',
            'Email marketing (Mailchimp integration)',
            'Support WhatsApp 6 bulan',
            'Email profesional (unlimited)',
            'Training lengkap (3 sesi)',
            '10x revisi design',
            'Free maintenance 3 bulan',
        ],
        'not_included' => []
    ],
    [
        'name' => 'ENTERPRISE',
        'tagline' => '🚀 Untuk Perusahaan Besar & Korporasi',
        'price_original' => 20000000,
        'price_promo' => 15000000,
        'popular' => false,
        'color' => 'enterprise',
        'features' => [
            'Website unlimited halaman',
            'Domain GRATIS 5 tahun',
            'Cloud Hosting 50GB (5 tahun)',
            'SSL Premium + Security suite',
            'Full branding + Marketing materials',
            '50 artikel SEO profesional',
            'SEO enterprise (dijamin ranking 1)',
            'Multi bahasa (3+ bahasa)',
            'Custom dashboard BI',
            'E-commerce marketplace (multi vendor)',
            'CRM & Automation system',
            'Live chat + Chatbot AI advanced',
            'Google Ads + Facebook Ads management (3 bulan)',
            'WhatsApp Business API + automation',
            'Email marketing automation',
            'Mobile app (Android + iOS) basic',
            'Support dedicated 24/7 (1 tahun)',
            'Email profesional (unlimited)',
            'Training lengkap + dokumentasi',
            'Revisi unlimited',
            'Free maintenance 1 tahun',
            'Monthly report & analytics',
            'Priority support',
        ],
        'not_included' => []
    ],
    [
        'name' => 'E-COMMERCE',
        'tagline' => '🛒 Khusus Toko Online Lengkap',
        'price_original' => 8000000,
        'price_promo' => 5500000,
        'popular' => false,
        'color' => 'ecommerce',
        'features' => [
            'Toko online unlimited produk',
            'Domain + Hosting 2 tahun',
            'SSL Premium',
            'Multi payment gateway (Midtrans, Xendit)',
            'Integrasi ekspedisi (JNE, J&T, SiCepat, dll)',
            'Dashboard penjual lengkap',
            'Manajemen stok otomatis',
            'Sistem diskon & voucher',
            'Review & rating produk',
            'Wishlist & compare',
            'Live chat + WhatsApp order',
            'Email notifikasi otomatis',
            'Laporan penjualan real-time',
            'SEO e-commerce optimized',
            'Google Shopping feed',
            'Facebook/Instagram shop integration',
            'Support 6 bulan',
            'Training admin & seller',
        ],
        'not_included' => [
            'Multi vendor system',
        ]
    ],
    [
        'name' => 'MARKETPLACE',
        'tagline' => '🏪 Platform Multi Vendor Seperti Tokopedia',
        'price_original' => 25000000,
        'price_promo' => 18000000,
        'popular' => false,
        'color' => 'marketplace',
        'features' => [
            'Multi vendor unlimited seller',
            'Domain + Cloud Hosting 3 tahun',
            'Admin, Seller, Buyer dashboard',
            'Komisi & pembagian revenue otomatis',
            'Multi payment gateway',
            'Multi ekspedisi terintegrasi',
            'Sistem verifikasi seller',
            'Rating & review 2 arah',
            'Dispute resolution system',
            'Withdrawal seller otomatis',
            'Push notification',
            'Live chat multi user',
            'Advanced analytics',
            'SEO marketplace',
            'Mobile app (Android + iOS)',
            'Email & WhatsApp automation',
            'Support dedicated 1 tahun',
            'Training lengkap',
            'Marketing materials',
        ],
        'not_included' => []
    ],
];

?>

<!-- HERO SECTION -->
<section class="hero-section pricing-hero" id="pricing-hero">
    <div class="container">
        <div class="hero-content text-center" data-aos="fade-up">
            <h1 class="hero-title">
                <?= $t['hero_title'] ?>
            </h1>

            <h2 class="hero-subtitle"><?= $t['hero_subtitle'] ?></h2>

            <div class="hero-badge">
                <i class="bi bi-cash-stack me-2"></i>
                Promo Terbatas! Hemat Jutaan Rupiah
            </div>
        </div>
    </div>
</section>

<!-- PACKAGES SECTION -->
<section class="pricing-section" id="all-packages">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up"><?= $t['section_packages'] ?></h2>

        <div class="pricing-table-extended">
            <?php
            $delay = 100;
            foreach ($packages as $pkg):
            $discount = round((($pkg['price_original'] - $pkg['price_promo']) / $pkg['price_original']) * 100);
            ?>
            <div class="card-premium pricing-card-extended <?= $pkg['popular'] ? 'pricing-popular' : '' ?>"
                 data-aos="fade-up" data-aos-delay="<?= $delay ?>">

                <?php if ($pkg['popular']): ?>
                <div class="badge badge-popular position-absolute top-0 end-0 m-3">
                    <i class="bi bi-star-fill me-1"></i> TERLARIS
                </div>
                <?php endif; ?>

                <div class="pricing-header text-center">
                    <h3 class="text-gold mb-2"><?= $pkg['name'] ?></h3>
                    <p class="text-light"><?= $pkg['tagline'] ?></p>

                    <div class="pricing-amount">
                        <div class="price-original"><?= formatRupiah($pkg['price_original']) ?></div>
                        <div class="price-promo"><?= formatRupiah($pkg['price_promo']) ?></div>
                        <div class="badge badge-gold mt-2">
                            <i class="bi bi-tag-fill me-1"></i>
                            <?= $t['save'] ?> <?= $discount ?>%
                        </div>
                    </div>
                </div>

                <div class="pricing-features">
                    <h5 class="text-gold mb-3">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        Yang Anda Dapatkan:
                    </h5>
                    <ul>
                        <?php foreach ($pkg['features'] as $feature): ?>
                        <li>
                            <i class="bi bi-check-circle-fill text-gold me-2"></i>
                            <?= $feature ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>

                    <?php if (!empty($pkg['not_included'])): ?>
                    <h5 class="text-muted mt-4 mb-3">
                        <i class="bi bi-x-circle me-2"></i>
                        Tidak Termasuk:
                    </h5>
                    <ul class="not-included">
                        <?php foreach ($pkg['not_included'] as $feature): ?>
                        <li>
                            <i class="bi bi-x-circle text-muted me-2"></i>
                            <?= $feature ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                </div>

                <a href="/client/demo-request?package=<?= urlencode($pkg['name']) ?>"
                   class="btn btn-gold w-100 btn-lg mt-4">
                    <i class="bi bi-cart-check me-2"></i>
                    <?= $t['btn_choose'] ?>
                </a>
            </div>
            <?php
            $delay += 100;
            endforeach;
            ?>
        </div>
    </div>
</section>

<!-- COMPARISON TABLE -->
<section class="about-section" id="comparison">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up"><?= $t['section_compare'] ?></h2>

        <div class="table-responsive mt-5" data-aos="fade-up">
            <table class="table table-comparison">
                <thead>
                    <tr>
                        <th>Fitur</th>
                        <th>STARTER</th>
                        <th class="highlight">BUSINESS</th>
                        <th>PREMIUM</th>
                        <th>ENTERPRISE</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>Harga</strong></td>
                        <td>Rp 2.5jt</td>
                        <td class="highlight">Rp 4jt</td>
                        <td>Rp 6.5jt</td>
                        <td>Rp 15jt</td>
                    </tr>
                    <tr>
                        <td>Jumlah Halaman</td>
                        <td>5 halaman</td>
                        <td class="highlight">8-10 halaman</td>
                        <td>10-15 halaman</td>
                        <td>Unlimited</td>
                    </tr>
                    <tr>
                        <td>Domain Gratis</td>
                        <td>1 tahun</td>
                        <td class="highlight">2 tahun</td>
                        <td>3 tahun</td>
                        <td>5 tahun</td>
                    </tr>
                    <tr>
                        <td>Hosting</td>
                        <td>5GB</td>
                        <td class="highlight">10GB</td>
                        <td>20GB</td>
                        <td>Cloud 50GB</td>
                    </tr>
                    <tr>
                        <td>Toko Online</td>
                        <td><i class="bi bi-x-circle text-danger"></i></td>
                        <td class="highlight"><i class="bi bi-check-circle text-success"></i> Basic</td>
                        <td><i class="bi bi-check-circle text-success"></i> Lengkap</td>
                        <td><i class="bi bi-check-circle text-success"></i> Marketplace</td>
                    </tr>
                    <tr>
                        <td>SEO</td>
                        <td>Dasar</td>
                        <td class="highlight">Advanced</td>
                        <td>Full</td>
                        <td>Enterprise</td>
                    </tr>
                    <tr>
                        <td>Artikel SEO</td>
                        <td>5 artikel</td>
                        <td class="highlight">10 artikel</td>
                        <td>20 artikel</td>
                        <td>50 artikel</td>
                    </tr>
                    <tr>
                        <td>Multi Bahasa</td>
                        <td><i class="bi bi-x-circle text-danger"></i></td>
                        <td class="highlight"><i class="bi bi-x-circle text-danger"></i></td>
                        <td><i class="bi bi-check-circle text-success"></i> 2 bahasa</td>
                        <td><i class="bi bi-check-circle text-success"></i> 3+ bahasa</td>
                    </tr>
                    <tr>
                        <td>Chatbot AI</td>
                        <td><i class="bi bi-x-circle text-danger"></i></td>
                        <td class="highlight"><i class="bi bi-x-circle text-danger"></i></td>
                        <td><i class="bi bi-check-circle text-success"></i> Basic</td>
                        <td><i class="bi bi-check-circle text-success"></i> Advanced</td>
                    </tr>
                    <tr>
                        <td>Mobile App</td>
                        <td><i class="bi bi-x-circle text-danger"></i></td>
                        <td class="highlight"><i class="bi bi-x-circle text-danger"></i></td>
                        <td><i class="bi bi-x-circle text-danger"></i></td>
                        <td><i class="bi bi-check-circle text-success"></i></td>
                    </tr>
                    <tr>
                        <td>Support</td>
                        <td>1 bulan</td>
                        <td class="highlight">3 bulan</td>
                        <td>6 bulan</td>
                        <td>1 tahun 24/7</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- CUSTOM PACKAGE CTA -->
<section id="custom-package">
    <div class="container text-center">
        <h2 class="section-title" data-aos="fade-up"><?= $t['section_custom'] ?></h2>

        <p class="section-subtitle" data-aos="fade-up">
            Tidak ada paket yang cocok? Buat paket custom sesuai kebutuhan Anda!
        </p>

        <div class="hero-buttons" data-aos="fade-up">
            <a href="/calculator" class="btn btn-gold btn-lg">
                <i class="bi bi-calculator me-2"></i>
                Buat Paket Custom & Hitung Harga
            </a>
            <a href="/contact" class="btn btn-outline-gold btn-lg">
                <i class="bi bi-chat-dots me-2"></i>
                Konsultasi Gratis
            </a>
        </div>
    </div>
</section>

<!-- GUARANTEE SECTION -->
<section class="about-section" id="guarantee">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up"><?= $t['section_guarantee'] ?></h2>

        <div class="row g-4 mt-4">
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card-premium text-center h-100">
                    <div class="about-feature-icon d-inline-block mb-3">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h4 class="text-gold">Money Back Guarantee</h4>
                    <p class="text-light">Jika tidak puas, uang kembali 100%</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card-premium text-center h-100">
                    <div class="about-feature-icon d-inline-block mb-3">
                        <i class="bi bi-clock-history"></i>
                    </div>
                    <h4 class="text-gold">FREE Demo 24 Jam</h4>
                    <p class="text-light">Lihat hasil demo sebelum bayar</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="card-premium text-center h-100">
                    <div class="about-feature-icon d-inline-block mb-3">
                        <i class="bi bi-arrow-repeat"></i>
                    </div>
                    <h4 class="text-gold">Revisi Unlimited</h4>
                    <p class="text-light">Revisi sampai Anda puas (paket tertentu)</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="card-premium text-center h-100">
                    <div class="about-feature-icon d-inline-block mb-3">
                        <i class="bi bi-headset"></i>
                    </div>
                    <h4 class="text-gold">Support 24/7</h4>
                    <p class="text-light">Tim support siap bantu kapan saja</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
