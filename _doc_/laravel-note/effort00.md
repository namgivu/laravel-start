CAUTION This guide is obsolete - please go for ./effort01.md

# get started on ubuntu 16
ref. https://www.rosehosting.com/blog/install-laravel-on-ubuntu-16-04/

get php, composer and laravel binaries ready
```bash
sudo apt update
sudo apt install -y software-properties-common
sudo add-apt-repository -y ppa:ondrej/php
sudo apt update
sudo apt upgrade -y
sudo apt -y autoremove

sudo apt install -y php7.2 
sudo apt install -y libapache2-mod-php7.2 php7.2-mbstring php7.2-xmlrpc php7.2-soap php7.2-gd php7.2-xml php7.2-cli php7.2-zip
sudo apt install -y unzip

curl -sS https://getcomposer.org/installer | php

sudo mv composer.phar   /usr/local/bin/composer
sudo chmod +x           /usr/local/bin/composer
```

apply laravel to your code
```bash
APP_HOME='/var/www/html/your_website'

sudo rm -rf         $APP_HOME
sudo mkdir -p       $APP_HOME
sudo chown ubuntu:  $APP_HOME

cd $APP_HOME
    git clone https://github.com/laravel/laravel.git .

# install required php packages
composer install

# generate app key
cp .env.example .env
php artisan key:generate # key generated to .env file ref. https://stackoverflow.com/a/33701687/248616
cat .env | grep APP_KEY # should see key

nano config/app.php
# enter app key to 'key' => env('APP_KEY', 'your key here') #TODO make bash command for this

sudo chown www-data: -R $APP_HOME
```

register as apache site
```bash
echo << EOF | sudo tee '/etc/apache2/sites-available/your_website.conf'
<VirtualHost *:80>
    ServerAdmin  admin@your_domain.com
    DocumentRoot /var/www/html/your_website/public/
    ServerName   35.187.224.27
    ServerAlias  35.187.224.27
    
    <Directory /var/www/html/your_website/>
        Options FollowSymLinks
        AllowOverride All
        Order allow,deny
        allow from all
    </Directory>
    
    ErrorLog    /var/log/apache2/your_website-error_log
    CustomLog   /var/log/apache2/your_website-access_log common
</VirtualHost>
EOF

sudo a2ensite your_website.conf
sudo service apache2 reload
```
