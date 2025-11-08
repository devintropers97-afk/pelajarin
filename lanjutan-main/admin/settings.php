<?php
$page_id = 'settings';
$pageTitle = 'System Settings - SITUNEO DIGITAL';
$pageDescription = 'Manage system settings';
$pageHeading = 'System Settings';

include __DIR__ . '/../includes/admin-header.php';

?>

<div class="row g-4">
    <!-- General Settings -->
    <div class="col-lg-6">
        <div class="card-premium">
            <h5 class="text-gold mb-4">
                <i class="bi bi-gear me-2"></i>
                General Settings
            </h5>
            <form id="generalSettings">
                <div class="mb-3">
                    <label class="form-label text-light">Site Name</label>
                    <input type="text" class="form-control" value="SITUNEO DIGITAL">
                </div>
                <div class="mb-3">
                    <label class="form-label text-light">Site Tagline</label>
                    <input type="text" class="form-control" value="Digital Agency & Web Development">
                </div>
                <div class="mb-3">
                    <label class="form-label text-light">Admin Email</label>
                    <input type="email" class="form-control" value="admin@situneo.my.id">
                </div>
                <div class="mb-3">
                    <label class="form-label text-light">WhatsApp Number</label>
                    <input type="tel" class="form-control" value="083173868915">
                </div>
                <div class="mb-3">
                    <label class="form-label text-light">Company Address</label>
                    <textarea class="form-control" rows="2">Jl. Example Street No. 123, Jakarta</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label text-light">NIB (Business License)</label>
                    <input type="text" class="form-control" value="20250926145704515453">
                </div>
                <button type="submit" class="btn btn-gold">
                    <i class="bi bi-save me-2"></i>Save Changes
                </button>
            </form>
        </div>
    </div>

    <!-- Commission Settings -->
    <div class="col-lg-6">
        <div class="card-premium">
            <h5 class="text-gold mb-4">
                <i class="bi bi-percent me-2"></i>
                Commission Settings
            </h5>
            <form id="commissionSettings">
                <div class="mb-3">
                    <label class="form-label text-light">Tier 1 - STARTER</label>
                    <div class="input-group">
                        <input type="number" class="form-control" value="30">
                        <span class="input-group-text">%</span>
                    </div>
                    <small class="text-muted">0-10 orders/month</small>
                </div>
                <div class="mb-3">
                    <label class="form-label text-light">Tier 2 - PRO</label>
                    <div class="input-group">
                        <input type="number" class="form-control" value="40">
                        <span class="input-group-text">%</span>
                    </div>
                    <small class="text-muted">10-50 orders/month</small>
                </div>
                <div class="mb-3">
                    <label class="form-label text-light">Tier 3 - EXPERT</label>
                    <div class="input-group">
                        <input type="number" class="form-control" value="50">
                        <span class="input-group-text">%</span>
                    </div>
                    <small class="text-muted">50+ orders/month</small>
                </div>
                <div class="mb-3">
                    <label class="form-label text-light">Tier 3 Bonus</label>
                    <div class="input-group">
                        <input type="number" class="form-control" value="5">
                        <span class="input-group-text">%</span>
                    </div>
                    <small class="text-muted">Additional bonus for Tier 3</small>
                </div>
                <button type="submit" class="btn btn-gold">
                    <i class="bi bi-save me-2"></i>Save Changes
                </button>
            </form>
        </div>
    </div>

    <!-- Calculator Discount Settings -->
    <div class="col-lg-6">
        <div class="card-premium">
            <h5 class="text-gold mb-4">
                <i class="bi bi-calculator me-2"></i>
                Calculator Discount
            </h5>
            <form id="discountSettings">
                <div class="mb-3">
                    <label class="form-label text-light">Discount for 3+ Services</label>
                    <div class="input-group">
                        <input type="number" class="form-control" value="10">
                        <span class="input-group-text">%</span>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label text-light">Discount for 5+ Services</label>
                    <div class="input-group">
                        <input type="number" class="form-control" value="15">
                        <span class="input-group-text">%</span>
                    </div>
                </div>
                <button type="submit" class="btn btn-gold">
                    <i class="bi bi-save me-2"></i>Save Changes
                </button>
            </form>
        </div>
    </div>

    <!-- Email Settings -->
    <div class="col-lg-6">
        <div class="card-premium">
            <h5 class="text-gold mb-4">
                <i class="bi bi-envelope me-2"></i>
                Email Settings (SMTP)
            </h5>
            <form id="emailSettings">
                <div class="mb-3">
                    <label class="form-label text-light">SMTP Host</label>
                    <input type="text" class="form-control" value="mail.situneo.my.id">
                </div>
                <div class="mb-3">
                    <label class="form-label text-light">SMTP Port</label>
                    <input type="number" class="form-control" value="587">
                </div>
                <div class="mb-3">
                    <label class="form-label text-light">SMTP Username</label>
                    <input type="email" class="form-control" value="noreply@situneo.my.id">
                </div>
                <div class="mb-3">
                    <label class="form-label text-light">SMTP Password</label>
                    <input type="password" class="form-control" value="********">
                </div>
                <div class="mb-3">
                    <label class="form-label text-light">From Name</label>
                    <input type="text" class="form-control" value="SITUNEO DIGITAL">
                </div>
                <button type="submit" class="btn btn-gold">
                    <i class="bi bi-save me-2"></i>Save Changes
                </button>
                <button type="button" class="btn btn-outline-info" onclick="testEmail()">
                    <i class="bi bi-send me-2"></i>Test Email
                </button>
            </form>
        </div>
    </div>

    <!-- Payment Gateway Settings -->
    <div class="col-lg-6">
        <div class="card-premium">
            <h5 class="text-gold mb-4">
                <i class="bi bi-credit-card me-2"></i>
                Payment Gateway
            </h5>
            <form id="paymentSettings">
                <h6 class="text-light mb-3">Bank Transfer</h6>
                <div class="mb-3">
                    <label class="form-label text-light">BCA Account</label>
                    <input type="text" class="form-control" value="1234567890">
                </div>
                <div class="mb-3">
                    <label class="form-label text-light">Mandiri Account</label>
                    <input type="text" class="form-control" value="9876543210">
                </div>

                <h6 class="text-light mb-3 mt-4">E-Wallet</h6>
                <div class="mb-3">
                    <label class="form-label text-light">GoPay/OVO/Dana Number</label>
                    <input type="tel" class="form-control" value="083173868915">
                </div>

                <button type="submit" class="btn btn-gold">
                    <i class="bi bi-save me-2"></i>Save Changes
                </button>
            </form>
        </div>
    </div>

    <!-- System Preferences -->
    <div class="col-lg-6">
        <div class="card-premium">
            <h5 class="text-gold mb-4">
                <i class="bi bi-sliders me-2"></i>
                System Preferences
            </h5>
            <form id="systemSettings">
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="demoMode" checked>
                        <label class="form-check-label text-light" for="demoMode">
                            Demo Mode (Show demo data)
                        </label>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="maintenance">
                        <label class="form-check-label text-light" for="maintenance">
                            Maintenance Mode
                        </label>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="registration" checked>
                        <label class="form-check-label text-light" for="registration">
                            Allow User Registration
                        </label>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="notifications" checked>
                        <label class="form-check-label text-light" for="notifications">
                            Email Notifications
                        </label>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label text-light">Session Timeout (minutes)</label>
                    <input type="number" class="form-control" value="60">
                </div>
                <div class="mb-3">
                    <label class="form-label text-light">Max Upload Size (MB)</label>
                    <input type="number" class="form-control" value="5">
                </div>
                <button type="submit" class="btn btn-gold">
                    <i class="bi bi-save me-2"></i>Save Changes
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Danger Zone -->
<div class="card-premium mt-4 border-danger">
    <h5 class="text-danger mb-4">
        <i class="bi bi-exclamation-triangle me-2"></i>
        Danger Zone
    </h5>
    <div class="alert alert-danger">
        <strong>Warning:</strong> These actions are irreversible. Please proceed with extreme caution.
    </div>
    <div class="d-flex gap-2">
        <button class="btn btn-outline-danger" onclick="clearCache()">
            <i class="bi bi-trash me-2"></i>
            Clear Cache
        </button>
        <button class="btn btn-outline-danger" onclick="resetDemo()">
            <i class="bi bi-arrow-counterclockwise me-2"></i>
            Reset Demo Data
        </button>
        <button class="btn btn-danger" onclick="clearDatabase()">
            <i class="bi bi-database-x me-2"></i>
            Clear All Database
        </button>
    </div>
</div>

<script>
document.getElementById('generalSettings').addEventListener('submit', function(e) {
    e.preventDefault();
    alert('General settings saved!');
});

document.getElementById('commissionSettings').addEventListener('submit', function(e) {
    e.preventDefault();
    alert('Commission settings saved!');
});

document.getElementById('discountSettings').addEventListener('submit', function(e) {
    e.preventDefault();
    alert('Discount settings saved!');
});

document.getElementById('emailSettings').addEventListener('submit', function(e) {
    e.preventDefault();
    alert('Email settings saved!');
});

document.getElementById('paymentSettings').addEventListener('submit', function(e) {
    e.preventDefault();
    alert('Payment settings saved!');
});

document.getElementById('systemSettings').addEventListener('submit', function(e) {
    e.preventDefault();
    alert('System settings saved!');
});

function testEmail() {
    alert('Sending test email to admin@situneo.my.id...\n\nTest email sent successfully!');
}

function clearCache() {
    if (confirm('Clear all cache?')) {
        alert('Cache cleared!');
    }
}

function resetDemo() {
    if (confirm('Reset all demo data to default?')) {
        alert('Demo data reset!');
    }
}

function clearDatabase() {
    const confirmation = prompt('This will DELETE ALL DATA! Type "DELETE ALL" to confirm:');
    if (confirmation === 'DELETE ALL') {
        alert('Database cleared! All data has been deleted.');
    }
}
</script>

<style>
.form-check-input:checked {
    background-color: var(--gold);
    border-color: var(--gold);
}

.border-danger {
    border: 2px solid #dc3545 !important;
}
</style>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
