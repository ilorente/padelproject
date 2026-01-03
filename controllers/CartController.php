<?php
class CartController {
    public function index() {
        $cart = $_SESSION['cart'] ?? [];
        require_once 'views/layout/header.php';
        echo "<h2>Carrito</h2><pre>".print_r($cart,true)."</pre>"; // Debug visual rápido
        echo "<a href='".BASE_URL."/products' class='btn btn-primary'>Seguir comprando</a>";
        require_once 'views/layout/footer.php';
    }
    public function add() {
        $id = $_POST['id'] ?? null;
        if ($id) $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
        header("Location: ".BASE_URL."/cart");
    }
    public function remove() { unset($_SESSION['cart']); header("Location: ".BASE_URL."/cart"); }
    public function update() {}
}
?>