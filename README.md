# Sistema de Biblioteca SENATI - CRUD de Libros

Sistema web para gestión de libros desarrollado con PHP y MySQL.

## 🚀 Características

- ✅ **CRUD Completo**: Crear, Leer, Actualizar y Eliminar libros
- ✅ **Validación de Datos**: Validación tanto en cliente como en servidor
- ✅ **Diseño Moderno**: Interfaz responsive con Bootstrap 5
- ✅ **Compatible con Azure**: Configurado para despliegue en Azure App Service
- ✅ **Estructura Organizada**: Proyecto organizado por carpetas

## 📁 Estructura del Proyecto

```
CrudLibros/
├── config/
│   └── database.php       # Configuración de base de datos
├── public/
│   ├── index.php          # Listado de libros
│   ├── crear.php          # Formulario crear
│   ├── editar.php         # Formulario editar
│   └── eliminar.php       # Eliminar libro
├── docs/
│   ├── README.md          # Documentación completa
│   ├── GUIA_AZURE.md      # Guía de Azure
│   └── database.sql       # Script SQL
├── .htaccess              # Configuración Apache
├── web.config             # Configuración IIS/Azure
└── index.php              # Redirección a public/
```

## 🔧 Instalación Local (XAMPP)

1. **Copiar el proyecto**
   ```
   C:\xampp\htdocs\CrudLibros
   ```

2. **Crear la base de datos**
   - Abrir phpMyAdmin: `http://localhost/phpmyadmin`
   - Crear base de datos: `biblioteca_senati`
   - Importar: `docs/database.sql`

3. **Acceder a la aplicación**
   ```
   http://localhost/CrudLibros/
   ```

## 🌐 URLs de Acceso

- **Raíz**: `http://localhost/CrudLibros/` → Redirige a public/
- **Directo**: `http://localhost/CrudLibros/public/`
- **Crear**: `http://localhost/CrudLibros/public/crear.php`
- **Editar**: `http://localhost/CrudLibros/public/editar.php?id=1`

## 💻 Tecnologías

- **Backend**: PHP 7.4+
- **Base de Datos**: MySQL 5.7+
- **Frontend**: Bootstrap 5.3, Bootstrap Icons
- **Servidor**: Apache (local) / IIS (Azure)

## 📚 Documentación

Para más detalles, consulta:
- **Documentación completa**: `docs/README.md`
- **Guía de Azure**: `docs/GUIA_AZURE.md`

## 🔒 Seguridad

- PDO con prepared statements
- Validación de datos en servidor
- Escape de HTML para prevenir XSS

## 👨‍💻 Autor

**Proyecto SENATI - Último Semestre**

---

**Nota**: El proyecto ahora está organizado con carpetas para mejor mantenimiento y escalabilidad.
