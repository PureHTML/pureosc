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

define('HEADING_TITLE', 'Zaslat dárkový poukaz');
define('NAVBAR_TITLE', 'Zaslat dárkový poukaz');
define('EMAIL_SUBJECT', 'Dotaz od ' . STORE_NAME);
define('HEADING_TEXT','<br />Vyberte níže způsob doručení dárkového poukazu. Pro další informace se podívejte na: <a href="' . tep_href_link(FILENAME_GV_FAQ,'','NONSSL').'">'.GV_FAQ.'.</a><br />');
define('ENTRY_NAME', 'Jméno adresáta:');
define('ENTRY_EMAIL', 'Adresátův e-mail:');
define('ENTRY_MESSAGE', 'Informace pro adresáta:');
define('ENTRY_AMOUNT', 'Hodnota dárkového poukazu:');
define('ERROR_ENTRY_AMOUNT_CHECK', '&nbsp;&nbsp;<span class="errorText">Špatná hodnota</span>');
define('ERROR_ENTRY_EMAIL_ADDRESS_CHECK', '&nbsp;&nbsp;<span class="errorText">špatný e-mail</span>');
define('MAIN_MESSAGE', 'Máte připraven k odeslání dárkový poukaz v ceně %s do %s emailové adresy %s<br /><br />Začátek e-mailu obsahuje text:<br /><br />Vážený %s<br /><br />
                        Dárkový poukaz odeslán v této ceně %s na %s');

define('PERSONAL_MESSAGE', '%s řekli');
define('TEXT_SUCCESS', 'Gratulujeme, Váš dárkový poukaz byl odeslán');


define('EMAIL_SEPARATOR', '----------------------------------------------------------------------------------------');
define('EMAIL_GV_TEXT_HEADER', 'Děkujeme, přijali jsme dárkový poukaz v ceně %s');
define('EMAIL_GV_TEXT_SUBJECT', 'Dárek od %s');
define('EMAIL_GV_FROM', 'Dárkový poukaz Vám byl zaslán na %s');
define('EMAIL_GV_MESSAGE', 'Úvod zprávy');
define('EMAIL_GV_SEND_TO', 'Dobrý den, %s');
define('EMAIL_GV_REDEEM', 'Pro připočítání tohoto dárkového poukazu, klikněte na link níže. Prosíme napište pouze ověřovací kód %s. Nechcete-li mít nějaký problém.');
define('EMAIL_GV_LINK', 'Pro připočítání klikněte ');
define('EMAIL_GV_VISIT', ' nebo navštivte ');
define('EMAIL_GV_ENTER', ' a vložte kód ');
define('EMAIL_GV_FIXED_FOOTER', 'Máte-li nějaký problém s připočtením dárkového poukazu použijte link výše, ' . "\n" . 
                                'Kód dárkového poukazu můžete také vložit při placení v našem obchodě.' . "\n\n");
define('EMAIL_GV_SHOP_FOOTER', '');
?>