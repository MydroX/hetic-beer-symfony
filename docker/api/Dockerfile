FROM php:8.0.2-fpm-alpine3.13

RUN apk add --no-cache ca-certificates \
    bash \
    git \
    sudo

RUN docker-php-ext-install mysqli pdo pdo_mysql

COPY docker/api/php.ini /usr/local/etc/php/conf.d/local.ini  

COPY . /var/www/app

WORKDIR /var/www/app

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ENTRYPOINT [ "/var/www/app/docker/entrypoint.sh" ]