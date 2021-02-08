FROM php:7.2.30-fpm-buster

RUN apt-get update

RUN apt-get install -y git libpq-dev libzip-dev \
    && docker-php-ext-configure mysqli -with-mysqli=mysqlnd \
    && docker-php-ext-configure pdo_mysql -with-pdo-mysql=mysqlnd \
    && docker-php-ext-install pdo pdo_mysql mysqli \
    && docker-php-ext-install zip \
    && apt-get install -y curl \
    && apt-get install -y zlib1g-dev libicu-dev g++ \
    && apt-get install -y nodejs \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl

WORKDIR /var/www/html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN export COMPOSER_ALLOW_SUPERUSER=1

RUN echo "export PATH=$PATH:'$HOME/.composer/vendor/bin'" >> $HOME/.bashrc

RUN apt-get clean && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

CMD ["php-fpm"]
