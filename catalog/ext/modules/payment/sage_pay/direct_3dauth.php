<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2009 osCommerce

  Released under the GNU General Public License
 */

chdir('../../../../');

require 'includes/application_top.php';

// if the customer is not logged on, redirect them to the login page
if (!isset($_SESSION['customer_id'])) {
    $navigation->set_snapshot(['mode' => 'SSL', 'page' => 'checkout_payment.php']);
    tep_redirect(tep_href_link('login.php'));
}

if (!isset($_SESSION['sage_pay_direct_acsurl'])) {
    tep_redirect(tep_href_link('checkout_payment.php'));
}

if (!isset($_SESSION['payment']) || ($payment !== 'sage_pay_direct')) {
    tep_redirect(tep_href_link('checkout_payment.php'));
}

require 'includes/languages/'.$language.'/checkout_confirmation.php';

require 'includes/languages/'.$language.'/modules/payment/sage_pay_direct.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo MODULE_PAYMENT_SAGE_PAY_DIRECT_3DAUTH_TITLE; ?></title>
<base href="<?php echo \constant('HTTPS_SERVER').\constant('DIR_WS_CATALOG'); ?>"/>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>
<FORM name="form" action="<?php echo $sage_pay_direct_acsurl; ?>" method="POST">
<input type="hidden" name="PaReq" value="<?php echo $sage_pay_direct_pareq; ?>" />
<input type="hidden" name="TermUrl" value="<?php echo tep_href_link('ext/modules/payment/sage_pay/redirect.php'); ?>" />
<input type="hidden" name="MD" value="<?php echo $sage_pay_direct_md; ?>" />
<NOSCRIPT>
<?php echo '<center><p>'.MODULE_PAYMENT_SAGE_PAY_DIRECT_3DAUTH_INFO.'</p><p><input type="submit" value="'.MODULE_PAYMENT_SAGE_PAY_DIRECT_3DAUTH_BUTTON.'"/></p></center>'; ?>
</NOSCRIPT>
<script>
document.form.submit();
</script>
</body>
</html>
<?php require 'includes/application_bottom.php'; ?>
