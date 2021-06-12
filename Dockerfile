FROM php:8-apache
COPY index.php /var/www/html/
COPY flag.html /var/www/html/
COPY .htaccess /var/www/html/
