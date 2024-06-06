<?php
/*
	This is the back-end PHP file for the osCommerce AJAX Search Suggest

	You may use this code in your own projects as long as this
	copyright is left	in place.  All code is provided AS-IS.
	This code is distributed in the hope that it will be useful,
 	but WITHOUT ANY WARRANTY; without even the implied warranty of
 	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.

	The complete tutorial on how this works can be found at:
	http://www.dynamicajax.com/fr/AJAX_Suggest_Tutorial-271_290_312.html

	For more AJAX code and tutorials visit http://www.DynamicAJAX.com
	For more osCommerce related tutorials and code examples visit http://www.osCommerce-SSL.com

	Copyright 2006 Ryan Smith / 345 Technical / 345 Group.
*/
  include('includes/application_top.php');

    $sql = "select * from " . TABLE_PRODUCTS_DESCRIPTION . " pd left join " . TABLE_PRODUCTS . " p on pd.products_id = p.products_id WHERE p.products_status = '1' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and pd.products_name like('%" . tep_db_input($_GET['search']) . "%') LIMIT 15";
  echo '<hr />';
    $product_query = tep_db_query($sql);
	while($product_array = tep_db_fetch_array($product_query)) {
		echo '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $product_array['products_id']) . '">' . $product_array['products_name'] . '</a>' . "\n";
	}
?>