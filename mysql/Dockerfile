FROM biarms/mysql:5.5
LABEL maintainer="pat@247.ch"

COPY my.cnf /etc/mysql/
COPY my-small.cnf /etc/mysql/conf.d
RUN rm /etc/mysql/conf.d/my.cnf
