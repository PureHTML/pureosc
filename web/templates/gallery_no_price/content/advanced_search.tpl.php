<?php echo tep_draw_form('advanced_search', tep_href_link(FILENAME_ADVANCED_SEARCH_RESULT, '', 'NONSSL', false), 'get', 'onsubmit="return check_form(this);"') . tep_hide_session_id(); ?>
<h1 class="pageHeading">
  <?php echo tep_image_2ma_template(bts_select(images, 'table_background_browse.png'), HEADING_TITLE_1, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?>
  <?php echo HEADING_TITLE_1; ?>
</h1> <br />
<div class="AlignLeft">
<?php
  if ($messageStack->size('search') > 0) {
?>
  <?php echo $messageStack->output('search'); ?> <br />
<?php
  }
?>
<br />
<?php
  $info_box_contents = array();
  $info_box_contents[] = array('text' => HEADING_SEARCH_CRITERIA);

  new infoBoxHeading($info_box_contents, true, true);

  $info_box_contents = array();
  $info_box_contents[] = array('text' => tep_draw_input_field_label(HEADING_TITLE_1, true, 'keywords', HEADING_TITLE_1, ''));
  $info_box_contents[] = array('text' => tep_draw_checkbox_field_label(TEXT_SEARCH_IN_DESCRIPTION, 'serch_descr', 'search_in_description', '1'));

  new infoBox($info_box_contents);
?>
</div>

  <?php echo tep_image_submit('button_search.png', IMAGE_BUTTON_SEARCH, 'id="serch"'); ?> 
  <?php echo '<a href="' . tep_href_link(FILENAME_POPUP_SEARCH_HELP) . '">' . TEXT_SEARCH_HELP_LINK . '</a>'; ?> 
  </form>