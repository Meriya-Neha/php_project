<?php
use Dotenv\Dotenv;

require_once __DIR__ . '/../../vendor/autoload.php';
$dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

class Database {
    private static ?PDO $conn = null;

    public static function getConnection(): PDO
    {
        if (self::$conn === null) {
            $host = 'localhost';
            $user = 'root';
            $password = '';
            $database = 'php_login_db';

            try {
                self::$conn = new PDO("mysql:host=$host;dbname=$database", $user, $password);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Database connection failed: " . $e->getMessage());
            }
        }

        return self::$conn;
    }
}