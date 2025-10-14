-- Base de datos para CRUD de Libros
-- Proyecto SENATI - Azure

CREATE DATABASE IF NOT EXISTS `biblioteca-senati`;
USE `biblioteca-senati`;

-- Tabla de libros
CREATE TABLE IF NOT EXISTS libros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(200) NOT NULL,
    autor VARCHAR(150) NOT NULL,
    anio INT NOT NULL,
    editorial VARCHAR(100) NOT NULL,
    fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Datos de ejemplo
INSERT INTO libros (titulo, autor, anio, editorial) VALUES
('Cien años de soledad', 'Gabriel García Márquez', 1967, 'Editorial Sudamericana'),
('Don Quijote de la Mancha', 'Miguel de Cervantes', 1605, 'Francisco de Robles'),
('El principito', 'Antoine de Saint-Exupéry', 1943, 'Reynal & Hitchcock'),
('1984', 'George Orwell', 1949, 'Secker & Warburg'),
('Orgullo y prejuicio', 'Jane Austen', 1813, 'T. Egerton');
