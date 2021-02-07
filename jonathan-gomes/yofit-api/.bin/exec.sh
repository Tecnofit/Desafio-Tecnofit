#!/bin/bash

if [ ! -f ".env" ]; then
    cp config/environment/.env.development .env
fi

if [ ! -f ".htaccess" ]; then
    cp .docker/apache/.htaccess .htaccess
fi

if [ ! -d "vendor" ]; then
  if [ ! -x "$(command -v composer)" ]; then
    sudo apt install composer
  fi

  composer install
fi

sudo docker network create backend

sudo docker-compose up --build
