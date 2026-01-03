<?php
class Database {
    private $host = "localhost";
    private $db_name = "tienda_padel";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            // Error silencioso en producción, pero útil aquí
            die("Error de Conexión DB: " . $exception->getMessage() . "<br>Revisa config/database.php");
        }
        return $this->conn;
    }
}
?>
