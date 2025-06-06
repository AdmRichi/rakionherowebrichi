# Usa la imagen oficial de PHP con Apache
FROM php:8.1-apache

# Copia todo el contenido de tu proyecto a la carpeta raíz del servidor web Apache
COPY . /var/www/html/

# Expone el puerto 80 para que Render sepa por dónde acceder
EXPOSE 80