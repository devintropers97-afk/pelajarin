<?php
// Load dependencies
require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/functions.php';
require_once __DIR__ . '/../includes/security.php';
require_once __DIR__ . '/../includes/session.php';

// Redirect if already logged in
if (isLoggedIn()) {
    $user = getCurrentUser();
    header('Location: /' . $user['role'] . '/dashboard');
    exit;
}

// Handle registration
$register_error = '';
$register_success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $role = sanitize($_POST['role'] ?? 'client');
    $full_name = sanitize($_POST['full_name'] ?? '');
    $email = sanitize($_POST['email'] ?? '');
    $phone = sanitize($_POST['phone'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Validation
    if (empty($full_name) || empty($email) || empty($phone) || empty($password)) {
        $register_error = 'Semua field wajib diisi.';
    } elseif (!validateEmail($email)) {
        $register_error = 'Format email tidak valid.';
    } elseif (strlen($password) < 8) {
        $register_error = 'Password minimal 8 karakter.';
    } elseif ($password !== $confirm_password) {
        $register_error = 'Password dan konfirmasi password tidak sama.';
    } else {
        // Additional validation for freelancer
        if ($role === 'freelancer') {
            $ktp = $_FILES['ktp'] ?? null;
            $address = trim($_POST['address'] ?? '');
            $cv = $_FILES['cv'] ?? null;

            if (!$ktp || $ktp['error'] !== UPLOAD_ERR_OK) {
                $register_error = 'Upload KTP wajib untuk freelancer.';
            } elseif (empty($address)) {
                $register_error = 'Alamat tempat tinggal wajib diisi untuk freelancer.';
            } elseif (strlen($address) < 20) {
                $register_error = 'Alamat terlalu pendek. Mohon tulis alamat lengkap Anda.';
            } elseif (!$cv || $cv['error'] !== UPLOAD_ERR_OK) {
                $register_error = 'Upload CV wajib untuk freelancer.';
            }
        }

        if (!$register_error) {
            // DEMO MODE - Just show success
            if (DEMO_MODE) {
                $register_success = 'Registrasi berhasil! Silakan login dengan email: ' . htmlspecialchars($email);

                // In demo mode, we don't actually save to database
                // Just show success message
            } else {
                // Real database registration would go here
                // Check if email exists, hash password, save to DB, etc.
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
    <title>Daftar - SITUNEO DIGITAL</title>
    <link rel="icon" type="image/png" href="https://situneo.my.id/logo">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Plus+Jakarta+Sans:wght@400;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary-blue: #1E5C99;
            --dark-blue: #0F3057;
            --gold: #FFB400;
            --gradient-primary: linear-gradient(135deg, #1E5C99 0%, #0F3057 100%);
            --gradient-gold: linear-gradient(135deg, #FFD700 0%, #FFB400 100%);
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
            overflow-x: hidden;
        }
        .bg-animation { position: fixed; width: 100%; height: 100%; top: 0; left: 0; z-index: 0; }
        .bg-animation canvas { width: 100%; height: 100%; }
        .auth-container {
            background: rgba(10, 22, 40, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
            border: 1px solid rgba(212, 175, 55, 0.2);
            overflow: hidden;
            max-width: 1100px;
            width: 100%;
            position: relative;
            z-index: 1;
            margin: 20px 0;
        }
        .auth-row { display: flex; flex-wrap: wrap; }
        .auth-left {
            flex: 1;
            min-width: 350px;
            background: var(--gradient-primary);
            padding: 50px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .auth-right { flex: 1.2; min-width: 400px; padding: 40px; max-height: 90vh; overflow-y: auto; }
        .logo img { width: 120px; height: 120px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4); }
        .auth-left-title {
            font-size: 2rem;
            font-weight: 900;
            margin: 20px 0 10px;
            background: var(--gradient-gold);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .benefit-item {
            display: flex;
            align-items: center;
            padding: 12px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            margin-bottom: 12px;
            transition: all 0.3s;
        }
        .benefit-item:hover { background: rgba(212, 175, 55, 0.2); transform: translateX(5px); }
        .benefit-item i { font-size: 1.3rem; color: var(--gold); margin-right: 12px; min-width: 25px; }
        .role-tabs { display: flex; gap: 10px; margin-bottom: 25px; }
        .role-tab {
            flex: 1;
            padding: 12px;
            border: 2px solid rgba(212, 175, 55, 0.3);
            border-radius: 10px;
            background: transparent;
            color: rgba(255, 255, 255, 0.7);
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 600;
        }
        .role-tab.active { background: var(--gradient-gold); color: var(--dark-blue); border-color: var(--gold); }
        .form-group { margin-bottom: 15px; }
        .form-label { color: rgba(255,255,255,0.9); font-weight: 500; margin-bottom: 6px; display: block; font-size: 0.9rem; }
        .form-control {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            padding: 12px 15px;
            color: #fff;
            font-size: 0.95rem;
        }
        .form-control:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: var(--gold);
            box-shadow: 0 0 0 0.2rem rgba(212, 175, 55, 0.25);
            color: #fff;
            outline: none;
        }
        .form-control::placeholder { color: rgba(255, 255, 255, 0.4); }
        .btn-gold {
            background: var(--gradient-gold);
            color: var(--dark-blue);
            border: none;
            padding: 14px;
            font-weight: 700;
            border-radius: 50px;
            width: 100%;
            box-shadow: 0 5px 15px rgba(212, 175, 55, 0.3);
            margin-top: 10px;
        }
        .btn-gold:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(212, 175, 55, 0.6); }
        .auth-link { color: var(--gold); text-decoration: none; }
        .input-group { position: relative; }
        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--gold);
            cursor: pointer;
        }
        .file-upload {
            position: relative;
            overflow: hidden;
            display: block;
        }
        .file-upload input[type=file] {
            position: absolute;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
        }
        .file-upload-label {
            background: rgba(255, 255, 255, 0.1);
            border: 2px dashed rgba(212, 175, 55, 0.3);
            border-radius: 10px;
            padding: 15px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s;
        }
        .file-upload-label:hover { background: rgba(212, 175, 55, 0.1); border-color: var(--gold); }
        .file-name { font-size: 0.85rem; color: var(--gold); margin-top: 5px; }
        .freelancer-fields { display: none; }
        .freelancer-fields.active { display: block; }
        .info-box {
            background: rgba(13, 202, 240, 0.1);
            border: 1px solid rgba(13, 202, 240, 0.3);
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }
        @media (max-width: 768px) {
            .auth-left, .auth-right { min-width: 100%; }
            .logo img { width: 80px; height: 80px; }
            .auth-left { padding: 30px 20px; }
            .auth-right { padding: 30px 20px; }
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
                <p style="opacity: 0.9; margin-bottom: 30px; font-size: 0.95rem;">Bergabung dengan 500+ bisnis sukses</p>
                <div style="text-align: left; width: 100%;">
                    <div class="benefit-item"><i class="bi bi-check-circle-fill"></i><span>FREE Demo 24 jam</span></div>
                    <div class="benefit-item"><i class="bi bi-check-circle-fill"></i><span>Akses dashboard lengkap</span></div>
                    <div class="benefit-item"><i class="bi bi-check-circle-fill"></i><span>Support 24/7 via WA</span></div>
                    <div class="benefit-item"><i class="bi bi-check-circle-fill"></i><span>Harga transparan</span></div>
                    <div class="benefit-item"><i class="bi bi-check-circle-fill"></i><span>Garansi kepuasan</span></div>
                </div>
            </div>
            <div class="auth-right">
                <h2 style="color: var(--gold); font-size: 1.8rem; font-weight: 800; margin-bottom: 8px;">Daftar Sekarang</h2>
                <p style="color: rgba(255,255,255,0.7); margin-bottom: 20px; font-size: 0.95rem;">Pilih tipe akun Anda</p>

                <?php if ($register_error): ?>
                <div class="alert alert-danger"><i class="bi bi-exclamation-triangle-fill me-2"></i><?= htmlspecialchars($register_error) ?></div>
                <?php endif; ?>

                <?php if ($register_success): ?>
                <div class="alert alert-success"><i class="bi bi-check-circle-fill me-2"></i><?= htmlspecialchars($register_success) ?>
                <div class="mt-2"><a href="/auth/login" class="btn btn-sm btn-success">Login Sekarang</a></div>
                </div>
                <?php endif; ?>

                <div class="role-tabs">
                    <button class="role-tab active" data-role="client">
                        <i class="bi bi-person"></i> Client<br>
                        <small style="font-size: 0.75rem; font-weight: 400;">Saya mau order website</small>
                    </button>
                    <button class="role-tab" data-role="freelancer">
                        <i class="bi bi-briefcase"></i> Freelancer<br>
                        <small style="font-size: 0.75rem; font-weight: 400;">Saya mau kerja/cari project</small>
                    </button>
                </div>

                <form method="POST" enctype="multipart/form-data" id="registerForm">
                    <input type="hidden" name="role" id="roleInput" value="client">

                    <!-- Common Fields -->
                    <div class="form-group">
                        <label class="form-label"><i class="bi bi-person me-1"></i>Nama Lengkap</label>
                        <input type="text" name="full_name" class="form-control" placeholder="Nama lengkap Anda" required>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"><i class="bi bi-envelope me-1"></i>Email</label>
                                <input type="email" name="email" class="form-control" placeholder="nama@email.com" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"><i class="bi bi-phone me-1"></i>No. WhatsApp</label>
                                <input type="tel" name="phone" class="form-control" placeholder="08xxxxxxxxxx" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"><i class="bi bi-lock me-1"></i>Password</label>
                                <div class="input-group">
                                    <input type="password" name="password" class="form-control" id="passwordInput" placeholder="Min. 8 karakter" required>
                                    <button type="button" class="toggle-password" onclick="togglePassword('passwordInput', 'toggleIcon1')">
                                        <i class="bi bi-eye" id="toggleIcon1"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label"><i class="bi bi-lock-fill me-1"></i>Konfirmasi Password</label>
                                <div class="input-group">
                                    <input type="password" name="confirm_password" class="form-control" id="confirmPasswordInput" placeholder="Ketik ulang password" required>
                                    <button type="button" class="toggle-password" onclick="togglePassword('confirmPasswordInput', 'toggleIcon2')">
                                        <i class="bi bi-eye" id="toggleIcon2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Freelancer Additional Fields -->
                    <div class="freelancer-fields" id="freelancerFields">
                        <hr style="border-color: rgba(212, 175, 55, 0.2); margin: 20px 0;">
                        <h6 style="color: var(--gold); margin-bottom: 15px;">
                            <i class="bi bi-file-earmark-arrow-up me-2"></i>Dokumen Wajib untuk Freelancer
                        </h6>

                        <div class="info-box">
                            <i class="bi bi-info-circle me-2"></i>
                            <strong>Persyaratan:</strong> Upload scan/foto dokumen dengan format JPG, PNG, atau PDF (Max 2MB per file)
                        </div>

                        <div class="form-group">
                            <label class="form-label"><i class="bi bi-card-heading me-1"></i>KTP (Kartu Tanda Penduduk) *</label>
                            <div class="file-upload">
                                <div class="file-upload-label">
                                    <i class="bi bi-cloud-upload fs-3 text-gold"></i>
                                    <p class="mb-0 mt-2">Klik untuk upload KTP</p>
                                    <small class="text-muted">JPG, PNG, PDF (Max 2MB)</small>
                                </div>
                                <input type="file" name="ktp" id="ktpFile" accept=".jpg,.jpeg,.png,.pdf" onchange="showFileName(this, 'ktpName')">
                            </div>
                            <div class="file-name" id="ktpName"></div>
                        </div>

                        <div class="form-group">
                            <label class="form-label"><i class="bi bi-geo-alt me-1"></i>Alamat Tempat Tinggal *</label>
                            <textarea
                                name="address"
                                id="addressField"
                                class="form-control"
                                rows="3"
                                placeholder="Masukkan alamat lengkap tempat tinggal Anda..."
                                style="resize: vertical;"
                            ></textarea>
                            <small class="text-muted">Tuliskan alamat lengkap termasuk RT/RW, Kelurahan, Kecamatan, Kota, dan Kode Pos</small>
                        </div>

                        <div class="form-group">
                            <label class="form-label"><i class="bi bi-file-text me-1"></i>CV (Curriculum Vitae) *</label>
                            <div class="file-upload">
                                <div class="file-upload-label">
                                    <i class="bi bi-cloud-upload fs-3 text-gold"></i>
                                    <p class="mb-0 mt-2">Klik untuk upload CV</p>
                                    <small class="text-muted">PDF (Max 2MB)</small>
                                </div>
                                <input type="file" name="cv" id="cvFile" accept=".pdf" onchange="showFileName(this, 'cvName')">
                            </div>
                            <div class="file-name" id="cvName"></div>
                        </div>
                    </div>

                    <div class="form-check mt-3 mb-3">
                        <input class="form-check-input" type="checkbox" id="agreeTerms" required>
                        <label class="form-check-label" for="agreeTerms" style="color: rgba(255,255,255,0.8); font-size: 0.9rem;">
                            Saya setuju dengan <a href="/terms" class="auth-link">Syarat & Ketentuan</a> dan <a href="/privacy" class="auth-link">Kebijakan Privasi</a>
                        </label>
                    </div>

                    <button type="submit" class="btn-gold">
                        <i class="bi bi-person-plus me-2"></i>DAFTAR SEKARANG
                    </button>
                </form>

                <p class="text-center mt-3" style="font-size: 0.95rem;">
                    Sudah punya akun? <a href="/auth/login" class="auth-link">Login di sini</a>
                </p>
            </div>
        </div>
    </div>

    <script>
        // Role Tab Switching
        document.querySelectorAll('.role-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.role-tab').forEach(t => t.classList.remove('active'));
                this.classList.add('active');

                const role = this.getAttribute('data-role');
                document.getElementById('roleInput').value = role;

                // Show/hide freelancer fields
                const freelancerFields = document.getElementById('freelancerFields');
                if (role === 'freelancer') {
                    freelancerFields.classList.add('active');
                    // Make file inputs required
                    document.getElementById('ktpFile').required = true;
                    document.getElementById('addressField').required = true;
                    document.getElementById('cvFile').required = true;
                } else {
                    freelancerFields.classList.remove('active');
                    // Make file inputs not required
                    document.getElementById('ktpFile').required = false;
                    document.getElementById('addressField').required = false;
                    document.getElementById('cvFile').required = false;
                }
            });
        });

        // Toggle Password Visibility
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('bi-eye', 'bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('bi-eye-slash', 'bi-eye');
            }
        }

        // Show uploaded file name
        function showFileName(input, targetId) {
            const target = document.getElementById(targetId);
            if (input.files && input.files[0]) {
                const fileName = input.files[0].name;
                const fileSize = (input.files[0].size / 1024 / 1024).toFixed(2);
                target.innerHTML = `<i class="bi bi-check-circle-fill me-1"></i>${fileName} (${fileSize} MB)`;
            }
        }

        // Animated Background
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
                ctx.fillStyle = 'rgba(212, 175, 55, 0.3)';
                ctx.fill();
            });
            requestAnimationFrame(animate);
        }
        animate();
        window.addEventListener('resize', () => { canvas.width = window.innerWidth; canvas.height = window.innerHeight; });
    </script>
</body>
</html>
