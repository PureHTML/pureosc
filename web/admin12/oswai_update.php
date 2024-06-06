<?php
/*
  $Id: SEO_Assistant.php,v 1.7 07/08/2004 - 12/17/2006
  SEO Originally Created by: Jack_mcs
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/
 
  require('includes/application_top.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>" />
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css" />

</head>
<body>
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
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
     <tr><td>
<?php
// /* per disabilitare la funzione di aggiornamento automatico
     echo '  osCommerce Online Merchant v2.2 RC1 - WAI v.' . PROJECT_VERSION_WAI;
function remote_file_exists ($url_web) 
{ 
/*
	Return error codes:
	1 = Invalid URL host
	2 = Unable to connect to remote host
*/	
	$head = ""; 
	$url_p = parse_url ($url_web); 
	
	if (isset ($url_p["host"])) 
	{ $host = $url_p["host"]; } 
	else 
	{ return 1; } 
	
	if (isset ($url_p["path"])) 
	{ $path = $url_p["path"]; } 
	else 
	{ $path = ""; } 
	
	$fp = @fsockopen ($host, 80, $errno, $errstr, 20); 
	if (!$fp) 
	{ return 2; } 
	else 
	{ 
		$parse = parse_url($url_web); 
		$host = $parse['host']; 
		
		fputs($fp, "HEAD ".$url_web." HTTP/1.1\r\n"); 
		fputs($fp, "HOST: ".$host."\r\n"); 
		fputs($fp, "Connection: close\r\n\r\n"); 
		$headers = ""; 
		while (!feof ($fp)) 
		{ $headers .= fgets ($fp, 128); } 
	} 
	fclose ($fp); 
	$arr_headers = explode("\n", $headers); 
	$return = false; 
	if (isset ($arr_headers[0])) 
	{ $return = strpos ($arr_headers[0], "404") === false; } 
	return $return; 
} 

// sample code 
$url_web = "http://www.magnino.net/version_num.txt"; 
if (remote_file_exists ($url_web)) 
{ 
     $wai_ver = @file($url_web);
     
     if (intval($wai_ver[0]) > intval(PROJECT_VERSION_WAI)) {
     echo ' - <a href="http://lnx.magnino.net/index.php" title="Update">New Update SITE OsWai</a> - ';
     } else {
     $wai_ver[0] = 100 ;
     echo ' - no Update';
     }
} // */ fine aggiornamento automatico  
?> 
</td></tr></table></td>
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
