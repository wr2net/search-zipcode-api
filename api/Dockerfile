FROM php:7.4-cli

WORKDIR /var/www

RUN apt-get update
RUN apt-get install libzip-dev -y
RUN docker-php-ext-install zip pdo pdo_mysql

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer;

COPY . /var/www

CMD bash -c "composer install && php artisan serve --host 0.0.0.0 --port 8000"
