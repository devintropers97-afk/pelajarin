<?php
/**
 * Reset Password Page
 */

defined('SITUNEO_ACCESS') or die('Direct access not permitted');

// Redirect if already logged in
if (Auth::check()) {
    if (Auth::isAdmin()) {
        Router::redirect('admin');
    } elseif (Auth::isClient()) {
        Router::redirect('client');
    } elseif (Auth::isFreelancer()) {
        Router::redirect('freelancer');
    }
}

$token = get('token');
$email = get('email');

$db = Database::getInstance();

// Validate token and email
$valid_token = false;
$user = null;

if ($token && $email) {
    $reset_request = $db->query("
        SELECT * FROM password_resets
        WHERE email = :email
        AND token = :token
        AND expires_at > NOW()
        ORDER BY created_at DESC
        LIMIT 1
    ", [
        'email' => $email,
        'token' => hash('sha256', $token)
    ])->fetch();

    if ($reset_request) {
        $valid_token = true;
        $user = $db->query("SELECT * FROM users WHERE email = :email AND is_active = 1", [
            'email' => $email
        ])->fetch();
    }
}

// Handle password reset form submission
if (is_post() && $valid_token && $user) {
    $password = post('password');
    $password_confirmation = post('password_confirmation');

    $validator = Validator::make([
        'password' => $password,
        'password_confirmation' => $password_confirmation
    ], [
        'password' => 'required|min:8|confirmed'
    ], [], [
        'password' => 'Password Baru',
        'password_confirmation' => 'Konfirmasi Password'
    ]);

    if ($validator->validate()) {
        // Update password
        $db->query("
            UPDATE users
            SET password = :password,
                updated_at = :updated_at
            WHERE id = :user_id
        ", [
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'updated_at' => date('Y-m-d H:i:s'),
            'user_id' => $user['id']
        ]);

        // Delete used token
        $db->query("DELETE FROM password_resets WHERE email = :email", [
            'email' => $email
        ]);

        // Log the password reset
        $db->insert('activity_logs', [
            'user_id' => $user['id'],
            'action' => 'password_reset',
            'description' => 'User reset password successfully',
            'ip_address' => $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0',
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        Session::flashSuccess('Password berhasil diubah! Silakan login dengan password baru Anda.');
        Router::redirect('login');
    } else {
        Session::flashError(implode('<br>', $validator->all()));
    }
}

$page_title = 'Reset Password - SITUNEO DIGITAL';
$page_description = 'Reset password akun SITUNEO DIGITAL Anda';

include INCLUDES_PATH . 'header/public-header.php';
?>

<section class="auth-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="auth-card" data-aos="fade-up">
                    <div class="auth-header text-center">
                        <i class="bi bi-shield-lock text-success" style="font-size: 3rem;"></i>
                        <h2>Reset Password</h2>
                        <?php if ($valid_token && $user): ?>
                        <p class="text-muted">Buat password baru untuk akun <strong><?= htmlspecialchars($email) ?></strong></p>
                        <?php else: ?>
                        <p class="text-muted text-danger">Link reset password tidak valid atau sudah kedaluwarsa</p>
                        <?php endif; ?>
                    </div>

                    <?php if ($valid_token && $user): ?>
                    <form method="post" action="<?= url('reset-password?token=' . urlencode($token) . '&email=' . urlencode($email)) ?>">
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label class="form-label">Password Baru <span class="text-danger">*</span></label>
                            <input type="password" name="password" class="form-control" required autofocus>
                            <small class="text-muted">Minimal 8 karakter</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password Baru <span class="text-danger">*</span></label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-success w-100 mb-3">
                            <i class="bi bi-shield-check"></i> Reset Password
                        </button>

                        <div class="text-center">
                            <a href="<?= url('login') ?>" class="text-muted">
                                <i class="bi bi-arrow-left"></i> Kembali ke Login
                            </a>
                        </div>
                    </form>
                    <?php else: ?>
                    <div class="text-center">
                        <div class="alert alert-danger">
                            <i class="bi bi-exclamation-triangle"></i>
                            <strong>Link Tidak Valid!</strong><br>
                            Link reset password tidak valid, sudah kedaluwarsa, atau sudah pernah digunakan.
                        </div>
                        <p class="mb-3">Silakan request link reset password baru.</p>
                        <a href="<?= url('forgot-password') ?>" class="btn btn-primary mb-2">
                            <i class="bi bi-envelope"></i> Request Link Baru
                        </a>
                        <br>
                        <a href="<?= url('login') ?>" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali ke Login
                        </a>
                    </div>
                    <?php endif; ?>

                    <hr class="my-4">

                    <div class="text-center">
                        <p class="mb-2"><strong>Butuh bantuan?</strong></p>
                        <a href="<?= whatsapp_link(COMPANY_WHATSAPP, 'Halo, saya perlu bantuan reset password') ?>" target="_blank" class="btn btn-success btn-sm">
                            <i class="bi bi-whatsapp"></i> Hubungi Admin via WhatsApp
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include INCLUDES_PATH . 'footer/public-footer.php'; ?>

<style>
.auth-section {
    padding: 100px 0;
    min-height: 100vh;
    background: var(--gray-50);
}

.auth-card {
    background: var(--white);
    border-radius: var(--radius-xl);
    padding: 3rem;
    box-shadow: var(--shadow-xl);
}

.auth-header {
    margin-bottom: 2rem;
}

.auth-header h2 {
    margin-bottom: 0.5rem;
    margin-top: 1rem;
}
</style>
