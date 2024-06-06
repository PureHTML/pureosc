<?php
/*
  $Id: contact_us.php,v 1.42 2003/06/12 12:17:07 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

// BOF Anti Robot Registration v2.6
  if (ACCOUNT_VALIDATION == 'true' && CONTACT_US_VALIDATION == 'true') {
    require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ACCOUNT_VALIDATION);
    include_once('includes/functions/' . FILENAME_ACCOUNT_VALIDATION);
  }
// EOF Anti Robot Registration v2.6

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CONTACT_US);

$page_query = tep_db_query("select 
                               p.pages_id, 
                               p.sort_order, 
                               p.status, 
                               s.pages_title, 
                               s.pages_html_text
                            from 
                               " . TABLE_PAGES . " p LEFT JOIN " .TABLE_PAGES_DESCRIPTION . " s on p.pages_id = s.pages_id 
                            where 
                               p.status = 1
                            and
                               s.language_id = '" . (int)$languages_id . "'
                            and 
                               p.page_type = 2");


$page_check = tep_db_fetch_array($page_query);

$pagetext=stripslashes($page_check[pages_html_text]);

  $error = false;
  if (isset($_GET['action']) && ($_GET['action'] == 'send')) {

// BOF Anti Robot Registration v2.6
    if (ACCOUNT_VALIDATION == 'true' && CONTACT_US_VALIDATION == 'true') {
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
      if ($entry_antirobotreg_error == true) $messageStack->add('contact', $text_antirobotreg_error);
    }
// EOF Anti Robot Registration v2.6
    $name = tep_db_prepare_input($_POST['name']);
    $email_address = tep_db_prepare_input($_POST['email']);
    $enquiry = tep_db_prepare_input($_POST['enquiry']);

// BOF Anti Robot Registration v2.6
    if (!tep_validate_email($email_address)) {
      $error = true;
      $messageStack->add('contact', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
	} elseif (!$entry_antirobotreg_error == true) {

//    if (tep_validate_email($email_address)) {

      tep_mail(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, EMAIL_SUBJECT, $enquiry, $name, $email_address);

//jsp:seourl      tep_redirect(tep_href_link(FILENAME_CONTACT_US, 'action=success'));
	header('Location:/contact_us.php?action=success');
//    } else {
//      $error = true;
//      $messageStack->add('contact', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
    }
// EOF Anti Robot Registration v2.6
  }

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_CONTACT_US));

  $content = basename($_SERVER['PHP_SELF']);
  while (strstr($content, '.php')) $content = str_replace('.php', '', $content);

  $javascript = 'remove_label.js';
  include (bts_select('main', $content_template)); // BTSv1.5

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>