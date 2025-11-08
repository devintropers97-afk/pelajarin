<?php
// Set page title
$pageTitle = '232+ Layanan Digital Marketing & Website | SITUNEO DIGITAL';
$pageDescription = 'Jasa digital marketing lengkap mulai Rp 350rb. Website, SEO, Google Ads, Chatbot AI, Branding, dan 227+ layanan lainnya. FREE DEMO 24 JAM!';

// Include header
include __DIR__ . '/../includes/header.php';

// Services with detail pages (mapping service name to slug)
$services_with_details = [
    'Landing Page' => 'landing-page',
    'Company Profile' => 'company-profile',
    'Toko Online / E-Commerce' => 'toko-online',
    'Website Pinjaman Online (Fintech)' => 'website-pinjol',
    'Website Sekolah/Kampus' => 'website-sekolah',
    'Website UMKM' => 'website-umkm'
];

// Helper function to check if service has detail page
function hasDetailPage($serviceName, $detailsMap) {
    return isset($detailsMap[$serviceName]);
}

// Helper function to get service slug
function getServiceSlug($serviceName, $detailsMap) {
    return $detailsMap[$serviceName] ?? null;
}

// Multi-language text
$text = [
    'id' => [
        'hero_title' => '232+ Layanan Digital',
        'hero_subtitle' => 'Solusi Lengkap untuk Semua Kebutuhan Digital Bisnis Anda',
        'search_placeholder' => 'Cari layanan...',
        'filter_all' => 'Semua Layanan',
        'section_featured' => 'Layanan Unggulan',
        'section_all' => 'Semua Layanan Kami',
        'btn_request' => 'Request Layanan',
        'btn_calculator' => 'Hitung Harga',
        'starting_from' => 'Mulai dari',
    ],
    'en' => [
        'hero_title' => '232+ Digital Services',
        'hero_subtitle' => 'Complete Solutions for All Your Business Digital Needs',
        'search_placeholder' => 'Search services...',
        'filter_all' => 'All Services',
        'section_featured' => 'Featured Services',
        'section_all' => 'All Our Services',
        'btn_request' => 'Request Service',
        'btn_calculator' => 'Calculate Price',
        'starting_from' => 'Starting from',
    ]
];

$t = $text[$lang];

// Fetch all services from database (in DEMO mode, use static data)
if (DEMO_MODE) {
    $services_by_division = [
        'Website Development' => [
            ['name' => 'Landing Page', 'price' => 150000, 'icon' => 'file-earmark-text', 'desc' => 'Website satu halaman untuk promosi produk/layanan - Sewa 150rb/bln atau Beli 1,5jt', 'popular' => true],
            ['name' => 'Website UMKM', 'price' => 150000, 'icon' => 'shop', 'desc' => 'Website terjangkau untuk UMKM Go Digital - Sewa 150rb/bln atau Beli 1,8jt', 'popular' => true],
            ['name' => 'Company Profile', 'price' => 300000, 'icon' => 'building', 'desc' => 'Website profil perusahaan profesional 5-8 halaman - Sewa 300rb/bln atau Beli 3,5jt', 'popular' => true],
            ['name' => 'Toko Online / E-Commerce', 'price' => 500000, 'icon' => 'cart', 'desc' => 'Platform jual beli online lengkap - Sewa 500rb/bln atau Beli 6jt', 'popular' => true],
            ['name' => 'Website Sekolah/Kampus', 'price' => 400000, 'icon' => 'mortarboard', 'desc' => 'Website institusi pendidikan lengkap - Sewa 400rb/bln atau Beli 4,5jt', 'popular' => false],
            ['name' => 'Website Pinjaman Online (Fintech)', 'price' => 2000000, 'icon' => 'cash-coin', 'desc' => 'Platform pinjaman online sesuai regulasi OJK - Sewa 2jt/bln atau Beli 25jt', 'popular' => false],
            ['name' => 'Website Portal Berita', 'price' => 3000000, 'icon' => 'newspaper', 'desc' => 'Portal berita dengan sistem admin dan kategori lengkap', 'popular' => false],
            ['name' => 'Website Membership', 'price' => 2500000, 'icon' => 'people', 'desc' => 'Website dengan sistem member dan login area', 'popular' => false],
            ['name' => 'Blog Personal/Profesional', 'price' => 800000, 'icon' => 'journal-text', 'desc' => 'Blog dengan CMS untuk posting artikel', 'popular' => false],
            ['name' => 'Website Restoran/Cafe', 'price' => 1200000, 'icon' => 'cup-straw', 'desc' => 'Website dengan menu digital dan order online', 'popular' => false],
            ['name' => 'Website Property', 'price' => 2500000, 'icon' => 'house', 'desc' => 'Listing property dengan search dan filter', 'popular' => false],
            ['name' => 'Website Event/Tiket', 'price' => 3000000, 'icon' => 'ticket', 'desc' => 'Platform booking tiket event online', 'popular' => false],
            ['name' => 'Marketplace Custom', 'price' => 5000000, 'icon' => 'shop-window', 'desc' => 'Marketplace multi-vendor seperti Tokopedia/Shopee', 'popular' => false],
            ['name' => 'Booking System', 'price' => 2000000, 'icon' => 'calendar-check', 'desc' => 'Sistem booking untuk hotel, salon, klinik, dll', 'popular' => false],
        ],
        'SEO & Digital Marketing' => [
            ['name' => 'SEO On-Page Optimization', 'price' => 500000, 'icon' => 'search', 'desc' => 'Optimasi struktur website untuk SEO', 'popular' => true],
            ['name' => 'SEO Off-Page (Backlink)', 'price' => 800000, 'icon' => 'link-45deg', 'desc' => 'Building backlink berkualitas tinggi', 'popular' => true],
            ['name' => 'Local SEO / Google My Business', 'price' => 600000, 'icon' => 'geo-alt', 'desc' => 'Optimasi untuk bisnis lokal di Google Maps', 'popular' => false],
            ['name' => 'Google Ads (Search)', 'price' => 1000000, 'icon' => 'google', 'desc' => 'Iklan Google di hasil pencarian (+ biaya iklan)', 'popular' => true],
            ['name' => 'Google Ads (Display)', 'price' => 1000000, 'icon' => 'images', 'desc' => 'Iklan banner di website partner Google', 'popular' => false],
            ['name' => 'Google Shopping Ads', 'price' => 1200000, 'icon' => 'bag-check', 'desc' => 'Iklan produk di Google Shopping', 'popular' => false],
            ['name' => 'Facebook Ads', 'price' => 800000, 'icon' => 'facebook', 'desc' => 'Iklan di Facebook (+ biaya iklan)', 'popular' => true],
            ['name' => 'Instagram Ads', 'price' => 800000, 'icon' => 'instagram', 'desc' => 'Iklan di Instagram (+ biaya iklan)', 'popular' => true],
            ['name' => 'TikTok Ads', 'price' => 1000000, 'icon' => 'tiktok', 'desc' => 'Iklan di TikTok (+ biaya iklan)', 'popular' => false],
            ['name' => 'YouTube Ads', 'price' => 1200000, 'icon' => 'youtube', 'desc' => 'Iklan video di YouTube (+ biaya iklan)', 'popular' => false],
            ['name' => 'Social Media Management', 'price' => 1500000, 'icon' => 'chat-dots', 'desc' => 'Kelola semua sosial media bisnis Anda (per bulan)', 'popular' => true],
            ['name' => 'Content Marketing', 'price' => 2000000, 'icon' => 'file-richtext', 'desc' => '20 artikel SEO per bulan + distribusi', 'popular' => false],
            ['name' => 'Email Marketing', 'price' => 500000, 'icon' => 'envelope', 'desc' => 'Campaign email marketing dengan segmentasi', 'popular' => false],
            ['name' => 'WhatsApp Blast Marketing', 'price' => 300000, 'icon' => 'whatsapp', 'desc' => 'Broadcast WhatsApp ke ribuan kontak', 'popular' => false],
        ],
        'Branding & Design' => [
            ['name' => 'Logo Design', 'price' => 500000, 'icon' => 'palette', 'desc' => 'Desain logo profesional + 5 revisi', 'popular' => true],
            ['name' => 'Brand Identity Package', 'price' => 2000000, 'icon' => 'box', 'desc' => 'Logo + Brand guideline + Stationery lengkap', 'popular' => true],
            ['name' => 'Company Profile PDF', 'price' => 800000, 'icon' => 'file-earmark-pdf', 'desc' => 'Company profile digital format PDF interaktif', 'popular' => false],
            ['name' => 'Brosur Design', 'price' => 300000, 'icon' => 'file-richtext', 'desc' => 'Desain brosur 2 sisi siap cetak', 'popular' => false],
            ['name' => 'Banner & Poster Design', 'price' => 250000, 'icon' => 'card-image', 'desc' => 'Desain banner promosi untuk digital/cetak', 'popular' => false],
            ['name' => 'Social Media Post Design', 'price' => 500000, 'icon' => 'instagram', 'desc' => '30 desain post untuk Instagram/Facebook', 'popular' => true],
            ['name' => 'Packaging Design', 'price' => 1000000, 'icon' => 'box-seam', 'desc' => 'Desain kemasan produk siap produksi', 'popular' => false],
            ['name' => 'UI/UX Design', 'price' => 3000000, 'icon' => 'layers', 'desc' => 'Desain interface aplikasi mobile/web', 'popular' => false],
            ['name' => 'Infographic Design', 'price' => 400000, 'icon' => 'bar-chart', 'desc' => 'Infografis menarik untuk data/statistik', 'popular' => false],
            ['name' => 'Presentation Design', 'price' => 600000, 'icon' => 'easel', 'desc' => 'Desain PowerPoint profesional untuk pitch', 'popular' => false],
        ],
        'AI & Automation' => [
            ['name' => 'Chatbot AI WhatsApp', 'price' => 1000000, 'icon' => 'robot', 'desc' => 'Bot WhatsApp pintar dengan AI (per bulan)', 'popular' => true],
            ['name' => 'Chatbot Website (Live Chat)', 'price' => 500000, 'icon' => 'chat-left-dots', 'desc' => 'Widget live chat otomatis di website', 'popular' => true],
            ['name' => 'Voice Bot/IVR System', 'price' => 2000000, 'icon' => 'telephone', 'desc' => 'Bot penjawab telepon otomatis dengan AI', 'popular' => false],
            ['name' => 'AI Content Generator', 'price' => 800000, 'icon' => 'magic', 'desc' => 'Tools AI untuk generate artikel/konten', 'popular' => false],
            ['name' => 'Auto Reply Instagram/FB', 'price' => 400000, 'icon' => 'reply', 'desc' => 'Bot auto reply untuk DM sosial media', 'popular' => false],
            ['name' => 'WhatsApp Business API', 'price' => 1500000, 'icon' => 'whatsapp', 'desc' => 'WhatsApp verified dengan API official (per bulan)', 'popular' => true],
            ['name' => 'CRM Automation', 'price' => 2500000, 'icon' => 'kanban', 'desc' => 'Sistem CRM otomatis follow-up customer', 'popular' => false],
            ['name' => 'Email Automation', 'price' => 600000, 'icon' => 'envelope-at', 'desc' => 'Auto email berdasarkan trigger behavior', 'popular' => false],
        ],
        'Mobile App Development' => [
            ['name' => 'Android App (Native)', 'price' => 10000000, 'icon' => 'android2', 'desc' => 'Aplikasi Android native dengan Kotlin/Java', 'popular' => false],
            ['name' => 'iOS App (Native)', 'price' => 12000000, 'icon' => 'apple', 'desc' => 'Aplikasi iOS native dengan Swift', 'popular' => false],
            ['name' => 'Hybrid App (Flutter)', 'price' => 8000000, 'icon' => 'phone', 'desc' => 'App hybrid untuk Android & iOS sekaligus', 'popular' => true],
            ['name' => 'PWA (Progressive Web App)', 'price' => 3000000, 'icon' => 'window', 'desc' => 'Web app yang bisa diinstall seperti native app', 'popular' => false],
            ['name' => 'Mobile Game Development', 'price' => 15000000, 'icon' => 'controller', 'desc' => 'Game mobile casual/hypercasual', 'popular' => false],
        ],
        'Cloud & DevOps' => [
            ['name' => 'Cloud Migration', 'price' => 5000000, 'icon' => 'cloud-upload', 'desc' => 'Migrasi website/app ke cloud (AWS/GCP/Azure)', 'popular' => false],
            ['name' => 'Server Management', 'price' => 1000000, 'icon' => 'server', 'desc' => 'Maintenance server 24/7 (per bulan)', 'popular' => false],
            ['name' => 'CI/CD Pipeline Setup', 'price' => 3000000, 'icon' => 'arrow-repeat', 'desc' => 'Otomasi deployment dengan CI/CD', 'popular' => false],
            ['name' => 'Docker & Kubernetes', 'price' => 4000000, 'icon' => 'box-seam', 'desc' => 'Containerization dan orchestration', 'popular' => false],
            ['name' => 'Backup & Disaster Recovery', 'price' => 800000, 'icon' => 'shield-check', 'desc' => 'Sistem backup otomatis + recovery plan', 'popular' => false],
        ],
        'Business Intelligence' => [
            ['name' => 'Dashboard Analytics', 'price' => 3000000, 'icon' => 'graph-up', 'desc' => 'Dashboard real-time monitoring bisnis', 'popular' => true],
            ['name' => 'Data Visualization', 'price' => 2000000, 'icon' => 'bar-chart-line', 'desc' => 'Visualisasi data interaktif dengan chart', 'popular' => false],
            ['name' => 'Report Automation', 'price' => 1500000, 'icon' => 'file-bar-graph', 'desc' => 'Auto generate laporan harian/mingguan', 'popular' => false],
            ['name' => 'Business Intelligence System', 'price' => 5000000, 'icon' => 'diagram-3', 'desc' => 'Sistem BI lengkap untuk decision making', 'popular' => false],
        ],
        'E-Commerce Solutions' => [
            ['name' => 'Integrasi Payment Gateway', 'price' => 1000000, 'icon' => 'credit-card', 'desc' => 'Integrasi Midtrans, Xendit, dll', 'popular' => true],
            ['name' => 'Integrasi Ekspedisi', 'price' => 800000, 'icon' => 'truck', 'desc' => 'Raja Ongkir, JNE, J&T, SiCepat, dll', 'popular' => true],
            ['name' => 'Multi-Vendor Platform', 'price' => 8000000, 'icon' => 'shop-window', 'desc' => 'Marketplace dengan sistem vendor/seller', 'popular' => false],
            ['name' => 'Dropship System', 'price' => 2000000, 'icon' => 'box-arrow-right', 'desc' => 'Sistem dropship otomatis', 'popular' => false],
            ['name' => 'Loyalty Program', 'price' => 1500000, 'icon' => 'trophy', 'desc' => 'Sistem poin reward untuk customer', 'popular' => false],
            ['name' => 'Inventory Management', 'price' => 2500000, 'icon' => 'boxes', 'desc' => 'Sistem stok barang real-time', 'popular' => false],
        ],
        'Digital Training' => [
            ['name' => 'SEO Training', 'price' => 1500000, 'icon' => 'book', 'desc' => 'Pelatihan SEO untuk tim internal', 'popular' => false],
            ['name' => 'Digital Marketing Workshop', 'price' => 2000000, 'icon' => 'people', 'desc' => 'Workshop digital marketing 1 hari', 'popular' => false],
            ['name' => 'Social Media Management Training', 'price' => 1000000, 'icon' => 'mortarboard', 'desc' => 'Training kelola sosmed untuk bisnis', 'popular' => false],
            ['name' => 'Content Creation Training', 'price' => 1200000, 'icon' => 'camera-video', 'desc' => 'Belajar bikin konten viral', 'popular' => false],
        ],
        'Consulting Services' => [
            ['name' => 'Digital Strategy Consulting', 'price' => 3000000, 'icon' => 'chat-square-text', 'desc' => 'Konsultasi strategi digital lengkap', 'popular' => false],
            ['name' => 'Business Model Consulting', 'price' => 5000000, 'icon' => 'diagram-2', 'desc' => 'Konsultasi model bisnis dan monetisasi', 'popular' => false],
            ['name' => 'Market Research', 'price' => 2000000, 'icon' => 'search', 'desc' => 'Riset pasar dan kompetitor analysis', 'popular' => false],
        ],
    ];
} else {
    // Fetch from database when not in demo mode
    $services_result = db_query("SELECT * FROM services WHERE is_active = 1 ORDER BY division_id, service_order");
    // Process and group by division
}

?>

<!-- HERO SECTION -->
<section class="hero-section services-hero" id="services-hero">
    <div class="container">
        <div class="hero-content text-center" data-aos="fade-up">
            <h1 class="hero-title">
                <?= $t['hero_title'] ?>
            </h1>

            <h2 class="hero-subtitle"><?= $t['hero_subtitle'] ?></h2>

            <!-- Search Toggle Button -->
            <button id="searchToggleBtn" class="btn btn-outline-gold mt-4" data-aos="fade-up" data-aos-delay="100">
                <i class="bi bi-search me-2"></i>
                <span id="searchToggleText">Tampilkan Pencarian</span>
            </button>

            <!-- Search Box (hidden by default) -->
            <div id="servicesSearchBox" class="services-search-box mt-3" style="display: none; max-height: 0; overflow: hidden; transition: all 0.3s ease;" data-aos="fade-up" data-aos-delay="100">
                <input type="text"
                       id="serviceSearch"
                       class="form-control form-control-lg"
                       placeholder="<?= $t['search_placeholder'] ?>">
                <i class="bi bi-search"></i>
            </div>
        </div>
    </div>
</section>

<!-- FILTER DROPDOWN -->
<section class="services-filter-section">
    <div class="container">
        <div class="row justify-content-center" data-aos="fade-up">
            <div class="col-md-6 col-lg-4">
                <label for="categoryFilter" class="form-label text-light mb-2">
                    <i class="bi bi-funnel-fill me-2"></i>Filter Kategori:
                </label>
                <select id="categoryFilter" class="form-select form-select-lg">
                    <option value="all"><?= $t['filter_all'] ?></option>
                    <?php foreach (array_keys($services_by_division) as $division): ?>
                    <option value="<?= slugify($division) ?>"><?= $division ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>
</section>

<!-- ALL SERVICES BY DIVISION -->
<?php foreach ($services_by_division as $division => $services): ?>
<section class="services-division-section" id="<?= slugify($division) ?>" data-division="<?= slugify($division) ?>">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up">
            <i class="bi bi-folder-fill text-gold me-3"></i>
            <?= $division ?>
        </h2>

        <div class="services-grid">
            <?php
            $delay = 100;
            foreach ($services as $service):
            ?>
            <div class="card-premium service-card"
                 data-aos="fade-up"
                 data-aos-delay="<?= $delay ?>"
                 data-service-name="<?= strtolower($service['name']) ?>"
                 data-service-desc="<?= strtolower($service['desc']) ?>">

                <?php if ($service['popular']): ?>
                <div class="badge badge-popular position-absolute top-0 end-0 m-3">
                    <i class="bi bi-star-fill me-1"></i> POPULER
                </div>
                <?php endif; ?>

                <div class="service-card-icon">
                    <i class="bi bi-<?= $service['icon'] ?>"></i>
                </div>

                <h3><?= $service['name'] ?></h3>
                <p class="text-light"><?= $service['desc'] ?></p>

                <div class="mt-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div>
                            <small class="text-muted"><?= $t['starting_from'] ?></small>
                            <div class="text-gold fw-bold fs-5"><?= formatRupiah($service['price']) ?></div>
                        </div>
                    </div>

                    <?php if (hasDetailPage($service['name'], $services_with_details)): ?>
                    <!-- Service has detail page - show both buttons -->
                    <div class="d-grid gap-2">
                        <a href="/service/<?= getServiceSlug($service['name'], $services_with_details) ?>"
                           class="btn btn-sm btn-outline-gold">
                            <i class="bi bi-info-circle me-1"></i> Lihat Detail & Harga
                        </a>
                        <a href="/calculator?service=<?= urlencode($service['name']) ?>"
                           class="btn btn-sm btn-gold">
                            <?= $t['btn_request'] ?> <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                    <?php else: ?>
                    <!-- No detail page - show only request button -->
                    <a href="/calculator?service=<?= urlencode($service['name']) ?>"
                       class="btn btn-sm btn-gold w-100">
                        <?= $t['btn_request'] ?> <i class="bi bi-arrow-right ms-1"></i>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php
            $delay += 50;
            if ($delay > 500) $delay = 100;
            endforeach;
            ?>
        </div>
    </div>
</section>
<?php endforeach; ?>

<!-- CTA SECTION -->
<section id="cta">
    <div class="container text-center">
        <h2 class="section-title" data-aos="fade-up">
            Tidak Menemukan Layanan yang Anda Cari?
        </h2>

        <p class="section-subtitle" data-aos="fade-up">
            Hubungi kami untuk konsultasi GRATIS! Kami siap bantu kebutuhan digital apapun
        </p>

        <div class="hero-buttons" data-aos="fade-up">
            <a href="/calculator" class="btn btn-gold btn-lg">
                <i class="bi bi-calculator me-2"></i>
                <?= $t['btn_calculator'] ?>
            </a>
            <a href="/contact" class="btn btn-outline-gold btn-lg">
                <i class="bi bi-envelope me-2"></i>
                Konsultasi Gratis
            </a>
        </div>
    </div>
</section>

<!-- Service Filter & Search JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('serviceSearch');
    const searchBox = document.getElementById('servicesSearchBox');
    const searchToggleBtn = document.getElementById('searchToggleBtn');
    const searchToggleText = document.getElementById('searchToggleText');
    const filterBtns = document.querySelectorAll('.filter-btn');
    const divisionSections = document.querySelectorAll('.services-division-section');
    const serviceCards = document.querySelectorAll('.service-card');

    // Toggle search bar
    let searchVisible = false;
    searchToggleBtn.addEventListener('click', function() {
        searchVisible = !searchVisible;

        if (searchVisible) {
            searchBox.style.display = 'block';
            setTimeout(() => {
                searchBox.style.maxHeight = '100px';
                searchBox.style.opacity = '1';
            }, 10);
            searchToggleText.textContent = 'Sembunyikan Pencarian';
            searchToggleBtn.querySelector('i').classList.remove('bi-search');
            searchToggleBtn.querySelector('i').classList.add('bi-x-lg');
        } else {
            searchBox.style.maxHeight = '0';
            searchBox.style.opacity = '0';
            setTimeout(() => {
                searchBox.style.display = 'none';
            }, 300);
            searchToggleText.textContent = 'Tampilkan Pencarian';
            searchToggleBtn.querySelector('i').classList.remove('bi-x-lg');
            searchToggleBtn.querySelector('i').classList.add('bi-search');
            // Clear search when hiding
            searchInput.value = '';
            // Show all services
            serviceCards.forEach(card => card.style.display = 'block');
            divisionSections.forEach(section => section.style.display = 'block');
        }
    });

    // Search functionality
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();

        serviceCards.forEach(card => {
            const serviceName = card.getAttribute('data-service-name');
            const serviceDesc = card.getAttribute('data-service-desc');

            if (serviceName.includes(searchTerm) || serviceDesc.includes(searchTerm)) {
                card.style.display = 'block';
                card.closest('.services-division-section').style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });

        // Hide empty divisions
        divisionSections.forEach(section => {
            const visibleCards = section.querySelectorAll('.service-card[style="display: block;"], .service-card:not([style])');
            if (visibleCards.length === 0 && searchTerm !== '') {
                section.style.display = 'none';
            }
        });
    });

    // Filter functionality with dropdown
    const categoryFilter = document.getElementById('categoryFilter');
    if (categoryFilter) {
        categoryFilter.addEventListener('change', function() {
            const filter = this.value;

            if (filter === 'all') {
                divisionSections.forEach(section => {
                    section.style.display = 'block';
                });
                serviceCards.forEach(card => {
                    card.style.display = 'block';
                });
            } else {
                divisionSections.forEach(section => {
                    if (section.getAttribute('data-division') === filter) {
                        section.style.display = 'block';
                        // Scroll to section smoothly
                        section.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    } else {
                        section.style.display = 'none';
                    }
                });
            }
        });
    }
});
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>
