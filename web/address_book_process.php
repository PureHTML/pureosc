<?php
/*
  $Id: address_book_process.php,v 1.79 2003/06/09 23:03:52 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  if (!tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

// needs to be included earlier to set the success message in the messageStack
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ADDRESS_BOOK_PROCESS);

  if (isset($_GET['action']) && ($_GET['action'] == 'deleteconfirm') && isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    tep_db_query("delete from " . TABLE_ADDRESS_BOOK . " where address_book_id = '" . (int)$_GET['delete'] . "' and customers_id = '" . (int)$customer_id . "'");

    $messageStack->add_session('addressbook', SUCCESS_ADDRESS_BOOK_ENTRY_DELETED, 'success');

    tep_redirect(tep_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL'));
  }

// error checking when updating or adding an entry
  $process = false;
  if (isset($_POST['action']) && (($_POST['action'] == 'process') || ($_POST['action'] == 'update'))) {
    $process = true;
    $error = false;

    if (ACCOUNT_GENDER == 'true') $gender = tep_db_prepare_input($_POST['gender']);
    if (ACCOUNT_COMPANY == 'true') $company = tep_db_prepare_input($_POST['company']);

    //PIVACF start
      if (ACCOUNT_PIVA == 'true') $piva = tep_db_prepare_input($_POST['piva']);
      if (ACCOUNT_CF == 'true') $cf = tep_db_prepare_input($_POST['cf']);
    //PIVACF end

    $firstname = tep_db_prepare_input($_POST['firstname']);
    $lastname = tep_db_prepare_input($_POST['lastname']);
    $street_address = tep_db_prepare_input($_POST['street_address']);
    if (ACCOUNT_SUBURB == 'true') $suburb = tep_db_prepare_input($_POST['suburb']);
    $postcode = tep_db_prepare_input($_POST['postcode']);
    $city = tep_db_prepare_input($_POST['city']);
    $country = tep_db_prepare_input($_POST['country']);
    if (ACCOUNT_STATE == 'true') {
      if (isset($_POST['zone_id'])) {
        $zone_id = tep_db_prepare_input($_POST['zone_id']);
      } else {
        $zone_id = false;
      }
      $state = tep_db_prepare_input($_POST['state']);
    }

    if (ACCOUNT_GENDER == 'true') {
      if ( ($gender != 'm') && ($gender != 'f') ) {
        $error = true;

        $messageStack->add('addressbook', ENTRY_GENDER_ERROR);
      }
    }

    //PIVACF start
	if ((ACCOUNT_PIVA == 'true') && ((int)$country == '105')) {
	  if (($piva == "") && (ACCOUNT_PIVA_REQ == 'true')) {
	    $error = true;
		$messageStack->add('addressbook', ENTRY_PIVA_ERROR);
	  } else if ((strlen($piva) != 11) && ($piva != ""))  {
        $error = true;
        $messageStack->add('addressbook', ENTRY_PIVA_ERROR);
      } else if (strlen($piva) == 11) {
	    if( ! ereg("^[0-9]+$", $piva) ) {
	      $error = true;
	      $messageStack->add('addressbook', ENTRY_PIVA_ERROR);
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
            $messageStack->add('addressbook', ENTRY_PIVA_ERROR);
          }
	    }
	  }	
	}
	if ((ACCOUNT_CF == 'true') && ((int)$country == '105')) {
	  if (($cf == "") && (ACCOUNT_CF_REQ == 'true')) {
	    $error = true;
		$messageStack->add('addressbook', ENTRY_CF_ERROR);
	  } else if ((strlen($cf) != 16) && ($cf != "")) {
	    $error = true;
		$messageStack->add('addressbook', ENTRY_CF_ERROR);
	  } else if (strlen($cf) == 16) {
		$cf = strtoupper($cf);
		if( ! ereg("^[A-Z0-9]+$", $cf) ){
		  $error = true;
		  $messageStack->add('addressbook', ENTRY_CF_ERROR);
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
		    $messageStack->add('addressbook', ENTRY_CF_ERROR);
		  }
	    }
	  }
    }
	//PIVACF end

    if (strlen($firstname) < ENTRY_FIRST_NAME_MIN_LENGTH) {
      $error = true;

      $messageStack->add('addressbook', ENTRY_FIRST_NAME_ERROR);
    }

    if (strlen($lastname) < ENTRY_LAST_NAME_MIN_LENGTH) {
      $error = true;

      $messageStack->add('addressbook', ENTRY_LAST_NAME_ERROR);
    }

    if (strlen($street_address) < ENTRY_STREET_ADDRESS_MIN_LENGTH) {
      $error = true;

      $messageStack->add('addressbook', ENTRY_STREET_ADDRESS_ERROR);
    }

    if (strlen($postcode) < ENTRY_POSTCODE_MIN_LENGTH) {
      $error = true;

      $messageStack->add('addressbook', ENTRY_POST_CODE_ERROR);
    }

    if (strlen($city) < ENTRY_CITY_MIN_LENGTH) {
      $error = true;

      $messageStack->add('addressbook', ENTRY_CITY_ERROR);
    }

    if (!is_numeric($country)) {
      $error = true;

      $messageStack->add('addressbook', ENTRY_COUNTRY_ERROR);
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

          $messageStack->add('addressbook', ENTRY_STATE_ERROR_SELECT);
        }
      } else {
        if (strlen($state) < ENTRY_STATE_MIN_LENGTH) {
          $error = true;

          $messageStack->add('addressbook', ENTRY_STATE_ERROR);
        }
      }
    }

    if ($error == false) {
      $sql_data_array = array('entry_firstname' => $firstname,
                              'entry_lastname' => $lastname,
                              'entry_street_address' => $street_address,
                              'entry_postcode' => $postcode,
                              'entry_city' => $city,
                              'entry_country_id' => (int)$country);

      if (ACCOUNT_GENDER == 'true') $sql_data_array['entry_gender'] = $gender;
      if (ACCOUNT_COMPANY == 'true') $sql_data_array['entry_company'] = $company;

      //PIVACF start
	  if (ACCOUNT_PIVA == 'true') $sql_data_array['entry_piva'] = $piva;
	  if (ACCOUNT_CF == 'true') $sql_data_array['entry_cf'] = $cf;
      //PIVACF end

      if (ACCOUNT_SUBURB == 'true') $sql_data_array['entry_suburb'] = $suburb;
      if (ACCOUNT_STATE == 'true') {
        if ($zone_id > 0) {
          $sql_data_array['entry_zone_id'] = (int)$zone_id;
          $sql_data_array['entry_state'] = '';
        } else {
          $sql_data_array['entry_zone_id'] = '0';
          $sql_data_array['entry_state'] = $state;
        }
      }

      if ($_POST['action'] == 'update') {
        $check_query = tep_db_query("select address_book_id from " . TABLE_ADDRESS_BOOK . " where address_book_id = '" . (int)$_GET['edit'] . "' and customers_id = '" . (int)$customer_id . "' limit 1");
        if (tep_db_num_rows($check_query) == 1) {
          tep_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array, 'update', "address_book_id = '" . (int)$_GET['edit'] . "' and customers_id ='" . (int)$customer_id . "'");

// reregister session variables
          if ( (isset($_POST['primary']) && ($_POST['primary'] == 'on')) || ($_GET['edit'] == $customer_default_address_id) ) {
            $customer_first_name = $firstname;
            $customer_country_id = $country;
            $customer_zone_id = (($zone_id > 0) ? (int)$zone_id : '0');
            $customer_default_address_id = (int)$_GET['edit'];

            $sql_data_array = array('customers_firstname' => $firstname,
                                    'customers_lastname' => $lastname,
                                    'customers_default_address_id' => (int)$_GET['edit']);

            if (ACCOUNT_GENDER == 'true') $sql_data_array['customers_gender'] = $gender;

            tep_db_perform(TABLE_CUSTOMERS, $sql_data_array, 'update', "customers_id = '" . (int)$customer_id . "'");
          }

          $messageStack->add_session('addressbook', SUCCESS_ADDRESS_BOOK_ENTRY_UPDATED, 'success');
        }
      } else {
        if (tep_count_customer_address_book_entries() < MAX_ADDRESS_BOOK_ENTRIES) {
          $sql_data_array['customers_id'] = (int)$customer_id;
          tep_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array);

          $new_address_book_id = tep_db_insert_id();

// reregister session variables
          if (isset($_POST['primary']) && ($_POST['primary'] == 'on')) {
            $customer_first_name = $firstname;
            $customer_country_id = $country;
            $customer_zone_id = (($zone_id > 0) ? (int)$zone_id : '0');
            if (isset($_POST['primary']) && ($_POST['primary'] == 'on')) $customer_default_address_id = $new_address_book_id;

            $sql_data_array = array('customers_firstname' => $firstname,
                                    'customers_lastname' => $lastname);

            if (ACCOUNT_GENDER == 'true') $sql_data_array['customers_gender'] = $gender;
            if (isset($_POST['primary']) && ($_POST['primary'] == 'on')) $sql_data_array['customers_default_address_id'] = $new_address_book_id;

            tep_db_perform(TABLE_CUSTOMERS, $sql_data_array, 'update', "customers_id = '" . (int)$customer_id . "'");

            $messageStack->add_session('addressbook', SUCCESS_ADDRESS_BOOK_ENTRY_UPDATED, 'success');
          }
        }
      }

      tep_redirect(tep_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL'));
    }
  }

  if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {

//PIVACF start
 // $entry_query = tep_db_query("select entry_gender, entry_company,                       entry_firstname, entry_lastname, entry_street_address, entry_suburb, entry_postcode, entry_city, entry_state, entry_zone_id, entry_country_id from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$customer_id . "' and address_book_id = '" . (int)$_GET['edit'] . "'");
    $entry_query = tep_db_query("select entry_gender, entry_company, entry_piva, entry_cf, entry_firstname, entry_lastname, entry_street_address, entry_suburb, entry_postcode, entry_city, entry_state, entry_zone_id, entry_country_id from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$customer_id . "' and address_book_id = '" . (int)$_GET['edit'] . "'");
//PIVACF end

    if (!tep_db_num_rows($entry_query)) {
      $messageStack->add_session('addressbook', ERROR_NONEXISTING_ADDRESS_BOOK_ENTRY);

      tep_redirect(tep_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL'));
    }

    $entry = tep_db_fetch_array($entry_query);
  } elseif (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    if ($_GET['delete'] == $customer_default_address_id) {
      $messageStack->add_session('addressbook', WARNING_PRIMARY_ADDRESS_DELETION, 'warning');

      tep_redirect(tep_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL'));
    } else {
      $check_query = tep_db_query("select count(*) as total from " . TABLE_ADDRESS_BOOK . " where address_book_id = '" . (int)$_GET['delete'] . "' and customers_id = '" . (int)$customer_id . "'");
      $check = tep_db_fetch_array($check_query);

      if ($check['total'] < 1) {
        $messageStack->add_session('addressbook', ERROR_NONEXISTING_ADDRESS_BOOK_ENTRY);

        tep_redirect(tep_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL'));
      }
    }
  } else {
    $entry = array();
  }

  if (!isset($_GET['delete']) && !isset($_GET['edit'])) {
    if (tep_count_customer_address_book_entries() >= MAX_ADDRESS_BOOK_ENTRIES) {
      $messageStack->add_session('addressbook', ERROR_ADDRESS_BOOK_FULL);

      tep_redirect(tep_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL'));
    }
  }

  $breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_ACCOUNT, '', 'SSL'));
  $breadcrumb->add(NAVBAR_TITLE_2, tep_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL'));

  if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $breadcrumb->add(NAVBAR_TITLE_MODIFY_ENTRY, tep_href_link(FILENAME_ADDRESS_BOOK_PROCESS, 'edit=' . $_GET['edit'], 'SSL'));
  } elseif (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $breadcrumb->add(NAVBAR_TITLE_DELETE_ENTRY, tep_href_link(FILENAME_ADDRESS_BOOK_PROCESS, 'delete=' . $_GET['delete'], 'SSL'));
  } else {
    $breadcrumb->add(NAVBAR_TITLE_ADD_ENTRY, tep_href_link(FILENAME_ADDRESS_BOOK_PROCESS, '', 'SSL'));
  }

  $content = basename($_SERVER['PHP_SELF']);
  while (strstr($content, '.php')) $content = str_replace('.php', '', $content);

  $javascript = $content . '.js.php';

  include (bts_select('main', $content_template)); // BTSv1.5

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>