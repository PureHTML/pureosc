<?php
/*
  $Id: my_points.php, v 2.00 2006/JULY/06 17:41:03 dsa_ Exp $
  created by Ben Zukrel, Deep Silver Accessories
  http://www.deep-silver.com

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/
define('NAVBAR_TITLE', 'Points Information');

define('HEADING_TITLE', 'My Points Information');

define('HEADING_ORDER_DATE', 'Date');
define('HEADING_ORDERS_NUMBER', 'Order No. & Status');
define('HEADING_ORDERS_STATUS', 'Order Status');
define('HEADING_POINTS_COMMENT', 'Comments');
define('HEADING_POINTS_STATUS', 'Points Status');
define('HEADING_POINTS_TOTAL', 'Points');

define('TEXT_DEFAULT_COMMENT', 'Shopping Points');
define('TEXT_DEFAULT_REDEEMED', 'Redeemed Points');

define('TEXT_DEFAULT_REFERRAL', 'Referral Points');
define('TEXT_DEFAULT_REVIEWS', 'Review Points');

define('TEXT_ORDER_HISTORY', 'View details for order no.');
define('TEXT_REVIEW_HISTORY', 'Show this Review.');

define('TEXT_ORDER_ADMINISTATION', '---');
define('TEXT_STATUS_ADMINISTATION', '-----------');

define('TEXT_POINTS_PENDING', 'Pending');
define('TEXT_POINTS_PROCESSING', 'Processing');
define('TEXT_POINTS_CONFIRMED', 'Confirmed');
define('TEXT_POINTS_CANCELLED', 'Cancelled');
define('TEXT_POINTS_REDEEMED', 'Redeemed');

define('MY_POINTS_EXPIRE', 'Expire at: ');
define('MY_POINTS_CURRENT_BALANCE', '<span class="b">Points Balance :</span> %s points. <span class="b">Valued at :</span> %s .');

define('MY_POINTS_HELP_LINK', ' Please check the <a href="' . tep_href_link(FILENAME_MY_POINTS_HELP) . '" title="Reward Point Program FAQ">Reward</a> Point Program FAQ for more information.');

define('TEXT_NO_PURCHASES', 'You have not yet made any purchases, and you don\'t have points yet');
define('TEXT_NO_POINTS', 'You don\'t have Qualified Points yet.');

define('TEXT_DISPLAY_NUMBER_OF_RECORDS', 'Displaying <span class="b">%d</span> to <span class="b">%d</span> (of <span class="b">%d</span> points records)');
?>
