<?php
class User {
    private PDO $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function findByEmail(string $email): ?array {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $row = $stmt->fetch();
        return $row ?: null;
    }

    public function create(string $name, string $email, string $password): bool {
        $hash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'user')");
        return $stmt->execute([$name, $email, $hash]);
    }

    public function verifyLogin(string $email, string $password): ?array {
        $user = $this->findByEmail($email);
        if (!$user) return null;
        if (!password_verify($password, $user['password'])) return null;
        return $user;
    }
}
