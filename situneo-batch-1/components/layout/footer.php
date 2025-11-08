<!-- Footer -->
<footer class="footer">
    <div class="container">
        <!-- Footer Top -->
        <div class="footer-top">
            <div class="footer-row">
                <!-- Company Info -->
                <div class="footer-col">
                    <div class="footer-logo">
                        <i class="fas fa-globe"></i>
                        <span>SITUNEO</span>
                    </div>
                    <p class="footer-desc">
                        <?php echo $t['footer_desc'] ?? 'Platform digital terdepan yang menghubungkan bisnis dengan freelancer profesional untuk menciptakan website berkualitas tinggi.'; ?>
                    </p>
                    <div class="footer-social">
                        <a href="https://facebook.com/situneo" target="_blank" rel="noopener" class="social-link">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://twitter.com/situneo" target="_blank" rel="noopener" class="social-link">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://instagram.com/situneo" target="_blank" rel="noopener" class="social-link">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="https://linkedin.com/company/situneo" target="_blank" rel="noopener" class="social-link">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="https://youtube.com/situneo" target="_blank" rel="noopener" class="social-link">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="footer-col">
                    <h4 class="footer-title"><?php echo $t['footer_links'] ?? 'Tautan Cepat'; ?></h4>
                    <ul class="footer-links">
                        <li><a href="<?php echo $baseURL ?? '/'; ?>about.php"><?php echo $t['nav_about'] ?? 'Tentang Kami'; ?></a></li>
                        <li><a href="<?php echo $baseURL ?? '/'; ?>services.php"><?php echo $t['nav_services'] ?? 'Layanan'; ?></a></li>
                        <li><a href="<?php echo $baseURL ?? '/'; ?>portfolio.php"><?php echo $t['nav_portfolio'] ?? 'Portfolio'; ?></a></li>
                        <li><a href="<?php echo $baseURL ?? '/'; ?>pricing.php"><?php echo $t['nav_pricing'] ?? 'Harga'; ?></a></li>
                        <li><a href="<?php echo $baseURL ?? '/'; ?>calculator.php"><?php echo $t['footer_calculator'] ?? 'Kalkulator Harga'; ?></a></li>
                        <li><a href="<?php echo $baseURL ?? '/'; ?>career.php"><?php echo $t['footer_career'] ?? 'Karir'; ?></a></li>
                    </ul>
                </div>

                <!-- Services -->
                <div class="footer-col">
                    <h4 class="footer-title"><?php echo $t['footer_services'] ?? 'Layanan Kami'; ?></h4>
                    <ul class="footer-links">
                        <li><a href="<?php echo $baseURL ?? '/'; ?>services.php?division=web-dev"><?php echo $t['service_web_dev'] ?? 'Pembuatan Website'; ?></a></li>
                        <li><a href="<?php echo $baseURL ?? '/'; ?>services.php?division=ecommerce"><?php echo $t['service_ecommerce'] ?? 'Toko Online'; ?></a></li>
                        <li><a href="<?php echo $baseURL ?? '/'; ?>services.php?division=design"><?php echo $t['service_design'] ?? 'Desain Grafis'; ?></a></li>
                        <li><a href="<?php echo $baseURL ?? '/'; ?>services.php?division=seo"><?php echo $t['service_seo'] ?? 'SEO & Marketing'; ?></a></li>
                        <li><a href="<?php echo $baseURL ?? '/'; ?>services.php?division=mobile"><?php echo $t['service_mobile'] ?? 'Aplikasi Mobile'; ?></a></li>
                        <li><a href="<?php echo $baseURL ?? '/'; ?>services.php"><?php echo $t['service_more'] ?? 'Lihat Semua'; ?></a></li>
                    </ul>
                </div>

                <!-- Newsletter -->
                <div class="footer-col">
                    <h4 class="footer-title"><?php echo $t['footer_newsletter'] ?? 'Newsletter'; ?></h4>
                    <p class="newsletter-desc">
                        <?php echo $t['newsletter_desc'] ?? 'Dapatkan update terbaru tentang tips website, promo spesial, dan berita industri digital.'; ?>
                    </p>
                    <form class="newsletter-form" id="newsletterForm">
                        <input type="email" placeholder="<?php echo $t['newsletter_placeholder'] ?? 'Alamat Email'; ?>" required>
                        <button type="submit">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                    <div class="newsletter-result" id="newsletterResult"></div>
                </div>
            </div>
        </div>

        <!-- Footer Middle - Payment Methods -->
        <div class="footer-middle">
            <div class="payment-methods">
                <h5><?php echo $t['payment_methods'] ?? 'Metode Pembayaran'; ?></h5>
                <div class="payment-logos">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" alt="Visa" loading="lazy">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" alt="Mastercard" loading="lazy">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" alt="PayPal" loading="lazy">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/e/e1/Logo_of_GoPay.svg" alt="GoPay" loading="lazy">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/7/72/Logo_dana_blue.svg" alt="DANA" loading="lazy">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/9/9b/OVO_logo.svg" alt="OVO" loading="lazy">
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="footer-bottom-content">
                <p class="copyright">
                    &copy; <?php echo date('Y'); ?> SITUNEO. <?php echo $t['footer_rights'] ?? 'All Rights Reserved.'; ?>
                </p>
                <div class="footer-legal">
                    <a href="pages/privacy-policy.php"><?php echo $t['footer_privacy'] ?? 'Kebijakan Privasi'; ?></a>
                    <span>|</span>
                    <a href="pages/terms-of-service.php"><?php echo $t['footer_terms'] ?? 'Syarat & Ketentuan'; ?></a>
                    <span>|</span>
                    <a href="pages/sitemap.php"><?php echo $t['footer_sitemap'] ?? 'Peta Situs'; ?></a>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Newsletter Form Handler -->
<script>
document.getElementById('newsletterForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const email = this.querySelector('input[type="email"]').value;
    const resultDiv = document.getElementById('newsletterResult');

    // Simulate API call
    resultDiv.innerHTML = '<i class="fas fa-spinner fa-spin"></i> <?php echo $t['newsletter_sending'] ?? 'Mengirim...'; ?>';

    setTimeout(() => {
        resultDiv.innerHTML = '<i class="fas fa-check-circle"></i> <?php echo $t['newsletter_success'] ?? 'Terima kasih! Email Anda telah terdaftar.'; ?>';
        this.reset();

        setTimeout(() => {
            resultDiv.innerHTML = '';
        }, 5000);
    }, 1500);
});
</script>
