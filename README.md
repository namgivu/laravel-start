```bash

: #ide deps PhpStorm, its plugin Laravel-xxx

: #app skeleton
t=$(mktemp -d) #create temp folder ref. https://stackoverflow.com/a/21564182/248616
composer create-project laravel/laravel "$t" --prefer-dist

CODE="$HOME/NN/code/_NN_/laravel-sfs"
cp -r "$t/." "$CODE"

: #install per-project homestead ref. $HOME/NN/code/_NN_/nn-tech/180101-1000.laravel-0th/00c.vagrant-per-project.md
HOMESTEAD_VERSION='6.6.0' &&\
  composer require laravel/homestead ^${HOMESTEAD_VERSION} --dev &&\
  php vendor/bin/homestead make
  
  
: #database prep
cd "$CODE"
php artisan make:migration create_tasks_table --create=tasks

vagrant up
vagrant ssh #get inside vagrant machine aka @homestead
    php artisan migrate # @homestead

# @homestead check database with dbHost=Homestead.yaml[id] 
#                                dbConn=.env[dbName, dbUser, dbPassword] 

php artisan make:model Task #generate model via Eloquent aka. Laravel ORM


: #follow the guide to create task's CRUD at /basic-tasks
: #break down above work via /basic-tasks-breakdown

php artisan make:auth #generate email+pass auth

php artisan make:controller TaskController #controller for adv /tasks

```


- often-used commands
```bash
composer install
vagrant up
vagrant provision

vagrant ssh; #then 
  php artisan migrate

```

- about csrf-xxx
  > Cross-Site Request Forgery (CSRF) is an attack that forces an end user 
    to execute unwanted actions on a web application in which they're currently authenticated. 

- TODO how to debug such laravel vagrant web app?
- TODO some syntax still marked as unresolved in PhpStorm e.g. Route::xxx, Validator::xxx
       we need PhpStorm understand a laravel project 