#region ubuntu 16.04 with python ref. https://gist.github.com/monkut/c4c07059444fd06f3f8661e13ccac619
FROM ubuntu:16.04

# install php 7.3
RUN apt-get update
RUN apt-get install -y software-properties-common python-software-properties

RUN LC_ALL=C.UTF-8 add-apt-repository -y ppa:ondrej/php && \
    apt-get update

RUN apt-get install -y php7.3 php7.3-cli php7.3-common
RUN php -v  # should print php version

# install composer
RUN apt-get install -y curl
RUN curl -sS https://getcomposer.org/installer | php

RUN mv composer.phar   /usr/local/bin/composer && \
    chmod +x           /usr/local/bin/composer && \
    composer -V  # should print composer version

# install laravel
RUN apt-get install -y libapache2-mod-php7.3 php7.3-mbstring php7.3-xmlrpc php7.3-soap php7.3-gd php7.3-xml php7.3-cli php7.3-zip unzip
RUN apt-get install -y php7.3-mysql
RUN apt-get -y autoremove
RUN composer global require laravel/installer

RUN echo "export PATH=\"$HOME/.config/composer/vendor/bin:$PATH\" " >> $HOME/.bashrc


# create THIS_APP folder
WORKDIR /app

# generate laravel quickstart to /app/quickstart
RUN composer create-project laravel/laravel quickstart --prefer-dist  # should have :quickstart folder created aka the laravel skeleton app

# force-rebuild tag - change _x to new value to invalidate .venv/ and force a rerun
RUN echo 191122_x

#TODO bundle app source
#COPY . .

# copy .env used for dockerized mode - NOTE this .env is in folder bin/docker/ and to link the api container with the postgres container
COPY ./docker/.env .

# for documentation on port
EXPOSE 8000

# Default command when running container
# Run the api at 8000
CMD cd /app/quickstart; \
    composer install; \
    php artisan serve --port=8000 --host=0.0.0.0;
#    tail -f `mktemp`;
