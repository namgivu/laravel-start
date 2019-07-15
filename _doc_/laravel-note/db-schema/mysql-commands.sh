#!/usr/bin/env bash

# start mysql/mariadb service at port 33066
. /path/to/mysql-mariadb-docker/start.sh

# run query from command line
docker exec -it nn_mariadb        mysql -u root  -e "select 1"
#               docker container           user  query

u='root'; db='nn_laravel_start'

# create db
docker exec -it nn_mariadb  mysql -u $u     -e "DROP DATABASE IF EXISTS $db;"
docker exec -it nn_mariadb  mysql -u $u     -e "CREATE DATABASE $db;"

# query
docker exec -it nn_mariadb  mysql -u $u $db -e 'select 1'
s='select 1'; docker exec -it nn_mariadb  mysql -u $u $db -e "$sql"

alias mysql='docker exec -it nn_mariadb  mysql'
mysql -u $u     -e "DROP DATABASE IF EXISTS $db;"
mysql -u $u     -e "CREATE DATABASE $db;"
mysql -u $u $db -e 'select 1'
s='select 1'; mysql -u $u $db -e "$s"

s='
select 1;
select 22;
'; mysql -u $u $db -e "$s"

s=`cat << EOF
select 1;
select 22;
EOF
`; mysql -u $u $db -e "$s"

cd /path-to/laravel-start/doc/laravel-note/
    s=`cat ./00.create-db.sql`;     mysql -u $u $db -e "$s"
    s=`cat ./01.create-users.sql`;  mysql -u $u $db -e "$s"
    s=`cat ./02.seeding-data.sql`;  mysql -u $u $db -e "$s"
    s='select * from users';  mysql -u $u $db -e "$s"
cd -
