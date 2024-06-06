<?php
/*
  $Id: admin_notes_help.php,v 2.2 2005/04/15 11:25:32 PopTheTop Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ADMIN_NOTES_HELP);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>" />
<title>Admin Notes Help</title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css" />
</head>
<style type="text/css"><!--
BODY { margin-bottom: 10px; margin-left: 10px; margin-right: 10px; margin-top: 10px; }
--></style>
<body>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td valign="top">
		<table border="0" width="100%" cellspacing="0" cellpadding="2">
			<tr class="dataTableHeadingRow">
				<td class="dataTableHeadingContent" align="center"><?php echo TEXT_GRAY_TITLE; ?></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td width="100%" class="dataTableContent">
		<?php echo TEXT_NOTE; ?>
		<br /><br />
		<?php echo ADMIN_NOTES_TITLE . AUTHOR . TEXT_IC_ONE; ?></td>
	</tr>
</table>
<p class="smallText" align="right"><?php echo '<a href="javascript:window.close()">' . TEXT_CLOSE_WINDOW . '</a>'; ?></p>
</body>
</html>
<?php require('includes/application_bottom.php'); ?>