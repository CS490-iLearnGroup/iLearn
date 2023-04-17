FROM ubuntu



RUN apt-get update && apt-get install -y \ 
    git \
    zip \
    apache2 \
    apache2-utils \
    sed \
    mysql-server \
    php-mysql

RUN DEBIAN_FRONTEND=noninteractive TZ=Etc/UTC apt-get -y install tzdata
RUN apt-get install -y php 


RUN apt clean




#Cloning git repo
ARG MOODLE_GIT_URL=https://github.com/CS490-iLearnGroup/iLearn.git
RUN git clone ${MOODLE_GIT_URL} /var/www/html/git

#opening perms for moodle
RUN chmod a+wrx /var/www

#Setting the container's timezone
ARG MOODLE_TIMEZONE=UTC
#RUN echo "date.timezone = ${MOODLE_TIMEZONE}" > /usr/local/etc/php/conf.d/timezone.ini

#allowing web server to see files
RUN sed -i "28i    <Directory /var/www/html>\n        Options Indexes FollowSymLinks MultiViews\n        AllowOverride All\n        Order allow,deny\n        allow from all\n    </Directory>" /etc/apache2/sites-available/000-default.conf

#idk this doesnt really work
RUN touch /var/www/html/.htaccess && chmod u+rwx /var/www/html/.htaccess
RUN echo "DirectoryIndex /var/www/html/git/moodle/index.php" >> /var/www/html/.htaccess

#opening port for webserver
EXPOSE 80

CMD ["apache2ctl", "-D","FOREGROUND"]