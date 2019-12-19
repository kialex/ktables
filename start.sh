#!/usr/bin/env bash

if !(grep -q CURRENT_UI ".env"); then
    echo CURRENT_UID=$(id -u):$(id -g)>>.env
fi

docker-compose build --no-cache
docker-compose up