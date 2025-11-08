<?php
defined('SITUNEO_ACCESS') or die('Direct access not permitted');

$slug = Router::getParam('slug');
$db = Database::getInstance();

$portfolio = $db->query("SELECT * FROM portfolios WHERE slug = :slug AND is_active = 1", ['slug' => $slug])->fetch();

if (!$portfolio) {
    Router::redirect('portfolio');
}

$page_title = $portfolio['title'] . ' - Portfolio SITUNEO DIGITAL';
include INCLUDES_PATH . 'header/public-header.php';
?>

<section class="portfolio-detail py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto" data-aos="fade-up">
                <h1><?= htmlspecialchars($portfolio['title']) ?></h1>
                <p class="text-muted"><?= htmlspecialchars($portfolio['category']) ?> | <?= htmlspecialchars($portfolio['industry']) ?></p>
                
                <?php if ($portfolio['demo_url']): ?>
                <a href="<?= htmlspecialchars($portfolio['demo_url']) ?>" class="btn btn-primary mb-4" target="_blank">
                    <i class="bi bi-eye"></i> Live Preview
                </a>
                <?php endif; ?>

                <div class="portfolio-content">
                    <p><?= nl2br(htmlspecialchars($portfolio['description'])) ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include INCLUDES_PATH . 'footer/public-footer.php'; ?>
