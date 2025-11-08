<?php
/**
 * Client Dashboard
 */
defined('SITUNEO_ACCESS') or die('Direct access not permitted');

Auth::requireRole('client');

$client = Auth::user();
$db = Database::getInstance();

// Get client stats
$stats = [
    'total_orders' => $db->query("SELECT COUNT(*) as count FROM orders WHERE user_id = :id", ['id' => $client['id']])->fetch()['count'] ?? 0,
    'active_projects' => $db->query("SELECT COUNT(*) as count FROM orders WHERE user_id = :id AND status IN ('processing', 'in_progress')", ['id' => $client['id']])->fetch()['count'] ?? 0,
    'total_spent' => $db->query("SELECT SUM(total_amount) as total FROM orders WHERE user_id = :id AND payment_status = 'paid'", ['id' => $client['id']])->fetch()['total'] ?? 0,
];

// Recent orders
$recent_orders = $db->query("
    SELECT o.*, s.name as service_name
    FROM orders o
    LEFT JOIN services s ON o.service_id = s.id
    WHERE o.user_id = :id
    ORDER BY o.created_at DESC
    LIMIT 5
", ['id' => $client['id']])->fetchAll();

$page_title = 'Client Dashboard - SITUNEO DIGITAL';
include ADMIN_PATH . 'includes/admin-header.php';
?>

<div class="dashboard-container">
    <div class="dashboard-header">
        <div>
            <h1>Welcome, <?= htmlspecialchars($client['name']) ?>!</h1>
            <p class="text-muted">Client Dashboard</p>
        </div>
        <div class="header-actions">
            <a href="<?= url('services') ?>" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Order New Service
            </a>
        </div>
    </div>

    <!-- Stats -->
    <div class="stats-grid">
        <div class="stat-card" data-aos="fade-up">
            <div class="stat-icon bg-primary"><i class="bi bi-cart-check"></i></div>
            <div class="stat-info">
                <h3><?= number_format($stats['total_orders']) ?></h3>
                <p>Total Orders</p>
            </div>
        </div>
        <div class="stat-card" data-aos="fade-up">
            <div class="stat-icon bg-success"><i class="bi bi-briefcase"></i></div>
            <div class="stat-info">
                <h3><?= number_format($stats['active_projects']) ?></h3>
                <p>Active Projects</p>
            </div>
        </div>
        <div class="stat-card" data-aos="fade-up">
            <div class="stat-icon bg-info"><i class="bi bi-cash-coin"></i></div>
            <div class="stat-info">
                <h3><?= format_price($stats['total_spent']) ?></h3>
                <p>Total Spent</p>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="data-card">
        <div class="card-header">
            <h3><i class="bi bi-clock-history"></i> Recent Orders</h3>
            <a href="<?= url('client/orders') ?>">View All</a>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Service</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($recent_orders)): ?>
                    <tr>
                        <td colspan="5" class="text-center">No orders yet. <a href="<?= url('services') ?>">Order your first service!</a></td>
                    </tr>
                    <?php else: ?>
                        <?php foreach ($recent_orders as $order): ?>
                        <tr>
                            <td><strong>#<?= $order['order_number'] ?? $order['id'] ?></strong></td>
                            <td><?= htmlspecialchars($order['service_name']) ?></td>
                            <td><?= format_price($order['total_amount']) ?></td>
                            <td><span class="badge bg-<?= order_status_color($order['status']) ?>"><?= ucfirst($order['status']) ?></span></td>
                            <td><?= date('d M Y', strtotime($order['created_at'])) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include ADMIN_PATH . 'includes/admin-footer.php'; ?>
