FROM wordpress:5.9.0
LABEL maintainer="pat@247.ch"

RUN apt-get update && apt-get install -y wget unzip

ARG blossom_version=1.1.5
ARG like_comment_version=1.1.6
ARG like_post_version=1.0.7


WORKDIR /usr/src/wordpress/wp-content/themes
RUN rm -rf ./*
RUN wget https://downloads.wordpress.org/theme/blossom-travel.${blossom_version}.zip
RUN unzip blossom-travel.${blossom_version}.zip && rm blossom-travel.${blossom_version}.zip

# Install plugins
WORKDIR /usr/src/wordpress/wp-content/plugins/
# Cornerstone 
RUN wget https://downloads.wordpress.org/plugin/cornerstone.zip
RUN unzip cornerstone.zip && rm cornerstone.zip
# Like Dislike comments
RUN wget https://downloads.wordpress.org/plugin/comments-like-dislike.${like_comment_version}.zip
RUN unzip comments-like-dislike.${like_comment_version}.zip && rm comments-like-dislike.${like_comment_version}.zip
# Like Dislike posts
RUN wget https://downloads.wordpress.org/plugin/posts-like-dislike.${like_post_version}.zip
RUN unzip posts-like-dislike.${like_post_version}.zip && rm posts-like-dislike.${like_post_version}.zip

RUN rm -rf /usr/src/wordpress/wp-content/plugins/akismet
RUN rm /usr/src/wordpress/wp-content/plugins/hello.php

WORKDIR /var/www/html

COPY ./blossom-travel/page.php /usr/src/wordpress/wp-content/themes/blossom-travel
COPY ./blossom-travel/content.php /usr/src/wordpress/wp-content/themes/blossom-travel/template-parts

RUN echo "upload_max_filesize = 1024M\npost_max_size = 1024M\nmemory_limit = 1024M" > /usr/src/wordpress/php.ini

