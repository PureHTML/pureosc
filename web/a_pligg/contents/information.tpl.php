<h1 class="pageHeading">
  <?php 
  define ('HEADING_TITLE', $title);   
  echo tep_image_2ma_template(bts_select(images, 'table_background_specials.png'), HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); 
  echo HEADING_TITLE; ?>
</h1><br />
<div class="AlignLeft">
<?php echo $description; ?> <br />
</div>