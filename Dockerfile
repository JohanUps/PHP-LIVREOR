FROM php:8.4-apache

#Copier le projet directement dans Apache
COPY . /var/www/html/

