<?php //jsp:seourl echo tep_draw_form('contact_us', tep_href_link(FILENAME_CONTACT_US, 'action=send')); ?>
<form name="contact_us" action="/contact_us.php?action=send" method="post">
<h1 class="pageHeading">
  <?php //echo tep_image_2ma_template(bts_select(images, 'table_background_contact_us.png'), HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?>
  <?php echo HEADING_TITLE; ?>
</h1> <br /> 
<div class="AlignLeft">
<?php
  if ($messageStack->size('contact') > 0) {
?>
  <?php echo $messageStack->output('contact'); ?><br />
<?php
  }

  if (isset($_GET['action']) && ($_GET['action'] == 'success')) {
?>
 <?php echo tep_image_2ma_template(bts_select(images, 'table_background_man_on_board.png'), HEADING_TITLE, '0', '0', '') . ' ' . TEXT_SUCCESS; ?><br /><br />
 <?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image_button('button_continue.png', IMAGE_BUTTON_CONTINUE) . '</a>'; ?>
<?php
  } else {
?>
    <?php echo $pagetext; ?> <br /><br />
  <div class="InfoBoxContenent2MA">
    <?php echo tep_draw_input_field_label(ENTRY_NAME, true, 'name', ENTRY_NAME); ?> 
    <br />
    <?php echo tep_draw_input_field_label(ENTRY_EMAIL, true, 'email', ENTRY_EMAIL); ?> 
    <br />
    <?php echo ENTRY_ENQUIRY; ?>
    <?php echo tep_draw_textarea_field('enquiry', '50', '10'); ?>
  </div> <br /> 
  
<?php
// BOF Anti Robot Registration v2.6
  if (ACCOUNT_VALIDATION == 'true' && strstr($PHP_SELF,'contact_us') &&  CONTACT_US_VALIDATION == 'true') {
?>
  <h2 class="b"><?php echo CATEGORY_ANTIROBOTREG; ?></h2>
  <div class="InfoBoxContenent2MA">
<?php
      if ($is_read_only == false || (strstr($PHP_SELF,'contact_us')) ) {
        $sql = "DELETE FROM " . TABLE_ANTI_ROBOT_REGISTRATION . " WHERE timestamp < '" . (time() - 3600) . "' OR session_id = '" . tep_session_id() . "'";
        if( !$result = tep_db_query($sql) ) { die('Could not delete validation key'); }
        $reg_key = gen_reg_key();
        $sql = "INSERT INTO ". TABLE_ANTI_ROBOT_REGISTRATION . " VALUES ('" . tep_session_id() . "', '" . $reg_key . "', '" . time() . "')";
        if( !$result = tep_db_query($sql) ) { die('Could not check registration information'); }
  echo '<label for="anti_robot_reg">' . ENTRY_ANTIROBOTREG . '<br />'; 
        $check_anti_robotreg_query = tep_db_query("select session_id, reg_key, timestamp from ". TABLE_ANTI_ROBOT_REGISTRATION . " where session_id = '" . tep_session_id() . "'");
        $new_guery_anti_robotreg = tep_db_fetch_array($check_anti_robotreg_query);
        $validation_images = '<br />' . tep_image_2ma('validation_png.php?rsid=' . $new_guery_anti_robotreg['session_id']);
          echo $validation_images . ' <br /> <br />' ;
          echo tep_draw_input_field('antirobotreg', $account['entry_antirobotreg'], ' id="anti_robot_reg" ', 'text', false) . '&nbsp;</label> ' . ENTRY_ANTIROBOTREG_TEXT;
      }
?>
  </div> <br />
<?php
        }
// EOF Anti Robot Registration v2.6
?>
    <?php echo tep_image_submit('button_continue.png', IMAGE_BUTTON_CONTINUE, 'id="continue"'); ?>
<?php
  }
?>
  </div></form>