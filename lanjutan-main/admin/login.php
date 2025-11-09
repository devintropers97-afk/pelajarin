<?php
// Load dependencies
require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/security.php';
require_once __DIR__ . '/../includes/session.php';

// Redirect if already logged in as admin
if (isLoggedIn()) {
    $user = getCurrentUser();
    if ($user['role'] === 'admin') {
        header('Location: /admin/dashboard');
        exit;
    } else {
        // Not admin, logout and show error
        session_destroy();
        $login_error = 'Halaman ini khusus untuk Admin. Silakan login dengan akun admin.';
    }
}

// Handle login form submission
$login_error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = sanitize($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']) ? true : false;

    // Validation
    if (empty($email) || empty($password)) {
        $login_error = 'Email dan password harus diisi.';
    } elseif (!validateEmail($email)) {
        $login_error = 'Format email tidak valid.';
    } else {
        // DEMO MODE
        if (DEMO_MODE) {
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
            } else {
                $login_error = 'Email atau password salah.';
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - SITUNEO DIGITAL</title>
    <link rel="icon" type="image/png" href="https://situneo.my.id/logo">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #1E5C99;
            --dark-blue: #0F3057;
            --gold: #FFB400;
            --red: #dc3545;
            --gradient-primary: linear-gradient(135deg, #1E5C99 0%, #0F3057 100%);
            --gradient-gold: linear-gradient(135deg, #FFD700 0%, #FFB400 100%);
            --gradient-red: linear-gradient(135deg, #ff6b6b 0%, #dc3545 100%);
        }
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            background: var(--dark-blue);
            color: #fff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow: hidden;
        }
        .bg-animation { position: absolute; width: 100%; height: 100%; top: 0; left: 0; z-index: 0; }
        .bg-animation canvas { width: 100%; height: 100%; }
        .auth-container {
            background: rgba(10, 22, 40, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            border: 2px solid rgba(220, 53, 69, 0.3);
            overflow: hidden;
            max-width: 1000px;
            width: 100%;
            position: relative;
            z-index: 1;
        }
        .auth-row { display: flex; flex-wrap: wrap; min-height: 600px; }
        .auth-left {
            flex: 1;
            min-width: 350px;
            background: var(--gradient-red);
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
        }
        .auth-right { flex: 1; min-width: 350px; padding: 50px 40px; }
        .logo img { width: 140px; height: 140px; border-radius: 25px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4); }
        .auth-left-title {
            font-size: 2.2rem;
            font-weight: 900;
            margin: 20px 0 10px;
            color: #fff;
            text-shadow: 0 2px 10px rgba(0,0,0,0.3);
        }
        .admin-badge {
            background: rgba(255,255,255,0.2);
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 20px;
        }
        .feature-item {
            display: flex;
            align-items: center;
            padding: 15px;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 10px;
            margin-bottom: 15px;
            transition: all 0.3s;
        }
        .feature-item:hover { background: rgba(255, 255, 255, 0.25); transform: translateX(5px); }
        .feature-item i { font-size: 1.5rem; color: #fff; margin-right: 15px; }
        .form-control {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            padding: 14px 18px;
            color: #fff;
            margin-bottom: 15px;
        }
        .form-control:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: var(--red);
            box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.25);
            color: #fff;
            outline: none;
        }
        .btn-admin {
            background: var(--gradient-red);
            color: #fff;
            border: none;
            padding: 14px;
            font-weight: 700;
            border-radius: 50px;
            width: 100%;
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
        }
        .btn-admin:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(220, 53, 69, 0.6); }
        .auth-link { color: var(--red); text-decoration: none; }
        .input-group { position: relative; }
        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--red);
            cursor: pointer;
        }
        .warning-box {
            background: rgba(255, 193, 7, 0.1);
            border: 1px solid rgba(255, 193, 7, 0.3);
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        @media (max-width: 768px) {
            .auth-left, .auth-right { min-width: 100%; }
            .logo img { width: 100px; height: 100px; }
        }
    </style>
</head>
<body>
    <div class="bg-animation"><canvas id="bgCanvas"></canvas></div>
    <div class="auth-container">
        <div class="auth-row">
            <div class="auth-left">
                <div class="logo"><img src="https://situneo.my.id/logo" alt="SITUNEO"></div>
                <h1 class="auth-left-title">SITUNEO DIGITAL</h1>
                <div class="admin-badge"><i class="bi bi-shield-lock-fill me-2"></i>Admin Area</div>
                <p style="opacity: 0.9; margin-bottom: 30px;">Panel Kontrol Administratorsituneo</p>
                <div style="text-align: left;">
                    <div class="feature-item"><i class="bi bi-speedometer"></i><span>Kontrol penuh sistem</span></div>
                    <div class="feature-item"><i class="bi bi-people-fill"></i><span>Kelola user & freelancer</span></div>
                    <div class="feature-item"><i class="bi bi-graph-up"></i><span>Analytics & reports</span></div>
                    <div class="feature-item"><i class="bi bi-gear-fill"></i><span>Pengaturan sistem</span></div>
                </div>
            </div>
            <div class="auth-right">
                <h2 style="color: var(--red); font-size: 1.8rem; font-weight: 800; margin-bottom: 10px;">
                    <i class="bi bi-shield-lock-fill me-2"></i>Admin Login
                </h2>
                <p style="color: rgba(255,255,255,0.7); margin-bottom: 25px;">Akses khusus administrator</p>

                <div class="warning-box">
                    <i class="bi bi-exclamation-triangle-fill me-2" style="color: #ffc107;"></i>
                    <strong style="color: #ffc107;">Perhatian:</strong> Halaman ini khusus untuk admin SITUNEO DIGITAL. Akses tidak sah akan dicatat.
                </div>

                <?php if ($login_error): ?>
                <div class="alert alert-danger"><i class="bi bi-exclamation-triangle-fill me-2"></i><?= htmlspecialchars($login_error) ?></div>
                <?php endif; ?>

                <?php if (DEMO_MODE): ?>
                <div class="alert alert-info" style="font-size: 0.9rem;">
                    <strong>Demo Mode:</strong><br>
                    <small>Email: admin@situneo.my.id</small><br>
                    <small>Password: admin123</small>
                </div>
                <?php endif; ?>

                <form method="POST">
                    <label style="color: rgba(255,255,255,0.8); display: block; margin-bottom: 8px;">Email Admin</label>
                    <input type="email" name="email" class="form-control" placeholder="admin@situneo.my.id" required>

                    <label style="color: rgba(255,255,255,0.8); display: block; margin-bottom: 8px;">Password</label>
                    <div class="input-group" style="margin-bottom: 15px;">
                        <input type="password" name="password" class="form-control" id="passwordInput" placeholder="Password admin" required style="margin-bottom: 0;">
                        <button type="button" class="toggle-password" onclick="togglePassword()">
                            <i class="bi bi-eye" id="toggleIcon"></i>
                        </button>
                    </div>

                    <div class="d-flex justify-content-between mb-3">
                        <label style="color: rgba(255,255,255,0.8);"><input type="checkbox" name="remember"> Ingat saya</label>
                        <a href="/auth/forgot-password" class="auth-link">Lupa password?</a>
                    </div>

                    <button type="submit" class="btn-admin">
                        <i class="bi bi-shield-lock-fill me-2"></i>LOGIN SEBAGAI ADMIN
                    </button>
                </form>

                <div class="text-center mt-4" style="padding-top: 20px; border-top: 1px solid rgba(255,255,255,0.1);">
                    <a href="/auth/login" style="color: rgba(255,255,255,0.6); font-size: 0.9rem;">
                        <i class="bi bi-arrow-left me-1"></i>Kembali ke Login User
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('passwordInput');
            const icon = document.getElementById('toggleIcon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('bi-eye', 'bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('bi-eye-slash', 'bi-eye');
            }
        }

        const canvas = document.getElementById('bgCanvas');
        const ctx = canvas.getContext('2d');
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;

        const particles = [];
        for (let i = 0; i < 50; i++) {
            particles.push({
                x: Math.random() * canvas.width,
                y: Math.random() * canvas.height,
                vx: (Math.random() - 0.5) * 0.5,
                vy: (Math.random() - 0.5) * 0.5,
                r: Math.random() * 2 + 1
            });
        }

        function animate() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            particles.forEach(p => {
                p.x += p.vx;
                p.y += p.vy;
                if (p.x < 0 || p.x > canvas.width) p.vx *= -1;
                if (p.y < 0 || p.y > canvas.height) p.vy *= -1;
                ctx.beginPath();
                ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
                ctx.fillStyle = 'rgba(220, 53, 69, 0.4)';
                ctx.fill();
            });
            requestAnimationFrame(animate);
        }
        animate();
        window.addEventListener('resize', () => { canvas.width = window.innerWidth; canvas.height = window.innerHeight; });
    </script>
</body>
</html>
