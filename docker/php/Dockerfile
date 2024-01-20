FROM php:8.2.14-cli

RUN apt-get update
RUN apt-get install libpq-dev -y
RUN docker-php-ext-configure pgsql --with-pgsql=/usr/local/pgsql
RUN docker-php-ext-install pdo_pgsql pgsql
RUN docker-php-ext-enable pdo_pgsql

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
  php -r "if (hash_file('sha384', 'composer-setup.php') === 'e21205b207c3ff031906575712edab6f13eb0b361f2085f1f1237b7126d785e826a450292b6cfd1d64d92e6563bbde02') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
  php composer-setup.php && \
  php -r "unlink('composer-setup.php');" && \
  mv composer.phar /usr/local/bin/composer

WORKDIR /var/www

CMD tail -f /dev/null

