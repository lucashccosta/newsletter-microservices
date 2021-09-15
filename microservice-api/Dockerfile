FROM php:fpm

RUN apt-get update \
    && apt-get upgrade \
    && apt-get install -y libzip-dev librdkafka-dev \
    && pecl install rdkafka \
    && rm -rf /tmp/pear \
    && echo "extension=rdkafka.so" > /usr/local/etc/php/conf.d/rdkafka.ini

RUN docker-php-ext-install pdo pdo_mysql mysqli zip
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app
COPY . /app
RUN mv .env.example .env
RUN composer install --no-dev --no-interaction --optimize-autoloader
EXPOSE 9090
CMD ["php", "-S", "0.0.0.0:9090", "-t", "public"]