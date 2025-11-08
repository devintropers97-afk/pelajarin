<?php
$page_id = 'support';
$pageTitle = 'Support Tickets - SITUNEO DIGITAL';
$pageDescription = 'Manage support tickets';
$pageHeading = 'Support Tickets Management';

include __DIR__ . '/../includes/admin-header.php';

$filter_status = isset($_GET['status']) ? $_GET['status'] : 'all';

// Demo data
if (DEMO_MODE) {
    $tickets = [
        ['id' => 1, 'ticket_id' => 'TKT-2025-001', 'user' => 'John Doe', 'role' => 'client', 'subject' => 'Issue with website loading speed', 'category' => 'Technical', 'priority' => 'high', 'status' => 'in-progress', 'created_at' => '2025-01-12 10:30:00', 'updated_at' => '2025-01-13 14:20:00', 'assigned_to' => 'Admin', 'replies' => 3],
        ['id' => 2, 'ticket_id' => 'TKT-2025-005', 'user' => 'Jane Smith', 'role' => 'client', 'subject' => 'Need invoice for payment', 'category' => 'Billing', 'priority' => 'medium', 'status' => 'resolved', 'created_at' => '2025-01-11 16:00:00', 'updated_at' => '2025-01-11 17:30:00', 'assigned_to' => 'Admin', 'replies' => 2],
        ['id' => 3, 'ticket_id' => 'TKT-2025-003', 'user' => 'Developer Pro', 'role' => 'freelancer', 'subject' => 'Withdrawal request status', 'category' => 'General', 'priority' => 'low', 'status' => 'open', 'created_at' => '2025-01-10 09:15:00', 'updated_at' => '2025-01-10 09:15:00', 'assigned_to' => null, 'replies' => 0],
        ['id' => 4, 'ticket_id' => 'TKT-2024-180', 'user' => 'Sarah Wilson', 'role' => 'client', 'subject' => 'How to update content?', 'category' => 'General', 'priority' => 'medium', 'status' => 'closed', 'created_at' => '2025-01-08 14:00:00', 'updated_at' => '2025-01-09 10:00:00', 'assigned_to' => 'Admin', 'replies' => 4],
    ];

    // Filter
    if ($filter_status !== 'all') {
        $tickets = array_filter($tickets, fn($t) => $t['status'] === $filter_status);
    }
}

// Stats
$total = count($tickets);
$open = count(array_filter($tickets, fn($t) => $t['status'] === 'open'));
$in_progress = count(array_filter($tickets, fn($t) => $t['status'] === 'in-progress'));
$resolved = count(array_filter($tickets, fn($t) => $t['status'] === 'resolved'));

?>

<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">Open Tickets</h6>
            <h3 class="text-warning mb-0"><?= $open ?></h3>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">In Progress</h6>
            <h3 class="text-info mb-0"><?= $in_progress ?></h3>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">Resolved</h6>
            <h3 class="text-success mb-0"><?= $resolved ?></h3>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">Total Tickets</h6>
            <h3 class="text-gold mb-0"><?= $total ?></h3>
        </div>
    </div>
</div>

<!-- Filter Tabs -->
<div class="card-premium mb-4">
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link <?= $filter_status === 'all' ? 'active' : '' ?>" href="?status=all">All (<?= $total ?>)</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $filter_status === 'open' ? 'active' : '' ?>" href="?status=open">Open (<?= $open ?>)</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $filter_status === 'in-progress' ? 'active' : '' ?>" href="?status=in-progress">In Progress (<?= $in_progress ?>)</a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $filter_status === 'resolved' ? 'active' : '' ?>" href="?status=resolved">Resolved (<?= $resolved ?>)</a>
        </li>
    </ul>
</div>

<!-- Tickets List -->
<?php foreach ($tickets as $ticket): ?>
<div class="card-premium mb-3">
    <div class="row">
        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                    <h5 class="text-gold mb-2">
                        <i class="bi bi-ticket-detailed me-2"></i>
                        <?= htmlspecialchars($ticket['subject']) ?>
                    </h5>
                    <div class="d-flex gap-2 flex-wrap">
                        <code><?= $ticket['ticket_id'] ?></code>
                        <span class="badge badge-gold"><?= $ticket['category'] ?></span>
                        <?php
                        $status_badge = match($ticket['status']) {
                            'open' => '<span class="badge bg-warning">Open</span>',
                            'in-progress' => '<span class="badge bg-info">In Progress</span>',
                            'resolved' => '<span class="badge bg-success">Resolved</span>',
                            'closed' => '<span class="badge bg-secondary">Closed</span>',
                        };
                        echo $status_badge;

                        $priority_badge = match($ticket['priority']) {
                            'urgent' => '<span class="badge bg-danger">Urgent</span>',
                            'high' => '<span class="badge bg-warning">High</span>',
                            'medium' => '<span class="badge bg-info">Medium</span>',
                            'low' => '<span class="badge bg-secondary">Low</span>',
                        };
                        echo $priority_badge;
                        ?>
                    </div>
                </div>
            </div>

            <div class="row g-3">
                <div class="col-md-4">
                    <small class="text-muted d-block">User</small>
                    <p class="text-light mb-0">
                        <?= htmlspecialchars($ticket['user']) ?>
                        <span class="badge bg-<?= $ticket['role'] === 'client' ? 'primary' : 'success' ?> ms-1">
                            <?= ucfirst($ticket['role']) ?>
                        </span>
                    </p>
                </div>
                <div class="col-md-4">
                    <small class="text-muted d-block">Created</small>
                    <p class="text-light mb-0 small"><?= timeAgo($ticket['created_at']) ?></p>
                </div>
                <div class="col-md-4">
                    <small class="text-muted d-block">Replies</small>
                    <p class="text-gold mb-0 fw-bold"><?= $ticket['replies'] ?> replies</p>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card bg-dark p-3">
                <h6 class="text-gold mb-3">Actions</h6>
                <div class="d-grid gap-2">
                    <button class="btn btn-gold btn-sm" onclick="viewTicket(<?= $ticket['id'] ?>)">
                        <i class="bi bi-eye me-2"></i>View & Reply
                    </button>

                    <?php if ($ticket['status'] === 'open'): ?>
                    <button class="btn btn-info btn-sm" onclick="assignToMe(<?= $ticket['id'] ?>)">
                        <i class="bi bi-person-check me-2"></i>Assign to Me
                    </button>
                    <?php endif; ?>

                    <?php if ($ticket['status'] === 'in-progress'): ?>
                    <button class="btn btn-success btn-sm" onclick="markResolved(<?= $ticket['id'] ?>)">
                        <i class="bi bi-check-circle me-2"></i>Mark Resolved
                    </button>
                    <?php endif; ?>

                    <button class="btn btn-outline-secondary btn-sm" onclick="closeTicket(<?= $ticket['id'] ?>)">
                        <i class="bi bi-x-circle me-2"></i>Close
                    </button>
                </div>

                <?php if ($ticket['assigned_to']): ?>
                <div class="alert alert-info mt-3 mb-0 small">
                    <i class="bi bi-person-check me-1"></i>
                    Assigned to: <strong><?= $ticket['assigned_to'] ?></strong>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

<script>
function viewTicket(id) {
    alert('Opening ticket details with conversation history');
}

function assignToMe(id) {
    if (confirm('Assign this ticket to yourself?')) {
        alert('Ticket assigned to you! Status changed to "In Progress"');
        location.reload();
    }
}

function markResolved(id) {
    if (confirm('Mark this ticket as resolved?')) {
        alert('Ticket marked as resolved!');
        location.reload();
    }
}

function closeTicket(id) {
    if (confirm('Close this ticket?')) {
        alert('Ticket closed!');
        location.reload();
    }
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
</style>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
