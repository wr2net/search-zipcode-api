FROM php:7.4-cli

WORKDIR /var/www

COPY . .

EXPOSE 8000

RUN apt-get update && \
    apt-get install libzip-dev -y && \
    apt-get install nano -y && \
    docker-php-ext-install zip
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN cp .env.example .env
RUN composer install

ENTRYPOINT [ "php", "artisan", "serve" ]

CMD [ "--host=0.0.0.0" ]
