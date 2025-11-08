<?php
$page_id = 'dashboard';
$pageTitle = 'Admin Dashboard - SITUNEO DIGITAL';
$pageDescription = 'Admin dashboard untuk mengelola website SITUNEO DIGITAL';
$pageHeading = 'Dashboard Overview';

// Include admin header
include __DIR__ . '/../includes/admin-header.php';

// Get statistics (DEMO MODE - static data)
if (DEMO_MODE) {
    $stats = [
        'total_users' => 523,
        'total_orders' => 187,
        'pending_payments' => 23,
        'total_revenue' => 487500000, // Rp 487.5 juta
        'active_freelancers' => 45,
        'pending_demos' => 12,
        'total_services' => 232,
        'total_portfolio' => 50,
    ];

    $recent_orders = [
        ['order_id' => 'ORD-2025-001', 'client' => 'John Doe', 'service' => 'Company Profile Website', 'amount' => 1500000, 'status' => 'pending', 'created_at' => '2025-01-10 14:30:00'],
        ['order_id' => 'ORD-2025-002', 'client' => 'Jane Smith', 'service' => 'E-Commerce Website', 'amount' => 2000000, 'status' => 'processing', 'created_at' => '2025-01-10 13:15:00'],
        ['order_id' => 'ORD-2025-003', 'client' => 'Budi Santoso', 'service' => 'SEO Optimization', 'amount' => 500000, 'status' => 'completed', 'created_at' => '2025-01-10 11:45:00'],
        ['order_id' => 'ORD-2025-004', 'client' => 'Sarah Wijaya', 'service' => 'Logo Design', 'amount' => 500000, 'status' => 'pending', 'created_at' => '2025-01-10 10:20:00'],
        ['order_id' => 'ORD-2025-005', 'client' => 'Ahmad Yani', 'service' => 'Google Ads Management', 'amount' => 1000000, 'status' => 'processing', 'created_at' => '2025-01-10 09:00:00'],
    ];

    $pending_payments = [
        ['payment_id' => 'PAY-001', 'client' => 'John Doe', 'order_id' => 'ORD-2025-001', 'amount' => 1500000, 'method' => 'Bank Transfer'],
        ['payment_id' => 'PAY-002', 'client' => 'Sarah Wijaya', 'order_id' => 'ORD-2025-004', 'amount' => 500000, 'method' => 'GoPay'],
        ['payment_id' => 'PAY-003', 'client' => 'David Lee', 'order_id' => 'ORD-2025-006', 'amount' => 3000000, 'method' => 'Bank Transfer'],
    ];

    $top_freelancers = [
        ['name' => 'Developer A', 'orders' => 45, 'revenue' => 45000000, 'tier' => 'tier_3'],
        ['name' => 'Developer B', 'orders' => 32, 'revenue' => 28000000, 'tier' => 'tier_3'],
        ['name' => 'Developer C', 'orders' => 18, 'revenue' => 15000000, 'tier' => 'tier_2'],
        ['name' => 'Developer D', 'orders' => 8, 'revenue' => 6500000, 'tier' => 'tier_1'],
    ];
} else {
    // Fetch real data from database
    $stats['total_users'] = db_fetch("SELECT COUNT(*) as count FROM users WHERE is_active = 1")['count'];
    $stats['total_orders'] = db_fetch("SELECT COUNT(*) as count FROM orders")['count'];
    $stats['pending_payments'] = db_fetch("SELECT COUNT(*) as count FROM payments WHERE status = 'pending'")['count'];
    $stats['total_revenue'] = db_fetch("SELECT SUM(amount) as total FROM orders WHERE status = 'completed'")['total'] ?? 0;
    // ... etc
}

?>

<!-- Stats Cards -->
<div class="row g-4 mb-4">
    <div class="col-lg-3 col-md-6">
        <div class="stat-card">
            <div class="d-flex align-items-center">
                <div class="stat-icon me-3">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div>
                    <div class="stat-value"><?= number_format($stats['total_users']) ?></div>
                    <div class="stat-label">Total Users</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="stat-card">
            <div class="d-flex align-items-center">
                <div class="stat-icon me-3">
                    <i class="bi bi-cart-check-fill"></i>
                </div>
                <div>
                    <div class="stat-value"><?= number_format($stats['total_orders']) ?></div>
                    <div class="stat-label">Total Orders</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="stat-card">
            <div class="d-flex align-items-center">
                <div class="stat-icon me-3">
                    <i class="bi bi-credit-card-fill"></i>
                </div>
                <div>
                    <div class="stat-value"><?= $stats['pending_payments'] ?></div>
                    <div class="stat-label">Pending Payments</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="stat-card">
            <div class="d-flex align-items-center">
                <div class="stat-icon me-3">
                    <i class="bi bi-cash-stack"></i>
                </div>
                <div>
                    <div class="stat-value"><?= formatRupiah($stats['total_revenue']) ?></div>
                    <div class="stat-label">Total Revenue</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Secondary Stats -->
<div class="row g-4 mb-4">
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <h6 class="text-gold">
                <i class="bi bi-person-badge me-2"></i>
                Active Freelancers
            </h6>
            <h3 class="text-light mb-0"><?= $stats['active_freelancers'] ?></h3>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <h6 class="text-gold">
                <i class="bi bi-rocket-takeoff me-2"></i>
                Pending Demos
            </h6>
            <h3 class="text-light mb-0"><?= $stats['pending_demos'] ?></h3>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <h6 class="text-gold">
                <i class="bi bi-grid me-2"></i>
                Total Services
            </h6>
            <h3 class="text-light mb-0"><?= $stats['total_services'] ?></h3>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <h6 class="text-gold">
                <i class="bi bi-image me-2"></i>
                Portfolio Items
            </h6>
            <h3 class="text-light mb-0"><?= $stats['total_portfolio'] ?></h3>
        </div>
    </div>
</div>

<!-- Recent Orders & Pending Payments -->
<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <div class="card-premium">
            <h5 class="text-gold mb-4">
                <i class="bi bi-clock-history me-2"></i>
                Recent Orders
            </h5>

            <div class="table-responsive">
                <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Client</th>
                            <th>Service</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($recent_orders as $order): ?>
                        <tr>
                            <td><code><?= $order['order_id'] ?></code></td>
                            <td><?= $order['client'] ?></td>
                            <td><?= $order['service'] ?></td>
                            <td><?= formatRupiah($order['amount']) ?></td>
                            <td>
                                <?php
                                // Status badge class (PHP 7.4 compatible)
                                if ($order['status'] === 'completed') {
                                    $badge_class = 'bg-success';
                                } elseif ($order['status'] === 'processing') {
                                    $badge_class = 'bg-warning';
                                } elseif ($order['status'] === 'pending') {
                                    $badge_class = 'bg-secondary';
                                } else {
                                    $badge_class = 'bg-secondary';
                                }
                                ?>
                                <span class="badge <?= $badge_class ?>"><?= ucfirst($order['status']) ?></span>
                            </td>
                            <td><?= timeAgo($order['created_at']) ?></td>
                            <td>
                                <a href="/admin/orders?id=<?= $order['order_id'] ?>" class="btn btn-sm btn-outline-gold">
                                    View
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <div class="text-end mt-3">
                <a href="/admin/orders" class="btn btn-gold">
                    View All Orders <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card-premium">
            <h5 class="text-gold mb-4">
                <i class="bi bi-exclamation-circle me-2"></i>
                Pending Payments
            </h5>

            <?php foreach ($pending_payments as $payment): ?>
            <div class="alert alert-warning mb-3">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <strong><?= $payment['client'] ?></strong>
                        <p class="mb-1 small"><?= $payment['order_id'] ?></p>
                        <p class="mb-0 small text-muted"><?= $payment['method'] ?></p>
                    </div>
                    <div class="text-end">
                        <div class="text-gold fw-bold"><?= formatRupiah($payment['amount']) ?></div>
                        <a href="/admin/payments?id=<?= $payment['payment_id'] ?>" class="btn btn-sm btn-warning mt-1">
                            Verify
                        </a>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

            <div class="text-end mt-3">
                <a href="/admin/payments" class="btn btn-gold w-100">
                    View All Payments
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Top Freelancers -->
<div class="row">
    <div class="col-12">
        <div class="card-premium">
            <h5 class="text-gold mb-4">
                <i class="bi bi-trophy me-2"></i>
                Top Performing Freelancers
            </h5>

            <div class="table-responsive">
                <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                            <th>Rank</th>
                            <th>Freelancer</th>
                            <th>Total Orders</th>
                            <th>Total Revenue</th>
                            <th>Tier</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $rank = 1;
                        foreach ($top_freelancers as $freelancer):
                            // Tier badge (PHP 7.4 compatible)
                            if ($freelancer['tier'] === 'tier_3') {
                                $tier_badge = '<span class="badge bg-success">Tier 3 (50%)</span>';
                            } elseif ($freelancer['tier'] === 'tier_2') {
                                $tier_badge = '<span class="badge bg-info">Tier 2 (40%)</span>';
                            } elseif ($freelancer['tier'] === 'tier_1') {
                                $tier_badge = '<span class="badge bg-secondary">Tier 1 (30%)</span>';
                            } else {
                                $tier_badge = '<span class="badge bg-secondary">New</span>';
                            }
                        ?>
                        <tr>
                            <td>
                                <?php if ($rank === 1): ?>
                                <i class="bi bi-trophy-fill text-warning"></i>
                                <?php elseif ($rank === 2): ?>
                                <i class="bi bi-trophy-fill text-muted"></i>
                                <?php elseif ($rank === 3): ?>
                                <i class="bi bi-trophy-fill" style="color: #CD7F32;"></i>
                                <?php else: ?>
                                <?= $rank ?>
                                <?php endif; ?>
                            </td>
                            <td><?= $freelancer['name'] ?></td>
                            <td><?= $freelancer['orders'] ?> orders</td>
                            <td><?= formatRupiah($freelancer['revenue']) ?></td>
                            <td><?= $tier_badge ?></td>
                            <td>
                                <a href="/admin/freelancers?id=<?= $rank ?>" class="btn btn-sm btn-outline-gold">
                                    View
                                </a>
                            </td>
                        </tr>
                        <?php
                        $rank++;
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
