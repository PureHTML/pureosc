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
if (SERVER_INSTANCE === 'admin') { // then compilation
    // if (SERVER_INSTANCE === 'admin' && $_SERVER['REMOTE_USER'] != 'wget'){ //then compilation
    cssgenerator();
    cssgenerator_index_top();
    cssgenerator_index_products();
}

$header = '<link href=s.css rel=stylesheet>';
// media
// echo '<link rel="stylesheet" data-media="screen and (min-width: 980px)" data-href="98">';
// from php templates like index.php
$css_file = preg_replace('/\.php$/', '', basename($_SERVER['PHP_SELF']));

if ($css_file === 'index') {
    $css_file = 'index_'.$category_depth;
}

if (file_exists($css_file.'.css')) {
    $header .= "\n".'        <link href="'.$css_file.'.css" rel="stylesheet">'."\n";
}

/*
 * elseif (file_exists(preg_replace('/_[a-z].*$/','', $css_file).'.css')){
 $header.= '        <link href="' . preg_replace('/_[a-z].*$/','', $css_file) . '.css" rel="stylesheet">' . "\n";
}
 */

// echo header oneliner:
echo str_replace("\n", '', $header)."\n";

echo $oscTemplate->getBlocks('header_tags'); ?>
<header>
    <?php require 'includes/header.php'; ?>
</header>

<?php
if ($messageStack->size('header') > 0) {
    ?>

  <div class="p-1 bg-danger text-white text-center mb-3">
    <?php echo $messageStack->output('header'); ?>
  </div>

  <?php
}

if (isset($_GET['error_message']) && !empty($_GET['error_message'])) {
    ?>

  <div class="p-3 mb-3 bg-danger text-white text-center">
    <?php echo htmlspecialchars(stripslashes(urldecode($_GET['error_message']))); ?>
  </div>

  <?php
}

if (isset($_GET['info_message']) && !empty($_GET['info_message'])) {
    ?>

  <div class="p-3 mb-3 bg-info text-white text-center">
    <?php echo htmlspecialchars(stripslashes(urldecode($_GET['info_message']))); ?>
  </div>

  <?php
}

?>

<main>
  <div>

    <ul class="list-inline">
      <?php echo $breadcrumb->trail('&#47;'); ?>
    </ul>

    <div class="row">

      <?php
      if ($oscTemplate->hasBlocks('boxes_column_left') && isset($cPath_array)) {
          ?>

        <aside class="aside col-lg-2">
          <?php echo $oscTemplate->getBlocks('boxes_column_left'); ?>
        </aside>

        <?php
      }

?>

      <div class="col">
        <div class="<?php echo str_replace('_', '-', basename($PHP_SELF, '.php')); ?>">
