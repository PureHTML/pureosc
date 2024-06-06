<?php
/*
  $Id: order_history.php,v 1.5 2003/06/09 22:18:30 hpdl Exp $

  modified by paulm_nl 2003/12/23

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

  if (tep_session_is_registered('customer_id')) {
// retreive the last x products purchased
    $orders_query = tep_db_query("select distinct op.products_id from " . TABLE_ORDERS . " o, " . TABLE_ORDERS_PRODUCTS . " op, " . TABLE_PRODUCTS . " p where o.customers_id = '" . (int)$customer_id . "' and o.orders_id = op.orders_id and op.products_id = p.products_id and p.products_status = '1' group by products_id order by o.date_purchased desc limit " . MAX_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX);
    if (tep_db_num_rows($orders_query)) {
?>
<!-- customer_orders //-->
<?php

      $boxHeading = BOX_HEADING_CUSTOMER_ORDERS;
      $corner_left = 'square';
      $corner_right = 'square';
      $box_base_name = 'order_history'; // for easy unique box template setup (added BTSv1.2)
      $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)
      $product_ids = '';
      while ($orders = tep_db_fetch_array($orders_query)) {
        $product_ids .= (int)$orders['products_id'] . ',';
      }
      $product_ids = substr($product_ids, 0, -1);

      $boxContent = '<div class="AlignLeft">';
      $products_query = tep_db_query("select products_id, products_name from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id in (" . $product_ids . ") and language_id = '" . (int)$languages_id . "' order by products_name");
      while ($products = tep_db_fetch_array($products_query)) {
        $boxContent .= '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products['products_id']) . '">' . $products['products_name'] . '</a>' 
                       //. '<a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=cust_order' . SEPARATOR_LINK . 'pid=' . $products['products_id']) . '">' . tep_image(DIR_WS_ICONS . 'cart.png', ICON_CART) . '</a>'
                       . '<br />' ;
      }

      $boxContent .= '</div>';

include (bts_select('boxes', $box_base_name)); // BTS 1.5

?>
<!-- customer_orders_eof //-->
<?php
    }
  }
?>