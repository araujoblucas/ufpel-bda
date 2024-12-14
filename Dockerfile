# Usar a imagem base
FROM php:8.3-fpm-alpine

# Criar um usuário e grupo
RUN addgroup -g 1000 appuser && \
    adduser -D -u 1000 -G appuser -s /bin/sh appuser

# Instalar dependências do sistema
RUN apk update && apk add --no-cache \
    curl \
    libpng-dev \
    oniguruma-dev \
    libxml2-dev \
    libzip-dev \
    icu-dev \
    zip \
    unzip \
    dcron \
    redis \
    net-tools \
    procps \
    && docker-php-ext-configure intl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd intl zip

# Definir o diretório de trabalho
WORKDIR /var/www

# Copiar o código do projeto para o container
COPY ./ /var/www/

# Instalar o Composer antes de alterar o usuário
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instalar dependências do Composer se o composer.json existir
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Definir permissões para o novo usuário
RUN chown -R appuser:appuser /var/www

# Mudar para o novo usuário
USER appuser

# Configurar o ambiente
RUN if [ -f ".env.example" ]; then cp .env.example .env; else echo ".env.example not found"; fi

# Cache de configurações e rotas
RUN php artisan config:cache && php artisan route:cache

# Comando padrão para rodar o PHP-FPM
CMD ["php-fpm"]
