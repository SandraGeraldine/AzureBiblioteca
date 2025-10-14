<?php
// Archivo de depuración para Azure
echo "<h1>Información del Servidor</h1>";
echo "<p><strong>PHP Version:</strong> " . phpversion() . "</p>";
echo "<p><strong>Server:</strong> " . $_SERVER['SERVER_SOFTWARE'] . "</p>";
echo "<p><strong>Document Root:</strong> " . $_SERVER['DOCUMENT_ROOT'] . "</p>";
echo "<p><strong>Script Filename:</strong> " . $_SERVER['SCRIPT_FILENAME'] . "</p>";
echo "<p><strong>Request URI:</strong> " . $_SERVER['REQUEST_URI'] . "</p>";

echo "<h2>Archivos en raíz:</h2>";
echo "<pre>";
print_r(scandir($_SERVER['DOCUMENT_ROOT']));
echo "</pre>";

if (file_exists($_SERVER['DOCUMENT_ROOT'] . '/public')) {
    echo "<h2>Archivos en /public:</h2>";
    echo "<pre>";
    print_r(scandir($_SERVER['DOCUMENT_ROOT'] . '/public'));
    echo "</pre>";
}

echo "<h2>Enlaces de Prueba:</h2>";
echo "<ul>";
echo "<li><a href='/index.php'>index.php (raíz)</a></li>";
echo "<li><a href='/public/index.php'>public/index.php</a></li>";
echo "<li><a href='/setup.php'>setup.php (raíz)</a></li>";
echo "<li><a href='/public/setup.php'>public/setup.php</a></li>";
echo "<li><a href='/test_connection.php'>test_connection.php</a></li>";
echo "</ul>";

echo "<h2>Variables de Entorno (MySQL):</h2>";
echo "<pre>";
echo "AZURE_MYSQL_HOST: " . (getenv('AZURE_MYSQL_HOST') ?: 'No configurado') . "\n";
echo "AZURE_MYSQL_DBNAME: " . (getenv('AZURE_MYSQL_DBNAME') ?: 'No configurado') . "\n";
echo "AZURE_MYSQL_USERNAME: " . (getenv('AZURE_MYSQL_USERNAME') ?: 'No configurado') . "\n";
echo "AZURE_MYSQL_PASSWORD: " . (getenv('AZURE_MYSQL_PASSWORD') ? '***configurado***' : 'No configurado') . "\n";
echo "AZURE_MYSQL_PORT: " . (getenv('AZURE_MYSQL_PORT') ?: 'No configurado') . "\n";
echo "</pre>";

