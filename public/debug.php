<?php
// Archivo temporal para debug - ELIMINAR después
header('Content-Type: text/plain');

echo "=== DEBUG DE VARIABLES DE ENTORNO ===\n\n";

echo "WEBSITE_SITE_NAME: " . ($_SERVER['WEBSITE_SITE_NAME'] ?? 'NO DEFINIDO') . "\n";
echo "Es Azure: " . (isset($_SERVER['WEBSITE_SITE_NAME']) ? 'SÍ' : 'NO') . "\n\n";

echo "AZURE_MYSQL_HOST: " . (getenv('AZURE_MYSQL_HOST') ?: 'NO DEFINIDO') . "\n";
echo "AZURE_MYSQL_DBNAME: " . (getenv('AZURE_MYSQL_DBNAME') ?: 'NO DEFINIDO') . "\n";
echo "AZURE_MYSQL_USERNAME: " . (getenv('AZURE_MYSQL_USERNAME') ?: 'NO DEFINIDO') . "\n";
echo "AZURE_MYSQL_PASSWORD: " . (getenv('AZURE_MYSQL_PASSWORD') ? '***DEFINIDO***' : 'NO DEFINIDO') . "\n";
echo "AZURE_MYSQL_PORT: " . (getenv('AZURE_MYSQL_PORT') ?: 'NO DEFINIDO') . "\n";
?>
