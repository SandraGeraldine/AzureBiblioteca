# AzureBiblioteca

Sistema CRUD de Libros para Biblioteca 

## Descripción
Aplicación web desarrollada en PHP y MySQL para la gestión de libros. Permite crear, leer, actualizar y eliminar registros de libros. Compatible con despliegue local (XAMPP) y Azure App Service.

## Estructura principal
- `index.php` (raíz): Redirige o incluye la app principal según el entorno.
- `config/database.php`: Configuración y conexión a la base de datos.
- `public/`: Contiene las vistas y lógica CRUD.
- `sql/database.sql`: Script para crear la base de datos y tabla de libros.
- `setup.php`: Inicializa la base de datos (usar solo una vez).
- `web.config` y `startup.sh`: Configuración para Azure.

## Uso
1. Clona el repositorio.
2. Configura la base de datos usando `setup.php` o el script SQL.
3. Accede a la aplicación desde el navegador.
4. Realiza operaciones CRUD desde la interfaz.

## Autor
Sandra Geraldine
