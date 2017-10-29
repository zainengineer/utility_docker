#!/usr/bin/env bash
DOCKER_IMAGE_NAME="util"
#docker-compose ps has different options then docker ps
for s in `docker-compose ps -q $DOCKER_IMAGE_NAME`
do
    NAME=`docker inspect -f "{{.Name}}" $s`
done
#remove leading slash
echo "${NAME:1}"