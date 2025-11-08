<?php
$page_id = 'demo-request';
$pageTitle = 'Request Demo Website - FREE 24 Jam!';
$pageDescription = 'Request demo website gratis dalam 24 jam. Lihat hasil sebelum bayar!';
$pageHeading = 'Request Demo Website GRATIS';

include __DIR__ . '/../includes/client-header.php';

$current_user = getCurrentUser();

// Handle form submission
$success = false;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['demo_request_form'])) {
    if (!verifyCsrfToken($_POST['csrf_token'])) {
        $error = 'Invalid security token';
    } else {
        // In real app, save to database
        if (!DEMO_MODE) {
            // Save demo request to database
            $request_id = 'DEMO-' . date('Y') . '-' . str_pad(rand(1,999), 3, '0', STR_PAD_LEFT);

            $data = [
                'request_id' => $request_id,
                'user_id' => $current_user['user_id'],
                // ... all 26 fields
                'created_at' => date('Y-m-d H:i:s')
            ];

            // db_insert('demo_requests', $data);
        }

        setFlash('success', 'Demo request berhasil dikirim! Tim kami akan menghubungi Anda dalam 1x24 jam.');
        header('Location: /client/dashboard');
        exit;
    }
}

?>

<div class="row justify-content-center">
    <div class="col-lg-10">
        <!-- Header Info -->
        <div class="card-premium mb-4 text-center">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h3 class="text-gold mb-3">
                        <i class="bi bi-gift me-2"></i>
                        FREE Demo Website dalam 24 Jam!
                    </h3>
                    <p class="text-light mb-3">
                        Isi form di bawah dengan detail bisnis Anda. Tim kami akan buatkan demo website
                        <strong class="text-gold">GRATIS</strong> dalam <strong class="text-gold">24 jam</strong>.
                        Lihat hasilnya dulu, puas baru bayar!
                    </p>
                    <div class="d-flex gap-3 justify-content-center flex-wrap">
                        <div class="badge badge-gold">
                            <i class="bi bi-check-circle me-1"></i>
                            100% Gratis
                        </div>
                        <div class="badge badge-gold">
                            <i class="bi bi-clock me-1"></i>
                            Response 24 Jam
                        </div>
                        <div class="badge badge-gold">
                            <i class="bi bi-shield-check me-1"></i>
                            Tanpa Komitmen
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=300" alt="Demo" class="img-fluid rounded">
                </div>
            </div>
        </div>

        <?php if ($error): ?>
        <div class="alert alert-danger">
            <i class="bi bi-exclamation-triangle me-2"></i>
            <?= $error ?>
        </div>
        <?php endif; ?>

        <!-- Demo Request Form - 26 Fields -->
        <form method="POST" action="/client/demo-request" id="demoRequestForm">
            <input type="hidden" name="demo_request_form" value="1">
            <input type="hidden" name="csrf_token" value="<?= generateCsrfToken() ?>">

            <!-- Section 1: Contact Information -->
            <div class="card-premium mb-4">
                <h5 class="text-gold mb-4">
                    <i class="bi bi-person-circle me-2"></i>
                    1. Informasi Kontak
                </h5>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label text-light">Nama Lengkap *</label>
                        <input type="text" name="full_name" class="form-control"
                               value="<?= htmlspecialchars($current_user['full_name']) ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-light">Email *</label>
                        <input type="email" name="email" class="form-control"
                               value="<?= htmlspecialchars($current_user['email']) ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-light">No. WhatsApp *</label>
                        <input type="tel" name="phone" class="form-control"
                               value="<?= htmlspecialchars($current_user['phone'] ?? '') ?>"
                               placeholder="08123456789" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-light">Preferred Contact Method</label>
                        <select name="contact_method" class="form-control">
                            <option value="whatsapp">WhatsApp</option>
                            <option value="email">Email</option>
                            <option value="phone">Phone Call</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Section 2: Business Information -->
            <div class="card-premium mb-4">
                <h5 class="text-gold mb-4">
                    <i class="bi bi-building me-2"></i>
                    2. Informasi Bisnis
                </h5>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label text-light">Nama Bisnis/Usaha *</label>
                        <input type="text" name="business_name" class="form-control"
                               placeholder="Contoh: Kopi Kenangan" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-light">Jenis Bisnis *</label>
                        <select name="business_type" class="form-control" required>
                            <option value="">Pilih jenis bisnis...</option>
                            <option value="Cafe & Restaurant">Cafe & Restaurant</option>
                            <option value="Toko Online / E-Commerce">Toko Online / E-Commerce</option>
                            <option value="Company Profile">Company Profile</option>
                            <option value="Healthcare / Klinik">Healthcare / Klinik</option>
                            <option value="Pendidikan / Kursus">Pendidikan / Kursus</option>
                            <option value="Real Estate">Real Estate</option>
                            <option value="Jasa / Service">Jasa / Service</option>
                            <option value="Hotel & Travel">Hotel & Travel</option>
                            <option value="Automotive">Automotive</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label text-light">Deskripsi Bisnis *</label>
                        <textarea name="business_description" class="form-control" rows="3"
                                  placeholder="Jelaskan bisnis Anda secara singkat..." required></textarea>
                        <small class="text-muted">Contoh: Kopi shop modern dengan konsep minimalist, target pasar anak muda 20-35 tahun</small>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-light">Website Bisnis Saat Ini (jika ada)</label>
                        <input type="url" name="current_website" class="form-control"
                               placeholder="https://example.com">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-light">Social Media Bisnis</label>
                        <input type="text" name="social_media" class="form-control"
                               placeholder="@instagram, facebook.com/page">
                    </div>
                </div>
            </div>

            <!-- Section 3: Website Requirements -->
            <div class="card-premium mb-4">
                <h5 class="text-gold mb-4">
                    <i class="bi bi-laptop me-2"></i>
                    3. Kebutuhan Website
                </h5>

                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label text-light">Tipe Website yang Diinginkan *</label>
                        <select name="website_type" class="form-control" required>
                            <option value="">Pilih tipe website...</option>
                            <option value="Landing Page">Landing Page (1 halaman)</option>
                            <option value="Company Profile">Company Profile (5-8 halaman)</option>
                            <option value="E-Commerce / Toko Online">E-Commerce / Toko Online</option>
                            <option value="Company Profile + E-Commerce">Company Profile + E-Commerce</option>
                            <option value="Blog / Portal Berita">Blog / Portal Berita</option>
                            <option value="Booking / Reservation System">Booking / Reservation System</option>
                            <option value="Marketplace">Marketplace (Multi Vendor)</option>
                            <option value="Custom">Custom (Jelaskan di Special Requirements)</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label text-light">Target Audience / Market *</label>
                        <input type="text" name="target_audience" class="form-control"
                               placeholder="Contoh: Anak muda 20-35 tahun, pekerja kantoran" required>
                    </div>

                    <div class="col-12">
                        <label class="form-label text-light">Fitur Utama yang Dibutuhkan *</label>
                        <textarea name="main_features" class="form-control" rows="3"
                                  placeholder="Contoh: Menu digital, Online ordering, Membership system, Gallery" required></textarea>
                        <small class="text-muted">Sebutkan fitur-fitur penting yang Anda butuhkan</small>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-light">Jumlah Halaman yang Dibutuhkan</label>
                        <select name="page_count" class="form-control">
                            <option value="1">1 halaman (Landing Page)</option>
                            <option value="3-5">3-5 halaman</option>
                            <option value="5-8">5-8 halaman</option>
                            <option value="8-10">8-10 halaman</option>
                            <option value="10+">10+ halaman</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-light">Bahasa Website</label>
                        <select name="language" class="form-control">
                            <option value="id">Indonesia</option>
                            <option value="en">English</option>
                            <option value="both">Indonesia + English</option>
                            <option value="other">Lainnya</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Section 4: Design Preferences -->
            <div class="card-premium mb-4">
                <h5 class="text-gold mb-4">
                    <i class="bi bi-palette me-2"></i>
                    4. Preferensi Design
                </h5>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label text-light">Warna Brand / Preferensi Warna</label>
                        <input type="text" name="color_preference" class="form-control"
                               placeholder="Contoh: Blue, White - Clean & Professional">
                        <small class="text-muted">Sebutkan warna dan kesan yang diinginkan</small>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-light">Style Design</label>
                        <select name="design_style" class="form-control">
                            <option value="modern">Modern & Minimalist</option>
                            <option value="classic">Classic & Elegant</option>
                            <option value="creative">Creative & Bold</option>
                            <option value="professional">Professional & Corporate</option>
                            <option value="playful">Playful & Colorful</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label text-light">Website Referensi (jika ada)</label>
                        <textarea name="reference_websites" class="form-control" rows="2"
                                  placeholder="Contoh: starbucks.com, tokopedia.com"></textarea>
                        <small class="text-muted">Website yang Anda suka designnya (opsional)</small>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-light">Apakah Logo Sudah Tersedia? *</label>
                        <select name="logo_available" class="form-control" required>
                            <option value="yes">Ya, sudah ada logo</option>
                            <option value="no">Belum, perlu dibuatkan</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-light">Apakah Konten Sudah Siap? *</label>
                        <select name="content_ready" class="form-control" required>
                            <option value="yes">Ya, konten sudah siap</option>
                            <option value="partial">Sebagian sudah ada</option>
                            <option value="no">Belum, perlu bantuan</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Section 5: Budget & Timeline -->
            <div class="card-premium mb-4">
                <h5 class="text-gold mb-4">
                    <i class="bi bi-cash-coin me-2"></i>
                    5. Budget & Timeline
                </h5>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label text-light">Budget Range *</label>
                        <select name="budget_range" class="form-control" required>
                            <option value="">Pilih range budget...</option>
                            <option value="< 1 juta">< Rp 1 juta</option>
                            <option value="1-2 juta">Rp 1-2 juta</option>
                            <option value="2-4 juta">Rp 2-4 juta (BUSINESS)</option>
                            <option value="4-6 juta">Rp 4-6 juta (PREMIUM)</option>
                            <option value="6-10 juta">Rp 6-10 juta</option>
                            <option value="> 10 juta">> Rp 10 juta (ENTERPRISE)</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-light">Kapan Deadline yang Diharapkan? *</label>
                        <select name="deadline_preference" class="form-control" required>
                            <option value="">Pilih deadline...</option>
                            <option value="1 minggu">1 minggu (Express)</option>
                            <option value="2 minggu">2 minggu</option>
                            <option value="3 minggu">3 minggu</option>
                            <option value="1 bulan">1 bulan</option>
                            <option value="Fleksibel">Fleksibel</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Section 6: Additional Requirements -->
            <div class="card-premium mb-4">
                <h5 class="text-gold mb-4">
                    <i class="bi bi-list-check me-2"></i>
                    6. Kebutuhan Tambahan
                </h5>

                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label text-light">Special Requirements / Notes</label>
                        <textarea name="special_requirements" class="form-control" rows="4"
                                  placeholder="Jelaskan kebutuhan khusus lainnya. Contoh: Butuh integrasi payment gateway, integrasi dengan sistem lain, fitur khusus, dll"></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-light">Apakah Butuh SEO?</label>
                        <select name="need_seo" class="form-control">
                            <option value="yes">Ya, butuh SEO optimization</option>
                            <option value="no">Tidak perlu</option>
                            <option value="unsure">Belum tahu</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-light">Apakah Butuh Maintenance?</label>
                        <select name="need_maintenance" class="form-control">
                            <option value="yes">Ya, butuh maintenance rutin</option>
                            <option value="no">Tidak perlu</option>
                            <option value="unsure">Belum tahu</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label class="form-label text-light">Bagaimana Anda Mengetahui SITUNEO DIGITAL?</label>
                        <select name="source" class="form-control">
                            <option value="">Pilih...</option>
                            <option value="Google Search">Google Search</option>
                            <option value="Social Media">Social Media</option>
                            <option value="Referral">Referral dari teman</option>
                            <option value="Advertisement">Iklan</option>
                            <option value="Other">Lainnya</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Terms & Submit -->
            <div class="card-premium">
                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" id="agree_terms" required>
                    <label class="form-check-label text-light" for="agree_terms">
                        Saya setuju dengan <a href="/terms" target="_blank" class="text-gold">Syarat & Ketentuan</a>
                        dan <a href="/privacy" target="_blank" class="text-gold">Kebijakan Privasi</a> SITUNEO DIGITAL *
                    </label>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-gold btn-lg">
                        <i class="bi bi-rocket-takeoff me-2"></i>
                        Submit Demo Request - FREE!
                    </button>
                    <a href="/client/dashboard" class="btn btn-outline-gold">
                        <i class="bi bi-arrow-left me-2"></i>
                        Kembali ke Dashboard
                    </a>
                </div>

                <div class="alert alert-info mt-3 mb-0">
                    <i class="bi bi-info-circle me-2"></i>
                    <strong>Catatan:</strong> Tim kami akan review request Anda dan menghubungi via WhatsApp/Email dalam <strong>1x24 jam</strong>.
                    Demo website akan dikirimkan dalam <strong>24 jam</strong> setelah konfirmasi detail.
                </div>
            </div>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
