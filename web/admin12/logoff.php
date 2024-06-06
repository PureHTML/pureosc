<?php
/*
  $Id: logoff.php,v 1.12 2003/02/13 03:01:51 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License

  Includes Contribution:
  Access with Level Account (v. 2.2a) for the Admin Area of osCommerce (MS2)

  This file may be deleted if disabling the above contribution
*/

  require('includes/application_top.php');

  @include(DIR_WS_LANGUAGES . $language . '/' . FILENAME_LOGOFF);

//tep_session_destroy();
  tep_session_unregister('login_id');
  tep_session_unregister('login_firstname');
  tep_session_unregister('login_groups_id');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>"/>
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<table border="0" width="600" cellspacing="0" cellpadding="0" align="center" >
  <tr>
    <td>
    	<table border="0" width="600" cellspacing="0" cellpadding="1" align="center" >
      	<tr class="mainback">
        	<td>
          	<table border="0" width="600" cellspacing="0" cellpadding="0">
          		<tr class="logo-head" >
              	<td height="50"><?php echo tep_image(DIR_WS_IMAGES . 'oscommerce.png', 'osCommerce', '204', '50'); ?></td>
                <td align="right" class="nav-head" nowrap><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . HEADER_TITLE_ADMINISTRATION . '</a>&nbsp;|&nbsp;<a href="' . tep_catalog_href_link() . '">' . HEADER_TITLE_ONLINE_CATALOG . '</a>&nbsp;|&nbsp;<a href="http://www.oscommerce.com" target="_blank">' . HEADER_TITLE_SUPPORT_SITE . '</a>'; ?>&nbsp;&nbsp;</td>
          		</tr>
          		<tr class="main">
              	<td colspan="2" align="center" valign="middle">
                 	<table width="280" border="0" cellspacing="0" cellpadding="2">
                   	<tr>
                     	<td class="logoff_heading" valign="top"><b><?php echo HEADING_TITLE; ?></b></td>
                    </tr>
                    <tr>
                     	<td class="login_heading"><?php echo TEXT_MAIN; ?></td>
                    </tr>
                    <tr>
                     	<td class="login_heading" align="right"><?php echo '<a class="login_heading" href="' . tep_href_link(FILENAME_LOGIN, '', 'SSL') . '">' . tep_image_button('button_back.png', IMAGE_BACK) . '</a>'; ?></td>
                    </tr>
                    <tr>
                     	<td colspan="2"><?php echo tep_draw_separator('pixel_trans.png', '100%', '30'); ?></td>
                    </tr>
                  </table>
           			</td>
           		</tr>
        	 	</table>
          </td>
     		</tr>
     		<tr>
       		<td><?php require(DIR_WS_INCLUDES . 'footer.php'); ?></td>
     		</tr>
   		</table>
    </td>
 	</tr>
</table>

</body>

</html>