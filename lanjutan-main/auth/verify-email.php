<?php
// Set page title
$pageTitle = 'Verifikasi Email - SITUNEO DIGITAL';
$pageDescription = 'Verifikasi alamat email Anda untuk mengaktifkan akun SITUNEO DIGITAL.';

// Include header
include __DIR__ . '/../includes/header.php';

// Get token from URL
$token = isset($_GET['token']) ? sanitize($_GET['token']) : '';

$verify_error = '';
$verify_success = false;

if (!empty($token)) {
    if (!DEMO_MODE) {
        // Check if token exists
        $user = db_fetch("SELECT * FROM users WHERE email_verification_token = ? AND is_active = 1", [$token]);

        if ($user) {
            if ($user['is_email_verified']) {
                $verify_error = 'Email Anda sudah diverifikasi sebelumnya. Silakan login.';
            } else {
                // Verify email
                $updated = db_execute("UPDATE users SET is_email_verified = 1, email_verification_token = NULL, email_verified_at = NOW() WHERE user_id = ?", [$user['user_id']]);

                if ($updated) {
                    // Log activity
                    logActivity($user['user_id'], 'email_verified', 'Email verified successfully');

                    // Send welcome email
                    sendWelcomeEmail($user['email'], $user['full_name']);

                    $verify_success = true;
                } else {
                    $verify_error = 'Gagal memverifikasi email. Silakan coba lagi atau hubungi support.';
                }
            }
        } else {
            $verify_error = 'Token verifikasi tidak valid atau sudah kadaluarsa.';
        }
    } else {
        // DEMO MODE - Always success
        $verify_success = true;
    }
} else {
    $verify_error = 'Token verifikasi tidak ditemukan.';
}

?>

<!-- AUTH SECTION -->
<section class="auth-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="auth-card text-center" data-aos="fade-up">
                    <!-- Logo -->
                    <div class="mb-4">
                        <h1 class="text-gold mb-2">SITUNEO DIGITAL</h1>
                        <p class="text-light">Verifikasi Email</p>
                    </div>

                    <?php if ($verify_success): ?>
                    <!-- Success State -->
                    <div class="verification-success">
                        <div class="success-icon mb-4">
                            <i class="bi bi-check-circle-fill display-1 text-gold"></i>
                        </div>

                        <h2 class="text-gold mb-3">Email Berhasil Diverifikasi!</h2>

                        <div class="alert alert-success mb-4">
                            <i class="bi bi-check-circle-fill me-2"></i>
                            Selamat! Akun Anda sudah aktif dan siap digunakan.
                        </div>

                        <div class="card-premium text-start mb-4">
                            <h5 class="text-gold mb-3">
                                <i class="bi bi-gift me-2"></i>
                                Apa yang bisa Anda lakukan sekarang:
                            </h5>
                            <ul class="text-light">
                                <li class="mb-2">
                                    <i class="bi bi-check-circle me-2 text-gold"></i>
                                    Login ke dashboard dan kelola akun Anda
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle me-2 text-gold"></i>
                                    Request demo website GRATIS dalam 24 jam
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle me-2 text-gold"></i>
                                    Order layanan dengan diskon hingga 15%
                                </li>
                                <li class="mb-2">
                                    <i class="bi bi-check-circle me-2 text-gold"></i>
                                    Tracking order secara real-time
                                </li>
                                <li>
                                    <i class="bi bi-check-circle me-2 text-gold"></i>
                                    Akses priority support 24/7
                                </li>
                            </ul>
                        </div>

                        <div class="d-grid gap-2">
                            <a href="/auth/login" class="btn btn-gold btn-lg">
                                <i class="bi bi-box-arrow-in-right me-2"></i>
                                Login Sekarang
                            </a>
                            <a href="/client/demo-request" class="btn btn-outline-gold btn-lg">
                                <i class="bi bi-rocket-takeoff me-2"></i>
                                Request Demo Gratis
                            </a>
                        </div>
                    </div>

                    <?php else: ?>
                    <!-- Error State -->
                    <div class="verification-error">
                        <div class="error-icon mb-4">
                            <i class="bi bi-x-circle-fill display-1 text-danger"></i>
                        </div>

                        <h2 class="text-light mb-3">Verifikasi Gagal</h2>

                        <div class="alert alert-danger mb-4">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <?= $verify_error ?>
                        </div>

                        <div class="card-premium text-start mb-4">
                            <h5 class="text-gold mb-3">
                                <i class="bi bi-question-circle me-2"></i>
                                Apa yang harus dilakukan?
                            </h5>
                            <ul class="text-light small">
                                <li class="mb-2">Pastikan Anda mengklik link yang benar dari email</li>
                                <li class="mb-2">Link verifikasi mungkin sudah kadaluarsa (berlaku 24 jam)</li>
                                <li class="mb-2">Email mungkin sudah diverifikasi sebelumnya - coba login</li>
                                <li>Jika masih bermasalah, hubungi support kami</li>
                            </ul>
                        </div>

                        <div class="d-grid gap-2">
                            <a href="/auth/login" class="btn btn-gold">
                                <i class="bi bi-box-arrow-in-right me-2"></i>
                                Coba Login
                            </a>
                            <a href="/contact" class="btn btn-outline-gold">
                                <i class="bi bi-headset me-2"></i>
                                Hubungi Support
                            </a>
                        </div>
                    </div>

                    <?php endif; ?>

                    <hr style="border-color: rgba(212, 175, 55, 0.2);" class="my-4">

                    <!-- Back to Home -->
                    <a href="/" class="text-light">
                        <i class="bi bi-arrow-left me-2"></i>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../includes/footer.php'; ?>
