<?php
/**
 * Services Management
 *
 * Admin dapat:
 * - Edit harga services (one-time & monthly)
 * - Edit deskripsi, features
 * - Activate/deactivate services
 * - Add new services
 */

defined('SITUNEO_ACCESS') or die('Direct access not permitted');

// Require admin access
Auth::requireAdmin();

$db = Database::getInstance();

// Get filters
$category_id = get('category', '');
$search = get('search', '');
$status = get('status', '');
$sort = get('sort', 'name');
$per_page = 20;
$page = max(1, (int)get('page', 1));
$offset = ($page - 1) * $per_page;

// Build WHERE clause
$where_conditions = [];
$params = [];

if ($category_id) {
    $where_conditions[] = 's.category_id = :category_id';
    $params['category_id'] = $category_id;
}

if ($search) {
    $where_conditions[] = '(s.name LIKE :search OR s.description LIKE :search)';
    $params['search'] = '%' . $search . '%';
}

if ($status !== '') {
    $where_conditions[] = 's.is_active = :status';
    $params['status'] = $status;
}

$where = !empty($where_conditions) ? 'WHERE ' . implode(' AND ', $where_conditions) : '';

// Get total count
$total_query = "SELECT COUNT(*) as count FROM services s $where";
$total = $db->query($total_query, $params)->fetch()['count'] ?? 0;
$total_pages = ceil($total / $per_page);

// Get services
$order_by = match($sort) {
    'price_asc' => 's.one_time_price ASC',
    'price_desc' => 's.one_time_price DESC',
    'newest' => 's.created_at DESC',
    'oldest' => 's.created_at ASC',
    default => 's.name ASC'
};

$services = $db->query("
    SELECT s.*, c.name as category_name
    FROM services s
    LEFT JOIN categories c ON s.category_id = c.id
    $where
    ORDER BY $order_by
    LIMIT $per_page OFFSET $offset
", $params)->fetchAll();

// Get categories for filter
$categories = $db->query("SELECT * FROM categories WHERE is_active = 1 ORDER BY name")->fetchAll();

$page_title = 'Manage Services & Pricing - Admin Panel';

include ADMIN_PATH . 'includes/admin-header.php';
?>

<div class="services-container">
    <div class="services-header">
        <div>
            <h1><i class="bi bi-basket"></i> Manage Services & Pricing</h1>
            <p class="text-muted">Edit harga (one-time & monthly) dan kelola semua services</p>
        </div>
        <div class="header-actions">
            <a href="<?= url('admin/services/edit') ?>" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah Service Baru
            </a>
        </div>
    </div>

    <!-- Filters -->
    <div class="filters-card" data-aos="fade-up">
        <form method="get" action="<?= url('admin/services') ?>">
            <div class="row g-3">
                <div class="col-md-3">
                    <input type="search" name="search" class="form-control" placeholder="Cari service..." value="<?= htmlspecialchars($search) ?>">
                </div>
                <div class="col-md-2">
                    <select name="category" class="form-select">
                        <option value="">Semua Kategori</option>
                        <?php foreach ($categories as $cat): ?>
                        <option value="<?= $cat['id'] ?>" <?= $category_id == $cat['id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($cat['name']) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="status" class="form-select">
                        <option value="">Semua Status</option>
                        <option value="1" <?= $status === '1' ? 'selected' : '' ?>>Active</option>
                        <option value="0" <?= $status === '0' ? 'selected' : '' ?>>Inactive</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select name="sort" class="form-select">
                        <option value="name" <?= $sort === 'name' ? 'selected' : '' ?>>Nama A-Z</option>
                        <option value="price_asc" <?= $sort === 'price_asc' ? 'selected' : '' ?>>Harga Terendah</option>
                        <option value="price_desc" <?= $sort === 'price_desc' ? 'selected' : '' ?>>Harga Tertinggi</option>
                        <option value="newest" <?= $sort === 'newest' ? 'selected' : '' ?>>Terbaru</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-funnel"></i> Filter
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Statistics -->
    <div class="stats-row" data-aos="fade-up">
        <div class="stat-mini">
            <i class="bi bi-basket text-primary"></i>
            <div>
                <h4><?= number_format($total) ?></h4>
                <p>Total Services</p>
            </div>
        </div>
        <div class="stat-mini">
            <i class="bi bi-check-circle text-success"></i>
            <div>
                <h4><?= number_format($db->query("SELECT COUNT(*) as count FROM services WHERE is_active = 1")->fetch()['count'] ?? 0) ?></h4>
                <p>Active</p>
            </div>
        </div>
        <div class="stat-mini">
            <i class="bi bi-x-circle text-danger"></i>
            <div>
                <h4><?= number_format($db->query("SELECT COUNT(*) as count FROM services WHERE is_active = 0")->fetch()['count'] ?? 0) ?></h4>
                <p>Inactive</p>
            </div>
        </div>
    </div>

    <!-- Services Table -->
    <div class="table-card" data-aos="fade-up">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Service Name</th>
                        <th>Category</th>
                        <th>One-Time Price</th>
                        <th>Monthly Price</th>
                        <th>Pricing Model</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($services)): ?>
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">
                            <i class="bi bi-inbox" style="font-size: 3rem; display: block; margin-bottom: 1rem;"></i>
                            Tidak ada services ditemukan
                        </td>
                    </tr>
                    <?php else: ?>
                        <?php foreach ($services as $service): ?>
                        <tr>
                            <td><strong>#<?= $service['id'] ?></strong></td>
                            <td>
                                <strong><?= htmlspecialchars($service['name']) ?></strong><br>
                                <small class="text-muted"><?= htmlspecialchars(substr($service['description'], 0, 60)) ?>...</small>
                            </td>
                            <td><span class="badge bg-secondary"><?= htmlspecialchars($service['category_name']) ?></span></td>
                            <td>
                                <strong class="text-success"><?= format_price($service['one_time_price']) ?></strong>
                            </td>
                            <td>
                                <strong class="text-primary"><?= format_price($service['monthly_price']) ?>/bln</strong>
                            </td>
                            <td>
                                <?php
                                $badge = match($service['pricing_model']) {
                                    'both' => '<span class="badge bg-info">Both</span>',
                                    'one_time_only' => '<span class="badge bg-success">One-Time Only</span>',
                                    'subscription_only' => '<span class="badge bg-primary">Subscription Only</span>',
                                    default => '<span class="badge bg-secondary">Unknown</span>'
                                };
                                echo $badge;
                                ?>
                            </td>
                            <td>
                                <?php if ($service['is_active']): ?>
                                <span class="badge bg-success">Active</span>
                                <?php else: ?>
                                <span class="badge bg-danger">Inactive</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="<?= url('admin/services/edit?id=' . $service['id']) ?>" class="btn btn-sm btn-primary" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="<?= url('service-detail/' . $service['slug']) ?>" class="btn btn-sm btn-info" title="View" target="_blank">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <?php if ($total_pages > 1): ?>
        <div class="pagination-container">
            <nav>
                <ul class="pagination">
                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                        <a class="page-link" href="<?= url('admin/services?page=' . $i . '&category=' . $category_id . '&search=' . urlencode($search) . '&status=' . $status . '&sort=' . $sort) ?>">
                            <?= $i ?>
                        </a>
                    </li>
                    <?php endfor; ?>
                </ul>
            </nav>
            <p class="text-muted mb-0">Showing <?= $offset + 1 ?> to <?= min($offset + $per_page, $total) ?> of <?= number_format($total) ?> services</p>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php include ADMIN_PATH . 'includes/admin-footer.php'; ?>

<style>
.services-container {
    padding: 2rem;
    max-width: 1600px;
    margin: 0 auto;
}

.services-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.services-header h1 {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.25rem;
}

.filters-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    padding: 1.5rem;
    box-shadow: var(--shadow);
    margin-bottom: 1.5rem;
}

.stats-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.stat-mini {
    background: var(--white);
    border-radius: var(--radius-lg);
    padding: 1.5rem;
    box-shadow: var(--shadow);
    display: flex;
    align-items: center;
    gap: 1rem;
}

.stat-mini i {
    font-size: 2.5rem;
}

.stat-mini h4 {
    font-size: 1.75rem;
    font-weight: 700;
    margin-bottom: 0.25rem;
}

.stat-mini p {
    margin: 0;
    color: var(--gray-600);
    font-size: 0.875rem;
}

.table-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow);
    overflow: hidden;
}

.table {
    margin-bottom: 0;
}

.table th {
    background: var(--gray-50);
    font-weight: 600;
    border-bottom: 2px solid var(--gray-200);
    padding: 1rem;
}

.table td {
    padding: 1rem;
    vertical-align: middle;
}

.pagination-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem;
    border-top: 1px solid var(--gray-200);
}
</style>
