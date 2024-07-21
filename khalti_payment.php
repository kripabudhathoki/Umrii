<?php
include('dbconnect.php');

session_start();
$order_id = $_SESSION['order_id'] ?? null;

if (!$order_id) {
    die("Order ID not found.");
}

$stmt = $conn->prepare("
    SELECT o.total_price, c.first_name AS customer_name, c.email AS customer_email, c.phone AS customer_phone 
    FROM orders o
    JOIN checkouts c ON o.checkout_id = c.checkout_id
    WHERE o.order_id = ?
");
$stmt->bind_param('i', $order_id);
$stmt->execute();
$result = $stmt->get_result();
$order = $result->fetch_assoc();
$stmt->close();

if (!$order) {
    die("Order not found.");
}

include('config.php');

$khalti_api_url = KHALTI_API_URL;
$khalti_api_key = KHALTI_API_KEY;

$data = [
    'return_url' => 'http://localhost/umrii/khalti_callback.php',
    'website_url' => 'http://localhost/',
    'amount' => $order['total_price']*10 ,
    'purchase_order_id' => $order_id,
    'purchase_order_name' => 'Order #' . $order_id,
    'customer_info' => [
        'name' => $order['customer_name'], 
        'email' => $order['customer_email'],
        'phone' => $order['customer_phone']
    ]
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $khalti_api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Key ' . $khalti_api_key,
    'Content-Type: application/json'
]);

$response = curl_exec($ch);
curl_close($ch);

$response_data = json_decode($response, true);

if (isset($response_data['payment_url'])) {
    header('Location: ' . $response_data['payment_url']);
    exit();
} else {
    die('Failed to initiate payment.');
}
?>
