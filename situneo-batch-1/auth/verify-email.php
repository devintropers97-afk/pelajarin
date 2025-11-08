<?php
require_once __DIR__ . '/../includes/session.php';
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../includes/functions/user.php';
require_once __DIR__ . '/../includes/functions/validation.php';

// Language support
$lang = $_SESSION['lang'] ?? 'id';
$baseURL = '/';

$text = [
    'id' => [
        'page_title' => 'Verifikasi Email - SITUNEO Digital',
        'verifying_title' => 'Memverifikasi Email...',
        'verifying_subtitle' => 'Mohon tunggu, kami sedang memverifikasi email Anda',
        'success_title' => 'Email Terverifikasi!',
        'success_subtitle' => 'Akun Anda telah berhasil diverifikasi',
        'success_message' => 'Selamat! Email Anda telah terverifikasi. Anda sekarang memiliki akses penuh ke semua fitur SITUNEO.',
        'error_title' => 'Verifikasi Gagal',
        'error_subtitle' => 'Link verifikasi tidak valid atau sudah kedaluwarsa',
        'error_message' => 'Link verifikasi yang Anda gunakan tidak valid atau sudah kedaluwarsa. Silakan request link verifikasi baru.',
        'goto_dashboard' => 'Ke Dashboard',
        'goto_login' => 'Ke Halaman Login',
        'resend_link' => 'Kirim Ulang Link Verifikasi',
    ],
    'en' => [
        'page_title' => 'Email Verification - SITUNEO Digital',
        'verifying_title' => 'Verifying Email...',
        'verifying_subtitle' => 'Please wait, we are verifying your email',
        'success_title' => 'Email Verified!',
        'success_subtitle' => 'Your account has been successfully verified',
        'success_message' => 'Congratulations! Your email has been verified. You now have full access to all SITUNEO features.',
        'error_title' => 'Verification Failed',
        'error_subtitle' => 'Verification link is invalid or expired',
        'error_message' => 'The verification link you used is invalid or has expired. Please request a new verification link.',
        'goto_dashboard' => 'Go to Dashboard',
        'goto_login' => 'Go to Login',
        'resend_link' => 'Resend Verification Link',
    ]
];

$t = $text[$lang];
$pageTitle = $t['page_title'];

// Check for token
$token = $_GET['token'] ?? '';
$verificationStatus = null;
$verifiedUser = null;

if (!empty($token) && validateToken($token)) {
    $result = verifyUserEmail($token);

    if ($result['success']) {
        $verificationStatus = 'success';
        $verifiedUser = $result['user'];

        // Auto-login user after verification
        createUserSession($verifiedUser);

        // Send welcome email
        require_once __DIR__ . '/../includes/functions/email.php';
        sendWelcomeEmail($verifiedUser['email'], $verifiedUser['full_name'], $verifiedUser['role']);

    } else {
        $verificationStatus = 'error';
    }
} else if (!empty($token)) {
    $verificationStatus = 'error';
} else {
    $verificationStatus = 'waiting';
}
?>

<?php include __DIR__ . '/../components/layout/header.php'; ?>

<style>
.auth-page { min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 100px 20px 50px; }
.auth-container { max-width: 500px; width: 100%; position: relative; z-index: 10; }
.auth-card { background: rgba(255, 255, 255, 0.98); border-radius: 16px; padding: 50px 40px; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3); text-align: center; }
.status-icon { width: 90px; height: 90px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 25px; font-size: 42px; }
.status-icon.verifying { background: linear-gradient(135deg, #1E5C99, #0F3057); color: #FFD700; animation: pulse 1.5s infinite; }
.status-icon.success { background: linear-gradient(135deg, #28a745, #20c997); color: #fff; }
.status-icon.error { background: linear-gradient(135deg, #dc3545, #c82333); color: #fff; }
@keyframes pulse { 0%, 100% { transform: scale(1); } 50% { transform: scale(1.05); } }
.status-title { font-size: 28px; font-weight: 700; color: #0F3057; margin: 0 0 10px; }
.status-subtitle { color: #666; font-size: 16px; margin-bottom: 25px; }
.status-message { background: #f8f9fa; border-left: 4px solid #1E5C99; padding: 20px; border-radius: 8px; margin: 25px 0; text-align: left; color: #333; font-size: 15px; line-height: 1.6; }
.status-message.success { border-color: #28a745; background: #d4edda; }
.status-message.error { border-color: #dc3545; background: #f8d7da; }
.btn-auth { display: inline-block; padding: 16px 40px; background: linear-gradient(135deg, #1E5C99, #0F3057); color: #fff; border: none; border-radius: 8px; font-size: 16px; font-weight: 700; cursor: pointer; text-decoration: none; transition: all 0.3s; margin: 10px 5px; }
.btn-auth:hover { transform: translateY(-2px); }
.btn-auth.success { background: linear-gradient(135deg, #28a745, #20c997); }
.spinner-large { display: inline-block; width: 50px; height: 50px; border: 4px solid rgba(255, 215, 0, 0.3); border-radius: 50%; border-top-color: #FFD700; animation: spin 1s linear infinite; }
@keyframes spin { to { transform: rotate(360deg); } }
</style>

<div class="auth-page">
    <div class="auth-container" data-aos="fade-up">
        <div class="auth-card">

            <?php if ($verificationStatus === 'waiting'): ?>
                <div class="status-icon verifying">
                    <div class="spinner-large"></div>
                </div>
                <h1 class="status-title"><?php echo $t['verifying_title']; ?></h1>
                <p class="status-subtitle"><?php echo $t['verifying_subtitle']; ?></p>

            <?php elseif ($verificationStatus === 'success'): ?>
                <div class="status-icon success">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h1 class="status-title"><?php echo $t['success_title']; ?></h1>
                <p class="status-subtitle"><?php echo $t['success_subtitle']; ?></p>

                <div class="status-message success">
                    <i class="fas fa-info-circle"></i>
                    <?php echo $t['success_message']; ?>
                </div>

                <a href="<?php echo getDashboardUrl(); ?>" class="btn-auth success">
                    <i class="fas fa-arrow-right"></i> <?php echo $t['goto_dashboard']; ?>
                </a>

            <?php else: ?>
                <div class="status-icon error">
                    <i class="fas fa-times-circle"></i>
                </div>
                <h1 class="status-title"><?php echo $t['error_title']; ?></h1>
                <p class="status-subtitle"><?php echo $t['error_subtitle']; ?></p>

                <div class="status-message error">
                    <i class="fas fa-exclamation-triangle"></i>
                    <?php echo $t['error_message']; ?>
                </div>

                <a href="/auth/login.php" class="btn-auth">
                    <i class="fas fa-sign-in-alt"></i> <?php echo $t['goto_login']; ?>
                </a>

            <?php endif; ?>

        </div>
    </div>
</div>

<?php include __DIR__ . '/../components/layout/footer.php'; ?>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="<?php echo $baseURL; ?>assets/js/main.js"></script>
<script>AOS.init({duration: 800, once: true});</script>

</body>
</html>
