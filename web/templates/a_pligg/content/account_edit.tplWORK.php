<?php echo tep_draw_form('account_edit', tep_href_link(FILENAME_ACCOUNT_EDIT, '', 'SSL'), 'post', 'onsubmit="return check_form(account_edit);"') . tep_draw_hidden_field('action', 'process'); ?>
<h1 class="pageHeading">
  <?php echo tep_image_2ma_template(bts_select(images, 'table_background_account.png'), HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?>
  <?php echo HEADING_TITLE; ?></h1><br />
<?php
  if ($messageStack->size('account_edit') > 0) {
?>
   <?php echo $messageStack->output('account_edit'); ?>
<?php
  }
?>
<div class="AlignLeft">
  <h2 class="b"><?php echo MY_ACCOUNT_TITLE; ?></h2>
  <h3 class="inputRequirement"><?php echo FORM_REQUIRED_INFORMATION; ?></h3>
  <div class="InfoBoxContenent2MA">
<?php
  if (ACCOUNT_GENDER == 'true') {
    if (isset($gender)) {
      $male = ($gender == 'm') ? true : false;
    } else {
      $male = ($account['customers_gender'] == 'm') ? true : false;
    }
    $female = !$male;
?>
  <?php echo ENTRY_GENDER; ?> &nbsp; 
  <?php echo tep_draw_radio_field_label(MALE, 'gender_m', 'gender', 'm', $male) . '&nbsp;&nbsp;' . tep_draw_radio_field_label(FEMALE, 'gender_f', 'gender', 'f', $female) . '&nbsp;' . (tep_not_null(ENTRY_GENDER_TEXT) ? '<span class="inputRequirement">' . ENTRY_GENDER_TEXT . '</span>': ''); ?><br />
<?php
  }
?>
  <?php echo tep_draw_input_field_label(ENTRY_FIRST_NAME, false, 'firstname', $account['customers_firstname']) . '&nbsp;' . (tep_not_null(ENTRY_FIRST_NAME_TEXT) ? '<span class="inputRequirement">' . ENTRY_FIRST_NAME_TEXT . '</span>': ''); ?><br />
  <?php echo tep_draw_input_field_label(ENTRY_LAST_NAME, false, 'lastname', $account['customers_lastname']) . '&nbsp;' . (tep_not_null(ENTRY_LAST_NAME_TEXT) ? '<span class="inputRequirement">' . ENTRY_LAST_NAME_TEXT . '</span>': ''); ?><br />

<?php // PIVACF BOF
  if (ACCOUNT_CF == 'true') {
?>
  <?php echo tep_draw_input_field_label(ENTRY_CF, false, 'cf', $account['entry_cf']) . '&nbsp;' . ((tep_not_null(ENTRY_CF_TEXT) && (ACCOUNT_CF_REQ=='true')) ? '<span class="inputRequirement">' . ENTRY_CF_TEXT . '</span>': ''); ?><br />
<?php
  } // PIVACF EOF
?>

<?php
  if (ACCOUNT_DOB == 'true') {
?>

  <?php echo tep_draw_input_field_label(ENTRY_DATE_OF_BIRTH, false, 'dob', tep_date_short($account['customers_dob'])) . '&nbsp;' . (tep_not_null(ENTRY_DATE_OF_BIRTH_TEXT) ? '<span class="inputRequirement">' . ENTRY_DATE_OF_BIRTH_TEXT . '</span>': ''); ?><br />
<?php
  }
?>
  <?php echo tep_draw_input_field_label(ENTRY_EMAIL_ADDRESS, false, 'email_address', $account['customers_email_address']) . '&nbsp;' . (tep_not_null(ENTRY_EMAIL_ADDRESS_TEXT) ? '<span class="inputRequirement">' . ENTRY_EMAIL_ADDRESS_TEXT . '</span>': ''); ?><br />
  <?php echo tep_draw_input_field_label(ENTRY_TELEPHONE_NUMBER, false, 'telephone', $account['customers_telephone']) . '&nbsp;' . (tep_not_null(ENTRY_TELEPHONE_NUMBER_TEXT) ? '<span class="inputRequirement">' . ENTRY_TELEPHONE_NUMBER_TEXT . '</span>': ''); ?><br />

  <?php echo tep_draw_input_field_label(ENTRY_FAX_NUMBER, false, 'fax', $account['customers_fax']) . '&nbsp;' . (tep_not_null(ENTRY_FAX_NUMBER_TEXT) ? 
'<span class="inputRequirement">' . ENTRY_FAX_NUMBER_TEXT . '</span>': ''); ?><br />
<!--shop2.0brain:new: ico-dic //-->
  <?php echo tep_draw_input_field_label(ENTRY_COMPANY, false, 'company', $account['entry_company']) . '&nbsp;' . (tep_not_null(ENTRY_COMPANY_TEXT) ? 
'<span class="inputRequirement">' . ENTRY_COMPANY_TEXT . '</span>': ''); ?><br />

  <?php echo tep_draw_input_field_label(ENTRY_ICO, false, 'ico', $account['entry_ico']) . '&nbsp;' . (tep_not_null(ENTRY_ICO_TEXT) ? 
'<span class="inputRequirement">' . ENTRY_ICO_TEXT . '</span>': ''); ?><br />

  <?php echo tep_draw_input_field_label(ENTRY_DIC, false, 'dic', $account['entry_dic']) . '&nbsp;' . (tep_not_null(ENTRY_DIC_TEXT) ? 
'<span class="inputRequirement">' . ENTRY_DIC_TEXT . '</span>': ''); ?><br />

</div>

<!-- // BOF Anti Robot Registration v2.6-->
<?php
  if (ACCOUNT_VALIDATION == 'true' && strstr($PHP_SELF,'account_edit') &&  ACCOUNT_EDIT_VALIDATION == 'true') {
?>
  <br />
  <h2 class="b"><?php echo CATEGORY_ANTIROBOTREG; ?></h2>
  <div class="InfoBoxContenent2MA">
<?php
      if ($is_read_only == false || (strstr($PHP_SELF,'account_edit')) ) {
        $sql = "DELETE FROM " . TABLE_ANTI_ROBOT_REGISTRATION . " WHERE timestamp < '" . (time() - 3600) . "' OR session_id = '" . tep_session_id() . "'";
        if( !$result = tep_db_query($sql) ) { die('Could not delete validation key'); }
        $reg_key = gen_reg_key();
        $sql = "INSERT INTO ". TABLE_ANTI_ROBOT_REGISTRATION . " VALUES ('" . tep_session_id() . "', '" . $reg_key . "', '" . time() . "')";
        if( !$result = tep_db_query($sql) ) { die('Could not check registration information'); }
  echo '<label for="anti_robot_reg">' . ENTRY_ANTIROBOTREG . '<br />'; 
          $check_anti_robotreg_query = tep_db_query("select session_id, reg_key, timestamp from " . TABLE_ANTI_ROBOT_REGISTRATION . " where session_id = '" . tep_session_id() . "'");
          $new_guery_anti_robotreg = tep_db_fetch_array($check_anti_robotreg_query);
          $validation_images = '<br />' . tep_image_2ma('validation_png.php?rsid=' . $new_guery_anti_robotreg['session_id']);
          echo $validation_images . ' <br /> <br />' ;
          echo tep_draw_input_field('antirobotreg', $account['entry_antirobotreg'], ' id="anti_robot_reg" ', 'text', false) . '&nbsp;</label> ' . ENTRY_ANTIROBOTREG_TEXT;
        }
?>
  </div>
<?php
    }
?>
<!-- // EOF Anti Robot Registration v2.6-->

<br />

<div class="CinquantaL">
  <?php echo '<a href="' . tep_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . tep_image_button('button_back.png', IMAGE_BUTTON_BACK) . '</a>'; ?>
</div>

<div class="CinquantaR">
  <?php echo tep_image_submit('button_continue.png', IMAGE_BUTTON_CONTINUE, 'id="continue"'); ?>
</div>

    </div></form>