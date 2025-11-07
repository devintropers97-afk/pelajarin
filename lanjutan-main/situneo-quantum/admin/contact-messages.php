<?php
$page_id = 'contact';
$pageTitle = 'Contact Messages - SITUNEO DIGITAL';
$pageDescription = 'Manage contact form messages';
$pageHeading = 'Contact Messages';

include __DIR__ . '/../includes/admin-header.php';

// Demo data
if (DEMO_MODE) {
    $messages = [
        ['id' => 1, 'name' => 'Alex Johnson', 'email' => 'alex@example.com', 'phone' => '081234567890', 'subject' => 'Inquiry about pricing', 'message' => 'Hi, I would like to know more about your enterprise package pricing and features.', 'status' => 'unread', 'created_at' => '2025-01-14 10:00:00'],
        ['id' => 2, 'name' => 'Maria Garcia', 'email' => 'maria@example.com', 'phone' => '082345678901', 'subject' => 'Partnership opportunity', 'message' => 'We are interested in partnering with SITUNEO DIGITAL for our clients.', 'status' => 'replied', 'created_at' => '2025-01-13 14:30:00'],
        ['id' => 3, 'name' => 'David Lee', 'email' => 'david@example.com', 'phone' => '083456789012', 'subject' => 'Technical support needed', 'message' => 'My website has been down for 2 hours. Please help urgently!', 'status' => 'unread', 'created_at' => '2025-01-14 16:45:00'],
        ['id' => 4, 'name' => 'Lisa Chen', 'email' => 'lisa@example.com', 'phone' => '084567890123', 'subject' => 'Request for quotation', 'message' => 'Please send quotation for e-commerce website development.', 'status' => 'archived', 'created_at' => '2025-01-10 09:15:00'],
    ];
}

// Stats
$total = count($messages);
$unread = count(array_filter($messages, fn($m) => $m['status'] === 'unread'));
$replied = count(array_filter($messages, fn($m) => $m['status'] === 'replied'));

?>

<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-lg-4 col-md-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">Total Messages</h6>
            <h3 class="text-gold mb-0"><?= $total ?></h3>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">Unread</h6>
            <h3 class="text-warning mb-0"><?= $unread ?></h3>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">Replied</h6>
            <h3 class="text-success mb-0"><?= $replied ?></h3>
        </div>
    </div>
</div>

<!-- Messages List -->
<?php foreach ($messages as $message): ?>
<div class="card-premium mb-3 <?= $message['status'] === 'unread' ? 'border-warning' : '' ?>">
    <div class="row">
        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <h5 class="text-gold mb-2"><?= htmlspecialchars($message['subject']) ?></h5>
                    <div class="d-flex gap-2 align-items-center flex-wrap">
                        <?php
                        $status_badge = match($message['status']) {
                            'unread' => '<span class="badge bg-warning">Unread</span>',
                            'replied' => '<span class="badge bg-success">Replied</span>',
                            'archived' => '<span class="badge bg-secondary">Archived</span>',
                        };
                        echo $status_badge;
                        ?>
                        <small class="text-muted"><?= timeAgo($message['created_at']) ?></small>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <strong class="text-light d-block mb-1"><?= htmlspecialchars($message['name']) ?></strong>
                <div class="text-muted small">
                    <i class="bi bi-envelope me-1"></i><?= htmlspecialchars($message['email']) ?>
                    <span class="mx-2">|</span>
                    <i class="bi bi-phone me-1"></i><?= htmlspecialchars($message['phone']) ?>
                </div>
            </div>

            <p class="text-light mb-0"><?= nl2br(htmlspecialchars($message['message'])) ?></p>
        </div>

        <div class="col-lg-4">
            <div class="card bg-dark p-3">
                <h6 class="text-gold mb-3">Actions</h6>
                <div class="d-grid gap-2">
                    <a href="mailto:<?= htmlspecialchars($message['email']) ?>" class="btn btn-gold btn-sm">
                        <i class="bi bi-envelope me-2"></i>Reply via Email
                    </a>
                    <a href="https://wa.me/62<?= ltrim($message['phone'], '0') ?>" target="_blank" class="btn btn-success btn-sm">
                        <i class="bi bi-whatsapp me-2"></i>WhatsApp
                    </a>
                    <?php if ($message['status'] === 'unread'): ?>
                    <button class="btn btn-info btn-sm" onclick="markRead(<?= $message['id'] ?>)">
                        <i class="bi bi-check me-2"></i>Mark as Read
                    </button>
                    <?php endif; ?>
                    <button class="btn btn-outline-secondary btn-sm" onclick="archiveMessage(<?= $message['id'] ?>)">
                        <i class="bi bi-archive me-2"></i>Archive
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

<script>
function markRead(id) {
    alert('Message marked as read!');
    location.reload();
}

function archiveMessage(id) {
    if (confirm('Archive this message?')) {
        alert('Message archived!');
        location.reload();
    }
}
</script>

<style>
.border-warning {
    border-left: 4px solid var(--bs-warning) !important;
}
</style>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
