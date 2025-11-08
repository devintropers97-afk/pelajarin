<?php
/**
 * Contact Page
 *
 * Hubungi kami via WhatsApp, Email, atau Form
 */

defined('SITUNEO_ACCESS') or die('Direct access not permitted');

$page_title = 'Hubungi Kami - SITUNEO DIGITAL';
$page_description = 'Hubungi SITUNEO DIGITAL untuk konsultasi GRATIS. Respons cepat dalam 1 jam!';

include INCLUDES_PATH . 'header/public-header.php';
?>

<!-- Hero -->
<section class="contact-hero">
    <div class="container text-center">
        <h1 class="hero-title" data-aos="fade-up">
            <i class="bi bi-headset"></i><br>
            <span class="text-gradient">Hubungi Kami</span>
        </h1>
        <p class="hero-subtitle" data-aos="fade-up" data-aos-delay="100">
            Punya pertanyaan? Butuh konsultasi? Tim kami siap membantu!<br>
            <strong>Konsultasi 100% GRATIS</strong> - Respons cepat dalam 1 jam
        </p>
    </div>
</section>

<!-- Contact Methods -->
<section class="contact-methods">
    <div class="container">
        <div class="row g-4">
            <!-- WhatsApp -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up">
                <a href="<?= whatsapp_link(COMPANY_WHATSAPP, 'Halo SITUNEO') ?>" target="_blank" class="contact-card whatsapp">
                    <i class="bi bi-whatsapp"></i>
                    <h3>WhatsApp</h3>
                    <p><?= format_phone(COMPANY_WHATSAPP) ?></p>
                    <span class="badge">Online 24/7</span>
                </a>
            </div>

            <!-- Email -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <a href="mailto:<?= COMPANY_EMAIL ?>" class="contact-card email">
                    <i class="bi bi-envelope"></i>
                    <h3>Email</h3>
                    <p><?= COMPANY_EMAIL ?></p>
                    <span class="badge">Respons &lt; 1 jam</span>
                </a>
            </div>

            <!-- Phone -->
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <a href="tel:<?= COMPANY_WHATSAPP ?>" class="contact-card phone">
                    <i class="bi bi-telephone"></i>
                    <h3>Telepon</h3>
                    <p><?= format_phone(COMPANY_WHATSAPP) ?></p>
                    <span class="badge">09:00-21:00</span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form -->
<section class="contact-form-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="form-card" data-aos="fade-up">
                    <h2><i class="bi bi-envelope"></i> Kirim Pesan</h2>
                    <form method="post" action="<?= url('api/contact') ?>">
                        <?= csrf_field() ?>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control" placeholder="Nama" required>
                            </div>
                            <div class="col-md-6">
                                <input type="email" name="email" class="form-control" placeholder="Email" required>
                            </div>
                            <div class="col-md-6">
                                <input type="tel" name="phone" class="form-control" placeholder="WhatsApp" required>
                            </div>
                            <div class="col-md-6">
                                <select name="subject" class="form-select">
                                    <option>Konsultasi</option>
                                    <option>Tanya Harga</option>
                                    <option>Demo</option>
                                    <option>Support</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <textarea name="message" class="form-control" rows="6" placeholder="Pesan Anda" required></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-lg w-100">
                                    <i class="bi bi-send"></i> Kirim Pesan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include INCLUDES_PATH . 'footer/public-footer.php'; ?>

<style>
.contact-hero {
    background: linear-gradient(135deg, var(--dark) 0%, var(--dark-light) 100%);
    color: var(--white);
    padding: 100px 0 60px;
}

.contact-methods {
    padding: 4rem 0;
    background: var(--gray-50);
}

.contact-card {
    display: block;
    background: var(--white);
    border-radius: var(--radius-xl);
    padding: 3rem 2rem;
    text-align: center;
    box-shadow: var(--shadow);
    transition: var(--transition);
    text-decoration: none;
    color: var(--dark);
    position: relative;
}

.contact-card:hover {
    transform: translateY(-10px);
    box-shadow: var(--shadow-xl);
}

.contact-card i {
    font-size: 4rem;
    margin-bottom: 1rem;
}

.contact-card.whatsapp:hover {
    background: #25d366;
    color: var(--white);
}

.contact-card.email:hover {
    background: var(--primary-color);
    color: var(--white);
}

.contact-card.phone:hover {
    background: var(--warning-color);
    color: var(--white);
}

.contact-card .badge {
    position: absolute;
    top: 1rem;
    right: 1rem;
    padding: 0.5rem 1rem;
    background: var(--success-color);
    color: var(--white);
    border-radius: var(--radius);
    font-size: 0.75rem;
}

.contact-form-section {
    padding: 4rem 0;
}

.form-card {
    background: var(--white);
    padding: 3rem;
    border-radius: var(--radius-xl);
    box-shadow: var(--shadow-lg);
}
</style>
