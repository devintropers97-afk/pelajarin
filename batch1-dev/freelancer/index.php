<?php
defined('SITUNEO_ACCESS') or die('Direct access not permitted');
Auth::requireRole('freelancer');

$freelancer = Auth::user();
$db = Database::getInstance();

$profile = $db->query("SELECT * FROM freelancer_profiles WHERE user_id = :id", ['id' => $freelancer['id']])->fetch();

$stats = [
    'total_earnings' => $profile['total_earnings'] ?? 0,
    'available_balance' => $profile['available_balance'] ?? 0,
    'pending_commission' => $db->query("SELECT SUM(commission_amount) as total FROM freelancer_commissions WHERE freelancer_id = :id AND status = 'pending'", ['id' => $freelancer['id']])->fetch()['total'] ?? 0,
    'completed_orders' => $db->query("SELECT COUNT(*) as count FROM orders WHERE freelancer_id = :id AND status = 'completed'", ['id' => $freelancer['id']])->fetch()['count'] ?? 0,
];

$page_title = 'Freelancer Dashboard - SITUNEO DIGITAL';
include ADMIN_PATH . 'includes/admin-header.php';
?>

<div class="dashboard-container">
    <h1>Welcome, <?= htmlspecialchars($freelancer['name']) ?>!</h1>
    <p class="text-muted">Freelancer Dashboard - Tier: <strong><?= ucfirst($profile['tier'] ?? 'bronze') ?></strong> (<?= $profile['commission_rate'] ?>% commission)</p>
    
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon bg-success"><i class="bi bi-cash-coin"></i></div>
            <div class="stat-info">
                <h3><?= format_price($stats['total_earnings']) ?></h3>
                <p>Total Earnings</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon bg-primary"><i class="bi bi-wallet2"></i></div>
            <div class="stat-info">
                <h3><?= format_price($stats['available_balance']) ?></h3>
                <p>Available Balance</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon bg-warning"><i class="bi bi-clock"></i></div>
            <div class="stat-info">
                <h3><?= format_price($stats['pending_commission']) ?></h3>
                <p>Pending Commission</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon bg-info"><i class="bi bi-check-circle"></i></div>
            <div class="stat-info">
                <h3><?= number_format($stats['completed_orders']) ?></h3>
                <p>Completed Orders</p>
            </div>
        </div>
    </div>
    
    <div class="quick-actions">
        <a href="<?= url('freelancer/commissions') ?>" class="btn btn-primary">View Commissions</a>
        <a href="<?= url('freelancer/withdrawals') ?>" class="btn btn-success">Request Withdrawal</a>
    </div>
</div>

<?php include ADMIN_PATH . 'includes/admin-footer.php'; ?>
