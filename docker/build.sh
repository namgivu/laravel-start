#!/usr/bin/env bash
i='thangtm58/lavarel_start'
docker image rm $i      # remove if exists
docker build -t $i   .  # do build