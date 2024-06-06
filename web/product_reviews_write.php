<?php
/*
  $Id: product_reviews_write.php,v 1.55 2003/06/20 14:25:58 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

// BOF Anti Robot Registration v2.6
  if (ACCOUNT_VALIDATION == 'true' && ACCOUNT_REVIEW_VALIDATION == 'true') {
    require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ACCOUNT_VALIDATION);
    include_once('includes/functions/' . FILENAME_ACCOUNT_VALIDATION);
  }
// EOF Anti Robot Registration v2.6

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_PRODUCT_REVIEWS_WRITE);

  if (!tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

  $product_info_query = tep_db_query("select p.products_id, p.products_model, p.products_image, p.products_price, p.products_tax_class_id, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = '" . (int)$_GET['products_id'] . "' and p.products_status = '1' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "'");
  if (!tep_db_num_rows($product_info_query)) {
//*** <Reviews Mod>
//    tep_redirect(tep_href_link(FILENAME_PRODUCT_REVIEWS, tep_get_all_get_params(array('action'))));
    tep_redirect(tep_href_link(FILENAME_REVIEW_NOTICE, tep_get_all_get_params(array('action'))));
//*** </Reviews Mod>
  } else {
    $product_info = tep_db_fetch_array($product_info_query);
  }

  $customer_query = tep_db_query("select customers_firstname, customers_lastname from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$customer_id . "'");
  $customer = tep_db_fetch_array($customer_query);

  if (isset($_GET['action']) && ($_GET['action'] == 'process')) {

// BOF Anti Robot Registration v2.6
    if (ACCOUNT_VALIDATION == 'true' && ACCOUNT_REVIEW_VALIDATION == 'true') {
      $sql = "SELECT * FROM " . TABLE_ANTI_ROBOT_REGISTRATION . " WHERE session_id = '" . tep_session_id() . "' LIMIT 1";
      if( !$result = tep_db_query($sql) ) {
        $error = true;
        $entry_antirobotreg_error = true;
        $text_antirobotreg_error = ERROR_VALIDATION_1;
      } else {
        $entry_antirobotreg_error = false;
        $anti_robot_row = tep_db_fetch_array($result);
        if (( strtoupper($_POST['antirobotreg']) != $anti_robot_row['reg_key'] ) || ($anti_robot_row['reg_key'] == '') || (strlen($antirobotreg) != ENTRY_VALIDATION_LENGTH)) {
          $error = true;
          $entry_antirobotreg_error = true;
          $text_antirobotreg_error = ERROR_VALIDATION_2;
        } else {
          $sql = "DELETE FROM " . TABLE_ANTI_ROBOT_REGISTRATION . " WHERE session_id = '" . tep_session_id() . "'";
          if( !$result = tep_db_query($sql) ) {
            $error = true;
            $entry_antirobotreg_error = true;
            $text_antirobotreg_error = ERROR_VALIDATION_3;
          } else {
            $sql = "OPTIMIZE TABLE " . TABLE_ANTI_ROBOT_REGISTRATION . "";
            if( !$result = tep_db_query($sql) ) {
              $error = true;
              $entry_antirobotreg_error = true;
              $text_antirobotreg_error = ERROR_VALIDATION_4;
            } else {
              $entry_antirobotreg_error = false;
            }
          }
        }
      }
      if ($entry_antirobotreg_error == true) $messageStack->add('product_reviews_write', $text_antirobotreg_error);
    }
// EOF Anti Robot Registration v2.6

    $rating = tep_db_prepare_input($_POST['rating']);
    $review = tep_db_prepare_input($_POST['review']);

    $error = false;
    if (strlen($review) < REVIEW_TEXT_MIN_LENGTH) {
      $error = true;

      $messageStack->add('review', JS_REVIEW_TEXT);
    }

    if (($rating < 1) || ($rating > 5)) {
      $error = true;

      $messageStack->add('review', JS_REVIEW_RATING);
    }

    if ($entry_antirobotreg_error == true) {
      $error = true;

      $messageStack->add('review', ERROR_VALIDATION . ERROR_VALIDATION_2);
    }

    if ($error == false) {
      tep_db_query("insert into " . TABLE_REVIEWS . " (products_id, customers_id, customers_name, reviews_rating, date_added) values ('" . (int)$_GET['products_id'] . "', '" . (int)$customer_id . "', '" . tep_db_input($customer['customers_firstname']) . ' ' . tep_db_input($customer['customers_lastname']) . "', '" . tep_db_input($rating) . "', now())");
      $insert_id = tep_db_insert_id();

      tep_db_query("insert into " . TABLE_REVIEWS_DESCRIPTION . " (reviews_id, languages_id, reviews_text) values ('" . (int)$insert_id . "', '" . (int)$languages_id . "', '" . tep_db_input($review) . "')");


#### Points/Rewards Module V2.00 BOF ####*/
    if ((USE_POINTS_SYSTEM == 'true') && (tep_not_null(USE_POINTS_FOR_REVIEWS))) {
      $points_toadd = USE_POINTS_FOR_REVIEWS;
      $comment = 'TEXT_DEFAULT_REVIEWS';
      $points_type = 'RV';
      tep_add_pending_points($customer_id, $product_info['products_id'], $points_toadd, $comment, $points_type);
    }
#### Points/Rewards Module V2.00 EOF ####*/

//*** <Reviews Mod>
//      tep_redirect(tep_href_link(FILENAME_PRODUCT_REVIEWS, tep_get_all_get_params(array('action'))));
      tep_mail(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, ADMIN_EMAIL_SUBJECT, ADMIN_EMAIL_MESSAGE, ADMIN_EMAIL_FROM_NAME, STORE_OWNER_EMAIL_ADDRESS);
      tep_redirect(tep_href_link(FILENAME_REVIEW_NOTICE, tep_get_all_get_params(array('action'))));
//*** </Reviews Mod>
    }
  }

  //TotalB2B start
  $product_info['products_price'] = tep_xppp_getproductprice($product_info['products_id']);
  //TotalB2B end

  if ($new_price = tep_get_products_special_price($product_info['products_id'])) {

    //TotalB2B start
    $query_special_prices_hide = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " WHERE configuration_key = 'SPECIAL_PRICES_HIDE'");
    $query_special_prices_hide_result = tep_db_fetch_array($query_special_prices_hide); 
    if ($query_special_prices_hide_result['configuration_value'] == 'true') {
	  $products_price = '<span class="ColorRed">' . $currencies->display_price_nodiscount($new_price, tep_get_tax_rate($product_info['products_tax_class_id'])) . '</span>';
	} else {
	  $products_price = '<span class="s"> ' . $currencies->display_price($product_info['products_id'], $product_info['products_price'], tep_get_tax_rate($product_info['products_tax_class_id'])) . '</span> <span class="ColorRed">' . $currencies->display_price_nodiscount($new_price, tep_get_tax_rate($product_info['products_tax_class_id'])) . '</span>';
	}
    //TotalB2B end

  } else {
    $products_price = $currencies->display_price($product_info['products_id'], $product_info['products_price'], tep_get_tax_rate($product_info['products_tax_class_id']));
  }

  if (tep_not_null($product_info['products_model'])) {
    $products_name = $product_info['products_name'] . '<br /><span class="smallText">[' . $product_info['products_model'] . ']</span>';
  } else {
    $products_name = $product_info['products_name'];
  }

//*** <Reviews Mod>
//  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_PRODUCT_REVIEWS_WRITE);
//*** </Reviews Mod>

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_PRODUCT_REVIEWS, tep_get_all_get_params()));

  $content = basename($_SERVER['PHP_SELF']);
  while (strstr($content, '.php')) $content = str_replace('.php', '', $content);

  $javascript = $content . '.js';

  include (bts_select('main', $content_template)); // BTSv1.5

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>