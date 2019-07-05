ref. https://github.com/petehouston/laravel-docs-vn
ref. https://laravel.com/docs/5.8

php 7.3 ref. https://laravel.com/docs/5.8
```bash
apt update 
apt upgrade -y

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

# install laravel 
apt install -y libapache2-mod-php7.3 php7.3-mbstring php7.3-xmlrpc php7.3-soap php7.3-gd php7.3-xml php7.3-cli php7.3-zip
apt install -y unzip
apt -y autoremove

composer global require laravel/installer

cat << EOF >> ~/.bashrc
export PATH="$HOME/.config/composer/vendor/bin:$PATH"
EOF

laravel -v

cd ~
    laravel new blog
    ls # should see blog
    
    : open droplet firewall to allow port 8000 ref.  
    
# start the web app
cd ~/blog; php artisan serve --host 0.0.0.0 --port 8000
```

install virtualbox ref. https://askubuntu.com/a/849695/22308
sudo apt install -y virtualbox
