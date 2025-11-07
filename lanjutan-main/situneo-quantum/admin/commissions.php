<?php
$page_id = 'commissions';
$pageTitle = 'Commissions Management - SITUNEO DIGITAL';
$pageDescription = 'Manage freelancer commissions';
$pageHeading = 'Commissions Management';

include __DIR__ . '/../includes/admin-header.php';

// Demo data
if (DEMO_MODE) {
    $commissions = [
        ['id' => 1, 'commission_id' => 'COM-2025-015', 'freelancer' => 'Developer Pro', 'order_id' => 'ORD-2025-012', 'service' => 'Landing Page Design', 'order_amount' => 800000, 'tier' => 2, 'rate' => 40, 'commission' => 320000, 'status' => 'pending', 'date' => '2025-01-14'],
        ['id' => 2, 'commission_id' => 'COM-2025-012', 'freelancer' => 'Design Expert', 'order_id' => 'ORD-2025-008', 'service' => 'E-Commerce Website', 'order_amount' => 5500000, 'tier' => 3, 'rate' => 50, 'commission' => 2750000, 'status' => 'paid', 'date' => '2025-01-18'],
        ['id' => 3, 'commission_id' => 'COM-2025-010', 'freelancer' => 'SEO Specialist', 'order_id' => 'ORD-2025-005', 'service' => 'SEO Optimization', 'order_amount' => 500000, 'tier' => 2, 'rate' => 40, 'commission' => 200000, 'status' => 'paid', 'date' => '2025-01-15'],
        ['id' => 4, 'commission_id' => 'COM-2025-008', 'freelancer' => 'Developer Pro', 'order_id' => 'ORD-2025-003', 'service' => 'Mobile App UI', 'order_amount' => 4000000, 'tier' => 2, 'rate' => 40, 'commission' => 1600000, 'status' => 'paid', 'date' => '2025-01-14'],
        ['id' => 5, 'commission_id' => 'COM-2025-018', 'freelancer' => 'Developer Pro', 'order_id' => 'ORD-2025-001', 'service' => 'Company Profile', 'order_amount' => 1500000, 'tier' => 2, 'rate' => 40, 'commission' => 600000, 'status' => 'pending', 'date' => '2025-01-20'],
    ];
}

// Stats
$total_commissions = array_sum(array_map(fn($c) => $c['commission'], $commissions));
$pending_commissions = array_sum(array_map(fn($c) => $c['status'] === 'pending' ? $c['commission'] : 0, $commissions));
$paid_commissions = array_sum(array_map(fn($c) => $c['status'] === 'paid' ? $c['commission'] : 0, $commissions));
$pending_count = count(array_filter($commissions, fn($c) => $c['status'] === 'pending'));

?>

<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">Total Commissions</h6>
            <h4 class="text-gold mb-0"><?= formatRupiah($total_commissions) ?></h4>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">Pending</h6>
            <h4 class="text-warning mb-1"><?= formatRupiah($pending_commissions) ?></h4>
            <small class="text-muted"><?= $pending_count ?> commissions</small>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">Paid</h6>
            <h4 class="text-success mb-0"><?= formatRupiah($paid_commissions) ?></h4>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">This Month</h6>
            <h4 class="text-info mb-0"><?= formatRupiah($total_commissions) ?></h4>
        </div>
    </div>
</div>

<!-- Tier Info -->
<div class="card-premium mb-4" style="background: var(--gradient-gold); color: var(--dark-blue);">
    <h5 class="mb-3">
        <i class="bi bi-trophy-fill me-2"></i>
        Commission Tier System
    </h5>
    <div class="row g-3">
        <div class="col-md-4">
            <div class="card bg-white bg-opacity-25 p-3 text-center">
                <i class="bi bi-trophy fs-2 mb-2"></i>
                <h6 class="mb-1">STARTER TIER</h6>
                <h4 class="mb-2">30%</h4>
                <small>0-10 orders/month</small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-white bg-opacity-50 p-3 text-center">
                <i class="bi bi-trophy-fill fs-2 mb-2"></i>
                <h6 class="mb-1">PRO TIER</h6>
                <h4 class="mb-2">40%</h4>
                <small>10-50 orders/month</small>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-white bg-opacity-75 p-3 text-center">
                <i class="bi bi-trophy-fill fs-2 mb-2"></i>
                <h6 class="mb-1">EXPERT TIER</h6>
                <h4 class="mb-2">50% + 5% Bonus</h4>
                <small>50+ orders/month</small>
            </div>
        </div>
    </div>
</div>

<!-- Commissions Table -->
<div class="card-premium">
    <h5 class="text-gold mb-4">
        <i class="bi bi-list-ul me-2"></i>
        Commission Records
    </h5>

    <div class="table-responsive">
        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <th>Commission ID</th>
                    <th>Freelancer</th>
                    <th>Order</th>
                    <th>Service</th>
                    <th>Order Amount</th>
                    <th>Tier</th>
                    <th>Rate</th>
                    <th>Commission</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($commissions as $commission): ?>
                <tr>
                    <td><code class="text-gold"><?= $commission['commission_id'] ?></code></td>
                    <td class="text-light"><?= htmlspecialchars($commission['freelancer']) ?></td>
                    <td><code><?= $commission['order_id'] ?></code></td>
                    <td class="text-light"><?= htmlspecialchars($commission['service']) ?></td>
                    <td class="text-light"><?= formatRupiah($commission['order_amount']) ?></td>
                    <td>
                        <?php
                        $tier_badge = match($commission['tier']) {
                            1 => '<span class="badge bg-secondary">Tier 1</span>',
                            2 => '<span class="badge bg-info">Tier 2</span>',
                            3 => '<span class="badge bg-success">Tier 3</span>',
                        };
                        echo $tier_badge;
                        ?>
                    </td>
                    <td class="text-warning"><?= $commission['rate'] ?>%</td>
                    <td class="text-gold fw-bold"><?= formatRupiah($commission['commission']) ?></td>
                    <td>
                        <?= $commission['status'] === 'paid' ?
                            '<span class="badge bg-success">Paid</span>' :
                            '<span class="badge bg-warning">Pending</span>' ?>
                    </td>
                    <td class="text-muted small"><?= date('d M Y', strtotime($commission['date'])) ?></td>
                    <td>
                        <?php if ($commission['status'] === 'pending'): ?>
                        <button class="btn btn-success btn-sm" onclick="markPaid(<?= $commission['id'] ?>, '<?= $commission['commission_id'] ?>')">
                            <i class="bi bi-check-circle"></i> Pay
                        </button>
                        <?php else: ?>
                        <span class="text-success">
                            <i class="bi bi-check-circle-fill"></i>
                        </span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot class="table-gold">
                <tr>
                    <th colspan="7" class="text-end">TOTAL:</th>
                    <th><?= formatRupiah($total_commissions) ?></th>
                    <th colspan="3"></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<!-- Summary by Freelancer -->
<div class="card-premium mt-4">
    <h5 class="text-gold mb-4">
        <i class="bi bi-pie-chart me-2"></i>
        Summary by Freelancer
    </h5>

    <div class="table-responsive">
        <table class="table table-dark">
            <thead>
                <tr>
                    <th>Freelancer</th>
                    <th>Total Commissions</th>
                    <th>Pending</th>
                    <th>Paid</th>
                    <th>Orders Count</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="text-light">Developer Pro</td>
                    <td class="text-gold fw-bold">Rp 2.520.000</td>
                    <td class="text-warning">Rp 920.000</td>
                    <td class="text-success">Rp 1.600.000</td>
                    <td class="text-muted">3 orders</td>
                </tr>
                <tr>
                    <td class="text-light">Design Expert</td>
                    <td class="text-gold fw-bold">Rp 2.750.000</td>
                    <td class="text-warning">Rp 0</td>
                    <td class="text-success">Rp 2.750.000</td>
                    <td class="text-muted">1 order</td>
                </tr>
                <tr>
                    <td class="text-light">SEO Specialist</td>
                    <td class="text-gold fw-bold">Rp 200.000</td>
                    <td class="text-warning">Rp 0</td>
                    <td class="text-success">Rp 200.000</td>
                    <td class="text-muted">1 order</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
function markPaid(id, commissionId) {
    if (confirm(`Mark commission ${commissionId} as paid?\n\nThis will add the amount to freelancer's balance.`)) {
        alert(`Commission ${commissionId} marked as paid!`);
        location.reload();
    }
}
</script>

<style>
.table-gold {
    background: var(--gradient-gold);
    color: var(--dark-blue);
}

.table-gold th {
    color: var(--dark-blue);
    font-weight: 700;
}
</style>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
