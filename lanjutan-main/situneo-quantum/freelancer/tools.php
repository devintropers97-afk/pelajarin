<?php
/**
 * FREELANCER - REFERRAL TOOLS
 * Marketing materials & referral tools
 */

$page_id = 'tools';
$pageTitle = 'Referral Tools - SITUNEO DIGITAL';
include __DIR__ . '/../includes/freelancer-header.php';

$referral_code = $current_user['referral_code'] ?? 'DEMO2025';
$referral_link = 'https://situneo.my.id/ref/' . $referral_code;

$stats = [
    'clicks' => 342,
    'registrations' => 68,
    'orders' => 42,
    'conversion_rate' => 12.3,
];
?>

<div class="mb-4">
    <h2 class="text-gold mb-2">
        <i class="bi bi-tools me-2"></i>
        Referral Tools & Marketing Materials
    </h2>
</div>

<!-- Referral Link -->
<div class="card-premium mb-4">
    <h5 class="text-gold mb-4">
        <i class="bi bi-link-45deg me-2"></i>
        Your Unique Referral Link
    </h5>

    <div class="mb-4">
        <label class="form-label text-light">Referral Code</label>
        <div class="input-group">
            <input type="text" class="form-control" value="<?= $referral_code ?>" readonly>
            <button class="btn btn-gold" onclick="copyText('<?= $referral_code ?>')">
                <i class="bi bi-clipboard"></i> Copy
            </button>
        </div>
    </div>

    <div class="mb-4">
        <label class="form-label text-light">Full Referral Link</label>
        <div class="input-group">
            <input type="text" class="form-control" id="fullLink" value="<?= $referral_link ?>" readonly>
            <button class="btn btn-gold" onclick="copyFullLink()">
                <i class="bi bi-clipboard"></i> Copy
            </button>
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-3">
            <div class="stat-box">
                <div class="stat-value text-primary"><?= $stats['clicks'] ?></div>
                <div class="stat-label">Clicks</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-box">
                <div class="stat-value text-info"><?= $stats['registrations'] ?></div>
                <div class="stat-label">Registrations</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-box">
                <div class="stat-value text-success"><?= $stats['orders'] ?></div>
                <div class="stat-label">Orders</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-box">
                <div class="stat-value text-gold"><?= $stats['conversion_rate'] ?>%</div>
                <div class="stat-label">Conversion</div>
            </div>
        </div>
    </div>
</div>

<!-- QR Code -->
<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="card-premium text-center">
            <h5 class="text-gold mb-4">
                <i class="bi bi-qr-code me-2"></i>
                QR Code
            </h5>
            <div class="qr-placeholder mb-3" style="width: 250px; height: 250px; background: white; margin: 0 auto; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                <div style="color: #333; font-size: 0.875rem;">
                    <i class="bi bi-qr-code" style="font-size: 3rem;"></i><br>
                    QR Code<br><?= $referral_code ?>
                </div>
            </div>
            <div class="d-grid gap-2">
                <button class="btn btn-gold">
                    <i class="bi bi-download me-2"></i>
                    Download PNG
                </button>
                <button class="btn btn-outline-gold">
                    <i class="bi bi-download me-2"></i>
                    Download SVG
                </button>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card-premium">
            <h5 class="text-gold mb-4">
                <i class="bi bi-file-earmark-arrow-down me-2"></i>
                Marketing Materials
            </h5>

            <div class="list-group list-group-dark">
                <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-file-pdf text-danger me-3" style="font-size: 1.5rem;"></i>
                        <div class="flex-grow-1">
                            <strong>Price List PDF</strong><br>
                            <small class="text-muted">Daftar harga semua layanan</small>
                        </div>
                        <i class="bi bi-download"></i>
                    </div>
                </a>

                <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-file-image text-info me-3" style="font-size: 1.5rem;"></i>
                        <div class="flex-grow-1">
                            <strong>Brosur Digital</strong><br>
                            <small class="text-muted">Desain brosur untuk promosi</small>
                        </div>
                        <i class="bi bi-download"></i>
                    </div>
                </a>

                <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-instagram text-warning me-3" style="font-size: 1.5rem;"></i>
                        <div class="flex-grow-1">
                            <strong>IG Story Template</strong><br>
                            <small class="text-muted">Template untuk Instagram</small>
                        </div>
                        <i class="bi bi-download"></i>
                    </div>
                </a>

                <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-file-ppt text-danger me-3" style="font-size: 1.5rem;"></i>
                        <div class="flex-grow-1">
                            <strong>Presentation Deck</strong><br>
                            <small class="text-muted">PowerPoint untuk pitching</small>
                        </div>
                        <i class="bi bi-download"></i>
                    </div>
                </a>

                <a href="#" class="list-group-item list-group-item-action">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-whatsapp text-success me-3" style="font-size: 1.5rem;"></i>
                        <div class="flex-grow-1">
                            <strong>WhatsApp Template</strong><br>
                            <small class="text-muted">Template pesan untuk WA blast</small>
                        </div>
                        <button class="btn btn-sm btn-success" onclick="alert('Template copied!')">Copy</button>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function copyText(text) {
    navigator.clipboard.writeText(text).then(() => {
        alert('Copied: ' + text);
    });
}

function copyFullLink() {
    const input = document.getElementById('fullLink');
    input.select();
    navigator.clipboard.writeText(input.value).then(() => {
        alert('Link berhasil dicopy!');
    });
}
</script>

<style>
.stat-box { background: rgba(212, 175, 55, 0.1); border-radius: 10px; padding: 1rem; text-align: center; }
.stat-value { font-size: 1.5rem; font-weight: bold; margin-bottom: 0.25rem; }
.stat-label { font-size: 0.875rem; color: var(--text-light); }
.list-group-dark .list-group-item { background: rgba(212, 175, 55, 0.05); border: 1px solid rgba(212, 175, 55, 0.1); color: var(--text-light); margin-bottom: 0.5rem; border-radius: 8px; }
.list-group-dark .list-group-item:hover { background: rgba(212, 175, 55, 0.1); }
</style>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
