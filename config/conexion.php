<?php
$host = "localhost";
$port = "5432";
$dbname = "sistemaenfermeria";
$user = "postgres";
$password = "123456";

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $pdo = new PDO($dsn, $user, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
