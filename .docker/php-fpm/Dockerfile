FROM php:8.2.27-fpm-alpine

# Arguments defined in docker-compose.yml
ARG GROUP
ARG UID

# Enviorement
ENV TZ=America/Sao_Paulo

RUN apk --no-cache --update add curl tzdata shadow \
&& docker-php-ext-install pdo pdo_mysql \
&& usermod -u $UID $GROUP \
&& apk del \
&& rm -Rf /var/cache/apk/*

COPY --from=composer:2.8.8 /usr/bin/composer /usr/bin/composer