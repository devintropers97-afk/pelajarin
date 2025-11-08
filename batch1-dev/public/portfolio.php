<?php
/**
 * Portfolio / Demo Showcase Page
 *
 * HYBRID SYSTEM (OPSI C):
 * - 50 Demo Production-Ready (TOP Categories)
 * - 1500+ Browsable Combinations (SEO)
 * - Smart Wizard untuk Custom Request
 *
 * Fitur:
 * - Filter by category, industry, style
 * - Live preview
 * - Screenshot gallery
 * - Tech stack display
 * - Request custom demo
 */

defined('SITUNEO_ACCESS') or die('Direct access not permitted');

// Get filters
$category = get_input('category', '');
$industry = get_input('industry', '');
$style = get_input('style', '');
$search = get_input('search', '');
$page = max(1, (int)get_input('page', 1));
$per_page = 12;

try {
    $db = Database::getInstance();

    // Build WHERE clause
    $where_conditions = ['p.is_active = 1'];
    $params = [];

    // Category filter
    if ($category) {
        $where_conditions[] = 'p.category = :category';
        $params[':category'] = $category;
    }

    // Industry filter
    if ($industry) {
        $where_conditions[] = 'p.industry = :industry';
        $params[':industry'] = $industry;
    }

    // Style filter
    if ($style) {
        $where_conditions[] = 'p.style = :style';
        $params[':style'] = $style;
    }

    // Search
    if ($search) {
        $where_conditions[] = '(p.title LIKE :search OR p.description LIKE :search OR p.features LIKE :search)';
        $params[':search'] = '%' . $search . '%';
    }

    $where = implode(' AND ', $where_conditions);

    // Count total
    $total_result = $db->query("SELECT COUNT(*) as count FROM portfolios p WHERE $where", $params);
    $total_demos = $total_result->fetchColumn();
    $total_pages = ceil($total_demos / $per_page);

    // Get portfolios
    $offset = ($page - 1) * $per_page;
    $portfolios = $db->query("
        SELECT p.*
        FROM portfolios p
        WHERE $where
        ORDER BY p.is_featured DESC, p.views DESC, p.created_at DESC
        LIMIT $per_page OFFSET $offset
    ", $params)->fetchAll();

    // Get filter options
    $categories = $db->query("
        SELECT DISTINCT category FROM portfolios
        WHERE is_active = 1 AND category IS NOT NULL AND category != ''
        ORDER BY category
    ")->fetchAll();

    $industries = $db->query("
        SELECT DISTINCT industry FROM portfolios
        WHERE is_active = 1 AND industry IS NOT NULL AND industry != ''
        ORDER BY industry
    ")->fetchAll();

    $styles = $db->query("
        SELECT DISTINCT style FROM portfolios
        WHERE is_active = 1 AND style IS NOT NULL AND style != ''
        ORDER BY style
    ")->fetchAll();

    // Get stats
    $total_all_demos = $db->query("SELECT COUNT(*) as count FROM portfolios WHERE is_active = 1")->fetchColumn();
    $total_featured = $db->query("SELECT COUNT(*) as count FROM portfolios WHERE is_active = 1 AND is_featured = 1")->fetchColumn();

} catch (Exception $e) {
    $portfolios = [];
    $categories = [];
    $industries = [];
    $styles = [];
    $total_demos = 0;
    $total_all_demos = 50;
    $total_featured = 10;
    error_log('Portfolio page error: ' . $e->getMessage());
}

$page_title = '50+ Demo Website Production-Ready - SITUNEO DIGITAL';
$page_description = 'Lihat 50+ demo website production-ready dari berbagai kategori. Preview langsung, pilih template, dan launch website Anda dalam 24 jam!';

include INCLUDES_PATH . 'header/public-header.php';
?>

<!-- Hero Section -->
<section class="portfolio-hero">
    <div class="container text-center">
        <h1 class="hero-title" data-aos="fade-up">
            <span class="text-gradient">50+ Demo Website</span><br>
            Production-Ready
        </h1>
        <p class="hero-subtitle" data-aos="fade-up" data-aos-delay="100">
            Lihat langsung hasil kerja kami! Preview demo, pilih yang cocok, dan launch dalam 24 jam!<br>
            <strong><?= format_number($total_all_demos) ?> demo</strong> siap pakai + <strong>1500+ kombinasi</strong> bisa dibrowse
        </p>

        <!-- Quick Stats -->
        <div class="hero-stats" data-aos="fade-up" data-aos-delay="200">
            <div class="stat-item">
                <i class="bi bi-collection"></i>
                <strong><?= format_number($total_all_demos) ?>+</strong>
                <span>Demo Ready</span>
            </div>
            <div class="stat-item">
                <i class="bi bi-star-fill"></i>
                <strong><?= $total_featured ?></strong>
                <span>Featured</span>
            </div>
            <div class="stat-item">
                <i class="bi bi-lightning-fill"></i>
                <strong>24 Jam</strong>
                <span>Launch Time</span>
            </div>
            <div class="stat-item">
                <i class="bi bi-check-circle-fill"></i>
                <strong>100%</strong>
                <span>Production-Ready</span>
            </div>
        </div>

        <!-- CTA -->
        <div class="hero-cta" data-aos="fade-up" data-aos-delay="300">
            <a href="#demo-grid" class="btn btn-primary btn-lg">
                <i class="bi bi-grid"></i> Lihat Demo
            </a>
            <a href="<?= url('demo') ?>" class="btn btn-success btn-lg">
                <i class="bi bi-gift"></i> Request Custom Demo GRATIS
            </a>
        </div>
    </div>
</section>

<!-- Filters -->
<section class="portfolio-filters">
    <div class="container">
        <form method="get" action="<?= url('portfolio') ?>" id="filterForm">
            <div class="row g-3 align-items-end">
                <!-- Search -->
                <div class="col-lg-3 col-md-6">
                    <label class="form-label"><i class="bi bi-search"></i> Cari Demo</label>
                    <input type="text" name="search" class="form-control" placeholder="Cari demo..." value="<?= e($search) ?>">
                </div>

                <!-- Category -->
                <div class="col-lg-3 col-md-6">
                    <label class="form-label"><i class="bi bi-grid"></i> Kategori</label>
                    <select name="category" class="form-select">
                        <option value="">Semua Kategori</option>
                        <?php foreach ($categories as $cat): ?>
                            <option value="<?= e($cat['category']) ?>" <?= $category === $cat['category'] ? 'selected' : '' ?>>
                                <?= ucfirst(str_replace('-', ' ', $cat['category'])) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Industry -->
                <div class="col-lg-2 col-md-6">
                    <label class="form-label"><i class="bi bi-briefcase"></i> Industri</label>
                    <select name="industry" class="form-select">
                        <option value="">Semua</option>
                        <?php foreach ($industries as $ind): ?>
                            <option value="<?= e($ind['industry']) ?>" <?= $industry === $ind['industry'] ? 'selected' : '' ?>>
                                <?= ucfirst($ind['industry']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Style -->
                <div class="col-lg-2 col-md-6">
                    <label class="form-label"><i class="bi bi-palette"></i> Style</label>
                    <select name="style" class="form-select">
                        <option value="">Semua</option>
                        <?php foreach ($styles as $st): ?>
                            <option value="<?= e($st['style']) ?>" <?= $style === $st['style'] ? 'selected' : '' ?>>
                                <?= ucfirst($st['style']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Submit -->
                <div class="col-lg-2 col-md-12">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search"></i> Filter
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>

<!-- Demo Grid -->
<section class="portfolio-grid" id="demo-grid">
    <div class="container">
        <!-- Results Info -->
        <div class="results-info mb-4">
            <p class="text-muted">
                Menampilkan <?= count($portfolios) ?> dari <?= format_number($total_demos) ?> demo
                <?php if ($search): ?>
                    untuk pencarian "<strong><?= e($search) ?></strong>"
                <?php endif; ?>
            </p>
        </div>

        <?php if (empty($portfolios)): ?>
            <!-- No Results -->
            <div class="no-results text-center py-5">
                <i class="bi bi-inbox" style="font-size: 4rem; color: var(--gray-400);"></i>
                <h3 class="mt-3">Tidak Ada Demo Ditemukan</h3>
                <p class="text-muted">Coba ubah filter atau request custom demo!</p>
                <a href="<?= url('demo') ?>" class="btn btn-success mt-3">
                    <i class="bi bi-gift"></i> Request Custom Demo GRATIS
                </a>
            </div>
        <?php else: ?>
            <!-- Portfolio Grid -->
            <div class="row g-4">
                <?php foreach ($portfolios as $portfolio): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="portfolio-card" data-aos="fade-up">
                        <!-- Featured Badge -->
                        <?php if ($portfolio['is_featured']): ?>
                            <div class="featured-badge">
                                <i class="bi bi-star-fill"></i> Featured
                            </div>
                        <?php endif; ?>

                        <!-- Screenshot -->
                        <div class="portfolio-screenshot">
                            <?php if ($portfolio['screenshot_url']): ?>
                                <img src="<?= e($portfolio['screenshot_url']) ?>" alt="<?= e($portfolio['title']) ?>" loading="lazy">
                            <?php else: ?>
                                <div class="placeholder-screenshot">
                                    <i class="bi bi-image"></i>
                                    <span>Screenshot Coming Soon</span>
                                </div>
                            <?php endif; ?>

                            <!-- Preview Overlay -->
                            <div class="preview-overlay">
                                <?php if ($portfolio['demo_url']): ?>
                                    <a href="<?= e($portfolio['demo_url']) ?>" target="_blank" class="btn btn-light btn-sm">
                                        <i class="bi bi-eye"></i> Live Preview
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Info -->
                        <div class="portfolio-info">
                            <!-- Category & Industry -->
                            <div class="portfolio-meta">
                                <span class="badge bg-primary"><?= ucfirst($portfolio['category']) ?></span>
                                <?php if ($portfolio['industry']): ?>
                                    <span class="badge bg-secondary"><?= ucfirst($portfolio['industry']) ?></span>
                                <?php endif; ?>
                            </div>

                            <!-- Title -->
                            <h3 class="portfolio-title">
                                <?= e($portfolio['title']) ?>
                            </h3>

                            <!-- Description -->
                            <p class="portfolio-description">
                                <?= truncate($portfolio['description'], 100) ?>
                            </p>

                            <!-- Tech Stack -->
                            <?php if ($portfolio['tech_stack']): ?>
                                <div class="tech-stack-mini">
                                    <?php
                                    $techs = json_decode($portfolio['tech_stack'], true);
                                    if ($techs && is_array($techs)):
                                        foreach (array_slice($techs, 0, 3) as $tech):
                                    ?>
                                        <span class="tech-badge"><?= e($tech) ?></span>
                                    <?php
                                        endforeach;
                                        if (count($techs) > 3):
                                    ?>
                                        <span class="tech-badge">+<?= count($techs) - 3 ?></span>
                                    <?php
                                        endif;
                                    endif;
                                    ?>
                                </div>
                            <?php endif; ?>

                            <!-- Stats -->
                            <div class="portfolio-stats">
                                <span class="stat">
                                    <i class="bi bi-eye"></i>
                                    <?= format_number($portfolio['views']) ?>
                                </span>
                                <span class="stat">
                                    <i class="bi bi-heart"></i>
                                    <?= format_number($portfolio['likes']) ?>
                                </span>
                                <?php if ($portfolio['style']): ?>
                                    <span class="stat">
                                        <i class="bi bi-palette"></i>
                                        <?= ucfirst($portfolio['style']) ?>
                                    </span>
                                <?php endif; ?>
                            </div>

                            <!-- Actions -->
                            <div class="portfolio-actions">
                                <?php if ($portfolio['demo_url']): ?>
                                    <a href="<?= e($portfolio['demo_url']) ?>" target="_blank" class="btn btn-primary btn-sm">
                                        <i class="bi bi-eye"></i> Live Preview
                                    </a>
                                <?php endif; ?>
                                <a href="<?= url('order?demo=' . $portfolio['slug']) ?>" class="btn btn-success btn-sm">
                                    <i class="bi bi-cart-plus"></i> Pesan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Pagination -->
            <?php if ($total_pages > 1): ?>
            <div class="pagination-wrapper mt-5">
                <nav aria-label="Portfolio pagination">
                    <ul class="pagination justify-content-center">
                        <?php if ($page > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="<?= url('portfolio?' . http_build_query(array_merge($_GET, ['page' => $page - 1]))) ?>">
                                <i class="bi bi-chevron-left"></i>
                            </a>
                        </li>
                        <?php endif; ?>

                        <?php
                        $start = max(1, $page - 2);
                        $end = min($total_pages, $page + 2);
                        for ($i = $start; $i <= $end; $i++):
                        ?>
                        <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                            <a class="page-link" href="<?= url('portfolio?' . http_build_query(array_merge($_GET, ['page' => $i]))) ?>">
                                <?= $i ?>
                            </a>
                        </li>
                        <?php endfor; ?>

                        <?php if ($page < $total_pages): ?>
                        <li class="page-item">
                            <a class="page-link" href="<?= url('portfolio?' . http_build_query(array_merge($_GET, ['page' => $page + 1]))) ?>">
                                <i class="bi bi-chevron-right"></i>
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

<!-- Browse More CTA -->
<section class="browse-more-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h2><i class="bi bi-infinity"></i> 1500+ Kombinasi Demo Lainnya</h2>
                <p>Masih banyak kombinasi industry × category × style yang bisa dibrowse! Atau request custom demo sesuai kebutuhan Anda.</p>
            </div>
            <div class="col-lg-4 text-lg-end">
                <a href="<?= url('demo') ?>" class="btn btn-success btn-lg">
                    <i class="bi bi-gift"></i> Request Custom Demo
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Our Demos -->
<section class="why-demos-section">
    <div class="container">
        <div class="section-header text-center mb-5">
            <h2 class="section-title">Kenapa Demo Kami Berbeda?</h2>
        </div>

        <div class="row g-4">
            <div class="col-lg-3 col-md-6" data-aos="fade-up">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-lightning-fill"></i>
                    </div>
                    <h4>Production-Ready</h4>
                    <p>Bukan mockup! Semua demo LIVE dan siap deploy langsung</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-phone"></i>
                    </div>
                    <h4>Fully Responsive</h4>
                    <p>Perfect di semua device: desktop, tablet, mobile</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-speedometer2"></i>
                    </div>
                    <h4>Super Cepat</h4>
                    <p>Optimized performance, SEO-friendly, fast loading</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-brush"></i>
                    </div>
                    <h4>Fully Customizable</h4>
                    <p>Bisa disesuaikan warna, konten, logo, semuanya!</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="portfolio-cta-section">
    <div class="container text-center">
        <h2>Tertarik dengan Demo Ini?</h2>
        <p class="lead">Pesan sekarang dan launch website Anda dalam 24 jam!</p>
        <div class="cta-buttons">
            <a href="<?= url('contact') ?>" class="btn btn-light btn-lg">
                <i class="bi bi-envelope"></i> Hubungi Kami
            </a>
            <a href="<?= whatsapp_link(COMPANY_WHATSAPP, 'Halo, saya tertarik dengan demo di portfolio') ?>" class="btn btn-success btn-lg" target="_blank">
                <i class="bi bi-whatsapp"></i> Chat WhatsApp
            </a>
        </div>
    </div>
</section>

<?php include INCLUDES_PATH . 'footer/public-footer.php'; ?>

<style>
/* Portfolio Specific Styles */
.portfolio-hero {
    background: linear-gradient(135deg, var(--dark) 0%, var(--dark-light) 100%);
    color: var(--white);
    padding: 100px 0 60px;
}

.hero-stats {
    display: flex;
    justify-content: center;
    gap: 3rem;
    margin: 2rem 0;
    flex-wrap: wrap;
}

.hero-stats .stat-item {
    text-align: center;
}

.hero-stats .stat-item i {
    display: block;
    font-size: 2.5rem;
    color: var(--primary-light);
    margin-bottom: 0.5rem;
}

.hero-stats .stat-item strong {
    display: block;
    font-size: 1.75rem;
    color: var(--white);
}

.hero-stats .stat-item span {
    color: rgba(255, 255, 255, 0.8);
    font-size: 0.875rem;
}

.portfolio-filters {
    background: var(--gray-50);
    padding: 2rem 0;
    border-bottom: 2px solid var(--gray-200);
}

.portfolio-grid {
    padding: 3rem 0;
}

.portfolio-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow);
    transition: var(--transition);
    height: 100%;
    position: relative;
}

.portfolio-card:hover {
    transform: translateY(-10px);
    box-shadow: var(--shadow-xl);
}

.featured-badge {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background: var(--gradient-warning);
    color: var(--white);
    padding: 0.375rem 0.75rem;
    border-radius: var(--radius);
    font-size: 0.75rem;
    font-weight: 700;
    z-index: 10;
}

.portfolio-screenshot {
    position: relative;
    width: 100%;
    height: 250px;
    overflow: hidden;
    background: var(--gray-100);
}

.portfolio-screenshot img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: var(--transition);
}

.portfolio-card:hover .portfolio-screenshot img {
    transform: scale(1.1);
}

.placeholder-screenshot {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    height: 100%;
    color: var(--gray-400);
}

.placeholder-screenshot i {
    font-size: 3rem;
    margin-bottom: 0.5rem;
}

.preview-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: var(--transition);
}

.portfolio-card:hover .preview-overlay {
    opacity: 1;
}

.portfolio-info {
    padding: 1.5rem;
}

.portfolio-meta {
    display: flex;
    gap: 0.5rem;
    margin-bottom: 1rem;
    flex-wrap: wrap;
}

.portfolio-title {
    font-size: 1.25rem;
    margin-bottom: 0.75rem;
    color: var(--dark);
}

.portfolio-description {
    color: var(--gray-600);
    font-size: 0.875rem;
    line-height: 1.6;
    margin-bottom: 1rem;
}

.tech-stack-mini {
    display: flex;
    gap: 0.5rem;
    margin-bottom: 1rem;
    flex-wrap: wrap;
}

.tech-badge {
    padding: 0.25rem 0.5rem;
    background: var(--gray-100);
    border-radius: var(--radius-sm);
    font-size: 0.75rem;
    color: var(--gray-700);
}

.portfolio-stats {
    display: flex;
    gap: 1rem;
    padding: 1rem 0;
    border-top: 1px solid var(--gray-200);
    border-bottom: 1px solid var(--gray-200);
    margin-bottom: 1rem;
    font-size: 0.875rem;
    color: var(--gray-600);
}

.portfolio-stats .stat {
    display: flex;
    align-items: center;
    gap: 0.25rem;
}

.portfolio-actions {
    display: flex;
    gap: 0.5rem;
}

.browse-more-section {
    background: var(--gradient-primary);
    color: var(--white);
    padding: 3rem 0;
}

.browse-more-section h2 {
    color: var(--white);
    margin-bottom: 0.5rem;
}

.why-demos-section {
    padding: 4rem 0;
    background: var(--gray-50);
}

.feature-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    padding: 2rem;
    text-align: center;
    box-shadow: var(--shadow);
    transition: var(--transition);
    height: 100%;
}

.feature-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-xl);
}

.feature-icon {
    width: 80px;
    height: 80px;
    background: var(--gradient-primary);
    color: var(--white);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    margin: 0 auto 1.5rem;
}

.portfolio-cta-section {
    background: var(--gradient-success);
    color: var(--white);
    padding: 4rem 0;
}

.portfolio-cta-section h2 {
    color: var(--white);
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
