<?php echo tep_draw_form('account_password', tep_href_link(FILENAME_ACCOUNT_PASSWORD, '', 'SSL'), 'post', 'onsubmit="return check_form(account_password);"') . tep_draw_hidden_field('action', 'process'); ?>
<h1 class="pageHeading">
  <?php echo tep_image_2ma_template(bts_select(images, 'table_background_account.png'), HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?>
  <?php echo HEADING_TITLE; ?>
</h1><br />
<?php
  if ($messageStack->size('account_password') > 0) {
?>
  <?php echo $messageStack->output('account_password'); ?>
<?php
  }
?>
<div class="AlignLeft">
  <h2 class="b"><?php echo MY_PASSWORD_TITLE; ?></h2> 
  <h3 class="inputRequirement"><?php echo FORM_REQUIRED_INFORMATION; ?></h3>
  <div class="InfoBoxContenent2MA">
    <?php echo tep_draw_password_field_label(ENTRY_PASSWORD_CURRENT, false, 'password_current') . '&nbsp;' . (tep_not_null(ENTRY_PASSWORD_CURRENT_TEXT) ? '<span class="inputRequirement">' . ENTRY_PASSWORD_CURRENT_TEXT . '</span>': ''); ?> 
    <br />
    <?php echo tep_draw_password_field_label(ENTRY_PASSWORD_NEW, false, 'password_new') . '&nbsp;' . (tep_not_null(ENTRY_PASSWORD_NEW_TEXT) ? '<span class="inputRequirement">' . ENTRY_PASSWORD_NEW_TEXT . '</span>': ''); ?> 
    <br />
    <?php echo tep_draw_password_field_label(ENTRY_PASSWORD_CONFIRMATION, false, 'password_confirmation') . '&nbsp;' . (tep_not_null(ENTRY_PASSWORD_CONFIRMATION_TEXT) ? '<span class="inputRequirement">' . ENTRY_PASSWORD_CONFIRMATION_TEXT . '</span>': ''); ?>
  </div> <br />

<!-- // BOF Anti Robot Registration v2.6-->
<?php
  if (ACCOUNT_VALIDATION == 'true' && strstr($PHP_SELF,'account_password') &&  ACCOUNT_EDIT_PASSWORD_VALIDATION == 'true') {
    echo '<h2 class="b">' . CATEGORY_ANTIROBOTREG . '</h2>';
    echo '<div class="InfoBoxContenent2MA">';
      if ($is_read_only == false || (strstr($PHP_SELF,'account_password')) ) {
        $sql = "DELETE FROM " . TABLE_ANTI_ROBOT_REGISTRATION . " WHERE timestamp < '" . (time() - 3600) . "' OR session_id = '" . tep_session_id() . "'";
        if( !$result = tep_db_query($sql) ) { die('Could not delete validation key'); }
        $reg_key = gen_reg_key();
        $sql = "INSERT INTO ". TABLE_ANTI_ROBOT_REGISTRATION . " VALUES ('" . tep_session_id() . "', '" . $reg_key . "', '" . time() . "')";
        if( !$result = tep_db_query($sql) ) { die('Could not check registration information'); }
  echo '<br />' . '<label for="anti_robot_reg">' . ENTRY_ANTIROBOTREG . '<br />'; 
        $check_anti_robotreg_query = tep_db_query("select session_id, reg_key, timestamp from ". TABLE_ANTI_ROBOT_REGISTRATION . " where session_id = '" . tep_session_id() . "'");
        $new_guery_anti_robotreg = tep_db_fetch_array($check_anti_robotreg_query);
        $validation_images = '<br />' . tep_image_2ma('validation_png.php?rsid=' . $new_guery_anti_robotreg['session_id']);
          echo $validation_images . ' <br /> <br />' ;
          echo tep_draw_input_field('antirobotreg', $account['entry_antirobotreg'], ' id="anti_robot_reg" ', 'text', false) . '&nbsp;</label> ' . ENTRY_ANTIROBOTREG_TEXT;

      }
echo '</div><br />';
        }
?>

<!-- // EOF Anti Robot Registration v2.6-->
</div> 
<div class="CinquantaL">
    <?php echo '<a href="' . tep_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . tep_image_button('button_back.png', IMAGE_BUTTON_BACK) . '</a>'; ?>
</div>

<div class="CinquantaR">
    <?php echo tep_image_submit('button_continue.png', IMAGE_BUTTON_CONTINUE, 'id="continue"'); ?>
</div>
  </form>
