<?php
$page_id = 'demo-requests';
$pageTitle = 'Demo Requests - Admin Dashboard';
$pageDescription = 'Manage demo website requests from clients';
$pageHeading = 'Demo Requests Management';

include __DIR__ . '/../includes/admin-header.php';

// Filters
$status_filter = isset($_GET['status']) ? sanitize($_GET['status']) : 'pending';

// Demo data - 26 fields dari demo request form
if (DEMO_MODE) {
    $demo_requests = [
        [
            'request_id' => 'DEMO-2025-001',
            'client_name' => 'John Doe',
            'client_email' => 'john@example.com',
            'client_phone' => '081234567890',
            'business_name' => 'John's Coffee Shop',
            'business_type' => 'Cafe & Restaurant',
            'business_description' => 'Modern coffee shop dengan konsep minimalist di Jakarta Selatan',
            'website_type' => 'Company Profile + E-Commerce',
            'target_audience' => 'Anak muda 20-35 tahun, pekerja kantoran',
            'main_features' => 'Menu digital, Online ordering, Membership system, Gallery',
            'color_preference' => 'Brown, Cream, White - Warm & Cozy',
            'reference_websites' => 'starbucks.com, kopi-kenangan.com',
            'content_ready' => 'yes',
            'logo_available' => 'yes',
            'special_requirements' => 'Butuh integrasi dengan GoFood & GrabFood',
            'budget_range' => '2-4 juta',
            'deadline_preference' => '2 minggu',
            'status' => 'pending',
            'priority' => 'high',
            'created_at' => '2025-01-10 14:00:00'
        ],
        [
            'request_id' => 'DEMO-2025-002',
            'client_name' => 'Sarah Wijaya',
            'client_email' => 'sarah@example.com',
            'client_phone' => '08199' . '9876543',
            'business_name' => 'Klinik Sehat Sentosa',
            'business_type' => 'Healthcare - Klinik',
            'business_description' => 'Klinik umum dengan layanan konsultasi dokter online',
            'website_type' => 'Company Profile + Booking System',
            'target_audience' => 'Keluarga, semua umur',
            'main_features' => 'Booking appointment, Doctor profiles, Telemedicine, Blog kesehatan',
            'color_preference' => 'Blue, White - Clean & Trust',
            'reference_websites' => 'halodoc.com, alodokter.com',
            'content_ready' => 'partial',
            'logo_available' => 'no',
            'special_requirements' => 'Harus HIPAA compliant, perlu form rekam medis',
            'budget_range' => '4-6 juta',
            'deadline_preference' => '3 minggu',
            'status' => 'processing',
            'priority' => 'high',
            'assigned_to' => 'Developer Pro',
            'created_at' => '2025-01-10 10:00:00'
        ],
        [
            'request_id' => 'DEMO-2025-003',
            'client_name' => 'Budi Santoso',
            'client_email' => 'budi@example.com',
            'client_phone' => '081345678901',
            'business_name' => 'Budi Property',
            'business_type' => 'Real Estate',
            'business_description' => 'Jual beli rumah, tanah, dan apartemen di Jakarta & sekitarnya',
            'website_type' => 'Listing Website',
            'target_audience' => 'Pembeli properti 25-50 tahun, middle-upper class',
            'main_features' => 'Property listing, Advanced search, Virtual tour, Mortgage calculator',
            'color_preference' => 'Navy Blue, Gold - Professional & Luxury',
            'reference_websites' => 'rumah123.com, lamudi.co.id',
            'content_ready' => 'yes',
            'logo_available' => 'yes',
            'special_requirements' => 'Butuh map integration, KPR calculator',
            'budget_range' => '5-8 juta',
            'deadline_preference' => '1 bulan',
            'status' => 'completed',
            'priority' => 'medium',
            'assigned_to' => 'Developer Pro',
            'demo_url' => 'https://demo.situneo.my.id/budi-property',
            'completed_at' => '2025-01-09 16:00:00',
            'created_at' => '2025-01-08 09:00:00'
        ],
    ];

    // Apply filter
    if ($status_filter !== 'all') {
        $demo_requests = array_filter($demo_requests, fn($d) => $d['status'] === $status_filter);
    }

    $total_requests = count($demo_requests);
}

// Stats
$stats = [
    'total' => DEMO_MODE ? 45 : 0,
    'pending' => DEMO_MODE ? 12 : 0,
    'processing' => DEMO_MODE ? 18 : 0,
    'completed' => DEMO_MODE ? 15 : 0,
];

?>

<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-1">Total Requests</h6>
                    <h3 class="text-gold mb-0"><?= $stats['total'] ?></h3>
                </div>
                <i class="bi bi-rocket-takeoff-fill text-gold" style="font-size: 2.5rem;"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-1">Pending</h6>
                    <h3 class="text-warning mb-0"><?= $stats['pending'] ?></h3>
                </div>
                <i class="bi bi-clock-fill text-warning" style="font-size: 2.5rem;"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-1">Processing</h6>
                    <h3 class="text-info mb-0"><?= $stats['processing'] ?></h3>
                </div>
                <i class="bi bi-gear-fill text-info" style="font-size: 2.5rem;"></i>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h6 class="text-muted mb-1">Completed</h6>
                    <h3 class="text-success mb-0"><?= $stats['completed'] ?></h3>
                </div>
                <i class="bi bi-check-circle-fill text-success" style="font-size: 2.5rem;"></i>
            </div>
        </div>
    </div>
</div>

<!-- Filter -->
<div class="card-premium mb-4">
    <form method="GET" action="/admin/demo-requests" class="row g-3 align-items-end">
        <div class="col-lg-4">
            <label class="form-label text-light">Status</label>
            <select name="status" class="form-control" onchange="this.form.submit()">
                <option value="all" <?= $status_filter === 'all' ? 'selected' : '' ?>>All Status</option>
                <option value="pending" <?= $status_filter === 'pending' ? 'selected' : '' ?>>Pending</option>
                <option value="processing" <?= $status_filter === 'processing' ? 'selected' : '' ?>>Processing</option>
                <option value="completed" <?= $status_filter === 'completed' ? 'selected' : '' ?>>Completed</option>
            </select>
        </div>
    </form>
</div>

<!-- Demo Requests List -->
<?php if (empty($demo_requests)): ?>
<div class="card-premium text-center py-5">
    <i class="bi bi-inbox display-4 text-muted mb-3"></i>
    <p class="text-light">No demo requests found</p>
</div>
<?php else: ?>
<?php foreach ($demo_requests as $request): ?>
<div class="card-premium mb-4">
    <div class="row">
        <!-- Left: Request Details -->
        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <h4 class="text-gold mb-2">
                        <i class="bi bi-building me-2"></i>
                        <?= htmlspecialchars($request['business_name']) ?>
                    </h4>
                    <code class="text-muted"><?= $request['request_id'] ?></code>
                    <span class="badge badge-gold ms-2"><?= $request['business_type'] ?></span>
                </div>
                <?php
                $status_badge = match($request['status']) {
                    'completed' => '<span class="badge bg-success">Completed</span>',
                    'processing' => '<span class="badge bg-info">Processing</span>',
                    'pending' => '<span class="badge bg-warning">Pending</span>',
                    default => '<span class="badge bg-secondary">Unknown</span>'
                };
                $priority_badge = match($request['priority'] ?? 'medium') {
                    'high' => '<span class="badge bg-danger">High Priority</span>',
                    'medium' => '<span class="badge bg-warning">Medium</span>',
                    'low' => '<span class="badge bg-secondary">Low</span>',
                    default => ''
                };
                echo $status_badge . ' ' . $priority_badge;
                ?>
            </div>

            <!-- Client Info -->
            <div class="row g-3 mb-3">
                <div class="col-md-4">
                    <small class="text-muted">Client</small>
                    <p class="text-light mb-0"><?= htmlspecialchars($request['client_name']) ?></p>
                </div>
                <div class="col-md-4">
                    <small class="text-muted">Email</small>
                    <p class="text-light mb-0"><?= htmlspecialchars($request['client_email']) ?></p>
                </div>
                <div class="col-md-4">
                    <small class="text-muted">Phone</small>
                    <p class="text-light mb-0"><?= htmlspecialchars($request['client_phone']) ?></p>
                </div>
            </div>

            <!-- Description -->
            <div class="mb-3">
                <small class="text-muted">Business Description</small>
                <p class="text-light"><?= htmlspecialchars($request['business_description']) ?></p>
            </div>

            <!-- Details Grid -->
            <div class="row g-3">
                <div class="col-md-6">
                    <small class="text-muted">Website Type</small>
                    <p class="text-light mb-0"><?= htmlspecialchars($request['website_type']) ?></p>
                </div>
                <div class="col-md-6">
                    <small class="text-muted">Budget</small>
                    <p class="text-gold fw-bold mb-0"><?= htmlspecialchars($request['budget_range']) ?></p>
                </div>
                <div class="col-md-6">
                    <small class="text-muted">Target Audience</small>
                    <p class="text-light mb-0"><?= htmlspecialchars($request['target_audience']) ?></p>
                </div>
                <div class="col-md-6">
                    <small class="text-muted">Deadline</small>
                    <p class="text-light mb-0"><?= htmlspecialchars($request['deadline_preference']) ?></p>
                </div>
            </div>

            <!-- Collapsed Details -->
            <div class="collapse mt-3" id="details-<?= $request['request_id'] ?>">
                <hr style="border-color: rgba(212, 175, 55, 0.2);">

                <div class="row g-3">
                    <div class="col-12">
                        <small class="text-muted">Main Features</small>
                        <p class="text-light"><?= htmlspecialchars($request['main_features']) ?></p>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted">Color Preference</small>
                        <p class="text-light"><?= htmlspecialchars($request['color_preference']) ?></p>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted">Reference Websites</small>
                        <p class="text-light"><?= htmlspecialchars($request['reference_websites']) ?></p>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted">Content Ready?</small>
                        <p class="text-light"><?= ucfirst($request['content_ready']) ?></p>
                    </div>
                    <div class="col-md-4">
                        <small class="text-muted">Logo Available?</small>
                        <p class="text-light"><?= ucfirst($request['logo_available']) ?></p>
                    </div>
                    <div class="col-12">
                        <small class="text-muted">Special Requirements</small>
                        <p class="text-light"><?= htmlspecialchars($request['special_requirements']) ?></p>
                    </div>
                    <?php if (isset($request['assigned_to'])): ?>
                    <div class="col-md-6">
                        <small class="text-muted">Assigned To</small>
                        <p class="text-info"><?= $request['assigned_to'] ?></p>
                    </div>
                    <?php endif; ?>
                    <?php if (isset($request['demo_url'])): ?>
                    <div class="col-md-6">
                        <small class="text-muted">Demo URL</small>
                        <p><a href="<?= $request['demo_url'] ?>" target="_blank" class="text-gold"><?= $request['demo_url'] ?></a></p>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <button class="btn btn-sm btn-outline-gold mt-3" type="button" data-bs-toggle="collapse" data-bs-target="#details-<?= $request['request_id'] ?>">
                <i class="bi bi-chevron-down me-2"></i>
                Show More Details
            </button>
        </div>

        <!-- Right: Actions -->
        <div class="col-lg-4">
            <div class="card bg-dark p-3 h-100">
                <h6 class="text-gold mb-3">
                    <i class="bi bi-gear me-2"></i>
                    Actions
                </h6>

                <?php if ($request['status'] === 'completed'): ?>
                <div class="alert alert-success mb-3">
                    <i class="bi bi-check-circle me-2"></i>
                    Demo completed!<br>
                    <small><?= timeAgo($request['completed_at']) ?></small>
                </div>
                <?php endif; ?>

                <div class="d-grid gap-2">
                    <!-- COPY FOR AI Button - Feature khusus yang diminta user -->
                    <button class="btn btn-gold" onclick="copyForAI('<?= $request['request_id'] ?>')">
                        <i class="bi bi-robot me-2"></i>
                        Copy for AI
                    </button>

                    <button class="btn btn-outline-info" onclick="viewDetails('<?= $request['request_id'] ?>')">
                        <i class="bi bi-eye me-2"></i>
                        View Full Details
                    </button>

                    <?php if ($request['status'] === 'pending'): ?>
                    <button class="btn btn-outline-success" onclick="assignDemo('<?= $request['request_id'] ?>')">
                        <i class="bi bi-person-plus me-2"></i>
                        Assign to Freelancer
                    </button>
                    <?php endif; ?>

                    <?php if ($request['status'] === 'processing'): ?>
                    <button class="btn btn-outline-success" onclick="markComplete('<?= $request['request_id'] ?>')">
                        <i class="bi bi-check-circle me-2"></i>
                        Mark as Complete
                    </button>
                    <?php endif; ?>

                    <button class="btn btn-outline-warning" onclick="contactClient('<?= $request['client_email'] ?>')">
                        <i class="bi bi-envelope me-2"></i>
                        Email Client
                    </button>

                    <button class="btn btn-outline-success" onclick="whatsappClient('<?= $request['client_phone'] ?>')">
                        <i class="bi bi-whatsapp me-2"></i>
                        WhatsApp Client
                    </button>
                </div>

                <hr style="border-color: rgba(212, 175, 55, 0.2);">

                <small class="text-muted">
                    <i class="bi bi-clock me-1"></i>
                    Requested <?= timeAgo($request['created_at']) ?>
                </small>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>
<?php endif; ?>

<script>
// COPY FOR AI - Generate prompt untuk AI berdasarkan request details
function copyForAI(requestId) {
    // Find request data (in real app, fetch from DOM or make AJAX call)
    const card = document.querySelector(`[id*="${requestId}"]`).closest('.card-premium');

    // Extract all fields from the request
    const businessName = card.querySelector('h4').textContent.trim().replace('navigate_next', '').trim();
    const businessType = card.querySelector('.badge-gold').textContent.trim();
    const description = card.querySelector('.text-light').textContent.trim();

    // Generate AI prompt
    const aiPrompt = `Create a demo website for the following business:

Business Name: ${businessName}
Business Type: ${businessType}
Description: ${description}

Please create a complete, professional demo website with:
- Modern, responsive design
- Brand-appropriate color scheme
- All requested features
- Sample content and images
- SEO-optimized structure

The demo should look production-ready and showcase best practices for this type of business.`;

    // Copy to clipboard
    navigator.clipboard.writeText(aiPrompt).then(() => {
        alert('✓ AI Prompt copied to clipboard!\n\nYou can now paste this to Claude or ChatGPT to generate the demo.');
    }).catch(err => {
        prompt('Copy this AI prompt:', aiPrompt);
    });
}

function assignDemo(requestId) {
    // In real app, show modal to select freelancer
    alert(`Assign demo ${requestId} to freelancer (DEMO)`);
}

function markComplete(requestId) {
    if (confirm('Mark this demo as complete?')) {
        alert(`Demo ${requestId} marked as complete (DEMO)`);
        location.reload();
    }
}

function contactClient(email) {
    window.location.href = `mailto:${email}`;
}

function whatsappClient(phone) {
    const cleanPhone = phone.replace(/[^0-9]/g, '');
    const wa = cleanPhone.startsWith('0') ? '62' + cleanPhone.substring(1) : cleanPhone;
    window.open(`https://wa.me/${wa}`, '_blank');
}

function viewDetails(requestId) {
    alert(`View full details for ${requestId} (DEMO)`);
}
</script>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
