<h1 class="pageHeading">
  <?php echo tep_image_2ma_template(bts_select(images, 'table_background_account.png'), HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?>
  <?php
//jsp:pwa:orig echo HEADING_TITLE;
            // PWA BOF
            if (!isset($HTTP_GET_VARS['guest']) && !isset($HTTP_POST_VARS['guest'])){
            HEADING_TITLE;
            }else{
            echo HEADING_TITLE_PWA;
            }
            // PWA EOF
            ?>
</h1> <br />

<?php echo tep_draw_form('create_account', tep_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL'), 'post', 'onsubmit="return check_form(create_account);"') . tep_draw_hidden_field('action', 'process'); ?>
<br />
  <?php echo sprintf(TEXT_ORIGIN_LOGIN, tep_href_link(FILENAME_LOGIN, tep_get_all_get_params(), 'SSL')); ?> <br />
<?php
  if ($messageStack->size('create_account') > 0) {
?>
  <?php echo $messageStack->output('create_account'); ?> <br/>
<?php
  }
?>
  <p class="ColorRed"> <?php echo FORM_REQUIRED_INFORMATION; ?> </p>
  <div class="AlignLeft">
  <h2 class="b"><?php echo CATEGORY_OPTIONS; ?></h2>
  <div class="InfoBoxContenent2MA">
    <?php echo tep_draw_checkbox_field_label(ENTRY_NEWSLETTER, 'news_you', 'newsletter', '1') . '&nbsp;' . (tep_not_null(ENTRY_NEWSLETTER_TEXT) ? '<span class="ColorRed">' . ENTRY_NEWSLETTER_TEXT . '</span>': ''); ?> <br />
    <?php 
if(READ_PRIVACY_REQUIRED==1)
echo tep_draw_checkbox_field_label(ENTRY_PRIVACY, 'read_ok', 'privacy_confirm', '1') . '&nbsp;' . (tep_not_null(ENTRY_PRIVACY_TEXT) ? '<span class="ColorRed">' . ENTRY_PRIVACY_TEXT . '</span>': ''); ?> <br />
  </div>
<br />
  <h2 class="b"> <?php echo CATEGORY_PERSONAL; ?> </h2>
  <div class="InfoBoxContenent2MA">
<?php
  if (ACCOUNT_GENDER == 'true') {
?>
    <?php echo ENTRY_GENDER; ?> &nbsp; 
    <?php echo tep_draw_radio_field_label(MALE, 'gender_m', 'gender', 'm') . '&nbsp;&nbsp;' . tep_draw_radio_field_label(FEMALE, 'gender_f', 'gender', 'f') . '&nbsp;' . (tep_not_null(ENTRY_GENDER_TEXT) ? '<span class="ColorRed">' . ENTRY_GENDER_TEXT . '</span>': ''); ?> <br />
<?php
  }
?>
     <?php echo tep_draw_input_field_label(ENTRY_FIRST_NAME, true, 'firstname', ENTRY_FIRST_NAME) . '&nbsp;' . (tep_not_null(ENTRY_FIRST_NAME_TEXT) ? '<span class="ColorRed">' . ENTRY_FIRST_NAME_TEXT . '</span>': ''); ?> 
     <br />
     <?php echo tep_draw_input_field_label(ENTRY_LAST_NAME, true, 'lastname', ENTRY_LAST_NAME) . '&nbsp;' . (tep_not_null(ENTRY_LAST_NAME_TEXT) ? '<span class="ColorRed">' . ENTRY_LAST_NAME_TEXT . '</span>': ''); ?> 
     <br />
<?php
  if (ACCOUNT_DOB == 'true') {
?>
      <?php echo tep_draw_input_field_label(ENTRY_DATE_OF_BIRTH, true, 'dob', ENTRY_DATE_OF_BIRTH) . '&nbsp;' . (tep_not_null(ENTRY_DATE_OF_BIRTH_TEXT) ? '<span class="ColorRed">' . ENTRY_DATE_OF_BIRTH_TEXT . '</span>': ''); ?> 
      <br />
<?php
  }
?>
    <?php echo tep_draw_input_field_label(ENTRY_EMAIL_ADDRESS, true, 'email_address', ENTRY_EMAIL_ADDRESS) . '&nbsp;' . (tep_not_null(ENTRY_EMAIL_ADDRESS_TEXT) ? '<span class="ColorRed">' . ENTRY_EMAIL_ADDRESS_TEXT . '</span>': ''); ?> 
    <br />


  </div>
<?php
  if (ACCOUNT_COMPANY == 'true') {
?>
  <h2 class="b"><?php echo CATEGORY_COMPANY; ?></h2>
  <div class="InfoBoxContenent2MA">
    <?php echo tep_draw_input_field_label(ENTRY_COMPANY, false, 'company') . '&nbsp;' . (tep_not_null(ENTRY_COMPANY_TEXT) ? '<span class="ColorRed">' . ENTRY_COMPANY_TEXT . '</span>': ''); ?> 
    <br />

<?php // PIVACF BOF
if (ACCOUNT_PIVA == 'true') { ?>
  <?php echo tep_draw_input_field_label(ENTRY_PIVA, false, 'piva') . '&nbsp;' . ((tep_not_null(ENTRY_PIVA_TEXT) && (ACCOUNT_PIVA_REQ == 'true')) ? '<span class="inputRequirement">' . ENTRY_PIVA_TEXT . '</span>': ''); ?> 
  <br />
<?php
} // PIVACF ENF
?>
<?php // PIVACF BOF
if (ACCOUNT_CF == 'true') {?>							
  <?php echo tep_draw_input_field_label(ENTRY_CF, false, 'cf') . '&nbsp;' . ((tep_not_null(ENTRY_CF_TEXT) && (ACCOUNT_CF_REQ == 'true')) ? '<span class="inputRequirement">' . ENTRY_CF_TEXT . '</span>': ''); ?> 
  <br />
<?php
} // PIVACF ENF
?>

  </div>
<?php
  }
?>
  <h2 class="b"><?php echo CATEGORY_ADDRESS; ?></h2>
  <div class="InfoBoxContenent2MA">
    <?php echo tep_draw_input_field_label(ENTRY_STREET_ADDRESS, true, 'street_address', ENTRY_STREET_ADDRESS) . '&nbsp;' . (tep_not_null(ENTRY_STREET_ADDRESS_TEXT) ? '<span class="ColorRed">' . ENTRY_STREET_ADDRESS_TEXT . '</span>': ''); ?> 
    <br />
<?php
  if (ACCOUNT_SUBURB == 'true') {
?>
    <?php echo tep_draw_input_field_label(ENTRY_SUBURB, true,'suburb',ENTRY_SUBURB) . '&nbsp;' . (tep_not_null(ENTRY_SUBURB_TEXT) ? '<span class="ColorRed">' . ENTRY_SUBURB_TEXT . '</span>': ''); ?> 
    <br />
<?php
  }
?>
    <?php echo tep_draw_input_field_label(ENTRY_POST_CODE, true, 'postcode', ENTRY_POST_CODE) . '&nbsp;' . (tep_not_null(ENTRY_POST_CODE_TEXT) ? '<span class="ColorRed">' . ENTRY_POST_CODE_TEXT . '</span>': ''); ?> 
    <br />
    <?php echo tep_draw_input_field_label(ENTRY_CITY, true, 'city', ENTRY_CITY) . '&nbsp;' . (tep_not_null(ENTRY_CITY_TEXT) ? '<span class="ColorRed">' . ENTRY_CITY_TEXT . '</span>': ''); ?> 
    <br />
<?php
  if (ACCOUNT_STATE == 'true') {
    if ($process == true) {
      if ($entry_state_has_zones == true) {
        $zones_array = array();
        $zones_query = tep_db_query("select zone_name from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "' order by zone_name");
        while ($zones_values = tep_db_fetch_array($zones_query)) {
          $zones_array[] = array('id' => $zones_values['zone_name'], 'text' => $zones_values['zone_name']);
        }
        echo tep_draw_pull_down_menu_label(ENTRY_STATE, 'list_state', 'state', $zones_array);
      } else {
        echo tep_draw_input_field_label(ENTRY_STATE, true, 'state', ENTRY_STATE);
      }
    } else {
      echo tep_draw_input_field_label(ENTRY_STATE, true, 'state', ENTRY_STATE);
    }

    if (tep_not_null(ENTRY_STATE_TEXT)) echo '&nbsp;<span class="ColorRed">' . ENTRY_STATE_TEXT . '</span>';
?>
<br />
<?php
  }
?>
    <?php echo ENTRY_COUNTRY; ?>&nbsp;
    <?php echo tep_get_country_list('country') . '&nbsp;' . (tep_not_null(ENTRY_COUNTRY_TEXT) ? '<span class="ColorRed">' . ENTRY_COUNTRY_TEXT . '</span>': ''); ?> <br />
  </div>
  <h2 class="b"><?php echo CATEGORY_CONTACT; ?></h2>
  <div class="InfoBoxContenent2MA">
    <?php echo tep_draw_input_field_label(ENTRY_TELEPHONE_NUMBER, true, 'telephone', ENTRY_TELEPHONE_NUMBER) . '&nbsp;' . (tep_not_null(ENTRY_TELEPHONE_NUMBER_TEXT) ? '<span class="ColorRed">' . ENTRY_TELEPHONE_NUMBER_TEXT . '</span>': ''); ?> 
    <br />
    <?php echo tep_draw_input_field_label(ENTRY_FAX_NUMBER, true, 'fax', ENTRY_FAX_NUMBER) . '&nbsp;' . (tep_not_null(ENTRY_FAX_NUMBER_TEXT) ? '<span class="ColorRed">' . ENTRY_FAX_NUMBER_TEXT . '</span>': ''); ?> 
    <br />
  </div>
  <h2 class="b"><?php echo CATEGORY_PASSWORD; ?></h2>
  <div class="InfoBoxContenent2MA">
    <?php echo tep_draw_password_field_label(ENTRY_PASSWORD, false, 'password') . '&nbsp;' . (tep_not_null(ENTRY_PASSWORD_TEXT) ? '<span class="ColorRed">' . ENTRY_PASSWORD_TEXT . '</span>': ''); ?> 
    <br />
    <?php echo tep_draw_password_field_label(ENTRY_PASSWORD_CONFIRMATION, false, 'confirmation') . '&nbsp;' . (tep_not_null(ENTRY_PASSWORD_CONFIRMATION_TEXT) ? '<span class="ColorRed">' . ENTRY_PASSWORD_CONFIRMATION_TEXT . '</span>': ''); ?> 
    <br />
  </div>
  
  
<!-- // BOF Anti Robot Registration v2.6-->
<?php
    if (ACCOUNT_VALIDATION == 'true' && strstr($PHP_SELF,'create_account') &&  ACCOUNT_CREATE_VALIDATION == 'true') {
?>
    <h2 class="b"><?php echo CATEGORY_ANTIROBOTREG; ?></h2>
  <div class="InfoBoxContenent2MA">
<?php
      if (ACCOUNT_VALIDATION == 'true' && strstr($PHP_SELF,'create_account') &&  ACCOUNT_CREATE_VALIDATION == 'true') {
        if ($is_read_only == false || (strstr($PHP_SELF,'create_account')) ) {
          $sql = "DELETE FROM " . TABLE_ANTI_ROBOT_REGISTRATION . " WHERE timestamp < '" . (time() - 3600) . "' OR session_id = '" . tep_session_id() . "'";
          if( !$result = tep_db_query($sql) ) { die('Could not delete validation key'); }
            $reg_key = gen_reg_key();
            $sql = "INSERT INTO ". TABLE_ANTI_ROBOT_REGISTRATION . " VALUES ('" . tep_session_id() . "', '" . $reg_key . "', '" . time() . "')";
            if( !$result = tep_db_query($sql) ) { die('Could not check registration information'); }
              echo '&nbsp;&nbsp;';
              echo '<a href="mailto:' . STORE_OWNER_EMAIL_ADDRESS . '?subject= ' . EMAIL_TITLE_HANDICAP . '&body= ' . EMAIL_BODY_HANDICAP 
                   . ', ' . ENTRY_GENDER
                   . ', ' . ENTRY_FIRST_NAME
                   . ', ' . ENTRY_DATE_OF_BIRTH
                   . ', ' . ENTRY_EMAIL_ADDRESS
                   . ', ' . CATEGORY_ADDRESS
                   . ', ' . ENTRY_SUBURB
                   . ', ' . ENTRY_POST_CODE
                   . ', ' . ENTRY_CITY
                   . ', ' . ENTRY_STATE
                   . ', ' . ENTRY_COUNTRY
                   . '" >' . tep_image(DIR_WS_ICONS . 'handicap.png', EMAIL_TITLE_HANDICAP) 
                   . EMAIL_TITLE_HANDICAP . '</a>' ;
              echo '<br />' . '<label for="anti_robot_reg">' . ENTRY_ANTIROBOTREG . '<br />';
              $check_anti_robotreg_query = tep_db_query("select session_id, reg_key, timestamp from  " . TABLE_ANTI_ROBOT_REGISTRATION . "  where session_id = '" . tep_session_id() . "'");
              $new_guery_anti_robotreg = tep_db_fetch_array($check_anti_robotreg_query);
              $validation_images = '<br />' . tep_image_2ma('validation_png.php?rsid=' . $new_guery_anti_robotreg['session_id']);
              echo $validation_images . ' <br /> <br />' ;
              echo tep_draw_input_field('antirobotreg', $account['entry_antirobotreg'], ' id="anti_robot_reg" ', 'text', false) . '&nbsp;</label> ' . ENTRY_ANTIROBOTREG_TEXT;
            }
          }
echo '  </div><br />';
        }
?>
<!-- // EOF Anti Robot Registration v2.6-->

<?php echo tep_image_submit('button_continue.png', IMAGE_BUTTON_CONTINUE, 'id="continue"'); ?>
  </div>         
</form>