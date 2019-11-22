#!/usr/bin/env bash
s=$BASH_SOURCE ; s=$(dirname "$s") ; s=$(cd "$s" && pwd) ; SCRIPT_HOME="$s"  # get SCRIPT_HOME=executed script's path, containing folder, cd & pwd to get container path

# run container from the built image
docker-compose  -f "$SCRIPT_HOME/docker-compose.yml"  up  --force-recreate  -d
#                #custom docker-compose                                     #run as background
#                #ref. https://stackoverflow.com/a/45158964/248616

# aftermath check
docker ps | grep -E 'thangtm58/lavarel_start|IMAGE'
echo "
view running container log; ctrl-z to quit log
cd $SCRIPT_HOME; docker-compose up; cd - 1>/dev/null
"
