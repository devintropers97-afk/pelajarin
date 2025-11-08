<?php
session_start();

// Multi-language support
$lang = $_GET['lang'] ?? $_SESSION['lang'] ?? 'id';
$_SESSION['lang'] = $lang;

// Language content
$text = [
    'id' => [
        'meta_description' => 'SITUNEO - Platform Website Profesional Berbasis AI. Hubungkan bisnis Anda dengan freelancer terbaik untuk website berkualitas tinggi.',
        'og_title' => 'SITUNEO - Platform Website Profesional Berbasis AI',
        'nav_home' => 'Beranda',
        'nav_about' => 'Tentang',
        'nav_services' => 'Layanan',
        'nav_portfolio' => 'Portfolio',
        'nav_pricing' => 'Harga',
        'nav_blog' => 'Blog',
        'nav_contact' => 'Kontak',
        'nav_login' => 'Masuk',
        'nib_label' => 'NIB Terdaftar',
        'hero_title' => 'Wujudkan Website Impian Anda',
        'hero_highlight' => 'Mulai dari Rp 350K',
        'hero_desc' => 'Platform digital terdepan yang menghubungkan bisnis dengan freelancer profesional untuk menciptakan website berkualitas tinggi dengan teknologi AI.',
        'hero_btn_start' => 'Mulai Sekarang',
        'hero_btn_demo' => 'Lihat Demo',
        'stat_customers' => 'Pelanggan',
        'stat_websites' => 'Website',
        'stat_satisfaction' => 'Kepuasan',
        'stat_support' => 'Support',
        'benefits_title' => 'Mengapa Memilih SITUNEO?',
        'benefit1_title' => 'Harga Terjangkau',
        'benefit1_desc' => 'Dapatkan website profesional dengan harga mulai Rp 350K. Kualitas premium tanpa menguras kantong.',
        'benefit2_title' => 'Freelancer Terverifikasi',
        'benefit2_desc' => 'Bekerja dengan freelancer terpilih yang telah melewati seleksi ketat dan memiliki portfolio terbukti.',
        'benefit3_title' => 'Teknologi AI Modern',
        'benefit3_desc' => 'Manfaatkan kekuatan AI untuk proses pembuatan website yang lebih cepat dan efisien.',
        'benefit4_title' => 'Support 24/7',
        'benefit4_desc' => 'Tim support kami siap membantu Anda kapan saja, 24 jam sehari, 7 hari seminggu.',
        'services_title' => 'Layanan Populer',
        'services_subtitle' => 'Pilihan layanan terbaik yang paling banyak diminati oleh pelanggan kami',
        'view_all' => 'Lihat Semua',
        'pricing_title' => 'Paket Harga Terbaik',
        'pricing_subtitle' => 'Pilih paket yang sesuai dengan kebutuhan dan budget Anda',
        'starter' => 'Pemula',
        'business' => 'Bisnis',
        'premium' => 'Premium',
        'most_popular' => 'Paling Populer',
        'per_project' => '/ proyek',
        'choose_package' => 'Pilih Paket',
        'portfolio_title' => 'Portfolio Demo',
        'portfolio_subtitle' => 'Lihat berbagai template website yang telah kami buat',
        'testimonials_title' => 'Apa Kata Mereka',
        'testimonials_subtitle' => 'Testimoni dari pelanggan yang puas dengan layanan kami',
        'faq_title' => 'Pertanyaan Umum',
        'faq_subtitle' => 'Temukan jawaban untuk pertanyaan yang sering diajukan',
        'footer_desc' => 'Platform digital terdepan yang menghubungkan bisnis dengan freelancer profesional untuk menciptakan website berkualitas tinggi.',
        'footer_links' => 'Tautan Cepat',
        'footer_services' => 'Layanan Kami',
        'footer_calculator' => 'Kalkulator Harga',
        'footer_career' => 'Karir',
        'footer_newsletter' => 'Newsletter',
        'newsletter_desc' => 'Dapatkan update terbaru tentang tips website, promo spesial, dan berita industri digital.',
        'newsletter_placeholder' => 'Alamat Email',
        'newsletter_sending' => 'Mengirim...',
        'newsletter_success' => 'Terima kasih! Email Anda telah terdaftar.',
        'payment_methods' => 'Metode Pembayaran',
        'footer_rights' => 'Hak Cipta Dilindungi.',
        'footer_privacy' => 'Kebijakan Privasi',
        'footer_terms' => 'Syarat & Ketentuan',
        'footer_sitemap' => 'Peta Situs',
        'whatsapp_status' => 'Online - Siap Membantu',
        'whatsapp_greeting' => 'Halo! 👋 Ada yang bisa kami bantu?',
        'whatsapp_default_message' => 'Halo SITUNEO, saya tertarik dengan layanan Anda.',
        'whatsapp_chat_now' => 'Chat Sekarang',
        'order_purchased' => 'Baru saja memesan',
        'minutes_ago' => 'menit yang lalu'
    ],
    'en' => [
        'meta_description' => 'SITUNEO - AI-Powered Professional Website Platform. Connect your business with the best freelancers for high-quality websites.',
        'og_title' => 'SITUNEO - AI-Powered Professional Website Platform',
        'nav_home' => 'Home',
        'nav_about' => 'About',
        'nav_services' => 'Services',
        'nav_portfolio' => 'Portfolio',
        'nav_pricing' => 'Pricing',
        'nav_blog' => 'Blog',
        'nav_contact' => 'Contact',
        'nav_login' => 'Login',
        'nib_label' => 'Registered NIB',
        'hero_title' => 'Build Your Dream Website',
        'hero_highlight' => 'Starting from $25',
        'hero_desc' => 'Leading digital platform connecting businesses with professional freelancers to create high-quality websites with AI technology.',
        'hero_btn_start' => 'Get Started',
        'hero_btn_demo' => 'View Demo',
        'stat_customers' => 'Customers',
        'stat_websites' => 'Websites',
        'stat_satisfaction' => 'Satisfaction',
        'stat_support' => 'Support',
        'benefits_title' => 'Why Choose SITUNEO?',
        'benefit1_title' => 'Affordable Pricing',
        'benefit1_desc' => 'Get professional websites starting from $25. Premium quality without breaking the bank.',
        'benefit2_title' => 'Verified Freelancers',
        'benefit2_desc' => 'Work with selected freelancers who have passed strict selection and have proven portfolios.',
        'benefit3_title' => 'Modern AI Technology',
        'benefit3_desc' => 'Leverage the power of AI for faster and more efficient website creation process.',
        'benefit4_title' => '24/7 Support',
        'benefit4_desc' => 'Our support team is ready to help you anytime, 24 hours a day, 7 days a week.',
        'services_title' => 'Popular Services',
        'services_subtitle' => 'Best service options most in demand by our customers',
        'view_all' => 'View All',
        'pricing_title' => 'Best Pricing Packages',
        'pricing_subtitle' => 'Choose a package that fits your needs and budget',
        'starter' => 'Starter',
        'business' => 'Business',
        'premium' => 'Premium',
        'most_popular' => 'Most Popular',
        'per_project' => '/ project',
        'choose_package' => 'Choose Package',
        'portfolio_title' => 'Demo Portfolio',
        'portfolio_subtitle' => 'See various website templates we have created',
        'testimonials_title' => 'What They Say',
        'testimonials_subtitle' => 'Testimonials from customers satisfied with our services',
        'faq_title' => 'Frequently Asked Questions',
        'faq_subtitle' => 'Find answers to commonly asked questions',
        'footer_desc' => 'Leading digital platform connecting businesses with professional freelancers to create high-quality websites.',
        'footer_links' => 'Quick Links',
        'footer_services' => 'Our Services',
        'footer_calculator' => 'Price Calculator',
        'footer_career' => 'Career',
        'footer_newsletter' => 'Newsletter',
        'newsletter_desc' => 'Get the latest updates on website tips, special promotions, and digital industry news.',
        'newsletter_placeholder' => 'Email Address',
        'newsletter_sending' => 'Sending...',
        'newsletter_success' => 'Thank you! Your email has been registered.',
        'payment_methods' => 'Payment Methods',
        'footer_rights' => 'All Rights Reserved.',
        'footer_privacy' => 'Privacy Policy',
        'footer_terms' => 'Terms & Conditions',
        'footer_sitemap' => 'Sitemap',
        'whatsapp_status' => 'Online - Ready to Help',
        'whatsapp_greeting' => 'Hello! 👋 How can we help you?',
        'whatsapp_default_message' => 'Hello SITUNEO, I am interested in your services.',
        'whatsapp_chat_now' => 'Chat Now',
        'order_purchased' => 'Just ordered',
        'minutes_ago' => 'minutes ago'
    ]
];

$t = $text[$lang];
$pageTitle = 'SITUNEO - Platform Website Profesional Berbasis AI';
$baseURL = '/';

// Include header and navigation
include 'components/layout/header.php';
include 'components/layout/navigation.php';
?>

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <div class="hero-content" data-aos="fade-up">
            <h1>
                <?php echo $t['hero_title']; ?><br>
                <span class="highlight"><?php echo $t['hero_highlight']; ?></span>
            </h1>
            <p><?php echo $t['hero_desc']; ?></p>
            <div class="hero-buttons">
                <a href="auth/register.php" class="btn-primary">
                    <i class="fas fa-rocket"></i>
                    <span><?php echo $t['hero_btn_start']; ?></span>
                </a>
                <a href="portfolio.php" class="btn-secondary">
                    <i class="fas fa-eye"></i>
                    <span><?php echo $t['hero_btn_demo']; ?></span>
                </a>
            </div>

            <!-- Stats Counter -->
            <div class="stats">
                <div class="stat-item" data-aos="fade-up" data-aos-delay="100">
                    <div class="stat-number" data-target="500">0</div>
                    <div class="stat-label"><?php echo $t['stat_customers']; ?>+</div>
                </div>
                <div class="stat-item" data-aos="fade-up" data-aos-delay="200">
                    <div class="stat-number" data-target="800">0</div>
                    <div class="stat-label"><?php echo $t['stat_websites']; ?>+</div>
                </div>
                <div class="stat-item" data-aos="fade-up" data-aos-delay="300">
                    <div class="stat-number" data-target="98">0</div>
                    <div class="stat-label"><?php echo $t['stat_satisfaction']; ?>%</div>
                </div>
                <div class="stat-item" data-aos="fade-up" data-aos-delay="400">
                    <div class="stat-number" data-target="24">0</div>
                    <div class="stat-label"><?php echo $t['stat_support']; ?>/7</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Benefits Section -->
<section class="benefits">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title"><?php echo $t['benefits_title']; ?></h2>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px;">
            <div class="card" data-aos="fade-up" data-aos-delay="100">
                <div class="card-icon">
                    <i class="fas fa-tags"></i>
                </div>
                <h3 class="card-title"><?php echo $t['benefit1_title']; ?></h3>
                <p class="card-text"><?php echo $t['benefit1_desc']; ?></p>
            </div>

            <div class="card" data-aos="fade-up" data-aos-delay="200">
                <div class="card-icon">
                    <i class="fas fa-user-shield"></i>
                </div>
                <h3 class="card-title"><?php echo $t['benefit2_title']; ?></h3>
                <p class="card-text"><?php echo $t['benefit2_desc']; ?></p>
            </div>

            <div class="card" data-aos="fade-up" data-aos-delay="300">
                <div class="card-icon">
                    <i class="fas fa-robot"></i>
                </div>
                <h3 class="card-title"><?php echo $t['benefit3_title']; ?></h3>
                <p class="card-text"><?php echo $t['benefit3_desc']; ?></p>
            </div>

            <div class="card" data-aos="fade-up" data-aos-delay="400">
                <div class="card-icon">
                    <i class="fas fa-headset"></i>
                </div>
                <h3 class="card-title"><?php echo $t['benefit4_title']; ?></h3>
                <p class="card-text"><?php echo $t['benefit4_desc']; ?></p>
            </div>
        </div>
    </div>
</section>

<!-- Popular Services Section -->
<section class="services">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title"><span><?php echo $t['services_title']; ?></span></h2>
            <p class="section-subtitle"><?php echo $t['services_subtitle']; ?></p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px; margin-bottom: 40px;">
            <?php
            $services = [
                ['title' => 'Company Profile Website', 'price' => 'Rp 1.5JT', 'image' => '1557426272-cceb617a55d3'],
                ['title' => 'E-Commerce / Toko Online', 'price' => 'Rp 3JT', 'image' => '1556745757-8d58faf35e7e'],
                ['title' => 'Landing Page', 'price' => 'Rp 800K', 'image' => '1460925895917-afdab827c52f'],
                ['title' => 'Portfolio Website', 'price' => 'Rp 1.2JT', 'image' => '1507238691740-8b31fb9220e9'],
                ['title' => 'Blog / News Website', 'price' => 'Rp 1JT', 'image' => '1499750310107-1bbf9a32504f'],
                ['title' => 'Booking / Reservation System', 'price' => 'Rp 2.5JT', 'image' => '1554224311-f13f3c25c053'],
                ['title' => 'Corporate Website', 'price' => 'Rp 2JT', 'image' => '1486406146456-cce4405d565b'],
                ['title' => 'Educational Platform', 'price' => 'Rp 3.5JT', 'image' => '1503676260728-1c00da094a0b']
            ];

            foreach ($services as $index => $service):
            ?>
            <div class="service-card" data-aos="fade-up" data-aos-delay="<?php echo ($index + 1) * 100; ?>">
                <div class="service-card-image">
                    <img src="https://images.unsplash.com/photo-<?php echo $service['image']; ?>?w=600&h=400&fit=crop&q=80" alt="<?php echo $service['title']; ?>" loading="lazy">
                </div>
                <div class="service-card-body">
                    <span class="service-category"><?php echo $lang === 'en' ? 'Popular' : 'Populer'; ?></span>
                    <h3 class="service-title"><?php echo $service['title']; ?></h3>
                    <div class="service-price">
                        <?php echo $service['price']; ?>
                        <small><?php echo $t['per_project']; ?></small>
                    </div>
                    <a href="services.php" class="btn-primary" style="width: 100%; justify-content: center; font-size: 14px; padding: 12px;">
                        <i class="fas fa-arrow-right"></i>
                        <span><?php echo $lang === 'en' ? 'Details' : 'Lihat Detail'; ?></span>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div style="text-align: center;" data-aos="fade-up">
            <a href="services.php" class="btn-primary">
                <i class="fas fa-th"></i>
                <span><?php echo $t['view_all']; ?></span>
            </a>
        </div>
    </div>
</section>

<!-- Pricing Section -->
<section class="pricing">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title"><span><?php echo $t['pricing_title']; ?></span></h2>
            <p class="section-subtitle"><?php echo $t['pricing_subtitle']; ?></p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; max-width: 1000px; margin: 0 auto;">
            <!-- Starter Package -->
            <div class="pricing-card" data-aos="fade-up" data-aos-delay="100">
                <h3 class="pricing-name"><?php echo $t['starter']; ?></h3>
                <div class="pricing-price">Rp 1.5JT</div>
                <p class="pricing-period"><?php echo $t['per_project']; ?></p>
                <ul class="pricing-features">
                    <li><i class="fas fa-check"></i> <?php echo $lang === 'en' ? '5 Pages' : '5 Halaman'; ?></li>
                    <li><i class="fas fa-check"></i> <?php echo $lang === 'en' ? 'Responsive Design' : 'Desain Responsif'; ?></li>
                    <li><i class="fas fa-check"></i> <?php echo $lang === 'en' ? 'Basic SEO' : 'SEO Dasar'; ?></li>
                    <li><i class="fas fa-check"></i> <?php echo $lang === 'en' ? 'Contact Form' : 'Form Kontak'; ?></li>
                    <li><i class="fas fa-check"></i> <?php echo $lang === 'en' ? '1 Month Support' : 'Support 1 Bulan'; ?></li>
                </ul>
                <a href="pricing.php" class="btn-primary" style="width: 100%; justify-content: center;">
                    <?php echo $t['choose_package']; ?>
                </a>
            </div>

            <!-- Business Package -->
            <div class="pricing-card featured" data-aos="fade-up" data-aos-delay="200">
                <div class="pricing-badge"><?php echo $t['most_popular']; ?></div>
                <h3 class="pricing-name"><?php echo $t['business']; ?></h3>
                <div class="pricing-price">Rp 3JT</div>
                <p class="pricing-period"><?php echo $t['per_project']; ?></p>
                <ul class="pricing-features">
                    <li><i class="fas fa-check"></i> <?php echo $lang === 'en' ? '10 Pages' : '10 Halaman'; ?></li>
                    <li><i class="fas fa-check"></i> <?php echo $lang === 'en' ? 'Responsive Design' : 'Desain Responsif'; ?></li>
                    <li><i class="fas fa-check"></i> <?php echo $lang === 'en' ? 'Advanced SEO' : 'SEO Lanjutan'; ?></li>
                    <li><i class="fas fa-check"></i> <?php echo $lang === 'en' ? 'Blog System' : 'Sistem Blog'; ?></li>
                    <li><i class="fas fa-check"></i> <?php echo $lang === 'en' ? '3 Months Support' : 'Support 3 Bulan'; ?></li>
                </ul>
                <a href="pricing.php" class="btn-primary" style="width: 100%; justify-content: center;">
                    <?php echo $t['choose_package']; ?>
                </a>
            </div>

            <!-- Premium Package -->
            <div class="pricing-card" data-aos="fade-up" data-aos-delay="300">
                <h3 class="pricing-name"><?php echo $t['premium']; ?></h3>
                <div class="pricing-price">Rp 5JT</div>
                <p class="pricing-period"><?php echo $t['per_project']; ?></p>
                <ul class="pricing-features">
                    <li><i class="fas fa-check"></i> <?php echo $lang === 'en' ? 'Unlimited Pages' : 'Halaman Unlimited'; ?></li>
                    <li><i class="fas fa-check"></i> <?php echo $lang === 'en' ? 'Custom Design' : 'Desain Custom'; ?></li>
                    <li><i class="fas fa-check"></i> <?php echo $lang === 'en' ? 'Premium SEO' : 'SEO Premium'; ?></li>
                    <li><i class="fas fa-check"></i> <?php echo $lang === 'en' ? 'Full Features' : 'Fitur Lengkap'; ?></li>
                    <li><i class="fas fa-check"></i> <?php echo $lang === 'en' ? '6 Months Support' : 'Support 6 Bulan'; ?></li>
                </ul>
                <a href="pricing.php" class="btn-primary" style="width: 100%; justify-content: center;">
                    <?php echo $t['choose_package']; ?>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Portfolio Section -->
<section class="portfolio">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title"><span><?php echo $t['portfolio_title']; ?></span></h2>
            <p class="section-subtitle"><?php echo $t['portfolio_subtitle']; ?></p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px;">
            <?php
            $portfolios = [
                ['title' => 'Modern Business', 'category' => 'Website', 'image' => '1460925895917-afdab827c52f'],
                ['title' => 'Fashion Store', 'category' => 'E-Commerce', 'image' => '1441986300917-64674bd600d8'],
                ['title' => 'Restaurant', 'category' => 'Landing', 'image' => '1517248135467-4c7edcad34c4'],
                ['title' => 'Creative Agency', 'category' => 'Portfolio', 'image' => '1542744173-8e7e53415bb0'],
                ['title' => 'Tech Startup', 'category' => 'Website', 'image' => '1519389950473-47ba0277781c'],
                ['title' => 'Online Shop', 'category' => 'E-Commerce', 'image' => '1472851294608-062f824d29cc'],
                ['title' => 'Fitness Center', 'category' => 'Landing', 'image' => '1534438327276-14e5300c3a48'],
                ['title' => 'Photography', 'category' => 'Portfolio', 'image' => '1452587925148-ce544e77e70d'],
                ['title' => 'Real Estate', 'category' => 'Website', 'image' => '1560518883-ce4b6e6ee99a'],
                ['title' => 'Beauty Salon', 'category' => 'Landing', 'image' => '1522337360788-8b13dee7a37e'],
                ['title' => 'Travel Agency', 'category' => 'Website', 'image' => '1469854523690-44d8cccbc8e8'],
                ['title' => 'Coffee Shop', 'category' => 'E-Commerce', 'image' => '1511081692775-05d0f180a065']
            ];

            foreach ($portfolios as $index => $portfolio):
            ?>
            <div class="portfolio-card" data-aos="fade-up" data-aos-delay="<?php echo ($index + 1) * 50; ?>">
                <div class="portfolio-image">
                    <img src="https://images.unsplash.com/photo-<?php echo $portfolio['image']; ?>?w=600&h=400&fit=crop&q=80" alt="<?php echo $portfolio['title']; ?>" loading="lazy">
                </div>
                <div class="portfolio-overlay">
                    <h3 class="portfolio-title"><?php echo $portfolio['title']; ?></h3>
                    <p class="portfolio-category"><?php echo $portfolio['category']; ?></p>
                    <a href="portfolio.php" class="portfolio-link">
                        <i class="fas fa-eye"></i>
                        <span><?php echo $lang === 'en' ? 'View Demo' : 'Lihat Demo'; ?></span>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <div style="text-align: center; margin-top: 40px;" data-aos="fade-up">
            <a href="portfolio.php" class="btn-primary">
                <i class="fas fa-images"></i>
                <span><?php echo $t['view_all']; ?></span>
            </a>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title"><span><?php echo $t['testimonials_title']; ?></span></h2>
            <p class="section-subtitle"><?php echo $t['testimonials_subtitle']; ?></p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 30px; max-width: 1200px; margin: 0 auto;">
            <div class="testimonial-card" data-aos="fade-up" data-aos-delay="100">
                <div class="testimonial-quote">"</div>
                <p class="testimonial-text"><?php echo $lang === 'en' ? 'Excellent service! My company profile website was completed quickly and the result exceeded expectations.' : 'Pelayanan yang sangat baik! Website company profile saya selesai dengan cepat dan hasilnya melebihi ekspektasi.'; ?></p>
                <div class="testimonial-author">
                    <div class="testimonial-avatar">
                        <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=FFB400&color=0F3057&size=50" alt="Budi Santoso">
                    </div>
                    <div class="testimonial-info">
                        <h5>Budi Santoso</h5>
                        <p><?php echo $lang === 'en' ? 'CEO, Tech Solutions' : 'CEO, PT Tech Solutions'; ?></p>
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

            <div class="testimonial-card" data-aos="fade-up" data-aos-delay="200">
                <div class="testimonial-quote">"</div>
                <p class="testimonial-text"><?php echo $lang === 'en' ? 'Professional and reliable! My online store is now running smoothly with great features.' : 'Profesional dan terpercaya! Toko online saya sekarang berjalan lancar dengan fitur yang lengkap.'; ?></p>
                <div class="testimonial-author">
                    <div class="testimonial-avatar">
                        <img src="https://ui-avatars.com/api/?name=Siti+Nurhaliza&background=FFD700&color=0F3057&size=50" alt="Siti Nurhaliza">
                    </div>
                    <div class="testimonial-info">
                        <h5>Siti Nurhaliza</h5>
                        <p><?php echo $lang === 'en' ? 'Owner, Fashion Boutique' : 'Pemilik Boutique Fashion'; ?></p>
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

            <div class="testimonial-card" data-aos="fade-up" data-aos-delay="300">
                <div class="testimonial-quote">"</div>
                <p class="testimonial-text"><?php echo $lang === 'en' ? 'Very satisfied! The freelancer was very responsive and the price was very affordable.' : 'Sangat puas! Freelancer sangat responsif dan harganya sangat terjangkau.'; ?></p>
                <div class="testimonial-author">
                    <div class="testimonial-avatar">
                        <img src="https://ui-avatars.com/api/?name=Ahmad+Yani&background=1E5C99&color=ffffff&size=50" alt="Ahmad Yani">
                    </div>
                    <div class="testimonial-info">
                        <h5>Ahmad Yani</h5>
                        <p><?php echo $lang === 'en' ? 'Director, Digital Agency' : 'Direktur Digital Agency'; ?></p>
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

            <div class="testimonial-card" data-aos="fade-up" data-aos-delay="400">
                <div class="testimonial-quote">"</div>
                <p class="testimonial-text"><?php echo $lang === 'en' ? 'Best platform for website creation! Fast process and professional results.' : 'Platform terbaik untuk pembuatan website! Proses cepat dan hasil yang profesional.'; ?></p>
                <div class="testimonial-author">
                    <div class="testimonial-avatar">
                        <img src="https://ui-avatars.com/api/?name=Dewi+Lestari&background=FF6B00&color=ffffff&size=50" alt="Dewi Lestari">
                    </div>
                    <div class="testimonial-info">
                        <h5>Dewi Lestari</h5>
                        <p><?php echo $lang === 'en' ? 'Blogger & Content Creator' : 'Blogger & Content Creator'; ?></p>
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
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title"><span><?php echo $t['faq_title']; ?></span></h2>
            <p class="section-subtitle"><?php echo $t['faq_subtitle']; ?></p>
        </div>

        <div class="faq-accordion" data-aos="fade-up">
            <div class="faq-item">
                <button class="faq-question">
                    <span><?php echo $lang === 'en' ? 'How long does it take to create a website?' : 'Berapa lama waktu pembuatan website?'; ?></span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="faq-answer">
                    <div class="faq-answer-content">
                        <?php echo $lang === 'en' ? 'The time required depends on the complexity of the project. For basic websites, it usually takes 7-14 working days. For more complex projects, it can take up to 1-2 months.' : 'Waktu yang dibutuhkan tergantung pada kompleksitas proyek. Untuk website dasar, biasanya membutuhkan waktu 7-14 hari kerja. Untuk proyek yang lebih kompleks, bisa memakan waktu hingga 1-2 bulan.'; ?>
                    </div>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">
                    <span><?php echo $lang === 'en' ? 'What payment methods are available?' : 'Apa saja metode pembayaran yang tersedia?'; ?></span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="faq-answer">
                    <div class="faq-answer-content">
                        <?php echo $lang === 'en' ? 'We accept various payment methods including Bank Transfer, Credit/Debit Card, GoPay, OVO, DANA, and PayPal for international transactions.' : 'Kami menerima berbagai metode pembayaran termasuk Transfer Bank, Kartu Kredit/Debit, GoPay, OVO, DANA, dan PayPal untuk transaksi internasional.'; ?>
                    </div>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">
                    <span><?php echo $lang === 'en' ? 'Is there a money-back guarantee?' : 'Apakah ada jaminan uang kembali?'; ?></span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="faq-answer">
                    <div class="faq-answer-content">
                        <?php echo $lang === 'en' ? 'Yes! We offer a 30-day money-back guarantee if you are not satisfied with the results. Terms and conditions apply.' : 'Ya! Kami menawarkan jaminan uang kembali 30 hari jika Anda tidak puas dengan hasilnya. Syarat dan ketentuan berlaku.'; ?>
                    </div>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">
                    <span><?php echo $lang === 'en' ? 'Can I request revisions?' : 'Apakah bisa request revisi?'; ?></span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="faq-answer">
                    <div class="faq-answer-content">
                        <?php echo $lang === 'en' ? 'Of course! Each package includes a certain number of revisions. You can request revisions until you are completely satisfied with the results.' : 'Tentu saja! Setiap paket sudah termasuk revisi tertentu. Anda bisa melakukan revisi hingga Anda benar-benar puas dengan hasilnya.'; ?>
                    </div>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">
                    <span><?php echo $lang === 'en' ? 'What kind of support do you provide after the website is complete?' : 'Bagaimana dengan support setelah website selesai?'; ?></span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="faq-answer">
                    <div class="faq-answer-content">
                        <?php echo $lang === 'en' ? 'We provide technical support according to the package you choose (1-6 months). During this period, we will help with bugs, minor updates, and technical questions.' : 'Kami menyediakan dukungan teknis sesuai paket yang Anda pilih (1-6 bulan). Selama periode ini, kami akan membantu dengan bug, update kecil, dan pertanyaan teknis.'; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
// Include footer and floating elements
include 'components/layout/footer.php';
include 'components/layout/whatsapp-float.php';
?>

<!-- AOS Library -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<!-- Main JavaScript -->
<script src="assets/js/main.js"></script>

</body>
</html>
