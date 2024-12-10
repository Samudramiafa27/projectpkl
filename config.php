<?php
// Konfigurasi database
$host = 'localhost';
$dbname = 'websitepkl';
$username = 'postgres';
$password = 'ranggamiafa666';

try {
    $pdo = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
