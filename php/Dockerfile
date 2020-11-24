FROM php:7.3-fpm
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-install -j$(nproc) iconv \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd

RUN docker-php-ext-install json

RUN \
  curl 'http://pecl.php.net/get/redis-5.3.2.tgz' -o /tmp/redis-5.3.2.tgz  \
  && cd /tmp \
  && pecl install redis-5.3.2.tgz \
  && rm -rf redis-5.3.2.tgz \
  && docker-php-ext-enable redis \