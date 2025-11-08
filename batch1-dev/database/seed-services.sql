-- ============================================================================
-- SITUNEO DIGITAL - SEED DATA FOR SERVICES, PACKAGES & WEBSITE TYPES
-- ============================================================================
-- File: seed-services.sql
-- Purpose: Populate 232+ services with DUAL PRICING system
-- Created: 2025-11-08
--
-- DUAL PRICING SYSTEM:
-- 1. BELI PUTUS (One-Time Payment): Setup fee, NO monthly, full ownership
-- 2. SEWA BULANAN (Subscription): Monthly fee, ZERO setup, rental model
-- ============================================================================

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- ============================================================================
-- SECTION 1: SERVICE CATEGORIES (10 Divisi)
-- ============================================================================

INSERT INTO `service_categories` (`id`, `name`, `slug`, `description`, `icon`, `color`, `sort_order`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Web Development', 'web-development', 'Pembuatan website profesional dari landing page hingga sistem kompleks dengan teknologi terkini', 'bi-code-square', '#1E5C99', 1, 1, NOW(), NOW()),
(2, 'Mobile App Development', 'mobile-app-development', 'Aplikasi mobile Android & iOS yang user-friendly dengan performa maksimal', 'bi-phone', '#0F3057', 2, 1, NOW(), NOW()),
(3, 'UI/UX Design', 'ui-ux-design', 'Desain antarmuka yang menarik dan pengalaman pengguna yang optimal untuk produk digital', 'bi-palette', '#FFB400', 3, 1, NOW(), NOW()),
(4, 'Digital Marketing', 'digital-marketing', 'Strategi pemasaran digital lengkap untuk meningkatkan brand awareness dan penjualan', 'bi-megaphone', '#FF6B6B', 4, 1, NOW(), NOW()),
(5, 'SEO Services', 'seo-services', 'Optimasi mesin pencari untuk ranking tinggi di Google dan traffic organik maksimal', 'bi-search', '#4ECDC4', 5, 1, NOW(), NOW()),
(6, 'Content Creation', 'content-creation', 'Pembuatan konten berkualitas tinggi untuk website, social media, dan marketing material', 'bi-file-text', '#95E1D3', 6, 1, NOW(), NOW()),
(7, 'Cloud & Hosting', 'cloud-hosting', 'Solusi hosting profesional dengan uptime 99.9% dan keamanan maksimal', 'bi-cloud', '#38A3A5', 7, 1, NOW(), NOW()),
(8, 'Maintenance & Support', 'maintenance-support', 'Pemeliharaan website dan dukungan teknis 24/7 untuk kelancaran bisnis online', 'bi-tools', '#22577A', 8, 1, NOW(), NOW()),
(9, 'E-Commerce Solutions', 'ecommerce-solutions', 'Solusi toko online lengkap dengan payment gateway dan inventory management', 'bi-cart', '#FF9F1C', 9, 1, NOW(), NOW()),
(10, 'Custom Software', 'custom-software', 'Pengembangan software custom sesuai kebutuhan bisnis spesifik perusahaan', 'bi-gear', '#2EC4B6', 10, 1, NOW(), NOW());

-- ============================================================================
-- SECTION 2: SERVICES - WEB DEVELOPMENT (30+ Services)
-- ============================================================================

INSERT INTO `services` (
    `category_id`, `name`, `slug`, `description`, `short_description`,
    `pricing_model`, `one_time_price`, `monthly_price`, `setup_fee`,
    `source_code_included`, `ownership_transfer`, `billing_cycle`, `min_commitment`,
    `delivery_time_days`, `revision_limit`, `support_duration_days`,
    `is_popular`, `is_featured`, `is_active`, `created_at`, `updated_at`
) VALUES

-- Landing Page Services
(1, 'Landing Page Basic', 'landing-page-basic',
'Landing page satu halaman untuk promosi produk/jasa dengan desain modern dan responsif. Cocok untuk campaign marketing, launching produk baru, atau event tertentu. Dilengkapi form contact dan integrasi WhatsApp.',
'Landing page 1 halaman untuk promosi produk/campaign',
'both', 350000.00, 150000.00, 0.00, 1, 1, 'monthly', 0, 3, 2, 30, 1, 0, 1, NOW(), NOW()),

(1, 'Landing Page Premium', 'landing-page-premium',
'Landing page multi-section dengan animasi menarik, video background, dan countdown timer. Ideal untuk pre-launch produk, webinar registration, atau campaign dengan konversi tinggi. Include A/B testing setup.',
'Landing page premium dengan animasi & video background',
'both', 750000.00, 250000.00, 0.00, 1, 1, 'monthly', 0, 5, 3, 60, 1, 1, 1, NOW(), NOW()),

(1, 'Landing Page E-Commerce', 'landing-page-ecommerce',
'Landing page khusus untuk produk e-commerce dengan product showcase, testimonial section, FAQ, dan checkout button langsung ke marketplace atau WA. Perfect untuk single product campaign.',
'Landing page produk e-commerce dengan checkout integration',
'both', 500000.00, 200000.00, 0.00, 1, 1, 'monthly', 0, 4, 2, 45, 0, 0, 1, NOW(), NOW()),

-- Company Profile Services
(1, 'Company Profile 5 Halaman', 'company-profile-5-pages',
'Website company profile 5 halaman standar: Home, About Us, Services, Portfolio, Contact. Desain profesional cocok untuk UMKM dan startup yang ingin tampil kredibel di dunia digital.',
'Website perusahaan 5 halaman standar profesional',
'both', 1500000.00, 300000.00, 0.00, 1, 1, 'monthly', 0, 7, 3, 90, 1, 1, 1, NOW(), NOW()),

(1, 'Company Profile 10 Halaman', 'company-profile-10-pages',
'Website company profile lengkap 10+ halaman dengan blog section, team showcase, client testimonials, dan FAQ. Cocok untuk perusahaan menengah yang butuh presence profesional.',
'Website perusahaan 10+ halaman dengan blog & portfolio',
'both', 2500000.00, 350000.00, 0.00, 1, 1, 'monthly', 0, 10, 3, 120, 1, 1, 1, NOW(), NOW()),

(1, 'Company Profile Enterprise', 'company-profile-enterprise',
'Website corporate premium unlimited halaman dengan multi-language, advanced SEO, career portal, news section, dan annual report download. Untuk perusahaan besar dan multinasional.',
'Website corporate premium multi-language & advanced features',
'both', 5000000.00, 500000.00, 0.00, 1, 1, 'monthly', 0, 21, 5, 365, 0, 1, 1, NOW(), NOW()),

-- Portfolio & Creative Services
(1, 'Portfolio Personal', 'portfolio-personal',
'Website portfolio untuk freelancer, fotografer, desainer, atau profesional kreatif. Galeri foto/video berkualitas tinggi, about me section, dan contact form. Mobile-friendly.',
'Portfolio website untuk freelancer & profesional kreatif',
'both', 800000.00, 200000.00, 0.00, 1, 1, 'monthly', 0, 5, 2, 60, 0, 0, 1, NOW(), NOW()),

(1, 'Portfolio Agency', 'portfolio-agency',
'Website portfolio untuk creative agency dengan case study detail, team showcase, client logos, dan testimonials. Include project filtering dan smooth animations.',
'Portfolio agency dengan case study & client showcase',
'both', 3000000.00, 400000.00, 0.00, 1, 1, 'monthly', 0, 14, 4, 180, 0, 1, 1, NOW(), NOW()),

(1, 'Portfolio Fotografer/Videografer', 'portfolio-photographer',
'Website portfolio khusus untuk fotografer & videografer dengan full-screen gallery, lightbox viewer, video player integration, dan online booking system untuk client.',
'Portfolio fotografer dengan gallery & booking system',
'both', 1200000.00, 250000.00, 0.00, 1, 1, 'monthly', 0, 7, 3, 90, 1, 0, 1, NOW(), NOW()),

-- Blog & Magazine Services
(1, 'Blog Personal', 'blog-personal',
'Website blog personal untuk menulis artikel, diary, atau sharing knowledge. Dilengkapi kategori, tag, komentar, dan social share. Perfect untuk content creator pemula.',
'Blog personal dengan kategori & sistem komentar',
'both', 600000.00, 150000.00, 0.00, 1, 1, 'monthly', 0, 4, 2, 30, 0, 0, 1, NOW(), NOW()),

(1, 'Blog Multi-Author', 'blog-multi-author',
'Platform blog untuk beberapa penulis dengan author management, editorial workflow, dan content scheduling. Cocok untuk media online atau blog tim.',
'Blog platform untuk multiple author dengan editorial system',
'both', 2000000.00, 350000.00, 0.00, 1, 1, 'monthly', 0, 10, 3, 120, 0, 0, 1, NOW(), NOW()),

(1, 'News/Magazine Portal', 'news-magazine-portal',
'Portal berita atau magazine online lengkap dengan breaking news system, multiple categories, advertisement management, dan subscriber newsletter. Ready untuk monetization.',
'Portal berita lengkap dengan ads & newsletter system',
'both', 4500000.00, 450000.00, 0.00, 1, 1, 'monthly', 0, 21, 4, 180, 0, 1, 1, NOW(), NOW()),

-- E-Learning & Educational Services
(1, 'Website Sekolah Basic', 'school-website-basic',
'Website sekolah dasar dengan informasi profil, galeri kegiatan, pengumuman, dan kontak. Cocok untuk TK, SD, SMP yang butuh presence online sederhana.',
'Website sekolah basic dengan info & galeri',
'both', 1800000.00, 300000.00, 0.00, 1, 1, 'monthly', 0, 10, 3, 90, 0, 0, 1, NOW(), NOW()),

(1, 'Website Sekolah Advanced', 'school-website-advanced',
'Website sekolah lengkap dengan student/parent portal, online payment SPP, academic calendar, e-library, dan online enrollment system. Terintegrasi dengan sistem akademik.',
'Website sekolah dengan portal siswa & payment system',
'both', 6000000.00, 600000.00, 0.00, 1, 1, 'monthly', 0, 30, 5, 365, 0, 1, 1, NOW(), NOW()),

(1, 'Platform E-Learning', 'elearning-platform',
'Platform pembelajaran online dengan video courses, quiz system, progress tracking, certificate generation, dan payment gateway. Support instructor & student roles.',
'Platform e-learning dengan courses & certificate',
'both', 8000000.00, 750000.00, 0.00, 1, 1, 'monthly', 0, 45, 5, 365, 0, 1, 1, NOW(), NOW()),

-- Business & Professional Services
(1, 'Website Klinik/Rumah Sakit', 'clinic-hospital-website',
'Website untuk klinik atau rumah sakit dengan informasi dokter, jadwal praktek, layanan medis, online appointment booking, dan article kesehatan. HIPAA compliant ready.',
'Website klinik dengan appointment booking system',
'both', 3500000.00, 400000.00, 0.00, 1, 1, 'monthly', 0, 14, 4, 180, 1, 1, 1, NOW(), NOW()),

(1, 'Website Hotel/Villa', 'hotel-villa-website',
'Website booking hotel atau villa dengan room showcase, availability calendar, online reservation system, payment gateway, dan review management. Include channel manager.',
'Website hotel dengan booking & payment system',
'both', 4000000.00, 450000.00, 0.00, 1, 1, 'monthly', 0, 21, 4, 180, 0, 1, 1, NOW(), NOW()),

(1, 'Website Restaurant/Cafe', 'restaurant-cafe-website',
'Website untuk restoran atau cafe dengan digital menu, online ordering, table reservation, promo section, dan galeri foto makanan. Terintegrasi dengan delivery platform.',
'Website restoran dengan online ordering & reservation',
'both', 2500000.00, 350000.00, 0.00, 1, 1, 'monthly', 0, 10, 3, 120, 1, 0, 1, NOW(), NOW()),

(1, 'Website Properti', 'property-website',
'Website listing properti dengan advanced search filter, virtual tour, mortgage calculator, agent directory, dan lead management. Perfect untuk developer atau agency properti.',
'Website properti dengan listing & virtual tour',
'both', 5500000.00, 550000.00, 0.00, 1, 1, 'monthly', 0, 30, 5, 365, 0, 1, 1, NOW(), NOW()),

(1, 'Website Event Organizer', 'event-organizer-website',
'Website untuk EO dengan portfolio event, service packages, online booking, vendor directory, dan event gallery. Include countdown timer untuk upcoming events.',
'Website EO dengan booking & event showcase',
'both', 2800000.00, 350000.00, 0.00, 1, 1, 'monthly', 0, 12, 3, 120, 0, 0, 1, NOW(), NOW()),

-- Membership & Community Services
(1, 'Website Membership Basic', 'membership-basic',
'Website dengan sistem member basic: registration, login, member-only content, dan profile management. Cocok untuk komunitas atau club sederhana.',
'Website membership dengan protected content',
'both', 3000000.00, 400000.00, 0.00, 1, 1, 'monthly', 0, 14, 4, 120, 0, 0, 1, NOW(), NOW()),

(1, 'Website Membership Premium', 'membership-premium',
'Platform membership lengkap dengan tiered subscription, recurring payment, exclusive content per level, member directory, dan private forum/discussion.',
'Platform membership dengan subscription tiers',
'both', 7000000.00, 650000.00, 0.00, 1, 1, 'monthly', 0, 35, 5, 365, 0, 1, 1, NOW(), NOW()),

(1, 'Forum/Community Website', 'forum-community',
'Website forum komunitas dengan discussion boards, user reputation system, private messaging, moderation tools, dan gamification features (badges, points).',
'Forum komunitas dengan reputation & gamification',
'both', 4500000.00, 500000.00, 0.00, 1, 1, 'monthly', 0, 21, 4, 180, 0, 0, 1, NOW(), NOW()),

-- Non-Profit & Government
(1, 'Website Yayasan/NGO', 'ngo-foundation-website',
'Website untuk yayasan atau NGO dengan program showcase, donation system, volunteer registration, transparency report, dan impact stories. Tax-deductible receipt ready.',
'Website NGO dengan donation & program management',
'both', 3500000.00, 400000.00, 0.00, 1, 1, 'monthly', 0, 14, 4, 180, 0, 1, 1, NOW(), NOW()),

(1, 'Website Masjid/Gereja', 'religious-website',
'Website untuk tempat ibadah dengan jadwal kegiatan, kajian/sermon archive, donation/infaq system, galeri kegiatan, dan online registration untuk event.',
'Website tempat ibadah dengan jadwal & donation',
'both', 2000000.00, 300000.00, 0.00, 1, 1, 'monthly', 0, 10, 3, 120, 0, 0, 1, NOW(), NOW()),

(1, 'Website Pemerintahan', 'government-website',
'Website instansi pemerintahan dengan info publik, layanan online, pengaduan masyarakat, berita daerah, dan transparency dashboard. Comply dengan standar SPBE.',
'Website pemerintah dengan layanan publik online',
'both', 8500000.00, 800000.00, 0.00, 1, 1, 'monthly', 0, 45, 5, 365, 0, 1, 1, NOW(), NOW()),

-- Specialized Web Apps
(1, 'Web App CRM', 'web-app-crm',
'Aplikasi web CRM (Customer Relationship Management) untuk manage leads, customers, sales pipeline, dan task management. Multi-user dengan role permissions.',
'Web app CRM dengan sales pipeline management',
'both', 12000000.00, 900000.00, 0.00, 1, 1, 'monthly', 0, 60, 5, 365, 0, 1, 1, NOW(), NOW()),

(1, 'Web App Inventory', 'web-app-inventory',
'Sistem inventory management berbasis web untuk track stok barang, purchase orders, stock alerts, barcode scanning, dan laporan inventory real-time.',
'Web app inventory dengan barcode & stock alerts',
'both', 10000000.00, 850000.00, 0.00, 1, 1, 'monthly', 0, 50, 5, 365, 0, 1, 1, NOW(), NOW()),

(1, 'Web App HR Management', 'web-app-hrm',
'Sistem HRIS lengkap dengan employee database, attendance tracking, payroll calculation, leave management, performance review, dan recruitment module.',
'Web app HRM dengan payroll & attendance',
'both', 15000000.00, 1000000.00, 0.00, 1, 1, 'monthly', 0, 75, 5, 365, 0, 1, 1, NOW(), NOW()),

(1, 'Web App Accounting', 'web-app-accounting',
'Aplikasi akuntansi berbasis web dengan general ledger, accounts payable/receivable, bank reconciliation, financial reports, dan tax calculation.',
'Web app accounting dengan financial reports',
'both', 18000000.00, 1200000.00, 0.00, 1, 1, 'monthly', 0, 90, 5, 365, 0, 1, 1, NOW(), NOW()),

(1, 'Custom Web Application', 'custom-web-application',
'Pengembangan aplikasi web custom sesuai kebutuhan bisnis spesifik. Full consultation, planning, development, testing, dan deployment. Include maintenance 1 tahun.',
'Aplikasi web custom sesuai kebutuhan bisnis',
'both', 25000000.00, 1500000.00, 0.00, 1, 1, 'monthly', 0, 120, 10, 365, 0, 1, 1, NOW(), NOW());

-- ============================================================================
-- SECTION 3: SERVICES - MOBILE APP DEVELOPMENT (25+ Services)
-- ============================================================================

INSERT INTO `services` (
    `category_id`, `name`, `slug`, `description`, `short_description`,
    `pricing_model`, `one_time_price`, `monthly_price`, `setup_fee`,
    `source_code_included`, `ownership_transfer`, `billing_cycle`, `min_commitment`,
    `delivery_time_days`, `revision_limit`, `support_duration_days`,
    `is_popular`, `is_featured`, `is_active`, `created_at`, `updated_at`
) VALUES

-- Android App Services
(2, 'Android App Simple', 'android-app-simple',
'Aplikasi Android sederhana 3-5 screen untuk keperluan bisnis dasar seperti catalog produk, company profile mobile, atau informasi layanan. Native Android dengan performa optimal.',
'Android app sederhana 3-5 screen native',
'both', 3500000.00, 400000.00, 0.00, 1, 1, 'monthly', 0, 21, 3, 180, 0, 0, 1, NOW(), NOW()),

(2, 'Android App E-Commerce', 'android-app-ecommerce',
'Aplikasi e-commerce Android lengkap dengan product catalog, shopping cart, checkout, payment gateway, order tracking, dan push notifications. Ready publish ke Play Store.',
'Android e-commerce dengan payment & notifications',
'both', 8000000.00, 750000.00, 0.00, 1, 1, 'monthly', 0, 45, 5, 365, 1, 1, 1, NOW(), NOW()),

(2, 'Android App Food Delivery', 'android-app-food-delivery',
'Aplikasi food delivery lengkap 3 panel: Customer, Driver, Restaurant. Realtime order tracking, in-app chat, payment integration, dan rating system.',
'Food delivery app 3 panel dengan realtime tracking',
'both', 15000000.00, 1200000.00, 0.00, 1, 1, 'monthly', 0, 90, 5, 365, 0, 1, 1, NOW(), NOW()),

(2, 'Android App Ride-Hailing', 'android-app-ride-hailing',
'Aplikasi ojek online/taxi seperti Gojek/Grab dengan 2 app (Customer & Driver), GPS tracking, fare calculation, in-app payment, dan admin dashboard.',
'Ride-hailing app dengan GPS & fare calculation',
'both', 20000000.00, 1500000.00, 0.00, 1, 1, 'monthly', 0, 120, 5, 365, 0, 1, 1, NOW(), NOW()),

(2, 'Android App Social Media', 'android-app-social-media',
'Aplikasi social media dengan features: post feed, stories, messaging, follow system, like/comment, dan media upload. Scalable architecture.',
'Social media app dengan post, stories & messaging',
'both', 18000000.00, 1400000.00, 0.00, 1, 1, 'monthly', 0, 105, 5, 365, 0, 1, 1, NOW(), NOW()),

-- iOS App Services
(2, 'iOS App Simple', 'ios-app-simple',
'Aplikasi iOS sederhana 3-5 screen native Swift/SwiftUI untuk catalog, portfolio, atau company profile. Mengikuti Apple Human Interface Guidelines.',
'iOS app sederhana native Swift 3-5 screen',
'both', 4000000.00, 450000.00, 0.00, 1, 1, 'monthly', 0, 21, 3, 180, 0, 0, 1, NOW(), NOW()),

(2, 'iOS App E-Commerce', 'ios-app-ecommerce',
'Aplikasi e-commerce iOS dengan Apple Pay integration, product catalog, shopping cart, secure checkout, dan push notifications. Ready submit ke App Store.',
'iOS e-commerce dengan Apple Pay integration',
'both', 9000000.00, 800000.00, 0.00, 1, 1, 'monthly', 0, 50, 5, 365, 1, 1, 1, NOW(), NOW()),

(2, 'iOS App Premium', 'ios-app-premium',
'Aplikasi iOS premium dengan advanced features: Core ML integration, ARKit, HealthKit, atau Apple Watch companion app. Enterprise-grade quality.',
'iOS premium dengan ML, AR, atau Watch integration',
'both', 25000000.00, 1800000.00, 0.00, 1, 1, 'monthly', 0, 120, 5, 365, 0, 1, 1, NOW(), NOW()),

-- Cross-Platform App Services
(2, 'Flutter App Basic', 'flutter-app-basic',
'Aplikasi cross-platform dengan Flutter untuk Android & iOS dari 1 codebase. Cocok untuk MVP atau startup dengan budget efisien. UI modern dan performa native-like.',
'Cross-platform Flutter app untuk Android & iOS',
'both', 5000000.00, 500000.00, 0.00, 1, 1, 'monthly', 0, 30, 4, 240, 1, 1, 1, NOW(), NOW()),

(2, 'Flutter App E-Commerce', 'flutter-app-ecommerce',
'Toko online cross-platform Flutter dengan product management, cart, checkout, multi payment methods, order tracking, dan admin panel web. 1 kode untuk 2 platform.',
'Flutter e-commerce untuk Android & iOS sekaligus',
'both', 10000000.00, 900000.00, 0.00, 1, 1, 'monthly', 0, 60, 5, 365, 1, 1, 1, NOW(), NOW()),

(2, 'React Native App', 'react-native-app',
'Aplikasi cross-platform dengan React Native, share code dengan web app jika ada. Perfect untuk tim yang sudah familiar dengan React ecosystem.',
'React Native app cross-platform dengan code sharing',
'both', 5500000.00, 550000.00, 0.00, 1, 1, 'monthly', 0, 35, 4, 240, 0, 0, 1, NOW(), NOW()),

-- Hybrid Web Apps
(2, 'PWA (Progressive Web App)', 'progressive-web-app',
'Progressive Web App yang bisa di-install seperti native app, work offline, dan dapat push notifications. Budget-friendly alternative untuk native apps.',
'PWA installable dengan offline support',
'both', 3000000.00, 350000.00, 0.00, 1, 1, 'monthly', 0, 21, 3, 180, 1, 0, 1, NOW(), NOW()),

(2, 'Hybrid App Ionic', 'hybrid-app-ionic',
'Aplikasi hybrid dengan Ionic framework menggunakan web technologies. Deploy ke Android, iOS, dan Web dari satu codebase. Cost-effective solution.',
'Hybrid app Ionic untuk 3 platform sekaligus',
'both', 4500000.00, 450000.00, 0.00, 1, 1, 'monthly', 0, 28, 4, 240, 0, 0, 1, NOW(), NOW()),

-- Specialized Mobile Apps
(2, 'Mobile App Gaming', 'mobile-game-app',
'Game mobile casual dengan Unity atau native engine. Include game design, level design, monetization setup (ads/IAP), dan analytics integration.',
'Mobile game app dengan monetization',
'both', 15000000.00, 1200000.00, 0.00, 1, 1, 'monthly', 0, 90, 5, 365, 0, 1, 1, NOW(), NOW()),

(2, 'Mobile App Fitness', 'mobile-app-fitness',
'Aplikasi fitness/health dengan workout tracking, meal planner, progress photos, calorie counter, dan integration dengan wearables (Apple Watch, Fitbit).',
'Fitness app dengan workout & meal tracking',
'both', 12000000.00, 1000000.00, 0.00, 1, 1, 'monthly', 0, 75, 5, 365, 0, 0, 1, NOW(), NOW()),

(2, 'Mobile App Finance', 'mobile-app-finance',
'Aplikasi finance management dengan expense tracking, budget planning, bill reminders, financial reports, dan bank account integration. Secure & encrypted.',
'Finance app dengan expense & budget tracking',
'both', 14000000.00, 1100000.00, 0.00, 1, 1, 'monthly', 0, 80, 5, 365, 0, 1, 1, NOW(), NOW()),

(2, 'Mobile App Education', 'mobile-app-education',
'Aplikasi edukasi dengan video lessons, quiz/test, progress tracking, gamification, dan certificate generation. Support multiple student accounts.',
'Education app dengan lessons & certificates',
'both', 10000000.00, 900000.00, 0.00, 1, 1, 'monthly', 0, 60, 5, 365, 0, 0, 1, NOW(), NOW()),

(2, 'Mobile App Real Estate', 'mobile-app-real-estate',
'Aplikasi properti dengan listing search, map view, virtual tour, mortgage calculator, favorite properties, dan agent chat. Include admin panel.',
'Real estate app dengan virtual tour & calculator',
'both', 11000000.00, 950000.00, 0.00, 1, 1, 'monthly', 0, 70, 5, 365, 0, 0, 1, NOW(), NOW()),

(2, 'Mobile App Booking', 'mobile-app-booking',
'Aplikasi booking serbaguna untuk salon, spa, klinik, hotel, atau appointment-based business. Calendar integration, payment, dan reminder notifications.',
'Booking app dengan calendar & payment integration',
'both', 9000000.00, 800000.00, 0.00, 1, 1, 'monthly', 0, 55, 5, 365, 1, 0, 1, NOW(), NOW()),

(2, 'Mobile App Streaming', 'mobile-app-streaming',
'Aplikasi streaming video/audio dengan HLS support, subscription model, download for offline, chromecast support, dan content management dashboard.',
'Streaming app dengan offline download & cast',
'both', 16000000.00, 1300000.00, 0.00, 1, 1, 'monthly', 0, 95, 5, 365, 0, 1, 1, NOW(), NOW()),

-- Enterprise Mobile Solutions
(2, 'Enterprise Mobile App', 'enterprise-mobile-app',
'Aplikasi enterprise untuk karyawan internal dengan features: employee portal, task management, document sharing, attendance, dan integration dengan ERP/CRM.',
'Enterprise app dengan ERP/CRM integration',
'both', 22000000.00, 1600000.00, 0.00, 1, 1, 'monthly', 0, 120, 5, 365, 0, 1, 1, NOW(), NOW()),

(2, 'Mobile App IoT Integration', 'mobile-app-iot',
'Aplikasi mobile untuk kontrol IoT devices dengan BLE, WiFi, atau cloud integration. Smart home, industrial monitoring, atau agriculture automation.',
'IoT mobile app dengan device control',
'both', 18000000.00, 1400000.00, 0.00, 1, 1, 'monthly', 0, 105, 5, 365, 0, 1, 1, NOW(), NOW()),

-- App Maintenance & Updates
(2, 'App Redesign & Modernization', 'app-redesign',
'Redesign aplikasi existing ke modern UI/UX, upgrade technology stack, improve performance, dan add new features. Make old app relevant again.',
'Redesign & modernisasi aplikasi lama',
'both', 12000000.00, 1000000.00, 0.00, 1, 1, 'monthly', 0, 75, 5, 365, 0, 0, 1, NOW(), NOW()),

(2, 'App Migration to New Platform', 'app-migration',
'Migrasi aplikasi dari platform lama ke baru (eg: Native to Flutter, Ionic to React Native) dengan code refactoring dan feature parity.',
'Migrasi app ke platform/technology baru',
'both', 15000000.00, 1200000.00, 0.00, 1, 1, 'monthly', 0, 90, 5, 365, 0, 0, 1, NOW(), NOW()),

(2, 'Custom Mobile Solution', 'custom-mobile-solution',
'Solusi mobile custom untuk kebutuhan bisnis spesifik dengan consultation lengkap, prototyping, development, testing, deployment, dan support 1 tahun.',
'Mobile solution custom untuk bisnis spesifik',
'both', 30000000.00, 2000000.00, 0.00, 1, 1, 'monthly', 0, 150, 10, 365, 0, 1, 1, NOW(), NOW());

-- ============================================================================
-- Continue with more categories... (I'll create this in parts to stay organized)
-- This seed file will be very long - let me add UI/UX Design services next
-- ============================================================================

-- ============================================================================
-- SECTION 4: SERVICES - UI/UX DESIGN (20+ Services)
-- ============================================================================

INSERT INTO `services` (
    `category_id`, `name`, `slug`, `description`, `short_description`,
    `pricing_model`, `one_time_price`, `monthly_price`, `setup_fee`,
    `source_code_included`, `ownership_transfer`, `billing_cycle`, `min_commitment`,
    `delivery_time_days`, `revision_limit`, `support_duration_days`,
    `is_popular`, `is_featured`, `is_active`, `created_at`, `updated_at`
) VALUES

-- UI Design Services
(3, 'UI Design Landing Page', 'ui-design-landing-page',
'Desain UI untuk landing page dengan 3 variasi konsep, high-fidelity mockup di Figma, prototype interaktif, dan design handoff untuk developer. Mobile & desktop version.',
'UI design landing page 3 konsep + prototype',
'both', 800000.00, 200000.00, 0.00, 1, 1, 'monthly', 0, 5, 3, 30, 1, 0, 1, NOW(), NOW()),

(3, 'UI Design Website 5-10 Pages', 'ui-design-website-medium',
'Desain UI komprehensif untuk website 5-10 halaman dengan design system, component library, typography guide, dan color palette. Full responsive design.',
'UI design 5-10 pages dengan design system',
'both', 2500000.00, 350000.00, 0.00, 1, 1, 'monthly', 0, 10, 4, 60, 1, 1, 1, NOW(), NOW()),

(3, 'UI Design Website Complex', 'ui-design-website-complex',
'Desain UI untuk website kompleks 20+ halaman dengan complete design system, atomic design methodology, interactive prototype, dan developer collaboration.',
'UI design 20+ pages atomic design methodology',
'both', 6000000.00, 650000.00, 0.00, 1, 1, 'monthly', 0, 21, 5, 90, 0, 1, 1, NOW(), NOW()),

(3, 'UI Design Mobile App', 'ui-design-mobile-app',
'Desain UI mobile app 10-15 screens dengan user flow, wireframes, high-fidelity design, micro-interactions, dan clickable prototype. iOS & Android guidelines.',
'UI design mobile 10-15 screens + prototype',
'both', 3500000.00, 400000.00, 0.00, 1, 1, 'monthly', 0, 14, 4, 60, 1, 1, 1, NOW(), NOW()),

(3, 'UI Design Dashboard/Admin Panel', 'ui-design-dashboard',
'Desain UI untuk dashboard atau admin panel dengan data visualization, charts, tables, filters, dan dark/light mode. Focus on usability & data clarity.',
'UI design dashboard dengan data visualization',
'both', 4000000.00, 450000.00, 0.00, 1, 1, 'monthly', 0, 14, 4, 90, 0, 0, 1, NOW(), NOW()),

-- UX Services
(3, 'UX Research & Analysis', 'ux-research-analysis',
'UX research lengkap: competitor analysis, user persona development, user journey mapping, pain points identification, dan strategic recommendations.',
'UX research dengan persona & journey mapping',
'both', 3000000.00, 400000.00, 0.00, 1, 1, 'monthly', 0, 10, 2, 30, 0, 0, 1, NOW(), NOW()),

(3, 'UX Audit & Consultation', 'ux-audit-consultation',
'Audit UX untuk website/app existing dengan heuristic evaluation, usability testing, accessibility check, dan actionable improvement recommendations.',
'UX audit dengan usability testing & report',
'both', 2500000.00, 350000.00, 0.00, 1, 1, 'monthly', 0, 7, 2, 30, 1, 0, 1, NOW(), NOW()),

(3, 'User Testing & Validation', 'user-testing-validation',
'Usability testing dengan real users (5-10 participants), task scenarios, observation, feedback collection, dan detailed report dengan video recordings.',
'User testing 5-10 participants dengan report',
'both', 4500000.00, 500000.00, 0.00, 1, 1, 'monthly', 0, 14, 1, 30, 0, 0, 1, NOW(), NOW()),

(3, 'Information Architecture', 'information-architecture',
'Pembuatan information architecture: sitemap, content structure, navigation design, taxonomy development, dan card sorting sessions.',
'IA dengan sitemap & navigation design',
'both', 2000000.00, 300000.00, 0.00, 1, 1, 'monthly', 0, 7, 3, 30, 0, 0, 1, NOW(), NOW()),

(3, 'Wireframing & Prototyping', 'wireframing-prototyping',
'Low & mid-fidelity wireframes untuk seluruh flow, interactive prototype di Figma/Adobe XD, dan user flow documentation. Pre-design phase essential.',
'Wireframes & interactive prototype lengkap',
'both', 1800000.00, 280000.00, 0.00, 1, 1, 'monthly', 0, 7, 3, 30, 1, 0, 1, NOW(), NOW()),

-- Specialized Design Services
(3, 'Design System Creation', 'design-system-creation',
'Pembuatan design system lengkap: component library, typography scale, color system, spacing/grid, icons, illustrations, dan documentation di Figma.',
'Design system komprehensif dengan documentation',
'both', 8000000.00, 750000.00, 0.00, 1, 1, 'monthly', 0, 30, 3, 90, 0, 1, 1, NOW(), NOW()),

(3, 'Brand Identity Design', 'brand-identity-design',
'Desain identitas brand lengkap: logo design (3 konsep), brand guidelines, color palette, typography, business card, letterhead, dan brand application.',
'Brand identity dengan logo & guidelines',
'both', 5000000.00, 550000.00, 0.00, 1, 1, 'monthly', 0, 14, 5, 60, 1, 1, 1, NOW(), NOW()),

(3, 'Logo Design Only', 'logo-design-only',
'Desain logo profesional dengan 5 konsep awal, unlimited revisi hingga approved, file vector (AI, EPS, SVG), dan basic brand guidelines.',
'Logo design 5 konsep unlimited revision',
'both', 1500000.00, 250000.00, 0.00, 1, 1, 'monthly', 0, 7, 999, 30, 1, 0, 1, NOW(), NOW()),

(3, 'Illustration & Icon Design', 'illustration-icon-design',
'Custom illustration atau icon set untuk website/app dengan style konsisten. Include berbagai format (SVG, PNG) dan usage guidelines.',
'Custom illustration & icon set',
'both', 2500000.00, 320000.00, 0.00, 1, 1, 'monthly', 0, 10, 3, 30, 0, 0, 1, NOW(), NOW()),

(3, 'Motion Design & Animation', 'motion-design-animation',
'Micro-interactions, loading animations, transitions, dan motion graphics untuk website atau app. Export to Lottie, GIF, or video format.',
'Motion design & micro-interactions',
'both', 3500000.00, 400000.00, 0.00, 1, 1, 'monthly', 0, 14, 3, 30, 0, 0, 1, NOW(), NOW()),

-- E-Commerce Design
(3, 'E-Commerce UI/UX Design', 'ecommerce-ui-ux-design',
'Complete UI/UX design untuk toko online dengan product listing, detail page, cart, checkout flow optimization, dan mobile-first approach.',
'E-commerce design dengan checkout optimization',
'both', 5500000.00, 600000.00, 0.00, 1, 1, 'monthly', 0, 21, 4, 90, 1, 1, 1, NOW(), NOW()),

(3, 'Marketplace Design', 'marketplace-design',
'Design untuk marketplace 2-sided (buyer & seller) dengan vendor dashboard, product management, order management, dan admin control panel.',
'Marketplace design buyer-seller 2-sided',
'both', 12000000.00, 1000000.00, 0.00, 1, 1, 'monthly', 0, 45, 5, 120, 0, 1, 1, NOW(), NOW()),

-- Redesign Services
(3, 'Website Redesign', 'website-redesign',
'Redesign complete untuk website existing dengan modern aesthetics, improved UX, responsive layout, dan accessibility compliance. Keep SEO structure.',
'Website redesign modern dengan improved UX',
'both', 4000000.00, 450000.00, 0.00, 1, 1, 'monthly', 0, 14, 4, 60, 1, 0, 1, NOW(), NOW()),

(3, 'App Redesign', 'app-redesign-ui',
'Redesign mobile app dengan fresh look, improved navigation, modern interactions, dan user feedback implementation. Maintain feature parity.',
'App redesign dengan improved navigation',
'both', 5000000.00, 550000.00, 0.00, 1, 1, 'monthly', 0, 21, 4, 60, 0, 0, 1, NOW(), NOW()),

(3, 'UI Modernization', 'ui-modernization',
'Update UI lama ke modern design trends tanpa ubah struktur besar. Quick refresh untuk product yang perlu facelift cepat.',
'UI modernization quick refresh',
'both', 2000000.00, 300000.00, 0.00, 1, 1, 'monthly', 0, 7, 3, 30, 0, 0, 1, NOW(), NOW());

-- ============================================================================
-- SECTION 5: SERVICES - DIGITAL MARKETING (30+ Services)
-- ============================================================================

INSERT INTO `services` (
    `category_id`, `name`, `slug`, `description`, `short_description`,
    `pricing_model`, `one_time_price`, `monthly_price`, `setup_fee`,
    `source_code_included`, `ownership_transfer`, `billing_cycle`, `min_commitment`,
    `delivery_time_days`, `revision_limit`, `support_duration_days`,
    `is_popular`, `is_featured`, `is_active`, `created_at`, `updated_at`
) VALUES

-- Social Media Marketing
(4, 'Social Media Management Basic', 'smm-basic',
'Pengelolaan 2 platform social media (IG + FB) dengan 12 post per bulan, caption writing, hashtag research, dan monthly analytics report. Cocok untuk UMKM.',
'Kelola 2 sosmed 12 post/bulan dengan report',
'subscription_only', 0.00, 1500000.00, 250000.00, 0, 0, 'monthly', 3, 30, 2, 30, 1, 0, 1, NOW(), NOW()),

(4, 'Social Media Management Premium', 'smm-premium',
'Pengelolaan 4 platform (IG, FB, TikTok, Twitter) dengan 20 post/bulan, reels/video content, engagement management, community building, dan detailed analytics.',
'Kelola 4 sosmed 20 post dengan video content',
'subscription_only', 0.00, 3500000.00, 500000.00, 0, 0, 'monthly', 3, 30, 3, 30, 1, 1, 1, NOW(), NOW()),

(4, 'Instagram Growth Campaign', 'instagram-growth',
'Campaign khusus growth Instagram: content strategy, daily posting, story engagement, collaboration setup, influencer outreach, dan follower analytics.',
'Campaign Instagram growth dengan daily posting',
'subscription_only', 0.00, 2500000.00, 350000.00, 0, 0, 'monthly', 3, 30, 2, 30, 1, 0, 1, NOW(), NOW()),

(4, 'TikTok Marketing Strategy', 'tiktok-marketing',
'TikTok marketing lengkap: trend analysis, video concept creation, editing, posting schedule, hashtag strategy, dan viral content optimization.',
'TikTok marketing dengan viral optimization',
'subscription_only', 0.00, 2000000.00, 300000.00, 0, 0, 'monthly', 3, 30, 2, 30, 1, 1, 1, NOW(), NOW()),

(4, 'YouTube Channel Management', 'youtube-management',
'Pengelolaan channel YouTube: video SEO, thumbnail design, description optimization, playlist organization, analytics, dan monetization strategy.',
'YouTube management dengan monetization strategy',
'subscription_only', 0.00, 3000000.00, 400000.00, 0, 0, 'monthly', 6, 30, 2, 30, 0, 0, 1, NOW(), NOW()),

-- Paid Advertising
(4, 'Google Ads Campaign', 'google-ads-campaign',
'Setup dan management Google Ads (Search, Display, Shopping) dengan keyword research, ad copywriting, bid optimization, dan conversion tracking.',
'Google Ads dengan conversion tracking',
'subscription_only', 0.00, 2500000.00, 500000.00, 0, 0, 'monthly', 3, 7, 3, 30, 1, 1, 1, NOW(), NOW()),

(4, 'Facebook/Instagram Ads', 'facebook-instagram-ads',
'Meta Ads campaign dengan audience targeting, creative design, A/B testing, retargeting setup, dan performance optimization. Include ad spend recommendation.',
'Meta Ads dengan retargeting & A/B testing',
'subscription_only', 0.00, 2000000.00, 400000.00, 0, 0, 'monthly', 3, 7, 3, 30, 1, 1, 1, NOW(), NOW()),

(4, 'TikTok Ads Campaign', 'tiktok-ads',
'TikTok Ads management dengan video ad creation, trend-based targeting, conversion optimization, dan ROI tracking. Perfect untuk brand awareness.',
'TikTok Ads dengan video creation & ROI tracking',
'subscription_only', 0.00, 2200000.00, 350000.00, 0, 0, 'monthly', 3, 7, 3, 30, 1, 0, 1, NOW(), NOW()),

(4, 'LinkedIn Ads B2B', 'linkedin-ads-b2b',
'LinkedIn Ads untuk B2B marketing dengan professional targeting, lead gen forms, InMail campaigns, dan account-based marketing strategy.',
'LinkedIn Ads B2B dengan lead generation',
'subscription_only', 0.00, 3000000.00, 500000.00, 0, 0, 'monthly', 3, 7, 2, 30, 0, 0, 1, NOW(), NOW()),

(4, 'Multi-Platform Ads Management', 'multi-platform-ads',
'Integrated ads management di Google, Meta, TikTok, LinkedIn dengan unified dashboard, cross-platform optimization, dan comprehensive reporting.',
'Multi-platform ads integrated management',
'subscription_only', 0.00, 5000000.00, 800000.00, 0, 0, 'monthly', 6, 14, 3, 30, 0, 1, 1, NOW(), NOW()),

-- Email Marketing
(4, 'Email Marketing Setup', 'email-marketing-setup',
'Setup email marketing lengkap: email list building, welcome series automation, newsletter template design, dan Mailchimp/SendGrid integration.',
'Email marketing setup dengan automation',
'both', 1500000.00, 500000.00, 0.00, 1, 1, 'monthly', 0, 7, 2, 30, 0, 0, 1, NOW(), NOW()),

(4, 'Email Campaign Management', 'email-campaign-management',
'Pengelolaan email campaign bulanan: 4 newsletter, segmentation strategy, A/B testing, automation flows, dan performance analytics.',
'Email campaign 4 newsletter/bulan dengan analytics',
'subscription_only', 0.00, 1800000.00, 300000.00, 0, 0, 'monthly', 3, 30, 2, 30, 1, 0, 1, NOW(), NOW()),

(4, 'E-Commerce Email Automation', 'ecommerce-email-automation',
'Email automation untuk e-commerce: abandoned cart recovery, product recommendations, order confirmations, shipping updates, dan review requests.',
'E-commerce email automation dengan cart recovery',
'both', 2500000.00, 800000.00, 0.00, 1, 1, 'monthly', 0, 10, 3, 60, 1, 0, 1, NOW(), NOW()),

-- Influencer & Affiliate Marketing
(4, 'Influencer Marketing Campaign', 'influencer-marketing',
'Campaign influencer marketing: influencer research & outreach, negotiation, content briefing, performance tracking, dan ROI analysis.',
'Influencer marketing dengan performance tracking',
'both', 5000000.00, 0.00, 0.00, 0, 0, 'one_time_only', 0, 30, 2, 60, 0, 0, 1, NOW(), NOW()),

(4, 'Affiliate Program Setup', 'affiliate-program-setup',
'Setup affiliate marketing program: tracking system, commission structure, affiliate dashboard, marketing materials, dan recruitment strategy.',
'Affiliate program setup dengan tracking system',
'both', 3500000.00, 500000.00, 0.00, 1, 1, 'monthly', 0, 14, 2, 90, 0, 0, 1, NOW(), NOW()),

(4, 'Affiliate Management Monthly', 'affiliate-management',
'Pengelolaan affiliate program: recruit new affiliates, provide marketing support, track performance, process commissions, dan monthly reporting.',
'Affiliate management dengan recruitment & support',
'subscription_only', 0.00, 2000000.00, 0.00, 0, 0, 'monthly', 3, 30, 1, 30, 0, 0, 1, NOW(), NOW()),

-- Content Marketing
(4, 'Content Marketing Strategy', 'content-marketing-strategy',
'Strategi content marketing komprehensif: audience research, content pillar development, editorial calendar, distribution plan, dan KPI setup.',
'Content strategy dengan editorial calendar',
'both', 4000000.00, 0.00, 0.00, 1, 1, 'one_time_only', 0, 14, 3, 30, 1, 1, 1, NOW(), NOW()),

(4, 'Blog Content Package', 'blog-content-package',
'Paket blog content: 8 artikel SEO-optimized per bulan (800-1200 kata), keyword research, internal linking, dan meta descriptions.',
'8 artikel SEO blog per bulan',
'subscription_only', 0.00, 3000000.00, 500000.00, 0, 0, 'monthly', 3, 30, 2, 30, 1, 0, 1, NOW(), NOW()),

(4, 'Video Marketing Production', 'video-marketing',
'Produksi video marketing: 4 video per bulan (30-60 detik), scriptwriting, shooting, editing, subtitles, dan optimization untuk social media.',
'Video marketing 4 video/bulan untuk sosmed',
'subscription_only', 0.00, 5000000.00, 1000000.00, 0, 0, 'monthly', 3, 30, 2, 30, 1, 1, 1, NOW(), NOW()),

(4, 'Podcast Production & Marketing', 'podcast-marketing',
'Podcast production lengkap: audio recording, editing, show notes, distribution ke platform, dan promotion strategy.',
'Podcast production dengan distribution',
'subscription_only', 0.00, 4000000.00, 800000.00, 0, 0, 'monthly', 6, 30, 1, 30, 0, 0, 1, NOW(), NOW()),

-- Analytics & Reporting
(4, 'Marketing Analytics Setup', 'marketing-analytics-setup',
'Setup marketing analytics: Google Analytics 4, Google Tag Manager, conversion tracking, custom dashboards, dan goal configuration.',
'Analytics setup GA4 & GTM dengan tracking',
'both', 2000000.00, 0.00, 0.00, 1, 1, 'one_time_only', 0, 5, 1, 30, 1, 0, 1, NOW(), NOW()),

(4, 'Monthly Marketing Report', 'monthly-marketing-report',
'Laporan marketing bulanan komprehensif: traffic analysis, conversion metrics, campaign performance, ROI calculation, dan strategic recommendations.',
'Monthly report dengan ROI & recommendations',
'subscription_only', 0.00, 1500000.00, 0.00, 0, 0, 'monthly', 3, 30, 0, 30, 1, 0, 1, NOW(), NOW()),

(4, 'Competitor Analysis', 'competitor-analysis',
'Analisis kompetitor mendalam: market position, digital strategy, keyword analysis, backlink profile, ads monitoring, dan benchmarking.',
'Competitor analysis dengan benchmarking',
'both', 3500000.00, 0.00, 0.00, 0, 1, 'one_time_only', 0, 10, 1, 30, 0, 0, 1, NOW(), NOW()),

-- Brand & Strategy
(4, 'Digital Marketing Strategy', 'digital-marketing-strategy',
'Strategi digital marketing end-to-end: market analysis, buyer persona, channel strategy, budget allocation, dan 12-month roadmap.',
'Marketing strategy 12-month roadmap',
'both', 8000000.00, 0.00, 0.00, 1, 1, 'one_time_only', 0, 21, 3, 60, 0, 1, 1, NOW(), NOW()),

(4, 'Brand Awareness Campaign', 'brand-awareness-campaign',
'Campaign brand awareness 3 bulan: multi-channel strategy, content creation, influencer collaboration, PR outreach, dan reach monitoring.',
'Brand awareness campaign 3 bulan multi-channel',
'both', 15000000.00, 0.00, 0.00, 0, 0, 'one_time_only', 0, 90, 2, 90, 0, 1, 1, NOW(), NOW()),

(4, 'Product Launch Campaign', 'product-launch-campaign',
'Campaign launching produk baru: pre-launch teaser, launch day coordination, multi-channel ads, influencer activation, dan post-launch analysis.',
'Product launch campaign multi-channel',
'both', 12000000.00, 0.00, 0.00, 0, 0, 'one_time_only', 0, 60, 3, 90, 0, 1, 1, NOW(), NOW()),

-- Conversion Optimization
(4, 'Conversion Rate Optimization', 'conversion-rate-optimization',
'CRO service: website audit, heatmap analysis, user testing, A/B test setup, landing page optimization, dan conversion funnel improvement.',
'CRO dengan A/B testing & funnel optimization',
'both', 5000000.00, 1500000.00, 0.00, 1, 1, 'monthly', 0, 14, 3, 90, 1, 1, 1, NOW(), NOW()),

(4, 'Landing Page Optimization', 'landing-page-optimization',
'Optimasi landing page untuk konversi tinggi: copywriting, design improvement, CTA optimization, form simplification, dan A/B testing.',
'Landing page optimization dengan A/B testing',
'both', 2500000.00, 0.00, 0.00, 1, 1, 'one_time_only', 0, 7, 3, 30, 1, 0, 1, NOW(), NOW()),

(4, 'Marketing Automation Setup', 'marketing-automation',
'Setup marketing automation: HubSpot/ActiveCampaign integration, workflow creation, lead scoring, email sequences, dan CRM sync.',
'Marketing automation dengan lead scoring',
'both', 6000000.00, 1200000.00, 0.00, 1, 1, 'monthly', 0, 21, 2, 180, 0, 1, 1, NOW(), NOW()),

(4, 'Retargeting Campaign Setup', 'retargeting-campaign',
'Setup retargeting campaign: pixel installation, audience segmentation, creative strategy, frequency capping, dan conversion optimization.',
'Retargeting setup dengan audience segmentation',
'both', 3000000.00, 1000000.00, 0.00, 1, 1, 'monthly', 0, 7, 2, 60, 1, 0, 1, NOW(), NOW());

-- ============================================================================
-- SECTION 6: SERVICES - SEO (25+ Services)
-- ============================================================================

INSERT INTO `services` (
    `category_id`, `name`, `slug`, `description`, `short_description`,
    `pricing_model`, `one_time_price`, `monthly_price`, `setup_fee`,
    `source_code_included`, `ownership_transfer`, `billing_cycle`, `min_commitment`,
    `delivery_time_days`, `revision_limit`, `support_duration_days`,
    `is_popular`, `is_featured`, `is_active`, `created_at`, `updated_at`
) VALUES

-- Technical SEO
(5, 'SEO Audit Complete', 'seo-audit-complete',
'Audit SEO menyeluruh: technical SEO check, on-page analysis, off-page review, competitor research, dan actionable recommendations dengan priority ranking.',
'SEO audit lengkap dengan competitor analysis',
'both', 2500000.00, 0.00, 0.00, 0, 1, 'one_time_only', 0, 7, 1, 30, 1, 1, 1, NOW(), NOW()),

(5, 'Technical SEO Optimization', 'technical-seo-optimization',
'Optimasi technical SEO: site speed, mobile-friendliness, crawlability, indexing, schema markup, sitemap, robots.txt, canonical tags, dan Core Web Vitals.',
'Technical SEO dengan Core Web Vitals optimization',
'both', 3500000.00, 500000.00, 0.00, 1, 1, 'monthly', 0, 14, 2, 90, 1, 1, 1, NOW(), NOW()),

(5, 'Site Speed Optimization', 'site-speed-optimization',
'Optimasi kecepatan website: image compression, code minification, caching setup, CDN integration, lazy loading, dan GTmetrix score improvement.',
'Speed optimization untuk PageSpeed 90+',
'both', 2000000.00, 0.00, 0.00, 1, 1, 'one_time_only', 0, 5, 2, 60, 1, 0, 1, NOW(), NOW()),

(5, 'Mobile SEO Optimization', 'mobile-seo-optimization',
'Optimasi SEO mobile: responsive design check, mobile usability, AMP setup (optional), mobile page speed, dan mobile-first indexing compliance.',
'Mobile SEO dengan mobile-first indexing',
'both', 1800000.00, 300000.00, 0.00, 1, 1, 'monthly', 0, 7, 2, 60, 0, 0, 1, NOW(), NOW()),

(5, 'Schema Markup Implementation', 'schema-markup',
'Implementasi structured data schema: product, article, local business, FAQ, review, breadcrumb, dan rich snippets optimization.',
'Schema markup untuk rich snippets',
'both', 1500000.00, 0.00, 0.00, 1, 1, 'one_time_only', 0, 5, 1, 30, 0, 0, 1, NOW(), NOW()),

-- On-Page SEO
(5, 'On-Page SEO Basic', 'on-page-seo-basic',
'On-page SEO untuk 10 halaman: keyword optimization, meta tags, headings, internal linking, image alt text, dan content structure improvement.',
'On-page SEO 10 halaman dengan optimization',
'both', 2000000.00, 400000.00, 0.00, 1, 1, 'monthly', 0, 7, 2, 60, 1, 0, 1, NOW(), NOW()),

(5, 'On-Page SEO Advanced', 'on-page-seo-advanced',
'On-page SEO unlimited halaman: comprehensive optimization, content gap analysis, topical authority building, semantic SEO, dan entity optimization.',
'On-page SEO unlimited dengan topical authority',
'both', 5000000.00, 800000.00, 0.00, 1, 1, 'monthly', 0, 21, 3, 120, 1, 1, 1, NOW(), NOW()),

(5, 'Keyword Research & Strategy', 'keyword-research',
'Research keyword mendalam: 100+ keywords dengan search volume, competition analysis, search intent, keyword clustering, dan content strategy.',
'Keyword research 100+ dengan strategy',
'both', 1800000.00, 0.00, 0.00, 0, 1, 'one_time_only', 0, 5, 2, 30, 1, 0, 1, NOW(), NOW()),

(5, 'Content Optimization SEO', 'content-optimization-seo',
'Optimasi content existing: keyword integration, readability improvement, semantic keywords, internal linking, dan meta optimization untuk 20 artikel.',
'Content SEO optimization 20 artikel',
'both', 3000000.00, 0.00, 0.00, 1, 1, 'one_time_only', 0, 10, 2, 30, 0, 0, 1, NOW(), NOW()),

(5, 'Title & Meta Description Optimization', 'title-meta-optimization',
'Optimasi title tags dan meta descriptions untuk seluruh website dengan CTR optimization, keyword integration, dan character limit compliance.',
'Title & meta optimization seluruh website',
'both', 1500000.00, 0.00, 0.00, 1, 1, 'one_time_only', 0, 5, 2, 30, 1, 0, 1, NOW(), NOW()),

-- Off-Page SEO
(5, 'Link Building Basic', 'link-building-basic',
'Link building 10 quality backlinks per bulan dari website relevan dengan DA 30+, natural anchor text, dan monthly report.',
'Link building 10 backlinks/bulan DA 30+',
'subscription_only', 0.00, 2500000.00, 500000.00, 0, 0, 'monthly', 6, 30, 1, 30, 1, 0, 1, NOW(), NOW()),

(5, 'Link Building Premium', 'link-building-premium',
'Link building 20 high-quality backlinks per bulan dari website DA 50+, diverse sources, contextual links, dan competitor backlink gap analysis.',
'Link building 20 backlinks/bulan DA 50+',
'subscription_only', 0.00, 5000000.00, 800000.00, 0, 0, 'monthly', 6, 30, 1, 30, 1, 1, 1, NOW(), NOW()),

(5, 'Guest Posting Service', 'guest-posting',
'Guest posting di 5 website niche-relevant per bulan: content writing (1000+ words), placement, dofollow backlink, dan traffic referral.',
'Guest posting 5 artikel/bulan dengan backlink',
'subscription_only', 0.00, 3500000.00, 600000.00, 0, 0, 'monthly', 3, 30, 1, 30, 0, 0, 1, NOW(), NOW()),

(5, 'Broken Link Building', 'broken-link-building',
'Broken link building strategy: find broken links di competitor sites, create replacement content, outreach, dan link acquisition.',
'Broken link building dengan outreach',
'both', 3000000.00, 1000000.00, 0.00, 0, 0, 'monthly', 0, 30, 1, 60, 0, 0, 1, NOW(), NOW()),

(5, 'Brand Mention & Link Reclamation', 'brand-mention-reclamation',
'Monitoring brand mentions dan convert unlinked mentions jadi backlinks, reclaim lost links, dan competitor mention opportunities.',
'Brand mention monitoring & link reclamation',
'subscription_only', 0.00, 1500000.00, 0.00, 0, 0, 'monthly', 3, 30, 0, 30, 0, 0, 1, NOW(), NOW()),

-- Local SEO
(5, 'Local SEO Setup', 'local-seo-setup',
'Setup local SEO lengkap: Google Business Profile optimization, local citations (30+ directories), NAP consistency, dan local schema markup.',
'Local SEO setup dengan 30+ citations',
'both', 2500000.00, 500000.00, 0.00, 1, 1, 'monthly', 0, 10, 2, 90, 1, 1, 1, NOW(), NOW()),

(5, 'Google Business Profile Management', 'google-business-management',
'Pengelolaan Google Business Profile: posting 2x/minggu, review management, Q&A monitoring, photo updates, dan monthly insights report.',
'GBP management dengan review & posting',
'subscription_only', 0.00, 1200000.00, 0.00, 0, 0, 'monthly', 3, 30, 1, 30, 1, 0, 1, NOW(), NOW()),

(5, 'Local Citation Building', 'local-citation-building',
'Building local citations di 50+ directories dan listing sites untuk improve local ranking dan NAP consistency across the web.',
'Local citations 50+ directories',
'both', 1800000.00, 0.00, 0.00, 0, 0, 'one_time_only', 0, 14, 1, 30, 0, 0, 1, NOW(), NOW()),

(5, 'Review Generation & Management', 'review-management',
'Review management service: review generation campaigns, review monitoring, response templates, reputation management, dan rating improvement.',
'Review management dengan generation campaign',
'subscription_only', 0.00, 1500000.00, 300000.00, 0, 0, 'monthly', 3, 30, 1, 30, 1, 0, 1, NOW(), NOW()),

(5, 'Multi-Location SEO', 'multi-location-seo',
'SEO untuk bisnis multi-location: location pages optimization, separate GBP for each location, local link building, dan centralized reporting.',
'Multi-location SEO untuk cabang',
'both', 5000000.00, 1500000.00, 0.00, 1, 1, 'monthly', 0, 21, 2, 180, 0, 1, 1, NOW(), NOW()),

-- E-Commerce SEO
(5, 'E-Commerce SEO Basic', 'ecommerce-seo-basic',
'SEO untuk toko online: product page optimization, category optimization, faceted navigation, duplicate content fix, dan product schema.',
'E-commerce SEO dengan product optimization',
'both', 4000000.00, 800000.00, 0.00, 1, 1, 'monthly', 0, 21, 3, 120, 1, 1, 1, NOW(), NOW()),

(5, 'E-Commerce SEO Advanced', 'ecommerce-seo-advanced',
'E-commerce SEO lengkap: technical SEO, 1000+ product optimization, category strategy, internal linking, review schema, dan conversion optimization.',
'E-commerce SEO 1000+ products advanced',
'both', 12000000.00, 2000000.00, 0.00, 1, 1, 'monthly', 0, 60, 5, 365, 0, 1, 1, NOW(), NOW()),

(5, 'Product Listing Optimization', 'product-listing-optimization',
'Optimasi product listings: keyword-rich titles, compelling descriptions, bullet points, product images SEO, dan variant optimization.',
'Product listing optimization dengan variants',
'both', 3500000.00, 0.00, 0.00, 1, 1, 'one_time_only', 0, 14, 2, 30, 0, 0, 1, NOW(), NOW()),

(5, 'Marketplace SEO (Tokopedia/Shopee)', 'marketplace-seo',
'SEO optimization untuk marketplace: product title optimization, description SEO, category selection, pricing strategy, dan review management.',
'Marketplace SEO untuk Tokopedia/Shopee',
'both', 2000000.00, 500000.00, 0.00, 0, 0, 'monthly', 0, 7, 2, 60, 1, 0, 1, NOW(), NOW()),

-- Monthly SEO Packages
(5, 'SEO Monthly Basic', 'seo-monthly-basic',
'Paket SEO bulanan basic: on-page optimization, 5 content posts, 5 backlinks, technical monitoring, monthly report. Cocok untuk website baru.',
'SEO basic 5 content + 5 backlinks/bulan',
'subscription_only', 0.00, 3500000.00, 800000.00, 0, 0, 'monthly', 6, 30, 2, 30, 1, 1, 1, NOW(), NOW()),

(5, 'SEO Monthly Professional', 'seo-monthly-professional',
'Paket SEO profesional: advanced optimization, 10 content posts, 15 backlinks, competitor analysis, conversion tracking, bi-weekly reports.',
'SEO professional 10 content + 15 backlinks',
'subscription_only', 0.00, 7500000.00, 1500000.00, 0, 0, 'monthly', 6, 30, 2, 30, 1, 1, 1, NOW(), NOW()),

(5, 'SEO Monthly Enterprise', 'seo-monthly-enterprise',
'Paket SEO enterprise: comprehensive optimization, 20+ content, 30+ backlinks, dedicated SEO manager, weekly calls, custom strategy.',
'SEO enterprise 20+ content dedicated manager',
'subscription_only', 0.00, 15000000.00, 3000000.00, 0, 0, 'monthly', 12, 30, 3, 30, 0, 1, 1, NOW(), NOW());

-- ============================================================================
-- SECTION 7: SERVICES - CONTENT CREATION (30+ Services)
-- ============================================================================

INSERT INTO `services` (
    `category_id`, `name`, `slug`, `description`, `short_description`,
    `pricing_model`, `one_time_price`, `monthly_price`, `setup_fee`,
    `source_code_included`, `ownership_transfer`, `billing_cycle`, `min_commitment`,
    `delivery_time_days`, `revision_limit`, `support_duration_days`,
    `is_popular`, `is_featured`, `is_active`, `created_at`, `updated_at`
) VALUES

-- Written Content
(6, 'Article Writing SEO', 'article-writing-seo',
'Penulisan artikel SEO 800-1200 kata dengan keyword research, struktur SEO-friendly, internal linking suggestions, meta description, dan 1x revision.',
'Artikel SEO 800-1200 kata dengan research',
'both', 300000.00, 0.00, 0.00, 0, 1, 'one_time_only', 0, 3, 1, 7, 1, 0, 1, NOW(), NOW()),

(6, 'Long-Form Article 2000+ Words', 'long-form-article',
'Artikel long-form 2000+ kata untuk pillar content dengan deep research, data analysis, infographic suggestions, dan internal link structure.',
'Long-form 2000+ kata dengan data analysis',
'both', 600000.00, 0.00, 0.00, 0, 1, 'one_time_only', 0, 5, 2, 14, 1, 0, 1, NOW(), NOW()),

(6, 'Blog Content Package 8 Articles', 'blog-package-8',
'Paket 8 artikel blog per bulan (@1000 kata) dengan topical research, keyword optimization, publication schedule, dan content calendar.',
'8 artikel blog/bulan dengan calendar',
'subscription_only', 0.00, 2000000.00, 0.00, 0, 1, 'monthly', 3, 30, 1, 30, 1, 0, 1, NOW(), NOW()),

(6, 'Blog Content Package 16 Articles', 'blog-package-16',
'Paket 16 artikel blog per bulan (@1000 kata) dengan comprehensive strategy, topical authority building, dan content distribution plan.',
'16 artikel blog/bulan topical authority',
'subscription_only', 0.00, 3500000.00, 0.00, 0, 1, 'monthly', 6, 30, 1, 30, 1, 1, 1, NOW(), NOW()),

(6, 'Product Description Writing', 'product-description',
'Penulisan deskripsi produk menarik dan persuasive dengan benefit-focused copy, SEO keywords, bullet points, dan emotional triggers.',
'Product description persuasive SEO',
'both', 150000.00, 0.00, 0.00, 0, 1, 'one_time_only', 0, 1, 1, 3, 1, 0, 1, NOW(), NOW()),

(6, 'Copywriting Landing Page', 'copywriting-landing-page',
'Copywriting landing page yang convert dengan AIDA formula, compelling headlines, benefit-driven copy, CTA optimization, dan social proof integration.',
'Copywriting landing page high-converting',
'both', 1500000.00, 0.00, 0.00, 0, 1, 'one_time_only', 0, 5, 3, 14, 1, 1, 1, NOW(), NOW()),

(6, 'Sales Copy/Sales Letter', 'sales-copy',
'Sales copy panjang (3000+ words) dengan problem-agitate-solve framework, storytelling, objection handling, dan strong call-to-action.',
'Sales copy 3000+ kata dengan storytelling',
'both', 2500000.00, 0.00, 0.00, 0, 1, 'one_time_only', 0, 7, 3, 14, 0, 0, 1, NOW(), NOW()),

(6, 'Email Copy Writing', 'email-copywriting',
'Penulisan email copy untuk campaigns: subject lines yang menarik, body copy engaging, personalization, dan CTA yang jelas. Paket 10 emails.',
'Email copywriting 10 emails engaging',
'both', 1000000.00, 0.00, 0.00, 0, 1, 'one_time_only', 0, 5, 2, 7, 0, 0, 1, NOW(), NOW()),

(6, 'Social Media Caption Writing', 'social-media-captions',
'Penulisan caption untuk social media: 30 captions untuk IG/FB/TikTok dengan hashtag research, hook yang menarik, dan CTA yang clear.',
'30 social media captions dengan hashtags',
'both', 750000.00, 0.00, 0.00, 0, 1, 'one_time_only', 0, 5, 2, 7, 1, 0, 1, NOW(), NOW()),

(6, 'E-Book Writing', 'ebook-writing',
'Penulisan e-book 50-100 halaman dengan research, outline, writing, editing, formatting, dan cover design. Perfect untuk lead magnet.',
'E-book 50-100 pages dengan cover design',
'both', 5000000.00, 0.00, 0.00, 0, 1, 'one_time_only', 0, 30, 3, 30, 0, 1, 1, NOW(), NOW()),

(6, 'White Paper Writing', 'whitepaper-writing',
'White paper profesional untuk B2B dengan industry research, data analysis, professional writing, dan executive summary. 15-25 pages.',
'White paper B2B 15-25 pages professional',
'both', 8000000.00, 0.00, 0.00, 0, 1, 'one_time_only', 0, 30, 2, 30, 0, 1, 1, NOW(), NOW()),

(6, 'Case Study Writing', 'case-study-writing',
'Penulisan case study dengan problem-solution structure, client interview, result quantification, dan compelling narrative. Include visual design.',
'Case study dengan interview & results',
'both', 2000000.00, 0.00, 0.00, 0, 1, 'one_time_only', 0, 7, 2, 14, 0, 0, 1, NOW(), NOW()),

-- Video Content
(6, 'Video Editing Basic', 'video-editing-basic',
'Video editing untuk 1 video (5-10 menit): cutting, color grading, background music, text overlay, transitions, dan export HD.',
'Video editing 5-10 menit dengan effects',
'both', 500000.00, 0.00, 0.00, 0, 1, 'one_time_only', 0, 3, 2, 7, 1, 0, 1, NOW(), NOW()),

(6, 'Video Editing Premium', 'video-editing-premium',
'Video editing premium (10-30 menit): advanced effects, motion graphics, sound design, color grading professional, dan subtitle.',
'Video editing 10-30 menit motion graphics',
'both', 1500000.00, 0.00, 0.00, 0, 1, 'one_time_only', 0, 7, 3, 14, 1, 1, 1, NOW(), NOW()),

(6, 'Short Video Content Package', 'short-video-package',
'Paket 8 short videos per bulan untuk TikTok/Reels/Shorts: concept, editing, captions, trending audio, dan posting schedule.',
'8 short videos/bulan untuk TikTok/Reels',
'subscription_only', 0.00, 3000000.00, 500000.00, 0, 1, 'monthly', 3, 30, 2, 30, 1, 1, 1, NOW(), NOW()),

(6, 'Explainer Video Animation', 'explainer-video-animation',
'Video explainer animasi 2D (60-90 detik) dengan scriptwriting, storyboard, voiceover, animation, dan background music.',
'Explainer video 2D animation 60-90 detik',
'both', 5000000.00, 0.00, 0.00, 0, 1, 'one_time_only', 0, 14, 3, 30, 1, 1, 1, NOW(), NOW()),

(6, 'Video Commercial/Ads', 'video-commercial',
'Video commercial untuk ads (15-30 detik) dengan creative concept, shooting (if needed), professional editing, dan multiple format exports.',
'Video commercial 15-30 detik professional',
'both', 8000000.00, 0.00, 0.00, 0, 1, 'one_time_only', 0, 14, 3, 30, 0, 1, 1, NOW(), NOW()),

(6, 'YouTube Video Production', 'youtube-video-production',
'Produksi video YouTube lengkap: script, shooting, editing, thumbnail design, SEO title/description, dan upload assistance.',
'YouTube video production lengkap dengan SEO',
'both', 3500000.00, 0.00, 0.00, 0, 1, 'one_time_only', 0, 10, 2, 14, 0, 0, 1, NOW(), NOW()),

(6, 'Video Testimonial Production', 'video-testimonial',
'Produksi video testimonial client: interview questions, shooting, editing, subtitle, background music, dan branding overlay.',
'Video testimonial dengan interview & editing',
'both', 2000000.00, 0.00, 0.00, 0, 1, 'one_time_only', 0, 7, 2, 14, 0, 0, 1, NOW(), NOW()),

(6, 'Podcast Video Editing', 'podcast-video-editing',
'Editing podcast video format: multi-camera editing, audio sync, lower thirds, B-roll insertion, intro/outro, dan chapter markers.',
'Podcast video editing multi-camera',
'both', 1200000.00, 0.00, 0.00, 0, 1, 'one_time_only', 0, 5, 1, 7, 0, 0, 1, NOW(), NOW()),

-- Graphic Design Content
(6, 'Social Media Graphic Design', 'social-media-graphics',
'Desain grafis untuk social media: 30 posts Instagram/Facebook dengan template konsisten, on-brand design, dan editable source files.',
'30 social media graphics dengan template',
'both', 1500000.00, 500000.00, 0.00, 1, 1, 'monthly', 0, 7, 2, 30, 1, 0, 1, NOW(), NOW()),

(6, 'Infographic Design', 'infographic-design',
'Desain infographic profesional dengan data visualization, icon design, color scheme, dan typography. Print-ready & web-optimized.',
'Infographic design dengan data visualization',
'both', 1000000.00, 0.00, 0.00, 1, 1, 'one_time_only', 0, 5, 3, 14, 1, 0, 1, NOW(), NOW()),

(6, 'E-Book/Lead Magnet Design', 'ebook-design',
'Desain layout e-book atau lead magnet (20-50 pages) dengan professional typography, image placement, dan export PDF interactive.',
'E-book design 20-50 pages PDF interactive',
'both', 2500000.00, 0.00, 0.00, 1, 1, 'one_time_only', 0, 7, 3, 14, 0, 0, 1, NOW(), NOW()),

(6, 'Presentation/Pitch Deck Design', 'presentation-design',
'Desain presentation deck profesional (15-30 slides) dengan visual storytelling, data visualization, consistent branding, dan animation.',
'Pitch deck 15-30 slides dengan animation',
'both', 2000000.00, 0.00, 0.00, 1, 1, 'one_time_only', 0, 5, 3, 14, 1, 1, 1, NOW(), NOW()),

(6, 'Banner Ads Design Package', 'banner-ads-design',
'Desain banner ads untuk Google/Facebook: 10 sizes, multiple variations, A/B test versions, dan editable source files.',
'Banner ads 10 sizes multiple variations',
'both', 1500000.00, 0.00, 0.00, 1, 1, 'one_time_only', 0, 5, 2, 14, 1, 0, 1, NOW(), NOW()),

(6, 'Print Material Design', 'print-material-design',
'Desain material print: brochure, flyer, poster, banner dengan print-ready files (CMYK, bleed, high resolution).',
'Print design brochure/flyer print-ready',
'both', 1200000.00, 0.00, 0.00, 1, 1, 'one_time_only', 0, 5, 3, 14, 0, 0, 1, NOW(), NOW()),

-- Specialized Content
(6, 'Content Localization (Translation)', 'content-localization',
'Lokalisasi content dari English ke Bahasa Indonesia atau sebaliknya dengan cultural adaptation, SEO consideration, dan native speaker review.',
'Content translation dengan cultural adaptation',
'both', 500000.00, 0.00, 0.00, 0, 1, 'one_time_only', 0, 5, 1, 7, 0, 0, 1, NOW(), NOW()),

(6, 'Content Repurposing Service', 'content-repurposing',
'Repurpose 1 piece of content jadi multiple formats: blog to video script, podcast to articles, webinar to social posts, dll.',
'Content repurposing 1 to multiple formats',
'both', 800000.00, 0.00, 0.00, 0, 1, 'one_time_only', 0, 5, 1, 7, 0, 0, 1, NOW(), NOW()),

(6, 'Press Release Writing', 'press-release-writing',
'Penulisan press release profesional dengan news angle, inverted pyramid structure, quote integration, dan distribution recommendations.',
'Press release writing dengan distribution tips',
'both', 1500000.00, 0.00, 0.00, 0, 1, 'one_time_only', 0, 3, 2, 7, 0, 0, 1, NOW(), NOW()),

(6, 'Content Strategy & Calendar', 'content-strategy-calendar',
'Pembuatan content strategy lengkap: audience research, content pillars, topic clusters, 3-month editorial calendar, dan distribution plan.',
'Content strategy dengan 3-month calendar',
'both', 4000000.00, 0.00, 0.00, 0, 1, 'one_time_only', 0, 10, 2, 30, 1, 1, 1, NOW(), NOW());

-- ============================================================================
-- SECTION 8: SERVICES - CLOUD & HOSTING (20+ Services)
-- ============================================================================

INSERT INTO `services` (
    `category_id`, `name`, `slug`, `description`, `short_description`,
    `pricing_model`, `one_time_price`, `monthly_price`, `setup_fee`,
    `source_code_included`, `ownership_transfer`, `billing_cycle`, `min_commitment`,
    `delivery_time_days`, `revision_limit`, `support_duration_days`,
    `is_popular`, `is_featured`, `is_active`, `created_at`, `updated_at`
) VALUES

-- Shared Hosting
(7, 'Shared Hosting Basic', 'shared-hosting-basic',
'Hosting shared untuk website kecil: 2GB storage, 10GB bandwidth, 1 domain, cPanel, SSL gratis, 99.9% uptime guarantee. Perfect untuk blog atau company profile.',
'Shared hosting 2GB untuk website kecil',
'subscription_only', 0.00, 100000.00, 0.00, 0, 0, 'monthly', 3, 1, 0, 30, 1, 0, 1, NOW(), NOW()),

(7, 'Shared Hosting Pro', 'shared-hosting-pro',
'Hosting shared untuk website menengah: 10GB storage, unlimited bandwidth, 5 domains, cPanel, SSL gratis, daily backup, dan email unlimited.',
'Shared hosting 10GB unlimited bandwidth',
'subscription_only', 0.00, 250000.00, 0.00, 0, 0, 'monthly', 3, 1, 0, 30, 1, 1, 1, NOW(), NOW()),

(7, 'Shared Hosting Business', 'shared-hosting-business',
'Hosting shared untuk multiple websites: 50GB SSD, unlimited bandwidth, unlimited domains, cPanel, SSL gratis, daily backup, prioritas support.',
'Shared hosting 50GB SSD unlimited domains',
'subscription_only', 0.00, 500000.00, 0.00, 0, 0, 'monthly', 3, 1, 0, 30, 0, 0, 1, NOW(), NOW()),

-- WordPress Hosting
(7, 'WordPress Hosting Starter', 'wordpress-hosting-starter',
'WordPress hosting optimized: 5GB SSD, managed WP, auto updates, staging environment, WP CLI access, dan caching pre-configured.',
'WP hosting optimized dengan staging',
'subscription_only', 0.00, 150000.00, 0.00, 0, 0, 'monthly', 3, 1, 0, 30, 1, 0, 1, NOW(), NOW()),

(7, 'WordPress Hosting Professional', 'wordpress-hosting-pro',
'WordPress hosting premium: 20GB NVMe SSD, managed WP, auto updates, staging, CDN included, advanced caching, dan WP expert support.',
'WP hosting premium dengan CDN included',
'subscription_only', 0.00, 350000.00, 0.00, 0, 0, 'monthly', 3, 1, 0, 30, 1, 1, 1, NOW(), NOW()),

(7, 'WordPress Hosting Agency', 'wordpress-hosting-agency',
'WordPress hosting untuk agency: 100GB NVMe SSD, unlimited sites, managed WP, white-label dashboard, client management, dan reseller options.',
'WP hosting agency unlimited sites',
'subscription_only', 0.00, 800000.00, 0.00, 0, 0, 'monthly', 6, 1, 0, 30, 0, 1, 1, NOW(), NOW()),

-- VPS & Cloud
(7, 'VPS Hosting Basic', 'vps-hosting-basic',
'VPS entry-level: 2 CPU cores, 4GB RAM, 50GB SSD, root access, choice of OS (Ubuntu/CentOS), dedicated IP, dan basic DDoS protection.',
'VPS 2 core 4GB RAM 50GB SSD',
'subscription_only', 0.00, 500000.00, 150000.00, 0, 0, 'monthly', 3, 2, 0, 30, 1, 0, 1, NOW(), NOW()),

(7, 'VPS Hosting Professional', 'vps-hosting-pro',
'VPS menengah: 4 CPU cores, 8GB RAM, 100GB NVMe SSD, full root access, managed firewall, automated backup, dan 24/7 monitoring.',
'VPS 4 core 8GB RAM 100GB NVMe',
'subscription_only', 0.00, 1000000.00, 200000.00, 0, 0, 'monthly', 3, 2, 0, 30, 1, 1, 1, NOW(), NOW()),

(7, 'VPS Hosting Enterprise', 'vps-hosting-enterprise',
'VPS high-performance: 8 CPU cores, 16GB RAM, 250GB NVMe SSD, dedicated resources, advanced security, load balancing option, dan priority support.',
'VPS 8 core 16GB RAM 250GB high-performance',
'subscription_only', 0.00, 2500000.00, 500000.00, 0, 0, 'monthly', 6, 2, 0, 30, 0, 1, 1, NOW(), NOW()),

(7, 'Cloud Hosting Scalable', 'cloud-hosting-scalable',
'Cloud hosting dengan auto-scaling: flexible resources, pay-as-you-use, load balancer, CDN integration, dan 99.99% SLA uptime.',
'Cloud hosting auto-scaling pay-as-you-use',
'subscription_only', 0.00, 1500000.00, 300000.00, 0, 0, 'monthly', 3, 2, 0, 30, 0, 1, 1, NOW(), NOW()),

-- Dedicated Server
(7, 'Dedicated Server Basic', 'dedicated-server-basic',
'Dedicated server entry: Intel Xeon 4-core, 16GB RAM, 500GB SSD, 10TB bandwidth, dedicated IP, full root access, dan basic management.',
'Dedicated server 4-core 16GB 500GB SSD',
'subscription_only', 0.00, 3500000.00, 1000000.00, 0, 0, 'monthly', 6, 5, 0, 30, 0, 0, 1, NOW(), NOW()),

(7, 'Dedicated Server Enterprise', 'dedicated-server-enterprise',
'Dedicated server premium: Intel Xeon 16-core, 64GB RAM, 2TB NVMe SSD RAID, unlimited bandwidth, DDoS protection, fully managed.',
'Dedicated server 16-core 64GB premium',
'subscription_only', 0.00, 8000000.00, 2000000.00, 0, 0, 'monthly', 12, 7, 0, 30, 0, 1, 1, NOW(), NOW()),

-- Domain Services
(7, 'Domain Registration .COM', 'domain-com',
'Registrasi domain .COM untuk 1 tahun dengan DNS management, domain privacy protection (WHOIS guard), dan auto-renewal option.',
'Domain .COM 1 tahun dengan privacy',
'subscription_only', 0.00, 150000.00, 0.00, 0, 1, 'yearly', 0, 1, 0, 365, 1, 0, 1, NOW(), NOW()),

(7, 'Domain Registration .ID/.CO.ID', 'domain-id',
'Registrasi domain .ID atau .CO.ID untuk 1 tahun dengan DNS management, support untuk PANDI verification, dan transfer assistance.',
'Domain .ID 1 tahun dengan PANDI support',
'subscription_only', 0.00, 200000.00, 0.00, 0, 1, 'yearly', 0, 3, 0, 365, 1, 0, 1, NOW(), NOW()),

(7, 'Premium Domain Acquisition', 'premium-domain',
'Acquisition service untuk premium domain: market research, negotiation dengan owner, transfer process, dan legal documentation.',
'Premium domain acquisition dengan negotiation',
'both', 5000000.00, 0.00, 0.00, 0, 1, 'one_time_only', 0, 30, 1, 30, 0, 1, 1, NOW(), NOW()),

-- Email Hosting
(7, 'Email Hosting Professional', 'email-hosting-professional',
'Email hosting bisnis: 10 accounts, 5GB per mailbox, webmail access, IMAP/POP3/SMTP, anti-spam/anti-virus, mobile sync, dan 99.9% uptime.',
'Email hosting 10 accounts 5GB per mailbox',
'subscription_only', 0.00, 200000.00, 0.00, 0, 0, 'monthly', 3, 1, 0, 30, 1, 0, 1, NOW(), NOW()),

(7, 'Google Workspace Setup', 'google-workspace',
'Google Workspace (Gmail business) setup & migration: custom domain email, Drive, Docs, Meet, Calendar, dan admin training.',
'Google Workspace setup dengan migration',
'both', 1500000.00, 0.00, 0.00, 0, 0, 'one_time_only', 0, 3, 1, 30, 1, 1, 1, NOW(), NOW()),

(7, 'Microsoft 365 Setup', 'microsoft-365-setup',
'Microsoft 365 setup & migration: Outlook, OneDrive, Teams, Office apps, SharePoint, dan user training untuk tim.',
'Microsoft 365 setup dengan training',
'both', 2000000.00, 0.00, 0.00, 0, 0, 'one_time_only', 0, 5, 1, 30, 0, 1, 1, NOW(), NOW()),

-- Additional Services
(7, 'SSL Certificate Basic', 'ssl-certificate-basic',
'SSL Certificate DV (Domain Validated) untuk 1 tahun: encryption 256-bit, browser compatibility, installation included, dan auto-renewal.',
'SSL DV 1 tahun dengan installation',
'subscription_only', 0.00, 150000.00, 0.00, 0, 0, 'yearly', 0, 1, 0, 365, 1, 0, 1, NOW(), NOW()),

(7, 'SSL Certificate Wildcard', 'ssl-certificate-wildcard',
'SSL Wildcard untuk unlimited subdomains: OV validation, 256-bit encryption, installation, seal/badge, dan priority support.',
'SSL Wildcard unlimited subdomain',
'subscription_only', 0.00, 1500000.00, 0.00, 0, 0, 'yearly', 0, 2, 0, 365, 0, 1, 1, NOW(), NOW()),

(7, 'CDN Setup & Configuration', 'cdn-setup',
'Content Delivery Network setup: Cloudflare/StackPath integration, cache configuration, performance optimization, dan DDoS protection.',
'CDN setup dengan performance optimization',
'both', 1000000.00, 300000.00, 0.00, 1, 1, 'monthly', 0, 3, 1, 90, 1, 0, 1, NOW(), NOW());

-- ============================================================================
-- SECTION 9: SERVICES - MAINTENANCE & SUPPORT (25+ Services)
-- ============================================================================

INSERT INTO `services` (
    `category_id`, `name`, `slug`, `description`, `short_description`,
    `pricing_model`, `one_time_price`, `monthly_price`, `setup_fee`,
    `source_code_included`, `ownership_transfer`, `billing_cycle`, `min_commitment`,
    `delivery_time_days`, `revision_limit`, `support_duration_days`,
    `is_popular`, `is_featured`, `is_active`, `created_at`, `updated_at`
) VALUES

-- Website Maintenance
(8, 'Website Maintenance Basic', 'maintenance-basic',
'Maintenance bulanan basic: content updates 2x/bulan, security monitoring, uptime monitoring, monthly backup, dan technical support via email.',
'Maintenance basic 2 updates/bulan dengan backup',
'subscription_only', 0.00, 500000.00, 0.00, 0, 0, 'monthly', 3, 30, 2, 30, 1, 0, 1, NOW(), NOW()),

(8, 'Website Maintenance Professional', 'maintenance-professional',
'Maintenance profesional: unlimited minor updates, weekly backup, security scanning, performance optimization, malware removal, dan priority support.',
'Maintenance pro unlimited updates dengan security',
'subscription_only', 0.00, 1500000.00, 0.00, 0, 0, 'monthly', 3, 30, 999, 30, 1, 1, 1, NOW(), NOW()),

(8, 'Website Maintenance Enterprise', 'maintenance-enterprise',
'Maintenance enterprise: 24/7 monitoring, daily backup, real-time security, emergency response (<2h), dedicated manager, dan SLA 99.9% uptime.',
'Maintenance enterprise 24/7 dengan SLA',
'subscription_only', 0.00, 3500000.00, 0.00, 0, 0, 'monthly', 6, 30, 999, 30, 0, 1, 1, NOW(), NOW()),

(8, 'WordPress Maintenance', 'wordpress-maintenance',
'WordPress-specific maintenance: plugin/theme updates, security hardening, database optimization, broken link check, comment spam removal.',
'WordPress maintenance dengan plugin updates',
'subscription_only', 0.00, 800000.00, 0.00, 0, 0, 'monthly', 3, 30, 999, 30, 1, 0, 1, NOW(), NOW()),

(8, 'E-Commerce Maintenance', 'ecommerce-maintenance',
'E-commerce maintenance: product updates, inventory sync, payment gateway monitoring, order system check, cart abandonment fix, security audit.',
'E-commerce maintenance dengan payment monitoring',
'subscription_only', 0.00, 2000000.00, 0.00, 0, 0, 'monthly', 3, 30, 999, 30, 1, 1, 1, NOW(), NOW()),

-- Security Services
(8, 'Security Audit & Hardening', 'security-audit',
'Security audit komprehensif: vulnerability scan, penetration testing simulation, security recommendations, firewall configuration, dan hardening implementation.',
'Security audit dengan penetration testing',
'both', 3500000.00, 0.00, 0.00, 0, 1, 'one_time_only', 0, 7, 1, 30, 1, 1, 1, NOW(), NOW()),

(8, 'Malware Removal & Cleanup', 'malware-removal',
'Malware removal service: malware scanning, infected file removal, backdoor cleanup, blacklist removal (Google/Norton), dan prevention setup.',
'Malware removal dengan blacklist cleanup',
'both', 2000000.00, 0.00, 0.00, 1, 1, 'one_time_only', 0, 3, 0, 14, 1, 0, 1, NOW(), NOW()),

(8, 'Website Security Monitoring', 'security-monitoring',
'24/7 security monitoring: real-time threat detection, firewall monitoring, intrusion detection, automatic blocking, dan instant alert notifications.',
'Security monitoring 24/7 dengan alerts',
'subscription_only', 0.00, 1200000.00, 300000.00, 0, 0, 'monthly', 6, 30, 0, 30, 1, 1, 1, NOW(), NOW()),

(8, 'DDoS Protection Service', 'ddos-protection',
'DDoS protection setup: traffic filtering, attack mitigation, CDN integration, real-time monitoring, dan incident response.',
'DDoS protection dengan mitigation',
'subscription_only', 0.00, 1500000.00, 500000.00, 0, 0, 'monthly', 3, 30, 0, 30, 0, 1, 1, NOW(), NOW()),

(8, 'SSL & HTTPS Migration', 'ssl-https-migration',
'Migrasi HTTP ke HTTPS lengkap: SSL installation, mixed content fix, redirect setup, search console update, dan post-migration testing.',
'HTTPS migration dengan mixed content fix',
'both', 1000000.00, 0.00, 0.00, 1, 1, 'one_time_only', 0, 3, 1, 30, 1, 0, 1, NOW(), NOW()),

-- Backup & Recovery
(8, 'Automated Backup Setup', 'automated-backup',
'Setup automated backup system: daily/weekly backup schedule, cloud storage integration (Google Drive/Dropbox), retention policy, dan recovery testing.',
'Automated backup dengan cloud storage',
'both', 1500000.00, 300000.00, 0.00, 1, 1, 'monthly', 0, 3, 1, 90, 1, 0, 1, NOW(), NOW()),

(8, 'Website Disaster Recovery', 'disaster-recovery',
'Disaster recovery service: emergency website restore, data recovery, server migration if needed, dan 24/7 emergency support.',
'Disaster recovery dengan emergency restore',
'both', 3000000.00, 0.00, 0.00, 1, 1, 'one_time_only', 0, 1, 0, 7, 0, 1, 1, NOW(), NOW()),

(8, 'Database Backup & Optimization', 'database-backup',
'Database maintenance: automated backup, query optimization, index optimization, dead data cleanup, dan performance tuning.',
'Database backup dengan optimization',
'subscription_only', 0.00, 800000.00, 200000.00, 0, 0, 'monthly', 3, 30, 0, 30, 0, 0, 1, NOW(), NOW()),

-- Performance Optimization
(8, 'Website Speed Optimization', 'speed-optimization',
'Optimasi kecepatan website: image optimization, code minification, caching, lazy loading, database optimization, CDN setup. Target: PageSpeed 90+.',
'Speed optimization target PageSpeed 90+',
'both', 2500000.00, 0.00, 0.00, 1, 1, 'one_time_only', 0, 5, 2, 60, 1, 1, 1, NOW(), NOW()),

(8, 'Database Optimization', 'database-optimization',
'Database optimization mendalam: query optimization, index creation, table optimization, connection pooling, dan slow query analysis.',
'Database optimization dengan query tuning',
'both', 1800000.00, 0.00, 0.00, 1, 1, 'one_time_only', 0, 3, 1, 30, 0, 0, 1, NOW(), NOW()),

(8, 'Server Performance Tuning', 'server-performance-tuning',
'Server optimization: PHP/MySQL configuration, Apache/Nginx tuning, memory optimization, caching layers, dan load testing.',
'Server tuning dengan load testing',
'both', 3000000.00, 0.00, 0.00, 1, 1, 'one_time_only', 0, 5, 1, 30, 0, 1, 1, NOW(), NOW()),

(8, 'CDN Integration & Optimization', 'cdn-integration',
'CDN integration lengkap: Cloudflare/AWS CloudFront setup, cache configuration, image optimization, dan performance monitoring.',
'CDN integration dengan cache optimization',
'both', 1500000.00, 0.00, 0.00, 1, 1, 'one_time_only', 0, 3, 1, 30, 1, 0, 1, NOW(), NOW()),

-- Migration Services
(8, 'Website Migration to New Host', 'website-migration',
'Migrasi website ke hosting baru: full backup, transfer files/database, DNS update, testing, dan zero downtime migration.',
'Website migration zero downtime',
'both', 1500000.00, 0.00, 0.00, 1, 1, 'one_time_only', 0, 3, 1, 14, 1, 0, 1, NOW(), NOW()),

(8, 'WordPress Migration Service', 'wordpress-migration',
'WordPress migration: backup, transfer, plugin compatibility check, permalink fix, media library migration, dan SEO preservation.',
'WordPress migration dengan SEO preservation',
'both', 1000000.00, 0.00, 0.00, 1, 1, 'one_time_only', 0, 2, 1, 14, 1, 0, 1, NOW(), NOW()),

(8, 'E-Commerce Migration', 'ecommerce-migration',
'E-commerce migration: product data migration, customer data transfer, order history, payment gateway re-setup, dan testing.',
'E-commerce migration dengan data transfer',
'both', 5000000.00, 0.00, 0.00, 1, 1, 'one_time_only', 0, 14, 2, 30, 0, 1, 1, NOW(), NOW()),

(8, 'Domain Transfer Service', 'domain-transfer',
'Domain transfer assistance: unlock domain, get auth code, transfer initiation, verification, dan DNS propagation monitoring.',
'Domain transfer dengan monitoring',
'both', 500000.00, 0.00, 0.00, 0, 1, 'one_time_only', 0, 7, 0, 14, 1, 0, 1, NOW(), NOW()),

-- Support Services
(8, 'Technical Support Retainer', 'technical-support-retainer',
'Technical support retainer bulanan: 10 hours support time, bug fixes, troubleshooting, consultation, via email/chat/call.',
'Support retainer 10 hours/bulan',
'subscription_only', 0.00, 2000000.00, 0.00, 0, 0, 'monthly', 3, 30, 999, 30, 1, 1, 1, NOW(), NOW()),

(8, 'Emergency Support 24/7', 'emergency-support',
'Emergency support package: 24/7 availability, response time <1 hour, critical issue resolution, dedicated hotline.',
'Emergency support 24/7 response <1h',
'subscription_only', 0.00, 3500000.00, 0.00, 0, 0, 'monthly', 6, 30, 999, 30, 0, 1, 1, NOW(), NOW()),

(8, 'Bug Fix Service', 'bug-fix-service',
'Bug fixing untuk website/app existing: diagnosis, fix implementation, testing, dan documentation. Per bug basis.',
'Bug fix per issue dengan testing',
'both', 500000.00, 0.00, 0.00, 1, 1, 'one_time_only', 0, 3, 1, 7, 1, 0, 1, NOW(), NOW()),

(8, 'Code Review & Quality Audit', 'code-review',
'Code review profesional: security audit, best practices check, performance analysis, refactoring suggestions, dan documentation review.',
'Code review dengan refactoring suggestions',
'both', 3000000.00, 0.00, 0.00, 0, 1, 'one_time_only', 0, 7, 1, 14, 0, 0, 1, NOW(), NOW());

-- ============================================================================
-- SECTION 10: SERVICES - E-COMMERCE SOLUTIONS (30+ Services)
-- ============================================================================

INSERT INTO `services` (
    `category_id`, `name`, `slug`, `description`, `short_description`,
    `pricing_model`, `one_time_price`, `monthly_price`, `setup_fee`,
    `source_code_included`, `ownership_transfer`, `billing_cycle`, `min_commitment`,
    `delivery_time_days`, `revision_limit`, `support_duration_days`,
    `is_popular`, `is_featured`, `is_active`, `created_at`, `updated_at`
) VALUES

-- Basic E-Commerce
(9, 'Toko Online Starter', 'toko-online-starter',
'Toko online basic dengan WooCommerce/Shopify: 50 products, shopping cart, checkout, 1 payment gateway, shipping calculator, dan mobile responsive.',
'Toko online 50 produk dengan payment gateway',
'both', 3500000.00, 350000.00, 0.00, 1, 1, 'monthly', 0, 14, 3, 90, 1, 1, 1, NOW(), NOW()),

(9, 'Toko Online Professional', 'toko-online-professional',
'Toko online menengah: 500 products, multi payment gateway (Midtrans, QRIS, Transfer), inventory management, promo/discount engine, customer accounts.',
'Toko online 500 produk multi payment',
'both', 8000000.00, 650000.00, 0.00, 1, 1, 'monthly', 0, 30, 4, 180, 1, 1, 1, NOW(), NOW()),

(9, 'Toko Online Enterprise', 'toko-online-enterprise',
'Toko online enterprise: unlimited products, multi-vendor support, advanced inventory, multi-warehouse, ERP integration, custom features.',
'Toko online enterprise unlimited multi-vendor',
'both', 25000000.00, 1500000.00, 0.00, 1, 1, 'monthly', 0, 90, 5, 365, 0, 1, 1, NOW(), NOW()),

-- Marketplace
(9, 'Marketplace 2-Sided Basic', 'marketplace-basic',
'Marketplace buyer-seller basic: vendor registration, product management per vendor, commission system, order management, admin dashboard.',
'Marketplace 2-sided dengan commission system',
'both', 15000000.00, 1200000.00, 0.00, 1, 1, 'monthly', 0, 60, 5, 365, 1, 1, 1, NOW(), NOW()),

(9, 'Marketplace Multi-Vendor Advanced', 'marketplace-advanced',
'Marketplace lengkap: multi-vendor, vendor tiers, complex commission rules, vendor analytics, payout management, review system, chat integration.',
'Marketplace advanced dengan vendor analytics',
'both', 35000000.00, 2500000.00, 0.00, 1, 1, 'monthly', 0, 120, 5, 365, 0, 1, 1, NOW(), NOW()),

(9, 'Marketplace Custom Solution', 'marketplace-custom',
'Marketplace custom untuk niche spesifik: consultation, custom features, integration requirements, scalable architecture, dan launch support.',
'Marketplace custom untuk niche spesifik',
'both', 50000000.00, 3000000.00, 0.00, 1, 1, 'monthly', 0, 180, 10, 365, 0, 1, 1, NOW(), NOW()),

-- Payment Integration
(9, 'Payment Gateway Integration', 'payment-gateway-integration',
'Integrasi payment gateway (Midtrans/Xendit/DOKU): setup, testing, webhook configuration, multiple payment methods, dan documentation.',
'Payment gateway integration multiple methods',
'both', 2000000.00, 0.00, 0.00, 1, 1, 'one_time_only', 0, 7, 2, 30, 1, 1, 1, NOW(), NOW()),

(9, 'Multi Payment Gateway Setup', 'multi-payment-setup',
'Setup multiple payment options: credit card, bank transfer, e-wallet (GoPay, OVO, Dana), QRIS, COD, installment, automatic verification.',
'Multi payment: card, transfer, e-wallet, QRIS',
'both', 3500000.00, 0.00, 0.00, 1, 1, 'one_time_only', 0, 10, 2, 60, 1, 0, 1, NOW(), NOW()),

(9, 'Subscription & Recurring Payment', 'subscription-payment',
'Subscription payment system: recurring billing, trial periods, plan management, upgrade/downgrade, cancellation handling, dunning management.',
'Subscription dengan recurring billing',
'both', 5000000.00, 0.00, 0.00, 1, 1, 'one_time_only', 0, 14, 3, 90, 0, 1, 1, NOW(), NOW()),

(9, 'Installment & Buy Now Pay Later', 'installment-bnpl',
'Integrasi cicilan (Kredivo/Akulaku) dan BNPL: installment options, approval automation, payment tracking, dan reminder system.',
'Installment & BNPL integration',
'both', 3000000.00, 0.00, 0.00, 1, 1, 'one_time_only', 0, 10, 2, 60, 0, 0, 1, NOW(), NOW()),

-- Inventory & Logistics
(9, 'Inventory Management System', 'inventory-management',
'Inventory system: stock tracking, low stock alerts, purchase orders, supplier management, stock reports, dan barcode integration.',
'Inventory dengan stock tracking & alerts',
'both', 8000000.00, 750000.00, 0.00, 1, 1, 'monthly', 0, 30, 4, 180, 1, 1, 1, NOW(), NOW()),

(9, 'Multi-Warehouse Management', 'multi-warehouse',
'Multi-warehouse system: stock per location, transfer orders, centralized reporting, warehouse-specific pricing, dan allocation logic.',
'Multi-warehouse dengan stock per location',
'both', 12000000.00, 1000000.00, 0.00, 1, 1, 'monthly', 0, 45, 4, 180, 0, 1, 1, NOW(), NOW()),

(9, 'Shipping Integration (JNE/SiCepat)', 'shipping-integration',
'Integrasi ekspedisi: JNE, SiCepat, J&T, JNT, automatic shipping cost calculation, resi tracking, pickup request, dan label printing.',
'Shipping integration dengan auto cost calculation',
'both', 3000000.00, 300000.00, 0.00, 1, 1, 'monthly', 0, 10, 2, 90, 1, 1, 1, NOW(), NOW()),

(9, 'Order Tracking System', 'order-tracking',
'Order tracking untuk customer: real-time status, email/WA notifications, tracking page, estimated delivery, dan delivery confirmation.',
'Order tracking real-time dengan notifications',
'both', 2500000.00, 0.00, 0.00, 1, 1, 'one_time_only', 0, 7, 2, 60, 1, 0, 1, NOW(), NOW()),

-- Customer Features
(9, 'Customer Loyalty Program', 'loyalty-program',
'Loyalty & rewards system: point accumulation, tier levels, reward redemption, referral bonuses, dan gamification features.',
'Loyalty program dengan point & rewards',
'both', 5000000.00, 500000.00, 0.00, 1, 1, 'monthly', 0, 21, 3, 120, 1, 1, 1, NOW(), NOW()),

(9, 'Product Review & Rating', 'product-review-system',
'Review system lengkap: star ratings, written reviews, photo reviews, verified purchase badge, review moderation, dan helpful voting.',
'Review system dengan photo & moderation',
'both', 2000000.00, 0.00, 0.00, 1, 1, 'one_time_only', 0, 7, 2, 30, 1, 0, 1, NOW(), NOW()),

(9, 'Wishlist & Favorites', 'wishlist-favorites',
'Wishlist system: save favorite products, share wishlist, price drop alerts, back-in-stock notification, dan wishlist analytics.',
'Wishlist dengan price alerts & notifications',
'both', 1500000.00, 0.00, 0.00, 1, 1, 'one_time_only', 0, 5, 2, 30, 1, 0, 1, NOW(), NOW()),

(9, 'Live Chat for E-Commerce', 'ecommerce-live-chat',
'Live chat integration: real-time customer support, product inquiry, order status check, chat history, dan mobile app support.',
'Live chat dengan product inquiry support',
'both', 2500000.00, 350000.00, 0.00, 1, 1, 'monthly', 0, 7, 2, 90, 1, 0, 1, NOW(), NOW()),

-- Marketing Features
(9, 'Abandoned Cart Recovery', 'abandoned-cart-recovery',
'Abandoned cart automation: cart tracking, email reminder series, WhatsApp notifications, discount incentives, dan recovery analytics.',
'Abandoned cart dengan email & WA automation',
'both', 3000000.00, 400000.00, 0.00, 1, 1, 'monthly', 0, 10, 2, 90, 1, 1, 1, NOW(), NOW()),

(9, 'Promo & Discount Engine', 'promo-discount-engine',
'Advanced promo system: percentage/fixed discounts, BOGO, bundle deals, flash sales, coupon codes, minimum purchase rules, auto-apply.',
'Promo engine dengan flash sales & coupons',
'both', 4000000.00, 0.00, 0.00, 1, 1, 'one_time_only', 0, 14, 3, 90, 1, 1, 1, NOW(), NOW()),

(9, 'Product Recommendation Engine', 'product-recommendation',
'AI-powered recommendations: frequently bought together, similar products, personalized suggestions, trending items, dan upsell/cross-sell.',
'Product recommendation AI-powered',
'both', 6000000.00, 600000.00, 0.00, 1, 1, 'monthly', 0, 21, 3, 120, 0, 1, 1, NOW(), NOW()),

(9, 'Email Marketing for E-Commerce', 'ecommerce-email-marketing',
'E-commerce email automation: welcome series, order confirmations, shipping updates, review requests, re-engagement, dan win-back campaigns.',
'Email automation untuk e-commerce',
'both', 3500000.00, 500000.00, 0.00, 1, 1, 'monthly', 0, 10, 2, 90, 1, 0, 1, NOW(), NOW()),

-- Platform-Specific
(9, 'WooCommerce Customization', 'woocommerce-customization',
'WooCommerce custom development: custom features, theme customization, plugin development, performance optimization, dan payment integration.',
'WooCommerce customization dengan plugins',
'both', 5000000.00, 0.00, 0.00, 1, 1, 'one_time_only', 0, 21, 4, 90, 1, 1, 1, NOW(), NOW()),

(9, 'Shopify Store Setup', 'shopify-setup',
'Shopify store complete setup: theme selection & customization, app integration, product import, payment setup, shipping config, dan launch.',
'Shopify setup lengkap ready to launch',
'both', 4000000.00, 0.00, 0.00, 0, 0, 'one_time_only', 0, 14, 3, 60, 1, 1, 1, NOW(), NOW()),

(9, 'Magento E-Commerce Development', 'magento-development',
'Magento development untuk enterprise: custom theme, extensions, multi-store setup, performance optimization, dan integration capabilities.',
'Magento enterprise development',
'both', 35000000.00, 2000000.00, 0.00, 1, 1, 'monthly', 0, 120, 5, 365, 0, 1, 1, NOW(), NOW()),

(9, 'PrestaShop Development', 'prestashop-development',
'PrestaShop e-commerce: installation, theme design, module development, payment integration, shipping setup, dan multi-language.',
'PrestaShop dengan multi-language',
'both', 8000000.00, 700000.00, 0.00, 1, 1, 'monthly', 0, 30, 4, 180, 0, 0, 1, NOW(), NOW()),

-- Integrations
(9, 'POS Integration', 'pos-integration',
'POS (Point of Sale) integration dengan online store: real-time inventory sync, offline sales tracking, unified reporting, dan customer data sync.',
'POS integration dengan inventory sync',
'both', 10000000.00, 800000.00, 0.00, 1, 1, 'monthly', 0, 45, 3, 180, 0, 1, 1, NOW(), NOW()),

(9, 'ERP Integration for E-Commerce', 'erp-ecommerce-integration',
'ERP integration: SAP/Odoo/custom ERP sync, order automation, inventory sync, accounting integration, dan real-time data flow.',
'ERP integration dengan real-time sync',
'both', 20000000.00, 1500000.00, 0.00, 1, 1, 'monthly', 0, 60, 4, 365, 0, 1, 1, NOW(), NOW()),

(9, 'Marketplace Integration (Tokopedia/Shopee)', 'marketplace-integration-tokped',
'Integrasi dengan marketplace: product sync to Tokopedia/Shopee/Lazada, order centralization, inventory sync, automated fulfillment.',
'Marketplace sync Tokped/Shopee/Lazada',
'both', 5000000.00, 500000.00, 0.00, 1, 1, 'monthly', 0, 21, 3, 120, 1, 1, 1, NOW(), NOW()),

(9, 'Omnichannel E-Commerce Solution', 'omnichannel-solution',
'Omnichannel lengkap: website, mobile app, marketplace integration, social commerce, POS integration, unified customer data.',
'Omnichannel solution all platforms',
'both', 45000000.00, 3000000.00, 0.00, 1, 1, 'monthly', 0, 150, 5, 365, 0, 1, 1, NOW(), NOW());

-- ============================================================================
-- SECTION 11: SERVICES - CUSTOM SOFTWARE (30+ Services)
-- ============================================================================

INSERT INTO `services` (
    `category_id`, `name`, `slug`, `description`, `short_description`,
    `pricing_model`, `one_time_price`, `monthly_price`, `setup_fee`,
    `source_code_included`, `ownership_transfer`, `billing_cycle`, `min_commitment`,
    `delivery_time_days`, `revision_limit`, `support_duration_days`,
    `is_popular`, `is_featured`, `is_active`, `created_at`, `updated_at`
) VALUES

-- Business Management Software
(10, 'CRM System Custom', 'crm-custom',
'Customer Relationship Management custom: lead management, sales pipeline, contact management, task automation, reporting, dan email integration.',
'CRM custom dengan sales pipeline & automation',
'both', 25000000.00, 1800000.00, 0.00, 1, 1, 'monthly', 0, 90, 5, 365, 1, 1, 1, NOW(), NOW()),

(10, 'ERP System Development', 'erp-development',
'Enterprise Resource Planning: finance, inventory, HR, procurement, manufacturing, reporting - fully integrated modular system.',
'ERP lengkap fully integrated modular',
'both', 80000000.00, 5000000.00, 0.00, 1, 1, 'monthly', 0, 240, 10, 365, 0, 1, 1, NOW(), NOW()),

(10, 'HR Management System (HRIS)', 'hris-system',
'HRIS lengkap: employee database, attendance, leave management, payroll, performance review, recruitment, training management.',
'HRIS dengan payroll & performance review',
'both', 35000000.00, 2500000.00, 0.00, 1, 1, 'monthly', 0, 120, 5, 365, 1, 1, 1, NOW(), NOW()),

(10, 'Project Management Software', 'project-management-software',
'Project management tool custom: task management, gantt charts, resource allocation, time tracking, collaboration, reporting.',
'Project management dengan gantt & time tracking',
'both', 20000000.00, 1500000.00, 0.00, 1, 1, 'monthly', 0, 75, 5, 365, 0, 1, 1, NOW(), NOW()),

(10, 'Document Management System', 'document-management',
'DMS untuk manage dokumen perusahaan: upload, versioning, access control, search, approval workflow, audit trail, dan archiving.',
'DMS dengan versioning & approval workflow',
'both', 18000000.00, 1200000.00, 0.00, 1, 1, 'monthly', 0, 60, 5, 365, 0, 0, 1, NOW(), NOW()),

-- Accounting & Finance
(10, 'Accounting Software Custom', 'accounting-software',
'Software akuntansi: general ledger, AP/AR, bank reconciliation, financial reports, multi-company, multi-currency, tax calculation.',
'Accounting dengan GL, AP/AR, reports',
'both', 30000000.00, 2000000.00, 0.00, 1, 1, 'monthly', 0, 120, 5, 365, 1, 1, 1, NOW(), NOW()),

(10, 'Invoicing & Billing System', 'invoicing-billing',
'Sistem invoice & billing: quote generation, invoice creation, recurring billing, payment tracking, reminder automation, client portal.',
'Invoicing dengan recurring billing & reminders',
'both', 15000000.00, 1000000.00, 0.00, 1, 1, 'monthly', 0, 60, 5, 365, 1, 0, 1, NOW(), NOW()),

(10, 'Expense Management System', 'expense-management',
'Expense tracking: claim submission, approval workflow, receipt scanning, reimbursement tracking, budget control, expense reports.',
'Expense management dengan approval workflow',
'both', 12000000.00, 900000.00, 0.00, 1, 1, 'monthly', 0, 45, 4, 180, 0, 0, 1, NOW(), NOW()),

(10, 'POS (Point of Sale) System', 'pos-system',
'POS custom untuk retail: barcode scanning, inventory real-time, customer display, receipt printing, cash drawer integration, reporting.',
'POS retail dengan inventory real-time',
'both', 18000000.00, 1200000.00, 0.00, 1, 1, 'monthly', 0, 60, 5, 365, 1, 1, 1, NOW(), NOW()),

-- Industry-Specific
(10, 'Hospital Management System', 'hospital-management',
'HMS lengkap: patient records, appointment scheduling, pharmacy, laboratory, billing, bed management, doctor management, reports.',
'HMS dengan patient records & appointments',
'both', 60000000.00, 4000000.00, 0.00, 1, 1, 'monthly', 0, 180, 5, 365, 0, 1, 1, NOW(), NOW()),

(10, 'School Management System', 'school-management',
'SMS untuk sekolah: student records, attendance, grades, timetable, fees management, parent portal, library management, transport.',
'SMS dengan student portal & fees management',
'both', 35000000.00, 2500000.00, 0.00, 1, 1, 'monthly', 0, 120, 5, 365, 1, 1, 1, NOW(), NOW()),

(10, 'Restaurant POS & Kitchen Display', 'restaurant-pos-kds',
'POS restoran dengan KDS: order taking, kitchen display, table management, split bill, tip management, inventory tracking.',
'Restaurant POS dengan kitchen display system',
'both', 25000000.00, 1800000.00, 0.00, 1, 1, 'monthly', 0, 90, 5, 365, 1, 1, 1, NOW(), NOW()),

(10, 'Hotel Management System (PMS)', 'hotel-pms',
'Property Management System: reservation, check-in/out, room management, housekeeping, billing, channel manager, reporting.',
'Hotel PMS dengan channel manager',
'both', 45000000.00, 3000000.00, 0.00, 1, 1, 'monthly', 0, 150, 5, 365, 0, 1, 1, NOW(), NOW()),

(10, 'Real Estate Management Software', 'real-estate-software',
'Software properti: listing management, client/agent portal, property valuation, document management, commission tracking, lead management.',
'Real estate dengan listing & commission tracking',
'both', 28000000.00, 2000000.00, 0.00, 1, 1, 'monthly', 0, 105, 5, 365, 0, 1, 1, NOW(), NOW()),

-- Logistics & Supply Chain
(10, 'Warehouse Management System', 'warehouse-management',
'WMS lengkap: receiving, put-away, picking, packing, shipping, inventory tracking, barcode/RFID, reporting, integration ready.',
'WMS dengan barcode tracking & integration',
'both', 40000000.00, 2800000.00, 0.00, 1, 1, 'monthly', 0, 135, 5, 365, 0, 1, 1, NOW(), NOW()),

(10, 'Fleet Management System', 'fleet-management',
'Fleet management: vehicle tracking GPS, maintenance scheduling, fuel management, driver management, route optimization, reports.',
'Fleet management dengan GPS & route optimization',
'both', 30000000.00, 2200000.00, 0.00, 1, 1, 'monthly', 0, 120, 5, 365, 0, 1, 1, NOW(), NOW()),

(10, 'Delivery Management System', 'delivery-management',
'Delivery system: order dispatch, route optimization, driver app, customer tracking, proof of delivery, automated notifications.',
'Delivery dengan route optimization & tracking',
'both', 22000000.00, 1600000.00, 0.00, 1, 1, 'monthly', 0, 75, 5, 365, 1, 1, 1, NOW(), NOW()),

(10, 'Supply Chain Management', 'supply-chain-management',
'SCM software: procurement, vendor management, purchase orders, inventory across locations, demand forecasting, analytics.',
'SCM dengan demand forecasting & analytics',
'both', 50000000.00, 3500000.00, 0.00, 1, 1, 'monthly', 0, 165, 5, 365, 0, 1, 1, NOW(), NOW()),

-- Collaboration & Communication
(10, 'Internal Communication Platform', 'internal-communication',
'Platform komunikasi internal: chat, channels, file sharing, video call, screen sharing, integrations, mobile apps.',
'Communication platform dengan video & channels',
'both', 25000000.00, 1800000.00, 0.00, 1, 1, 'monthly', 0, 90, 5, 365, 0, 1, 1, NOW(), NOW()),

(10, 'Helpdesk/Ticketing System', 'helpdesk-ticketing',
'Helpdesk custom: ticket management, SLA tracking, knowledge base, multi-channel support (email/chat/phone), reporting, automation.',
'Helpdesk dengan SLA tracking & knowledge base',
'both', 18000000.00, 1300000.00, 0.00, 1, 1, 'monthly', 0, 60, 5, 365, 1, 1, 1, NOW(), NOW()),

(10, 'Learning Management System (LMS)', 'lms-system',
'LMS custom: course creation, video hosting, quiz/assignments, progress tracking, certificates, gamification, mobile learning.',
'LMS dengan quiz, certificates & gamification',
'both', 32000000.00, 2300000.00, 0.00, 1, 1, 'monthly', 0, 120, 5, 365, 1, 1, 1, NOW(), NOW()),

(10, 'Survey & Feedback System', 'survey-feedback-system',
'Survey platform: custom form builder, logic branching, multi-language, data visualization, export, anonymous/identified responses.',
'Survey system dengan branching & analytics',
'both', 15000000.00, 1000000.00, 0.00, 1, 1, 'monthly', 0, 60, 4, 180, 0, 0, 1, NOW(), NOW()),

-- Analytics & Reporting
(10, 'Business Intelligence Dashboard', 'bi-dashboard',
'BI dashboard custom: data integration from multiple sources, real-time dashboards, KPI tracking, drill-down reports, scheduled reports.',
'BI dashboard real-time dengan KPI tracking',
'both', 28000000.00, 2000000.00, 0.00, 1, 1, 'monthly', 0, 105, 5, 365, 0, 1, 1, NOW(), NOW()),

(10, 'Analytics & Reporting System', 'analytics-reporting',
'Analytics platform: data warehouse, ETL processes, custom reports, data visualization, export capabilities, API access.',
'Analytics dengan data warehouse & custom reports',
'both', 35000000.00, 2500000.00, 0.00, 1, 1, 'monthly', 0, 120, 5, 365, 0, 1, 1, NOW(), NOW()),

(10, 'Data Migration Service', 'data-migration',
'Data migration dari sistem lama ke baru: data extraction, transformation, validation, migration, testing, dan rollback plan.',
'Data migration dengan validation & testing',
'both', 15000000.00, 0.00, 0.00, 1, 1, 'one_time_only', 0, 60, 2, 90, 0, 1, 1, NOW(), NOW()),

-- Integration & API
(10, 'API Development & Integration', 'api-development',
'RESTful API development: endpoint design, documentation, authentication, rate limiting, versioning, testing, dan monitoring.',
'API development RESTful dengan documentation',
'both', 12000000.00, 0.00, 0.00, 1, 1, 'one_time_only', 0, 45, 4, 90, 1, 1, 1, NOW(), NOW()),

(10, 'Third-Party Integration', 'third-party-integration',
'Integrasi dengan sistem third-party: API integration, data sync, webhook setup, error handling, logging, dan monitoring.',
'Third-party integration dengan data sync',
'both', 8000000.00, 0.00, 0.00, 1, 1, 'one_time_only', 0, 30, 3, 60, 1, 0, 1, NOW(), NOW()),

(10, 'Microservices Architecture', 'microservices-architecture',
'Microservices development: service decomposition, API gateway, service mesh, containerization (Docker), orchestration (Kubernetes).',
'Microservices dengan Docker & Kubernetes',
'both', 60000000.00, 4000000.00, 0.00, 1, 1, 'monthly', 0, 180, 5, 365, 0, 1, 1, NOW(), NOW()),

-- Custom Solutions
(10, 'Custom Software Consultation', 'custom-software-consultation',
'Konsultasi software custom: requirement analysis, technology stack recommendation, architecture design, cost estimation, roadmap.',
'Software consultation dengan architecture design',
'both', 5000000.00, 0.00, 0.00, 0, 1, 'one_time_only', 0, 14, 3, 30, 1, 1, 1, NOW(), NOW()),

(10, 'MVP (Minimum Viable Product)', 'mvp-development',
'MVP development untuk startup: core features only, fast time-to-market, iterative development, user feedback integration.',
'MVP development fast time-to-market',
'both', 30000000.00, 0.00, 0.00, 1, 1, 'one_time_only', 0, 90, 5, 180, 1, 1, 1, NOW(), NOW()),

(10, 'Custom Software Full Development', 'custom-software-full',
'Full custom software dari scratch: consultation, design, development, testing, deployment, training, documentation, support 1 tahun.',
'Custom software full cycle dengan support',
'both', 100000000.00, 5000000.00, 0.00, 1, 1, 'monthly', 0, 365, 10, 365, 0, 1, 1, NOW(), NOW());

-- ============================================================================
-- 🎉 SEED DATA COMPLETE!
-- Total Services: 232+ across 10 categories
-- All with DUAL PRICING system (one_time & subscription options)
-- ============================================================================

COMMIT;
SET FOREIGN_KEY_CHECKS=1;
