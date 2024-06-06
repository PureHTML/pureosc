<?php
/*
  $Id: gv_redeem.php,v 1.1.1.1.2.1 2003/04/18 16:56:03 wilt Exp $

  The Exchange Project - Community Made Shopping!
  http://www.theexchangeproject.org

  Gift Voucher System v1.0
  Copyright (c) 2001,2002 Ian C Wilson
  http://www.phesis.org

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', 'Připočtení dárkového poukazu');
define('HEADING_TITLE', 'Připočtení dárkového poukazu');
define('TEXT_INFORMATION', 'Pro další informace týkající se dárkových poukazů, se prosím podívejte na náš link<a href="' . tep_href_link(FILENAME_GV_FAQ,'','NONSSL').'">'.GV_FAQ.'.</a>');
define('TEXT_INVALID_GV', 'Váš dárkový poukaz má špatné číslo, nebo musí být přepočítán. Prosíme, kontaktujte provozovatele obchodu na kontaktní stránce.');
define('TEXT_VALID_GV', 'Gratulujeme, máte připočítán dárkový poukaz v ceně %s');
?>