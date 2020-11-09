FROM php:7.3.6-apache-stretch

RUN apt-get update && apt-get install -y \
  wget \
  git

# Configurações do apache (virtualhost)
COPY dev.conf /etc/apache2/sites-enabled/000-default.conf

RUN a2enmod rewrite

RUN docker-php-ext-install pdo pdo_mysql

# Instalação e configuração do XDebug
RUN yes | pecl install xdebug \
    && echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_handler=dbgp" >>  /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_port=9000" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_autostart=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_connect_back=on" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.idekey=docker" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.remote_log=/var/log/xdebug.log" >> /usr/local/etc/php/conf.d/xdebug.ini \
    && echo "xdebug.default_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini


WORKDIR /var/www/html/