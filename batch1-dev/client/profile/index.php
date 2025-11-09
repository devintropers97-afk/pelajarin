<?php
defined('SITUNEO_ACCESS') or die('Direct access not permitted');
Auth::requireRole('client');

$client = Auth::user();
$db = Database::getInstance();

// Get client profile
$profile = $db->query("SELECT * FROM client_profiles WHERE user_id = :id", ['id' => $client['id']])->fetch();

// Handle profile update
if (is_post()) {
    $name = post('name');
    $email = post('email');
    $phone = post('phone');
    $company_name = post('company_name');
    $industry = post('industry');
    $address = post('address');
    
    // Update user
    $db->query("UPDATE users SET name = :name, email = :email, phone = :phone, updated_at = NOW() WHERE id = :id", [
        'name' => $name, 'email' => $email, 'phone' => $phone, 'id' => $client['id']
    ]);
    
    // Update profile
    $db->query("UPDATE client_profiles SET company_name = :company, industry = :industry, address = :address, updated_at = NOW() WHERE user_id = :id", [
        'company' => $company_name, 'industry' => $industry, 'address' => $address, 'id' => $client['id']
    ]);
    
    Session::flashSuccess('Profile updated successfully!');
    Router::redirect('client/profile');
}

$page_title = 'My Profile - SITUNEO DIGITAL';
include ADMIN_PATH . 'includes/admin-header.php';
?>

<div class="profile-container">
    <h1>My Profile</h1>
    <form method="post" class="profile-form">
        <?= csrf_field() ?>
        
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Full Name</label>
                <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($client['name']) ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($client['email']) ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Phone</label>
                <input type="tel" name="phone" class="form-control" value="<?= htmlspecialchars($client['phone']) ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Company Name</label>
                <input type="text" name="company_name" class="form-control" value="<?= htmlspecialchars($profile['company_name'] ?? '') ?>">
            </div>
            <div class="col-md-6 mb-3">
                <label>Industry</label>
                <input type="text" name="industry" class="form-control" value="<?= htmlspecialchars($profile['industry'] ?? '') ?>">
            </div>
            <div class="col-md-12 mb-3">
                <label>Address</label>
                <textarea name="address" class="form-control" rows="3"><?= htmlspecialchars($profile['address'] ?? '') ?></textarea>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary">Update Profile</button>
    </form>
</div>

<?php include ADMIN_PATH . 'includes/admin-footer.php'; ?>
