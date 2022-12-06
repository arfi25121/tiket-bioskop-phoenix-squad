#!/usr/bin/bash

# create network
docker network create app-network

# run maria-db container
docker run \
    --detach \
    --network app-network \
    --name app-mariadb \
    --env MARIADB_USER=app_user \
    --env MARIADB_DATABASE=app_db \
    --env MARIADB_PASSWORD=app_pass \
    --env MARIADB_ROOT_PASSWORD=app_root_pass  \
    mariadb:latest

# import database
docker exec -i app-mariadb mysql -u app_user -papp_pass app_db < ./database/app.sql

# Go to mariadb container database
# docker run -it --network app-network --rm mariadb mariadb -h app-mariadb -u app_user -papp_pass

# build image
sudo docker build -t ticket_bioskop_app .

# run 
sudo docker run \
    --network app-network \
    -p 80:80 ticket_bioskop_app

# clear all
# stop all container
# docker stop $(docker ps -a -q)
# # remove all container
# docker rm $(docker ps -a -q)
# # remove ticket_bioskop_app image
# docker rmi ticket_bioskop_app
# # remove app-network
# docker network rm app-network