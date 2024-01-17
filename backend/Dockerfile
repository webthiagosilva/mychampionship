FROM php:8.2-apache

ENV APACHE_DOCUMENT_ROOT /var/www/html/backend/public

ENV APPLICATION_PORT 8000
RUN sed -i "s/80/$APPLICATION_PORT/g" /etc/apache2/sites-available/000-default.conf /etc/apache2/ports.conf

RUN apt-get update && apt-get install -y \
        libpng-dev \
        libonig-dev \
        libjpeg62-turbo-dev \
        libfreetype6-dev \
        libzip-dev \
        unzip \
        zip \
        git && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install -j$(nproc) gd pdo_mysql mbstring zip && \
    rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY backend/ /var/www/html/backend

COPY --chmod=755 backend/.build/dir-permissions.sh /usr/local/bin/dir-permissions

WORKDIR /var/www/html/backend

RUN composer install --no-interaction --no-dev --optimize-autoloader

RUN sed -i -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -i -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN a2enmod rewrite

EXPOSE 8000

CMD ["/bin/bash", "-c", "dir-permissions && apache2-foreground"]
