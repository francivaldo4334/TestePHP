FROM php:8.4-fpm

# Instala dependências do sistema e bibliotecas para o PDF (Snappy)
RUN apt-get update && apt-get install -y \
    libxrender1 \
    libfontconfig1 \
    libxext6 \
    unzip \
    curl \
    libzip-dev \
    libxml2-dev

# Instala extensões do PHP
RUN docker-php-ext-install pdo_mysql zip

# Copia o Composer de forma segura
# Se o --from falhar, usamos o método direto
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

WORKDIR /app
