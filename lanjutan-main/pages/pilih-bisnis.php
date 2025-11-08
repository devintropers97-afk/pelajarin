<?php
// Set page title
$pageTitle = 'Pilih Jenis Bisnis Anda - SITUNEO Digital Solution';
$pageDescription = 'Bingung pilih website yang cocok? Pilih jenis bisnis Anda, kami bantu carikan solusi terbaik!';

// Include header
include __DIR__ . '/../includes/header.php';
?>

<!-- Hero Section -->
<section class="business-hero">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold text-white mb-3" data-aos="fade-up">
                Bingung Mau Bikin Website Apa?
            </h1>
            <p class="lead text-light mb-4" data-aos="fade-up" data-aos-delay="100" style="font-size: 1.3rem;">
                Tenang! Gak perlu ngerti teknologi 🙂<br>
                <strong class="text-gold">Pilih bisnis Anda di bawah</strong>, kami bantu carikan solusi terbaik
            </p>
        </div>
    </div>
</section>

<!-- Business Categories -->
<section class="py-5" style="background: var(--dark-blue);">
    <div class="container">
        <div class="row g-4">

            <!-- 1. Toko/Jualan Produk -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <a href="/solutions/toko-online" class="text-decoration-none">
                    <div class="business-card">
                        <span class="business-icon">🏪</span>
                        <h3 class="business-title">Saya Punya<br>TOKO/JUALAN PRODUK</h3>
                        <p class="business-examples">Fashion, Elektronik, Kosmetik,<br>Alat Rumah Tangga, dll</p>
                        <div class="business-solution">Website Toko Online</div>
                        <p class="business-price">Mulai 350rb/bulan</p>
                        <p class="text-light mt-3" style="font-size: 0.9rem;">
                            <i class="bi bi-check-circle text-gold me-2"></i>Persis kayak Tokopedia<br>
                            <i class="bi bi-check-circle text-gold me-2"></i>Ongkir otomatis<br>
                            <i class="bi bi-check-circle text-gold me-2"></i>Jualan 24 jam
                        </p>
                    </div>
                </a>
            </div>

            <!-- 2. Resto/Cafe -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <a href="/solutions/resto-online" class="text-decoration-none">
                    <div class="business-card">
                        <span class="business-icon">🍔</span>
                        <h3 class="business-title">Saya Punya<br>RESTO/CAFE/WARUNG</h3>
                        <p class="business-examples">Restoran, Cafe, Catering,<br>Bakery, Kedai Minuman</p>
                        <div class="business-solution">Website Resto + Online Order</div>
                        <p class="business-price">Mulai 250rb/bulan</p>
                        <p class="text-light mt-3" style="font-size: 0.9rem;">
                            <i class="bi bi-check-circle text-gold me-2"></i>Menu digital + QR code<br>
                            <i class="bi bi-check-circle text-gold me-2"></i>Pesan online delivery<br>
                            <i class="bi bi-check-circle text-gold me-2"></i>Booking meja
                        </p>
                    </div>
                </a>
            </div>

            <!-- 3. Perusahaan -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <a href="/solutions/company-profile" class="text-decoration-none">
                    <div class="business-card">
                        <span class="business-icon">🏢</span>
                        <h3 class="business-title">Saya Punya<br>PERUSAHAAN/KANTOR</h3>
                        <p class="business-examples">PT, CV, Kontraktor, Pabrik,<br>Yayasan, Konsultan</p>
                        <div class="business-solution">Website Company Profile</div>
                        <p class="business-price">Mulai 150rb/bulan</p>
                        <p class="text-light mt-3" style="font-size: 0.9rem;">
                            <i class="bi bi-check-circle text-gold me-2"></i>Kelihatan profesional<br>
                            <i class="bi bi-check-circle text-gold me-2"></i>Portfolio project<br>
                            <i class="bi bi-check-circle text-gold me-2"></i>Lowongan kerja
                        </p>
                    </div>
                </a>
            </div>

            <!-- 4. Klinik/Praktek -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <a href="/solutions/klinik-online" class="text-decoration-none">
                    <div class="business-card">
                        <span class="business-icon">💊</span>
                        <h3 class="business-title">Saya Punya<br>KLINIK/PRAKTEK DOKTER</h3>
                        <p class="business-examples">Klinik, Dokter, Apotek,<br>Lab, Kecantikan</p>
                        <div class="business-solution">Website Klinik + Appointment</div>
                        <p class="business-price">Mulai 500rb/bulan</p>
                        <p class="text-light mt-3" style="font-size: 0.9rem;">
                            <i class="bi bi-check-circle text-gold me-2"></i>Booking online<br>
                            <i class="bi bi-check-circle text-gold me-2"></i>Antrian online<br>
                            <i class="bi bi-check-circle text-gold me-2"></i>Jadwal dokter
                        </p>
                    </div>
                </a>
            </div>

            <!-- 5. Bisnis Digital -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                <a href="/solutions/bisnis-digital" class="text-decoration-none">
                    <div class="business-card">
                        <span class="business-icon">🎮</span>
                        <h3 class="business-title">Saya Mau Bikin<br>BISNIS DIGITAL</h3>
                        <p class="business-examples">Top-up game, Pulsa/Token,<br>Akun Premium, Kursus Online</p>
                        <div class="business-solution">Digital Product System</div>
                        <p class="business-price">Mulai 10 juta</p>
                        <p class="text-light mt-3" style="font-size: 0.9rem;">
                            <i class="bi bi-check-circle text-gold me-2"></i>100% autopilot<br>
                            <i class="bi bi-check-circle text-gold me-2"></i>Pembayaran otomatis<br>
                            <i class="bi bi-check-circle text-gold me-2"></i>Kirim produk otomatis
                        </p>
                    </div>
                </a>
            </div>

            <!-- 6. Property/Agen -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                <a href="/solutions/property-listing" class="text-decoration-none">
                    <div class="business-card">
                        <span class="business-icon">🏠</span>
                        <h3 class="business-title">Saya Agen<br>PROPERTY/MOBIL</h3>
                        <p class="business-examples">Real Estate, Dealer Mobil,<br>Rental, Travel, Wedding</p>
                        <div class="business-solution">Website Listing + Booking</div>
                        <p class="business-price">Mulai 500rb/bulan</p>
                        <p class="text-light mt-3" style="font-size: 0.9rem;">
                            <i class="bi bi-check-circle text-gold me-2"></i>Listing unlimited<br>
                            <i class="bi bi-check-circle text-gold me-2"></i>Virtual tour 360°<br>
                            <i class="bi bi-check-circle text-gold me-2"></i>Calculator KPR
                        </p>
                    </div>
                </a>
            </div>

            <!-- 7. Sekolah/Kursus -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="700">
                <a href="/solutions/sekolah-online" class="text-decoration-none">
                    <div class="business-card">
                        <span class="business-icon">📚</span>
                        <h3 class="business-title">Saya Punya<br>SEKOLAH/KURSUS</h3>
                        <p class="business-examples">Sekolah, Bimbel, Kursus,<br>Training Center, Daycare</p>
                        <div class="business-solution">Website Sekolah + E-Learning</div>
                        <p class="business-price">Mulai 750rb/bulan</p>
                        <p class="text-light mt-3" style="font-size: 0.9rem;">
                            <i class="bi bi-check-circle text-gold me-2"></i>PPDB online<br>
                            <i class="bi bi-check-circle text-gold me-2"></i>SPP online<br>
                            <i class="bi bi-check-circle text-gold me-2"></i>E-learning system
                        </p>
                    </div>
                </a>
            </div>

            <!-- 8. Belum Tau -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="800">
                <a href="https://wa.me/<?= SITE_WHATSAPP ?>?text=Halo%20SITUNEO,%20saya%20mau%20konsultasi,%20bisnis%20saya%20[isi],%20butuh%20website%20yang%20gimana%20ya?" class="text-decoration-none" target="_blank">
                    <div class="business-card" style="border-color: var(--whatsapp-green);">
                        <span class="business-icon">🤔</span>
                        <h3 class="business-title">Saya<br>GAK TAU BUTUH APA</h3>
                        <p class="business-examples">Bingung? Bisnis saya unik?<br>Mau konsultasi dulu?</p>
                        <div class="business-solution" style="background: var(--whatsapp-green);">Konsultasi GRATIS</div>
                        <p class="business-price" style="color: var(--whatsapp-green);">Via WhatsApp 24/7</p>
                        <p class="text-light mt-3" style="font-size: 0.9rem;">
                            <i class="bi bi-whatsapp text-success me-2"></i>Chat langsung<br>
                            <i class="bi bi-whatsapp text-success me-2"></i>Respon 1 menit<br>
                            <i class="bi bi-whatsapp text-success me-2"></i>100% GRATIS
                        </p>
                    </div>
                </a>
            </div>

        </div>
    </div>
</section>

<!-- Search Helper Section -->
<section class="search-helper py-5">
    <div class="container">
        <h2 class="text-center text-white fw-bold mb-5" data-aos="fade-up">
            <i class="bi bi-search text-gold me-2"></i>
            "Saya Mau Bikin Kayak..."
        </h2>

        <div class="row">
            <div class="col-lg-6 mb-3" data-aos="fade-up" data-aos-delay="100">
                <div class="search-item">
                    <span class="search-query">"Saya mau bikin kayak TOKOPEDIA"</span>
                    <span class="search-arrow">→</span>
                    <span class="search-result">Website Toko Online / Marketplace</span>
                </div>
            </div>

            <div class="col-lg-6 mb-3" data-aos="fade-up" data-aos-delay="150">
                <div class="search-item">
                    <span class="search-query">"Saya mau bikin kayak GOJEK"</span>
                    <span class="search-arrow">→</span>
                    <span class="search-result">Aplikasi On-Demand + Multi Service</span>
                </div>
            </div>

            <div class="col-lg-6 mb-3" data-aos="fade-up" data-aos-delay="200">
                <div class="search-item">
                    <span class="search-query">"Saya mau bikin kayak TRAVELOKA"</span>
                    <span class="search-arrow">→</span>
                    <span class="search-result">Website Booking + Payment Gateway</span>
                </div>
            </div>

            <div class="col-lg-6 mb-3" data-aos="fade-up" data-aos-delay="250">
                <div class="search-item">
                    <span class="search-query">"Saya mau bikin kayak NETFLIX"</span>
                    <span class="search-arrow">→</span>
                    <span class="search-result">Video Streaming Platform</span>
                </div>
            </div>

            <div class="col-lg-6 mb-3" data-aos="fade-up" data-aos-delay="300">
                <div class="search-item">
                    <span class="search-query">"Saya mau jualan online"</span>
                    <span class="search-arrow">→</span>
                    <span class="search-result">Produk fisik: Toko Online | Makanan: Resto Online | Jasa: Booking System</span>
                </div>
            </div>

            <div class="col-lg-6 mb-3" data-aos="fade-up" data-aos-delay="350">
                <div class="search-item">
                    <span class="search-query">"Website untuk CV/PT saya"</span>
                    <span class="search-arrow">→</span>
                    <span class="search-result">Website Company Profile</span>
                </div>
            </div>
        </div>

        <div class="text-center mt-5" data-aos="fade-up">
            <p class="text-light mb-4" style="font-size: 1.1rem;">
                Masih bingung? Gak masalah!
            </p>
            <a href="https://wa.me/<?= SITE_WHATSAPP ?>?text=Halo%20SITUNEO,%20saya%20butuh%20bantuan%20pilih%20website%20yang%20cocok" class="btn btn-lg" style="background: var(--whatsapp-green); color: white; padding: 15px 40px; font-weight: 700;" target="_blank">
                <i class="bi bi-whatsapp me-2"></i>
                Chat Admin - Kami Bantu Pilih Yang Cocok
            </a>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-5" style="background: var(--gradient-primary);">
    <div class="container text-center">
        <h2 class="text-white fw-bold mb-4" data-aos="fade-up">
            Yakin Dengan Pilihan Anda?
        </h2>
        <p class="text-light mb-4" data-aos="fade-up" data-aos-delay="100" style="font-size: 1.1rem;">
            Atau mau <strong class="text-gold">COBA DEMO GRATIS</strong> dulu sebelum memutuskan?
        </p>
        <div class="d-flex gap-3 justify-content-center flex-wrap" data-aos="fade-up" data-aos-delay="200">
            <a href="/client/demo-request" class="btn btn-gold btn-lg">
                <i class="bi bi-rocket-takeoff me-2"></i>
                Ya, Coba Demo Gratis
            </a>
            <a href="/services" class="btn btn-outline-light btn-lg">
                <i class="bi bi-grid me-2"></i>
                Lihat Semua Layanan (232+)
            </a>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
