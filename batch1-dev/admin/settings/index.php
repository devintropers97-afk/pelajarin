<?php
/**
 * Settings Management - FULL CONTROL
 *
 * Admin dapat edit SEMUA settings website dari sini:
 * - Company Info (nama, email, phone, alamat)
 * - Social Media Links
 * - Logo & Favicon
 * - SEO Settings
 * - Payment Settings
 * - Email Settings
 * - dll
 *
 * SEMUA settings disimpan di database, BUKAN di file PHP!
 */

defined('SITUNEO_ACCESS') or die('Direct access not permitted');

// Require admin access
Auth::requireAdmin();

$db = Database::getInstance();

// Handle settings update
if (is_post()) {
    $settings = post('settings', []);

    // Begin transaction
    $db->beginTransaction();

    try {
        foreach ($settings as $key => $value) {
            // Check if setting exists
            $existing = $db->query("SELECT id FROM settings WHERE setting_key = :key", [
                'key' => $key
            ])->fetch();

            if ($existing) {
                // Update existing setting
                $db->query("
                    UPDATE settings
                    SET setting_value = :value,
                        updated_at = :updated_at
                    WHERE setting_key = :key
                ", [
                    'value' => $value,
                    'updated_at' => date('Y-m-d H:i:s'),
                    'key' => $key
                ]);
            } else {
                // Insert new setting
                $db->insert('settings', [
                    'setting_key' => $key,
                    'setting_value' => $value,
                    'setting_type' => 'string',
                    'is_public' => 1,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
        }

        // Commit transaction
        $db->commit();

        // Log the update
        $db->insert('activity_logs', [
            'user_id' => Auth::id(),
            'action' => 'update_settings',
            'description' => 'Admin updated website settings',
            'ip_address' => $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0',
            'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        Session::flashSuccess('Settings berhasil diupdate!');
        Router::redirect('admin/settings');
    } catch (Exception $e) {
        // Rollback transaction
        $db->rollBack();
        Session::flashError('Error: ' . $e->getMessage());
    }
}

// Get all current settings
$settings_data = $db->query("SELECT * FROM settings ORDER BY setting_key")->fetchAll();

// Convert to key-value array for easy access
$settings = [];
foreach ($settings_data as $setting) {
    $settings[$setting['setting_key']] = $setting['setting_value'];
}

// Helper function to get setting value
function get_setting($key, $default = '') {
    global $settings;
    return $settings[$key] ?? $default;
}

$page_title = 'Settings Website - Admin Panel';

include ADMIN_PATH . 'includes/admin-header.php';
?>

<div class="settings-container">
    <div class="settings-header">
        <div>
            <h1><i class="bi bi-gear"></i> Settings Website</h1>
            <p class="text-muted">Kelola semua pengaturan website dari sini - FULL CONTROL</p>
        </div>
    </div>

    <form method="post" action="<?= url('admin/settings') ?>" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div class="row">
            <!-- Company Information -->
            <div class="col-lg-6">
                <div class="settings-card" data-aos="fade-up">
                    <div class="card-header">
                        <h3><i class="bi bi-building"></i> Company Information</h3>
                        <p class="text-muted">Informasi perusahaan Anda</p>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Nama Perusahaan <span class="text-danger">*</span></label>
                            <input type="text" name="settings[company_name]" class="form-control" value="<?= htmlspecialchars(get_setting('company_name', 'SITUNEO DIGITAL')) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Tagline</label>
                            <input type="text" name="settings[company_tagline]" class="form-control" value="<?= htmlspecialchars(get_setting('company_tagline', 'Website Era Baru')) ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">NIB (Nomor Induk Berusaha)</label>
                            <input type="text" name="settings[company_nib]" class="form-control" value="<?= htmlspecialchars(get_setting('company_nib', COMPANY_NIB)) ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alamat Lengkap</label>
                            <textarea name="settings[company_address]" class="form-control" rows="3"><?= htmlspecialchars(get_setting('company_address', COMPANY_ADDRESS)) ?></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kota</label>
                                <input type="text" name="settings[company_city]" class="form-control" value="<?= htmlspecialchars(get_setting('company_city', 'Semarang')) ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Provinsi</label>
                                <input type="text" name="settings[company_province]" class="form-control" value="<?= htmlspecialchars(get_setting('company_province', 'Jawa Tengah')) ?>">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kode Pos</label>
                            <input type="text" name="settings[company_postal_code]" class="form-control" value="<?= htmlspecialchars(get_setting('company_postal_code', '50149')) ?>">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Information -->
            <div class="col-lg-6">
                <div class="settings-card" data-aos="fade-up" data-aos-delay="50">
                    <div class="card-header">
                        <h3><i class="bi bi-telephone"></i> Contact Information</h3>
                        <p class="text-muted">Informasi kontak perusahaan</p>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="email" name="settings[company_email]" class="form-control" value="<?= htmlspecialchars(get_setting('company_email', COMPANY_EMAIL)) ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">WhatsApp <span class="text-danger">*</span></label>
                            <input type="tel" name="settings[company_whatsapp]" class="form-control" value="<?= htmlspecialchars(get_setting('company_whatsapp', COMPANY_WHATSAPP)) ?>" required>
                            <small class="text-muted">Format: 6281234567890</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Telepon</label>
                            <input type="tel" name="settings[company_phone]" class="form-control" value="<?= htmlspecialchars(get_setting('company_phone', COMPANY_WHATSAPP)) ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Website URL</label>
                            <input type="url" name="settings[company_website]" class="form-control" value="<?= htmlspecialchars(get_setting('company_website', BASE_URL)) ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Jam Operasional</label>
                            <input type="text" name="settings[company_hours]" class="form-control" value="<?= htmlspecialchars(get_setting('company_hours', 'Senin - Sabtu: 09:00 - 21:00')) ?>">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Social Media -->
            <div class="col-lg-6">
                <div class="settings-card" data-aos="fade-up">
                    <div class="card-header">
                        <h3><i class="bi bi-share"></i> Social Media</h3>
                        <p class="text-muted">Link media sosial perusahaan</p>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-facebook"></i> Facebook</label>
                            <input type="url" name="settings[social_facebook]" class="form-control" value="<?= htmlspecialchars(get_setting('social_facebook', '')) ?>" placeholder="https://facebook.com/situneo">
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-instagram"></i> Instagram</label>
                            <input type="url" name="settings[social_instagram]" class="form-control" value="<?= htmlspecialchars(get_setting('social_instagram', '')) ?>" placeholder="https://instagram.com/situneo">
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-twitter"></i> Twitter / X</label>
                            <input type="url" name="settings[social_twitter]" class="form-control" value="<?= htmlspecialchars(get_setting('social_twitter', '')) ?>" placeholder="https://twitter.com/situneo">
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-linkedin"></i> LinkedIn</label>
                            <input type="url" name="settings[social_linkedin]" class="form-control" value="<?= htmlspecialchars(get_setting('social_linkedin', '')) ?>" placeholder="https://linkedin.com/company/situneo">
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-youtube"></i> YouTube</label>
                            <input type="url" name="settings[social_youtube]" class="form-control" value="<?= htmlspecialchars(get_setting('social_youtube', '')) ?>" placeholder="https://youtube.com/@situneo">
                        </div>

                        <div class="mb-3">
                            <label class="form-label"><i class="bi bi-tiktok"></i> TikTok</label>
                            <input type="url" name="settings[social_tiktok]" class="form-control" value="<?= htmlspecialchars(get_setting('social_tiktok', '')) ?>" placeholder="https://tiktok.com/@situneo">
                        </div>
                    </div>
                </div>
            </div>

            <!-- SEO Settings -->
            <div class="col-lg-6">
                <div class="settings-card" data-aos="fade-up" data-aos-delay="50">
                    <div class="card-header">
                        <h3><i class="bi bi-search"></i> SEO Settings</h3>
                        <p class="text-muted">Pengaturan SEO untuk website</p>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Site Title</label>
                            <input type="text" name="settings[seo_title]" class="form-control" value="<?= htmlspecialchars(get_setting('seo_title', 'SITUNEO DIGITAL - Digital Agency Terlengkap')) ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Meta Description</label>
                            <textarea name="settings[seo_description]" class="form-control" rows="3"><?= htmlspecialchars(get_setting('seo_description', '232+ layanan digital dengan dual pricing (beli putus & sewa bulanan). 50+ demo production-ready. Konsultasi GRATIS!')) ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Meta Keywords</label>
                            <input type="text" name="settings[seo_keywords]" class="form-control" value="<?= htmlspecialchars(get_setting('seo_keywords', 'digital agency, web development, jasa website, sewa website, beli website')) ?>">
                            <small class="text-muted">Pisahkan dengan koma</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Google Analytics ID</label>
                            <input type="text" name="settings[google_analytics_id]" class="form-control" value="<?= htmlspecialchars(get_setting('google_analytics_id', '')) ?>" placeholder="G-XXXXXXXXXX">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Facebook Pixel ID</label>
                            <input type="text" name="settings[facebook_pixel_id]" class="form-control" value="<?= htmlspecialchars(get_setting('facebook_pixel_id', '')) ?>">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Settings -->
            <div class="col-lg-6">
                <div class="settings-card" data-aos="fade-up">
                    <div class="card-header">
                        <h3><i class="bi bi-credit-card"></i> Payment Settings</h3>
                        <p class="text-muted">Pengaturan payment gateway</p>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Payment Gateway</label>
                            <select name="settings[payment_gateway]" class="form-select">
                                <option value="midtrans" <?= get_setting('payment_gateway') === 'midtrans' ? 'selected' : '' ?>>Midtrans</option>
                                <option value="xendit" <?= get_setting('payment_gateway') === 'xendit' ? 'selected' : '' ?>>Xendit</option>
                                <option value="manual" <?= get_setting('payment_gateway') === 'manual' ? 'selected' : '' ?>>Manual Transfer</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Midtrans Server Key</label>
                            <input type="text" name="settings[midtrans_server_key]" class="form-control" value="<?= htmlspecialchars(get_setting('midtrans_server_key', '')) ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Midtrans Client Key</label>
                            <input type="text" name="settings[midtrans_client_key]" class="form-control" value="<?= htmlspecialchars(get_setting('midtrans_client_key', '')) ?>">
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" name="settings[midtrans_sandbox]" class="form-check-input" value="1" <?= get_setting('midtrans_sandbox') == '1' ? 'checked' : '' ?>>
                                <label class="form-check-label">Sandbox Mode (Testing)</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Homepage Settings -->
            <div class="col-lg-6">
                <div class="settings-card" data-aos="fade-up" data-aos-delay="50">
                    <div class="card-header">
                        <h3><i class="bi bi-house"></i> Homepage Settings</h3>
                        <p class="text-muted">Pengaturan konten homepage</p>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label">Hero Title</label>
                            <input type="text" name="settings[hero_title]" class="form-control" value="<?= htmlspecialchars(get_setting('hero_title', '232+ Layanan Digital')) ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Hero Subtitle</label>
                            <textarea name="settings[hero_subtitle]" class="form-control" rows="2"><?= htmlspecialchars(get_setting('hero_subtitle', 'Dual Pricing System " Beli Putus & Sewa Bulanan')) ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Hero CTA Text</label>
                            <input type="text" name="settings[hero_cta_text]" class="form-control" value="<?= htmlspecialchars(get_setting('hero_cta_text', 'Request Free Demo')) ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Total Services</label>
                            <input type="number" name="settings[total_services_display]" class="form-control" value="<?= htmlspecialchars(get_setting('total_services_display', '232')) ?>">
                            <small class="text-muted">Angka yang ditampilkan di homepage</small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Total Demos</label>
                            <input type="number" name="settings[total_demos_display]" class="form-control" value="<?= htmlspecialchars(get_setting('total_demos_display', '50')) ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="settings-footer" data-aos="fade-up">
            <div class="d-flex justify-content-between align-items-center">
                <p class="text-muted mb-0"><i class="bi bi-info-circle"></i> Semua perubahan akan tersimpan di database</p>
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="bi bi-check-circle"></i> Simpan Semua Settings
                </button>
            </div>
        </div>
    </form>
</div>

<?php include ADMIN_PATH . 'includes/admin-footer.php'; ?>

<style>
.settings-container {
    padding: 2rem;
    max-width: 1400px;
    margin: 0 auto;
}

.settings-header {
    margin-bottom: 2rem;
}

.settings-header h1 {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.25rem;
}

.settings-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow);
    margin-bottom: 1.5rem;
    overflow: hidden;
}

.settings-card .card-header {
    background: var(--gradient-primary);
    color: var(--white);
    padding: 1.5rem;
}

.settings-card .card-header h3 {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 0.25rem;
}

.settings-card .card-header p {
    margin: 0;
    opacity: 0.9;
    font-size: 0.875rem;
}

.settings-card .card-body {
    padding: 1.5rem;
}

.settings-footer {
    background: var(--white);
    border-radius: var(--radius-lg);
    padding: 1.5rem;
    box-shadow: var(--shadow);
    position: sticky;
    bottom: 1rem;
}
</style>
