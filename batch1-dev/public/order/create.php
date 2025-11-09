<?php
defined('SITUNEO_ACCESS') or die('Direct access not permitted');

if (!Auth::check()) {
    Session::set('redirect_after_login', $_SERVER['REQUEST_URI']);
    Router::redirect('login');
}

$service_id = get('service_id');
$db = Database::getInstance();

$service = $db->query("SELECT * FROM services WHERE id = :id AND is_active = 1", ['id' => $service_id])->fetch();

if (!$service) {
    Session::flashError('Service not found!');
    Router::redirect('services');
}

// Handle order submission
if (is_post()) {
    $pricing_type = post('pricing_type'); // 'one_time' or 'subscription'
    $custom_requirements = post('custom_requirements');
    
    $amount = $pricing_type === 'one_time' ? $service['one_time_price'] : $service['monthly_price'];
    
    // Create order
    $order_id = $db->insert('orders', [
        'user_id' => Auth::id(),
        'service_id' => $service_id,
        'order_number' => 'ORD-' . date('Ymd') . '-' . strtoupper(substr(md5(time()), 0, 6)),
        'pricing_type' => $pricing_type,
        'amount' => $amount,
        'total_amount' => $amount,
        'status' => 'pending',
        'payment_status' => 'pending',
        'custom_requirements' => $custom_requirements,
        'created_at' => date('Y-m-d H:i:s')
    ]);
    
    Session::flashSuccess('Order created! Please complete payment.');
    Router::redirect('order/payment?order_id=' . $order_id);
}

$page_title = 'Order ' . $service['name'] . ' - SITUNEO DIGITAL';
include INCLUDES_PATH . 'header/public-header.php';
?>

<section class="order-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h1>Order: <?= htmlspecialchars($service['name']) ?></h1>
                
                <form method="post">
                    <?= csrf_field() ?>
                    
                    <div class="pricing-selection mb-4">
                        <h3>Select Pricing Option:</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="pricing-option">
                                    <input type="radio" name="pricing_type" value="one_time" checked>
                                    <div class="pricing-card">
                                        <h4>Beli Putus</h4>
                                        <div class="price"><?= format_price($service['one_time_price']) ?></div>
                                        <p>Full ownership, no monthly fee</p>
                                    </div>
                                </label>
                            </div>
                            <div class="col-md-6">
                                <label class="pricing-option">
                                    <input type="radio" name="pricing_type" value="subscription">
                                    <div class="pricing-card">
                                        <h4>Sewa Bulanan</h4>
                                        <div class="price"><?= format_price($service['monthly_price']) ?>/bln</div>
                                        <p>Zero setup, includes maintenance</p>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label>Custom Requirements (Optional)</label>
                        <textarea name="custom_requirements" class="form-control" rows="5" placeholder="Describe your specific needs..."></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-lg">Proceed to Payment</button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include INCLUDES_PATH . 'footer/public-footer.php'; ?>
