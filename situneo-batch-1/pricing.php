<?php
session_start();
$lang = $_GET['lang'] ?? $_SESSION['lang'] ?? 'id';
$_SESSION['lang'] = $lang;

$t = ['id' => ['page_title' => 'Paket Harga', 'nav_home' => 'Beranda', 'nav_about' => 'Tentang', 'nav_services' => 'Layanan', 'nav_portfolio' => 'Portfolio', 'nav_pricing' => 'Harga', 'nav_blog' => 'Blog', 'nav_contact' => 'Kontak', 'nav_login' => 'Masuk', 'nib_label' => 'NIB Terdaftar'], 'en' => ['page_title' => 'Pricing Packages', 'nav_home' => 'Home', 'nav_about' => 'About', 'nav_services' => 'Services', 'nav_portfolio' => 'Portfolio', 'nav_pricing' => 'Pricing', 'nav_blog' => 'Blog', 'nav_contact' => 'Contact', 'nav_login' => 'Login', 'nib_label' => 'Registered NIB']][$lang];

$pageTitle = $t['page_title'] . ' - SITUNEO';
$baseURL = '/';

include 'components/layout/header.php';
include 'components/layout/navigation.php';
?>

<section class="hero" style="padding-top: 140px; padding-bottom: 60px;">
    <div class="container">
        <div class="hero-content" data-aos="fade-up">
            <h1><?php echo $t['page_title']; ?></h1>
            <p><?php echo $lang === 'en' ? 'Choose the package that best suits your needs and budget' : 'Pilih paket yang sesuai dengan kebutuhan dan budget Anda'; ?></p>
        </div>
    </div>
</section>

<!-- Bundling Packages -->
<section style="padding: 60px 0;">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title"><span><?php echo $lang === 'en' ? 'Complete Bundling Packages' : 'Paket Bundling Lengkap'; ?></span></h2>
        </div>

        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 30px;">
            <?php
            $packages = [
                ['name' => 'Starter Bundle', 'price' => 'Rp 2.5JT', 'features' => ['Company Profile Website', 'Logo Design', 'Domain .com (1 Tahun)', 'Hosting 1GB', 'Basic SEO', '2 Bulan Support'], 'popular' => false],
                ['name' => 'Business Bundle', 'price' => 'Rp 4JT', 'features' => ['E-Commerce Website', 'Logo + Banner Design', 'Domain .com (1 Tahun)', 'Hosting 5GB', 'Advanced SEO', 'Blog System', '3 Bulan Support'], 'popular' => true],
                ['name' => 'Premium Bundle', 'price' => 'Rp 6.5JT', 'features' => ['Custom Website Design', 'Complete Branding', 'Domain .com (1 Tahun)', 'Hosting 10GB', 'Premium SEO', 'Full Features', '6 Bulan Support'], 'popular' => false],
                ['name' => 'Corporate Bundle', 'price' => 'Rp 8JT', 'features' => ['Multi-page Corporate Site', 'Corporate Identity Design', 'Domain .com + .id', 'Hosting 20GB', 'Enterprise SEO', 'CMS + Blog', '1 Tahun Support'], 'popular' => false],
                ['name' => 'E-Commerce Pro', 'price' => 'Rp 10JT', 'features' => ['Full E-Commerce Platform', 'Product Photography', 'Domain Premium', 'Hosting 50GB', 'E-Commerce SEO', 'Payment Gateway', '1 Tahun Support'], 'popular' => false],
                ['name' => 'Enterprise Bundle', 'price' => 'Rp 15JT', 'features' => ['Custom Enterprise Solution', 'Full Branding Package', 'Multiple Domains', 'Dedicated Hosting', 'Enterprise SEO', 'All Features Unlimited', '2 Tahun Support'], 'popular' => false]
            ];

            foreach ($packages as $index => $package):
            ?>
            <div class="pricing-card <?php echo $package['popular'] ? 'featured' : ''; ?>" data-aos="fade-up" data-aos-delay="<?php echo ($index + 1) * 100; ?>">
                <?php if ($package['popular']): ?>
                <div class="pricing-badge"><?php echo $lang === 'en' ? 'MOST POPULAR' : 'PALING POPULER'; ?></div>
                <?php endif; ?>
                <h3 class="pricing-name"><?php echo $package['name']; ?></h3>
                <div class="pricing-price"><?php echo $package['price']; ?></div>
                <p class="pricing-period">/ <?php echo $lang === 'en' ? 'bundle' : 'paket'; ?></p>
                <ul class="pricing-features">
                    <?php foreach ($package['features'] as $feature): ?>
                    <li><i class="fas fa-check"></i> <?php echo $feature; ?></li>
                    <?php endforeach; ?>
                </ul>
                <a href="auth/login.php" class="btn-primary" style="width: 100%; justify-content: center;">
                    <?php echo $lang === 'en' ? 'Choose Package' : 'Pilih Paket'; ?>
                </a>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Feature Comparison -->
<section style="padding: 60px 0; background: rgba(0,0,0,0.2);">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title"><span><?php echo $lang === 'en' ? 'Feature Comparison' : 'Perbandingan Fitur'; ?></span></h2>
        </div>

        <div style="overflow-x: auto;" data-aos="fade-up">
            <table style="width: 100%; min-width: 800px; border-collapse: collapse; background: rgba(255,255,255,0.05); border-radius: 15px; overflow: hidden;">
                <thead style="background: rgba(255,180,0,0.2);">
                    <tr>
                        <th style="padding: 20px; text-align: left; border-bottom: 2px solid var(--gold-start);"><?php echo $lang === 'en' ? 'Features' : 'Fitur'; ?></th>
                        <th style="padding: 20px; text-align: center; border-bottom: 2px solid var(--gold-start);">Starter</th>
                        <th style="padding: 20px; text-align: center; border-bottom: 2px solid var(--gold-start);">Business</th>
                        <th style="padding: 20px; text-align: center; border-bottom: 2px solid var(--gold-start);">Premium</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $features = [
                        ['Jumlah Halaman', '5', '10', 'Unlimited'],
                        ['Responsive Design', '✓', '✓', '✓'],
                        ['SEO Optimization', 'Basic', 'Advanced', 'Premium'],
                        ['Logo Design', '✗', '✓', '✓'],
                        ['Blog System', '✗', '✓', '✓'],
                        ['E-Commerce', '✗', '✗', '✓'],
                        ['Durasi Support', '1 Bulan', '3 Bulan', '6 Bulan']
                    ];

                    foreach ($features as $feature):
                    ?>
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.1);">
                        <td style="padding: 15px;"><?php echo $feature[0]; ?></td>
                        <td style="padding: 15px; text-align: center;"><?php echo $feature[1]; ?></td>
                        <td style="padding: 15px; text-align: center;"><?php echo $feature[2]; ?></td>
                        <td style="padding: 15px; text-align: center;"><?php echo $feature[3]; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- FAQ -->
<section style="padding: 60px 0;">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title"><span><?php echo $lang === 'en' ? 'Frequently Asked Questions' : 'Pertanyaan Umum'; ?></span></h2>
        </div>

        <div class="faq-accordion" data-aos="fade-up">
            <div class="faq-item">
                <button class="faq-question">
                    <span><?php echo $lang === 'en' ? 'Can I upgrade my package later?' : 'Apakah bisa upgrade paket nanti?'; ?></span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="faq-answer">
                    <div class="faq-answer-content"><?php echo $lang === 'en' ? 'Yes, you can upgrade anytime by paying the difference.' : 'Ya, Anda bisa upgrade kapan saja dengan membayar selisihnya.'; ?></div>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">
                    <span><?php echo $lang === 'en' ? 'Is there a refund policy?' : 'Apakah ada kebijakan refund?'; ?></span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="faq-answer">
                    <div class="faq-answer-content"><?php echo $lang === 'en' ? 'We offer 30-day money-back guarantee if you are not satisfied.' : 'Kami menawarkan jaminan uang kembali 30 hari jika tidak puas.'; ?></div>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question">
                    <span><?php echo $lang === 'en' ? 'What payment methods do you accept?' : 'Metode pembayaran apa saja yang diterima?'; ?></span>
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="faq-answer">
                    <div class="faq-answer-content"><?php echo $lang === 'en' ? 'We accept Bank Transfer, Credit Card, GoPay, OVO, DANA, and PayPal.' : 'Kami menerima Transfer Bank, Kartu Kredit, GoPay, OVO, DANA, dan PayPal.'; ?></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Calculator CTA -->
<section style="padding: 60px 0; background: rgba(0,0,0,0.2);">
    <div class="container">
        <div class="card" style="text-align: center; max-width: 800px; margin: 0 auto; background: rgba(255,180,0,0.1); border-color: var(--gold-start);" data-aos="fade-up">
            <div class="card-icon" style="margin: 0 auto;">
                <i class="fas fa-calculator"></i>
            </div>
            <h3 class="card-title"><?php echo $lang === 'en' ? 'Calculate Your Project Cost' : 'Hitung Biaya Proyek Anda'; ?></h3>
            <p class="card-text" style="margin-bottom: 20px;"><?php echo $lang === 'en' ? 'Use our price calculator to get an accurate estimate for your project' : 'Gunakan kalkulator harga kami untuk mendapatkan estimasi yang akurat untuk proyek Anda'; ?></p>
            <a href="calculator.php" class="btn-primary">
                <i class="fas fa-arrow-right"></i>
                <span><?php echo $lang === 'en' ? 'Go to Calculator' : 'Buka Kalkulator'; ?></span>
            </a>
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
