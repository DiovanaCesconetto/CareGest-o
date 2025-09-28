FROM laravelsail/php84-composer

# Instalar intl
RUN apt-get update && apt-get install -y libicu-dev \
    && docker-php-ext-install intl
