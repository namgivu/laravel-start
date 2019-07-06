#!/usr/bin/env bash
s=$BASH_SOURCE ; s=$(dirname "$s") ; s=$(cd "$s" && pwd) ; SCRIPT_HOME="$s" # get SCRIPT_HOME=executed script's path, containing folder, cd & pwd to get container path

#docker-compose -f "$SCRIPT_HOME/docker-compose.yml" down #TODO we have error when stopping by docker-compose down > Removing network for-atlas_default; where is this network from?
CONTAINER_NAME='gc_postgres'; docker stop $CONTAINER_NAME && docker rm $CONTAINER_NAME
CONTAINER_NAME='gc_mongo';    docker stop $CONTAINER_NAME && docker rm $CONTAINER_NAME
CONTAINER_NAME='gc_redis';    docker stop $CONTAINER_NAME && docker rm $CONTAINER_NAME
