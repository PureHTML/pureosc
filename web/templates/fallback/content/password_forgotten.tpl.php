 <?php echo tep_draw_form('password_forgotten', tep_href_link(FILENAME_PASSWORD_FORGOTTEN, 'action=process', 'SSL')); ?>
<h1 class="pageHeading">
  <?php echo tep_image_2ma_template(bts_select(images, 'table_background_password_forgotten.png'), HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?>
  <?php echo HEADING_TITLE; ?>
</h1> <br />
<div class="AlignLeft">
<?php
  if ($messageStack->size('password_forgotten') > 0) {
?>
  <?php echo $messageStack->output('password_forgotten'); ?>
<?php
  }
?>
  <p class="InfoBoxContenent2MA">
    <?php echo TEXT_MAIN; ?><br />
    <?php echo tep_draw_input_field_label(ENTRY_EMAIL_ADDRESS, true, 'email_address', ENTRY_EMAIL_ADDRESS); ?> 
  </p>
<?php
// BOF Anti Robot Registration v2.6
  if (ACCOUNT_VALIDATION == 'true' && strstr($PHP_SELF,'password_forgotten') &&  ACCOUNT_PASSWORD_FORGOTTEN_VALIDATION == 'true') {
?>
  <h2 class="b"><?php echo CATEGORY_ANTIROBOTREG; ?></h2>
  <p class="InfoBoxContenent2MA">
<?php
      if ($is_read_only == false || (strstr($PHP_SELF,'account_edit')) ) {
        $sql = "DELETE FROM " . TABLE_ANTI_ROBOT_REGISTRATION . " WHERE timestamp < '" . (time() - 3600) . "' OR session_id = '" . tep_session_id() . "'";
        if( !$result = tep_db_query($sql) ) { die('Could not delete validation key'); }
        $reg_key = gen_reg_key();
        $sql = "INSERT INTO ". TABLE_ANTI_ROBOT_REGISTRATION . " VALUES ('" . tep_session_id() . "', '" . $reg_key . "', '" . time() . "')";
        if( !$result = tep_db_query($sql) ) { die('Could not check registration information'); }
?>
   <?php echo '<label for="anti_robot_reg">' . ENTRY_ANTIROBOTREG . '<br />'; ?>
<?php
          $check_anti_robotreg_query = tep_db_query("select session_id, reg_key, timestamp from " . TABLE_ANTI_ROBOT_REGISTRATION . " where session_id = '" . tep_session_id() . "'");
          $new_guery_anti_robotreg = tep_db_fetch_array($check_anti_robotreg_query);
          $validation_images = '<br />' . tep_image_2ma('validation_png.php?rsid=' . $new_guery_anti_robotreg['session_id']);
          echo $validation_images . ' <br /> <br />' ;
          echo tep_draw_input_field('antirobotreg', $account['entry_antirobotreg'], ' id="anti_robot_reg" ', 'text', false) . '&nbsp;</label> ' . ENTRY_ANTIROBOTREG_TEXT;
        }
?>
  </p>
<?php
        }
// EOF Anti Robot Registration v2.6
?>
</div>
<div class="CinquantaL">
    <?php echo '<a href="' . tep_href_link(FILENAME_LOGIN, '', 'SSL') . '">' . tep_image_button('button_back.png', IMAGE_BUTTON_BACK) . '</a>'; ?>
</div>

<div class="CinquantaR">
    <?php echo tep_image_submit('button_continue.png', IMAGE_BUTTON_CONTINUE, 'id="continue"'); ?>
</div>
</form>