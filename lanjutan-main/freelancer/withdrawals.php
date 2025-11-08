<?php
/**
 * FREELANCER - WITHDRAWALS
 * Request penarikan komisi yang sudah earned
 */

$page_id = 'withdrawals';
$pageTitle = 'Penarikan Komisi - SITUNEO DIGITAL';
$pageDescription = 'Request withdrawal of your commission earnings';
$pageHeading = 'Penarikan Komisi';

include __DIR__ . '/../includes/freelancer-header.php';

// Demo data
$available_balance = 2620000; // From paid commissions minus pending withdrawals
$minimum_withdrawal = 100000;
$pending_withdrawal = 2500000;

$bank_accounts = [
    ['id' => 1, 'bank' => 'BCA', 'account' => '1234567890', 'name' => getCurrentUser()['full_name'], 'is_primary' => true],
    ['id' => 2, 'bank' => 'Mandiri', 'account' => '9876543210', 'name' => getCurrentUser()['full_name'], 'is_primary' => false],
];

$withdrawals = [
    [
        'withdrawal_id' => 'WD-2025-008',
        'amount' => 2500000,
        'bank' => 'BCA',
        'account' => '1234567890',
        'status' => 'pending',
        'requested_at' => '2025-01-12 10:00:00',
        'processed_at' => null,
        'notes' => null,
    ],
    [
        'withdrawal_id' => 'WD-2025-003',
        'amount' => 1500000,
        'bank' => 'BCA',
        'account' => '1234567890',
        'status' => 'completed',
        'requested_at' => '2025-01-05 14:00:00',
        'processed_at' => '2025-01-06 10:30:00',
        'notes' => 'Transfer completed',
    ],
    [
        'withdrawal_id' => 'WD-2024-092',
        'amount' => 1200000,
        'bank' => 'Mandiri',
        'account' => '9876543210',
        'status' => 'completed',
        'requested_at' => '2024-12-28 09:00:00',
        'processed_at' => '2024-12-29 11:00:00',
        'notes' => 'Transfer completed',
    ],
    [
        'withdrawal_id' => 'WD-2024-085',
        'amount' => 500000,
        'bank' => 'BCA',
        'account' => '1234567890',
        'status' => 'rejected',
        'requested_at' => '2024-12-20 15:00:00',
        'processed_at' => '2024-12-21 09:00:00',
        'notes' => 'Insufficient balance at request time',
    ],
];

$stats = [
    'total_withdrawn' => 2700000,
    'pending' => 2500000,
    'this_month' => 2500000,
    'requests_count' => count($withdrawals),
];

?>

<!-- Balance Card -->
<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <div class="card-premium" style="background: var(--gradient-gold); color: var(--dark-blue);">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h5 class="mb-3">
                        <i class="bi bi-wallet2 me-2"></i>
                        Available Balance
                    </h5>
                    <h2 class="mb-3"><?= formatRupiah($available_balance) ?></h2>
                    <p class="mb-0">
                        Minimum withdrawal: <strong><?= formatRupiah($minimum_withdrawal) ?></strong>
                    </p>
                </div>
                <div class="col-md-4 text-center">
                    <i class="bi bi-cash-stack" style="font-size: 5rem; opacity: 0.3;"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card-premium bg-warning bg-opacity-25 h-100">
            <h6 class="text-warning mb-3">
                <i class="bi bi-clock-history me-2"></i>
                Pending Withdrawal
            </h6>
            <h3 class="text-gold mb-2"><?= formatRupiah($pending_withdrawal) ?></h3>
            <small class="text-muted">Being processed by admin</small>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">Total Withdrawn</h6>
            <h4 class="text-success mb-0"><?= formatRupiah($stats['total_withdrawn']) ?></h4>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">Pending</h6>
            <h4 class="text-warning mb-0"><?= formatRupiah($stats['pending']) ?></h4>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">This Month</h6>
            <h4 class="text-info mb-0"><?= formatRupiah($stats['this_month']) ?></h4>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">Total Requests</h6>
            <h4 class="text-gold mb-0"><?= $stats['requests_count'] ?></h4>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Left: Withdrawal Form -->
    <div class="col-lg-5">
        <div class="card-premium">
            <h5 class="text-gold mb-4">
                <i class="bi bi-plus-circle me-2"></i>
                Request New Withdrawal
            </h5>

            <form id="withdrawalForm">
                <!-- Amount -->
                <div class="mb-4">
                    <label class="form-label text-light">Withdrawal Amount <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="text" class="form-control" id="withdrawalAmount" placeholder="Enter amount" required>
                    </div>
                    <small class="text-muted">
                        Available: <?= formatRupiah($available_balance) ?> |
                        Min: <?= formatRupiah($minimum_withdrawal) ?>
                    </small>
                </div>

                <!-- Bank Account -->
                <div class="mb-4">
                    <label class="form-label text-light">Bank Account <span class="text-danger">*</span></label>
                    <select class="form-select" id="bankAccount" required>
                        <option value="">-- Select Bank Account --</option>
                        <?php foreach ($bank_accounts as $account): ?>
                        <option value="<?= $account['id'] ?>" <?= $account['is_primary'] ? 'selected' : '' ?>>
                            <?= $account['bank'] ?> - <?= $account['account'] ?> (<?= $account['name'] ?>)
                            <?= $account['is_primary'] ? ' - Primary' : '' ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                    <small class="text-muted">
                        <a href="#" class="text-gold" data-bs-toggle="modal" data-bs-target="#addBankModal">
                            <i class="bi bi-plus-circle me-1"></i>
                            Add New Bank Account
                        </a>
                    </small>
                </div>

                <!-- Notes -->
                <div class="mb-4">
                    <label class="form-label text-light">Notes (Optional)</label>
                    <textarea class="form-control" id="withdrawalNotes" rows="3" placeholder="Additional notes for admin..."></textarea>
                </div>

                <!-- Info Alert -->
                <div class="alert alert-info mb-4">
                    <i class="bi bi-info-circle me-2"></i>
                    <strong>Processing Time:</strong> Withdrawals are processed within 2x24 hours on business days.
                </div>

                <!-- Submit -->
                <button type="submit" class="btn btn-gold w-100">
                    <i class="bi bi-send me-2"></i>
                    Submit Withdrawal Request
                </button>
            </form>
        </div>

        <!-- Bank Accounts -->
        <div class="card-premium mt-4">
            <h6 class="text-gold mb-3">
                <i class="bi bi-bank me-2"></i>
                Saved Bank Accounts
            </h6>

            <?php foreach ($bank_accounts as $account): ?>
            <div class="card bg-dark p-3 mb-2">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <strong class="text-light d-block"><?= $account['bank'] ?></strong>
                        <code class="text-gold"><?= $account['account'] ?></code>
                        <p class="text-muted small mb-0 mt-1"><?= $account['name'] ?></p>
                    </div>
                    <div class="d-flex gap-2">
                        <?php if ($account['is_primary']): ?>
                        <span class="badge bg-gold">Primary</span>
                        <?php else: ?>
                        <button class="btn btn-sm btn-outline-gold" onclick="setPrimary(<?= $account['id'] ?>)">
                            Set Primary
                        </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

            <button class="btn btn-sm btn-outline-gold w-100 mt-2" data-bs-toggle="modal" data-bs-target="#addBankModal">
                <i class="bi bi-plus-circle me-2"></i>
                Add New Bank Account
            </button>
        </div>
    </div>

    <!-- Right: Withdrawal History -->
    <div class="col-lg-7">
        <div class="card-premium">
            <h5 class="text-gold mb-4">
                <i class="bi bi-clock-history me-2"></i>
                Withdrawal History
            </h5>

            <?php if (empty($withdrawals)): ?>
            <div class="text-center py-5">
                <i class="bi bi-inbox display-4 text-muted mb-3"></i>
                <p class="text-light">No withdrawal requests yet</p>
            </div>
            <?php else: ?>
            <?php foreach ($withdrawals as $withdrawal): ?>
            <div class="card bg-dark mb-3 p-3">
                <div class="d-flex justify-content-between align-items-start mb-3">
                    <div>
                        <code class="text-gold"><?= $withdrawal['withdrawal_id'] ?></code>
                        <?php
                        // PHP 7.4 compatible
                        if ($withdrawal['status'] === 'completed') {
                            $status_badge = '<span class="badge bg-success ms-2">Completed</span>';
                        } elseif ($withdrawal['status'] === 'pending') {
                            $status_badge = '<span class="badge bg-warning ms-2">Pending</span>';
                        } elseif ($withdrawal['status'] === 'approved') {
                            $status_badge = '<span class="badge bg-info ms-2">Approved</span>';
                        } elseif ($withdrawal['status'] === 'rejected') {
                            $status_badge = '<span class="badge bg-danger ms-2">Rejected</span>';
                        } else {
                            $status_badge = '<span class="badge bg-secondary ms-2">Unknown</span>';
                        }
                        echo $status_badge;
                        ?>
                    </div>
                    <h4 class="text-gold mb-0"><?= formatRupiah($withdrawal['amount']) ?></h4>
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-6">
                        <small class="text-muted d-block mb-1">
                            <i class="bi bi-bank me-1"></i>Bank
                        </small>
                        <p class="text-light mb-0 small"><?= $withdrawal['bank'] ?></p>
                        <code class="text-muted small"><?= $withdrawal['account'] ?></code>
                    </div>
                    <div class="col-6">
                        <small class="text-muted d-block mb-1">
                            <i class="bi bi-calendar me-1"></i>Requested
                        </small>
                        <p class="text-light mb-0 small"><?= timeAgo($withdrawal['requested_at']) ?></p>
                    </div>
                    <?php if ($withdrawal['processed_at']): ?>
                    <div class="col-12">
                        <small class="text-muted d-block mb-1">
                            <i class="bi bi-check-circle me-1"></i>Processed
                        </small>
                        <p class="text-success mb-0 small"><?= timeAgo($withdrawal['processed_at']) ?></p>
                    </div>
                    <?php endif; ?>
                </div>

                <?php if ($withdrawal['notes']): ?>
                <div class="alert alert-<?= $withdrawal['status'] === 'rejected' ? 'danger' : 'info' ?> mb-0 small">
                    <i class="bi bi-info-circle me-1"></i>
                    <?= htmlspecialchars($withdrawal['notes']) ?>
                </div>
                <?php endif; ?>

                <?php if ($withdrawal['status'] === 'pending'): ?>
                <div class="alert alert-warning mb-0 mt-3 small">
                    <i class="bi bi-clock me-1"></i>
                    Your withdrawal is being processed. Please wait for admin approval.
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Add Bank Account Modal -->
<div class="modal fade" id="addBankModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content bg-dark">
            <div class="modal-header border-gold">
                <h5 class="modal-title text-gold">
                    <i class="bi bi-bank me-2"></i>
                    Add Bank Account
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addBankForm">
                    <div class="mb-3">
                        <label class="form-label text-light">Bank Name <span class="text-danger">*</span></label>
                        <select class="form-select" id="bankName" required>
                            <option value="">-- Select Bank --</option>
                            <option value="BCA">BCA</option>
                            <option value="Mandiri">Mandiri</option>
                            <option value="BRI">BRI</option>
                            <option value="BNI">BNI</option>
                            <option value="CIMB Niaga">CIMB Niaga</option>
                            <option value="Permata">Permata</option>
                            <option value="BTN">BTN</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-light">Account Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="accountNumber" placeholder="1234567890" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-light">Account Holder Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="accountName" value="<?= htmlspecialchars(getCurrentUser()['full_name']) ?>" required>
                        <small class="text-muted">Must match your ID card name</small>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="setPrimaryCheck">
                        <label class="form-check-label text-light" for="setPrimaryCheck">
                            Set as primary account
                        </label>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-gold">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-gold" onclick="submitBankAccount()">
                    <i class="bi bi-save me-2"></i>
                    Save Bank Account
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark">
            <div class="modal-body text-center py-5">
                <i class="bi bi-check-circle-fill text-success" style="font-size: 5rem;"></i>
                <h4 class="text-gold mt-4 mb-3">Withdrawal Request Submitted!</h4>
                <p class="text-light mb-4">
                    Your withdrawal request has been submitted successfully. We will process it within 2x24 hours.
                </p>
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>
                    You will receive email notification once processed.
                </div>
                <button type="button" class="btn btn-gold" data-bs-dismiss="modal">
                    OK
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let addBankModal, successModal;

document.addEventListener('DOMContentLoaded', function() {
    addBankModal = new bootstrap.Modal(document.getElementById('addBankModal'));
    successModal = new bootstrap.Modal(document.getElementById('successModal'));

    // Format withdrawal amount
    document.getElementById('withdrawalAmount').addEventListener('input', function(e) {
        let value = this.value.replace(/[^\d]/g, '');
        this.value = formatNumber(value);
    });

    // Withdrawal form submission
    document.getElementById('withdrawalForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const amount = parseInt(document.getElementById('withdrawalAmount').value.replace(/\./g, ''));
        const availableBalance = <?= $available_balance ?>;
        const minimumWithdrawal = <?= $minimum_withdrawal ?>;

        if (amount < minimumWithdrawal) {
            alert(`Minimum withdrawal amount is ${formatRupiah(minimumWithdrawal)}`);
            return;
        }

        if (amount > availableBalance) {
            alert(`Insufficient balance. Available: ${formatRupiah(availableBalance)}`);
            return;
        }

        // In real implementation, submit via AJAX
        successModal.show();
        setTimeout(() => {
            location.reload();
        }, 2000);
    });
});

function submitBankAccount() {
    const bank = document.getElementById('bankName').value;
    const account = document.getElementById('accountNumber').value;
    const name = document.getElementById('accountName').value;

    if (!bank || !account || !name) {
        alert('Please fill all required fields');
        return;
    }

    alert('Bank account saved successfully!');
    addBankModal.hide();
    location.reload();
}

function setPrimary(accountId) {
    if (confirm('Set this account as primary?')) {
        alert('Primary account updated!');
        location.reload();
    }
}

function formatNumber(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}

function formatRupiah(number) {
    return 'Rp ' + number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}
</script>

<style>
.form-check-input:checked {
    background-color: var(--gold);
    border-color: var(--gold);
}

.form-check-input:focus {
    border-color: var(--gold);
    box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.25);
}
</style>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
