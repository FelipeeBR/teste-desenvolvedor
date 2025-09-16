FROM php:8.2-cli

RUN apt-get update && apt-get install -y \
    unzip \
    zip \
    git \
    curl \
    libzip-dev \
    && docker-php-ext-install pcntl zip pdo pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

ENV HOME="/root"
ENV PATH="/root/.composer/vendor/bin:${PATH}:/root/.bun/bin"
RUN curl -fsSL https://bun.sh/install | bash && \
    ln -s $(which bun) /usr/local/bin/npm && \
    ln -s $(which bunx) /usr/local/bin/npx

RUN composer global require laravel/installer

WORKDIR /app

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]