<?php
session_start();
header('Content-Type: application/json; charset=utf-8');

$id = (int)($_POST['id'] ?? 0);
if ($id <= 0) {
    echo json_encode(['ok' => false, 'msg' => 'ID inválido']);
    exit;
}

try {
    // Cargar producto desde el modelo (compatible con varios nombres típicos)
    require_once __DIR__ . '/../models/Product.php';

    $product = null;

    // Intentos de métodos comunes:
    if (class_exists('Product')) {
        if (method_exists('Product', 'find')) {
            $product = Product::find($id);
        } elseif (method_exists('Product', 'getById')) {
            $product = Product::getById($id);
        } elseif (method_exists('Product', 'get')) {
            $product = Product::get($id);
        }
    }

    if (!$product) {
        echo json_encode(['ok' => false, 'msg' => 'Producto no encontrado']);
        exit;
    }

    $_SESSION['cart'] ??= [];

    // Si ya existe, sumar quantity
    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]['quantity'] = (int)$_SESSION['cart'][$id]['quantity'] + 1;
    } else {
        // Normalizamos keys esperadas por tus views
        $_SESSION['cart'][$id] = [
            'id' => (int)$product['id'],
            'name' => (string)$product['name'],
            'price' => (float)$product['price'],
            'image' => (string)$product['image'],
            'quantity' => 1
        ];
    }

    // Recalcular contador
    $cartCount = 0;
    foreach ($_SESSION['cart'] as $it) $cartCount += (int)$it['quantity'];

    echo json_encode([
        'ok' => true,
        'cartCount' => $cartCount
    ]);
} catch (Throwable $e) {
    echo json_encode(['ok' => false, 'msg' => 'Error interno']);
}
