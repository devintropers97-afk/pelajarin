<?php
/**
 * FREELANCER - ANALYTICS
 * Performance tracking & reports
 */

$page_id = 'analytics';
$pageTitle = 'Analytics & Reports - SITUNEO DIGITAL';
include __DIR__ . '/../includes/freelancer-header.php';

$performance = [
    'orders_this_month' => 18,
    'orders_last_month' => 22,
    'commission_this_month' => 7200000,
    'commission_last_month' => 8800000,
    'new_clients' => 6,
    'conversion_rate' => 11,
];

$top_services = [
    ['name' => 'Website UMKM', 'orders' => 8, 'commission' => 3200000],
    ['name' => 'Toko Online', 'orders' => 4, 'commission' => 2400000],
    ['name' => 'Branding Paket', 'orders' => 3, 'commission' => 1200000],
];

$client_sources = [
    ['source' => 'Instagram', 'percentage' => 45],
    ['source' => 'WhatsApp', 'percentage' => 30],
    ['source' => 'Facebook', 'percentage' => 15],
    ['source' => 'Referral', 'percentage' => 10],
];
?>

<div class="mb-4">
    <h2 class="text-gold mb-2">
        <i class="bi bi-graph-up me-2"></i>
        Analytics & Performance
    </h2>
</div>

<!-- Performance Comparison -->
<div class="card-premium mb-4">
    <h5 class="text-gold mb-4">Performance Overview (Bulan Ini vs Bulan Lalu)</h5>

    <div class="row g-4">
        <div class="col-md-3">
            <div class="metric-card">
                <div class="metric-label">Orders</div>
                <div class="metric-value"><?= $performance['orders_this_month'] ?></div>
                <div class="metric-comparison">
                    vs <?= $performance['orders_last_month'] ?>
                    <span class="badge bg-danger ms-2">-18%</span>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="metric-card">
                <div class="metric-label">Komisi</div>
                <div class="metric-value"><?= formatRupiah($performance['commission_this_month']) ?></div>
                <div class="metric-comparison">
                    vs <?= formatRupiah($performance['commission_last_month']) ?>
                    <span class="badge bg-danger ms-2">-18%</span>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="metric-card">
                <div class="metric-label">New Clients</div>
                <div class="metric-value"><?= $performance['new_clients'] ?></div>
                <div class="metric-comparison">
                    vs 8
                    <span class="badge bg-danger ms-2">-25%</span>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="metric-card">
                <div class="metric-label">Conversion Rate</div>
                <div class="metric-value"><?= $performance['conversion_rate'] ?>%</div>
                <div class="metric-comparison">
                    vs 13%
                    <span class="badge bg-danger ms-2">-15%</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4 mb-4">
    <!-- Top Services -->
    <div class="col-md-6">
        <div class="card-premium">
            <h5 class="text-gold mb-4">
                <i class="bi bi-trophy me-2"></i>
                Top Performing Services
            </h5>

            <?php foreach ($top_services as $service): ?>
            <div class="service-stat mb-3 p-3" style="background: rgba(212, 175, 55, 0.05); border-radius: 8px;">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <strong class="text-light"><?= $service['name'] ?></strong>
                    <span class="badge bg-info"><?= $service['orders'] ?> orders</span>
                </div>
                <div class="text-gold fw-bold"><?= formatRupiah($service['commission']) ?></div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Client Sources -->
    <div class="col-md-6">
        <div class="card-premium">
            <h5 class="text-gold mb-4">
                <i class="bi bi-pie-chart me-2"></i>
                Client Source Distribution
            </h5>

            <?php foreach ($client_sources as $source): ?>
            <div class="mb-3">
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-light"><?= $source['source'] ?></span>
                    <span class="text-gold"><?= $source['percentage'] ?>%</span>
                </div>
                <div class="progress" style="height: 10px;">
                    <div class="progress-bar bg-gold" style="width: <?= $source['percentage'] ?>%"></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<!-- Monthly Trend -->
<div class="card-premium">
    <h5 class="text-gold mb-4">
        <i class="bi bi-graph-up-arrow me-2"></i>
        Monthly Trend (6 Bulan Terakhir)
    </h5>

    <div class="chart-placeholder" style="height: 300px; background: rgba(212, 175, 55, 0.05); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
        <div class="text-center text-muted">
            <i class="bi bi-graph-up-arrow" style="font-size: 3rem;"></i><br>
            <small>Chart will be rendered here<br>(Orders & Commission per Month)</small>
        </div>
    </div>
</div>

<style>
.metric-card { background: rgba(212, 175, 55, 0.1); border-radius: 10px; padding: 1.5rem; text-align: center; }
.metric-label { font-size: 0.875rem; color: var(--text-light); margin-bottom: 0.5rem; }
.metric-value { font-size: 1.75rem; font-weight: bold; color: var(--gold); margin-bottom: 0.5rem; }
.metric-comparison { font-size: 0.875rem; color: var(--text-light); }
</style>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
