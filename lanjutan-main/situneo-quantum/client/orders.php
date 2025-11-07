<?php
$page_id = 'orders';
$pageTitle = 'My Orders - SITUNEO DIGITAL';
$pageDescription = 'Track all your orders';
$pageHeading = 'My Orders';

include __DIR__ . '/../includes/client-header.php';

$current_user = getCurrentUser();

// Demo data for client orders
if (DEMO_MODE) {
    $orders = [
        [
            'order_id' => 'ORD-2025-001',
            'service' => 'Company Profile Website',
            'package' => 'BUSINESS',
            'amount' => 1500000,
            'status' => 'processing',
            'payment_status' => 'verified',
            'progress' => 65,
            'freelancer' => 'Developer Pro',
            'deadline' => '2025-01-25',
            'created_at' => '2025-01-10 14:30:00',
            'details' => 'Website 8 halaman dengan design modern minimalist. Include domain + hosting 2 tahun.',
            'demo_url' => null,
        ],
        [
            'order_id' => 'ORD-2025-006',
            'service' => 'Mobile App Development',
            'package' => 'ENTERPRISE',
            'amount' => 8000000,
            'status' => 'pending',
            'payment_status' => 'unpaid',
            'progress' => 0,
            'freelancer' => null,
            'deadline' => '2025-02-28',
            'created_at' => '2025-01-09 16:00:00',
            'details' => 'Hybrid mobile app (Android + iOS) dengan Flutter. Include backend API.',
            'demo_url' => null,
        ],
        [
            'order_id' => 'ORD-2024-180',
            'service' => 'SEO Optimization',
            'package' => null,
            'amount' => 500000,
            'status' => 'completed',
            'payment_status' => 'verified',
            'progress' => 100,
            'freelancer' => 'SEO Expert',
            'deadline' => '2025-01-20',
            'created_at' => '2024-12-20 10:00:00',
            'completed_at' => '2025-01-15 15:00:00',
            'details' => 'SEO On-Page optimization untuk 10 halaman. Include meta tags, sitemap, keyword research.',
            'demo_url' => null,
        ],
    ];
}

// Stats
$stats = [
    'all' => count($orders),
    'pending' => count(array_filter($orders, fn($o) => $o['status'] === 'pending')),
    'processing' => count(array_filter($orders, fn($o) => $o['status'] === 'processing')),
    'completed' => count(array_filter($orders, fn($o) => $o['status'] === 'completed')),
];

?>

<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">All Orders</h6>
            <h3 class="text-gold mb-0"><?= $stats['all'] ?></h3>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">Pending</h6>
            <h3 class="text-warning mb-0"><?= $stats['pending'] ?></h3>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">Processing</h6>
            <h3 class="text-info mb-0"><?= $stats['processing'] ?></h3>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">Completed</h6>
            <h3 class="text-success mb-0"><?= $stats['completed'] ?></h3>
        </div>
    </div>
</div>

<!-- Orders List -->
<?php if (empty($orders)): ?>
<div class="card-premium text-center py-5">
    <i class="bi bi-inbox display-4 text-muted mb-3"></i>
    <h5 class="text-light mb-3">Belum ada order</h5>
    <p class="text-muted mb-4">Mulai order layanan kami sekarang!</p>
    <a href="/calculator" class="btn btn-gold">
        <i class="bi bi-calculator me-2"></i>
        Hitung Harga & Order
    </a>
</div>
<?php else: ?>
<?php foreach ($orders as $order): ?>
<div class="card-premium mb-4">
    <div class="row">
        <!-- Left: Order Info -->
        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <h4 class="text-gold mb-2">
                        <i class="bi bi-box-seam me-2"></i>
                        <?= htmlspecialchars($order['service']) ?>
                    </h4>
                    <code class="text-muted"><?= $order['order_id'] ?></code>
                    <?php if ($order['package']): ?>
                    <span class="badge badge-gold ms-2"><?= $order['package'] ?></span>
                    <?php endif; ?>
                </div>
                <?php
                $status_badge = match($order['status']) {
                    'completed' => '<span class="badge bg-success">Completed</span>',
                    'processing' => '<span class="badge bg-info">Processing</span>',
                    'pending' => '<span class="badge bg-warning">Pending</span>',
                    'cancelled' => '<span class="badge bg-danger">Cancelled</span>',
                    default => '<span class="badge bg-secondary">Unknown</span>'
                };
                echo $status_badge;
                ?>
            </div>

            <p class="text-light mb-3"><?= htmlspecialchars($order['details']) ?></p>

            <!-- Progress Bar -->
            <div class="mb-3">
                <div class="d-flex justify-content-between mb-2">
                    <small class="text-light"><i class="bi bi-graph-up me-1"></i>Progress</small>
                    <small class="text-gold fw-bold"><?= $order['progress'] ?>%</small>
                </div>
                <div class="progress" style="height: 10px;">
                    <div class="progress-bar bg-gold" role="progressbar" style="width: <?= $order['progress'] ?>%"></div>
                </div>
            </div>

            <!-- Details Grid -->
            <div class="row g-3">
                <div class="col-md-4">
                    <small class="text-muted"><i class="bi bi-cash me-1"></i>Amount</small>
                    <p class="text-gold fw-bold mb-0"><?= formatRupiah($order['amount']) ?></p>
                </div>
                <div class="col-md-4">
                    <small class="text-muted"><i class="bi bi-credit-card me-1"></i>Payment</small>
                    <p class="mb-0">
                        <?php
                        $payment_badge = match($order['payment_status']) {
                            'verified' => '<span class="badge bg-success">Verified</span>',
                            'pending' => '<span class="badge bg-warning">Pending</span>',
                            'unpaid' => '<span class="badge bg-danger">Unpaid</span>',
                            default => '<span class="badge bg-secondary">-</span>'
                        };
                        echo $payment_badge;
                        ?>
                    </p>
                </div>
                <div class="col-md-4">
                    <small class="text-muted"><i class="bi bi-calendar me-1"></i>Deadline</small>
                    <p class="text-light mb-0"><?= date('d M Y', strtotime($order['deadline'])) ?></p>
                </div>
                <?php if ($order['freelancer']): ?>
                <div class="col-md-4">
                    <small class="text-muted"><i class="bi bi-person me-1"></i>Developer</small>
                    <p class="text-light mb-0"><?= $order['freelancer'] ?></p>
                </div>
                <?php endif; ?>
                <div class="col-md-4">
                    <small class="text-muted"><i class="bi bi-clock me-1"></i>Ordered</small>
                    <p class="text-light mb-0"><?= timeAgo($order['created_at']) ?></p>
                </div>
                <?php if (isset($order['completed_at'])): ?>
                <div class="col-md-4">
                    <small class="text-muted"><i class="bi bi-check-circle me-1"></i>Completed</small>
                    <p class="text-success mb-0"><?= timeAgo($order['completed_at']) ?></p>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Right: Actions -->
        <div class="col-lg-4">
            <div class="card bg-dark p-3 h-100">
                <h6 class="text-gold mb-3">
                    <i class="bi bi-lightning me-2"></i>
                    Actions
                </h6>

                <div class="d-grid gap-2">
                    <?php if ($order['payment_status'] === 'unpaid'): ?>
                    <a href="/client/payment-upload?order=<?= $order['order_id'] ?>" class="btn btn-warning">
                        <i class="bi bi-upload me-2"></i>
                        Upload Payment
                    </a>
                    <?php endif; ?>

                    <?php if ($order['demo_url']): ?>
                    <a href="<?= $order['demo_url'] ?>" target="_blank" class="btn btn-gold">
                        <i class="bi bi-eye me-2"></i>
                        View Demo
                    </a>
                    <?php endif; ?>

                    <a href="/client/invoices?order=<?= $order['order_id'] ?>" class="btn btn-outline-gold">
                        <i class="bi bi-receipt me-2"></i>
                        View Invoice
                    </a>

                    <a href="https://wa.me/6283173868915?text=Order%20<?= $order['order_id'] ?>" target="_blank" class="btn btn-outline-success">
                        <i class="bi bi-whatsapp me-2"></i>
                        Contact Support
                    </a>

                    <?php if ($order['status'] === 'completed'): ?>
                    <button class="btn btn-outline-info" onclick="leaveReview('<?= $order['order_id'] ?>')">
                        <i class="bi bi-star me-2"></i>
                        Leave Review
                    </button>
                    <?php endif; ?>
                </div>

                <?php if ($order['status'] === 'pending' && $order['payment_status'] === 'unpaid'): ?>
                <div class="alert alert-warning mt-3 mb-0 small">
                    <i class="bi bi-exclamation-triangle me-1"></i>
                    Menunggu pembayaran. Silakan upload bukti transfer.
                </div>
                <?php elseif ($order['status'] === 'processing'): ?>
                <div class="alert alert-info mt-3 mb-0 small">
                    <i class="bi bi-info-circle me-1"></i>
                    Order sedang dikerjakan oleh <?= $order['freelancer'] ?>
                </div>
                <?php elseif ($order['status'] === 'completed'): ?>
                <div class="alert alert-success mt-3 mb-0 small">
                    <i class="bi bi-check-circle me-1"></i>
                    Order selesai! Terima kasih sudah order.
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>
<?php endif; ?>

<!-- Modal: Leave Review -->
<div class="modal fade" id="reviewModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content bg-dark">
            <div class="modal-header border-gold">
                <h5 class="modal-title text-gold">Leave a Review</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label text-light">Rating</label>
                    <div class="rating-stars">
                        <i class="bi bi-star-fill text-gold fs-3" data-rating="1"></i>
                        <i class="bi bi-star-fill text-gold fs-3" data-rating="2"></i>
                        <i class="bi bi-star-fill text-gold fs-3" data-rating="3"></i>
                        <i class="bi bi-star-fill text-gold fs-3" data-rating="4"></i>
                        <i class="bi bi-star-fill text-gold fs-3" data-rating="5"></i>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label text-light">Review</label>
                    <textarea class="form-control" rows="4" placeholder="Share your experience..."></textarea>
                </div>
            </div>
            <div class="modal-footer border-gold">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-gold">Submit Review</button>
            </div>
        </div>
    </div>
</div>

<script>
let reviewModal;

document.addEventListener('DOMContentLoaded', function() {
    reviewModal = new bootstrap.Modal(document.getElementById('reviewModal'));
});

function leaveReview(orderId) {
    reviewModal.show();
}

// Rating stars interaction
document.querySelectorAll('.rating-stars i').forEach((star, index) => {
    star.addEventListener('click', function() {
        const rating = parseInt(this.dataset.rating);
        document.querySelectorAll('.rating-stars i').forEach((s, i) => {
            if (i < rating) {
                s.classList.remove('bi-star');
                s.classList.add('bi-star-fill');
            } else {
                s.classList.remove('bi-star-fill');
                s.classList.add('bi-star');
            }
        });
    });
});
</script>

<style>
.rating-stars i {
    cursor: pointer;
    margin: 0 2px;
    transition: all 0.2s;
}
.rating-stars i:hover {
    transform: scale(1.2);
}
.border-gold {
    border-color: rgba(212, 175, 55, 0.3) !important;
}
</style>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
