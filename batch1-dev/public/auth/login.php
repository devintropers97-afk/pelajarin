<?php
/**
 * Login Page
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

// Handle login form submission
if (is_post()) {
    $email = post('email');
    $password = post('password');
    $remember = post('remember') ? true : false;

    $validator = Validator::make([
        'email' => $email,
        'password' => $password
    ], [
        'email' => 'required|email',
        'password' => 'required'
    ], [], [
        'email' => 'Email',
        'password' => 'Password'
    ]);

    if ($validator->validate()) {
        $result = Auth::login($email, $password, $remember);

        if ($result['success']) {
            Session::flashSuccess($result['message']);

            // Redirect based on role
            if (Auth::isAdmin()) {
                Router::redirect('admin');
            } elseif (Auth::isClient()) {
                Router::redirect('client');
            } elseif (Auth::isFreelancer()) {
                Router::redirect('freelancer');
            } else {
                Router::redirect('/');
            }
        } else {
            Session::flashError($result['message']);
        }
    } else {
        Session::flashError(implode('<br>', $validator->all()));
        Session::flashInput($_POST);
    }
}

$page_title = 'Login - SITUNEO DIGITAL';
$page_description = 'Login ke akun SITUNEO DIGITAL Anda';

include INCLUDES_PATH . 'header/public-header.php';
?>

<section class="auth-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="auth-card" data-aos="fade-up">
                    <div class="auth-header text-center">
                        <h2>Login</h2>
                        <p class="text-muted">Masuk ke akun Anda</p>
                    </div>

                    <form method="post" action="<?= url('login') ?>">
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" value="<?= old('email') ?>" required autofocus>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" name="remember" class="form-check-input" id="remember">
                            <label class="form-check-label" for="remember">Remember Me</label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mb-3">
                            <i class="bi bi-box-arrow-in-right"></i> Login
                        </button>

                        <div class="text-center">
                            <a href="<?= url('forgot-password') ?>" class="text-muted">Lupa Password?</a>
                        </div>
                    </form>

                    <hr class="my-4">

                    <div class="text-center">
                        <p class="mb-0">Belum punya akun? <a href="<?= url('register') ?>">Daftar Sekarang</a></p>
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
}
</style>
