<?php
  $info_box_contents = array();
  $info_box_contents[] = array('text' => HEADING_SEARCH_HELP);
  new infoBoxHeading($info_box_contents, true, true);
  $info_box_contents = array();
  $info_box_contents[] = array('text' => TEXT_SEARCH_HELP);
  new infoBox($info_box_contents);
?>
  
<div class="CinquantaL">
    <?php echo '<a href="' . tep_href_link(FILENAME_ADVANCED_SEARCH_RESULT) . '">' . tep_image_button('button_back.png', IMAGE_BUTTON_BACK) . '</a>'; ?>
</div>

<div class="CinquantaR">
    <?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image_button('button_continue.png', IMAGE_BUTTON_CONTINUE) . '</a>'; ?>
</div>