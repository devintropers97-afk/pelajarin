<?php
$page_id = 'payments';
$pageTitle = 'Payments Verification - Admin Dashboard';
$pageDescription = 'Verify and manage customer payments';
$pageHeading = 'Payments Verification';

include __DIR__ . '/../includes/admin-header.php';

// Filters
$status_filter = isset($_GET['status']) ? sanitize($_GET['status']) : 'pending';
$method_filter = isset($_GET['method']) ? sanitize($_GET['method']) : 'all';

// Demo data
if (DEMO_MODE) {
    $payments = [
        ['payment_id' => 'PAY-001', 'order_id' => 'ORD-2025-001', 'client_name' => 'John Doe', 'amount' => 1500000, 'method' => 'Bank Transfer - BCA', 'proof' => 'https://images.unsplash.com/photo-1554224154-26032ffc0d07?w=400', 'status' => 'pending', 'created_at' => '2025-01-10 15:00:00'],
        ['payment_id' => 'PAY-002', 'order_id' => 'ORD-2025-004', 'client_name' => 'Sarah Wijaya', 'amount' => 500000, 'method' => 'GoPay', 'proof' => 'https://images.unsplash.com/photo-1563013544-824ae1b704d3?w=400', 'status' => 'pending', 'created_at' => '2025-01-10 14:30:00'],
        ['payment_id' => 'PAY-003', 'order_id' => 'ORD-2025-006', 'client_name' => 'John Doe', 'amount' => 8000000, 'method' => 'Bank Transfer - Mandiri', 'proof' => 'https://images.unsplash.com/photo-1633158829875-e5316a358c6f?w=400', 'status' => 'pending', 'created_at' => '2025-01-10 12:00:00'],
        ['payment_id' => 'PAY-004', 'order_id' => 'ORD-2025-002', 'client_name' => 'Jane Smith', 'amount' => 2000000, 'method' => 'Bank Transfer - BCA', 'proof' => 'https://images.unsplash.com/photo-1606857521015-7f9fcf423740?w=400', 'status' => 'verified', 'verified_at' => '2025-01-10 13:30:00', 'verified_by' => 'Admin SITUNEO', 'created_at' => '2025-01-10 11:00:00'],
        ['payment_id' => 'PAY-005', 'order_id' => 'ORD-2025-005', 'client_name' => 'Ahmad Yani', 'amount' => 1000000, 'method' => 'OVO', 'proof' => 'https://images.unsplash.com/photo-1607863680198-23d4b2565df0?w=400', 'status' => 'verified', 'verified_at' => '2025-01-10 09:45:00', 'verified_by' => 'Admin SITUNEO', 'created_at' => '2025-01-10 09:00:00'],
        ['payment_id' => 'PAY-006', 'order_id' => 'ORD-2024-180', 'client_name' => 'David Lee', 'amount' => 750000, 'method' => 'Dana', 'proof' => 'https://images.unsplash.com/photo-1579621970563-ebec7560ff3e?w=400', 'status' => 'rejected', 'rejected_at' => '2025-01-09 16:00:00', 'rejection_reason' => 'Bukti transfer tidak jelas', 'created_at' => '2025-01-09 14:00:00'],
    ];

    // Apply filters
    if ($status_filter !== 'all') {
        $payments = array_filter($payments, fn($p) => $p['status'] === $status_filter);
    }
    if ($method_filter !== 'all') {
        $payments = array_filter($payments, fn($p) => stripos($p['method'], $method_filter) !== false);
    }

    $total_payments = count($payments);
}

// Stats
$stats = [
    'total' => DEMO_MODE ? 156 : 0,
    'pending' => DEMO_MODE ? 23 : 0,
    'verified' => DEMO_MODE ? 125 : 0,
    'rejected' => DEMO_MODE ? 8 : 0,
    'total_amount' => DEMO_MODE ? 487500000 : 0,
];

?>

<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">Pending Verification</h6>
            <h2 class="text-warning mb-0"><?= number_format($stats['pending']) ?></h2>
            <small class="text-light">Waiting for review</small>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">Verified</h6>
            <h2 class="text-success mb-0"><?= number_format($stats['verified']) ?></h2>
            <small class="text-light">Approved payments</small>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">Rejected</h6>
            <h2 class="text-danger mb-0"><?= number_format($stats['rejected']) ?></h2>
            <small class="text-light">Invalid proofs</small>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">Total Revenue</h6>
            <h2 class="text-gold mb-0"><?= formatRupiah($stats['total_amount']) ?></h2>
            <small class="text-light">All verified payments</small>
        </div>
    </div>
</div>

<!-- Filters -->
<div class="card-premium mb-4">
    <form method="GET" action="/admin/payments" class="row g-3">
        <div class="col-lg-4 col-md-6">
            <label class="form-label text-light">Status</label>
            <select name="status" class="form-control" onchange="this.form.submit()">
                <option value="all" <?= $status_filter === 'all' ? 'selected' : '' ?>>All Status</option>
                <option value="pending" <?= $status_filter === 'pending' ? 'selected' : '' ?>>Pending</option>
                <option value="verified" <?= $status_filter === 'verified' ? 'selected' : '' ?>>Verified</option>
                <option value="rejected" <?= $status_filter === 'rejected' ? 'selected' : '' ?>>Rejected</option>
            </select>
        </div>

        <div class="col-lg-4 col-md-6">
            <label class="form-label text-light">Payment Method</label>
            <select name="method" class="form-control" onchange="this.form.submit()">
                <option value="all" <?= $method_filter === 'all' ? 'selected' : '' ?>>All Methods</option>
                <option value="BCA" <?= $method_filter === 'BCA' ? 'selected' : '' ?>>BCA</option>
                <option value="Mandiri" <?= $method_filter === 'Mandiri' ? 'selected' : '' ?>>Mandiri</option>
                <option value="BRI" <?= $method_filter === 'BRI' ? 'selected' : '' ?>>BRI</option>
                <option value="GoPay" <?= $method_filter === 'GoPay' ? 'selected' : '' ?>>GoPay</option>
                <option value="OVO" <?= $method_filter === 'OVO' ? 'selected' : '' ?>>OVO</option>
                <option value="Dana" <?= $method_filter === 'Dana' ? 'selected' : '' ?>>Dana</option>
            </select>
        </div>

        <div class="col-lg-4 col-md-12">
            <label class="form-label text-light">&nbsp;</label>
            <button type="submit" class="btn btn-gold w-100">
                <i class="bi bi-funnel me-2"></i>Apply Filters
            </button>
        </div>
    </form>
</div>

<!-- Payments Grid -->
<div class="card-premium">
    <h5 class="text-gold mb-4">
        <i class="bi bi-credit-card me-2"></i>
        Payment Proofs (<?= $total_payments ?>)
    </h5>

    <?php if (empty($payments)): ?>
    <div class="text-center text-muted py-5">
        <i class="bi bi-inbox display-4 d-block mb-3"></i>
        <p>No payments found</p>
    </div>
    <?php else: ?>
    <div class="row g-4">
        <?php foreach ($payments as $payment): ?>
        <div class="col-lg-4 col-md-6">
            <div class="payment-proof-card card-premium">
                <!-- Payment Proof Image -->
                <div class="payment-proof-image mb-3">
                    <img src="<?= $payment['proof'] ?>"
                         alt="Payment Proof"
                         class="img-fluid rounded"
                         style="width: 100%; height: 200px; object-fit: cover; cursor: pointer;"
                         onclick="viewProof('<?= $payment['proof'] ?>')">
                </div>

                <!-- Payment Info -->
                <div class="mb-3">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <code class="text-gold"><?= $payment['payment_id'] ?></code>
                            <p class="text-muted small mb-0"><?= $payment['order_id'] ?></p>
                        </div>
                        <?php
                        $status_badge = match($payment['status']) {
                            'verified' => '<span class="badge bg-success">Verified</span>',
                            'pending' => '<span class="badge bg-warning">Pending</span>',
                            'rejected' => '<span class="badge bg-danger">Rejected</span>',
                            default => '<span class="badge bg-secondary">Unknown</span>'
                        };
                        echo $status_badge;
                        ?>
                    </div>

                    <h6 class="text-light"><?= htmlspecialchars($payment['client_name']) ?></h6>
                    <p class="text-gold fw-bold mb-2"><?= formatRupiah($payment['amount']) ?></p>
                    <p class="text-muted small mb-2">
                        <i class="bi bi-credit-card me-1"></i>
                        <?= $payment['method'] ?>
                    </p>
                    <p class="text-muted small">
                        <i class="bi bi-clock me-1"></i>
                        <?= timeAgo($payment['created_at']) ?>
                    </p>
                </div>

                <!-- Actions -->
                <?php if ($payment['status'] === 'pending'): ?>
                <div class="d-grid gap-2">
                    <button class="btn btn-success btn-sm"
                            onclick="verifyPayment('<?= $payment['payment_id'] ?>', '<?= $payment['order_id'] ?>')">
                        <i class="bi bi-check-circle me-2"></i>
                        Approve Payment
                    </button>
                    <button class="btn btn-danger btn-sm"
                            onclick="rejectPayment('<?= $payment['payment_id'] ?>')">
                        <i class="bi bi-x-circle me-2"></i>
                        Reject
                    </button>
                </div>
                <?php elseif ($payment['status'] === 'verified'): ?>
                <div class="alert alert-success mb-0 small">
                    <i class="bi bi-check-circle me-1"></i>
                    Verified by <?= $payment['verified_by'] ?><br>
                    <small><?= timeAgo($payment['verified_at']) ?></small>
                </div>
                <?php elseif ($payment['status'] === 'rejected'): ?>
                <div class="alert alert-danger mb-0 small">
                    <i class="bi bi-x-circle me-1"></i>
                    Rejected<br>
                    <small><?= $payment['rejection_reason'] ?></small>
                </div>
                <?php endif; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>
</div>

<!-- Modal: View Proof -->
<div class="modal fade" id="viewProofModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-dark">
            <div class="modal-header border-gold">
                <h5 class="modal-title text-gold">Payment Proof</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img id="proofImage" src="" alt="Payment Proof" class="img-fluid rounded">
            </div>
        </div>
    </div>
</div>

<!-- Modal: Reject Reason -->
<div class="modal fade" id="rejectModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content bg-dark">
            <div class="modal-header border-gold">
                <h5 class="modal-title text-gold">Reject Payment</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="text-light">Payment ID: <code id="rejectPaymentId"></code></p>
                <div class="mb-3">
                    <label class="form-label text-light">Rejection Reason *</label>
                    <textarea class="form-control" id="rejectionReason" rows="3" placeholder="e.g. Bukti transfer tidak jelas, nominal tidak sesuai..." required></textarea>
                </div>
            </div>
            <div class="modal-footer border-gold">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="confirmReject()">Reject Payment</button>
            </div>
        </div>
    </div>
</div>

<script>
let viewProofModal, rejectModal;

document.addEventListener('DOMContentLoaded', function() {
    viewProofModal = new bootstrap.Modal(document.getElementById('viewProofModal'));
    rejectModal = new bootstrap.Modal(document.getElementById('rejectModal'));
});

function viewProof(imageUrl) {
    document.getElementById('proofImage').src = imageUrl;
    viewProofModal.show();
}

function verifyPayment(paymentId, orderId) {
    if (confirm(`Approve payment ${paymentId} for order ${orderId}?`)) {
        alert('Payment approved! Order status will be updated. (DEMO)');
        location.reload();
    }
}

function rejectPayment(paymentId) {
    document.getElementById('rejectPaymentId').textContent = paymentId;
    document.getElementById('rejectionReason').value = '';
    rejectModal.show();
}

function confirmReject() {
    const reason = document.getElementById('rejectionReason').value.trim();
    if (!reason) {
        alert('Please provide rejection reason');
        return;
    }
    alert('Payment rejected. Client will be notified. (DEMO)');
    rejectModal.hide();
    location.reload();
}
</script>

<style>
.payment-proof-card {
    height: 100%;
    display: flex;
    flex-direction: column;
}

.payment-proof-image {
    position: relative;
}

.payment-proof-image:hover::after {
    content: '\F3B2';
    font-family: 'bootstrap-icons';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    font-size: 3rem;
    color: white;
    text-shadow: 0 0 10px rgba(0,0,0,0.8);
}
</style>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
