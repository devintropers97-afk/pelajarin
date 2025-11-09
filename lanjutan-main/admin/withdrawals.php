<?php
$page_id = 'withdrawals';
$pageTitle = 'Withdrawals Management - SITUNEO DIGITAL';
$pageDescription = 'Manage withdrawal requests';
$pageHeading = 'Withdrawals Management';

include __DIR__ . '/../includes/admin-header.php';

$filter_status = isset($_GET['status']) ? $_GET['status'] : 'all';

// Demo data
if (DEMO_MODE) {
    $withdrawals = [
        ['id' => 1, 'withdrawal_id' => 'WD-2025-008', 'freelancer' => 'Developer Pro', 'amount' => 2500000, 'bank' => 'BCA', 'account' => '1234567890', 'status' => 'pending', 'requested_at' => '2025-01-12 10:00:00', 'processed_at' => null],
        ['id' => 2, 'withdrawal_id' => 'WD-2025-007', 'freelancer' => 'Design Expert', 'amount' => 5000000, 'bank' => 'Mandiri', 'account' => '9876543210', 'status' => 'pending', 'requested_at' => '2025-01-11 14:00:00', 'processed_at' => null],
        ['id' => 3, 'withdrawal_id' => 'WD-2025-006', 'freelancer' => 'SEO Specialist', 'amount' => 1800000, 'bank' => 'BRI', 'account' => '5555666677', 'status' => 'approved', 'requested_at' => '2025-01-10 09:00:00', 'processed_at' => '2025-01-11 10:00:00'],
        ['id' => 4, 'withdrawal_id' => 'WD-2025-005', 'freelancer' => 'Developer Pro', 'amount' => 1500000, 'bank' => 'BCA', 'account' => '1234567890', 'status' => 'completed', 'requested_at' => '2025-01-05 14:00:00', 'processed_at' => '2025-01-06 10:30:00'],
        ['id' => 5, 'withdrawal_id' => 'WD-2025-004', 'freelancer' => 'Junior Dev', 'amount' => 500000, 'bank' => 'BCA', 'account' => '8888999900', 'status' => 'rejected', 'requested_at' => '2025-01-04 11:00:00', 'processed_at' => '2025-01-04 15:00:00', 'reject_reason' => 'Insufficient balance'],
    ];

    // Filter
    if ($filter_status !== 'all') {
        $withdrawals = array_filter($withdrawals, fn($w) => $w['status'] === $filter_status);
    }
}

// Stats
$total = count($withdrawals);
$pending = count(array_filter($withdrawals, fn($w) => $w['status'] === 'pending'));
$approved = count(array_filter($withdrawals, fn($w) => $w['status'] === 'approved'));
$completed = count(array_filter($withdrawals, fn($w) => $w['status'] === 'completed'));
$pending_amount = array_sum(array_map(fn($w) => $w['status'] === 'pending' ? $w['amount'] : 0, $withdrawals));

?>

<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">Pending</h6>
            <h4 class="text-warning mb-1"><?= $pending ?></h4>
            <small class="text-muted"><?= formatRupiah($pending_amount) ?></small>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">Approved</h6>
            <h3 class="text-info mb-0"><?= $approved ?></h3>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">Completed</h6>
            <h3 class="text-success mb-0"><?= $completed ?></h3>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">Total Requests</h6>
            <h3 class="text-gold mb-0"><?= $total ?></h3>
        </div>
    </div>
</div>

<!-- Filter Tabs -->
<div class="card-premium mb-4">
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link <?= $filter_status === 'all' ? 'active' : '' ?>" href="?status=all">All</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $filter_status === 'pending' ? 'active' : '' ?>" href="?status=pending">Pending (<?= $pending ?>)</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $filter_status === 'approved' ? 'active' : '' ?>" href="?status=approved">Approved</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $filter_status === 'completed' ? 'active' : '' ?>" href="?status=completed">Completed</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $filter_status === 'rejected' ? 'active' : '' ?>" href="?status=rejected">Rejected</a>
        </li>
    </ul>
</div>

<!-- Withdrawals List -->
<?php foreach ($withdrawals as $withdrawal): ?>
<div class="card-premium mb-3">
    <div class="row align-items-center">
        <div class="col-lg-6">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <code class="text-gold"><?= $withdrawal['withdrawal_id'] ?></code>
                    <?php
                    $status_badge = match($withdrawal['status']) {
                        'pending' => '<span class="badge bg-warning ms-2">Pending</span>',
                        'approved' => '<span class="badge bg-info ms-2">Approved</span>',
                        'completed' => '<span class="badge bg-success ms-2">Completed</span>',
                        'rejected' => '<span class="badge bg-danger ms-2">Rejected</span>',
                        default => '<span class="badge bg-secondary ms-2">Unknown</span>'
                    };
                    echo $status_badge;
                    ?>
                </div>
                <h4 class="text-gold mb-0"><?= formatRupiah($withdrawal['amount']) ?></h4>
            </div>

            <div class="row g-3">
                <div class="col-md-6">
                    <small class="text-muted d-block mb-1">Freelancer</small>
                    <p class="text-light mb-0"><?= htmlspecialchars($withdrawal['freelancer']) ?></p>
                </div>
                <div class="col-md-6">
                    <small class="text-muted d-block mb-1">Bank Account</small>
                    <p class="text-light mb-0"><?= $withdrawal['bank'] ?></p>
                    <code class="text-muted small"><?= $withdrawal['account'] ?></code>
                </div>
                <div class="col-md-6">
                    <small class="text-muted d-block mb-1">Requested</small>
                    <p class="text-light mb-0 small"><?= timeAgo($withdrawal['requested_at']) ?></p>
                </div>
                <?php if ($withdrawal['processed_at']): ?>
                <div class="col-md-6">
                    <small class="text-muted d-block mb-1">Processed</small>
                    <p class="text-success mb-0 small"><?= timeAgo($withdrawal['processed_at']) ?></p>
                </div>
                <?php endif; ?>
            </div>

            <?php if (isset($withdrawal['reject_reason'])): ?>
            <div class="alert alert-danger mt-3 mb-0 small">
                <i class="bi bi-x-circle me-1"></i>
                Rejected: <?= htmlspecialchars($withdrawal['reject_reason']) ?>
            </div>
            <?php endif; ?>
        </div>

        <div class="col-lg-6">
            <div class="card bg-dark p-3">
                <h6 class="text-gold mb-3">Actions</h6>

                <?php if ($withdrawal['status'] === 'pending'): ?>
                <div class="d-grid gap-2">
                    <button class="btn btn-success" onclick="approveWithdrawal(<?= $withdrawal['id'] ?>, '<?= $withdrawal['withdrawal_id'] ?>')">
                        <i class="bi bi-check-circle me-2"></i>
                        Approve & Process
                    </button>
                    <button class="btn btn-danger" onclick="rejectWithdrawal(<?= $withdrawal['id'] ?>, '<?= $withdrawal['withdrawal_id'] ?>')">
                        <i class="bi bi-x-circle me-2"></i>
                        Reject
                    </button>
                </div>
                <?php elseif ($withdrawal['status'] === 'approved'): ?>
                <button class="btn btn-gold w-100" onclick="markCompleted(<?= $withdrawal['id'] ?>, '<?= $withdrawal['withdrawal_id'] ?>')">
                    <i class="bi bi-check-circle me-2"></i>
                    Mark as Completed
                </button>
                <?php else: ?>
                <div class="alert alert-<?= $withdrawal['status'] === 'completed' ? 'success' : 'danger' ?> mb-0 small text-center">
                    <i class="bi bi-<?= $withdrawal['status'] === 'completed' ? 'check' : 'x' ?>-circle me-1"></i>
                    <?= ucfirst($withdrawal['status']) ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

<!-- Reject Reason Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content bg-dark">
            <div class="modal-header border-danger">
                <h5 class="modal-title text-danger">
                    <i class="bi bi-x-circle me-2"></i>
                    Reject Withdrawal
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="rejectId">
                <input type="hidden" id="rejectWithdrawalId">

                <div class="mb-3">
                    <label class="form-label text-light">Reason for Rejection <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="rejectReason" rows="4" required></textarea>
                </div>
            </div>
            <div class="modal-footer border-danger">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="submitRejection()">
                    <i class="bi bi-x-circle me-2"></i>
                    Reject Withdrawal
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let rejectModal;

document.addEventListener('DOMContentLoaded', function() {
    rejectModal = new bootstrap.Modal(document.getElementById('rejectModal'));
});

function approveWithdrawal(id, withdrawalId) {
    if (confirm(`Approve withdrawal ${withdrawalId}?\n\nThis will process the payment to freelancer's bank account.`)) {
        alert(`Withdrawal ${withdrawalId} approved! Payment will be processed.`);
        location.reload();
    }
}

function rejectWithdrawal(id, withdrawalId) {
    document.getElementById('rejectId').value = id;
    document.getElementById('rejectWithdrawalId').value = withdrawalId;
    rejectModal.show();
}

function submitRejection() {
    const reason = document.getElementById('rejectReason').value;
    if (!reason) {
        alert('Please provide rejection reason');
        return;
    }

    const withdrawalId = document.getElementById('rejectWithdrawalId').value;
    alert(`Withdrawal ${withdrawalId} rejected.\nFreelancer will be notified.`);
    rejectModal.hide();
    location.reload();
}

function markCompleted(id, withdrawalId) {
    if (confirm(`Mark withdrawal ${withdrawalId} as completed?\n\nUse this after payment has been transferred.`)) {
        alert(`Withdrawal ${withdrawalId} marked as completed!`);
        location.reload();
    }
}
</script>

<style>
.nav-pills .nav-link {
    color: var(--gold);
    border: 1px solid transparent;
}

.nav-pills .nav-link:hover {
    background: rgba(212, 175, 55, 0.1);
    border-color: var(--gold);
}

.nav-pills .nav-link.active {
    background: var(--gradient-gold);
    color: var(--dark-blue);
    border-color: var(--gold);
}
</style>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
