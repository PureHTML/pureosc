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

if (isset($_GET['payment_error']) && !empty($_GET['payment_error'])) {
    $redirect_url = tep_href_link('checkout_payment.php', 'payment_error='.$_GET['payment_error'].(isset($_GET['error']) && !empty($_GET['error']) ? '&error='.$_GET['error'] : ''));
} else {
    $hidden_params = '';

    if ($payment === 'sage_pay_direct') {
        $redirect_url = tep_href_link('checkout_process.php', 'check=3D');
        $hidden_params = tep_draw_hidden_field('MD', $_POST['MD']).tep_draw_hidden_field('PaRes', $_POST['PaRes']);
    } else {
        $redirect_url = tep_href_link('checkout_success.php');
    }
}

require 'includes/languages/'.$language.'/checkout_confirmation.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<base href="<?php echo \constant('HTTPS_SERVER').\constant('DIR_WS_CATALOG'); ?>"/>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>
<form name="redirect" action="<?php echo $redirect_url; ?>" method="post" target="_top"><?php echo $hidden_params; ?>
<noscript>
  <p align="center" class="main">The transaction is being finalized. Please click continue to finalize your order.</p>
  <p align="center" class="main"><input type="submit" value="Continue" /></p>
</noscript>
</form>
<script>
document.redirect.submit();
</script>
</body>
</html>
<?php require 'includes/application_bottom.php'; ?>
