<?php
/**
 * Content Editor - Edit konten semua halaman
 *
 * Admin dapat edit:
 * - Homepage content (hero, sections, dll)
 * - About page content
 * - Contact page content
 * - Pricing page content
 * - Dan semua halaman lainnya
 *
 * SEMUA content disimpan di database table 'page_contents'
 */

defined('SITUNEO_ACCESS') or die('Direct access not permitted');

// Require admin access
Auth::requireAdmin();

$db = Database::getInstance();

// Get selected page
$page = get('page', 'homepage');

// Handle content update
if (is_post()) {
    $contents = post('content', []);

    $db->beginTransaction();

    try {
        foreach ($contents as $key => $value) {
            // Check if content exists
            $existing = $db->query("
                SELECT id FROM page_contents
                WHERE page_slug = :page AND content_key = :key
            ", [
                'page' => $page,
                'key' => $key
            ])->fetch();

            if ($existing) {
                // Update existing content
                $db->query("
                    UPDATE page_contents
                    SET content_value = :value,
                        updated_at = :updated_at
                    WHERE page_slug = :page AND content_key = :key
                ", [
                    'value' => $value,
                    'updated_at' => date('Y-m-d H:i:s'),
                    'page' => $page,
                    'key' => $key
                ]);
            } else {
                // Insert new content
                $db->insert('page_contents', [
                    'page_slug' => $page,
                    'content_key' => $key,
                    'content_value' => $value,
                    'content_type' => 'text',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
        }

        $db->commit();

        $db->insert('activity_logs', [
            'user_id' => Auth::id(),
            'action' => 'update_page_content',
            'description' => "Updated {$page} page content",
            'ip_address' => $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0',
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        Session::flashSuccess('Content berhasil diupdate!');
        Router::redirect('admin/content?page=' . $page);
    } catch (Exception $e) {
        $db->rollBack();
        Session::flashError('Error: ' . $e->getMessage());
    }
}

// Get page contents
$contents_data = $db->query("
    SELECT * FROM page_contents
    WHERE page_slug = :page
    ORDER BY content_key
", ['page' => $page])->fetchAll();

// Convert to key-value array
$contents = [];
foreach ($contents_data as $content) {
    $contents[$content['content_key']] = $content['content_value'];
}

// Helper function
function get_content($key, $default = '') {
    global $contents;
    return $contents[$key] ?? $default;
}

// Define page templates with editable fields
$page_templates = [
    'homepage' => [
        'name' => 'Homepage',
        'url' => url('/'),
        'fields' => [
            'hero_title' => ['label' => 'Hero Title', 'type' => 'text', 'default' => '232+ Layanan Digital'],
            'hero_subtitle' => ['label' => 'Hero Subtitle', 'type' => 'textarea', 'default' => 'Dual Pricing System " Beli Putus & Sewa Bulanan'],
            'hero_description' => ['label' => 'Hero Description', 'type' => 'textarea', 'default' => 'Digital agency terlengkap di Indonesia...'],
            'stats_services' => ['label' => 'Stats: Total Services', 'type' => 'number', 'default' => '232'],
            'stats_demos' => ['label' => 'Stats: Total Demos', 'type' => 'number', 'default' => '50'],
            'stats_combinations' => ['label' => 'Stats: Kombinasi Template', 'type' => 'number', 'default' => '1500'],
            'section_pricing_title' => ['label' => 'Pricing Section Title', 'type' => 'text', 'default' => 'Dual Pricing System'],
            'section_pricing_description' => ['label' => 'Pricing Section Description', 'type' => 'textarea', 'default' => 'Pilih cara pembayaran yang paling cocok...'],
        ]
    ],
    'about' => [
        'name' => 'About Us',
        'url' => url('about'),
        'fields' => [
            'hero_title' => ['label' => 'Hero Title', 'type' => 'text', 'default' => 'SITUNEO DIGITAL'],
            'hero_subtitle' => ['label' => 'Hero Subtitle', 'type' => 'text', 'default' => 'Website Era Baru'],
            'hero_description' => ['label' => 'Hero Description', 'type' => 'textarea', 'default' => 'Digital agency terlengkap di Indonesia...'],
            'story_title' => ['label' => 'Story Title', 'type' => 'text', 'default' => 'Kenapa SITUNEO DIGITAL?'],
            'story_content' => ['label' => 'Story Content', 'type' => 'wysiwyg', 'default' => 'Kami hadir untuk memberikan solusi digital...'],
            'values_title' => ['label' => 'Values Section Title', 'type' => 'text', 'default' => 'Nilai-Nilai Kami'],
            'value_1_title' => ['label' => 'Value 1 Title', 'type' => 'text', 'default' => 'Terpercaya'],
            'value_1_description' => ['label' => 'Value 1 Description', 'type' => 'text', 'default' => 'Legalitas jelas, NIB terdaftar'],
            'value_2_title' => ['label' => 'Value 2 Title', 'type' => 'text', 'default' => 'Terjangkau'],
            'value_2_description' => ['label' => 'Value 2 Description', 'type' => 'text', 'default' => 'Dual pricing: beli putus atau sewa bulanan'],
        ]
    ],
    'contact' => [
        'name' => 'Contact Us',
        'url' => url('contact'),
        'fields' => [
            'hero_title' => ['label' => 'Hero Title', 'type' => 'text', 'default' => 'Hubungi Kami'],
            'hero_description' => ['label' => 'Hero Description', 'type' => 'textarea', 'default' => 'Punya pertanyaan? Butuh konsultasi?'],
            'contact_whatsapp_label' => ['label' => 'WhatsApp Label', 'type' => 'text', 'default' => 'WhatsApp'],
            'contact_email_label' => ['label' => 'Email Label', 'type' => 'text', 'default' => 'Email'],
            'contact_phone_label' => ['label' => 'Phone Label', 'type' => 'text', 'default' => 'Telepon'],
            'form_title' => ['label' => 'Form Title', 'type' => 'text', 'default' => 'Kirim Pesan'],
        ]
    ],
    'pricing' => [
        'name' => 'Pricing Page',
        'url' => url('pricing'),
        'fields' => [
            'hero_title' => ['label' => 'Hero Title', 'type' => 'text', 'default' => 'Dual Pricing System'],
            'hero_description' => ['label' => 'Hero Description', 'type' => 'textarea', 'default' => 'Pilih cara pembayaran yang paling cocok dengan budget Anda'],
            'one_time_title' => ['label' => 'One-Time Section Title', 'type' => 'text', 'default' => 'Beli Putus'],
            'one_time_description' => ['label' => 'One-Time Description', 'type' => 'textarea', 'default' => 'Full ownership, no monthly fee'],
            'subscription_title' => ['label' => 'Subscription Section Title', 'type' => 'text', 'default' => 'Sewa Bulanan'],
            'subscription_description' => ['label' => 'Subscription Description', 'type' => 'textarea', 'default' => 'Zero setup fee, includes maintenance'],
        ]
    ],
];

$current_template = $page_templates[$page] ?? $page_templates['homepage'];

$page_title = 'Edit Content: ' . $current_template['name'] . ' - Admin Panel';

include ADMIN_PATH . 'includes/admin-header.php';
?>

<div class="content-editor-container">
    <div class="content-editor-header">
        <div>
            <h1><i class="bi bi-file-text"></i> Edit Page Content</h1>
            <p class="text-muted">Edit konten semua halaman tanpa coding</p>
        </div>
        <div class="header-actions">
            <a href="<?= $current_template['url'] ?>" class="btn btn-outline-primary" target="_blank">
                <i class="bi bi-eye"></i> Preview Page
            </a>
        </div>
    </div>

    <!-- Page Selector -->
    <div class="page-selector" data-aos="fade-up">
        <div class="page-tabs">
            <?php foreach ($page_templates as $slug => $template): ?>
            <a href="<?= url('admin/content?page=' . $slug) ?>" class="page-tab <?= $page === $slug ? 'active' : '' ?>">
                <i class="bi bi-file-text"></i>
                <?= $template['name'] ?>
            </a>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Content Form -->
    <form method="post" action="<?= url('admin/content?page=' . $page) ?>">
        <?= csrf_field() ?>

        <div class="row">
            <div class="col-lg-9">
                <div class="content-card" data-aos="fade-up">
                    <div class="card-header">
                        <h3><i class="bi bi-pencil"></i> Edit Content: <?= $current_template['name'] ?></h3>
                        <p class="text-muted">Semua perubahan akan langsung tampil di website</p>
                    </div>
                    <div class="card-body">
                        <?php foreach ($current_template['fields'] as $field_key => $field): ?>
                        <div class="mb-4">
                            <label class="form-label"><strong><?= $field['label'] ?></strong></label>

                            <?php if ($field['type'] === 'text'): ?>
                            <input type="text" name="content[<?= $field_key ?>]" class="form-control" value="<?= htmlspecialchars(get_content($field_key, $field['default'])) ?>">

                            <?php elseif ($field['type'] === 'number'): ?>
                            <input type="number" name="content[<?= $field_key ?>]" class="form-control" value="<?= htmlspecialchars(get_content($field_key, $field['default'])) ?>">

                            <?php elseif ($field['type'] === 'textarea'): ?>
                            <textarea name="content[<?= $field_key ?>]" class="form-control" rows="4"><?= htmlspecialchars(get_content($field_key, $field['default'])) ?></textarea>

                            <?php elseif ($field['type'] === 'wysiwyg'): ?>
                            <textarea name="content[<?= $field_key ?>]" class="form-control wysiwyg" rows="8"><?= htmlspecialchars(get_content($field_key, $field['default'])) ?></textarea>
                            <small class="text-muted">Mendukung HTML basic: &lt;p&gt;, &lt;strong&gt;, &lt;br&gt;, dll</small>

                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="content-sidebar sticky-sidebar" data-aos="fade-up">
                    <div class="card-header">
                        <h3><i class="bi bi-gear"></i> Actions</h3>
                    </div>
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary w-100 mb-3">
                            <i class="bi bi-check-circle"></i> Save Changes
                        </button>

                        <a href="<?= $current_template['url'] ?>" class="btn btn-info w-100 mb-3" target="_blank">
                            <i class="bi bi-eye"></i> Preview Page
                        </a>

                        <hr>

                        <div class="alert alert-info">
                            <i class="bi bi-info-circle"></i>
                            <small><strong>Tips:</strong> Semua perubahan disimpan di database. Tidak perlu edit file PHP!</small>
                        </div>

                        <hr>

                        <h6>Quick Links:</h6>
                        <div class="quick-links">
                            <a href="<?= url('admin/settings') ?>"><i class="bi bi-gear"></i> Settings</a>
                            <a href="<?= url('admin/services') ?>"><i class="bi bi-basket"></i> Services</a>
                            <a href="<?= url('admin/portfolios') ?>"><i class="bi bi-image"></i> Portfolios</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<?php include ADMIN_PATH . 'includes/admin-footer.php'; ?>

<style>
.content-editor-container {
    padding: 2rem;
    max-width: 1400px;
    margin: 0 auto;
}

.content-editor-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.content-editor-header h1 {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.25rem;
}

.page-selector {
    background: var(--white);
    border-radius: var(--radius-lg);
    padding: 1rem;
    box-shadow: var(--shadow);
    margin-bottom: 1.5rem;
}

.page-tabs {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.page-tab {
    padding: 0.875rem 1.5rem;
    border-radius: var(--radius);
    text-decoration: none;
    color: var(--gray-700);
    background: var(--gray-50);
    transition: var(--transition);
    border: 2px solid transparent;
}

.page-tab:hover {
    background: var(--gray-100);
    color: var(--primary-color);
}

.page-tab.active {
    background: var(--gradient-primary);
    color: var(--white);
    border-color: var(--primary-color);
}

.content-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow);
    overflow: hidden;
}

.content-card .card-header {
    background: var(--gradient-primary);
    color: var(--white);
    padding: 1.5rem;
}

.content-card .card-header h3 {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 0.25rem;
}

.content-card .card-header p {
    margin: 0;
    opacity: 0.9;
    font-size: 0.875rem;
}

.content-card .card-body {
    padding: 2rem;
}

.content-sidebar {
    background: var(--white);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow);
    overflow: hidden;
    position: sticky;
    top: 90px;
}

.content-sidebar .card-header {
    background: var(--gray-50);
    padding: 1rem 1.5rem;
    border-bottom: 1px solid var(--gray-200);
}

.content-sidebar .card-header h3 {
    font-size: 1.125rem;
    font-weight: 600;
    margin: 0;
}

.content-sidebar .card-body {
    padding: 1.5rem;
}

.quick-links {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.quick-links a {
    padding: 0.5rem 0.75rem;
    border-radius: var(--radius);
    text-decoration: none;
    color: var(--gray-700);
    background: var(--gray-50);
    transition: var(--transition);
}

.quick-links a:hover {
    background: var(--primary-light);
    color: var(--primary-color);
}

.wysiwyg {
    font-family: monospace;
}
</style>
