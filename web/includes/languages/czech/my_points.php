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
define('NAVBAR_TITLE', 'Informace o bonusových bodech');

define('HEADING_TITLE', 'Mé body');

define('HEADING_ORDER_DATE', 'Datum');
define('HEADING_ORDERS_NUMBER', 'Objednávka číslo');
define('HEADING_ORDERS_STATUS', 'Průběh objednávky');
define('HEADING_POINTS_COMMENT', 'Komentáře');
define('HEADING_POINTS_STATUS', 'počet bodů');
define('HEADING_POINTS_TOTAL', 'Bodů');

define('TEXT_DEFAULT_COMMENT', 'Nákupní body');
define('TEXT_DEFAULT_REDEEMED', 'Připočítané body');

define('TEXT_DEFAULT_REFERRAL', 'Referral body');
define('TEXT_DEFAULT_REVIEWS', 'body za komentáře');

define('TEXT_ORDER_HISTORY', 'Zobrezit deatily pro objednávku čílo:');
define('TEXT_REVIEW_HISTORY', 'Ukázat hodnocení.');

define('TEXT_ORDER_ADMINISTATION', '---');
define('TEXT_STATUS_ADMINISTATION', '-----------');

define('TEXT_POINTS_PENDING', 'Očekáváno');
define('TEXT_POINTS_PROCESSING', 'Vytvořeno');
define('TEXT_POINTS_CONFIRMED', 'Potvrzeno');
define('TEXT_POINTS_CANCELLED', 'Zrušeno');
define('TEXT_POINTS_REDEEMED', 'Připočítáno');

define('MY_POINTS_EXPIRE', 'Platnost skončí k datu: ');
define('MY_POINTS_CURRENT_BALANCE', '<span class="b">Celkem:</span> %s bodů. <span class="b">V hodnotě:</span> %s .');

define('MY_POINTS_HELP_LINK', ' Podívejte se na: <a href="' . tep_href_link(FILENAME_MY_POINTS_HELP) . '" title="Bonusové body - často kladené dotazy">Bonusové body - často kladené dotazy.');

define('TEXT_NO_PURCHASES', 'Buď nemáte nic objednáno nebo nemáte žádné body.');
define('TEXT_NO_POINTS', 'Nemáte dost bodů.');

define('TEXT_DISPLAY_NUMBER_OF_RECORDS', 'Zobrazení <span class="b">%d</span> to <span class="b">%d</span> (of <span class="b">%d</span> počet bodů)');
?>
