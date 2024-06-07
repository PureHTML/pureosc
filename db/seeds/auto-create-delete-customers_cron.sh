#!/bin/bash
#source ./dbconnect.sh
# mysql -e  "GRANT ALL on *.* to ruzkyAdmin@localhost identified by 'pass' WITH GRANT OPTION"
H='localhost'
D='ruzky'
RU='ruzkyAdmin'
RP='pass'
NEW_CUSTOMERS_ID_RESERVE=5
LAST_REAL_CUSTOMER=`mysql --column-names=FALSE -h${H} -u${RU} -p${RP} $D -e "SELECT customers_id FROM customers_real ORDER BY customers_id DESC LIMIT 1"`
echo '$LAST_REAL_CUSTOMER:' $LAST_REAL_CUSTOMER

LAST_EMPTY_CUSTOMERS_ID=`mysql --column-names=FALSE -h${H} -u${RU} -p${RP} $D -e "SELECT customers_id FROM last_empty_customers_id"`
echo 'LAST_EMPTY_CUSTOMERS_ID:' $LAST_EMPTY_CUSTOMERS_ID
if [[ $((LAST_REAL_CUSTOMER+NEW_CUSTOMERS_ID_RESERVE)) -le LAST_EMPTY_CUSTOMERS_ID ]]
then
  echo exit
	exit
else
  N=$((LAST_EMPTY_CUSTOMERS_ID+1))
  while [ $N -le $((LAST_EMPTY_CUSTOMERS_ID+NEW_CUSTOMERS_ID_RESERVE)) ]
  do
    mysql -h${H} -u${RU} -p${RP} $D -e "CREATE USER ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "GRANT USAGE on ${D}.* to ${D}_${N}@${H}"
#debug only!!!
#    mysql -h${H} -u${RU} -p${RP} $D -e "GRANT ALL on ${D}.* to ${D}_${N}@${H}"
# NEW: for LOAD_FILE

    #TODO:otestovat contact_us!!!
    mysql -h${H} -u${RU} -p${RP} $D -e "grant INSERT on $D.action_recorder to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT, INSERT, UPDATE, DELETE on $D.address_book to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT on $D.address_format to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT on $D.authors to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT on $D.authors_info to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT on $D.banners to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT on $D.banners_history to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT on $D.cache to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT on $D.categories to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT on $D.categories_description to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT on $D.configuration to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT on $D.configuration_group to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT on $D.countries to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT on $D.css to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT on $D.currencies to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT, INSERT, UPDATE on $D.customers to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT, INSERT, UPDATE on $D.customers_info to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT, INSERT, UPDATE, DELETE on $D.customers_basket to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT, INSERT, UPDATE, DELETE on $D.customers_basket_attributes to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT, INSERT, UPDATE on $D.customers_info to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT on $D.geo_zones to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT on $D.languages to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT on $D.last_empty_customers_id to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT on $D.manufacturers to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT on $D.manufacturers_info to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT on $D.newsletters to ${D}_${N}@${H}"
#delete ne? TODO
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT, INSERT, UPDATE on $D.orders to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT, INSERT, UPDATE, DELETE on $D.orders_products to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT, INSERT, UPDATE, DELETE on $D.orders_products_attributes to ${D}_${N}@${H}"
#TODO jen select?
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT on $D.orders_products_download to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT on $D.orders_status to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT, INSERT on $D.orders_status_history to ${D}_${N}@${H}"
#TODO??
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT, INSERT, DELETE on $D.orders_total to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT on $D.products to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT on $D.products_related_products to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant UPDATE (products_quantity) on $D.products to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant UPDATE (products_ordered) on $D.products to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT on $D.products_attributes to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant UPDATE (options_values_quantity, options_values_nobuy) on $D.products_attributes to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT on $D.products_attributes_download to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT on $D.products_description to ${D}_${N}@${H}"
##BACHA! otestovat
    mysql -h${H} -u${RU} -p${RP} $D -e "grant UPDATE (products_viewed) on $D.products_description to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT on $D.products_images to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT, INSERT, UPDATE, DELETE on $D.products_notifications to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT on $D.products_options to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT on $D.products_options_values to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT on $D.products_options_values_to_products_options to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT on $D.products_to_categories to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT on $D.reviews to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT on $D.reviews_description to ${D}_${N}@${H}"
##?????!!!! je treba
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT on $D.sec_directory_whitelist to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT on $D.sessions to ${D}_${N}@${H}"

    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT on $D.specials to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant UPDATE (status, date_status_change) on $D.specials to ${D}_${N}@${H}"
##?treba
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT on $D.tax_class to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT on $D.tax_rates to ${D}_${N}@${H}"
#???? update?
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT, INSERT, UPDATE, DELETE on $D.whos_online to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT on $D.zasilkovna to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT on $D.zones to ${D}_${N}@${H}"
    mysql -h${H} -u${RU} -p${RP} $D -e "grant SELECT on $D.zones_to_geo_zones to ${D}_${N}@${H}"

#bacha
mysql -h${H} -u${RU} -p${RP} $D -e "GRANT FILE on *.* to ${D}_${N}@${H}"
# funkce otp10decrypt
mysql -h ${H} -u ${RU} -p${RP} $D -e "GRANT EXECUTE on FUNCTION ${D}.otp10decrypt TO ${D}_${N}@${H}"


echo NNN: ${N}
	  let N+=1
  done
  mysql -h${H} -u${RU} -p${RP} $D -e "FLUSH PRIVILEGES"
  mysql -h${H} -u${RU} -p${RP} $D -e "UPDATE last_empty_customers_id SET customers_id=$((N-1))"
fi

exit

#master admin
grant all privileges on mydatabase.* to masteradmin@dbserver identified by 'masteradminpassword' with grant option;
#catalog side user
grant usage on mydatabase.* to cataloguser@dbserver identified by 'cataloguserpassword';

#old seznam
grant usage on mydatabase.* to cataloguser@dbserver identified by 'cataloguserpassword';
grant SELECT on mydatabase.products to cataloguser@dbserver;
grant UPDATE on mydatabase.products to cataloguser@dbserver;
grant SELECT on mydatabase.currencies to cataloguser@dbserver;
grant SELECT on mydatabase.sessions to cataloguser@dbserver;
grant SELECT on mydatabase.banners to cataloguser@dbserver;
grant SELECT on mydatabase.banners_history to cataloguser@dbserver;
grant SELECT on mydatabase.specials to cataloguser@dbserver;
grant SELECT on mydatabase.manufacturers to cataloguser@dbserver;
grant SELECT on mydatabase.categories to cataloguser@dbserver;
grant SELECT on mydatabase.categories_description to cataloguser@dbserver;
grant SELECT on mydatabase.products_to_categories to cataloguser@dbserver;
grant SELECT on mydatabase.reviews to cataloguser@dbserver;
grant SELECT on mydatabase.reviews_description to cataloguser@dbserver;
grant SELECT on mydatabase.counter to cataloguser@dbserver;
grant SELECT on mydatabase.tax_rates to cataloguser@dbserver;
grant SELECT on mydatabase.products_attributes to cataloguser@dbserver;
grant SELECT on mydatabase.address_format to cataloguser@dbserver;
grant SELECT on mydatabase.configuration to cataloguser@dbserver;
grant DELETE on mydatabase.whos_online to cataloguser@dbserver;
grant SELECT on mydatabase.whos_online to cataloguser@dbserver;
grant UPDATE on mydatabase.whos_online to cataloguser@dbserver;
grant SELECT on mydatabase.languages to cataloguser@dbserver;
grant SELECT on mydatabase.products_description to cataloguser@dbserver;
grant SELECT on mydatabase.customers to cataloguser@dbserver;
grant SELECT on mydatabase.zones_to_geo_zones to cataloguser@dbserver;
grant SELECT on mydatabase.geo_zones to cataloguser@dbserver;
grant SELECT on mydatabase.products_attributes to cataloguser@dbserver;
grant SELECT on mydatabase.products_options to cataloguser@dbserver;
grant SELECT on mydatabase.orders_products to cataloguser@dbserver;
grant SELECT on mydatabase.orders to cataloguser@dbserver;
grant INSERT on mydatabase.whos_online to cataloguser@dbserver;
grant UPDATE on mydatabase.banners_history to cataloguser@dbserver;
grant SELECT on mydatabase.products_options_values to cataloguser@dbserver;
grant SELECT on mydatabase.manufacturers_info to cataloguser@dbserver;
grant SELECT on mydatabase.address_book to cataloguser@dbserver;
grant UPDATE on mydatabase.customers_info to cataloguser@dbserver;
grant SELECT on mydatabase.manudiscount to cataloguser@dbserver;
grant SELECT on mydatabase.zones to cataloguser@dbserver;
grant SELECT on mydatabase.countries to cataloguser@dbserver;
grant INSERT on mydatabase.orders to cataloguser@dbserver;
grant INSERT on mydatabase.orders_total to cataloguser@dbserver;
grant INSERT on mydatabase.orders_status_history to cataloguser@dbserver;
grant SELECT on mydatabase.products_attributes_download to cataloguser@dbserver;
grant INSERT on mydatabase.orders_products to cataloguser@dbserver;
grant SELECT on mydatabase.products_attributes_download to cataloguser@dbserver;
grant INSERT on mydatabase.orders_products to cataloguser@dbserver;
grant DELETE on mydatabase.customers_basket to cataloguser@dbserver;
grant INSERT on mydatabase.customers to cataloguser@dbserver;
grant INSERT on mydatabase.address_book to cataloguser@dbserver;
grant SELECT on mydatabase.products_attributes_download to cataloguser@dbserver;
grant INSERT on mydatabase.orders_products to cataloguser@dbserver;
grant INSERT on mydatabase.whos_online to cataloguser@dbserver;
grant SELECT on mydatabase.configuration to cataloguser@dbserver;
grant UPDATE on mydatabase.whos_online to cataloguser@dbserver;
grant SELECT on mydatabase.banners to cataloguser@dbserver;
grant SELECT on mydatabase.customers_info to cataloguser@dbserver;
grant SELECT on mydatabase.customers_basket_attributes to cataloguser@dbserver;
grant DELETE on mydatabase.customers_basket_attributes to cataloguser@dbserver;
grant INSERT on mydatabase.customers_info to cataloguser@dbserver;
