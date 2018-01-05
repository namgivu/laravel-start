```bash

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


: #follow the guide to create task's CRUD at /tasks
: #TODO break down above work via /breakdown-tasks

```