FROM composer:2

FROM php:8.1-fpm-alpine3.14

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

ENV APCU_VERSION 5.1.17

RUN apk add --no-cache ca-certificates icu-libs git libtool zlib-dev
RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS icu-dev
RUN apk add --no-cache freetype libpng libjpeg libjpeg-turbo freetype-dev libpng-dev libjpeg-turbo-dev
RUN apk add --update --no-cache libzip-dev
RUN apk add --no-cache wkhtmltopdf xvfb ttf-dejavu ttf-droid ttf-freefont ttf-liberation

RUN docker-php-ext-install zip
RUN docker-php-ext-install intl exif
RUN apk add --no-cache  gnu-libiconv
ENV LD_PRELOAD /usr/lib/preloadable_libiconv.so
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install -j$(nproc) gd
RUN pecl install -o -f apcu
RUN docker-php-ext-enable apcu
RUN docker-php-ext-enable opcache
RUN docker-php-ext-enable exif
RUN docker-php-ext-install pdo_mysql
RUN echo "short_open_tag = off" >> /usr/local/etc/php/php.ini
RUN echo "memory_limit = -1" >> /usr/local/etc/php/php.ini
RUN echo "date.timezone = Europe/Paris" >> /usr/local/etc/php/conf.d/symfony.ini
RUN echo "opcache.max_accelerated_files = 20000" >> /usr/local/etc/php/conf.d/symfony.ini
RUN echo "realpath_cache_size=4096K" >> /usr/local/etc/php/conf.d/symfony.ini
RUN echo "realpath_cache_ttl=600" >> /usr/local/etc/php/conf.d/symfony.ini
RUN echo "memory_limit = -1" >> /usr/local/etc/php/conf.d/symfony.ini
RUN apk del .build-deps
RUN apk add gosu --update --no-cache --repository http://dl-3.alpinelinux.org/alpine/edge/testing/ --allow-untrusted
RUN addgroup bar
RUN adduser -D -h /home -s /bin/sh -G bar foo
RUN composer config --global --auth http-basic.odiseo.repo.packagist.com token b433584843525ee115f9aa6ee28a4ee76428e0a73c38c8631f0c7093f3bf

ADD entrypoint.sh /entrypoint

ENTRYPOINT ["/entrypoint"]
