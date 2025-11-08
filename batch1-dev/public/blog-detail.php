<?php
defined('SITUNEO_ACCESS') or die('Direct access not permitted');

$slug = Router::getParam('slug');
$page_title = 'Blog - SITUNEO DIGITAL';
include INCLUDES_PATH . 'header/public-header.php';
?>

<section class="blog-detail py-5">
    <div class="container">
        <h1><?= htmlspecialchars($slug) ?></h1>
        <div class="alert alert-info mt-4">
            <i class="bi bi-info-circle"></i> Blog post detail - Coming soon!
        </div>
    </div>
</section>

<?php include INCLUDES_PATH . 'footer/public-footer.php'; ?>
