-- ========================================
-- SITUNEO DIGITAL - Portfolio Demos
-- 50 Demo Websites for Showcase
-- BATCH 4
-- ========================================
--
-- Demo URLs Structure:
-- https://demo.situneo.my.id/[category]/[demo-name]/
--
-- All demos are fully functional and can be shown to clients
-- Each demo represents a real use-case scenario
--
-- ========================================

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Clear existing portfolio (optional for fresh install)
-- TRUNCATE TABLE `portfolios`;

-- ========================================
-- INSERT 50 PORTFOLIO DEMOS
-- ========================================

INSERT INTO `portfolios` (`title`, `slug`, `category`, `client_name`, `project_type`, `description`, `image`, `demo_url`, `technologies`, `completion_date`, `featured`, `display_order`, `is_active`) VALUES

-- CATEGORY: Restoran & F&B (8 demos)
('Restoran Padang Sederhana', 'restoran-padang-sederhana', 'Restaurant', 'Demo Client', 'Landing Page', 'Website landing page untuk restoran Padang dengan menu digital, lokasi, dan WhatsApp order', 'demo-restoran-padang.jpg', 'https://demo.situneo.my.id/restaurant/padang-sederhana/', '["HTML", "CSS", "JavaScript", "Bootstrap", "WhatsApp API"]', '2024-01-15', 1, 1, 1),

('Kafe Kopi Modern', 'kafe-kopi-modern', 'Cafe', 'Demo Client', 'Multi-page Website', 'Website kafe kopi modern dengan menu, gallery, booking meja, dan blog', 'demo-cafe-kopi.jpg', 'https://demo.situneo.my.id/cafe/kopi-modern/', '["WordPress", "WooCommerce", "Elementor", "Booking Plugin"]', '2024-01-20', 1, 2, 1),

('Catering Nusantara', 'catering-nusantara', 'Catering', 'Demo Client', 'Company Profile', 'Website catering dengan paket menu, portofolio event, dan sistem pemesanan', 'demo-catering.jpg', 'https://demo.situneo.my.id/catering/nusantara/', '["PHP", "MySQL", "Bootstrap", "Google Calendar API"]', '2024-02-01', 0, 3, 1),

('Bakery & Cake Shop', 'bakery-cake-shop', 'Bakery', 'Demo Client', 'E-Commerce', 'Toko online kue dan roti dengan katalog produk dan payment gateway', 'demo-bakery.jpg', 'https://demo.situneo.my.id/bakery/cake-shop/', '["WooCommerce", "Midtrans", "Stock Management"]', '2024-02-10', 1, 4, 1),

('Cloud Kitchen Express', 'cloud-kitchen-express', 'Cloud Kitchen', 'Demo Client', 'Online Ordering', 'Platform online ordering untuk cloud kitchen dengan multiple menus', 'demo-cloud-kitchen.jpg', 'https://demo.situneo.my.id/food/cloud-kitchen/', '["React", "Node.js", "MongoDB", "Stripe"]', '2024-02-15', 0, 5, 1),

('Sushi Bar Premium', 'sushi-bar-premium', 'Japanese Restaurant', 'Demo Client', 'Booking System', 'Website sushi bar dengan reservasi online dan omakase menu', 'demo-sushi.jpg', 'https://demo.situneo.my.id/restaurant/sushi-bar/', '["PHP", "MySQL", "Booking Calendar", "Payment Integration"]', '2024-02-20', 0, 6, 1),

('Warung Makan Tradisional', 'warung-makan-tradisional', 'Warung', 'Demo Client', 'Landing Page', 'Landing page sederhana untuk warung makan dengan menu dan lokasi', 'demo-warung.jpg', 'https://demo.situneo.my.id/warung/tradisional/', '["HTML", "CSS", "JavaScript", "Google Maps"]', '2024-02-25', 0, 7, 1),

('Juice Bar Healthy', 'juice-bar-healthy', 'Beverage', 'Demo Client', 'Product Catalog', 'Website juice bar dengan katalog minuman sehat dan nutrition facts', 'demo-juice.jpg', 'https://demo.situneo.my.id/beverage/juice-bar/', '["WordPress", "Custom Post Type", "Nutrition Database"]', '2024-03-01', 0, 8, 1),

-- CATEGORY: Hotel & Hospitality (5 demos)
('Villa Bali Tropical', 'villa-bali-tropical', 'Villa', 'Demo Client', 'Booking Website', 'Website booking villa dengan virtual tour 360 dan kalender ketersediaan', 'demo-villa-bali.jpg', 'https://demo.situneo.my.id/hospitality/villa-bali/', '["PHP", "MySQL", "Booking Engine", "Virtual Tour 360"]', '2024-03-05', 1, 9, 1),

('Hotel Boutique Jakarta', 'hotel-boutique-jakarta', 'Hotel', 'Demo Client', 'Hotel Website', 'Website hotel boutique dengan room booking, gallery, dan payment gateway', 'demo-hotel-boutique.jpg', 'https://demo.situneo.my.id/hospitality/hotel-jakarta/', '["WordPress", "Booking System", "Payment Gateway", "Multi-language"]', '2024-03-10', 1, 10, 1),

('Homestay Jogja', 'homestay-jogja', 'Homestay', 'Demo Client', 'Booking Platform', 'Platform booking homestay dengan review dan rating system', 'demo-homestay.jpg', 'https://demo.situneo.my.id/hospitality/homestay-jogja/', '["Laravel", "MySQL", "Rating System", "Review Module"]', '2024-03-15', 0, 11, 1),

('Resort Pantai Lombok', 'resort-pantai-lombok', 'Resort', 'Demo Client', 'Resort Website', 'Website resort mewah dengan package deals dan activity booking', 'demo-resort.jpg', 'https://demo.situneo.my.id/hospitality/resort-lombok/', '["Next.js", "Headless CMS", "Booking API", "Payment Integration"]', '2024-03-20', 0, 12, 1),

('Guest House Budget', 'guest-house-budget', 'Guest House', 'Demo Client', 'Simple Booking', 'Website guest house sederhana dengan harga terjangkau', 'demo-guesthouse.jpg', 'https://demo.situneo.my.id/hospitality/guesthouse/', '["HTML", "PHP", "MySQL", "WhatsApp Integration"]', '2024-03-25', 0, 13, 1),

-- CATEGORY: Kesehatan & Medis (5 demos)
('Klinik Umum Sehat', 'klinik-umum-sehat', 'Clinic', 'Demo Client', 'Clinic Website', 'Website klinik dengan jadwal dokter, booking appointment, dan artikel kesehatan', 'demo-klinik.jpg', 'https://demo.situneo.my.id/healthcare/klinik-umum/', '["PHP", "MySQL", "Doctor Schedule", "Appointment System"]', '2024-04-01', 1, 14, 1),

('Apotek Online 24 Jam', 'apotek-online-24', 'Pharmacy', 'Demo Client', 'E-Commerce Pharmacy', 'Apotek online dengan katalog obat, resep upload, dan delivery tracking', 'demo-apotek.jpg', 'https://demo.situneo.my.id/healthcare/apotek-online/', '["WooCommerce", "Prescription Upload", "Delivery Tracking"]', '2024-04-05', 1, 15, 1),

('Klinik Kecantikan Elite', 'klinik-kecantikan-elite', 'Beauty Clinic', 'Demo Client', 'Beauty Clinic', 'Website klinik kecantikan dengan treatment list, before-after, dan booking', 'demo-beauty-clinic.jpg', 'https://demo.situneo.my.id/healthcare/beauty-clinic/', '["WordPress", "Gallery Plugin", "Booking System", "WhatsApp"]', '2024-04-10', 0, 16, 1),

('Laboratorium Medis', 'lab-medis', 'Laboratory', 'Demo Client', 'Lab Website', 'Website lab dengan daftar tes, harga, dan home service booking', 'demo-lab.jpg', 'https://demo.situneo.my.id/healthcare/lab-medis/', '["PHP", "MySQL", "Test Database", "Booking Calendar"]', '2024-04-15', 0, 17, 1),

('Praktek Dokter Spesialis', 'dokter-spesialis', 'Doctor Practice', 'Demo Client', 'Doctor Website', 'Website dokter spesialis dengan profil, jadwal praktek, dan online consultation', 'demo-doctor.jpg', 'https://demo.situneo.my.id/healthcare/dokter-spesialis/', '["WordPress", "Appointment Plugin", "Video Call Integration"]', '2024-04-20', 0, 18, 1),

-- CATEGORY: Fashion & Retail (6 demos)
('Butik Fashion Wanita', 'butik-fashion-wanita', 'Fashion', 'Demo Client', 'E-Commerce Fashion', 'Online shop fashion wanita dengan size chart, wishlist, dan multiple payment', 'demo-fashion.jpg', 'https://demo.situneo.my.id/fashion/butik-wanita/', '["WooCommerce", "Size Chart", "Wishlist", "Payment Gateway"]', '2024-04-25', 1, 19, 1),

('Toko Sepatu Sport', 'toko-sepatu-sport', 'Footwear', 'Demo Client', 'Shoe Store', 'Website toko sepatu dengan product comparison dan size guide', 'demo-shoes.jpg', 'https://demo.situneo.my.id/fashion/sepatu-sport/', '["Shopify Alternative", "Product Comparison", "Size Guide"]', '2024-05-01', 1, 20, 1),

('Aksesoris & Jam Tangan', 'aksesoris-jam', 'Accessories', 'Demo Client', 'Accessories Shop', 'Toko online aksesoris dan jam tangan premium', 'demo-accessories.jpg', 'https://demo.situneo.my.id/fashion/aksesoris/', '["WooCommerce", "Product Variants", "Instagram Feed"]', '2024-05-05', 0, 21, 1),

('Hijab & Modest Fashion', 'hijab-modest-fashion', 'Hijab', 'Demo Client', 'Hijab Store', 'Online shop hijab dengan tutorial styling dan mix-match guide', 'demo-hijab.jpg', 'https://demo.situneo.my.id/fashion/hijab/', '["WordPress", "Video Tutorial", "Style Guide", "WhatsApp Order"]', '2024-05-10', 0, 22, 1),

('Thrift Shop Vintage', 'thrift-shop-vintage', 'Thrift', 'Demo Client', 'Thrift Store', 'Website thrift shop dengan unique items dan sustainable fashion', 'demo-thrift.jpg', 'https://demo.situneo.my.id/fashion/thrift-shop/', '["Custom E-Commerce", "Instagram Integration", "Story Features"]', '2024-05-15', 0, 23, 1),

('Konveksi & Sablon Custom', 'konveksi-sablon', 'Konveksi', 'Demo Client', 'Custom Printing', 'Website konveksi dengan design upload, price calculator, dan bulk order', 'demo-konveksi.jpg', 'https://demo.situneo.my.id/fashion/konveksi/', '["PHP", "Design Upload", "Price Calculator", "Bulk Order"]', '2024-05-20', 0, 24, 1),

-- CATEGORY: Properti & Real Estate (4 demos)
('Real Estate Premium', 'real-estate-premium', 'Real Estate', 'Demo Client', 'Property Portal', 'Portal properti dengan listing, virtual tour 360, dan KPR calculator', 'demo-property.jpg', 'https://demo.situneo.my.id/property/real-estate/', '["Laravel", "Property Listing", "Virtual Tour", "KPR Calculator"]', '2024-05-25', 1, 25, 1),

('Developer Perumahan', 'developer-perumahan', 'Developer', 'Demo Client', 'Housing Developer', 'Website developer perumahan dengan master plan dan booking unit', 'demo-developer.jpg', 'https://demo.situneo.my.id/property/developer/', '["Next.js", "3D Siteplan", "Unit Availability", "Booking System"]', '2024-06-01', 1, 26, 1),

('Kos & Apartemen', 'kos-apartemen', 'Kos', 'Demo Client', 'Kos Listing', 'Platform listing kos dan apartemen dengan filter lokasi', 'demo-kos.jpg', 'https://demo.situneo.my.id/property/kos/', '["WordPress", "Advanced Search", "Maps Integration", "Contact"]', '2024-06-05', 0, 27, 1),

('Interior Design Studio', 'interior-design', 'Interior', 'Demo Client', 'Interior Portfolio', 'Website interior designer dengan portfolio project dan 3D visualization', 'demo-interior.jpg', 'https://demo.situneo.my.id/property/interior-design/', '["Portfolio Gallery", "3D Viewer", "Project Categories", "Contact"]', '2024-06-10', 0, 28, 1),

-- CATEGORY: Pendidikan (5 demos)
('Sekolah Menengah Atas', 'sma-negeri', 'School', 'Demo Client', 'School Website', 'Website sekolah dengan profil, guru, berita, dan PPDB online', 'demo-school.jpg', 'https://demo.situneo.my.id/education/sma/', '["WordPress", "News Module", "PPDB System", "Gallery"]', '2024-06-15', 1, 29, 1),

('Bimbel & Les Privat', 'bimbel-les-privat', 'Bimbel', 'Demo Client', 'Tutoring Center', 'Website bimbel dengan program, jadwal, dan registrasi online', 'demo-bimbel.jpg', 'https://demo.situneo.my.id/education/bimbel/', '["PHP", "Class Schedule", "Registration Form", "Payment"]', '2024-06-20', 1, 30, 1),

('Kursus Online Platform', 'kursus-online', 'Online Course', 'Demo Client', 'LMS Platform', 'Platform e-learning dengan video course, quiz, dan certificate', 'demo-lms.jpg', 'https://demo.situneo.my.id/education/online-course/', '["Moodle/LearnDash", "Video Hosting", "Quiz System", "Certificate"]', '2024-06-25', 1, 31, 1),

('Kampus Universitas', 'universitas', 'University', 'Demo Client', 'University Website', 'Website universitas dengan fakultas, berita, dan portal mahasiswa', 'demo-university.jpg', 'https://demo.situneo.my.id/education/university/', '["WordPress Multisite", "Student Portal", "News", "Events"]', '2024-07-01', 0, 32, 1),

('Training Center Professional', 'training-center', 'Training', 'Demo Client', 'Training Center', 'Website training profesional dengan sertifikasi dan jadwal pelatihan', 'demo-training.jpg', 'https://demo.situneo.my.id/education/training/', '["PHP", "Course Catalog", "Certification", "Booking"]', '2024-07-05', 0, 33, 1),

-- CATEGORY: Salon & Beauty (4 demos)
('Salon Kecantikan Modern', 'salon-modern', 'Salon', 'Demo Client', 'Salon Website', 'Website salon dengan treatment list, booking online, dan membership', 'demo-salon.jpg', 'https://demo.situneo.my.id/beauty/salon/', '["WordPress", "Booking Plugin", "Membership", "Gallery"]', '2024-07-10', 1, 34, 1),

('Barbershop Pria', 'barbershop', 'Barbershop', 'Demo Client', 'Barbershop Website', 'Website barbershop dengan price list, gallery, dan booking terapis', 'demo-barbershop.jpg', 'https://demo.situneo.my.id/beauty/barbershop/', '["HTML", "PHP", "Booking System", "WhatsApp"]', '2024-07-15', 0, 35, 1),

('Spa & Massage Therapy', 'spa-massage', 'Spa', 'Demo Client', 'Spa Website', 'Website spa dengan paket treatment, therapist profile, dan voucher', 'demo-spa.jpg', 'https://demo.situneo.my.id/beauty/spa/', '["WordPress", "Package System", "Booking", "Voucher"]', '2024-07-20', 0, 36, 1),

('Nail Salon & Extension', 'nail-salon', 'Nail Salon', 'Demo Client', 'Nail Salon', 'Website nail salon dengan design gallery dan online appointment', 'demo-nail.jpg', 'https://demo.situneo.my.id/beauty/nail-salon/', '["Portfolio Gallery", "Instagram Feed", "Booking", "Price List"]', '2024-07-25', 0, 37, 1),

-- CATEGORY: Technology & IT (4 demos)
('Software House Portfolio', 'software-house', 'IT Company', 'Demo Client', 'IT Company Website', 'Website software house dengan portfolio project dan tech stack', 'demo-software.jpg', 'https://demo.situneo.my.id/tech/software-house/', '["Next.js", "Portfolio CMS", "Tech Stack", "Case Studies"]', '2024-08-01', 1, 38, 1),

('Toko Komputer & Gadget', 'toko-komputer', 'Computer Shop', 'Demo Client', 'E-Commerce Tech', 'Toko online komputer dengan spesifikasi detail dan compare product', 'demo-computer.jpg', 'https://demo.situneo.my.id/tech/computer-shop/', '["WooCommerce", "Spec Comparison", "Stock Management"]', '2024-08-05', 1, 39, 1),

('Digital Agency Creative', 'digital-agency', 'Agency', 'Demo Client', 'Agency Website', 'Website digital agency dengan services, portfolio, dan client testimonials', 'demo-agency.jpg', 'https://demo.situneo.my.id/tech/digital-agency/', '["WordPress", "Portfolio", "Team", "Testimonials"]', '2024-08-10', 0, 40, 1),

('IT Support & Services', 'it-support', 'IT Services', 'Demo Client', 'IT Services', 'Website IT support dengan service packages dan ticket system', 'demo-it-support.jpg', 'https://demo.situneo.my.id/tech/it-support/', '["PHP", "Service Packages", "Ticket System", "Knowledge Base"]', '2024-08-15', 0, 41, 1),

-- CATEGORY: Personal & Portfolio (5 demos)
('Fotografer Wedding', 'fotografer-wedding', 'Photography', 'Demo Client', 'Photographer Portfolio', 'Portfolio fotografer dengan gallery HD dan booking package', 'demo-photographer.jpg', 'https://demo.situneo.my.id/portfolio/photographer/', '["Portfolio Gallery", "Lightbox", "Booking Form", "Price Packages"]', '2024-08-20', 1, 42, 1),

('Freelance Web Developer', 'freelance-developer', 'Developer', 'Demo Client', 'Developer Portfolio', 'Portfolio web developer dengan tech stack dan project showcase', 'demo-developer-portfolio.jpg', 'https://demo.situneo.my.id/portfolio/web-developer/', '["React", "Portfolio API", "GitHub Integration", "Blog"]', '2024-08-25', 1, 43, 1),

('Desainer Grafis', 'desainer-grafis', 'Designer', 'Demo Client', 'Designer Portfolio', 'Portfolio desainer grafis dengan creative works dan client list', 'demo-designer.jpg', 'https://demo.situneo.my.id/portfolio/graphic-designer/', '["Behance Integration", "Portfolio Grid", "About", "Contact"]', '2024-09-01', 0, 44, 1),

('Content Creator & Influencer', 'content-creator', 'Influencer', 'Demo Client', 'Influencer Page', 'Landing page content creator dengan social media links dan media kit', 'demo-influencer.jpg', 'https://demo.situneo.my.id/portfolio/content-creator/', '["Link in Bio", "Social Feed", "Media Kit", "Contact"]', '2024-09-05', 0, 45, 1),

('Arsitek & Kontraktor', 'arsitek', 'Architecture', 'Demo Client', 'Architect Portfolio', 'Portfolio arsitek dengan project showcase dan virtual tour', 'demo-architect.jpg', 'https://demo.situneo.my.id/portfolio/architect/', '["Portfolio Gallery", "3D Tour", "Before-After", "Services"]', '2024-09-10', 0, 46, 1),

-- CATEGORY: Other Industries (4 demos)
('Gym & Fitness Center', 'gym-fitness', 'Fitness', 'Demo Client', 'Gym Website', 'Website gym dengan membership, class schedule, dan trainer profile', 'demo-gym.jpg', 'https://demo.situneo.my.id/other/gym/', '["WordPress", "Membership", "Class Schedule", "Trainer Profiles"]', '2024-09-15', 1, 47, 1),

('Event Organizer Professional', 'event-organizer', 'Event', 'Demo Client', 'EO Website', 'Website EO dengan portfolio event, packages, dan booking system', 'demo-event.jpg', 'https://demo.situneo.my.id/other/event-organizer/', '["Portfolio", "Package Pricing", "Booking Calendar", "Testimonials"]', '2024-09-20', 0, 48, 1),

('Travel & Tour Agency', 'travel-tour', 'Travel', 'Demo Client', 'Travel Website', 'Website travel dengan paket tour, itinerary, dan booking online', 'demo-travel.jpg', 'https://demo.situneo.my.id/other/travel/', '["Tour Packages", "Itinerary Builder", "Booking System", "Payment"]', '2024-09-25', 0, 49, 1),

('Pet Shop & Grooming', 'pet-shop', 'Pet', 'Demo Client', 'Pet Shop Website', 'Website pet shop dengan katalog produk, grooming booking, dan pet care tips', 'demo-petshop.jpg', 'https://demo.situneo.my.id/other/pet-shop/', '["WooCommerce", "Grooming Booking", "Blog", "Pet Gallery"]', '2024-09-30', 0, 50, 1);


COMMIT;

-- ========================================
-- END OF PORTFOLIO DEMOS
--
-- SUMMARY:
-- ========================================
-- Total Demos: 50
-- Categories:
-- - Restaurant & F&B: 8 demos
-- - Hotel & Hospitality: 5 demos
-- - Healthcare & Medical: 5 demos
-- - Fashion & Retail: 6 demos
-- - Property & Real Estate: 4 demos
-- - Education: 5 demos
-- - Salon & Beauty: 4 demos
-- - Technology & IT: 4 demos
-- - Personal & Portfolio: 5 demos
-- - Other Industries: 4 demos
--
-- Featured Demos: 15 (marked with featured = 1)
-- All demos fully functional and ready to show
--
-- NOTES:
-- - All demo URLs follow pattern: demo.situneo.my.id/category/slug/
-- - Images should be placed in: /assets/portfolio/
-- - Each demo showcases different features and technologies
-- - Demos cover major industries and use-cases
-- - Perfect for client presentations and sales pitches
-- ========================================
