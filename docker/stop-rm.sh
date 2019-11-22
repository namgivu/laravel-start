#!/usr/bin/env bash
c="thangtm58_lavarel_start_pg"
docker stop $c
docker rm $c

c="thangtm58_lavarel_start"
docker stop $c
docker rm $c