<?php
/**
 * Edit Service - FULL CONTROL untuk edit harga & details
 */

defined('SITUNEO_ACCESS') or die('Direct access not permitted');

// Require admin access
Auth::requireAdmin();

$db = Database::getInstance();

$service_id = get('id');
$is_edit = !empty($service_id);

// Get service data if editing
$service = null;
if ($is_edit) {
    $service = $db->query("SELECT * FROM services WHERE id = :id", ['id' => $service_id])->fetch();
    if (!$service) {
        Session::flashError('Service tidak ditemukan');
        Router::redirect('admin/services');
    }
}

// Handle form submission
if (is_post()) {
    $name = post('name');
    $slug = post('slug') ?: slugify($name);
    $category_id = post('category_id');
    $description = post('description');
    $features = post('features');
    $pricing_model = post('pricing_model');
    $one_time_price = post('one_time_price');
    $monthly_price = post('monthly_price');
    $setup_fee = post('setup_fee', 0);
    $is_active = post('is_active', 0);
    $is_featured = post('is_featured', 0);

    $validator = Validator::make([
        'name' => $name,
        'category_id' => $category_id,
        'description' => $description,
        'pricing_model' => $pricing_model,
        'one_time_price' => $one_time_price,
        'monthly_price' => $monthly_price
    ], [
        'name' => 'required|min:3|max:255',
        'category_id' => 'required|numeric',
        'description' => 'required|min:10',
        'pricing_model' => 'required|in:both,one_time_only,subscription_only',
        'one_time_price' => 'required|numeric|min:0',
        'monthly_price' => 'required|numeric|min:0'
    ]);

    if ($validator->validate()) {
        $data = [
            'name' => $name,
            'slug' => $slug,
            'category_id' => $category_id,
            'description' => $description,
            'features' => $features,
            'pricing_model' => $pricing_model,
            'one_time_price' => $one_time_price,
            'monthly_price' => $monthly_price,
            'setup_fee' => $setup_fee,
            'is_active' => $is_active ? 1 : 0,
            'is_featured' => $is_featured ? 1 : 0,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        if ($is_edit) {
            // Update existing service
            $update_fields = [];
            foreach ($data as $key => $value) {
                $update_fields[] = "$key = :$key";
            }
            $data['id'] = $service_id;

            $db->query("UPDATE services SET " . implode(', ', $update_fields) . " WHERE id = :id", $data);

            $db->insert('activity_logs', [
                'user_id' => Auth::id(),
                'action' => 'update_service',
                'description' => "Updated service: {$name}",
                'ip_address' => $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0',
                'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown',
                'created_at' => date('Y-m-d H:i:s')
            ]);

            Session::flashSuccess('Service berhasil diupdate!');
            Router::redirect('admin/services/edit?id=' . $service_id);
        } else {
            // Insert new service
            $data['created_at'] = date('Y-m-d H:i:s');
            $new_id = $db->insert('services', $data);

            $db->insert('activity_logs', [
                'user_id' => Auth::id(),
                'action' => 'create_service',
                'description' => "Created new service: {$name}",
                'ip_address' => $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0',
                'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown',
                'created_at' => date('Y-m-d H:i:s')
            ]);

            Session::flashSuccess('Service berhasil ditambahkan!');
            Router::redirect('admin/services/edit?id=' . $new_id);
        }
    } else {
        Session::flashError(implode('<br>', $validator->all()));
        Session::flashInput($_POST);
    }
}

// Get categories
$categories = $db->query("SELECT * FROM categories WHERE is_active = 1 ORDER BY name")->fetchAll();

$page_title = ($is_edit ? 'Edit' : 'Tambah') . ' Service - Admin Panel';

include ADMIN_PATH . 'includes/admin-header.php';
?>

<div class="edit-container">
    <div class="edit-header">
        <div>
            <h1><i class="bi bi-<?= $is_edit ? 'pencil' : 'plus-circle' ?>"></i> <?= $is_edit ? 'Edit' : 'Tambah' ?> Service</h1>
            <p class="text-muted">Edit harga dan semua detail service</p>
        </div>
        <div class="header-actions">
            <a href="<?= url('admin/services') ?>" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <form method="post" action="<?= url('admin/services/edit' . ($is_edit ? '?id=' . $service_id : '')) ?>">
        <?= csrf_field() ?>

        <div class="row">
            <!-- Basic Info -->
            <div class="col-lg-8">
                <div class="edit-card" data-aos="fade-up">
                    <div class="card-header">
                        <h3><i class="bi bi-info-circle"></i> Basic Information</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Service Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control" value="<?= htmlspecialchars(old('name', $service['name'] ?? '')) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Slug (URL)</label>
                            <input type="text" name="slug" class="form-control" value="<?= htmlspecialchars(old('slug', $service['slug'] ?? '')) ?>" placeholder="auto-generated-from-name">
                            <small class="text-muted">Kosongkan untuk auto-generate dari nama</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Category <span class="text-danger">*</span></label>
                            <select name="category_id" class="form-select" required>
                                <option value="">Pilih kategori...</option>
                                <?php foreach ($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>" <?= old('category_id', $service['category_id'] ?? '') == $cat['id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($cat['name']) ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description <span class="text-danger">*</span></label>
                            <textarea name="description" class="form-control" rows="4" required><?= htmlspecialchars(old('description', $service['description'] ?? '')) ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Features <small class="text-muted">(pisahkan dengan enter)</small></label>
                            <textarea name="features" class="form-control" rows="8" placeholder="Responsive Design&#10;SEO Optimized&#10;Fast Loading"><?= htmlspecialchars(old('features', $service['features'] ?? '')) ?></textarea>
                        </div>
                    </div>
                </div>

                <!-- Pricing -->
                <div class="edit-card" data-aos="fade-up">
                    <div class="card-header bg-gradient-success">
                        <h3><i class="bi bi-cash-coin"></i> Pricing - DUAL PRICING SYSTEM</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <label class="form-label">Pricing Model <span class="text-danger">*</span></label>
                            <select name="pricing_model" class="form-select" id="pricingModel" required>
                                <option value="both" <?= old('pricing_model', $service['pricing_model'] ?? 'both') === 'both' ? 'selected' : '' ?>>Both (Beli Putus & Sewa)</option>
                                <option value="one_time_only" <?= old('pricing_model', $service['pricing_model'] ?? '') === 'one_time_only' ? 'selected' : '' ?>>One-Time Only (Beli Putus Saja)</option>
                                <option value="subscription_only" <?= old('pricing_model', $service['pricing_model'] ?? '') === 'subscription_only' ? 'selected' : '' ?>>Subscription Only (Sewa Saja)</option>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">One-Time Price (Beli Putus) <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="one_time_price" class="form-control" value="<?= old('one_time_price', $service['one_time_price'] ?? 0) ?>" step="0.01" min="0" required>
                                </div>
                                <small class="text-muted">Full ownership, no monthly fee</small>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Monthly Price (Sewa Bulanan) <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="monthly_price" class="form-control" value="<?= old('monthly_price', $service['monthly_price'] ?? 0) ?>" step="0.01" min="0" required>
                                    <span class="input-group-text">/bulan</span>
                                </div>
                                <small class="text-muted">Zero setup fee, includes maintenance</small>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Setup Fee (Optional)</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="setup_fee" class="form-control" value="<?= old('setup_fee', $service['setup_fee'] ?? 0) ?>" step="0.01" min="0">
                            </div>
                            <small class="text-muted">Biaya setup awal (biasanya Rp 0 untuk subscription)</small>
                        </div>

                        <!-- Pricing Calculator Preview -->
                        <div class="pricing-preview mt-4">
                            <h5>Pricing Preview:</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="price-box one-time">
                                        <h6>Beli Putus</h6>
                                        <p class="price" id="previewOneTime">Rp 0</p>
                                        <small>Full ownership</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="price-box subscription">
                                        <h6>Sewa Bulanan</h6>
                                        <p class="price" id="previewMonthly">Rp 0/bln</p>
                                        <small>Includes maintenance</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="edit-card sticky-sidebar" data-aos="fade-up">
                    <div class="card-header">
                        <h3><i class="bi bi-gear"></i> Settings</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input type="checkbox" name="is_active" class="form-check-input" id="isActive" value="1" <?= old('is_active', $service['is_active'] ?? 1) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="isActive"><strong>Active</strong></label>
                                <small class="d-block text-muted">Service akan tampil di website</small>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check form-switch">
                                <input type="checkbox" name="is_featured" class="form-check-input" id="isFeatured" value="1" <?= old('is_featured', $service['is_featured'] ?? 0) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="isFeatured"><strong>Featured</strong></label>
                                <small class="d-block text-muted">Tampilkan di homepage</small>
                            </div>
                        </div>

                        <?php if ($is_edit): ?>
                        <hr>
                        <div class="mb-3">
                            <small class="text-muted">
                                <strong>Created:</strong><br>
                                <?= date('d M Y H:i', strtotime($service['created_at'])) ?>
                            </small>
                        </div>
                        <div class="mb-3">
                            <small class="text-muted">
                                <strong>Last Updated:</strong><br>
                                <?= date('d M Y H:i', strtotime($service['updated_at'])) ?>
                            </small>
                        </div>
                        <?php endif; ?>

                        <hr>

                        <button type="submit" class="btn btn-primary w-100 mb-2">
                            <i class="bi bi-check-circle"></i> <?= $is_edit ? 'Update' : 'Create' ?> Service
                        </button>

                        <?php if ($is_edit): ?>
                        <a href="<?= url('service-detail/' . $service['slug']) ?>" class="btn btn-info w-100 mb-2" target="_blank">
                            <i class="bi bi-eye"></i> Preview
                        </a>
                        <button type="button" class="btn btn-danger w-100" data-confirm-delete onclick="if(confirm('Hapus service ini?')) window.location.href='<?= url('admin/services/delete?id=' . $service_id) ?>'">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<?php include ADMIN_PATH . 'includes/admin-footer.php'; ?>

<script>
// Update pricing preview
function updatePricingPreview() {
    const oneTimePrice = parseFloat(document.querySelector('[name="one_time_price"]').value) || 0;
    const monthlyPrice = parseFloat(document.querySelector('[name="monthly_price"]').value) || 0;

    document.getElementById('previewOneTime').textContent = 'Rp ' + oneTimePrice.toLocaleString('id-ID');
    document.getElementById('previewMonthly').textContent = 'Rp ' + monthlyPrice.toLocaleString('id-ID') + '/bln';
}

document.querySelector('[name="one_time_price"]').addEventListener('input', updatePricingPreview);
document.querySelector('[name="monthly_price"]').addEventListener('input', updatePricingPreview);

// Initialize preview
updatePricingPreview();

// Auto-generate slug from name
document.querySelector('[name="name"]').addEventListener('input', function() {
    const slugInput = document.querySelector('[name="slug"]');
    if (!slugInput.value || slugInput.dataset.auto !== 'false') {
        slugInput.value = this.value
            .toLowerCase()
            .replace(/[^a-z0-9]+/g, '-')
            .replace(/^-+|-+$/g, '');
        slugInput.dataset.auto = 'true';
    }
});

document.querySelector('[name="slug"]').addEventListener('input', function() {
    this.dataset.auto = 'false';
});
</script>

<style>
.edit-container {
    padding: 2rem;
    max-width: 1400px;
    margin: 0 auto;
}

.edit-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.edit-header h1 {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.25rem;
}

.edit-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow);
    margin-bottom: 1.5rem;
    overflow: hidden;
}

.edit-card .card-header {
    background: var(--gradient-primary);
    color: var(--white);
    padding: 1.5rem;
}

.edit-card .card-header.bg-gradient-success {
    background: var(--gradient-success);
}

.edit-card .card-header h3 {
    font-size: 1.25rem;
    font-weight: 600;
    margin: 0;
}

.edit-card .card-body {
    padding: 1.5rem;
}

.sticky-sidebar {
    position: sticky;
    top: 90px;
}

.pricing-preview {
    background: var(--gray-50);
    padding: 1.5rem;
    border-radius: var(--radius);
}

.price-box {
    background: var(--white);
    padding: 1rem;
    border-radius: var(--radius);
    text-align: center;
    border: 2px solid var(--gray-200);
}

.price-box.one-time {
    border-color: var(--success-color);
}

.price-box.subscription {
    border-color: var(--primary-color);
}

.price-box h6 {
    margin-bottom: 0.5rem;
    font-weight: 600;
}

.price-box .price {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--primary-color);
    margin: 0.5rem 0;
}

.price-box.one-time .price {
    color: var(--success-color);
}
</style>
