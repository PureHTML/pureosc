<?php
/*
  $Id: checkout_success.php,v 1.12 2003/04/15 17:47:42 dgw_ Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce 

  Released under the GNU General Public License 
*/

define('NAVBAR_TITLE_1', 'Acquista');
define('NAVBAR_TITLE_2', 'Successo');

define('HEADING_TITLE', 'Il tuo ordine &egrave; stato inoltrato!');

define('TEXT_SUCCESS', 'Il tuo ordine &egrave; stato inoltrato con successo! I prodotti arriveranno a destinazione entro 2-5 giorni lavorativi.');
define('TEXT_NOTIFY_PRODUCTS', 'Comunicami gli aggiornamenti dei prodotti che io ho selezionato sotto:');
define('TEXT_SEE_ORDERS', 'Puoi vedere la cronologia dei tuoi ordini dalla pagina <a href="' . tep_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">\'Il mio account\'</a> e cliccando sopra <a href="' . tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL') . '">\'Cronologia\'</a>.');
define('TEXT_CONTACT_STORE_OWNER', 'Comunica qualsiasi problema all\' <a href="' . tep_href_link(FILENAME_CONTACT_US) . '">amministratore</a>.');
define('TEXT_THANKS_FOR_SHOPPING', 'Grazie per aver acquistato on-line con noi!');

define('TABLE_HEADING_COMMENTS', 'Inserisci un commento per il procedimento di acquisto');

define('TABLE_HEADING_DOWNLOAD_DATE', 'Data di scadenza: ');
define('TABLE_HEADING_DOWNLOAD_COUNT', ' Downloads rimanenti.');
define('HEADING_DOWNLOAD', 'Scarica qui il tuo prodotto:');
define('FOOTER_DOWNLOAD', 'Tu puoi scaricare il tuo prodotto dopo le ore \'%s\'');
?>