FROM debian:testing

ENV COMPOSER_ALLOW_SUPERUSER=1

# Install mysql
RUN apt-get -y update
RUN apt-get -y install mariadb-server

# Install php
RUN apt-get -y install php php-mysql php-xml php-zip

# Install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && mv composer.phar /usr/local/bin/composer

VOLUME /src
ENTRYPOINT ["/bin/bash", "/src/preview.sh"]
