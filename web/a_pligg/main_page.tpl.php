<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>"/>
<link rel="bookmark" href="favicon.ico" />
<link rel="shortcut icon" href="favicon.ico" />
<meta http-equiv="Default-Style" content="default" />
<meta name="Copyright" content="<?=STORE_OWNER?>" />
<meta name="robots" content="index, follow" />
<meta name="Author" content="OsCommerce Team, Contribution, studioIQ.cz" />
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
<?
//jsp:new:pagehack 
$template_width = 900;
$template_width_hack = $template_width / 2; ?>
#page {
  width: <?php echo $template_width ?>px; 
  top:0px; 
<? //jsp:osc_admin_mode
if (ADMIN_LOGIN==1) {
echo '   
        left: 0%;
        /*  margin-left:  -0px; */
        ';
} else {
echo '
  left: 50%;
  margin-left:  -' . $template_width_hack . 'px;
  ';
}
?>


body {
  font-size: 95%; 
} 
</style>
<!--[if IE]>
<style type="text/css">
body {
  font-size: 100%;
}
</style>
<![endif]-->

</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/cs_CZ/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?
//echo '<pre><div align="left">'; $GLOBALS['HTTP_REFERER'];  print_r($GLOBALS);  exit; 
?><div id="page">
<!-- header //-->
<div class="header">

  <div class="HeaderLeft">
<a href="/"></a>
  </div>

<div class="searchwindow">
<form name="quick_find" action="/advanced_search_result.php"
method="get"> <input class="searchtext" 
alt="keywords" type="text" name="keywords"
id="keywords"   size="16" maxlength="30" onfocus="this.value='';" value="vyhledat"
/>
</form>
</div>


<div class="banner">
<?php
  if ($banner = tep_banner_exists('dynamic', 'horni')) {
?>

<?php 
//echo tep_display_banner('static', $banner); ?>
<?php
  }
?>
</div>

<div class="menicko">
<a class="HeaderNavigationText" href="/">home</a>

<? 
//vydavatel
if  ($language=='czech') echo '<a class="HeaderNavigationText" href="' . tep_href_link('contact_us.php', '', 'SSL') . '">' . TOPMENU_CONTACT .'</a>';

if  ($language=='czech') echo '<a class="HeaderNavigationText" href="' . tep_href_link('pro-developpery-i-6.html', '', 'SSL') . '">' . MENU_DEVELOPPERS .'</a>';

if  ($language=='czech') echo '<a class="HeaderNavigationText" href="' . tep_href_link('o-nas-i-4.html', '', 'SSL') . '">' . MENU_ABOUT_US .'</a>';
if  ($language=='czech') echo '<a class="HeaderNavigationText" href="' . tep_href_link('reference-i-15.html', '', 'SSL') . '">' . MENU_REFERENCE .'</a>';

if  ($language=='czech') echo '<a class="HeaderNavigationText" href="' . tep_href_link('jak-nakupovat-i-5.html', '', 'SSL') . '">' . MENU_HELP .'</a>';



?>
<?php 
 if (tep_session_is_registered('customer_id') && (!isset($HTTP_GET_VARS['guest']) && !isset($HTTP_POST_VARS['guest'])) && !$order->customer['is_dummy_account']) { 
  ?> <a href="<?php echo tep_href_link(FILENAME_LOGOFF, '', 'SSL'); ?>" class="HeaderNavigationText"><?php echo HEADER_TITLE_LOGOFF; ?></a><?php 
  } else {
  ?> <a href="<?php echo tep_href_link(FILENAME_LOGIN, '', 'SSL'); ?>" class="HeaderNavigationText"><?php echo HEADER_TITLE_LOGIN; ?></a><?php 

  }
 if (tep_session_is_registered('customer_id') && (!isset($HTTP_GET_VARS['guest']) && !isset($HTTP_POST_VARS['guest'])) && !$order->customer['is_dummy_account']) { ?><a href="<?php echo tep_href_link(FILENAME_ACCOUNT, '', 'SSL'); ?>" class="HeaderNavigationText"><?php echo HEADER_TITLE_MY_ACCOUNT; ?></a>  <?php } ?><a href="<?php echo tep_href_link(FILENAME_SHOPPING_CART); ?>" class="HeaderNavigationText"><?php echo HEADER_TITLE_CART_CONTENTS; ?></a>  <a href="<?php echo tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'); ?>" class="HeaderNavigationText"><?php echo HEADER_TITLE_CHECKOUT; ?></a>

</div>
</div>
<? 
if ($language!='czech') {
echo '<div style="position:absolute; left:200px;top:150px;text-align:left"><h3>Page under construction<br>contact:  misur@kairos-portal.org</h3></div>
';
exit;
}

?>
<!-- header_eof //-->





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


<script type="text/javascript">
    var leady_track_key="jxgheBP6nx8U84nW";
    var leady_track_server=document.location.protocol+"//track.leady.cz/";
    (function(){
	var l=document.createElement("script");l.type="text/javascript";l.async=true;
	l.src=leady_track_server+leady_track_key+"/L.js";
	var s=document.getElementsByTagName("script")[0];s.parentNode.insertBefore(l,s);
    })();
</script>


</body>
</html>