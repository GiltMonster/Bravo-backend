# Imagem base com PHP, Composer e extensões necessárias
FROM php:8.3-fpm

# Instala dependências de sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    unzip \
    zip \
    libzip-dev \
    libpq-dev \
    libcurl4-openssl-dev \
    pkg-config \
    libssl-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath

# Instala o Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Cria diretório da aplicação
WORKDIR /var/www

# Copia arquivos da aplicação
COPY . .

# Instala dependências do Laravel
RUN composer install --no-dev --optimize-autoloader

# Ajusta permissões
RUN chown -R www-data:www-data /var/www \
    && chmod -R 755 /var/www/storage /var/www/bootstrap/cache

# Expõe a porta que o Railway usa
EXPOSE 8080

# Comando para subir o servidor Laravel (via PHP embutido)
CMD php artisan serve --host=0.0.0.0 --port=8000
