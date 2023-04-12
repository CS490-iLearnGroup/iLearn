FROM php:7.4-apache

WORKDIR /var/www/html

RUN apt-get update && apt-get install -y \ 
    git \
    zip \
    supervisor


#Cloning git repo
RUN mkdir /iLearn
ARG MOODLE_GIT_URL=https://github.com/CS490-iLearnGroup/iLearn.git
RUN git clone ${MOODLE_GIT_URL} /iLearn


#Setting the container's timezone
ARG MOODLE_TIMEZONE=UTC
RUN echo "date.timezone = ${MOODLE_TIMEZONE}" > /usr/local/etc/php/conf.d/timezone.ini

RUN a2enmod rewrite

EXPOSE 80

CMD ["supervisord", "-n"]