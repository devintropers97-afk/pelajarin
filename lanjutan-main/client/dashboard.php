<?php
$page_id = 'dashboard';
$pageTitle = 'My Dashboard - SITUNEO DIGITAL';
$pageDescription = 'Client dashboard overview';

include __DIR__ . '/../includes/client-header.php';

$pageHeading = 'Welcome, ' . $current_user['full_name'] . '!';

// Demo data for client
$stats = [
    'active_orders' => 2,
    'pending_payments' => 1,
    'total_spent' => 3500000,
    'pending_demos' => 1,
];

$recent_orders = [
    ['order_id' => 'ORD-2025-001', 'service' => 'Company Profile Website', 'amount' => 1500000, 'status' => 'processing', 'progress' => 65, 'created_at' => '2025-01-10 14:30:00'],
    ['order_id' => 'ORD-2024-180', 'service' => 'SEO Optimization', 'amount' => 500000, 'status' => 'completed', 'progress' => 100, 'created_at' => '2024-12-20 10:00:00'],
];

$pending_invoices = [
    ['invoice_id' => 'INV-2025-001', 'order_id' => 'ORD-2025-006', 'amount' => 8000000, 'due_date' => '2025-01-15', 'status' => 'unpaid'],
];

?>

<!-- Welcome Card -->
<div class="card-premium mb-4">
    <div class="row align-items-center">
        <div class="col-lg-8">
            <h3 class="text-gold mb-3">
                <i class="bi bi-hand-thumbs-up me-2"></i>
                Selamat Datang di SITUNEO DIGITAL!
            </h3>
            <p class="text-light mb-3">
                Kelola semua project digital Anda di satu tempat. Request demo gratis, track order, dan upload payment dengan mudah.
            </p>
            <div class="d-flex gap-2 flex-wrap">
                <a href="/client/demo-request" class="btn btn-gold">
                    <i class="bi bi-rocket-takeoff me-2"></i>
                    Request Demo Gratis
                </a>
                <a href="/calculator" class="btn btn-outline-gold">
                    <i class="bi bi-calculator me-2"></i>
                    Hitung Harga
                </a>
                <a href="/portfolio" class="btn btn-outline-gold">
                    <i class="bi bi-eye me-2"></i>
                    Lihat Portfolio
                </a>
            </div>
        </div>
        <div class="col-lg-4 text-center">
            <img src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?w=300" alt="Welcome" class="img-fluid rounded-4" style="max-height: 200px;">
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-lg-3 col-md-6">
        <div class="stat-card">
            <div class="d-flex align-items-center">
                <div class="stat-icon me-3">
                    <i class="bi bi-cart-check-fill"></i>
                </div>
                <div>
                    <div class="stat-value"><?= $stats['active_orders'] ?></div>
                    <div class="stat-label">Active Orders</div>
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
                    <div class="stat-value"><?= formatRupiah($stats['total_spent']) ?></div>
                    <div class="stat-label">Total Spent</div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="stat-card">
            <div class="d-flex align-items-center">
                <div class="stat-icon me-3">
                    <i class="bi bi-rocket-takeoff-fill"></i>
                </div>
                <div>
                    <div class="stat-value"><?= $stats['pending_demos'] ?></div>
                    <div class="stat-label">Pending Demos</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Orders & Pending Invoices -->
<div class="row g-4">
    <!-- Recent Orders -->
    <div class="col-lg-8">
        <div class="card-premium">
            <h5 class="text-gold mb-4">
                <i class="bi bi-clock-history me-2"></i>
                My Recent Orders
            </h5>

            <?php if (empty($recent_orders)): ?>
            <div class="text-center py-5">
                <i class="bi bi-inbox display-4 text-muted mb-3"></i>
                <p class="text-light">Belum ada order</p>
                <a href="/calculator" class="btn btn-gold">
                    <i class="bi bi-calculator me-2"></i>
                    Mulai Order Sekarang
                </a>
            </div>
            <?php else: ?>
            <?php foreach ($recent_orders as $order): ?>
            <div class="card bg-dark mb-3 p-3">
                <div class="d-flex justify-content-between align-items-start mb-2">
                    <div>
                        <h6 class="text-light mb-1"><?= $order['service'] ?></h6>
                        <code class="text-muted"><?= $order['order_id'] ?></code>
                    </div>
                    <?php
                    // Status badge (PHP 7.4 compatible)
                    if ($order['status'] === 'completed') {
                        echo '<span class="badge bg-success">Completed</span>';
                    } elseif ($order['status'] === 'processing') {
                        echo '<span class="badge bg-info">Processing</span>';
                    } elseif ($order['status'] === 'pending') {
                        echo '<span class="badge bg-warning">Pending</span>';
                    } else {
                        echo '<span class="badge bg-secondary">Unknown</span>';
                    }
                    ?>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="text-muted small">
                        <i class="bi bi-calendar me-1"></i>
                        <?= timeAgo($order['created_at']) ?>
                    </span>
                    <span class="text-gold fw-bold"><?= formatRupiah($order['amount']) ?></span>
                </div>

                <!-- Progress Bar -->
                <div class="mb-2">
                    <div class="d-flex justify-content-between mb-1">
                        <small class="text-light">Progress</small>
                        <small class="text-gold"><?= $order['progress'] ?>%</small>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-gold" role="progressbar" style="width: <?= $order['progress'] ?>%"></div>
                    </div>
                </div>

                <a href="/client/orders?id=<?= $order['order_id'] ?>" class="btn btn-sm btn-outline-gold">
                    View Details <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
            <?php endforeach; ?>

            <div class="text-end mt-3">
                <a href="/client/orders" class="btn btn-gold">
                    View All Orders <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Sidebar: Pending Invoices & Quick Links -->
    <div class="col-lg-4">
        <!-- Pending Invoices -->
        <div class="card-premium mb-4">
            <h6 class="text-gold mb-3">
                <i class="bi bi-exclamation-circle me-2"></i>
                Pending Invoices
            </h6>

            <?php if (empty($pending_invoices)): ?>
            <p class="text-muted small">No pending invoices</p>
            <?php else: ?>
            <?php foreach ($pending_invoices as $invoice): ?>
            <div class="alert alert-warning mb-3">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <strong><?= $invoice['invoice_id'] ?></strong>
                        <p class="mb-1 small"><?= $invoice['order_id'] ?></p>
                        <p class="mb-0 small text-muted">Due: <?= date('d M Y', strtotime($invoice['due_date'])) ?></p>
                    </div>
                    <div class="text-end">
                        <div class="text-dark fw-bold"><?= formatRupiah($invoice['amount']) ?></div>
                    </div>
                </div>
                <a href="/client/payment-upload?invoice=<?= $invoice['invoice_id'] ?>" class="btn btn-sm btn-warning w-100 mt-2">
                    <i class="bi bi-upload me-2"></i>
                    Upload Payment
                </a>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Quick Links -->
        <div class="card-premium">
            <h6 class="text-gold mb-3">
                <i class="bi bi-lightning me-2"></i>
                Quick Actions
            </h6>

            <div class="d-grid gap-2">
                <a href="/client/demo-request" class="btn btn-outline-gold btn-sm">
                    <i class="bi bi-rocket-takeoff me-2"></i>
                    Request Demo
                </a>
                <a href="/calculator" class="btn btn-outline-gold btn-sm">
                    <i class="bi bi-calculator me-2"></i>
                    Price Calculator
                </a>
                <a href="/services" class="btn btn-outline-gold btn-sm">
                    <i class="bi bi-grid me-2"></i>
                    Browse Services
                </a>
                <a href="/contact" class="btn btn-outline-gold btn-sm">
                    <i class="bi bi-whatsapp me-2"></i>
                    Contact Support
                </a>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../includes/admin-footer.php'; // Reuse admin footer ?>
