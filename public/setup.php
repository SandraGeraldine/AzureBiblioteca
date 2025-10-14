<?php
/**
 * Script de inicialización de base de datos
 * Ejecutar este archivo UNA VEZ para crear la tabla libros en Azure
 * URL: https://biblioteca-senati.azurewebsites.net/public/setup.php
 */

// Detectar si estamos en Azure
$isAzure = isset($_SERVER['WEBSITE_SITE_NAME']);

if ($isAzure) {
    // Configuración para Azure App Service
    $host = getenv('AZURE_MYSQL_HOST') ?: 'localhost';
    $dbname = getenv('AZURE_MYSQL_DBNAME') ?: 'biblioteca-senati';
    $username = getenv('AZURE_MYSQL_USERNAME') ?: 'root';
    $password = getenv('AZURE_MYSQL_PASSWORD') ?: '';
    $port = getenv('AZURE_MYSQL_PORT') ?: 3306;
} else {
    // Configuración local (XAMPP)
    $host = 'localhost';
    $dbname = 'biblioteca_senati';
    $username = 'root';
    $password = '';
    $port = 3306;
}

echo "<h1>Configuración de Base de Datos</h1>";
echo "<p><strong>Entorno:</strong> " . ($isAzure ? "Azure App Service" : "Local") . "</p>";
echo "<p><strong>Base de datos:</strong> $dbname</p>";
echo "<hr>";

try {
    // Conectar sin especificar base de datos primero
    $dsn = "mysql:host=$host;port=$port;charset=utf8mb4";
    
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    
    if ($isAzure) {
        $options[PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT] = false;
        $options[PDO::MYSQL_ATTR_SSL_CA] = true;
    }
    
    $pdo = new PDO($dsn, $username, $password, $options);
    echo "<p>Conexión al servidor MySQL exitosa</p>";
    
    // Crear base de datos si no existe
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "<p>Base de datos '$dbname' verificada/creada</p>";
    
    // Seleccionar la base de datos
    $pdo->exec("USE `$dbname`");
    
    // Crear tabla libros
    $createTableSQL = "
    CREATE TABLE IF NOT EXISTS libros (
        id INT AUTO_INCREMENT PRIMARY KEY,
        titulo VARCHAR(200) NOT NULL,
        autor VARCHAR(150) NOT NULL,
        anio INT NOT NULL,
        editorial VARCHAR(100) NOT NULL,
        fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
    ";
    
    $pdo->exec($createTableSQL);
    echo "<p>Tabla 'libros' creada exitosamente</p>";
    
    // Verificar si ya hay datos
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM libros");
    $result = $stmt->fetch();
    $totalLibros = $result['total'];
    
    if ($totalLibros == 0) {
        // Insertar datos de ejemplo
        $insertSQL = "
        INSERT INTO libros (titulo, autor, anio, editorial) VALUES
        ('Cien años de soledad', 'Gabriel García Márquez', 1967, 'Editorial Sudamericana'),
        ('Don Quijote de la Mancha', 'Miguel de Cervantes', 1605, 'Francisco de Robles'),
        ('El principito', 'Antoine de Saint-Exupéry', 1943, 'Reynal & Hitchcock'),
        ('1984', 'George Orwell', 1949, 'Secker & Warburg'),
        ('Orgullo y prejuicio', 'Jane Austen', 1813, 'T. Egerton')
        ";
        
        $pdo->exec($insertSQL);
        echo "<p>5 libros de ejemplo insertados</p>";
    } else {
        echo "<p>ℹLa tabla ya contiene $totalLibros libro(s)</p>";
    }
    
    // Mostrar los libros actuales
    echo "<h2>Libros en la base de datos:</h2>";
    $stmt = $pdo->query("SELECT * FROM libros ORDER BY id");
    $libros = $stmt->fetchAll();
    
    if (count($libros) > 0) {
        echo "<table border='1' cellpadding='10' style='border-collapse: collapse; width: 100%;'>";
        echo "<tr style='background-color: #4CAF50; color: white;'>";
        echo "<th>ID</th><th>Título</th><th>Autor</th><th>Año</th><th>Editorial</th><th>Fecha Registro</th>";
        echo "</tr>";
        
        foreach ($libros as $libro) {
            echo "<tr>";
            echo "<td>{$libro['id']}</td>";
            echo "<td>{$libro['titulo']}</td>";
            echo "<td>{$libro['autor']}</td>";
            echo "<td>{$libro['anio']}</td>";
            echo "<td>{$libro['editorial']}</td>";
            echo "<td>{$libro['fecha_registro']}</td>";
            echo "</tr>";
        }
        
        echo "</table>";
    }
    
    echo "<hr>";
    echo "<h2>Configuración completada exitosamente</h2>";
    echo "<p><a href='index.php' style='background-color: #4CAF50; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Ir a la aplicación</a></p>";
    echo "<p style='color: #ff9800;'><strong>IMPORTANTE:</strong> Por seguridad, elimina este archivo después de ejecutarlo o restringe su acceso.</p>";
    
} catch(PDOException $e) {
    echo "<p style='color: red;'> Error: " . $e->getMessage() . "</p>";
    echo "<h3>Información de depuración:</h3>";
    echo "<pre>";
    echo "Host: $host\n";
    echo "Puerto: $port\n";
    echo "Base de datos: $dbname\n";
    echo "Usuario: $username\n";
    echo "</pre>";
}
?>
