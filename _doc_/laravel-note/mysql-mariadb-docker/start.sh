#!/usr/bin/env bash
set -e # halt if error occurs
s=$BASH_SOURCE ; s=$(dirname "$s") ; s=$(cd "$s" && pwd) ; SCRIPT_HOME="$s" # get SCRIPT_HOME=executed script's path, containing folder, cd & pwd to get container path

# run the container(s)
docker-compose -f "$SCRIPT_HOME/docker-compose.yml" up -d --force-recreate #ref. https://forums.docker.com/t/named-volume-with-postgresql-doesnt-keep-databases-data/7434/2

# aftermath guide
echo '
After run, we can

    # open bash prompt
    docker exec -it  nn_mariadb  /bin/bash

    # open postgres client aka psql
    docker exec -it  nn_mariadb  mysql -u root -p -h localhost -P 33066

Done
'
