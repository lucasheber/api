FROM php:8.4-cli AS stage

# install dependencies
RUN apt-get update && \
    apt-get install -y \
    libzip-dev \
    unzip \
    git \
    libpq-dev \
    && docker-php-ext-install pdo_pgsql \
    && docker-php-ext-install zip

# install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# set working directory
WORKDIR /var/www/html

# copy files
COPY index.php .
COPY composer.json .
COPY src/ /var/www/html/src

# install PHP dependencies
RUN composer install --no-dev --no-scripts --no-progress --prefer-dist

FROM php:8.4-cli-alpine AS production
WORKDIR /var/www/html

COPY --from=stage /var/www/html /var/www/html

# expose port 8080
EXPOSE 8080

# run PHP's built-in server on port 8080
CMD ["php", "-S", "0.0.0.0:8080", "index.php"]