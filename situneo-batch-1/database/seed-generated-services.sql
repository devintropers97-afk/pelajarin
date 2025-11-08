-- ========================================
-- SITUNEO DIGITAL - Generated Services Seed Data
-- Sample: 20 services across different templates
-- Full 1500+ will be auto-generated via PHP installer
-- ========================================

-- Landing Page samples (5 services)
INSERT INTO `generated_services` (`template_id`, `category_id`, `service_name`, `service_slug`, `what_is_it`, `for_whom`, `price_setup`, `price_monthly`, `features`, `is_active`) VALUES
(1, 1, 'Landing Page untuk Restoran & Cafe', 'landing-page-restoran-cafe', 'Website satu halaman fokus promosi menu dan lokasi. Pengunjung bisa lihat menu, foto makanan, lokasi Maps, dan reservasi via WhatsApp!', 'Cocok untuk restoran baru, cafe, atau warung yang mau upgrade ke digital.', 350000, 150000, '["Menu Digital", "Lokasi Google Maps", "WhatsApp Order", "Galeri Foto", "Jam Buka", "Mobile Friendly"]', 1),
(1, 4, 'Landing Page untuk Salon & Barbershop', 'landing-page-salon', 'Website salon dengan treatment list, harga, dan portfolio. Customer booking langsung lewat WhatsApp!', 'Cocok untuk salon, barbershop, nail salon, lash extension.', 350000, 150000, '["Daftar Treatment", "Portfolio Before-After", "Booking WhatsApp", "Promo", "Galeri", "Jam Buka"]', 1),
(1, 5, 'Landing Page untuk Toko Fashion', 'landing-page-fashion', 'Website promosi fashion dengan katalog produk. Order langsung via WhatsApp dengan foto produk menarik.', 'Cocok untuk butik online, reseller, toko baju, aksesoris.', 350000, 150000, '["Katalog Produk", "Order WhatsApp", "Galeri Fashion", "Promo Diskon", "Size Chart", "Cara Order"]', 1);

-- Company Profile samples (3 services)  
INSERT INTO `generated_services` (`template_id`, `category_id`, `service_name`, `service_slug`, `what_is_it`, `for_whom`, `price_setup`, `price_monthly`, `features`, `is_active`) VALUES
(2, 1, 'Website Company Profile Restoran', 'company-profile-restoran', 'Website lengkap 5-8 halaman untuk restoran profesional. Menu lengkap, about us, galeri, blog resep.', 'Untuk restoran established, franchise, chain cafe.', 750000, 250000, '["Homepage Hero", "Menu by Category", "About Us", "Galeri HD", "Multiple Locations", "Blog", "Reservasi", "Reviews"]', 1),
(2, 24, 'Website Company Profile IT & Software', 'company-profile-it', 'Website profesional untuk perusahaan IT dengan portfolio project, team, case studies.', 'Untuk software house, digital agency, startup tech, konsultan IT.', 975000, 325000, '["Portfolio Projects", "Team Profile", "Tech Stack", "Case Studies", "Testimonials", "Blog Tech", "Contact", "Packages"]', 1);

-- E-Commerce samples (3 services)
INSERT INTO `generated_services` (`template_id`, `category_id`, `service_name`, `service_slug`, `what_is_it`, `for_whom`, `price_setup`, `price_monthly`, `features`, `is_active`) VALUES
(3, 5, 'Toko Online Fashion Lengkap', 'ecommerce-fashion', 'Toko online dengan keranjang, payment gateway, tracking order. Customer belanja 24/7 bayar online!', 'Untuk brand fashion, reseller, toko sepatu, aksesoris serius jualan online.', 1500000, 350000, '["Product Catalog", "Shopping Cart", "Payment Gateway", "Order Management", "Customer Dashboard", "Stock Management", "Variants", "Shipping", "Wishlist", "Reviews"]', 1),
(3, 35, 'Toko Online Komputer & Gadget', 'ecommerce-gadget', 'Toko online elektronik dengan spesifikasi detail, compare product, warranty info.', 'Untuk toko komputer, dealer gadget, distributor elektronik.', 1650000, 385000, '["Specs Detail", "Compare Products", "Warranty Info", "Payment", "Stock Real-time", "Shipping Calculator", "Reviews", "Dashboard", "Invoice"]', 1);

-- Booking System samples (3 services)
INSERT INTO `generated_services` (`template_id`, `category_id`, `service_name`, `service_slug`, `what_is_it`, `for_whom`, `price_setup`, `price_monthly`, `features`, `is_active`) VALUES
(6, 3, 'Sistem Booking Online Klinik', 'booking-klinik', 'Booking appointment online. Pasien pilih dokter, jam, dapat konfirmasi auto via email/WhatsApp.', 'Untuk klinik umum, gigi, kecantikan, dokter spesialis.', 1560000, 520000, '["Kalender Dokter", "Booking by Doctor", "Email/SMS Confirm", "Patient Dashboard", "Reminder", "Payment", "Medical Records", "Admin Panel"]', 1),
(6, 4, 'Sistem Booking Salon & Spa', 'booking-salon', 'Booking treatment salon pilih terapis, treatment, kalkulasi harga auto. Customer dapat reminder H-1.', 'Untuk salon besar, spa, massage, nail salon.', 1200000, 400000, '["Pilih Treatment", "Pilih Terapis", "Availability", "Price Calculator", "Confirmation", "Reminder", "History", "Membership"]', 1);

-- Portfolio samples (2 services)
INSERT INTO `generated_services` (`template_id`, `category_id`, `service_name`, `service_slug`, `what_is_it`, `for_whom`, `price_setup`, `price_monthly`, `features`, `is_active`) VALUES
(4, 11, 'Website Portfolio Fotografer', 'portfolio-photographer', 'Portfolio showcase hasil foto dengan galeri HD, kategori (wedding, product, event), booking form.', 'Untuk fotografer profesional, videografer, content creator.', 700000, 200000, '["Photo Gallery HD", "Category by Type", "Lightbox", "About Me", "Services", "Testimonials", "Booking", "Instagram Feed"]', 1),
(4, 29, 'Website Portfolio Arsitek', 'portfolio-arsitek', 'Portfolio project arsitektur dengan before-after dan virtual tour 3D.', 'Untuk arsitek, kontraktor, interior designer, developer.', 910000, 260000, '["Project Gallery", "Before-After", "Virtual Tour 3D", "Details", "Services", "Reviews", "Download PDF", "Contact"]', 1);

-- LMS sample (1 service)
INSERT INTO `generated_services` (`template_id`, `category_id`, `service_name`, `service_slug`, `what_is_it`, `for_whom`, `price_setup`, `price_monthly`, `features`, `is_active`) VALUES
(7, 26, 'Platform E-Learning Kursus Online', 'lms-kursus', 'Platform belajar online dengan video course, quiz, sertifikat digital. Kayak Udemy punya sendiri!', 'Untuk lembaga kursus, trainer, guru les, educator.', 2600000, 650000, '["Video Course", "Quiz & Exam", "Progress Tracking", "Certificate", "Student Dashboard", "Instructor Panel", "Forum", "Payment"]', 1);

-- Directory/Marketplace sample (1 service)
INSERT INTO `generated_services` (`template_id`, `category_id`, `service_name`, `service_slug`, `what_is_it`, `for_whom`, `price_setup`, `price_monthly`, `features`, `is_active`) VALUES
(8, 53, 'Website Marketplace Multi-Vendor', 'marketplace-multi-vendor', 'Platform marketplace banyak seller bisa jualan. Kayak Tokopedia versi sendiri! Ada komisi per transaksi.', 'Untuk pengusaha bikin marketplace lokal, komunitas, niche market.', 1300000, 455000, '["Multi-vendor", "Vendor Dashboard", "Product Management", "Order Processing", "Commission", "Payment", "Rating", "Reports"]', 1);

-- Dashboard/SaaS sample (1 service)
INSERT INTO `generated_services` (`template_id`, `category_id`, `service_name`, `service_slug`, `what_is_it`, `for_whom`, `price_setup`, `price_monthly`, `features`, `is_active`) VALUES
(9, 24, 'Dashboard Admin Panel Custom', 'dashboard-admin', 'Dashboard admin untuk manage data dengan grafik, chart, export report. Customize sesuai kebutuhan.', 'Untuk perusahaan butuh sistem internal, startup SaaS, bisnis banyak data.', 3250000, 780000, '["Custom Layout", "Charts & Analytics", "User Management", "Role-based Access", "Export Reports", "API", "Real-time", "Mobile Responsive"]', 1);

-- Custom Web App sample (1 service)
INSERT INTO `generated_services` (`template_id`, `category_id`, `service_name`, `service_slug`, `what_is_it`, `for_whom`, `price_setup`, `price_monthly`, `features`, `is_active`) VALUES
(10, 6, 'Aplikasi Custom Portal Properti', 'custom-property-portal', 'Aplikasi custom listing properti dengan virtual tour 360°, KPR calculator, agent management.', 'Untuk developer properti, agency real estate, startup proptech.', 3900000, 1040000, '["Property Listing", "Virtual Tour 360", "KPR Calculator", "Agent Management", "Lead Management", "Advanced Search", "Wishlist", "Mobile App Ready", "Maps Integration"]', 1);
