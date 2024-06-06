<?php
/*
  $Id: gv_queue.php,v 1.2.2.1 2003/04/27 12:36:00 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 - 2003 osCommerce

  Gift Voucher System v1.0
  Copyright (c) 2001,2002 Ian C Wilson
  http://www.phesis.org

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Ch&egrave;ques cadeaux en attente');

define('TABLE_HEADING_CUSTOMERS', 'Clients');
define('TABLE_HEADING_ORDERS_ID', 'Num&eacute;ro de la commande');
define('TABLE_HEADING_VOUCHER_VALUE', 'Valeur du ch&egrave;que');
define('TABLE_HEADING_DATE_PURCHASED', 'Date de l\'achat');
define('TABLE_HEADING_ACTION', 'Action');

define('TEXT_REDEEM_COUPON_MESSAGE_HEADER', 'Vous avez r�cemment achet� un ch�que cadeau dans notre magasin.' . "\n"
                                          . 'Pour des raisons de s�curit� il n\'�tait pas imm�diatement disponible sur votre compte.' . "\n"
                                          . 'Cependant le montant a maintenant �t� enregistr�.' . "\n"
                                          . 'Vous pouvez maintenant visiter notre magasin et vous retrouverez ce ch�que sur votre compte dans le panier.' . "\n\n");

define('TEXT_REDEEM_COUPON_MESSAGE_AMOUNT', 'Le montant du ch�que cadeau que vous avez achet� est de %s' . "\n\n");

define('TEXT_REDEEM_COUPON_MESSAGE_BODY', '');
define('TEXT_REDEEM_COUPON_MESSAGE_FOOTER', '');
define('TEXT_REDEEM_COUPON_SUBJECT', 'Validation ch�que cadeau');
?>