<?php
/*
  $Id: create_account.php,v 1.65 2003/06/09 23:03:54 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');
//jsp:pwa start
  if (isset($HTTP_GET_VARS['guest']) && $cart->count_contents() < 1) tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
//jsp:pwa end
// BOF Anti Robot Registration v2.6
  if (ACCOUNT_VALIDATION == 'true' && ACCOUNT_CREATE_VALIDATION == 'true') {
    require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ACCOUNT_VALIDATION);
    include_once('includes/functions/' . FILENAME_ACCOUNT_VALIDATION);
  }
// EOF Anti Robot Registration v2.6

  if (tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_DEFAULT, '', 'NONSSL', false));
  }
  
// needs to be included earlier to set the success message in the messageStack
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CREATE_ACCOUNT);

  $process = false;
  if (isset($_POST['action']) && ($_POST['action'] == 'process')) {
    $process = true;

    if (ACCOUNT_GENDER == 'true') {
      if (isset($_POST['gender'])) {
        $gender = tep_db_prepare_input($_POST['gender']);
      } else {
        $gender = false;
      }
    }
    $firstname = tep_db_prepare_input($_POST['firstname']);
    $lastname = tep_db_prepare_input($_POST['lastname']);
    if (ACCOUNT_DOB == 'true') $dob = tep_db_prepare_input($_POST['dob']);
    $email_address = tep_db_prepare_input($_POST['email_address']);
    if (ACCOUNT_COMPANY == 'true') $company = tep_db_prepare_input($_POST['company']);

    //PIVACF start
    if (ACCOUNT_PIVA == 'true') $piva = tep_db_prepare_input($_POST['piva']);
    if (ACCOUNT_CF == 'true') $cf = tep_db_prepare_input($_POST['cf']);
    //PIVACF end

    $street_address = tep_db_prepare_input($_POST['street_address']);
    if (ACCOUNT_SUBURB == 'true') $suburb = tep_db_prepare_input($_POST['suburb']);
    $postcode = tep_db_prepare_input($_POST['postcode']);
    $city = tep_db_prepare_input($_POST['city']);
    if (ACCOUNT_STATE == 'true') {
      $state = tep_db_prepare_input($_POST['state']);
      if (isset($_POST['zone_id'])) {
        $zone_id = tep_db_prepare_input($_POST['zone_id']);
      } else {
        $zone_id = false;
      }
    }
    $country = tep_db_prepare_input($_POST['country']);
    $telephone = tep_db_prepare_input($_POST['telephone']);
    $fax = tep_db_prepare_input($_POST['fax']);
    if (isset($_POST['newsletter'])) {
      $newsletter = tep_db_prepare_input($_POST['newsletter']);
    } else {
      $newsletter = false;
    }
    $password = tep_db_prepare_input($_POST['password']);
    $confirmation = tep_db_prepare_input($_POST['confirmation']);

// BOF Anti Robot Registration v2.6
    if (ACCOUNT_VALIDATION == 'true' && ACCOUNT_CREATE_VALIDATION == 'true') {
    $antirobotreg = tep_db_prepare_input($_POST['antirobotreg']);
    }
// EOF Anti Robot Registration v2.6

    $error = false;

    if (ACCOUNT_GENDER == 'true') {
      if ( ($gender != 'm') && ($gender != 'f') ) {
        $error = true;

        $messageStack->add('create_account', ENTRY_GENDER_ERROR);
      }
    }

    if (strlen($firstname) < ENTRY_FIRST_NAME_MIN_LENGTH) {
      $error = true;

      $messageStack->add('create_account', ENTRY_FIRST_NAME_ERROR);
    }

    if (strlen($lastname) < ENTRY_LAST_NAME_MIN_LENGTH) {
      $error = true;

      $messageStack->add('create_account', ENTRY_LAST_NAME_ERROR);
    }

    if (ACCOUNT_DOB == 'true') {
      if (@checkdate(substr(tep_date_raw($dob), 4, 2), substr(tep_date_raw($dob), 6, 2), substr(tep_date_raw($dob), 0, 4)) == false) {
        $error = true;

        $messageStack->add('create_account', ENTRY_DATE_OF_BIRTH_ERROR);
      }
//######################AVS Age veriyfication################################
$day = substr(tep_date_raw($dob), 6, 2);
$month = substr(tep_date_raw($dob), 4, 2);
$year = substr(tep_date_raw($dob), 0, 4);
$today = getdate();
$cmonth = $today['mon'];
$cday = $today['mday'];
$cyear = $today['year'];
$fullyears = $cyear - $year;
//FIXED LINE IN 2.2
if ($cmonth < $month || ($cmonth == $month && $cday < $day)) $fullyears--;
//END OF 2.2 MOD
if ($fullyears < MIN_AGE) {
	$error = true;
	$entry_date_of_birth_error2 = true;
$messageStack->add('create_account', ENTRY_DATE_OF_BIRTH_ERROR2);
}
if ($fullyears > MAX_AGE) {
	$error = true;
	$entry_date_of_birth_error2 = true;
$messageStack->add('create_account', ENTRY_DATE_OF_BIRTH_ERROR3);
}
//#####################AVS end Age veriyfication################################
    }
    
    
    if (strlen($email_address) < ENTRY_EMAIL_ADDRESS_MIN_LENGTH) {
      $error = true;

      $messageStack->add('create_account', ENTRY_EMAIL_ADDRESS_ERROR);
    } elseif (tep_validate_email($email_address) == false) {
      $error = true;

      $messageStack->add('create_account', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
    } else {
      //jsp:pwa:orig $check_email_query = tep_db_query("select count(*) as total from " . TABLE_CUSTOMERS . " where customers_email_address = '" . tep_db_input($email_address) . "'");
     //jsp:pwa 1
        $check_email_query = tep_db_query("select count(*) as total from " . TABLE_CUSTOMERS . " where customers_email_address = '" . tep_db_input($email_address) . "' and guest_account != '1'");
      $check_email = tep_db_fetch_array($check_email_query);
      if ($check_email['total'] > 0) {
        $error = true;

        $messageStack->add('create_account', ENTRY_EMAIL_ADDRESS_ERROR_EXISTS);
      }
    }

    //PIVACF start
    if ((ACCOUNT_PIVA == 'true') && ((int)$country == '105')) {  //shop2.0brain:todo: italy
      if (($piva == "") && (ACCOUNT_PIVA_REQ == 'true')) {
        $error = true;
            $messageStack->add('create_account', ENTRY_PIVA_ERROR);
      } else if ((strlen($piva) != 11) && ($piva != ""))  {
        $error = true;
        $messageStack->add('create_account', ENTRY_PIVA_ERROR);
      } else if (strlen($piva) == 11) {
	    if( ! ereg("^[0-9]+$", $piva) ) {
	      $error = true;
	      $messageStack->add('create_account', ENTRY_PIVA_ERROR);
        } else {
	      $s = 0;
		  for( $i = 0; $i <= 9; $i += 2 ) $s += ord($piva[$i]) - ord('0');
		  for( $i = 1; $i <= 9; $i += 2 ) {
		    $c = 2*( ord($piva[$i]) - ord('0') );
		    if( $c > 9 ) $c = $c - 9;
		    $s += $c;
	      }
	      if( ( 10 - $s%10 )%10 != ord($piva[10]) - ord('0') ) {
            $error = true;
            $messageStack->add('create_account', ENTRY_PIVA_ERROR);
          }
	    }
	  }	
	}
	if ((ACCOUNT_CF == 'true') && ((int)$country == '105')) {
	  if (($cf == "") && (ACCOUNT_CF_REQ == 'true')) {
	    $error = true;
		$messageStack->add('create_account', ENTRY_CF_ERROR);
	  } else if ((strlen($cf) != 16) && ($cf != "")) {
	    $error = true;
		$messageStack->add('create_account', ENTRY_CF_ERROR);
	  } else if (strlen($cf) == 16) {
		$cf = strtoupper($cf);
		if( ! ereg("^[A-Z0-9]+$", $cf) ){
		  $error = true;
		  $messageStack->add('create_account', ENTRY_CF_ERROR);
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
		    $messageStack->add('create_account', ENTRY_CF_ERROR);
		  }
	    }
	  }
    }
    //PIVACF end
	
    if (strlen($street_address) < ENTRY_STREET_ADDRESS_MIN_LENGTH) {
      $error = true;

      $messageStack->add('create_account', ENTRY_STREET_ADDRESS_ERROR);
    }

    if (strlen($postcode) < ENTRY_POSTCODE_MIN_LENGTH) {
      $error = true;

      $messageStack->add('create_account', ENTRY_POST_CODE_ERROR);
    }

    if (strlen($city) < ENTRY_CITY_MIN_LENGTH) {
      $error = true;

      $messageStack->add('create_account', ENTRY_CITY_ERROR);
    }

    if (is_numeric($country) == false) {
      $error = true;

      $messageStack->add('create_account', ENTRY_COUNTRY_ERROR);
    }

    if (ACCOUNT_STATE == 'true') {
      $zone_id = 0;
      $check_query = tep_db_query("select count(*) as total from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "'");
      $check = tep_db_fetch_array($check_query);
      $entry_state_has_zones = ($check['total'] > 0);
      if ($entry_state_has_zones == true) {
        $zone_query = tep_db_query("select distinct zone_id from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "' and (zone_name = '" . tep_db_input($state) . "' or zone_code = '" . tep_db_input($state) . "')");
        if (tep_db_num_rows($zone_query) == 1) {
          $zone = tep_db_fetch_array($zone_query);
          $zone_id = $zone['zone_id'];
        } else {
          $error = true;

          $messageStack->add('create_account', ENTRY_STATE_ERROR_SELECT);
        }
      } else {
        if (strlen($state) < ENTRY_STATE_MIN_LENGTH) {
          $error = true;

          $messageStack->add('create_account', ENTRY_STATE_ERROR);
        }
      }
    }

    if (strlen($telephone) < ENTRY_TELEPHONE_MIN_LENGTH) {
      $error = true;

      $messageStack->add('create_account', ENTRY_TELEPHONE_NUMBER_ERROR);
    }

// BOF Anti Robot Registration v2.6
    if (ACCOUNT_VALIDATION == 'true' && ACCOUNT_CREATE_VALIDATION == 'true') {
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
      if ($entry_antirobotreg_error == true) $messageStack->add('create_account', $text_antirobotreg_error);
    }
// EOF Anti Robot Registration v2.6
if(READ_PRIVACY_REQUIRED==1) {
    if ($privacy_confirm != true) {
      $error = true;

      $messageStack->add('create_account', ENTRY_PRIVACY_ERROR);
    }
}
//jsp:pwa
 if (!isset($HTTP_GET_VARS['guest']) && !isset($HTTP_POST_VARS['guest'])) {

    if (strlen($password) < ENTRY_PASSWORD_MIN_LENGTH) {
      $error = true;

      $messageStack->add('create_account', ENTRY_PASSWORD_ERROR);
    } elseif ($password != $confirmation) {
      $error = true;

      $messageStack->add('create_account', ENTRY_PASSWORD_ERROR_NOT_MATCHING);
    }
//jsp:pwa
}
    if ($error == false) {
                // PWA BOF 2b
                if (!isset($HTTP_GET_VARS['guest']) && !isset($HTTP_POST_VARS['guest']))
                {
                        $dbPass = tep_encrypt_password($password);
                        $guestaccount = '0';
                }else{
                        $dbPass = 'null';
                        $guestaccount = '1';
                }
                // PWA EOF 2b

      //TotalB2B start
      $customersenable_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " WHERE configuration_key = 'NEW_CUSTOMERS_ENABLED'");
      $customersenable = tep_db_fetch_array($customersenable_query); 
      if ($customersenable['configuration_value']=='true') $cust_status = 1;
      else $cust_status = 0;

      $sql_data_array = array('customers_firstname' => $firstname,
                              'customers_lastname' => $lastname,
                              'customers_email_address' => $email_address,
                              'customers_telephone' => $telephone,
                              'customers_fax' => $fax,
                              'customers_newsletter' => $newsletter,
    //jsp:pwa:orig                          'customers_password' => tep_encrypt_password($password),
                              //jsp:pwa PWA BOF 2b
                              'customers_password' => $dbPass,
                              'guest_account' => $guestaccount,
                              // PWA EOF 2b
                              'customers_status' => $cust_status);
      //TotalB2B end

      if (ACCOUNT_GENDER == 'true') $sql_data_array['customers_gender'] = $gender;
      if (ACCOUNT_DOB == 'true') $sql_data_array['customers_dob'] = tep_date_raw($dob);

      tep_db_perform(TABLE_CUSTOMERS, $sql_data_array);

      $customer_id = tep_db_insert_id();

      $sql_data_array = array('customers_id' => $customer_id,
                              'entry_firstname' => $firstname,
                              'entry_lastname' => $lastname,
                              'entry_street_address' => $street_address,
                              'entry_postcode' => $postcode,
                              'entry_city' => $city,
                              'entry_country_id' => $country);

      if (ACCOUNT_GENDER == 'true') $sql_data_array['entry_gender'] = $gender;
      if (ACCOUNT_COMPANY == 'true') $sql_data_array['entry_company'] = $company;
	  
      //PIVACF start
      if (ACCOUNT_PIVA == 'true') $sql_data_array['entry_piva'] = $piva;
      if (ACCOUNT_CF == 'true') $sql_data_array['entry_cf'] = $cf;
      //PIVACF end

      if (ACCOUNT_SUBURB == 'true') $sql_data_array['entry_suburb'] = $suburb;
      if (ACCOUNT_STATE == 'true') {
        if ($zone_id > 0) {
          $sql_data_array['entry_zone_id'] = $zone_id;
          $sql_data_array['entry_state'] = '';
        } else {
          $sql_data_array['entry_zone_id'] = '0';
          $sql_data_array['entry_state'] = $state;
        }
      }

//jsp:PWA BOF
     if (isset($HTTP_GET_VARS['guest']) or isset($HTTP_POST_VARS['guest']))
       tep_session_register('customer_is_guest');
//pwa end
      tep_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array);

      $address_id = tep_db_insert_id();

      tep_db_query("update " . TABLE_CUSTOMERS . " set customers_default_address_id = '" . (int)$address_id . "' where customers_id = '" . (int)$customer_id . "'");

      tep_db_query("insert into " . TABLE_CUSTOMERS_INFO . " (customers_info_id, customers_info_number_of_logons, customers_info_date_account_created) values ('" . (int)$customer_id . "', '0', now())");

      if (SESSION_RECREATE == 'True') {
        tep_session_recreate();
      }

      $customer_first_name = $firstname;
      $customer_default_address_id = $address_id;
      $customer_country_id = $country;
      $customer_zone_id = $zone_id;
      tep_session_register('customer_id');
      tep_session_register('customer_first_name');
      tep_session_register('customer_default_address_id');
      tep_session_register('customer_country_id');
      tep_session_register('customer_zone_id');

//jsp:PWA BOF
      if (isset($HTTP_GET_VARS['guest']) or isset($HTTP_POST_VARS['guest'])) tep_redirect(tep_href_link(FILENAME_CHECKOUT_SHIPPING));
// PWA EOF

// restore cart contents
      $cart->restore_contents();

// build the message content
      $name = $firstname . ' ' . $lastname;

      if (ACCOUNT_GENDER == 'true') {
         if ($gender == 'm') {
           $email_text = sprintf(EMAIL_GREET_MR, $lastname);
         } else {
           $email_text = sprintf(EMAIL_GREET_MS, $lastname);
         }
      } else {
        $email_text = sprintf(EMAIL_GREET_NONE, $firstname);
      }

// Points/Rewards system V2.00 BOF
      if (NEW_SIGNUP_POINT_AMOUNT > 0) {
        tep_add_welcome_points($customer_id);
        
        $points_account .= '<a href="' . tep_href_link(FILENAME_MY_POINTS, '', 'SSL') . '">' . EMAIL_POINTS_ACCOUNT . '</a>.';
        $points_faq .= '<a href="' . tep_href_link(FILENAME_MY_POINTS_HELP, '', 'NONSSL') . '">' . EMAIL_POINTS_FAQ . '</a>.';
	    $text_points = sprintf(EMAIL_WELCOME_POINTS , $points_account, number_format(NEW_SIGNUP_POINT_AMOUNT,POINTS_DECIMAL_PLACES), $currencies->format(tep_calc_shopping_pvalue(NEW_SIGNUP_POINT_AMOUNT)),$points_faq) ."\n\n";
      }
	    
//    $email_text .= EMAIL_WELCOME . EMAIL_TEXT                . EMAIL_CONTACT . EMAIL_WARNING;
      $email_text .= EMAIL_WELCOME . EMAIL_TEXT . $text_points . EMAIL_CONTACT . EMAIL_WARNING;
      
// Points/Rewards system V2.00 EOF

// ###### Added CCGV Contribution #########
  if (NEW_SIGNUP_GIFT_VOUCHER_AMOUNT > 0) {
    $coupon_code = create_coupon_code();
    $insert_query = tep_db_query("insert into " . TABLE_COUPONS . " (coupon_code, coupon_type, coupon_amount, date_created) values ('" . $coupon_code . "', 'G', '" . NEW_SIGNUP_GIFT_VOUCHER_AMOUNT . "', now())");
    $insert_id = tep_db_insert_id_old($insert_query);
    $insert_query = tep_db_query("insert into " . TABLE_COUPON_EMAIL_TRACK . " (coupon_id, customer_id_sent, sent_firstname, emailed_to, date_sent) values ('" . $insert_id ."', '0', 'Admin', '" . $email_address . "', now() )");

    $email_text .= sprintf(EMAIL_GV_INCENTIVE_HEADER, $currencies->format(NEW_SIGNUP_GIFT_VOUCHER_AMOUNT)) . "\n\n" .
                   sprintf(EMAIL_GV_REDEEM, $coupon_code) . "\n\n" .
                   EMAIL_GV_LINK . tep_href_link(FILENAME_GV_REDEEM, 'gv_no=' . $coupon_code,'NONSSL', false) .
                   "\n\n";
  }
  if (NEW_SIGNUP_DISCOUNT_COUPON != '') {
		$coupon_code = NEW_SIGNUP_DISCOUNT_COUPON;
    $coupon_query = tep_db_query("select * from " . TABLE_COUPONS . " where coupon_code = '" . $coupon_code . "'");
    $coupon = tep_db_fetch_array($coupon_query);
		$coupon_id = $coupon['coupon_id'];		
    $coupon_desc_query = tep_db_query("select * from " . TABLE_COUPONS_DESCRIPTION . " where coupon_id = '" . $coupon_id . "' and language_id = '" . (int)$languages_id . "'");
    $coupon_desc = tep_db_fetch_array($coupon_desc_query);
    $insert_query = tep_db_query("insert into " . TABLE_COUPON_EMAIL_TRACK . " (coupon_id, customer_id_sent, sent_firstname, emailed_to, date_sent) values ('" . $coupon_id ."', '0', 'Admin', '" . $email_address . "', now() )");
    $email_text .= EMAIL_COUPON_INCENTIVE_HEADER .  "\n" .
                   sprintf("%s", $coupon_desc['coupon_description']) ."\n\n" .
                   sprintf(EMAIL_COUPON_REDEEM, $coupon['coupon_code']) . "\n\n" .
                   "\n\n";

  }
//    $email_text .= EMAIL_TEXT . EMAIL_CONTACT . EMAIL_WARNING;
// ###### End Added CCGV Contribution #########
      tep_mail($name, $email_address, EMAIL_SUBJECT, $email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);

//TotalB2B start
      $email_validate_text = EMAIL_VALIDATE . " \n\n " . EMAIL_VALIDATE_PROFILE . " " . tep_href_link('admin/customers.php','cID='.$customer_id.'&action=edit', 'SSL') . " \n" . EMAIL_VALIDATE_ACTIVATE . " " . tep_href_link('admin/customers.php','action=setflag&flag=1&cID='.$customer_id, 'SSL');
      tep_mail(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, EMAIL_VALIDATE_SUBJECT, $email_validate_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
//TotalB2B end

      tep_redirect(tep_href_link(FILENAME_CREATE_ACCOUNT_SUCCESS, '', 'SSL'));
    }
  }

//jsp:orig:pwa  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL'));
 //jsp:pwa start
 if (!isset($HTTP_GET_VARS['guest']) && !isset($HTTP_POST_VARS['guest'])){
   $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL'));
 }else{
   $breadcrumb->add(NAVBAR_TITLE_PWA, tep_href_link(FILENAME_CREATE_ACCOUNT, 'guest=guest', 'SSL'));
 }
//jsp:pwa end


  $content = basename($_SERVER['PHP_SELF']);
  while (strstr($content, '.php')) $content = str_replace('.php', '', $content);

  $javascript = 'form_check.js.php';
  include (bts_select('main', $content_template)); // BTSv1.5

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>