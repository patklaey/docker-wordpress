FROM wordpress:5.4.1
LABEL maintainer="pat@247.ch"

COPY cornerstone /usr/src/wordpress/wp-content/plugins/cornerstone
COPY ./twentyseventeen/page.php /usr/src/wordpress/wp-content/themes/twentyseventeen 
COPY ./twentysixteen/page.php /usr/src/wordpress/wp-content/themes/twentysixteen 

RUN echo "upload_max_filesize = 128M\npost_max_size = 128M\nmemory_limit = 128M" > /usr/src/wordpress/php.ini
