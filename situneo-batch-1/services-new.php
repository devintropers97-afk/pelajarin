<?php
session_start();
$lang = $_GET['lang'] ?? $_SESSION['lang'] ?? 'id';
$_SESSION['lang'] = $lang;

$t = [
    'id' => ['page_title' => 'Layanan Kami', 'search_placeholder' => 'Cari layanan...', 'all' => 'Semua', 'login_cta' => 'Login untuk melihat 1500+ layanan lainnya', 'nav_home' => 'Beranda', 'nav_about' => 'Tentang', 'nav_services' => 'Layanan', 'nav_portfolio' => 'Portfolio', 'nav_pricing' => 'Harga', 'nav_blog' => 'Blog', 'nav_contact' => 'Kontak', 'nav_login' => 'Masuk', 'nib_label' => 'NIB Terdaftar'],
    'en' => ['page_title' => 'Our Services', 'search_placeholder' => 'Search services...', 'all' => 'All', 'login_cta' => 'Login to see 1500+ other services', 'nav_home' => 'Home', 'nav_about' => 'About', 'nav_services' => 'Services', 'nav_portfolio' => 'Portfolio', 'nav_pricing' => 'Pricing', 'nav_blog' => 'Blog', 'nav_contact' => 'Contact', 'nav_login' => 'Login', 'nib_label' => 'Registered NIB']
][$lang];

$pageTitle = $t['page_title'] . ' - SITUNEO';
$baseURL = '/';

include 'components/layout/header-new.php';
include 'components/layout/navigation-new.php';
?>

<section class="hero" style="padding-top: 140px; padding-bottom: 60px;">
    <div class="container">
        <div class="hero-content" data-aos="fade-up">
            <h1><?php echo $t['page_title']; ?></h1>
            <div style="max-width: 600px; margin: 30px auto;">
                <input type="text" id="serviceSearch" class="form-control" placeholder="<?php echo $t['search_placeholder']; ?>" style="text-align: center;">
            </div>
        </div>
    </div>
</section>

<!-- Division Filters -->
<section style="padding: 40px 0;">
    <div class="container">
        <div style="display: flex; gap: 10px; flex-wrap: wrap; justify-content: center; margin-bottom: 40px;" data-aos="fade-up">
            <?php
            $divisions = [
                ['id' => 'all', 'name' => $t['all'], 'icon' => 'fa-th'],
                ['id' => 'web-dev', 'name' => ($lang === 'en' ? 'Web Dev' : 'Web Development'), 'icon' => 'fa-code'],
                ['id' => 'ecommerce', 'name' => 'E-Commerce', 'icon' => 'fa-shopping-cart'],
                ['id' => 'design', 'name' => 'Design', 'icon' => 'fa-palette'],
                ['id' => 'seo', 'name' => 'SEO & Marketing', 'icon' => 'fa-chart-line'],
                ['id' => 'mobile', 'name' => 'Mobile App', 'icon' => 'fa-mobile-alt'],
                ['id' => 'hosting', 'name' => 'Hosting', 'icon' => 'fa-server'],
                ['id' => 'content', 'name' => 'Content Writing', 'icon' => 'fa-pen'],
                ['id' => 'video', 'name' => 'Video', 'icon' => 'fa-video'],
                ['id' => 'social', 'name' => 'Social Media', 'icon' => 'fa-share-alt']
            ];

            foreach ($divisions as $index => $div):
            ?>
            <button class="division-filter btn-secondary <?php echo $index === 0 ? 'active' : ''; ?>" data-division="<?php echo $div['id']; ?>" style="padding: 10px 20px; font-size: 14px;">
                <i class="fas <?php echo $div['icon']; ?>"></i>
                <?php echo $div['name']; ?>
            </button>
            <?php endforeach; ?>
        </div>

        <!-- Services Grid (8 public) -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px; margin-bottom: 40px;">
            <?php
            $services = [
                ['title' => 'Company Profile Website', 'division' => 'web-dev', 'price' => 'Rp 1.5JT', 'image' => '1557426272-cceb617a55d3'],
                ['title' => 'E-Commerce / Online Store', 'division' => 'ecommerce', 'price' => 'Rp 3JT', 'image' => '1556745757-8d58faf35e7e'],
                ['title' => 'Landing Page', 'division' => 'web-dev', 'price' => 'Rp 800K', 'image' => '1460925895917-afdab827c52f'],
                ['title' => 'Logo Design', 'division' => 'design', 'price' => 'Rp 500K', 'image' => '1626785774625-ddcddc3445e9'],
                ['title' => 'SEO Optimization', 'division' => 'seo', 'price' => 'Rp 1JT', 'image' => '1432888622747-9eb99fbcfb76'],
                ['title' => 'Mobile App Development', 'division' => 'mobile', 'price' => 'Rp 5JT', 'image' => '1512941937669-90d4643a5266'],
                ['title' => 'Blog Writing', 'division' => 'content', 'price' => 'Rp 300K', 'image' => '1499750310107-1bbf9a32504f'],
                ['title' => 'Social Media Management', 'division' => 'social', 'price' => 'Rp 2JT', 'image' => '1611162617474-5b21e806adf7']
            ];

            foreach ($services as $index => $service):
            ?>
            <div class="service-card" data-division="<?php echo $service['division']; ?>" data-aos="fade-up" data-aos-delay="<?php echo ($index + 1) * 50; ?>">
                <div class="service-card-image">
                    <img src="https://images.unsplash.com/photo-<?php echo $service['image']; ?>?w=600&h=400&fit=crop&q=80" alt="<?php echo $service['title']; ?>" loading="lazy">
                </div>
                <div class="service-card-body">
                    <span class="service-category"><?php echo ucfirst($service['division']); ?></span>
                    <h3 class="service-title"><?php echo $service['title']; ?></h3>
                    <div class="service-price"><?php echo $service['price']; ?></div>
                    <a href="auth/login.php" class="btn-primary" style="width: 100%; justify-content: center; font-size: 14px; padding: 12px;">
                        <i class="fas fa-shopping-cart"></i>
                        <span><?php echo $lang === 'en' ? 'Order Now' : 'Pesan Sekarang'; ?></span>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Login CTA -->
        <div class="card" style="text-align: center; background: rgba(255, 180, 0, 0.1); border-color: var(--gold-start);" data-aos="fade-up">
            <div class="card-icon" style="margin: 0 auto;">
                <i class="fas fa-lock"></i>
            </div>
            <h3 class="card-title"><?php echo $t['login_cta']; ?></h3>
            <p class="card-text" style="margin-bottom: 20px;"><?php echo $lang === 'en' ? 'Register now to access our complete service catalog' : 'Daftar sekarang untuk mengakses katalog layanan lengkap kami'; ?></p>
            <a href="auth/login.php" class="btn-primary">
                <i class="fas fa-user"></i>
                <span><?php echo $lang === 'en' ? 'Login / Register' : 'Login / Daftar'; ?></span>
            </a>
        </div>
    </div>
</section>

<?php
include 'components/layout/footer-new.php';
include 'components/layout/whatsapp-float-new.php';
?>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="assets/js/main-new.js"></script>

</body>
</html>
