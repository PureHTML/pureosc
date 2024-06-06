<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2021 osCommerce

  Released under the GNU General Public License
*/
?>
<!DOCTYPE html>

<html>

<head>
  <meta charset="utf-8">
  <title>Vanilla osCommerce, Starting Your Online Business</title>
  <meta name="robots" content="noindex,nofollow">
  <link rel="icon" type="image/png" href="images/oscommerce_icon.png">

  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/redmond/jquery-ui.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

  <link rel="stylesheet" href="templates/main_page/stylesheet.css">
</head>

<body>

<div id="pageHeader">
  <div>
    <div style="float: right; padding-top: 40px; padding-right: 15px; color: #000000; font-weight: bold;">
      <a href="http://www.oscommerce.com" target="_blank">osCommerce Website</a> &nbsp;|&nbsp;
      <a href="http://www.oscommerce.com/support" target="_blank">Support</a> &nbsp;|&nbsp;
      <a href="http://www.oscommerce.info" target="_blank">Documentation</a></div>

    <a href="index.php"><img src="images/oscommerce.png" title="osCommerce Online Merchant" style="margin: 10px 10px 0 10px;"></a>
  </div>
</div>

<div id="pageContent">
  <?php require('templates/pages/' . $page_contents); ?>
</div>

<div id="pageFooter">
  <p>osCommerce Online Merchant Copyright &copy; 2000-<?php echo date('Y'); ?>
    <a href="http://www.oscommerce.com" target="_blank">osCommerce</a> (<a href="http://www.oscommerce.com/Us&amp;Legal" target="_blank">Copyright and Trademark Policy</a>)
  </p>
</div>

</body>

</html>
