FROM debian:testing

ARG baseurl
ENV full_baseurl=/$baseurl
ENV COMPOSER_ALLOW_SUPERUSER=1

WORKDIR /src
ADD . /src

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

RUN composer install


VOLUME /src
ENTRYPOINT service mariadb start && mysql < build/leaf_ota.sql && bin/console -e prod stenope:build --base-url=/$full_baseurl ./build/static && chmod a+rw -R build
