FROM php:7.3-apache 

RUN apt-get update \ 
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install intl \
    && apt-get -y install \
            libmagickwand-dev \
        --no-install-recommends \
    && pecl install imagick \
    && docker-php-ext-enable imagick \
    && rm -r /var/lib/apt/lists/* \
    && a2enmod rewrite 
