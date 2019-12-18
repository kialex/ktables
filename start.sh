#!/usr/bin/env bash

export CURRENT_UID=$(id -u):$(id -g)

docker-compose build --no-cache
docker-compose up