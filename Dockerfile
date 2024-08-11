FROM alpine:latest

LABEL maintainer="Lucian DOGARU (Rolsoftware)"
LABEL description="Docker image for laravel application"

WORKDIR /app

# Set Timezone
ENV TZ=Europe/Bucharest
RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

# Install packages and remove default server definition
RUN apk add --no-cache \
  bash \
  libgcc libc6-compat \
  curl \
  zip \
  unzip \
  nginx \
  php83 \
  php83-ctype \
  php83-curl \
  php83-dom \
  php83-fileinfo \
  php83-fpm \
  php83-gd \
  php83-intl \
  php83-mbstring \
  php83-mysqli \
  php83-opcache \
  php83-openssl \
  php83-pdo_mysql \
  php83-phar \
  php83-session \
  php83-tokenizer \
  php83-xml \
  php83-xmlreader \
  php83-xmlwriter \
  php83-simplexml \
  php83-pcntl \
  php83-posix \
  php83-iconv \
  php83-zip \
  php83-ldap \
  php83-ftp \
  supervisor

# Copy Configuration
COPY /docker/ /

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

# Make sure files/folders needed by the processes are accessable when they run under the nobody user
RUN mkdir -p /var/log/php83
RUN chown -R nobody.nobody /app /run /var/lib/nginx /var/log/nginx /var/log/php83
RUN chmod -R 775 /app

# Copy docker-entrypoint
RUN chmod +x /usr/local/bin/docker-entrypoint

# Update CA Certificates
RUN /usr/sbin/update-ca-certificates

USER nobody

COPY --chown=nobody . /app

# Install dependencies
RUN composer install --no-dev

# Let supervisord start nginx & php-fpm
CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]

EXPOSE 80

ENTRYPOINT ["/usr/local/bin/docker-entrypoint"]
