<?php
require_once __DIR__ . '/../config/database.php';

$id = $_GET['id'] ?? null;

if (!$id || !is_numeric($id)) {
    header('Location: index.php');
    exit;
}

try {
    $stmt = $pdo->prepare("DELETE FROM libros WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: index.php?mensaje=eliminado');
} catch(PDOException $e) {
    die("Error al eliminar: " . $e->getMessage());
}
?>
