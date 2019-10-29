ref. https://github.com/petehouston/laravel-docs-vn
ref. https://laravel.com/docs/5.8
  
php 7.3 and the composer ref. https://laravel.com/docs/5.8
```bash
sudo su

# update system
apt update ; apt install -y; apt -y autoremove

# install apache2
apt install -y apache2
systemctl start apache2
systemctl enable apache2
systemctl status apache2

# install php 7.3
apt install -y software-properties-common python-software-properties
LC_ALL=C.UTF-8 add-apt-repository -y ppa:ondrej/php
apt update
apt install -y php7.3 php7.3-cli php7.3-common
php -v  # should print php version 

# install composer
curl -sS https://getcomposer.org/installer | php
mv composer.phar   /usr/local/bin/composer
chmod +x           /usr/local/bin/composer
composer -V  # should print composer version
```


# install laravel 
requires php 7.3 and composer installed to proceed
```bash

apt install -y libapache2-mod-php7.3 php7.3-mbstring php7.3-xmlrpc php7.3-soap php7.3-gd php7.3-xml php7.3-cli php7.3-zip unzip
apt install -y php7.3-mysql
apt -y autoremove

composer global require laravel/installer

cat << EOF >> ~/.bashrc
export PATH="$HOME/.config/composer/vendor/bin:$PATH"
EOF
```


# laravel blog app
```bash
laravel -V

cd ~
    laravel new blog
    ls # should see blog
    
    : open droplet firewall to allow port 8000 ref.  
    
# start the web app
cd ~/blog; php artisan serve --host 0.0.0.0 --port 8000
```

# install mysql via docker container
install docker and docker-compose ref. bit.ly/nndocker
run mariadb aka mysql ref. https://github.com/namgivu/docker-compose-services/tree/master/mysql-mariadb


# quick start laravel
ref. https://github.com/laravel/quickstart-basic
ref. https://laravel.com/docs/5.2/quickstart

create migration script
```bash
php artisan make:migration create_schema_w_seeding_0th --create=abbccc
```

run sql script with laravel migration ref. https://stackoverflow.com/q/28787293/248616
```php
DB::statement(<<<EOS
    CREATE TABLE users(
        id SERIAL;
        email TEXT;
    ) ENGINE=InnoDB;
EOS);
```
