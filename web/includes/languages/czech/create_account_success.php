<?php
/*
  $Id: create_account_success.php,v 1.9 2002/11/19 01:48:08 dgw_ Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

//TotalB2B
define('TEXT_ACCOUNT_CREATED_ENABLE', '<br /><br /><b><u>Váš účet byl úspěšně vytvořen.</u></b>');
define('TEXT_ACCOUNT_CREATED_DISABLE', '<br /><br /><b><u>Váš účet musíte před použitím aktivovat.</u></b>');
//TotalB2B

// Points/Rewards system V2.00 BOF
define('TEXT_WELCOME_POINTS_TITLE', 'Jako součást přihlášení nového zákazníka, poskytujeme Vám tento  <a href="' . tep_href_link(FILENAME_MY_POINTS, '', 'SSL') . '">Účet bonusových bodů</a>  s celkovým součtem %s bonusové body s cenou %s');
define('TEXT_WELCOME_POINTS_LINK', 'Prosíme podívejte se sem:  <a href="' . tep_href_link(FILENAME_MY_POINTS_HELP, '', 'NONSSL') . '">program bonusových bodů Reward Point Program FAQ</a> jak jej používat.');
// Points/Rewards system V2.00 EOF
define('NAVBAR_TITLE_1', 'Vytvořit účet');
define('NAVBAR_TITLE_2', 'Ano, povedlo se');
define('HEADING_TITLE', 'Váš účet byl úspěšně vytvořen');
define('TEXT_ACCOUNT_CREATED', 'Gratulujeme, váš nový účet byl úspěšně vytvořen. Máte-li dotazy, <a href="' . tep_href_link(FILENAME_CONTACT_US) . '">napište provozovateli obchodu</a>.');
?>