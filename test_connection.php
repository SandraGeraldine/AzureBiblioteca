<?php
// test_connection.php - prueba rápida de conexión a la base de datos
// Instrucciones: abre en el navegador http://localhost/CrudLibros/test_connection.php

require_once __DIR__ . '/config.php';

header('Content-Type: text/plain; charset=utf-8');

echo "Prueba de conexión PDO\n";

try {
    if (!isset($pdo)) {
        throw new Exception('La variable $pdo no está definida. Asegúrate de que config.php creó $pdo.');
    }

    // Información de PDO
    echo "PDO disponible: sí\n";
    echo "Driver PDO: " . $pdo->getAttribute(PDO::ATTR_DRIVER_NAME) . "\n";

    // Versión del servidor MySQL (si la conexión funciona)
    $version = $pdo->query('SELECT VERSION() as v')->fetchColumn();
    echo "Versión de MySQL/MariaDB: " . $version . "\n";

    // Conteo de tabla libros (si existe)
    $stmt = $pdo->query("SHOW TABLES LIKE 'libros'");
    $exists = $stmt->fetchColumn();
    if ($exists) {
        $count = $pdo->query('SELECT COUNT(*) FROM libros')->fetchColumn();
        echo "Tabla 'libros' encontrada. Registros: " . $count . "\n";
    } else {
        echo "Tabla 'libros' no encontrada. Importa sql/database.sql si aún no lo has hecho.\n";
    }

    echo "\nConexión: OK\n";
} catch (PDOException $e) {
    echo "Error PDO: " . $e->getMessage() . "\n";
    echo "Comprueba que la extensión pdo_mysql esté habilitada en php.ini y que MySQL esté corriendo.\n";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}

?>