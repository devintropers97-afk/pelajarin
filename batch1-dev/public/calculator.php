<?php
/**
 * Pricing Calculator - Beli Putus vs Sewa Bulanan
 * Help users calculate savings and ROI
 */

defined('SITUNEO_ACCESS') or die('Direct access not permitted');

$page_title = 'Kalkulator Harga - SITUNEO DIGITAL';
$page_description = 'Hitung penghematan antara beli putus dan sewa bulanan';

include INCLUDES_PATH . 'header/public-header.php';
?>

<section class="calculator-hero py-5 bg-gradient-primary text-white">
    <div class="container">
        <div class="row align-items-center" data-aos="fade-up">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-3">Kalkulator Harga</h1>
                <p class="lead">Hitung penghematan antara <strong>Beli Putus</strong> dan <strong>Sewa Bulanan</strong></p>
                <p>Cari tahu mana yang lebih menguntungkan untuk budget Anda!</p>
            </div>
            <div class="col-lg-6">
                <div class="calculator-icon text-center">
                    <i class="bi bi-calculator" style="font-size: 10rem; opacity: 0.3;"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="calculator-section py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="calculator-card" data-aos="fade-up">
                    <div class="card-header">
                        <h3><i class="bi bi-calculator"></i> Input Harga</h3>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <label class="form-label fw-bold">Harga Beli Putus (One-Time)</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text">Rp</span>
                                <input type="number" id="oneTimePrice" class="form-control" value="1000000" min="0" step="10000">
                            </div>
                            <small class="text-muted">Full ownership, no monthly fee, sekali bayar</small>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Harga Sewa Bulanan (Monthly)</label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text">Rp</span>
                                <input type="number" id="monthlyPrice" class="form-control" value="200000" min="0" step="10000">
                                <span class="input-group-text">/bulan</span>
                            </div>
                            <small class="text-muted">Zero setup fee, includes maintenance & updates</small>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Periode Penggunaan</label>
                            <div class="range-container">
                                <input type="range" id="months" class="form-range" min="1" max="36" value="12" step="1">
                                <div class="d-flex justify-content-between mt-2">
                                    <small>1 bulan</small>
                                    <strong id="monthsDisplay" class="text-primary">12 bulan</strong>
                                    <small>36 bulan</small>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary btn-lg w-100" onclick="calculateSavings()">
                            <i class="bi bi-calculator"></i> Hitung Penghematan
                        </button>
                    </div>
                </div>

                <!-- Results -->
                <div id="resultsContainer" class="mt-4" style="display: none;" data-aos="fade-up">
                    <div class="results-card">
                        <h4 class="mb-4">Hasil Perhitungan:</h4>

                        <div class="row g-4">
                            <!-- Beli Putus -->
                            <div class="col-md-6">
                                <div class="option-card one-time">
                                    <div class="option-icon">
                                        <i class="bi bi-cash-coin"></i>
                                    </div>
                                    <h5>Beli Putus</h5>
                                    <div class="price" id="oneTimeTotalDisplay">Rp 0</div>
                                    <div class="details">
                                        <p> Full ownership</p>
                                        <p> Sekali bayar</p>
                                        <p> No monthly fee</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Sewa Bulanan -->
                            <div class="col-md-6">
                                <div class="option-card subscription">
                                    <div class="option-icon">
                                        <i class="bi bi-calendar-check"></i>
                                    </div>
                                    <h5>Sewa Bulanan</h5>
                                    <div class="price" id="monthlyTotalDisplay">Rp 0</div>
                                    <div class="details">
                                        <p> Zero setup fee</p>
                                        <p> Maintenance included</p>
                                        <p> Free updates</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Savings Summary -->
                        <div class="savings-summary mt-4">
                            <div id="savingsResult"></div>
                        </div>

                        <!-- Recommendation -->
                        <div class="recommendation mt-4">
                            <h5><i class="bi bi-lightbulb"></i> Rekomendasi:</h5>
                            <div id="recommendationText"></div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="action-buttons mt-4">
                            <a href="<?= url('services') ?>" class="btn btn-primary btn-lg">
                                <i class="bi bi-basket"></i> Lihat Semua Services
                            </a>
                            <a href="<?= whatsapp_link(COMPANY_WHATSAPP, 'Halo, saya ingin konsultasi tentang pricing') ?>" class="btn btn-success btn-lg" target="_blank">
                                <i class="bi bi-whatsapp"></i> Konsultasi Gratis
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include INCLUDES_PATH . 'footer/public-footer.php'; ?>

<style>
.calculator-hero {
    background: var(--gradient-primary);
}

.calculator-card {
    background: var(--white);
    border-radius: var(--radius-xl);
    box-shadow: var(--shadow-xl);
    overflow: hidden;
}

.calculator-card .card-header {
    background: var(--gradient-primary);
    color: var(--white);
    padding: 1.5rem;
}

.calculator-card .card-header h3 {
    margin: 0;
    font-size: 1.5rem;
    font-weight: 600;
}

.calculator-card .card-body {
    padding: 2rem;
}

.results-card {
    background: var(--white);
    border-radius: var(--radius-xl);
    padding: 2rem;
    box-shadow: var(--shadow-xl);
}

.option-card {
    background: var(--gray-50);
    border-radius: var(--radius-lg);
    padding: 2rem;
    text-align: center;
    border: 3px solid var(--gray-200);
    transition: var(--transition);
}

.option-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}

.option-card.one-time {
    border-color: var(--success-color);
}

.option-card.subscription {
    border-color: var(--primary-color);
}

.option-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
}

.option-card.one-time .option-icon {
    color: var(--success-color);
}

.option-card.subscription .option-icon {
    color: var(--primary-color);
}

.option-card .price {
    font-size: 2rem;
    font-weight: 700;
    color: var(--dark);
    margin: 1rem 0;
}

.option-card .details p {
    margin: 0.5rem 0;
    font-size: 0.875rem;
    color: var(--gray-600);
}

.savings-summary {
    background: var(--gradient-primary);
    color: var(--white);
    border-radius: var(--radius-lg);
    padding: 1.5rem;
    text-align: center;
}

.savings-summary h3 {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.recommendation {
    background: var(--gray-50);
    border-radius: var(--radius-lg);
    padding: 1.5rem;
    border-left: 4px solid var(--primary-color);
}

.action-buttons {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

.action-buttons .btn {
    flex: 1;
    min-width: 200px;
}

@media (max-width: 768px) {
    .action-buttons {
        flex-direction: column;
    }
}
</style>

<script>
// Update months display on slider change
document.getElementById('months').addEventListener('input', function() {
    document.getElementById('monthsDisplay').textContent = this.value + ' bulan';
});

// Calculate savings
function calculateSavings() {
    const oneTimePrice = parseFloat(document.getElementById('oneTimePrice').value) || 0;
    const monthlyPrice = parseFloat(document.getElementById('monthlyPrice').value) || 0;
    const months = parseInt(document.getElementById('months').value) || 12;

    // Calculate totals
    const oneTimeTotal = oneTimePrice;
    const monthlyTotal = monthlyPrice * months;
    const savings = monthlyTotal - oneTimeTotal;
    const breakEvenMonths = Math.ceil(oneTimePrice / monthlyPrice);

    // Display totals
    document.getElementById('oneTimeTotalDisplay').textContent = formatRupiah(oneTimeTotal);
    document.getElementById('monthlyTotalDisplay').textContent = formatRupiah(monthlyTotal) + ' (' + months + ' bulan)';

    // Savings result
    const savingsResult = document.getElementById('savingsResult');
    if (savings > 0) {
        savingsResult.innerHTML = `
            <h3 class="text-success">+${formatRupiah(savings)}</h3>
            <p class="mb-0">Anda HEMAT dengan memilih <strong>Beli Putus</strong></p>
        `;
    } else {
        savingsResult.innerHTML = `
            <h3 class="text-info">${formatRupiah(Math.abs(savings))}</h3>
            <p class="mb-0">Anda hemat dengan memilih <strong>Sewa Bulanan</strong> untuk ${months} bulan</p>
        `;
    }

    // Recommendation
    const recommendation = document.getElementById('recommendationText');
    if (months >= breakEvenMonths) {
        recommendation.innerHTML = `
            <div class="alert alert-success mb-0">
                <strong>Pilih BELI PUTUS!</strong><br>
                Setelah ${breakEvenMonths} bulan, biaya sewa akan melebihi harga beli putus.
                Anda akan hemat <strong>${formatRupiah(savings)}</strong> dalam ${months} bulan.
            </div>
        `;
    } else {
        recommendation.innerHTML = `
            <div class="alert alert-info mb-0">
                <strong>Pilih SEWA BULANAN!</strong><br>
                Untuk penggunaan ${months} bulan, sewa bulanan lebih ekonomis.
                Baru setelah ${breakEvenMonths} bulan, beli putus akan lebih menguntungkan.
            </div>
        `;
    }

    // Show results
    document.getElementById('resultsContainer').style.display = 'block';

    // Scroll to results
    document.getElementById('resultsContainer').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
}

// Format to Rupiah
function formatRupiah(amount) {
    return 'Rp ' + amount.toLocaleString('id-ID');
}

// Auto-calculate on page load
document.addEventListener('DOMContentLoaded', function() {
    calculateSavings();
});

// Recalculate on input change
document.getElementById('oneTimePrice').addEventListener('input', calculateSavings);
document.getElementById('monthlyPrice').addEventListener('input', calculateSavings);
document.getElementById('months').addEventListener('input', calculateSavings);
</script>
