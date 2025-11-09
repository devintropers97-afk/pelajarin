<?php
defined('SITUNEO_ACCESS') or die('Direct access not permitted');
Auth::requireRole('freelancer');

$freelancer = Auth::user();
$db = Database::getInstance();

$commissions = $db->query("
    SELECT fc.*, o.order_number, s.name as service_name
    FROM freelancer_commissions fc
    LEFT JOIN orders o ON fc.order_id = o.id
    LEFT JOIN services s ON o.service_id = s.id
    WHERE fc.freelancer_id = :id
    ORDER BY fc.created_at DESC
", ['id' => $freelancer['id']])->fetchAll();

$page_title = 'My Commissions - SITUNEO DIGITAL';
include ADMIN_PATH . 'includes/admin-header.php';
?>

<div class="commissions-container">
    <h1>My Commissions</h1>
    
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Order</th>
                    <th>Service</th>
                    <th>Order Amount</th>
                    <th>Commission Rate</th>
                    <th>Commission Amount</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($commissions)): ?>
                <tr><td colspan="7" class="text-center">No commissions yet.</td></tr>
                <?php else: ?>
                    <?php foreach ($commissions as $comm): ?>
                    <tr>
                        <td>#<?= $comm['order_number'] ?></td>
                        <td><?= htmlspecialchars($comm['service_name']) ?></td>
                        <td><?= format_price($comm['order_amount']) ?></td>
                        <td><?= $comm['commission_rate'] ?>%</td>
                        <td><strong><?= format_price($comm['commission_amount']) ?></strong></td>
                        <td><span class="badge bg-<?= $comm['status'] === 'available' ? 'success' : 'warning' ?>"><?= ucfirst($comm['status']) ?></span></td>
                        <td><?= date('d M Y', strtotime($comm['created_at'])) ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include ADMIN_PATH . 'includes/admin-footer.php'; ?>
