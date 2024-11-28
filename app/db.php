<?php
$host = getenv('DB_HOST') ?: $_ENV['DB_HOST'];
$port = getenv('DB_PORT') ?: $_ENV['DB_PORT'];
$dbname = getenv('DB_NAME') ?: $_ENV['DB_NAME'];
$username = getenv('DB_USER') ?: $_ENV['DB_USER'];
$password = getenv('DB_PASSWORD') ?: $_ENV['DB_PASSWORD'];

try {
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Kết nối thất bại: " . $e->getMessage());
}
?>
