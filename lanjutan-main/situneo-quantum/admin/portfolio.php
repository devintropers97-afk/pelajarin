<?php
$page_id = 'portfolio';
$pageTitle = 'Portfolio Management - SITUNEO DIGITAL';
$pageDescription = 'Manage portfolio items';
$pageHeading = 'Portfolio Management';

include __DIR__ . '/../includes/admin-header.php';

$filter_category = isset($_GET['category']) ? $_GET['category'] : 'all';

// Demo data
if (DEMO_MODE) {
    $portfolios = [
        ['id' => 1, 'title' => 'E-Commerce Fashion Store', 'category' => 'E-Commerce', 'client' => 'Fashion Co', 'image' => 'https://source.unsplash.com/800x600/?ecommerce,fashion', 'url' => 'https://demo1.example.com', 'views' => 1250, 'status' => 'published', 'created_at' => '2024-12-15'],
        ['id' => 2, 'title' => 'Corporate Website Law Firm', 'category' => 'Company Profile', 'client' => 'Legal Partners', 'image' => 'https://source.unsplash.com/800x600/?lawyer,office', 'url' => 'https://demo2.example.com', 'views' => 890, 'status' => 'published', 'created_at' => '2024-12-10'],
        ['id' => 3, 'title' => 'Restaurant Booking System', 'category' => 'Food & Restaurant', 'client' => 'Tasty Bites', 'image' => 'https://source.unsplash.com/800x600/?restaurant,food', 'url' => 'https://demo3.example.com', 'views' => 2100, 'status' => 'published', 'created_at' => '2024-12-05'],
        ['id' => 4, 'title' => 'Healthcare Clinic Portal', 'category' => 'Healthcare', 'client' => 'Health Plus', 'image' => 'https://source.unsplash.com/800x600/?hospital,health', 'url' => 'https://demo4.example.com', 'views' => 1450, 'status' => 'published', 'created_at' => '2024-11-28'],
        ['id' => 5, 'title' => 'Property Listing Platform', 'category' => 'Property', 'client' => 'Real Estate Pro', 'image' => 'https://source.unsplash.com/800x600/?property,house', 'url' => 'https://demo5.example.com', 'views' => 1680, 'status' => 'published', 'created_at' => '2024-11-20'],
        ['id' => 6, 'title' => 'Online Education LMS', 'category' => 'Education', 'client' => 'EduTech', 'image' => 'https://source.unsplash.com/800x600/?education,learning', 'url' => 'https://demo6.example.com', 'views' => 3200, 'status' => 'published', 'created_at' => '2024-11-15'],
        ['id' => 7, 'title' => 'Travel Agency Booking', 'category' => 'Travel', 'client' => 'Wanderlust Tours', 'image' => 'https://source.unsplash.com/800x600/?travel,vacation', 'url' => null, 'views' => 450, 'status' => 'draft', 'created_at' => '2025-01-12'],
        ['id' => 8, 'title' => 'Automotive Showroom', 'category' => 'Automotive', 'client' => 'Auto Gallery', 'image' => 'https://source.unsplash.com/800x600/?car,showroom', 'url' => 'https://demo8.example.com', 'views' => 920, 'status' => 'published', 'created_at' => '2024-11-05'],
    ];

    // Filter
    if ($filter_category !== 'all') {
        $portfolios = array_filter($portfolios, fn($p) => $p['category'] === $filter_category);
    }
}

$categories = ['E-Commerce', 'Company Profile', 'Food & Restaurant', 'Healthcare', 'Property', 'Education', 'Travel', 'Automotive', 'Hotel', 'Event', 'Creative', 'Retail'];

// Stats
$total = count($portfolios);
$published = count(array_filter($portfolios, fn($p) => $p['status'] === 'published'));
$draft = count(array_filter($portfolios, fn($p) => $p['status'] === 'draft'));
$total_views = array_sum(array_map(fn($p) => $p['views'], $portfolios));

?>

<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">Total Portfolio</h6>
            <h3 class="text-gold mb-0"><?= $total ?></h3>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">Published</h6>
            <h3 class="text-success mb-0"><?= $published ?></h3>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">Draft</h6>
            <h3 class="text-warning mb-0"><?= $draft ?></h3>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">Total Views</h6>
            <h3 class="text-info mb-0"><?= formatNumber($total_views) ?></h3>
        </div>
    </div>
</div>

<!-- Filters & Actions -->
<div class="card-premium mb-4">
    <div class="row g-3 align-items-center">
        <div class="col-md-8">
            <select class="form-select" id="categoryFilter">
                <option value="all">All Categories</option>
                <?php foreach ($categories as $cat): ?>
                <option value="<?= htmlspecialchars($cat) ?>" <?= $filter_category === $cat ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cat) ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-4 text-end">
            <button class="btn btn-gold" data-bs-toggle="modal" data-bs-target="#addPortfolioModal">
                <i class="bi bi-plus-circle me-2"></i>
                Add Portfolio
            </button>
        </div>
    </div>
</div>

<!-- Portfolio Grid -->
<div class="row g-4">
    <?php foreach ($portfolios as $portfolio): ?>
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="card-premium p-0 h-100">
            <div class="portfolio-image" style="height: 200px; overflow: hidden; position: relative;">
                <img src="<?= htmlspecialchars($portfolio['image']) ?>" alt="Portfolio" class="w-100 h-100" style="object-fit: cover;">
                <div class="portfolio-overlay">
                    <?php if ($portfolio['url']): ?>
                    <a href="<?= htmlspecialchars($portfolio['url']) ?>" target="_blank" class="btn btn-sm btn-gold">
                        <i class="bi bi-eye"></i> View Demo
                    </a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="p-3">
                <span class="badge badge-gold mb-2"><?= htmlspecialchars($portfolio['category']) ?></span>
                <h6 class="text-light mb-2"><?= htmlspecialchars($portfolio['title']) ?></h6>
                <p class="text-muted small mb-3">
                    <i class="bi bi-building me-1"></i><?= htmlspecialchars($portfolio['client']) ?>
                </p>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <small class="text-muted">
                        <i class="bi bi-eye me-1"></i><?= formatNumber($portfolio['views']) ?> views
                    </small>
                    <?= $portfolio['status'] === 'published' ?
                        '<span class="badge bg-success">Published</span>' :
                        '<span class="badge bg-warning">Draft</span>' ?>
                </div>
                <div class="d-grid gap-2">
                    <button class="btn btn-outline-warning btn-sm" onclick="editPortfolio(<?= $portfolio['id'] ?>)">
                        <i class="bi bi-pencil"></i> Edit
                    </button>
                    <button class="btn btn-outline-danger btn-sm" onclick="deletePortfolio(<?= $portfolio['id'] ?>)">
                        <i class="bi bi-trash"></i> Delete
                    </button>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<!-- Add/Edit Portfolio Modal -->
<div class="modal fade" id="addPortfolioModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-dark">
            <div class="modal-header border-gold">
                <h5 class="modal-title text-gold">Add Portfolio Item</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="portfolioForm">
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label text-light">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="portfolioTitle" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label text-light">Category <span class="text-danger">*</span></label>
                            <select class="form-select" id="portfolioCategory" required>
                                <option value="">Select</option>
                                <?php foreach ($categories as $cat): ?>
                                <option value="<?= $cat ?>"><?= $cat ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-light">Client Name</label>
                            <input type="text" class="form-control" id="portfolioClient">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-light">Demo URL</label>
                            <input type="url" class="form-control" id="portfolioUrl" placeholder="https://">
                        </div>
                        <div class="col-12">
                            <label class="form-label text-light">Upload Image <span class="text-danger">*</span></label>
                            <input type="file" class="form-control" id="portfolioImage" accept="image/*" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-light">Status</label>
                            <select class="form-select" id="portfolioStatus">
                                <option value="published">Published</option>
                                <option value="draft">Draft</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-gold">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-gold" onclick="submitPortfolio()">
                    <i class="bi bi-save me-2"></i>Save
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let addPortfolioModal;

document.addEventListener('DOMContentLoaded', function() {
    addPortfolioModal = new bootstrap.Modal(document.getElementById('addPortfolioModal'));

    document.getElementById('categoryFilter').addEventListener('change', function() {
        window.location.href = '?category=' + this.value;
    });
});

function editPortfolio(id) {
    addPortfolioModal.show();
}

function deletePortfolio(id) {
    if (confirm('Delete this portfolio item?')) {
        alert('Portfolio deleted!');
        location.reload();
    }
}

function submitPortfolio() {
    alert('Portfolio saved!');
    addPortfolioModal.hide();
    location.reload();
}
</script>

<style>
.portfolio-image {
    position: relative;
}

.portfolio-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(10, 22, 40, 0.9);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s;
}

.portfolio-image:hover .portfolio-overlay {
    opacity: 1;
}
</style>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
