FROM wordpress:5.5.3
LABEL maintainer="pat@247.ch"

RUN apt-get update && apt-get install -y wget unzip

WORKDIR /usr/src/wordpress/wp-content/themes
RUN wget https://downloads.wordpress.org/theme/blossom-travel.1.0.8.zip
RUN wget https://downloads.wordpress.org/theme/twentytwenty.1.5.zip
RUN wget https://downloads.wordpress.org/theme/twentynineteen.1.7.zip
RUN unzip -o twentytwenty.1.5.zip && rm twentytwenty.1.5.zip
RUN unzip -o twentynineteen.1.7.zip && rm twentynineteen.1.7.zip
RUN unzip blossom-travel.1.0.8.zip && rm blossom-travel.1.0.8.zip

WORKDIR /usr/src/wordpress/wp-content/plugins/
RUN wget https://downloads.wordpress.org/plugin/cornerstone.zip
RUN unzip cornerstone.zip && rm cornerstone.zip

RUN rm -rf /usr/src/wordpress/wp-content/plugins/akismet
RUN rm /usr/src/wordpress/wp-content/plugins/hello.php

WORKDIR /var/www/html

COPY ./blossom-travel/page.php /usr/src/wordpress/wp-content/themes/blossom-travel
COPY ./twentyseventeen/page.php /usr/src/wordpress/wp-content/themes/twentyseventeen

RUN echo "upload_max_filesize = 128M\npost_max_size = 128M\nmemory_limit = 128M" > /usr/src/wordpress/php.ini
