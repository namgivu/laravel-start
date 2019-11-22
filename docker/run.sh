#!/usr/bin/env bash
docker run  --name thangtm58_lavarel_start  -d  -p 18111:8000  thangtm58/lavarel_start

echo "
Container log can be viewed by (press ^C to exit watch)
$ docker logs -t -f thangtm58_lavarel_start
"