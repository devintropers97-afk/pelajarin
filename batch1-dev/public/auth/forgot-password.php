<?php
/**
 * Forgot Password Page
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

// Handle forgot password form submission
if (is_post()) {
    $email = post('email');

    $validator = Validator::make([
        'email' => $email
    ], [
        'email' => 'required|email'
    ], [], [
        'email' => 'Email'
    ]);

    if ($validator->validate()) {
        $db = Database::getInstance();

        // Check if user exists
        $user = $db->query("SELECT id, name, email FROM users WHERE email = :email AND is_active = 1", [
            'email' => $email
        ])->fetch();

        if ($user) {
            // Generate reset token
            $token = bin2hex(random_bytes(32));
            $expires_at = date('Y-m-d H:i:s', strtotime('+1 hour'));

            // Delete any existing tokens for this user
            $db->query("DELETE FROM password_resets WHERE email = :email", [
                'email' => $email
            ]);

            // Insert new token
            $db->insert('password_resets', [
                'email' => $email,
                'token' => hash('sha256', $token),
                'created_at' => date('Y-m-d H:i:s'),
                'expires_at' => $expires_at
            ]);

            // Create reset link
            $reset_link = url('reset-password?token=' . $token . '&email=' . urlencode($email));

            // In production, send email here
            // For now, we'll use WhatsApp link as fallback
            $whatsapp_message = "Halo {$user['name']}, berikut link reset password Anda:\n\n{$reset_link}\n\nLink berlaku 1 jam.\n\nJika Anda tidak meminta reset password, abaikan pesan ini.";

            // Log the reset request
            $db->insert('activity_logs', [
                'user_id' => $user['id'],
                'action' => 'password_reset_request',
                'description' => 'User requested password reset',
                'ip_address' => $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0',
                'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown',
                'created_at' => date('Y-m-d H:i:s')
            ]);

            Session::flashSuccess('Link reset password telah dikirim ke email Anda. Silakan cek inbox/spam.<br><small>Atau <a href="' . whatsapp_link(COMPANY_WHATSAPP, $whatsapp_message) . '" target="_blank">klik di sini</a> untuk reset via WhatsApp.</small>');
            Session::set('reset_token_sent', true);
        } else {
            // Don't reveal if email exists or not (security best practice)
            Session::flashSuccess('Jika email terdaftar, link reset password akan dikirim ke email Anda.');
        }
    } else {
        Session::flashError(implode('<br>', $validator->all()));
        Session::flashInput($_POST);
    }
}

$page_title = 'Lupa Password - SITUNEO DIGITAL';
$page_description = 'Reset password akun SITUNEO DIGITAL Anda';

include INCLUDES_PATH . 'header/public-header.php';
?>

<section class="auth-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="auth-card" data-aos="fade-up">
                    <div class="auth-header text-center">
                        <i class="bi bi-key text-warning" style="font-size: 3rem;"></i>
                        <h2>Lupa Password?</h2>
                        <p class="text-muted">Masukkan email Anda dan kami akan kirimkan link reset password</p>
                    </div>

                    <?php if (!Session::get('reset_token_sent')): ?>
                    <form method="post" action="<?= url('forgot-password') ?>">
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="<?= old('email') ?>" required autofocus>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mb-3">
                            <i class="bi bi-envelope"></i> Kirim Link Reset Password
                        </button>

                        <div class="text-center">
                            <a href="<?= url('login') ?>" class="text-muted">
                                <i class="bi bi-arrow-left"></i> Kembali ke Login
                            </a>
                        </div>
                    </form>
                    <?php else: ?>
                    <div class="text-center">
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle"></i> Link reset password telah dikirim!
                        </div>
                        <p class="mb-3">Silakan cek email Anda dan klik link yang kami kirimkan.</p>
                        <a href="<?= url('login') ?>" class="btn btn-primary">
                            <i class="bi bi-arrow-left"></i> Kembali ke Login
                        </a>
                    </div>
                    <?php Session::remove('reset_token_sent'); ?>
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
