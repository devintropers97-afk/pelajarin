<?php
/**
 * Services Listing Page
 *
 * Menampilkan 232+ layanan dengan:
 * - Filter by category
 * - Search
 * - Pricing toggle (one-time vs subscription)
 * - Sort options
 * - Pagination
 */

defined('SITUNEO_ACCESS') or die('Direct access not permitted');

// Get filters
$category = get_input('category', '');
$search = get_input('search', '');
$pricing_type = get_input('pricing', 'both'); // both, one_time_only, subscription_only
$sort = get_input('sort', 'popular'); // popular, newest, price_low, price_high, name
$page = max(1, (int)get_input('page', 1));
$per_page = 12;

try {
    $db = Database::getInstance();

    // Build WHERE clause
    $where_conditions = ['is_active = 1'];
    $params = [];

    // Category filter
    if ($category) {
        $cat = $db->select('service_categories', 'id', 'slug = :slug AND is_active = 1', [':slug' => $category]);
        if (!empty($cat)) {
            $where_conditions[] = 'category_id = :category_id';
            $params[':category_id'] = $cat[0]['id'];
        }
    }

    // Search filter
    if ($search) {
        $where_conditions[] = '(name LIKE :search OR description LIKE :search OR features LIKE :search)';
        $params[':search'] = '%' . $search . '%';
    }

    // Pricing type filter
    if ($pricing_type !== 'both') {
        $where_conditions[] = "(pricing_model = :pricing_type OR pricing_model = 'both')";
        $params[':pricing_type'] = $pricing_type;
    }

    $where = implode(' AND ', $where_conditions);

    // Count total
    $total_result = $db->query("SELECT COUNT(*) as count FROM services WHERE $where", $params);
    $total_services = $total_result->fetchColumn();
    $total_pages = ceil($total_services / $per_page);

    // Build ORDER BY
    $order_by = match($sort) {
        'newest' => 'created_at DESC',
        'price_low' => 'one_time_price ASC',
        'price_high' => 'one_time_price DESC',
        'name' => 'name ASC',
        default => 'sort_order ASC, views DESC' // popular
    };

    // Get services with pagination
    $offset = ($page - 1) * $per_page;
    $services = $db->query("
        SELECT s.*, sc.name as category_name, sc.slug as category_slug, sc.icon as category_icon, sc.color as category_color
        FROM services s
        LEFT JOIN service_categories sc ON s.category_id = sc.id
        WHERE $where
        ORDER BY $order_by
        LIMIT $per_page OFFSET $offset
    ", $params)->fetchAll();

    // Get all categories for filter
    $categories = $db->query("
        SELECT * FROM service_categories
        WHERE is_active = 1
        ORDER BY sort_order ASC
    ")->fetchAll();

} catch (Exception $e) {
    $services = [];
    $categories = [];
    $total_services = 0;
    $total_pages = 0;
    error_log('Services page error: ' . $e->getMessage());
}

$page_title = $category
    ? 'Layanan ' . ucfirst(str_replace('-', ' ', $category)) . ' - SITUNEO DIGITAL'
    : '232+ Layanan Digital - SITUNEO DIGITAL';

$page_description = 'Temukan layanan digital terlengkap dengan dual pricing system (Beli Putus & Sewa Bulanan). Dari website, mobile app, hingga digital marketing.';

include INCLUDES_PATH . 'header/public-header.php';
?>

<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="page-title">
                    <i class="bi bi-grid"></i>
                    <?= $category ? 'Layanan ' . ucfirst(str_replace('-', ' ', $category)) : '232+ Layanan Digital' ?>
                </h1>
                <p class="page-subtitle">
                    Pilih dari <?= format_number($total_services) ?> layanan digital terlengkap dengan dual pricing system
                </p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="<?= url('demo') ?>" class="btn btn-primary">
                    <i class="bi bi-gift"></i> Request Free Demo
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Filters & Search -->
<section class="services-filters">
    <div class="container">
        <form method="get" action="<?= url('services') ?>" id="filterForm">
            <div class="row g-3 align-items-end">
                <!-- Search -->
                <div class="col-lg-4 col-md-6">
                    <label class="form-label"><i class="bi bi-search"></i> Cari Layanan</label>
                    <input type="text" name="search" class="form-control" placeholder="Cari layanan..." value="<?= e($search) ?>">
                </div>

                <!-- Category Filter -->
                <div class="col-lg-3 col-md-6">
                    <label class="form-label"><i class="bi bi-funnel"></i> Kategori</label>
                    <select name="category" class="form-select">
                        <option value="">Semua Kategori</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= e($cat['slug']) ?>" <?= $category === $cat['slug'] ? 'selected' : '' ?>>
                                <?= e($cat['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Pricing Type -->
                <div class="col-lg-2 col-md-6">
                    <label class="form-label"><i class="bi bi-cash"></i> Tipe Harga</label>
                    <select name="pricing" class="form-select">
                        <option value="both" <?= $pricing_type === 'both' ? 'selected' : '' ?>>Semua</option>
                        <option value="one_time_only" <?= $pricing_type === 'one_time_only' ? 'selected' : '' ?>>Beli Putus</option>
                        <option value="subscription_only" <?= $pricing_type === 'subscription_only' ? 'selected' : '' ?>>Sewa Bulanan</option>
                    </select>
                </div>

                <!-- Sort -->
                <div class="col-lg-2 col-md-6">
                    <label class="form-label"><i class="bi bi-sort-down"></i> Urutkan</label>
                    <select name="sort" class="form-select">
                        <option value="popular" <?= $sort === 'popular' ? 'selected' : '' ?>>Terpopuler</option>
                        <option value="newest" <?= $sort === 'newest' ? 'selected' : '' ?>>Terbaru</option>
                        <option value="price_low" <?= $sort === 'price_low' ? 'selected' : '' ?>>Harga Terendah</option>
                        <option value="price_high" <?= $sort === 'price_high' ? 'selected' : '' ?>>Harga Tertinggi</option>
                        <option value="name" <?= $sort === 'name' ? 'selected' : '' ?>>Nama A-Z</option>
                    </select>
                </div>

                <!-- Submit -->
                <div class="col-lg-1 col-md-12">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>

<!-- Services Grid -->
<section class="services-grid">
    <div class="container">
        <!-- Results Info -->
        <div class="results-info mb-4">
            <p class="text-muted">
                Menampilkan <?= count($services) ?> dari <?= format_number($total_services) ?> layanan
                <?php if ($search): ?>
                    untuk pencarian "<strong><?= e($search) ?></strong>"
                <?php endif; ?>
            </p>
        </div>

        <?php if (empty($services)): ?>
            <!-- No Results -->
            <div class="no-results text-center py-5">
                <i class="bi bi-inbox" style="font-size: 4rem; color: var(--gray-400);"></i>
                <h3 class="mt-3">Tidak Ada Layanan Ditemukan</h3>
                <p class="text-muted">Coba ubah filter atau kata kunci pencarian Anda</p>
                <a href="<?= url('services') ?>" class="btn btn-primary mt-3">
                    <i class="bi bi-arrow-clockwise"></i> Reset Filter
                </a>
            </div>
        <?php else: ?>
            <!-- Services Grid -->
            <div class="row g-4">
                <?php foreach ($services as $service): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="service-card" data-aos="fade-up">
                        <!-- Category Badge -->
                        <div class="service-category-badge" style="background: <?= e($service['category_color']) ?>20; color: <?= e($service['category_color']) ?>;">
                            <i class="bi <?= e($service['category_icon']) ?>"></i>
                            <?= e($service['category_name']) ?>
                        </div>

                        <!-- Featured Badge -->
                        <?php if ($service['is_featured']): ?>
                            <div class="service-featured-badge">
                                <i class="bi bi-star-fill"></i> Featured
                            </div>
                        <?php endif; ?>

                        <!-- Service Info -->
                        <div class="service-info">
                            <h3 class="service-title">
                                <a href="<?= url('services/' . $service['slug']) ?>">
                                    <?= e($service['name']) ?>
                                </a>
                            </h3>
                            <p class="service-description">
                                <?= truncate($service['description'], 120) ?>
                            </p>
                        </div>

                        <!-- Pricing -->
                        <div class="service-pricing">
                            <?php if ($service['pricing_model'] === 'both' || $service['pricing_model'] === 'one_time_only'): ?>
                            <div class="price-item price-onetime">
                                <span class="price-label">Beli Putus</span>
                                <span class="price-value"><?= format_rupiah($service['one_time_price']) ?></span>
                            </div>
                            <?php endif; ?>

                            <?php if ($service['pricing_model'] === 'both' || $service['pricing_model'] === 'subscription_only'): ?>
                            <div class="price-item price-subscription">
                                <span class="price-label">Sewa Bulanan</span>
                                <span class="price-value"><?= format_rupiah($service['monthly_price']) ?>/bln</span>
                            </div>
                            <?php endif; ?>
                        </div>

                        <!-- Stats -->
                        <div class="service-stats">
                            <span class="stat-item" title="Waktu pengerjaan">
                                <i class="bi bi-clock"></i>
                                <?= $service['delivery_time'] ?> hari
                            </span>
                            <span class="stat-item" title="Revisi">
                                <i class="bi bi-arrow-repeat"></i>
                                <?= $service['revisions'] === 999 ? 'Unlimited' : $service['revisions'] ?>
                            </span>
                            <span class="stat-item" title="Dilihat">
                                <i class="bi bi-eye"></i>
                                <?= format_number($service['views']) ?>
                            </span>
                        </div>

                        <!-- Action -->
                        <div class="service-action">
                            <a href="<?= url('services/' . $service['slug']) ?>" class="btn btn-primary w-100">
                                <i class="bi bi-eye"></i> Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Pagination -->
            <?php if ($total_pages > 1): ?>
            <div class="pagination-wrapper mt-5">
                <nav aria-label="Services pagination">
                    <ul class="pagination justify-content-center">
                        <!-- Previous -->
                        <?php if ($page > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="<?= url('services?' . http_build_query(array_merge($_GET, ['page' => $page - 1]))) ?>">
                                <i class="bi bi-chevron-left"></i> Previous
                            </a>
                        </li>
                        <?php endif; ?>

                        <!-- Pages -->
                        <?php
                        $start = max(1, $page - 2);
                        $end = min($total_pages, $page + 2);

                        if ($start > 1):
                        ?>
                            <li class="page-item">
                                <a class="page-link" href="<?= url('services?' . http_build_query(array_merge($_GET, ['page' => 1]))) ?>">1</a>
                            </li>
                            <?php if ($start > 2): ?>
                            <li class="page-item disabled"><span class="page-link">...</span></li>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php for ($i = $start; $i <= $end; $i++): ?>
                        <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                            <a class="page-link" href="<?= url('services?' . http_build_query(array_merge($_GET, ['page' => $i]))) ?>">
                                <?= $i ?>
                            </a>
                        </li>
                        <?php endfor; ?>

                        <?php if ($end < $total_pages): ?>
                            <?php if ($end < $total_pages - 1): ?>
                            <li class="page-item disabled"><span class="page-link">...</span></li>
                            <?php endif; ?>
                            <li class="page-item">
                                <a class="page-link" href="<?= url('services?' . http_build_query(array_merge($_GET, ['page' => $total_pages]))) ?>">
                                    <?= $total_pages ?>
                                </a>
                            </li>
                        <?php endif; ?>

                        <!-- Next -->
                        <?php if ($page < $total_pages): ?>
                        <li class="page-item">
                            <a class="page-link" href="<?= url('services?' . http_build_query(array_merge($_GET, ['page' => $page + 1]))) ?>">
                                Next <i class="bi bi-chevron-right"></i>
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </nav>
            </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container text-center">
        <h2>Tidak Menemukan yang Anda Cari?</h2>
        <p class="lead">Hubungi kami untuk konsultasi GRATIS dan dapatkan solusi custom sesuai kebutuhan Anda!</p>
        <div class="cta-buttons">
            <a href="<?= url('contact') ?>" class="btn btn-primary btn-lg">
                <i class="bi bi-envelope"></i> Hubungi Kami
            </a>
            <a href="<?= whatsapp_link(COMPANY_WHATSAPP, 'Halo, saya butuh konsultasi untuk project saya') ?>" class="btn btn-success btn-lg" target="_blank">
                <i class="bi bi-whatsapp"></i> Chat WhatsApp
            </a>
        </div>
    </div>
</section>

<?php include INCLUDES_PATH . 'footer/public-footer.php'; ?>

<style>
/* Services Page Specific Styles */
.page-header {
    background: linear-gradient(135deg, var(--dark) 0%, var(--dark-light) 100%);
    color: var(--white);
    padding: 80px 0 40px;
}

.page-title {
    color: var(--white);
    margin-bottom: 1rem;
    font-size: 2.5rem;
}

.page-subtitle {
    color: rgba(255, 255, 255, 0.8);
    font-size: 1.125rem;
}

.services-filters {
    background: var(--gray-50);
    padding: 2rem 0;
    border-bottom: 2px solid var(--gray-200);
}

.services-grid {
    padding: 3rem 0;
}

.service-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    padding: 1.5rem;
    box-shadow: var(--shadow);
    transition: var(--transition);
    height: 100%;
    display: flex;
    flex-direction: column;
    position: relative;
}

.service-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-xl);
}

.service-category-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.375rem 0.75rem;
    border-radius: var(--radius);
    font-size: 0.75rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.service-featured-badge {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background: var(--gradient-warning);
    color: var(--white);
    padding: 0.25rem 0.75rem;
    border-radius: var(--radius);
    font-size: 0.75rem;
    font-weight: 600;
}

.service-title {
    font-size: 1.25rem;
    margin-bottom: 0.75rem;
}

.service-title a {
    color: var(--dark);
    text-decoration: none;
}

.service-title a:hover {
    color: var(--primary-color);
}

.service-description {
    color: var(--gray-600);
    font-size: 0.875rem;
    line-height: 1.6;
    margin-bottom: 1rem;
    flex-grow: 1;
}

.service-pricing {
    border-top: 1px solid var(--gray-200);
    border-bottom: 1px solid var(--gray-200);
    padding: 1rem 0;
    margin-bottom: 1rem;
}

.price-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.5rem 0;
}

.price-label {
    font-size: 0.875rem;
    color: var(--gray-600);
}

.price-value {
    font-size: 1.125rem;
    font-weight: 700;
    color: var(--dark);
}

.service-stats {
    display: flex;
    gap: 1rem;
    margin-bottom: 1rem;
    font-size: 0.875rem;
    color: var(--gray-600);
}

.stat-item {
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.cta-section {
    background: var(--gradient-primary);
    color: var(--white);
    padding: 4rem 0;
}

.cta-section h2 {
    color: var(--white);
    margin-bottom: 1rem;
}

.cta-buttons {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
    margin-top: 2rem;
}
</style>

<script>
// Auto submit on filter change
document.querySelectorAll('#filterForm select').forEach(select => {
    select.addEventListener('change', () => {
        document.getElementById('filterForm').submit();
    });
});
</script>
