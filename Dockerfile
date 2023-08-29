# Use uma imagem base do PHP com Apache
FROM php:apache

# Copie os arquivos do projeto para o diretório do Apache
COPY . /var/www/html/
