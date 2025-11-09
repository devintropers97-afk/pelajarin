<?php
defined('SITUNEO_ACCESS') or die('Direct access not permitted');
Auth::requireRole('freelancer');

$freelancer = Auth::user();
$db = Database::getInstance();

$profile = $db->query("SELECT * FROM freelancer_profiles WHERE user_id = :id", ['id' => $freelancer['id']])->fetch();

// Handle withdrawal request
if (is_post()) {
    $amount = post('amount');
    $bank_name = post('bank_name');
    $account_number = post('account_number');
    $account_name = post('account_name');
    
    if ($amount > $profile['available_balance']) {
        Session::flashError('Insufficient balance!');
    } else {
        $db->insert('withdrawals', [
            'freelancer_id' => $freelancer['id'],
            'amount' => $amount,
            'bank_name' => $bank_name,
            'account_number' => $account_number,
            'account_name' => $account_name,
            'status' => 'pending',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        
        Session::flashSuccess('Withdrawal request submitted!');
        Router::redirect('freelancer/withdrawals');
    }
}

$withdrawals = $db->query("SELECT * FROM withdrawals WHERE freelancer_id = :id ORDER BY created_at DESC", ['id' => $freelancer['id']])->fetchAll();

$page_title = 'Withdrawals - SITUNEO DIGITAL';
include ADMIN_PATH . 'includes/admin-header.php';
?>

<div class="withdrawals-container">
    <h1>Withdrawals</h1>
    <p>Available Balance: <strong><?= format_price($profile['available_balance']) ?></strong></p>
    
    <form method="post" class="withdrawal-form mb-4">
        <?= csrf_field() ?>
        <div class="row">
            <div class="col-md-3">
                <input type="number" name="amount" class="form-control" placeholder="Amount" required>
            </div>
            <div class="col-md-3">
                <input type="text" name="bank_name" class="form-control" placeholder="Bank Name" required>
            </div>
            <div class="col-md-3">
                <input type="text" name="account_number" class="form-control" placeholder="Account Number" required>
            </div>
            <div class="col-md-3">
                <input type="text" name="account_name" class="form-control" placeholder="Account Name" required>
            </div>
        </div>
        <button type="submit" class="btn btn-success mt-2">Request Withdrawal</button>
    </form>
    
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Bank</th>
                    <th>Account</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($withdrawals)): ?>
                <tr><td colspan="5" class="text-center">No withdrawal history.</td></tr>
                <?php else: ?>
                    <?php foreach ($withdrawals as $w): ?>
                    <tr>
                        <td><?= date('d M Y', strtotime($w['created_at'])) ?></td>
                        <td><?= format_price($w['amount']) ?></td>
                        <td><?= htmlspecialchars($w['bank_name']) ?></td>
                        <td><?= htmlspecialchars($w['account_number']) ?></td>
                        <td><span class="badge bg-<?= $w['status'] === 'completed' ? 'success' : 'warning' ?>"><?= ucfirst($w['status']) ?></span></td>
                    </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include ADMIN_PATH . 'includes/admin-footer.php'; ?>
