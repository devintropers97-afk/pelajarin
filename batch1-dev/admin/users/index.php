<?php
/**
 * Admin - User Management
 * Manage all users (Admin, Client, Freelancer)
 */

define('SITUNEO_ACCESS', true);
require_once dirname(dirname(__DIR__)) . '/config/bootstrap.php';

// Require admin authentication
Auth::requireRole('admin');

$db = Database::getInstance();
$admin = Auth::user();

// Handle user actions
if (is_post()) {
    $action = post('action');
    $user_id = post('user_id');

    if ($action === 'activate') {
        $db->update('users', ['is_active' => 1], ['id' => $user_id]);
        Session::flashSuccess('User activated successfully!');
        redirect('/admin/users/');
    }

    if ($action === 'deactivate') {
        $db->update('users', ['is_active' => 0], ['id' => $user_id]);
        Session::flashSuccess('User deactivated successfully!');
        redirect('/admin/users/');
    }

    if ($action === 'delete') {
        // Soft delete or hard delete based on your preference
        $db->delete('users', ['id' => $user_id]);
        Session::flashSuccess('User deleted successfully!');
        redirect('/admin/users/');
    }

    if ($action === 'update_role') {
        $new_role = post('role');
        $db->update('users', ['role' => $new_role], ['id' => $user_id]);
        Session::flashSuccess('User role updated successfully!');
        redirect('/admin/users/');
    }
}

// Filters
$role_filter = get('role', 'all');
$status_filter = get('status', 'all');
$search = get('search', '');

// Build query
$where = "1=1";
$params = [];

if ($role_filter !== 'all') {
    $where .= " AND role = :role";
    $params['role'] = $role_filter;
}

if ($status_filter === 'active') {
    $where .= " AND is_active = 1";
} elseif ($status_filter === 'inactive') {
    $where .= " AND is_active = 0";
}

if ($search) {
    $where .= " AND (name LIKE :search OR email LIKE :search)";
    $params['search'] = "%$search%";
}

// Get users
$users = $db->query("
    SELECT * FROM users
    WHERE $where
    ORDER BY created_at DESC
", $params)->fetchAll();

// Get statistics
$stats = [
    'total' => $db->query("SELECT COUNT(*) as count FROM users")->fetch()['count'],
    'admins' => $db->query("SELECT COUNT(*) as count FROM users WHERE role = 'admin'")->fetch()['count'],
    'clients' => $db->query("SELECT COUNT(*) as count FROM users WHERE role = 'client'")->fetch()['count'],
    'freelancers' => $db->query("SELECT COUNT(*) as count FROM users WHERE role = 'freelancer'")->fetch()['count'],
    'active' => $db->query("SELECT COUNT(*) as count FROM users WHERE is_active = 1")->fetch()['count'],
];

include dirname(__DIR__) . '/includes/admin-header.php';
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>User Management</h2>
                <a href="/admin/users/create.php" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add New User
                </a>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5>Total Users</h5>
                    <h2><?= $stats['total'] ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>Clients</h5>
                    <h2><?= $stats['clients'] ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5>Freelancers</h5>
                    <h2><?= $stats['freelancers'] ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h5>Active</h5>
                    <h2><?= $stats['active'] ?></h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Search</label>
                    <input type="text" name="search" class="form-control" placeholder="Name or email..." value="<?= esc($search) ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-select">
                        <option value="all" <?= $role_filter === 'all' ? 'selected' : '' ?>>All Roles</option>
                        <option value="admin" <?= $role_filter === 'admin' ? 'selected' : '' ?>>Admin</option>
                        <option value="client" <?= $role_filter === 'client' ? 'selected' : '' ?>>Client</option>
                        <option value="freelancer" <?= $role_filter === 'freelancer' ? 'selected' : '' ?>>Freelancer</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="all" <?= $status_filter === 'all' ? 'selected' : '' ?>>All Status</option>
                        <option value="active" <?= $status_filter === 'active' ? 'selected' : '' ?>>Active</option>
                        <option value="inactive" <?= $status_filter === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">&nbsp;</label>
                    <button type="submit" class="btn btn-primary d-block w-100">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Users Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th>Registered</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($users)): ?>
                            <tr>
                                <td colspan="8" class="text-center">No users found</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?= $user['id'] ?></td>
                                    <td>
                                        <strong><?= esc($user['name']) ?></strong>
                                    </td>
                                    <td><?= esc($user['email']) ?></td>
                                    <td>
                                        <span class="badge bg-<?= $user['role'] === 'admin' ? 'danger' : ($user['role'] === 'freelancer' ? 'info' : 'success') ?>">
                                            <?= ucfirst($user['role']) ?>
                                        </span>
                                    </td>
                                    <td><?= esc($user['phone'] ?? '-') ?></td>
                                    <td>
                                        <?php if ($user['is_active']): ?>
                                            <span class="badge bg-success">Active</span>
                                        <?php else: ?>
                                            <span class="badge bg-danger">Inactive</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= date('d M Y', strtotime($user['created_at'])) ?></td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="/admin/users/edit.php?id=<?= $user['id'] ?>" class="btn btn-info" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <?php if ($user['is_active']): ?>
                                                <form method="POST" style="display: inline;" onsubmit="return confirm('Deactivate this user?')">
                                                    <input type="hidden" name="action" value="deactivate">
                                                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                                    <?= csrf_field() ?>
                                                    <button type="submit" class="btn btn-warning" title="Deactivate">
                                                        <i class="fas fa-ban"></i>
                                                    </button>
                                                </form>
                                            <?php else: ?>
                                                <form method="POST" style="display: inline;">
                                                    <input type="hidden" name="action" value="activate">
                                                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                                    <?= csrf_field() ?>
                                                    <button type="submit" class="btn btn-success" title="Activate">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>
                                            <?php endif; ?>

                                            <?php if ($user['id'] !== $admin['id']): ?>
                                                <form method="POST" style="display: inline;" onsubmit="return confirm('Delete this user permanently?')">
                                                    <input type="hidden" name="action" value="delete">
                                                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                                    <?= csrf_field() ?>
                                                    <button type="submit" class="btn btn-danger" title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
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
    </div>
</div>

<?php include dirname(__DIR__) . '/includes/admin-footer.php'; ?>
