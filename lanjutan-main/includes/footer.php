</div>
<!-- End Main Wrapper -->

<!-- Footer -->
<footer class="py-5" style="background: linear-gradient(135deg, #0F3057 0%, #000000 100%); border-top: 2px solid var(--gold);">
    <div class="container">
        <div class="row g-4">
            <!-- Brand Info -->
            <div class="col-lg-4">
                <div class="d-flex align-items-center mb-3">
                    <img src="https://situneo.my.id/logo"
                         alt="Situneo" width="60" height="60"
                         style="border-radius: 15px; margin-right: 15px;">
                    <div>
                        <h4 style="color: var(--gold); margin: 0; font-weight: 800;">SITUNEO DIGITAL</h4>
                        <small style="color: var(--text-light);">Digital Harmony</small>
                    </div>
                </div>
                <p style="color: var(--text-light); line-height: 1.8; margin-bottom: 1rem;">
                    Partner digital terpercaya sejak 2020. Udah bantu 500+ bisnis sukses online dengan harga paling terjangkau!
                </p>
                <div class="trust-badges">
                    <div style="background: rgba(212, 175, 55,0.1); border: 1px solid var(--gold);
                         padding: 10px 20px; border-radius: 10px; display: inline-block; margin-bottom: 1rem;">
                        <strong style="color: var(--gold);">NIB:</strong>
                        <span style="color: var(--text-light); font-size: 0.9rem;"><?= COMPANY_NIB ?? '20250-9261-4570-4515-5453' ?></span>
                    </div>
                </div>
                <div class="social-links mt-3">
                    <h6 style="color: var(--gold); margin-bottom: 15px;">Follow Kami</h6>
                    <div class="d-flex gap-2">
                        <a href="https://facebook.com/situneo" target="_blank" class="social-btn" style="width: 45px; height: 45px; background: rgba(212, 175, 55,0.15);
                           border: 1px solid var(--gold); border-radius: 12px; display: flex; align-items: center;
                           justify-content: center; color: var(--gold); text-decoration: none; transition: all 0.3s;">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="https://instagram.com/situneo" target="_blank" class="social-btn" style="width: 45px; height: 45px; background: rgba(212, 175, 55,0.15);
                           border: 1px solid var(--gold); border-radius: 12px; display: flex; align-items: center;
                           justify-content: center; color: var(--gold); text-decoration: none; transition: all 0.3s;">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="https://tiktok.com/@situneo" target="_blank" class="social-btn" style="width: 45px; height: 45px; background: rgba(212, 175, 55,0.15);
                           border: 1px solid var(--gold); border-radius: 12px; display: flex; align-items: center;
                           justify-content: center; color: var(--gold); text-decoration: none; transition: all 0.3s;">
                            <i class="bi bi-tiktok"></i>
                        </a>
                        <a href="https://youtube.com/@situneo" target="_blank" class="social-btn" style="width: 45px; height: 45px; background: rgba(212, 175, 55,0.15);
                           border: 1px solid var(--gold); border-radius: 12px; display: flex; align-items: center;
                           justify-content: center; color: var(--gold); text-decoration: none; transition: all 0.3s;">
                            <i class="bi bi-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 col-md-4">
                <h5 style="color: var(--gold); font-weight: 700; margin-bottom: 1.5rem;">Menu Cepat</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="/" style="color: var(--text-light); text-decoration: none; transition: color 0.3s;">
                            <i class="bi bi-chevron-right" style="font-size: 0.8rem;"></i> Beranda
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="/about" style="color: var(--text-light); text-decoration: none; transition: color 0.3s;">
                            <i class="bi bi-chevron-right" style="font-size: 0.8rem;"></i> Tentang Kami
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="/services" style="color: var(--text-light); text-decoration: none; transition: color 0.3s;">
                            <i class="bi bi-chevron-right" style="font-size: 0.8rem;"></i> Layanan
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="/portfolio" style="color: var(--text-light); text-decoration: none; transition: color 0.3s;">
                            <i class="bi bi-chevron-right" style="font-size: 0.8rem;"></i> Demo Website
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="/pricing" style="color: var(--text-light); text-decoration: none; transition: color 0.3s;">
                            <i class="bi bi-chevron-right" style="font-size: 0.8rem;"></i> Harga Paket
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="/contact" style="color: var(--text-light); text-decoration: none; transition: color 0.3s;">
                            <i class="bi bi-chevron-right" style="font-size: 0.8rem;"></i> Hubungi
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="/calculator" style="color: var(--text-light); text-decoration: none; transition: color 0.3s;">
                            <i class="bi bi-chevron-right" style="font-size: 0.8rem;"></i> Hitung Harga
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Services -->
            <div class="col-lg-3 col-md-4">
                <h5 style="color: var(--gold); font-weight: 700; margin-bottom: 1.5rem;">Layanan Populer</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="/services#website" style="color: var(--text-light); text-decoration: none; transition: color 0.3s;">
                            <i class="bi bi-check-circle" style="font-size: 0.9rem;"></i> Bikin Website
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="/services#seo" style="color: var(--text-light); text-decoration: none; transition: color 0.3s;">
                            <i class="bi bi-check-circle" style="font-size: 0.9rem;"></i> SEO & Digital Marketing
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="/services#ecommerce" style="color: var(--text-light); text-decoration: none; transition: color 0.3s;">
                            <i class="bi bi-check-circle" style="font-size: 0.9rem;"></i> Toko Online
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="/services#design" style="color: var(--text-light); text-decoration: none; transition: color 0.3s;">
                            <i class="bi bi-check-circle" style="font-size: 0.9rem;"></i> Design Logo
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="/services#chatbot" style="color: var(--text-light); text-decoration: none; transition: color 0.3s;">
                            <i class="bi bi-check-circle" style="font-size: 0.9rem;"></i> Robot Chat AI
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="/services#custom" style="color: var(--text-light); text-decoration: none; transition: color 0.3s;">
                            <i class="bi bi-check-circle" style="font-size: 0.9rem;"></i> Custom Development
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Account & Legal -->
            <div class="col-lg-3 col-md-4">
                <h5 style="color: var(--gold); font-weight: 700; margin-bottom: 1.5rem;">Akun</h5>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="/auth/login" style="color: var(--text-light); text-decoration: none; transition: color 0.3s;">
                            <i class="bi bi-box-arrow-in-right" style="font-size: 0.9rem;"></i> Login
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="/auth/register" style="color: var(--text-light); text-decoration: none; transition: color 0.3s;">
                            <i class="bi bi-person-plus" style="font-size: 0.9rem;"></i> Daftar Akun
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="/client/dashboard" style="color: var(--text-light); text-decoration: none; transition: color 0.3s;">
                            <i class="bi bi-speedometer2" style="font-size: 0.9rem;"></i> Dashboard
                        </a>
                    </li>
                </ul>

                <h6 style="color: var(--gold); margin-top: 2rem; margin-bottom: 1rem; font-weight: 600;">Legal</h6>
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <a href="/privacy-policy" style="color: var(--text-light); text-decoration: none; font-size: 0.9rem;">
                            <i class="bi bi-shield" style="font-size: 0.8rem;"></i> Privacy Policy
                        </a>
                    </li>
                    <li class="mb-2">
                        <a href="/terms-of-service" style="color: var(--text-light); text-decoration: none; font-size: 0.9rem;">
                            <i class="bi bi-file-text" style="font-size: 0.8rem;"></i> Terms of Service
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <hr style="border-color: rgba(212, 175, 55,0.2); margin: 2rem 0;">

        <!-- Copyright -->
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                <p style="color: var(--text-light); margin: 0; font-size: 0.95rem;">
                    &copy; <?= date('Y') ?> <strong style="color: var(--gold);">SITUNEO DIGITAL</strong>. All Rights Reserved.
                </p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <p style="color: var(--text-light); margin: 0; font-size: 0.95rem;">
                    Made with <i class="bi bi-heart-fill" style="color: #FF0000;"></i> in Jakarta, Indonesia
                </p>
            </div>
        </div>
    </div>
</footer>

<style>
    footer a:hover {
        color: var(--gold) !important;
        padding-left: 5px;
    }

    .social-btn:hover {
        background: var(--gradient-gold) !important;
        transform: translateY(-3px);
        color: var(--dark-blue) !important;
    }
</style>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

<!-- Custom Scripts -->
<script src="<?= ASSETS_URL ?>/js/main.js"></script>
<script src="<?= ASSETS_URL ?>/js/network-bg.js"></script>
<script src="<?= ASSETS_URL ?>/js/loading-screen.js"></script>
<script src="<?= ASSETS_URL ?>/js/animations.js"></script>
<script src="<?= ASSETS_URL ?>/js/order-notification.js"></script>
<script src="<?= ASSETS_URL ?>/js/language-switcher.js"></script>
<script src="<?= ASSETS_URL ?>/js/quantum-effects.js"></script>

<?php if (isset($customJS)): ?>
<script src="<?= ASSETS_URL ?>/js/<?= $customJS ?>"></script>
<?php endif; ?>

<script>
// Initialize AOS
AOS.init({
    duration: 1000,
    once: true,
    offset: 100
});

// Navbar scroll effect
window.addEventListener('scroll', function() {
    const navbar = document.getElementById('mainNavbar');
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});

// Back to top button
window.addEventListener('scroll', function() {
    const backToTop = document.getElementById('backToTop');
    if (window.scrollY > 300) {
        backToTop.style.display = 'flex';
    } else {
        backToTop.style.display = 'none';
    }
});

function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

// Close order notification
function closeOrderNotification() {
    document.getElementById('orderNotification').classList.remove('show');
}
</script>

</body>
</html>
