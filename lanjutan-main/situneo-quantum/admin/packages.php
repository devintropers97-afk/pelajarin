<?php
$page_id = 'packages';
$pageTitle = 'Packages Management - SITUNEO DIGITAL';
$pageDescription = 'Manage service packages';
$pageHeading = 'Packages Management';

include __DIR__ . '/../includes/admin-header.php';

// Demo data for packages
if (DEMO_MODE) {
    $packages = [
        ['id' => 1, 'name' => 'STARTER', 'price' => 2500000, 'description' => 'Perfect for small businesses', 'features' => 'Website 5 halaman|Domain .com|Hosting 1 tahun|SSL Certificate|Responsive Design', 'popular' => false, 'status' => 'active', 'orders_count' => 45],
        ['id' => 2, 'name' => 'BUSINESS', 'price' => 4000000, 'description' => 'Best for growing companies', 'features' => 'Website 8-10 halaman|Domain .com|Hosting 1 tahun|SSL Certificate|Responsive Design|SEO Basic|Google Analytics', 'popular' => true, 'status' => 'active', 'orders_count' => 78],
        ['id' => 3, 'name' => 'PREMIUM', 'price' => 6500000, 'description' => 'Advanced features for professionals', 'features' => 'Website 15 halaman|Domain .com|Hosting 2 tahun|SSL Certificate|Responsive Design|SEO Advanced|Google Analytics|Content Management', 'popular' => false, 'status' => 'active', 'orders_count' => 52],
        ['id' => 4, 'name' => 'ENTERPRISE', 'price' => 15000000, 'description' => 'Complete solution for large business', 'features' => 'Website Unlimited|Domain .com + .id|Hosting 3 tahun|SSL Certificate|Responsive Design|SEO Advanced|Analytics & Tracking|CRM Integration|Priority Support', 'popular' => false, 'status' => 'active', 'orders_count' => 23],
        ['id' => 5, 'name' => 'E-COMMERCE', 'price' => 5500000, 'description' => 'Online store solution', 'features' => 'E-Commerce Website|Payment Gateway|Product Management|Order Management|Customer Management|Responsive Design|SSL Certificate|Hosting 1 tahun', 'popular' => false, 'status' => 'active', 'orders_count' => 34],
        ['id' => 6, 'name' => 'MARKETPLACE', 'price' => 18000000, 'description' => 'Multi-vendor platform', 'features' => 'Marketplace Platform|Multi-vendor System|Commission Management|Payment Gateway|Advanced Dashboard|Mobile App Ready|Hosting 2 tahun|Priority Support', 'popular' => false, 'status' => 'inactive', 'orders_count' => 8],
    ];
}

// Stats
$total = count($packages);
$active = count(array_filter($packages, fn($p) => $p['status'] === 'active'));
$popular = count(array_filter($packages, fn($p) => $p['popular']));
$total_orders = array_sum(array_map(fn($p) => $p['orders_count'], $packages));

?>

<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">Total Packages</h6>
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
            <h6 class="text-muted mb-2">Popular</h6>
            <h3 class="text-warning mb-0"><?= $popular ?></h3>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">Total Orders</h6>
            <h3 class="text-info mb-0"><?= $total_orders ?></h3>
        </div>
    </div>
</div>

<!-- Header Actions -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div></div>
    <button class="btn btn-gold" data-bs-toggle="modal" data-bs-target="#addPackageModal">
        <i class="bi bi-plus-circle me-2"></i>
        Add New Package
    </button>
</div>

<!-- Packages Grid -->
<div class="row g-4">
    <?php foreach ($packages as $package): ?>
    <div class="col-lg-4 col-md-6">
        <div class="card-premium h-100 <?= $package['popular'] ? 'border-gold' : '' ?>" style="position: relative;">
            <?php if ($package['popular']): ?>
            <div class="position-absolute top-0 end-0 m-3">
                <span class="badge bg-gold">MOST POPULAR</span>
            </div>
            <?php endif; ?>

            <div class="text-center mb-4">
                <h3 class="text-gold mb-2"><?= htmlspecialchars($package['name']) ?></h3>
                <p class="text-muted mb-3"><?= htmlspecialchars($package['description']) ?></p>
                <h2 class="text-light mb-0"><?= formatRupiah($package['price']) ?></h2>
            </div>

            <div class="mb-4">
                <h6 class="text-gold mb-3">Features:</h6>
                <ul class="list-unstyled">
                    <?php
                    $features = explode('|', $package['features']);
                    foreach ($features as $feature):
                    ?>
                    <li class="mb-2">
                        <i class="bi bi-check-circle text-success me-2"></i>
                        <span class="text-light"><?= htmlspecialchars($feature) ?></span>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="mt-auto">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <small class="text-muted"><?= $package['orders_count'] ?> orders</small>
                    <?= $package['status'] === 'active' ?
                        '<span class="badge bg-success">Active</span>' :
                        '<span class="badge bg-secondary">Inactive</span>' ?>
                </div>

                <div class="d-grid gap-2">
                    <button class="btn btn-outline-warning btn-sm" onclick="editPackage(<?= $package['id'] ?>)">
                        <i class="bi bi-pencil me-2"></i>
                        Edit Package
                    </button>
                    <div class="btn-group btn-group-sm">
                        <button class="btn btn-outline-<?= $package['popular'] ? 'secondary' : 'gold' ?>"
                                onclick="togglePopular(<?= $package['id'] ?>, <?= $package['popular'] ? 'false' : 'true' ?>)">
                            <i class="bi bi-star<?= $package['popular'] ? '-fill' : '' ?>"></i>
                            <?= $package['popular'] ? 'Remove Popular' : 'Set Popular' ?>
                        </button>
                        <button class="btn btn-outline-<?= $package['status'] === 'active' ? 'secondary' : 'success' ?>"
                                onclick="toggleStatus(<?= $package['id'] ?>, '<?= $package['status'] ?>')">
                            <i class="bi bi-<?= $package['status'] === 'active' ? 'pause' : 'play' ?>-circle"></i>
                            <?= $package['status'] === 'active' ? 'Deactivate' : 'Activate' ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<!-- Add/Edit Package Modal -->
<div class="modal fade" id="addPackageModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-dark">
            <div class="modal-header border-gold">
                <h5 class="modal-title text-gold">
                    <i class="bi bi-plus-circle me-2"></i>
                    Add New Package
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="packageForm">
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label text-light">Package Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="packageName" placeholder="e.g. STARTER" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-light">Price <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="text" class="form-control" id="packagePrice" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <label class="form-label text-light">Description</label>
                            <input type="text" class="form-control" id="packageDescription" placeholder="Short description">
                        </div>
                        <div class="col-12">
                            <label class="form-label text-light">Features <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="packageFeatures" rows="6" placeholder="One feature per line&#10;Website 5 halaman&#10;Domain .com&#10;Hosting 1 tahun" required></textarea>
                            <small class="text-muted">Enter one feature per line</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-light">Status</label>
                            <select class="form-select" id="packageStatus">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check mt-4">
                                <input class="form-check-input" type="checkbox" id="packagePopular">
                                <label class="form-check-label text-light" for="packagePopular">
                                    Mark as Popular/Most Selling
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-gold">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-gold" onclick="submitPackage()">
                    <i class="bi bi-save me-2"></i>
                    Save Package
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let addPackageModal;

document.addEventListener('DOMContentLoaded', function() {
    addPackageModal = new bootstrap.Modal(document.getElementById('addPackageModal'));

    // Price formatting
    document.getElementById('packagePrice').addEventListener('input', function() {
        let value = this.value.replace(/[^\d]/g, '');
        this.value = formatNumber(value);
    });
});

function editPackage(id) {
    alert(`Edit package ${id}`);
    addPackageModal.show();
}

function togglePopular(id, setPopular) {
    if (confirm(`${setPopular ? 'Set' : 'Remove'} this package as popular?`)) {
        alert(`Package ${id} ${setPopular ? 'marked' : 'unmarked'} as popular`);
        location.reload();
    }
}

function toggleStatus(id, currentStatus) {
    const newStatus = currentStatus === 'active' ? 'inactive' : 'active';
    if (confirm(`${newStatus === 'inactive' ? 'Deactivate' : 'Activate'} this package?`)) {
        alert(`Package ${id} ${newStatus === 'inactive' ? 'deactivated' : 'activated'}`);
        location.reload();
    }
}

function submitPackage() {
    const name = document.getElementById('packageName').value;
    const price = document.getElementById('packagePrice').value;
    const features = document.getElementById('packageFeatures').value;

    if (!name || !price || !features) {
        alert('Please fill all required fields');
        return;
    }

    alert('Package saved successfully!');
    addPackageModal.hide();
    location.reload();
}

function formatNumber(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}
</script>

<style>
.border-gold {
    border: 2px solid var(--gold) !important;
    box-shadow: 0 0 20px rgba(212, 175, 55, 0.3);
}

.form-check-input:checked {
    background-color: var(--gold);
    border-color: var(--gold);
}
</style>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
