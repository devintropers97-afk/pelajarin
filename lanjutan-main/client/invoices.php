<?php
$page_id = 'invoices';
$pageTitle = 'My Invoices - SITUNEO DIGITAL';
$pageDescription = 'View and manage your invoices';
$pageHeading = 'My Invoices';

include __DIR__ . '/../includes/client-header.php';

$current_user = getCurrentUser();
$filter_status = isset($_GET['status']) ? $_GET['status'] : 'all';
$selected_order = isset($_GET['order']) ? $_GET['order'] : null;

// Demo data for client invoices
if (DEMO_MODE) {
    $invoices = [
        [
            'invoice_id' => 'INV-2025-001',
            'order_id' => 'ORD-2025-001',
            'service' => 'Company Profile Website',
            'amount' => 1500000,
            'tax' => 150000, // 10% PPN
            'total' => 1650000,
            'status' => 'paid',
            'payment_method' => 'BCA Transfer',
            'issue_date' => '2025-01-10 14:30:00',
            'due_date' => '2025-01-17',
            'paid_date' => '2025-01-11 16:20:00',
        ],
        [
            'invoice_id' => 'INV-2025-006',
            'order_id' => 'ORD-2025-006',
            'service' => 'Mobile App Development',
            'amount' => 8000000,
            'tax' => 800000,
            'total' => 8800000,
            'status' => 'unpaid',
            'payment_method' => null,
            'issue_date' => '2025-01-09 16:00:00',
            'due_date' => '2025-01-15',
            'paid_date' => null,
        ],
        [
            'invoice_id' => 'INV-2025-008',
            'order_id' => 'ORD-2025-008',
            'service' => 'E-Commerce Website',
            'amount' => 5500000,
            'tax' => 550000,
            'total' => 6050000,
            'status' => 'unpaid',
            'payment_method' => null,
            'issue_date' => '2025-01-11 10:00:00',
            'due_date' => '2025-01-18',
            'paid_date' => null,
        ],
        [
            'invoice_id' => 'INV-2024-180',
            'order_id' => 'ORD-2024-180',
            'service' => 'SEO Optimization',
            'amount' => 500000,
            'tax' => 50000,
            'total' => 550000,
            'status' => 'paid',
            'payment_method' => 'GoPay',
            'issue_date' => '2024-12-20 10:00:00',
            'due_date' => '2024-12-27',
            'paid_date' => '2024-12-21 09:15:00',
        ],
        [
            'invoice_id' => 'INV-2024-165',
            'order_id' => 'ORD-2024-165',
            'service' => 'Google Ads Campaign',
            'amount' => 3000000,
            'tax' => 300000,
            'total' => 3300000,
            'status' => 'overdue',
            'payment_method' => null,
            'issue_date' => '2024-12-01 14:00:00',
            'due_date' => '2024-12-08',
            'paid_date' => null,
        ],
    ];

    // Filter invoices
    if ($filter_status !== 'all') {
        $invoices = array_filter($invoices, function($inv) use ($filter_status) {
            return $inv['status'] === $filter_status;
        });
    }

    // Check for overdue invoices
    foreach ($invoices as &$invoice) {
        if ($invoice['status'] === 'unpaid' && strtotime($invoice['due_date']) < time()) {
            $invoice['status'] = 'overdue';
        }
    }
}

// Stats
$all_invoices = count($invoices);
$paid = count(array_filter($invoices, fn($i) => $i['status'] === 'paid'));
$unpaid = count(array_filter($invoices, fn($i) => $i['status'] === 'unpaid'));
$overdue = count(array_filter($invoices, fn($i) => $i['status'] === 'overdue'));
$total_paid = array_sum(array_map(fn($i) => $i['status'] === 'paid' ? $i['total'] : 0, $invoices));
$total_unpaid = array_sum(array_map(fn($i) => $i['status'] !== 'paid' ? $i['total'] : 0, $invoices));

?>

<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-lg-2 col-md-4 col-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">All Invoices</h6>
            <h3 class="text-gold mb-0"><?= $all_invoices ?></h3>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">Paid</h6>
            <h3 class="text-success mb-0"><?= $paid ?></h3>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">Unpaid</h6>
            <h3 class="text-warning mb-0"><?= $unpaid ?></h3>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">Overdue</h6>
            <h3 class="text-danger mb-0"><?= $overdue ?></h3>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">Total Paid</h6>
            <p class="text-success mb-0 fw-bold small"><?= formatRupiah($total_paid) ?></p>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">Total Unpaid</h6>
            <p class="text-warning mb-0 fw-bold small"><?= formatRupiah($total_unpaid) ?></p>
        </div>
    </div>
</div>

<!-- Filter Tabs -->
<div class="card-premium mb-4">
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link <?= $filter_status === 'all' ? 'active' : '' ?>" href="?status=all">
                All (<?= $all_invoices ?>)
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $filter_status === 'paid' ? 'active' : '' ?>" href="?status=paid">
                Paid (<?= $paid ?>)
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $filter_status === 'unpaid' ? 'active' : '' ?>" href="?status=unpaid">
                Unpaid (<?= $unpaid ?>)
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $filter_status === 'overdue' ? 'active' : '' ?>" href="?status=overdue">
                Overdue (<?= $overdue ?>)
            </a>
        </li>
    </ul>
</div>

<!-- Invoices List -->
<?php if (empty($invoices)): ?>
<div class="card-premium text-center py-5">
    <i class="bi bi-receipt display-4 text-muted mb-3"></i>
    <h5 class="text-light mb-3">No invoices found</h5>
    <p class="text-muted mb-4">
        <?php if ($filter_status !== 'all'): ?>
            No <?= $filter_status ?> invoices. <a href="?status=all" class="text-gold">View all invoices</a>
        <?php else: ?>
            You don't have any invoices yet.
        <?php endif; ?>
    </p>
</div>
<?php else: ?>

<?php foreach ($invoices as $invoice): ?>
<div class="card-premium mb-3">
    <div class="row align-items-center">
        <!-- Left: Invoice Info -->
        <div class="col-lg-6">
            <div class="d-flex align-items-start mb-3">
                <div class="me-3">
                    <i class="bi bi-receipt text-gold" style="font-size: 2.5rem;"></i>
                </div>
                <div class="flex-grow-1">
                    <h5 class="text-gold mb-1"><?= $invoice['invoice_id'] ?></h5>
                    <p class="text-light mb-1"><?= htmlspecialchars($invoice['service']) ?></p>
                    <code class="text-muted small"><?= $invoice['order_id'] ?></code>
                    <?php
                    $status_badge = match($invoice['status']) {
                        'paid' => '<span class="badge bg-success ms-2">Paid</span>',
                        'unpaid' => '<span class="badge bg-warning ms-2">Unpaid</span>',
                        'overdue' => '<span class="badge bg-danger ms-2">Overdue</span>',
                        default => '<span class="badge bg-secondary ms-2">Unknown</span>'
                    };
                    echo $status_badge;
                    ?>
                </div>
            </div>

            <!-- Invoice Details -->
            <div class="row g-3">
                <div class="col-6">
                    <small class="text-muted d-block mb-1">
                        <i class="bi bi-calendar me-1"></i>Issue Date
                    </small>
                    <p class="text-light mb-0 small"><?= date('d M Y', strtotime($invoice['issue_date'])) ?></p>
                </div>
                <div class="col-6">
                    <small class="text-muted d-block mb-1">
                        <i class="bi bi-calendar-check me-1"></i>Due Date
                    </small>
                    <p class="<?= $invoice['status'] === 'overdue' ? 'text-danger' : 'text-light' ?> mb-0 small">
                        <?= date('d M Y', strtotime($invoice['due_date'])) ?>
                        <?php if ($invoice['status'] === 'overdue'): ?>
                            <span class="badge bg-danger ms-1">Late!</span>
                        <?php endif; ?>
                    </p>
                </div>
                <?php if ($invoice['paid_date']): ?>
                <div class="col-6">
                    <small class="text-muted d-block mb-1">
                        <i class="bi bi-check-circle me-1"></i>Paid Date
                    </small>
                    <p class="text-success mb-0 small"><?= date('d M Y', strtotime($invoice['paid_date'])) ?></p>
                </div>
                <div class="col-6">
                    <small class="text-muted d-block mb-1">
                        <i class="bi bi-credit-card me-1"></i>Payment Method
                    </small>
                    <p class="text-light mb-0 small"><?= $invoice['payment_method'] ?></p>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Middle: Amount Breakdown -->
        <div class="col-lg-3">
            <div class="card bg-dark p-3">
                <div class="d-flex justify-content-between mb-2">
                    <small class="text-muted">Subtotal</small>
                    <small class="text-light"><?= formatRupiah($invoice['amount']) ?></small>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <small class="text-muted">Tax (10%)</small>
                    <small class="text-light"><?= formatRupiah($invoice['tax']) ?></small>
                </div>
                <hr class="my-2 border-gold">
                <div class="d-flex justify-content-between">
                    <strong class="text-gold">Total</strong>
                    <strong class="text-gold"><?= formatRupiah($invoice['total']) ?></strong>
                </div>
            </div>
        </div>

        <!-- Right: Actions -->
        <div class="col-lg-3">
            <div class="d-grid gap-2">
                <button class="btn btn-outline-gold btn-sm" onclick="viewInvoice('<?= $invoice['invoice_id'] ?>')">
                    <i class="bi bi-eye me-2"></i>
                    View Details
                </button>

                <button class="btn btn-outline-info btn-sm" onclick="downloadInvoice('<?= $invoice['invoice_id'] ?>')">
                    <i class="bi bi-download me-2"></i>
                    Download PDF
                </button>

                <?php if ($invoice['status'] !== 'paid'): ?>
                <a href="/client/payment-upload?invoice=<?= $invoice['invoice_id'] ?>" class="btn btn-warning btn-sm">
                    <i class="bi bi-upload me-2"></i>
                    Upload Payment
                </a>
                <?php endif; ?>

                <a href="https://wa.me/6283173868915?text=Invoice%20<?= $invoice['invoice_id'] ?>" target="_blank" class="btn btn-outline-success btn-sm">
                    <i class="bi bi-whatsapp me-2"></i>
                    Contact
                </a>
            </div>
        </div>
    </div>

    <!-- Overdue Warning -->
    <?php if ($invoice['status'] === 'overdue'): ?>
    <div class="alert alert-danger mt-3 mb-0">
        <i class="bi bi-exclamation-triangle me-2"></i>
        <strong>Payment Overdue!</strong> This invoice is past the due date. Please upload your payment immediately to avoid service suspension.
    </div>
    <?php endif; ?>
</div>
<?php endforeach; ?>

<?php endif; ?>

<!-- Invoice Details Modal -->
<div class="modal fade" id="invoiceModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-dark">
            <div class="modal-header border-gold">
                <h5 class="modal-title text-gold">
                    <i class="bi bi-receipt me-2"></i>
                    Invoice Details
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="invoiceDetailsContent">
                <!-- Invoice details will be loaded here -->
                <div class="text-center py-5">
                    <div class="spinner-border text-gold" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                    <p class="text-light mt-3">Loading invoice details...</p>
                </div>
            </div>
            <div class="modal-footer border-gold">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-info" onclick="printInvoice()">
                    <i class="bi bi-printer me-2"></i>
                    Print
                </button>
                <button type="button" class="btn btn-gold" onclick="downloadCurrentInvoice()">
                    <i class="bi bi-download me-2"></i>
                    Download PDF
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let invoiceModal;
let currentInvoiceId;

document.addEventListener('DOMContentLoaded', function() {
    invoiceModal = new bootstrap.Modal(document.getElementById('invoiceModal'));
});

function viewInvoice(invoiceId) {
    currentInvoiceId = invoiceId;

    // Find invoice data
    const invoices = <?= json_encode($invoices) ?>;
    const invoice = invoices.find(inv => inv.invoice_id === invoiceId);

    if (!invoice) {
        alert('Invoice not found');
        return;
    }

    // Generate invoice HTML
    const html = `
        <div class="invoice-preview">
            <!-- Company Header -->
            <div class="text-center mb-4 pb-4 border-bottom border-gold">
                <h2 class="text-gold mb-2">SITUNEO DIGITAL</h2>
                <p class="text-light mb-1">Jl. Example Street No. 123, Jakarta</p>
                <p class="text-light mb-1">Phone: +62 831-7386-8915 | Email: admin@situneo.my.id</p>
                <p class="text-light mb-0">NIB: 20250926145704515453</p>
            </div>

            <!-- Invoice Header -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <h4 class="text-gold mb-3">INVOICE</h4>
                    <p class="mb-1"><strong class="text-light">Invoice ID:</strong> <span class="text-gold">${invoice.invoice_id}</span></p>
                    <p class="mb-1"><strong class="text-light">Order ID:</strong> <code>${invoice.order_id}</code></p>
                    <p class="mb-1"><strong class="text-light">Issue Date:</strong> <span class="text-light">${formatDate(invoice.issue_date)}</span></p>
                    <p class="mb-1"><strong class="text-light">Due Date:</strong> <span class="text-light">${formatDate(invoice.due_date)}</span></p>
                </div>
                <div class="col-md-6 text-md-end">
                    <h5 class="text-light mb-2">Bill To:</h5>
                    <p class="mb-1 text-light"><strong>${'<?= $current_user["full_name"] ?>'}</strong></p>
                    <p class="mb-1 text-light">${'<?= $current_user["email"] ?>'}</p>
                    <p class="mb-1 text-light">${'<?= $current_user["phone"] ?? "-" ?>'}</p>
                </div>
            </div>

            <!-- Invoice Items -->
            <div class="table-responsive mb-4">
                <table class="table table-dark table-bordered">
                    <thead class="table-gold">
                        <tr>
                            <th>Description</th>
                            <th class="text-end">Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-light">${invoice.service}</td>
                            <td class="text-end text-light">${formatRupiah(invoice.amount)}</td>
                        </tr>
                        <tr>
                            <td class="text-light">Tax (PPN 10%)</td>
                            <td class="text-end text-light">${formatRupiah(invoice.tax)}</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr class="table-gold">
                            <th>TOTAL</th>
                            <th class="text-end">${formatRupiah(invoice.total)}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Payment Status -->
            <div class="card ${invoice.status === 'paid' ? 'bg-success' : invoice.status === 'overdue' ? 'bg-danger' : 'bg-warning'} bg-opacity-25 p-3 mb-4">
                <h6 class="${invoice.status === 'paid' ? 'text-success' : invoice.status === 'overdue' ? 'text-danger' : 'text-warning'} mb-2">
                    Payment Status: ${invoice.status.toUpperCase()}
                </h6>
                ${invoice.paid_date ? `
                    <p class="mb-0 text-light small">Paid on ${formatDate(invoice.paid_date)} via ${invoice.payment_method}</p>
                ` : `
                    <p class="mb-0 text-light small">Please complete payment before ${formatDate(invoice.due_date)}</p>
                `}
            </div>

            <!-- Payment Instructions -->
            ${invoice.status !== 'paid' ? `
            <div class="card bg-dark p-3">
                <h6 class="text-gold mb-3">Payment Instructions</h6>
                <p class="text-light small mb-2"><strong>Transfer to:</strong></p>
                <ul class="text-light small mb-0">
                    <li>BCA: 1234567890 a/n SITUNEO DIGITAL</li>
                    <li>Mandiri: 9876543210 a/n SITUNEO DIGITAL</li>
                    <li>GoPay/OVO/Dana: 083173868915</li>
                </ul>
            </div>
            ` : ''}

            <!-- Footer -->
            <div class="text-center mt-4 pt-4 border-top border-gold">
                <p class="text-muted small mb-0">Thank you for your business!</p>
                <p class="text-muted small mb-0">For questions, contact us at admin@situneo.my.id or +62 831-7386-8915</p>
            </div>
        </div>
    `;

    document.getElementById('invoiceDetailsContent').innerHTML = html;
    invoiceModal.show();
}

function downloadInvoice(invoiceId) {
    // In real implementation, generate PDF server-side
    alert(`Downloading invoice ${invoiceId}...\n\nIn production, this will download a PDF file.`);
}

function downloadCurrentInvoice() {
    if (currentInvoiceId) {
        downloadInvoice(currentInvoiceId);
    }
}

function printInvoice() {
    window.print();
}

function formatDate(dateString) {
    const date = new Date(dateString);
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return date.toLocaleDateString('id-ID', options);
}

function formatRupiah(number) {
    return 'Rp ' + number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}
</script>

<style>
.nav-pills .nav-link {
    color: var(--gold);
    border: 1px solid transparent;
}

.nav-pills .nav-link:hover {
    background: rgba(212, 175, 55, 0.1);
    border-color: var(--gold);
}

.nav-pills .nav-link.active {
    background: var(--gradient-gold);
    color: var(--dark-blue);
    border-color: var(--gold);
}

.table-gold {
    background: var(--gradient-gold);
    color: var(--dark-blue);
}

.table-gold th {
    color: var(--dark-blue);
    font-weight: 700;
}

.invoice-preview {
    color: var(--text-light);
}

@media print {
    .modal-header,
    .modal-footer,
    .btn {
        display: none !important;
    }

    .modal-body {
        padding: 20px;
    }
}
</style>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
