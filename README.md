```bash
t=$(mktemp -d) #create temp folder ref. https://stackoverflow.com/a/21564182/248616
composer create-project laravel/laravel "$t" --prefer-dist

CODE="$HOME/NN/code/_NN_/laravel-sfs"
cp -r "$t/." "$CODE"

cd "$CODE"

: #database prep
php artisan make:migration create_tasks_table --create=tasks

```