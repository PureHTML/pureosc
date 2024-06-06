<h1 class="pageHeading">
  <?php echo tep_image_2ma_template(bts_select(images, 'table_background_specials.png'), HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?>
  <?php echo HEADING_TITLE; ?>
</h1><br />
<div class="AlignLeft">
<?php echo $pagetext; ?>
<br />
<?php echo TEXT_INFORMATION; ?>
<br /><br />
<?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image_button('button_continue.png', IMAGE_BUTTON_CONTINUE) . '</a>'; ?>
</div>