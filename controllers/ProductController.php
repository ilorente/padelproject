<?php
require_once 'models/Product.php';
class ProductController {
    public function index() {
        $product = new Product();
        $result = $product->getAll();
        $products = [];
        while($row = $result->fetch(PDO::FETCH_ASSOC)) $products[] = $row;
        require_once 'views/products/index.php';
    }
    public function show($id) {
        $product = new Product();
        if ($product->getById($id)) require_once 'views/products/show.php';
        else header("Location: ".BASE_URL);
    }
}
?>