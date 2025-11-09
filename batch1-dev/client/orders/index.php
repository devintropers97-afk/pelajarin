<?php
defined('SITUNEO_ACCESS') or die('Direct access not permitted');
Auth::requireRole('client');

$client = Auth::user();
$db = Database::getInstance();

$orders = $db->query("
    SELECT o.*, s.name as service_name, s.slug as service_slug
    FROM orders o
    LEFT JOIN services s ON o.service_id = s.id
    WHERE o.user_id = :id
    ORDER BY o.created_at DESC
", ['id' => $client['id']])->fetchAll();

$page_title = 'My Orders - SITUNEO DIGITAL';
include ADMIN_PATH . 'includes/admin-header.php';
?>

<div class="orders-container">
    <div class="orders-header">
        <h1>My Orders</h1>
        <a href="<?= url('services') ?>" class="btn btn-primary">Order New Service</a>
    </div>
    
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Service</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Payment</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($orders)): ?>
                <tr>
                    <td colspan="7" class="text-center">No orders yet. <a href="<?= url('services') ?>">Order your first service!</a></td>
                </tr>
                <?php else: ?>
                    <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><strong>#<?= $order['order_number'] ?? $order['id'] ?></strong></td>
                        <td><?= htmlspecialchars($order['service_name']) ?></td>
                        <td><?= format_price($order['total_amount']) ?></td>
                        <td><span class="badge bg-<?= order_status_color($order['status']) ?>"><?= ucfirst($order['status']) ?></span></td>
                        <td><span class="badge bg-<?= $order['payment_status'] === 'paid' ? 'success' : 'warning' ?>"><?= ucfirst($order['payment_status']) ?></span></td>
                        <td><?= date('d M Y', strtotime($order['created_at'])) ?></td>
                        <td>
                            <a href="<?= url('client/orders/detail?id=' . $order['id']) ?>" class="btn btn-sm btn-info">View</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include ADMIN_PATH . 'includes/admin-footer.php'; ?>
