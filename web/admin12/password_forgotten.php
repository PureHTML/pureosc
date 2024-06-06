<?php
/*
  $Id: login.php,v 1.17 2003/02/14 12:57:29 dgw_ Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License

  Includes Contribution:
  Access with Level Account (v. 2.2a) for the Admin Area of osCommerce (MS2)

  This file may be deleted if disabling the above contribution
*/

  require('includes/application_top.php');
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_LOGIN);

  if (isset($_GET['action']) && ($_GET['action'] == 'process')) {
    $email_address = tep_db_prepare_input($_POST['email_address']);
    $firstname = tep_db_prepare_input($_POST['firstname']);
    $log_times = $_POST['log_times']+1;
    if ($log_times >= 4) {
      tep_session_register('password_forgotten');
    }

// Check if email exists
    $check_admin_query = tep_db_query("select admin_id as check_id, admin_firstname as check_firstname, admin_lastname as check_lastname, admin_email_address as check_email_address from " . TABLE_ADMIN . " where admin_email_address = '" . tep_db_input($email_address) . "'");
    if (!tep_db_num_rows($check_admin_query)) {
      $_GET['login'] = 'fail';
    } else {
      $check_admin = tep_db_fetch_array($check_admin_query);
      if ($check_admin['check_firstname'] != $firstname) {
        $_GET['login'] = 'fail';
      } else {
        $_GET['login'] = 'success';

        function randomize() {
          $salt = "ABCDEFGHIJKLMNOPQRSTUVWXWZabchefghjkmnpqrstuvwxyz0123456789";
          srand((double)microtime()*1000000);
          $i = 0;

          while ($i <= 7) {
            $num = rand() % 33;
    	    $tmp = substr($salt, $num, 1);
    	    $pass = $pass . $tmp;
    	    $i++;
  	  }
  	  return $pass;
        }
        $makePassword = randomize();
        tep_mail($check_admin['check_firstname'] . ' ' . $check_admin['admin_lastname'], $check_admin['check_email_address'], ADMIN_EMAIL_SUBJECT, sprintf(ADMIN_EMAIL_TEXT, $check_admin['check_firstname'], HTTP_SERVER . DIR_WS_ADMIN, $check_admin['check_email_address'], $makePassword, STORE_OWNER), STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
        tep_db_query("update " . TABLE_ADMIN . " set admin_password = '" . tep_encrypt_password($makePassword) . "' where admin_id = '" . $check_admin['check_id'] . "'");
      }
    }
  }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>"/>
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<table border="0" width="600" cellspacing="0" cellpadding="0" align="center" >
  <tr>
    <td>
    	<table border="0" width="600" cellspacing="0" cellpadding="1" align="center" >
      	<tr class="mainback">
        	<td>
          	<table border="0" width="600" cellspacing="0" cellpadding="0">
          		<tr class="logo-head">
            		<td height="50"><?php echo tep_image(DIR_WS_IMAGES . 'oscommerce.png', 'osCommerce', '204', '50'); ?></td>
            		<td align="right" class="nav-head" nowrap><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . HEADER_TITLE_ADMINISTRATION . '</a>&nbsp;|&nbsp;<a href="' . tep_catalog_href_link() . '">' . HEADER_TITLE_ONLINE_CATALOG . '</a>&nbsp;|&nbsp;<a href="http://www.oscommerce.com" target="_blank">' . HEADER_TITLE_SUPPORT_SITE . '</a>'; ?>&nbsp;&nbsp;</td>
          		</tr>
          		<tr class="main">
            		<td colspan="2" align="center" valign="middle">
                <?php echo tep_draw_form('login', FILENAME_PASSWORD_FORGOTTEN, 'action=process'); ?>
                	<table width="280" border="0" cellspacing="0" cellpadding="2">
                  	<tr>
                    	<td class="login_heading" valign="top">&nbsp;<b><?php echo HEADING_PASSWORD_FORGOTTEN; ?></b></td>
                    </tr>
                    <tr>
                    	<td height="100%" width="100%" valign="top" align="center">
                      	<table border="0" width="100%" cellspacing="0" cellpadding="1" class="login_form_bg">
                        	<tr>
                          	<td>
                            	<table border="0" width="100%" cellspacing="3" cellpadding="2" class="login_form">
<?php
  if ($_GET['login'] == 'success') {
    $success_message = TEXT_FORGOTTEN_SUCCESS;
  } elseif ($_GET['login'] == 'fail') {
    $info_message = TEXT_FORGOTTEN_ERROR;
  }
  if (tep_session_is_registered('password_forgotten')) {
?>
																<tr>
                                  <td class="smallText"><?php echo TEXT_FORGOTTEN_FAIL; ?></td>
                                </tr>
                                <tr>
                                	<td align="center" valign="top"><?php echo '<a href="' . tep_href_link(FILENAME_LOGIN, '' , 'SSL') . '">' . tep_image_button('button_back.png', IMAGE_BACK) . '</a>'; ?></td>
                                </tr>
<?php
  } elseif (isset($success_message)) {
?>
                                <tr>
                                  <td class="smallText"><?php echo $success_message; ?></td>
                                </tr>
                                <tr>
                                  <td align="center" valign="top"><?php echo '<a href="' . tep_href_link(FILENAME_LOGIN, '' , 'SSL') . '">' . tep_image_button('button_back.png', IMAGE_BACK) . '</a>'; ?></td>
                                </tr>
<?php
  } else {
    if (isset($info_message)) {
?>
                                <tr>
                                  <td colspan="2" class="smallText" align="center"><?php echo $info_message; ?><?php echo tep_draw_hidden_field('log_times', $log_times); ?></td>
                                </tr>
<?php
    } else {
?>
                                <tr>
                                	<td colspan="2"><?php echo tep_draw_separator('pixel_trans.png', '100%', '10'); ?><?php echo tep_draw_hidden_field('log_times', '0'); ?></td>
                                </tr>
<?php
    }
?>
                                <tr>
                                	<td class="login"><?php echo ENTRY_FIRSTNAME; ?></td>
                                  <td class="login"><?php echo tep_draw_input_field('firstname'); ?></td>
                                </tr>
                                <tr>
                                  <td class="login"><?php echo ENTRY_EMAIL_ADDRESS; ?></td>
                                  <td class="login"><?php echo tep_draw_input_field('email_address'); ?></td>
                                </tr>
                                <tr>
                                  <td colspan="2" align="right" valign="top"><?php echo '<a href="' . tep_href_link(FILENAME_LOGIN, '' , 'SSL') . '">' . tep_image_button('button_back.png', IMAGE_BACK) . '</a> ' . tep_image_submit('button_confirm.png', IMAGE_BUTTON_LOGIN); ?>&nbsp;</td>
                                </tr>
<?php
  }
?>
															</table>
														</td>
													</tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </form>
                </td>
          		</tr>
        		</table>
					</td>
      	</tr>
      	<tr>
        	<td><?php require(DIR_WS_INCLUDES . 'footer.php'); ?></td>
      	</tr>
    	</table>
		</td>
  </tr>
</table>

</body>

</html>