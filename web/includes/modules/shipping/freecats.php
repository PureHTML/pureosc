<?php
/*
  $Id$ freeamount.php 2

  The Exchange Project - Community Made Shopping!
  http://www.theexchangeproject.org

  Copyright (c) 2003

  Released under the GNU General Public License

  ----------------------------------------------
  ane - 06/02/02 - modified freecount.php to
  allow for freeshipping on minimum order amount
  originally written by dwatkins 1/24/02
  Modified BearHappy 09/04/04
  ----------------------------------------------
*/

  class freecats {
    var $code, $title, $description, $icon, $enabled;

// class constructor
    function freecats() {
      global $order, $customer;

      $this->code = 'freecats';
      $this->title = MODULE_SHIPPING_FREE_PER_CATS_TEXT_TITLE;
      $this->description = MODULE_SHIPPING_FREE_PER_CATS_TEXT_DESCRIPTION;
      $this->sort_order = MODULE_SHIPPING_FREE_PER_CATS_SORT_ORDER;
      $this->icon ='';
      $this->enabled = ((MODULE_SHIPPING_FREE_PER_CATS_STATUS == 'True') ? true : false);

			if (!tep_not_null(MODULE_SHIPPING_FREE_PER_CATS_CATEGORIES))
			      $this->enabled = false;

      if ( ($this->enabled == true) && ((int)MODULE_SHIPPING_FREE_PER_CATS_ZONE > 0) ) {

        $check_flag = false;
        $check_query = tep_db_query("select zone_id, zone_country_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_SHIPPING_FREE_PER_CATS_ZONE . "' and zone_country_id = '" . $order->delivery['country']['id'] . "' order by zone_id");
        $order_shipping_country = $order->delivery['country']['id'];

        while ($check = tep_db_fetch_array($check_query)) {

          if ($check['zone_id'] < 1) {
            $check_flag = true;
            break;
          } elseif ($check['zone_country_id'] == $order->delivery['country']['id']) {
            $check_flag = true;
            break;
          }
        }
        if ($check_flag == false) {
          $this->enabled = false;
        }
     }
}

// class methods
    function quote($method = '') {
      global $cart, $shipping_weight;

		  $is_free = false;
			$get_weight = false;

			$cats_array = explode(',',MODULE_SHIPPING_FREE_PER_CATS_CATEGORIES);
			$cat_names = '';
			
			for($i=0, $x=sizeof($cats_array); $i<$x; $i++){
			     $cats_array[$i] = (int)$cats_array[$i];
           $cat_names .= tep_get_categories_name($cats_array[$i]).', ';
			}
			
			$cat_names = substr($cat_names, 0,-2);

			 $pID_list = $cart->get_product_id_list();

			 $pID_list = explode(',',$pID_list);
				for($i=0, $x=sizeof($pID_list); $i<$x; $i++){
				     $pID_list[$i] = (int)$pID_list[$i];
				}
				$pID_list = implode(',',$pID_list);

			 if (MODULE_SHIPPING_FREE_PER_CATS_ALL_OR_ONE == 'One'){
			      $products = $cart->get_products();
						for($i=0, $x=sizeof($products); $i<$x; $i++){
										$check_query = tep_db_query('select * from '.TABLE_PRODUCTS_TO_CATEGORIES.' where categories_id in ('.implode(',',$cats_array).') and products_id="'.(int)$products[$i]['id'].'"');
										if (tep_db_num_rows($check_query))
										  $is_free = true;
						}
			 } elseif (MODULE_SHIPPING_FREE_PER_CATS_ALL_OR_ONE == 'All'){
					 $count = 0;
					for($i=0, $x=sizeof($cats_array); $i<$x; $i++){
										$check_query = tep_db_query('select * from '.TABLE_PRODUCTS_TO_CATEGORIES.' where categories_id="'.$cats_array[$i].'" and products_id in ('.$pID_list.')');
										if (tep_db_num_rows($check_query))
												$count++;
					}
					if ($count == sizeof($cats_array))
										  $is_free = true;
			 } else {
			   $this->enabled = false;
			   return false;
			 }

			 if ( MODULE_SHIPPING_FREE_PER_CATS_ONLY_OR_ANY == 'Only' ){
					$check_query = tep_db_query('select * from '.TABLE_PRODUCTS_TO_CATEGORIES.' where categories_id not in ('.MODULE_SHIPPING_FREE_PER_CATS_CATEGORIES.') and products_id in ('.$pID_list.')');
		      if (tep_db_num_rows($check_query))
										  $is_free = false;
			 }

		  if (!$is_free) {
				if (MODULE_SHIPPING_FREE_PER_CATS_DISPLAY == 'True'){
					 if (MODULE_SHIPPING_FREE_PER_CATS_ALL_OR_ONE == 'One') {
					    if ( MODULE_SHIPPING_FREE_PER_CATS_ONLY_OR_ANY == 'Only' )
								$this->quotes['error'] = '<span class="b">'.MODULE_SHIPPING_FREE_PER_CATS_TEXT_TITLE.'</span><br />'.sprintf(MODULE_SHIPPING_FREE_PER_CATS_TEXT_ERROR_ONE_ONLY, $cat_names);
							else
								$this->quotes['error'] = '<span class="b">'.MODULE_SHIPPING_FREE_PER_CATS_TEXT_TITLE.'</span><br />'.sprintf(MODULE_SHIPPING_FREE_PER_CATS_TEXT_ERROR_ONE_ANY, $cat_names);
					 } elseif (MODULE_SHIPPING_FREE_PER_CATS_ALL_OR_ONE == 'All') {
					    if ( MODULE_SHIPPING_FREE_PER_CATS_ONLY_OR_ANY == 'Only' )
								$this->quotes['error'] = '<span class="b">'.MODULE_SHIPPING_FREE_PER_CATS_TEXT_TITLE.'</span><br />'.sprintf(MODULE_SHIPPING_FREE_PER_CATS_TEXT_ERROR_ALL_ONLY, $cat_names);
							else
								$this->quotes['error'] = '<span class="b">'.MODULE_SHIPPING_FREE_PER_CATS_TEXT_TITLE.'</span><br />'.sprintf(MODULE_SHIPPING_FREE_PER_CATS_TEXT_ERROR_ONE_ANY, $cat_names);
					 }
			   }
	    }

      if ($shipping_weight > MODULE_SHIPPING_FREE_PER_CATS_WEIGHT_MAX && MODULE_SHIPPING_FREE_PER_CATS_WEIGHT_MAX > 0) {
					if (MODULE_SHIPPING_FREE_PER_CATS_DISPLAY == 'True'){
			    	  	$this->quotes['error'] = '<span class="b">'.MODULE_SHIPPING_FREE_PER_CATS_TEXT_TITLE.'</span><br />'.sprintf(MODULE_SHIPPING_FREE_PER_CATS_TEXT_TO_WEIGHT, $cat_names);
					}
					$get_weight = false;
		  } else {
		   		$get_weight = true;
		  }

	if (($is_free && $get_weight))
	{
		$this->quotes = array('id' => $this->code,
													'module' => MODULE_SHIPPING_FREE_PER_CATS_TEXT_TITLE,
													'methods' => array(array('id' => $this->code,
																									 'title' => sprintf(MODULE_SHIPPING_FREE_PER_CATS_TEXT_WAY, $cat_names),
																									 'cost' => MODULE_SHIPPING_FREE_PER_CATS_COST)));
	}


	  if (tep_not_null($this->icon)) $this->quotes['icon'] = tep_image($this->icon, $this->title);

	  return $this->quotes;

	}

    function check() {
      if (!isset($this->_check)) {
        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_FREE_PER_CATS_STATUS'");
        $this->_check = tep_db_num_rows($check_query);
      }
      return $this->_check;
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Free Shipping for certain categories', 'MODULE_SHIPPING_FREE_PER_CATS_STATUS', 'False', 'Do you want to offer free shipping for certain categories?', '667', '7', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Maximum Weight', 'MODULE_SHIPPING_FREE_PER_CATS_WEIGHT_MAX', '10', 'What is the maximum weight you will ship? (zero to turn off)', '667', '8', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Display', 'MODULE_SHIPPING_FREE_PER_CATS_DISPLAY', 'True', 'Do you want to display text if products from needed categories not purchased?', '667', '7', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Categories List', 'MODULE_SHIPPING_FREE_PER_CATS_CATEGORIES', '', 'For what categories do you want to offer free shipping?<br />NOTE! not recurcive - select all subcategories if you need it.', '667', '8', 'tep_cfg_show_multicategories', 'tep_cfg_select_multicategories(', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('All or One', 'MODULE_SHIPPING_FREE_PER_CATS_ALL_OR_ONE', 'All', 'Do you want to offer a free shipping for orders with products from all mentioned categories, or with at least from one of them?', '667', '7', 'tep_cfg_select_option(array(\'All\', \'One\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Only or Any', 'MODULE_SHIPPING_FREE_PER_CATS_ONLY_OR_ANY', 'Only', 'Do you want to offer a free shipping for orders with products only from mentioned categories, or with products from any categories (including mentioned)?', '667', '7', 'tep_cfg_select_option(array(\'Only\', \'Any\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_SHIPPING_FREE_PER_CATS_SORT_ORDER', '0', 'Sort order of display.', '667', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Shipping Zone', 'MODULE_SHIPPING_FREE_PER_CATS_ZONE', '0', 'If a zone is selected, only enable this shipping method for that zone.', '667', '0', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");
   }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

   function keys() {
     $keys = array(
           'MODULE_SHIPPING_FREE_PER_CATS_STATUS',
           'MODULE_SHIPPING_FREE_PER_CATS_WEIGHT_MAX',
           'MODULE_SHIPPING_FREE_PER_CATS_SORT_ORDER',
           'MODULE_SHIPPING_FREE_PER_CATS_DISPLAY',
           'MODULE_SHIPPING_FREE_PER_CATS_ALL_OR_ONE',
           'MODULE_SHIPPING_FREE_PER_CATS_ONLY_OR_ANY',
           'MODULE_SHIPPING_FREE_PER_CATS_CATEGORIES',
           'MODULE_SHIPPING_FREE_PER_CATS_ZONE'
           );
     return $keys;
   }
 }
?>
