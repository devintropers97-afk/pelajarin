<?php
require_once __DIR__ . '/../includes/session.php';

// Language support
$lang = $_SESSION['lang'] ?? 'id';
$baseURL = '/';

$text = [
    'id' => [
        'page_title' => 'Lupa Kata Sandi - SITUNEO Digital',
        'title' => 'Lupa Kata Sandi?',
        'subtitle' => 'Masukkan email Anda dan kami akan mengirimkan link untuk reset kata sandi',
        'email_label' => 'Alamat Email',
        'email_placeholder' => 'nama@email.com',
        'send_btn' => 'Kirim Link Reset',
        'sending' => 'Mengirim...',
        'back_login' => 'Kembali ke Halaman Login',
    ],
    'en' => [
        'page_title' => 'Forgot Password - SITUNEO Digital',
        'title' => 'Forgot Password?',
        'subtitle' => 'Enter your email and we will send you a password reset link',
        'email_label' => 'Email Address',
        'email_placeholder' => 'name@email.com',
        'send_btn' => 'Send Reset Link',
        'sending' => 'Sending...',
        'back_login' => 'Back to Login',
    ]
];

$t = $text[$lang];
$pageTitle = $t['page_title'];

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
.btn-auth { width: 100%; padding: 16px; background: linear-gradient(135deg, #1E5C99, #0F3057); color: #fff; border: none; border-radius: 8px; font-size: 16px; font-weight: 700; cursor: pointer; transition: all 0.3s; }
.btn-auth:hover { transform: translateY(-2px); }
.btn-auth:disabled { opacity: 0.6; cursor: not-allowed; }
.auth-footer { text-align: center; margin-top: 20px; }
.auth-footer a { color: #1E5C99; text-decoration: none; font-weight: 600; }
.alert { padding: 14px 18px; border-radius: 8px; margin-bottom: 20px; font-size: 14px; }
.alert-success { background: #d4edda; color: #155724; }
.alert-error { background: #f8d7da; color: #721c24; }
.spinner { display: inline-block; width: 16px; height: 16px; border: 2px solid rgba(255,255,255,0.3); border-radius: 50%; border-top-color: #fff; animation: spin 0.6s linear infinite; }
@keyframes spin { to { transform: rotate(360deg); } }
</style>

<div class="auth-page">
    <div class="auth-container" data-aos="fade-up">
        <div class="auth-card">
            <div class="auth-header">
                <div class="auth-icon">
                    <i class="fas fa-key"></i>
                </div>
                <h1><?php echo $t['title']; ?></h1>
                <p><?php echo $t['subtitle']; ?></p>
            </div>

            <?php if ($flash): ?>
                <div class="alert alert-<?php echo $flash['type']; ?>">
                    <?php echo htmlspecialchars($flash['message']); ?>
                </div>
            <?php endif; ?>

            <form id="forgotPasswordForm" method="POST" action="/auth/process/forgot-password-process.php">
                <input type="hidden" name="csrf_token" value="<?php echo generateCSRFToken(); ?>">

                <div class="form-group">
                    <label for="email"><?php echo $t['email_label']; ?> *</label>
                    <input type="email" id="email" name="email" class="form-control"
                           placeholder="<?php echo $t['email_placeholder']; ?>" required autofocus>
                </div>

                <button type="submit" class="btn-auth" id="submitBtn">
                    <?php echo $t['send_btn']; ?>
                </button>
            </form>

            <div class="auth-footer">
                <a href="/auth/login.php">
                    <i class="fas fa-arrow-left"></i> <?php echo $t['back_login']; ?>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('forgotPasswordForm').addEventListener('submit', function(e) {
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<span class="spinner"></span> <?php echo $t['sending']; ?>';
});
</script>

<?php include __DIR__ . '/../components/layout/footer.php'; ?>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="<?php echo $baseURL; ?>assets/js/main.js"></script>
<script>AOS.init({duration: 800, once: true});</script>

</body>
</html>
