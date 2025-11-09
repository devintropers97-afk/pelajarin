<?php
/**
 * Freelancer Dashboard - Portfolio Management
 * Add, edit, and manage portfolio items
 */

define('SITUNEO_ACCESS', true);
require_once dirname(dirname(__DIR__)) . '/config/bootstrap.php';

Auth::requireRole('freelancer');

$db = Database::getInstance();
$freelancer = Auth::user();

// Handle portfolio actions
if (is_post()) {
    $action = post('action');

    if ($action === 'add') {
        $title = post('title');
        $description = post('description');
        $category = post('category');
        $project_url = post('project_url');
        $tags = post('tags');

        // Handle image upload
        $image_url = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
            $upload_dir = dirname(dirname(__DIR__)) . '/uploads/portfolios/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            $file_ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $file_name = 'portfolio_' . $freelancer['id'] . '_' . time() . '.' . $file_ext;
            $file_path = $upload_dir . $file_name;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $file_path)) {
                $image_url = '/uploads/portfolios/' . $file_name;
            }
        }

        $db->insert('portfolios', [
            'freelancer_id' => $freelancer['id'],
            'title' => $title,
            'description' => $description,
            'category' => $category,
            'image_url' => $image_url,
            'project_url' => $project_url,
            'tags' => $tags,
            'status' => 'pending',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        Session::flashSuccess('Portfolio item added! Waiting for admin approval.');
        redirect('/freelancer/portfolio/');
    }

    if ($action === 'delete') {
        $portfolio_id = post('portfolio_id');
        $db->delete('portfolios', ['id' => $portfolio_id, 'freelancer_id' => $freelancer['id']]);
        Session::flashSuccess('Portfolio item deleted!');
        redirect('/freelancer/portfolio/');
    }
}

// Get all portfolio items
$portfolios = $db->query("
    SELECT * FROM portfolios
    WHERE freelancer_id = :freelancer_id
    ORDER BY created_at DESC
", ['freelancer_id' => $freelancer['id']])->fetchAll();

// Statistics
$stats = [
    'total' => count($portfolios),
    'approved' => count(array_filter($portfolios, fn($p) => $p['status'] === 'approved')),
    'pending' => count(array_filter($portfolios, fn($p) => $p['status'] === 'pending')),
    'featured' => count(array_filter($portfolios, fn($p) => $p['is_featured'])),
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio Management - SITUNEO DIGITAL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .portfolio-card {
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .portfolio-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }
        .portfolio-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .portfolio-placeholder {
            width: 100%;
            height: 200px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 3rem;
        }
        .status-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 10;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2><i class="fas fa-briefcase"></i> Portfolio Management</h2>
                        <p class="text-muted">Showcase your best work to attract clients</p>
                    </div>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPortfolioModal">
                            <i class="fas fa-plus"></i> Add Portfolio
                        </button>
                        <a href="/freelancer/" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left"></i> Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <?php if (Session::hasFlash('success')): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <?= Session::getFlash('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <!-- Statistics -->
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <h6>Total Items</h6>
                        <h2><?= $stats['total'] ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h6>Approved</h6>
                        <h2><?= $stats['approved'] ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <h6>Pending</h6>
                        <h2><?= $stats['pending'] ?></h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <h6>Featured</h6>
                        <h2><?= $stats['featured'] ?></h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- Portfolio Grid -->
        <div class="row">
            <?php if (empty($portfolios)): ?>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body text-center py-5">
                            <i class="fas fa-folder-open fa-5x text-muted mb-3"></i>
                            <h4>No Portfolio Items Yet</h4>
                            <p class="text-muted mb-4">Start showcasing your work by adding your first portfolio item!</p>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPortfolioModal">
                                <i class="fas fa-plus"></i> Add Your First Portfolio
                            </button>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <?php foreach ($portfolios as $portfolio): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card portfolio-card">
                            <?php
                            $status_colors = [
                                'pending' => 'warning',
                                'approved' => 'success',
                                'rejected' => 'danger'
                            ];
                            $status_color = $status_colors[$portfolio['status']] ?? 'secondary';
                            ?>
                            <span class="badge bg-<?= $status_color ?> status-badge">
                                <?= ucfirst($portfolio['status']) ?>
                            </span>

                            <?php if ($portfolio['is_featured']): ?>
                                <span class="badge bg-warning position-absolute top-0 start-0 m-2">
                                    <i class="fas fa-star"></i> Featured
                                </span>
                            <?php endif; ?>

                            <?php if ($portfolio['image_url']): ?>
                                <img src="<?= esc($portfolio['image_url']) ?>" alt="Portfolio" class="portfolio-image">
                            <?php else: ?>
                                <div class="portfolio-placeholder">
                                    <i class="fas fa-image"></i>
                                </div>
                            <?php endif; ?>

                            <div class="card-body">
                                <h5 class="card-title"><?= esc($portfolio['title']) ?></h5>
                                <p class="card-text text-muted small" style="height: 60px; overflow: hidden;">
                                    <?= esc(substr($portfolio['description'], 0, 120)) ?>...
                                </p>

                                <?php if ($portfolio['category']): ?>
                                    <p class="mb-2">
                                        <span class="badge bg-secondary"><?= esc($portfolio['category']) ?></span>
                                    </p>
                                <?php endif; ?>

                                <?php if ($portfolio['tags']): ?>
                                    <p class="mb-3">
                                        <?php foreach (explode(',', $portfolio['tags']) as $tag): ?>
                                            <span class="badge bg-light text-dark me-1"><?= esc(trim($tag)) ?></span>
                                        <?php endforeach; ?>
                                    </p>
                                <?php endif; ?>

                                <div class="d-flex gap-2">
                                    <?php if ($portfolio['project_url']): ?>
                                        <a href="<?= esc($portfolio['project_url']) ?>" target="_blank" class="btn btn-sm btn-outline-primary flex-grow-1">
                                            <i class="fas fa-external-link-alt"></i> View
                                        </a>
                                    <?php endif; ?>

                                    <a href="/freelancer/portfolio/edit.php?id=<?= $portfolio['id'] ?>" class="btn btn-sm btn-info">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <form method="POST" style="display: inline;" onsubmit="return confirm('Delete this portfolio item?')">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="portfolio_id" value="<?= $portfolio['id'] ?>">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>

                                <?php if ($portfolio['status'] === 'rejected' && $portfolio['rejection_reason']): ?>
                                    <div class="alert alert-danger mt-3 mb-0 small">
                                        <strong>Rejection Reason:</strong><br>
                                        <?= esc($portfolio['rejection_reason']) ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="card-footer small text-muted">
                                <i class="fas fa-clock"></i> Added <?= date('d M Y', strtotime($portfolio['created_at'])) ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Add Portfolio Modal -->
    <div class="modal fade" id="addPortfolioModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form method="POST" enctype="multipart/form-data">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Portfolio Item</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="action" value="add">
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label class="form-label">Project Title *</label>
                            <input type="text" name="title" class="form-control" required placeholder="e.g., Brand Identity for Tech Startup">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description *</label>
                            <textarea name="description" class="form-control" rows="4" required
                                placeholder="Describe your project, the challenge, and the solution you provided..."></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Category</label>
                                <select name="category" class="form-select">
                                    <option value="">Select category...</option>
                                    <option value="Logo Design">Logo Design</option>
                                    <option value="Web Design">Web Design</option>
                                    <option value="Mobile App">Mobile App</option>
                                    <option value="Branding">Branding</option>
                                    <option value="Illustration">Illustration</option>
                                    <option value="UI/UX Design">UI/UX Design</option>
                                    <option value="Content Writing">Content Writing</option>
                                    <option value="Video Editing">Video Editing</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Project URL (Optional)</label>
                                <input type="url" name="project_url" class="form-control" placeholder="https://example.com">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tags (comma separated)</label>
                            <input type="text" name="tags" class="form-control" placeholder="logo, branding, corporate, modern">
                            <small class="text-muted">Add relevant tags to help clients find your work</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Portfolio Image *</label>
                            <input type="file" name="image" class="form-control" accept="image/*" required>
                            <small class="text-muted">Upload your best project image (Max 5MB, JPG/PNG)</small>
                        </div>

                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> Your portfolio will be reviewed by our team before being published.
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Submit for Review
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
