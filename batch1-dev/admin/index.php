<?php
/**
 * Admin Dashboard
 *
 * FULL CONTROL untuk Admin:
 * - Edit harga services
 * - Edit settings website
 * - Edit content semua halaman
 * - Manage users, portfolios, orders
 */

defined('SITUNEO_ACCESS') or die('Direct access not permitted');

// Require admin access
Auth::requireAdmin();

$admin = Auth::user();
$db = Database::getInstance();

// Get statistics
$stats = [
    'total_users' => $db->query("SELECT COUNT(*) as count FROM users WHERE is_active = 1")->fetch()['count'] ?? 0,
    'total_clients' => $db->query("SELECT COUNT(*) as count FROM users WHERE role = 'client' AND is_active = 1")->fetch()['count'] ?? 0,
    'total_freelancers' => $db->query("SELECT COUNT(*) as count FROM users WHERE role = 'freelancer' AND is_active = 1")->fetch()['count'] ?? 0,
    'total_services' => $db->query("SELECT COUNT(*) as count FROM services WHERE is_active = 1")->fetch()['count'] ?? 0,
    'total_portfolios' => $db->query("SELECT COUNT(*) as count FROM portfolios WHERE is_active = 1")->fetch()['count'] ?? 0,
    'total_orders' => $db->query("SELECT COUNT(*) as count FROM orders")->fetch()['count'] ?? 0,
    'pending_orders' => $db->query("SELECT COUNT(*) as count FROM orders WHERE status = 'pending'")->fetch()['count'] ?? 0,
    'active_orders' => $db->query("SELECT COUNT(*) as count FROM orders WHERE status IN ('processing', 'in_progress')")->fetch()['count'] ?? 0,
];

// Get recent activities
$recent_activities = $db->query("
    SELECT al.*, u.name as user_name, u.email as user_email
    FROM activity_logs al
    LEFT JOIN users u ON al.user_id = u.id
    ORDER BY al.created_at DESC
    LIMIT 10
")->fetchAll();

// Get recent orders
$recent_orders = $db->query("
    SELECT o.*, u.name as client_name, s.name as service_name
    FROM orders o
    LEFT JOIN users u ON o.user_id = u.id
    LEFT JOIN services s ON o.service_id = s.id
    ORDER BY o.created_at DESC
    LIMIT 5
")->fetchAll();

$page_title = 'Admin Dashboard - SITUNEO DIGITAL';

include ADMIN_PATH . 'includes/admin-header.php';
?>

<div class="dashboard-container">
    <!-- Header -->
    <div class="dashboard-header">
        <div>
            <h1>Dashboard</h1>
            <p class="text-muted">Selamat datang, <?= htmlspecialchars($admin['name']) ?>!</p>
        </div>
        <div class="header-actions">
            <a href="<?= url('/') ?>" class="btn btn-outline-primary" target="_blank">
                <i class="bi bi-globe"></i> Lihat Website
            </a>
        </div>
    </div>

    <!-- Stats Grid -->
    <div class="stats-grid">
        <div class="stat-card" data-aos="fade-up">
            <div class="stat-icon bg-primary">
                <i class="bi bi-people"></i>
            </div>
            <div class="stat-info">
                <h3><?= number_format($stats['total_users']) ?></h3>
                <p>Total Users</p>
            </div>
        </div>

        <div class="stat-card" data-aos="fade-up" data-aos-delay="50">
            <div class="stat-icon bg-success">
                <i class="bi bi-briefcase"></i>
            </div>
            <div class="stat-info">
                <h3><?= number_format($stats['total_clients']) ?></h3>
                <p>Clients</p>
            </div>
        </div>

        <div class="stat-card" data-aos="fade-up" data-aos-delay="100">
            <div class="stat-icon bg-info">
                <i class="bi bi-laptop"></i>
            </div>
            <div class="stat-info">
                <h3><?= number_format($stats['total_freelancers']) ?></h3>
                <p>Freelancers</p>
            </div>
        </div>

        <div class="stat-card" data-aos="fade-up" data-aos-delay="150">
            <div class="stat-icon bg-warning">
                <i class="bi bi-basket"></i>
            </div>
            <div class="stat-info">
                <h3><?= number_format($stats['total_services']) ?></h3>
                <p>Services</p>
            </div>
        </div>

        <div class="stat-card" data-aos="fade-up" data-aos-delay="200">
            <div class="stat-icon bg-purple">
                <i class="bi bi-image"></i>
            </div>
            <div class="stat-info">
                <h3><?= number_format($stats['total_portfolios']) ?></h3>
                <p>Portfolios</p>
            </div>
        </div>

        <div class="stat-card" data-aos="fade-up" data-aos-delay="250">
            <div class="stat-icon bg-danger">
                <i class="bi bi-cart-check"></i>
            </div>
            <div class="stat-info">
                <h3><?= number_format($stats['total_orders']) ?></h3>
                <p>Total Orders</p>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="section-header">
        <h2><i class="bi bi-lightning"></i> Quick Actions - FULL CONTROL</h2>
        <p class="text-muted">Edit apapun tanpa perlu coding</p>
    </div>

    <div class="quick-actions-grid">
        <a href="<?= url('admin/settings') ?>" class="action-card" data-aos="fade-up">
            <i class="bi bi-gear text-primary"></i>
            <h4>Settings Website</h4>
            <p>Edit company info, contact, social media, logo, dll</p>
        </a>

        <a href="<?= url('admin/services') ?>" class="action-card" data-aos="fade-up" data-aos-delay="50">
            <i class="bi bi-basket text-warning"></i>
            <h4>Manage Services</h4>
            <p>Edit harga (one-time & monthly), deskripsi, features</p>
        </a>

        <a href="<?= url('admin/content') ?>" class="action-card" data-aos="fade-up" data-aos-delay="100">
            <i class="bi bi-file-text text-success"></i>
            <h4>Edit Content</h4>
            <p>Edit Homepage, About, Contact, dll tanpa coding</p>
        </a>

        <a href="<?= url('admin/portfolios') ?>" class="action-card" data-aos="fade-up" data-aos-delay="150">
            <i class="bi bi-image text-info"></i>
            <h4>Manage Portfolios</h4>
            <p>Tambah/edit demo showcase website</p>
        </a>

        <a href="<?= url('admin/users') ?>" class="action-card" data-aos="fade-up" data-aos-delay="200">
            <i class="bi bi-people text-purple"></i>
            <h4>Manage Users</h4>
            <p>Kelola admin, client, freelancer</p>
        </a>

        <a href="<?= url('admin/orders') ?>" class="action-card" data-aos="fade-up" data-aos-delay="250">
            <i class="bi bi-cart-check text-danger"></i>
            <h4>Manage Orders</h4>
            <p>Kelola semua order & transaksi</p>
        </a>
    </div>

    <!-- Recent Orders & Activities -->
    <div class="row mt-4">
        <div class="col-lg-6">
            <div class="data-card">
                <div class="card-header">
                    <h3><i class="bi bi-cart-check"></i> Recent Orders</h3>
                    <a href="<?= url('admin/orders') ?>">View All</a>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Client</th>
                                <th>Service</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($recent_orders)): ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted">Belum ada order</td>
                            </tr>
                            <?php else: ?>
                                <?php foreach ($recent_orders as $order): ?>
                                <tr>
                                    <td><strong>#<?= $order['order_number'] ?? $order['id'] ?></strong></td>
                                    <td><?= htmlspecialchars($order['client_name'] ?? 'N/A') ?></td>
                                    <td><?= htmlspecialchars(substr($order['service_name'] ?? 'N/A', 0, 30)) ?>...</td>
                                    <td><span class="badge bg-<?= order_status_color($order['status']) ?>"><?= ucfirst($order['status']) ?></span></td>
                                    <td><?= date('d/m/Y', strtotime($order['created_at'])) ?></td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="data-card">
                <div class="card-header">
                    <h3><i class="bi bi-clock-history"></i> Recent Activities</h3>
                    <a href="<?= url('admin/activities') ?>">View All</a>
                </div>
                <div class="activities-list">
                    <?php if (empty($recent_activities)): ?>
                    <p class="text-center text-muted py-3">Belum ada aktivitas</p>
                    <?php else: ?>
                        <?php foreach ($recent_activities as $activity): ?>
                        <div class="activity-item">
                            <div class="activity-icon">
                                <i class="bi bi-<?= activity_icon($activity['action']) ?>"></i>
                            </div>
                            <div class="activity-info">
                                <p><strong><?= htmlspecialchars($activity['user_name'] ?? 'System') ?></strong> <?= htmlspecialchars($activity['description']) ?></p>
                                <small class="text-muted"><?= time_ago($activity['created_at']) ?></small>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include ADMIN_PATH . 'includes/admin-footer.php'; ?>

<style>
.dashboard-container {
    padding: 2rem;
    max-width: 1400px;
    margin: 0 auto;
}

.dashboard-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.dashboard-header h1 {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.25rem;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
    margin-bottom: 3rem;
}

.stat-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    padding: 1.5rem;
    box-shadow: var(--shadow);
    display: flex;
    align-items: center;
    gap: 1rem;
    transition: var(--transition);
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: var(--radius);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.75rem;
    color: var(--white);
}

.stat-icon.bg-purple {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.stat-info h3 {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.25rem;
}

.stat-info p {
    color: var(--gray-600);
    margin: 0;
}

.section-header {
    margin-bottom: 1.5rem;
}

.section-header h2 {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 0.25rem;
}

.quick-actions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 3rem;
}

.action-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    padding: 2rem;
    box-shadow: var(--shadow);
    text-decoration: none;
    color: var(--dark);
    transition: var(--transition);
    border: 2px solid transparent;
}

.action-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-xl);
    border-color: var(--primary-color);
}

.action-card i {
    font-size: 2.5rem;
    margin-bottom: 1rem;
}

.action-card h4 {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.action-card p {
    color: var(--gray-600);
    margin: 0;
    font-size: 0.875rem;
}

.data-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow);
    overflow: hidden;
    margin-bottom: 1.5rem;
}

.data-card .card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem;
    border-bottom: 1px solid var(--gray-200);
}

.data-card .card-header h3 {
    font-size: 1.125rem;
    font-weight: 600;
    margin: 0;
}

.data-card .card-header a {
    font-size: 0.875rem;
}

.activities-list {
    padding: 1rem;
}

.activity-item {
    display: flex;
    gap: 1rem;
    padding: 1rem;
    border-bottom: 1px solid var(--gray-100);
}

.activity-item:last-child {
    border-bottom: none;
}

.activity-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: var(--primary-light);
    color: var(--primary-color);
    display: flex;
    align-items: center;
    justify-content: center;
}

.activity-info p {
    margin-bottom: 0.25rem;
}
</style>
