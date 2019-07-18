ref. https://github.com/petehouston/laravel-docs-vn
ref. https://laravel.com/docs/5.8
  
php 7.3 and the composer ref. https://laravel.com/docs/5.8
```bash
sudo su

apt update 
apt upgrade -y
apt -y autoremove

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
php -v # should print php version 

# install composer
curl -sS https://getcomposer.org/installer | php
mv composer.phar   /usr/local/bin/composer
chmod +x           /usr/local/bin/composer
composer -V # should print composer version
```


# install laravel 
```bash
# requires php 7.3 installed to proceed

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
install docker ref. https://gist.github.com/namgivu/536ae64983b515026bd5d5c908668207
```bash
apt remove docker docker-engine docker.io

apt install -y apt-transport-https ca-certificates curl software-properties-common
curl -fsSL https://download.docker.com/linux/ubuntu/gpg | apt-key add - ; apt-key fingerprint 0EBFCD88; add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/ubuntu $(lsb_release -cs) stable"

apt update; apt install -y docker.io
echo; docker -v
```

install docker-compose
```bash
latestUrl=`curl -s https://github.com/docker/compose/releases/latest | grep -Eo "(http[^\"]+)"` #sample result of this command https://github.com/docker/compose/releases/tag/1.17.1
version=`echo "$latestUrl" | cut -d '/' -f8` #bash split string and get nth element ref. https://unix.stackexchange.com/a/312281/17671

curl -L "https://github.com/docker/compose/releases/download/$version/docker-compose-`uname -s`-`uname -m`" > ./docker-compose
mv ./docker-compose /usr/bin/docker-compose; chmod +x /usr/bin/docker-compose
```

run mariadb aka mysql
download folder at https://gist.github.com/namgivu/faad68e6163e0faf4d410fd8faab5865
eg to folder ~/mysql-mariadb-docker
```bash
cd ~/mysql-mariadb-docker
./start.sh
```

# quick start laravel
ref. https://github.com/laravel/quickstart-basic
ref. https://laravel.com/docs/5.2/quickstart

create migration script
```bash
php artisan make:migration create_schema_w_seeding_0th --create=abbccc
```


TODO run sql script with laravel migration, how?
```php
ref. https://stackoverflow.com/q/28787293/248616

DB::statement(<<<EOS
    CREATE TABLE users(
        id SERIAL;
        email TEXT;
    ) ENGINE=InnoDB;
EOS);
```
