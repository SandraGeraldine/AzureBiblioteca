#!/bin/bash
# Startup script for Azure App Service
echo "Iniciando aplicación PHP..."

# Configurar nginx para servir desde /public
echo " Configurando Document Root a /public..."

# Crear configuración de nginx
cat > /etc/nginx/sites-available/default <<'EOF'
server {
    listen 8080;
    listen [::]:8080;
    root /home/site/wwwroot/public;
    index index.php index.html;
    
    server_name _;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location ~ \.php$ {
        include fastcgi_params;
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
    }
    
    location ~ /\.(?!well-known).* {
        deny all;
    }
}
EOF

# Recargar nginx
nginx -s reload
echo "Nginx configurado correctamente"
echo "Document Root: /home/site/wwwroot/public"
