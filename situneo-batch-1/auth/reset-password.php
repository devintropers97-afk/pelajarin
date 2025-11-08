<?php
require_once __DIR__ . '/../includes/session.php';
require_once __DIR__ . '/../includes/functions/user.php';
require_once __DIR__ . '/../includes/functions/validation.php';

// Language support
$lang = $_SESSION['lang'] ?? 'id';
$baseURL = '/';

$text = [
    'id' => [
        'page_title' => 'Reset Kata Sandi - SITUNEO Digital',
        'title' => 'Reset Kata Sandi',
        'subtitle' => 'Masukkan kata sandi baru untuk akun Anda',
        'password_label' => 'Kata Sandi Baru',
        'password_placeholder' => 'Minimal 8 karakter',
        'confirm_password_label' => 'Konfirmasi Kata Sandi',
        'confirm_password_placeholder' => 'Ketik ulang kata sandi',
        'reset_btn' => 'Reset Kata Sandi',
        'resetting' => 'Mereset...',
        'invalid_token' => 'Link reset tidak valid atau sudah kedaluwarsa',
        'request_new' => 'Kirim link baru',
    ],
    'en' => [
        'page_title' => 'Reset Password - SITUNEO Digital',
        'title' => 'Reset Password',
        'subtitle' => 'Enter your new password for your account',
        'password_label' => 'New Password',
        'password_placeholder' => 'Minimum 8 characters',
        'confirm_password_label' => 'Confirm Password',
        'confirm_password_placeholder' => 'Re-type password',
        'reset_btn' => 'Reset Password',
        'resetting' => 'Resetting...',
        'invalid_token' => 'Invalid or expired reset link',
        'request_new' => 'Request new link',
    ]
];

$t = $text[$lang];
$pageTitle = $t['page_title'];

// Get and validate token
$token = $_GET['token'] ?? '';
$validToken = false;

if (!empty($token) && validateToken($token)) {
    $result = verifyPasswordResetToken($token);
    if ($result) {
        $validToken = true;
    }
}

// Get flash message
$flash = getFlashMessage();
?>

<?php include __DIR__ . '/../components/layout/header.php'; ?>

<style>
.auth-page { min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 100px 20px 50px; }
.auth-container { max-width: 450px; width: 100%; position: relative; z-index: 10; }
.auth-card { background: rgba(255, 255, 255, 0.98); border-radius: 16px; padding: 40px; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3); }
.auth-header { text-align: center; margin-bottom: 35px; }
.auth-icon { width: 70px; height: 70px; background: linear-gradient(135deg, #1E5C99, #0F3057); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px; font-size: 32px; color: #FFD700; box-shadow: 0 8px 20px rgba(30, 92, 153, 0.3); }
.auth-header h1 { font-size: 28px; font-weight: 700; color: #0F3057; margin: 0 0 10px; }
.auth-header p { color: #666; font-size: 15px; }
.form-group { margin-bottom: 20px; }
.form-group label { display: block; font-weight: 600; color: #0F3057; margin-bottom: 8px; font-size: 14px; }
.form-control { width: 100%; padding: 14px 16px; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 15px; transition: all 0.3s; }
.form-control:focus { outline: none; border-color: #1E5C99; box-shadow: 0 0 0 3px rgba(30, 92, 153, 0.1); }
.password-wrapper { position: relative; }
.toggle-password { position: absolute; right: 15px; top: 50%; transform: translateY(-50%); background: none; border: none; color: #666; cursor: pointer; font-size: 18px; }
.btn-auth { width: 100%; padding: 16px; background: linear-gradient(135deg, #1E5C99, #0F3057); color: #fff; border: none; border-radius: 8px; font-size: 16px; font-weight: 700; cursor: pointer; transition: all 0.3s; }
.btn-auth:hover { transform: translateY(-2px); }
.btn-auth:disabled { opacity: 0.6; cursor: not-allowed; }
.alert { padding: 14px 18px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; }
.alert-error { background: #f8d7da; color: #721c24; text-align: center; }
.alert a { color: #1E5C99; font-weight: 600; text-decoration: underline; }
.spinner { display: inline-block; width: 16px; height: 16px; border: 2px solid rgba(255,255,255,0.3); border-radius: 50%; border-top-color: #fff; animation: spin 0.6s linear infinite; }
@keyframes spin { to { transform: rotate(360deg); } }
</style>

<div class="auth-page">
    <div class="auth-container" data-aos="fade-up">
        <div class="auth-card">
            <div class="auth-header">
                <div class="auth-icon">
                    <i class="fas fa-lock"></i>
                </div>
                <h1><?php echo $t['title']; ?></h1>
                <p><?php echo $t['subtitle']; ?></p>
            </div>

            <?php if (!$validToken): ?>
                <div class="alert alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <?php echo $t['invalid_token']; ?>
                    <br><br>
                    <a href="/auth/forgot-password.php"><?php echo $t['request_new']; ?></a>
                </div>
            <?php else: ?>

                <?php if ($flash): ?>
                    <div class="alert alert-<?php echo $flash['type']; ?>">
                        <?php echo htmlspecialchars($flash['message']); ?>
                    </div>
                <?php endif; ?>

                <form id="resetPasswordForm" method="POST" action="/auth/process/reset-password-process.php">
                    <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">
                    <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">

                    <div class="form-group">
                        <label for="password"><?php echo $t['password_label']; ?> *</label>
                        <div class="password-wrapper">
                            <input type="password" id="password" name="password" class="form-control"
                                   placeholder="<?php echo $t['password_placeholder']; ?>" required>
                            <button type="button" class="toggle-password" onclick="togglePassword('password', 'toggleIcon1')">
                                <i class="fas fa-eye" id="toggleIcon1"></i>
                            </button>
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

                    <button type="submit" class="btn-auth" id="submitBtn">
                        <?php echo $t['reset_btn']; ?>
                    </button>
                </form>

            <?php endif; ?>
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

document.getElementById('resetPasswordForm')?.addEventListener('submit', function(e) {
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<span class="spinner"></span> <?php echo $t['resetting']; ?>';
});
</script>

<?php include __DIR__ . '/../components/layout/footer.php'; ?>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="<?php echo $baseURL; ?>assets/js/main.js"></script>
<script>AOS.init({duration: 800, once: true});</script>

</body>
</html>
