FROM php:8.0-apache

RUN apt-get update && apt-get install -y sqlite3 libsqlite3-dev

WORKDIR /var/www/html/

COPY ./Src .

RUN chown -R root:www-data /var/www/html
RUN chmod 777 /var/www/html

RUN find . -type d -exec chmod 750 {} \;
RUN find . -type f -exec chmod 640 {} \;
