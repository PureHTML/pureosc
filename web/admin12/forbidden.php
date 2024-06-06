<?php
/*
  $Id: admin_account.php,v 1.29 2002/03/17 17:52:23 harley_vb Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');
  
  $current_boxes = DIR_FS_ADMIN . DIR_WS_BOXES;
  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>"/>
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css"/>
<script type="text/javascript" src="includes/general.js"></script>
</head>
<body style="margin: 0" bgcolor="#FFFFFF" onload="SetFocus();">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>
<!-- body_text //-->    
    <td width="100%" valign="top">
      <table border="0" width="100%" cellspacing="0" cellpadding="2">     
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.png', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td>
            <table border="0" width="100%" cellspacing="0" cellpadding="2" align="center">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo NAVBAR_TITLE; ?></td>
              </tr>
              <tr class="dataTableRow">
                <td align="left" class="dataTableContent"><?php echo TEXT_MAIN; ?></td>
              </tr>
              <tr class="dataTableRow">
                <td align="left"><?php echo '&nbsp;<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image_button('button_back.png', IMAGE_BACK) . '</a>&nbsp;'; ?></td>
              </tr>              
            </table>
        </td>
      </tr>
    </table></td>  
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br />
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>