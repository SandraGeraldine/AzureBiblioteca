#!/bin/bash
# Startup script for Azure App Service
echo "Starting PHP application..."

# Copiar configuración de nginx si existe
if [ -f /home/site/wwwroot/default.conf ]; then
    echo "Copiando configuración de nginx..."
    cp /home/site/wwwroot/default.conf /etc/nginx/sites-available/default
    nginx -s reload
    echo "Nginx configurado correctamente"
fi
