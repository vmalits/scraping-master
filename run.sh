#!/bin/bash

cd laradock

docker-compose up -d nginx postgres mailhog workspace
