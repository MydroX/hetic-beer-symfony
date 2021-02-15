FROM php:8.0.2-fpm-alpine3.13

RUN apk add --no-cache ca-certificates \
    bash \
    git \
    curl \
    sudo \
    nodejs=14.15.4-r0 \
    npm=14.15.4-r0

COPY docker/api/php.ini /usr/local/etc/php/conf.d/local.ini  

COPY . /var/www/app

WORKDIR /var/www/app

# RUN curl -fsSL https://deb.nodesource.com/setup_15.x | sudo -E bash -
# RUN apk add -y nodejs

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ENTRYPOINT [ "/var/www/app/docker/entrypoint.sh" ]