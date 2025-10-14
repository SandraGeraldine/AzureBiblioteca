<?php
// Redirigir a la carpeta public
// Detectar si estamos en Azure
$isAzure = isset($_SERVER['WEBSITE_SITE_NAME']);

if ($isAzure) {
    // En Azure, incluir directamente el archivo
    require_once __DIR__ . '/public/index.php';
} else {
    // En local, redirigir
    header('Location: public/index.php');
    exit;
}
?>
