<?php
/**
 * ========================================
 * SITUNEO DIGITAL - Contact Page
 * Kontak - Contact Form & Office Info
 * ========================================
 */

require_once dirname(__DIR__) . '/config/init.php';

// Page variables
$current_page = 'contact';
$page_title = 'Hubungi SITUNEO - Kontak & Konsultasi Gratis';
$page_description = 'Hubungi SITUNEO Digital untuk konsultasi gratis tentang kebutuhan website Anda. Isi form, telepon, email, atau chat WhatsApp kami. Support 24/7 siap membantu.';
$lang = $_GET['lang'] ?? 'id';

// Include header
include __DIR__ . '/../components/layout/header.php';
?>

<!-- Main Content -->
<main id="main-content">

    <!-- Breadcrumb -->
    <section class="breadcrumb-section">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo SITE_URL; ?>">Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Kontak</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="hero-content text-center">
                <p class="hero-subtitle">HUBUNGI KAMI</p>
                <h1 class="hero-title">
                    Terhubung Dengan Tim<br>
                    <span class="text-gradient-gold">SITUNEO</span>
                </h1>
                <p class="hero-description">
                    Ada pertanyaan atau ingin konsultasi tentang website Anda?
                    Tim kami siap membantu Anda 24/7 melalui berbagai channel komunikasi.
                </p>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="section section-gray">
        <div class="container">
            <div class="row g-4">
                <!-- Contact Form -->
                <div class="col-lg-7" data-aos="fade-right">
                    <div class="card">
                        <div class="card-body p-4">
                            <h3 class="card-title mb-4">
                                <i class="bi bi-chat-dots me-2"></i>
                                Kirim Pesan Kepada Kami
                            </h3>

                            <form id="contactForm" method="POST" action="#">
                                <!-- Name Field -->
                                <div class="mb-3">
                                    <label for="contactName" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" id="contactName" name="name"
                                           placeholder="Masukkan nama Anda" required>
                                </div>

                                <!-- Email Field -->
                                <div class="mb-3">
                                    <label for="contactEmail" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="contactEmail" name="email"
                                           placeholder="contoh@email.com" required>
                                </div>

                                <!-- Phone Field -->
                                <div class="mb-3">
                                    <label for="contactPhone" class="form-label">Nomor Telepon</label>
                                    <input type="tel" class="form-control" id="contactPhone" name="phone"
                                           placeholder="08xx-xxxx-xxxx" required>
                                </div>

                                <!-- Subject Field -->
                                <div class="mb-3">
                                    <label for="contactSubject" class="form-label">Subjek</label>
                                    <select class="form-select" id="contactSubject" name="subject" required>
                                        <option value="">Pilih subjek...</option>
                                        <option value="inquiry">Pertanyaan Umum</option>
                                        <option value="quotation">Minta Penawaran</option>
                                        <option value="support">Support/Bantuan Teknis</option>
                                        <option value="partnership">Kerjasama</option>
                                        <option value="other">Lainnya</option>
                                    </select>
                                </div>

                                <!-- Message Field -->
                                <div class="mb-3">
                                    <label for="contactMessage" class="form-label">Pesan</label>
                                    <textarea class="form-control" id="contactMessage" name="message"
                                              rows="5" placeholder="Tulis pesan Anda di sini..." required></textarea>
                                </div>

                                <!-- reCAPTCHA -->
                                <div class="mb-3">
                                    <div class="g-recaptcha" data-sitekey="<?php echo RECAPTCHA_SITE_KEY; ?>"></div>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-gradient-gold w-100">
                                    <i class="bi bi-send me-2"></i>
                                    Kirim Pesan
                                </button>
                            </form>

                            <p class="text-muted text-center mt-4 small">
                                Kami akan merespons pesan Anda dalam waktu 24 jam.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="col-lg-5" data-aos="fade-left">
                    <!-- Quick Contact Cards -->
                    <div class="mb-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex gap-3">
                                    <div class="flex-shrink-0">
                                        <div class="contact-icon">
                                            <i class="bi bi-geo-alt-fill"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="card-title">Alamat</h5>
                                        <p class="card-text text-muted">
                                            Jl. Digital No. 123<br>
                                            Jakarta Selatan 12345<br>
                                            Indonesia
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex gap-3">
                                    <div class="flex-shrink-0">
                                        <div class="contact-icon">
                                            <i class="bi bi-envelope-fill"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="card-title">Email</h5>
                                        <p class="card-text">
                                            <a href="mailto:info@situneo.my.id" class="text-decoration-none">
                                                info@situneo.my.id
                                            </a><br>
                                            <a href="mailto:support@situneo.my.id" class="text-decoration-none">
                                                support@situneo.my.id
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex gap-3">
                                    <div class="flex-shrink-0">
                                        <div class="contact-icon">
                                            <i class="bi bi-telephone-fill"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="card-title">Telepon</h5>
                                        <p class="card-text">
                                            <a href="tel:+6282100000000" class="text-decoration-none">
                                                +62 821-0000-0000
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="d-flex gap-3">
                                    <div class="flex-shrink-0">
                                        <div class="contact-icon">
                                            <i class="bi bi-whatsapp"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="card-title">WhatsApp</h5>
                                        <p class="card-text">
                                            <a href="https://wa.me/6282100000000" target="_blank" rel="noopener noreferrer"
                                               class="text-decoration-none">
                                                <i class="bi bi-arrow-up-right me-1"></i>
                                                Chat WhatsApp
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex gap-3">
                                    <div class="flex-shrink-0">
                                        <div class="contact-icon">
                                            <i class="bi bi-clock-fill"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1">
                                        <h5 class="card-title">Jam Operasional</h5>
                                        <p class="card-text text-muted mb-2">
                                            <strong>Senin - Jumat:</strong><br>
                                            09:00 - 18:00 WIB<br>
                                            <strong>Sabtu:</strong><br>
                                            10:00 - 15:00 WIB<br>
                                            <strong>Support 24/7:</strong><br>
                                            Via WhatsApp & Email
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Social Links -->
                    <div class="card bg-light">
                        <div class="card-body text-center">
                            <h5 class="card-title mb-3">Ikuti Kami</h5>
                            <div class="d-flex gap-2 justify-content-center">
                                <a href="https://facebook.com/situneo" target="_blank" rel="noopener noreferrer"
                                   class="btn btn-circle btn-facebook">
                                    <i class="bi bi-facebook"></i>
                                </a>
                                <a href="https://instagram.com/situneo" target="_blank" rel="noopener noreferrer"
                                   class="btn btn-circle btn-instagram">
                                    <i class="bi bi-instagram"></i>
                                </a>
                                <a href="https://twitter.com/situneo" target="_blank" rel="noopener noreferrer"
                                   class="btn btn-circle btn-twitter">
                                    <i class="bi bi-twitter"></i>
                                </a>
                                <a href="https://linkedin.com/company/situneo" target="_blank" rel="noopener noreferrer"
                                   class="btn btn-circle btn-linkedin">
                                    <i class="bi bi-linkedin"></i>
                                </a>
                                <a href="https://youtube.com/@situneo" target="_blank" rel="noopener noreferrer"
                                   class="btn btn-circle btn-youtube">
                                    <i class="bi bi-youtube"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section -->
    <section class="section">
        <div class="container">
            <div class="section-header">
                <p class="section-subtitle">LOKASI KAMI</p>
                <h2 class="section-title">Kantor SITUNEO</h2>
            </div>

            <div class="row g-4">
                <div class="col-12" data-aos="zoom-in">
                    <div class="map-container" style="height: 400px; border-radius: 12px; overflow: hidden;">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322596!2d106.7725!3d-6.2088!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e945e34b5d%3A0x5371bf0fdad786a2!2sJakarta%2C%20Indonesia!5e0!3m2!1sid!2sid!4v1234567890"
                                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="section section-gray">
        <div class="container">
            <div class="section-header">
                <p class="section-subtitle">PERTANYAAN UMUM</p>
                <h2 class="section-title">FAQ - Hubungi Kami</h2>
            </div>

            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="accordion" id="faqAccordion" data-aos="fade-up">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    Berapa lama waktu respons tim support Anda?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Tim kami berusaha merespons setiap pertanyaan dalam waktu kurang dari 24 jam.
                                    Untuk pertanyaan urgent, silakan hubungi kami via WhatsApp.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    Apakah konsultasi awal gratis?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Ya, konsultasi awal kami sepenuhnya gratis. Tim kami akan mendengarkan kebutuhan Anda
                                    dan memberikan rekomendasi terbaik tanpa kewajiban apapun.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    Channel komunikasi mana yang paling cepat?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    WhatsApp adalah channel tercepat untuk respons. Untuk pertanyaan formal, email juga siap digunakan.
                                    Hubungi kami melalui channel yang paling nyaman untuk Anda.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                    Bagaimana jika saya punya pertanyaan teknis setelah website jadi?
                                </button>
                            </h2>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Kami menyediakan support teknis lengkap sesuai dengan paket yang Anda pilih.
                                    Hubungi tim support kami untuk bantuan teknis kapan saja.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                                    Apakah saya bisa berkunjung ke kantor Anda?
                                </button>
                            </h2>
                            <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Tentu saja! Anda dapat mengunjungi kantor kami. Namun, sebaiknya hubungi kami terlebih dahulu
                                    untuk membuat janji temu agar tim kami bisa menyiapkan diri dengan baik.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

<style>
.contact-icon {
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, var(--color-secondary), var(--color-primary));
    color: white;
    border-radius: 50%;
    font-size: 1.3rem;
}

.btn-circle {
    width: 45px;
    height: 45px;
    padding: 0;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
}

.btn-facebook { background-color: #3b5998; color: white; }
.btn-facebook:hover { background-color: #2d4373; color: white; }

.btn-instagram { background-color: #E4405F; color: white; }
.btn-instagram:hover { background-color: #d63447; color: white; }

.btn-twitter { background-color: #1DA1F2; color: white; }
.btn-twitter:hover { background-color: #1a8cd8; color: white; }

.btn-linkedin { background-color: #0A66C2; color: white; }
.btn-linkedin:hover { background-color: #084399; color: white; }

.btn-youtube { background-color: #FF0000; color: white; }
.btn-youtube:hover { background-color: #cc0000; color: white; }

.map-container {
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
}
</style>

<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script>
document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();
    alert('Terima kasih telah menghubungi kami! Pesan Anda akan diproses oleh sistem backend. Tim kami akan segera menghubungi Anda.');
});
</script>

<?php
// Include footer
include __DIR__ . '/../components/layout/footer.php';
?>
