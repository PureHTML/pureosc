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

<tr>
        <?php echo $oscTemplate->getBlocks('header_top'); ?>

  <?php
}

?>

  <tr valign=bottom>

      <?php echo $oscTemplate->getBlocks('header'); ?>
<?php
