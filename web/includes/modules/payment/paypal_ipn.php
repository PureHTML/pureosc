<?php
/*
  $Id: paypal_ipn.php,v 2.3.3.0 11/17/2007 11:15:28 alexstudio Exp $

  Copyright (c) 2008 osCommerce
  Released under the GNU General Public License
  
  Original Authors: Harald Ponce de Leon, Mark Evans 
  Updates by PandA.nl, Navyhost, Zoeticlight, David, gravyface, AlexStudio, windfjf and Terra
  v2.3 Updated by AlexStudio
    
*/

  class paypal_ipn {
    var $code, $title, $description, $enabled, $identifier;

// class constructor
    function paypal_ipn() {
      global $order;

      $this->code = 'paypal_ipn';
      $this->title = MODULE_PAYMENT_PAYPAL_IPN_TEXT_TITLE;
      $this->description = MODULE_PAYMENT_PAYPAL_IPN_TEXT_DESCRIPTION;
      $this->sort_order = MODULE_PAYMENT_PAYPAL_IPN_SORT_ORDER;
      $this->enabled = ((MODULE_PAYMENT_PAYPAL_IPN_STATUS == 'True') ? true : false);
      $this->email_footer = MODULE_PAYMENT_PAYPAL_IPN_TEXT_EMAIL_FOOTER;
      $this->identifier = 'osCommerce PayPal IPN v2.3.3';
      // BOF Additional show text added by AlexStudio
      $this->show = MODULE_PAYMENT_PAYPAL_IPN_TEXT_SELECTION;
      $this->last_confirm = MODULE_PAYMENT_PAYPAL_IPN_TEXT_LAST_CONFIRM;
      // EOF Additional show text added by AlexStudio

      if ((int)MODULE_PAYMENT_PAYPAL_IPN_PREPARE_ORDER_STATUS_ID > 0) {
        $this->order_status = MODULE_PAYMENT_PAYPAL_IPN_PREPARE_ORDER_STATUS_ID;
      }

      if (is_object($order)) $this->update_status();

      if (MODULE_PAYMENT_PAYPAL_IPN_GATEWAY_SERVER == 'Live') {
        $this->form_action_url = 'https://www.paypal.com/cgi-bin/webscr';
      } else {
        $this->form_action_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
      }
    }

// class methods
    function update_status() {
      global $order;

      if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_PAYPAL_IPN_ZONE > 0) ) {
        $check_flag = false;
        $check_query = tep_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_PAYPAL_IPN_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
        while ($check = tep_db_fetch_array($check_query)) {
          if ($check['zone_id'] < 1) {
            $check_flag = true;
            break;
          } elseif ($check['zone_id'] == $order->billing['zone_id']) {
            $check_flag = true;
            break;
          }
        }

        if ($check_flag == false) {
          $this->enabled = false;
        }
      }
    }

    function javascript_validation() {
      return false;
    }

    function selection() {
      return array('id' => $this->code,
                   // BOF Additional show text addedby AlexStudio
                   'module' => $this->show);
                   // EOF Additional show text added by AlexStudio
    }

    function pre_confirmation_check() {
      return false;
    }

    function confirmation() {
      global $cartID, $cart_PayPal_IPN_ID, $customer_id, $languages_id, $order, $order_total_modules;

     // if (tep_session_is_registered('cartID')) {
	 // PandA.nl: register_globals fix
     if (array_key_exists('cartID', $_SESSION)) {
        $insert_order = false;

        if (tep_session_is_registered('cart_PayPal_IPN_ID')) {
          $order_id = substr($cart_PayPal_IPN_ID, strpos($cart_PayPal_IPN_ID, '-')+1);

          $curr_check = tep_db_query("select currency from " . TABLE_ORDERS . " where orders_id = '" . (int)$order_id . "'");
          $curr = tep_db_fetch_array($curr_check);

           //if ( ($curr['currency'] != $order->info['currency']) || ($cartID != substr($cart_PayPal_IPN_ID, 0, strlen($cartID))) ) {
            //$check_query = tep_db_query('select orders_id from ' . TABLE_ORDERS_STATUS_HISTORY . ' where orders_id = "' . (int)$order_id . '" limit 1'); 
			$check_query = tep_db_query('select orders_id from ' . TABLE_ORDERS_STATUS_HISTORY . ' where orders_id = "' . (int)$order_id . '" limit 2');  //1.4
            $update_order = false;//1.4
			
			//if (tep_db_num_rows($check_query) < 1) {
              //tep_db_query('delete from ' . TABLE_ORDERS . ' where orders_id = "' . (int)$order_id . '"');
			if (tep_db_num_rows($check_query) == 1) { //1.4
			  $update_order = true; //1.4
              tep_db_query('delete from ' . TABLE_ORDERS_TOTAL . ' where orders_id = "' . (int)$order_id . '"');
              tep_db_query('delete from ' . TABLE_ORDERS_STATUS_HISTORY . ' where orders_id = "' . (int)$order_id . '"');
              tep_db_query('delete from ' . TABLE_ORDERS_PRODUCTS . ' where orders_id = "' . (int)$order_id . '"');
              tep_db_query('delete from ' . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . ' where orders_id = "' . (int)$order_id . '"');
              tep_db_query('delete from ' . TABLE_ORDERS_PRODUCTS_DOWNLOAD . ' where orders_id = "' . (int)$order_id . '"');
            }

            $insert_order = true;
		  //}	
        } else {
          $insert_order = true;
        }

        if ($insert_order == true) {
          $order_totals = array();
          if (is_array($order_total_modules->modules)) {
            reset($order_total_modules->modules);
            while (list(, $value) = each($order_total_modules->modules)) {
              $class = substr($value, 0, strrpos($value, '.'));
              if ($GLOBALS[$class]->enabled) {
                for ($i=0, $n=sizeof($GLOBALS[$class]->output); $i<$n; $i++) {
                  if (tep_not_null($GLOBALS[$class]->output[$i]['title']) && tep_not_null($GLOBALS[$class]->output[$i]['text'])) {
                    $order_totals[] = array('code' => $GLOBALS[$class]->code,
                                            'title' => $GLOBALS[$class]->output[$i]['title'],
                                            'text' => $GLOBALS[$class]->output[$i]['text'],
                                            'value' => $GLOBALS[$class]->output[$i]['value'],
                                            'sort_order' => $GLOBALS[$class]->sort_order);
                  }
                }
              }
            }
          }

          $sql_data_array = array('customers_id' => $customer_id,
                                  'customers_name' => $order->customer['firstname'] . ' ' . $order->customer['lastname'],
                                  'customers_company' => $order->customer['company'],
                                  'customers_street_address' => $order->customer['street_address'],
                                  'customers_suburb' => $order->customer['suburb'],
                                  'customers_city' => $order->customer['city'],
                                  'customers_postcode' => $order->customer['postcode'],
                                  'customers_state' => $order->customer['state'],
                                  'customers_country' => $order->customer['country']['title'],
                                  'customers_telephone' => $order->customer['telephone'],
                                  'customers_email_address' => $order->customer['email_address'],
                                  'customers_address_format_id' => $order->customer['format_id'],
                                  'delivery_name' => $order->delivery['firstname'] . ' ' . $order->delivery['lastname'],
                                  'delivery_company' => $order->delivery['company'],
                                  'delivery_street_address' => $order->delivery['street_address'],
                                  'delivery_suburb' => $order->delivery['suburb'],
                                  'delivery_city' => $order->delivery['city'],
                                  'delivery_postcode' => $order->delivery['postcode'],
                                  'delivery_state' => $order->delivery['state'],
                                  'delivery_country' => $order->delivery['country']['title'],
                                  'delivery_address_format_id' => $order->delivery['format_id'],
                                  'billing_name' => $order->billing['firstname'] . ' ' . $order->billing['lastname'],
                                  'billing_company' => $order->billing['company'],
                                  'billing_street_address' => $order->billing['street_address'],
                                  'billing_suburb' => $order->billing['suburb'],
                                  'billing_city' => $order->billing['city'],
                                  'billing_postcode' => $order->billing['postcode'],
                                  'billing_state' => $order->billing['state'],
                                  'billing_country' => $order->billing['country']['title'],
                                  'billing_address_format_id' => $order->billing['format_id'],
                                  'payment_method' => $order->info['payment_method'],
                                  'cc_type' => $order->info['cc_type'],
                                  'cc_owner' => $order->info['cc_owner'],
                                  'cc_number' => $order->info['cc_number'],
                                  'cc_expires' => $order->info['cc_expires'],
                                  'date_purchased' => 'now()',
                                  'orders_status' => $order->info['order_status'],
                                  'currency' => $order->info['currency'],
                                  'currency_value' => $order->info['currency_value']);

		  //+1.4
		  if ( $update_order ){  
		    tep_db_perform(TABLE_ORDERS, $sql_data_array, 'update', 'orders_id = "' . (int)$order_id . '"');
            $insert_id = (int)$order_id;
		  } else { 
		  //-1.4
          tep_db_perform(TABLE_ORDERS, $sql_data_array);

          $insert_id = tep_db_insert_id();
		  }//1.4

          for ($i=0, $n=sizeof($order_totals); $i<$n; $i++) {
            $sql_data_array = array('orders_id' => $insert_id,
                                    'title' => $order_totals[$i]['title'],
                                    'text' => $order_totals[$i]['text'],
                                    'value' => $order_totals[$i]['value'],
                                    'class' => $order_totals[$i]['code'],
                                    'sort_order' => $order_totals[$i]['sort_order']);

            tep_db_perform(TABLE_ORDERS_TOTAL, $sql_data_array);
          }
		  //+1.4
		  $sql_data_array = array('orders_id' => $insert_id, 
                                    'orders_status_id' => $order->info['order_status'], 
                                    'date_added' => 'now()', 
						 'customer_notified' => '0', 
                                    'comments' => $order->info['comments']);
          tep_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array);
		  //-1.4

          for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
            $sql_data_array = array('orders_id' => $insert_id,
                                    'products_id' => tep_get_prid($order->products[$i]['id']),
                                    'products_model' => $order->products[$i]['model'],
                                    'products_name' => $order->products[$i]['name'],
                                    'products_price' => $order->products[$i]['price'],
                                    'final_price' => $order->products[$i]['final_price'],
                                    'products_tax' => $order->products[$i]['tax'],
                                    'products_quantity' => $order->products[$i]['qty']);

            tep_db_perform(TABLE_ORDERS_PRODUCTS, $sql_data_array);

            $order_products_id = tep_db_insert_id();

            $attributes_exist = '0';
            if (isset($order->products[$i]['attributes'])) {
              $attributes_exist = '1';
              for ($j=0, $n2=sizeof($order->products[$i]['attributes']); $j<$n2; $j++) {
                if (DOWNLOAD_ENABLED == 'true') {
                  $attributes_query = "select popt.products_options_name, poval.products_options_values_name, pa.options_values_price, pa.price_prefix, pad.products_attributes_maxdays, pad.products_attributes_maxcount , pad.products_attributes_filename
                                       from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_OPTIONS_VALUES . " poval, " . TABLE_PRODUCTS_ATTRIBUTES . " pa
                                       left join " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " pad
                                       on pa.products_attributes_id=pad.products_attributes_id
                                       where pa.products_id = '" . $order->products[$i]['id'] . "'
                                       and pa.options_id = '" . $order->products[$i]['attributes'][$j]['option_id'] . "'
                                       and pa.options_id = popt.products_options_id
                                       and pa.options_values_id = '" . $order->products[$i]['attributes'][$j]['value_id'] . "'
                                       and pa.options_values_id = poval.products_options_values_id
                                       and popt.language_id = '" . $languages_id . "'
                                       and poval.language_id = '" . $languages_id . "'";
                  $attributes = tep_db_query($attributes_query);
                } else {
                  $attributes = tep_db_query("select popt.products_options_name, poval.products_options_values_name, pa.options_values_price, pa.price_prefix from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_OPTIONS_VALUES . " poval, " . TABLE_PRODUCTS_ATTRIBUTES . " pa where pa.products_id = '" . $order->products[$i]['id'] . "' and pa.options_id = '" . $order->products[$i]['attributes'][$j]['option_id'] . "' and pa.options_id = popt.products_options_id and pa.options_values_id = '" . $order->products[$i]['attributes'][$j]['value_id'] . "' and pa.options_values_id = poval.products_options_values_id and popt.language_id = '" . $languages_id . "' and poval.language_id = '" . $languages_id . "'");
                }
                $attributes_values = tep_db_fetch_array($attributes);

                $sql_data_array = array('orders_id' => $insert_id,
                                        'orders_products_id' => $order_products_id,
                                        'products_options' => $attributes_values['products_options_name'],
                                        'products_options_values' => $attributes_values['products_options_values_name'],
                                        'options_values_price' => $attributes_values['options_values_price'],
                                        'price_prefix' => $attributes_values['price_prefix']);

                tep_db_perform(TABLE_ORDERS_PRODUCTS_ATTRIBUTES, $sql_data_array);

                if ((DOWNLOAD_ENABLED == 'true') && isset($attributes_values['products_attributes_filename']) && tep_not_null($attributes_values['products_attributes_filename'])) {
                  $sql_data_array = array('orders_id' => $insert_id,
                                          'orders_products_id' => $order_products_id,
                                          'orders_products_filename' => $attributes_values['products_attributes_filename'],
                                          'download_maxdays' => $attributes_values['products_attributes_maxdays'],
                                          'download_count' => $attributes_values['products_attributes_maxcount']);

                  tep_db_perform(TABLE_ORDERS_PRODUCTS_DOWNLOAD, $sql_data_array);
                }
              }
            }
          }

          tep_session_register('cart_PayPal_IPN_ID');
          // Terra register globals fix
          $_SESSION['cart_PayPal_IPN_ID'] = $cartID . '-' . $insert_id;
        }
      }
      // BOF Confirmation Info added by AlexStudio
      $confirmation = array('title' => MODULE_PAYMENT_PAYPAL_IPN_TEXT_LAST_CONFIRM, 'fields' => array());
      return $confirmation;
      // EOF Confirmation Info added by AlexStudio
    }

    function process_button() {
      global $customer_id, $order, $languages_id, $currencies, $currency, $cart_PayPal_IPN_ID, $shipping, $order_total_modules;

      if (MODULE_PAYMENT_PAYPAL_IPN_CURRENCY == 'Selected Currency') {
        $my_currency = $currency;
      } else {
        $my_currency = substr(MODULE_PAYMENT_PAYPAL_IPN_CURRENCY, 5);
      }
      
      if (!in_array($my_currency, array('AUD', 'CAD', 'CHF', 'CZK', 'DKK', 'EUR', 'GBP', 'HKD', 'HUF', 'JPY', 'NOK', 'NZD', 'PLN', 'SEK', 'SGD', 'USD'))) {
        $my_currency = 'USD';
      }

      // BOF Per Item mode fix by alexstudio
      $order_totals = array();
      if (is_array($order_total_modules->modules)) {
        reset($order_total_modules->modules);
        while (list(, $value) = each($order_total_modules->modules)) {
          $class = substr($value, 0, strrpos($value, '.'));
          if ($GLOBALS[$class]->enabled) {
            for ($i=0, $n=sizeof($GLOBALS[$class]->output); $i<$n; $i++) {
              if (tep_not_null($GLOBALS[$class]->output[$i]['title']) && tep_not_null($GLOBALS[$class]->output[$i]['text'])) {
                $order_totals[] = array('code' => $GLOBALS[$class]->code,
                                        'title' => $GLOBALS[$class]->output[$i]['title'],
                                        'text' => $GLOBALS[$class]->output[$i]['text'],
                                        'value' => $GLOBALS[$class]->output[$i]['value'],
                                        'sort_order' => $GLOBALS[$class]->sort_order);
              }
            }
          }
        }
      }
      foreach ($order_totals as $ot) {
        $order_total[$ot['code']] = $ot['value'];
      }
      $subtotal = $order_total['ot_subtotal'];
      if (DISPLAY_PRICE_WITH_TAX == 'true') $subtotal -= $order->info['tax'];
      // EOF Per Item mode fix by alexstudio
      
      $parameters = array();

      if ( (MODULE_PAYMENT_PAYPAL_IPN_TRANSACTION_TYPE == 'Per Item')/* && (MODULE_PAYMENT_PAYPAL_IPN_EWP_STATUS == 'False') // removed by AlexStudio*/) {
        $parameters['cmd'] = '_cart';
        $parameters['upload'] = '1';

        // Decide how many items are virtual (no shipping)
        $shipping_count = 0;
        $shipping_added = 0;
        $handling_added = 0;
        $item_tax = 0;
        $virtual_items = 0;
        for ($y=0; $y<sizeof($order->products); $y++) {
          if (is_array($order->products[$y]['attributes'])) {
            while (list($key, $value) = each($order->products[$y]['attributes'])) {
              $z = $key;
              $attributes_query = "select pad.products_attributes_filename
                                   from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_OPTIONS_VALUES . " poval,
                                   " . TABLE_PRODUCTS_ATTRIBUTES . " pa left join " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " pad
                                   on pa.products_attributes_id=pad.products_attributes_id
                                   where pa.products_id = '" . $order->products[$y]['id'] . "'
                                   and pa.options_id = '" . $order->products[$y]['attributes'][$z]['option_id'] . "'
                                   and pa.options_id = popt.products_options_id
                                   and pa.options_values_id = '" . $order->products[$y]['attributes'][$z]['value_id'] . "'
                                   and pa.options_values_id = poval.products_options_values_id";
              $attributes = tep_db_query($attributes_query);
              $attributes_values = tep_db_fetch_array($attributes);
              if (tep_not_null($attributes_values['products_attributes_filename'])) $virtual_items++;
            }
          }
        }
        
        for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
          $item = $i+1;

          $tax_value = ($order->products[$i]['tax'] / 100) * $order->products[$i]['final_price'];

          $parameters['item_name_' . $item] = $order->products[$i]['name'];
          $parameters['item_number_' . $item] = $order->products[$i]['model'];
          // BOF Tax pre item fix by AlexStudio
          if(MOVE_TAX_TO_TOTAL_AMOUNT == 'True') $parameters['amount_' . $item] = number_format(($order->products[$i]['final_price'] + $tax_value) * $currencies->get_value($my_currency), $currencies->get_decimal_places($my_currency));
          else {
            $parameters['amount_' . $item] = number_format($order->products[$i]['final_price'] * $currencies->get_value($my_currency), $currencies->get_decimal_places($my_currency));
            $parameters['tax_' . $item] = number_format($tax_value * $currencies->get_value($my_currency), $currencies->get_decimal_places($my_currency));
          }
          $item_tax += number_format($tax_value * $order->products[$i]['qty'] * $currencies->get_value($my_currency), $currencies->get_decimal_places($my_currency));
          // EOF Tax pre item fix by AlexStudio
          $parameters['quantity_' . $item] = $order->products[$i]['qty'];

          // BOF shipping & handling fix by AlexStudio
          $item_has_shipping = true;
          // EOF shipping & handling fix by AlexStudio
          if (isset($order->products[$i]['attributes'])) {
            for ($j=0, $n2=sizeof($order->products[$i]['attributes']); $j<$n2; $j++) {
              if (DOWNLOAD_ENABLED == 'true') {
                $attributes_query = "select popt.products_options_name, poval.products_options_values_name, pa.options_values_price, pa.price_prefix, pad.products_attributes_maxdays, pad.products_attributes_maxcount , pad.products_attributes_filename
                                     from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_OPTIONS_VALUES . " poval, " . TABLE_PRODUCTS_ATTRIBUTES . " pa
                                     left join " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " pad
                                     on pa.products_attributes_id=pad.products_attributes_id
                                     where pa.products_id = '" . $order->products[$i]['id'] . "'
                                     and pa.options_id = '" . $order->products[$i]['attributes'][$j]['option_id'] . "'
                                     and pa.options_id = popt.products_options_id
                                     and pa.options_values_id = '" . $order->products[$i]['attributes'][$j]['value_id'] . "'
                                     and pa.options_values_id = poval.products_options_values_id
                                     and popt.language_id = '" . $languages_id . "'
                                     and poval.language_id = '" . $languages_id . "'";
                $attributes = tep_db_query($attributes_query);
              } else {
                $attributes = tep_db_query("select popt.products_options_name, poval.products_options_values_name, pa.options_values_price, pa.price_prefix from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_OPTIONS_VALUES . " poval, " . TABLE_PRODUCTS_ATTRIBUTES . " pa where pa.products_id = '" . $order->products[$i]['id'] . "' and pa.options_id = '" . $order->products[$i]['attributes'][$j]['option_id'] . "' and pa.options_id = popt.products_options_id and pa.options_values_id = '" . $order->products[$i]['attributes'][$j]['value_id'] . "' and pa.options_values_id = poval.products_options_values_id and popt.language_id = '" . $languages_id . "' and poval.language_id = '" . $languages_id . "'");
              }
              $attributes_values = tep_db_fetch_array($attributes);
              // BOF shipping & handling fix by AlexStudio
              if (tep_not_null($attributes_values['products_attributes_filename'])) $item_has_shipping = false;
              // EOF shipping & handling fix by AlexStudio

// Unfortunately PayPal only accepts two attributes per product, so the
// third attribute onwards will not be shown at PayPal
              $parameters['on' . $j . '_' . $item] = $attributes_values['products_options_name'];
              $parameters['os' . $j . '_' . $item] = $attributes_values['products_options_values_name'];
            }
          }
          // BOF shipping & handling fix by AlexStudio
          $handling = $order_total['ot_loworderfee'];
          if ($n == 1 || $item < $n) {
            $parameters['handling_' . $item] = number_format($handling/$n * $currencies->get_value($my_currency), $currencies->get_decimal_places($my_currency));
            $handling_added += $parameters['handling_' . $item];
          } else {
            $parameters['handling_' . $item] = number_format($handling * $currencies->get_value($my_currency), $currencies->get_decimal_places($my_currency)) - $handling_added;
          }
          if ($item_has_shipping) {
            $shipping_count++;
            $shipping_items = $n - $virtual_items;
            if ($shipping_items == 1 || $shipping_count < $shipping_items) {
              $parameters['shipping_' . $item] = number_format(($order_total['ot_shipping']/$shipping_items) * $currencies->get_value($my_currency), $currencies->get_decimal_places($my_currency));
              $shipping_added += $parameters['shipping_' . $item];
            } else {
              $parameters['shipping_' . $item] = number_format($order_total['ot_shipping'] * $currencies->get_value($my_currency), $currencies->get_decimal_places($my_currency)) - $shipping_added;
            }
          }
          // EOF shipping & handling fix by AlexStudio
        }
        // BOF Tax pre item fix by AlexStudio
        $tax_total = number_format($order->info['tax'] * $currencies->get_value($my_currency), $currencies->get_decimal_places($my_currency));
        if ($tax_total > $item_tax && DISPLAY_PRICE_WITH_TAX != 'true') {
          $item++;
          $parameters['item_name_' . $item] = 'Shipping Tax';
          $parameters['amount_' . $item] = $tax_total - $item_tax;
          $parameters['quantity_' . $item] = 1;
        }
        // EOF Tax pre item fix by AlexStudio

        if(MOVE_TAX_TO_TOTAL_AMOUNT == 'True') {
          // BOF Tax pre item fix by AlexStudio
          $parameters['amount'] = number_format(($subtotal + $order->info['tax']) * $currencies->get_value($my_currency), $currencies->get_decimal_places($my_currency));
        } else {
          // default
          $parameters['amount'] = number_format($subtotal * $currencies->get_value($my_currency), $currencies->get_decimal_places($my_currency));
          // EOF Tax pre item fix by AlexStudio
        }

      } else {
        $parameters['cmd'] = '_ext-enter';
        $parameters['redirect_cmd'] = '_xclick';
        $parameters['item_name'] = STORE_NAME;
        // BOF shipping & handling fix by AlexStudio
        if(MOVE_TAX_TO_TOTAL_AMOUNT == 'True') {
          $parameters['amount'] = number_format(($subtotal + $order->info['tax']) * $currencies->get_value($my_currency), $currencies->get_decimal_places($my_currency));
        } else {
          // default
          $parameters['amount'] = number_format($subtotal * $currencies->get_value($my_currency), $currencies->get_decimal_places($my_currency));
          $parameters['tax'] = number_format($order->info['tax'] * $currencies->get_value($my_currency), $currencies->get_decimal_places($my_currency));
        }
        if ($order->content_type != 'virtual') {
          $parameters['shipping'] = number_format($order_total['ot_shipping'] * $currencies->get_value($my_currency), $currencies->get_decimal_places($my_currency));
        }
        $parameters['handling'] = number_format($order_total['ot_loworderfee'] * $currencies->get_value($my_currency), $currencies->get_decimal_places($my_currency));
        // EOF shipping & handling fix by AlexStudio
      }

      // BOF billing address fix by AlexStudio
      if ($order->content_type != 'virtual') {
        $state_abbr = tep_get_zone_code($order->delivery['country']['id'], $order->delivery['zone_id'], $order->delivery['state']);
      } else {
        $state_abbr = tep_get_zone_code($order->billing['country']['id'], $order->billing['zone_id'], $order->billing['state']);
      }
      // EOF billing address fix by AlexStudio

      $parameters['business'] = MODULE_PAYMENT_PAYPAL_IPN_ID;
      
      // let's check what has been defined in the shop admin for the shipping address
// BOF parameters fix by AlexStudio
      if ($order->content_type != 'virtual') {
        $parameters['address_override'] = '1';
        $parameters['no_shipping'] = '2';
        $parameters['night_phone_b'] = $order->customer['telephone'];
        $parameters['first_name'] = $order->delivery['firstname'];
        $parameters['last_name'] = $order->delivery['lastname'];
        $parameters['address1'] = $order->delivery['street_address'];
        $parameters['address2'] = $order->delivery['suburb'];
        $parameters['city'] = $order->delivery['city'];
        $parameters['zip'] = $order->delivery['postcode'];
        $parameters['state'] = $state_abbr;
        $parameters['country'] = $order->delivery['country']['iso_code_2'];
        $parameters['email'] = $order->customer['email_address'];
      } else {
        $parameters['no_shipping'] = '1';
        $parameters['night_phone_b'] = $order->customer['telephone'];
        $parameters['first_name'] = $order->billing['firstname'];
        $parameters['last_name'] = $order->billing['lastname'];
        $parameters['address1'] = $order->billing['street_address'];
        $parameters['address2'] = $order->billing['suburb'];
        $parameters['city'] = $order->billing['city'];
        $parameters['zip'] = $order->billing['postcode'];
        $parameters['state'] = $state_abbr;
        $parameters['country'] = $order->billing['country']['iso_code_2'];
        $parameters['email'] = $order->customer['email_address'];
      }
      /*********************************************************************************************
      *    Currently these are the supported charsets:                                             *
      *    big5, euc-jp, euc-kr, euc-tw, gb2312, hz-gb-2312, ibm-862, iso-2022-cn, iso-2022-jp,    *
      *    iso-2022-kr, iso-8859-1, iso-8859-2, iso-8859-3, iso-8859-4, iso-8859-5, iso-8859-6,    *
      *    iso-8859-7, iso-8859-8, iso-8859-9, iso-8859-13, iso-8859-15, ko18-r, shift_jis,        *
      *    utf-7, utf-8, utf-16, utf-16be, utf-16le, utf-16_platformendian, utf-16_oppositeendian, *
      *    utf-32, utf-32be, utf-32le, utf-32_platformendian, utf-32_oppositeendian, usa-ascii,    *
      *    windows-1250, windows-1251, windows-1252, windows-1253, windows-1254, windows-1255,     *
      *    windows-1256, windows-1257, windows-1258, windows-874, windows-949, x-mac-greek,        *
      *    x-mac-turkish, x-mac-centraleurroman, x-mac-cyrillic, ebcdic-cp-us, ibm-1047            *
      **********************************************************************************************/
      $parameters['charset'] = "utf-8"; // Modify this line if you have problems with the character set.
// EOF parameters fix by AlexStudio
      
      $parameters['currency_code'] = $my_currency;
      $parameters['invoice'] = substr($cart_PayPal_IPN_ID, strpos($cart_PayPal_IPN_ID, '-')+1);
      $parameters['custom'] = $customer_id;
      $parameters['no_note'] = '1';
      $parameters['notify_url'] = tep_href_link('ext/modules/payment/paypal_ipn/ipn.php', 'language=' . $_SESSION['language'], 'SSL', false, false);
      $parameters['cbt'] = CONFIRMATION_BUTTON_TEXT;  
      $parameters['return'] = tep_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL');
      $parameters['cancel_return'] = tep_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL');
      $parameters['bn'] = $this->identifier;
      $parameters['lc'] = $order->customer['country']['iso_code_2'];
      
      if (tep_not_null(MODULE_PAYMENT_PAYPAL_IPN_PAGE_STYLE)) {
        $parameters['page_style'] = MODULE_PAYMENT_PAYPAL_IPN_PAGE_STYLE;
      }

      if (MODULE_PAYMENT_PAYPAL_IPN_EWP_STATUS == 'True') {
        $parameters['cert_id'] = MODULE_PAYMENT_PAYPAL_IPN_EWP_CERT_ID;

        $random_string = rand(100000, 999999) . '-' . $customer_id . '-';

        $data = '';
        reset($parameters);
        while (list($key, $value) = each($parameters)) {
          $data .= $key . '=' . $value . "\n";
        }

        $fp = fopen(MODULE_PAYMENT_PAYPAL_IPN_EWP_WORKING_DIRECTORY . '/' . $random_string . 'data.txt', 'w');
        fwrite($fp, $data);
        fclose($fp);

        unset($data);

        if (function_exists('openssl_pkcs7_sign') && function_exists('openssl_pkcs7_encrypt')) {
          openssl_pkcs7_sign(MODULE_PAYMENT_PAYPAL_IPN_EWP_WORKING_DIRECTORY . '/' . $random_string . 'data.txt', MODULE_PAYMENT_PAYPAL_IPN_EWP_WORKING_DIRECTORY . '/' . $random_string . 'signed.txt', file_get_contents(MODULE_PAYMENT_PAYPAL_IPN_EWP_PUBLIC_KEY), file_get_contents(MODULE_PAYMENT_PAYPAL_IPN_EWP_PRIVATE_KEY), array('From' => MODULE_PAYMENT_PAYPAL_IPN_ID), PKCS7_BINARY);

          unlink(MODULE_PAYMENT_PAYPAL_IPN_EWP_WORKING_DIRECTORY . '/' . $random_string . 'data.txt');

// remove headers from the signature
          $signed = file_get_contents(MODULE_PAYMENT_PAYPAL_IPN_EWP_WORKING_DIRECTORY . '/' . $random_string . 'signed.txt');
          $signed = explode("\n\n", $signed);
          $signed = base64_decode($signed[1]);

          $fp = fopen(MODULE_PAYMENT_PAYPAL_IPN_EWP_WORKING_DIRECTORY . '/' . $random_string . 'signed.txt', 'w');
          fwrite($fp, $signed);
          fclose($fp);

          unset($signed);

          openssl_pkcs7_encrypt(MODULE_PAYMENT_PAYPAL_IPN_EWP_WORKING_DIRECTORY . '/' . $random_string . 'signed.txt', MODULE_PAYMENT_PAYPAL_IPN_EWP_WORKING_DIRECTORY . '/' . $random_string . 'encrypted.txt', file_get_contents(MODULE_PAYMENT_PAYPAL_IPN_EWP_PAYPAL_KEY), array('From' => MODULE_PAYMENT_PAYPAL_IPN_ID), PKCS7_BINARY);

          unlink(MODULE_PAYMENT_PAYPAL_IPN_EWP_WORKING_DIRECTORY . '/' . $random_string . 'signed.txt');

// remove headers from the encrypted result
          $data = file_get_contents(MODULE_PAYMENT_PAYPAL_IPN_EWP_WORKING_DIRECTORY . '/' . $random_string . 'encrypted.txt');
          $data = explode("\n\n", $data);
          $data = '-----BEGIN PKCS7-----' . "\n" . $data[1] . "\n" . '-----END PKCS7-----';

          unlink(MODULE_PAYMENT_PAYPAL_IPN_EWP_WORKING_DIRECTORY . '/' . $random_string . 'encrypted.txt');
        } else {
          exec(MODULE_PAYMENT_PAYPAL_IPN_EWP_OPENSSL . ' smime -sign -in ' . MODULE_PAYMENT_PAYPAL_IPN_EWP_WORKING_DIRECTORY . '/' . $random_string . 'data.txt -signer ' . MODULE_PAYMENT_PAYPAL_IPN_EWP_PUBLIC_KEY . ' -inkey ' . MODULE_PAYMENT_PAYPAL_IPN_EWP_PRIVATE_KEY . ' -outform der -nodetach -binary > ' . MODULE_PAYMENT_PAYPAL_IPN_EWP_WORKING_DIRECTORY . '/' . $random_string . 'signed.txt');
          unlink(MODULE_PAYMENT_PAYPAL_IPN_EWP_WORKING_DIRECTORY . '/' . $random_string . 'data.txt');

          exec(MODULE_PAYMENT_PAYPAL_IPN_EWP_OPENSSL . ' smime -encrypt -des3 -binary -outform pem ' . MODULE_PAYMENT_PAYPAL_IPN_EWP_PAYPAL_KEY . ' < ' . MODULE_PAYMENT_PAYPAL_IPN_EWP_WORKING_DIRECTORY . '/' . $random_string . 'signed.txt > ' . MODULE_PAYMENT_PAYPAL_IPN_EWP_WORKING_DIRECTORY . '/' . $random_string . 'encrypted.txt');
          unlink(MODULE_PAYMENT_PAYPAL_IPN_EWP_WORKING_DIRECTORY . '/' . $random_string . 'signed.txt');

          $fh = fopen(MODULE_PAYMENT_PAYPAL_IPN_EWP_WORKING_DIRECTORY . '/' . $random_string . 'encrypted.txt', 'rb');
          $data = fread($fh, filesize(MODULE_PAYMENT_PAYPAL_IPN_EWP_WORKING_DIRECTORY . '/' . $random_string . 'encrypted.txt'));
          fclose($fh);

          unlink(MODULE_PAYMENT_PAYPAL_IPN_EWP_WORKING_DIRECTORY . '/' . $random_string . 'encrypted.txt');
        }

        $process_button_string = tep_draw_hidden_field('cmd', '_s-xclick') .
                                 tep_draw_hidden_field('encrypted', $data);

        unset($data);
      } else {
        reset($parameters);
        while (list($key, $value) = each($parameters)) {
          $process_button_string .= tep_draw_hidden_field($key, $value);
        }
      }
      return $process_button_string;
    }

    function before_process() {
      global $cart;

      $cart->reset(true);

// unregister session variables used during checkout
      tep_session_unregister('sendto');
      tep_session_unregister('billto');
      tep_session_unregister('shipping');
      tep_session_unregister('payment');
      tep_session_unregister('comments');

      tep_session_unregister('cart_PayPal_IPN_ID');

      tep_redirect(tep_href_link(FILENAME_CHECKOUT_SUCCESS, '', 'SSL'));
    }

    function after_process() {
      return false;
    }

    function output_error() {
      return false;
    }

    function check() {
      if (!isset($this->_check)) {
        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_PAYPAL_IPN_STATUS'");
        $this->_check = tep_db_num_rows($check_query);
      }
      return $this->_check;
    }

    function install() {
      $check_query = tep_db_query("select orders_status_id from " . TABLE_ORDERS_STATUS . " where orders_status_name = 'Preparing [PayPal IPN]' limit 1");

      if (tep_db_num_rows($check_query) < 1) {
        $status_query = tep_db_query("select max(orders_status_id) as status_id from " . TABLE_ORDERS_STATUS);
        $status = tep_db_fetch_array($status_query);

        $status_id = $status['status_id']+1;

        $languages = tep_get_languages();

        foreach ($languages as $lang) {
          tep_db_query("insert into " . TABLE_ORDERS_STATUS . " (orders_status_id, language_id, orders_status_name) values ('" . $status_id . "', '" . $lang['id'] . "', 'Preparing [PayPal IPN]')");
        }
      } else {
        $check = tep_db_fetch_array($check_query);

        $status_id = $check['orders_status_id'];
      }

      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable PayPal IPN Module', 'MODULE_PAYMENT_PAYPAL_IPN_STATUS', 'False', 'Do you want to accept PayPal IPN payments?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Gateway Server', 'MODULE_PAYMENT_PAYPAL_IPN_GATEWAY_SERVER', 'Testing', 'Use the testing (sandbox) or live gateway server for transactions?', '6', '2', 'tep_cfg_select_option(array(\'Testing\',\'Live\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort order of display.', 'MODULE_PAYMENT_PAYPAL_IPN_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '3', now())");            
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('E-Mail Address', 'MODULE_PAYMENT_PAYPAL_IPN_ID', '', 'The e-mail address to use for the PayPal IPN service', '6', '5', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Transaction Currency', 'MODULE_PAYMENT_PAYPAL_IPN_CURRENCY', 'Selected Currency', 'The currency to use for transactions', '6', '10', 'tep_cfg_select_option(array(\'Selected Currency\',\'Only USD\',\'Only GBP\',\'Only AUD\',\'Only CAD\',\'Only CHF\',\'Only CZK\',\'Only DKK\',\'Only EUR\',\'Only HKD\',\'Only HUF\',\'Only JPY\',\'Only NOK\',\'Only NZD\',\'Only PLN\',\'Only SEK\',\'Only SGD\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Payment Zone', 'MODULE_PAYMENT_PAYPAL_IPN_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '11', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set Preparing Order Status', 'MODULE_PAYMENT_PAYPAL_IPN_PREPARE_ORDER_STATUS_ID', '" . $status_id . "', 'Set the status of prepared orders made with this payment module to this value', '6', '12', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set PayPal Acknowledged Order Status', 'MODULE_PAYMENT_PAYPAL_IPN_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', '6', '13', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set PayPal Completed Order Status', 'MODULE_PAYMENT_PAYPAL_IPN_COMP_ORDER_STATUS_ID', '0', 'Set the status of orders which are confirmed as paid (completed) to this value', '6', '13', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Transaction Type', 'MODULE_PAYMENT_PAYPAL_IPN_TRANSACTION_TYPE', 'Aggregate', 'Send individual items to PayPal or aggregate all as one total item?', '6', '14', 'tep_cfg_select_option(array(\'Per Item\',\'Aggregate\'), ', now())");
      // bof PandA.nl move tax to total amount
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Move tax to total amount', 'MOVE_TAX_TO_TOTAL_AMOUNT', 'True', 'Do you want to move the tax to the total amount? If true PayPal will allways show the total amount including tax. (needs Aggregate instead of Per Item to function)', '6', '15', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      // eof PandA.nl move tax to total amount      
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Page Style', 'MODULE_PAYMENT_PAYPAL_IPN_PAGE_STYLE', '', 'The page style to use for the transaction procedure (defined at your PayPal Profile page)', '6', '20', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Debug E-Mail Address', 'MODULE_PAYMENT_PAYPAL_IPN_DEBUG_EMAIL', '', 'All parameters of an Invalid IPN notification will be sent to this email address if one is entered.', '6', '21', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('cURL Proxy server', 'MODULE_PAYMENT_PAYPAL_IPN_PROXY_SERVER', '', 'If curl transactions need to go through a proxy, type the address here starting with http://. Otherwise, leave it blank. The current GoDaddy proxy address is http://proxy.shr.secureserver.net:3128', '6', '22', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Encrypted Web Payments', 'MODULE_PAYMENT_PAYPAL_IPN_EWP_STATUS', 'False', 'Do you want to enable Encrypted Web Payments?', '6', '30', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Your Private Key', 'MODULE_PAYMENT_PAYPAL_IPN_EWP_PRIVATE_KEY', '', 'The location of your Private Key to use for signing the data. (*.pem)', '6', '31', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Your Public Certificate', 'MODULE_PAYMENT_PAYPAL_IPN_EWP_PUBLIC_KEY', '', 'The location of your Public Certificate to use for signing the data. (*.pem)', '6', '32', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('PayPals Public Certificate', 'MODULE_PAYMENT_PAYPAL_IPN_EWP_PAYPAL_KEY', '', 'The location of the PayPal Public Certificate for encrypting the data.', '6', '33', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Your PayPal Public Certificate ID', 'MODULE_PAYMENT_PAYPAL_IPN_EWP_CERT_ID', '', 'The Certificate ID to use from your PayPal Encrypted Payment Settings Profile.', '6', '34', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Working Directory', 'MODULE_PAYMENT_PAYPAL_IPN_EWP_WORKING_DIRECTORY', '', 'The working directory to use for temporary files. (trailing slash needed)', '6', '35', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('OpenSSL Location', 'MODULE_PAYMENT_PAYPAL_IPN_EWP_OPENSSL', '/usr/bin/openssl', 'The location of the openssl binary file.', '6', '36', now())");

    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

   function keys() {
    // PandA.nl move tax to total amount added: ", 'MOVE_TAX_TO_TOTAL_AMOUNT'"
     return array('MODULE_PAYMENT_PAYPAL_IPN_STATUS', 'MODULE_PAYMENT_PAYPAL_IPN_GATEWAY_SERVER', 'MODULE_PAYMENT_PAYPAL_IPN_ID', 'MODULE_PAYMENT_PAYPAL_IPN_SORT_ORDER', 'MODULE_PAYMENT_PAYPAL_IPN_CURRENCY', 'MODULE_PAYMENT_PAYPAL_IPN_ZONE', 'MODULE_PAYMENT_PAYPAL_IPN_PREPARE_ORDER_STATUS_ID', 'MODULE_PAYMENT_PAYPAL_IPN_ORDER_STATUS_ID', 'MODULE_PAYMENT_PAYPAL_IPN_COMP_ORDER_STATUS_ID', 'MODULE_PAYMENT_PAYPAL_IPN_TRANSACTION_TYPE', 'MOVE_TAX_TO_TOTAL_AMOUNT', 'MODULE_PAYMENT_PAYPAL_IPN_PAGE_STYLE', 'MODULE_PAYMENT_PAYPAL_IPN_DEBUG_EMAIL', 'MODULE_PAYMENT_PAYPAL_IPN_PROXY_SERVER', 'MODULE_PAYMENT_PAYPAL_IPN_EWP_STATUS', 'MODULE_PAYMENT_PAYPAL_IPN_EWP_PRIVATE_KEY', 'MODULE_PAYMENT_PAYPAL_IPN_EWP_PUBLIC_KEY', 'MODULE_PAYMENT_PAYPAL_IPN_EWP_PAYPAL_KEY', 'MODULE_PAYMENT_PAYPAL_IPN_EWP_CERT_ID', 'MODULE_PAYMENT_PAYPAL_IPN_EWP_WORKING_DIRECTORY', 'MODULE_PAYMENT_PAYPAL_IPN_EWP_OPENSSL');
   }
  }
?>
