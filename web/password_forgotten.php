<?php
/*
  $Id: password_forgotten.php,v 1.50 2003/06/05 23:28:24 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');
  
// BOF Anti Robot Registration v2.6
  if (ACCOUNT_VALIDATION == 'true' && ACCOUNT_PASSWORD_FORGOTTEN_VALIDATION == 'true') {
    require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ACCOUNT_VALIDATION);
    include_once('includes/functions/' . FILENAME_ACCOUNT_VALIDATION);
  }
// EOF Anti Robot Registration v2.6

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_PASSWORD_FORGOTTEN);

  if (isset($_GET['action']) && ($_GET['action'] == 'process')) {
  
// BOF Anti Robot Registration v2.6
    if (ACCOUNT_VALIDATION == 'true' && ACCOUNT_PASSWORD_FORGOTTEN_VALIDATION == 'true') {
      $sql = "SELECT * FROM " . TABLE_ANTI_ROBOT_REGISTRATION . " WHERE session_id = '" . tep_session_id() . "' LIMIT 1";
      if( !$result = tep_db_query($sql) ) {
        $error = true;
        $entry_antirobotreg_error = true;
        $text_antirobotreg_error = ERROR_VALIDATION_1;
      } else {
        $entry_antirobotreg_error = false;
        $anti_robot_row = tep_db_fetch_array($result);
        if (( strtoupper($_POST['antirobotreg']) != $anti_robot_row['reg_key'] ) || ($anti_robot_row['reg_key'] == '') || (strlen($antirobotreg) != ENTRY_VALIDATION_LENGTH)) {
          $error = true;
          $entry_antirobotreg_error = true;
          $text_antirobotreg_error = ERROR_VALIDATION_2;
        } else {
          $sql = "DELETE FROM " . TABLE_ANTI_ROBOT_REGISTRATION . " WHERE session_id = '" . tep_session_id() . "'";
          if( !$result = tep_db_query($sql) ) {
            $error = true;
            $entry_antirobotreg_error = true;
            $text_antirobotreg_error = ERROR_VALIDATION_3;
          } else {
            $sql = "OPTIMIZE TABLE " . TABLE_ANTI_ROBOT_REGISTRATION . "";
            if( !$result = tep_db_query($sql) ) {
              $error = true;
              $entry_antirobotreg_error = true;
              $text_antirobotreg_error = ERROR_VALIDATION_4;
            } else {
              $entry_antirobotreg_error = false;
            }
          }
        }
      }
      if ($entry_antirobotreg_error == true) $messageStack->add('password_forgotten', $text_antirobotreg_error);
    }
// EOF Anti Robot Registration v2.6
  
    $email_address = tep_db_prepare_input($_POST['email_address']);

    $check_customer_query = tep_db_query("select customers_firstname, customers_lastname, customers_password, customers_id from " . TABLE_CUSTOMERS . " where customers_email_address = '" . tep_db_input($email_address) . "'");
    if (tep_db_num_rows($check_customer_query) && (!$entry_antirobotreg_error == true)) {
//    if (tep_db_num_rows($check_customer_query)) {
      $check_customer = tep_db_fetch_array($check_customer_query);

      $new_password = tep_create_random_value(ENTRY_PASSWORD_MIN_LENGTH);
      $crypted_password = tep_encrypt_password($new_password);

      tep_db_query("update " . TABLE_CUSTOMERS . " set customers_password = '" . tep_db_input($crypted_password) . "' where customers_id = '" . (int)$check_customer['customers_id'] . "'");

      tep_mail($check_customer['customers_firstname'] . ' ' . $check_customer['customers_lastname'], $email_address, EMAIL_PASSWORD_REMINDER_SUBJECT, sprintf(EMAIL_PASSWORD_REMINDER_BODY, $new_password), STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);

      $messageStack->add_session('login', SUCCESS_PASSWORD_SENT, 'success');

      tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
    } elseif (!tep_validate_email($email_address)) {
//    else {
      $messageStack->add('password_forgotten', TEXT_NO_EMAIL_ADDRESS_FOUND);
    }
  }

  $breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  $breadcrumb->add(NAVBAR_TITLE_2, tep_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL'));

  $content = basename($_SERVER['PHP_SELF']);
  while (strstr($content, '.php')) $content = str_replace('.php', '', $content);

  $javascript = 'remove_label.js';
  include (bts_select('main', $content_template)); // BTSv1.5

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>