<?php
defined('SITUNEO_ACCESS') or die('Direct access not permitted');

header('Content-Type: application/json');

if (!Auth::check()) {
    json_error('Unauthorized', [], 401);
}

$input = json_decode(file_get_contents('php://input'), true);
$order_id = $input['order_id'] ?? null;

$db = Database::getInstance();
$order = $db->query("SELECT * FROM orders WHERE id = :id AND user_id = :user_id", [
    'id' => $order_id,
    'user_id' => Auth::id()
])->fetch();

if (!$order) {
    json_error('Order not found', [], 404);
}

// Midtrans configuration
$server_key = getenv('MIDTRANS_SERVER_KEY');
$is_production = getenv('MIDTRANS_IS_PRODUCTION') === 'true';

$params = [
    'transaction_details' => [
        'order_id' => $order['order_number'],
        'gross_amount' => (int)$order['total_amount']
    ],
    'customer_details' => [
        'first_name' => Auth::user()['name'],
        'email' => Auth::user()['email'],
        'phone' => Auth::user()['phone']
    ]
];

// Create Snap Token
$url = $is_production ? 'https://app.midtrans.com/snap/v1/transactions' : 'https://app.sandbox.midtrans.com/snap/v1/transactions';

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Authorization: Basic ' . base64_encode($server_key . ':')
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);
curl_close($ch);

$response = json_decode($result, true);

if (isset($response['token'])) {
    json_success('Transaction created', ['snap_token' => $response['token']]);
} else {
    json_error('Failed to create transaction', $response);
}
