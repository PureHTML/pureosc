<?php
/*
  $Id: account_edit.php,v 1.65 2003/06/09 23:03:52 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');
  
// BOF Anti Robot Validation v2.6
  if (ACCOUNT_VALIDATION == 'true' && ACCOUNT_EDIT_VALIDATION == 'true') {
    require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ACCOUNT_VALIDATION);
    include_once('includes/functions/' . FILENAME_ACCOUNT_VALIDATION);
  }
// EOF Anti Robot Registration v2.6

  if (!tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

// needs to be included earlier to set the success message in the messageStack
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ACCOUNT_EDIT);

  if (isset($_POST['action']) && ($_POST['action'] == 'process')) {
    if (ACCOUNT_GENDER == 'true') $gender = tep_db_prepare_input($_POST['gender']);
    $firstname = tep_db_prepare_input($_POST['firstname']);
    $lastname = tep_db_prepare_input($_POST['lastname']);
    if (ACCOUNT_DOB == 'true') $dob = tep_db_prepare_input($_POST['dob']);
    $email_address = tep_db_prepare_input($_POST['email_address']);
    $telephone = tep_db_prepare_input($_POST['telephone']);
    $fax = tep_db_prepare_input($_POST['fax']);

    //PIVACF start
      if (ACCOUNT_CF == 'true') $cf = tep_db_prepare_input($_POST['cf']);
    //PIVACF end

    $error = false;

    if (ACCOUNT_GENDER == 'true') {
      if ( ($gender != 'm') && ($gender != 'f') ) {
        $error = true;

        $messageStack->add('account_edit', ENTRY_GENDER_ERROR);
      }
    }

    //PIVACF start
	if ((ACCOUNT_CF == 'true') && ((int)$country == '105')) {
	  if (($cf == "") && (ACCOUNT_CF_REQ == 'true')) {
	    $error = true;
		$messageStack->add('account_edit', ENTRY_CF_ERROR);
	  } else if ((strlen($cf) != 16) && ($cf != "")) {
	    $error = true;
		$messageStack->add('account_edit', ENTRY_CF_ERROR);
	  } else if (strlen($cf) == 16) {
		$cf = strtoupper($cf);
		if( ! ereg("^[A-Z0-9]+$", $cf) ){
		  $error = true;
		  $messageStack->add('account_edit', ENTRY_CF_ERROR);
	    } else { 
		  $s = 0;
		  for( $i = 1; $i <= 13; $i += 2 ){
		    $c = $cf[$i];
		    if( '0' <= $c && $c <= '9' )
			  $s += ord($c) - ord('0');
		    else
			  $s += ord($c) - ord('A');
		  }
		  for( $i = 0; $i <= 14; $i += 2 ){
		    $c = $cf[$i];
		    switch( $c ){
		      case '0':  $s += 1;  break;
		      case '1':  $s += 0;  break;
		      case '2':  $s += 5;  break;
		      case '3':  $s += 7;  break;
		      case '4':  $s += 9;  break;
		      case '5':  $s += 13;  break;
		      case '6':  $s += 15;  break;
		      case '7':  $s += 17;  break;
		      case '8':  $s += 19;  break;
		      case '9':  $s += 21;  break;
		      case 'A':  $s += 1;  break;
		      case 'B':  $s += 0;  break;
		      case 'C':  $s += 5;  break;
		      case 'D':  $s += 7;  break;
		      case 'E':  $s += 9;  break;
		      case 'F':  $s += 13;  break;
		      case 'G':  $s += 15;  break;
		      case 'H':  $s += 17;  break;
		      case 'I':  $s += 19;  break;
		      case 'J':  $s += 21;  break;
		      case 'K':  $s += 2;  break;
		      case 'L':  $s += 4;  break;
		      case 'M':  $s += 18;  break;
		      case 'N':  $s += 20;  break;
		      case 'O':  $s += 11;  break;
		      case 'P':  $s += 3;  break;
		      case 'Q':  $s += 6;  break;
		      case 'R':  $s += 8;  break;
		      case 'S':  $s += 12;  break;
		      case 'T':  $s += 14;  break;
		      case 'U':  $s += 16;  break;
		      case 'V':  $s += 10;  break;
		      case 'W':  $s += 22;  break;
		      case 'X':  $s += 25;  break;
		      case 'Y':  $s += 24;  break;
		      case 'Z':  $s += 23;  break;
		    }
	      }
	      if( chr($s%26 + ord('A')) != $cf[15] ){
		    $error = true;
		    $messageStack->add('account_edit', ENTRY_CF_ERROR);
		  }
	    }
	  }
    }
    //PIVACF end

    if (strlen($firstname) < ENTRY_FIRST_NAME_MIN_LENGTH) {
      $error = true;

      $messageStack->add('account_edit', ENTRY_FIRST_NAME_ERROR);
    }

    if (strlen($lastname) < ENTRY_LAST_NAME_MIN_LENGTH) {
      $error = true;

      $messageStack->add('account_edit', ENTRY_LAST_NAME_ERROR);
    }

    if (ACCOUNT_DOB == 'true') {
      if (!checkdate(substr(tep_date_raw($dob), 4, 2), substr(tep_date_raw($dob), 6, 2), substr(tep_date_raw($dob), 0, 4))) {
        $error = true;

        $messageStack->add('account_edit', ENTRY_DATE_OF_BIRTH_ERROR);
      }
    }

    if (strlen($email_address) < ENTRY_EMAIL_ADDRESS_MIN_LENGTH) {
      $error = true;

      $messageStack->add('account_edit', ENTRY_EMAIL_ADDRESS_ERROR);
    }

    if (!tep_validate_email($email_address)) {
      $error = true;

      $messageStack->add('account_edit', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
    }

    $check_email_query = tep_db_query("select count(*) as total from " . TABLE_CUSTOMERS . " where customers_email_address = '" . tep_db_input($email_address) . "' and customers_id != '" . (int)$customer_id . "'");
    $check_email = tep_db_fetch_array($check_email_query);
    if ($check_email['total'] > 0) {
      $error = true;

      $messageStack->add('account_edit', ENTRY_EMAIL_ADDRESS_ERROR_EXISTS);
    }

    if (strlen($telephone) < ENTRY_TELEPHONE_MIN_LENGTH) {
      $error = true;

      $messageStack->add('account_edit', ENTRY_TELEPHONE_NUMBER_ERROR);
    }

// BOF Anti Robot Registration v2.6
    if (ACCOUNT_VALIDATION == 'true' && ACCOUNT_EDIT_VALIDATION == 'true') {
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
      if ($entry_antirobotreg_error == true) $messageStack->add('account_edit', $text_antirobotreg_error);
    }
// EOF Anti Robot Registration v2.6

    if ($error == false) {
      $sql_data_array = array('customers_firstname' => $firstname,
                              'customers_lastname' => $lastname,
                              'customers_email_address' => $email_address,
                              'customers_telephone' => $telephone,
                              'customers_fax' => $fax);

      if (ACCOUNT_GENDER == 'true') $sql_data_array['customers_gender'] = $gender;
      if (ACCOUNT_DOB == 'true') $sql_data_array['customers_dob'] = tep_date_raw($dob);

      tep_db_perform(TABLE_CUSTOMERS, $sql_data_array, 'update', "customers_id = '" . (int)$customer_id . "'");

      tep_db_query("update " . TABLE_CUSTOMERS_INFO . " set customers_info_date_account_last_modified = now() where customers_info_id = '" . (int)$customer_id . "'");

      $sql_data_array = array('entry_firstname' => $firstname,
                              'entry_lastname' => $lastname);

      //PIVACF start
	  if (ACCOUNT_CF == 'true') $sql_data_array['entry_cf'] = $cf;
	  $sql_data_array['entry_gender'] = $gender;
      //PIVACF end

      tep_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array, 'update', "customers_id = '" . (int)$customer_id . "' and address_book_id = '" . (int)$customer_default_address_id . "'");

// reset the session variables
      $customer_first_name = $firstname;

      $messageStack->add_session('account', SUCCESS_ACCOUNT_UPDATED, 'success');

      tep_redirect(tep_href_link(FILENAME_ACCOUNT, '', 'SSL'));
    }
  }

  //PIVACF start
// $account_query = tep_db_query("select   customers_gender,   customers_firstname,   customers_lastname,   customers_dob,   customers_email_address,   customers_telephone,   customers_fax             from " . TABLE_CUSTOMERS . "                                                                                                where                                       customers_id = '" . (int)$customer_id . "'");
   $account_query = tep_db_query("select c.customers_gender, c.customers_firstname, c.customers_lastname, c.customers_dob, c.customers_email_address, c.customers_telephone, c.customers_fax, a.entry_cf from " . TABLE_CUSTOMERS . " c left join " . TABLE_ADDRESS_BOOK . " a on c.customers_default_address_id = a.address_book_id where a.customers_id = c.customers_id and c.customers_id = '" . (int)$customer_id . "'");
  //PIVACF end

  $account = tep_db_fetch_array($account_query);

  $breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_ACCOUNT, '', 'SSL'));
  $breadcrumb->add(NAVBAR_TITLE_2, tep_href_link(FILENAME_ACCOUNT_EDIT, '', 'SSL'));

  $content = basename($_SERVER['PHP_SELF']);
  while (strstr($content, '.php')) $content = str_replace('.php', '', $content);

  $javascript = 'form_check.js.php';

  include (bts_select('main', $content_template)); // BTSv1.5

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>