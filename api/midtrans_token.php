<?php
// Include Midtrans SDK
require_once dirname(__FILE__) . '/vendor/autoload.php';

// Masukkan Server Key kamu di sini:
\Midtrans\Config::$serverKey = 'SB-Mid-server-5zG3F2x80tzmagnnEgUQqpDJ';

// FALSE = Sandbox (testing), TRUE = Production
\Midtrans\Config::$isProduction = false;

// Terima data dari aplikasi Flutter (POST JSON)
$input = json_decode(file_get_contents("php://input"), true);

// Contoh parameter transaksi
$params = [
    'transaction_details' => [
        'order_id' => 'ORDER-' . rand(),
        'gross_amount' => $input['amount'],
    ],
    'customer_details' => [
        'first_name' => $input['name'],
        'email' => $input['email'],
        'phone' => $input['phone'],
    ]
];

// Dapatkan Snap Token dari Midtrans
$snapToken = \Midtrans\Snap::getSnapToken($params);

// Kembalikan ke Flutter
echo json_encode(['token' => $snapToken]);
