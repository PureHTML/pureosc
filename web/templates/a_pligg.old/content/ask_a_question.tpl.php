  <?php echo tep_draw_form('email_friend', tep_href_link(FILENAME_ASK_QUESTION, 'action=process' . SEPARATOR_LINK . 'products_id=' . $_GET['products_id'])); ?> 
  <h1 class="pageHeading">
  <?php echo tep_image(DIR_WS_IMAGES . $product_info['products_image'], $product_info['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT); ?><br />
  <?php echo sprintf(HEADING_TITLE, $product_info['products_name']); ?> - (<?php echo $product_info['products_model'] ?>)
  </h1>

<?php
  if ($messageStack->size('friend') > 0) {
?>
  <?php echo $messageStack->output('friend'); ?> <br />
<?php
  }
?>
<div class="AlignLeft">
  <h2><?php echo FORM_TITLE_CUSTOMER_DETAILS; ?></h2>
<div class="InfoBoxContenent2MA">
  <?php echo tep_draw_input_field_label(FORM_FIELD_CUSTOMER_NAME, false, 'from_name'); ?><br />
  <?php echo tep_draw_input_field_label(FORM_FIELD_CUSTOMER_EMAIL, false, 'from_email_address');?>

  <?php echo tep_draw_hidden_field('to_email_address', STORE_OWNER_EMAIL_ADDRESS) ; ?>
  <?php echo tep_draw_hidden_field('to_name', STORE_OWNER); ?>
</div>
  <h2><?php echo FORM_TITLE_FRIEND_MESSAGE; ?></h2>
<div class="InfoBoxContenent2MA">
  <?php echo tep_draw_textarea_field('message', '40', '8'); ?>
</div> <br />

<?php
// BOF Anti Robot Registration v2.6
  if (ACCOUNT_VALIDATION == 'true' && strstr($PHP_SELF,'ask_a_question') &&  ACCOUNT_INFO_PRODUCT_VALIDATION == 'true') {
?>
  <h2 class="b"><?php echo CATEGORY_ANTIROBOTREG; ?></h2>
  <div class="InfoBoxContenent2MA">
<?php
      if ($is_read_only == false || (strstr($PHP_SELF,'ask_a_question')) ) {
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
<br />
</div>

<div class="CinquantaL">
    <?php echo '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $_GET['products_id']) . '">' . tep_image_button('button_back.png', IMAGE_BUTTON_BACK) . '</a>'; ?>
</div>

<div class="CinquantaR">
    <?php echo tep_image_submit('button_continue.png', IMAGE_BUTTON_CONTINUE); ?>
</div>

  </form>