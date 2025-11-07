<?php
// Set page title
$pageTitle = 'Website Toko Online - Jualan 24 Jam Nonstop | SITUNEO';
$pageDescription = 'Website toko online persis kayak Tokopedia, tapi khusus untuk toko Anda. Ongkir otomatis, payment gateway, unlimited produk. Mulai 350rb/bulan!';

// Include header
include __DIR__ . '/../../includes/header.php';
?>

<style>
.solution-hero {
    padding: 150px 0 80px;
    background: var(--gradient-primary);
    position: relative;
}

.solution-icon-big {
    font-size: 100px;
    display: inline-block;
    animation: float 3s ease-in-out infinite;
}

.comparison-section {
    background: rgba(255, 255, 255, 0.05);
    border-radius: 20px;
    padding: 40px;
    margin: 30px 0;
}

.comparison-col {
    padding: 30px;
    border-radius: 15px;
}

.comparison-col.before {
    background: rgba(255, 0, 0, 0.1);
    border: 2px solid rgba(255, 0, 0, 0.3);
}

.comparison-col.after {
    background: rgba(0, 255, 0, 0.1);
    border: 2px solid rgba(0, 255, 0, 0.3);
}

.feature-card {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(212, 175, 55, 0.2);
    border-radius: 15px;
    padding: 30px;
    height: 100%;
    transition: all 0.3s ease;
}

.feature-card:hover {
    border-color: var(--gold);
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(212, 175, 55, 0.3);
}

.step-number {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: var(--gradient-gold);
    color: var(--dark-blue);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
    font-size: 1.5rem;
    margin-bottom: 20px;
}

.example-card {
    background: rgba(10, 22, 40, 0.8);
    border: 2px solid var(--gold);
    border-radius: 15px;
    padding: 25px;
    margin-bottom: 20px;
}

@keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-15px); }
}
</style>

<!-- Hero Section -->
<section class="solution-hero">
    <div class="container">
        <div class="text-center">
            <span class="solution-icon-big">🏪</span>
            <h1 class="display-3 fw-bold text-white mt-4 mb-3" data-aos="fade-up">
                Website Toko Online
            </h1>
            <p class="lead text-light mb-4" data-aos="fade-up" data-aos-delay="100" style="font-size: 1.4rem;">
                Persis Kayak <strong class="text-gold">TOKOPEDIA</strong>, Tapi Khusus untuk Toko Anda!
            </p>
            <div class="d-flex gap-3 justify-content-center flex-wrap mt-4" data-aos="fade-up" data-aos-delay="200">
                <a href="#detail" class="btn btn-gold btn-lg">
                    <i class="bi bi-arrow-down-circle me-2"></i>
                    Penjelasan Lengkap
                </a>
                <a href="https://wa.me/<?= SITE_WHATSAPP ?>?text=Halo%20SITUNEO,%20saya%20mau%20bikin%20Website%20Toko%20Online" class="btn btn-outline-light btn-lg" target="_blank">
                    <i class="bi bi-whatsapp me-2"></i>
                    Tanya-Tanya Dulu
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="py-5" style="background: var(--dark-blue);" id="detail">
    <div class="container">

        <!-- Penjelasan Sederhana -->
        <div class="row mb-5">
            <div class="col-lg-10 mx-auto">
                <div class="comparison-section">
                    <h2 class="text-white fw-bold mb-4 text-center">
                        <i class="bi bi-lightbulb text-gold me-2"></i>
                        Bayangin Gini...
                    </h2>
                    <p class="text-light" style="font-size: 1.2rem; line-height: 2;">
                        Anda punya <strong class="text-gold">toko di mall</strong> kan? Nah, <strong>website toko online</strong> itu kayak Anda punya <strong class="text-gold">SATU TOKO LAGI, tapi DI INTERNET</strong>.
                    </p>

                    <div class="row mt-5 g-4">
                        <div class="col-md-6">
                            <div class="comparison-col before">
                                <h4 class="text-white fw-bold mb-3">
                                    <i class="bi bi-x-circle text-danger me-2"></i>
                                    Toko di Mall
                                </h4>
                                <ul class="text-light" style="font-size: 1.1rem; line-height: 2;">
                                    <li>Cuma buka jam 10-22</li>
                                    <li>Customer harus datang</li>
                                    <li>Bayar pegawai untuk jaga</li>
                                    <li>Bayar sewa kios mahal</li>
                                    <li>Customer cuma dari sekitar mall</li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="comparison-col after">
                                <h4 class="text-white fw-bold mb-3">
                                    <i class="bi bi-check-circle text-success me-2"></i>
                                    Toko Online
                                </h4>
                                <ul class="text-light" style="font-size: 1.1rem; line-height: 2;">
                                    <li><strong>Buka 24 JAM NON-STOP</strong></li>
                                    <li><strong>Customer tinggal buka HP</strong></li>
                                    <li><strong>KOMPUTER yang jaga (gratis!)</strong></li>
                                    <li><strong>Cuma 350rb/bulan</strong></li>
                                    <li><strong>Customer dari SELURUH INDONESIA</strong></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cara Kerja -->
        <div class="row mb-5">
            <div class="col-lg-10 mx-auto">
                <h2 class="text-center text-white fw-bold mb-5">
                    <i class="bi bi-gear text-gold me-2"></i>
                    Cara Kerjanya SIMPLE Banget!
                </h2>

                <div class="row g-4">
                    <div class="col-md-4" data-aos="fade-up">
                        <div class="feature-card text-center">
                            <div class="step-number">1</div>
                            <h5 class="text-white fw-bold mb-3">Customer Buka Website</h5>
                            <p class="text-light">Customer buka website Anda dari HP/Laptop, bisa dari mana aja</p>
                        </div>
                    </div>
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                        <div class="feature-card text-center">
                            <div class="step-number">2</div>
                            <h5 class="text-white fw-bold mb-3">Pilih Barang</h5>
                            <p class="text-light">Lihat-lihat produk, pilih warna/ukuran, masuk keranjang (kayak di Tokopedia)</p>
                        </div>
                    </div>
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                        <div class="feature-card text-center">
                            <div class="step-number">3</div>
                            <h5 class="text-white fw-bold mb-3">Isi Alamat</h5>
                            <p class="text-light">Customer isi alamat lengkap untuk pengiriman</p>
                        </div>
                    </div>
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                        <div class="feature-card text-center">
                            <div class="step-number">4</div>
                            <h5 class="text-white fw-bold mb-3">Pilih Kurir</h5>
                            <p class="text-light">Pilih JNE/JNT/SiCepat, <strong class="text-gold">ongkir dihitung OTOMATIS</strong></p>
                        </div>
                    </div>
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="400">
                        <div class="feature-card text-center">
                            <div class="step-number">5</div>
                            <h5 class="text-white fw-bold mb-3">Bayar</h5>
                            <p class="text-light">Transfer/QRIS/E-wallet/COD, <strong class="text-gold">terserah customer</strong></p>
                        </div>
                    </div>
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="500">
                        <div class="feature-card text-center">
                            <div class="step-number">6</div>
                            <h5 class="text-white fw-bold mb-3">Anda Terima Notif WA</h5>
                            <p class="text-light">Langsung ada notifikasi ke WA Anda, tinggal <strong class="text-gold">packing & kirim!</strong></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Yang Bikin Enak -->
        <div class="row mb-5">
            <div class="col-lg-10 mx-auto">
                <div class="comparison-section">
                    <h2 class="text-white fw-bold mb-5 text-center">
                        <i class="bi bi-emoji-smile text-gold me-2"></i>
                        Yang Bikin ENAK Pakai Toko Online
                    </h2>

                    <div class="row g-4">
                        <div class="col-md-6">
                            <h4 class="text-danger fw-bold mb-3">❌ DULU (Tanpa Website):</h4>
                            <div style="background: rgba(255,0,0,0.1); padding: 20px; border-radius: 10px; border-left: 4px solid var(--danger);">
                                <p class="text-light mb-2"><strong>Customer WA:</strong> "Kak, ada baju A?"</p>
                                <p class="text-light mb-2"><strong>Anda:</strong> "Ada kak"</p>
                                <p class="text-light mb-2"><strong>Customer:</strong> "Berapa harganya?"</p>
                                <p class="text-light mb-2"><strong>Anda:</strong> "175rb kak"</p>
                                <p class="text-light mb-2"><strong>Customer:</strong> "Ada warna apa aja?"</p>
                                <p class="text-light mb-2"><strong>Anda:</strong> "Merah, biru, hitam"</p>
                                <p class="text-light mb-2"><strong>Customer:</strong> "Ukuran?"</p>
                                <p class="text-light mb-2"><strong>Anda:</strong> "S, M, L, XL"</p>
                                <p class="text-light mb-2"><strong>Customer:</strong> "Ongkir ke Jakarta?"</p>
                                <p class="text-light mb-2"><strong>Anda:</strong> <em>*Cek JNE manual...*</em> "18rb kak"</p>
                                <p class="text-light mb-2"><strong>Customer:</strong> "Totalnya?"</p>
                                <p class="text-light mb-2"><strong>Anda:</strong> "193rb kak"</p>
                                <p class="text-danger fw-bold mt-3">*Customer hilang, gak jadi beli*</p>
                                <p class="text-danger fw-bold">*Anda cape jawab, buang-buang waktu*</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <h4 class="text-success fw-bold mb-3">✅ SEKARANG (Pakai Website):</h4>
                            <div style="background: rgba(0,255,0,0.1); padding: 20px; border-radius: 10px; border-left: 4px solid var(--success);">
                                <p class="text-light mb-3">
                                    <i class="bi bi-check-circle text-success me-2"></i>
                                    Customer buka website
                                </p>
                                <p class="text-light mb-3">
                                    <i class="bi bi-check-circle text-success me-2"></i>
                                    Pilih sendiri warna & ukuran
                                </p>
                                <p class="text-light mb-3">
                                    <i class="bi bi-check-circle text-success me-2"></i>
                                    Ongkir dihitung otomatis
                                </p>
                                <p class="text-light mb-3">
                                    <i class="bi bi-check-circle text-success me-2"></i>
                                    Bayar
                                </p>
                                <p class="text-success fw-bold mt-4" style="font-size: 1.3rem;">
                                    ✓ DONE! Anda tinggal kirim
                                </p>
                                <p class="text-success fw-bold">
                                    ✓ Gak perlu chat panjang lebar
                                </p>
                                <p class="text-success fw-bold">
                                    ✓ Gak cape jawab pertanyaan sama berkali-kali
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Real Example -->
        <div class="row mb-5">
            <div class="col-lg-10 mx-auto">
                <h2 class="text-center text-white fw-bold mb-5">
                    <i class="bi bi-graph-up-arrow text-gold me-2"></i>
                    Contoh NYATA dari Customer Kami
                </h2>

                <div class="example-card" data-aos="fade-up">
                    <h4 class="text-gold fw-bold mb-3">📈 Pak Budi - Toko Kaos Distro</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="text-light mb-2"><strong>DULU (sebelum pakai website):</strong></p>
                            <ul class="text-light">
                                <li>5-10 pembeli per hari</li>
                                <li>Cape balas WA seharian</li>
                                <li>Sering kehilangan customer karena telat balas</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <p class="text-light mb-2"><strong>SEKARANG (pakai website):</strong></p>
                            <ul class="text-success">
                                <li><strong>20-30 order per hari</strong></li>
                                <li><strong>Semua otomatis, tinggal packing</strong></li>
                                <li><strong>Gak pernah kehilangan customer</strong></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="example-card" data-aos="fade-up" data-aos-delay="100">
                    <h4 class="text-gold fw-bold mb-3">📈 Bu Siti - Toko Hijab Online</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="text-light mb-2"><strong>DULU:</strong></p>
                            <ul class="text-light">
                                <li>Cuma jual ke tetangga kompleks</li>
                                <li>Omset 5-7 juta/bulan</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <p class="text-light mb-2"><strong>SEKARANG:</strong></p>
                            <ul class="text-success">
                                <li><strong>Kirim ke Aceh sampai Papua</strong></li>
                                <li><strong>Omset 50-70 juta/bulan</strong></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Yang Anda Dapat -->
        <div class="row mb-5">
            <div class="col-lg-10 mx-auto">
                <h2 class="text-center text-white fw-bold mb-5">
                    <i class="bi bi-gift text-gold me-2"></i>
                    Yang Anda DAPAT Lengkap Banget!
                </h2>

                <div class="row g-4">
                    <div class="col-md-6" data-aos="fade-up">
                        <div class="feature-card">
                            <h5 class="text-gold fw-bold mb-3">
                                <i class="bi bi-box-seam me-2"></i>
                                Unlimited Produk
                            </h5>
                            <p class="text-light">Mau upload 10 produk atau 10.000 produk, BISA! Gak ada batasan</p>
                        </div>
                    </div>

                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="50">
                        <div class="feature-card">
                            <h5 class="text-gold fw-bold mb-3">
                                <i class="bi bi-credit-card me-2"></i>
                                Multiple Payment
                            </h5>
                            <p class="text-light">Transfer Bank, QRIS, GoPay, OVO, Dana, COD - Terserah customer mau bayar pakai apa</p>
                        </div>
                    </div>

                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="feature-card">
                            <h5 class="text-gold fw-bold mb-3">
                                <i class="bi bi-truck me-2"></i>
                                Ongkir Otomatis
                            </h5>
                            <p class="text-light">Langsung terhubung ke JNE, JNT, SiCepat, dll. Ongkir dihitung otomatis, Anda gak perlu cek manual lagi</p>
                        </div>
                    </div>

                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="150">
                        <div class="feature-card">
                            <h5 class="text-gold fw-bold mb-3">
                                <i class="bi bi-cart-check me-2"></i>
                                Shopping Cart & Wishlist
                            </h5>
                            <p class="text-light">Customer bisa masukkan banyak barang ke keranjang sekaligus (kayak di Tokopedia)</p>
                        </div>
                    </div>

                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="feature-card">
                            <h5 class="text-gold fw-bold mb-3">
                                <i class="bi bi-receipt me-2"></i>
                                Invoice Otomatis
                            </h5>
                            <p class="text-light">Setiap order langsung dapat invoice otomatis, gak perlu bikin manual</p>
                        </div>
                    </div>

                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="250">
                        <div class="feature-card">
                            <h5 class="text-gold fw-bold mb-3">
                                <i class="bi bi-geo-alt me-2"></i>
                                Order Tracking
                            </h5>
                            <p class="text-light">Customer bisa lacak paketnya sampai mana (tracking resi otomatis)</p>
                        </div>
                    </div>

                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="feature-card">
                            <h5 class="text-gold fw-bold mb-3">
                                <i class="bi bi-percent me-2"></i>
                                Diskon & Promo Code
                            </h5>
                            <p class="text-light">Buat kode diskon untuk promo (misal: DISKON20 atau LEBARAN50)</p>
                        </div>
                    </div>

                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="350">
                        <div class="feature-card">
                            <h5 class="text-gold fw-bold mb-3">
                                <i class="bi bi-star me-2"></i>
                                Review & Rating
                            </h5>
                            <p class="text-light">Customer bisa kasih review & rating, bikin toko Anda lebih terpercaya</p>
                        </div>
                    </div>

                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="feature-card">
                            <h5 class="text-gold fw-bold mb-3">
                                <i class="bi bi-bar-chart me-2"></i>
                                Laporan Penjualan
                            </h5>
                            <p class="text-light">Tau hari ini laku berapa, untung berapa, barang apa yang paling laris - Semua ada laporannya</p>
                        </div>
                    </div>

                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="450">
                        <div class="feature-card">
                            <h5 class="text-gold fw-bold mb-3">
                                <i class="bi bi-phone me-2"></i>
                                Mobile Responsive
                            </h5>
                            <p class="text-light">Tampilan otomatis menyesuaikan di HP, tablet, laptop - Nyaman di semua perangkat</p>
                        </div>
                    </div>

                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="500">
                        <div class="feature-card">
                            <h5 class="text-gold fw-bold mb-3">
                                <i class="bi bi-whatsapp text-success me-2"></i>
                                Notifikasi WhatsApp
                            </h5>
                            <p class="text-light">Setiap ada order baru, langsung dapat notif ke WA Anda. Gak perlu cek website terus-menerus</p>
                        </div>
                    </div>

                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="550">
                        <div class="feature-card">
                            <h5 class="text-gold fw-bold mb-3">
                                <i class="bi bi-sliders me-2"></i>
                                Admin Panel Gampang
                            </h5>
                            <p class="text-light">Kelola toko dari HP/laptop, gampang kayak pakai Facebook. Gak perlu jago komputer!</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Harga -->
        <div class="row mb-5">
            <div class="col-lg-10 mx-auto">
                <h2 class="text-center text-white fw-bold mb-5">
                    <i class="bi bi-currency-dollar text-gold me-2"></i>
                    Soal Harga, Tenang Aja!
                </h2>

                <div class="row g-4">
                    <div class="col-md-6" data-aos="fade-up">
                        <div class="feature-card text-center" style="border-color: var(--gold); border-width: 2px;">
                            <h3 class="text-gold fw-bold mb-3">SEWA</h3>
                            <h2 class="text-white fw-bold mb-3" style="font-size: 3rem;">350rb<span style="font-size: 1.5rem;">/bulan</span></h2>
                            <p class="text-light mb-4">
                                = <strong class="text-gold">11.600 rupiah per hari</strong><br>
                                Lebih murah dari:
                            </p>
                            <ul class="text-light text-start" style="list-style: none; padding: 0;">
                                <li class="mb-2"><i class="bi bi-x text-danger me-2"></i>Gaji pegawai (2 juta/bulan)</li>
                                <li class="mb-2"><i class="bi bi-x text-danger me-2"></i>Sewa kios (1 juta/bulan)</li>
                                <li class="mb-2"><i class="bi bi-x text-danger me-2"></i>Iklan FB Ads (500rb-3jt/bulan)</li>
                            </ul>
                            <p class="text-success fw-bold mt-3">
                                ✓ Tapi bisa jualan ke SELURUH INDONESIA!
                            </p>
                            <a href="https://wa.me/<?= SITE_WHATSAPP ?>?text=Halo%20SITUNEO,%20saya%20mau%20SEWA%20Website%20Toko%20Online%20350rb/bulan" class="btn btn-gold btn-lg w-100 mt-3" target="_blank">
                                <i class="bi bi-whatsapp me-2"></i>
                                Order Paket SEWA
                            </a>
                        </div>
                    </div>

                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="feature-card text-center" style="border-color: var(--bright-gold); border-width: 2px;">
                            <div style="position: absolute; top: -15px; right: 20px; background: var(--gradient-red); padding: 8px 20px; border-radius: 20px; font-weight: 700; font-size: 0.9rem;">
                                HEMAT!
                            </div>
                            <h3 class="text-bright-gold fw-bold mb-3">BELI PUTUS</h3>
                            <h2 class="text-white fw-bold mb-3" style="font-size: 3rem;">5 juta<span style="font-size: 1.5rem;"> aja</span></h2>
                            <p class="text-light mb-4">
                                = <strong class="text-bright-gold">Punya selamanya!</strong><br>
                                Keuntungannya:
                            </p>
                            <ul class="text-light text-start" style="list-style: none; padding: 0;">
                                <li class="mb-2"><i class="bi bi-check text-success me-2"></i>Gak perlu bayar bulanan lagi</li>
                                <li class="mb-2"><i class="bi bi-check text-success me-2"></i>Full kontrol website</li>
                                <li class="mb-2"><i class="bi bi-check text-success me-2"></i>Bisa custom sesuka hati</li>
                                <li class="mb-2"><i class="bi bi-check text-success me-2"></i>Lebih hemat untuk jangka panjang</li>
                            </ul>
                            <p class="text-gold fw-bold mt-3" style="font-size: 0.95rem;">
                                Kalau sewa 350rb x 15 bulan = 5.25 juta<br>
                                Mending BELI kan? 😊
                            </p>
                            <a href="https://wa.me/<?= SITE_WHATSAPP ?>?text=Halo%20SITUNEO,%20saya%20mau%20BELI%20Website%20Toko%20Online%205%20juta" class="btn btn-lg w-100 mt-3" style="background: var(--gradient-gold); color: var(--dark-blue); font-weight: 700;" target="_blank">
                                <i class="bi bi-whatsapp me-2"></i>
                                Order Paket BELI
                            </a>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-5">
                    <p class="text-gold fw-bold" style="font-size: 1.2rem;">🎁 BONUS GILA-GILAAN:</p>
                    <div class="row g-3 mt-3">
                        <div class="col-md-3 col-6">
                            <div style="background: rgba(212, 175, 55,0.1); padding: 15px; border-radius: 10px;">
                                <p class="text-light mb-0"><small>Domain .com 1 tahun</small></p>
                                <p class="text-success fw-bold mb-0">GRATIS</p>
                                <p class="text-muted mb-0"><small>(nilai 150rb)</small></p>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div style="background: rgba(212, 175, 55,0.1); padding: 15px; border-radius: 10px;">
                                <p class="text-light mb-0"><small>Hosting unlimited</small></p>
                                <p class="text-success fw-bold mb-0">GRATIS</p>
                                <p class="text-muted mb-0"><small>(nilai 1.2jt)</small></p>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div style="background: rgba(212, 175, 55,0.1); padding: 15px; border-radius: 10px;">
                                <p class="text-light mb-0"><small>Maintenance & backup</small></p>
                                <p class="text-success fw-bold mb-0">GRATIS</p>
                                <p class="text-muted mb-0"><small>(selama sewa)</small></p>
                            </div>
                        </div>
                        <div class="col-md-3 col-6">
                            <div style="background: rgba(212, 175, 55,0.1); padding: 15px; border-radius: 10px;">
                                <p class="text-light mb-0"><small>Training 2 jam</small></p>
                                <p class="text-success fw-bold mb-0">GRATIS</p>
                                <p class="text-muted mb-0"><small>(sampai bisa)</small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Takut Gak Bisa Pakai? -->
        <div class="row mb-5">
            <div class="col-lg-10 mx-auto">
                <div class="comparison-section" style="background: rgba(37, 211, 102, 0.1); border: 2px solid var(--whatsapp-green);">
                    <h2 class="text-white fw-bold mb-4 text-center">
                        <i class="bi bi-question-circle text-success me-2"></i>
                        Takut Gak Bisa Pakai?
                    </h2>
                    <p class="text-light text-center" style="font-size: 1.2rem; line-height: 2;">
                        <strong class="text-success">TENANG!</strong> Semudah pakai <strong>Facebook</strong>:
                    </p>
                    <div class="row mt-4">
                        <div class="col-md-3 text-center mb-3">
                            <i class="bi bi-upload text-success" style="font-size: 3rem;"></i>
                            <p class="text-light mt-2">Upload foto<br><strong>Drag & drop</strong></p>
                        </div>
                        <div class="col-md-3 text-center mb-3">
                            <i class="bi bi-pencil text-success" style="font-size: 3rem;"></i>
                            <p class="text-light mt-2">Ganti harga<br><strong>Tinggal ketik</strong></p>
                        </div>
                        <div class="col-md-3 text-center mb-3">
                            <i class="bi bi-bell text-success" style="font-size: 3rem;"></i>
                            <p class="text-light mt-2">Lihat order<br><strong>Ada notifikasi</strong></p>
                        </div>
                        <div class="col-md-3 text-center mb-3">
                            <i class="bi bi-printer text-success" style="font-size: 3rem;"></i>
                            <p class="text-light mt-2">Kirim barang<br><strong>Print label</strong></p>
                        </div>
                    </div>
                    <p class="text-center text-light mt-4" style="font-size: 1.1rem;">
                        <strong class="text-success">✓</strong> Kita training sampai bisa!<br>
                        <strong class="text-success">✓</strong> Kita kasih video tutorial!<br>
                        <strong class="text-success">✓</strong> Kita support WA 24 jam!
                    </p>
                </div>
            </div>
        </div>

        <!-- CTA Final -->
        <div class="row">
            <div class="col-lg-10 mx-auto text-center">
                <h2 class="text-white fw-bold mb-4" style="font-size: 2.5rem;">
                    Mau Coba Dulu Sebelum Bayar?
                </h2>
                <p class="text-light mb-4" style="font-size: 1.2rem;">
                    <strong class="text-gold">BISA!</strong> Demo GRATIS 3 hari, suka baru bayar 😊
                </p>
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="/client/demo-request" class="btn btn-gold btn-lg" style="padding: 18px 40px;">
                        <i class="bi bi-rocket-takeoff me-2"></i>
                        Ya, Mau Coba DEMO Gratis!
                    </a>
                    <a href="https://wa.me/<?= SITE_WHATSAPP ?>?text=Halo%20SITUNEO,%20saya%20mau%20tanya-tanya%20tentang%20Website%20Toko%20Online" class="btn btn-outline-light btn-lg" style="padding: 18px 40px;" target="_blank">
                        <i class="bi bi-whatsapp me-2"></i>
                        Tanya-Tanya Dulu
                    </a>
                </div>

                <p class="text-muted mt-4" style="font-size: 0.95rem;">
                    <i class="bi bi-shield-check text-success me-2"></i>
                    Garansi uang kembali 7 hari kalau tidak puas
                </p>
            </div>
        </div>

    </div>
</section>

<?php include __DIR__ . '/../../includes/footer.php'; ?>
