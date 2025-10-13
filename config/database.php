<?php
// Configuración de base de datos para Azure y Local
// Detectar si estamos en Azure
$isAzure = isset($_SERVER['WEBSITE_SITE_NAME']);

if ($isAzure) {
    // Configuración para Azure App Service
    // Estas variables se configuran en: Configuración > Variables de entorno
    $host = getenv('AZURE_MYSQL_HOST') ?: 'localhost';
    $dbname = getenv('AZURE_MYSQL_DBNAME') ?: 'biblioteca_senati';
    $username = getenv('AZURE_MYSQL_USERNAME') ?: 'root';
    $password = getenv('AZURE_MYSQL_PASSWORD') ?: '';
    
    // Soporte para Azure Database for MySQL con SSL
    $port = getenv('AZURE_MYSQL_PORT') ?: 3306;
} else {
    // Configuración local (XAMPP)
    $host = 'localhost';
    $dbname = 'biblioteca_senati';
    $username = 'root';
    $password = '';
    $port = 3306;
}

try {
    // Crear conexión PDO
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
    $pdo = new PDO($dsn, $username, $password);
    
    // Configurar atributos PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch(PDOException $e) {
    die("Error de conexión a la base de datos: " . $e->getMessage());
}
?>