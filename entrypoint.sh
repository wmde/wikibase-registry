#!/bin/bash

REQUIRED_VARIABLES=(MW_ADMIN_NAME MW_ADMIN_PASS MW_WG_SECRET_KEY DB_SERVER DB_USER DB_PASS DB_NAME)
for i in ${REQUIRED_VARIABLES[@]}; do
    eval THISSHOULDBESET=\$$i
    if [ -z "$THISSHOULDBESET" ]; then
    echo "$i is required but isn't set. You should pass it to docker. See: https://docs.docker.com/engine/reference/commandline/run/#set-environment-variables--e---env---env-file";
    exit 1;
    fi
done

set -eu

/wait-for-it.sh $DB_SERVER -t 120
sleep 1
/wait-for-it.sh $DB_SERVER -t 120

docker-php-entrypoint apache2-foreground
