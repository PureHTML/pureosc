<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2020 osCommerce

  Released under the GNU General Public License
 */
?>
<!DOCTYPE html>
<html <?php echo HTML_PARAMS; ?>>
<head>
  <meta charset="<?php echo CHARSET; ?>">
  <meta name="robots" content="noindex,nofollow">
  <title><?php echo TITLE; ?></title>
  <base href="<?php echo constant('HTTPS_SERVER') . constant('DIR_WS_HTTPS_ADMIN') ?>"/>
  <link rel="shortcut icon" href="<?php echo tep_catalog_href_link('favicon.ico'); ?>"/>
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/redmond/jquery-ui.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

  <?php
  if (!empty(JQUERY_DATEPICKER_I18N_CODE)) {
      ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.10.4/i18n/jquery.ui.datepicker-<?php echo JQUERY_DATEPICKER_I18N_CODE; ?>.min.js"></script>
    <script>
      $.datepicker.setDefaults($.datepicker.regional['<?php echo JQUERY_DATEPICKER_I18N_CODE; ?>']);
    </script>
    <?php
  }

?>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/jquery.flot.min.js" integrity="sha512-eO1AKNIv7KSFl5n81oHCKnYLMi8UV4wWD1TcLYKNTssoECDuiGhoRsQkdiZkl8VUjoms2SeJY7zTSw5noGSqbQ==" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/jquery.flot.time.min.js" integrity="sha512-lcRowrkiQvFli9HkuJ2Yr58iEwAtzhFNJ1Galsko4SJDhcZfUub8UxGlMQIsMvARiTqx2pm7g6COxJozihOixA==" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="includes/stylesheet.css">
  <script src="includes/general.js"></script>
   <?php
     if (!defined('USE_SUMMERNOTE_ADMIN_TEXTAREA')) {
       tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, set_function) values ('', 'Use SummerNote', 'USE_SUMMERNOTE_ADMIN_TEXTAREA','true','Use SummerNote for WYSIWYG editing of textarea fields in admin',1,99,now(),'tep_cfg_select_option(array(\'true\', \'false\'),' )");
       define ('USE_SUMMERNOTE_ADMIN_TEXTAREA','true');
     }
     if (USE_SUMMERNOTE_ADMIN_TEXTAREA == "true") { //TODO:add summernote to modules, create dark skin
   ?>


    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-lite.min.js"></script>
    <style>.note-editable{background:white !important}</style>
   <?php } ?>
</head>
<body>

<?php require 'includes/header.php'; ?>

<?php
if (isset($_SESSION['admin'])) {
    include 'includes/column_left.php';
} else {
    ?>

  <style>
      #contentText {
          margin-left: 0;
      }
  </style>

  <?php
}

?>

<div id="contentText">
