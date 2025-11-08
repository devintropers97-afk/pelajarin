<?php
// Set page title
$pageTitle = 'Semua Jenis Website - 50+ Kategori Lengkap | SITUNEO Digital';
$pageDescription = 'Daftar lengkap 50+ kategori website dari A-Z. Bisnis, Jasa, F&B, Properti, Kesehatan, Pendidikan, dan lainnya. Temukan website yang cocok untuk bisnis Anda!';

// Include header
include __DIR__ . '/../includes/header.php';

// 50 Kategori Website
$categories = [
    [
        'id' => 1,
        'name' => 'Bisnis & Komersial',
        'icon' => '🏪',
        'color' => '#FFB400',
        'types' => [
            'E-commerce / Toko Online',
            'Company Profile',
            'Landing Page',
            'Katalog Produk Digital',
            'Marketplace Multi-vendor',
            'Website Distributor',
            'Website Wholesaler/Grosir',
            'B2B Platform',
            'Dropship System',
            'Reseller Website',
            'Pre-order System',
            'Flash Sale Platform',
            'Auction Website'
        ],
        'solution' => 'toko-online',
        'price_start' => '350rb/bulan'
    ],
    [
        'id' => 2,
        'name' => 'Jasa & Layanan Profesional',
        'icon' => '💼',
        'color' => '#1E5C99',
        'types' => [
            'Konsultan Bisnis',
            'IT/Software House',
            'Marketing Agency',
            'Desain Grafis',
            'Fotografi Profesional',
            'Videografi',
            'Event Organizer',
            'Cleaning Service',
            'Konstruksi',
            'Jasa Pengiriman/Logistik',
            'Jasa Keuangan',
            'Kantor Hukum/Legal',
            'Notaris',
            'Kantor Akunting',
            'Wedding Organizer',
            'Freelance Platform'
        ],
        'solution' => 'company-profile',
        'price_start' => '150rb/bulan'
    ],
    [
        'id' => 3,
        'name' => 'Food & Beverage',
        'icon' => '🍔',
        'color' => '#FF6B6B',
        'types' => [
            'Restoran',
            'Cafe/Coffee Shop',
            'Fast Food/Quick Service',
            'Bakery/Toko Roti',
            'Catering',
            'Food Delivery',
            'Cloud Kitchen',
            'Warung/Warung Makan',
            'Jajanan/Snack',
            'Kedai Minuman',
            'Diet Catering',
            'Meal Prep Service'
        ],
        'solution' => 'resto-online',
        'price_start' => '250rb/bulan'
    ],
    [
        'id' => 4,
        'name' => 'Properti & Real Estate',
        'icon' => '🏠',
        'color' => '#4ECDC4',
        'types' => [
            'Jual Beli Properti',
            'Sewa/Rental Properti',
            'Developer Property',
            'Kontraktor Bangunan',
            'Arsitek',
            'Interior Design',
            'Property Management',
            'Kos-kosan/Apartemen'
        ],
        'solution' => 'property-listing',
        'price_start' => '500rb/bulan'
    ],
    [
        'id' => 5,
        'name' => 'Perhotelan & Pariwisata',
        'icon' => '✈️',
        'color' => '#95E1D3',
        'types' => [
            'Hotel',
            'Resort',
            'Villa',
            'Homestay/Penginapan',
            'Booking System',
            'Travel Agency',
            'Tour & Travel',
            'Wisata/Tourism',
            'Rental Kendaraan',
            'Tiket Pesawat/Bus/Kereta'
        ],
        'solution' => 'booking-system',
        'price_start' => '750rb/bulan'
    ],
    [
        'id' => 6,
        'name' => 'Kesehatan & Medis',
        'icon' => '💊',
        'color' => '#38B6FF',
        'types' => [
            'Rumah Sakit',
            'Klinik',
            'Praktek Dokter',
            'Apotek/Pharmacy',
            'Laboratorium',
            'Toko Alat Kesehatan',
            'Homecare Service',
            'Terapis',
            'Fisioterapi',
            'Psikolog',
            'Ahli Gizi/Nutrisionist',
            'Pengobatan Alternatif'
        ],
        'solution' => 'klinik-online',
        'price_start' => '500rb/bulan'
    ],
    [
        'id' => 7,
        'name' => 'Kecantikan & Perawatan',
        'icon' => '💅',
        'color' => '#FF9ECD',
        'types' => [
            'Salon Kecantikan',
            'Barbershop',
            'Spa',
            'Massage/Pijat',
            'Fitness Center',
            'Gym',
            'Yoga Studio',
            'Klinik Kecantikan',
            'Skincare Clinic',
            'Makeup Artist',
            'Nail Salon',
            'Lash Extension'
        ],
        'solution' => 'booking-system',
        'price_start' => '350rb/bulan'
    ],
    [
        'id' => 8,
        'name' => 'Pendidikan',
        'icon' => '📚',
        'color' => '#5F27CD',
        'types' => [
            'Sekolah (SD/SMP/SMA)',
            'Universitas/Kampus',
            'Kursus/Training Center',
            'Bimbingan Belajar',
            'Les Private',
            'E-learning Platform',
            'LMS (Learning Management)',
            'Perpustakaan Digital',
            'Jurnal/Publikasi Ilmiah'
        ],
        'solution' => 'sekolah-online',
        'price_start' => '750rb/bulan'
    ],
    [
        'id' => 9,
        'name' => 'Otomotif',
        'icon' => '🚗',
        'color' => '#FFA500',
        'types' => [
            'Dealer Mobil',
            'Dealer Motor',
            'Bengkel/Service',
            'Spare Parts',
            'Car Wash/Cuci Mobil',
            'Rental Mobil/Motor',
            'Modifikasi Kendaraan',
            'Audio Mobil',
            'Car Detailing',
            'CCTV & Aksesoris Mobil'
        ],
        'solution' => 'toko-online',
        'price_start' => '350rb/bulan'
    ],
    [
        'id' => 10,
        'name' => 'Fashion & Retail',
        'icon' => '👗',
        'color' => '#E056FD',
        'types' => [
            'Toko Fashion',
            'Butik',
            'Toko Sepatu',
            'Toko Tas',
            'Aksesoris Fashion',
            'Hijab/Muslim Fashion',
            'Batik',
            'Thrift Shop/Preloved',
            'Custom Clothing',
            'Konveksi',
            'Sablon/Printing Kaos'
        ],
        'solution' => 'toko-online',
        'price_start' => '350rb/bulan'
    ],
    [
        'id' => 11,
        'name' => 'Teknologi & Elektronik',
        'icon' => '💻',
        'color' => '#00D2FF',
        'types' => [
            'Toko Gadget',
            'Toko Komputer/Laptop',
            'Toko HP/Smartphone',
            'Service Elektronik',
            'Software House',
            'IT Solutions',
            'Web Hosting',
            'Cloud Services'
        ],
        'solution' => 'toko-online',
        'price_start' => '350rb/bulan'
    ],
    [
        'id' => 12,
        'name' => 'Media & Konten',
        'icon' => '📰',
        'color' => '#EA4C89',
        'types' => [
            'Portal Berita',
            'Majalah Online',
            'Blog Platform',
            'Podcast Website',
            'Video Streaming',
            'Platform Musik',
            'Radio Online',
            'Content Creator',
            'Influencer Platform'
        ],
        'solution' => 'portal-berita',
        'price_start' => '500rb/bulan'
    ],
    [
        'id' => 13,
        'name' => 'Komunitas & Sosial',
        'icon' => '👥',
        'color' => '#5352ED',
        'types' => [
            'Forum Diskusi',
            'Community Website',
            'Social Network',
            'Dating Platform',
            'Alumni Network',
            'Fan Club',
            'NGO/Lembaga Sosial',
            'Yayasan',
            'Organisasi'
        ],
        'solution' => 'community-platform',
        'price_start' => '750rb/bulan'
    ],
    [
        'id' => 14,
        'name' => 'Event & Hiburan',
        'icon' => '🎉',
        'color' => '#FF3838',
        'types' => [
            'Event Organizer',
            'Konser/Festival',
            'Pameran',
            'Seminar/Workshop',
            'Ticketing System',
            'Bioskop',
            'Teater',
            'Game Center',
            'Entertainment'
        ],
        'solution' => 'booking-system',
        'price_start' => '500rb/bulan'
    ],
    [
        'id' => 15,
        'name' => 'Pemerintahan',
        'icon' => '🏛️',
        'color' => '#2C3E50',
        'types' => [
            'Website Desa',
            'Website Kelurahan',
            'Website Kecamatan',
            'Dinas Pemerintahan',
            'Layanan Publik',
            'BUMN/BUMD',
            'Kementerian',
            'Lembaga Negara'
        ],
        'solution' => 'government-portal',
        'price_start' => '1jt/bulan'
    ],
    [
        'id' => 16,
        'name' => 'Olahraga & Fitness',
        'icon' => '⚽',
        'color' => '#27AE60',
        'types' => [
            'Gym/Fitness Center',
            'Studio Olahraga',
            'Klub Olahraga',
            'Lapangan Futsal',
            'Kolam Renang',
            'Lapangan Badminton',
            'Lapangan Golf',
            'Boxing Gym',
            'Martial Arts',
            'Dance Studio'
        ],
        'solution' => 'booking-system',
        'price_start' => '350rb/bulan'
    ],
    [
        'id' => 17,
        'name' => 'Pet & Hewan',
        'icon' => '🐾',
        'color' => '#F39C12',
        'types' => [
            'Pet Shop',
            'Pet Grooming',
            'Klinik Hewan',
            'Pet Hotel',
            'Adopsi Hewan',
            'Perlengkapan Hewan'
        ],
        'solution' => 'toko-online',
        'price_start' => '350rb/bulan'
    ],
    [
        'id' => 18,
        'name' => 'Undangan Digital',
        'icon' => '💌',
        'color' => '#E91E63',
        'types' => [
            'Undangan Pernikahan',
            'Undangan Ulang Tahun',
            'Undangan Khitanan',
            'Undangan Acara Kantor',
            'Undangan Event'
        ],
        'solution' => 'undangan-digital',
        'price_start' => '99rb/website'
    ],
    [
        'id' => 19,
        'name' => 'Aplikasi & Tools',
        'icon' => '🛠️',
        'color' => '#607D8B',
        'types' => [
            'Dashboard Admin',
            'CRM System',
            'Inventory Management',
            'POS (Point of Sale)',
            'Booking System',
            'Calculator',
            'Converter/Konverter',
            'Generator Tools',
            'To-Do List',
            'Note-Taking App'
        ],
        'solution' => 'custom-system',
        'price_start' => '5jt+'
    ],
    [
        'id' => 20,
        'name' => 'Game & Interaktif',
        'icon' => '🎮',
        'color' => '#9B59B6',
        'types' => [
            'Game Online',
            'Quiz Platform',
            'Survey System',
            'Polling Website',
            'Voting System',
            'Gamification Platform'
        ],
        'solution' => 'interactive-platform',
        'price_start' => '2jt+'
    ],
    [
        'id' => 21,
        'name' => 'Galeri & Portfolio',
        'icon' => '📸',
        'color' => '#34495E',
        'types' => [
            'Galeri Foto',
            'Galeri Video',
            'Portfolio Seni',
            'Portfolio Designer',
            'Portfolio Developer',
            'Portfolio Fotografer',
            'Portfolio Videografer',
            'Portfolio Artist',
            'Portfolio Model'
        ],
        'solution' => 'portfolio-website',
        'price_start' => '250rb/bulan'
    ],
    [
        'id' => 22,
        'name' => 'Keuangan & Investasi',
        'icon' => '💰',
        'color' => '#16A085',
        'types' => [
            'Website Bank',
            'Fintech Platform',
            'P2P Lending',
            'Platform Investasi',
            'Asuransi',
            'Payment Gateway',
            'E-wallet',
            'Securities',
            'Crypto Exchange'
        ],
        'solution' => 'fintech-platform',
        'price_start' => '10jt+'
    ],
    [
        'id' => 23,
        'name' => 'Pertanian & Agribisnis',
        'icon' => '🌾',
        'color' => '#27AE60',
        'types' => [
            'Toko Pertanian',
            'Hasil Tani',
            'Peternakan',
            'Hidroponik',
            'Urban Farming',
            'Organic Farm',
            'Supplier Bibit'
        ],
        'solution' => 'toko-online',
        'price_start' => '350rb/bulan'
    ],
    [
        'id' => 24,
        'name' => 'Furniture & Interior',
        'icon' => '🛋️',
        'color' => '#8E44AD',
        'types' => [
            'Toko Furniture',
            'Custom Furniture',
            'Interior Design',
            'Kitchen Set',
            'Dekorasi Rumah',
            'Toko Lampu'
        ],
        'solution' => 'toko-online',
        'price_start' => '350rb/bulan'
    ],
    [
        'id' => 25,
        'name' => 'Percetakan & Produksi',
        'icon' => '🖨️',
        'color' => '#E74C3C',
        'types' => [
            'Digital Printing',
            'Sablon',
            'Konveksi',
            'Souvenir',
            'Merchandise',
            'Packaging/Kemasan'
        ],
        'solution' => 'toko-online',
        'price_start' => '350rb/bulan'
    ],
    [
        'id' => 26,
        'name' => 'Marketplace Spesifik',
        'icon' => '🛒',
        'color' => '#3498DB',
        'types' => [
            'Handmade Marketplace',
            'UMKM Marketplace',
            'Digital Products',
            'Services Marketplace',
            'Rental Marketplace',
            'B2B Marketplace',
            'Freelance Marketplace',
            'Template/Assets Store'
        ],
        'solution' => 'marketplace',
        'price_start' => '10jt+'
    ],
    [
        'id' => 27,
        'name' => 'Direktori & Listing',
        'icon' => '📋',
        'color' => '#F39C12',
        'types' => [
            'Business Directory',
            'Yellow Pages',
            'Job Portal',
            'Classified Ads',
            'Review/Rating Platform'
        ],
        'solution' => 'directory-listing',
        'price_start' => '5jt+'
    ],
    [
        'id' => 28,
        'name' => 'Membership & Subscription',
        'icon' => '👑',
        'color' => '#F1C40F',
        'types' => [
            'Membership Club',
            'Subscription Service',
            'Premium Content',
            'Coworking Space'
        ],
        'solution' => 'membership-platform',
        'price_start' => '2jt+'
    ],
    [
        'id' => 29,
        'name' => 'Transportasi & Logistik',
        'icon' => '🚚',
        'color' => '#1ABC9C',
        'types' => [
            'Maskapai Penerbangan',
            'Bandara',
            'Pelabuhan',
            'Kereta Api',
            'Bus/Travel',
            'Jalan Tol',
            'Freight/Cargo',
            'Warehouse',
            '3PL Logistics'
        ],
        'solution' => 'booking-system',
        'price_start' => '5jt+'
    ],
    [
        'id' => 30,
        'name' => 'Manufaktur & Industri',
        'icon' => '🏭',
        'color' => '#95A5A6',
        'types' => [
            'Pabrik/Manufacturing',
            'Production',
            'Supplier Industri',
            'Import/Export',
            'Wholesale Industrial',
            'Chemical Industry',
            'Steel/Metal',
            'Cement',
            'Textile',
            'Automotive Parts'
        ],
        'solution' => 'company-profile',
        'price_start' => '1jt/bulan'
    ],
    [
        'id' => 31,
        'name' => 'Energi & Tambang',
        'icon' => '⚡',
        'color' => '#F39C12',
        'types' => [
            'Oil & Gas',
            'Mining/Tambang',
            'Coal/Batubara',
            'Renewable Energy',
            'Solar Power',
            'Wind Energy',
            'Geothermal',
            'Power Plant'
        ],
        'solution' => 'company-profile',
        'price_start' => '2jt/bulan'
    ],
    [
        'id' => 32,
        'name' => 'Telekomunikasi & Media',
        'icon' => '📡',
        'color' => '#3498DB',
        'types' => [
            'Telco Provider',
            'Satellite',
            'Broadcasting',
            'TV Network',
            'Radio Station',
            'Publishing House',
            'News Agency'
        ],
        'solution' => 'company-profile',
        'price_start' => '1jt/bulan'
    ],
    [
        'id' => 33,
        'name' => 'Konstruksi & Infrastruktur',
        'icon' => '🏗️',
        'color' => '#E67E22',
        'types' => [
            'EPC Contractor',
            'Developer Infrastruktur',
            'Jalan Tol',
            'Bandara',
            'Pelabuhan',
            'Bendungan',
            'High-Rise Building'
        ],
        'solution' => 'company-profile',
        'price_start' => '1jt/bulan'
    ],
    [
        'id' => 34,
        'name' => 'Kerajinan & Handicraft',
        'icon' => '🎨',
        'color' => '#9B59B6',
        'types' => [
            'Anyaman',
            'Rotan',
            'Keramik',
            'Kayu/Woodcraft',
            'Batik',
            'Tenun',
            'Souvenir Tradisional',
            'Custom Handicraft'
        ],
        'solution' => 'toko-online',
        'price_start' => '350rb/bulan'
    ],
    [
        'id' => 35,
        'name' => 'Home Industry & UMKM',
        'icon' => '🏡',
        'color' => '#E74C3C',
        'types' => [
            'Makanan Rumahan',
            'Kue/Cake',
            'Snack',
            'Minuman Kemasan',
            'Sabun Handmade',
            'Lilin Aromaterapi',
            'Kosmetik Natural'
        ],
        'solution' => 'toko-online',
        'price_start' => '150rb/bulan'
    ],
    [
        'id' => 36,
        'name' => 'Jasa Rumah Tangga',
        'icon' => '🧹',
        'color' => '#16A085',
        'types' => [
            'Laundry',
            'Cleaning Service',
            'AC Service',
            'Pest Control',
            'Plumbing/Tukang Ledeng',
            'Electrical/Listrik',
            'Jasa Pindahan',
            'Tukang Bangunan'
        ],
        'solution' => 'booking-system',
        'price_start' => '250rb/bulan'
    ],
    [
        'id' => 37,
        'name' => 'Digital Marketing',
        'icon' => '📊',
        'color' => '#2ECC71',
        'types' => [
            'SEO Services',
            'Google Ads Agency',
            'Facebook/Meta Ads',
            'Social Media Management',
            'Content Marketing',
            'Email Marketing',
            'Influencer Marketing'
        ],
        'solution' => 'company-profile',
        'price_start' => '500rb/bulan'
    ],
    [
        'id' => 38,
        'name' => 'Blockchain & Crypto',
        'icon' => '₿',
        'color' => '#F39C12',
        'types' => [
            'Crypto Wallet',
            'DeFi Platform',
            'NFT Marketplace',
            'Token Platform',
            'Staking Platform',
            'DAO',
            'Mining Pool',
            'Web3 Platform',
            'Smart Contract'
        ],
        'solution' => 'blockchain-platform',
        'price_start' => '25jt+'
    ],
    [
        'id' => 39,
        'name' => 'Gaming & Esports',
        'icon' => '🎯',
        'color' => '#9B59B6',
        'types' => [
            'Game Developer',
            'Esports Team',
            'Tournament Platform',
            'Gaming Cafe',
            'Game Store',
            'Boosting Service',
            'Top-up Game'
        ],
        'solution' => 'bisnis-digital',
        'price_start' => '1jt/bulan'
    ],
    [
        'id' => 40,
        'name' => 'Wedding Industry',
        'icon' => '💍',
        'color' => '#E91E63',
        'types' => [
            'Wedding Planner',
            'Wedding Venue',
            'Wedding Catering',
            'Dekorasi Wedding',
            'MUA Wedding',
            'Gaun Pengantin',
            'Foto/Video Wedding',
            'Souvenir Wedding'
        ],
        'solution' => 'booking-system',
        'price_start' => '500rb/bulan'
    ],
    [
        'id' => 41,
        'name' => 'Security & Safety',
        'icon' => '🔒',
        'color' => '#34495E',
        'types' => [
            'Security Guard',
            'CCTV Installation',
            'Alarm System',
            'Fire Safety',
            'Cyber Security',
            'Data Recovery',
            'Investigation'
        ],
        'solution' => 'company-profile',
        'price_start' => '500rb/bulan'
    ],
    [
        'id' => 42,
        'name' => 'Luxury & Premium',
        'icon' => '💎',
        'color' => '#FFD700',
        'types' => [
            'Luxury Hotel',
            'Private Jet',
            'Yacht Charter',
            'Luxury Car Dealer',
            'Private Banking',
            'Wealth Management',
            'High-End Products'
        ],
        'solution' => 'premium-website',
        'price_start' => '10jt+'
    ],
    [
        'id' => 43,
        'name' => 'Research & Innovation',
        'icon' => '🔬',
        'color' => '#3498DB',
        'types' => [
            'Think Tank',
            'Research Institute',
            'Scientific Journal',
            'Patent Office',
            'Innovation Hub',
            'Tech Transfer'
        ],
        'solution' => 'portal-akademik',
        'price_start' => '2jt/bulan'
    ],
    [
        'id' => 44,
        'name' => 'Seni & Budaya',
        'icon' => '🎭',
        'color' => '#E74C3C',
        'types' => [
            'Museum',
            'Opera House',
            'Symphony Orchestra',
            'Ballet',
            'Theater',
            'Cultural Center',
            'Art Gallery'
        ],
        'solution' => 'cultural-website',
        'price_start' => '750rb/bulan'
    ],
    [
        'id' => 45,
        'name' => 'Recruitment & HR',
        'icon' => '👔',
        'color' => '#2C3E50',
        'types' => [
            'Job Board',
            'Headhunter',
            'HR Consulting',
            'Payroll Service',
            'Career Counseling',
            'Training Provider'
        ],
        'solution' => 'job-portal',
        'price_start' => '5jt+'
    ],
    [
        'id' => 46,
        'name' => 'Environment & Sustainability',
        'icon' => '♻️',
        'color' => '#27AE60',
        'types' => [
            'Recycling Service',
            'Waste Management',
            'Solar Installation',
            'Green Building',
            'Eco-friendly Products',
            'Zero Waste Store'
        ],
        'solution' => 'toko-online',
        'price_start' => '350rb/bulan'
    ],
    [
        'id' => 47,
        'name' => 'Insurance & Planning',
        'icon' => '🛡️',
        'color' => '#3498DB',
        'types' => [
            'Life Insurance',
            'Health Insurance',
            'Car Insurance',
            'Travel Insurance',
            'Retirement Planning',
            'Estate Planning'
        ],
        'solution' => 'insurance-platform',
        'price_start' => '2jt/bulan'
    ],
    [
        'id' => 48,
        'name' => 'Specialty Retail',
        'icon' => '📚',
        'color' => '#9B59B6',
        'types' => [
            'Toko Buku',
            'Toko Komik',
            'Toko Mainan',
            'Toko Alat Musik',
            'Toko Kamera',
            'Vintage Shop',
            'Antique Store',
            'Collectibles'
        ],
        'solution' => 'toko-online',
        'price_start' => '350rb/bulan'
    ],
    [
        'id' => 49,
        'name' => 'Personal Services',
        'icon' => '🤝',
        'color' => '#E67E22',
        'types' => [
            'Baby Sitter',
            'Driver Pribadi',
            'Personal Assistant',
            'Massage Therapist',
            'Reflexology',
            'Personal Shopper',
            'Mystery Shopping'
        ],
        'solution' => 'booking-system',
        'price_start' => '250rb/bulan'
    ],
    [
        'id' => 50,
        'name' => 'Platform & Aggregator',
        'icon' => '🌐',
        'color' => '#1ABC9C',
        'types' => [
            'Multi-vendor Platform',
            'Price Comparison',
            'Price Monitor',
            'Cashback Platform',
            'Affiliate Network',
            'Booking Aggregator',
            'Reservation System'
        ],
        'solution' => 'platform',
        'price_start' => '15jt+'
    ]
];
?>

<style>
/* Premium Design for Categories Page */
.categories-hero {
    padding: 150px 0 80px;
    background: var(--gradient-primary);
    position: relative;
}

.search-filter-section {
    background: rgba(10, 22, 40, 0.5);
    backdrop-filter: blur(20px);
    padding: 40px 0;
    position: sticky;
    top: 80px;
    z-index: 100;
    border-bottom: 2px solid rgba(212, 175, 55, 0.2);
}

.search-box {
    max-width: 600px;
    margin: 0 auto;
    position: relative;
}

.search-box input {
    width: 100%;
    padding: 18px 60px 18px 24px;
    border: 2px solid rgba(212, 175, 55, 0.3);
    border-radius: 50px;
    background: rgba(255, 255, 255, 0.1);
    color: var(--white);
    font-size: 1.1rem;
    transition: all 0.3s ease;
}

.search-box input:focus {
    outline: none;
    border-color: var(--gold);
    background: rgba(255, 255, 255, 0.15);
    box-shadow: 0 0 30px rgba(212, 175, 55, 0.3);
}

.search-box input::placeholder {
    color: rgba(255, 255, 255, 0.5);
}

.search-box .search-icon {
    position: absolute;
    right: 24px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--gold);
    font-size: 1.5rem;
    pointer-events: none;
}

.filter-tabs {
    display: flex;
    gap: 15px;
    justify-content: center;
    flex-wrap: wrap;
    margin-top: 30px;
}

.filter-tab {
    padding: 10px 20px;
    border-radius: 25px;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(212, 175, 55, 0.2);
    color: var(--white);
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 0.9rem;
    font-weight: 600;
}

.filter-tab:hover,
.filter-tab.active {
    background: var(--gradient-gold);
    color: var(--dark-blue);
    border-color: var(--gold);
    transform: translateY(-2px);
}

.category-card {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(20px);
    border: 2px solid rgba(212, 175, 55, 0.2);
    border-radius: 20px;
    padding: 30px;
    transition: all 0.4s ease;
    height: 100%;
    cursor: pointer;
}

.category-card:hover {
    transform: translateY(-10px);
    border-color: var(--gold);
    box-shadow: 0 15px 40px rgba(212, 175, 55, 0.4);
}

.category-icon {
    font-size: 60px;
    display: block;
    margin-bottom: 20px;
    animation: float 3s ease-in-out infinite;
}

.category-name {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--white);
    margin-bottom: 20px;
}

.category-types {
    list-style: none;
    padding: 0;
    margin: 20px 0;
}

.category-types li {
    padding: 8px 0;
    color: var(--text-light);
    font-size: 0.95rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    display: flex;
    align-items: center;
}

.category-types li:before {
    content: '✓';
    color: var(--gold);
    font-weight: 700;
    margin-right: 10px;
}

.category-types li:last-child {
    border-bottom: none;
}

.category-price {
    color: var(--gold);
    font-weight: 700;
    font-size: 1.2rem;
    margin-top: 20px;
    display: block;
}

.quick-stats {
    display: flex;
    gap: 30px;
    justify-content: center;
    margin: 40px 0;
    flex-wrap: wrap;
}

.stat-item {
    text-align: center;
    padding: 20px 30px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 15px;
    border: 1px solid rgba(212, 175, 55, 0.2);
}

.stat-number {
    font-size: 3rem;
    font-weight: 800;
    color: var(--gold);
    display: block;
}

.stat-label {
    color: var(--text-light);
    font-size: 1rem;
}

@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
}

.load-more-btn {
    text-align: center;
    margin: 50px 0;
}

.hidden {
    display: none !important;
}
</style>

<!-- Hero Section -->
<section class="categories-hero">
    <div class="container text-center">
        <h1 class="display-3 fw-bold text-white mb-4" data-aos="fade-up">
            <span class="text-gold">50+</span> Jenis Website Lengkap
        </h1>
        <p class="lead text-light mb-4" data-aos="fade-up" data-aos-delay="100" style="font-size: 1.3rem; max-width: 800px; margin: 0 auto;">
            Dari Bisnis Kecil Sampai Korporat Besar<br>
            Kami Punya Solusi Website yang Tepat untuk Anda!
        </p>

        <!-- Quick Stats -->
        <div class="quick-stats" data-aos="fade-up" data-aos-delay="200">
            <div class="stat-item">
                <span class="stat-number">50+</span>
                <span class="stat-label">Kategori</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">200+</span>
                <span class="stat-label">Jenis Website</span>
            </div>
            <div class="stat-item">
                <span class="stat-number">500+</span>
                <span class="stat-label">Client Puas</span>
            </div>
        </div>
    </div>
</section>

<!-- Search & Filter Section -->
<section class="search-filter-section">
    <div class="container">
        <div class="search-box">
            <input type="text" id="searchInput" placeholder="Cari jenis website... (contoh: toko online, restoran, klinik)" autocomplete="off">
            <i class="bi bi-search search-icon"></i>
        </div>

        <div class="filter-tabs">
            <div class="filter-tab active" data-filter="all">
                <i class="bi bi-grid-3x3 me-1"></i> Semua (50)
            </div>
            <div class="filter-tab" data-filter="popular">
                <i class="bi bi-star me-1"></i> Populer
            </div>
            <div class="filter-tab" data-filter="affordable">
                <i class="bi bi-currency-dollar me-1"></i> Terjangkau
            </div>
            <div class="filter-tab" data-filter="premium">
                <i class="bi bi-gem me-1"></i> Premium
            </div>
        </div>
    </div>
</section>

<!-- Categories Grid -->
<section class="py-5" style="background: var(--dark-blue);">
    <div class="container">
        <div class="row g-4" id="categoriesGrid">
            <?php foreach($categories as $index => $category): ?>
            <div class="col-lg-4 col-md-6 category-item"
                 data-aos="fade-up"
                 data-aos-delay="<?= $index * 50 ?>"
                 data-category="<?= strtolower($category['name']) ?>"
                 data-price="<?= $category['price_start'] ?>">
                <div class="category-card" style="border-left: 4px solid <?= $category['color'] ?>;">
                    <span class="category-icon"><?= $category['icon'] ?></span>
                    <h3 class="category-name"><?= $category['name'] ?></h3>
                    <p class="text-light mb-3" style="font-size: 0.95rem; opacity: 0.8;">
                        <?= count($category['types']) ?> jenis website tersedia
                    </p>

                    <ul class="category-types">
                        <?php foreach(array_slice($category['types'], 0, 5) as $type): ?>
                        <li><?= $type ?></li>
                        <?php endforeach; ?>
                        <?php if(count($category['types']) > 5): ?>
                        <li style="color: var(--gold); border: none; padding-top: 10px;">
                            <i class="bi bi-plus-circle me-2"></i>
                            +<?= count($category['types']) - 5 ?> jenis lainnya
                        </li>
                        <?php endif; ?>
                    </ul>

                    <span class="category-price">
                        <i class="bi bi-tag me-2"></i>
                        Mulai <?= $category['price_start'] ?>
                    </span>

                    <div class="mt-3 d-flex gap-2">
                        <a href="/pages/solutions/<?= $category['solution'] ?>" class="btn btn-gold btn-sm flex-grow-1">
                            <i class="bi bi-info-circle me-1"></i> Detail
                        </a>
                        <a href="https://wa.me/<?= SITE_WHATSAPP ?>?text=Halo%20SITUNEO,%20saya%20tertarik%20dengan%20<?= urlencode($category['name']) ?>"
                           class="btn btn-outline-gold btn-sm flex-grow-1" target="_blank">
                            <i class="bi bi-whatsapp me-1"></i> Tanya
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- No Results Message -->
        <div id="noResults" class="text-center py-5 hidden">
            <i class="bi bi-search" style="font-size: 4rem; color: var(--gold); opacity: 0.3;"></i>
            <h3 class="text-white mt-3">Tidak Ada Hasil</h3>
            <p class="text-light">Coba kata kunci lain atau <a href="https://wa.me/<?= SITE_WHATSAPP ?>" class="text-gold">chat admin</a> untuk bantuan</p>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5" style="background: var(--gradient-primary);">
    <div class="container text-center">
        <h2 class="text-white fw-bold mb-4" data-aos="fade-up">
            Tidak Menemukan Yang Anda Cari?
        </h2>
        <p class="text-light mb-4" data-aos="fade-up" data-aos-delay="100" style="font-size: 1.2rem;">
            Konsultasi <strong class="text-gold">GRATIS</strong> dengan expert kami!<br>
            Kami bantu carikan solusi yang paling tepat untuk bisnis Anda
        </p>
        <div class="d-flex gap-3 justify-content-center flex-wrap" data-aos="fade-up" data-aos-delay="200">
            <a href="https://wa.me/<?= SITE_WHATSAPP ?>?text=Halo%20SITUNEO,%20saya%20butuh%20konsultasi%20untuk%20website"
               class="btn btn-lg" style="background: var(--whatsapp-green); color: white; padding: 18px 40px; font-weight: 700;" target="_blank">
                <i class="bi bi-whatsapp me-2"></i>
                Chat Admin Sekarang
            </a>
            <a href="/client/demo-request" class="btn btn-outline-light btn-lg" style="padding: 18px 40px;">
                <i class="bi bi-rocket-takeoff me-2"></i>
                Request Demo Gratis
            </a>
        </div>
    </div>
</section>

<script>
// Search Functionality
document.getElementById('searchInput').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const categories = document.querySelectorAll('.category-item');
    let visibleCount = 0;

    categories.forEach(category => {
        const categoryName = category.dataset.category;
        const categoryText = category.textContent.toLowerCase();

        if(categoryText.includes(searchTerm)) {
            category.style.display = 'block';
            visibleCount++;
        } else {
            category.style.display = 'none';
        }
    });

    // Show/hide no results message
    document.getElementById('noResults').classList.toggle('hidden', visibleCount > 0);
});

// Filter Functionality
document.querySelectorAll('.filter-tab').forEach(tab => {
    tab.addEventListener('click', function() {
        // Remove active class from all tabs
        document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
        this.classList.add('active');

        const filter = this.dataset.filter;
        const categories = document.querySelectorAll('.category-item');

        categories.forEach(category => {
            const price = category.dataset.price;
            let show = false;

            switch(filter) {
                case 'all':
                    show = true;
                    break;
                case 'popular':
                    // Show first 10 categories (most popular)
                    show = Array.from(categories).indexOf(category) < 10;
                    break;
                case 'affordable':
                    // Show items under 500rb
                    show = parseInt(price.replace(/\D/g, '')) < 500000;
                    break;
                case 'premium':
                    // Show items 1jt and above
                    show = parseInt(price.replace(/\D/g, '')) >= 1000000;
                    break;
            }

            category.style.display = show ? 'block' : 'none';
        });

        // Clear search when changing filter
        document.getElementById('searchInput').value = '';
        document.getElementById('noResults').classList.add('hidden');
    });
});
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>
