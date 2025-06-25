FROM php:8.2-apache 

# Instala dependências necessárias
RUN apt-get update && apt-get install -y --no-install-recommends \
    autoconf \
    build-essential \
    apt-utils \
    zlib1g-dev \
    libzip-dev \
    unzip \
    zip \
    libmagick++-dev \
    libmagickwand-dev \
    libpq-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    unixodbc \
    unixodbc-dev \
    freetds-dev \
    freetds-bin \
    tdsodbc \
    curl \
 && rm -rf /var/lib/apt/lists/*

# Configura e instala extensões PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-configure pdo_dblib --with-libdir=/lib/x86_64-linux-gnu \
 && docker-php-ext-install \
    gd \
    intl \
    opcache \
    pdo_mysql \
    pdo_pgsql \
    mysqli \
    zip \
    pdo_dblib \
    soap

# Instala e habilita o Xdebug
RUN pecl install xdebug \
 && docker-php-ext-enable xdebug

# Instala Composer
RUN curl -sS https://getcomposer.org/installer | php \
 && mv composer.phar /usr/local/bin/composer

# Configura limites de upload
RUN echo "file_uploads = On\n" \
         "memory_limit = 500M\n" \
         "upload_max_filesize = 500M\n" \
         "post_max_size = 500M\n" \
         "max_execution_time = 600\n" \
         "max_input_vars=5000\n" \
         > /usr/local/etc/php/conf.d/uploads.ini

# Configura o diretório de trabalho
WORKDIR /var/www/html

# Ativa o módulo de reescrita do Apache
RUN a2enmod rewrite

EXPOSE 80
