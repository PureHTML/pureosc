<?php
/*
  $Id: gv_send.php,v 1.1.2.1 2003/04/18 17:25:44 wilt Exp $

  The Exchange Project - Community Made Shopping!
  http://www.theexchangeproject.org

  Gift Voucher System v1.0
  Copyright (c) 2001,2002 Ian C Wilson
  http://www.phesis.org

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Invia ' . 'BUONI REGALO');
define('NAVBAR_TITLE', 'Invia ' . 'BUONI REGALO');
define('EMAIL_SUBJECT', 'Messaggio da ' . STORE_NAME);
define('HEADING_TEXT','<br />Per cortesia, inserisci qui sotto i dettagli dei ' . 'BUONI REGALO' . ' che desideri inviare. Per maggiori informazioni, consulta le nostre <a href="' . tep_href_link(FILENAME_GV_FAQ, '', 'NONSSL').'">' . GV_FAQ . '.</a><br />');
define('ENTRY_NAME', 'Generalit&agrave; destinatario:');
define('ENTRY_EMAIL', 'Indirizzo e-mail destinatario:');
define('ENTRY_MESSAGE', 'Messaggio per destinatario:');
define('ENTRY_AMOUNT', 'Ammontare dei BUONI REGALO:');
define('ERROR_ENTRY_AMOUNT_CHECK', '<br />Questo ammontare di BUONI REGALO non sembra essere corretto, le ricordiamo che deve gi&agrave; possedere i BUONI REGALO per poterli regalare.<br />');
define('ERROR_ENTRY_EMAIL_ADDRESS_CHECK', 'Questo indirizzo email &egrave; corretto? Cortesemente verifica!');
define('MAIN_MESSAGE', 'Stai inviando un ' . 'BUONI REGALO' . ' del valore di %s a %s,  il cui indirizzo email address &egrave; %s. Se queste informazioni non sono corrette, puoi modificare il messaggio cliccando sul pulsante <strong>modifica</strong>.<br /><br />Il messaggio che stai inviando &egrave;:<br /><br />');

define('PERSONAL_MESSAGE', '%s dice');
define('TEXT_SUCCESS', 'Complimenti, il tuo BUONO REGALO &egrave; stato inviato regolarmente');


define('EMAIL_SEPARATOR', '----------------------------------------------------------------------------------------');
define('EMAIL_GV_TEXT_HEADER', 'Complimenti, hai ricevuto un ' . 'BUONI REGALO' . ' del valore di %s');
define('EMAIL_GV_TEXT_SUBJECT', 'Un regalo da %s');
define('EMAIL_GV_FROM', 'Questo ' . 'BUONI REGALO' . ' ti &egrave; stato inviati da %s');
define('EMAIL_GV_MESSAGE', 'con il seguente messaggio: ');
define('EMAIL_GV_SEND_TO', 'Ciao, %s');
define('EMAIL_GV_REDEEM', 'Per riscuotere questi ' . 'BUONI REGALO' . ', clicca sul link sottostante. Ti consigliamo anche di annotare il ' . 'CODICE BUONO REGALO' . ': %s  qualora dovessero insorgere difficoltà.');
define('EMAIL_GV_LINK', 'Per riscuotere clicca qui');
define('EMAIL_GV_VISIT', ' oppure visita ');
define('EMAIL_GV_ENTER', ' ed inserisci il ' . 'CODICE BUONO REGALO' . ' ');
define('EMAIL_GV_FIXED_FOOTER', 'Se dovessi incontrare difficoltà nella riscossione dei ' . 'BUONI REGALO' . ' mediante il link automatico qui sopra, ' . "\n" .
                                'puoi anche inserire il ' . 'BUONI REGALO' . ' ' . 'CODICE BUONO REGALO' . ' durante la fase di acquisto.');
define('EMAIL_GV_SHOP_FOOTER', '');
?>