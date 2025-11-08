<?php
require_once __DIR__ . '/../includes/session.php';
require_once __DIR__ . '/../includes/auth.php';

// Redirect if already logged in
requireGuest();

// Language support
$lang = $_SESSION['lang'] ?? 'id';
$baseURL = '/';

$text = [
    'id' => [
        'page_title' => 'Masuk - SITUNEO Digital',
        'login_title' => 'Masuk ke Akun Anda',
        'login_subtitle' => 'Selamat datang kembali! Silakan masuk untuk melanjutkan.',
        'email_label' => 'Alamat Email',
        'email_placeholder' => 'nama@email.com',
        'password_label' => 'Kata Sandi',
        'password_placeholder' => 'Masukkan kata sandi Anda',
        'remember_me' => 'Ingat Saya',
        'forgot_password' => 'Lupa Kata Sandi?',
        'login_btn' => 'Masuk',
        'logging_in' => 'Sedang Masuk...',
        'no_account' => 'Belum punya akun?',
        'register_client' => 'Daftar sebagai Client',
        'register_partner' => 'Daftar sebagai Partner',
        'or_divider' => 'ATAU',
    ],
    'en' => [
        'page_title' => 'Login - SITUNEO Digital',
        'login_title' => 'Sign In to Your Account',
        'login_subtitle' => 'Welcome back! Please sign in to continue.',
        'email_label' => 'Email Address',
        'email_placeholder' => 'name@email.com',
        'password_label' => 'Password',
        'password_placeholder' => 'Enter your password',
        'remember_me' => 'Remember Me',
        'forgot_password' => 'Forgot Password?',
        'login_btn' => 'Sign In',
        'logging_in' => 'Signing In...',
        'no_account' => 'Don\'t have an account?',
        'register_client' => 'Register as Client',
        'register_partner' => 'Register as Partner',
        'or_divider' => 'OR',
    ]
];

$t = $text[$lang];
$pageTitle = $t['page_title'];

// Get flash message
$flash = getFlashMessage();
?>

<?php include __DIR__ . '/../components/layout/header.php'; ?>

<style>
/* Auth Page Styles */
.auth-page {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 100px 20px 50px;
    position: relative;
    overflow: hidden;
}

.auth-container {
    max-width: 450px;
    width: 100%;
    position: relative;
    z-index: 10;
}

.auth-card {
    background: rgba(255, 255, 255, 0.98);
    border-radius: 16px;
    padding: 40px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

.auth-header {
    text-align: center;
    margin-bottom: 35px;
}

.auth-icon {
    width: 70px;
    height: 70px;
    background: linear-gradient(135deg, #1E5C99, #0F3057);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    font-size: 32px;
    color: #FFD700;
    box-shadow: 0 8px 20px rgba(30, 92, 153, 0.3);
}

.auth-header h1 {
    font-size: 28px;
    font-weight: 700;
    color: #0F3057;
    margin: 0 0 10px;
}

.auth-header p {
    color: #666;
    font-size: 15px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    font-weight: 600;
    color: #0F3057;
    margin-bottom: 8px;
    font-size: 14px;
}

.form-control {
    width: 100%;
    padding: 14px 16px;
    border: 2px solid #e0e0e0;
    border-radius: 8px;
    font-size: 15px;
    transition: all 0.3s;
    background: #fff;
}

.form-control:focus {
    outline: none;
    border-color: #1E5C99;
    box-shadow: 0 0 0 3px rgba(30, 92, 153, 0.1);
}

.form-control.error {
    border-color: #dc3545;
}

.password-wrapper {
    position: relative;
}

.toggle-password {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: #666;
    cursor: pointer;
    font-size: 18px;
    padding: 5px;
}

.form-options {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
}

.checkbox-wrapper {
    display: flex;
    align-items: center;
}

.checkbox-wrapper input[type="checkbox"] {
    margin-right: 8px;
    width: 18px;
    height: 18px;
    cursor: pointer;
}

.checkbox-wrapper label {
    margin: 0;
    font-weight: 500;
    font-size: 14px;
    color: #666;
    cursor: pointer;
}

.forgot-link {
    color: #1E5C99;
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
    transition: color 0.3s;
}

.forgot-link:hover {
    color: #0F3057;
}

.btn-auth {
    width: 100%;
    padding: 16px;
    background: linear-gradient(135deg, #1E5C99, #0F3057);
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s;
    box-shadow: 0 4px 15px rgba(30, 92, 153, 0.3);
}

.btn-auth:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(30, 92, 153, 0.4);
}

.btn-auth:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none;
}

.auth-divider {
    text-align: center;
    margin: 30px 0;
    position: relative;
}

.auth-divider::before {
    content: '';
    position: absolute;
    left: 0;
    top: 50%;
    width: 100%;
    height: 1px;
    background: #e0e0e0;
}

.auth-divider span {
    background: #fff;
    padding: 0 15px;
    color: #999;
    font-size: 13px;
    font-weight: 600;
    position: relative;
}

.auth-footer {
    text-align: center;
    margin-top: 25px;
    padding-top: 25px;
    border-top: 1px solid #e0e0e0;
}

.auth-footer p {
    color: #666;
    margin-bottom: 15px;
    font-size: 14px;
}

.auth-footer a {
    color: #1E5C99;
    text-decoration: none;
    font-weight: 600;
    margin: 0 5px;
    transition: color 0.3s;
}

.auth-footer a:hover {
    color: #0F3057;
}

.alert {
    padding: 14px 18px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-size: 14px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.alert-success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.alert-error {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.alert-warning {
    background: #fff3cd;
    color: #856404;
    border: 1px solid #ffeaa7;
}

.spinner {
    display: inline-block;
    width: 16px;
    height: 16px;
    border: 2px solid rgba(255,255,255,0.3);
    border-radius: 50%;
    border-top-color: #fff;
    animation: spin 0.6s linear infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}
</style>

<div class="auth-page">
    <div class="auth-container" data-aos="fade-up">
        <div class="auth-card">
            <div class="auth-header">
                <div class="auth-icon">
                    <i class="fas fa-user-circle"></i>
                </div>
                <h1><?php echo $t['login_title']; ?></h1>
                <p><?php echo $t['login_subtitle']; ?></p>
            </div>

            <?php if ($flash): ?>
                <div class="alert alert-<?php echo $flash['type']; ?>">
                    <i class="fas fa-<?php echo $flash['type'] === 'success' ? 'check-circle' : ($flash['type'] === 'error' ? 'exclamation-circle' : 'info-circle'); ?>"></i>
                    <?php echo htmlspecialchars($flash['message']); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_GET['timeout'])): ?>
                <div class="alert alert-warning">
                    <i class="fas fa-clock"></i>
                    <?php echo $lang === 'id' ? 'Sesi Anda telah berakhir. Silakan masuk kembali.' : 'Your session has expired. Please sign in again.'; ?>
                </div>
            <?php endif; ?>

            <form id="loginForm" method="POST" action="/auth/process/login-process.php">
                <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">

                <div class="form-group">
                    <label for="email"><?php echo $t['email_label']; ?> *</label>
                    <input type="email" id="email" name="email" class="form-control"
                           placeholder="<?php echo $t['email_placeholder']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="password"><?php echo $t['password_label']; ?> *</label>
                    <div class="password-wrapper">
                        <input type="password" id="password" name="password" class="form-control"
                               placeholder="<?php echo $t['password_placeholder']; ?>" required>
                        <button type="button" class="toggle-password" onclick="togglePassword()">
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                </div>

                <div class="form-options">
                    <div class="checkbox-wrapper">
                        <input type="checkbox" id="remember_me" name="remember_me" value="1">
                        <label for="remember_me"><?php echo $t['remember_me']; ?></label>
                    </div>
                    <a href="/auth/forgot-password.php" class="forgot-link"><?php echo $t['forgot_password']; ?></a>
                </div>

                <button type="submit" class="btn-auth" id="submitBtn">
                    <?php echo $t['login_btn']; ?>
                </button>
            </form>

            <div class="auth-divider">
                <span><?php echo $t['or_divider']; ?></span>
            </div>

            <div class="auth-footer">
                <p><?php echo $t['no_account']; ?></p>
                <a href="/auth/register.php"><?php echo $t['register_client']; ?></a>
                <span style="color: #ccc;">|</span>
                <a href="/auth/register-partner.php"><?php echo $t['register_partner']; ?></a>
            </div>
        </div>
    </div>
</div>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}

document.getElementById('loginForm').addEventListener('submit', function(e) {
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<span class="spinner"></span> <?php echo $t['logging_in']; ?>';
});
</script>

<?php include __DIR__ . '/../components/layout/footer.php'; ?>

<!-- AOS & Main JS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="<?php echo $baseURL; ?>assets/js/main.js"></script>
<script>AOS.init({duration: 800, once: true});</script>

</body>
</html>
