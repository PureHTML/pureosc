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


<?php require(bts_select('stylesheet','stylesheet.php')); ?>


</head>
<body>


<?php
// include i.e. template switcher in every template
if(bts_select('common', 'common_top.php')) include (bts_select('common', 'common_top.php')); // BTSv1.5
?>


<!-- header //-->
<div class="header">
  <span class="HeaderLeft"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image(bts_select(images, 'logo.png'), STORE_NAME) . '</a>'; ?></span>
  <span class="HeaderRight"><?php echo '<a href="' . tep_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . tep_image(bts_select(images, 'header_account.png'), HEADER_TITLE_MY_ACCOUNT) . '</a>&nbsp;.&nbsp;<a href="' . tep_href_link(FILENAME_SHOPPING_CART) . '">' . tep_image(bts_select(images, 'header_cart.png'), HEADER_TITLE_CART_CONTENTS) . '</a>&nbsp;.&nbsp;<a href="' . tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL') . '">' . tep_image(bts_select(images, 'header_checkout.png'), HEADER_TITLE_CHECKOUT) . '</a>'; ?>&nbsp;&nbsp;</span>
<div class="Clear"> <br /> </div>
</div>
<div class="HeaderNavigation">
  <span class="HeaderNavigationLeft">&nbsp;&nbsp;<?php echo $breadcrumb->trail(' &raquo; '); ?></span>
  <span class="HeaderNavigationRight"> &nbsp;|&nbsp; 
<?php 
  if (tep_session_is_registered('customer_id')) { 
  ?> <a href="<?php echo tep_href_link(FILENAME_LOGOFF, '', 'SSL'); ?>" class="HeaderNavigationText"><?php echo HEADER_TITLE_LOGOFF; ?></a> &nbsp;|&nbsp; <?php 
  } else {
  ?> <a href="<?php echo tep_href_link(FILENAME_LOGIN, '', 'SSL'); ?>" class="HeaderNavigationText"><?php echo HEADER_TITLE_LOGIN; ?></a> &nbsp;|&nbsp; <?php 

  }
?><a href="<?php echo tep_href_link(FILENAME_ACCOUNT, '', 'SSL'); ?>" class="HeaderNavigationText"><?php echo HEADER_TITLE_MY_ACCOUNT; ?></a> &nbsp;|&nbsp; <a href="<?php echo tep_href_link(FILENAME_SHOPPING_CART); ?>" class="HeaderNavigationText"><?php echo HEADER_TITLE_CART_CONTENTS; ?></a> &nbsp;|&nbsp; <a href="<?php echo tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'); ?>" class="HeaderNavigationText"><?php echo HEADER_TITLE_CHECKOUT; ?></a> &nbsp;&nbsp;</span>
<div class="Clear"> <br /> </div>
</div>
<!-- header_eof //-->


<div class="TemplateSpazio"> <br /> </div>


<!-- body //-->


<span class="Retta"> <br /> <br /> </span>


<!-- left_navigation //-->
<div class="Table_templateSx">
<?php require(bts_select('column', 'column_left.php')); // BTSv1.5 ?>
</div> 
<!-- left_navigation_eof //-->


<span class="Retta"> <br /> <br /> </span>



<!-- content //-->
<div class="Table_templateCentral">
<!-- warnings //-->
<?php require(DIR_WS_INCLUDES . 'warnings.php'); ?>
<!-- warning_eof //-->
<?php require (bts_select ('content')); // BTSv1.5 ?>
</div>
<!-- content_eof //-->


<span class="Retta"> <br /> <br /> </span>


<!-- column_right //-->
<div class="Table_templateDx">
<?php require(bts_select('column', 'column_right.php')); // BTSv1.5 ?>
</div> 
<!-- column_right eof //-->



<div class="Table_templateClear"> <br /> </div> 


<!-- body_eof //-->



<!-- footer //-->
<br />
<?php require(DIR_WS_INCLUDES . 'counter.php'); ?>
<div class="HeaderNavigation">
<span class="HeaderNavigationLeft" >&nbsp;&nbsp;<?php echo strftime(DATE_FORMAT_LONG); ?></span>
<span class="HeaderNavigationRight" >&nbsp;&nbsp;<?php echo $counter_now . ' ' . FOOTER_TEXT_REQUESTS_SINCE . ' ' . $counter_startdate_formatted; ?>&nbsp;&nbsp;</span>
<div class="Clear"> <br /> </div>
</div>
<br />
<div class="Clear"> &nbsp; </div>
<?php echo STORE_NAME_ADDRESS; ?> <br />
<?php 
/*
  The following copyright announcement can only be
  appropriately modified or removed if the layout of
  the site theme has been modified to distinguish
  itself from the default osCommerce-copyrighted
  theme.

  For more information please read the following
  Frequently Asked Questions entry on the osCommerce
  support site:

  http://www.oscommerce.com/community.php/faq,26/q,50

  Please leave this comment intact together with the
  following copyright announcement.
*/
echo FOOTER_TEXT_BODY; 
    // Output the footer for Dynamenu for osCommerce
    echo $GLOBALS['dmfooter'];
?> <br />
<br />
<?php
  if ($banner = tep_banner_exists('dynamic', '468x50')) {
?>
<br />
<?php echo tep_display_banner('static', $banner); ?>
<?php
  }
?>
<!-- footer_eof //-->



<br />
</body>
</html>