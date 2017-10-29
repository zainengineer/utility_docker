#!/usr/bin/env bash

parent_path=$( cd "$(dirname "${BASH_SOURCE}")" ; pwd -P )
PHP_PARAM=" -dxdebug.remote_enable=1 -dxdebug.remote_autostart=1 "
#PHP_PARAM=""

#CONTAINER_HASH="$($parent_path/build/util_CONTAINER_HASH.sh)"
FULL_INSPECT=""

for s in `docker-compose ps -q`
do
    FULL_INSPECT=$(docker inspect "$s")"--z-inspect-separator--$FULL_INSPECT"
    #http://container-solutions.com/docker-inspect-template-magic/
    LABEL=$(docker inspect "$s"  -f '{{ index .Config.Labels "com.docker.compose.service"}}')
    if [[ "$LABEL" == "util" ]];
    then
        CONTAINER_HASH="$s"
    fi

done

{ cat "$parent_path/../docker-compose.yml" && echo "__z_separate__" && docker-compose ps && echo "__z_separate__" && cat <<EOF
$FULL_INSPECT
EOF
} | docker exec -i "$CONTAINER_HASH"  php $PHP_PARAM /cli_app/main.php "$@" > output.bash
#for some reason I cannot do | sh
bash output.bash
