# 📘 Instrucciones para Configurar Azure App Service

## 🎯 Objetivo
Configurar Azure para que sirva la aplicación desde la carpeta `/public`

---

## ✅ PASO 1: Hacer Push de los Cambios

Ejecuta estos comandos en tu terminal:

```bash
git add .
git commit -m "Configurar Document Root para Azure"
git push origin main
```

Espera 1-2 minutos para que GitHub Actions despliegue automáticamente.

---

## ✅ PASO 2: Configurar Startup Command en Azure

### Opción A: Desde el Portal de Azure (Recomendado)

1. **Abre el Portal de Azure**: https://portal.azure.com
2. **Busca tu App Service**: `biblioteca-senati`
3. En el menú lateral, ve a: **Configuración** → **Configuración general**
4. Busca el campo **"Comando de inicio"** o **"Startup Command"**
5. Pega este comando:
   ```bash
   /home/site/wwwroot/startup.sh
   ```
6. Haz clic en **Guardar**
7. Haz clic en **Reiniciar** (botón en la parte superior)

### Opción B: Desde Azure CLI

Si prefieres usar la terminal:

```bash
az webapp config set --resource-group <TU_RESOURCE_GROUP> --name biblioteca-senati --startup-file "/home/site/wwwroot/startup.sh"
az webapp restart --resource-group <TU_RESOURCE_GROUP> --name biblioteca-senati
```

---

## ✅ PASO 3: Verificar la Configuración

Después de reiniciar, abre estas URLs:

### 1. Página Principal
```
https://biblioteca-senati-f5cbfwhzfzf2htea.westus3-01.azurewebsites.net/
```
Debería mostrar tu aplicación CRUD de libros.

### 2. Debug (para verificar configuración)
```
https://biblioteca-senati-f5cbfwhzfzf2htea.westus3-01.azurewebsites.net/debug.php
```
Debería mostrar información del servidor.

### 3. Setup (para crear la tabla)
```
https://biblioteca-senati-f5cbfwhzfzf2htea.westus3-01.azurewebsites.net/setup.php
```
Ejecuta esto **UNA VEZ** para crear la tabla `libros` en la base de datos.

---

## 🔍 Solución de Problemas

### Si sigue mostrando 404:

1. **Verifica los logs de Azure:**
   - En el portal: **Supervisión** → **Secuencia de registro**
   - Busca errores de nginx o PHP

2. **Verifica que el startup.sh se esté ejecutando:**
   - Ve a **Herramientas de desarrollo** → **SSH**
   - Ejecuta: `cat /etc/nginx/sites-available/default`
   - Deberías ver `root /home/site/wwwroot/public;`

3. **Verifica los archivos:**
   - En SSH ejecuta: `ls -la /home/site/wwwroot/public/`
   - Deberías ver `index.php`, `crear.php`, etc.

### Si muestra error de base de datos:

1. **Verifica las variables de entorno:**
   - Ve a **Configuración** → **Variables de entorno**
   - Asegúrate de que estén configuradas:
     - `AZURE_MYSQL_HOST`
     - `AZURE_MYSQL_DBNAME` = `biblioteca-senati`
     - `AZURE_MYSQL_USERNAME`
     - `AZURE_MYSQL_PASSWORD`
     - `AZURE_MYSQL_PORT` = `3306`

2. **Ejecuta el setup:**
   - Abre: `https://tu-app.azurewebsites.net/setup.php`
   - Esto creará la tabla `libros` automáticamente

---

## 📋 Checklist Final

- [ ] Hice push de los cambios a GitHub
- [ ] Configuré el Startup Command en Azure
- [ ] Reinicié el App Service
- [ ] Verifiqué que la URL principal funciona
- [ ] Ejecuté el setup.php para crear la tabla
- [ ] La aplicación CRUD funciona correctamente

---

## 🆘 ¿Necesitas Ayuda?

Si algo no funciona, comparte:
1. Captura del error que ves
2. Logs de Azure (Secuencia de registro)
3. Resultado de `/debug.php`

---

**¡Éxito con tu proyecto SENATI! 🎓🚀**
