<?php
$page_id = 'reports';
$pageTitle = 'Reports & Analytics - SITUNEO DIGITAL';
$pageDescription = 'Business reports and analytics';
$pageHeading = 'Reports & Analytics';

include __DIR__ . '/../includes/admin-header.php';

// Demo data
$revenue_data = [
    'today' => 3500000,
    'yesterday' => 2800000,
    'this_week' => 18000000,
    'last_week' => 15000000,
    'this_month' => 65000000,
    'last_month' => 52000000,
    'this_year' => 520000000,
];

$orders_data = [
    'total' => 156,
    'completed' => 128,
    'processing' => 18,
    'pending' => 10,
    'cancelled' => 8,
];

$services_popular = [
    ['name' => 'Company Profile Website', 'orders' => 45, 'revenue' => 112500000],
    ['name' => 'E-Commerce Website', 'orders' => 32, 'revenue' => 176000000],
    ['name' => 'SEO Optimization', 'orders' => 28, 'revenue' => 14000000],
    ['name' => 'Landing Page', 'orders' => 22, 'revenue' => 17600000],
    ['name' => 'Mobile App Development', 'orders' => 12, 'revenue' => 96000000],
];

$monthly_revenue = [
    ['month' => 'Jan 2025', 'revenue' => 65000000, 'orders' => 28],
    ['month' => 'Dec 2024', 'revenue' => 52000000, 'orders' => 22],
    ['month' => 'Nov 2024', 'revenue' => 48000000, 'orders' => 20],
    ['month' => 'Oct 2024', 'revenue' => 55000000, 'orders' => 24],
    ['month' => 'Sep 2024', 'revenue' => 42000000, 'orders' => 18],
    ['month' => 'Aug 2024', 'revenue' => 38000000, 'orders' => 16],
];

?>

<!-- Revenue Stats -->
<div class="card-premium mb-4" style="background: var(--gradient-gold); color: var(--dark-blue);">
    <h4 class="mb-4">
        <i class="bi bi-cash-stack me-2"></i>
        Revenue Overview
    </h4>
    <div class="row g-4">
        <div class="col-md-3">
            <div class="card bg-white bg-opacity-25 p-3">
                <small class="d-block mb-1">Today</small>
                <h4 class="mb-0"><?= formatRupiah($revenue_data['today']) ?></h4>
                <small class="text-success">
                    <i class="bi bi-arrow-up"></i> +25% from yesterday
                </small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-white bg-opacity-25 p-3">
                <small class="d-block mb-1">This Week</small>
                <h4 class="mb-0"><?= formatRupiah($revenue_data['this_week']) ?></h4>
                <small class="text-success">
                    <i class="bi bi-arrow-up"></i> +20% from last week
                </small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-white bg-opacity-50 p-3">
                <small class="d-block mb-1">This Month</small>
                <h4 class="mb-0"><?= formatRupiah($revenue_data['this_month']) ?></h4>
                <small class="text-success">
                    <i class="bi bi-arrow-up"></i> +25% from last month
                </small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-white bg-opacity-75 p-3">
                <small class="d-block mb-1">This Year</small>
                <h4 class="mb-0"><?= formatRupiah($revenue_data['this_year']) ?></h4>
            </div>
        </div>
    </div>
</div>

<!-- Orders Stats -->
<div class="row g-3 mb-4">
    <div class="col-lg col-md-4 col-6">
        <div class="card-premium text-center">
            <h6 class="text-muted mb-2">Total Orders</h6>
            <h3 class="text-gold mb-0"><?= $orders_data['total'] ?></h3>
        </div>
    </div>
    <div class="col-lg col-md-4 col-6">
        <div class="card-premium text-center">
            <h6 class="text-muted mb-2">Completed</h6>
            <h3 class="text-success mb-0"><?= $orders_data['completed'] ?></h3>
        </div>
    </div>
    <div class="col-lg col-md-4 col-6">
        <div class="card-premium text-center">
            <h6 class="text-muted mb-2">Processing</h6>
            <h3 class="text-info mb-0"><?= $orders_data['processing'] ?></h3>
        </div>
    </div>
    <div class="col-lg col-md-4 col-6">
        <div class="card-premium text-center">
            <h6 class="text-muted mb-2">Pending</h6>
            <h3 class="text-warning mb-0"><?= $orders_data['pending'] ?></h3>
        </div>
    </div>
    <div class="col-lg col-md-4 col-6">
        <div class="card-premium text-center">
            <h6 class="text-muted mb-2">Cancelled</h6>
            <h3 class="text-danger mb-0"><?= $orders_data['cancelled'] ?></h3>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Popular Services -->
    <div class="col-lg-6">
        <div class="card-premium">
            <h5 class="text-gold mb-4">
                <i class="bi bi-trophy me-2"></i>
                Top Services
            </h5>
            <div class="table-responsive">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th>Service</th>
                            <th class="text-center">Orders</th>
                            <th class="text-end">Revenue</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($services_popular as $service): ?>
                        <tr>
                            <td class="text-light"><?= htmlspecialchars($service['name']) ?></td>
                            <td class="text-center text-warning"><?= $service['orders'] ?></td>
                            <td class="text-end text-gold fw-bold"><?= formatRupiah($service['revenue']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Monthly Revenue Trend -->
    <div class="col-lg-6">
        <div class="card-premium">
            <h5 class="text-gold mb-4">
                <i class="bi bi-graph-up me-2"></i>
                Revenue Trend (6 Months)
            </h5>
            <div class="table-responsive">
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th>Month</th>
                            <th class="text-center">Orders</th>
                            <th class="text-end">Revenue</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($monthly_revenue as $data): ?>
                        <tr>
                            <td class="text-light"><?= $data['month'] ?></td>
                            <td class="text-center text-info"><?= $data['orders'] ?></td>
                            <td class="text-end text-gold fw-bold"><?= formatRupiah($data['revenue']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Export Actions -->
<div class="card-premium mt-4">
    <h5 class="text-gold mb-4">
        <i class="bi bi-download me-2"></i>
        Export Reports
    </h5>
    <div class="row g-3">
        <div class="col-md-3">
            <button class="btn btn-outline-gold w-100" onclick="exportReport('revenue')">
                <i class="bi bi-file-earmark-excel me-2"></i>
                Revenue Report
            </button>
        </div>
        <div class="col-md-3">
            <button class="btn btn-outline-gold w-100" onclick="exportReport('orders')">
                <i class="bi bi-file-earmark-excel me-2"></i>
                Orders Report
            </button>
        </div>
        <div class="col-md-3">
            <button class="btn btn-outline-gold w-100" onclick="exportReport('commissions')">
                <i class="bi bi-file-earmark-excel me-2"></i>
                Commissions Report
            </button>
        </div>
        <div class="col-md-3">
            <button class="btn btn-outline-gold w-100" onclick="exportReport('customers')">
                <i class="bi bi-file-earmark-excel me-2"></i>
                Customers Report
            </button>
        </div>
    </div>
</div>

<script>
function exportReport(type) {
    alert(`Exporting ${type} report to Excel...\n\nIn production, this will download an Excel file.`);
}
</script>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
