# Use uma imagem base do PHP com Apache
FROM php:apache

# Instala o módulo MySQLi
RUN docker-php-ext-install mysqli

# Copie os arquivos do projeto para o diretório do Apache
COPY . /var/www/html/
