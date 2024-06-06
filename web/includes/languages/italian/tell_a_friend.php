<?php
/*
  $Id: tell_a_friend.php,v 1.7 2003/06/10 18:20:39 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce 

  Released under the GNU General Public License 
*/

define('NAVBAR_TITLE', 'Dillo ad un amico');

define('HEADING_TITLE', 'Dillo ad un amico riguardo \'%s\'');

define('FORM_TITLE_CUSTOMER_DETAILS', 'I tuoi Dettagli');
define('FORM_TITLE_FRIEND_DETAILS', 'I dettagli dei tuoi amici');
define('FORM_TITLE_FRIEND_MESSAGE', 'Messaggio');

define('FORM_FIELD_CUSTOMER_NAME', 'Nome:');
define('FORM_FIELD_CUSTOMER_EMAIL', ' Indirizzo Email:');
define('FORM_FIELD_FRIEND_NAME', 'Nome del tuo amico:');
define('FORM_FIELD_FRIEND_EMAIL', 'Email del tuo amico :');

define('TEXT_EMAIL_SUCCESSFUL_SENT', 'La tua email riguardo <span class="b">%s</span> &egrave; stata spedita con successo a <span class="b">%s</span>.');

define('TEXT_EMAIL_SUBJECT', 'Il tuo amico %s ti ha raccomandato questo prodotto da %s');
define('TEXT_EMAIL_INTRO', 'Ciao %s!' . "\n\n" . 'Il tuo amico, %s, ha pensato che potresti essere interessato a %s da %s.');
define('TEXT_EMAIL_LINK', 'Per vedere il prodotto clicca sul link sotto o copia e incolla il link sulla barra degli indirizzi:' . "\n\n" . '%s');
define('TEXT_EMAIL_SIGNATURE', 'Saluti,' . "\n\n" . '%s');

define('ERROR_TO_NAME', 'Errore: Il campo "Nome del tuo amico" non può essere vuoto.');
define('ERROR_TO_ADDRESS', 'Errore: L\'indirizzo e-mail del tuo amico deve essere valido.');
define('ERROR_FROM_NAME', 'Errore: Il campo "Nome" non può essere vuoto.');
define('ERROR_FROM_ADDRESS', 'Errore: Il tuo indirizzo e-mail deve essere valido.');
?>