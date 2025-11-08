<?php
session_start();
$lang = $_GET['lang'] ?? $_SESSION['lang'] ?? 'id';
$_SESSION['lang'] = $lang;

$t = ['id' => ['page_title' => 'Hubungi Kami', 'nav_home' => 'Beranda', 'nav_about' => 'Tentang', 'nav_services' => 'Layanan', 'nav_portfolio' => 'Portfolio', 'nav_pricing' => 'Harga', 'nav_blog' => 'Blog', 'nav_contact' => 'Kontak', 'nav_login' => 'Masuk', 'nib_label' => 'NIB Terdaftar'], 'en' => ['page_title' => 'Contact Us', 'nav_home' => 'Home', 'nav_about' => 'About', 'nav_services' => 'Services', 'nav_portfolio' => 'Portfolio', 'nav_pricing' => 'Pricing', 'nav_blog' => 'Blog', 'nav_contact' => 'Contact', 'nav_login' => 'Login', 'nib_label' => 'Registered NIB']][$lang];

$pageTitle = $t['page_title'] . ' - SITUNEO';
$baseURL = '/';

include 'components/layout/header-new.php';
include 'components/layout/navigation-new.php';
?>

<section class="hero" style="padding-top: 140px; padding-bottom: 60px;">
    <div class="container">
        <div class="hero-content" data-aos="fade-up">
            <h1><?php echo $t['page_title']; ?></h1>
            <p><?php echo $lang === 'en' ? 'We are ready to help you. Contact us through the channel below' : 'Kami siap membantu Anda. Hubungi kami melalui channel di bawah ini'; ?></p>
        </div>
    </div>
</section>

<!-- Contact Info Cards -->
<section style="padding: 60px 0;">
    <div class="container">
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px; margin-bottom: 60px;">
            <div class="card" style="text-align: center;" data-aos="fade-up" data-aos-delay="100">
                <div class="card-icon" style="margin: 0 auto;">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <h3 class="card-title"><?php echo $lang === 'en' ? 'Address' : 'Alamat'; ?></h3>
                <p class="card-text">Jl. Sudirman No. 123<br>Jakarta Pusat 10110<br>Indonesia</p>
            </div>

            <div class="card" style="text-align: center;" data-aos="fade-up" data-aos-delay="200">
                <div class="card-icon" style="margin: 0 auto;">
                    <i class="fas fa-envelope"></i>
                </div>
                <h3 class="card-title">Email</h3>
                <p class="card-text">info@situneo.com<br>support@situneo.com<br>sales@situneo.com</p>
            </div>

            <div class="card" style="text-align: center;" data-aos="fade-up" data-aos-delay="300">
                <div class="card-icon" style="margin: 0 auto;">
                    <i class="fas fa-phone"></i>
                </div>
                <h3 class="card-title"><?php echo $lang === 'en' ? 'Phone' : 'Telepon'; ?></h3>
                <p class="card-text">+62 812-3456-7890<br>+62 21-1234-5678</p>
            </div>

            <div class="card" style="text-align: center;" data-aos="fade-up" data-aos-delay="400">
                <div class="card-icon" style="margin: 0 auto;">
                    <i class="fab fa-whatsapp"></i>
                </div>
                <h3 class="card-title">WhatsApp</h3>
                <p class="card-text">+62 812-3456-7890<br><?php echo $lang === 'en' ? 'Available 24/7' : 'Tersedia 24/7'; ?></p>
            </div>
        </div>

        <!-- Contact Form & Map -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 40px;">
            <!-- Contact Form -->
            <div class="card" data-aos="fade-up">
                <h3 class="card-title" style="margin-bottom: 25px;">
                    <i class="fas fa-paper-plane"></i>
                    <?php echo $lang === 'en' ? 'Send Message' : 'Kirim Pesan'; ?>
                </h3>

                <form id="contactForm">
                    <div style="margin-bottom: 20px;">
                        <input type="text" class="form-control" placeholder="<?php echo $lang === 'en' ? 'Your Name' : 'Nama Anda'; ?>" required>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <input type="email" class="form-control" placeholder="Email" required>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <input type="tel" class="form-control" placeholder="<?php echo $lang === 'en' ? 'Phone Number' : 'Nomor Telepon'; ?>" required>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <input type="text" class="form-control" placeholder="<?php echo $lang === 'en' ? 'Subject' : 'Subjek'; ?>" required>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <textarea class="form-control" placeholder="<?php echo $lang === 'en' ? 'Your Message' : 'Pesan Anda'; ?>" rows="5" required></textarea>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <div class="g-recaptcha" data-sitekey="6LeIxAcTAAAAAJcZVRqyHh71UMIEGNQ_MXjiZKhI"></div>
                    </div>

                    <button type="submit" class="btn-primary" style="width: 100%; justify-content: center;">
                        <i class="fas fa-paper-plane"></i>
                        <span><?php echo $lang === 'en' ? 'Send Message' : 'Kirim Pesan'; ?></span>
                    </button>
                </form>
            </div>

            <!-- Google Maps -->
            <div data-aos="fade-up" data-aos-delay="200">
                <div style="border-radius: 15px; overflow: hidden; height: 100%; min-height: 500px;">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322283!2d106.8195613!3d-6.2087634!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5d2e764b12d%3A0x3d2ad6e1e0e9bcc8!2sMonas!5e0!3m2!1sen!2sid!4v1234567890" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Office Hours -->
<section style="padding: 60px 0; background: rgba(0,0,0,0.2);">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title"><span><?php echo $lang === 'en' ? 'Office Hours' : 'Jam Operasional'; ?></span></h2>
        </div>

        <div class="card" style="max-width: 600px; margin: 0 auto; text-align: center;" data-aos="fade-up">
            <div style="display: grid; gap: 15px;">
                <div style="display: flex; justify-content: space-between; padding: 15px; background: rgba(255,255,255,0.05); border-radius: 10px;">
                    <span><?php echo $lang === 'en' ? 'Monday - Friday' : 'Senin - Jumat'; ?></span>
                    <span style="color: var(--gold-start); font-weight: 600;">09:00 - 18:00</span>
                </div>
                <div style="display: flex; justify-content: space-between; padding: 15px; background: rgba(255,255,255,0.05); border-radius: 10px;">
                    <span><?php echo $lang === 'en' ? 'Saturday' : 'Sabtu'; ?></span>
                    <span style="color: var(--gold-start); font-weight: 600;">10:00 - 15:00</span>
                </div>
                <div style="display: flex; justify-content: space-between; padding: 15px; background: rgba(255,255,255,0.05); border-radius: 10px;">
                    <span><?php echo $lang === 'en' ? 'Sunday' : 'Minggu'; ?></span>
                    <span style="color: var(--text-light);"><?php echo $lang === 'en' ? 'Closed' : 'Tutup'; ?></span>
                </div>
                <div style="display: flex; justify-content: space-between; padding: 15px; background: rgba(255,180,0,0.1); border-radius: 10px; border: 1px solid var(--gold-start);">
                    <span><?php echo $lang === 'en' ? 'WhatsApp Support' : 'Support WhatsApp'; ?></span>
                    <span style="color: var(--gold-start); font-weight: 600;">24/7</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Social Media -->
<section style="padding: 60px 0;">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title"><span><?php echo $lang === 'en' ? 'Follow Us' : 'Ikuti Kami'; ?></span></h2>
        </div>

        <div style="display: flex; gap: 20px; justify-content: center; flex-wrap: wrap;" data-aos="fade-up">
            <?php
            $socials = [
                ['name' => 'Facebook', 'icon' => 'fab fa-facebook-f', 'url' => 'https://facebook.com/situneo', 'color' => '#1877F2'],
                ['name' => 'Instagram', 'icon' => 'fab fa-instagram', 'url' => 'https://instagram.com/situneo', 'color' => '#E4405F'],
                ['name' => 'Twitter', 'icon' => 'fab fa-twitter', 'url' => 'https://twitter.com/situneo', 'color' => '#1DA1F2'],
                ['name' => 'LinkedIn', 'icon' => 'fab fa-linkedin-in', 'url' => 'https://linkedin.com/company/situneo', 'color' => '#0A66C2'],
                ['name' => 'YouTube', 'icon' => 'fab fa-youtube', 'url' => 'https://youtube.com/situneo', 'color' => '#FF0000']
            ];

            foreach ($socials as $social):
            ?>
            <a href="<?php echo $social['url']; ?>" target="_blank" rel="noopener" style="width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 24px; color: var(--white); background: rgba(255,255,255,0.1); transition: var(--transition);" onmouseover="this.style.background='<?php echo $social['color']; ?>'" onmouseout="this.style.background='rgba(255,255,255,0.1)'">
                <i class="<?php echo $social['icon']; ?>"></i>
            </a>
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
