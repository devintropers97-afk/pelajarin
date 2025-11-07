<?php
// Set page title
$pageTitle = 'Lupa Password - SITUNEO DIGITAL';
$pageDescription = 'Reset password akun SITUNEO DIGITAL Anda. Link reset akan dikirim ke email.';

// Include header
include __DIR__ . '/../includes/header.php';

// Handle forgot password form submission
$forgot_error = '';
$forgot_success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['forgot_form'])) {
    // Verify CSRF token
    if (!verifyCsrfToken($_POST['csrf_token'])) {
        $forgot_error = 'Invalid security token. Please try again.';
    } else {
        $email = sanitize($_POST['email']);

        // Validation
        if (empty($email)) {
            $forgot_error = 'Email harus diisi.';
        } elseif (!validateEmail($email)) {
            $forgot_error = 'Format email tidak valid.';
        } else {
            if (!DEMO_MODE) {
                // Check if email exists
                $user = db_fetch("SELECT * FROM users WHERE email = ? AND is_active = 1", [$email]);

                if ($user) {
                    // Generate reset token
                    $reset_token = bin2hex(random_bytes(32));
                    $reset_expires = date('Y-m-d H:i:s', strtotime('+1 hour'));

                    // Update user with reset token
                    db_execute("UPDATE users SET password_reset_token = ?, password_reset_expires = ? WHERE user_id = ?", [
                        $reset_token,
                        $reset_expires,
                        $user['user_id']
                    ]);

                    // Send reset email
                    sendPasswordResetEmail($email, $user['full_name'], $reset_token);

                    // Log activity
                    logActivity($user['user_id'], 'password_reset_request', 'Password reset requested');

                    $forgot_success = true;
                } else {
                    // For security, always show success even if email doesn't exist
                    $forgot_success = true;
                }
            } else {
                // DEMO MODE - Just show success
                $forgot_success = true;
            }
        }
    }
}

?>

<!-- AUTH SECTION -->
<section class="auth-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="auth-card" data-aos="fade-up">
                    <!-- Logo -->
                    <div class="text-center mb-4">
                        <h1 class="text-gold mb-2">SITUNEO DIGITAL</h1>
                        <p class="text-light">Reset Password Anda</p>
                    </div>

                    <?php if ($forgot_error): ?>
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <?= $forgot_error ?>
                    </div>
                    <?php endif; ?>

                    <?php if ($forgot_success): ?>
                    <div class="alert alert-success">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        <strong>Link Reset Password Telah Dikirim!</strong><br>
                        Silakan cek email Anda untuk link reset password. Link berlaku selama 1 jam.
                    </div>

                    <div class="text-center mt-4">
                        <a href="/auth/login" class="btn btn-gold">
                            <i class="bi bi-arrow-left me-2"></i>
                            Kembali ke Login
                        </a>
                    </div>
                    <?php else: ?>

                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>
                        Masukkan email Anda, kami akan mengirimkan link untuk reset password.
                    </div>

                    <!-- Forgot Password Form -->
                    <form method="POST" action="/auth/forgot-password" id="forgotForm">
                        <input type="hidden" name="forgot_form" value="1">
                        <input type="hidden" name="csrf_token" value="<?= generateCsrfToken() ?>">

                        <div class="mb-4">
                            <label for="email" class="form-label">
                                <i class="bi bi-envelope me-2"></i>Email Terdaftar
                            </label>
                            <input type="email"
                                   class="form-control form-control-lg"
                                   id="email"
                                   name="email"
                                   placeholder="nama@email.com"
                                   required
                                   autofocus>
                        </div>

                        <button type="submit" class="btn btn-gold btn-lg w-100 mb-3">
                            <i class="bi bi-send me-2"></i>
                            Kirim Link Reset Password
                        </button>
                    </form>

                    <hr style="border-color: rgba(212, 175, 55, 0.2);">

                    <!-- Back to Login -->
                    <div class="text-center">
                        <p class="text-light mb-0">
                            Ingat password Anda?
                            <a href="/auth/login" class="text-gold fw-bold">
                                Login di sini
                            </a>
                        </p>
                    </div>

                    <?php endif; ?>
                </div>

                <!-- Back to Home -->
                <div class="text-center mt-4">
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
