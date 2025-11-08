<?php
session_start();
$lang = $_GET['lang'] ?? $_SESSION['lang'] ?? 'id';
$_SESSION['lang'] = $lang;

$t = [
    'id' => ['page_title' => 'Portfolio Demo', 'page_subtitle' => 'Lihat berbagai template website yang telah kami buat', 'all' => 'Semua', 'register_cta' => 'Register untuk melihat 38+ demo lainnya', 'nav_home' => 'Beranda', 'nav_about' => 'Tentang', 'nav_services' => 'Layanan', 'nav_portfolio' => 'Portfolio', 'nav_pricing' => 'Harga', 'nav_blog' => 'Blog', 'nav_contact' => 'Kontak', 'nav_login' => 'Masuk', 'nib_label' => 'NIB Terdaftar'],
    'en' => ['page_title' => 'Demo Portfolio', 'page_subtitle' => 'See various website templates we have created', 'all' => 'All', 'register_cta' => 'Register to see 38+ other demos', 'nav_home' => 'Home', 'nav_about' => 'About', 'nav_services' => 'Services', 'nav_portfolio' => 'Portfolio', 'nav_pricing' => 'Pricing', 'nav_blog' => 'Blog', 'nav_contact' => 'Contact', 'nav_login' => 'Login', 'nib_label' => 'Registered NIB']
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
            <p><?php echo $t['page_subtitle']; ?></p>
        </div>
    </div>
</section>

<!-- Filter Buttons -->
<section style="padding: 40px 0;">
    <div class="container">
        <div style="display: flex; gap: 10px; flex-wrap: wrap; justify-content: center; margin-bottom: 40px;" data-aos="fade-up">
            <?php
            $filters = [
                ['id' => 'all', 'name' => $t['all']],
                ['id' => 'website', 'name' => 'Website'],
                ['id' => 'ecommerce', 'name' => 'E-Commerce'],
                ['id' => 'landing', 'name' => 'Landing Page'],
                ['id' => 'portfolio', 'name' => 'Portfolio']
            ];

            foreach ($filters as $index => $filter):
            ?>
            <button class="portfolio-filter btn-secondary <?php echo $index === 0 ? 'active' : ''; ?>" data-filter="<?php echo $filter['id']; ?>" style="padding: 10px 24px;">
                <?php echo $filter['name']; ?>
            </button>
            <?php endforeach; ?>
        </div>

        <!-- Portfolio Grid (12 public) -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; margin-bottom: 40px;">
            <?php
            $portfolios = [
                ['title' => 'Modern Business', 'category' => 'website', 'image' => '1460925895917-afdab827c52f'],
                ['title' => 'Fashion Store', 'category' => 'ecommerce', 'image' => '1441986300917-64674bd600d8'],
                ['title' => 'Restaurant', 'category' => 'landing', 'image' => '1517248135467-4c7edcad34c4'],
                ['title' => 'Creative Agency', 'category' => 'portfolio', 'image' => '1542744173-8e7e53415bb0'],
                ['title' => 'Tech Startup', 'category' => 'website', 'image' => '1519389950473-47ba0277781c'],
                ['title' => 'Online Shop', 'category' => 'ecommerce', 'image' => '1472851294608-062f824d29cc'],
                ['title' => 'Fitness Center', 'category' => 'landing', 'image' => '1534438327276-14e5300c3a48'],
                ['title' => 'Photography', 'category' => 'portfolio', 'image' => '1452587925148-ce544e77e70d'],
                ['title' => 'Real Estate', 'category' => 'website', 'image' => '1560518883-ce4b6e6ee99a'],
                ['title' => 'Beauty Salon', 'category' => 'landing', 'image' => '1522337360788-8b13dee7a37e'],
                ['title' => 'Travel Agency', 'category' => 'website', 'image' => '1469854523690-44d8cccbc8e8'],
                ['title' => 'Coffee Shop', 'category' => 'ecommerce', 'image' => '1511081692775-05d0f180a065']
            ];

            foreach ($portfolios as $index => $portfolio):
            ?>
            <div class="portfolio-card" data-category="<?php echo $portfolio['category']; ?>" data-aos="fade-up" data-aos-delay="<?php echo ($index + 1) * 50; ?>">
                <div class="portfolio-image">
                    <img src="https://images.unsplash.com/photo-<?php echo $portfolio['image']; ?>?w=600&h=400&fit=crop&q=80" alt="<?php echo $portfolio['title']; ?>" loading="lazy">
                </div>
                <div class="portfolio-overlay">
                    <h3 class="portfolio-title"><?php echo $portfolio['title']; ?></h3>
                    <p class="portfolio-category"><?php echo ucfirst($portfolio['category']); ?></p>
                    <a href="demo/preview.php?id=<?php echo $index + 1; ?>" class="portfolio-link">
                        <i class="fas fa-eye"></i>
                        <span><?php echo $lang === 'en' ? 'View Demo' : 'Lihat Demo'; ?></span>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Register CTA -->
        <div class="card" style="text-align: center; background: rgba(255, 180, 0, 0.1); border-color: var(--gold-start);" data-aos="fade-up">
            <div class="card-icon" style="margin: 0 auto;">
                <i class="fas fa-lock"></i>
            </div>
            <h3 class="card-title"><?php echo $t['register_cta']; ?></h3>
            <p class="card-text" style="margin-bottom: 20px;"><?php echo $lang === 'en' ? 'Get full access to all premium templates' : 'Dapatkan akses penuh ke semua template premium'; ?></p>
            <a href="auth/register.php" class="btn-primary">
                <i class="fas fa-user-plus"></i>
                <span><?php echo $lang === 'en' ? 'Register Now' : 'Daftar Sekarang'; ?></span>
            </a>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section style="padding: 60px 0; background: rgba(0,0,0,0.2);">
    <div class="container">
        <div class="stats">
            <div class="stat-item" data-aos="fade-up" data-aos-delay="100">
                <div class="stat-number" data-target="50">0</div>
                <div class="stat-label"><?php echo $lang === 'en' ? 'Premium Templates' : 'Template Premium'; ?></div>
            </div>
            <div class="stat-item" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-number" data-target="800">0</div>
                <div class="stat-label"><?php echo $lang === 'en' ? 'Websites Created' : 'Website Tercipta'; ?></div>
            </div>
            <div class="stat-item" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-number" data-target="98">0</div>
                <div class="stat-label"><?php echo $lang === 'en' ? '% Satisfaction' : '% Kepuasan'; ?></div>
            </div>
            <div class="stat-item" data-aos="fade-up" data-aos-delay="400">
                <div class="stat-number" data-target="24">0</div>
                <div class="stat-label"><?php echo $lang === 'en' ? 'Hour Support' : 'Jam Support'; ?>/7</div>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials -->
<section style="padding: 60px 0;">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title"><span><?php echo $lang === 'en' ? 'What They Say' : 'Apa Kata Mereka'; ?></span></h2>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; max-width: 1200px; margin: 0 auto;">
            <?php
            $testimonials = [
                ['name' => 'Ahmad Yani', 'role' => ($lang === 'en' ? 'Business Owner' : 'Pemilik Bisnis'), 'text' => ($lang === 'en' ? 'The template quality is amazing! My website looks very professional.' : 'Kualitas template sangat bagus! Website saya terlihat sangat profesional.')],
                ['name' => 'Linda Wijaya', 'role' => ($lang === 'en' ? 'Online Shop Owner' : 'Pemilik Toko Online'), 'text' => ($lang === 'en' ? 'I love the e-commerce templates. Easy to customize and full featured.' : 'Saya suka template e-commerce nya. Mudah dikustomisasi dan fitur lengkap.')],
                ['name' => 'Rudi Hartono', 'role' => ($lang === 'en' ? 'Photographer' : 'Fotografer'), 'text' => ($lang === 'en' ? 'Perfect portfolio template! My photos look stunning on it.' : 'Template portfolio yang sempurna! Foto-foto saya terlihat memukau.')]
            ];

            foreach ($testimonials as $index => $testimonial):
            ?>
            <div class="testimonial-card" data-aos="fade-up" data-aos-delay="<?php echo ($index + 1) * 100; ?>">
                <div class="testimonial-quote">"</div>
                <p class="testimonial-text"><?php echo $testimonial['text']; ?></p>
                <div class="testimonial-author">
                    <div class="testimonial-avatar">
                        <img src="https://ui-avatars.com/api/?name=<?php echo urlencode($testimonial['name']); ?>&background=FFB400&color=0F3057&size=50" alt="<?php echo $testimonial['name']; ?>">
                    </div>
                    <div class="testimonial-info">
                        <h5><?php echo $testimonial['name']; ?></h5>
                        <p><?php echo $testimonial['role']; ?></p>
                        <div class="testimonial-rating">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
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
