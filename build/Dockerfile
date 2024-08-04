# ---------------- base
FROM php:8.3.8-apache AS base

ENV APACHE_DOCUMENT_ROOT /var/www/html

ENV ACCEPT_EULA=Y

# Fix debconf warnings upon build
ARG DEBIAN_FRONTEND=noninteractive

COPY build/configs/vhost.conf /etc/apache2/sites-available/000-default.conf
COPY build/scripts /scripts

RUN apt-get update -yq && \
    apt-get install -yq git zip iputils-ping iproute2 tzdata apt-utils gnupg2 apt-transport-https zip unzip libcurl3-dev zlib1g-dev libfreetype6-dev nano \
    libpng-dev libzip-dev locales && \
    locale-gen && \
    apt-get clean && \
    docker-php-ext-install -j$(nproc) pdo_mysql bcmath exif gd zip opcache pcntl sockets && \
    a2enmod rewrite

RUN curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add - \
    && curl https://packages.microsoft.com/config/debian/9/prod.list > /etc/apt/sources.list.d/mssql-release.list \
    && apt-get update \
    && apt-get -y --no-install-recommends install msodbcsql17 unixodbc-dev \
    && pecl install sqlsrv \
    && pecl install pdo_sqlsrv \
    && echo "extension=pdo_sqlsrv.so" >> `php --ini | grep "Scan for additional .ini files" | sed -e "s|.*:\s*||"`/30-pdo_sqlsrv.ini \
    && echo "extension=sqlsrv.so" >> `php --ini | grep "Scan for additional .ini files" | sed -e "s|.*:\s*||"`/30-sqlsrv.ini \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

ENTRYPOINT ["bash", "/scripts/entrypoint.sh"]
CMD ["apache2-foreground"]

# ---------------- local
FROM base AS local

ARG UID=1000
ARG GID=1000

COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

RUN apt-get update -yq \
    && apt-get install -yq vim gnupg graphviz \
    && usermod -u $UID www-data \
    && groupmod -g $GID www-data \
    && usermod -g $GID www-data

