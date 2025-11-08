</main>
<!-- Main Content End -->

<!-- Footer -->
<footer class="footer">
    <div class="footer-top">
        <div class="container">
            <div class="row g-4">
                <!-- Company Info -->
                <div class="col-lg-4 col-md-6">
                    <div class="footer-widget">
                        <img src="<?= asset('images/logo-white.png') ?>" alt="SITUNEO DIGITAL" class="footer-logo mb-3">
                        <p class="footer-desc">
                            Solusi digital terlengkap di Indonesia dengan 232+ layanan, dual pricing system (Beli Putus & Sewa Bulanan), dan 50+ demo website production-ready.
                        </p>
                        <div class="footer-stats">
                            <div class="stat-item">
                                <i class="bi bi-shield-check"></i>
                                <span>NIB: <?= COMPANY_NIB ?></span>
                            </div>
                            <div class="stat-item">
                                <i class="bi bi-award"></i>
                                <span>Terpercaya sejak 2020</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6">
                    <div class="footer-widget">
                        <h5 class="footer-title">Layanan</h5>
                        <ul class="footer-links">
                            <li><a href="<?= url('services?category=web-development') ?>">Web Development</a></li>
                            <li><a href="<?= url('services?category=mobile-app') ?>">Mobile App</a></li>
                            <li><a href="<?= url('services?category=ui-ux-design') ?>">UI/UX Design</a></li>
                            <li><a href="<?= url('services?category=digital-marketing') ?>">Digital Marketing</a></li>
                            <li><a href="<?= url('services?category=seo') ?>">SEO Services</a></li>
                            <li><a href="<?= url('services') ?>">Lihat Semua</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Company -->
                <div class="col-lg-2 col-md-6">
                    <div class="footer-widget">
                        <h5 class="footer-title">Perusahaan</h5>
                        <ul class="footer-links">
                            <li><a href="<?= url('about') ?>">Tentang Kami</a></li>
                            <li><a href="<?= url('portfolio') ?>">Portfolio</a></li>
                            <li><a href="<?= url('pricing') ?>">Harga</a></li>
                            <li><a href="<?= url('demo') ?>">Free Demo</a></li>
                            <li><a href="<?= url('blog') ?>">Blog</a></li>
                            <li><a href="<?= url('contact') ?>">Kontak</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Legal -->
                <div class="col-lg-2 col-md-6">
                    <div class="footer-widget">
                        <h5 class="footer-title">Legal</h5>
                        <ul class="footer-links">
                            <li><a href="<?= url('privacy-policy') ?>">Privacy Policy</a></li>
                            <li><a href="<?= url('terms-of-service') ?>">Terms of Service</a></li>
                            <li><a href="<?= url('refund-policy') ?>">Refund Policy</a></li>
                            <li><a href="<?= url('sla') ?>">SLA Agreement</a></li>
                            <li><a href="<?= url('freelancer') ?>">Jadi Freelancer</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Contact -->
                <div class="col-lg-2 col-md-6">
                    <div class="footer-widget">
                        <h5 class="footer-title">Hubungi Kami</h5>
                        <ul class="footer-contact">
                            <li>
                                <i class="bi bi-geo-alt"></i>
                                <span><?= COMPANY_ADDRESS ?? 'Indonesia' ?></span>
                            </li>
                            <li>
                                <i class="bi bi-envelope"></i>
                                <a href="mailto:<?= COMPANY_EMAIL ?>"><?= COMPANY_EMAIL ?></a>
                            </li>
                            <li>
                                <i class="bi bi-whatsapp"></i>
                                <a href="<?= whatsapp_link(COMPANY_WHATSAPP, 'Halo SITUNEO') ?>" target="_blank">
                                    <?= format_phone(COMPANY_WHATSAPP) ?>
                                </a>
                            </li>
                        </ul>

                        <!-- Social Media -->
                        <div class="footer-social mt-3">
                            <?php if (defined('COMPANY_INSTAGRAM') && COMPANY_INSTAGRAM): ?>
                            <a href="<?= COMPANY_INSTAGRAM ?>" target="_blank" class="social-link" title="Instagram">
                                <i class="bi bi-instagram"></i>
                            </a>
                            <?php endif; ?>

                            <?php if (defined('COMPANY_FACEBOOK') && COMPANY_FACEBOOK): ?>
                            <a href="<?= COMPANY_FACEBOOK ?>" target="_blank" class="social-link" title="Facebook">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <?php endif; ?>

                            <?php if (defined('COMPANY_TIKTOK') && COMPANY_TIKTOK): ?>
                            <a href="<?= COMPANY_TIKTOK ?>" target="_blank" class="social-link" title="TikTok">
                                <i class="bi bi-tiktok"></i>
                            </a>
                            <?php endif; ?>

                            <?php if (defined('COMPANY_YOUTUBE') && COMPANY_YOUTUBE): ?>
                            <a href="<?= COMPANY_YOUTUBE ?>" target="_blank" class="social-link" title="YouTube">
                                <i class="bi bi-youtube"></i>
                            </a>
                            <?php endif; ?>

                            <?php if (defined('COMPANY_LINKEDIN') && COMPANY_LINKEDIN): ?>
                            <a href="<?= COMPANY_LINKEDIN ?>" target="_blank" class="social-link" title="LinkedIn">
                                <i class="bi bi-linkedin"></i>
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Trust Badges -->
    <div class="footer-trust">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12 text-center">
                    <div class="trust-badges">
                        <div class="badge-item">
                            <i class="bi bi-shield-check"></i>
                            <span>100% Aman</span>
                        </div>
                        <div class="badge-item">
                            <i class="bi bi-award"></i>
                            <span>Terpercaya</span>
                        </div>
                        <div class="badge-item">
                            <i class="bi bi-lightning"></i>
                            <span>Pengerjaan Cepat</span>
                        </div>
                        <div class="badge-item">
                            <i class="bi bi-headset"></i>
                            <span>Support 24/7</span>
                        </div>
                        <div class="badge-item">
                            <i class="bi bi-cash-coin"></i>
                            <span>Harga Terjangkau</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Methods -->
    <div class="footer-payment">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <p class="payment-title">Metode Pembayaran:</p>
                    <div class="payment-methods">
                        <img src="<?= asset('images/payment/bca.png') ?>" alt="BCA" title="BCA">
                        <img src="<?= asset('images/payment/mandiri.png') ?>" alt="Mandiri" title="Mandiri">
                        <img src="<?= asset('images/payment/bri.png') ?>" alt="BRI" title="BRI">
                        <img src="<?= asset('images/payment/bni.png') ?>" alt="BNI" title="BNI">
                        <img src="<?= asset('images/payment/gopay.png') ?>" alt="GoPay" title="GoPay">
                        <img src="<?= asset('images/payment/ovo.png') ?>" alt="OVO" title="OVO">
                        <img src="<?= asset('images/payment/dana.png') ?>" alt="DANA" title="DANA">
                        <img src="<?= asset('images/payment/qris.png') ?>" alt="QRIS" title="QRIS">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Footer -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <p class="copyright">
                        &copy; <?= date('Y') ?> <strong>SITUNEO DIGITAL</strong>. All rights reserved.
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="powered-by">
                        Made with <i class="bi bi-heart-fill text-danger"></i> in Indonesia
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Back to Top Button -->
<button id="backToTop" class="back-to-top" title="Kembali ke Atas">
    <i class="bi bi-arrow-up"></i>
</button>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- AOS Animation -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<!-- Custom JavaScript -->
<script src="<?= asset('js/main.js') ?>"></script>

<?php if (isset($additional_js)): ?>
    <?= $additional_js ?>
<?php endif; ?>

<!-- Initialize AOS -->
<script>
    AOS.init({
        duration: 800,
        easing: 'ease-in-out',
        once: true,
        offset: 100
    });
</script>

</body>
</html>
