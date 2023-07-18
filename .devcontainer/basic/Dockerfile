# [Choice] PHP version (use -bullseye variants on local arm64/Apple Silicon): 8-apache-bookworm, 8.2-apache-bookworm, 8.1-apache-bookworm, 8-apache-bullseye, 8.2-apache-bullseye, 8.1-apache-bullseye, 8.0-apache-bullseye, 8-apache-buster, 8.2-apache-buster, 8.1-apache-buster, 8.0-apache-buster
ARG VARIANT=8.2-apache-bookworm
FROM php:${VARIANT}

# Install xdebug
RUN yes | pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.mode = debug" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.start_with_request = yes" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.client_port = 9000" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && rm -rf /tmp/pear

# Install composer
RUN curl -sSL https://getcomposer.org/installer | php \
    && chmod +x composer.phar \
    && mv composer.phar /usr/local/bin/composer

# Install package dependencies for PHP extensions
RUN apt-get update && export DEBIAN_FRONTEND=noninteractive \
    && apt-get -y install --no-install-recommends zlib1g-dev libpng-dev libicu-dev librabbitmq-dev

# Install PHP extensions
RUN docker-php-ext-configure gd \
    && docker-php-ext-install -j$(nproc) gd intl \
    && pecl install amqp \
    && pecl install redis \
    && docker-php-ext-enable amqp redis