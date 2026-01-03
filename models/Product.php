<?php
require_once 'config/database.php';
class Product {
    private $conn;
    public $id; public $name; public $price; public $image; public $description; public $category; public $brand; public $stock;

    public function __construct() { $db = new Database(); $this->conn = $db->getConnection(); }

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT * FROM products ORDER BY id DESC");
        $stmt->execute();
        return $stmt;
    }
    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            foreach ($row as $key => $val) $this->$key = $val;
            return true;
        } return false;
    }
}
?>