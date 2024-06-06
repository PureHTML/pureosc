<?php
/*
  $Id: tell_a_friend.php,v 1.7 2003/06/10 18:20:39 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
  
  Edit only lines 26 & 27.
*/

define('NAVBAR_TITLE', 'Richiesta di informazioni');

define('HEADING_TITLE', 'Richiesta di informazioni su:<br />%s');

define('FORM_TITLE_CUSTOMER_DETAILS', 'I tuoi dati');
define('FORM_TITLE_FRIEND_MESSAGE', 'La tua domanda');

define('FORM_FIELD_CUSTOMER_NAME', 'Il tuo nome :');
define('FORM_FIELD_CUSTOMER_EMAIL', 'La tua e-mail:');


define('TEXT_EMAIL_SUCCESSFUL_SENT', 'La domanda su: <span class="b">%s</span> &egrave; stata spedita con successo...');

define('TEXT_EMAIL_SUBJECT', 'Una domanda da %s');
define('TEXT_EMAIL_INTRO', '%s' . "\n\n" . 'Un visitatore, %s, ha una domanda su: %s - %s.');
define('TEXT_EMAIL_LINK', 'Il link del prodotto:' . "\n\n" . '%s');
define('TEXT_EMAIL_SIGNATURE', 'Grazie,' . "\n\n" . '%s');

define('ERROR_FROM_NAME', 'Errore: La casella il tuo nome non può essere vuota.');
define('ERROR_FROM_ADDRESS', 'Errore: La tua e-mail non ha un Indirizzo valido.');
?>