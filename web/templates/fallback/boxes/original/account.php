<?php

/*

  LoginBox v5.2 for the BTSv1.5

  osCommerce, Open Source E-Commerce Solutions

  http://www.oscommerce.com



  Copyright (c) 2008 osCommerce



  Released under the GNU General Public License



  LoginBox v5.0 was originally designed by Aubrey Kilian <aubrey@mycon.co.za>

  LoginBox v5.2 rewritten by Linda McGrath <osCOMMERCE@WebMakers.com>

  Rewritten and adapted for the BTSv1.5 by Paul Mathot <forums.eeweb.nl>

*/



$corner_left = 'square';

$corner_right = 'square';

$box_base_name = 'account'; // for easy unique box template setup (added BTSv1.2)

$box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)

require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ACCOUNT);

$boxHeading = MY_ACCOUNT_TITLE;

$boxContent = '<a href="' . tep_href_link(FILENAME_LOGOFF, '', 'NONSSL') . '">' . HEADER_TITLE_LOGOFF . '</a>';
$boxContent .= '<br /><a href="' . tep_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . MY_ACCOUNT_TITLE . '</a>';

include (bts_select('boxes', $box_base_name)); // BTS 1.5
?>

