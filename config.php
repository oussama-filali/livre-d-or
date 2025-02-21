<?php
class Config {
    protected $pdo;

    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $this->pdo = new PDO('mysql:host=localhost;dbname=livreor;charset=utf8mb4', 'root', '');
    }
}
?>