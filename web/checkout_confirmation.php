<?php
/*
  $Id: checkout_confirmation.php,v 1.139 2003/06/11 17:34:53 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

// if the customer is not logged on, redirect them to the login page
  if (!tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot(array('mode' => 'SSL', 'page' => FILENAME_CHECKOUT_PAYMENT));
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

// if there is nothing in the customers cart, redirect them to the shopping cart page
  if ($cart->count_contents() < 1) {
    tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
  }

// avoid hack attempts during the checkout procedure by checking the internal cartID
  if (isset($cart->cartID) && tep_session_is_registered('cartID')) {
    if ($cart->cartID != $cartID) {
      tep_redirect(tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
    }
  }

// if no shipping method has been selected, redirect the customer to the shipping method selection page
  if (!tep_session_is_registered('shipping')) {
//    tep_redirect(tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
  }

  if (!tep_session_is_registered('payment')) tep_session_register('payment');
  if (isset($_POST['payment'])) $payment = $_POST['payment'];

  if (!tep_session_is_registered('comments')) tep_session_register('comments');
  if (tep_not_null($_POST['comments'])) {
    $comments = tep_db_prepare_input($_POST['comments']);
  }

// load the selected payment module
  require(DIR_WS_CLASSES . 'payment.php');
// ################# Added CGV Contribution ##################"
  if ($credit_covers) $payment=''; //ICW added for CREDIT CLASS
// ################# End Added CGV Contribution ##################"
  $payment_modules = new payment($payment);
// ################# Added CGV Contribution ##################"
  require(DIR_WS_CLASSES . 'order_total.php');
// ################# End Added CGV Contribution ##################"

  require(DIR_WS_CLASSES . 'order.php');
  $order = new order;

  $payment_modules->update_status();


  if (is_array($payment_modules->modules)) {
    $payment_modules->pre_confirmation_check();
  }

// load the selected shipping module
  require(DIR_WS_CLASSES . 'shipping.php');
  $shipping_modules = new shipping($shipping);

// ################# Added CGV Contribution ##################"
// CCGV Contribution
  $order_total_modules = new order_total;
  $order_total_modules->process();
  $order_total_modules->collect_posts();
  $order_total_modules->pre_confirmation_check();

// >>> FOR ERROR gv_redeem_code NULL 
//if (isset($_POST['gv_redeem_code']) && ($_POST['gv_redeem_code'] == null)) {tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));} 
// <<< end for error

##### Points/Rewards Module V2.00 check for error BOF #######
  if (isset($_POST['customer_shopping_points_spending']) && USE_REDEEM_SYSTEM == 'true') {
    if (isset($_POST['customer_shopping_points_spending']) && tep_calc_shopping_pvalue($customer_shopping_points_spending) < $order->info['total'] && !is_object($$payment)) {
//      tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'error_message=' . urlencode(REDEEM_SYSTEM_ERROR_POINTS_NOT), 'SSL'));
    } else {
    if (!tep_session_is_registered('customer_shopping_points_spending'))
      tep_session_register('customer_shopping_points_spending');
    }
  }
  if (isset($_POST['customer_referred']) && tep_not_null($_POST['customer_referred'])) {
    $valid_referral_query = tep_db_query("SELECT customers_id FROM " . TABLE_CUSTOMERS . " WHERE customers_email_address = '" . $_POST['customer_referred'] . "'");
	$valid_referral = tep_db_fetch_array($valid_referral_query);
    if (!tep_db_num_rows($valid_referral_query)) {
//      tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'error_message=' . urlencode(REFERRAL_ERROR_NOT_FOUND), 'SSL'));
    }
    if ($_POST['customer_referred'] == $order->customer['email_address']) {
      tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'error_message=' . urlencode(REFERRAL_ERROR_SELF), 'SSL'));
    } else {
      $customer_referral = $valid_referral['customers_id'];
      if (!tep_session_is_registered('customer_referral')) tep_session_register('customer_referral');
    }
  }
  if ( ( (is_array($payment_modules->modules)) && (sizeof($payment_modules->modules) > 1) && (!is_object($$payment)) && (!$credit_covers) && (!$customer_shopping_points_spending) ) || ( (is_object($$payment)) && ($$payment->enabled == false) ) ) {
//jsp:     tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'error_message=' . urlencode(ERROR_NO_PAYMENT_MODULE_SELECTED), 'SSL'));
   }
########  Points/Rewards Module V2.00 EOF #################*/

// Stock Check
  $any_out_of_stock = false;
  if (STOCK_CHECK == 'true') {
    for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
      if (tep_check_stock($order->products[$i]['id'], $order->products[$i]['qty'])) {
        $any_out_of_stock = true;
      }
    }
    // Out of Stock
    if ( (STOCK_ALLOW_CHECKOUT != 'true') && ($any_out_of_stock == true) ) {
      tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
    }
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT_CONFIRMATION);

  $breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
  $breadcrumb->add(NAVBAR_TITLE_2);

  $content = basename($_SERVER['PHP_SELF']);
  while (strstr($content, '.php')) $content = str_replace('.php', '', $content);

  $javascript = 'remove_label.js';
  include (bts_select('main', $content_template)); // BTSv1.5

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>