# Imagem base PHP-FPM
FROM php:8.2-fpm

# Instalar dependências do PHP e extensões necessárias
RUN apt-get update && apt-get install -y \
    zip unzip curl libzip-dev libpng-dev libonig-dev libxml2-dev netcat-openbsd \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd

# Copiar Composer do container oficial
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Definir diretório de trabalho
WORKDIR /var/www

# Copiar código da aplicação
COPY . .

# Instalar dependências PHP
RUN composer install --no-interaction --optimize-autoloader

# Ajustar permissões
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Copiar entrypoint
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

Definir entrypoint
ENTRYPOINT ["entrypoint.sh"]

# Comando padrão
CMD ["php-fpm"]
