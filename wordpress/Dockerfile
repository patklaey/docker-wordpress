FROM wordpress:5.6.0
LABEL maintainer="pat@247.ch"

RUN apt-get update && apt-get install -y wget unzip

ARG blossom_version=1.0.8

WORKDIR /usr/src/wordpress/wp-content/themes
RUN rm -rf ./*
RUN wget https://downloads.wordpress.org/theme/blossom-travel.${blossom_version}.zip
RUN unzip blossom-travel.${blossom_version}.zip && rm blossom-travel.${blossom_version}.zip

WORKDIR /usr/src/wordpress/wp-content/plugins/
RUN wget https://downloads.wordpress.org/plugin/cornerstone.zip
RUN unzip cornerstone.zip && rm cornerstone.zip

RUN rm -rf /usr/src/wordpress/wp-content/plugins/akismet
RUN rm /usr/src/wordpress/wp-content/plugins/hello.php

WORKDIR /var/www/html

COPY ./blossom-travel/page.php /usr/src/wordpress/wp-content/themes/blossom-travel

RUN echo "upload_max_filesize = 128M\npost_max_size = 128M\nmemory_limit = 128M" > /usr/src/wordpress/php.ini
