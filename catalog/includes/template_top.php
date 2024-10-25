<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2020 osCommerce

  Released under the GNU General Public License
 */

$oscTemplate->buildBlocks();
?>
<!DOCTYPE html>
<html <?php echo HTML_PARAMS; ?>>
  <meta charset="<?php echo CHARSET; ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?php echo tep_output_string_protected($oscTemplate->getTitle()); ?></title>
  <link rel="shortcut icon" href="favicon.ico">
<?php
$header = "<link href=/s/s.css rel=stylesheet media=print onload=\"this.media='all'; this.onload=null;\">";
//TODO: media // echo '<link rel="stylesheet" data-media="screen and (min-width: 980px)" data-href="98">';
// from php templates like index.php
$css_file = preg_replace('/\.php$/', '', basename($_SERVER['PHP_SELF']));
if ($css_file === 'index') {
    $css_file = 'index_'.$category_depth;
}
if (file_exists($css_file.'.css')) {
    $header .= "\n".'        <link href="/s/'.$css_file.'.css" rel="stylesheet">'."\n";
}
/*
 * elseif (file_exists(preg_replace('/_[a-z].*$/','', $css_file).'.css')){
 $header.= '        <link href="' . preg_replace('/_[a-z].*$/','', $css_file) . '.css" rel="stylesheet">' . "\n";
}
 */
// echo header css output:
echo str_replace("\n", '', $header)."\n";

//include inline css
echo '<style>';
include('s/inline_css.inc');
echo '</style>';
echo $oscTemplate->getBlocks('header_tags'); ?>
<br>
<center>
<table width=96%>
    <?php require 'includes/header.php'; ?>
</table>

<?php if ($oscTemplate->hasBlocks('header_menu')) {  
  if (DBG == 'true') {echo '<!-- navigation  BEGIN -->';
}
?>
<table width=96%>
  <tr>
    <td id=m>
<?php echo $oscTemplate->getBlocks('header_menu'); ?>
<?php } ?>
</table><?php
if ($messageStack->size('header') > 0) {
    ?>
<table width=96%>
<tr>
  <td>
    <?php echo $messageStack->output('header'); ?>
</table><?php
}

if (isset($_GET['error_message']) && !empty($_GET['error_message'])) {
    ?>
<table width=96%>
<tr>
  <td>
    <?php echo htmlspecialchars(stripslashes(urldecode($_GET['error_message']))); ?>
</table>

  <?php
}

if (isset($_GET['info_message']) && !empty($_GET['info_message'])) {
    ?>
<table width=96%>
<tr>
  <td>
    <?php echo htmlspecialchars(stripslashes(urldecode($_GET['info_message']))); ?>
</table><?php
}

?><table width=96%>
<?php
  //diable breadcrumb on HomePage
  if (($_SERVER['SCRIPT_NAME'] != '/index.php') || (array_key_exists('cPath', $_GET))) { ?>
<tr>
  <td>
    <ul>
      <?php echo $breadcrumb->trail('&#47;'); ?>
    </ul>
<?php } ?>

      <?php
      if ($oscTemplate->hasBlocks('boxes_column_left') && isset($cPath_array)) {
          ?>

        <td>
          <?php echo $oscTemplate->getBlocks('boxes_column_left'); ?>
        </td>

        <?php
      }

?>