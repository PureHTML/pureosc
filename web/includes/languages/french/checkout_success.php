<?php
/*
  $Id: checkout_success.php,v 1.1.1.1 2005/05/03 15:21:54 manmachine Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE_1', 'Commande');
define('NAVBAR_TITLE_2', 'Succ&egrave;s');

define('HEADING_TITLE', 'Votre commande vient d\'&ecirc;tre prise en compte !');

define('TEXT_SUCCESS', 'Votre commande vient d\'&ecirc;tre prise en compte avec succ&egrave;s ! Vos produits arriveront à destination dans 2-5 jours ouvr&eacute;s');
define('TEXT_NOTIFY_PRODUCTS', 'Veuillez m\'informer des mises &agrave; jour des produits que j\'ai choisis ci-dessous :');
define('TEXT_SEE_ORDERS', 'Vous pouvez voir l\'historique de votre commande en allant &agrave; la page <a href="' . tep_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">\'Mon compte\'</a> et en cliquant sur <a href="' . tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL') . '">\'Historique\'</a>.');
define('TEXT_CONTACT_STORE_OWNER', 'Veuillez poser toutes les questions directement au <a href="' . tep_href_link(FILENAME_CONTACT_US) . '">propri&eacute;taire du magasin</a>.');
define('TEXT_THANKS_FOR_SHOPPING', 'Merci d\'avoir fait vos achats en ligne avec nous !');

define('TABLE_HEADING_COMMENTS', 'Ecrivez un commentaire pour la commande pass&eacute;e;');

define('TABLE_HEADING_DOWNLOAD_DATE', 'date d\'expiration : ');
define('TABLE_HEADING_DOWNLOAD_COUNT', ' t&eacute;l&eacute;chargements restant');
define('HEADING_DOWNLOAD', 'T&eacute;l&eacute;chargez vos produits ici :');
define('FOOTER_DOWNLOAD', 'Vous pouvez aussi t&eacute;l&eacute;charger vos produits plus tard &agrave; \'%s\'');
?>