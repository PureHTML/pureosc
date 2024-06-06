<?php
/*
  $Id: whos_online.php,v 3.5 2008/6/13 SteveDallas Exp $
  
  2008 Jun 13 v3.5 Glen Hoag aka SteveDallas Moved version number out of language files
                                             Added string TEXT_ACTIVE_CUSTOMERS
                                             Added string TEXT_SHOW_BOTS

  updated version number because of version number jumble and provide installation instructions.
  corection french by azer
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

// added for version 1.9 - to be translated to the right language BOF ******
define('AZER_WHOSONLINE_WHOIS_URL', 'http://www.dnsstuff.com/tools/whois.ch?ip='); //for version 2.9 by azer - whois ip
define('TEXT_NOT_AVAILABLE', '   <b>Note:</b> N/A = Adresse IP Non Disponible'); //for version 2.9 by azer was missing
define('TEXT_LAST_REFRESH', 'Derni&egrave;re Mise &agrave; Jour'); //for version 2.9 by azer was missing
define('TEXT_EMPTY', 'Vide'); //for version 2.8 by azer was missing
define('TEXT_MY_IP_ADDRESS', 'Mon Adresse IP '); //for version 2.8 by azer was missing
define('TABLE_HEADING_COUNTRY', 'Pays'); // azerc : 25oct05 for contrib whos_online with country and flag
// added for version 1.9 EOF *************************************************

define('HEADING_TITLE', 'Qui est en Ligne ?');  // Version update to 3.2 because of multiple 1.x and 2.x jumble.  apr-07 by nerbonne
define('TABLE_HEADING_ONLINE', 'En Ligne');
define('TABLE_HEADING_CUSTOMER_ID', 'ID');
define('TABLE_HEADING_FULL_NAME', 'Nom');
define('TABLE_HEADING_IP_ADDRESS', 'Adresse IP');
define('TABLE_HEADING_ENTRY_TIME', 'Arriv&eacute; ');
define('TABLE_HEADING_LAST_CLICK', 'Dernier Clic');
define('TABLE_HEADING_LAST_PAGE_URL', 'Derni&egrave;re URL');
define('TABLE_HEADING_ACTION', 'Action');
define('TABLE_HEADING_SHOPPING_CART', 'Panier');
define('TEXT_SHOPPING_CART_SUBTOTAL', 'Sous Total');
define('TEXT_NUMBER_OF_CUSTOMERS', '%s &nbsp;Visiteur(s) en ligne (Consid&eacute;r&eacute; inactif apres 5 minutes. Retir&eacute; apres 15 minutes)');
define('TABLE_HEADING_HTTP_REFERER', 'Referer ?');
define('TEXT_HTTP_REFERER_URL', 'HTTP Referer URL');
define('TEXT_HTTP_REFERER_FOUND', 'Oui');
define('TEXT_HTTP_REFERER_NOT_FOUND', 'Non Trouv&eacute;');
define('TEXT_STATUS_ACTIVE_CART', 'Actif avec un Panier');
define('TEXT_STATUS_ACTIVE_NOCART', 'Actif sans Panier');
define('TEXT_STATUS_INACTIVE_CART', 'Inactif avec Panier');
define('TEXT_STATUS_INACTIVE_NOCART', 'Inactif sans Panier');
define('TEXT_STATUS_NO_SESSION_BOT', 'Robot Inactif Bot sans session ?'); //Azer !!! check if right description
define('TEXT_STATUS_INACTIVE_BOT', 'Robot Inactif en session '); //Azer !!! check if right description
define('TEXT_STATUS_ACTIVE_BOT', 'Robot Actif avec session '); //Azer !!! check if right description
define('TABLE_HEADING_COUNTRY', 'Pays');
define('TABLE_HEADING_USER_SESSION', 'Session ?');
define('TEXT_IN_SESSION', 'Oui');
define('TEXT_NO_SESSION', 'Non');

define('TEXT_OSCID', 'osCsid');
define('TEXT_PROFILE_DISPLAY', 'Affichage du Profil');
define('TEXT_USER_AGENT', 'User Agent');
define('TEXT_ERROR', 'Erreur!');
define('TEXT_ADMIN', 'Admin');
define('TEXT_DUPLICATE_IP', 'Adresse(s) IP(s) Dupliqu&eacute;es');
define('TEXT_BOTS', 'Robots');
define('TEXT_ME', 'Moi !');
define('TEXT_ALL', 'Tous');
define('TEXT_REAL_CUSTOMERS', 'Client(s) R&eacute;els');
define('TEXT_ACTIVE_CUSTOMERS', ' Actif.');

define('TEXT_YOUR_IP_ADDRESS', 'Votre Adresse IP');
define('TEXT_SET_REFRESH_RATE', 'D&eacute;lai de Raffraichissement');
define('TEXT_NONE_', 'Aucun');
define('TEXT_CUSTOMERS', 'Client(s)');
define('TEXT_SHOW_BOTS', 'Montrez Robots');
?>