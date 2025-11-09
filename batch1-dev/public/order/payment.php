<?php
defined('SITUNEO_ACCESS') or die('Direct access not permitted');
Auth::require();

$order_id = get('order_id');
$db = Database::getInstance();

$order = $db->query("
    SELECT o.*, s.name as service_name
    FROM orders o
    LEFT JOIN services s ON o.service_id = s.id
    WHERE o.id = :id AND o.user_id = :user_id
", ['id' => $order_id, 'user_id' => Auth::id()])->fetch();

if (!$order) {
    Session::flashError('Order not found!');
    Router::redirect('client/orders');
}

$page_title = 'Payment - SITUNEO DIGITAL';
include INCLUDES_PATH . 'header/public-header.php';
?>

<section class="payment-section py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 mx-auto">
                <h1>Complete Payment</h1>
                
                <div class="order-summary mb-4">
                    <h3>Order Summary</h3>
                    <p><strong>Order #:</strong> <?= $order['order_number'] ?></p>
                    <p><strong>Service:</strong> <?= htmlspecialchars($order['service_name']) ?></p>
                    <p><strong>Amount:</strong> <?= format_price($order['total_amount']) ?></p>
                </div>
                
                <div class="payment-methods">
                    <h3>Select Payment Method:</h3>
                    
                    <button class="btn btn-primary btn-lg w-100 mb-2" onclick="payWithMidtrans()">
                        <i class="bi bi-credit-card"></i> Pay with Midtrans
                    </button>
                    
                    <a href="<?= whatsapp_link(COMPANY_WHATSAPP, 'Halo, saya ingin bayar order #' . $order['order_number']) ?>" class="btn btn-success btn-lg w-100" target="_blank">
                        <i class="bi bi-whatsapp"></i> Pay via WhatsApp (Manual)
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?= getenv('MIDTRANS_CLIENT_KEY') ?>"></script>
<script>
function payWithMidtrans() {
    // TODO: Implement Midtrans Snap payment
    fetch('<?= url("api/midtrans/create-transaction") ?>', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({order_id: <?= $order_id ?>})
    })
    .then(res => res.json())
    .then(data => {
        snap.pay(data.snap_token, {
            onSuccess: function(result) {
                window.location.href = '<?= url("order/success?order_id=' . $order_id . '") ?>';
            },
            onPending: function(result) {
                alert('Payment pending');
            },
            onError: function(result) {
                alert('Payment failed');
            }
        });
    });
}
</script>

<?php include INCLUDES_PATH . 'footer/public-footer.php'; ?>
