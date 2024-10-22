<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2020 osCommerce

  Released under the GNU General Public License
 */
?>


  <?php
  if ($oscTemplate->hasBlocks('footer_top')) {
      ?>
<div>

    <?php echo $oscTemplate->getBlocks('footer_top'); ?>
</div>

    <?php
  }

?>



    <?php
  if ($oscTemplate->hasBlocks('footer')) {
      ?>

        <?php echo $oscTemplate->getBlocks('footer'); ?>
      <?php
  }
?>
    <?php
if ($oscTemplate->hasBlocks('footer_bottom')) {
    ?>
      <?php echo $oscTemplate->getBlocks('footer_bottom'); ?>
      <?php
}
?>
