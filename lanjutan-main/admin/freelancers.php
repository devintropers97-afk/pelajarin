<?php
$page_id = 'freelancers';
$pageTitle = 'Freelancers Management - SITUNEO DIGITAL';
$pageDescription = 'Manage freelancers and assignments';
$pageHeading = 'Freelancers Management';

include __DIR__ . '/../includes/admin-header.php';

// Demo data
if (DEMO_MODE) {
    $freelancers = [
        ['id' => 1, 'name' => 'Developer Pro', 'email' => 'freelancer@example.com', 'tier' => 2, 'tier_name' => 'PRO', 'rate' => 40, 'monthly_orders' => 15, 'total_earnings' => 12500000, 'active_projects' => 3, 'completed_projects' => 28, 'rating' => 4.8, 'status' => 'active'],
        ['id' => 2, 'name' => 'Design Expert', 'email' => 'designer@example.com', 'tier' => 3, 'tier_name' => 'EXPERT', 'rate' => 50, 'monthly_orders' => 55, 'total_earnings' => 45000000, 'active_projects' => 5, 'completed_projects' => 120, 'rating' => 4.9, 'status' => 'active'],
        ['id' => 3, 'name' => 'SEO Specialist', 'email' => 'seo@example.com', 'tier' => 2, 'tier_name' => 'PRO', 'rate' => 40, 'monthly_orders' => 22, 'total_earnings' => 8500000, 'active_projects' => 2, 'completed_projects' => 45, 'rating' => 4.7, 'status' => 'active'],
        ['id' => 4, 'name' => 'Junior Dev', 'email' => 'junior@example.com', 'tier' => 1, 'tier_name' => 'STARTER', 'rate' => 30, 'monthly_orders' => 5, 'total_earnings' => 1200000, 'active_projects' => 1, 'completed_projects' => 8, 'rating' => 4.5, 'status' => 'active'],
        ['id' => 5, 'name' => 'Content Writer', 'email' => 'writer@example.com', 'tier' => 1, 'tier_name' => 'STARTER', 'rate' => 30, 'monthly_orders' => 8, 'total_earnings' => 2400000, 'active_projects' => 0, 'completed_projects' => 15, 'rating' => 4.6, 'status' => 'inactive'],
    ];
}

// Stats
$total = count($freelancers);
$active = count(array_filter($freelancers, fn($f) => $f['status'] === 'active'));
$expert = count(array_filter($freelancers, fn($f) => $f['tier'] === 3));
$total_projects = array_sum(array_map(fn($f) => $f['active_projects'], $freelancers));

?>

<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">Total Freelancers</h6>
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
            <h6 class="text-muted mb-2">Expert Tier</h6>
            <h3 class="text-info mb-0"><?= $expert ?></h3>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">Active Projects</h6>
            <h3 class="text-warning mb-0"><?= $total_projects ?></h3>
        </div>
    </div>
</div>

<!-- Freelancers List -->
<?php foreach ($freelancers as $freelancer): ?>
<div class="card-premium mb-3">
    <div class="row align-items-center">
        <div class="col-lg-6">
            <div class="d-flex align-items-center gap-3 mb-3">
                <div class="avatar-large">
                    <img src="https://ui-avatars.com/api/?name=<?= urlencode($freelancer['name']) ?>&size=80&background=FFB400&color=0F3057&bold=true"
                         alt="Avatar" class="rounded-circle" style="width: 80px; height: 80px;">
                </div>
                <div>
                    <h5 class="text-gold mb-1"><?= htmlspecialchars($freelancer['name']) ?></h5>
                    <p class="text-muted mb-1"><?= $freelancer['email'] ?></p>
                    <div class="d-flex gap-2 align-items-center">
                        <?php
                        $tier_badge = match($freelancer['tier']) {
                            1 => '<span class="badge bg-secondary">STARTER - 30%</span>',
                            2 => '<span class="badge bg-info">PRO - 40%</span>',
                            3 => '<span class="badge bg-success">EXPERT - 50%</span>',
                        };
                        echo $tier_badge;
                        ?>
                        <span class="text-warning">
                            <i class="bi bi-star-fill"></i> <?= $freelancer['rating'] ?>
                        </span>
                        <?= $freelancer['status'] === 'active' ?
                            '<span class="badge bg-success">Active</span>' :
                            '<span class="badge bg-secondary">Inactive</span>' ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="row g-2 text-center">
                <div class="col-6">
                    <small class="text-muted d-block">Active</small>
                    <strong class="text-warning"><?= $freelancer['active_projects'] ?></strong>
                </div>
                <div class="col-6">
                    <small class="text-muted d-block">Completed</small>
                    <strong class="text-success"><?= $freelancer['completed_projects'] ?></strong>
                </div>
                <div class="col-12">
                    <small class="text-muted d-block">Total Earnings</small>
                    <strong class="text-gold"><?= formatRupiah($freelancer['total_earnings']) ?></strong>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="d-grid gap-2">
                <button class="btn btn-gold btn-sm" onclick="assignProject(<?= $freelancer['id'] ?>)">
                    <i class="bi bi-plus-circle me-2"></i>Assign Project
                </button>
                <button class="btn btn-outline-info btn-sm" onclick="viewFreelancer(<?= $freelancer['id'] ?>)">
                    <i class="bi bi-eye me-2"></i>View Profile
                </button>
                <button class="btn btn-outline-<?= $freelancer['status'] === 'active' ? 'warning' : 'success' ?> btn-sm"
                        onclick="toggleStatus(<?= $freelancer['id'] ?>, '<?= $freelancer['status'] ?>')">
                    <i class="bi bi-<?= $freelancer['status'] === 'active' ? 'pause' : 'play' ?>-circle me-2"></i>
                    <?= $freelancer['status'] === 'active' ? 'Deactivate' : 'Activate' ?>
                </button>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

<!-- Assign Project Modal -->
<div class="modal fade" id="assignProjectModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content bg-dark">
            <div class="modal-header border-gold">
                <h5 class="modal-title text-gold">
                    <i class="bi bi-plus-circle me-2"></i>
                    Assign Project to Freelancer
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="assignForm">
                    <input type="hidden" id="freelancerId">

                    <div class="mb-3">
                        <label class="form-label text-light">Select Order</label>
                        <select class="form-select" id="orderId" required>
                            <option value="">-- Select Unassigned Order --</option>
                            <option value="ORD-2025-020">ORD-2025-020 - Branding Package - Rp 2.000.000</option>
                            <option value="ORD-2025-022">ORD-2025-022 - SEO Audit - Rp 1.500.000</option>
                            <option value="ORD-2025-025">ORD-2025-025 - Logo Design - Rp 500.000</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-light">Notes for Freelancer</label>
                        <textarea class="form-control" id="assignNotes" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-gold">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-gold" onclick="submitAssignment()">
                    <i class="bi bi-check-circle me-2"></i>
                    Assign
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let assignProjectModal;

document.addEventListener('DOMContentLoaded', function() {
    assignProjectModal = new bootstrap.Modal(document.getElementById('assignProjectModal'));
});

function assignProject(freelancerId) {
    document.getElementById('freelancerId').value = freelancerId;
    assignProjectModal.show();
}

function submitAssignment() {
    const orderId = document.getElementById('orderId').value;
    if (!orderId) {
        alert('Please select an order');
        return;
    }

    alert('Project assigned successfully!');
    assignProjectModal.hide();
    location.reload();
}

function viewFreelancer(id) {
    alert(`View freelancer ${id} detailed profile, performance stats, and project history`);
}

function toggleStatus(id, currentStatus) {
    const action = currentStatus === 'active' ? 'deactivate' : 'activate';
    if (confirm(`${action.charAt(0).toUpperCase() + action.slice(1)} this freelancer?`)) {
        alert(`Freelancer ${action}d successfully!`);
        location.reload();
    }
}
</script>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
