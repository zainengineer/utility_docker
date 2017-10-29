FROM php:7-apache
#An example https://github.com/docker-library/php/issues/75#issuecomment-235773906
RUN apt-get update
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
ADD util/build/xdebug.ini /usr/local/etc/php/conf.d/20-xdebug.ini
RUN sed -e "s/%XDEBUG_REMOTE_HOST%/`/sbin/ip route|awk '/default/ { print $3 }'`/" \
        -i /usr/local/etc/php/conf.d/20-xdebug.ini
RUN apt-get install -y libyaml-dev
RUN pecl install yaml
RUN docker-php-ext-enable yaml
