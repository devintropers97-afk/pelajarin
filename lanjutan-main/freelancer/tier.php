<?php
/**
 * FREELANCER - TIER & KOMISI
 * Track tier level, progress, dan history
 */

$page_id = 'tier';
$pageTitle = 'Tier & Komisi - SITUNEO DIGITAL';
include __DIR__ . '/../includes/freelancer-header.php';

$current_tier = [
    'level' => 'tier_2',
    'name' => 'Tier 2',
    'rate' => 40,
    'orders_this_month' => 18,
    'target' => 25,
    'progress' => 72,
];

$tier_history = [
    ['month' => 'Nov 2025', 'tier' => 'tier_2', 'orders' => 18, 'status' => 'On Track'],
    ['month' => 'Okt 2025', 'tier' => 'tier_2', 'orders' => 22, 'status' => 'Achieved'],
    ['month' => 'Sep 2025', 'tier' => 'tier_1', 'orders' => 12, 'status' => 'Promoted'],
];
?>

<div class="mb-4">
    <h2 class="text-gold mb-2">
        <i class="bi bi-trophy me-2"></i>
        Tier & Komisi System
    </h2>
</div>

<!-- Current Tier -->
<div class="card-premium mb-4" style="background: var(--gradient-gold); color: var(--dark-blue);">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h3 class="mb-3">Current: <?= $current_tier['name'] ?> (<?= $current_tier['rate'] ?>%)</h3>
            <p class="mb-3">Progress bulan ini: <strong><?= $current_tier['orders_this_month'] ?> / <?= $current_tier['target'] ?> orders</strong></p>
            <div class="progress" style="height: 30px; background: rgba(10, 22, 40, 0.3);">
                <div class="progress-bar" style="width: <?= $current_tier['progress'] ?>%; background: var(--dark-blue); font-weight: bold;">
                    <?= $current_tier['progress'] ?>%
                </div>
            </div>
            <p class="mt-2 mb-0"><small>Butuh <?= $current_tier['target'] - $current_tier['orders_this_month'] ?> order lagi untuk Tier 3!</small></p>
        </div>
        <div class="col-md-4 text-center">
            <i class="bi bi-trophy-fill" style="font-size: 6rem; opacity: 0.3;"></i>
        </div>
    </div>
</div>

<!-- Tier Explanation -->
<div class="row g-4 mb-4">
    <div class="col-md-6 col-lg-3">
        <div class="card-premium h-100" style="border: 2px solid #6c757d;">
            <div class="text-center mb-3">
                <div class="tier-badge bg-secondary">TIER 1</div>
                <h4 class="text-light mt-2">30%</h4>
            </div>
            <ul class="list-unstyled small text-light">
                <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>0-10 orders/bulan</li>
                <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Komisi 30%</li>
                <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Marketing materials</li>
            </ul>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card-premium h-100" style="border: 2px solid #0dcaf0;">
            <div class="text-center mb-3">
                <div class="tier-badge bg-info">TIER 2</div>
                <h4 class="text-light mt-2">40%</h4>
                <span class="badge bg-success">Your Tier</span>
            </div>
            <ul class="list-unstyled small text-light">
                <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>10-25 orders/bulan</li>
                <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Komisi 40%</li>
                <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Priority support</li>
            </ul>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card-premium h-100" style="border: 2px solid #198754;">
            <div class="text-center mb-3">
                <div class="tier-badge bg-success">TIER 3</div>
                <h4 class="text-light mt-2">50%</h4>
            </div>
            <ul class="list-unstyled small text-light">
                <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>25-50 orders/bulan</li>
                <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>Komisi 50%</li>
                <li class="mb-2"><i class="bi bi-check-circle text-success me-2"></i>VIP support</li>
            </ul>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card-premium h-100" style="border: 2px solid var(--gold); background: var(--gradient-gold); color: var(--dark-blue);">
            <div class="text-center mb-3">
                <div class="tier-badge" style="background: var(--dark-blue); color: var(--gold);">TIER MAX</div>
                <h4 class="mt-2">55%</h4>
            </div>
            <ul class="list-unstyled small">
                <li class="mb-2"><i class="bi bi-star-fill me-2"></i>75+ orders/bulan</li>
                <li class="mb-2"><i class="bi bi-star-fill me-2"></i>Komisi 55%</li>
                <li class="mb-2"><i class="bi bi-star-fill me-2"></i>Exclusive bonus</li>
            </ul>
        </div>
    </div>
</div>

<!-- Tier History -->
<div class="card-premium">
    <h5 class="text-gold mb-4">Tier History</h5>
    <div class="table-responsive">
        <table class="table table-dark">
            <thead>
                <tr>
                    <th>Bulan</th>
                    <th>Tier</th>
                    <th>Orders</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tier_history as $history): ?>
                <tr>
                    <td><?= $history['month'] ?></td>
                    <td><span class="badge bg-info"><?= ucfirst($history['tier']) ?></span></td>
                    <td><?= $history['orders'] ?> orders</td>
                    <td><span class="badge bg-success"><?= $history['status'] ?></span></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<style>
.tier-badge { display: inline-block; padding: 0.5rem 1rem; border-radius: 50px; font-weight: bold; font-size: 0.875rem; }
</style>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
