<?php
class Database {
    private $pdo;

    public function __construct() {
        $this->pdo = new PDO('mysql:host=localhost;dbname=livreor;charset=utf8mb4', 'root', ''); // Remplacez par les informations correctes
    }

    public function getConnection() {
        return $this->pdo;
    }
}
?>
