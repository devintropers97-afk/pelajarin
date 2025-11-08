<?php
/**
 * Registration Page
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

// Handle registration form submission
if (is_post()) {
    $name = post('name');
    $email = post('email');
    $phone = post('phone');
    $password = post('password');
    $password_confirmation = post('password_confirmation');
    $role = post('role', 'client'); // Default to client
    $agree_terms = post('agree_terms');

    $validator = Validator::make([
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'password' => $password,
        'password_confirmation' => $password_confirmation,
        'role' => $role,
        'agree_terms' => $agree_terms
    ], [
        'name' => 'required|min:3|max:100',
        'email' => 'required|email',
        'phone' => 'required|min:10|max:15',
        'password' => 'required|min:8|confirmed',
        'role' => 'required|in:client,freelancer',
        'agree_terms' => 'accepted'
    ], [], [
        'name' => 'Nama Lengkap',
        'email' => 'Email',
        'phone' => 'No. WhatsApp',
        'password' => 'Password',
        'password_confirmation' => 'Konfirmasi Password',
        'role' => 'Role',
        'agree_terms' => 'Syarat & Ketentuan'
    ]);

    if ($validator->validate()) {
        // Check if email already exists
        $db = Database::getInstance();
        $existing = $db->query("SELECT id FROM users WHERE email = :email", [
            'email' => $email
        ])->fetch();

        if ($existing) {
            Session::flashError('Email sudah terdaftar. Silakan gunakan email lain atau <a href="' . url('login') . '">login</a>.');
            Session::flashInput($_POST);
        } else {
            // Create new user
            $user_id = $db->insert('users', [
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'role' => $role,
                'is_active' => 1,
                'email_verified_at' => null, // Will be verified later
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            if ($user_id) {
                // Create profile based on role
                if ($role === 'freelancer') {
                    $db->insert('freelancer_profiles', [
                        'user_id' => $user_id,
                        'tier' => 'bronze', // Start at bronze tier (30% commission)
                        'commission_rate' => 30.00,
                        'total_earnings' => 0.00,
                        'available_balance' => 0.00,
                        'is_verified' => 0,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                } else {
                    $db->insert('client_profiles', [
                        'user_id' => $user_id,
                        'company_name' => null,
                        'industry' => null,
                        'total_spent' => 0.00,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                }

                // Log the registration
                $db->insert('activity_logs', [
                    'user_id' => $user_id,
                    'action' => 'register',
                    'description' => "User registered as {$role}",
                    'ip_address' => $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0',
                    'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown',
                    'created_at' => date('Y-m-d H:i:s')
                ]);

                // Auto-login after registration
                $result = Auth::login($email, $password, false);

                if ($result['success']) {
                    Session::flashSuccess('Selamat datang, ' . $name . '! Akun Anda berhasil dibuat.');

                    // Redirect based on role
                    if ($role === 'freelancer') {
                        Router::redirect('freelancer');
                    } else {
                        Router::redirect('client');
                    }
                } else {
                    // Registration successful but auto-login failed
                    Session::flashSuccess('Registrasi berhasil! Silakan login.');
                    Router::redirect('login');
                }
            } else {
                Session::flashError('Terjadi kesalahan saat membuat akun. Silakan coba lagi.');
                Session::flashInput($_POST);
            }
        }
    } else {
        Session::flashError(implode('<br>', $validator->all()));
        Session::flashInput($_POST);
    }
}

$page_title = 'Daftar - SITUNEO DIGITAL';
$page_description = 'Daftar akun SITUNEO DIGITAL dan mulai project Anda';

include INCLUDES_PATH . 'header/public-header.php';
?>

<section class="auth-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <div class="auth-card" data-aos="fade-up">
                    <div class="auth-header text-center">
                        <h2>Daftar Akun Baru</h2>
                        <p class="text-muted">Mulai project digital Anda bersama kami</p>
                    </div>

                    <form method="post" action="<?= url('register') ?>">
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="<?= old('name') ?>" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" class="form-control" value="<?= old('email') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">No. WhatsApp <span class="text-danger">*</span></label>
                            <input type="tel" name="phone" class="form-control" value="<?= old('phone') ?>" placeholder="08123456789" required>
                            <small class="text-muted">Format: 08xxxxxxxxxx</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" class="form-control" required>
                            <small class="text-muted">Minimal 8 karakter</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Daftar Sebagai <span class="text-danger">*</span></label>
                            <div class="role-selection">
                                <label class="role-option">
                                    <input type="radio" name="role" value="client" <?= old('role', 'client') === 'client' ? 'checked' : '' ?>>
                                    <div class="role-card">
                                        <i class="bi bi-briefcase"></i>
                                        <h5>Client</h5>
                                        <p>Saya ingin order jasa digital</p>
                                    </div>
                                </label>
                                <label class="role-option">
                                    <input type="radio" name="role" value="freelancer" <?= old('role') === 'freelancer' ? 'checked' : '' ?>>
                                    <div class="role-card">
                                        <i class="bi bi-laptop"></i>
                                        <h5>Freelancer</h5>
                                        <p>Saya ingin join sebagai freelancer dan dapat komisi</p>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" name="agree_terms" class="form-check-input" id="agreeTerms" value="1" required>
                            <label class="form-check-label" for="agreeTerms">
                                Saya setuju dengan <a href="<?= url('terms') ?>" target="_blank">Syarat & Ketentuan</a>
                                dan <a href="<?= url('privacy') ?>" target="_blank">Kebijakan Privasi</a>
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mb-3">
                            <i class="bi bi-person-plus"></i> Daftar Sekarang
                        </button>

                        <div class="text-center">
                            <p class="mb-0">Sudah punya akun? <a href="<?= url('login') ?>">Login di sini</a></p>
                        </div>
                    </form>
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
}

.role-selection {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
}

.role-option {
    cursor: pointer;
    margin-bottom: 0;
}

.role-option input[type="radio"] {
    display: none;
}

.role-card {
    background: var(--gray-50);
    border: 2px solid var(--gray-200);
    border-radius: var(--radius-lg);
    padding: 1.5rem;
    text-align: center;
    transition: var(--transition);
}

.role-option input[type="radio"]:checked + .role-card {
    background: var(--primary-light);
    border-color: var(--primary-color);
}

.role-card i {
    font-size: 2.5rem;
    color: var(--primary-color);
    margin-bottom: 0.5rem;
}

.role-card h5 {
    font-size: 1.125rem;
    font-weight: 600;
    margin-bottom: 0.25rem;
}

.role-card p {
    font-size: 0.875rem;
    color: var(--gray-600);
    margin-bottom: 0;
}

@media (max-width: 576px) {
    .role-selection {
        grid-template-columns: 1fr;
    }
}
</style>
