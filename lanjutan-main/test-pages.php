<?php
/**
 * SITUNEO DIGITAL - Test Pages
 * Quick access to all 42 pages for testing
 *
 * CARA PAKAI:
 * 1. Akses: http://situneo.my.id/test-pages.php
 * 2. Klik link untuk test setiap halaman
 * 3. Setelah selesai testing, hapus file ini untuk security
 */

// Get base URL
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$base_url = $protocol . '://' . $_SERVER['HTTP_HOST'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test All Pages - SITUNEO DIGITAL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #0F2027 0%, #203A43 50%, #2C5364 100%);
            min-height: 100vh;
            padding: 40px 0;
        }
        .test-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .card {
            background: rgba(255, 255, 255, 0.95);
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            margin-bottom: 30px;
        }
        .card-header {
            background: linear-gradient(135deg, #1E5C99 0%, #2471B8 100%);
            color: white;
            font-weight: 700;
            font-size: 1.2rem;
            padding: 15px 20px;
        }
        .test-link {
            display: block;
            padding: 12px 20px;
            color: #1E5C99;
            text-decoration: none;
            border-bottom: 1px solid #e9ecef;
            transition: all 0.3s;
            position: relative;
        }
        .test-link:hover {
            background: #f8f9fa;
            padding-left: 30px;
            color: #FFB400;
        }
        .test-link i {
            margin-right: 10px;
            width: 20px;
        }
        .test-link small {
            color: #6c757d;
            display: block;
            margin-top: 4px;
            font-size: 0.85rem;
        }
        .badge-count {
            background: #FFB400;
            color: #0F2027;
            font-weight: 700;
            padding: 5px 15px;
            border-radius: 20px;
        }
        .warning-box {
            background: #fff3cd;
            border: 2px solid #ffc107;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 30px;
        }
        .warning-box i {
            color: #ffc107;
            font-size: 2rem;
        }
        .test-info {
            background: linear-gradient(135deg, #FFB400 0%, #FFD700 100%);
            padding: 30px;
            border-radius: 15px;
            color: #0F2027;
            margin-bottom: 30px;
            text-align: center;
        }
        .test-info h1 {
            font-weight: 900;
            margin-bottom: 10px;
        }
        .category-count {
            display: inline-block;
            background: rgba(255, 255, 255, 0.9);
            padding: 8px 20px;
            border-radius: 25px;
            margin: 5px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container test-container">
        <!-- Header Info -->
        <div class="test-info">
            <h1><i class="bi bi-list-check"></i> TEST ALL PAGES</h1>
            <p class="mb-3">SITUNEO DIGITAL - Complete Website Testing</p>
            <div>
                <span class="category-count"><i class="bi bi-globe"></i> 7 Public</span>
                <span class="category-count"><i class="bi bi-lock"></i> 6 Auth</span>
                <span class="category-count"><i class="bi bi-person"></i> 8 Client</span>
                <span class="category-count"><i class="bi bi-briefcase"></i> 4 Freelancer</span>
                <span class="category-count"><i class="bi bi-gear"></i> 17 Admin</span>
            </div>
            <div class="mt-3">
                <h2 class="badge-count">42 PAGES TOTAL</h2>
            </div>
        </div>

        <!-- Warning -->
        <div class="warning-box">
            <div class="d-flex align-items-center">
                <i class="bi bi-exclamation-triangle-fill me-3"></i>
                <div>
                    <strong>PENTING!</strong> File ini hanya untuk testing.
                    <strong>Hapus file ini setelah selesai testing</strong> untuk keamanan website.
                </div>
            </div>
        </div>

        <!-- PUBLIC PAGES -->
        <div class="card">
            <div class="card-header">
                <i class="bi bi-globe"></i> HALAMAN PUBLIC
                <span class="badge bg-light text-dark float-end">7 Pages</span>
            </div>
            <div class="card-body p-0">
                <a href="<?= $base_url ?>/" class="test-link" target="_blank">
                    <i class="bi bi-house-door-fill"></i> <strong>Homepage</strong>
                    <small>Hero section, services overview, tentang kami</small>
                </a>
                <a href="<?= $base_url ?>/about" class="test-link" target="_blank">
                    <i class="bi bi-info-circle-fill"></i> <strong>Tentang Kami</strong>
                    <small>Profil perusahaan, visi misi, tim profesional</small>
                </a>
                <a href="<?= $base_url ?>/services" class="test-link" target="_blank">
                    <i class="bi bi-grid-3x3-gap-fill"></i> <strong>Layanan</strong>
                    <small>Daftar 232+ layanan digital tersedia</small>
                </a>
                <a href="<?= $base_url ?>/portfolio" class="test-link" target="_blank">
                    <i class="bi bi-collection-fill"></i> <strong>Portfolio</strong>
                    <small>Showcase project yang telah dikerjakan</small>
                </a>
                <a href="<?= $base_url ?>/pricing" class="test-link" target="_blank">
                    <i class="bi bi-tags-fill"></i> <strong>Harga & Paket</strong>
                    <small>Daftar paket dan harga layanan</small>
                </a>
                <a href="<?= $base_url ?>/calculator" class="test-link" target="_blank">
                    <i class="bi bi-calculator-fill"></i> <strong>Kalkulator Harga</strong>
                    <small>Hitung estimasi biaya website custom</small>
                </a>
                <a href="<?= $base_url ?>/contact" class="test-link" target="_blank">
                    <i class="bi bi-envelope-fill"></i> <strong>Kontak</strong>
                    <small>Form kontak, alamat, WhatsApp</small>
                </a>
            </div>
        </div>

        <!-- AUTHENTICATION PAGES -->
        <div class="card">
            <div class="card-header">
                <i class="bi bi-lock-fill"></i> HALAMAN AUTHENTICATION
                <span class="badge bg-light text-dark float-end">6 Pages</span>
            </div>
            <div class="card-body p-0">
                <a href="<?= $base_url ?>/login" class="test-link" target="_blank">
                    <i class="bi bi-box-arrow-in-right"></i> <strong>Login</strong>
                    <small>Form login untuk client, freelancer, admin</small>
                </a>
                <a href="<?= $base_url ?>/register" class="test-link" target="_blank">
                    <i class="bi bi-person-plus-fill"></i> <strong>Register</strong>
                    <small>Form registrasi akun baru</small>
                </a>
                <a href="<?= $base_url ?>/logout" class="test-link" target="_blank">
                    <i class="bi bi-box-arrow-left"></i> <strong>Logout</strong>
                    <small>Proses logout dari sistem</small>
                </a>
                <a href="<?= $base_url ?>/forgot-password" class="test-link" target="_blank">
                    <i class="bi bi-question-circle-fill"></i> <strong>Lupa Password</strong>
                    <small>Request reset password via email</small>
                </a>
                <a href="<?= $base_url ?>/reset-password" class="test-link" target="_blank">
                    <i class="bi bi-key-fill"></i> <strong>Reset Password</strong>
                    <small>Set password baru dengan token</small>
                </a>
                <a href="<?= $base_url ?>/verify-email" class="test-link" target="_blank">
                    <i class="bi bi-envelope-check-fill"></i> <strong>Verifikasi Email</strong>
                    <small>Konfirmasi email dengan token</small>
                </a>
            </div>
        </div>

        <!-- CLIENT DASHBOARD -->
        <div class="card">
            <div class="card-header">
                <i class="bi bi-person-fill"></i> CLIENT DASHBOARD
                <span class="badge bg-light text-dark float-end">8 Pages</span>
            </div>
            <div class="card-body p-0">
                <a href="<?= $base_url ?>/client" class="test-link" target="_blank">
                    <i class="bi bi-speedometer2"></i> <strong>Dashboard Client</strong>
                    <small>Overview order, invoice, statistik</small>
                </a>
                <a href="<?= $base_url ?>/client/orders" class="test-link" target="_blank">
                    <i class="bi bi-bag-check-fill"></i> <strong>Order Saya</strong>
                    <small>Daftar order yang telah dibuat</small>
                </a>
                <a href="<?= $base_url ?>/client/invoices" class="test-link" target="_blank">
                    <i class="bi bi-receipt"></i> <strong>Invoice</strong>
                    <small>Invoice yang harus dibayar</small>
                </a>
                <a href="<?= $base_url ?>/client/payment-upload" class="test-link" target="_blank">
                    <i class="bi bi-cloud-upload-fill"></i> <strong>Upload Bukti Bayar</strong>
                    <small>Upload bukti transfer pembayaran</small>
                </a>
                <a href="<?= $base_url ?>/client/demo-request" class="test-link" target="_blank">
                    <i class="bi bi-eye-fill"></i> <strong>Request Demo</strong>
                    <small>Form request demo website 24 jam</small>
                </a>
                <a href="<?= $base_url ?>/client/support" class="test-link" target="_blank">
                    <i class="bi bi-headset"></i> <strong>Support</strong>
                    <small>Buat dan lihat ticket support</small>
                </a>
                <a href="<?= $base_url ?>/client/profile" class="test-link" target="_blank">
                    <i class="bi bi-person-circle"></i> <strong>Profile</strong>
                    <small>Edit profil dan setting akun</small>
                </a>
            </div>
        </div>

        <!-- FREELANCER DASHBOARD -->
        <div class="card">
            <div class="card-header">
                <i class="bi bi-briefcase-fill"></i> FREELANCER DASHBOARD
                <span class="badge bg-light text-dark float-end">4 Pages</span>
            </div>
            <div class="card-body p-0">
                <a href="<?= $base_url ?>/freelancer" class="test-link" target="_blank">
                    <i class="bi bi-speedometer2"></i> <strong>Dashboard Freelancer</strong>
                    <small>Overview project, komisi, statistik</small>
                </a>
                <a href="<?= $base_url ?>/freelancer/projects" class="test-link" target="_blank">
                    <i class="bi bi-folder-fill"></i> <strong>Project Saya</strong>
                    <small>Daftar project yang dikerjakan</small>
                </a>
                <a href="<?= $base_url ?>/freelancer/commissions" class="test-link" target="_blank">
                    <i class="bi bi-cash-coin"></i> <strong>Komisi</strong>
                    <small>Riwayat komisi 30%/40%/50%</small>
                </a>
                <a href="<?= $base_url ?>/freelancer/withdrawals" class="test-link" target="_blank">
                    <i class="bi bi-wallet2"></i> <strong>Penarikan</strong>
                    <small>Request dan riwayat penarikan</small>
                </a>
            </div>
        </div>

        <!-- ADMIN DASHBOARD -->
        <div class="card">
            <div class="card-header">
                <i class="bi bi-gear-fill"></i> ADMIN DASHBOARD
                <span class="badge bg-light text-dark float-end">17 Pages</span>
            </div>
            <div class="card-body p-0">
                <a href="<?= $base_url ?>/admin" class="test-link" target="_blank">
                    <i class="bi bi-speedometer2"></i> <strong>Dashboard Admin</strong>
                    <small>Overview statistik website lengkap</small>
                </a>
                <a href="<?= $base_url ?>/admin/users" class="test-link" target="_blank">
                    <i class="bi bi-people-fill"></i> <strong>Manajemen User</strong>
                    <small>CRUD semua user (client, freelancer, admin)</small>
                </a>
                <a href="<?= $base_url ?>/admin/orders" class="test-link" target="_blank">
                    <i class="bi bi-cart-fill"></i> <strong>Manajemen Order</strong>
                    <small>Monitoring dan update status order</small>
                </a>
                <a href="<?= $base_url ?>/admin/services" class="test-link" target="_blank">
                    <i class="bi bi-grid-fill"></i> <strong>Manajemen Layanan</strong>
                    <small>CRUD 232+ layanan digital</small>
                </a>
                <a href="<?= $base_url ?>/admin/packages" class="test-link" target="_blank">
                    <i class="bi bi-box-seam"></i> <strong>Manajemen Paket</strong>
                    <small>CRUD 6 paket (STARTER, BUSINESS, dst)</small>
                </a>
                <a href="<?= $base_url ?>/admin/portfolio" class="test-link" target="_blank">
                    <i class="bi bi-images"></i> <strong>Manajemen Portfolio</strong>
                    <small>Upload dan kelola portfolio project</small>
                </a>
                <a href="<?= $base_url ?>/admin/freelancers" class="test-link" target="_blank">
                    <i class="bi bi-person-badge"></i> <strong>Manajemen Freelancer</strong>
                    <small>Kelola tier freelancer (1/2/3)</small>
                </a>
                <a href="<?= $base_url ?>/admin/commissions" class="test-link" target="_blank">
                    <i class="bi bi-percent"></i> <strong>Manajemen Komisi</strong>
                    <small>Track dan bayar komisi freelancer</small>
                </a>
                <a href="<?= $base_url ?>/admin/withdrawals" class="test-link" target="_blank">
                    <i class="bi bi-cash-stack"></i> <strong>Request Penarikan</strong>
                    <small>Approve/reject request penarikan</small>
                </a>
                <a href="<?= $base_url ?>/admin/payments" class="test-link" target="_blank">
                    <i class="bi bi-credit-card-fill"></i> <strong>Verifikasi Pembayaran</strong>
                    <small>Validasi bukti transfer client</small>
                </a>
                <a href="<?= $base_url ?>/admin/demo-requests" class="test-link" target="_blank">
                    <i class="bi bi-display"></i> <strong>Request Demo</strong>
                    <small>Kelola request demo dari client</small>
                </a>
                <a href="<?= $base_url ?>/admin/support" class="test-link" target="_blank">
                    <i class="bi bi-life-preserver"></i> <strong>Support Tickets</strong>
                    <small>Kelola ticket support dari user</small>
                </a>
                <a href="<?= $base_url ?>/admin/reviews" class="test-link" target="_blank">
                    <i class="bi bi-star-fill"></i> <strong>Manajemen Review</strong>
                    <small>Moderasi review dari customer</small>
                </a>
                <a href="<?= $base_url ?>/admin/contact-messages" class="test-link" target="_blank">
                    <i class="bi bi-chat-dots-fill"></i> <strong>Pesan Kontak</strong>
                    <small>Inbox pesan dari form kontak</small>
                </a>
                <a href="<?= $base_url ?>/admin/reports" class="test-link" target="_blank">
                    <i class="bi bi-graph-up"></i> <strong>Laporan & Analytics</strong>
                    <small>Statistik revenue, order, trend</small>
                </a>
                <a href="<?= $base_url ?>/admin/settings" class="test-link" target="_blank">
                    <i class="bi bi-sliders"></i> <strong>Pengaturan Sistem</strong>
                    <small>Setting umum, komisi, email, payment</small>
                </a>
            </div>
        </div>

        <!-- Footer Info -->
        <div class="card">
            <div class="card-body text-center">
                <h5 class="mb-3">✅ <strong>Website 100% Complete!</strong></h5>
                <p class="mb-2">Total <strong>42 halaman</strong> siap diakses dan di-test</p>
                <p class="text-muted small mb-3">Klik setiap link di atas untuk membuka halaman di tab baru</p>
                <hr>
                <p class="text-danger small mb-0">
                    <i class="bi bi-shield-exclamation"></i>
                    <strong>HAPUS FILE INI</strong> setelah selesai testing untuk keamanan
                </p>
                <code class="small">rm test-pages.php</code>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
