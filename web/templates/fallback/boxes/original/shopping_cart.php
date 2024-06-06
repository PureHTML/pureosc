xxx<?php
/*
  $Id: shopping_cart.php,v 1.18 2003/02/10 22:31:06 hpdl Exp $

  modified by paulm_nl 2003/12/23

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- shopping_cart //-->
<?php

  $boxHeading = BOX_HEADING_SHOPPING_CART;
  $corner_left = 'square';
  $corner_right = 'rounded';
  $boxLink = '<a class="BoxesInfoBoxHeadingCenterBoxRight" title="Box_cart_grafic_Details" href="' . tep_href_link(FILENAME_SHOPPING_CART) . '">&nbsp;&raquo;&nbsp;</a>';
  $box_base_name = 'shopping_cart'; // for easy unique box template setup (added BTSv1.2)
  $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)
      $boxContent = '<div class="AlignLeft">';
  if ($cart->count_contents() > 0) {
    $products = $cart->get_products();
    for ($i=0, $n=sizeof($products); $i<$n; $i++) {

      if ((tep_session_is_registered('new_products_id_in_cart')) && ($new_products_id_in_cart == $products[$i]['id'])) {
        $boxContent .= '<span class="ColorRed">';
      } else {
        $boxContent .= '<span>';
      }

      $boxContent .= $products[$i]['quantity'] . '&nbsp;x&nbsp;</span>
      <a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products[$i]['id']) . '">';

      if ((tep_session_is_registered('new_products_id_in_cart')) && ($new_products_id_in_cart == $products[$i]['id'])) {
        $boxContent .= '<span class="ColorRed">';
      } else {
        $boxContent .= '<span>';
      }

      $boxContent .= $products[$i]['name'] . '</span></a><br />';

      if ((tep_session_is_registered('new_products_id_in_cart')) && ($new_products_id_in_cart == $products[$i]['id'])) {
        tep_session_unregister('new_products_id_in_cart');
      }
    }
  } else {
    $boxContent .= BOX_SHOPPING_CART_EMPTY;
  }

  //TotalB2B start
  global $customer_id;
  $query_price_to_guest = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " WHERE configuration_key = 'ALLOW_GUEST_TO_SEE_PRICES'");
  $query_price_to_guest_result = tep_db_fetch_array($query_price_to_guest);
  if ((($query_price_to_guest_result['configuration_value']=='true') && !(tep_session_is_registered('customer_id'))) || ((tep_session_is_registered('customer_id')))) {
      $box_text = $currencies->format($cart->show_total());
  } else {
      $box_text = PRICES_LOGGED_IN_TEXT;
  }
  if ($cart->count_contents() > 0) {
    $boxContent .= tep_draw_separator();
    $boxContent .= $box_text;
  }
  //TotalB2B end
// ############ Added CCGV Contribution ##########
  if (tep_session_is_registered('customer_id')) {
    $gv_query = tep_db_query("select amount from " . TABLE_COUPON_GV_CUSTOMER . " where customer_id = '" . $customer_id . "'");
    $gv_result = tep_db_fetch_array($gv_query);
    if ($gv_result['amount'] > 0 ) {
      $boxContent .= tep_draw_separator();
      $boxContent .= VOUCHER_BALANCE . $currencies->format($gv_result['amount']);
      $boxContent .= '<br /><a href="'. tep_href_link(FILENAME_GV_SEND) . '">' . BOX_SEND_TO_FRIEND . '</a>';
    }
  }
  if (tep_session_is_registered('gv_id')) {
    $gv_query = tep_db_query("select coupon_amount from " . TABLE_COUPONS . " where coupon_id = '" . $gv_id . "'");
    $coupon = tep_db_fetch_array($gv_query);
    $boxContent .= tep_draw_separator();
    $boxContent .= VOUCHER_REDEEMED . $currencies->format($coupon['coupon_amount']);

  }

if (tep_session_is_registered('cc_id') && $cc_id) {
 $coupon_query = tep_db_query("select * from " . TABLE_COUPONS . " where coupon_id = '" . $cc_id . "'");
 $coupon = tep_db_fetch_array($coupon_query);
 $coupon_desc_query = tep_db_query("select * from " . TABLE_COUPONS_DESCRIPTION . " where coupon_id = '" . $cc_id . "' and language_id = '" . $languages_id . "'");
 $coupon_desc = tep_db_fetch_array($coupon_desc_query);
 $text_coupon_help = sprintf("%s",$coupon_desc['coupon_name']);
   $boxContent .= tep_draw_separator();
   $boxContent .= '<div class="infoBoxContents">' . CART_COUPON . $text_coupon_help . '<br />' . '</div>';
   }  

// ############ End Added CCGV Contribution ##########

#### Points/Rewards Module V2.00 BOF ####
  if (USE_REDEEM_SYSTEM == 'true') {
    $shopping_points = tep_get_shopping_points($customer_id);
    if ($shopping_points > 0) {
      $boxContent .= tep_draw_separator();
      $boxContent .= '<span class="b"><a href="' . tep_href_link(FILENAME_MY_POINTS, '', 'SSL') . '">'. TEXT_POINTS_BALANCE . '</a></span><br />' . TEXT_POINTS .'&nbsp;'. number_format($shopping_points,POINTS_DECIMAL_PLACES) . '<br />' .  TEXT_VALUE . $currencies->format(tep_calc_shopping_pvalue($shopping_points));
    }
  }
#### Points/Rewards Module V2.00 EOF ####

      $boxContent .= '</div>';

include (bts_select('boxes', $box_base_name)); // BTS 1.5
  $boxLink = '';
?>
<!-- shopping_cart_eof //-->