<?php
defined('SITUNEO_ACCESS') or die('Direct access not permitted');
Auth::requireRole('client');

$client = Auth::user();
$db = Database::getInstance();

$payments = $db->query("
    SELECT p.*, o.order_number, s.name as service_name
    FROM payments p
    LEFT JOIN orders o ON p.order_id = o.id
    LEFT JOIN services s ON o.service_id = s.id
    WHERE p.user_id = :id
    ORDER BY p.created_at DESC
", ['id' => $client['id']])->fetchAll();

$page_title = 'Payment History - SITUNEO DIGITAL';
include ADMIN_PATH . 'includes/admin-header.php';
?>

<div class="payments-container">
    <h1>Payment History</h1>
    
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Payment ID</th>
                    <th>Order</th>
                    <th>Service</th>
                    <th>Amount</th>
                    <th>Method</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($payments)): ?>
                <tr>
                    <td colspan="7" class="text-center">No payment history yet.</td>
                </tr>
                <?php else: ?>
                    <?php foreach ($payments as $payment): ?>
                    <tr>
                        <td><strong><?= $payment['payment_id'] ?></strong></td>
                        <td>#<?= $payment['order_number'] ?></td>
                        <td><?= htmlspecialchars($payment['service_name']) ?></td>
                        <td><?= format_price($payment['amount']) ?></td>
                        <td><?= ucfirst($payment['payment_method']) ?></td>
                        <td><span class="badge bg-<?= $payment['status'] === 'success' ? 'success' : 'warning' ?>"><?= ucfirst($payment['status']) ?></span></td>
                        <td><?= date('d M Y H:i', strtotime($payment['created_at'])) ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include ADMIN_PATH . 'includes/admin-footer.php'; ?>
