<?php
/**
 * Freelancer Dashboard - Profile Management
 * Update freelancer profile, skills, bio, portfolio links
 */

define('SITUNEO_ACCESS', true);
require_once dirname(dirname(__DIR__)) . '/config/bootstrap.php';

Auth::requireRole('freelancer');

$db = Database::getInstance();
$freelancer = Auth::user();

// Get or create freelancer profile
$profile = $db->query("SELECT * FROM freelancer_profiles WHERE user_id = :id", ['id' => $freelancer['id']])->fetch();

if (!$profile) {
    // Create profile if doesn't exist
    $db->insert('freelancer_profiles', [
        'user_id' => $freelancer['id'],
        'bio' => '',
        'skills' => '',
        'hourly_rate' => 0,
        'availability' => 'available',
        'created_at' => date('Y-m-d H:i:s')
    ]);
    $profile = $db->query("SELECT * FROM freelancer_profiles WHERE user_id = :id", ['id' => $freelancer['id']])->fetch();
}

// Handle form submission
if (is_post()) {
    $bio = post('bio');
    $skills = post('skills');
    $hourly_rate = post('hourly_rate');
    $availability = post('availability');
    $portfolio_url = post('portfolio_url');
    $linkedin_url = post('linkedin_url');
    $github_url = post('github_url');
    $behance_url = post('behance_url');

    // Update user basic info
    $db->update('users', [
        'name' => post('name'),
        'email' => post('email'),
        'phone' => post('phone'),
    ], ['id' => $freelancer['id']]);

    // Update freelancer profile
    $db->update('freelancer_profiles', [
        'bio' => $bio,
        'skills' => $skills,
        'hourly_rate' => $hourly_rate,
        'availability' => $availability,
        'portfolio_url' => $portfolio_url,
        'linkedin_url' => $linkedin_url,
        'github_url' => $github_url,
        'behance_url' => $behance_url,
        'updated_at' => date('Y-m-d H:i:s')
    ], ['user_id' => $freelancer['id']]);

    // Handle avatar upload
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === 0) {
        $upload_dir = dirname(dirname(__DIR__)) . '/uploads/avatars/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        $file_ext = pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
        $file_name = 'avatar_' . $freelancer['id'] . '_' . time() . '.' . $file_ext;
        $file_path = $upload_dir . $file_name;

        if (move_uploaded_file($_FILES['avatar']['tmp_name'], $file_path)) {
            $avatar_url = '/uploads/avatars/' . $file_name;
            $db->update('users', ['avatar' => $avatar_url], ['id' => $freelancer['id']]);
        }
    }

    Session::flashSuccess('Profile updated successfully!');
    redirect('/freelancer/profile/');
}

// Refresh user data
$freelancer = $db->query("SELECT * FROM users WHERE id = :id", ['id' => $freelancer['id']])->fetch();
$profile = $db->query("SELECT * FROM freelancer_profiles WHERE user_id = :id", ['id' => $freelancer['id']])->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Settings - SITUNEO DIGITAL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .avatar-preview {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #dee2e6;
        }
        .avatar-placeholder {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: #6c757d;
            border: 4px solid #dee2e6;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container py-5">
        <!-- Header -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2><i class="fas fa-user-edit"></i> Profile Settings</h2>
                        <p class="text-muted">Manage your freelancer profile and information</p>
                    </div>
                    <a href="/freelancer/" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left"></i> Back to Dashboard
                    </a>
                </div>
            </div>
        </div>

        <?php if (Session::hasFlash('success')): ?>
            <div class="alert alert-success alert-dismissible fade show">
                <?= Session::getFlash('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <?= csrf_field() ?>

            <div class="row">
                <!-- Left Column -->
                <div class="col-md-4">
                    <!-- Avatar -->
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <h5 class="card-title mb-3">Profile Photo</h5>

                            <?php if ($freelancer['avatar']): ?>
                                <img src="<?= esc($freelancer['avatar']) ?>" alt="Avatar" class="avatar-preview mb-3">
                            <?php else: ?>
                                <div class="avatar-placeholder mb-3">
                                    <?= strtoupper(substr($freelancer['name'], 0, 1)) ?>
                                </div>
                            <?php endif; ?>

                            <input type="file" name="avatar" class="form-control" accept="image/*">
                            <small class="text-muted d-block mt-2">Max 2MB, JPG/PNG</small>
                        </div>
                    </div>

                    <!-- Profile Completion -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h6 class="card-title">Profile Completion</h6>
                            <?php
                            $completion = 0;
                            if ($freelancer['avatar']) $completion += 20;
                            if ($profile['bio']) $completion += 20;
                            if ($profile['skills']) $completion += 20;
                            if ($profile['portfolio_url']) $completion += 20;
                            if ($profile['hourly_rate'] > 0) $completion += 20;
                            ?>
                            <div class="progress mb-2" style="height: 25px;">
                                <div class="progress-bar bg-<?= $completion >= 80 ? 'success' : ($completion >= 50 ? 'warning' : 'danger') ?>"
                                     style="width: <?= $completion ?>%">
                                    <?= $completion ?>%
                                </div>
                            </div>
                            <small class="text-muted">Complete your profile to attract more clients!</small>
                        </div>
                    </div>

                    <!-- Stats -->
                    <div class="card">
                        <div class="card-body">
                            <h6 class="card-title mb-3">Your Stats</h6>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Commission Tier</span>
                                <strong><?= $profile['tier'] ?? '1' ?></strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Commission Rate</span>
                                <strong><?= $profile['commission_rate'] ?? '30' ?>%</strong>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span>Rating</span>
                                <strong>
                                    <?= number_format($profile['rating'] ?? 0, 1) ?>
                                    <i class="fas fa-star text-warning"></i>
                                </strong>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span>Total Earnings</span>
                                <strong>Rp <?= number_format($profile['total_earnings'] ?? 0) ?></strong>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="col-md-8">
                    <!-- Basic Information -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fas fa-info-circle"></i> Basic Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Full Name *</label>
                                    <input type="text" name="name" class="form-control" value="<?= esc($freelancer['name']) ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email Address *</label>
                                    <input type="email" name="email" class="form-control" value="<?= esc($freelancer['email']) ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text" name="phone" class="form-control" value="<?= esc($freelancer['phone'] ?? '') ?>" placeholder="+62xxx">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Availability Status</label>
                                    <select name="availability" class="form-select">
                                        <option value="available" <?= $profile['availability'] === 'available' ? 'selected' : '' ?>>Available for Work</option>
                                        <option value="busy" <?= $profile['availability'] === 'busy' ? 'selected' : '' ?>>Busy</option>
                                        <option value="unavailable" <?= $profile['availability'] === 'unavailable' ? 'selected' : '' ?>>Unavailable</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Professional Information -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fas fa-briefcase"></i> Professional Information</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Professional Bio</label>
                                <textarea name="bio" class="form-control" rows="4" placeholder="Tell clients about yourself, your experience, and expertise..."><?= esc($profile['bio'] ?? '') ?></textarea>
                                <small class="text-muted">Write a compelling bio to attract clients (max 500 characters)</small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Skills & Expertise</label>
                                <textarea name="skills" class="form-control" rows="3" placeholder="e.g., Logo Design, Web Development, Content Writing, SEO..."><?= esc($profile['skills'] ?? '') ?></textarea>
                                <small class="text-muted">Separate skills with commas</small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Hourly Rate (Optional)</label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input type="number" name="hourly_rate" class="form-control" value="<?= $profile['hourly_rate'] ?? 0 ?>" min="0" step="1000" placeholder="50000">
                                    <span class="input-group-text">/hour</span>
                                </div>
                                <small class="text-muted">Set your hourly rate for custom projects</small>
                            </div>
                        </div>
                    </div>

                    <!-- Social Links & Portfolio -->
                    <div class="card mb-4">
                        <div class="card-header">
                            <h5 class="mb-0"><i class="fas fa-link"></i> Portfolio & Social Links</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label"><i class="fas fa-globe"></i> Portfolio Website</label>
                                <input type="url" name="portfolio_url" class="form-control" value="<?= esc($profile['portfolio_url'] ?? '') ?>" placeholder="https://yourportfolio.com">
                            </div>

                            <div class="mb-3">
                                <label class="form-label"><i class="fab fa-linkedin"></i> LinkedIn Profile</label>
                                <input type="url" name="linkedin_url" class="form-control" value="<?= esc($profile['linkedin_url'] ?? '') ?>" placeholder="https://linkedin.com/in/yourprofile">
                            </div>

                            <div class="mb-3">
                                <label class="form-label"><i class="fab fa-github"></i> GitHub Profile</label>
                                <input type="url" name="github_url" class="form-control" value="<?= esc($profile['github_url'] ?? '') ?>" placeholder="https://github.com/yourusername">
                            </div>

                            <div class="mb-3">
                                <label class="form-label"><i class="fab fa-behance"></i> Behance Profile</label>
                                <input type="url" name="behance_url" class="form-control" value="<?= esc($profile['behance_url'] ?? '') ?>" placeholder="https://behance.net/yourprofile">
                            </div>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary flex-grow-1">
                                    <i class="fas fa-save"></i> Save Changes
                                </button>
                                <a href="/freelancer/" class="btn btn-outline-secondary">
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
