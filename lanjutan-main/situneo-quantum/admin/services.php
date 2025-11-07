<?php
$page_id = 'services';
$pageTitle = 'Services Management - SITUNEO DIGITAL';
$pageDescription = 'Manage all services';
$pageHeading = 'Services Management';

include __DIR__ . '/../includes/admin-header.php';

$filter_division = isset($_GET['division']) ? $_GET['division'] : 'all';
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Demo data - 20 sample services from different divisions
if (DEMO_MODE) {
    $services = [
        ['id' => 1, 'name' => 'Company Profile Website', 'division' => 'Website Development', 'base_price' => 2500000, 'status' => 'active', 'orders_count' => 45],
        ['id' => 2, 'name' => 'E-Commerce Website', 'division' => 'Website Development', 'base_price' => 5500000, 'status' => 'active', 'orders_count' => 32],
        ['id' => 3, 'name' => 'Landing Page', 'division' => 'Website Development', 'base_price' => 800000, 'status' => 'active', 'orders_count' => 78],
        ['id' => 4, 'name' => 'SEO Optimization', 'division' => 'SEO & Digital Marketing', 'base_price' => 500000, 'status' => 'active', 'orders_count' => 56],
        ['id' => 5, 'name' => 'Google Ads Campaign', 'division' => 'SEO & Digital Marketing', 'base_price' => 3000000, 'status' => 'active', 'orders_count' => 28],
        ['id' => 6, 'name' => 'Social Media Marketing', 'division' => 'SEO & Digital Marketing', 'base_price' => 2000000, 'status' => 'active', 'orders_count' => 41],
        ['id' => 7, 'name' => 'Logo Design', 'division' => 'Branding & Design', 'base_price' => 500000, 'status' => 'active', 'orders_count' => 92],
        ['id' => 8, 'name' => 'Brand Identity Package', 'division' => 'Branding & Design', 'base_price' => 2000000, 'status' => 'active', 'orders_count' => 35],
        ['id' => 9, 'name' => 'UI/UX Design', 'division' => 'Branding & Design', 'base_price' => 3000000, 'status' => 'active', 'orders_count' => 27],
        ['id' => 10, 'name' => 'Mobile App Development', 'division' => 'Mobile Development', 'base_price' => 8000000, 'status' => 'active', 'orders_count' => 18],
        ['id' => 11, 'name' => 'Chatbot AI', 'division' => 'AI & Automation', 'base_price' => 4000000, 'status' => 'active', 'orders_count' => 15],
        ['id' => 12, 'name' => 'Content Writing', 'division' => 'Content Creation', 'base_price' => 350000, 'status' => 'active', 'orders_count' => 64],
        ['id' => 13, 'name' => 'Video Editing', 'division' => 'Content Creation', 'base_price' => 1000000, 'status' => 'active', 'orders_count' => 38],
        ['id' => 14, 'name' => 'WordPress Maintenance', 'division' => 'Website Development', 'base_price' => 500000, 'status' => 'active', 'orders_count' => 52],
        ['id' => 15, 'name' => 'Instagram Ads', 'division' => 'SEO & Digital Marketing', 'base_price' => 2500000, 'status' => 'active', 'orders_count' => 33],
        ['id' => 16, 'name' => 'Business Card Design', 'division' => 'Branding & Design', 'base_price' => 200000, 'status' => 'active', 'orders_count' => 88],
        ['id' => 17, 'name' => 'Google Analytics Setup', 'division' => 'Analytics & Tracking', 'base_price' => 800000, 'status' => 'active', 'orders_count' => 42],
        ['id' => 18, 'name' => 'Email Marketing', 'division' => 'SEO & Digital Marketing', 'base_price' => 1500000, 'status' => 'active', 'orders_count' => 29],
        ['id' => 19, 'name' => 'CRM System', 'division' => 'E-Commerce Solutions', 'base_price' => 6000000, 'status' => 'active', 'orders_count' => 12],
        ['id' => 20, 'name' => 'API Integration', 'division' => 'Website Development', 'base_price' => 2000000, 'status' => 'inactive', 'orders_count' => 8],
    ];

    // Filter by division
    if ($filter_division !== 'all') {
        $services = array_filter($services, fn($s) => $s['division'] === $filter_division);
    }

    // Search
    if ($search) {
        $services = array_filter($services, fn($s) =>
            stripos($s['name'], $search) !== false || stripos($s['division'], $search) !== false
        );
    }
}

$divisions = [
    'Website Development',
    'SEO & Digital Marketing',
    'Branding & Design',
    'Mobile Development',
    'AI & Automation',
    'Content Creation',
    'Analytics & Tracking',
    'E-Commerce Solutions',
];

// Stats
$total = 232; // Total services in system
$active = 220;
$inactive = 12;
$total_orders = array_sum(array_map(fn($s) => $s['orders_count'], $services));

?>

<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">Total Services</h6>
            <h3 class="text-gold mb-0"><?= $total ?></h3>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">Active</h6>
            <h3 class="text-success mb-0"><?= $active ?></h3>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">Inactive</h6>
            <h3 class="text-secondary mb-0"><?= $inactive ?></h3>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">Total Orders</h6>
            <h3 class="text-info mb-0"><?= $total_orders ?></h3>
        </div>
    </div>
</div>

<!-- Filters & Actions -->
<div class="card-premium mb-4">
    <div class="row g-3 align-items-center">
        <div class="col-md-4">
            <input type="text" class="form-control" id="searchInput" placeholder="Search services..." value="<?= htmlspecialchars($search) ?>">
        </div>
        <div class="col-md-4">
            <select class="form-select" id="divisionFilter">
                <option value="all">All Divisions</option>
                <?php foreach ($divisions as $div): ?>
                <option value="<?= htmlspecialchars($div) ?>" <?= $filter_division === $div ? 'selected' : '' ?>>
                    <?= htmlspecialchars($div) ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-4 text-end">
            <button class="btn btn-gold" data-bs-toggle="modal" data-bs-target="#addServiceModal">
                <i class="bi bi-plus-circle me-2"></i>
                Add New Service
            </button>
        </div>
    </div>
</div>

<!-- Services Table -->
<div class="card-premium">
    <h5 class="text-gold mb-4">
        <i class="bi bi-grid me-2"></i>
        Services List (<?= count($services) ?> showing)
    </h5>

    <div class="table-responsive">
        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Service Name</th>
                    <th>Division</th>
                    <th>Base Price</th>
                    <th>Orders</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($services as $service): ?>
                <tr>
                    <td><code><?= $service['id'] ?></code></td>
                    <td class="text-light fw-bold"><?= htmlspecialchars($service['name']) ?></td>
                    <td><span class="badge badge-gold"><?= htmlspecialchars($service['division']) ?></span></td>
                    <td class="text-gold"><?= formatRupiah($service['base_price']) ?></td>
                    <td class="text-muted"><?= $service['orders_count'] ?> orders</td>
                    <td>
                        <?= $service['status'] === 'active' ?
                            '<span class="badge bg-success">Active</span>' :
                            '<span class="badge bg-secondary">Inactive</span>' ?>
                    </td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <button class="btn btn-outline-info" onclick="viewService(<?= $service['id'] ?>)">
                                <i class="bi bi-eye"></i>
                            </button>
                            <button class="btn btn-outline-warning" onclick="editService(<?= $service['id'] ?>)">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <button class="btn btn-outline-<?= $service['status'] === 'active' ? 'secondary' : 'success' ?>"
                                    onclick="toggleStatus(<?= $service['id'] ?>, '<?= $service['status'] ?>')">
                                <i class="bi bi-<?= $service['status'] === 'active' ? 'pause' : 'play' ?>"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Add/Edit Service Modal -->
<div class="modal fade" id="addServiceModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-dark">
            <div class="modal-header border-gold">
                <h5 class="modal-title text-gold">
                    <i class="bi bi-plus-circle me-2"></i>
                    Add New Service
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="serviceForm">
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label text-light">Service Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="serviceName" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-light">Base Price <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="text" class="form-control" id="servicePrice" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-light">Division <span class="text-danger">*</span></label>
                            <select class="form-select" id="serviceDivision" required>
                                <option value="">-- Select Division --</option>
                                <?php foreach ($divisions as $div): ?>
                                <option value="<?= htmlspecialchars($div) ?>"><?= htmlspecialchars($div) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-light">Status</label>
                            <select class="form-select" id="serviceStatus">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label text-light">Description</label>
                            <textarea class="form-control" id="serviceDescription" rows="3"></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-gold">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-gold" onclick="submitService()">
                    <i class="bi bi-save me-2"></i>
                    Save Service
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let addServiceModal;

document.addEventListener('DOMContentLoaded', function() {
    addServiceModal = new bootstrap.Modal(document.getElementById('addServiceModal'));

    // Search
    document.getElementById('searchInput').addEventListener('input', function() {
        const search = this.value;
        window.location.href = `?search=${encodeURIComponent(search)}&division=<?= $filter_division ?>`;
    });

    // Division filter
    document.getElementById('divisionFilter').addEventListener('change', function() {
        const division = this.value;
        window.location.href = `?division=${division}&search=<?= urlencode($search) ?>`;
    });

    // Price formatting
    document.getElementById('servicePrice').addEventListener('input', function() {
        let value = this.value.replace(/[^\d]/g, '');
        this.value = formatNumber(value);
    });
});

function viewService(id) {
    alert(`View service ${id} details`);
}

function editService(id) {
    alert(`Edit service ${id}`);
    addServiceModal.show();
}

function toggleStatus(id, currentStatus) {
    const newStatus = currentStatus === 'active' ? 'inactive' : 'active';
    if (confirm(`${newStatus === 'inactive' ? 'Deactivate' : 'Activate'} this service?`)) {
        alert(`Service ${id} ${newStatus === 'inactive' ? 'deactivated' : 'activated'}`);
        location.reload();
    }
}

function submitService() {
    const name = document.getElementById('serviceName').value;
    const price = document.getElementById('servicePrice').value;
    const division = document.getElementById('serviceDivision').value;

    if (!name || !price || !division) {
        alert('Please fill all required fields');
        return;
    }

    alert('Service saved successfully!');
    addServiceModal.hide();
    location.reload();
}

function formatNumber(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}
</script>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
