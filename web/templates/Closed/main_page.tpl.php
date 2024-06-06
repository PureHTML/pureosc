<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>"/>
<link rel="bookmark" href="favicon.ico" />
<link rel="shortcut icon" href="favicon.ico" />
<meta http-equiv="Default-Style" content="default" />
<meta name="Copyright" content="OsCommerce Team" />
<meta name="Author" content="OsCommerce Team, Contribution" />
<meta name="Optimized Wai Xhtml" content="Maury2ma, Vitforlinux, www.magnino.net" />
<meta name="Optimized PHP4-5 MySql4-5" content="Maury2ma, Vitforlinux, www.magnino.net" />
<title>Closed</title>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>" />
</head>
<body style="background-color: #ffffff;">
<!--
"Closed" template for osC created by Paul Mathot
2003/12/29
-->
<?php
// include i.e. template switcher in every template
if(bts_select('common', 'common_top.php')) 
include (bts_select('common', 'common_top.php')); // BTSv1.5
;
?>
<h1 style="color: #ff0000;">Sorry we're Closed</h1>
Work in progress
</body>
</html>
