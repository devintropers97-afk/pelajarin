<?php
/**
 * FREELANCER - KATALOG LAYANAN
 * Browse 232+ layanan Situneo untuk dipromosikan
 */

$page_id = 'services';
$pageTitle = 'Katalog Layanan - SITUNEO DIGITAL';
include __DIR__ . '/../includes/freelancer-header.php';

// Demo data - categories
$service_categories = [
    ['id' => 1, 'name' => 'Web Development', 'total' => 45, 'icon' => 'code-slash'],
    ['id' => 2, 'name' => 'Digital Marketing', 'total' => 38, 'icon' => 'megaphone'],
    ['id' => 3, 'name' => 'Branding & Design', 'total' => 32, 'icon' => 'palette'],
    ['id' => 4, 'name' => 'AI & Automation', 'total' => 28, 'icon' => 'robot'],
    ['id' => 5, 'name' => 'Content Creation', 'total' => 25, 'icon' => 'file-text'],
    ['id' => 6, 'name' => 'E-Commerce', 'total' => 22, 'icon' => 'cart'],
    ['id' => 7, 'name' => 'SEO & Analytics', 'total' => 18, 'icon' => 'graph-up'],
    ['id' => 8, 'name' => 'Mobile App', 'total' => 15, 'icon' => 'phone'],
];

$featured_services = [
    ['name' => 'Website Company Profile', 'price_min' => 2500000, 'price_max' => 15000000],
    ['name' => 'Toko Online', 'price_min' => 5000000, 'price_max' => 25000000],
    ['name' => 'Website UMKM', 'price_min' => 3000000, 'price_max' => 8000000],
    ['name' => 'Branding Paket', 'price_min' => 4000000, 'price_max' => 12000000],
];

$freelancer_rate = 40; // Demo
?>

<div class="mb-4">
    <h2 class="text-gold mb-2">
        <i class="bi bi-grid-3x3-gap me-2"></i>
        Katalog Layanan (232+)
    </h2>
    <p class="text-muted">Komisi Anda: <strong class="text-gold"><?= $freelancer_rate ?>%</strong></p>
</div>

<div class="card-premium mb-4">
    <input type="text" class="form-control" placeholder="Cari layanan...">
</div>

<div class="row g-3 mb-4">
    <?php foreach ($service_categories as $cat): ?>
    <div class="col-lg-4 col-md-6">
        <div class="card-premium category-card">
            <div class="d-flex align-items-center">
                <div class="category-icon">
                    <i class="bi bi-<?= $cat['icon'] ?>"></i>
                </div>
                <div class="flex-grow-1">
                    <h6 class="text-light mb-1"><?= $cat['name'] ?></h6>
                    <small class="text-muted"><?= $cat['total'] ?> layanan</small>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<div class="card-premium">
    <h5 class="text-gold mb-4">Layanan Paling Laris</h5>

    <div class="row g-3">
        <?php foreach ($featured_services as $service):
            $commission_min = $service['price_min'] * $freelancer_rate / 100;
            $commission_max = $service['price_max'] * $freelancer_rate / 100;
        ?>
        <div class="col-md-6">
            <div class="service-item p-3" style="background: rgba(212, 175, 55, 0.05); border-left: 3px solid var(--gold); border-radius: 8px;">
                <h6 class="text-light mb-2"><?= $service['name'] ?></h6>

                <div class="mb-2">
                    <small class="text-muted">Harga:</small>
                    <div class="text-gold fw-bold"><?= formatRupiah($service['price_min']) ?> - <?= formatRupiah($service['price_max']) ?></div>
                </div>

                <div class="mb-3">
                    <small class="text-muted">Komisi Anda (<?= $freelancer_rate ?>%):</small>
                    <div class="text-success fw-bold"><?= formatRupiah($commission_min) ?> - <?= formatRupiah($commission_max) ?></div>
                </div>

                <button class="btn btn-sm btn-gold" onclick="alert('Link copied!')">
                    <i class="bi bi-link-45deg me-1"></i> Get Link
                </button>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<style>
.category-card { transition: all 0.3s ease; }
.category-card:hover { transform: translateY(-3px); }
.category-icon { width: 50px; height: 50px; border-radius: 10px; background: var(--gradient-gold); color: var(--dark-blue); display: flex; align-items: center; justify-content: center; font-size: 1.5rem; margin-right: 1rem; }
</style>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
