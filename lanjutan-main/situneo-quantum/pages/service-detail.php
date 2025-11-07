<?php
// Service Detail Page
$service_slug = $_GET['service'] ?? '';

// Load dependencies
require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../includes/functions.php';

// Service data with rental & purchase prices
$services_data = [
    'landing-page' => [
        'name' => 'Landing Page',
        'category' => 'Website Development',
        'tagline' => 'Website Satu Halaman untuk Promosi Produk/Layanan Anda',
        'description' => 'Landing page adalah halaman website satu halaman yang dirancang khusus untuk konversi maksimal. Cocok untuk promosi produk, campaign iklan, atau lead generation.',
        'icon' => 'file-earmark-text',
        'price_rent' => 150000, // per bulan
        'price_buy' => 1500000, // beli putus
        'features' => [
            'Desain responsive mobile-friendly',
            'Loading super cepat (optimized)',
            'SEO friendly',
            'Form kontak terintegrasi',
            'Google Analytics',
            'WhatsApp button',
            'Social media integration',
            '1x revisi gratis',
            'FREE domain .my.id',
            'SSL Certificate gratis'
        ],
        'rent_benefits' => [
            'Maintenance & update gratis',
            'Hosting unlimited bandwidth',
            'Backup otomatis harian',
            'Support 24/7 via WhatsApp',
            'Perpanjangan mudah per bulan',
            'Bisa upgrade ke plan lebih besar'
        ],
        'buy_benefits' => [
            'Full ownership (milik Anda selamanya)',
            'Source code diberikan',
            'Gratis hosting 1 tahun',
            'Gratis domain 1 tahun',
            'Maintenance 3 bulan gratis',
            'Bisa dijual kembali'
        ],
        'suitable_for' => [
            'UMKM & Startup',
            'Freelancer & Personal Branding',
            'Campaign Marketing',
            'Product Launch',
            'Event Promotion',
            'Lead Generation'
        ],
        'delivery_time' => '3-5 hari kerja',
        'revision' => '1x revisi gratis',
        'examples' => [
            'Website jasa cleaning service',
            'Promosi kursus online',
            'Jualan produk skincare',
            'Landing page wedding organizer'
        ]
    ],
    'company-profile' => [
        'name' => 'Company Profile',
        'category' => 'Website Development',
        'tagline' => 'Website Profesional untuk Profil Perusahaan Anda',
        'description' => 'Website company profile lengkap dengan 5-8 halaman untuk menampilkan profil perusahaan, produk/layanan, tim, dan kontak. Cocok untuk membangun kredibilitas bisnis Anda.',
        'icon' => 'building',
        'price_rent' => 300000,
        'price_buy' => 3500000,
        'features' => [
            'Desain profesional & modern',
            '5-8 halaman lengkap',
            'Responsive semua device',
            'Admin panel CMS',
            'Galeri foto/video',
            'Blog/artikel',
            'Multiple contact forms',
            'Google Maps integration',
            'Live chat widget',
            'SEO optimized',
            'Social media links',
            'Newsletter subscription',
            '2x revisi gratis'
        ],
        'rent_benefits' => [
            'Maintenance & security update',
            'Hosting cloud Indonesia',
            'Backup mingguan',
            'Content update 2x per bulan',
            'Support prioritas',
            'Free minor design changes'
        ],
        'buy_benefits' => [
            'Kepemilikan penuh',
            'Source code lengkap',
            'Hosting 1 tahun',
            'Domain .com/.co.id',
            'Maintenance 6 bulan',
            'Training admin panel'
        ],
        'suitable_for' => [
            'Perusahaan menengah & besar',
            'Konsultan & Agency',
            'Developer & Kontraktor',
            'Klinik & Rumah Sakit',
            'Law Firm & Notaris',
            'Hotel & Villa'
        ],
        'delivery_time' => '7-10 hari kerja',
        'revision' => '2x revisi gratis',
        'examples' => [
            'Website perusahaan konstruksi',
            'Profil agency digital',
            'Website klinik kesehatan',
            'Company profile konsultan'
        ]
    ],
    'toko-online' => [
        'name' => 'Toko Online / E-Commerce',
        'category' => 'Website Development',
        'tagline' => 'Platform Jual Beli Online Lengkap untuk Bisnis Anda',
        'description' => 'Website toko online lengkap dengan sistem keranjang belanja, payment gateway, order management, dan admin panel. Siap untuk jualan online dengan sistem yang profesional.',
        'icon' => 'cart',
        'price_rent' => 500000,
        'price_buy' => 6000000,
        'features' => [
            'Unlimited produk',
            'Shopping cart system',
            'Multiple payment gateway',
            'Ongkir otomatis (Raja Ongkir)',
            'Order tracking',
            'Invoice otomatis',
            'Admin dashboard lengkap',
            'Manajemen stok',
            'Customer account',
            'Wishlist & Compare',
            'Product review system',
            'Promo & Discount code',
            'Multi-currency (Rupiah)',
            'WhatsApp notification',
            'Email notification'
        ],
        'rent_benefits' => [
            'Update fitur berkala',
            'Payment gateway fee included',
            'Hosting e-commerce tier',
            'SSL premium',
            'Backup harian',
            'Product upload 20 item/bulan',
            'Support 24/7'
        ],
        'buy_benefits' => [
            'Full ownership',
            'Source code',
            'Hosting 1 tahun',
            'Domain premium',
            'Maintenance 6 bulan',
            'Training lengkap',
            'Marketing kit gratis'
        ],
        'suitable_for' => [
            'Toko Retail Online',
            'Fashion & Clothing',
            'Elektronik & Gadget',
            'Makanan & Minuman',
            'Kosmetik & Skincare',
            'Furniture & Home Decor',
            'UMKM Go Digital'
        ],
        'delivery_time' => '14-21 hari kerja',
        'revision' => '3x revisi gratis',
        'examples' => [
            'Toko baju online',
            'Jualan skincare',
            'Marketplace furniture',
            'Toko elektronik'
        ]
    ],
    'website-pinjol' => [
        'name' => 'Website Pinjaman Online (Fintech)',
        'category' => 'Website Development',
        'tagline' => 'Platform Pinjaman Online Profesional & Aman',
        'description' => 'Website pinjaman online (pinjol) dengan sistem perhitungan bunga otomatis, verifikasi customer, sistem approval, dan dashboard monitoring lengkap. Sesuai regulasi OJK.',
        'icon' => 'cash-coin',
        'price_rent' => 2000000,
        'price_buy' => 25000000,
        'features' => [
            'Sistem pengajuan pinjaman online',
            'KYC & Verifikasi identitas',
            'Credit scoring system',
            'Perhitungan bunga otomatis',
            'Tenor pinjaman flexible',
            'Approval workflow (multi-level)',
            'Disbursement integration',
            'Sistem cicilan & reminder',
            'Payment gateway integration',
            'SMS & Email notification',
            'Admin dashboard analytics',
            'Customer dashboard',
            'Collection management',
            'Report lengkap untuk OJK',
            'Keamanan tingkat bank'
        ],
        'rent_benefits' => [
            'Update regulasi OJK',
            'Server dedicated',
            'Backup real-time',
            'Security monitoring 24/7',
            'Support prioritas',
            'Konsultasi regulasi',
            'Free minor features'
        ],
        'buy_benefits' => [
            'Full ownership + Source code',
            'Server setup assistance',
            'Hosting 2 tahun',
            'Domain .co.id',
            'Maintenance 1 tahun',
            'Training team lengkap',
            'Legal document template',
            'Marketing materials'
        ],
        'suitable_for' => [
            'Perusahaan Fintech',
            'Koperasi Digital',
            'Startup Lending',
            'P2P Lending Platform'
        ],
        'delivery_time' => '30-45 hari kerja',
        'revision' => '5x revisi gratis',
        'examples' => [
            'Platform pinjaman UMKM',
            'Pinjaman karyawan',
            'Peer-to-peer lending',
            'Micro-financing'
        ],
        'notes' => 'Wajib memiliki izin OJK untuk operasional. Kami bantu konsultasi regulasi.'
    ],
    'website-sekolah' => [
        'name' => 'Website Sekolah / Kampus',
        'category' => 'Website Development',
        'tagline' => 'Website Institusi Pendidikan Lengkap & Modern',
        'description' => 'Website sekolah/kampus dengan fitur informasi akademik, sistem pengumuman, galeri kegiatan, dan portal siswa/mahasiswa. Cocok untuk TK, SD, SMP, SMA, hingga Universitas.',
        'icon' => 'mortarboard',
        'price_rent' => 400000,
        'price_buy' => 4500000,
        'features' => [
            'Home dengan info sekolah',
            'Profil & Visi Misi',
            'Program/Jurusan',
            'Informasi PPDB online',
            'Kalender akademik',
            'Berita & Pengumuman',
            'Galeri foto & video',
            'Prestasi siswa',
            'Profil guru/dosen',
            'Download materi',
            'Kontak & Lokasi',
            'Fasilitas sekolah',
            'Blog artikel pendidikan'
        ],
        'rent_benefits' => [
            'Update content 4x per bulan',
            'Hosting education tier',
            'Backup otomatis',
            'Support via WA Group',
            'Training operator website',
            'Template surat digital'
        ],
        'buy_benefits' => [
            'Kepemilikan selamanya',
            'Source code',
            'Hosting 1 tahun',
            'Domain .sch.id',
            'Maintenance 6 bulan',
            'Training lengkap',
            'Bonus template design'
        ],
        'suitable_for' => [
            'TK & PAUD',
            'SD & MI',
            'SMP & MTs',
            'SMA & SMK',
            'Universitas & Institut',
            'Pesantren & Madrasah',
            'Lembaga Kursus'
        ],
        'delivery_time' => '10-14 hari kerja',
        'revision' => '2x revisi gratis',
        'examples' => [
            'Website SMA Negeri',
            'Portal kampus swasta',
            'Website pesantren modern',
            'Lembaga kursus bahasa'
        ]
    ],
    'website-umkm' => [
        'name' => 'Website UMKM',
        'category' => 'Website Development',
        'tagline' => 'Website Terjangkau untuk UMKM Go Digital',
        'description' => 'Paket website khusus UMKM dengan harga terjangkau. Tampil profesional dengan fitur katalog produk, kontak WhatsApp, dan lokasi toko. Cocok untuk usaha kecil menengah.',
        'icon' => 'shop',
        'price_rent' => 150000,
        'price_buy' => 1800000,
        'features' => [
            'Desain simple & profesional',
            'Katalog produk/jasa',
            'Harga & deskripsi lengkap',
            'WhatsApp order button',
            'Google Maps lokasi',
            'Jam operasional',
            'Testimoni customer',
            'Instagram feed',
            'Facebook page plugin',
            'Mobile responsive',
            'Fast loading'
        ],
        'rent_benefits' => [
            'Update produk unlimited',
            'Hosting cepat',
            'Backup berkala',
            'Support WA',
            'Free domain .my.id',
            'Tutorial lengkap'
        ],
        'buy_benefits' => [
            'Milik sendiri',
            'Source code',
            'Hosting 1 tahun',
            'Domain pilihan',
            'Maintenance 3 bulan',
            'Video tutorial',
            'Template promosi medsos'
        ],
        'suitable_for' => [
            'Warung & Kedai',
            'Toko Kelontong',
            'Jasa Laundry',
            'Salon & Barbershop',
            'Catering & Katering',
            'Toko Bangunan',
            'Service AC/Elektronik',
            'Bengkel Motor/Mobil'
        ],
        'delivery_time' => '3-5 hari kerja',
        'revision' => '1x revisi gratis',
        'examples' => [
            'Toko baju muslim',
            'Jasa cleaning service',
            'Catering rumahan',
            'Bengkel motor'
        ]
    ]
];

// Check if service exists
if (!isset($services_data[$service_slug])) {
    header('Location: /services');
    exit;
}

$service = $services_data[$service_slug];
$pageTitle = $service['name'] . ' - Harga Mulai Rp ' . number_format($service['price_rent'], 0, ',', '.') . '/bulan | SITUNEO DIGITAL';
$pageDescription = $service['tagline'] . ' - Sewa mulai Rp ' . number_format($service['price_rent'], 0, ',', '.') . '/bulan atau beli putus Rp ' . number_format($service['price_buy'], 0, ',', '.');

require_once __DIR__ . '/../includes/header.php';
?>

<style>
.service-detail-hero {
    background: linear-gradient(135deg, #0F3057 0%, #1E5C99 100%);
    padding: 120px 0 80px;
    position: relative;
    overflow: hidden;
}
.service-detail-hero::before {
    content: '';
    position: absolute;
    width: 500px;
    height: 500px;
    background: radial-gradient(circle, rgba(212, 175, 55,0.1) 0%, transparent 70%);
    top: -100px;
    right: -100px;
}
.service-icon-large {
    width: 80px;
    height: 80px;
    background: var(--gradient-gold);
    border-radius: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    color: var(--dark-blue);
    margin-bottom: 20px;
    box-shadow: 0 10px 30px rgba(212, 175, 55, 0.3);
}
.price-card {
    background: rgba(10, 22, 40, 0.5);
    backdrop-filter: blur(10px);
    border: 2px solid rgba(212, 175, 55, 0.3);
    border-radius: 20px;
    padding: 30px;
    text-align: center;
    transition: all 0.3s;
    height: 100%;
}
.price-card:hover {
    transform: translateY(-10px);
    border-color: var(--gold);
    box-shadow: 0 15px 40px rgba(212, 175, 55, 0.3);
}
.price-badge {
    background: var(--gradient-gold);
    color: var(--dark-blue);
    padding: 8px 20px;
    border-radius: 50px;
    font-weight: 700;
    font-size: 0.9rem;
    display: inline-block;
    margin-bottom: 15px;
}
.price-amount {
    font-size: 2.5rem;
    font-weight: 900;
    color: var(--gold);
    margin: 15px 0;
}
.price-period {
    color: rgba(255,255,255,0.7);
    font-size: 1rem;
}
.feature-list {
    list-style: none;
    padding: 0;
    margin: 25px 0;
    text-align: left;
}
.feature-list li {
    padding: 10px 0;
    border-bottom: 1px solid rgba(255,255,255,0.1);
    color: rgba(255,255,255,0.9);
}
.feature-list li:last-child {
    border-bottom: none;
}
.feature-list li i {
    color: var(--gold);
    margin-right: 10px;
}
.benefit-card {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 15px;
    padding: 25px;
    margin-bottom: 20px;
}
.suitable-tag {
    display: inline-block;
    background: rgba(212, 175, 55, 0.2);
    border: 1px solid rgba(212, 175, 55, 0.4);
    padding: 8px 15px;
    border-radius: 50px;
    margin: 5px;
    font-size: 0.9rem;
    color: var(--gold);
}
</style>

<!-- Hero Section -->
<section class="service-detail-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/" class="text-gold">Home</a></li>
                        <li class="breadcrumb-item"><a href="/services" class="text-gold">Layanan</a></li>
                        <li class="breadcrumb-item active text-light"><?= $service['name'] ?></li>
                    </ol>
                </nav>

                <div class="service-icon-large" data-aos="zoom-in">
                    <i class="bi bi-<?= $service['icon'] ?>"></i>
                </div>

                <h1 class="display-4 fw-bold text-white mb-3" data-aos="fade-up">
                    <?= $service['name'] ?>
                </h1>

                <p class="lead text-gold mb-4" data-aos="fade-up" data-aos-delay="100">
                    <?= $service['tagline'] ?>
                </p>

                <p class="text-light mb-4" data-aos="fade-up" data-aos-delay="200" style="font-size: 1.1rem;">
                    <?= $service['description'] ?>
                </p>

                <div class="d-flex gap-3 flex-wrap" data-aos="fade-up" data-aos-delay="300">
                    <a href="#pricing" class="btn btn-gold btn-lg">
                        <i class="bi bi-tag me-2"></i>Lihat Harga
                    </a>
                    <a href="/contact" class="btn btn-outline-gold btn-lg">
                        <i class="bi bi-whatsapp me-2"></i>Konsultasi Gratis
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Pricing Section -->
<section class="py-5" id="pricing" style="background: var(--dark-blue);">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-5 fw-bold text-gold mb-3">Pilih Paket Yang Cocok</h2>
            <p class="text-light">Sewa bulanan atau beli putus? Pilihan ada di tangan Anda!</p>
        </div>

        <div class="row g-4">
            <!-- Rental Package -->
            <div class="col-lg-6" data-aos="fade-up">
                <div class="price-card">
                    <span class="price-badge">💰 HEMAT - SEWA BULANAN</span>
                    <h3 class="text-white mb-3">Paket Sewa</h3>
                    <div class="price-amount">Rp <?= number_format($service['price_rent'], 0, ',', '.') ?></div>
                    <div class="price-period">per bulan</div>

                    <ul class="feature-list">
                        <?php foreach($service['features'] as $feature): ?>
                        <li><i class="bi bi-check-circle-fill"></i> <?= $feature ?></li>
                        <?php endforeach; ?>
                    </ul>

                    <div class="mt-4">
                        <h6 class="text-gold mb-3">Benefit Sewa:</h6>
                        <ul class="feature-list">
                            <?php foreach($service['rent_benefits'] as $benefit): ?>
                            <li><i class="bi bi-star-fill"></i> <?= $benefit ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <a href="/auth/register" class="btn btn-gold w-100 mt-4">
                        <i class="bi bi-cart-plus me-2"></i>Pilih Sewa Bulanan
                    </a>
                    <small class="text-muted d-block mt-2">* Bisa berhenti kapan saja</small>
                </div>
            </div>

            <!-- Purchase Package -->
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                <div class="price-card">
                    <span class="price-badge">👑 PREMIUM - BELI PUTUS</span>
                    <h3 class="text-white mb-3">Paket Beli</h3>
                    <div class="price-amount">Rp <?= number_format($service['price_buy'], 0, ',', '.') ?></div>
                    <div class="price-period">sekali bayar</div>

                    <ul class="feature-list">
                        <?php foreach($service['features'] as $feature): ?>
                        <li><i class="bi bi-check-circle-fill"></i> <?= $feature ?></li>
                        <?php endforeach; ?>
                    </ul>

                    <div class="mt-4">
                        <h6 class="text-gold mb-3">Benefit Beli Putus:</h6>
                        <ul class="feature-list">
                            <?php foreach($service['buy_benefits'] as $benefit): ?>
                            <li><i class="bi bi-trophy-fill"></i> <?= $benefit ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <a href="/auth/register" class="btn btn-gold w-100 mt-4">
                        <i class="bi bi-bag-check me-2"></i>Pilih Beli Putus
                    </a>
                    <small class="text-muted d-block mt-2">* Milik Anda selamanya</small>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Suitable For Section -->
<section class="py-5" style="background: rgba(10, 22, 40, 0.5);">
    <div class="container">
        <h3 class="text-gold mb-4 text-center">Cocok Untuk:</h3>
        <div class="text-center">
            <?php foreach($service['suitable_for'] as $item): ?>
            <span class="suitable-tag"><?= $item ?></span>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Info Section -->
<section class="py-5" style="background: var(--dark-blue);">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="benefit-card text-center">
                    <i class="bi bi-clock text-gold" style="font-size: 3rem;"></i>
                    <h5 class="text-white mt-3">Waktu Pengerjaan</h5>
                    <p class="text-light"><?= $service['delivery_time'] ?></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="benefit-card text-center">
                    <i class="bi bi-arrow-repeat text-gold" style="font-size: 3rem;"></i>
                    <h5 class="text-white mt-3">Revisi</h5>
                    <p class="text-light"><?= $service['revision'] ?></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="benefit-card text-center">
                    <i class="bi bi-headset text-gold" style="font-size: 3rem;"></i>
                    <h5 class="text-white mt-3">Support</h5>
                    <p class="text-light">24/7 via WhatsApp</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5" style="background: var(--gradient-primary);">
    <div class="container text-center">
        <h2 class="display-5 fw-bold text-white mb-3">Siap Mulai Project Anda?</h2>
        <p class="text-light mb-4">Daftar sekarang dan dapatkan FREE DEMO 24 jam!</p>
        <div class="d-flex gap-3 justify-content-center flex-wrap">
            <a href="/auth/register" class="btn btn-gold btn-lg">
                <i class="bi bi-rocket-takeoff me-2"></i>Daftar & Mulai Sekarang
            </a>
            <a href="https://wa.me/<?= SITE_WHATSAPP ?>?text=Halo, saya mau tanya tentang <?= urlencode($service['name']) ?>" class="btn btn-outline-gold btn-lg">
                <i class="bi bi-whatsapp me-2"></i>Chat WhatsApp
            </a>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
