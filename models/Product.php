<?php
class Product {
    private PDO $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function all(): array {
        $stmt = $this->conn->query("SELECT * FROM products ORDER BY id DESC");
        return $stmt->fetchAll();
    }

    public function find(int $id): ?array {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();
        return $row ?: null;
    }
}
