<?php
// Set page title
$pageTitle = 'Login - SITUNEO DIGITAL';
$pageDescription = 'Login ke dashboard SITUNEO DIGITAL. Akses order, invoice, demo request, dan lainnya.';

// Include header
include __DIR__ . '/../includes/header.php';

// Redirect if already logged in
if (isLoggedIn()) {
    $user = getCurrentUser();
    if ($user['role'] === 'admin') {
        header('Location: /admin/dashboard');
    } elseif ($user['role'] === 'freelancer') {
        header('Location: /freelancer/dashboard');
    } else {
        header('Location: /client/dashboard');
    }
    exit;
}

// Handle login form submission
$login_error = '';
$login_success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login_form'])) {
    // Verify CSRF token
    if (!verifyCsrfToken($_POST['csrf_token'])) {
        $login_error = 'Invalid security token. Please try again.';
    } else {
        $email = sanitize($_POST['email']);
        $password = $_POST['password'];
        $remember = isset($_POST['remember']) ? true : false;

        // Validation
        if (empty($email) || empty($password)) {
            $login_error = 'Email dan password harus diisi.';
        } elseif (!validateEmail($email)) {
            $login_error = 'Format email tidak valid.';
        } else {
            // Check rate limit
            if (!checkRateLimit('login_' . $_SERVER['REMOTE_ADDR'], 5, 300)) {
                $login_error = 'Terlalu banyak percobaan login. Silakan coba lagi dalam 5 menit.';
            } else {
                // Verify credentials
                if (!DEMO_MODE) {
                    $user = db_fetch("SELECT * FROM users WHERE email = ? AND is_active = 1", [$email]);

                    if ($user && verifyPassword($password, $user['password'])) {
                        // Check if email is verified
                        if (!$user['is_email_verified']) {
                            $login_error = 'Email Anda belum diverifikasi. Silakan cek email untuk link verifikasi.';
                        } else {
                            // Update last login
                            db_execute("UPDATE users SET last_login = NOW(), last_login_ip = ? WHERE user_id = ?", [
                                $_SERVER['REMOTE_ADDR'],
                                $user['user_id']
                            ]);

                            // Log activity
                            logActivity($user['user_id'], 'login', 'User logged in');

                            // Set session
                            setUserSession($user, $remember);

                            // Redirect based on role
                            if ($user['role'] === 'admin') {
                                header('Location: /admin/dashboard');
                            } elseif ($user['role'] === 'freelancer') {
                                header('Location: /freelancer/dashboard');
                            } else {
                                header('Location: /client/dashboard');
                            }
                            exit;
                        }
                    } else {
                        $login_error = 'Email atau password salah.';
                    }
                } else {
                    // DEMO MODE - Accept any credentials
                    if ($email === 'admin@situneo.my.id' && $password === 'admin123') {
                        $demo_user = [
                            'user_id' => 1,
                            'email' => 'admin@situneo.my.id',
                            'full_name' => 'Admin SITUNEO',
                            'role' => 'admin',
                            'is_email_verified' => 1
                        ];
                        setUserSession($demo_user, $remember);
                        header('Location: /admin/dashboard');
                        exit;
                    } elseif ($email === 'client@example.com' && $password === 'client123') {
                        $demo_user = [
                            'user_id' => 2,
                            'email' => 'client@example.com',
                            'full_name' => 'Demo Client',
                            'role' => 'client',
                            'is_email_verified' => 1
                        ];
                        setUserSession($demo_user, $remember);
                        header('Location: /client/dashboard');
                        exit;
                    } elseif ($email === 'freelancer@example.com' && $password === 'freelancer123') {
                        $demo_user = [
                            'user_id' => 3,
                            'email' => 'freelancer@example.com',
                            'full_name' => 'Demo Freelancer',
                            'role' => 'freelancer',
                            'is_email_verified' => 1
                        ];
                        setUserSession($demo_user, $remember);
                        header('Location: /freelancer/dashboard');
                        exit;
                    } else {
                        $login_error = 'Email atau password salah.';
                    }
                }
            }
        }
    }
}

// Check for flash messages
$flash_success = getFlash('success');
$flash_error = getFlash('error');

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
                        <p class="text-light">Masuk ke Dashboard Anda</p>
                    </div>

                    <?php if ($flash_success): ?>
                    <div class="alert alert-success">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        <?= $flash_success ?>
                    </div>
                    <?php endif; ?>

                    <?php if ($flash_error || $login_error): ?>
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <?= $flash_error ?: $login_error ?>
                    </div>
                    <?php endif; ?>

                    <?php if (DEMO_MODE): ?>
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle me-2"></i>
                        <strong>Demo Mode:</strong><br>
                        <small>Admin: admin@situneo.my.id / admin123</small><br>
                        <small>Client: client@example.com / client123</small><br>
                        <small>Freelancer: freelancer@example.com / freelancer123</small>
                    </div>
                    <?php endif; ?>

                    <!-- Login Form -->
                    <form method="POST" action="/auth/login" id="loginForm">
                        <input type="hidden" name="login_form" value="1">
                        <input type="hidden" name="csrf_token" value="<?= generateCsrfToken() ?>">

                        <div class="mb-4">
                            <label for="email" class="form-label">
                                <i class="bi bi-envelope me-2"></i>Email
                            </label>
                            <input type="email"
                                   class="form-control form-control-lg"
                                   id="email"
                                   name="email"
                                   placeholder="nama@email.com"
                                   required
                                   autofocus>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label">
                                <i class="bi bi-lock me-2"></i>Password
                            </label>
                            <div class="input-group">
                                <input type="password"
                                       class="form-control form-control-lg"
                                       id="password"
                                       name="password"
                                       placeholder="••••••••"
                                       required>
                                <button class="btn btn-outline-gold"
                                        type="button"
                                        id="togglePassword">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input"
                                       type="checkbox"
                                       id="remember"
                                       name="remember">
                                <label class="form-check-label text-light" for="remember">
                                    Ingat Saya
                                </label>
                            </div>
                            <a href="/auth/forgot-password" class="text-gold small">
                                Lupa Password?
                            </a>
                        </div>

                        <button type="submit" class="btn btn-gold btn-lg w-100 mb-3">
                            <i class="bi bi-box-arrow-in-right me-2"></i>
                            Masuk
                        </button>
                    </form>

                    <!-- Social Login (Coming Soon) -->
                    <div class="text-center mb-4">
                        <p class="text-muted small mb-3">Atau masuk dengan</p>
                        <div class="d-flex gap-2 justify-content-center">
                            <button class="btn btn-outline-gold btn-sm" disabled>
                                <i class="bi bi-google"></i> Google
                            </button>
                            <button class="btn btn-outline-gold btn-sm" disabled>
                                <i class="bi bi-facebook"></i> Facebook
                            </button>
                        </div>
                        <p class="text-muted small mt-2">(Segera Hadir)</p>
                    </div>

                    <hr style="border-color: rgba(212, 175, 55, 0.2);">

                    <!-- Register Link -->
                    <div class="text-center">
                        <p class="text-light mb-0">
                            Belum punya akun?
                            <a href="/auth/register" class="text-gold fw-bold">
                                Daftar Sekarang
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

<!-- Toggle Password Visibility -->
<script>
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
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>
