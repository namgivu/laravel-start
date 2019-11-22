#!/usr/bin/env bash
s=$BASH_SOURCE ; s=$(dirname "$s") ; s=$(cd "$s" && pwd) ; SCRIPT_HOME="$s"  # get SCRIPT_HOME=executed script's path, containing folder, cd & pwd to get container path

if [[ -z MYSQL ]]; then MYSQL='MYSQL'; fi

docstring="
MYSQL='docker exec thangtm58_lavarel_start_pg  mysql -uroot -proot' ./db/reset_db.sh
"

DB_NAME='thangtm58_lavarel_start'
$MYSQL -e "SELECT 1"  #TODO find the command to close current mysql connection
$MYSQL -e "DROP DATABASE if exists $DB_NAME;"
$MYSQL -e "CREATE DATABASE $DB_NAME;"
