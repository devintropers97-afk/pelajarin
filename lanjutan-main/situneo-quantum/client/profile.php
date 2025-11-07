<?php
$page_id = 'profile';
$pageTitle = 'My Profile - SITUNEO DIGITAL';
$pageDescription = 'Manage your account settings';
$pageHeading = 'My Profile';

include __DIR__ . '/../includes/client-header.php';

$current_user = getCurrentUser();

// Recent activity (demo data)
$recent_activity = [
    ['action' => 'Uploaded payment proof', 'time' => '2025-01-13 14:30:00', 'icon' => 'upload', 'color' => 'success'],
    ['action' => 'Created support ticket TKT-2025-001', 'time' => '2025-01-12 10:30:00', 'icon' => 'ticket-detailed', 'color' => 'warning'],
    ['action' => 'Logged in from 192.168.1.1', 'time' => '2025-01-12 09:00:00', 'icon' => 'box-arrow-in-right', 'color' => 'info'],
    ['action' => 'Updated profile information', 'time' => '2025-01-10 16:20:00', 'icon' => 'person-check', 'color' => 'primary'],
    ['action' => 'Requested demo for website', 'time' => '2025-01-09 11:00:00', 'icon' => 'rocket-takeoff', 'color' => 'gold'],
];

?>

<div class="row g-4">
    <!-- Left Column: Profile Forms -->
    <div class="col-lg-8">
        <!-- Personal Information -->
        <div class="card-premium mb-4">
            <h5 class="text-gold mb-4">
                <i class="bi bi-person me-2"></i>
                Personal Information
            </h5>

            <form id="personalInfoForm">
                <div class="row g-3">
                    <!-- Avatar Upload -->
                    <div class="col-12">
                        <div class="d-flex align-items-center gap-4 mb-3">
                            <div class="avatar-large">
                                <img id="avatarPreview" src="https://ui-avatars.com/api/?name=<?= urlencode($current_user['full_name']) ?>&size=120&background=FFB400&color=0F3057&bold=true" alt="Avatar" class="rounded-circle" style="width: 120px; height: 120px; object-fit: cover; border: 3px solid var(--gold);">
                            </div>
                            <div>
                                <h6 class="text-light mb-2">Profile Photo</h6>
                                <input type="file" class="form-control form-control-sm mb-2" id="avatarFile" accept="image/*">
                                <small class="text-muted">JPG, PNG or GIF (Max 2MB)</small>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-light">Full Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="fullName" value="<?= htmlspecialchars($current_user['full_name']) ?>" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-light">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" value="<?= htmlspecialchars($current_user['email']) ?>" required>
                        <small class="text-success">
                            <i class="bi bi-check-circle me-1"></i>
                            Verified
                        </small>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-light">Phone / WhatsApp</label>
                        <input type="tel" class="form-control" id="phone" value="<?= htmlspecialchars($current_user['phone'] ?? '') ?>" placeholder="08xxxx">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-light">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" value="1990-01-01">
                    </div>

                    <div class="col-12">
                        <label class="form-label text-light">Address</label>
                        <textarea class="form-control" id="address" rows="2" placeholder="Your full address"><?= htmlspecialchars($current_user['address'] ?? '') ?></textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-light">City</label>
                        <input type="text" class="form-control" id="city" placeholder="e.g. Jakarta">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-light">Province</label>
                        <select class="form-select" id="province">
                            <option value="">-- Select Province --</option>
                            <option value="DKI Jakarta">DKI Jakarta</option>
                            <option value="Jawa Barat">Jawa Barat</option>
                            <option value="Jawa Tengah">Jawa Tengah</option>
                            <option value="Jawa Timur">Jawa Timur</option>
                            <option value="Banten">Banten</option>
                            <option value="Bali">Bali</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-gold">
                        <i class="bi bi-save me-2"></i>
                        Save Changes
                    </button>
                </div>
            </form>
        </div>

        <!-- Company Information (Optional) -->
        <div class="card-premium mb-4">
            <h5 class="text-gold mb-4">
                <i class="bi bi-building me-2"></i>
                Company Information <span class="badge bg-secondary ms-2">Optional</span>
            </h5>

            <form id="companyInfoForm">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label text-light">Company Name</label>
                        <input type="text" class="form-control" id="companyName" placeholder="Your company name">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-light">Company Type</label>
                        <select class="form-select" id="companyType">
                            <option value="">-- Select Type --</option>
                            <option value="PT">PT (Perseroan Terbatas)</option>
                            <option value="CV">CV (Commanditaire Vennootschap)</option>
                            <option value="UD">UD (Usaha Dagang)</option>
                            <option value="Perorangan">Perorangan</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-light">NPWP (Tax ID)</label>
                        <input type="text" class="form-control" id="npwp" placeholder="XX.XXX.XXX.X-XXX.XXX">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label text-light">NIB (Business ID)</label>
                        <input type="text" class="form-control" id="nib" placeholder="Business identification number">
                    </div>

                    <div class="col-12">
                        <label class="form-label text-light">Company Address</label>
                        <textarea class="form-control" id="companyAddress" rows="2" placeholder="Company address"></textarea>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-gold">
                        <i class="bi bi-save me-2"></i>
                        Save Company Info
                    </button>
                </div>
            </form>
        </div>

        <!-- Change Password -->
        <div class="card-premium mb-4">
            <h5 class="text-gold mb-4">
                <i class="bi bi-shield-lock me-2"></i>
                Change Password
            </h5>

            <form id="changePasswordForm">
                <div class="row g-3">
                    <div class="col-12">
                        <label class="form-label text-light">Current Password <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="currentPassword" required>
                            <button class="btn btn-outline-gold" type="button" onclick="togglePassword('currentPassword')">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label text-light">New Password <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="newPassword" required>
                            <button class="btn btn-outline-gold" type="button" onclick="togglePassword('newPassword')">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        <div class="progress mt-2" style="height: 5px;">
                            <div class="progress-bar" id="passwordStrengthBar" role="progressbar" style="width: 0%"></div>
                        </div>
                        <small class="text-muted" id="passwordStrengthText">Password strength: Weak</small>
                    </div>

                    <div class="col-12">
                        <label class="form-label text-light">Confirm New Password <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="confirmPassword" required>
                            <button class="btn btn-outline-gold" type="button" onclick="togglePassword('confirmPassword')">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                        <small class="text-muted" id="passwordMatchText"></small>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-key me-2"></i>
                        Update Password
                    </button>
                </div>
            </form>
        </div>

        <!-- Account Settings -->
        <div class="card-premium mb-4">
            <h5 class="text-gold mb-4">
                <i class="bi bi-gear me-2"></i>
                Account Settings
            </h5>

            <form id="accountSettingsForm">
                <!-- Email Notifications -->
                <div class="mb-4">
                    <h6 class="text-light mb-3">Email Notifications</h6>
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="notifyOrders" checked>
                        <label class="form-check-label text-light" for="notifyOrders">
                            Order updates and status changes
                        </label>
                    </div>
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="notifyPayments" checked>
                        <label class="form-check-label text-light" for="notifyPayments">
                            Payment confirmations
                        </label>
                    </div>
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="notifySupport" checked>
                        <label class="form-check-label text-light" for="notifySupport">
                            Support ticket replies
                        </label>
                    </div>
                    <div class="form-check form-switch mb-2">
                        <input class="form-check-input" type="checkbox" id="notifyPromotions">
                        <label class="form-check-label text-light" for="notifyPromotions">
                            Promotions and special offers
                        </label>
                    </div>
                </div>

                <!-- Language & Display -->
                <div class="mb-4">
                    <h6 class="text-light mb-3">Language & Display</h6>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label text-light">Language</label>
                            <select class="form-select" id="language">
                                <option value="id" selected>Bahasa Indonesia</option>
                                <option value="en">English</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-light">Timezone</label>
                            <select class="form-select" id="timezone">
                                <option value="Asia/Jakarta" selected>WIB (Jakarta)</option>
                                <option value="Asia/Makassar">WITA (Makassar)</option>
                                <option value="Asia/Jayapura">WIT (Jayapura)</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <button type="submit" class="btn btn-gold">
                        <i class="bi bi-save me-2"></i>
                        Save Settings
                    </button>
                </div>
            </form>
        </div>

        <!-- Danger Zone -->
        <div class="card-premium border-danger">
            <h5 class="text-danger mb-4">
                <i class="bi bi-exclamation-triangle me-2"></i>
                Danger Zone
            </h5>

            <div class="alert alert-danger">
                <strong>Warning:</strong> These actions are irreversible. Please proceed with caution.
            </div>

            <div class="d-flex gap-2">
                <button class="btn btn-outline-danger" onclick="deactivateAccount()">
                    <i class="bi bi-pause-circle me-2"></i>
                    Deactivate Account
                </button>
                <button class="btn btn-danger" onclick="deleteAccount()">
                    <i class="bi bi-trash me-2"></i>
                    Delete Account
                </button>
            </div>
        </div>
    </div>

    <!-- Right Column: Stats & Activity -->
    <div class="col-lg-4">
        <!-- Account Stats -->
        <div class="card-premium mb-4">
            <h6 class="text-gold mb-3">
                <i class="bi bi-graph-up me-2"></i>
                Account Statistics
            </h6>

            <div class="stat-item mb-3 pb-3 border-bottom border-gold border-opacity-25">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted d-block">Member Since</small>
                        <strong class="text-light"><?= date('d M Y', strtotime($current_user['created_at'])) ?></strong>
                    </div>
                    <i class="bi bi-calendar-check text-gold fs-3"></i>
                </div>
            </div>

            <div class="stat-item mb-3 pb-3 border-bottom border-gold border-opacity-25">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted d-block">Total Orders</small>
                        <strong class="text-light">3 Orders</strong>
                    </div>
                    <i class="bi bi-cart-check text-gold fs-3"></i>
                </div>
            </div>

            <div class="stat-item mb-3 pb-3 border-bottom border-gold border-opacity-25">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted d-block">Total Spent</small>
                        <strong class="text-light">Rp 3.500.000</strong>
                    </div>
                    <i class="bi bi-cash-stack text-gold fs-3"></i>
                </div>
            </div>

            <div class="stat-item">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted d-block">Support Tickets</small>
                        <strong class="text-light">4 Tickets</strong>
                    </div>
                    <i class="bi bi-ticket-detailed text-gold fs-3"></i>
                </div>
            </div>
        </div>

        <!-- Account Status -->
        <div class="card-premium mb-4">
            <h6 class="text-gold mb-3">
                <i class="bi bi-shield-check me-2"></i>
                Account Status
            </h6>

            <div class="d-flex align-items-center gap-3 mb-3">
                <i class="bi bi-check-circle-fill text-success fs-4"></i>
                <div>
                    <strong class="text-light d-block">Email Verified</strong>
                    <small class="text-muted"><?= $current_user['email'] ?></small>
                </div>
            </div>

            <div class="d-flex align-items-center gap-3 mb-3">
                <i class="bi bi-check-circle-fill text-success fs-4"></i>
                <div>
                    <strong class="text-light d-block">Phone Verified</strong>
                    <small class="text-muted"><?= $current_user['phone'] ?? 'Not set' ?></small>
                </div>
            </div>

            <div class="d-flex align-items-center gap-3">
                <i class="bi bi-x-circle-fill text-warning fs-4"></i>
                <div>
                    <strong class="text-light d-block">Two-Factor Auth</strong>
                    <small class="text-muted">Not enabled</small>
                    <a href="#" class="text-gold small d-block">Enable Now</a>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="card-premium">
            <h6 class="text-gold mb-3">
                <i class="bi bi-clock-history me-2"></i>
                Recent Activity
            </h6>

            <?php foreach ($recent_activity as $activity): ?>
            <div class="activity-item mb-3 pb-3 border-bottom border-gold border-opacity-25">
                <div class="d-flex gap-3">
                    <div class="activity-icon">
                        <i class="bi bi-<?= $activity['icon'] ?> text-<?= $activity['color'] ?> fs-5"></i>
                    </div>
                    <div class="flex-grow-1">
                        <p class="text-light mb-1 small"><?= $activity['action'] ?></p>
                        <small class="text-muted"><?= timeAgo($activity['time']) ?></small>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>

            <a href="#" class="text-gold small">
                View All Activity <i class="bi bi-arrow-right ms-1"></i>
            </a>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Avatar preview
    document.getElementById('avatarFile').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            if (file.size > 2 * 1024 * 1024) {
                alert('File size must be less than 2MB');
                this.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('avatarPreview').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    // Personal info form
    document.getElementById('personalInfoForm').addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Profile updated successfully!');
    });

    // Company info form
    document.getElementById('companyInfoForm').addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Company information saved successfully!');
    });

    // Change password form
    document.getElementById('changePasswordForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const newPassword = document.getElementById('newPassword').value;
        const confirmPassword = document.getElementById('confirmPassword').value;

        if (newPassword !== confirmPassword) {
            alert('Passwords do not match!');
            return;
        }

        alert('Password changed successfully! Please login again.');
    });

    // Account settings form
    document.getElementById('accountSettingsForm').addEventListener('submit', function(e) {
        e.preventDefault();
        alert('Settings saved successfully!');
    });

    // Password strength checker
    document.getElementById('newPassword').addEventListener('input', function(e) {
        const password = e.target.value;
        let strength = 0;

        if (password.length >= 8) strength += 25;
        if (password.length >= 12) strength += 25;
        if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength += 25;
        if (/[0-9]/.test(password)) strength += 12.5;
        if (/[^A-Za-z0-9]/.test(password)) strength += 12.5;

        const bar = document.getElementById('passwordStrengthBar');
        const text = document.getElementById('passwordStrengthText');

        bar.style.width = strength + '%';

        if (strength < 25) {
            bar.className = 'progress-bar bg-danger';
            text.textContent = 'Password strength: Very Weak';
            text.className = 'text-danger';
        } else if (strength < 50) {
            bar.className = 'progress-bar bg-warning';
            text.textContent = 'Password strength: Weak';
            text.className = 'text-warning';
        } else if (strength < 75) {
            bar.className = 'progress-bar bg-info';
            text.textContent = 'Password strength: Medium';
            text.className = 'text-info';
        } else {
            bar.className = 'progress-bar bg-success';
            text.textContent = 'Password strength: Strong';
            text.className = 'text-success';
        }
    });

    // Password match checker
    document.getElementById('confirmPassword').addEventListener('input', function(e) {
        const newPassword = document.getElementById('newPassword').value;
        const confirmPassword = e.target.value;
        const text = document.getElementById('passwordMatchText');

        if (confirmPassword.length > 0) {
            if (newPassword === confirmPassword) {
                text.textContent = '✓ Passwords match';
                text.className = 'text-success';
            } else {
                text.textContent = '✗ Passwords do not match';
                text.className = 'text-danger';
            }
        } else {
            text.textContent = '';
        }
    });
});

function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const btn = event.target.closest('button');
    const icon = btn.querySelector('i');

    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    }
}

function deactivateAccount() {
    if (confirm('Are you sure you want to deactivate your account? You can reactivate it by logging in again.')) {
        alert('Account deactivated. You will be logged out now.');
        // Redirect to logout
    }
}

function deleteAccount() {
    const confirmation = prompt('This action is irreversible. Type "DELETE" to confirm:');
    if (confirmation === 'DELETE') {
        alert('Account deletion request submitted. Our team will process it within 7 days.');
    }
}
</script>

<style>
.form-check-input:checked {
    background-color: var(--gold);
    border-color: var(--gold);
}

.form-check-input:focus {
    border-color: var(--gold);
    box-shadow: 0 0 0 0.25rem rgba(212, 175, 55, 0.25);
}

.activity-item:last-child {
    border-bottom: none !important;
    padding-bottom: 0 !important;
    margin-bottom: 0 !important;
}

.border-danger {
    border: 2px solid #dc3545 !important;
}
</style>

<?php include __DIR__ . '/../includes/admin-footer.php'; ?>
