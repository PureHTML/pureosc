<?php
/*
  $Id: paypal_ipn.php,v 2.3.0.0 10/09/2007 11:58:21 alexstudio Exp $

  Copyright (c) 2008 osCommerce
  Released under the GNU General Public License
  
  Original Authors: Harald Ponce de Leon, Mark Evans 
  Updates by PandA.nl, Navyhost, Zoeticlight, David, gravyface, AlexStudio, windfjf, Monika in Germany and Terra
  v2.3 updated by AlexStudio
    
*/

  chdir('../../../../');
  require('includes/application_top.php');
  include(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT_PROCESS);
  // BOF configuration keys fix by AlexStudio
  require(DIR_WS_CLASSES . 'payment.php');
  $payment_modules = new payment(paypal_ipn);
  // EOF configuration keys fix by AlexStudio

  $parameters = 'cmd=_notify-validate';

  foreach ($_POST as $key => $value) {
    $parameters .= '&' . $key . '=' . urlencode(stripslashes($value));
  }

  if (MODULE_PAYMENT_PAYPAL_IPN_GATEWAY_SERVER == 'Live') {
    $server = 'www.paypal.com';
  } else {
    $server = 'www.sandbox.paypal.com';
  }

  $fsocket = false;
  $curl = false;
  $result = false;

  if ( (PHP_VERSION >= 4.3) && ($fp = @fsockopen('ssl://' . $server, 443, $errno, $errstr, 30)) ) {
    $fsocket = true;
  } elseif (function_exists('curl_exec')) {
    $curl = true;
  } elseif ($fp = @fsockopen($server, 80, $errno, $errstr, 30)) {
    $fsocket = true;
  }

  if ($fsocket == true) {
    $header = 'POST /cgi-bin/webscr HTTP/1.0' . "\r\n" .
              'Host: ' . $server . "\r\n" .
              'Content-Type: application/x-www-form-urlencoded' . "\r\n" .
              'Content-Length: ' . strlen($parameters) . "\r\n" .
              'Connection: close' . "\r\n\r\n";

    @fputs($fp, $header . $parameters);

    $string = '';
    while (!@feof($fp)) {
      $res = @fgets($fp, 1024);
      $string .= $res;

      if ( ($res == 'VERIFIED') || ($res == 'INVALID') ) {
        $result = $res;
        break;
      }
    }

    @fclose($fp);
  } elseif ($curl == true) {
    $ch = curl_init();

    // BOF add by AlexStudio
    // For the poor souls on GoDaddy and the like, set the connection to go through their proxy
    if (trim(MODULE_PAYMENT_PAYPAL_IPN_PROXY_SERVER) != '') {
      curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
      curl_setopt($ch, CURLOPT_PROXY, MODULE_PAYMENT_PAYPAL_IPN_PROXY_SERVER);
    }
    // Eof add by AlexStudio
    curl_setopt($ch, CURLOPT_URL, 'https://' . $server . '/cgi-bin/webscr');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $parameters);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

    $result = curl_exec($ch);

    curl_close($ch);
  }

  if ($result == 'VERIFIED') {
    if (isset($_POST['invoice']) && is_numeric($_POST['invoice']) && ($_POST['invoice'] > 0)) {
      $order_query = tep_db_query("select currency, currency_value from " . TABLE_ORDERS . " where orders_id = '" . $_POST['invoice'] . "' and customers_id = '" . (int)$_POST['custom'] . "'");
      if (tep_db_num_rows($order_query) > 0) {
        $order_db = tep_db_fetch_array($order_query);

        // let's re-create the required arrays
        require(DIR_WS_CLASSES . 'order.php');
        $order = new order($_POST['invoice']);

        // let's update the order status
        $total_query = tep_db_query("select value from " . TABLE_ORDERS_TOTAL . " where orders_id = '" . $_POST['invoice'] . "' and class = 'ot_total' limit 1");
        $total = tep_db_fetch_array($total_query);

        $comment_status = 'payment status: ' . $_POST['payment_status'] . ' (' . ucfirst($_POST['payer_status']) . '; ' . $currencies->format($_POST['mc_gross'], false, $_POST['mc_currency']) . ')';

        if ($_POST['payment_status'] == 'Pending') {
          $comment_status .= '; ' . $_POST['pending_reason'];
        } elseif ( ($_POST['payment_status'] == 'Reversed') || ($_POST['payment_status'] == 'Refunded') ) {
          $comment_status .= '; ' . $_POST['reason_code'];
        } elseif ( ($_POST['payment_status'] == 'Completed') && (tep_not_null($_POST['address_street'])) ) {
          $comment_status .= ", \n" . PAYPAL_ADDRESS . ": " . $_POST['address_name'] . ", " . $_POST['address_street'] . ", " . $_POST['address_city'] . ", " . $_POST['address_zip'] . ", " . $_POST['address_state'] . ", " . $_POST['address_country'] . ", " . $_POST['address_country_code'] . ", " . $_POST['address_status'];
        } 

        $order_status_id = DEFAULT_ORDERS_STATUS_ID;

// modified AlexStudio's Rounding error bug fix 
// variances of up to 0.05 on either side (plus / minus) are ignored
        if ((((number_format($total['value'] * $order_db['currency_value'], $currencies->get_decimal_places($order_db['currency']))) -  $_POST['mc_gross']) <= 0.05)  
          &&
          (((number_format($total['value'] * $order_db['currency_value'], $currencies->get_decimal_places($order_db['currency']))) -  $_POST['mc_gross']) >= -0.05)) {

// Terra -> modified update. If payment status is "completed" than a completed order status is chosen based on the admin settings 
          if ( (MODULE_PAYMENT_PAYPAL_IPN_COMP_ORDER_STATUS_ID > 0) && ($_POST['payment_status'] == 'Completed') ) {
            $order_status_id = MODULE_PAYMENT_PAYPAL_IPN_COMP_ORDER_STATUS_ID;
          } elseif (MODULE_PAYMENT_PAYPAL_IPN_ORDER_STATUS_ID > 0) {
            $order_status_id = MODULE_PAYMENT_PAYPAL_IPN_ORDER_STATUS_ID;
          }
        }

        // Let's see what the PayPal payment status is and set the notification accordingly
        // more info: https://www.paypal.com/IntegrationCenter/ic_ipn-pdt-variable-reference.html
        if ( ($_POST['payment_status'] == 'Pending') || ($_POST['payment_status'] == 'Completed')) {
          $customer_notified = '1'; 
        } else {
          $customer_notified = '0'; 
        }

        tep_db_query("update " . TABLE_ORDERS . " set orders_status = '" . $order_status_id . "', last_modified = now() where orders_id = '" . $_POST['invoice'] . "'");

        $sql_data_array = array('orders_id' => $_POST['invoice'],
                                'orders_status_id' => $order_status_id,
                                'date_added' => 'now()',
                                'customer_notified' => $customer_notified,
                                'comments' => 'PayPal IPN Verified [' . $comment_status . ']');

        tep_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array);

// If the order is completed, then we want to send the order email and update the stock
        if ($_POST['payment_status'] == 'Completed') { // START STATUS == COMPLETED LOOP

// initialized for the email confirmation
          $products_ordered = '';
          $total_tax = 0;

// let's update the stock  
#######################################################
          for ($i=0, $n=sizeof($order->products); $i<$n; $i++) { // PRODUCT LOOP STARTS HERE
// Stock Update - Joao Correia
            if (STOCK_LIMITED == 'true') {
              if (DOWNLOAD_ENABLED == 'true') {
                $stock_query_raw = "SELECT products_quantity, pad.products_attributes_filename 
                                    FROM " . TABLE_PRODUCTS . " p
                                    LEFT JOIN " . TABLE_PRODUCTS_ATTRIBUTES . " pa
                                    ON p.products_id=pa.products_id
                                    LEFT JOIN " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " pad
                                    ON pa.products_attributes_id=pad.products_attributes_id
                                    WHERE p.products_id = '" . tep_get_prid($order->products[$i]['id']) . "'";
// Will work with only one option for downloadable products
// otherwise, we have to build the query dynamically with a loop
                $products_attributes = $order->products[$i]['attributes'];
                if (is_array($products_attributes)) {
                  $stock_query_raw .= " AND pa.options_id = '" . $products_attributes[0]['option_id'] . "' AND pa.options_values_id = '" . $products_attributes[0]['value_id'] . "'";
                }
                $stock_query = tep_db_query($stock_query_raw);
              } else {
                $stock_query = tep_db_query("select products_quantity from " . TABLE_PRODUCTS . " where products_id = '" . tep_get_prid($order->products[$i]['id']) . "'");
              }
              if (tep_db_num_rows($stock_query) > 0) {
                $stock_values = tep_db_fetch_array($stock_query);
// do not decrement quantities if products_attributes_filename exists
                if ((DOWNLOAD_ENABLED != 'true') || (!$stock_values['products_attributes_filename'])) {
                  $stock_left = $stock_values['products_quantity'] - $order->products[$i]['qty'];
                } else {
                  $stock_left = $stock_values['products_quantity'];
                }
                tep_db_query("update " . TABLE_PRODUCTS . " set products_quantity = '" . $stock_left . "' where products_id = '" . tep_get_prid($order->products[$i]['id']) . "'");
                if ( ($stock_left < 1) && (STOCK_ALLOW_CHECKOUT == 'false') ) {
                  tep_db_query("update " . TABLE_PRODUCTS . " set products_status = '0' where products_id = '" . tep_get_prid($order->products[$i]['id']) . "'");
                }
              }
            }

// Update products_ordered (for bestsellers list)
            tep_db_query("update " . TABLE_PRODUCTS . " set products_ordered = products_ordered + " . sprintf('%d', $order->products[$i]['qty']) . " where products_id = '" . tep_get_prid($order->products[$i]['id']) . "'");

// Let's get all the info together for the email
            $total_weight += ($order->products[$i]['qty'] * $order->products[$i]['weight']);
            $total_tax += tep_calculate_tax($total_products_price, $products_tax) * $order->products[$i]['qty'];
            $total_cost += $total_products_price;

// Let's get the attributes
            $products_ordered_attributes = '';
            if ( (isset($order->products[$i]['attributes'])) && (sizeof($order->products[$i]['attributes']) > 0) ) {
              for ($j=0, $n2=sizeof($order->products[$i]['attributes']); $j<$n2; $j++) {
                $products_ordered_attributes .= "\n\t" . $order->products[$i]['attributes'][$j]['option'] . ' ' . $order->products[$i]['attributes'][$j]['value'];
              }
            } 

// Let's format the products model       
            $products_model = '';      
            if ( !empty($order->products[$i]['model']) ) {
              $products_model = ' (' . $order->products[$i]['model'] . ')';
            } 

// Let's put all the product info together into a string
            $products_ordered .= $order->products[$i]['qty'] . ' x ' . $order->products[$i]['name'] . $products_model . ' = ' . $currencies->display_price($order->products[$i]['final_price'], $order->products[$i]['tax'], $order->products[$i]['qty']) . $products_ordered_attributes . "\n";
          }        // PRODUCT LOOP ENDS HERE
#######################################################

// lets start with the email confirmation
// BOF content type fix by AlexStudio
            $content_type = '';
            $content_count = 0;
            // BOF order comment fix
            $comment_query = tep_db_query("select comments from " . TABLE_ORDERS_STATUS_HISTORY . " where orders_id = '" . $_POST['invoice'] . "'");
            $comment_array = tep_db_fetch_array($comment_query);
            $comments = $comment_array['comments'];
            // EOF order comment fix

            if (DOWNLOAD_ENABLED == 'true') {
              $content_query = tep_db_query("select * from " . TABLE_ORDERS_PRODUCTS_DOWNLOAD . " where orders_id = '" . (int)$_POST['invoice'] . "'");
              $content_count = tep_db_num_rows($content_query);
              if ($content_count > 0) {
                $content_type = 'virtual';
              }
            }
            switch ($content_type) {
              case 'virtual':
                if ($content_count != sizeof($order->products)) $content_type = 'mixed'; 
                break;
              default:
                $content_type = 'physical';
                break;
            }
// EOF content type fix by AlexStudio
// $order variables have been changed from checkout_process to work with the variables from the function query () instead of cart () in the order class
          $email_order = STORE_NAME . "\n" . 
                         EMAIL_SEPARATOR . "\n" . 
                         EMAIL_TEXT_ORDER_NUMBER . ' ' . $_POST['invoice'] . "\n" .
                         EMAIL_TEXT_INVOICE_URL . ' ' . tep_href_link(FILENAME_ACCOUNT_HISTORY_INFO, 'order_id=' . $_POST['invoice'], 'SSL', false) . "\n" .
                         EMAIL_TEXT_DATE_ORDERED . ' ' . strftime(DATE_FORMAT_LONG) . "\n\n";

          // BOF order comment fix by AlexStudio
          if ($comments) {
            $email_order .= $comments . "\n\n";
          }
          // EOF order comment fix by AlexStudio

          $email_order .= EMAIL_TEXT_PRODUCTS . "\n" . 
                          EMAIL_SEPARATOR . "\n" . 
                          $products_ordered . 
                          EMAIL_SEPARATOR . "\n";

          for ($i=0, $n=sizeof($order->totals); $i<$n; $i++) {
            $email_order .= strip_tags($order->totals[$i]['title']) . ' ' . strip_tags($order->totals[$i]['text']) . "\n";
          }

          // BOF content type fix by AlexStudio
          if ($content_type != 'virtual') {
          // EOF content type fix by AlexStudio
            $email_order .= "\n" . EMAIL_TEXT_DELIVERY_ADDRESS . "\n" . 
                            EMAIL_SEPARATOR . "\n" .
                            tep_address_format($order->delivery['format_id'], $order->delivery,  0, '', "\n") . "\n";
          }

          $email_order .= "\n" . EMAIL_TEXT_BILLING_ADDRESS . "\n" .
                          EMAIL_SEPARATOR . "\n" .
                          tep_address_format($order->billing['format_id'], $order->billing, 0, '', "\n") . "\n\n";
          if (is_object($$payment)) {
            $email_order .= EMAIL_TEXT_PAYMENT_METHOD . "\n" . 
                            EMAIL_SEPARATOR . "\n";
            $payment_class = $$payment;
            $email_order .= $payment_class->title . "\n\n";
            if ($payment_class->email_footer) { 
              $email_order .= $payment_class->email_footer . "\n\n";
            }
          }
          tep_mail($order->customer['name'], $order->customer['email_address'], EMAIL_TEXT_SUBJECT, nl2br($email_order), STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);

// send emails to other people
          if (SEND_EXTRA_ORDER_EMAILS_TO != '') {
            tep_mail('', SEND_EXTRA_ORDER_EMAILS_TO, EMAIL_TEXT_SUBJECT, nl2br($email_order), STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
          }
        } // END STATUS == COMPLETED LOOP

        if ($_POST['payment_status'] == 'Pending') { // START STATUS == PENDING LOOP

          $email_order = STORE_NAME . "\n" . 
                         EMAIL_SEPARATOR . "\n" . 
                         EMAIL_TEXT_ORDER_NUMBER . ' ' . $_POST['invoice'] . "\n" .
                         EMAIL_TEXT_INVOICE_URL . ' ' . tep_href_link(FILENAME_ACCOUNT_HISTORY_INFO, 'order_id=' . $_POST['invoice'], 'SSL', false) . "\n" .
                         EMAIL_TEXT_DATE_ORDERED . ' ' . strftime(DATE_FORMAT_LONG) . "\n\n" . 
                         EMAIL_SEPARATOR . "\n" .
                         EMAIL_PAYPAL_PENDING_NOTICE . "\n\n"; 

          tep_mail($order->customer['name'], $order->customer['email_address'], EMAIL_TEXT_SUBJECT, $email_order, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);

// send emails to other people
          if (SEND_EXTRA_ORDER_EMAILS_TO != '') {
            tep_mail('', SEND_EXTRA_ORDER_EMAILS_TO, EMAIL_TEXT_SUBJECT, $email_order, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
          } 
        } // END STATUS == PENDING LOOP
//emptying cart for everyone! by Monika in Germany
        tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" . (int)$_POST['custom'] . "'");
        tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " where customers_id = '" . (int)$_POST['custom'] . "'");
//end emptying cart for everyone
      }
    }
  } else {
    if (tep_not_null(MODULE_PAYMENT_PAYPAL_IPN_DEBUG_EMAIL)) {
      $email_body = '$_POST:' . "\n\n";
      foreach ($_POST as $key => $value) {
        $email_body .= $key . '=' . $value . "\n";
      }
      $email_body .= "\n" . '$_GET:' . "\n\n";
      foreach ($_GET as $key => $value) {
        $email_body .= $key . '=' . $value . "\n";
      }
      tep_mail('', MODULE_PAYMENT_PAYPAL_IPN_DEBUG_EMAIL, 'PayPal IPN Invalid Process', $email_body, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
    }

    if (isset($_POST['invoice']) && is_numeric($_POST['invoice']) && ($_POST['invoice'] > 0)) {
      $check_query = tep_db_query("select orders_id from " . TABLE_ORDERS . " where orders_id = '" . $_POST['invoice'] . "' and customers_id = '" . (int)$_POST['custom'] . "'");
      if (tep_db_num_rows($check_query) > 0) {
        $comment_status = $_POST['payment_status'];

        if ($_POST['payment_status'] == 'Pending') {
          $comment_status .= '; ' . $_POST['pending_reason'];
        } elseif ( ($_POST['payment_status'] == 'Reversed') || ($_POST['payment_status'] == 'Refunded') ) {
          $comment_status .= '; ' . $_POST['reason_code'];
        }

        tep_db_query("update " . TABLE_ORDERS . " set orders_status = '" . ((MODULE_PAYMENT_PAYPAL_IPN_ORDER_STATUS_ID > 0) ? MODULE_PAYMENT_PAYPAL_IPN_ORDER_STATUS_ID : DEFAULT_ORDERS_STATUS_ID) . "', last_modified = now() where orders_id = '" . $_POST['invoice'] . "'");

        $sql_data_array = array('orders_id' => $_POST['invoice'],
                                'orders_status_id' => (MODULE_PAYMENT_PAYPAL_IPN_ORDER_STATUS_ID > 0) ? MODULE_PAYMENT_PAYPAL_IPN_ORDER_STATUS_ID : DEFAULT_ORDERS_STATUS_ID,
                                'date_added' => 'now()',
                                'customer_notified' => '0',
                                'comments' => 'PayPal IPN Invalid [' . $comment_status . ']');

        tep_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array);
      }
    }
  }

  require('includes/application_bottom.php');
?>
