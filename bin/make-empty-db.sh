#!/bin/bash
source ./dbconnect.sh
DATE=`date +%y-%m-%d-%T|sed 's/:/_/g'`
mariadb-dump  -h"${H}" -u"${U}" -p"${P}" "${D}" |gzip > /tmp/"${D}"-"${DATE}".sql.gz
mariadb  -h"${H}" -u"${U}" -p"${P}" "$D" -e "TRUNCATE categories"
mariadb  -h"${H}" -u"${U}" -p"${P}" "$D" -e "TRUNCATE categories_description"
mariadb  -h"${H}" -u"${U}" -p"${P}" "$D" -e "TRUNCATE products_to_categories"
mariadb  -h"${H}" -u"${U}" -p"${P}" "$D" -e "TRUNCATE products"
mariadb  -h"${H}" -u"${U}" -p"${P}" "$D" -e "TRUNCATE products_description"
mariadb  -h"${H}" -u"${U}" -p"${P}" "$D" -e "TRUNCATE sessions"
mariadb-dump  -h"${H}" -u"${U}" -p"${P}" "$D" > ../catalog/install/oscommerce.sql
zcat /tmp/"${D}"-"${DATE}".sql.gz| mariadb -h"${H}" -u"${U}" -p"${P}" "$D"
