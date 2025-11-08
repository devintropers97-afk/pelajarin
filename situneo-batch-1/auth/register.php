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
        'page_title' => 'Daftar Client - SITUNEO Digital',
        'register_title' => 'Daftar Sebagai Client',
        'register_subtitle' => 'Mulai perjalanan digital Anda bersama kami',
        'full_name_label' => 'Nama Lengkap',
        'full_name_placeholder' => 'Masukkan nama lengkap Anda',
        'email_label' => 'Alamat Email',
        'email_placeholder' => 'nama@email.com',
        'phone_label' => 'Nomor Telepon (Opsional)',
        'phone_placeholder' => '+62 812 3456 7890',
        'password_label' => 'Kata Sandi',
        'password_placeholder' => 'Minimal 8 karakter',
        'confirm_password_label' => 'Konfirmasi Kata Sandi',
        'confirm_password_placeholder' => 'Ketik ulang kata sandi',
        'terms_text' => 'Saya setuju dengan',
        'terms_link' => 'Syarat & Ketentuan',
        'privacy_link' => 'Kebijakan Privasi',
        'register_btn' => 'Daftar Sekarang',
        'registering' => 'Sedang Mendaftar...',
        'have_account' => 'Sudah punya akun?',
        'login_link' => 'Masuk di sini',
        'partner_text' => 'Ingin menjadi Partner?',
        'partner_link' => 'Daftar sebagai Partner',
    ],
    'en' => [
        'page_title' => 'Register Client - SITUNEO Digital',
        'register_title' => 'Register as Client',
        'register_subtitle' => 'Start your digital journey with us',
        'full_name_label' => 'Full Name',
        'full_name_placeholder' => 'Enter your full name',
        'email_label' => 'Email Address',
        'email_placeholder' => 'name@email.com',
        'phone_label' => 'Phone Number (Optional)',
        'phone_placeholder' => '+62 812 3456 7890',
        'password_label' => 'Password',
        'password_placeholder' => 'Minimum 8 characters',
        'confirm_password_label' => 'Confirm Password',
        'confirm_password_placeholder' => 'Re-type password',
        'terms_text' => 'I agree to the',
        'terms_link' => 'Terms & Conditions',
        'privacy_link' => 'Privacy Policy',
        'register_btn' => 'Register Now',
        'registering' => 'Registering...',
        'have_account' => 'Already have an account?',
        'login_link' => 'Sign in here',
        'partner_text' => 'Want to become a Partner?',
        'partner_link' => 'Register as Partner',
    ]
];

$t = $text[$lang];
$pageTitle = $t['page_title'];

// Get flash message
$flash = getFlashMessage();
?>

<?php include __DIR__ . '/../components/layout/header.php'; ?>

<style>
/* Import Auth Styles from login.php */
.auth-page { min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 100px 20px 50px; position: relative; overflow: hidden; }
.auth-container { max-width: 500px; width: 100%; position: relative; z-index: 10; }
.auth-card { background: rgba(255, 255, 255, 0.98); border-radius: 16px; padding: 40px; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2); }
.auth-header { text-align: center; margin-bottom: 35px; }
.auth-icon { width: 70px; height: 70px; background: linear-gradient(135deg, #1E5C99, #0F3057); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 32px; color: #FFD700; box-shadow: 0 8px 20px rgba(30, 92, 153, 0.3); }
.auth-header h1 { font-size: 28px; font-weight: 700; color: #0F3057; margin: 0 0 10px; }
.auth-header p { color: #666; font-size: 15px; }
.form-group { margin-bottom: 18px; }
.form-group label { display: block; font-weight: 600; color: #0F3057; margin-bottom: 8px; font-size: 14px; }
.form-control { width: 100%; padding: 14px 16px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 15px; transition: all 0.3s; background: #fff; }
.form-control:focus { outline: none; border-color: #1E5C99; box-shadow: 0 0 0 3px rgba(30, 92, 153, 0.1); }
.form-control.error { border-color: #dc3545; }
.password-wrapper { position: relative; }
.toggle-password { position: absolute; right: 15px; top: 50%; transform: translateY(-50%); background: none; border: none; color: #666; cursor: pointer; font-size: 18px; padding: 5px; }
.checkbox-wrapper { display: flex; align-items: flex-start; margin-bottom: 20px; }
.checkbox-wrapper input[type="checkbox"] { margin-right: 8px; margin-top: 3px; width: 18px; height: 18px; cursor: pointer; flex-shrink: 0; }
.checkbox-wrapper label { margin: 0; font-weight: 400; font-size: 13px; color: #666; cursor: pointer; line-height: 1.5; }
.checkbox-wrapper a { color: #1E5C99; text-decoration: none; font-weight: 600; }
.checkbox-wrapper a:hover { color: #0F3057; }
.btn-auth { width: 100%; padding: 16px; background: linear-gradient(135deg, #1E5C99, #0F3057); color: #fff; border: none; border-radius: 8px; font-size: 16px; font-weight: 700; cursor: pointer; transition: all 0.3s; box-shadow: 0 4px 15px rgba(30, 92, 153, 0.3); }
.btn-auth:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(30, 92, 153, 0.4); }
.btn-auth:disabled { opacity: 0.6; cursor: not-allowed; transform: none; }
.auth-divider { text-align: center; margin: 25px 0; position: relative; }
.auth-divider::before { content: ''; position: absolute; left: 0; top: 50%; width: 100%; height: 1px; background: #e0e0e0; }
.auth-divider span { background: #fff; padding: 0 15px; color: #999; font-size: 13px; font-weight: 600; position: relative; }
.auth-footer { text-align: center; margin-top: 20px; padding-top: 20px; border-top: 1px solid #e0e0e0; }
.auth-footer p { color: #666; margin-bottom: 10px; font-size: 14px; }
.auth-footer a { color: #1E5C99; text-decoration: none; font-weight: 600; margin: 0 5px; transition: color 0.3s; }
.auth-footer a:hover { color: #0F3057; }
.alert { padding: 14px 18px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; display: flex; align-items: center; gap: 10px; }
.alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
.alert-error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
.spinner { display: inline-block; width: 16px; height: 16px; border: 2px solid rgba(255,255,255,0.3); border-radius: 50%; border-top-color: #fff; animation: spin 0.6s linear infinite; }
@keyframes spin { to { transform: rotate(360deg); } }
.password-strength { margin-top: 8px; font-size: 12px; }
.strength-bar { height: 4px; background: #e0e0e0; border-radius: 2px; overflow: hidden; margin-bottom: 5px; }
.strength-bar-fill { height: 100%; transition: all 0.3s; width: 0; }
.strength-weak { width: 33%; background: #dc3545; }
.strength-medium { width: 66%; background: #ffc107; }
.strength-strong { width: 100%; background: #28a745; }
</style>

<div class="auth-page">
    <div class="auth-container" data-aos="fade-up">
        <div class="auth-card">
            <div class="auth-header">
                <div class="auth-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <h1><?php echo $t['register_title']; ?></h1>
                <p><?php echo $t['register_subtitle']; ?></p>
            </div>

            <?php if ($flash): ?>
                <div class="alert alert-<?php echo $flash['type']; ?>">
                    <i class="fas fa-<?php echo $flash['type'] === 'success' ? 'check-circle' : 'exclamation-circle'; ?>"></i>
                    <?php echo htmlspecialchars($flash['message']); ?>
                </div>
            <?php endif; ?>

            <form id="registerForm" method="POST" action="/auth/process/register-process.php">
                <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                <input type="hidden" name="role" value="client">

                <div class="form-group">
                    <label for="full_name"><?php echo $t['full_name_label']; ?> *</label>
                    <input type="text" id="full_name" name="full_name" class="form-control"
                           placeholder="<?php echo $t['full_name_placeholder']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="email"><?php echo $t['email_label']; ?> *</label>
                    <input type="email" id="email" name="email" class="form-control"
                           placeholder="<?php echo $t['email_placeholder']; ?>" required>
                </div>

                <div class="form-group">
                    <label for="phone"><?php echo $t['phone_label']; ?></label>
                    <input type="tel" id="phone" name="phone" class="form-control"
                           placeholder="<?php echo $t['phone_placeholder']; ?>">
                </div>

                <div class="form-group">
                    <label for="password"><?php echo $t['password_label']; ?> *</label>
                    <div class="password-wrapper">
                        <input type="password" id="password" name="password" class="form-control"
                               placeholder="<?php echo $t['password_placeholder']; ?>" required>
                        <button type="button" class="toggle-password" onclick="togglePassword('password', 'toggleIcon1')">
                            <i class="fas fa-eye" id="toggleIcon1"></i>
                        </button>
                    </div>
                    <div class="password-strength">
                        <div class="strength-bar">
                            <div class="strength-bar-fill" id="strengthBar"></div>
                        </div>
                        <span id="strengthText"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="confirm_password"><?php echo $t['confirm_password_label']; ?> *</label>
                    <div class="password-wrapper">
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control"
                               placeholder="<?php echo $t['confirm_password_placeholder']; ?>" required>
                        <button type="button" class="toggle-password" onclick="togglePassword('confirm_password', 'toggleIcon2')">
                            <i class="fas fa-eye" id="toggleIcon2"></i>
                        </button>
                    </div>
                </div>

                <div class="checkbox-wrapper">
                    <input type="checkbox" id="agree_terms" name="agree_terms" required>
                    <label for="agree_terms">
                        <?php echo $t['terms_text']; ?>
                        <a href="/pages/terms-of-service.php" target="_blank"><?php echo $t['terms_link']; ?></a>
                        <?php echo $lang === 'id' ? 'dan' : 'and'; ?>
                        <a href="/pages/privacy-policy.php" target="_blank"><?php echo $t['privacy_link']; ?></a>
                    </label>
                </div>

                <button type="submit" class="btn-auth" id="submitBtn">
                    <?php echo $t['register_btn']; ?>
                </button>
            </form>

            <div class="auth-divider">
                <span>OR</span>
            </div>

            <div class="auth-footer">
                <p><?php echo $t['have_account']; ?> <a href="/auth/login.php"><?php echo $t['login_link']; ?></a></p>
                <p><?php echo $t['partner_text']; ?> <a href="/auth/register-partner.php"><?php echo $t['partner_link']; ?></a></p>
            </div>
        </div>
    </div>
</div>

<script>
function togglePassword(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);

    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

// Password strength checker
document.getElementById('password').addEventListener('input', function() {
    const password = this.value;
    const strengthBar = document.getElementById('strengthBar');
    const strengthText = document.getElementById('strengthText');

    let strength = 0;
    if (password.length >= 8) strength++;
    if (/[A-Z]/.test(password)) strength++;
    if (/[a-z]/.test(password)) strength++;
    if (/[0-9]/.test(password)) strength++;
    if (/[^A-Za-z0-9]/.test(password)) strength++;

    strengthBar.className = 'strength-bar-fill';

    if (strength === 0) {
        strengthText.textContent = '';
    } else if (strength <= 2) {
        strengthBar.classList.add('strength-weak');
        strengthText.textContent = '<?php echo $lang === 'id' ? 'Lemah' : 'Weak'; ?>';
        strengthText.style.color = '#dc3545';
    } else if (strength <= 4) {
        strengthBar.classList.add('strength-medium');
        strengthText.textContent = '<?php echo $lang === 'id' ? 'Sedang' : 'Medium'; ?>';
        strengthText.style.color = '#ffc107';
    } else {
        strengthBar.classList.add('strength-strong');
        strengthText.textContent = '<?php echo $lang === 'id' ? 'Kuat' : 'Strong'; ?>';
        strengthText.style.color = '#28a745';
    }
});

document.getElementById('registerForm').addEventListener('submit', function(e) {
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<span class="spinner"></span> <?php echo $t['registering']; ?>';
});
</script>

<?php include __DIR__ . '/../components/layout/footer.php'; ?>

<!-- AOS & Main JS -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="<?php echo $baseURL; ?>assets/js/main.js"></script>
<script>AOS.init({duration: 800, once: true});</script>

</body>
</html>
