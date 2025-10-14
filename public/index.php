<?php
require_once __DIR__ . '/../config/database.php';

// Obtener todos los libros
$stmt = $pdo->query("SELECT * FROM libros ORDER BY id DESC");
$libros = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca SENATI - CRUD de Libros</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #dee3f8ff 0%, #efe5faff 100%);
            min-height: 100vh;
            padding: 20px 0;
        }
        .main-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            padding: 30px;
            margin-top: 20px;
        }
        .header-section {
            background: linear-gradient(135deg, #667eea 0%, #667eea  100%);
            color: white;
            padding: 30px;
            border-radius: 10px;
            margin-bottom: 30px;
            text-align: center;
        }
        .btn-custom {
            background: linear-gradient(135deg, #667eea 0%, #667eea  100%);
            border: none;
            color: white;
        }
        .btn-custom:hover {
            background: linear-gradient(135deg, #667eea  0%, #667eea 100%);
            color: white;
        }
        .table-hover tbody tr:hover {
            background-color: #f8f9fa;
        }
        .action-buttons {
            display: flex;
            gap: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="main-container">
            <div class="header-section">
                <h1><i class="bi bi-book"></i> Sistema de Biblioteca</h1>
                <p class="mb-0">CRUD de Libros - Proyecto SENATI Azure</p>
            </div>

            <!-- Botón para agregar nuevo libro -->
            <div class="mb-4">
                <a href="crear.php" class="btn btn-custom btn-lg">
                    <i class="bi bi-plus-circle"></i> Agregar Nuevo Libro
                </a>
            </div>

            <!-- Tabla de libros -->
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Año</th>
                            <th>Editorial</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($libros) > 0): ?>
                            <?php foreach ($libros as $libro): ?>
                                <tr>
                                    <td><?= htmlspecialchars($libro['id']) ?></td>
                                    <td><strong><?= htmlspecialchars($libro['titulo']) ?></strong></td>
                                    <td><?= htmlspecialchars($libro['autor']) ?></td>
                                    <td><?= htmlspecialchars($libro['anio']) ?></td>
                                    <td><?= htmlspecialchars($libro['editorial']) ?></td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="editar.php?id=<?= $libro['id'] ?>" class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil"></i> Editar
                                            </a>
                                            <a href="eliminar.php?id=<?= $libro['id'] ?>" 
                                               class="btn btn-danger btn-sm" 
                                               onclick="return confirm('¿Estás seguro de eliminar este libro?')">
                                                <i class="bi bi-trash"></i> Eliminar
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">
                                    <div class="alert alert-info">
                                        <i class="bi bi-info-circle"></i> No hay libros registrados. ¡Agrega el primero!
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <div class="text-center mt-4">
                <p class="text-muted">
                    <i class="bi bi-cloud"></i> Desplegado en Azure | SENATI - Último Semestre
                </p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
