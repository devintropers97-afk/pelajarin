<?php
session_start();
$lang = $_GET['lang'] ?? $_SESSION['lang'] ?? 'id';
$_SESSION['lang'] = $lang;

$t = ['id' => ['page_title' => 'Kalkulator Harga', 'nav_home' => 'Beranda', 'nav_about' => 'Tentang', 'nav_services' => 'Layanan', 'nav_portfolio' => 'Portfolio', 'nav_pricing' => 'Harga', 'nav_blog' => 'Blog', 'nav_contact' => 'Kontak', 'nav_login' => 'Masuk', 'nib_label' => 'NIB Terdaftar'], 'en' => ['page_title' => 'Price Calculator', 'nav_home' => 'Home', 'nav_about' => 'About', 'nav_services' => 'Services', 'nav_portfolio' => 'Portfolio', 'nav_pricing' => 'Pricing', 'nav_blog' => 'Blog', 'nav_contact' => 'Contact', 'nav_login' => 'Login', 'nib_label' => 'Registered NIB']][$lang];

$pageTitle = $t['page_title'] . ' - SITUNEO';
$baseURL = '/';

include 'components/layout/header.php';
include 'components/layout/navigation.php';
?>

<section class="hero" style="padding-top: 140px; padding-bottom: 60px;">
    <div class="container">
        <div class="hero-content" data-aos="fade-up">
            <h1><?php echo $t['page_title']; ?></h1>
            <p><?php echo $lang === 'en' ? 'Get instant estimate for your project' : 'Dapatkan estimasi instan untuk proyek Anda'; ?></p>
        </div>
    </div>
</section>

<!-- Calculator Section -->
<section style="padding: 60px 0;">
    <div class="container">
        <div style="max-width: 800px; margin: 0 auto;">
            <!-- Basic Calculator (Public) -->
            <div class="card" data-aos="fade-up">
                <h3 class="card-title" style="margin-bottom: 30px; text-align: center;">
                    <i class="fas fa-calculator"></i>
                    <?php echo $lang === 'en' ? 'Basic Calculator' : 'Kalkulator Dasar'; ?>
                </h3>

                <form id="calculatorForm">
                    <div style="margin-bottom: 25px;">
                        <label style="display: block; margin-bottom: 10px; font-weight: 600;">
                            <?php echo $lang === 'en' ? 'Select Template' : 'Pilih Template'; ?>
                        </label>
                        <select id="templateSelect" class="form-control">
                            <option value="0"><?php echo $lang === 'en' ? '-- Choose Template --' : '-- Pilih Template --'; ?></option>
                            <option value="500000"><?php echo $lang === 'en' ? 'Simple Landing Page (Rp 500K)' : 'Landing Page Sederhana (Rp 500K)'; ?></option>
                            <option value="1500000"><?php echo $lang === 'en' ? 'Company Profile (Rp 1.5JT)' : 'Company Profile (Rp 1.5JT)'; ?></option>
                            <option value="3000000"><?php echo $lang === 'en' ? 'E-Commerce (Rp 3JT)' : 'E-Commerce (Rp 3JT)'; ?></option>
                            <option value="5000000"><?php echo $lang === 'en' ? 'Custom Design (Rp 5JT)' : 'Desain Custom (Rp 5JT)'; ?></option>
                        </select>
                    </div>

                    <div style="margin-bottom: 25px;">
                        <label style="display: block; margin-bottom: 10px; font-weight: 600;">
                            <?php echo $lang === 'en' ? 'Business Category' : 'Kategori Bisnis'; ?>
                        </label>
                        <select id="categorySelect" class="form-control">
                            <option value="1"><?php echo $lang === 'en' ? '-- Choose Category --' : '-- Pilih Kategori --'; ?></option>
                            <option value="1"><?php echo $lang === 'en' ? 'General Business (1x)' : 'Bisnis Umum (1x)'; ?></option>
                            <option value="1.2"><?php echo $lang === 'en' ? 'Retail / F&B (1.2x)' : 'Retail / F&B (1.2x)'; ?></option>
                            <option value="1.5"><?php echo $lang === 'en' ? 'Corporate / Enterprise (1.5x)' : 'Corporate / Enterprise (1.5x)'; ?></option>
                        </select>
                    </div>

                    <div style="margin-bottom: 30px;">
                        <label style="display: block; margin-bottom: 10px; font-weight: 600;">
                            <?php echo $lang === 'en' ? 'Additional Features' : 'Fitur Tambahan'; ?>
                        </label>
                        <div style="display: grid; gap: 12px;">
                            <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; padding: 12px; background: rgba(255,255,255,0.05); border-radius: 8px;">
                                <input type="checkbox" class="feature-checkbox" data-price="500000">
                                <span><?php echo $lang === 'en' ? 'Blog System (Rp 500K)' : 'Sistem Blog (Rp 500K)'; ?></span>
                            </label>
                            <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; padding: 12px; background: rgba(255,255,255,0.05); border-radius: 8px;">
                                <input type="checkbox" class="feature-checkbox" data-price="750000">
                                <span><?php echo $lang === 'en' ? 'SEO Optimization (Rp 750K)' : 'Optimasi SEO (Rp 750K)'; ?></span>
                            </label>
                            <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; padding: 12px; background: rgba(255,255,255,0.05); border-radius: 8px;">
                                <input type="checkbox" class="feature-checkbox" data-price="300000">
                                <span><?php echo $lang === 'en' ? 'Logo Design (Rp 300K)' : 'Desain Logo (Rp 300K)'; ?></span>
                            </label>
                        </div>
                    </div>

                    <div style="background: rgba(255,180,0,0.1); border: 2px solid var(--gold-start); border-radius: 15px; padding: 30px; text-align: center; margin-bottom: 25px;">
                        <div style="font-size: 16px; color: var(--text-light); margin-bottom: 10px;">
                            <?php echo $lang === 'en' ? 'Estimated Price' : 'Estimasi Harga'; ?>
                        </div>
                        <div id="estimatedPrice" style="font-size: 42px; font-weight: 800; color: var(--gold-start); font-family: var(--font-heading);">
                            Rp 0
                        </div>
                    </div>

                    <button type="button" class="btn-primary" style="width: 100%; justify-content: center;" onclick="alert('<?php echo $lang === 'en' ? 'Feature will be available soon!' : 'Fitur akan segera tersedia!'; ?>')">
                        <i class="fas fa-download"></i>
                        <span><?php echo $lang === 'en' ? 'Download Estimate' : 'Download Estimasi'; ?></span>
                    </button>
                </form>
            </div>

            <!-- Login Gate for Full Calculator -->
            <div class="card" style="margin-top: 30px; text-align: center; background: rgba(255,180,0,0.1); border-color: var(--gold-start);" data-aos="fade-up" data-aos-delay="200">
                <div class="card-icon" style="margin: 0 auto;">
                    <i class="fas fa-lock"></i>
                </div>
                <h3 class="card-title"><?php echo $lang === 'en' ? 'Login for Full Calculator' : 'Login untuk Full Calculator'; ?></h3>
                <p class="card-text" style="margin-bottom: 20px;">
                    <?php echo $lang === 'en' ? 'Access the complete calculator with detailed features, custom pricing, and project comparison' : 'Akses kalkulator lengkap dengan fitur detail, harga custom, dan perbandingan proyek'; ?>
                </p>
                <a href="auth/login.php" class="btn-primary">
                    <i class="fas fa-user"></i>
                    <span><?php echo $lang === 'en' ? 'Login / Register' : 'Login / Daftar'; ?></span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- How It Works -->
<section style="padding: 60px 0; background: rgba(0,0,0,0.2);">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title"><span><?php echo $lang === 'en' ? 'How It Works' : 'Cara Kerja'; ?></span></h2>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px;">
            <div class="card" style="text-align: center;" data-aos="fade-up" data-aos-delay="100">
                <div class="card-icon" style="margin: 0 auto;">
                    <i class="fas fa-list-check"></i>
                </div>
                <h3 class="card-title">1. <?php echo $lang === 'en' ? 'Select Options' : 'Pilih Opsi'; ?></h3>
                <p class="card-text"><?php echo $lang === 'en' ? 'Choose template, category, and additional features' : 'Pilih template, kategori, dan fitur tambahan'; ?></p>
            </div>

            <div class="card" style="text-align: center;" data-aos="fade-up" data-aos-delay="200">
                <div class="card-icon" style="margin: 0 auto;">
                    <i class="fas fa-calculator"></i>
                </div>
                <h3 class="card-title">2. <?php echo $lang === 'en' ? 'Get Estimate' : 'Dapat Estimasi'; ?></h3>
                <p class="card-text"><?php echo $lang === 'en' ? 'See instant price calculation based on your selection' : 'Lihat kalkulasi harga instan dari pilihan Anda'; ?></p>
            </div>

            <div class="card" style="text-align: center;" data-aos="fade-up" data-aos-delay="300">
                <div class="card-icon" style="margin: 0 auto;">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <h3 class="card-title">3. <?php echo $lang === 'en' ? 'Order Now' : 'Pesan Sekarang'; ?></h3>
                <p class="card-text"><?php echo $lang === 'en' ? 'Proceed to order or contact us for consultation' : 'Lanjut order atau hubungi kami untuk konsultasi'; ?></p>
            </div>
        </div>
    </div>
</section>

<?php
include 'components/layout/footer.php';
include 'components/layout/whatsapp-float.php';
?>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="assets/js/main.js"></script>

</body>
</html>
