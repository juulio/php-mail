#!/usr/bin/env bash

mysql_password='wpDB2018'
database_name='wordpressDB'
database_user='root'
database_password='wordpressDBuser'

locale-gen UTF-8
export LANGUAGE=en_US.UTF-8; export LANG=en_US.UTF-8; export LC_ALL=en_US.UTF-8; locale-gen en_US.UTF-8
dpkg-reconfigure locales
sh -c "echo -e 'LANG=en_US.UTF-8\nLC_ALL=en_US.UTF-8' > /etc/environment"
#reboot
apt-get update

# apache
apt-get install -y apache2
if ! [ -L /var/www ]; then
  rm -rf /var/www
  ln -fs /vagrant /var/www
fi

# mysql
debconf-set-selections <<< "mysql-server mysql-server/root_password password "$mysql_password
debconf-set-selections <<< "mysql-server mysql-server/root_password_again password "$mysql_password
apt-get -y install mysql-server php5-mysql

# Author: Bert Van Vreckem <bert.vanvreckem@gmail.com>
#
# A non-interactive replacement for mysql_secure_installation
#
# Tested on CentOS 6, CentOS 7, Ubuntu 12.04 LTS (Precise Pangolin), Ubuntu
# 14.04 LTS (Trusty Tahr).

mysql --user=root -p$mysql_password <<_EOF_
  DELETE FROM mysql.user WHERE User='';
  DELETE FROM mysql.user WHERE User='root' AND Host NOT IN ('localhost', '127.0.0.1', '::1');
  DROP DATABASE IF EXISTS test;
  DELETE FROM mysql.db WHERE Db='test' OR Db='test\\_%';
  FLUSH PRIVILEGES;

  CREATE DATABASE $database_name;
  CREATE USER $database_user@localhost IDENTIFIED BY '$database_password';
  GRANT ALL PRIVILEGES ON $database_name.* TO $database_user@localhost;
  FLUSH PRIVILEGES;
_EOF_

#php
apt-get -y install php5 libapache2-mod-php5 php5-mcrypt

# libs for WP
apt-get -y install php5-gd libssh2-php

# set up apache
match='DocumentRoot.*'
insert='ServerName localhost\n\tDocumentRoot /vagrant\n\t<Directory /vagrant/>\n\t\tRequire all granted\n\t</Directory>'
file='/etc/apache2/sites-available/000-default.conf'
cat $file
sed -i "s:$match:$insert:" $file

match='#<Directory /srv/>'
insert='<Directory /vagrant/>\n\tOptions Indexes FollowSymLinks\n\tAllowOverride All\n\tOptions Indexes FollowSymLinks\n\tRequire all granted\n\t</Directory>\n\n#<Directory /srv/>'
file='/etc/apache2/apache2.conf'
cat $file
sed -i "s:$match:$insert:" $file

a2enmod rewrite
service apache2 restart

# a brand new htaccess
touch /vagrant/.htaccess
