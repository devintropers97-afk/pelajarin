-- Seed Business Categories Table
-- Comprehensive list of 53 business categories for SITUNEO Platform

INSERT INTO `business_categories` (`category_name`, `category_slug`, `parent_id`, `description`, `icon`, `is_active`, `display_order`) VALUES

-- Food & Beverage Categories
(1, 'Restoran & Cafe', 'restoran-cafe', NULL, 'Tempat makan lengkap yang menyajikan berbagai menu makanan dan minuman dengan suasana nyaman untuk pelanggan.', 'bi-cup-hot', 1, 1),
(2, 'Coffee Shop & Kedai Kopi', 'coffee-shop-kedai-kopi', NULL, 'Kedai kopi spesialis yang menyajikan berbagai jenis kopi premium dan minuman hangat lainnya.', 'bi-cup-fill', 1, 2),
(3, 'Bakery & Cake Shop', 'bakery-cake-shop', NULL, 'Toko roti dan kue yang menyediakan berbagai produk bakery segar dan kue custom untuk acara spesial.', 'bi-bag-check', 1, 3),
(4, 'Catering & Food Delivery', 'catering-food-delivery', NULL, 'Layanan katering dan pengiriman makanan untuk berbagai acara dan kebutuhan sehari-hari.', 'bi-truck', 1, 4),
(5, 'Warung Makan & Rumah Makan', 'warung-makan-rumah-makan', NULL, 'Warung makan tradisional yang menyajikan menu masakan lokal dengan harga terjangkau dan pelayanan hangat.', 'bi-egg-fried', 1, 5),

-- Accommodation & Travel
(6, 'Hotel & Resort', 'hotel-resort', NULL, 'Akomodasi penginapan lengkap dengan fasilitas premium untuk wisatawan dan pebisnis.', 'bi-building', 1, 6),
(7, 'Travel & Tour Agency', 'travel-tour-agency', NULL, 'Agen perjalanan yang menyelenggarakan paket wisata dan akomodasi untuk destinasi lokal dan internasional.', 'bi-airplane', 1, 7),
(8, 'Rental Mobil & Motor', 'rental-mobil-motor', NULL, 'Layanan penyewaan kendaraan mobil dan motor untuk keperluan perjalanan dan transportasi.', 'bi-car-front', 1, 8),

-- Health & Beauty
(9, 'Klinik & Rumah Sakit', 'klinik-rumah-sakit', NULL, 'Fasilitas kesehatan yang menyediakan layanan medis, diagnosis, dan pengobatan untuk pasien.', 'bi-hospital', 1, 9),
(10, 'Apotek & Toko Obat', 'apotek-toko-obat', NULL, 'Toko farmasi yang menjual obat-obatan, suplemen, dan produk kesehatan dengan konsultasi apoteker.', 'bi-capsule', 1, 10),
(11, 'Salon & Barbershop', 'salon-barbershop', NULL, 'Salon kecantikan dan barbershop profesional yang menyediakan layanan potong rambut dan perawatan wajah.', 'bi-scissors', 1, 11),
(12, 'Barbershop Premium', 'barbershop-premium', NULL, 'Barbershop kelas premium dengan barber berpengalaman dan produk grooming berkualitas tinggi.', 'bi-star', 1, 12),
(13, 'Spa & Massage', 'spa-massage', NULL, 'Layanan spa dan pijat terapeutik untuk relaksasi dan pemulihan tubuh dengan terapis profesional.', 'bi-droplet', 1, 13),
(14, 'Gym & Fitness', 'gym-fitness', NULL, 'Pusat kebugaran modern dengan peralatan lengkap dan instruktur bersertifikat untuk program latihan.', 'bi-heart-pulse', 1, 14),
(15, 'Skincare & Kosmetik', 'skincare-kosmetik', NULL, 'Toko kosmetik dan skincare yang menjual produk perawatan kulit dari brand ternama dan lokal.', 'bi-heart', 1, 15),
(16, 'Klinik Kecantikan', 'klinik-kecantikan', NULL, 'Klinik khusus perawatan kecantikan dengan teknologi modern untuk prosedur estetika dan rejuvenasi kulit.', 'bi-hand-thumbs-up', 1, 16),
(17, 'Optik & Kacamata', 'optik-kacamata', NULL, 'Toko optik yang menyediakan kacamata, lensa, dan layanan tes mata profesional dari optometris.', 'bi-eye', 1, 17),

-- Education & Training
(18, 'Sekolah & Pendidikan', 'sekolah-pendidikan', NULL, 'Institusi pendidikan yang menyediakan layanan pembelajaran formal untuk berbagai tingkat pendidikan.', 'bi-book', 1, 18),
(19, 'Kursus & Training Center', 'kursus-training-center', NULL, 'Pusat pelatihan yang menawarkan kursus berbagai keterampilan dan pengembangan profesional untuk masyarakat.', 'bi-person-raised-hand', 1, 19),
(20, 'Kursus Online / E-Learning', 'kursus-online-elearning', NULL, 'Platform pembelajaran online yang menyediakan kursus digital dan materi edukasi yang dapat diakses kapan saja.', 'bi-journal-arrow-up', 1, 20),

-- Professional Services
(21, 'Konsultan & Jasa Profesional', 'konsultan-jasa-profesional', NULL, 'Layanan konsultasi profesional dari para ahli di berbagai bidang bisnis dan manajemen.', 'bi-briefcase', 1, 21),
(22, 'Notaris & Lawyer', 'notaris-lawyer', NULL, 'Kantor hukum dan jasa notaris yang menangani dokumentasi dan keperluan hukum untuk klien.', 'bi-briefcase-fill', 1, 22),
(23, 'Akuntan & Konsultan Pajak', 'akuntan-konsultan-pajak', NULL, 'Layanan akuntansi dan konsultasi pajak profesional untuk manajemen keuangan bisnis yang efisien.', 'bi-calculator', 1, 23),

-- Real Estate & Construction
(24, 'Properti & Real Estate', 'properti-real-estate', NULL, 'Agen properti yang menjual, membeli, dan menyewakan rumah, ruko, dan tanah untuk kebutuhan perumahan dan bisnis.', 'bi-house', 1, 24),
(25, 'Arsitek & Kontraktor', 'arsitek-kontraktor', NULL, 'Jasa arsitektur dan kontraktor untuk desain dan pembangunan properti residential maupun komersial.', 'bi-hammer', 1, 25),

-- Fashion & Retail
(26, 'Toko Fashion & Retail', 'toko-fashion-retail', NULL, 'Toko retail yang menjual pakaian, aksesori, dan produk fashion dari berbagai brand dan desainer.', 'bi-bag-check', 1, 26),
(27, 'Toko Sepatu & Tas', 'toko-sepatu-tas', NULL, 'Toko khusus sepatu dan tas dengan berbagai pilihan model, brand, dan ukuran untuk pria dan wanita.', 'bi-shoe', 1, 27),
(28, 'Butik & Fashion Hijab', 'butik-fashion-hijab', NULL, 'Butik fashion khusus dengan koleksi pakaian islami dan hijab trendy dari desainer lokal dan internasional.', 'bi-dress', 1, 28),
(29, 'Toko Jam & Aksesoris', 'toko-jam-aksesoris', NULL, 'Toko aksesoris yang menjual jam tangan, perhiasan, dan aksesori mode dari brand ternama.', 'bi-clock', 1, 29),

-- Retail & General Merchandise
(30, 'Toko Buku & Alat Tulis', 'toko-buku-alat-tulis', NULL, 'Toko buku dan alat tulis yang menyediakan berbagai jenis buku, alat sekolah, dan perlengkapan kantor.', 'bi-pencil', 1, 30),
(31, 'Toko Komputer & Gadget', 'toko-komputer-gadget', NULL, 'Toko elektronik yang menjual komputer, laptop, smartphone, dan gadget terbaru dengan harga kompetitif.', 'bi-laptop', 1, 31),
(32, 'Toko Mainan Anak', 'toko-mainan-anak', NULL, 'Toko mainan edukatif dan hiburan anak dengan berbagai pilihan mainan aman dan berkualitas.', 'bi-joystick', 1, 32),
(33, 'Pet Shop & Grooming', 'pet-shop-grooming', NULL, 'Pet shop yang menjual hewan peliharaan, makanan, dan aksesoris, serta layanan grooming profesional.', 'bi-paw', 1, 33),
(34, 'Furniture & Interior Design', 'furniture-interior-design', NULL, 'Toko furniture dan jasa desain interior yang menyediakan furnitur modern dan layanan dekorasi rumah.', 'bi-palette', 1, 34),
(35, 'Toko Sembako', 'toko-sembako', NULL, 'Toko kebutuhan sehari-hari yang menjual bahan pokok, makanan, dan barang konsumsi lainnya dengan harga terjangkau.', 'bi-basket', 1, 35),
(36, 'Minimarket & Toko Kelontong', 'minimarket-toko-kelontong', NULL, 'Minimarket dan toko kelontong yang menyediakan kebutuhan sehari-hari dengan jam operasional panjang.', 'bi-shop', 1, 36),

-- Automotive Services
(37, 'Bengkel & Otomotif', 'bengkel-otomotif', NULL, 'Bengkel servis kendaraan yang melakukan perbaikan, pemeliharaan, dan modifikasi mobil dan motor.', 'bi-tools', 1, 37),
(38, 'Dealer Mobil & Motor', 'dealer-mobil-motor', NULL, 'Dealer penjualan kendaraan baru dan bekas dengan layanan kredit dan purna jual terpercaya.', 'bi-speedometer', 1, 38),
(39, 'Cuci Mobil & Detailing', 'cuci-mobil-detailing', NULL, 'Layanan pencucian kendaraan dan detailing profesional untuk perawatan eksterior dan interior mobil.', 'bi-sparkles', 1, 39),
(40, 'Service Laptop & HP', 'service-laptop-hp', NULL, 'Layanan perbaikan dan servis laptop, smartphone, dan gadget elektronik dengan teknisi berpengalaman.', 'bi-phone', 1, 40),

-- Security & Tech
(41, 'CCTV & Security', 'cctv-security', NULL, 'Layanan instalasi dan monitoring CCTV serta sistem keamanan terintegrasi untuk properti residential dan komersial.', 'bi-shield-lock', 1, 41),

-- Creative & Production
(42, 'Photographer & Videographer', 'photographer-videographer', NULL, 'Jasa fotografi dan videografi profesional untuk dokumentasi acara, produk, dan kebutuhan kreatif lainnya.', 'bi-camera-video', 1, 42),
(43, 'Event Organizer', 'event-organizer', NULL, 'Jasa penyelenggaraan acara profesional yang mengelola event dari konsep hingga eksekusi sempurna.', 'bi-calendar-event', 1, 43),
(44, 'Wedding Organizer', 'wedding-organizer', NULL, 'Jasa spesialis penyelenggaraan pernikahan yang merancang dan mengelola semua detail upacara pernikahan.', 'bi-heart', 1, 44),
(45, 'Florist & Toko Bunga', 'florist-toko-bunga', NULL, 'Toko bunga yang menyediakan rangkaian bunga segar dan dekorasi floral untuk berbagai acara spesial.', 'bi-flower1', 1, 45),

-- Printing & Services
(46, 'Percetakan & Digital Printing', 'percetakan-digital-printing', NULL, 'Layanan percetakan dan printing digital untuk berbagai kebutuhan advertising dan publikasi bisnis.', 'bi-printer', 1, 46),
(47, 'Konveksi & Sablon', 'konveksi-sablon', NULL, 'Usaha konveksi dan sablon yang memproduksi pakaian custom, seragam, dan merchandise bercetak.', 'bi-thread', 1, 47),
(48, 'Laundry & Cleaning Service', 'laundry-cleaning-service', NULL, 'Layanan laundry dan cleaning service profesional untuk pakaian, karpet, dan pembersihan kantor.', 'bi-broom', 1, 48),

-- IT & Digital Services
(49, 'Developer & Software House', 'developer-software-house', NULL, 'Perusahaan pengembang software yang membuat aplikasi, website, dan solusi digital custom untuk klien.', 'bi-code-slash', 1, 49),
(50, 'Digital Marketing Agency', 'digital-marketing-agency', NULL, 'Agensi digital marketing yang menyediakan layanan SEO, social media, dan advertising online untuk bisnis.', 'bi-megaphone', 1, 50),

-- E-Commerce & Platform
(51, 'Toko Online / E-Commerce', 'toko-online-ecommerce', NULL, 'Toko online yang menjual produk melalui platform digital dengan layanan pengiriman ke seluruh lokasi.', 'bi-laptop', 1, 51),
(52, 'Marketplace & Platform', 'marketplace-platform', NULL, 'Platform e-commerce yang menghubungkan penjual dan pembeli untuk transaksi jual-beli online yang aman dan mudah.', 'bi-globe', 1, 52),
(53, 'Jasa Pengiriman & Logistik', 'jasa-pengiriman-logistik', NULL, 'Jasa kurir dan logistik yang menyediakan layanan pengiriman barang ke seluruh Indonesia dan mancanegara.', 'bi-box2', 1, 53);

-- End of seed file
-- Total categories inserted: 53
