<?php
// Set page title
$pageTitle = 'Hubungi Kami | SITUNEO DIGITAL - Konsultasi GRATIS 24/7';
$pageDescription = 'Hubungi SITUNEO DIGITAL untuk konsultasi GRATIS. WhatsApp, Email, Telepon 24/7. Kantor pusat di Jakarta. Response cepat dalam 5 menit!';

// Include header
include __DIR__ . '/../includes/header.php';

// Multi-language text
$text = [
    'id' => [
        'hero_title' => 'Hubungi Kami',
        'hero_subtitle' => 'Konsultasi GRATIS 24/7 - Response dalam 5 Menit!',
        'section_form' => 'Kirim Pesan',
        'section_info' => 'Informasi Kontak',
        'section_channels' => 'Saluran Komunikasi',
        'section_faq' => 'FAQ (Frequently Asked Questions)',
        'section_office' => 'Kantor Kami',
        'form_name' => 'Nama Lengkap',
        'form_email' => 'Email',
        'form_phone' => 'No. WhatsApp',
        'form_subject' => 'Subjek',
        'form_message' => 'Pesan Anda',
        'btn_send' => 'Kirim Pesan',
        'office_hours' => 'Jam Operasional',
        'mon_fri' => 'Senin - Jumat',
        'saturday' => 'Sabtu',
        'sunday' => 'Minggu',
    ],
    'en' => [
        'hero_title' => 'Contact Us',
        'hero_subtitle' => 'FREE Consultation 24/7 - Response in 5 Minutes!',
        'section_form' => 'Send Message',
        'section_info' => 'Contact Information',
        'section_channels' => 'Communication Channels',
        'section_faq' => 'FAQ (Frequently Asked Questions)',
        'section_office' => 'Our Office',
        'form_name' => 'Full Name',
        'form_email' => 'Email',
        'form_phone' => 'WhatsApp Number',
        'form_subject' => 'Subject',
        'form_message' => 'Your Message',
        'btn_send' => 'Send Message',
        'office_hours' => 'Office Hours',
        'mon_fri' => 'Monday - Friday',
        'saturday' => 'Saturday',
        'sunday' => 'Sunday',
    ]
];

$t = $text[$lang];

// Handle form submission
$form_success = false;
$form_error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_form'])) {
    // Verify CSRF token
    if (!verifyCsrfToken($_POST['csrf_token'])) {
        $form_error = 'Invalid security token. Please try again.';
    } else {
        $name = sanitize($_POST['name']);
        $email = sanitize($_POST['email']);
        $phone = sanitize($_POST['phone']);
        $subject = sanitize($_POST['subject']);
        $message = sanitize($_POST['message']);

        // Validation
        if (empty($name) || empty($email) || empty($phone) || empty($subject) || empty($message)) {
            $form_error = 'Semua field harus diisi.';
        } elseif (!validateEmail($email)) {
            $form_error = 'Email tidak valid.';
        } elseif (!validatePhone($phone)) {
            $form_error = 'Nomor telepon tidak valid.';
        } else {
            // Save to database
            if (!DEMO_MODE) {
                $insert = db_insert('contact_messages', [
                    'name' => $name,
                    'email' => $email,
                    'phone' => $phone,
                    'subject' => $subject,
                    'message' => $message,
                    'ip_address' => $_SERVER['REMOTE_ADDR'],
                    'user_agent' => $_SERVER['HTTP_USER_AGENT'],
                    'created_at' => date('Y-m-d H:i:s')
                ]);

                if ($insert) {
                    // Send email notification to admin
                    sendContactNotification($name, $email, $phone, $subject, $message);
                    $form_success = true;
                } else {
                    $form_error = 'Gagal mengirim pesan. Silakan coba lagi.';
                }
            } else {
                // Demo mode - just show success
                $form_success = true;
            }
        }
    }
}

?>

<!-- HERO SECTION -->
<section class="hero-section contact-hero" id="contact-hero">
    <div class="container">
        <div class="hero-content text-center" data-aos="fade-up">
            <h1 class="hero-title">
                <?= $t['hero_title'] ?>
            </h1>

            <h2 class="hero-subtitle"><?= $t['hero_subtitle'] ?></h2>

            <div class="hero-badge">
                <i class="bi bi-headset me-2"></i>
                Tim Support Siap Membantu Kapan Saja
            </div>
        </div>
    </div>
</section>

<!-- CONTACT INFO CARDS -->
<section class="contact-info-section">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card-premium text-center h-100">
                    <div class="contact-card-icon">
                        <i class="bi bi-whatsapp"></i>
                    </div>
                    <h4 class="text-gold mb-3">WhatsApp</h4>
                    <p class="text-light mb-3">Chat langsung dengan tim kami</p>
                    <a href="https://wa.me/6283173868915" target="_blank" class="btn btn-sm btn-gold">
                        <i class="bi bi-whatsapp me-2"></i>
                        Chat Now
                    </a>
                    <p class="text-muted small mt-2">+62 831-7386-8915</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card-premium text-center h-100">
                    <div class="contact-card-icon">
                        <i class="bi bi-envelope"></i>
                    </div>
                    <h4 class="text-gold mb-3">Email</h4>
                    <p class="text-light mb-3">Kirim email ke kami</p>
                    <a href="mailto:<?= COMPANY_EMAIL ?>" class="btn btn-sm btn-gold">
                        <i class="bi bi-envelope me-2"></i>
                        Send Email
                    </a>
                    <p class="text-muted small mt-2"><?= COMPANY_EMAIL ?></p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="card-premium text-center h-100">
                    <div class="contact-card-icon">
                        <i class="bi bi-telephone"></i>
                    </div>
                    <h4 class="text-gold mb-3">Telepon</h4>
                    <p class="text-light mb-3">Hubungi via telepon</p>
                    <a href="tel:+6283173868915" class="btn btn-sm btn-gold">
                        <i class="bi bi-telephone me-2"></i>
                        Call Now
                    </a>
                    <p class="text-muted small mt-2">+62 831-7386-8915</p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="card-premium text-center h-100">
                    <div class="contact-card-icon">
                        <i class="bi bi-geo-alt"></i>
                    </div>
                    <h4 class="text-gold mb-3">Alamat</h4>
                    <p class="text-light mb-3">Kunjungi kantor kami</p>
                    <a href="#map" class="btn btn-sm btn-gold">
                        <i class="bi bi-map me-2"></i>
                        View Map
                    </a>
                    <p class="text-muted small mt-2">Jakarta, Indonesia</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FORM & INFO SECTION -->
<section class="contact-section">
    <div class="container">
        <div class="contact-grid">
            <!-- Contact Form -->
            <div data-aos="fade-right">
                <h2 class="section-title text-start"><?= $t['section_form'] ?></h2>

                <?php if ($form_success): ?>
                <div class="alert alert-success">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    Pesan Anda berhasil dikirim! Tim kami akan segera menghubungi Anda.
                </div>
                <?php endif; ?>

                <?php if ($form_error): ?>
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <?= $form_error ?>
                </div>
                <?php endif; ?>

                <form method="POST" action="/contact" class="contact-form" id="contactForm">
                    <input type="hidden" name="contact_form" value="1">
                    <input type="hidden" name="csrf_token" value="<?= generateCsrfToken() ?>">

                    <div class="mb-4">
                        <label for="name" class="form-label"><?= $t['form_name'] ?> *</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="form-label"><?= $t['form_email'] ?> *</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="mb-4">
                        <label for="phone" class="form-label"><?= $t['form_phone'] ?> *</label>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="08123456789" required>
                    </div>

                    <div class="mb-4">
                        <label for="subject" class="form-label"><?= $t['form_subject'] ?> *</label>
                        <select class="form-control" id="subject" name="subject" required>
                            <option value="">Pilih Subjek...</option>
                            <option value="Konsultasi Website">Konsultasi Website</option>
                            <option value="Request Demo">Request Demo</option>
                            <option value="Pertanyaan Harga">Pertanyaan Harga</option>
                            <option value="Komplain / Support">Komplain / Support</option>
                            <option value="Kerjasama">Kerjasama / Partnership</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="message" class="form-label"><?= $t['form_message'] ?> *</label>
                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-gold btn-lg w-100">
                        <i class="bi bi-send me-2"></i>
                        <?= $t['btn_send'] ?>
                    </button>
                </form>
            </div>

            <!-- Contact Info -->
            <div data-aos="fade-left">
                <h2 class="section-title text-start"><?= $t['section_info'] ?></h2>

                <div class="contact-info-card">
                    <h4 class="text-gold mb-3">
                        <i class="bi bi-building me-2"></i>
                        SITUNEO DIGITAL
                    </h4>
                    <p class="text-light">
                        Digital agency terpercaya sejak 2020 dengan NIB resmi dan NPWP terdaftar.
                        Melayani 500+ client di seluruh Indonesia.
                    </p>

                    <div class="mt-4">
                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <i class="bi bi-patch-check-fill"></i>
                            </div>
                            <div>
                                <strong class="text-gold">NIB Resmi</strong>
                                <p class="text-light mb-0"><?= COMPANY_NIB ?></p>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <i class="bi bi-file-text"></i>
                            </div>
                            <div>
                                <strong class="text-gold">NPWP</strong>
                                <p class="text-light mb-0"><?= COMPANY_NPWP ?></p>
                            </div>
                        </div>

                        <div class="contact-info-item">
                            <div class="contact-info-icon">
                                <i class="bi bi-geo-alt-fill"></i>
                            </div>
                            <div>
                                <strong class="text-gold">Alamat</strong>
                                <p class="text-light mb-0">Jakarta, Indonesia</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Office Hours -->
                <div class="contact-info-card mt-4">
                    <h4 class="text-gold mb-3">
                        <i class="bi bi-clock me-2"></i>
                        <?= $t['office_hours'] ?>
                    </h4>

                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-light"><?= $t['mon_fri'] ?>:</span>
                        <span class="text-gold">09:00 - 21:00 WIB</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-light"><?= $t['saturday'] ?>:</span>
                        <span class="text-gold">09:00 - 18:00 WIB</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-light"><?= $t['sunday'] ?>:</span>
                        <span class="text-gold">10:00 - 16:00 WIB</span>
                    </div>

                    <div class="alert alert-info mt-3">
                        <i class="bi bi-info-circle me-2"></i>
                        <strong>WhatsApp Support 24/7</strong> - Response cepat!
                    </div>
                </div>

                <!-- Social Media -->
                <div class="contact-info-card mt-4">
                    <h4 class="text-gold mb-3">
                        <i class="bi bi-share me-2"></i>
                        Ikuti Kami
                    </h4>

                    <div class="d-flex gap-2 flex-wrap">
                        <a href="#" class="btn btn-outline-gold" target="_blank">
                            <i class="bi bi-facebook"></i> Facebook
                        </a>
                        <a href="#" class="btn btn-outline-gold" target="_blank">
                            <i class="bi bi-instagram"></i> Instagram
                        </a>
                        <a href="#" class="btn btn-outline-gold" target="_blank">
                            <i class="bi bi-twitter"></i> Twitter
                        </a>
                        <a href="#" class="btn btn-outline-gold" target="_blank">
                            <i class="bi bi-linkedin"></i> LinkedIn
                        </a>
                        <a href="#" class="btn btn-outline-gold" target="_blank">
                            <i class="bi bi-youtube"></i> YouTube
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ SECTION -->
<section class="faq-section" id="faq">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up"><?= $t['section_faq'] ?></h2>

        <div class="faq-accordion mt-5">
            <?php
            $faqs = [
                [
                    'q' => 'Bagaimana cara order di SITUNEO DIGITAL?',
                    'a' => 'Mudah! Anda bisa langsung hubungi kami via WhatsApp, isi form demo request, atau gunakan calculator untuk hitung harga. Tim kami akan response dalam 5 menit dan bantu Anda dari awal sampai selesai.'
                ],
                [
                    'q' => 'Apakah ada garansi uang kembali?',
                    'a' => 'Ya! Kami berikan garansi 100% uang kembali jika Anda tidak puas dengan hasil demo pertama (dalam 24 jam setelah demo). Kepuasan Anda adalah prioritas kami.'
                ],
                [
                    'q' => 'Berapa lama proses pembuatan website?',
                    'a' => 'Tergantung paket yang dipilih. Untuk paket STARTER: 3-5 hari kerja, BUSINESS: 7-10 hari, PREMIUM: 14-21 hari, ENTERPRISE: 30-45 hari. Kami berikan FREE DEMO dalam 24 jam untuk semua paket!'
                ],
                [
                    'q' => 'Apakah harga sudah termasuk domain dan hosting?',
                    'a' => 'Ya! Semua paket sudah include domain .com atau .id GRATIS dan hosting sesuai durasi paket. Anda tidak perlu bayar tambahan untuk domain dan hosting.'
                ],
                [
                    'q' => 'Bagaimana cara pembayaran?',
                    'a' => 'Kami terima transfer bank (BCA, Mandiri, BRI, BNI), e-wallet (GoPay, OVO, Dana), dan QRIS. Untuk project besar bisa cicilan 2-3x. Payment gateway otomatis akan segera tersedia.'
                ],
                [
                    'q' => 'Apakah bisa revisi setelah website jadi?',
                    'a' => 'Tentu! Setiap paket include revisi (STARTER: 2x, BUSINESS: 5x, PREMIUM: 10x, ENTERPRISE: unlimited). Revisi bisa dilakukan sampai Anda 100% puas.'
                ],
                [
                    'q' => 'Apakah website SEO friendly?',
                    'a' => 'Pasti! Semua website kami built-in SEO dari awal. Structure code, meta tags, sitemap, schema markup, page speed optimization - semua sudah kami handle. Plus artikel SEO di setiap paket.'
                ],
                [
                    'q' => 'Bagaimana dengan maintenance website setelah selesai?',
                    'a' => 'Paket STARTER: support 1 bulan, BUSINESS: 3 bulan, PREMIUM: 6 bulan, ENTERPRISE: 1 tahun. Setelah itu bisa perpanjang dengan harga terjangkau mulai Rp 300rb/bulan.'
                ],
            ];

            foreach ($faqs as $index => $faq):
            ?>
            <div class="faq-item" data-aos="fade-up" data-aos-delay="<?= $index * 50 ?>">
                <div class="faq-question">
                    <?= $faq['q'] ?>
                    <i class="bi bi-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <?= $faq['a'] ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- MAP SECTION -->
<section class="map-section" id="map">
    <div class="container">
        <h2 class="section-title" data-aos="fade-up"><?= $t['section_office'] ?></h2>

        <div class="map-container" data-aos="fade-up">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d253840.65741788604!2d106.68942995!3d-6.229386599999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3e945e34b9d%3A0x5371bf0fdad786a2!2sJakarta!5e0!3m2!1sen!2sid!4v1234567890123!5m2!1sen!2sid"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
