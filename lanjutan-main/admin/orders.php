<?php
$page_id = 'orders';
$pageTitle = 'Orders Management - Admin Dashboard';
$pageDescription = 'Manage all customer orders';
$pageHeading = 'Orders Management';

include __DIR__ . '/../includes/admin-header.php';

// Filters
$status_filter = isset($_GET['status']) ? sanitize($_GET['status']) : 'all';
$search = isset($_GET['search']) ? sanitize($_GET['search']) : '';

// Demo data
if (DEMO_MODE) {
    $orders = [
        ['order_id' => 'ORD-2025-001', 'user_id' => 2, 'client_name' => 'John Doe', 'service' => 'Company Profile Website', 'package' => 'BUSINESS', 'amount' => 1500000, 'status' => 'pending', 'payment_status' => 'pending', 'freelancer' => null, 'created_at' => '2025-01-10 14:30:00', 'deadline' => '2025-01-25'],
        ['order_id' => 'ORD-2025-002', 'user_id' => 3, 'client_name' => 'Jane Smith', 'service' => 'E-Commerce Website', 'package' => 'PREMIUM', 'amount' => 2000000, 'status' => 'processing', 'payment_status' => 'verified', 'freelancer' => 'Developer Pro', 'created_at' => '2025-01-10 13:15:00', 'deadline' => '2025-01-27'],
        ['order_id' => 'ORD-2025-003', 'user_id' => 8, 'client_name' => 'Budi Santoso', 'service' => 'SEO Optimization', 'package' => null, 'amount' => 500000, 'status' => 'completed', 'payment_status' => 'verified', 'freelancer' => 'SEO Expert', 'created_at' => '2025-01-10 11:45:00', 'deadline' => '2025-01-20'],
        ['order_id' => 'ORD-2025-004', 'user_id' => 5, 'client_name' => 'Sarah Wijaya', 'service' => 'Logo Design', 'package' => null, 'amount' => 500000, 'status' => 'pending', 'payment_status' => 'pending', 'freelancer' => null, 'created_at' => '2025-01-10 10:20:00', 'deadline' => '2025-01-18'],
        ['order_id' => 'ORD-2025-005', 'user_id' => 8, 'client_name' => 'Ahmad Yani', 'service' => 'Google Ads Management', 'package' => null, 'amount' => 1000000, 'status' => 'processing', 'payment_status' => 'verified', 'freelancer' => 'Marketing Guru', 'created_at' => '2025-01-10 09:00:00', 'deadline' => '2025-02-10'],
        ['order_id' => 'ORD-2025-006', 'user_id' => 2, 'client_name' => 'John Doe', 'service' => 'Mobile App Development', 'package' => 'ENTERPRISE', 'amount' => 8000000, 'status' => 'pending', 'payment_status' => 'pending', 'freelancer' => null, 'created_at' => '2025-01-09 16:00:00', 'deadline' => '2025-02-28'],
        ['order_id' => 'ORD-2024-187', 'user_id' => 3, 'client_name' => 'Jane Smith', 'service' => 'Social Media Management', 'package' => null, 'amount' => 1500000, 'status' => 'cancelled', 'payment_status' => 'refunded', 'freelancer' => null, 'created_at' => '2024-12-20 10:00:00', 'deadline' => null],
    ];

    // Apply filters
    if ($status_filter !== 'all') {
        $orders = array_filter($orders, fn($o) => $o['status'] === $status_filter);
    }
    if (!empty($search)) {
        $orders = array_filter($orders, fn($o) =>
            stripos($o['order_id'], $search) !== false ||
            stripos($o['client_name'], $search) !== false ||
            stripos($o['service'], $search) !== false
        );
    }

    $total_orders = count($orders);
}

// Stats
$stats = [
    'total' => DEMO_MODE ? 187 : 0,
    'pending' => DEMO_MODE ? 23 : 0,
    'processing' => DEMO_MODE ? 45 : 0,
    'completed' => DEMO_MODE ? 115 : 0,
    'cancelled' => DEMO_MODE ? 4 : 0,
];

?>

<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-1">Total Orders</h6>
                    <h3 class="text-gold mb-0"><?= number_format($stats['total']) ?></h3>
                </div>
                <i class="bi bi-cart-check-fill text-gold" style="font-size: 2.5rem;"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-1">Pending</h6>
                    <h3 class="text-warning mb-0"><?= number_format($stats['pending']) ?></h3>
                </div>
                <i class="bi bi-clock-fill text-warning" style="font-size: 2.5rem;"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-1">Processing</h6>
                    <h3 class="text-info mb-0"><?= number_format($stats['processing']) ?></h3>
                </div>
                <i class="bi bi-gear-fill text-info" style="font-size: 2.5rem;"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-1">Completed</h6>
                    <h3 class="text-success mb-0"><?= number_format($stats['completed']) ?></h3>
                </div>
                <i class="bi bi-check-circle-fill text-success" style="font-size: 2.5rem;"></i>
            </div>
        </div>
    </div>
</div>

<!-- Filters -->
<div class="card-premium mb-4">
    <form method="GET" action="/admin/orders" class="row g-3">
        <div class="col-lg-3 col-md-6">
            <label class="form-label text-light">Status</label>
            <select name="status" class="form-control" onchange="this.form.submit()">
                <option value="all" <?= $status_filter === 'all' ? 'selected' : '' ?>>All Status</option>
                <option value="pending" <?= $status_filter === 'pending' ? 'selected' : '' ?>>Pending</option>
                <option value="processing" <?= $status_filter === 'processing' ? 'selected' : '' ?>>Processing</option>
                <option value="completed" <?= $status_filter === 'completed' ? 'selected' : '' ?>>Completed</option>
                <option value="cancelled" <?= $status_filter === 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
            </select>
        </div>

        <div class="col-lg-7 col-md-12">
            <label class="form-label text-light">Search</label>
            <input type="text" name="search" class="form-control" placeholder="Order ID, client, or service..." value="<?= htmlspecialchars($search) ?>">
        </div>

        <div class="col-lg-2 col-md-6">
            <label class="form-label text-light">&nbsp;</label>
            <button type="submit" class="btn btn-gold w-100">
                <i class="bi bi-search me-2"></i>Search
            </button>
        </div>
    </form>
</div>

<!-- Orders Table -->
<div class="card-premium">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="text-gold mb-0">
            <i class="bi bi-list-ul me-2"></i>
            All Orders (<?= $total_orders ?>)
        </h5>
    </div>

    <div class="table-responsive">
        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Client</th>
                    <th>Service</th>
                    <th>Package</th>
                    <th>Amount</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th>Freelancer</th>
                    <th>Deadline</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($orders)): ?>
                <tr>
                    <td colspan="10" class="text-center text-muted py-5">
                        <i class="bi bi-inbox display-4 d-block mb-3"></i>
                        No orders found
                    </td>
                </tr>
                <?php else: ?>
                <?php foreach ($orders as $order): ?>
                <tr>
                    <td><code><?= $order['order_id'] ?></code></td>
                    <td><?= htmlspecialchars($order['client_name']) ?></td>
                    <td><?= htmlspecialchars($order['service']) ?></td>
                    <td>
                        <?= $order['package'] ? '<span class="badge badge-gold">' . $order['package'] . '</span>' : '<span class="text-muted">-</span>' ?>
                    </td>
                    <td><?= formatRupiah($order['amount']) ?></td>
                    <td>
                        <?php
                        $payment_badge = match($order['payment_status']) {
                            'verified' => '<span class="badge bg-success">Verified</span>',
                            'pending' => '<span class="badge bg-warning">Pending</span>',
                            'refunded' => '<span class="badge bg-info">Refunded</span>',
                            default => '<span class="badge bg-secondary">-</span>'
                        };
                        echo $payment_badge;
                        ?>
                    </td>
                    <td>
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
                    </td>
                    <td>
                        <?php if ($order['freelancer']): ?>
                        <span class="text-light"><?= $order['freelancer'] ?></span>
                        <?php else: ?>
                        <button class="btn btn-sm btn-outline-gold" onclick="assignFreelancer('<?= $order['order_id'] ?>')">
                            <i class="bi bi-person-plus"></i> Assign
                        </button>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($order['deadline']): ?>
                        <small><?= date('d M Y', strtotime($order['deadline'])) ?></small>
                        <?php else: ?>
                        <span class="text-muted">-</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="/admin/orders/view?id=<?= $order['order_id'] ?>"
                               class="btn btn-outline-info"
                               title="View Details">
                                <i class="bi bi-eye"></i>
                            </a>
                            <button onclick="updateStatus('<?= $order['order_id'] ?>')"
                                    class="btn btn-outline-warning"
                                    title="Update Status">
                                <i class="bi bi-pencil"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal: Assign Freelancer -->
<div class="modal fade" id="assignFreelancerModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content bg-dark">
            <div class="modal-header border-gold">
                <h5 class="modal-title text-gold">Assign Freelancer</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="text-light">Order ID: <code id="assignOrderId"></code></p>
                <div class="mb-3">
                    <label class="form-label text-light">Select Freelancer</label>
                    <select class="form-control" id="freelancerSelect">
                        <option value="">Choose freelancer...</option>
                        <option value="1">Developer Pro</option>
                        <option value="2">Designer Creative</option>
                        <option value="3">SEO Expert</option>
                        <option value="4">Marketing Guru</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer border-gold">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-gold" onclick="confirmAssign()">Assign</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Update Status -->
<div class="modal fade" id="updateStatusModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content bg-dark">
            <div class="modal-header border-gold">
                <h5 class="modal-title text-gold">Update Order Status</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p class="text-light">Order ID: <code id="statusOrderId"></code></p>
                <div class="mb-3">
                    <label class="form-label text-light">New Status</label>
                    <select class="form-control" id="statusSelect">
                        <option value="pending">Pending</option>
                        <option value="processing">Processing</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label text-light">Notes (optional)</label>
                    <textarea class="form-control" rows="3" placeholder="Add notes..."></textarea>
                </div>
            </div>
            <div class="modal-footer border-gold">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-gold" onclick="confirmUpdate()">Update</button>
            </div>
        </div>
    </div>
</div>

<script>
let assignModal, statusModal;

document.addEventListener('DOMContentLoaded', function() {
    assignModal = new bootstrap.Modal(document.getElementById('assignFreelancerModal'));
    statusModal = new bootstrap.Modal(document.getElementById('updateStatusModal'));
});

function assignFreelancer(orderId) {
    document.getElementById('assignOrderId').textContent = orderId;
    assignModal.show();
}

function confirmAssign() {
    const freelancerId = document.getElementById('freelancerSelect').value;
    if (!freelancerId) {
        alert('Please select a freelancer');
        return;
    }
    alert('Freelancer assigned (DEMO)');
    assignModal.hide();
    location.reload();
}

function updateStatus(orderId) {
    document.getElementById('statusOrderId').textContent = orderId;
    statusModal.show();
}

function confirmUpdate() {
    alert('Status updated (DEMO)');
    statusModal.hide();
    location.reload();
}
</script>

<style>
.border-gold {
    border-color: rgba(212, 175, 55, 0.3) !important;
}
</style>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
