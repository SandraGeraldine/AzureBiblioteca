<?php
// Archivo de prueba para Azure
echo "<h1>Conexión Exitosa</h1>";
echo "<p>PHP Version: " . phpversion() . "</p>";
echo "<p>Server: " . $_SERVER['SERVER_SOFTWARE'] . "</p>";
echo "<p>Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "</p>";

// Verificar estructura de archivos
echo "<h2>Archivos en raíz:</h2>";
echo "<pre>";
print_r(scandir(__DIR__));
echo "</pre>";

// Verificar carpeta public
if (is_dir(__DIR__ . '/public')) {
    echo "<h2>Archivos en /public:</h2>";
    echo "<pre>";
    print_r(scandir(__DIR__ . '/public'));
    echo "</pre>";
}

// Probar conexión a base de datos
echo "<h2>Prueba de Base de Datos:</h2>";
try {
    require_once __DIR__ . '/config/database.php';
    echo "<p style='color: green;'>Conexión a base de datos exitosa</p>";
    
    // Verificar tabla libros
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM libros");
    $result = $stmt->fetch();
    echo "<p>Total de libros en BD: " . $result['total'] . "</p>";
} catch (Exception $e) {
    echo "<p style='color: red;'>Error de conexión: " . $e->getMessage() . "</p>";
}
?>
