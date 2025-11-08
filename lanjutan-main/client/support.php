<?php
$page_id = 'support';
$pageTitle = 'Support Tickets - SITUNEO DIGITAL';
$pageDescription = 'Get help from our support team';
$pageHeading = 'Support Tickets';

include __DIR__ . '/../includes/client-header.php';

$current_user = getCurrentUser();
$filter_status = isset($_GET['status']) ? $_GET['status'] : 'all';

// Demo data for client support tickets
if (DEMO_MODE) {
    $tickets = [
        [
            'ticket_id' => 'TKT-2025-001',
            'subject' => 'Issue with website loading speed',
            'category' => 'Technical',
            'priority' => 'high',
            'status' => 'in-progress',
            'order_id' => 'ORD-2025-001',
            'created_at' => '2025-01-12 10:30:00',
            'updated_at' => '2025-01-13 14:20:00',
            'assigned_to' => 'Support Team',
            'replies_count' => 3,
            'last_reply' => 'We are investigating the issue. Will update soon.',
            'last_reply_by' => 'Admin',
            'last_reply_at' => '2025-01-13 14:20:00',
        ],
        [
            'ticket_id' => 'TKT-2025-005',
            'subject' => 'Need invoice for payment',
            'category' => 'Billing',
            'priority' => 'medium',
            'status' => 'resolved',
            'order_id' => 'ORD-2025-001',
            'created_at' => '2025-01-11 16:00:00',
            'updated_at' => '2025-01-11 17:30:00',
            'assigned_to' => 'Support Team',
            'replies_count' => 2,
            'last_reply' => 'Invoice has been sent to your email.',
            'last_reply_by' => 'Admin',
            'last_reply_at' => '2025-01-11 17:30:00',
        ],
        [
            'ticket_id' => 'TKT-2025-003',
            'subject' => 'Request for additional feature',
            'category' => 'Feature Request',
            'priority' => 'low',
            'status' => 'open',
            'order_id' => 'ORD-2025-006',
            'created_at' => '2025-01-10 09:15:00',
            'updated_at' => '2025-01-10 09:15:00',
            'assigned_to' => null,
            'replies_count' => 0,
            'last_reply' => null,
            'last_reply_by' => null,
            'last_reply_at' => null,
        ],
        [
            'ticket_id' => 'TKT-2024-180',
            'subject' => 'How to update content?',
            'category' => 'General',
            'priority' => 'medium',
            'status' => 'closed',
            'order_id' => 'ORD-2024-180',
            'created_at' => '2025-01-08 14:00:00',
            'updated_at' => '2025-01-09 10:00:00',
            'assigned_to' => 'Support Team',
            'replies_count' => 4,
            'last_reply' => 'Glad we could help! Ticket closed.',
            'last_reply_by' => 'Admin',
            'last_reply_at' => '2025-01-09 10:00:00',
        ],
    ];

    // Filter tickets
    if ($filter_status !== 'all') {
        $tickets = array_filter($tickets, function($ticket) use ($filter_status) {
            return $ticket['status'] === $filter_status;
        });
    }
}

// Stats
$all_tickets = count($tickets);
$open = count(array_filter($tickets, fn($t) => $t['status'] === 'open'));
$in_progress = count(array_filter($tickets, fn($t) => $t['status'] === 'in-progress'));
$resolved = count(array_filter($tickets, fn($t) => $t['status'] === 'resolved'));
$closed = count(array_filter($tickets, fn($t) => $t['status'] === 'closed'));

?>

<!-- Header Actions -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <p class="text-muted mb-0">Need help? Create a support ticket and our team will assist you.</p>
    </div>
    <button class="btn btn-gold" data-bs-toggle="modal" data-bs-target="#createTicketModal">
        <i class="bi bi-plus-circle me-2"></i>
        Create New Ticket
    </button>
</div>

<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-lg-2 col-md-4 col-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">All Tickets</h6>
            <h3 class="text-gold mb-0"><?= $all_tickets ?></h3>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">Open</h6>
            <h3 class="text-warning mb-0"><?= $open ?></h3>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">In Progress</h6>
            <h3 class="text-info mb-0"><?= $in_progress ?></h3>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">Resolved</h6>
            <h3 class="text-success mb-0"><?= $resolved ?></h3>
        </div>
    </div>
    <div class="col-lg-2 col-md-4 col-6">
        <div class="card-premium">
            <h6 class="text-muted mb-2">Closed</h6>
            <h3 class="text-secondary mb-0"><?= $closed ?></h3>
        </div>
    </div>
</div>

<!-- Filter Tabs -->
<div class="card-premium mb-4">
    <ul class="nav nav-pills">
        <li class="nav-item">
            <a class="nav-link <?= $filter_status === 'all' ? 'active' : '' ?>" href="?status=all">
                All (<?= $all_tickets ?>)
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $filter_status === 'open' ? 'active' : '' ?>" href="?status=open">
                Open (<?= $open ?>)
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $filter_status === 'in-progress' ? 'active' : '' ?>" href="?status=in-progress">
                In Progress (<?= $in_progress ?>)
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $filter_status === 'resolved' ? 'active' : '' ?>" href="?status=resolved">
                Resolved (<?= $resolved ?>)
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link <?= $filter_status === 'closed' ? 'active' : '' ?>" href="?status=closed">
                Closed (<?= $closed ?>)
            </a>
        </li>
    </ul>
</div>

<!-- Tickets List -->
<?php if (empty($tickets)): ?>
<div class="card-premium text-center py-5">
    <i class="bi bi-ticket-detailed display-4 text-muted mb-3"></i>
    <h5 class="text-light mb-3">No tickets found</h5>
    <p class="text-muted mb-4">
        <?php if ($filter_status !== 'all'): ?>
            No <?= $filter_status ?> tickets. <a href="?status=all" class="text-gold">View all tickets</a>
        <?php else: ?>
            You haven't created any support tickets yet.
        <?php endif; ?>
    </p>
    <button class="btn btn-gold" data-bs-toggle="modal" data-bs-target="#createTicketModal">
        <i class="bi bi-plus-circle me-2"></i>
        Create Your First Ticket
    </button>
</div>
<?php else: ?>

<?php foreach ($tickets as $ticket): ?>
<div class="card-premium mb-3 ticket-card">
    <div class="row">
        <!-- Left: Ticket Info -->
        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="flex-grow-1">
                    <h5 class="text-gold mb-2">
                        <i class="bi bi-ticket-detailed me-2"></i>
                        <?= htmlspecialchars($ticket['subject']) ?>
                    </h5>
                    <div class="d-flex gap-2 flex-wrap align-items-center">
                        <code class="text-muted"><?= $ticket['ticket_id'] ?></code>

                        <?php
                        $status_badge = match($ticket['status']) {
                            'open' => '<span class="badge bg-warning">Open</span>',
                            'in-progress' => '<span class="badge bg-info">In Progress</span>',
                            'resolved' => '<span class="badge bg-success">Resolved</span>',
                            'closed' => '<span class="badge bg-secondary">Closed</span>',
                            default => '<span class="badge bg-secondary">Unknown</span>'
                        };
                        echo $status_badge;
                        ?>

                        <span class="badge badge-gold"><?= $ticket['category'] ?></span>

                        <?php
                        $priority_badge = match($ticket['priority']) {
                            'urgent' => '<span class="badge bg-danger">Urgent</span>',
                            'high' => '<span class="badge bg-warning">High</span>',
                            'medium' => '<span class="badge bg-info">Medium</span>',
                            'low' => '<span class="badge bg-secondary">Low</span>',
                            default => '<span class="badge bg-secondary">Unknown</span>'
                        };
                        echo $priority_badge;
                        ?>

                        <?php if ($ticket['order_id']): ?>
                        <span class="badge bg-dark">
                            <i class="bi bi-link me-1"></i>
                            <?= $ticket['order_id'] ?>
                        </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <!-- Last Reply -->
            <?php if ($ticket['last_reply']): ?>
            <div class="card bg-dark p-3 mb-3">
                <small class="text-muted mb-2">
                    <i class="bi bi-chat-left-text me-1"></i>
                    Last reply by <strong class="text-gold"><?= $ticket['last_reply_by'] ?></strong>
                    - <?= timeAgo($ticket['last_reply_at']) ?>
                </small>
                <p class="text-light mb-0 small"><?= htmlspecialchars($ticket['last_reply']) ?></p>
            </div>
            <?php else: ?>
            <div class="alert alert-warning mb-3">
                <i class="bi bi-clock me-1"></i>
                Waiting for support team response...
            </div>
            <?php endif; ?>

            <!-- Ticket Meta -->
            <div class="row g-3">
                <div class="col-md-4">
                    <small class="text-muted d-block mb-1">
                        <i class="bi bi-calendar me-1"></i>Created
                    </small>
                    <p class="text-light mb-0 small"><?= timeAgo($ticket['created_at']) ?></p>
                </div>
                <div class="col-md-4">
                    <small class="text-muted d-block mb-1">
                        <i class="bi bi-clock-history me-1"></i>Last Update
                    </small>
                    <p class="text-light mb-0 small"><?= timeAgo($ticket['updated_at']) ?></p>
                </div>
                <div class="col-md-4">
                    <small class="text-muted d-block mb-1">
                        <i class="bi bi-chat-dots me-1"></i>Replies
                    </small>
                    <p class="text-gold mb-0 small fw-bold"><?= $ticket['replies_count'] ?> replies</p>
                </div>
            </div>
        </div>

        <!-- Right: Actions -->
        <div class="col-lg-4">
            <div class="card bg-dark p-3 h-100">
                <h6 class="text-gold mb-3">
                    <i class="bi bi-lightning me-2"></i>
                    Actions
                </h6>

                <div class="d-grid gap-2">
                    <button class="btn btn-gold btn-sm" onclick="viewTicket('<?= $ticket['ticket_id'] ?>')">
                        <i class="bi bi-eye me-2"></i>
                        View Conversation
                    </button>

                    <?php if ($ticket['status'] !== 'closed'): ?>
                    <button class="btn btn-outline-info btn-sm" onclick="replyTicket('<?= $ticket['ticket_id'] ?>')">
                        <i class="bi bi-reply me-2"></i>
                        Add Reply
                    </button>
                    <?php endif; ?>

                    <?php if ($ticket['status'] === 'resolved'): ?>
                    <button class="btn btn-outline-success btn-sm" onclick="closeTicket('<?= $ticket['ticket_id'] ?>')">
                        <i class="bi bi-check-circle me-2"></i>
                        Close Ticket
                    </button>
                    <?php endif; ?>

                    <a href="https://wa.me/6283173868915?text=Ticket%20<?= $ticket['ticket_id'] ?>" target="_blank" class="btn btn-outline-success btn-sm">
                        <i class="bi bi-whatsapp me-2"></i>
                        WhatsApp Support
                    </a>
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

<?php endif; ?>

<!-- Create Ticket Modal -->
<div class="modal fade" id="createTicketModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-dark">
            <div class="modal-header border-gold">
                <h5 class="modal-title text-gold">
                    <i class="bi bi-plus-circle me-2"></i>
                    Create New Support Ticket
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="createTicketForm">
                    <!-- Subject -->
                    <div class="mb-3">
                        <label class="form-label text-light">Subject <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="ticketSubject" placeholder="Brief description of your issue" required>
                    </div>

                    <!-- Category -->
                    <div class="mb-3">
                        <label class="form-label text-light">Category <span class="text-danger">*</span></label>
                        <select class="form-select" id="ticketCategory" required>
                            <option value="">-- Select Category --</option>
                            <option value="Technical">Technical Issue</option>
                            <option value="Billing">Billing & Payment</option>
                            <option value="General">General Question</option>
                            <option value="Feature Request">Feature Request</option>
                            <option value="Bug Report">Bug Report</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <!-- Priority -->
                    <div class="mb-3">
                        <label class="form-label text-light">Priority <span class="text-danger">*</span></label>
                        <select class="form-select" id="ticketPriority" required>
                            <option value="">-- Select Priority --</option>
                            <option value="low">Low - Can wait</option>
                            <option value="medium" selected>Medium - Normal</option>
                            <option value="high">High - Important</option>
                            <option value="urgent">Urgent - Critical</option>
                        </select>
                    </div>

                    <!-- Related Order (Optional) -->
                    <div class="mb-3">
                        <label class="form-label text-light">Related Order (Optional)</label>
                        <select class="form-select" id="ticketOrder">
                            <option value="">-- No related order --</option>
                            <option value="ORD-2025-001">ORD-2025-001 - Company Profile Website</option>
                            <option value="ORD-2025-006">ORD-2025-006 - Mobile App Development</option>
                            <option value="ORD-2025-008">ORD-2025-008 - E-Commerce Website</option>
                        </select>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label class="form-label text-light">Description <span class="text-danger">*</span></label>
                        <textarea class="form-control" id="ticketDescription" rows="5" placeholder="Please describe your issue in detail..." required></textarea>
                        <small class="text-muted">Provide as much detail as possible to help us assist you better.</small>
                    </div>

                    <!-- Attachment -->
                    <div class="mb-3">
                        <label class="form-label text-light">Attachment (Optional)</label>
                        <input type="file" class="form-control" id="ticketAttachment" accept="image/*,.pdf,.doc,.docx">
                        <small class="text-muted">Max 5MB - Images, PDF, or Documents</small>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-gold">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-gold" onclick="submitTicket()">
                    <i class="bi bi-send me-2"></i>
                    Submit Ticket
                </button>
            </div>
        </div>
    </div>
</div>

<!-- View Ticket Modal -->
<div class="modal fade" id="viewTicketModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-dark">
            <div class="modal-header border-gold">
                <h5 class="modal-title text-gold" id="viewTicketTitle">
                    <i class="bi bi-ticket-detailed me-2"></i>
                    Loading...
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="viewTicketContent" style="max-height: 500px; overflow-y: auto;">
                <!-- Conversation will be loaded here -->
            </div>
            <div class="modal-footer border-gold">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
let createTicketModal, viewTicketModal;

document.addEventListener('DOMContentLoaded', function() {
    createTicketModal = new bootstrap.Modal(document.getElementById('createTicketModal'));
    viewTicketModal = new bootstrap.Modal(document.getElementById('viewTicketModal'));
});

function submitTicket() {
    const subject = document.getElementById('ticketSubject').value;
    const category = document.getElementById('ticketCategory').value;
    const priority = document.getElementById('ticketPriority').value;
    const description = document.getElementById('ticketDescription').value;

    if (!subject || !category || !priority || !description) {
        alert('Please fill all required fields');
        return;
    }

    // In real implementation, submit via AJAX
    alert('Ticket created successfully! Our team will respond within 24 hours.');
    createTicketModal.hide();
    document.getElementById('createTicketForm').reset();
    location.reload();
}

function viewTicket(ticketId) {
    // Demo conversation data
    const conversations = {
        'TKT-2025-001': [
            { from: 'You', message: 'The website is loading very slowly. It takes more than 10 seconds to load.', time: '2025-01-12 10:30:00', type: 'client' },
            { from: 'Support Team', message: 'Thank you for reporting this. We are investigating the issue. Can you tell us which pages are slow?', time: '2025-01-12 14:00:00', type: 'admin' },
            { from: 'You', message: 'The homepage and services page are the slowest.', time: '2025-01-13 09:00:00', type: 'client' },
            { from: 'Support Team', message: 'We are investigating the issue. Will update soon.', time: '2025-01-13 14:20:00', type: 'admin' },
        ],
    };

    const conversation = conversations[ticketId] || [];
    const ticket = <?= json_encode($tickets) ?>.find(t => t.ticket_id === ticketId);

    document.getElementById('viewTicketTitle').textContent = ticket.subject;

    let html = '<div class="conversation">';
    conversation.forEach(msg => {
        html += `
            <div class="message ${msg.type === 'client' ? 'message-client' : 'message-admin'} mb-3">
                <div class="d-flex align-items-start gap-3">
                    <div class="avatar">
                        <i class="bi ${msg.type === 'client' ? 'bi-person-circle' : 'bi-headset'} text-gold" style="font-size: 2rem;"></i>
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <strong class="text-gold">${msg.from}</strong>
                            <small class="text-muted">${formatDateTime(msg.time)}</small>
                        </div>
                        <div class="card ${msg.type === 'client' ? 'bg-primary' : 'bg-secondary'} bg-opacity-25 p-3">
                            <p class="text-light mb-0">${msg.message}</p>
                        </div>
                    </div>
                </div>
            </div>
        `;
    });
    html += '</div>';

    document.getElementById('viewTicketContent').innerHTML = html;
    viewTicketModal.show();
}

function replyTicket(ticketId) {
    alert(`Reply feature coming soon!\n\nFor now, please use WhatsApp to communicate with our support team.`);
}

function closeTicket(ticketId) {
    if (confirm('Are you sure you want to close this ticket? You can reopen it later if needed.')) {
        alert(`Ticket ${ticketId} has been closed.`);
        location.reload();
    }
}

function formatDateTime(dateString) {
    const date = new Date(dateString);
    const options = { year: 'numeric', month: 'short', day: 'numeric', hour: '2-digit', minute: '2-digit' };
    return date.toLocaleDateString('en-US', options);
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

.ticket-card {
    transition: all 0.3s ease;
}

.ticket-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(212, 175, 55, 0.2);
}

.conversation .message {
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
