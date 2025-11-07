<?php
/**
 * FREELANCER - REQUEST DEMO FOR CLIENT
 * Form untuk bantu client request demo website
 */

$page_id = 'demo-request';
$pageTitle = 'Request Demo for Client - SITUNEO DIGITAL';
$pageDescription = 'Help your client request a free demo website';

include __DIR__ . '/../includes/freelancer-header.php';

// Handle form submission
$success = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // TODO: Save to database with freelancer_id and referral_code
    $success = true;
}

?>

<!-- Page Header -->
<div class="mb-4">
    <h2 class="text-gold mb-2">
        <i class="bi bi-file-earmark-text me-2"></i>
        Request Demo untuk Client
    </h2>
    <p class="text-muted mb-0">Bantu client Anda request demo website gratis. Jika jadi order, komisi otomatis masuk ke Anda!</p>
</div>

<?php if ($success): ?>
<div class="alert alert-success alert-dismissible fade show">
    <i class="bi bi-check-circle-fill me-2"></i>
    <strong>Demo request berhasil dikirim!</strong> Admin akan follow-up client dalam 24 jam. Jika jadi order, komisi akan masuk ke akun Anda.
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<?php if ($error): ?>
<div class="alert alert-danger alert-dismissible fade show">
    <i class="bi bi-exclamation-triangle-fill me-2"></i>
    <?= $error ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
<?php endif; ?>

<div class="row">
    <div class="col-lg-8">
        <div class="card-premium">
            <form method="POST" action="/freelancer/demo-request" id="demoRequestForm">
                <input type="hidden" name="csrf_token" value="<?= generateCSRFToken() ?>">
                <input type="hidden" name="freelancer_id" value="<?= $current_user['id'] ?>">
                <input type="hidden" name="referral_code" value="<?= $current_user['referral_code'] ?>">

                <h5 class="text-gold mb-4">
                    <i class="bi bi-person me-2"></i>
                    Data Client
                </h5>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Nama Lengkap Client *</label>
                        <input type="text" class="form-control" name="client_name" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email Client *</label>
                        <input type="email" class="form-control" name="client_email" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">WhatsApp Client *</label>
                        <input type="tel" class="form-control" name="client_whatsapp" placeholder="08123456789" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Nama Usaha/Project *</label>
                        <input type="text" class="form-control" name="business_name" required>
                    </div>
                </div>

                <h5 class="text-gold mb-4 mt-5">
                    <i class="bi bi-briefcase me-2"></i>
                    Kebutuhan Website
                </h5>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Jenis Layanan yang Diminati *</label>
                        <select class="form-control" name="service_type" required>
                            <option value="">Pilih Layanan...</option>
                            <option value="Website Company Profile">Website Company Profile</option>
                            <option value="Website UMKM">Website UMKM</option>
                            <option value="Toko Online">Toko Online / E-Commerce</option>
                            <option value="Landing Page">Landing Page</option>
                            <option value="Website Sekolah">Website Sekolah</option>
                            <option value="Website Portfolio">Website Portfolio</option>
                            <option value="Branding Paket">Branding Paket</option>
                            <option value="Digital Marketing">Digital Marketing</option>
                            <option value="Custom">Custom (Lainnya)</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Budget Range *</label>
                        <select class="form-control" name="budget_range" required>
                            <option value="">Pilih Budget...</option>
                            <option value="< Rp 5jt">< Rp 5 juta</option>
                            <option value="Rp 5jt - 10jt">Rp 5 - 10 juta</option>
                            <option value="Rp 10jt - 20jt">Rp 10 - 20 juta</option>
                            <option value="> Rp 20jt">> Rp 20 juta</option>
                            <option value="Belum tahu">Belum tahu</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Deskripsi Kebutuhan</label>
                        <textarea class="form-control" name="requirements" rows="4" placeholder="Ceritakan kebutuhan client Anda... (optional)"></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Website Referensi (jika ada)</label>
                        <input type="url" class="form-control" name="reference_url" placeholder="https://...">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Timeline yang Diharapkan</label>
                        <select class="form-control" name="timeline">
                            <option value="">Pilih Timeline...</option>
                            <option value="Segera (< 1 minggu)">Segera (< 1 minggu)</option>
                            <option value="1-2 minggu">1-2 minggu</option>
                            <option value="2-4 minggu">2-4 minggu</option>
                            <option value="Flexible">Flexible</option>
                        </select>
                    </div>
                </div>

                <h5 class="text-gold mb-4 mt-5">
                    <i class="bi bi-chat-dots me-2"></i>
                    Catatan Tambahan
                </h5>

                <div class="mb-4">
                    <label class="form-label">Notes (Internal - hanya untuk Anda & Admin)</label>
                    <textarea class="form-control" name="freelancer_notes" rows="3" placeholder="Catatan khusus tentang client ini..."></textarea>
                </div>

                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>
                    <strong>Info:</strong> Referral code Anda (<code><?= $current_user['referral_code'] ?></code>) otomatis terintegrasi. Jika client jadi order, komisi langsung masuk ke akun Anda!
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-gold btn-lg">
                        <i class="bi bi-send me-2"></i>
                        Submit Demo Request
                    </button>
                    <a href="/freelancer/referrals" class="btn btn-outline-secondary btn-lg">
                        <i class="bi bi-x-circle me-2"></i>
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Sidebar Tips -->
    <div class="col-lg-4">
        <div class="card-premium mb-4">
            <h6 class="text-gold mb-3">
                <i class="bi bi-lightbulb me-2"></i>
                Tips Mendapatkan Order
            </h6>
            <ul class="list-unstyled text-light small">
                <li class="mb-3">
                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                    <strong>Jelaskan Value:</strong> Fokus ke manfaat website untuk bisnis client
                </li>
                <li class="mb-3">
                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                    <strong>Tunjukkan Portfolio:</strong> Share portfolio Situneo yang relevan
                </li>
                <li class="mb-3">
                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                    <strong>Demo Gratis:</strong> Tekankan client dapat demo website gratis 24 jam
                </li>
                <li class="mb-3">
                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                    <strong>Follow-up Cepat:</strong> Admin akan follow-up maksimal 24 jam
                </li>
                <li>
                    <i class="bi bi-check-circle-fill text-success me-2"></i>
                    <strong>Komisi Besar:</strong> Anda dapat 30%-55% tergantung tier
                </li>
            </ul>
        </div>

        <div class="card-premium" style="background: var(--gradient-gold); color: var(--dark-blue);">
            <h6 class="mb-3" style="color: var(--dark-blue);">
                <i class="bi bi-calculator me-2"></i>
                Estimasi Komisi
            </h6>
            <div class="mb-3">
                <small style="opacity: 0.8;">Jika client order Website UMKM (Rp 5jt)</small>
                <h4 class="mb-0" style="color: var(--dark-blue);">
                    Komisi Anda: Rp 2jt (40%)
                </h4>
            </div>
            <div class="mb-3">
                <small style="opacity: 0.8;">Jika client order Toko Online (Rp 10jt)</small>
                <h4 class="mb-0" style="color: var(--dark-blue);">
                    Komisi Anda: Rp 4jt (40%)
                </h4>
            </div>
            <small style="opacity: 0.8;">
                <i class="bi bi-star-fill me-1"></i>
                Naik ke Tier 3 untuk dapat 50% komisi!
            </small>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
