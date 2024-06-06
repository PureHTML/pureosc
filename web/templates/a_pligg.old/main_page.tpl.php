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
<?php 
/* removed for Dinamic CSS to PHP
<link rel="stylesheet" type="text/css" href="<?php echo (bts_select('stylesheet','stylesheet.css')); // BTSv1.5 ?>">
*/
//shop2.0brain:new css load if EntryPage else ccs.linked
//if (str_replace(HTTP_SERVER, '', $_SERVER['HTTP_REFERER']) == $_SERVER['HTTP_REFERER']) { 
//echo '<link rel="stylesheet" media="all" href="' . (bts_select('stylesheet','stylesheet.css')) .  '" type="text/css" />';

// } else { 
echo '<style title="default" type="text/css" media="all"><!--';
require(bts_select('stylesheet','stylesheet.php')); 
echo '--></style>';
//}
?>

<link rel="alternate stylesheet" media="all" href="<?php echo (bts_select('stylesheet','stylesheet_BN.css')); // BTSv1.5 ?>" title="Black White" type="text/css" />
<link rel="alternate stylesheet" media="all" href="<?php echo (bts_select('stylesheet','stylesheet_BNL.css')); // BTSv1.5 ?>" title="Black White Large" type="text/css" />
<link rel="stylesheet" media="print" href="<?php echo (bts_select('stylesheet','print.css')); // BTSv1.5 ?>" title="Print CSS" type="text/css" />




<?php
# cDynamic Meta Tags 
/*<title><?php echo TITLE; ?></title>*/ 
require(DIR_WS_INCLUDES . 'meta_tags.php'); 
# END Meta Tag 
?>

<?php if (isset($javascript) && file_exists(DIR_WS_JAVASCRIPT . basename($javascript))) { require(DIR_WS_JAVASCRIPT . basename($javascript)); } ?>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>" />

<style type="text/css">
body {
  background-image: url(/i/pozadiHneda.gif);
  background-position: center top;
  background-repeat: repeat-y;
  background-color:#c0b693;
  font-size: 95%;
}
</style>
<!--[if IE]>
<style type="text/css">
body {
  font-size: 100%;
  background-image: url(/i/pozadiHnedaIE.gif);
  background-position: center top;
  background-repeat: repeat-y;
  background-color:#c0b693;
}
</style>
<![endif]-->

</head>
<body><?  //echo '<pre><div align="left">'; $GLOBALS['HTTP_REFERER'];  print_r($GLOBALS);  exit; ?><div id="page">
<!-- header //-->
<div class="header">

  <span class="HeaderLeft">
<?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image(bts_select(images, 'logo.gif'), STORE_NAME) . '</a>'; ?>
  </span>  

<div class="banner">
<?php
  if ($banner = tep_banner_exists('dynamic', 'horni')) {
?>

<?php echo tep_display_banner('static', $banner); ?>
<?php
  }
?>
</div>

<div class="menicko">
<a class="HeaderNavigationText" href="/">home</a>&nbsp;|&nbsp;

<a class="HeaderNavigationText" href="<?php echo tep_href_link('o-nas-i-4.html', '', 'SSL'); ?>">o nás</a>&nbsp;|&nbsp;<a class="HeaderNavigationText" href="<?php echo tep_href_link('jak-nakupovat-i-5.html', '', 'SSL'); ?>">jak nakupovat</a>&nbsp;|&nbsp;<?php 
  if (tep_session_is_registered('customer_id')) { 
  ?> <a href="<?php echo tep_href_link(FILENAME_LOGOFF, '', 'SSL'); ?>" class="HeaderNavigationText"><?php echo HEADER_TITLE_LOGOFF; ?></a>&nbsp;|&nbsp;<?php 
  } else {
  ?> <a href="<?php echo tep_href_link(FILENAME_LOGIN, '', 'SSL'); ?>" class="HeaderNavigationText"><?php echo HEADER_TITLE_LOGIN; ?></a>&nbsp;|&nbsp;<?php 

  }
?><a href="<?php echo tep_href_link(FILENAME_ACCOUNT, '', 'SSL'); ?>" class="HeaderNavigationText"><?php echo HEADER_TITLE_MY_ACCOUNT; ?></a>&nbsp;|&nbsp;<a href="<?php echo tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'); ?>" class="HeaderNavigationText"><?php echo HEADER_TITLE_CHECKOUT; ?></a> &nbsp;&nbsp;
</div>

</div><!-- header_eof //-->





<!-- body //-->


<span class="Retta"></span>








<!-- content //-->
<div class="Table_templateCentral">

<!-- warnings //-->
<?php require(DIR_WS_INCLUDES . 'warnings.php'); ?>
<!-- warning_eof //-->
<?php require (bts_select ('content')); // BTSv1.5 ?>
</div>

<!-- content_eof //-->


<!-- column_left //-->
<div class="column_left">
<?php require(bts_select('column', 'column_left.php')); // BTSv1.5 ?>
</div>
<!-- column_left eof //-->

<!-- column_right //-->
<div class="Table_templateColumnRight">
<?php require(bts_select('column', 'column_right.php')); // BTSv1.5 ?>
</div>
<!-- column_right eof //-->





<!-- body_eof //-->
</div>

</body>
</html>