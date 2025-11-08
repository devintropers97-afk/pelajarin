<?php
// Set page title
$pageTitle = 'Portfolio 500+ Project | Contoh Website SITUNEO DIGITAL';
$pageDescription = 'Lihat 60+ contoh website nyata yang kami buat. Toko online, company profile, landing page, fintech, UMKM, dan lainnya. FREE DEMO - coba dulu sebelum pesan!';

// Include header
include __DIR__ . '/../includes/header.php';

// Multi-language text
$text = [
    'id' => [
        'hero_title' => '60+ Demo Website Perfect',
        'hero_subtitle' => 'Lihat Langsung Kualitas Kerja Kami - Semua Kategori Tersedia!',
        'filter_all' => 'Semua',
        'btn_view_demo' => 'Lihat Demo',
        'btn_order_similar' => 'Pesan Serupa',
        'views' => 'views',
        'category' => 'Kategori',
    ],
    'en' => [
        'hero_title' => '60+ Perfect Website Demos',
        'hero_subtitle' => 'See Our Work Quality - All Categories Available!',
        'filter_all' => 'All',
        'btn_view_demo' => 'View Demo',
        'btn_order_similar' => 'Order Similar',
        'views' => 'views',
        'category' => 'Category',
    ]
];

$t = $text[$lang];

// Portfolio demos - 50 perfect examples
if (DEMO_MODE) {
    $portfolios = [
        // E-Commerce / Toko Online
        ['id' => 1, 'name' => 'Toko Baju Fashion "StyleHub"', 'category' => 'E-Commerce', 'image' => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=800', 'views' => 1250, 'desc' => 'Toko online fashion modern dengan cart dan payment gateway'],
        ['id' => 2, 'name' => 'Toko Sepatu "ShoePlanet"', 'category' => 'E-Commerce', 'image' => 'https://images.unsplash.com/photo-1460353581641-37baddab0fa2?w=800', 'views' => 980, 'desc' => 'E-commerce sepatu dengan filter size dan warna'],
        ['id' => 3, 'name' => 'Toko Elektronik "TechMart"', 'category' => 'E-Commerce', 'image' => 'https://images.unsplash.com/photo-1498049794561-7780e7231661?w=800', 'views' => 1450, 'desc' => 'Marketplace gadget dan elektronik lengkap'],
        ['id' => 4, 'name' => 'Toko Kosmetik "BeautyBox"', 'category' => 'E-Commerce', 'image' => 'https://images.unsplash.com/photo-1596462502278-27bfdc403348?w=800', 'views' => 890, 'desc' => 'Online shop kosmetik dan skincare'],
        ['id' => 5, 'name' => 'Toko Furniture "HomeStyle"', 'category' => 'E-Commerce', 'image' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=800', 'views' => 760, 'desc' => 'Toko furniture rumah minimalis modern'],

        // Company Profile
        ['id' => 6, 'name' => 'PT Digital Solusindo', 'category' => 'Company Profile', 'image' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=800', 'views' => 1120, 'desc' => 'Company profile IT consultant profesional'],
        ['id' => 7, 'name' => 'CV Sejahtera Mandiri', 'category' => 'Company Profile', 'image' => 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=800', 'views' => 950, 'desc' => 'Profil perusahaan konstruksi dan properti'],
        ['id' => 8, 'name' => 'Law Firm "Hukum Prima"', 'category' => 'Company Profile', 'image' => 'https://images.unsplash.com/photo-1589829545856-d10d557cf95f?w=800', 'views' => 670, 'desc' => 'Website firma hukum elegan'],
        ['id' => 9, 'name' => 'Konsultan Pajak "Tax Expert"', 'category' => 'Company Profile', 'image' => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=800', 'views' => 540, 'desc' => 'Profil konsultan pajak dan akuntansi'],
        ['id' => 10, 'name' => 'Agency Advertising "Creative Pro"', 'category' => 'Company Profile', 'image' => 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0?w=800', 'views' => 820, 'desc' => 'Portfolio agency kreatif dan advertising'],

        // Service / Jasa
        ['id' => 11, 'name' => 'Service AC "CoolTech"', 'category' => 'Service', 'image' => 'https://images.unsplash.com/photo-1631545804657-2c0d0c882e8c?w=800', 'views' => 1340, 'desc' => 'Website jasa service AC dengan booking online'],
        ['id' => 12, 'name' => 'Laundry "CleanPro"', 'category' => 'Service', 'image' => 'https://images.unsplash.com/photo-1517677208171-0bc6725a3e60?w=800', 'views' => 980, 'desc' => 'Laundry premium dengan sistem order dan antar jemput'],
        ['id' => 13, 'name' => 'Salon & Spa "BeautyVilla"', 'category' => 'Service', 'image' => 'https://images.unsplash.com/photo-1560066984-138dadb4c035?w=800', 'views' => 1150, 'desc' => 'Booking salon dan spa online'],
        ['id' => 14, 'name' => 'Service Laptop "TechRepair"', 'category' => 'Service', 'image' => 'https://images.unsplash.com/photo-1588872657578-7efd1f1555ed?w=800', 'views' => 720, 'desc' => 'Service komputer dan laptop dengan estimasi online'],
        ['id' => 15, 'name' => 'Cleaning Service "SparkleClean"', 'category' => 'Service', 'image' => 'https://images.unsplash.com/photo-1581578731548-c64695cc6952?w=800', 'views' => 890, 'desc' => 'Jasa cleaning rumah dan kantor'],

        // Pendidikan / Education
        ['id' => 16, 'name' => 'Kursus Online "EduMaster"', 'category' => 'Education', 'image' => 'https://images.unsplash.com/photo-1501504905252-473c47e087f8?w=800', 'views' => 1680, 'desc' => 'Platform kursus online dengan video learning'],
        ['id' => 17, 'name' => 'Bimbel "Smart Study"', 'category' => 'Education', 'image' => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=800', 'views' => 1120, 'desc' => 'Bimbingan belajar dengan sistem member'],
        ['id' => 18, 'name' => 'Sekolah "SMP Harapan Bangsa"', 'category' => 'Education', 'image' => 'https://images.unsplash.com/photo-1546410531-bb4caa6b424d?w=800', 'views' => 950, 'desc' => 'Website sekolah lengkap dengan portal siswa'],
        ['id' => 19, 'name' => 'Universitas "Tech University"', 'category' => 'Education', 'image' => 'https://images.unsplash.com/photo-1562774053-701939374585?w=800', 'views' => 780, 'desc' => 'Portal universitas dengan sistem akademik'],
        ['id' => 20, 'name' => 'Kursus Bahasa "LingoLab"', 'category' => 'Education', 'image' => 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=800', 'views' => 640, 'desc' => 'Kursus bahasa inggris online'],

        // Kesehatan / Healthcare
        ['id' => 21, 'name' => 'Klinik "HealthCare Plus"', 'category' => 'Healthcare', 'image' => 'https://images.unsplash.com/photo-1519494026892-80bbd2d6fd0d?w=800', 'views' => 1450, 'desc' => 'Website klinik dengan booking appointment'],
        ['id' => 22, 'name' => 'Dokter Gigi "SmileDental"', 'category' => 'Healthcare', 'image' => 'https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?w=800', 'views' => 890, 'desc' => 'Praktek dokter gigi dengan jadwal online'],
        ['id' => 23, 'name' => 'Apotek "FarmaMedika"', 'category' => 'Healthcare', 'image' => 'https://images.unsplash.com/photo-1587854692152-cbe660dbde88?w=800', 'views' => 1120, 'desc' => 'Apotek online dengan resep digital'],
        ['id' => 24, 'name' => 'Rumah Sakit "RS Sehat Sentosa"', 'category' => 'Healthcare', 'image' => 'https://images.unsplash.com/photo-1538108149393-fbbd81895907?w=800', 'views' => 980, 'desc' => 'Portal rumah sakit lengkap'],
        ['id' => 25, 'name' => 'Gym & Fitness "PowerGym"', 'category' => 'Healthcare', 'image' => 'https://images.unsplash.com/photo-1534438327276-14e5300c3a48?w=800', 'views' => 740, 'desc' => 'Website gym dengan membership online'],

        // Food & Beverage
        ['id' => 26, 'name' => 'Restoran "Rasa Nusantara"', 'category' => 'Food', 'image' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=800', 'views' => 1580, 'desc' => 'Restoran dengan menu digital dan order online'],
        ['id' => 27, 'name' => 'Cafe "Coffee Break"', 'category' => 'Food', 'image' => 'https://images.unsplash.com/photo-1445116572660-236099ec97a0?w=800', 'views' => 1230, 'desc' => 'Cafe modern dengan reservation system'],
        ['id' => 28, 'name' => 'Catering "Delicious Catering"', 'category' => 'Food', 'image' => 'https://images.unsplash.com/photo-1555244162-803834f70033?w=800', 'views' => 890, 'desc' => 'Jasa catering dengan katalog menu lengkap'],
        ['id' => 29, 'name' => 'Bakery "Sweet Bakeshop"', 'category' => 'Food', 'image' => 'https://images.unsplash.com/photo-1509440159596-0249088772ff?w=800', 'views' => 1050, 'desc' => 'Toko roti dan kue dengan pre-order online'],
        ['id' => 30, 'name' => 'Food Truck "Burger Van"', 'category' => 'Food', 'image' => 'https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?w=800', 'views' => 670, 'desc' => 'Website food truck dengan lokasi tracker'],

        // Property / Real Estate
        ['id' => 31, 'name' => 'Property "Prime Estate"', 'category' => 'Property', 'image' => 'https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=800', 'views' => 1340, 'desc' => 'Listing properti dengan search advanced'],
        ['id' => 32, 'name' => 'Developer "Grand City"', 'category' => 'Property', 'image' => 'https://images.unsplash.com/photo-1486718448742-163732cd1544?w=800', 'views' => 980, 'desc' => 'Website developer perumahan'],
        ['id' => 33, 'name' => 'Villa Rental "Paradise Villa"', 'category' => 'Property', 'image' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800', 'views' => 1120, 'desc' => 'Rental villa dengan booking system'],
        ['id' => 34, 'name' => 'Apartemen "Sky Residence"', 'category' => 'Property', 'image' => 'https://images.unsplash.com/photo-1545324418-cc1a3fa10c00?w=800', 'views' => 850, 'desc' => 'Marketing apartemen mewah'],
        ['id' => 35, 'name' => 'Kontraktor "BuildPro"', 'category' => 'Property', 'image' => 'https://images.unsplash.com/photo-1503387762-592deb58ef4e?w=800', 'views' => 720, 'desc' => 'Jasa kontraktor dan renovasi'],

        // Automotive
        ['id' => 36, 'name' => 'Car Wash "AutoClean"', 'category' => 'Automotive', 'image' => 'https://images.unsplash.com/photo-1520340356584-f9917d1eea6f?w=800', 'views' => 980, 'desc' => 'Cuci mobil dengan membership'],
        ['id' => 37, 'name' => 'Bengkel "Fix Auto"', 'category' => 'Automotive', 'image' => 'https://images.unsplash.com/photo-1487754180451-c456f719a1fc?w=800', 'views' => 840, 'desc' => 'Service mobil dengan booking online'],
        ['id' => 38, 'name' => 'Rental Mobil "RentCar Pro"', 'category' => 'Automotive', 'image' => 'https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?w=800', 'views' => 1260, 'desc' => 'Sewa mobil dengan sistem reservasi'],
        ['id' => 39, 'name' => 'Showroom Motor "BikeHub"', 'category' => 'Automotive', 'image' => 'https://images.unsplash.com/photo-1558981806-ec527fa84c39?w=800', 'views' => 690, 'desc' => 'Dealer motor bekas dan baru'],
        ['id' => 40, 'name' => 'Aksesori Mobil "AutoParts"', 'category' => 'Automotive', 'image' => 'https://images.unsplash.com/photo-1486262715619-67b85e0b08d3?w=800', 'views' => 550, 'desc' => 'Toko aksesori dan spare part mobil'],

        // Hotel & Travel
        ['id' => 41, 'name' => 'Hotel "Grand Paradise"', 'category' => 'Hotel', 'image' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800', 'views' => 1450, 'desc' => 'Hotel dengan sistem reservasi online'],
        ['id' => 42, 'name' => 'Travel Agent "WanderLust"', 'category' => 'Travel', 'image' => 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?w=800', 'views' => 1120, 'desc' => 'Paket tour dan travel domestik/internasional'],
        ['id' => 43, 'name' => 'Villa Resort "Tropical Stay"', 'category' => 'Hotel', 'image' => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800', 'views' => 980, 'desc' => 'Resort tepi pantai dengan booking online'],
        ['id' => 44, 'name' => 'Homestay "Cozy Home"', 'category' => 'Hotel', 'image' => 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=800', 'views' => 720, 'desc' => 'Homestay murah dan nyaman'],
        ['id' => 45, 'name' => 'Tour Guide "Explorer ID"', 'category' => 'Travel', 'image' => 'https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?w=800', 'views' => 850, 'desc' => 'Jasa tour guide profesional'],

        // Fintech / Pinjaman Online
        ['id' => 46, 'name' => 'Pinjol "DanaCepat"', 'category' => 'Fintech', 'image' => 'https://images.unsplash.com/photo-1579621970563-ebec7560ff3e?w=800', 'views' => 2150, 'desc' => 'Platform pinjaman online sesuai regulasi OJK dengan sistem kredit scoring'],
        ['id' => 47, 'name' => 'Fintech "KoperasiDigital"', 'category' => 'Fintech', 'image' => 'https://images.unsplash.com/photo-1563013544-824ae1b704d3?w=800', 'views' => 1840, 'desc' => 'Koperasi digital dengan sistem pinjaman anggota online'],
        ['id' => 48, 'name' => 'P2P Lending "InvestasiKu"', 'category' => 'Fintech', 'image' => 'https://images.unsplash.com/photo-1554224154-26032ffc0d07?w=800', 'views' => 1670, 'desc' => 'Platform peer-to-peer lending untuk UMKM'],

        // UMKM / Usaha Kecil
        ['id' => 49, 'name' => 'Warung Kelontong "Bu Ani"', 'category' => 'UMKM', 'image' => 'https://images.unsplash.com/photo-1604719312566-8912e9227c6a?w=800', 'views' => 1450, 'desc' => 'Website warung kelontong dengan katalog produk dan WhatsApp order'],
        ['id' => 50, 'name' => 'Toko Sembako "Sumber Rezeki"', 'category' => 'UMKM', 'image' => 'https://images.unsplash.com/photo-1542838132-92c53300491e?w=800', 'views' => 1320, 'desc' => 'Toko sembako dengan sistem online order dan delivery'],
        ['id' => 51, 'name' => 'Jasa Laundry "Bersih Wangi"', 'category' => 'UMKM', 'image' => 'https://images.unsplash.com/photo-1545173168-9f1947eebb7f?w=800', 'views' => 1180, 'desc' => 'Laundry UMKM dengan price list dan layanan antar jemput'],
        ['id' => 52, 'name' => 'Catering Rumahan "Mama Cook"', 'category' => 'UMKM', 'image' => 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=800', 'views' => 1540, 'desc' => 'Catering rumahan dengan menu paket lengkap'],
        ['id' => 53, 'name' => 'Bengkel Motor "Jaya Teknik"', 'category' => 'UMKM', 'image' => 'https://images.unsplash.com/photo-1486262715619-67b85e0b08d3?w=800', 'views' => 990, 'desc' => 'Bengkel motor dengan price list dan booking service'],
        ['id' => 54, 'name' => 'Toko Bangunan "Mandiri"', 'category' => 'UMKM', 'image' => 'https://images.unsplash.com/photo-1513694203232-719a280e022f?w=800', 'views' => 870, 'desc' => 'Toko material bangunan dengan katalog produk'],

        // Landing Page
        ['id' => 55, 'name' => 'Landing Page Kursus "BelajarDesign"', 'category' => 'Landing Page', 'image' => 'https://images.unsplash.com/photo-1561070791-2526d30994b5?w=800', 'views' => 1890, 'desc' => 'Landing page kursus desain grafis dengan lead capture'],
        ['id' => 56, 'name' => 'Landing Page Properti "RumahIdaman"', 'category' => 'Landing Page', 'image' => 'https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=800', 'views' => 1650, 'desc' => 'Landing page marketing properti perumahan'],
        ['id' => 57, 'name' => 'Landing Page Event "TechConf 2025"', 'category' => 'Landing Page', 'image' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?w=800', 'views' => 1420, 'desc' => 'Landing page event conference dengan tiket online'],

        // Others
        ['id' => 58, 'name' => 'Wedding Organizer "DreamWedding"', 'category' => 'Event', 'image' => 'https://images.unsplash.com/photo-1519741497674-611481863552?w=800', 'views' => 1340, 'desc' => 'Jasa wedding organizer lengkap'],
        ['id' => 59, 'name' => 'Photography "PixelShot"', 'category' => 'Creative', 'image' => 'https://images.unsplash.com/photo-1542038784456-1ea8e935640e?w=800', 'views' => 980, 'desc' => 'Jasa fotografi profesional dengan portfolio'],
        ['id' => 60, 'name' => 'Florist "Bloom Garden"', 'category' => 'Retail', 'image' => 'https://images.unsplash.com/photo-1487070183336-b863922373d4?w=800', 'views' => 760, 'desc' => 'Toko bunga dengan delivery service'],
    ];

    // Get unique categories
    $categories = array_unique(array_column($portfolios, 'category'));
    sort($categories);
} else {
    // Fetch from database
    $portfolios = db_fetch_all("SELECT * FROM portfolios WHERE is_active = 1 ORDER BY views DESC, created_at DESC");
    $categories = db_fetch_all("SELECT DISTINCT category FROM portfolios WHERE is_active = 1 ORDER BY category");
}

?>

<!-- HERO SECTION -->
<section class="hero-section portfolio-hero" id="portfolio-hero">
    <div class="container">
        <div class="hero-content text-center" data-aos="fade-up">
            <h1 class="hero-title">
                <?= $t['hero_title'] ?>
            </h1>

            <h2 class="hero-subtitle"><?= $t['hero_subtitle'] ?></h2>

            <div class="hero-badge">
                <i class="bi bi-eye-fill me-2"></i>
                Semua Demo GRATIS - Coba Sekarang!
            </div>
        </div>
    </div>
</section>

<!-- FILTER SECTION -->
<section class="portfolio-filter-section">
    <div class="container">
        <div class="portfolio-filter" data-aos="fade-up">
            <button class="filter-btn active" data-filter="all">
                <i class="bi bi-grid-3x3-gap me-2"></i>
                <?= $t['filter_all'] ?>
            </button>
            <?php foreach ($categories as $category): ?>
            <button class="filter-btn" data-filter="<?= slugify($category) ?>">
                <?= $category ?>
            </button>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- PORTFOLIO GRID -->
<section class="portfolio-section">
    <div class="container">
        <div class="portfolio-grid">
            <?php
            $delay = 100;
            foreach ($portfolios as $portfolio):
            ?>
            <div class="card-premium portfolio-card"
                 data-aos="fade-up"
                 data-aos-delay="<?= $delay ?>"
                 data-category="<?= slugify($portfolio['category']) ?>">

                <div class="portfolio-image-wrapper">
                    <img src="<?= $portfolio['image'] ?>"
                         alt="<?= $portfolio['name'] ?>"
                         class="portfolio-image">

                    <div class="portfolio-overlay">
                        <a href="/demo/<?= $portfolio['id'] ?>"
                           class="btn btn-gold btn-sm"
                           target="_blank">
                            <i class="bi bi-eye me-2"></i>
                            <?= $t['btn_view_demo'] ?>
                        </a>
                    </div>
                </div>

                <div class="portfolio-info">
                    <div class="badge badge-gold mb-2">
                        <i class="bi bi-folder me-1"></i>
                        <?= $portfolio['category'] ?>
                    </div>

                    <h3><?= $portfolio['name'] ?></h3>
                    <p class="text-light"><?= $portfolio['desc'] ?></p>

                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="text-muted small">
                            <i class="bi bi-eye me-1"></i>
                            <?= number_format($portfolio['views']) ?> <?= $t['views'] ?>
                        </div>

                        <a href="/calculator?project=<?= urlencode($portfolio['name']) ?>"
                           class="btn btn-sm btn-outline-gold">
                            <?= $t['btn_order_similar'] ?> <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
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

<!-- CTA SECTION -->
<section id="cta">
    <div class="container text-center">
        <h2 class="section-title" data-aos="fade-up">
            Tertarik dengan Salah Satu Demo di Atas?
        </h2>

        <p class="section-subtitle" data-aos="fade-up">
            Request demo serupa untuk bisnis Anda! Custom sesuai kebutuhan
        </p>

        <div class="hero-buttons" data-aos="fade-up">
            <a href="/client/demo-request" class="btn btn-gold btn-lg">
                <i class="bi bi-rocket-takeoff me-2"></i>
                Request Demo Gratis
            </a>
            <a href="/calculator" class="btn btn-outline-gold btn-lg">
                <i class="bi bi-calculator me-2"></i>
                Hitung Harga Custom
            </a>
        </div>
    </div>
</section>

<!-- Portfolio Filter JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    const portfolioCards = document.querySelectorAll('.portfolio-card');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active from all
            filterBtns.forEach(b => b.classList.remove('active'));

            // Add active to clicked
            this.classList.add('active');

            const filter = this.getAttribute('data-filter');

            portfolioCards.forEach(card => {
                if (filter === 'all' || card.getAttribute('data-category') === filter) {
                    card.style.display = 'block';
                    // Re-trigger AOS animation
                    card.classList.add('aos-animate');
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
});
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>
