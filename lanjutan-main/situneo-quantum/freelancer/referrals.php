<?php
/**
 * FREELANCER - MY REFERRALS PAGE
 * List semua client yang direfer oleh freelancer
 */

$page_id = 'referrals';
$pageTitle = 'My Referrals - SITUNEO DIGITAL';
$pageDescription = 'Manage your referred clients and track their orders';

include __DIR__ . '/../includes/freelancer-header.php';

// Demo data - akan diganti dengan query database
$all_referrals = [
    [
        'id' => 1,
        'client_name' => 'Budi Santoso',
        'email' => 'budi@example.com',
        'phone' => '081234567890',
        'company' => 'Budi Store',
        'registered_date' => '2025-09-15',
        'total_orders' => 3,
        'total_spent' => 5500000,
        'total_commission' => 2200000,
        'last_order_date' => '2025-11-01',
        'status' => 'active',
    ],
    [
        'id' => 2,
        'client_name' => 'Ani Lestari',
        'email' => 'ani@example.com',
        'phone' => '081345678901',
        'company' => 'Ani Beauty Salon',
        'registered_date' => '2025-10-02',
        'total_orders' => 2,
        'total_spent' => 4000000,
        'total_commission' => 1600000,
        'last_order_date' => '2025-11-03',
        'status' => 'active',
    ],
    [
        'id' => 3,
        'client_name' => 'Toko Jaya',
        'email' => 'toko@example.com',
        'phone' => '082134567890',
        'company' => 'Toko Jaya Elektronik',
        'registered_date' => '2025-11-05',
        'total_orders' => 1,
        'total_spent' => 5000000,
        'total_commission' => 2000000,
        'last_order_date' => '2025-11-05',
        'status' => 'pending',
    ],
];

$summary = [
    'total_referrals' => 42,
    'active_clients' => 38,
    'total_orders' => 156,
    'total_commission_earned' => 62400000,
];

?>

<!-- Page Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="text-gold mb-2">
            <i class="bi bi-person-hearts me-2"></i>
            My Referrals
        </h2>
        <p class="text-muted mb-0">Manage all clients you've referred to Situneo</p>
    </div>
    <a href="/freelancer/demo-request" class="btn btn-gold">
        <i class="bi bi-plus-circle me-2"></i>
        Add New Client
    </a>
</div>

<!-- Summary Cards -->
<div class="row g-3 mb-4">
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <div class="d-flex align-items-center">
                <div class="stat-icon bg-primary me-3">
                    <i class="bi bi-people-fill"></i>
                </div>
                <div>
                    <div class="text-muted small">Total Referrals</div>
                    <h4 class="text-gold mb-0"><?= $summary['total_referrals'] ?></h4>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <div class="d-flex align-items-center">
                <div class="stat-icon bg-success me-3">
                    <i class="bi bi-check-circle-fill"></i>
                </div>
                <div>
                    <div class="text-muted small">Active Clients</div>
                    <h4 class="text-gold mb-0"><?= $summary['active_clients'] ?></h4>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <div class="d-flex align-items-center">
                <div class="stat-icon bg-info me-3">
                    <i class="bi bi-bag-check-fill"></i>
                </div>
                <div>
                    <div class="text-muted small">Total Orders</div>
                    <h4 class="text-gold mb-0"><?= $summary['total_orders'] ?></h4>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <div class="d-flex align-items-center">
                <div class="stat-icon bg-warning me-3">
                    <i class="bi bi-cash-stack"></i>
                </div>
                <div>
                    <div class="text-muted small">Total Commission</div>
                    <h4 class="text-gold mb-0"><?= formatRupiah($summary['total_commission_earned']) ?></h4>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filters -->
<div class="card-premium mb-4">
    <div class="row g-3">
        <div class="col-md-4">
            <input type="text" class="form-control" placeholder="Search by name, email, company...">
        </div>
        <div class="col-md-3">
            <select class="form-control">
                <option value="">All Status</option>
                <option value="active">Active</option>
                <option value="pending">Pending</option>
                <option value="inactive">Inactive</option>
            </select>
        </div>
        <div class="col-md-3">
            <select class="form-control">
                <option value="">Sort by</option>
                <option value="recent">Most Recent</option>
                <option value="orders">Most Orders</option>
                <option value="commission">Highest Commission</option>
            </select>
        </div>
        <div class="col-md-2">
            <button class="btn btn-gold w-100">
                <i class="bi bi-funnel me-2"></i>
                Filter
            </button>
        </div>
    </div>
</div>

<!-- Referrals Table -->
<div class="card-premium">
    <div class="table-responsive">
        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <th>Client Info</th>
                    <th>Company</th>
                    <th>Registered</th>
                    <th>Orders</th>
                    <th>Total Spent</th>
                    <th>Your Commission</th>
                    <th>Last Order</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($all_referrals as $ref): ?>
                <tr>
                    <td>
                        <div>
                            <strong class="text-light"><?= htmlspecialchars($ref['client_name']) ?></strong><br>
                            <small class="text-muted"><?= htmlspecialchars($ref['email']) ?></small><br>
                            <small class="text-muted">
                                <i class="bi bi-phone me-1"></i><?= htmlspecialchars($ref['phone']) ?>
                            </small>
                        </div>
                    </td>
                    <td class="text-light"><?= htmlspecialchars($ref['company']) ?></td>
                    <td class="text-muted small"><?= date('d M Y', strtotime($ref['registered_date'])) ?></td>
                    <td>
                        <span class="badge bg-info"><?= $ref['total_orders'] ?> orders</span>
                    </td>
                    <td class="text-light"><?= formatRupiah($ref['total_spent']) ?></td>
                    <td class="text-gold fw-bold"><?= formatRupiah($ref['total_commission']) ?></td>
                    <td class="text-muted small"><?= date('d M Y', strtotime($ref['last_order_date'])) ?></td>
                    <td>
                        <?php
                        $badge_class = $ref['status'] === 'active' ? 'success' : ($ref['status'] === 'pending' ? 'warning' : 'secondary');
                        ?>
                        <span class="badge bg-<?= $badge_class ?>"><?= ucfirst($ref['status']) ?></span>
                    </td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <button class="btn btn-outline-info" title="View Details" onclick="viewClient(<?= $ref['id'] ?>)">
                                <i class="bi bi-eye"></i>
                            </button>
                            <a href="https://wa.me/<?= $ref['phone'] ?>" target="_blank" class="btn btn-outline-success" title="WhatsApp">
                                <i class="bi bi-whatsapp"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-between align-items-center mt-4">
        <div class="text-muted small">
            Showing 1-3 of <?= $summary['total_referrals'] ?> referrals
        </div>
        <nav>
            <ul class="pagination pagination-sm mb-0">
                <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul>
        </nav>
    </div>
</div>

<script>
function viewClient(clientId) {
    alert('Opening client details for ID: ' + clientId);
    // TODO: Show modal with client order history and details
}
</script>

<style>
.stat-icon {
    width: 50px;
    height: 50px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
}
</style>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
