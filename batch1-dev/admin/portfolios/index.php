<?php
/**
 * Admin - Portfolio Management
 * Manage freelancer portfolios, approve/reject submissions
 */

define('SITUNEO_ACCESS', true);
require_once dirname(dirname(__DIR__)) . '/config/bootstrap.php';

Auth::requireRole('admin');

$db = Database::getInstance();

// Handle portfolio actions
if (is_post()) {
    $action = post('action');
    $portfolio_id = post('portfolio_id');

    if ($action === 'approve') {
        $db->update('portfolios', [
            'status' => 'approved',
            'approved_at' => date('Y-m-d H:i:s'),
            'approved_by' => Auth::id()
        ], ['id' => $portfolio_id]);
        Session::flashSuccess('Portfolio approved successfully!');
        redirect('/admin/portfolios/');
    }

    if ($action === 'reject') {
        $rejection_reason = post('rejection_reason');
        $db->update('portfolios', [
            'status' => 'rejected',
            'rejection_reason' => $rejection_reason
        ], ['id' => $portfolio_id]);
        Session::flashSuccess('Portfolio rejected!');
        redirect('/admin/portfolios/');
    }

    if ($action === 'feature') {
        $db->update('portfolios', ['is_featured' => 1], ['id' => $portfolio_id]);
        Session::flashSuccess('Portfolio featured!');
        redirect('/admin/portfolios/');
    }

    if ($action === 'unfeature') {
        $db->update('portfolios', ['is_featured' => 0], ['id' => $portfolio_id]);
        Session::flashSuccess('Portfolio unfeatured!');
        redirect('/admin/portfolios/');
    }

    if ($action === 'delete') {
        $db->delete('portfolios', ['id' => $portfolio_id]);
        Session::flashSuccess('Portfolio deleted!');
        redirect('/admin/portfolios/');
    }
}

// Filters
$status_filter = get('status', 'all');
$search = get('search', '');

$where = "1=1";
$params = [];

if ($status_filter !== 'all') {
    $where .= " AND p.status = :status";
    $params['status'] = $status_filter;
}

if ($search) {
    $where .= " AND (p.title LIKE :search OR u.name LIKE :search)";
    $params['search'] = "%$search%";
}

// Get portfolios
$portfolios = $db->query("
    SELECT p.*, u.name as freelancer_name, u.email as freelancer_email,
           fp.rating as freelancer_rating
    FROM portfolios p
    INNER JOIN users u ON p.freelancer_id = u.id
    LEFT JOIN freelancer_profiles fp ON u.id = fp.user_id
    WHERE $where
    ORDER BY p.created_at DESC
", $params)->fetchAll();

// Statistics
$stats = [
    'total' => $db->query("SELECT COUNT(*) as count FROM portfolios")->fetch()['count'],
    'pending' => $db->query("SELECT COUNT(*) as count FROM portfolios WHERE status = 'pending'")->fetch()['count'],
    'approved' => $db->query("SELECT COUNT(*) as count FROM portfolios WHERE status = 'approved'")->fetch()['count'],
    'featured' => $db->query("SELECT COUNT(*) as count FROM portfolios WHERE is_featured = 1")->fetch()['count'],
];

include dirname(__DIR__) . '/includes/admin-header.php';
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">Portfolio Management</h2>
        </div>
    </div>

    <!-- Statistics -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5>Total Portfolios</h5>
                    <h2><?= $stats['total'] ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-warning text-white">
                <div class="card-body">
                    <h5>Pending Review</h5>
                    <h2><?= $stats['pending'] ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5>Approved</h5>
                    <h2><?= $stats['approved'] ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5>Featured</h5>
                    <h2><?= $stats['featured'] ?></h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Search</label>
                    <input type="text" name="search" class="form-control" placeholder="Portfolio title or freelancer name..." value="<?= esc($search) ?>">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select">
                        <option value="all" <?= $status_filter === 'all' ? 'selected' : '' ?>>All Status</option>
                        <option value="pending" <?= $status_filter === 'pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="approved" <?= $status_filter === 'approved' ? 'selected' : '' ?>>Approved</option>
                        <option value="rejected" <?= $status_filter === 'rejected' ? 'selected' : '' ?>>Rejected</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">&nbsp;</label>
                    <button type="submit" class="btn btn-primary d-block w-100">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Portfolios Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Freelancer</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Featured</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($portfolios)): ?>
                            <tr>
                                <td colspan="9" class="text-center">No portfolios found</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($portfolios as $portfolio): ?>
                                <tr>
                                    <td><?= $portfolio['id'] ?></td>
                                    <td>
                                        <?php if ($portfolio['image_url']): ?>
                                            <img src="<?= esc($portfolio['image_url']) ?>" alt="Portfolio" style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px;">
                                        <?php else: ?>
                                            <div style="width: 60px; height: 60px; background: #e9ecef; border-radius: 4px; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-image text-muted"></i>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <strong><?= esc($portfolio['title']) ?></strong>
                                        <?php if ($portfolio['project_url']): ?>
                                            <br><small><a href="<?= esc($portfolio['project_url']) ?>" target="_blank">View Project <i class="fas fa-external-link-alt"></i></a></small>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?= esc($portfolio['freelancer_name']) ?>
                                        <br><small class="text-muted"><?= esc($portfolio['freelancer_email']) ?></small>
                                    </td>
                                    <td><?= esc($portfolio['category'] ?? '-') ?></td>
                                    <td>
                                        <?php
                                        $badge_class = [
                                            'pending' => 'warning',
                                            'approved' => 'success',
                                            'rejected' => 'danger'
                                        ][$portfolio['status']] ?? 'secondary';
                                        ?>
                                        <span class="badge bg-<?= $badge_class ?>">
                                            <?= ucfirst($portfolio['status']) ?>
                                        </span>
                                    </td>
                                    <td>
                                        <?php if ($portfolio['is_featured']): ?>
                                            <span class="badge bg-warning">
                                                <i class="fas fa-star"></i> Featured
                                            </span>
                                        <?php else: ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= date('d M Y', strtotime($portfolio['created_at'])) ?></td>
                                    <td>
                                        <div class="btn-group btn-group-sm">
                                            <a href="/admin/portfolios/view.php?id=<?= $portfolio['id'] ?>" class="btn btn-info" title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>

                                            <?php if ($portfolio['status'] === 'pending'): ?>
                                                <form method="POST" style="display: inline;">
                                                    <input type="hidden" name="action" value="approve">
                                                    <input type="hidden" name="portfolio_id" value="<?= $portfolio['id'] ?>">
                                                    <?= csrf_field() ?>
                                                    <button type="submit" class="btn btn-success" title="Approve">
                                                        <i class="fas fa-check"></i>
                                                    </button>
                                                </form>

                                                <button type="button" class="btn btn-danger" title="Reject"
                                                    data-bs-toggle="modal" data-bs-target="#rejectModal<?= $portfolio['id'] ?>">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            <?php endif; ?>

                                            <?php if ($portfolio['status'] === 'approved'): ?>
                                                <?php if ($portfolio['is_featured']): ?>
                                                    <form method="POST" style="display: inline;">
                                                        <input type="hidden" name="action" value="unfeature">
                                                        <input type="hidden" name="portfolio_id" value="<?= $portfolio['id'] ?>">
                                                        <?= csrf_field() ?>
                                                        <button type="submit" class="btn btn-warning" title="Remove from Featured">
                                                            <i class="fas fa-star-half-alt"></i>
                                                        </button>
                                                    </form>
                                                <?php else: ?>
                                                    <form method="POST" style="display: inline;">
                                                        <input type="hidden" name="action" value="feature">
                                                        <input type="hidden" name="portfolio_id" value="<?= $portfolio['id'] ?>">
                                                        <?= csrf_field() ?>
                                                        <button type="submit" class="btn btn-warning" title="Feature">
                                                            <i class="fas fa-star"></i>
                                                        </button>
                                                    </form>
                                                <?php endif; ?>
                                            <?php endif; ?>

                                            <form method="POST" style="display: inline;" onsubmit="return confirm('Delete this portfolio?')">
                                                <input type="hidden" name="action" value="delete">
                                                <input type="hidden" name="portfolio_id" value="<?= $portfolio['id'] ?>">
                                                <?= csrf_field() ?>
                                                <button type="submit" class="btn btn-danger" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>

                                        <!-- Reject Modal -->
                                        <div class="modal fade" id="rejectModal<?= $portfolio['id'] ?>" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form method="POST">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Reject Portfolio</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name="action" value="reject">
                                                            <input type="hidden" name="portfolio_id" value="<?= $portfolio['id'] ?>">
                                                            <?= csrf_field() ?>
                                                            <div class="mb-3">
                                                                <label class="form-label">Rejection Reason</label>
                                                                <textarea name="rejection_reason" class="form-control" rows="3" required
                                                                    placeholder="Please provide reason for rejection..."></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-danger">Reject Portfolio</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
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
