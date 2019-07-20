install php7.3, composer, laravel 
ref. https://github.com/namgivu/laravel-start/blob/doc/_doc_/laravel-note/effort01.md

now learn the laravel quickstart
ref. https://laravel.com/docs/5.2/quickstart

# generate app skeleton
cd :THIS_PROJECT
composer create-project laravel/laravel quickstart --prefer-dist  # should have :quickstart folder created aka the laravel skeleton app

# create table :tasks migration
cd quickstart
    php artisan make:migration create_tasks_table --create=tasks; 
cd -
