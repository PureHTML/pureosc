<?php
/*
  $Id: login.php,v 1.11 2002/06/03 13:19:42 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

  define('NAVBAR_TITLE', 'Login');
  define('HEADING_TITLE', 'Welcome, Please Sign In');
  define('TEXT_STEP_BY_STEP', ''); // should be empty

define('HEADING_RETURNING_ADMIN', 'Login Panel:');
define('HEADING_PASSWORD_FORGOTTEN', 'Password Forgotten:');
define('TEXT_RETURNING_ADMIN', 'Staff only!');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail Address:');
define('ENTRY_PASSWORD', 'Password:');
define('ENTRY_FIRSTNAME', 'First Name:');
define('IMAGE_BUTTON_LOGIN', 'Submit');

define('TEXT_PASSWORD_FORGOTTEN', 'Password forgotten?');

define('TEXT_LOGIN_ERROR', '<font color="#ff0000"><b>ERROR:</b></font> Wrong username or password!');
define('TEXT_FORGOTTEN_ERROR', '<font color="#ff0000"><b>ERROR:</b></font> first name and password not match!');
define('TEXT_FORGOTTEN_FAIL', 'You have try over 3 times. For security reason, please contact your Web Administrator to get new password.<br />&nbsp;<br />&nbsp;');
define('TEXT_FORGOTTEN_SUCCESS', 'The new password have sent to your email address. Please check your email and click back to login.<br />&nbsp;<br />&nbsp;');

define('ADMIN_EMAIL_SUBJECT', 'New Password'); 
define('ADMIN_EMAIL_TEXT', 'Hi %s,' . "\n\n" . 'You can access the admin panel with the following password. Once you access the admin, please change your password!' . "\n\n" . 'Website : %s' . "\n" . 'Username: %s' . "\n" . 'Password: %s' . "\n\n" . 'Thanks!' . "\n" . '%s' . "\n\n" . 'This is an automated response, please do not reply!'); 
?>
