<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

$id = (int)($_POST['id'] ?? 0);
if ($id <= 0) {
    echo json_encode(['ok' => false, 'msg' => 'ID inválido']);
    exit;
}

if (isset($_SESSION['cart'][$id])) {
    unset($_SESSION['cart'][$id]);
}

$cartCount = 0;
$total = 0.0;

foreach (($_SESSION['cart'] ?? []) as $it) {
    $cartCount += (int)$it['quantity'];
    $total += (float)$it['price'] * (int)$it['quantity'];
}

echo json_encode([
    'ok' => true,
    'cartCount' => $cartCount,
    'total' => number_format($total, 2) . '€'
]);
