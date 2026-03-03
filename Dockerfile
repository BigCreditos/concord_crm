FROM php:8.2-fpm-alpine

# Arguments for user/group IDs
ARG user=www-data
ARG uid=1000

# Install system dependencies
RUN apk add --no-cache \
    curl \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    icu-dev \
    libxml2-dev \
    libzip-dev \
    imap-dev \
    krb5-dev \
    openssl-dev \
    shadow \
    mysql-client

# Configure and install PHP extensions
RUN docker-php-ext-configure imap --with-kerberos --with-imap-ssl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install \
    pdo_mysql \
    gd \
    intl \
    xml \
    zip \
    bcmath \
    imap \
    opcache

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy existing application directory contents
COPY . /var/www/html

# Set permissions
RUN chown -R ${user}:${user} /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Switch to non-root user
USER ${user}

EXPOSE 9000
CMD ["php-fpm"]
