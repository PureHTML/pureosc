<h1 class="pageHeading">
  <?php echo tep_image_2ma_template(bts_select(images, 'table_background_default.png'), HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?>
  <?php echo HEADING_TITLE; ?> 
</h1><br />
<div class="AlignLeft">
<?php echo tep_customer_greeting(); ?>
<?php echo TEXT_MAIN; ?><br /><?php echo $pagetext; ?><br />
</div>
<?php include(DIR_WS_MODULES . FILENAME_NEW_PRODUCTS); ?>

<?php include(DIR_WS_MODULES . FILENAME_UPCOMING_PRODUCTS); ?>