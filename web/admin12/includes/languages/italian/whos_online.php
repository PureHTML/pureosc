<?php
/*
  $Id: whos_online.php,v 3.5 2008/6/13 SteveDallas Exp $
  
  2008 Jun 13 v3.5 Glen Hoag aka SteveDallas Moved version number out of language files
                                             Added string TEXT_ACTIVE_CUSTOMERS
                                             Added string TEXT_SHOW_BOTS

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
  
  Italian Translation by Giuseppe Scaletta
*/

// added for version 1.9 - to be translated to the right language BOF ******
define('AZER_WHOSONLINE_WHOIS_URL', 'http://www.dnsstuff.com/tools/whois.ch?ip='); //for version 2.9 by azer - whois ip
define('TEXT_NOT_AVAILABLE', '   <b>Nota:</b> N/A = IP non disponibile'); //for version 2.9 by azer was missing
define('TEXT_LAST_REFRESH', 'Ultimo aggiornamento alle ore'); //for version 2.9 by azer was missing
define('TEXT_EMPTY', 'Vuoto'); //for version 2.8 by azer was missing
define('TEXT_MY_IP_ADDRESS', 'Il mio indirizzo IP '); //for version 2.8 by azer was missing
define('TABLE_HEADING_COUNTRY', 'Paese'); // azerc : 25oct05 for contrib whos_online with country and flag
// added for version 1.9 EOF *************************************************

define('HEADING_TITLE', 'Who\'s Online');
define('TABLE_HEADING_ONLINE', 'Online');
define('TABLE_HEADING_CUSTOMER_ID', 'ID');
define('TABLE_HEADING_FULL_NAME', 'Nome');
define('TABLE_HEADING_IP_ADDRESS', 'Indirizzo IP');
define('TABLE_HEADING_ENTRY_TIME', 'Accesso');
define('TABLE_HEADING_LAST_CLICK', 'Ultimo Click');
define('TABLE_HEADING_LAST_PAGE_URL', 'Ultimo URL');
define('TABLE_HEADING_ACTION', 'Azione');
define('TABLE_HEADING_SHOPPING_CART', 'Carrello');
define('TEXT_SHOPPING_CART_SUBTOTAL', 'Subtotale');
define('TEXT_NUMBER_OF_CUSTOMERS', '%s &nbsp;Visitatori online (Inattivi dopo 5 minuti. Rimossi dopo 15 minuti)');
define('TABLE_HEADING_HTTP_REFERER', 'Riferimento?');
define('TEXT_HTTP_REFERER_URL', 'URL HTTP di Riferimento');
define('TEXT_HTTP_REFERER_FOUND', 'Si');
define('TEXT_HTTP_REFERER_NOT_FOUND', 'No');
define('TEXT_STATUS_ACTIVE_CART', 'Attivo con Carrello');
define('TEXT_STATUS_ACTIVE_NOCART', 'Attivo senza Carrello');
define('TEXT_STATUS_INACTIVE_CART', 'Inattivo con Carrello');
define('TEXT_STATUS_INACTIVE_NOCART', 'Inattivo senza Carrello');
define('TEXT_STATUS_NO_SESSION_BOT', 'Spider Inattivo senza Sessione '); //Azer !!! check if right description
define('TEXT_STATUS_INACTIVE_BOT', 'Spider Inattivo con Sessione '); //Azer !!! check if right description
define('TEXT_STATUS_ACTIVE_BOT', 'Spider Attivo con Sessione '); //Azer !!! check if right description
define('TABLE_HEADING_COUNTRY', 'Paese');
define('TABLE_HEADING_USER_SESSION', 'Sessione');
define('TEXT_IN_SESSION', 'Si');
define('TEXT_NO_SESSION', 'No');

define('TEXT_OSCID', 'osCsid');
define('TEXT_PROFILE_DISPLAY', 'Mostra Profilo');
define('TEXT_USER_AGENT', 'User Agent');
define('TEXT_ERROR', 'Errore!');
define('TEXT_ADMIN', 'Amministratore');
define('TEXT_DUPLICATE_IP', 'IP Duplicati');
define('TEXT_BOTS', 'Spiders');
define('TEXT_ME', 'Me Stesso!');
define('TEXT_ALL', 'Tutti');
define('TEXT_REAL_CUSTOMERS', 'Clienti Reali');
define('TEXT_ACTIVE_CUSTOMERS', 'Attivo');

define('TEXT_YOUR_IP_ADDRESS', 'Il mio Indirizzo IP');
define('TEXT_SET_REFRESH_RATE', 'Frequenza di Aggiornamento');
define('TEXT_NONE_', 'Nessuno');
define('TEXT_CUSTOMERS', 'Clienti');
define('TEXT_SHOW_BOTS', 'Visualizza Spiders');
?>