<?php
/**
 * Demo Request Wizard Page
 *
 * SMART WIZARD untuk request custom demo:
 * - Multi-step wizard (Category ’ Industry ’ Style ’ Features)
 * - Auto-suggest similar demos
 * - 24 jam guarantee
 * - GRATIS tanpa komitmen
 *
 * Part of HYBRID SYSTEM (OPSI C):
 * - 50 production demos showcase
 * - 1500+ browsable combinations
 * - Smart wizard custom request  INI!
 */

defined('SITUNEO_ACCESS') or die('Direct access not permitted');

try {
    $db = Database::getInstance();

    // Get wizard options from database
    $categories = $db->query("
        SELECT DISTINCT category FROM portfolios
        WHERE is_active = 1 AND category IS NOT NULL
        ORDER BY category
    ")->fetchAll();

    $industries = $db->query("
        SELECT DISTINCT industry FROM portfolios
        WHERE is_active = 1 AND industry IS NOT NULL
        ORDER BY industry
    ")->fetchAll();

    $styles = ['modern', 'minimalist', 'corporate', 'creative', 'elegant', 'colorful', 'dark'];

} catch (Exception $e) {
    $categories = [];
    $industries = [];
    $styles = [];
    error_log('Demo wizard error: ' . $e->getMessage());
}

$page_title = 'Request FREE Demo 24 Jam - SITUNEO DIGITAL';
$page_description = 'Request demo website GRATIS! Pilih category, industry, style yang Anda mau. Kami kirim demo dalam 24 jam. Tanpa komitmen!';

include INCLUDES_PATH . 'header/public-header.php';
?>

<!-- Hero -->
<section class="demo-hero">
    <div class="container text-center">
        <h1 class="hero-title" data-aos="fade-up">
            <i class="bi bi-gift"></i><br>
            <span class="text-gradient">Request FREE Demo</span><br>
            Kirim dalam 24 Jam!
        </h1>
        <p class="hero-subtitle" data-aos="fade-up" data-aos-delay="100">
            Mau lihat demo website sesuai bisnis Anda? <strong>100% GRATIS</strong> tanpa komitmen!<br>
            Pilih category, industry, style ’ Kami buatkan demo dalam 24 jam!
        </p>

        <!-- Guarantee Badges -->
        <div class="guarantee-badges" data-aos="fade-up" data-aos-delay="200">
            <div class="badge-item">
                <i class="bi bi-gift-fill"></i>
                <strong>100% GRATIS</strong>
            </div>
            <div class="badge-item">
                <i class="bi bi-clock-fill"></i>
                <strong>Kirim 24 Jam</strong>
            </div>
            <div class="badge-item">
                <i class="bi bi-shield-check"></i>
                <strong>Tanpa Komitmen</strong>
            </div>
            <div class="badge-item">
                <i class="bi bi-stars"></i>
                <strong>Production-Ready</strong>
            </div>
        </div>
    </div>
</section>

<!-- Wizard -->
<section class="wizard-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="wizard-container" data-aos="fade-up">
                    <!-- Progress Steps -->
                    <div class="wizard-steps">
                        <div class="step active" data-step="1">
                            <div class="step-number">1</div>
                            <div class="step-label">Category</div>
                        </div>
                        <div class="step-line"></div>
                        <div class="step" data-step="2">
                            <div class="step-number">2</div>
                            <div class="step-label">Industry</div>
                        </div>
                        <div class="step-line"></div>
                        <div class="step" data-step="3">
                            <div class="step-number">3</div>
                            <div class="step-label">Style</div>
                        </div>
                        <div class="step-line"></div>
                        <div class="step" data-step="4">
                            <div class="step-number">4</div>
                            <div class="step-label">Features</div>
                        </div>
                        <div class="step-line"></div>
                        <div class="step" data-step="5">
                            <div class="step-number">5</div>
                            <div class="step-label">Kontak</div>
                        </div>
                    </div>

                    <!-- Wizard Content -->
                    <form id="demoWizardForm" method="post" action="<?= url('api/demo-request') ?>">
                        <?= csrf_field() ?>

                        <!-- Step 1: Category -->
                        <div class="wizard-content active" data-content="1">
                            <h3><i class="bi bi-grid"></i> Pilih Category Website</h3>
                            <p class="text-muted">Jenis website apa yang Anda butuhkan?</p>

                            <div class="option-grid">
                                <label class="option-card">
                                    <input type="radio" name="category" value="landing-page" required>
                                    <div class="option-content">
                                        <i class="bi bi-file-earmark"></i>
                                        <strong>Landing Page</strong>
                                        <small>1 halaman untuk promo/event</small>
                                    </div>
                                </label>

                                <label class="option-card">
                                    <input type="radio" name="category" value="company-profile">
                                    <div class="option-content">
                                        <i class="bi bi-building"></i>
                                        <strong>Company Profile</strong>
                                        <small>Website perusahaan lengkap</small>
                                    </div>
                                </label>

                                <label class="option-card">
                                    <input type="radio" name="category" value="e-commerce">
                                    <div class="option-content">
                                        <i class="bi bi-cart"></i>
                                        <strong>E-Commerce</strong>
                                        <small>Toko online jualan produk</small>
                                    </div>
                                </label>

                                <label class="option-card">
                                    <input type="radio" name="category" value="portfolio">
                                    <div class="option-content">
                                        <i class="bi bi-images"></i>
                                        <strong>Portfolio</strong>
                                        <small>Showcase karya/project</small>
                                    </div>
                                </label>

                                <label class="option-card">
                                    <input type="radio" name="category" value="blog">
                                    <div class="option-content">
                                        <i class="bi bi-newspaper"></i>
                                        <strong>Blog/News</strong>
                                        <small>Website artikel/berita</small>
                                    </div>
                                </label>

                                <label class="option-card">
                                    <input type="radio" name="category" value="education">
                                    <div class="option-content">
                                        <i class="bi bi-book"></i>
                                        <strong>Education/LMS</strong>
                                        <small>Platform belajar online</small>
                                    </div>
                                </label>

                                <label class="option-card">
                                    <input type="radio" name="category" value="booking">
                                    <div class="option-content">
                                        <i class="bi bi-calendar-check"></i>
                                        <strong>Booking/Reservation</strong>
                                        <small>Sistem reservasi online</small>
                                    </div>
                                </label>

                                <label class="option-card">
                                    <input type="radio" name="category" value="custom">
                                    <div class="option-content">
                                        <i class="bi bi-lightning"></i>
                                        <strong>Custom/Other</strong>
                                        <small>Kebutuhan khusus lainnya</small>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Step 2: Industry -->
                        <div class="wizard-content" data-content="2">
                            <h3><i class="bi bi-briefcase"></i> Pilih Industry/Bisnis Anda</h3>
                            <p class="text-muted">Bidang bisnis atau industri Anda?</p>

                            <div class="option-grid">
                                <label class="option-card">
                                    <input type="radio" name="industry" value="retail" required>
                                    <div class="option-content">
                                        <i class="bi bi-shop"></i>
                                        <strong>Retail/Toko</strong>
                                    </div>
                                </label>

                                <label class="option-card">
                                    <input type="radio" name="industry" value="food-beverage">
                                    <div class="option-content">
                                        <i class="bi bi-cup-hot"></i>
                                        <strong>Food & Beverage</strong>
                                    </div>
                                </label>

                                <label class="option-card">
                                    <input type="radio" name="industry" value="fashion">
                                    <div class="option-content">
                                        <i class="bi bi-bag"></i>
                                        <strong>Fashion/Clothing</strong>
                                    </div>
                                </label>

                                <label class="option-card">
                                    <input type="radio" name="industry" value="health">
                                    <div class="option-content">
                                        <i class="bi bi-heart-pulse"></i>
                                        <strong>Health/Medical</strong>
                                    </div>
                                </label>

                                <label class="option-card">
                                    <input type="radio" name="industry" value="education">
                                    <div class="option-content">
                                        <i class="bi bi-mortarboard"></i>
                                        <strong>Education</strong>
                                    </div>
                                </label>

                                <label class="option-card">
                                    <input type="radio" name="industry" value="technology">
                                    <div class="option-content">
                                        <i class="bi bi-laptop"></i>
                                        <strong>Technology/IT</strong>
                                    </div>
                                </label>

                                <label class="option-card">
                                    <input type="radio" name="industry" value="real-estate">
                                    <div class="option-content">
                                        <i class="bi bi-house"></i>
                                        <strong>Real Estate</strong>
                                    </div>
                                </label>

                                <label class="option-card">
                                    <input type="radio" name="industry" value="other">
                                    <div class="option-content">
                                        <i class="bi bi-three-dots"></i>
                                        <strong>Lainnya</strong>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Step 3: Style -->
                        <div class="wizard-content" data-content="3">
                            <h3><i class="bi bi-palette"></i> Pilih Style/Tema</h3>
                            <p class="text-muted">Gaya desain yang Anda suka?</p>

                            <div class="option-grid">
                                <?php
                                $style_icons = [
                                    'modern' => 'bi-stars',
                                    'minimalist' => 'bi-dash-circle',
                                    'corporate' => 'bi-building',
                                    'creative' => 'bi-brush',
                                    'elegant' => 'bi-gem',
                                    'colorful' => 'bi-rainbow',
                                    'dark' => 'bi-moon'
                                ];
                                foreach ($styles as $style):
                                ?>
                                <label class="option-card">
                                    <input type="radio" name="style" value="<?= $style ?>" required>
                                    <div class="option-content">
                                        <i class="bi <?= $style_icons[$style] ?? 'bi-palette' ?>"></i>
                                        <strong><?= ucfirst($style) ?></strong>
                                    </div>
                                </label>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- Step 4: Features -->
                        <div class="wizard-content" data-content="4">
                            <h3><i class="bi bi-check2-square"></i> Fitur yang Dibutuhkan</h3>
                            <p class="text-muted">Pilih fitur-fitur yang Anda inginkan (boleh lebih dari 1)</p>

                            <div class="features-grid">
                                <label class="feature-checkbox">
                                    <input type="checkbox" name="features[]" value="contact-form">
                                    <div class="checkbox-content">
                                        <i class="bi bi-envelope"></i>
                                        <span>Contact Form</span>
                                    </div>
                                </label>

                                <label class="feature-checkbox">
                                    <input type="checkbox" name="features[]" value="whatsapp-integration">
                                    <div class="checkbox-content">
                                        <i class="bi bi-whatsapp"></i>
                                        <span>WhatsApp Integration</span>
                                    </div>
                                </label>

                                <label class="feature-checkbox">
                                    <input type="checkbox" name="features[]" value="cms">
                                    <div class="checkbox-content">
                                        <i class="bi bi-gear"></i>
                                        <span>CMS (Edit Konten)</span>
                                    </div>
                                </label>

                                <label class="feature-checkbox">
                                    <input type="checkbox" name="features[]" value="blog">
                                    <div class="checkbox-content">
                                        <i class="bi bi-newspaper"></i>
                                        <span>Blog/News</span>
                                    </div>
                                </label>

                                <label class="feature-checkbox">
                                    <input type="checkbox" name="features[]" value="gallery">
                                    <div class="checkbox-content">
                                        <i class="bi bi-images"></i>
                                        <span>Photo Gallery</span>
                                    </div>
                                </label>

                                <label class="feature-checkbox">
                                    <input type="checkbox" name="features[]" value="testimonials">
                                    <div class="checkbox-content">
                                        <i class="bi bi-chat-quote"></i>
                                        <span>Testimonials</span>
                                    </div>
                                </label>

                                <label class="feature-checkbox">
                                    <input type="checkbox" name="features[]" value="live-chat">
                                    <div class="checkbox-content">
                                        <i class="bi bi-chat-dots"></i>
                                        <span>Live Chat</span>
                                    </div>
                                </label>

                                <label class="feature-checkbox">
                                    <input type="checkbox" name="features[]" value="booking-system">
                                    <div class="checkbox-content">
                                        <i class="bi bi-calendar-check"></i>
                                        <span>Booking System</span>
                                    </div>
                                </label>

                                <label class="feature-checkbox">
                                    <input type="checkbox" name="features[]" value="payment-gateway">
                                    <div class="checkbox-content">
                                        <i class="bi bi-credit-card"></i>
                                        <span>Payment Gateway</span>
                                    </div>
                                </label>

                                <label class="feature-checkbox">
                                    <input type="checkbox" name="features[]" value="multi-language">
                                    <div class="checkbox-content">
                                        <i class="bi bi-translate"></i>
                                        <span>Multi-Language</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Step 5: Contact -->
                        <div class="wizard-content" data-content="5">
                            <h3><i class="bi bi-person"></i> Informasi Kontak</h3>
                            <p class="text-muted">Kami akan kirim demo ke email/WhatsApp Anda dalam 24 jam!</p>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nama Lengkap *</label>
                                    <input type="text" name="name" class="form-control" required placeholder="Nama Anda">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Email *</label>
                                    <input type="email" name="email" class="form-control" required placeholder="email@example.com">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">WhatsApp *</label>
                                    <input type="tel" name="phone" class="form-control" required placeholder="08123456789">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Nama Bisnis/Perusahaan</label>
                                    <input type="text" name="company" class="form-control" placeholder="PT Example">
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Catatan Tambahan (Optional)</label>
                                    <textarea name="notes" class="form-control" rows="4" placeholder="Ada request khusus? Tulis di sini..."></textarea>
                                </div>
                            </div>

                            <!-- Summary -->
                            <div class="request-summary mt-4">
                                <h4>=Ë Summary Request Anda:</h4>
                                <div class="summary-content">
                                    <p><strong>Category:</strong> <span id="summary-category">-</span></p>
                                    <p><strong>Industry:</strong> <span id="summary-industry">-</span></p>
                                    <p><strong>Style:</strong> <span id="summary-style">-</span></p>
                                    <p><strong>Features:</strong> <span id="summary-features">-</span></p>
                                </div>
                            </div>
                        </div>

                        <!-- Navigation -->
                        <div class="wizard-navigation">
                            <button type="button" class="btn btn-secondary" id="prevBtn" style="display: none;">
                                <i class="bi bi-chevron-left"></i> Previous
                            </button>
                            <button type="button" class="btn btn-primary" id="nextBtn">
                                Next <i class="bi bi-chevron-right"></i>
                            </button>
                            <button type="submit" class="btn btn-success btn-lg" id="submitBtn" style="display: none;">
                                <i class="bi bi-send"></i> Request Demo GRATIS!
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Similar Demos -->
<section class="similar-demos-section">
    <div class="container">
        <h2 class="section-title text-center mb-5">
            Atau Lihat Demo yang Sudah Ada
        </h2>
        <div class="text-center">
            <a href="<?= url('portfolio') ?>" class="btn btn-primary btn-lg">
                <i class="bi bi-grid"></i> Browse 50+ Demo
            </a>
        </div>
    </div>
</section>

<?php include INCLUDES_PATH . 'footer/public-footer.php'; ?>

<style>
.demo-hero {
    background: linear-gradient(135deg, var(--dark) 0%, var(--dark-light) 100%);
    color: var(--white);
    padding: 100px 0 60px;
}

.guarantee-badges {
    display: flex;
    justify-content: center;
    gap: 2rem;
    margin-top: 2rem;
    flex-wrap: wrap;
}

.guarantee-badges .badge-item {
    background: rgba(255, 255, 255, 0.1);
    padding: 1rem 2rem;
    border-radius: var(--radius-lg);
    backdrop-filter: blur(10px);
}

.guarantee-badges .badge-item i {
    display: block;
    font-size: 2rem;
    margin-bottom: 0.5rem;
}

.wizard-section {
    padding: 4rem 0;
}

.wizard-container {
    background: var(--white);
    border-radius: var(--radius-xl);
    padding: 3rem;
    box-shadow: var(--shadow-xl);
}

.wizard-steps {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 3rem;
}

.step {
    text-align: center;
    flex: 0 0 auto;
}

.step-number {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: var(--gray-200);
    color: var(--gray-600);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.25rem;
    margin: 0 auto 0.5rem;
    transition: var(--transition);
}

.step.active .step-number {
    background: var(--gradient-primary);
    color: var(--white);
}

.step.completed .step-number {
    background: var(--success-color);
    color: var(--white);
}

.step-label {
    font-size: 0.875rem;
    color: var(--gray-600);
}

.step-line {
    flex: 1;
    height: 2px;
    background: var(--gray-200);
    margin: 0 1rem;
}

.wizard-content {
    display: none;
    min-height: 400px;
}

.wizard-content.active {
    display: block;
}

.option-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: 1rem;
    margin: 2rem 0;
}

.option-card {
    position: relative;
    cursor: pointer;
}

.option-card input[type="radio"] {
    position: absolute;
    opacity: 0;
}

.option-content {
    background: var(--gray-50);
    border: 2px solid var(--gray-200);
    border-radius: var(--radius-lg);
    padding: 2rem 1rem;
    text-align: center;
    transition: var(--transition);
}

.option-content i {
    font-size: 2.5rem;
    color: var(--gray-400);
    display: block;
    margin-bottom: 1rem;
}

.option-card input:checked + .option-content {
    background: var(--primary-color);
    border-color: var(--primary-color);
    color: var(--white);
}

.option-card input:checked + .option-content i {
    color: var(--white);
}

.option-card input:checked + .option-content strong,
.option-card input:checked + .option-content small {
    color: var(--white);
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 1rem;
    margin: 2rem 0;
}

.feature-checkbox {
    cursor: pointer;
}

.feature-checkbox input[type="checkbox"] {
    position: absolute;
    opacity: 0;
}

.checkbox-content {
    background: var(--gray-50);
    border: 2px solid var(--gray-200);
    border-radius: var(--radius);
    padding: 1rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    transition: var(--transition);
}

.checkbox-content i {
    font-size: 1.5rem;
    color: var(--gray-400);
}

.feature-checkbox input:checked + .checkbox-content {
    background: rgba(59, 130, 246, 0.1);
    border-color: var(--primary-color);
}

.feature-checkbox input:checked + .checkbox-content i {
    color: var(--primary-color);
}

.request-summary {
    background: var(--gray-50);
    border-radius: var(--radius-lg);
    padding: 1.5rem;
}

.request-summary h4 {
    margin-bottom: 1rem;
}

.summary-content p {
    margin-bottom: 0.5rem;
}

.wizard-navigation {
    display: flex;
    justify-content: space-between;
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 2px solid var(--gray-200);
}

.similar-demos-section {
    padding: 4rem 0;
    background: var(--gray-50);
}
</style>

<script>
// Wizard Logic
let currentStep = 1;
const totalSteps = 5;

function showStep(step) {
    // Hide all contents
    document.querySelectorAll('.wizard-content').forEach(content => {
        content.classList.remove('active');
    });

    // Show current content
    document.querySelector(`.wizard-content[data-content="${step}"]`).classList.add('active');

    // Update steps
    document.querySelectorAll('.step').forEach(stepEl => {
        const stepNum = parseInt(stepEl.dataset.step);
        stepEl.classList.remove('active', 'completed');
        if (stepNum === step) {
            stepEl.classList.add('active');
        } else if (stepNum < step) {
            stepEl.classList.add('completed');
        }
    });

    // Update buttons
    document.getElementById('prevBtn').style.display = step === 1 ? 'none' : 'inline-block';
    document.getElementById('nextBtn').style.display = step === totalSteps ? 'none' : 'inline-block';
    document.getElementById('submitBtn').style.display = step === totalSteps ? 'inline-block' : 'none';

    // Update summary
    if (step === totalSteps) {
        updateSummary();
    }
}

function nextStep() {
    const currentContent = document.querySelector(`.wizard-content[data-content="${currentStep}"]`);
    const required = currentContent.querySelectorAll('[required]');
    let valid = true;

    required.forEach(input => {
        if (input.type === 'radio') {
            const name = input.name;
            if (!document.querySelector(`input[name="${name}"]:checked`)) {
                valid = false;
            }
        } else if (!input.value) {
            valid = false;
        }
    });

    if (!valid) {
        alert('Mohon lengkapi pilihan Anda!');
        return;
    }

    if (currentStep < totalSteps) {
        currentStep++;
        showStep(currentStep);
    }
}

function prevStep() {
    if (currentStep > 1) {
        currentStep--;
        showStep(currentStep);
    }
}

function updateSummary() {
    const category = document.querySelector('input[name="category"]:checked');
    const industry = document.querySelector('input[name="industry"]:checked');
    const style = document.querySelector('input[name="style"]:checked');
    const features = Array.from(document.querySelectorAll('input[name="features[]"]:checked'));

    document.getElementById('summary-category').textContent = category ? category.value : '-';
    document.getElementById('summary-industry').textContent = industry ? industry.value : '-';
    document.getElementById('summary-style').textContent = style ? style.value : '-';
    document.getElementById('summary-features').textContent = features.length > 0
        ? features.map(f => f.value).join(', ')
        : '-';
}

document.getElementById('nextBtn').addEventListener('click', nextStep);
document.getElementById('prevBtn').addEventListener('click', prevStep);

// Form submit
document.getElementById('demoWizardForm').addEventListener('submit', async function(e) {
    e.preventDefault();

    const formData = new FormData(this);
    const submitBtn = document.getElementById('submitBtn');
    const originalText = submitBtn.innerHTML;

    submitBtn.disabled = true;
    submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Sending...';

    try {
        // Simulate API call (replace with actual endpoint)
        await new Promise(resolve => setTimeout(resolve, 2000));

        alert(' Request berhasil! Kami akan kirim demo ke email/WhatsApp Anda dalam 24 jam. Terima kasih!');
        window.location.href = '<?= url('/') ?>';
    } catch (error) {
        alert('L Terjadi kesalahan. Silakan coba lagi atau hubungi kami via WhatsApp.');
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
    }
});

// Initialize
showStep(currentStep);
</script>
