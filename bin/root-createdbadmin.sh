#!/bin/bash
#no exists yet: source ./dbconnect.sh
H='localhost'
read -p "Enter DB Server Name (empty for localhost): " ${H}
read -p "Enter DB name: " D
read -p "Enter RootDB username (dbname_admin): " RU
read -p "Enter RootDB password: " RP

mariadb -e  "GRANT ALL on *.* to ${D}_admin@${H} identified by '${RP}' WITH GRANT OPTION"

if [[ ! -f ../catalog/admin/includes/configure.php ]];then
  echo 'Missing admin/configure.php, creating!'
  cp ../catalog/admin/includes/configure.tpl.php ../catalog/admin/includes/configure.php
fi
  sed "s/'EMPTY_DB_SERVER'/'${H}'/" -i ../catalog/admin/includes/configure.php
  sed "s/'EMPTY_DB_DATABASE'/'${D}'/" -i ../catalog/admin/includes/configure.php
  sed "s/'EMPTY_DB_SERVER_ROOT_USERNAME'/'${RU}'/" -i ../catalog/admin/includes/configure.php
  sed "s/'EMPTY_DB_SERVER_ROOT_PASSWORD'/'${RP}'/" -i ../catalog/admin/includes/configure.php
