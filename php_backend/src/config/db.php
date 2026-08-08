<?php
 use Dotenv\Dotenv;

require __DIR__ . '/../../vendor/autoload.php';
$dotenv=Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

$host = $_ENV['DB_HOST'];
$user= $_ENV['DB_USER'];
$password= $_ENV['DB_PASSWORD'];
$database = $_ENV['DB_NAME'];

try{
    $conn=new PDO("mysql:host=$host;database=$database",$user,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    echo "Database connection successful";

}
catch(PDOException $e){
    die("Database connection failed: " . $e->getMessage());
}




?>