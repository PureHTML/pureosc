<?php
/*
  $Id: product_notifications.php,v 1.8 2003/06/09 22:19:07 hpdl Exp $

  modified by paulm_nl 2003/12/23

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/
    if (tep_session_is_registered('customer_id')) {
  if (isset($_GET['products_id'])) {
?>
<!-- notifications //-->
<?php
    $boxHeading = BOX_HEADING_NOTIFICATIONS;
    $corner_left = 'square';
    $corner_right = 'square';
    $boxLink = '<a class="BoxesInfoBoxHeadingCenterBoxRight" title="Box_notif_grafic_Details" href="' . tep_href_link(FILENAME_ACCOUNT_NOTIFICATIONS, '', 'SSL') . '">&nbsp;&raquo;&nbsp;</a>';
    $box_base_name = 'product_notifications'; // for easy unique box template setup (added BTSv1.2)
    $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)

    if (tep_session_is_registered('customer_id')) {
      $check_query = tep_db_query("select count(*) as count from " . TABLE_PRODUCTS_NOTIFICATIONS . " where products_id = '" . (int)$_GET['products_id'] . "' and customers_id = '" . (int)$customer_id . "'");
      $check = tep_db_fetch_array($check_query);

      $notification_exists = (($check['count'] > 0) ? true : false);
    } else {
      $notification_exists = false;
    }

    if ($notification_exists == true) {
      $boxContent = '<a accesskey="Z" href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=notify_remove', $request_type) . '">' . '&nbsp;[Z]&nbsp;' . tep_image(bts_select(images, 'box_products_notifications_remove.png'), IMAGE_BUTTON_REMOVE_NOTIFICATIONS) . '</a><br /><a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=notify_remove', $request_type) . '">' . sprintf(BOX_NOTIFICATIONS_NOTIFY_REMOVE, tep_get_products_name($_GET['products_id'])) .'</a>';
    } else {
      $boxContent = '<a accesskey="Z" href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=notify', $request_type) . '">' . '&nbsp;[Z]&nbsp;' . tep_image( bts_select(images, 'box_products_notifications.png'), IMAGE_BUTTON_NOTIFICATIONS) . '</a><br /><a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=notify', $request_type) . '">' . sprintf(BOX_NOTIFICATIONS_NOTIFY, tep_get_products_name($_GET['products_id'])) .'</a>';
    }

include (bts_select('boxes', $box_base_name)); // BTS 1.5
    $boxLink = '';
?>
<!-- notifications_eof //-->
<?php
  }
    }
?>