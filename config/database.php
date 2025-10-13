<?php
$isAzure = isset($_SERVER['WEBSITE_SITE_NAME']);

if ($isAzure) {
    $host = getenv('AZURE_MYSQL_HOST');
    $dbname = getenv('AZURE_MYSQL_DBNAME');
    $username = getenv('AZURE_MYSQL_USERNAME');
    $password = getenv('AZURE_MYSQL_PASSWORD');
} else {
    $host = 'localhost';
    $dbname = 'biblioteca_senati';
    $username = 'root';
    $password = '';
}

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>