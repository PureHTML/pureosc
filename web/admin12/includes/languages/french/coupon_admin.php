<?php
/*
  $Id: coupon_admin.php,v 1.1.2.5 2003/05/13 23:28:30 wilt Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com
  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/
define('TEXT_COUPON_REDEEMED', 'Redeemed Coupons');
define('REDEEM_DATE_LAST', 'Date Last Redeemed');
define('TOP_BAR_TITLE', 'Statistique');
define('HEADING_TITLE', 'Coupons de r&eacute;duction');
define('HEADING_TITLE_STATUS', 'Statut : ');
define('TEXT_CUSTOMER', 'Client :');
define('TEXT_COUPON', 'Nom du coupon :');
define('TEXT_COUPON_ALL', 'Tous les coupons');
define('TEXT_COUPON_ACTIVE', 'Coupons actifs');
define('TEXT_COUPON_INACTIVE', 'Coupons inactifs');
define('TEXT_SUBJECT', 'Sujet :');
define('TEXT_FROM', 'De :');
define('TEXT_FREE_SHIPPING', 'Exp&eacute;dition gratuite');
define('TEXT_MESSAGE', 'Message :');
define('TEXT_SELECT_CUSTOMER', 'Selection du client');
define('TEXT_ALL_CUSTOMERS', 'Tous les clients');
define('TEXT_NEWSLETTER_CUSTOMERS', 'A tous les abonnés &agrave; la newsletter');
define('TEXT_CONFIRM_DELETE', '&Ecirc;tes-vous s&ucirc;rs que vous voulez supprimer ce coupon ?');

define('TEXT_TO_REDEEM', 'Vous pouvez utiliser le coupon pendant la procédure de payement. Entrez simplement le code dans la case appropriée, et cliquez sur le bouton utiliser.');
define('TEXT_IN_CASE', ' en cas de probleme ');
define('TEXT_VOUCHER_IS', 'Le code du coupon est ');
define('TEXT_REMEMBER', 'Ne perdez pas le code du coupon, assurez vous de le garder pour pouvoir profiter de cette offre spéciale.');
define('TEXT_VISIT', 'Bonne visite : ' . HTTP_SERVER . DIR_WS_CATALOG);
define('TEXT_ENTER_CODE', ' et entrez le code ');

define('TABLE_HEADING_ACTION', 'Action');

define('CUSTOMER_ID', 'Identifiant client');
define('CUSTOMER_NAME', 'Nom du client');
define('REDEEM_DATE', 'Date d\'utilisation');
define('IP_ADDRESS', 'Adresse IP');

define('TEXT_REDEMPTIONS', 'Rapport d\'utilisation');
define('TEXT_REDEMPTIONS_TOTAL', 'Total d\'utilisation');
define('TEXT_REDEMPTIONS_CUSTOMER', 'Pour ce client');
define('TEXT_NO_FREE_SHIPPING', 'Aucune livraison gratuite');

define('NOTICE_EMAIL_SENT_TO', 'Note : Email envoy&eacute; a %s');
define('ERROR_NO_CUSTOMER_SELECTED', 'Erreur : aucun client n\'a &eacute;t&eacute; s&eacute;lectionn&eacute;.');
define('COUPON_NAME', 'Nom du coupon');
//define('COUPON_VALUE', 'Valeur du coupon');
define('COUPON_AMOUNT', 'Valeur du coupon');
define('COUPON_CODE', 'Code du coupon');
define('COUPON_STARTDATE', 'Date d\'effet');
define('COUPON_FINISHDATE', 'Date de fin d\'effet');
define('COUPON_FREE_SHIP', 'Livraison gratuite');
define('COUPON_DESC', 'Description du coupon');
define('COUPON_MIN_ORDER', 'Commande minimum pour le coupon');
define('COUPON_USES_COUPON', 'Utilisations par coupon');
define('COUPON_USES_USER', 'Utilisations par client');
define('COUPON_PRODUCTS', 'Liste des produits valable');
define('COUPON_CATEGORIES', 'Liste des cat&eacute;gories valable');
define('VOUCHER_NUMBER_USED', 'Nombre d\'utilisation');
define('DATE_CREATED', 'Date de cr&eacute;ation');
define('DATE_MODIFIED', 'Date de modification');
define('TEXT_HEADING_NEW_COUPON', 'Cr&eacute;er un nouveau coupon');
define('TEXT_NEW_INTRO', 'Remplissez les diff&eacute;rentes informations du coupon.<br />');


define('COUPON_NAME_HELP', 'Mettre un nom court pour le coupon');
define('COUPON_AMOUNT_HELP', 'Mettre une valeur pour une remise fixe ou bien ajouter % sur la fin pour une remise en pourcentage.');
define('COUPON_CODE_HELP', 'Vous pouvez personnaliser votre propre code. Laisser vide le formulaire pour obtenir un code automatiquement.');
define('COUPON_STARTDATE_HELP', 'D&eacute;but de la date d\'effet du coupon.');
define('COUPON_FINISHDATE_HELP', 'Fin de la date d\'effet du coupon.');
define('COUPON_FREE_SHIP_HELP', 'Offrir la livraison avec l\'utilisation de ce coupon');
define('COUPON_DESC_HELP', 'Description du coupon pour le client');
define('COUPON_MIN_ORDER_HELP', 'Montant minimum d\'une commande &agrave; partir duquel le coupon devient valide');
define('COUPON_USES_COUPON_HELP', 'Le maximum de fois que le coupon peut etre utilis&eacute;. Laisser vide le formulaire si vous ne voulez aucune limite.');
define('COUPON_USES_USER_HELP', 'Le maximum de fois qu\'un client peut utiliser ce coupon. Laisser vide le formulaire si vous ne voulez aucune limite.');
define('COUPON_PRODUCTS_HELP', 'Liste des identifiants des produits (s&eacute;par&eacute; par une virgule) qui peuvent &ecirc;tre associ&eacute;s au coupon. Laisser vide le formulaire si on ne veut pas de limite.');
define('COUPON_CATEGORIES_HELP', 'Liste des cat&eacute;gories qui peuvent etre associ&eacute;s au coupon. Laisser vide si on ne veut pas de limite.');
define('ERROR_NO_COUPON_AMOUNT', 'Erreur : Vous n\'avez pas remplis le minimum pour valider coupon');
define('ERROR_COUPON_EXISTS', 'Error: A coupon with the same coupon code already exists.');
define('COUPON_BUTTON_EMAIL_VOUCHER', 'Email Voucher');
define('COUPON_BUTTON_EDIT_VOUCHER', 'Edit Voucher');
define('COUPON_BUTTON_DELETE_VOUCHER', 'Delete Voucher');
define('COUPON_BUTTON_VOUCHER_REPORT', 'Voucher Report');
define('COUPON_STATUS', 'Status');
define('COUPON_STATUS_HELP', 'Set to ' . IMAGE_ICON_STATUS_RED . ' to disable customers\' ability to use the coupon.');
?>