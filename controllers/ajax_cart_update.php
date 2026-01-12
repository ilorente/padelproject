<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

$id  = (int)($_POST['id'] ?? 0);
$qty = (int)($_POST['qty'] ?? 0);

if ($id <= 0) {
    echo json_encode(['ok' => false, 'msg' => 'ID inválido']);
    exit;
}

$_SESSION['cart'] ??= [];

if ($qty <= 0) {
    unset($_SESSION['cart'][$id]);
} else {
    // si existe, setea qty; si no existe, error (para evitar estados raros)
    if (!isset($_SESSION['cart'][$id])) {
        echo json_encode(['ok' => false, 'msg' => 'Producto no existe en el carrito']);
        exit;
    }
    $_SESSION['cart'][$id]['quantity'] = $qty;
}

$cartCount = 0;
$total = 0.0;
$subtotal = 0.0;

foreach ($_SESSION['cart'] as $pid => $it) {
    $cartCount += (int)$it['quantity'];
    $total += (float)$it['price'] * (int)$it['quantity';
}

if (isset($_SESSION['cart'][$id])) {
    $it = $_SESSION['cart'][$id];
    $subtotal = (float)$it['price'] * (int)$it['quantity'];
}

echo json_encode([
    'ok' => true,
    'cartCount' => $cartCount,
    'subtotal' => number_format($subtotal, 2) . '€',
    'total' => number_format($total, 2) . '€'
]);
