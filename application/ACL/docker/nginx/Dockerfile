FROM nginx:alpine

ARG default_port=80
ARG server_name=localhost
ARG php_container_host=127.0.0.1

RUN apk add --no-cache sed

ADD docker/nginx/confs/nginx.conf /etc/nginx/conf.d/default.conf

RUN sed -i "s/{default_port}/$default_port/" /etc/nginx/conf.d/default.conf
RUN sed -i "s/{server_name}/$server_name/" /etc/nginx/conf.d/default.conf
RUN sed -i "s/{php_container_host}/$php_container_host/" /etc/nginx/conf.d/default.conf
