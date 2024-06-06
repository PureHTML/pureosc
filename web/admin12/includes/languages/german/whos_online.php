<?php
/*
  $Id: whos_online.php ,v 1.5 2002/03/30 15:48:55 harley_vb Exp $
  $Id: german translation ,v 1.5 2002/03/30 15:48:55 Ernst Steininger Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

// added for version 1.9 - ranslated to german BOF ******
define('AZER_WHOSONLINE_WHOIS_URL', 'http://www.dnsstuff.com/tools/whois.ch?ip='); //for version 2.9 by azer - whois ip
define('TEXT_NOT_AVAILABLE', '   <b>Anmerkung:</b> N/A = IP nicht gefunden'); //for version 2.9 by azer was missing
define('TEXT_LAST_REFRESH', 'Letzte Aktualisierung '); //for version 2.9 by azer was missing
define('TEXT_EMPTY', 'Leer'); //for version 2.8 by azer was missing
define('TEXT_MY_IP_ADDRESS', 'Meine IP Adresse'); //for version 2.8 by azer was missing
define('TABLE_HEADING_COUNTRY', 'Land'); // azerc : 25oct05 for contrib whos_online with country and flag
// added for version 1.9 EOF *************************************************

define('HEADING_TITLE', 'Wer ist Online');
define('TABLE_HEADING_ONLINE', 'Online');
define('TABLE_HEADING_CUSTOMER_ID', 'ID');
define('TABLE_HEADING_FULL_NAME', 'Name');
define('TABLE_HEADING_IP_ADDRESS', 'IP Addresse');
define('TABLE_HEADING_ENTRY_TIME', 'Startzeit');
define('TABLE_HEADING_LAST_CLICK', 'Letzter Klick');
define('TABLE_HEADING_LAST_PAGE_URL', 'Letzte URL');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TABLE_HEADING_SHOPPING_CART', 'Warenkorb');
define('TEXT_SHOPPING_CART_SUBTOTAL', 'Zwischensumme');
define('TEXT_NUMBER_OF_CUSTOMERS', '%s Benutzer online (Gilt als inaktiv nach 5 Minuten, wird entfernt nach 15 Minuten');
define('TABLE_HEADING_HTTP_REFERER', 'Link von');
define('TEXT_HTTP_REFERER_URL', 'Link von: URL');
define('TEXT_HTTP_REFERER_FOUND', 'Ja');
define('TEXT_HTTP_REFERER_NOT_FOUND', 'Nein');
define('TEXT_STATUS_ACTIVE_CART', 'Aktiv mit Warenkorb');
define('TEXT_STATUS_ACTIVE_NOCART', 'Aktiv ohne Warenkorb');
define('TEXT_STATUS_INACTIVE_CART', 'Inaktiv mit Warenkorb');
define('TEXT_STATUS_INACTIVE_NOCART', 'Inaktiv ohne Warenkorb');
define('TEXT_STATUS_NO_SESSION_BOT', 'Kein Session Bot');
define('TEXT_STATUS_INACTIVE_BOT', 'Inaktiver Session Bot');
define('TEXT_STATUS_ACTIVE_BOT', 'Aktiver Session Bot');
define('TABLE_HEADING_COUNTRY', 'Land');
define('TABLE_HEADING_USER_SESSION', 'Sitzung');
define('TEXT_IN_SESSION', 'Ja');
define('TEXT_NO_SESSION', 'Nein');

define('TEXT_OSCID', 'osCs-Id');
define('TEXT_PROFILE_DISPLAY', 'Profil Anzeige');
define('TEXT_USER_AGENT', 'Browser');
define('TEXT_ERROR', 'Fehler!');
define('TEXT_ADMIN', 'Admin');
define('TEXT_DUPLICATE_IP', 'Doppelte IPs');
define('TEXT_BOTS', 'Bots');
define('TEXT_ME', 'Selbst!');
define('TEXT_ALL', 'Alle');
define('TEXT_REAL_CUSTOMERS', 'Echte Kunden');
define('TEXT_ACTIVE_CUSTOMERS', ' are active.');

define('TEXT_YOUR_IP_ADDRESS', 'Ihre IP Addresse');
define('TEXT_SET_REFRESH_RATE', 'Aktualisierungsrate setzen');
define('TEXT_NONE_', 'Keine');
define('TEXT_CUSTOMERS', 'Kunden');
define('TEXT_SHOW_BOTS', 'Show Bots');
?>