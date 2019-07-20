install php7.3, composer, laravel 
ref. https://github.com/namgivu/laravel-start/blob/doc/_doc_/laravel-note/effort01.md

now learn the laravel quickstart
ref. https://laravel.com/docs/5.2/quickstart

on github
ref. https://github.com/laravel/quickstart-basic

# get mysql 3306 via docker
ref. https://gist.githubusercontent.com/namgivu/faad68e6163e0faf4d410fd8faab5865/

d=mysql-mariadb-docker; mkdir -p $d; cd $d
    wget https://gist.githubusercontent.com/namgivu/faad68e6163e0faf4d410fd8faab5865/raw/70d96c9d5519d262d41f52857c991628491ccaaf/docker-compose.yml
    wget https://gist.githubusercontent.com/namgivu/faad68e6163e0faf4d410fd8faab5865/raw/70d96c9d5519d262d41f52857c991628491ccaaf/start.sh
    wget https://gist.githubusercontent.com/namgivu/faad68e6163e0faf4d410fd8faab5865/raw/70d96c9d5519d262d41f52857c991628491ccaaf/stop.sh
    
    chmod +x start.sh stop.sh
    
    ./start.sh
    
    docker exec -it  nn_mariadb  mysql --version  # should see version
cd -

# create database :quickstart
alias dmysql='docker exec -it  nn_mariadb  mysql -uroot -proot'
dmysql -e 'DROP DATABASE IF EXISTS quickstart;'
dmysql -e 'CREATE DATABASE quickstart;'

: optional view 
dmysql -e 'SHOW DATABASES'
dmysql quickstart -e 'SHOW TABLES'

# generate app skeleton
cd :THIS_PROJECT
composer create-project laravel/laravel quickstart --prefer-dist  # should have :quickstart folder created aka the laravel skeleton app

# config  mysql connection @ laravel app :quickstart 
cd quickstart
nano .env # update below entries with correct mysql connection info 

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=quickstart
DB_USERNAME=root
DB_PASSWORD=root
    
# create :tasks table @ create migration script
cd quickstart
    php artisan make:migration create_tasks_table --create=tasks; 
    f=`find -name "*create*tasks*table*"`; ll $f
    nano $f  # edit the file to add column :name $table->string('name');
cd -

# create :tasks table @ run migration script
php artisan migrate  # should success
                     # TODO after this `artisan migrate`, how to reset migration head? aka what records the current run migration? aka what helps to print 'Nothing to migrate.' when run again?

dmysql -e 'SHOW TABLES'  # should see :tasks table in the list
dmysql -e 'SHOW TABLES' | grep tasks

cd -

# create Eloquent model
php artisan make:model Task  # model file be created at `app/Task.php`

more detail on ref. https://github.com/laravel/quickstart-basic
