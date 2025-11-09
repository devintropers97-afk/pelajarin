<?php
/**
 * Client Dashboard - Projects
 * View and manage active projects
 */

define('SITUNEO_ACCESS', true);
require_once dirname(dirname(__DIR__)) . '/config/bootstrap.php';

Auth::requireRole('client');

$db = Database::getInstance();
$client = Auth::user();

// Get all projects (orders that are in progress)
$projects = $db->query("
    SELECT o.*, s.name as service_name, s.category_id,
           u.name as freelancer_name, u.email as freelancer_email,
           c.name as category_name
    FROM orders o
    INNER JOIN services s ON o.service_id = s.id
    LEFT JOIN categories c ON s.category_id = c.id
    LEFT JOIN users u ON o.freelancer_id = u.id
    WHERE o.user_id = :user_id
    AND o.status IN ('processing', 'in_progress', 'in_review')
    ORDER BY o.created_at DESC
", ['user_id' => $client['id']])->fetchAll();

// Get completed projects
$completed_projects = $db->query("
    SELECT o.*, s.name as service_name,
           u.name as freelancer_name
    FROM orders o
    INNER JOIN services s ON o.service_id = s.id
    LEFT JOIN users u ON o.freelancer_id = u.id
    WHERE o.user_id = :user_id
    AND o.status = 'completed'
    ORDER BY o.updated_at DESC
    LIMIT 10
", ['user_id' => $client['id']])->fetchAll();

// Calculate statistics
$stats = [
    'active' => count($projects),
    'completed' => $db->query("SELECT COUNT(*) as count FROM orders WHERE user_id = :id AND status = 'completed'", ['id' => $client['id']])->fetch()['count'],
    'in_review' => $db->query("SELECT COUNT(*) as count FROM orders WHERE user_id = :id AND status = 'in_review'", ['id' => $client['id']])->fetch()['count'],
];

// Helper function to get progress percentage
function getProgressPercentage($status) {
    $progress_map = [
        'pending' => 0,
        'processing' => 25,
        'in_progress' => 50,
        'in_review' => 75,
        'completed' => 100,
        'cancelled' => 0
    ];
    return $progress_map[$status] ?? 0;
}

// Helper function to get status color
function getStatusColor($status) {
    $color_map = [
        'pending' => 'secondary',
        'processing' => 'info',
        'in_progress' => 'primary',
        'in_review' => 'warning',
        'completed' => 'success',
        'cancelled' => 'danger'
    ];
    return $color_map[$status] ?? 'secondary';
}

// Include header
$page_title = 'My Projects';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $page_title ?> - SITUNEO DIGITAL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .project-card {
            transition: all 0.3s ease;
            border-left: 4px solid #dee2e6;
        }
        .project-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .project-card.in-progress {
            border-left-color: #0d6efd;
        }
        .project-card.in-review {
            border-left-color: #ffc107;
        }
        .project-card.processing {
            border-left-color: #0dcaf0;
        }
        .progress-custom {
            height: 8px;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2><i class="fas fa-folder-open"></i> My Projects</h2>
                        <p class="text-muted">Track and manage your ongoing projects</p>
                    </div>
                    <div>
                        <a href="/client/" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left"></i> Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics -->
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">Active Projects</h6>
                                <h2 class="mb-0"><?= $stats['active'] ?></h2>
                            </div>
                            <div>
                                <i class="fas fa-tasks fa-3x opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">In Review</h6>
                                <h2 class="mb-0"><?= $stats['in_review'] ?></h2>
                            </div>
                            <div>
                                <i class="fas fa-eye fa-3x opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">Completed</h6>
                                <h2 class="mb-0"><?= $stats['completed'] ?></h2>
                            </div>
                            <div>
                                <i class="fas fa-check-circle fa-3x opacity-50"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Active Projects -->
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="fas fa-spinner fa-spin"></i> Active Projects</h5>
            </div>
            <div class="card-body">
                <?php if (empty($projects)): ?>
                    <div class="text-center py-5">
                        <i class="fas fa-folder-open fa-4x text-muted mb-3"></i>
                        <p class="text-muted">No active projects at the moment</p>
                        <a href="/services.php" class="btn btn-primary">
                            <i class="fas fa-search"></i> Browse Services
                        </a>
                    </div>
                <?php else: ?>
                    <div class="row">
                        <?php foreach ($projects as $project): ?>
                            <div class="col-md-6 mb-4">
                                <div class="card project-card <?= $project['status'] ?>">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div>
                                                <h5 class="card-title mb-1"><?= esc($project['service_name']) ?></h5>
                                                <small class="text-muted">
                                                    <i class="fas fa-tag"></i> <?= esc($project['category_name'] ?? 'General') ?>
                                                </small>
                                            </div>
                                            <span class="badge bg-<?= getStatusColor($project['status']) ?>">
                                                <?= ucwords(str_replace('_', ' ', $project['status'])) ?>
                                            </span>
                                        </div>

                                        <div class="mb-3">
                                            <div class="d-flex justify-content-between mb-1">
                                                <small class="text-muted">Progress</small>
                                                <small class="text-muted"><?= getProgressPercentage($project['status']) ?>%</small>
                                            </div>
                                            <div class="progress progress-custom">
                                                <div class="progress-bar bg-<?= getStatusColor($project['status']) ?>"
                                                     style="width: <?= getProgressPercentage($project['status']) ?>%"></div>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-6">
                                                <small class="text-muted d-block">Order ID</small>
                                                <strong>#<?= $project['order_number'] ?></strong>
                                            </div>
                                            <div class="col-6">
                                                <small class="text-muted d-block">Started</small>
                                                <strong><?= date('d M Y', strtotime($project['created_at'])) ?></strong>
                                            </div>
                                        </div>

                                        <?php if ($project['freelancer_name']): ?>
                                            <div class="mb-3">
                                                <small class="text-muted d-block">Assigned Freelancer</small>
                                                <div class="d-flex align-items-center mt-1">
                                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-2"
                                                         style="width: 35px; height: 35px;">
                                                        <?= strtoupper(substr($project['freelancer_name'], 0, 1)) ?>
                                                    </div>
                                                    <div>
                                                        <strong><?= esc($project['freelancer_name']) ?></strong>
                                                        <br><small class="text-muted"><?= esc($project['freelancer_email']) ?></small>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <div class="d-flex gap-2">
                                            <a href="/client/orders/view.php?id=<?= $project['id'] ?>" class="btn btn-sm btn-primary flex-grow-1">
                                                <i class="fas fa-eye"></i> View Details
                                            </a>
                                            <?php if ($project['freelancer_id']): ?>
                                                <a href="/messages.php?to=<?= $project['freelancer_id'] ?>" class="btn btn-sm btn-outline-primary">
                                                    <i class="fas fa-comment"></i> Message
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Recently Completed -->
        <?php if (!empty($completed_projects)): ?>
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="fas fa-check-circle"></i> Recently Completed</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Service</th>
                                    <th>Freelancer</th>
                                    <th>Completed</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($completed_projects as $completed): ?>
                                    <tr>
                                        <td><strong>#<?= $completed['order_number'] ?></strong></td>
                                        <td><?= esc($completed['service_name']) ?></td>
                                        <td><?= esc($completed['freelancer_name'] ?? 'Not assigned') ?></td>
                                        <td><?= date('d M Y', strtotime($completed['updated_at'])) ?></td>
                                        <td>
                                            <div class="btn-group btn-group-sm">
                                                <a href="/client/orders/view.php?id=<?= $completed['id'] ?>" class="btn btn-outline-primary">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                                <a href="/client/orders/review.php?id=<?= $completed['id'] ?>" class="btn btn-outline-warning">
                                                    <i class="fas fa-star"></i> Review
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
