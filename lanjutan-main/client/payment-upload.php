<?php
$page_id = 'payment-upload';
$pageTitle = 'Upload Payment - SITUNEO DIGITAL';
$pageDescription = 'Upload payment proof for your order';
$pageHeading = 'Upload Payment Proof';

include __DIR__ . '/../includes/client-header.php';

$current_user = getCurrentUser();
$selected_order = isset($_GET['order']) ? $_GET['order'] : null;
$selected_invoice = isset($_GET['invoice']) ? $_GET['invoice'] : null;

// Demo data for unpaid orders
if (DEMO_MODE) {
    $unpaid_orders = [
        [
            'order_id' => 'ORD-2025-006',
            'service' => 'Mobile App Development',
            'package' => 'ENTERPRISE',
            'amount' => 8000000,
            'status' => 'pending',
            'payment_status' => 'unpaid',
            'created_at' => '2025-01-09 16:00:00',
            'invoice_id' => 'INV-2025-006',
            'due_date' => '2025-01-15',
        ],
        [
            'order_id' => 'ORD-2025-008',
            'service' => 'E-Commerce Website',
            'package' => 'E-COMMERCE',
            'amount' => 5500000,
            'status' => 'pending',
            'payment_status' => 'unpaid',
            'created_at' => '2025-01-11 10:00:00',
            'invoice_id' => 'INV-2025-008',
            'due_date' => '2025-01-18',
        ],
    ];

    // Find selected order
    $order_details = null;
    if ($selected_order) {
        foreach ($unpaid_orders as $order) {
            if ($order['order_id'] === $selected_order || $order['invoice_id'] === $selected_invoice) {
                $order_details = $order;
                break;
            }
        }
    }
}

// Bank accounts for payment reference
$bank_accounts = [
    'BCA' => ['account' => '1234567890', 'name' => 'SITUNEO DIGITAL'],
    'Mandiri' => ['account' => '9876543210', 'name' => 'SITUNEO DIGITAL'],
    'BRI' => ['account' => '5555666677', 'name' => 'SITUNEO DIGITAL'],
    'BNI' => ['account' => '8888999900', 'name' => 'SITUNEO DIGITAL'],
];

$ewallet_accounts = [
    'GoPay' => '083173868915',
    'OVO' => '083173868915',
    'Dana' => '083173868915',
    'QRIS' => 'Scan QR Code di halaman pembayaran',
];

?>

<!-- Info Alert -->
<?php if (empty($unpaid_orders) && !DEMO_MODE): ?>
<div class="alert alert-info">
    <i class="bi bi-info-circle me-2"></i>
    Tidak ada order yang menunggu pembayaran. Silakan <a href="/client/orders" class="alert-link">cek orders Anda</a>.
</div>
<?php endif; ?>

<div class="row g-4">
    <!-- Left: Upload Form -->>
    <div class="col-lg-8">
        <div class="card-premium">
            <h5 class="text-gold mb-4">
                <i class="bi bi-upload me-2"></i>
                Upload Payment Proof
            </h5>

            <form id="paymentForm" enctype="multipart/form-data">
                <!-- Select Order -->
                <div class="mb-4">
                    <label class="form-label text-light">Select Order / Invoice <span class="text-danger">*</span></label>
                    <select class="form-select form-select-lg" id="orderSelect" required>
                        <option value="">-- Select Order --</option>
                        <?php foreach ($unpaid_orders as $order): ?>
                        <option value="<?= $order['order_id'] ?>"
                                data-amount="<?= $order['amount'] ?>"
                                data-service="<?= htmlspecialchars($order['service']) ?>"
                                data-invoice="<?= $order['invoice_id'] ?>"
                                <?= ($selected_order === $order['order_id'] || $selected_invoice === $order['invoice_id']) ? 'selected' : '' ?>>
                            <?= $order['order_id'] ?> - <?= htmlspecialchars($order['service']) ?> - <?= formatRupiah($order['amount']) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Order Details (shown when order selected) -->
                <div id="orderDetails" class="card bg-dark p-3 mb-4" style="<?= $order_details ? '' : 'display: none;' ?>">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <small class="text-muted d-block mb-1">Service</small>
                            <div class="text-light" id="detailService"><?= $order_details ? htmlspecialchars($order_details['service']) : '' ?></div>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted d-block mb-1">Invoice ID</small>
                            <code id="detailInvoice"><?= $order_details ? $order_details['invoice_id'] : '' ?></code>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted d-block mb-1">Amount to Pay</small>
                            <h4 class="text-gold mb-0" id="detailAmount"><?= $order_details ? formatRupiah($order_details['amount']) : '' ?></h4>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted d-block mb-1">Due Date</small>
                            <div class="text-warning" id="detailDueDate"><?= $order_details ? date('d M Y', strtotime($order_details['due_date'])) : '' ?></div>
                        </div>
                    </div>
                </div>

                <!-- Payment Method -->
                <div class="mb-4">
                    <label class="form-label text-light">Payment Method <span class="text-danger">*</span></label>
                    <div class="row g-2">
                        <!-- Bank Transfer -->
                        <div class="col-md-3 col-6">
                            <input type="radio" class="btn-check" name="payment_method" id="bca" value="BCA" required>
                            <label class="btn btn-outline-gold w-100" for="bca">
                                <i class="bi bi-bank2 d-block mb-1"></i>
                                BCA
                            </label>
                        </div>
                        <div class="col-md-3 col-6">
                            <input type="radio" class="btn-check" name="payment_method" id="mandiri" value="Mandiri">
                            <label class="btn btn-outline-gold w-100" for="mandiri">
                                <i class="bi bi-bank2 d-block mb-1"></i>
                                Mandiri
                            </label>
                        </div>
                        <div class="col-md-3 col-6">
                            <input type="radio" class="btn-check" name="payment_method" id="bri" value="BRI">
                            <label class="btn btn-outline-gold w-100" for="bri">
                                <i class="bi bi-bank2 d-block mb-1"></i>
                                BRI
                            </label>
                        </div>
                        <div class="col-md-3 col-6">
                            <input type="radio" class="btn-check" name="payment_method" id="bni" value="BNI">
                            <label class="btn btn-outline-gold w-100" for="bni">
                                <i class="bi bi-bank2 d-block mb-1"></i>
                                BNI
                            </label>
                        </div>
                        <!-- E-Wallet -->
                        <div class="col-md-3 col-6">
                            <input type="radio" class="btn-check" name="payment_method" id="gopay" value="GoPay">
                            <label class="btn btn-outline-gold w-100" for="gopay">
                                <i class="bi bi-wallet2 d-block mb-1"></i>
                                GoPay
                            </label>
                        </div>
                        <div class="col-md-3 col-6">
                            <input type="radio" class="btn-check" name="payment_method" id="ovo" value="OVO">
                            <label class="btn btn-outline-gold w-100" for="ovo">
                                <i class="bi bi-wallet2 d-block mb-1"></i>
                                OVO
                            </label>
                        </div>
                        <div class="col-md-3 col-6">
                            <input type="radio" class="btn-check" name="payment_method" id="dana" value="Dana">
                            <label class="btn btn-outline-gold w-100" for="dana">
                                <i class="bi bi-wallet2 d-block mb-1"></i>
                                Dana
                            </label>
                        </div>
                        <div class="col-md-3 col-6">
                            <input type="radio" class="btn-check" name="payment_method" id="qris" value="QRIS">
                            <label class="btn btn-outline-gold w-100" for="qris">
                                <i class="bi bi-qr-code d-block mb-1"></i>
                                QRIS
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Payment Amount Confirmation -->
                <div class="mb-4">
                    <label class="form-label text-light">Payment Amount <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="text" class="form-control" id="paymentAmount" placeholder="Enter amount you paid" required>
                    </div>
                    <small class="text-muted">Enter the exact amount you transferred</small>
                </div>

                <!-- Upload Proof -->
                <div class="mb-4">
                    <label class="form-label text-light">Payment Proof (Screenshot) <span class="text-danger">*</span></label>
                    <input type="file" class="form-control" id="proofFile" accept="image/*" required>
                    <small class="text-muted">Upload screenshot of your payment confirmation (Max 5MB, JPG/PNG)</small>

                    <!-- Image Preview -->
                    <div id="imagePreview" class="mt-3" style="display: none;">
                        <p class="text-light mb-2">Preview:</p>
                        <img id="previewImg" src="" alt="Preview" class="img-fluid rounded" style="max-height: 300px;">
                        <button type="button" class="btn btn-sm btn-outline-danger mt-2" onclick="removeImage()">
                            <i class="bi bi-trash me-1"></i> Remove
                        </button>
                    </div>
                </div>

                <!-- Transaction ID / Reference -->
                <div class="mb-4">
                    <label class="form-label text-light">Transaction ID / Reference Number</label>
                    <input type="text" class="form-control" id="transactionRef" placeholder="Optional: Enter transaction reference">
                    <small class="text-muted">If available from your bank/e-wallet</small>
                </div>

                <!-- Notes -->
                <div class="mb-4">
                    <label class="form-label text-light">Notes (Optional)</label>
                    <textarea class="form-control" id="paymentNotes" rows="3" placeholder="Additional information about your payment..."></textarea>
                </div>

                <!-- Submit -->
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-gold">
                        <i class="bi bi-upload me-2"></i>
                        Submit Payment Proof
                    </button>
                    <a href="/client/orders" class="btn btn-outline-secondary">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Right: Payment Instructions -->
    <div class="col-lg-4">
        <!-- Bank Account Info -->
        <div class="card-premium mb-4">
            <h6 class="text-gold mb-3">
                <i class="bi bi-bank me-2"></i>
                Bank Transfer Details
            </h6>

            <?php foreach ($bank_accounts as $bank => $account): ?>
            <div class="card bg-dark p-3 mb-2">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <strong class="text-light d-block"><?= $bank ?></strong>
                        <code class="text-gold"><?= $account['account'] ?></code>
                        <p class="text-muted small mb-0 mt-1"><?= $account['name'] ?></p>
                    </div>
                    <button class="btn btn-sm btn-outline-gold" onclick="copyText('<?= $account['account'] ?>')">
                        <i class="bi bi-clipboard"></i>
                    </button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- E-Wallet Info -->
        <div class="card-premium mb-4">
            <h6 class="text-gold mb-3">
                <i class="bi bi-wallet2 me-2"></i>
                E-Wallet Details
            </h6>

            <?php foreach ($ewallet_accounts as $ewallet => $number): ?>
            <div class="card bg-dark p-3 mb-2">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="flex-grow-1">
                        <strong class="text-light d-block"><?= $ewallet ?></strong>
                        <?php if ($ewallet !== 'QRIS'): ?>
                        <code class="text-gold"><?= $number ?></code>
                        <?php else: ?>
                        <small class="text-muted"><?= $number ?></small>
                        <?php endif; ?>
                    </div>
                    <?php if ($ewallet !== 'QRIS'): ?>
                    <button class="btn btn-sm btn-outline-gold" onclick="copyText('<?= $number ?>')">
                        <i class="bi bi-clipboard"></i>
                    </button>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Instructions -->
        <div class="card-premium">
            <h6 class="text-gold mb-3">
                <i class="bi bi-info-circle me-2"></i>
                Payment Instructions
            </h6>

            <ol class="text-light small ps-3">
                <li class="mb-2">Select your order from dropdown above</li>
                <li class="mb-2">Choose payment method (Bank/E-Wallet)</li>
                <li class="mb-2">Transfer exact amount to our account</li>
                <li class="mb-2">Take screenshot of payment confirmation</li>
                <li class="mb-2">Upload screenshot via form</li>
                <li class="mb-2">Wait for verification (max 2x24 hours)</li>
            </ol>

            <div class="alert alert-warning mt-3 mb-0 small">
                <i class="bi bi-exclamation-triangle me-1"></i>
                <strong>Important:</strong> Make sure amount and account number are correct before transferring.
            </div>
        </div>

        <!-- Contact Support -->
        <div class="card-premium mt-4">
            <h6 class="text-gold mb-3">Need Help?</h6>
            <a href="https://wa.me/6283173868915?text=Halo,%20saya%20butuh%20bantuan%20dengan%20pembayaran" target="_blank" class="btn btn-success w-100">
                <i class="bi bi-whatsapp me-2"></i>
                Contact via WhatsApp
            </a>
        </div>
    </div>
</div>

<!-- Success Modal -->
<div class="modal fade" id="successModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark">
            <div class="modal-body text-center py-5">
                <div class="mb-4">
                    <i class="bi bi-check-circle-fill text-success" style="font-size: 5rem;"></i>
                </div>
                <h4 class="text-gold mb-3">Payment Proof Uploaded!</h4>
                <p class="text-light mb-4">
                    Your payment proof has been submitted successfully. Our team will verify your payment within 2x24 hours.
                </p>
                <div class="alert alert-info">
                    <i class="bi bi-info-circle me-2"></i>
                    We'll send you an email notification once verified.
                </div>
                <div class="d-flex gap-2 justify-content-center">
                    <a href="/client/orders" class="btn btn-gold">
                        <i class="bi bi-cart-check me-2"></i>
                        View My Orders
                    </a>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
let successModal;

document.addEventListener('DOMContentLoaded', function() {
    successModal = new bootstrap.Modal(document.getElementById('successModal'));

    // Order select change handler
    document.getElementById('orderSelect').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        if (this.value) {
            const amount = selectedOption.dataset.amount;
            const service = selectedOption.dataset.service;
            const invoice = selectedOption.dataset.invoice;
            const dueDate = selectedOption.dataset.duedate || '15 Jan 2025';

            document.getElementById('detailService').textContent = service;
            document.getElementById('detailInvoice').textContent = invoice;
            document.getElementById('detailAmount').textContent = formatRupiah(parseInt(amount));
            document.getElementById('detailDueDate').textContent = dueDate;
            document.getElementById('orderDetails').style.display = 'block';

            // Pre-fill payment amount
            document.getElementById('paymentAmount').value = formatNumber(amount);
        } else {
            document.getElementById('orderDetails').style.display = 'none';
        }
    });

    // Trigger change if order pre-selected
    if (document.getElementById('orderSelect').value) {
        document.getElementById('orderSelect').dispatchEvent(new Event('change'));
    }

    // Image preview
    document.getElementById('proofFile').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            // Check file size (5MB max)
            if (file.size > 5 * 1024 * 1024) {
                alert('File size must be less than 5MB');
                this.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImg').src = e.target.result;
                document.getElementById('imagePreview').style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });

    // Form submission
    document.getElementById('paymentForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const orderId = document.getElementById('orderSelect').value;
        const paymentMethod = document.querySelector('input[name="payment_method"]:checked');
        const amount = document.getElementById('paymentAmount').value;
        const file = document.getElementById('proofFile').files[0];

        if (!orderId || !paymentMethod || !amount || !file) {
            alert('Please fill all required fields');
            return;
        }

        // In real implementation, upload via AJAX
        // For demo, just show success
        setTimeout(() => {
            successModal.show();
            this.reset();
            document.getElementById('imagePreview').style.display = 'none';
            document.getElementById('orderDetails').style.display = 'none';
        }, 500);
    });

    // Format payment amount input
    document.getElementById('paymentAmount').addEventListener('input', function(e) {
        let value = this.value.replace(/[^\d]/g, '');
        this.value = formatNumber(value);
    });
});

function removeImage() {
    document.getElementById('proofFile').value = '';
    document.getElementById('imagePreview').style.display = 'none';
}

function copyText(text) {
    navigator.clipboard.writeText(text).then(() => {
        // Show temporary success message
        const btn = event.target.closest('button');
        const originalHTML = btn.innerHTML;
        btn.innerHTML = '<i class="bi bi-check"></i>';
        btn.classList.add('btn-success');
        btn.classList.remove('btn-outline-gold');

        setTimeout(() => {
            btn.innerHTML = originalHTML;
            btn.classList.remove('btn-success');
            btn.classList.add('btn-outline-gold');
        }, 1500);
    });
}

function formatRupiah(number) {
    return 'Rp ' + number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}

function formatNumber(number) {
    return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}
</script>

<style>
.btn-check:checked + .btn-outline-gold {
    background: var(--gradient-gold);
    border-color: var(--gold);
    color: var(--dark-blue);
}

#imagePreview img {
    border: 2px solid var(--gold);
}

.form-control:focus,
.form-select:focus {
    border-color: var(--gold);
    box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.25);
}
</style>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
