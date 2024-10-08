<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2020 osCommerce

  Released under the GNU General Public License
 */
// icons TODO css compile mimify

if ($oscTemplate->hasBlocks('header_top')) {
    ?>

  <div>
        <?php echo $oscTemplate->getBlocks('header_top'); ?>
  </div>

  <?php
}

?>

  <div>
      <?php echo $oscTemplate->getBlocks('header'); ?>
  </div>

<?php
if ($oscTemplate->hasBlocks('header_menu')) {
    ?>

  <div>
      <?php echo $oscTemplate->getBlocks('header_menu'); ?>
  </div>

  <?php
}
