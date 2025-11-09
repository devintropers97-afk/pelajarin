<?php
$page_id = 'users';
$pageTitle = 'Users Management - Admin Dashboard';
$pageDescription = 'Manage all users (clients, freelancers, admins)';
$pageHeading = 'Users Management';

include __DIR__ . '/../includes/admin-header.php';

// Filters
$role_filter = isset($_GET['role']) ? sanitize($_GET['role']) : 'all';
$status_filter = isset($_GET['status']) ? sanitize($_GET['status']) : 'all';
$search = isset($_GET['search']) ? sanitize($_GET['search']) : '';

// Demo data
if (DEMO_MODE) {
    $users = [
        ['user_id' => 1, 'full_name' => 'Admin SITUNEO', 'email' => 'admin@situneo.my.id', 'phone' => '081234567890', 'role' => 'admin', 'is_active' => 1, 'is_email_verified' => 1, 'created_at' => '2020-01-01 10:00:00', 'last_login' => '2025-01-10 14:30:00'],
        ['user_id' => 2, 'full_name' => 'John Doe', 'email' => 'john@example.com', 'phone' => '081234567891', 'role' => 'client', 'is_active' => 1, 'is_email_verified' => 1, 'created_at' => '2024-06-15 09:20:00', 'last_login' => '2025-01-10 13:15:00'],
        ['user_id' => 3, 'full_name' => 'Jane Smith', 'email' => 'jane@example.com', 'phone' => '081234567892', 'role' => 'client', 'is_active' => 1, 'is_email_verified' => 1, 'created_at' => '2024-07-20 11:30:00', 'last_login' => '2025-01-10 12:00:00'],
        ['user_id' => 4, 'full_name' => 'Developer Pro', 'email' => 'dev@example.com', 'phone' => '081234567893', 'role' => 'freelancer', 'is_active' => 1, 'is_email_verified' => 1, 'created_at' => '2024-03-10 08:00:00', 'last_login' => '2025-01-10 11:00:00'],
        ['user_id' => 5, 'full_name' => 'Sarah Wijaya', 'email' => 'sarah@example.com', 'phone' => '081234567894', 'role' => 'client', 'is_active' => 0, 'is_email_verified' => 1, 'created_at' => '2024-09-05 14:20:00', 'last_login' => '2024-12-20 10:00:00'],
        ['user_id' => 6, 'full_name' => 'Budi Santoso', 'email' => 'budi@example.com', 'phone' => '081234567895', 'role' => 'client', 'is_active' => 1, 'is_email_verified' => 0, 'created_at' => '2025-01-09 16:00:00', 'last_login' => null],
        ['user_id' => 7, 'full_name' => 'Designer Creative', 'email' => 'designer@example.com', 'phone' => '081234567896', 'role' => 'freelancer', 'is_active' => 1, 'is_email_verified' => 1, 'created_at' => '2024-05-15 10:00:00', 'last_login' => '2025-01-10 09:30:00'],
        ['user_id' => 8, 'full_name' => 'Ahmad Yani', 'email' => 'ahmad@example.com', 'phone' => '081234567897', 'role' => 'client', 'is_active' => 1, 'is_email_verified' => 1, 'created_at' => '2024-11-20 13:00:00', 'last_login' => '2025-01-10 08:00:00'],
    ];

    // Apply filters
    if ($role_filter !== 'all') {
        $users = array_filter($users, fn($u) => $u['role'] === $role_filter);
    }
    if ($status_filter === 'active') {
        $users = array_filter($users, fn($u) => $u['is_active'] == 1);
    } elseif ($status_filter === 'suspended') {
        $users = array_filter($users, fn($u) => $u['is_active'] == 0);
    }
    if (!empty($search)) {
        $users = array_filter($users, fn($u) =>
            stripos($u['full_name'], $search) !== false ||
            stripos($u['email'], $search) !== false
        );
    }

    $total_users = count($users);
} else {
    // Real database query
    $where = ['1=1'];
    $params = [];

    if ($role_filter !== 'all') {
        $where[] = 'role = ?';
        $params[] = $role_filter;
    }
    if ($status_filter === 'active') {
        $where[] = 'is_active = 1';
    } elseif ($status_filter === 'suspended') {
        $where[] = 'is_active = 0';
    }
    if (!empty($search)) {
        $where[] = '(full_name LIKE ? OR email LIKE ?)';
        $params[] = "%$search%";
        $params[] = "%$search%";
    }

    $users = db_fetch_all("SELECT * FROM users WHERE " . implode(' AND ', $where) . " ORDER BY created_at DESC", $params);
    $total_users = count($users);
}

// Stats
$stats = [
    'total' => DEMO_MODE ? 523 : db_fetch("SELECT COUNT(*) as c FROM users")['c'],
    'clients' => DEMO_MODE ? 450 : db_fetch("SELECT COUNT(*) as c FROM users WHERE role='client'")['c'],
    'freelancers' => DEMO_MODE ? 45 : db_fetch("SELECT COUNT(*) as c FROM users WHERE role='freelancer'")['c'],
    'admins' => DEMO_MODE ? 3 : db_fetch("SELECT COUNT(*) as c FROM users WHERE role='admin'")['c'],
];

?>

<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-1">Total Users</h6>
                    <h3 class="text-gold mb-0"><?= number_format($stats['total']) ?></h3>
                </div>
                <i class="bi bi-people-fill text-gold" style="font-size: 2.5rem;"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-1">Clients</h6>
                    <h3 class="text-light mb-0"><?= number_format($stats['clients']) ?></h3>
                </div>
                <i class="bi bi-person-fill text-light" style="font-size: 2.5rem;"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-1">Freelancers</h6>
                    <h3 class="text-light mb-0"><?= number_format($stats['freelancers']) ?></h3>
                </div>
                <i class="bi bi-person-badge-fill text-light" style="font-size: 2.5rem;"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-1">Admins</h6>
                    <h3 class="text-light mb-0"><?= number_format($stats['admins']) ?></h3>
                </div>
                <i class="bi bi-shield-fill-check text-light" style="font-size: 2.5rem;"></i>
            </div>
        </div>
    </div>
</div>

<!-- Filters & Search -->
<div class="card-premium mb-4">
    <form method="GET" action="/admin/users" class="row g-3">
        <div class="col-lg-3 col-md-6">
            <label class="form-label text-light">Role</label>
            <select name="role" class="form-control" onchange="this.form.submit()">
                <option value="all" <?= $role_filter === 'all' ? 'selected' : '' ?>>All Roles</option>
                <option value="client" <?= $role_filter === 'client' ? 'selected' : '' ?>>Client</option>
                <option value="freelancer" <?= $role_filter === 'freelancer' ? 'selected' : '' ?>>Freelancer</option>
                <option value="admin" <?= $role_filter === 'admin' ? 'selected' : '' ?>>Admin</option>
            </select>
        </div>

        <div class="col-lg-3 col-md-6">
            <label class="form-label text-light">Status</label>
            <select name="status" class="form-control" onchange="this.form.submit()">
                <option value="all" <?= $status_filter === 'all' ? 'selected' : '' ?>>All Status</option>
                <option value="active" <?= $status_filter === 'active' ? 'selected' : '' ?>>Active</option>
                <option value="suspended" <?= $status_filter === 'suspended' ? 'selected' : '' ?>>Suspended</option>
            </select>
        </div>

        <div class="col-lg-4 col-md-8">
            <label class="form-label text-light">Search</label>
            <input type="text" name="search" class="form-control" placeholder="Name or email..." value="<?= htmlspecialchars($search) ?>">
        </div>

        <div class="col-lg-2 col-md-4">
            <label class="form-label text-light">&nbsp;</label>
            <button type="submit" class="btn btn-gold w-100">
                <i class="bi bi-search me-2"></i>Search
            </button>
        </div>
    </form>
</div>

<!-- Users Table -->
<div class="card-premium">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h5 class="text-gold mb-0">
            <i class="bi bi-list-ul me-2"></i>
            All Users (<?= $total_users ?>)
        </h5>
        <a href="/admin/users/add" class="btn btn-gold">
            <i class="bi bi-person-plus me-2"></i>
            Add New User
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-dark table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Registered</th>
                    <th>Last Login</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($users)): ?>
                <tr>
                    <td colspan="9" class="text-center text-muted py-5">
                        <i class="bi bi-inbox display-4 d-block mb-3"></i>
                        No users found
                    </td>
                </tr>
                <?php else: ?>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><code><?= $user['user_id'] ?></code></td>
                    <td>
                        <div class="d-flex align-items-center">
                            <div class="avatar-circle me-2">
                                <?= strtoupper(substr($user['full_name'], 0, 1)) ?>
                            </div>
                            <div>
                                <?= htmlspecialchars($user['full_name']) ?>
                                <?php if (!$user['is_email_verified']): ?>
                                <i class="bi bi-exclamation-triangle text-warning ms-1" title="Email not verified"></i>
                                <?php endif; ?>
                            </div>
                        </div>
                    </td>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                    <td><?= htmlspecialchars($user['phone']) ?></td>
                    <td>
                        <?php
                        $role_badge = match($user['role']) {
                            'admin' => '<span class="badge bg-danger">Admin</span>',
                            'freelancer' => '<span class="badge bg-info">Freelancer</span>',
                            'client' => '<span class="badge bg-primary">Client</span>',
                            default => '<span class="badge bg-secondary">Unknown</span>'
                        };
                        echo $role_badge;
                        ?>
                    </td>
                    <td>
                        <?php if ($user['is_active']): ?>
                        <span class="badge bg-success">Active</span>
                        <?php else: ?>
                        <span class="badge bg-danger">Suspended</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <small><?= timeAgo($user['created_at']) ?></small>
                    </td>
                    <td>
                        <small>
                            <?= $user['last_login'] ? timeAgo($user['last_login']) : '<span class="text-muted">Never</span>' ?>
                        </small>
                    </td>
                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="/admin/users/view?id=<?= $user['user_id'] ?>"
                               class="btn btn-outline-info"
                               title="View Details">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="/admin/users/edit?id=<?= $user['user_id'] ?>"
                               class="btn btn-outline-warning"
                               title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <?php if ($user['is_active']): ?>
                            <button onclick="suspendUser(<?= $user['user_id'] ?>)"
                                    class="btn btn-outline-danger"
                                    title="Suspend">
                                <i class="bi bi-x-circle"></i>
                            </button>
                            <?php else: ?>
                            <button onclick="activateUser(<?= $user['user_id'] ?>)"
                                    class="btn btn-outline-success"
                                    title="Activate">
                                <i class="bi bi-check-circle"></i>
                            </button>
                            <?php endif; ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- JavaScript -->
<script>
function suspendUser(userId) {
    if (confirm('Are you sure you want to suspend this user?')) {
        // In real app, make AJAX call to suspend
        alert('User #' + userId + ' suspended (DEMO)');
        location.reload();
    }
}

function activateUser(userId) {
    if (confirm('Activate this user?')) {
        // In real app, make AJAX call to activate
        alert('User #' + userId + ' activated (DEMO)');
        location.reload();
    }
}
</script>

<style>
.avatar-circle {
    width: 35px;
    height: 35px;
    border-radius: 50%;
    background: var(--gradient-gold);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    color: var(--dark-blue);
}
</style>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
