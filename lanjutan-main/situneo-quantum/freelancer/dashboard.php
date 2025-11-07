<?php
/**
 * FREELANCER DASHBOARD - V2.0
 * Affiliate Marketing / Sales Agent Dashboard
 * Freelancers cari client & dapat komisi via referral
 */

$page_id = 'dashboard';
$pageTitle = 'Freelancer Dashboard - SITUNEO DIGITAL';
$pageDescription = 'Manage your referrals and track your commission';

include __DIR__ . '/../includes/freelancer-header.php';

// Demo data untuk freelancer (akan diganti dengan real data dari database)
$freelancer_stats = [
    'tier' => 'tier_2',
    'tier_name' => 'Tier 2',
    'commission_rate' => 40,
    'orders_this_month' => 18,
    'target_next_tier' => 25,
    'progress_percentage' => 72, // 18/25
    'total_referrals' => 42,
    'total_orders' => 156,
    'commission_this_month' => 7200000,
    'total_earnings' => 62400000,
    'available_balance' => 15400000,
    'pending_balance' => 2800000,
    'withdrawn_total' => 44200000,
];

$recent_referrals = [
    [
        'client_name' => 'Budi Santoso',
        'email' => 'budi@example.com',
        'phone' => '081234567890',
        'order' => 'Website UMKM',
        'status' => 'completed',
        'commission' => 750000,
        'date' => '2025-11-01',
    ],
    [
        'client_name' => 'Ani Lestari',
        'email' => 'ani@example.com',
        'phone' => '081345678901',
        'order' => 'Branding Paket',
        'status' => 'processing',
        'commission' => 1600000,
        'date' => '2025-11-03',
    ],
    [
        'client_name' => 'Toko Jaya',
        'email' => 'toko@example.com',
        'phone' => '082134567890',
        'order' => 'Toko Online',
        'status' => 'pending',
        'commission' => 2000000,
        'date' => '2025-11-05',
    ],
];

$user_referral_code = $current_user['referral_code'] ?? strtoupper(substr($current_user['name'], 0, 4)) . date('Y');
$referral_link = 'https://situneo.my.id/ref/' . $user_referral_code;

?>

<!-- Tier Progress Banner -->
<div class="card-premium mb-4" style="background: var(--gradient-gold); color: var(--dark-blue);">
    <div class="row align-items-center">
        <div class="col-lg-8">
            <div class="d-flex align-items-center mb-3">
                <i class="bi bi-trophy-fill me-2" style="font-size: 2.5rem;"></i>
                <div>
                    <h3 class="mb-0">Current Tier: <?= $freelancer_stats['tier_name'] ?></h3>
                    <p class="mb-0">Komisi: <strong><?= $freelancer_stats['commission_rate'] ?>%</strong> per order</p>
                </div>
            </div>

            <p class="mb-3">
                <strong><?= $freelancer_stats['orders_this_month'] ?> / <?= $freelancer_stats['target_next_tier'] ?> orders</strong> bulan ini
                - Butuh <strong><?= $freelancer_stats['target_next_tier'] - $freelancer_stats['orders_this_month'] ?> order lagi</strong> untuk naik ke Tier 3 (50% komisi)!
            </p>

            <div class="progress" style="height: 30px; background: rgba(10, 22, 40, 0.3);">
                <div class="progress-bar" style="width: <?= $freelancer_stats['progress_percentage'] ?>%; background: var(--dark-blue); font-weight: bold; font-size: 1rem;">
                    <?= $freelancer_stats['progress_percentage'] ?>%
                </div>
            </div>
        </div>
        <div class="col-lg-4 text-center">
            <i class="bi bi-graph-up-arrow" style="font-size: 8rem; opacity: 0.3;"></i>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-lg-3 col-md-6">
        <div class="stat-card bg-primary">
            <div class="stat-icon">
                <i class="bi bi-people-fill"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value"><?= $freelancer_stats['total_referrals'] ?></div>
                <div class="stat-label">Total Referrals</div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="stat-card bg-success">
            <div class="stat-icon">
                <i class="bi bi-bag-check-fill"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value"><?= $freelancer_stats['total_orders'] ?></div>
                <div class="stat-label">Total Orders (Lifetime)</div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="stat-card bg-warning">
            <div class="stat-icon">
                <i class="bi bi-calendar-month"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value"><?= formatRupiah($freelancer_stats['commission_this_month']) ?></div>
                <div class="stat-label">Komisi Bulan Ini</div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="stat-card" style="background: var(--gradient-gold); color: var(--dark-blue);">
            <div class="stat-icon" style="background: rgba(10, 22, 40, 0.2); color: var(--dark-blue);">
                <i class="bi bi-wallet2"></i>
            </div>
            <div class="stat-content">
                <div class="stat-value" style="color: var(--dark-blue);"><?= formatRupiah($freelancer_stats['available_balance']) ?></div>
                <div class="stat-label" style="color: var(--dark-blue); opacity: 0.8;">Saldo Tersedia</div>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="row g-4">
    <!-- Left: Recent Referrals & Quick Actions -->
    <div class="col-lg-8">
        <!-- Komisi Balance -->
        <div class="card-premium mb-4" style="background: linear-gradient(135deg, #198754 0%, #0d5132 100%);">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h5 class="text-white mb-3">
                        <i class="bi bi-wallet2 me-2"></i>
                        Saldo Komisi
                    </h5>
                    <div class="row g-3">
                        <div class="col-6">
                            <small class="text-white opacity-75">Available Balance</small>
                            <h4 class="text-white mb-0"><?= formatRupiah($freelancer_stats['available_balance']) ?></h4>
                        </div>
                        <div class="col-6">
                            <small class="text-white opacity-75">Pending Clearance</small>
                            <h4 class="text-warning mb-0"><?= formatRupiah($freelancer_stats['pending_balance']) ?></h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 text-center">
                    <a href="/freelancer/withdrawals" class="btn btn-light btn-lg">
                        <i class="bi bi-cash-coin me-2"></i>
                        Tarik Komisi
                    </a>
                </div>
            </div>
        </div>

        <!-- Recent Referrals -->
        <div class="card-premium">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="text-gold mb-0">
                    <i class="bi bi-person-hearts me-2"></i>
                    Recent Referrals
                </h5>
                <a href="/freelancer/referrals" class="btn btn-sm btn-outline-gold">
                    View All <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>

            <?php if (empty($recent_referrals)): ?>
            <div class="text-center py-5">
                <i class="bi bi-inbox display-4 text-muted mb-3"></i>
                <p class="text-light">Belum ada referral</p>
                <small class="text-muted">Share link referral Anda untuk mulai dapat komisi!</small>
            </div>
            <?php else: ?>
            <div class="table-responsive">
                <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                            <th>Client</th>
                            <th>Order</th>
                            <th>Status</th>
                            <th>Komisi</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recent_referrals as $ref): ?>
                        <tr>
                            <td>
                                <div>
                                    <strong class="text-light"><?= htmlspecialchars($ref['client_name']) ?></strong><br>
                                    <small class="text-muted"><?= htmlspecialchars($ref['email']) ?></small>
                                </div>
                            </td>
                            <td class="text-light"><?= htmlspecialchars($ref['order']) ?></td>
                            <td>
                                <?php
                                // PHP 7.4 compatible
                                if ($ref['status'] === 'completed') {
                                    $badge_class = 'success';
                                } elseif ($ref['status'] === 'processing') {
                                    $badge_class = 'info';
                                } elseif ($ref['status'] === 'pending') {
                                    $badge_class = 'warning';
                                } else {
                                    $badge_class = 'secondary';
                                }
                                ?>
                                <span class="badge bg-<?= $badge_class ?>"><?= ucfirst($ref['status']) ?></span>
                            </td>
                            <td class="text-gold fw-bold"><?= formatRupiah($ref['commission']) ?></td>
                            <td class="text-muted small"><?= date('d M Y', strtotime($ref['date'])) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Right: Referral Tools & Quick Links -->
    <div class="col-lg-4">
        <!-- Referral Link -->
        <div class="card-premium mb-4">
            <h6 class="text-gold mb-3">
                <i class="bi bi-link-45deg me-2"></i>
                Your Referral Link
            </h6>

            <div class="mb-3">
                <input type="text" class="form-control" id="referralLink" value="<?= $referral_link ?>" readonly>
            </div>

            <div class="d-grid gap-2">
                <button class="btn btn-gold btn-sm" onclick="copyReferralLink()">
                    <i class="bi bi-clipboard me-2"></i>
                    Copy Link
                </button>
                <a href="/freelancer/tools" class="btn btn-outline-gold btn-sm">
                    <i class="bi bi-qr-code me-2"></i>
                    Get QR Code & Materials
                </a>
            </div>

            <div class="mt-3 p-3" style="background: rgba(212, 175, 55, 0.1); border-radius: 8px; border-left: 3px solid var(--gold);">
                <small class="text-light">
                    <i class="bi bi-info-circle me-1"></i>
                    Share link ini ke calon client. Ketika mereka daftar & order, Anda dapat komisi otomatis!
                </small>
            </div>
        </div>

        <!-- Tier Info -->
        <div class="card-premium mb-4">
            <h6 class="text-gold mb-3">
                <i class="bi bi-trophy me-2"></i>
                Tier System
            </h6>

            <div class="tier-list">
                <div class="tier-item mb-2 p-3" style="background: rgba(108, 117, 125, 0.2); border-left: 3px solid #6c757d;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <strong class="text-light">Tier 1</strong><br>
                            <small class="text-muted">0-10 orders/bulan</small>
                        </div>
                        <span class="badge bg-secondary">30%</span>
                    </div>
                </div>

                <div class="tier-item mb-2 p-3" style="background: rgba(13, 202, 240, 0.2); border-left: 3px solid #0dcaf0;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <strong class="text-info">Tier 2</strong><br>
                            <small class="text-light">10-25 orders/bulan</small>
                        </div>
                        <span class="badge bg-info">40%</span>
                    </div>
                    <div class="mt-2">
                        <i class="bi bi-check-circle-fill text-success me-1"></i>
                        <small class="text-success">Your current tier</small>
                    </div>
                </div>

                <div class="tier-item mb-2 p-3" style="background: rgba(25, 135, 84, 0.2); border-left: 3px solid #198754;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <strong class="text-success">Tier 3</strong><br>
                            <small class="text-muted">25-50 orders/bulan</small>
                        </div>
                        <span class="badge bg-success">50%</span>
                    </div>
                </div>

                <div class="tier-item p-3" style="background: var(--gradient-gold); border-left: 3px solid var(--gold);">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <strong style="color: var(--dark-blue);">Tier MAX</strong><br>
                            <small style="color: var(--dark-blue); opacity: 0.8;">75+ orders/bulan</small>
                        </div>
                        <span class="badge bg-dark">55%</span>
                    </div>
                    <div class="mt-2">
                        <small style="color: var(--dark-blue);">
                            <i class="bi bi-star-fill me-1"></i>
                            Top Performer Bonus!
                        </small>
                    </div>
                </div>
            </div>

            <div class="mt-3">
                <a href="/freelancer/tier" class="text-gold small">
                    View Tier Details & History <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card-premium">
            <h6 class="text-gold mb-3">
                <i class="bi bi-lightning-fill me-2"></i>
                Quick Actions
            </h6>

            <div class="d-grid gap-2">
                <a href="/freelancer/demo-request" class="btn btn-gold btn-sm">
                    <i class="bi bi-file-earmark-text me-2"></i>
                    Request Demo untuk Client
                </a>
                <a href="/freelancer/services" class="btn btn-outline-gold btn-sm">
                    <i class="bi bi-grid-3x3-gap me-2"></i>
                    Katalog Layanan (232+)
                </a>
                <a href="/freelancer/analytics" class="btn btn-outline-info btn-sm">
                    <i class="bi bi-graph-up me-2"></i>
                    View Analytics
                </a>
                <a href="https://wa.me/6283173868915?text=Halo%20Admin%20SITUNEO%2C%20saya%20freelancer%20<?= urlencode($current_user['name']) ?>" target="_blank" class="btn btn-outline-success btn-sm">
                    <i class="bi bi-whatsapp me-2"></i>
                    Contact Admin
                </a>
            </div>
        </div>
    </div>
</div>

<script>
function copyReferralLink() {
    const linkInput = document.getElementById('referralLink');
    linkInput.select();
    linkInput.setSelectionRange(0, 99999); // For mobile devices

    navigator.clipboard.writeText(linkInput.value).then(() => {
        // Show success message
        const btn = event.target.closest('button');
        const originalHTML = btn.innerHTML;
        btn.innerHTML = '<i class="bi bi-check-circle me-2"></i>Copied!';
        btn.classList.add('btn-success');
        btn.classList.remove('btn-gold');

        setTimeout(() => {
            btn.innerHTML = originalHTML;
            btn.classList.remove('btn-success');
            btn.classList.add('btn-gold');
        }, 2000);
    }).catch(err => {
        alert('Failed to copy: ' + err);
    });
}
</script>

<style>
.stat-card {
    padding: 1.5rem;
    border-radius: 12px;
    color: white;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 1rem;
}

.stat-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(212, 175, 55, 0.3);
}

.stat-icon {
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
    background: rgba(255, 255, 255, 0.2);
    font-size: 1.8rem;
}

.stat-content {
    flex: 1;
}

.stat-value {
    font-size: 1.5rem;
    font-weight: 700;
    line-height: 1.2;
}

.stat-label {
    font-size: 0.875rem;
    opacity: 0.9;
    margin-top: 0.25rem;
}

.tier-item {
    border-radius: 8px;
    transition: all 0.3s ease;
}

.tier-item:hover {
    transform: translateX(3px);
}
</style>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
