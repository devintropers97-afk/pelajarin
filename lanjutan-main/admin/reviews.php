<?php
$page_id = 'reviews';
$pageTitle = 'Reviews Moderation - SITUNEO DIGITAL';
$pageDescription = 'Manage customer reviews';
$pageHeading = 'Reviews Moderation';

include __DIR__ . '/../includes/admin-header.php';

// Demo data
if (DEMO_MODE) {
    $reviews = [
        ['id' => 1, 'user' => 'John Doe', 'order_id' => 'ORD-2024-180', 'service' => 'SEO Optimization', 'rating' => 5, 'comment' => 'Excellent service! Website traffic increased significantly.', 'status' => 'approved', 'created_at' => '2025-01-10 14:00:00'],
        ['id' => 2, 'user' => 'Jane Smith', 'order_id' => 'ORD-2025-003', 'service' => 'Mobile App UI', 'rating' => 5, 'comment' => 'Beautiful design, very professional work!', 'status' => 'approved', 'created_at' => '2025-01-15 10:00:00'],
        ['id' => 3, 'user' => 'Mike Brown', 'order_id' => 'ORD-2025-008', 'service' => 'E-Commerce Website', 'rating' => 4, 'comment' => 'Good quality, but delivery was a bit late.', 'status' => 'pending', 'created_at' => '2025-01-18 16:00:00'],
        ['id' => 4, 'user' => 'Sarah Wilson', 'order_id' => 'ORD-2025-001', 'service' => 'Company Profile', 'rating' => 5, 'comment' => 'Perfect! Exactly what I wanted.', 'status' => 'approved', 'created_at' => '2025-01-12 11:00:00'],
    ];
}

// Stats
$total = count($reviews);
$approved = count(array_filter($reviews, fn($r) => $r['status'] === 'approved'));
$pending = count(array_filter($reviews, fn($r) => $r['status'] === 'pending'));
$avg_rating = round(array_sum(array_map(fn($r) => $r['rating'], $reviews)) / count($reviews), 1);

?>

<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">Total Reviews</h6>
            <h3 class="text-gold mb-0"><?= $total ?></h3>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">Approved</h6>
            <h3 class="text-success mb-0"><?= $approved ?></h3>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">Pending</h6>
            <h3 class="text-warning mb-0"><?= $pending ?></h3>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">Average Rating</h6>
            <h3 class="text-warning mb-0">
                <?= $avg_rating ?> <i class="bi bi-star-fill fs-5"></i>
            </h3>
        </div>
    </div>
</div>

<!-- Reviews List -->
<?php foreach ($reviews as $review): ?>
<div class="card-premium mb-3">
    <div class="row">
        <div class="col-lg-8">
            <div class="d-flex gap-3 mb-3">
                <img src="https://ui-avatars.com/api/?name=<?= urlencode($review['user']) ?>&size=60" class="rounded-circle" style="width: 60px; height: 60px;">
                <div class="flex-grow-1">
                    <h6 class="text-gold mb-1"><?= htmlspecialchars($review['user']) ?></h6>
                    <div class="mb-2">
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <i class="bi bi-star<?= $i <= $review['rating'] ? '-fill' : '' ?> text-warning"></i>
                        <?php endfor; ?>
                        <span class="text-muted ms-2"><?= timeAgo($review['created_at']) ?></span>
                    </div>
                    <p class="text-light mb-2"><?= htmlspecialchars($review['comment']) ?></p>
                    <small class="text-muted">
                        <code><?= $review['order_id'] ?></code> - <?= htmlspecialchars($review['service']) ?>
                    </small>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card bg-dark p-3">
                <?= $review['status'] === 'approved' ?
                    '<span class="badge bg-success mb-3">Approved</span>' :
                    '<span class="badge bg-warning mb-3">Pending</span>' ?>

                <div class="d-grid gap-2">
                    <?php if ($review['status'] === 'pending'): ?>
                    <button class="btn btn-success btn-sm" onclick="approveReview(<?= $review['id'] ?>)">
                        <i class="bi bi-check-circle me-2"></i>Approve
                    </button>
                    <button class="btn btn-danger btn-sm" onclick="rejectReview(<?= $review['id'] ?>)">
                        <i class="bi bi-x-circle me-2"></i>Reject
                    </button>
                    <?php else: ?>
                    <button class="btn btn-outline-secondary btn-sm" onclick="unapproveReview(<?= $review['id'] ?>)">
                        <i class="bi bi-x-circle me-2"></i>Unapprove
                    </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

<script>
function approveReview(id) {
    if (confirm('Approve this review?')) {
        alert('Review approved!');
        location.reload();
    }
}

function rejectReview(id) {
    if (confirm('Reject this review? It will be deleted.')) {
        alert('Review rejected!');
        location.reload();
    }
}

function unapproveReview(id) {
    if (confirm('Unapprove this review?')) {
        alert('Review unapproved!');
        location.reload();
    }
}
</script>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
