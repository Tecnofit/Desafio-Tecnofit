FROM httpd:2.4.33-alpine

RUN apk update; \
    apk upgrade; \
    apk add apache2-utils;

RUN sed -i '/LoadModule rewrite_module/s/^#//g' /usr/local/apache2/conf/httpd.conf

COPY demo.apache.conf /usr/local/apache2/conf/demo.apache.conf

RUN echo "Include /usr/local/apache2/conf/demo.apache.conf" \
    >> /usr/local/apache2/conf/httpd.conf
