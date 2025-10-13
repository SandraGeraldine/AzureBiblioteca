<?php
// Configuración de la base de datos
// Para uso local (XAMPP) y Azure

// Detectar si estamos en Azure o local
$isAzure = isset($_SERVER['WEBSITE_SITE_NAME']);

if ($isAzure) {
    // Configuración para Azure
    // Estas variables se configurarán en Azure App Service
    $host = getenv('DB_HOST') ?: 'localhost';
    $dbname = getenv('DB_NAME') ?: 'biblioteca_senati';
    $username = getenv('DB_USER') ?: 'root';
    $password = getenv('DB_PASS') ?: '';
} else {
    // Configuración local (XAMPP)
    $host = 'localhost';
    $dbname = 'biblioteca_senati';
    $username = 'root';
    $password = '';
}

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
