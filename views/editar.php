<?php
require_once __DIR__ . '/../config/database.php';

$error = '';
$success = '';
$libro = null;

// Obtener ID del libro
$id = $_GET['id'] ?? null;

if (!$id || !is_numeric($id)) {
    header('Location: index.php');
    exit;
}

// Obtener datos del libro
try {
    $stmt = $pdo->prepare("SELECT * FROM libros WHERE id = ?");
    $stmt->execute([$id]);
    $libro = $stmt->fetch();
    
    if (!$libro) {
        header('Location: index.php');
        exit;
    }
} catch(PDOException $e) {
    die("Error: " . $e->getMessage());
}

// Procesar formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo'] ?? '');
    $autor = trim($_POST['autor'] ?? '');
    $anio = trim($_POST['anio'] ?? '');
    $editorial = trim($_POST['editorial'] ?? '');

    // Validaciones
    if (empty($titulo) || empty($autor) || empty($anio) || empty($editorial)) {
        $error = 'Todos los campos son obligatorios';
    } elseif (!is_numeric($anio) || $anio < 1000 || $anio > date('Y')) {
        $error = 'El año debe ser válido';
    } else {
        try {
            $stmt = $pdo->prepare("UPDATE libros SET titulo = ?, autor = ?, anio = ?, editorial = ? WHERE id = ?");
            $stmt->execute([$titulo, $autor, $anio, $editorial, $id]);
            $success = 'Libro actualizado exitosamente';
            // Actualizar datos mostrados
            $libro = ['id' => $id, 'titulo' => $titulo, 'autor' => $autor, 'anio' => $anio, 'editorial' => $editorial];
            header("refresh:2;url=index.php");
        } catch(PDOException $e) {
            $error = 'Error al actualizar el libro: ' . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Libro - Biblioteca SENATI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px 0;
        }
        .form-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            padding: 40px;
            max-width: 600px;
            margin: 50px auto;
        }
        .btn-custom {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
        }
        .btn-custom:hover {
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2 class="text-center mb-4">
                <i class="bi bi-pencil-square"></i> Editar Libro
            </h2>

            <?php if ($error): ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <i class="bi bi-exclamation-triangle"></i> <?= htmlspecialchars($error) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            <?php endif; ?>

            <?php if ($success): ?>
                <div class="alert alert-success alert-dismissible fade show">
                    <i class="bi bi-check-circle"></i> <?= htmlspecialchars($success) ?>
                    <p class="mb-0 mt-2">Redirigiendo...</p>
                </div>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="mb-3">
                    <label for="titulo" class="form-label">Título del Libro *</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" 
                           value="<?= htmlspecialchars($libro['titulo']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="autor" class="form-label">Autor *</label>
                    <input type="text" class="form-control" id="autor" name="autor" 
                           value="<?= htmlspecialchars($libro['autor']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="anio" class="form-label">Año de Publicación *</label>
                    <input type="number" class="form-control" id="anio" name="anio" 
                           min="1000" max="<?= date('Y') ?>"
                           value="<?= htmlspecialchars($libro['anio']) ?>" required>
                </div>

                <div class="mb-3">
                    <label for="editorial" class="form-label">Editorial *</label>
                    <input type="text" class="form-control" id="editorial" name="editorial" 
                           value="<?= htmlspecialchars($libro['editorial']) ?>" required>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-custom btn-lg">
                        <i class="bi bi-save"></i> Actualizar Libro
                    </button>
                    <a href="index.php" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Volver al Listado
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
