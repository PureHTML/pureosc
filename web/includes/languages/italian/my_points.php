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
define('NAVBAR_TITLE', 'Informazioni sui punti');

define('HEADING_TITLE', 'Informazioni sui miei punti');

define('HEADING_ORDER_DATE', 'Data di coda');
define('HEADING_ORDERS_NUMBER', 'Numero e stato ordine');
define('HEADING_ORDERS_STATUS', 'Stato ordine');
define('HEADING_POINTS_COMMENT', 'Commenti');
define('HEADING_POINTS_STATUS', 'Stato punti');
define('HEADING_POINTS_TOTAL', 'Punti');

define('TEXT_DEFAULT_COMMENT', 'Punti shopping');
define('TEXT_DEFAULT_REDEEMED', 'Punti riscossi');

define('TEXT_DEFAULT_REFERRAL', 'Referral Points');
define('TEXT_DEFAULT_REVIEWS', 'Punti per Recensioni');

define('TEXT_ORDER_HISTORY', 'Vedi dettagli per l&#39;ordine nr. ');
define('TEXT_REVIEW_HISTORY', 'Vedi questa Recensione.');

define('TEXT_ORDER_ADMINISTATION', '---');
define('TEXT_STATUS_ADMINISTATION', '-----------');

define('TEXT_POINTS_PENDING', 'Pendenti');
define('TEXT_POINTS_PROCESSING', 'In elaborazione');
define('TEXT_POINTS_CONFIRMED', 'Confermati');
define('TEXT_POINTS_CANCELLED', 'Cancellati');
define('TEXT_POINTS_REDEEMED', 'Riscossi');

define('MY_POINTS_EXPIRE', 'Expire at: ');
define('MY_POINTS_CURRENT_BALANCE', '<span class="b">Bilancio Punti :</span> %s punti. <span class="b">Valutati :</span> %s .');

define('MY_POINTS_HELP_LINK', ' Guarda il <a href="' . tep_href_link(FILENAME_MY_POINTS_HELP) . '" title="Reward Point Program FAQ">Reward</a> Point Program FAQ per pi&ugrave; informazioni.');

define('TEXT_NO_PURCHASES', 'Non hai ancora effettuato alcun acquisto e non possiedi punti');
define('TEXT_NO_POINTS', 'Non possiedi ancora punti qualificati');

define('TEXT_DISPLAY_NUMBER_OF_RECORDS', 'Displaying <span class="b">%d</span> to <span class="b">%d</span> (of <span class="b">%d</span> points records)');
?>
