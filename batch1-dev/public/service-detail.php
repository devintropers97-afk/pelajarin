<?php
/**
 * Service Detail Page
 *
 * Menampilkan detail lengkap service:
 * - Full description
 * - Features list
 * - Dual pricing comparison
 * - Tech stack
 * - Process timeline
 * - FAQs
 * - Related services
 * - Order button
 */

defined('SITUNEO_ACCESS') or die('Direct access not permitted');

// Get service slug from URL
$slug = Router::getParam('slug') ?? get_input('slug', '');

if (empty($slug)) {
    Router::redirect('services');
}

try {
    $db = Database::getInstance();

    // Get service with category info
    $services = $db->query("
        SELECT s.*, sc.name as category_name, sc.slug as category_slug,
               sc.icon as category_icon, sc.color as category_color
        FROM services s
        LEFT JOIN service_categories sc ON s.category_id = sc.id
        WHERE s.slug = :slug AND s.is_active = 1
        LIMIT 1
    ", [':slug' => $slug])->fetchAll();

    if (empty($services)) {
        Router::redirect('services');
    }

    $service = $services[0];

    // Increment view count
    $db->update('services',
        ['views' => $service['views'] + 1],
        'id = :id',
        [':id' => $service['id']]
    );

    // Get related services (same category)
    $related_services = $db->query("
        SELECT s.*, sc.name as category_name, sc.slug as category_slug
        FROM services s
        LEFT JOIN service_categories sc ON s.category_id = sc.id
        WHERE s.category_id = :category_id
          AND s.id != :id
          AND s.is_active = 1
        ORDER BY RAND()
        LIMIT 4
    ", [
        ':category_id' => $service['category_id'],
        ':id' => $service['id']
    ])->fetchAll();

    // Parse features JSON
    $features = !empty($service['features']) ? json_decode($service['features'], true) : [];

    // Parse tech stack JSON
    $tech_stack = !empty($service['tech_stack']) ? json_decode($service['tech_stack'], true) : [];

    // Calculate savings
    $savings = calculate_savings($service['one_time_price'], $service['monthly_price']);

} catch (Exception $e) {
    error_log('Service detail error: ' . $e->getMessage());
    Router::redirect('services');
}

$page_title = e($service['name']) . ' - SITUNEO DIGITAL';
$page_description = truncate(strip_tags($service['description']), 160);

include INCLUDES_PATH . 'header/public-header.php';
?>

<!-- Service Hero -->
<section class="service-hero">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= url('/') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="<?= url('services') ?>">Layanan</a></li>
                        <li class="breadcrumb-item"><a href="<?= url('services?category=' . $service['category_slug']) ?>"><?= e($service['category_name']) ?></a></li>
                        <li class="breadcrumb-item active"><?= e($service['name']) ?></li>
                    </ol>
                </nav>

                <!-- Category Badge -->
                <div class="category-badge mb-3" style="background: <?= e($service['category_color']) ?>20; color: <?= e($service['category_color']) ?>;">
                    <i class="bi <?= e($service['category_icon']) ?>"></i>
                    <?= e($service['category_name']) ?>
                </div>

                <!-- Title -->
                <h1 class="service-hero-title">
                    <?= e($service['name']) ?>
                    <?php if ($service['is_featured']): ?>
                        <span class="badge bg-warning ms-2"><i class="bi bi-star-fill"></i> Featured</span>
                    <?php endif; ?>
                </h1>

                <!-- Meta Info -->
                <div class="service-meta">
                    <span class="meta-item">
                        <i class="bi bi-clock"></i>
                        Pengerjaan <?= $service['delivery_time'] ?> hari
                    </span>
                    <span class="meta-item">
                        <i class="bi bi-arrow-repeat"></i>
                        <?= $service['revisions'] === 999 ? 'Unlimited Revisi' : $service['revisions'] . ' Revisi' ?>
                    </span>
                    <span class="meta-item">
                        <i class="bi bi-eye"></i>
                        <?= format_number($service['views']) ?> views
                    </span>
                </div>
            </div>

            <div class="col-lg-4">
                <!-- Quick Action Card -->
                <div class="quick-action-card">
                    <div class="price-display">
                        <div class="price-label">Mulai dari</div>
                        <?php if ($service['pricing_model'] === 'subscription_only'): ?>
                            <div class="price-value"><?= format_rupiah($service['monthly_price']) ?><span>/bln</span></div>
                        <?php else: ?>
                            <div class="price-value"><?= format_rupiah($service['one_time_price']) ?></div>
                        <?php endif; ?>
                    </div>
                    <a href="#pricing-section" class="btn btn-primary btn-lg w-100 mb-2">
                        <i class="bi bi-cart-plus"></i> Pesan Sekarang
                    </a>
                    <a href="<?= whatsapp_link(COMPANY_WHATSAPP, 'Halo, saya tertarik dengan layanan ' . $service['name']) ?>" class="btn btn-success btn-lg w-100" target="_blank">
                        <i class="bi bi-whatsapp"></i> Chat WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Service Content -->
<section class="service-content">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Description -->
                <div class="content-section" data-aos="fade-up">
                    <h2><i class="bi bi-file-text"></i> Deskripsi Layanan</h2>
                    <div class="description-content">
                        <?= nl2br(e($service['description'])) ?>
                    </div>
                </div>

                <!-- Features -->
                <?php if (!empty($features)): ?>
                <div class="content-section" data-aos="fade-up">
                    <h2><i class="bi bi-check-circle"></i> Fitur yang Didapatkan</h2>
                    <div class="features-grid">
                        <?php foreach ($features as $feature): ?>
                        <div class="feature-item">
                            <i class="bi bi-check-circle-fill text-success"></i>
                            <span><?= e($feature) ?></span>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Tech Stack -->
                <?php if (!empty($tech_stack)): ?>
                <div class="content-section" data-aos="fade-up">
                    <h2><i class="bi bi-code-slash"></i> Teknologi yang Digunakan</h2>
                    <div class="tech-stack-grid">
                        <?php foreach ($tech_stack as $tech): ?>
                        <div class="tech-badge">
                            <?= e($tech) ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Pricing Comparison -->
                <div class="content-section" id="pricing-section" data-aos="fade-up">
                    <h2><i class="bi bi-cash-stack"></i> Pilihan Harga</h2>

                    <?php if ($service['pricing_model'] === 'both'): ?>
                    <div class="row g-4">
                        <!-- One-Time -->
                        <div class="col-md-6">
                            <div class="pricing-detail-card onetime">
                                <div class="pricing-header">
                                    <div class="pricing-icon">
                                        <i class="bi bi-cash-coin"></i>
                                    </div>
                                    <h3>Beli Putus</h3>
                                    <p>Bayar sekali, milik selamanya</p>
                                </div>
                                <div class="pricing-price">
                                    <?= format_rupiah($service['one_time_price']) ?>
                                    <?php if ($service['setup_fee'] > 0): ?>
                                        <small class="d-block mt-2 text-muted">+ Setup: <?= format_rupiah($service['setup_fee']) ?></small>
                                    <?php endif; ?>
                                </div>
                                <ul class="pricing-benefits">
                                    <li><i class="bi bi-check"></i> Ownership 100%</li>
                                    <li><i class="bi bi-check"></i> Source Code Diberikan</li>
                                    <li><i class="bi bi-check"></i> Bisa Migrate Hosting</li>
                                    <li><i class="bi bi-check"></i> TANPA Biaya Bulanan</li>
                                </ul>
                                <div class="pricing-note">
                                    =¡ Lebih hemat untuk jangka panjang (>12 bulan)
                                </div>
                            </div>
                        </div>

                        <!-- Subscription -->
                        <div class="col-md-6">
                            <div class="pricing-detail-card subscription featured">
                                <div class="featured-label">PALING POPULER</div>
                                <div class="pricing-header">
                                    <div class="pricing-icon">
                                        <i class="bi bi-arrow-repeat"></i>
                                    </div>
                                    <h3>Sewa Bulanan</h3>
                                    <p>Bayar bulanan, tanpa komitmen panjang</p>
                                </div>
                                <div class="pricing-price">
                                    <?= format_rupiah($service['monthly_price']) ?><span>/bulan</span>
                                    <?php if ($service['setup_fee'] > 0): ?>
                                        <small class="d-block mt-2 text-muted">Setup: GRATIS</small>
                                    <?php endif; ?>
                                </div>
                                <ul class="pricing-benefits">
                                    <li><i class="bi bi-check"></i> TANPA Setup Fee</li>
                                    <li><i class="bi bi-check"></i> Maintenance GRATIS</li>
                                    <li><i class="bi bi-check"></i> Update Selamanya</li>
                                    <li><i class="bi bi-check"></i> Support 24/7</li>
                                </ul>
                                <div class="pricing-note">
                                    =¡ Bisa berhenti kapan saja, cocok untuk testing
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Savings Calculation -->
                    <div class="savings-info mt-4">
                        <div class="alert alert-info">
                            <strong>=° Analisa Hemat:</strong><br>
                            Jika sewa selama <?= $savings['break_even_months'] ?> bulan = <?= format_rupiah($service['monthly_price'] * $savings['break_even_months']) ?><br>
                            Lebih baik Beli Putus dan hemat <?= format_rupiah($savings['savings_amount']) ?>!
                        </div>
                    </div>

                    <?php elseif ($service['pricing_model'] === 'one_time_only'): ?>
                    <!-- One-Time Only -->
                    <div class="pricing-detail-card onetime">
                        <div class="pricing-header">
                            <div class="pricing-icon">
                                <i class="bi bi-cash-coin"></i>
                            </div>
                            <h3>Beli Putus</h3>
                            <p>Bayar sekali, milik selamanya</p>
                        </div>
                        <div class="pricing-price">
                            <?= format_rupiah($service['one_time_price']) ?>
                            <?php if ($service['setup_fee'] > 0): ?>
                                <small class="d-block mt-2 text-muted">+ Setup: <?= format_rupiah($service['setup_fee']) ?></small>
                            <?php endif; ?>
                        </div>
                        <ul class="pricing-benefits">
                            <li><i class="bi bi-check"></i> Ownership 100%</li>
                            <li><i class="bi bi-check"></i> Source Code Diberikan</li>
                            <li><i class="bi bi-check"></i> Bisa Migrate Hosting</li>
                            <li><i class="bi bi-check"></i> TANPA Biaya Bulanan</li>
                        </ul>
                    </div>

                    <?php else: // subscription_only ?>
                    <!-- Subscription Only -->
                    <div class="pricing-detail-card subscription">
                        <div class="pricing-header">
                            <div class="pricing-icon">
                                <i class="bi bi-arrow-repeat"></i>
                            </div>
                            <h3>Sewa Bulanan</h3>
                            <p>Bayar bulanan, tanpa komitmen panjang</p>
                        </div>
                        <div class="pricing-price">
                            <?= format_rupiah($service['monthly_price']) ?><span>/bulan</span>
                        </div>
                        <ul class="pricing-benefits">
                            <li><i class="bi bi-check"></i> TANPA Setup Fee</li>
                            <li><i class="bi bi-check"></i> Maintenance GRATIS</li>
                            <li><i class="bi bi-check"></i> Update Selamanya</li>
                            <li><i class="bi bi-check"></i> Support 24/7</li>
                        </ul>
                    </div>
                    <?php endif; ?>

                    <!-- Order Button -->
                    <div class="text-center mt-4">
                        <a href="<?= url('order?service=' . $service['slug']) ?>" class="btn btn-primary btn-lg px-5">
                            <i class="bi bi-cart-plus"></i> Pesan Layanan Ini
                        </a>
                    </div>
                </div>

                <!-- Process Timeline -->
                <div class="content-section" data-aos="fade-up">
                    <h2><i class="bi bi-diagram-3"></i> Proses Pengerjaan</h2>
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-marker">1</div>
                            <div class="timeline-content">
                                <h4>Konsultasi & Brief</h4>
                                <p>Diskusi kebutuhan, fitur, dan ekspektasi project Anda</p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker">2</div>
                            <div class="timeline-content">
                                <h4>Desain & Approval</h4>
                                <p>Pembuatan mockup/wireframe untuk persetujuan</p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker">3</div>
                            <div class="timeline-content">
                                <h4>Development</h4>
                                <p>Pengerjaan coding sesuai desain yang disetujui</p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker">4</div>
                            <div class="timeline-content">
                                <h4>Testing & Revisi</h4>
                                <p>Quality assurance dan revisi sesuai feedback (<?= $service['revisions'] === 999 ? 'unlimited' : $service['revisions'] . 'x' ?>)</p>
                            </div>
                        </div>
                        <div class="timeline-item">
                            <div class="timeline-marker">5</div>
                            <div class="timeline-content">
                                <h4>Delivery & Support</h4>
                                <p>Serah terima project + training + support</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <!-- Sticky Sidebar -->
                <div class="sidebar-sticky">
                    <!-- Why Choose Us -->
                    <div class="sidebar-card" data-aos="fade-up">
                        <h3><i class="bi bi-award"></i> Kenapa Pilih Kami?</h3>
                        <ul class="benefits-list">
                            <li><i class="bi bi-check-circle-fill"></i> Pengerjaan Cepat & Tepat Waktu</li>
                            <li><i class="bi bi-check-circle-fill"></i> Kualitas Terjamin</li>
                            <li><i class="bi bi-check-circle-fill"></i> Support 24/7</li>
                            <li><i class="bi bi-check-circle-fill"></i> Harga Transparan</li>
                            <li><i class="bi bi-check-circle-fill"></i> Free Konsultasi</li>
                            <li><i class="bi bi-check-circle-fill"></i> Garansi Kepuasan</li>
                        </ul>
                    </div>

                    <!-- Need Help -->
                    <div class="sidebar-card bg-primary text-white" data-aos="fade-up">
                        <h3><i class="bi bi-headset"></i> Butuh Bantuan?</h3>
                        <p>Tim kami siap membantu Anda!</p>
                        <a href="<?= whatsapp_link(COMPANY_WHATSAPP, 'Halo, saya butuh bantuan tentang ' . $service['name']) ?>" class="btn btn-light w-100" target="_blank">
                            <i class="bi bi-whatsapp"></i> Chat WhatsApp
                        </a>
                    </div>

                    <!-- Guarantee -->
                    <div class="sidebar-card" data-aos="fade-up">
                        <h3><i class="bi bi-shield-check"></i> Garansi Kami</h3>
                        <ul class="guarantee-list">
                            <li> 100% Uang Kembali jika tidak sesuai</li>
                            <li> Free Revisi hingga puas</li>
                            <li> Source code lengkap (Beli Putus)</li>
                            <li> Dokumentasi lengkap</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Services -->
<?php if (!empty($related_services)): ?>
<section class="related-services">
    <div class="container">
        <h2 class="section-title text-center mb-5">
            Layanan Terkait
        </h2>
        <div class="row g-4">
            <?php foreach ($related_services as $related): ?>
            <div class="col-lg-3 col-md-6">
                <div class="service-card-mini" data-aos="fade-up">
                    <h4><a href="<?= url('services/' . $related['slug']) ?>"><?= e($related['name']) ?></a></h4>
                    <p><?= truncate($related['description'], 80) ?></p>
                    <div class="price-mini">
                        Mulai <?= format_rupiah(min($related['one_time_price'], $related['monthly_price'])) ?>
                    </div>
                    <a href="<?= url('services/' . $related['slug']) ?>" class="btn btn-sm btn-outline-primary w-100">
                        Lihat Detail
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php include INCLUDES_PATH . 'footer/public-footer.php'; ?>

<style>
/* Service Detail Specific Styles */
.service-hero {
    background: linear-gradient(135deg, var(--dark) 0%, var(--dark-light) 100%);
    color: var(--white);
    padding: 100px 0 40px;
}

.breadcrumb {
    background: rgba(255, 255, 255, 0.1);
    padding: 0.75rem 1rem;
    border-radius: var(--radius);
}

.breadcrumb-item a {
    color: rgba(255, 255, 255, 0.8);
}

.breadcrumb-item.active {
    color: var(--white);
}

.category-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 1rem;
    border-radius: var(--radius);
    font-weight: 600;
}

.service-hero-title {
    color: var(--white);
    font-size: 2.5rem;
    margin-bottom: 1.5rem;
}

.service-meta {
    display: flex;
    gap: 1.5rem;
    flex-wrap: wrap;
    color: rgba(255, 255, 255, 0.8);
}

.meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.quick-action-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    padding: 2rem;
    box-shadow: var(--shadow-xl);
}

.price-display {
    text-align: center;
    margin-bottom: 1.5rem;
    padding-bottom: 1.5rem;
    border-bottom: 2px solid var(--gray-200);
}

.price-label {
    font-size: 0.875rem;
    color: var(--gray-600);
    margin-bottom: 0.5rem;
}

.price-value {
    font-size: 2.5rem;
    font-weight: 800;
    color: var(--primary-color);
}

.price-value span {
    font-size: 1.25rem;
    color: var(--gray-600);
}

.service-content {
    padding: 4rem 0;
}

.content-section {
    margin-bottom: 3rem;
    padding: 2rem;
    background: var(--white);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow);
}

.content-section h2 {
    font-size: 1.75rem;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 2px solid var(--gray-200);
}

.description-content {
    line-height: 1.8;
    color: var(--gray-700);
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1rem;
}

.feature-item {
    display: flex;
    align-items: start;
    gap: 0.75rem;
    padding: 0.75rem;
    background: var(--gray-50);
    border-radius: var(--radius);
}

.tech-stack-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
}

.tech-badge {
    padding: 0.5rem 1rem;
    background: var(--gradient-primary);
    color: var(--white);
    border-radius: var(--radius);
    font-size: 0.875rem;
    font-weight: 600;
}

.pricing-detail-card {
    background: var(--white);
    border: 2px solid var(--gray-200);
    border-radius: var(--radius-xl);
    padding: 2rem;
    position: relative;
    transition: var(--transition);
}

.pricing-detail-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-xl);
}

.pricing-detail-card.onetime {
    border-color: var(--warning-color);
}

.pricing-detail-card.subscription {
    border-color: var(--success-color);
}

.pricing-detail-card.featured {
    border-width: 3px;
}

.featured-label {
    position: absolute;
    top: -15px;
    right: 20px;
    background: var(--gradient-success);
    color: var(--white);
    padding: 0.5rem 1.5rem;
    border-radius: var(--radius-lg);
    font-size: 0.75rem;
    font-weight: 700;
}

.pricing-header {
    text-align: center;
    margin-bottom: 1.5rem;
}

.pricing-icon {
    width: 80px;
    height: 80px;
    background: var(--gradient-primary);
    color: var(--white);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    margin: 0 auto 1rem;
}

.pricing-price {
    text-align: center;
    font-size: 2.5rem;
    font-weight: 800;
    color: var(--dark);
    margin-bottom: 1.5rem;
}

.pricing-benefits {
    list-style: none;
    padding: 0;
    margin-bottom: 1rem;
}

.pricing-benefits li {
    padding: 0.75rem 0;
    border-bottom: 1px solid var(--gray-200);
}

.pricing-note {
    background: var(--gray-50);
    padding: 1rem;
    border-radius: var(--radius);
    font-size: 0.875rem;
}

.timeline {
    position: relative;
    padding-left: 50px;
}

.timeline::before {
    content: '';
    position: absolute;
    left: 20px;
    top: 0;
    bottom: 0;
    width: 2px;
    background: var(--gray-300);
}

.timeline-item {
    position: relative;
    margin-bottom: 2rem;
}

.timeline-marker {
    position: absolute;
    left: -50px;
    top: 0;
    width: 40px;
    height: 40px;
    background: var(--gradient-primary);
    color: var(--white);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
}

.timeline-content h4 {
    color: var(--dark);
    margin-bottom: 0.5rem;
}

.sidebar-sticky {
    position: sticky;
    top: 100px;
}

.sidebar-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    box-shadow: var(--shadow);
}

.sidebar-card h3 {
    font-size: 1.25rem;
    margin-bottom: 1rem;
}

.benefits-list {
    list-style: none;
    padding: 0;
}

.benefits-list li {
    padding: 0.5rem 0;
    display: flex;
    align-items: start;
    gap: 0.5rem;
}

.benefits-list i {
    color: var(--success-color);
    margin-top: 0.25rem;
}

.guarantee-list {
    list-style: none;
    padding: 0;
}

.guarantee-list li {
    padding: 0.5rem 0;
}

.related-services {
    padding: 4rem 0;
    background: var(--gray-50);
}

.service-card-mini {
    background: var(--white);
    border-radius: var(--radius-lg);
    padding: 1.5rem;
    box-shadow: var(--shadow);
    transition: var(--transition);
    height: 100%;
}

.service-card-mini:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-xl);
}

.service-card-mini h4 a {
    color: var(--dark);
    text-decoration: none;
}

.price-mini {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--primary-color);
    margin: 1rem 0;
}
</style>
