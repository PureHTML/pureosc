<?php

/*

  LoginBox v5.2 for the BTSv1.5

  osCommerce, Open Source E-Commerce Solutions

  http://www.oscommerce.com



  Copyright (c) 2008 osCommerce



  Released under the GNU General Public License



  LoginBox v5.0 was originally designed by Aubrey Kilian <aubrey@mycon.co.za>

  LoginBox v5.2 rewritten by Linda McGrath <osCOMMERCE@WebMakers.com>

  Rewritten and adapted for the BTSv1.5 by Paul Mathot

*/



$corner_left = 'square';

$corner_right = 'square';

$box_base_name = 'login'; // for easy unique box template setup (added BTSv1.2)

$box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)

require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_LOGIN); 

$boxHeading = IMAGE_BUTTON_LOGIN;

//jsp:orig todo fixme ssl 
//$boxContent = '<div class="AlignLeft"><br />' . tep_draw_form('login', tep_href_link(FILENAME_LOGIN, 'action=process', 'SSL'));
$boxContent = '<div class="AlignLeft"><br /><form action="login.php?action=process" method="post" name="login">';
$boxContent .= tep_draw_input_field_label('', true, 'email_address', ENTRY_EMAIL_ADDRESS) . '<br />';
$boxContent .= tep_draw_password_field_label('', false, 'password', ENTRY_PASSWORD) . '<br />';
$boxContent .= '<a class="ColorSpan" href="' . tep_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL') . '">' . TEXT_PASSWORD_FORGOTTEN . '</a> | <a class="ColorSpan" href="' . tep_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL') . '">' . TEXT_NEW_CUSTOMER . '</a>';
$boxContent .= '<div align="right">' . tep_image_submit('button_login.png', IMAGE_BUTTON_LOGIN, 'id="login_button"') . '</div></form><br />'; 
$boxContent .= '</div>';


include (bts_select('boxes', $box_base_name)); // BTS 1.5
?>