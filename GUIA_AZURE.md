# 🚀 Guía de Despliegue en Azure - SOLUCIÓN DE PROBLEMAS

## ⚠️ PROBLEMA ACTUAL: Página en Blanco

Tu aplicación está desplegada pero muestra página en blanco. Causas comunes:

### 1. **Variables de Entorno NO Configuradas** ⭐ (Más probable)

Ve a Azure Portal:

1. **Ir a tu App Service**: `biblioteca-senati-f5cbfwhzf2h2ea`
2. **Menú izquierdo** → `Configuración` → `Variables de aplicación`
3. **Agregar estas variables**:

```
AZURE_MYSQL_HOST = [tu-servidor-mysql].mysql.database.azure.com
AZURE_MYSQL_DBNAME = biblioteca_senati
AZURE_MYSQL_USERNAME = [tu-usuario-admin]
AZURE_MYSQL_PASSWORD = [tu-contraseña]
AZURE_MYSQL_PORT = 3306
```

4. **GUARDAR** (botón arriba)
5. **Esperar 1-2 minutos** y refrescar tu sitio

---

### 2. **Ver Logs de Error**

Para saber exactamente qué está fallando:

1. **En tu App Service** → `Registros de App Service`
2. **Activar**:
   - Registro de aplicaciones (Sistema de archivos): **Activado**
   - Nivel: **Error**
3. **Guardar**
4. **Ir a**: `Secuencia de registro` (menú izquierdo)
5. **Refrescar tu sitio** y ver qué error aparece

---

### 3. **Verificar Archivos Desplegados**

1. **En tu App Service** → `Herramientas avanzadas (Kudu)` → **Ir**
2. **En Kudu** → `Debug console` → `CMD`
3. **Navegar a**: `site/wwwroot/`
4. **Verificar que existen**:
   - ✅ `web.config`
   - ✅ `index.php`
   - ✅ Carpeta `public/`
   - ✅ Carpeta `config/`

---

### 4. **Verificar Base de Datos**

¿Ya creaste la base de datos MySQL en Azure?

**Opción A: Crear MySQL en Azure**

1. **Portal Azure** → `Crear recurso` → `Azure Database for MySQL`
2. **Flexible Server**
3. **Configurar**:
   - Servidor: `mysql-biblioteca-senati`
   - Usuario: `adminbiblioteca`
   - Contraseña: [crear una segura]
   - Región: `West US 3` (misma que tu App Service)
4. **Redes**: Permitir acceso desde servicios de Azure
5. **Crear base de datos**: `biblioteca_senati`
6. **Importar**: `sql/database.sql`

**Opción B: Usar otra base de datos**

Si tienes MySQL en otro lugar (Hostinger, ClearDB, etc.), solo necesitas los datos de conexión.

---

## 📤 CÓMO ACTUALIZAR EL CÓDIGO EN AZURE

### Método 1: Git (Recomendado)

```bash
# En tu carpeta del proyecto
git add .
git commit -m "Correcciones para Azure"
git push azure master
```

### Método 2: FTP

1. **App Service** → `Centro de implementación` → `Credenciales de FTP`
2. **Usar FileZilla** con las credenciales
3. **Subir archivos** a `/site/wwwroot/`

### Método 3: ZIP Deploy

1. **Comprimir tu proyecto** en `.zip`
2. **Kudu** → `Tools` → `Zip Push Deploy`
3. **Arrastrar el archivo**

---

## ✅ CHECKLIST DE VERIFICACIÓN

Marca lo que ya tienes:

- [ ] App Service creado ✅ (Ya lo tienes)
- [ ] Base de datos MySQL creada
- [ ] Variables de entorno configuradas
- [ ] Archivos subidos correctamente
- [ ] `web.config` en la raíz
- [ ] Carpeta `/public` con archivos PHP
- [ ] Logs activados para ver errores

---

## 🔍 DIAGNÓSTICO RÁPIDO

**Ejecuta esto en Kudu Console** (`site/wwwroot/`):

```bash
# Ver si existe web.config
dir web.config

# Ver si existe public/index.php
dir public\index.php

# Ver si existe config/database.php
dir config\database.php
```

---

## 💡 SOLUCIÓN RÁPIDA

Si quieres que funcione YA, necesitas:

1. **Variables de entorno** configuradas (sin esto NO funcionará)
2. **Base de datos** accesible desde Azure
3. **Archivos** correctamente desplegados

**¿Cuál de estos 3 te falta?**

---

## 📞 SIGUIENTE PASO

Dime:
1. ¿Ya configuraste las variables de entorno?
2. ¿Ya tienes una base de datos MySQL (en Azure o externa)?
3. ¿Qué ves en los logs de error?

Con esa información te ayudo a solucionar el problema específico.
