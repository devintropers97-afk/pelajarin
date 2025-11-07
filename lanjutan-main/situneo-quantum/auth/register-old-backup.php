<?php
// Set page title
$pageTitle = 'Daftar Akun Baru - SITUNEO DIGITAL';
$pageDescription = 'Daftar gratis di SITUNEO DIGITAL. Akses dashboard, request demo, order layanan, dan dapatkan special offers!';

// Include header
include __DIR__ . '/../includes/header.php';

// Redirect if already logged in
if (isLoggedIn()) {
    header('Location: /client/dashboard');
    exit;
}

// Handle registration form submission
$register_error = '';
$register_success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register_form'])) {
    // Verify CSRF token
    if (!verifyCsrfToken($_POST['csrf_token'])) {
        $register_error = 'Invalid security token. Please try again.';
    } else {
        $full_name = sanitize($_POST['full_name']);
        $email = sanitize($_POST['email']);
        $phone = sanitize($_POST['phone']);
        $password = $_POST['password'];
        $password_confirm = $_POST['password_confirm'];
        $agree_terms = isset($_POST['agree_terms']);

        // Validation
        if (empty($full_name) || empty($email) || empty($phone) || empty($password) || empty($password_confirm)) {
            $register_error = 'Semua field harus diisi.';
        } elseif (!validateEmail($email)) {
            $register_error = 'Format email tidak valid.';
        } elseif (!validatePhone($phone)) {
            $register_error = 'Format nomor telepon tidak valid. Gunakan format: 08xxxxxxxxxx';
        } elseif (strlen($password) < 8) {
            $register_error = 'Password minimal 8 karakter.';
        } elseif ($password !== $password_confirm) {
            $register_error = 'Konfirmasi password tidak cocok.';
        } elseif (!$agree_terms) {
            $register_error = 'Anda harus menyetujui syarat & ketentuan.';
        } else {
            // Check password strength
            if (!isPasswordStrong($password)) {
                $register_error = 'Password harus mengandung huruf besar, huruf kecil, angka, dan minimal 8 karakter.';
            } else {
                if (!DEMO_MODE) {
                    // Check if email already exists
                    $existing = db_fetch("SELECT user_id FROM users WHERE email = ?", [$email]);

                    if ($existing) {
                        $register_error = 'Email sudah terdaftar. Silakan login atau gunakan email lain.';
                    } else {
                        // Create user
                        $hashed_password = hashPassword($password);
                        $verification_token = bin2hex(random_bytes(32));
                        $referral_code = generateReferralCode();

                        $user_id = db_insert('users', [
                            'full_name' => $full_name,
                            'email' => $email,
                            'phone' => $phone,
                            'password' => $hashed_password,
                            'role' => 'client',
                            'email_verification_token' => $verification_token,
                            'is_email_verified' => 0,
                            'is_active' => 1,
                            'referral_code' => $referral_code,
                            'registered_ip' => $_SERVER['REMOTE_ADDR'],
                            'created_at' => date('Y-m-d H:i:s')
                        ]);

                        if ($user_id) {
                            // Send verification email
                            sendVerificationEmail($email, $full_name, $verification_token);

                            // Log activity
                            logActivity($user_id, 'register', 'New user registered');

                            // Set success message
                            setFlash('success', 'Registrasi berhasil! Silakan cek email Anda untuk verifikasi akun.');

                            // Redirect to login
                            header('Location: /auth/login');
                            exit;
                        } else {
                            $register_error = 'Gagal membuat akun. Silakan coba lagi.';
                        }
                    }
                } else {
                    // DEMO MODE - Just show success
                    setFlash('success', 'Registrasi berhasil! (DEMO MODE - Email verifikasi tidak dikirim)');
                    header('Location: /auth/login');
                    exit;
                }
            }
        }
    }
}

?>

<!-- AUTH SECTION -->
<section class="auth-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="auth-card" data-aos="fade-up">
                    <!-- Logo -->
                    <div class="text-center mb-4">
                        <h1 class="text-gold mb-2">SITUNEO DIGITAL</h1>
                        <p class="text-light">Daftar Akun Baru - GRATIS!</p>
                    </div>

                    <?php if ($register_error): ?>
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <?= $register_error ?>
                    </div>
                    <?php endif; ?>

                    <!-- Benefits -->
                    <div class="alert alert-info mb-4">
                        <h6 class="mb-2"><i class="bi bi-gift me-2"></i>Keuntungan Daftar:</h6>
                        <ul class="mb-0 small">
                            <li>FREE Demo Website 24 Jam</li>
                            <li>Akses Dashboard & Tracking Order</li>
                            <li>Diskon hingga 15% untuk repeat order</li>
                            <li>Priority support 24/7</li>
                        </ul>
                    </div>

                    <!-- Register Form -->
                    <form method="POST" action="/auth/register" id="registerForm">
                        <input type="hidden" name="register_form" value="1">
                        <input type="hidden" name="csrf_token" value="<?= generateCsrfToken() ?>">

                        <div class="mb-3">
                            <label for="full_name" class="form-label">
                                <i class="bi bi-person me-2"></i>Nama Lengkap *
                            </label>
                            <input type="text"
                                   class="form-control"
                                   id="full_name"
                                   name="full_name"
                                   placeholder="Nama lengkap Anda"
                                   required
                                   autofocus
                                   value="<?= isset($_POST['full_name']) ? htmlspecialchars($_POST['full_name']) : '' ?>">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">
                                <i class="bi bi-envelope me-2"></i>Email *
                            </label>
                            <input type="email"
                                   class="form-control"
                                   id="email"
                                   name="email"
                                   placeholder="nama@email.com"
                                   required
                                   value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '' ?>">
                            <small class="text-muted">Email akan digunakan untuk login dan verifikasi akun</small>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">
                                <i class="bi bi-phone me-2"></i>No. WhatsApp *
                            </label>
                            <input type="tel"
                                   class="form-control"
                                   id="phone"
                                   name="phone"
                                   placeholder="08123456789"
                                   required
                                   value="<?= isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '' ?>">
                            <small class="text-muted">Nomor aktif untuk komunikasi dan support</small>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">
                                <i class="bi bi-lock me-2"></i>Password *
                            </label>
                            <div class="input-group">
                                <input type="password"
                                       class="form-control"
                                       id="password"
                                       name="password"
                                       placeholder="Min. 8 karakter"
                                       required>
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
                                <i class="bi bi-lock-fill me-2"></i>Konfirmasi Password *
                            </label>
                            <input type="password"
                                   class="form-control"
                                   id="password_confirm"
                                   name="password_confirm"
                                   placeholder="Ulangi password"
                                   required>
                        </div>

                        <div class="mb-4">
                            <div class="form-check">
                                <input class="form-check-input"
                                       type="checkbox"
                                       id="agree_terms"
                                       name="agree_terms"
                                       required>
                                <label class="form-check-label text-light small" for="agree_terms">
                                    Saya setuju dengan
                                    <a href="/terms" target="_blank" class="text-gold">Syarat & Ketentuan</a>
                                    dan
                                    <a href="/privacy" target="_blank" class="text-gold">Kebijakan Privasi</a>
                                </label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-gold btn-lg w-100 mb-3">
                            <i class="bi bi-person-plus me-2"></i>
                            Daftar Sekarang
                        </button>
                    </form>

                    <hr style="border-color: rgba(212, 175, 55, 0.2);">

                    <!-- Login Link -->
                    <div class="text-center">
                        <p class="text-light mb-0">
                            Sudah punya akun?
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
document.getElementById('togglePassword').addEventListener('click', function() {
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
document.getElementById('password').addEventListener('input', function() {
    const password = this.value;
    const strengthDiv = document.getElementById('passwordStrength');
    const progressBar = strengthDiv.querySelector('.progress-bar');
    const strengthText = document.getElementById('strengthText');

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
document.getElementById('password_confirm').addEventListener('input', function() {
    const password = document.getElementById('password').value;
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
