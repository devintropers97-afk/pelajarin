<?php
// Set page title
$pageTitle = 'Kalkulator Harga Website & Digital Marketing | SITUNEO DIGITAL';
$pageDescription = 'Hitung sendiri harga website dan digital marketing Anda. Pilih layanan, dapatkan harga instant + diskon otomatis! Transparan, tanpa biaya tersembunyi.';

// Include header
include __DIR__ . '/../includes/header.php';

// Multi-language text
$text = [
    'id' => [
        'hero_title' => 'Hitung Harga Custom Anda',
        'hero_subtitle' => 'Pilih Layanan, Dapatkan Harga Instant + Diskon Otomatis!',
        'section_services' => 'Pilih Layanan yang Anda Butuhkan',
        'section_cart' => 'Ringkasan Pesanan',
        'search_placeholder' => 'Cari layanan...',
        'cart_empty' => 'Keranjang masih kosong',
        'cart_empty_desc' => 'Pilih layanan di sebelah kiri untuk menghitung harga',
        'subtotal' => 'Subtotal',
        'discount' => 'Diskon',
        'total' => 'Total Harga',
        'btn_clear' => 'Kosongkan',
        'btn_order' => 'Lanjut Pesan',
        'discount_info_3' => 'Pilih 3+ layanan dapat diskon 10%',
        'discount_info_5' => 'Pilih 5+ layanan dapat diskon 15%',
        'discount_active' => 'Selamat! Anda dapat diskon',
    ],
    'en' => [
        'hero_title' => 'Calculate Your Custom Price',
        'hero_subtitle' => 'Choose Services, Get Instant Price + Auto Discount!',
        'section_services' => 'Select Services You Need',
        'section_cart' => 'Order Summary',
        'search_placeholder' => 'Search services...',
        'cart_empty' => 'Cart is empty',
        'cart_empty_desc' => 'Select services on the left to calculate price',
        'subtotal' => 'Subtotal',
        'discount' => 'Discount',
        'total' => 'Total Price',
        'btn_clear' => 'Clear All',
        'btn_order' => 'Continue Order',
        'discount_info_3' => 'Select 3+ services get 10% discount',
        'discount_info_5' => 'Select 5+ services get 15% discount',
        'discount_active' => 'Congrats! You get discount',
    ]
];

$t = $text[$lang];

// Calculator services (29 most popular ones)
$calculator_services = [
    // Website Development
    ['id' => 1, 'name' => 'Landing Page', 'price' => 350000, 'category' => 'Website', 'icon' => 'file-earmark-text'],
    ['id' => 2, 'name' => 'Company Profile Website', 'price' => 1500000, 'category' => 'Website', 'icon' => 'building'],
    ['id' => 3, 'name' => 'Toko Online / E-Commerce', 'price' => 2000000, 'category' => 'Website', 'icon' => 'cart'],
    ['id' => 4, 'name' => 'Website Portal Berita', 'price' => 3000000, 'category' => 'Website', 'icon' => 'newspaper'],
    ['id' => 5, 'name' => 'Website Sekolah/Kampus', 'price' => 2000000, 'category' => 'Website', 'icon' => 'mortarboard'],

    // SEO & Ads
    ['id' => 6, 'name' => 'SEO On-Page Optimization', 'price' => 500000, 'category' => 'SEO & Ads', 'icon' => 'search'],
    ['id' => 7, 'name' => 'SEO Off-Page (Backlink)', 'price' => 800000, 'category' => 'SEO & Ads', 'icon' => 'link-45deg'],
    ['id' => 8, 'name' => 'Google Ads Management', 'price' => 1000000, 'category' => 'SEO & Ads', 'icon' => 'google'],
    ['id' => 9, 'name' => 'Facebook & Instagram Ads', 'price' => 800000, 'category' => 'SEO & Ads', 'icon' => 'facebook'],
    ['id' => 10, 'name' => 'Social Media Management', 'price' => 1500000, 'category' => 'SEO & Ads', 'icon' => 'chat-dots'],

    // Branding & Design
    ['id' => 11, 'name' => 'Logo Design Professional', 'price' => 500000, 'category' => 'Branding', 'icon' => 'palette'],
    ['id' => 12, 'name' => 'Brand Identity Package', 'price' => 2000000, 'category' => 'Branding', 'icon' => 'box'],
    ['id' => 13, 'name' => 'Social Media Post Design (30 pcs)', 'price' => 500000, 'category' => 'Branding', 'icon' => 'instagram'],
    ['id' => 14, 'name' => 'UI/UX Design', 'price' => 3000000, 'category' => 'Branding', 'icon' => 'layers'],

    // AI & Automation
    ['id' => 15, 'name' => 'Chatbot AI WhatsApp', 'price' => 1000000, 'category' => 'AI & Automation', 'icon' => 'robot'],
    ['id' => 16, 'name' => 'Chatbot Website (Live Chat)', 'price' => 500000, 'category' => 'AI & Automation', 'icon' => 'chat-left-dots'],
    ['id' => 17, 'name' => 'WhatsApp Business API Setup', 'price' => 1500000, 'category' => 'AI & Automation', 'icon' => 'whatsapp'],
    ['id' => 18, 'name' => 'Email Automation', 'price' => 600000, 'category' => 'AI & Automation', 'icon' => 'envelope-at'],

    // E-Commerce
    ['id' => 19, 'name' => 'Payment Gateway Integration', 'price' => 1000000, 'category' => 'E-Commerce', 'icon' => 'credit-card'],
    ['id' => 20, 'name' => 'Shipping Integration (JNE, J&T, dll)', 'price' => 800000, 'category' => 'E-Commerce', 'icon' => 'truck'],
    ['id' => 21, 'name' => 'Inventory Management System', 'price' => 2500000, 'category' => 'E-Commerce', 'icon' => 'boxes'],

    // Business Intelligence
    ['id' => 22, 'name' => 'Dashboard Analytics', 'price' => 3000000, 'category' => 'Analytics', 'icon' => 'graph-up'],
    ['id' => 23, 'name' => 'Data Visualization', 'price' => 2000000, 'category' => 'Analytics', 'icon' => 'bar-chart-line'],
    ['id' => 24, 'name' => 'Report Automation', 'price' => 1500000, 'category' => 'Analytics', 'icon' => 'file-bar-graph'],

    // Content & Marketing
    ['id' => 25, 'name' => 'Content Marketing (20 artikel/bulan)', 'price' => 2000000, 'category' => 'Content', 'icon' => 'file-richtext'],
    ['id' => 26, 'name' => 'Email Marketing Campaign', 'price' => 500000, 'category' => 'Content', 'icon' => 'envelope'],
    ['id' => 27, 'name' => 'WhatsApp Blast Marketing', 'price' => 300000, 'category' => 'Content', 'icon' => 'whatsapp'],

    // Mobile App
    ['id' => 28, 'name' => 'Hybrid Mobile App (Android+iOS)', 'price' => 8000000, 'category' => 'Mobile App', 'icon' => 'phone'],
    ['id' => 29, 'name' => 'PWA (Progressive Web App)', 'price' => 3000000, 'category' => 'Mobile App', 'icon' => 'window'],
];

// Get unique categories
$categories = array_unique(array_column($calculator_services, 'category'));
sort($categories);

?>

<!-- HERO SECTION -->
<section class="hero-section calculator-hero" id="calculator-hero">
    <div class="container">
        <div class="hero-content text-center" data-aos="fade-up">
            <h1 class="hero-title">
                <?= $t['hero_title'] ?>
            </h1>

            <h2 class="hero-subtitle"><?= $t['hero_subtitle'] ?></h2>

            <div class="hero-badge">
                <i class="bi bi-tag-fill me-2"></i>
                <?= $t['discount_info_3'] ?> • <?= $t['discount_info_5'] ?>
            </div>
        </div>
    </div>
</section>

<!-- CALCULATOR SECTION -->
<section class="calculator-section">
    <div class="calculator-container container">
        <div class="row">
            <!-- Services Selection -->
            <div class="col-lg-8">
                <h2 class="section-title text-start" data-aos="fade-up"><?= $t['section_services'] ?></h2>

                <!-- Search Box -->
                <div class="services-search-box mt-4 mb-4" data-aos="fade-up">
                    <input type="text"
                           id="calcServiceSearch"
                           class="form-control"
                           placeholder="<?= $t['search_placeholder'] ?>">
                    <i class="bi bi-search"></i>
                </div>

                <!-- Category Filter -->
                <div class="calculator-filter mb-4" data-aos="fade-up">
                    <button class="filter-btn active" data-filter="all">
                        Semua
                    </button>
                    <?php foreach ($categories as $cat): ?>
                    <button class="filter-btn" data-filter="<?= slugify($cat) ?>">
                        <?= $cat ?>
                    </button>
                    <?php endforeach; ?>
                </div>

                <!-- Services Grid -->
                <div class="services-selection" id="servicesGrid">
                    <?php foreach ($calculator_services as $service): ?>
                    <div class="service-checkbox-card"
                         data-aos="fade-up"
                         data-service-id="<?= $service['id'] ?>"
                         data-service-name="<?= strtolower($service['name']) ?>"
                         data-service-category="<?= slugify($service['category']) ?>"
                         data-price="<?= $service['price'] ?>">

                        <div class="d-flex align-items-start">
                            <input type="checkbox"
                                   class="form-check-input me-3 mt-1"
                                   id="service_<?= $service['id'] ?>"
                                   value="<?= $service['id'] ?>">

                            <div class="flex-grow-1">
                                <label for="service_<?= $service['id'] ?>" class="d-flex align-items-center mb-2 cursor-pointer">
                                    <i class="bi bi-<?= $service['icon'] ?> text-gold fs-4 me-2"></i>
                                    <h5 class="mb-0"><?= $service['name'] ?></h5>
                                </label>
                                <p class="text-muted small mb-2">
                                    <i class="bi bi-folder me-1"></i><?= $service['category'] ?>
                                </p>
                                <p class="text-gold fw-bold mb-0">
                                    <?= formatRupiah($service['price']) ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Cart Summary (Sticky) -->
            <div class="col-lg-4">
                <div class="cart-summary" data-aos="fade-up">
                    <h3 class="text-gold mb-4">
                        <i class="bi bi-cart-check me-2"></i>
                        <?= $t['section_cart'] ?>
                    </h3>

                    <!-- Empty State -->
                    <div id="cartEmpty" class="text-center py-5">
                        <i class="bi bi-cart-x display-1 text-muted mb-3"></i>
                        <h5 class="text-light"><?= $t['cart_empty'] ?></h5>
                        <p class="text-muted small"><?= $t['cart_empty_desc'] ?></p>
                    </div>

                    <!-- Cart Items -->
                    <div id="cartItems" style="display: none;">
                        <div id="cartItemsList" class="mb-4"></div>

                        <!-- Discount Info -->
                        <div id="discountInfo" class="alert alert-success" style="display: none;">
                            <i class="bi bi-tag-fill me-2"></i>
                            <strong id="discountText"></strong>
                        </div>

                        <!-- Summary -->
                        <div class="cart-summary-details">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-light"><?= $t['subtotal'] ?>:</span>
                                <span class="text-light" id="cartSubtotal">Rp 0</span>
                            </div>

                            <div class="d-flex justify-content-between mb-2" id="discountRow" style="display: none;">
                                <span class="text-gold"><?= $t['discount'] ?> <span id="discountPercentage"></span>:</span>
                                <span class="text-gold" id="cartDiscount">Rp 0</span>
                            </div>

                            <hr style="border-color: rgba(212, 175, 55, 0.3);">

                            <div class="d-flex justify-content-between mb-4">
                                <h4 class="text-gold"><?= $t['total'] ?>:</h4>
                                <h4 class="text-gold" id="cartTotal">Rp 0</h4>
                            </div>

                            <div class="d-grid gap-2">
                                <button class="btn btn-gold btn-lg" id="btnOrder">
                                    <i class="bi bi-rocket-takeoff me-2"></i>
                                    <?= $t['btn_order'] ?>
                                </button>
                                <button class="btn btn-outline-gold" id="btnClearCart">
                                    <i class="bi bi-trash me-2"></i>
                                    <?= $t['btn_clear'] ?>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Calculator JavaScript -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.service-checkbox-card input[type="checkbox"]');
    const cartEmpty = document.getElementById('cartEmpty');
    const cartItems = document.getElementById('cartItems');
    const cartItemsList = document.getElementById('cartItemsList');
    const cartSubtotal = document.getElementById('cartSubtotal');
    const cartDiscount = document.getElementById('cartDiscount');
    const cartTotal = document.getElementById('cartTotal');
    const discountRow = document.getElementById('discountRow');
    const discountInfo = document.getElementById('discountInfo');
    const discountText = document.getElementById('discountText');
    const discountPercentage = document.getElementById('discountPercentage');
    const btnClearCart = document.getElementById('btnClearCart');
    const btnOrder = document.getElementById('btnOrder');
    const searchInput = document.getElementById('calcServiceSearch');
    const filterBtns = document.querySelectorAll('.calculator-filter .filter-btn');
    const serviceCards = document.querySelectorAll('.service-checkbox-card');

    let selectedServices = [];

    // Checkbox change handler
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const card = this.closest('.service-checkbox-card');
            const serviceId = parseInt(card.dataset.serviceId);
            const serviceName = card.querySelector('h5').textContent;
            const price = parseInt(card.dataset.price);

            if (this.checked) {
                card.classList.add('selected');
                selectedServices.push({
                    id: serviceId,
                    name: serviceName,
                    price: price
                });
            } else {
                card.classList.remove('selected');
                selectedServices = selectedServices.filter(s => s.id !== serviceId);
            }

            updateCart();
        });
    });

    // Update cart display
    function updateCart() {
        if (selectedServices.length === 0) {
            cartEmpty.style.display = 'block';
            cartItems.style.display = 'none';
            return;
        }

        cartEmpty.style.display = 'none';
        cartItems.style.display = 'block';

        // Calculate totals
        const subtotal = selectedServices.reduce((sum, s) => sum + s.price, 0);
        const discount = calculateDiscount(selectedServices.length, subtotal);
        const total = subtotal - discount;

        // Update cart items list
        cartItemsList.innerHTML = selectedServices.map(service => `
            <div class="cart-item">
                <div>
                    <small class="text-light">${service.name}</small>
                </div>
                <div class="text-gold">${formatRupiah(service.price)}</div>
            </div>
        `).join('');

        // Update totals
        cartSubtotal.textContent = formatRupiah(subtotal);
        cartDiscount.textContent = formatRupiah(discount);
        cartTotal.textContent = formatRupiah(total);

        // Show/hide discount
        if (discount > 0) {
            const discountPct = calculateDiscountPercentage(selectedServices.length);
            discountRow.style.display = 'flex';
            discountInfo.style.display = 'block';
            discountPercentage.textContent = `(${discountPct}%)`;
            discountText.textContent = `<?= $t['discount_active'] ?> ${discountPct}%!`;
        } else {
            discountRow.style.display = 'none';
            discountInfo.style.display = 'none';
        }
    }

    // Calculate discount based on number of services
    function calculateDiscount(count, subtotal) {
        const discountPct = calculateDiscountPercentage(count);
        return Math.floor(subtotal * discountPct / 100);
    }

    function calculateDiscountPercentage(count) {
        if (count >= 5) return 15;
        if (count >= 3) return 10;
        return 0;
    }

    // Format currency
    function formatRupiah(amount) {
        return 'Rp ' + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    // Clear cart
    btnClearCart.addEventListener('click', function() {
        checkboxes.forEach(cb => cb.checked = false);
        serviceCards.forEach(card => card.classList.remove('selected'));
        selectedServices = [];
        updateCart();
    });

    // Order button
    btnOrder.addEventListener('click', function() {
        const serviceIds = selectedServices.map(s => s.id).join(',');
        const total = cartTotal.textContent;
        window.location.href = `/client/demo-request?services=${serviceIds}&total=${encodeURIComponent(total)}`;
    });

    // Search functionality
    searchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();

        serviceCards.forEach(card => {
            const serviceName = card.dataset.serviceName;
            if (serviceName.includes(searchTerm)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });

    // Filter functionality
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const filter = this.dataset.filter;

            serviceCards.forEach(card => {
                if (filter === 'all' || card.dataset.serviceCategory === filter) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
});
</script>

<?php include __DIR__ . '/../includes/footer.php'; ?>
