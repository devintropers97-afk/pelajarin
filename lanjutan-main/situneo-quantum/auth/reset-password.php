<?php
// Set page title
$pageTitle = 'Reset Password - SITUNEO DIGITAL';
$pageDescription = 'Buat password baru untuk akun SITUNEO DIGITAL Anda.';

// Include header
include __DIR__ . '/../includes/header.php';

// Get token from URL
$token = isset($_GET['token']) ? sanitize($_GET['token']) : '';

$reset_error = '';
$reset_success = false;
$token_valid = false;
$user_data = null;

// Verify token
if (!empty($token)) {
    if (!DEMO_MODE) {
        $user_data = db_fetch("SELECT * FROM users WHERE password_reset_token = ? AND password_reset_expires > NOW() AND is_active = 1", [$token]);

        if ($user_data) {
            $token_valid = true;
        } else {
            $reset_error = 'Link reset password tidak valid atau sudah kadaluarsa. Silakan request ulang.';
        }
    } else {
        // DEMO MODE - Accept any token
        $token_valid = true;
        $user_data = ['user_id' => 1, 'email' => 'demo@example.com'];
    }
} else {
    $reset_error = 'Token reset password tidak ditemukan.';
}

// Handle reset password form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reset_form']) && $token_valid) {
    // Verify CSRF token
    if (!verifyCsrfToken($_POST['csrf_token'])) {
        $reset_error = 'Invalid security token. Please try again.';
    } else {
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];

        // Validation
        if (empty($password) || empty($password_confirm)) {
            $reset_error = 'Password harus diisi.';
        } elseif (strlen($password) < 8) {
            $reset_error = 'Password minimal 8 karakter.';
        } elseif ($password !== $password_confirm) {
            $reset_error = 'Konfirmasi password tidak cocok.';
        } elseif (!isPasswordStrong($password)) {
            $reset_error = 'Password harus mengandung huruf besar, huruf kecil, angka, dan minimal 8 karakter.';
        } else {
            if (!DEMO_MODE) {
                // Update password
                $hashed_password = hashPassword($password);

                $updated = db_execute("UPDATE users SET password = ?, password_reset_token = NULL, password_reset_expires = NULL WHERE user_id = ?", [
                    $hashed_password,
                    $user_data['user_id']
                ]);

                if ($updated) {
                    // Log activity
                    logActivity($user_data['user_id'], 'password_reset', 'Password reset successfully');

                    // Send notification email
                    sendPasswordChangedEmail($user_data['email'], $user_data['full_name']);

                    setFlash('success', 'Password berhasil direset! Silakan login dengan password baru Anda.');
                    header('Location: /auth/login');
                    exit;
                } else {
                    $reset_error = 'Gagal mereset password. Silakan coba lagi.';
                }
            } else {
                // DEMO MODE - Just show success
                setFlash('success', 'Password berhasil direset! (DEMO MODE)');
                header('Location: /auth/login');
                exit;
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
                        <p class="text-light">Buat Password Baru</p>
                    </div>

                    <?php if ($reset_error): ?>
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <?= $reset_error ?>
                    </div>

                    <?php if (!$token_valid): ?>
                    <div class="text-center mt-4">
                        <a href="/auth/forgot-password" class="btn btn-gold">
                            <i class="bi bi-arrow-left me-2"></i>
                            Request Ulang Reset Password
                        </a>
                    </div>
                    <?php endif; ?>

                    <?php elseif ($token_valid): ?>

                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>
                        Masukkan password baru Anda. Pastikan password kuat dan mudah diingat.
                    </div>

                    <!-- Reset Password Form -->
                    <form method="POST" action="/auth/reset-password?token=<?= htmlspecialchars($token) ?>" id="resetForm">
                        <input type="hidden" name="reset_form" value="1">
                        <input type="hidden" name="csrf_token" value="<?= generateCsrfToken() ?>">

                        <div class="mb-3">
                            <label for="password" class="form-label">
                                <i class="bi bi-lock me-2"></i>Password Baru *
                            </label>
                            <div class="input-group">
                                <input type="password"
                                       class="form-control form-control-lg"
                                       id="password"
                                       name="password"
                                       placeholder="Min. 8 karakter"
                                       required
                                       autofocus>
                                <button class="btn btn-outline-gold" type="button" id="togglePassword">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                            <small class="text-muted">Minimal 8 karakter, gunakan kombinasi huruf, angka, dan simbol</small>

                            <!-- Password Strength Indicator -->
                            <div class="password-strength mt-2" id="passwordStrength" style="display: none;">
                                <div class="progress" style="height: 5px;">
                                    <div class="progress-bar" role="progressbar" style="width: 0%"></div>
                                </div>
                                <small class="text-muted" id="strengthText"></small>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="password_confirm" class="form-label">
                                <i class="bi bi-lock-fill me-2"></i>Konfirmasi Password Baru *
                            </label>
                            <input type="password"
                                   class="form-control form-control-lg"
                                   id="password_confirm"
                                   name="password_confirm"
                                   placeholder="Ulangi password baru"
                                   required>
                        </div>

                        <button type="submit" class="btn btn-gold btn-lg w-100 mb-3">
                            <i class="bi bi-check-circle me-2"></i>
                            Reset Password
                        </button>
                    </form>

                    <?php endif; ?>

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

<!-- Scripts -->
<script>
// Toggle password visibility
document.getElementById('togglePassword')?.addEventListener('click', function() {
    const passwordInput = document.getElementById('password');
    const icon = this.querySelector('i');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    } else {
        passwordInput.type = 'password';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    }
});

// Password strength checker
document.getElementById('password')?.addEventListener('input', function() {
    const password = this.value;
    const strengthDiv = document.getElementById('passwordStrength');
    const progressBar = strengthDiv?.querySelector('.progress-bar');
    const strengthText = document.getElementById('strengthText');

    if (!strengthDiv || !progressBar || !strengthText) return;

    if (password.length === 0) {
        strengthDiv.style.display = 'none';
        return;
    }

    strengthDiv.style.display = 'block';

    let strength = 0;
    let text = '';
    let color = '';

    // Length check
    if (password.length >= 8) strength += 25;
    if (password.length >= 12) strength += 25;

    // Lowercase
    if (/[a-z]/.test(password)) strength += 12.5;

    // Uppercase
    if (/[A-Z]/.test(password)) strength += 12.5;

    // Numbers
    if (/[0-9]/.test(password)) strength += 12.5;

    // Special characters
    if (/[^A-Za-z0-9]/.test(password)) strength += 12.5;

    if (strength < 40) {
        text = 'Lemah';
        color = 'bg-danger';
    } else if (strength < 70) {
        text = 'Sedang';
        color = 'bg-warning';
    } else {
        text = 'Kuat';
        color = 'bg-success';
    }

    progressBar.style.width = strength + '%';
    progressBar.className = 'progress-bar ' + color;
    strengthText.textContent = text;
});

// Password confirmation validation
document.getElementById('password_confirm')?.addEventListener('input', function() {
    const password = document.getElementById('password')?.value;
    const passwordConfirm = this.value;

    if (passwordConfirm === '') {
        this.setCustomValidity('');
        return;
    }

    if (password !== passwordConfirm) {
        this.setCustomValidity('Password tidak cocok');
    } else {
        this.setCustomValidity('');
    }
});
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>
