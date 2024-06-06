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

  if (isset($_GET['action']) && ($_GET['action'] == 'process')) {
    $email_address = tep_db_prepare_input($_POST['email_address']);
    $password = tep_db_prepare_input($_POST['password']);

// Check if email exists
    $check_admin_query = tep_db_query("select admin_id as login_id, admin_groups_id as login_groups_id, admin_firstname as login_firstname, admin_email_address as login_email_address, admin_password as login_password, admin_modified as login_modified, admin_logdate as login_logdate, admin_lognum as login_lognum from " . TABLE_ADMIN . " where admin_email_address = '" . tep_db_input($email_address) . "'");
    if (!tep_db_num_rows($check_admin_query)) {
      $_GET['login'] = 'fail';
    } else {
      $check_admin = tep_db_fetch_array($check_admin_query);
      // Check that password is good
      if (!tep_validate_password($password, $check_admin['login_password'])) {
        $_GET['login'] = 'fail';
      } else {
        if (tep_session_is_registered('password_forgotten')) {
          tep_session_unregister('password_forgotten');
        }

        $login_id = $check_admin['login_id'];
        $login_groups_id = $check_admin[login_groups_id];
        $login_firstname = $check_admin['login_firstname'];
        $login_email_address = $check_admin['login_email_address'];
        $login_logdate = $check_admin['login_logdate'];
        $login_lognum = $check_admin['login_lognum'];
        $login_modified = $check_admin['login_modified'];

        tep_session_register('login_id');
        tep_session_register('login_groups_id');
        tep_session_register('login_first_name');

        //$date_now = date('Ymd');
        tep_db_query("update " . TABLE_ADMIN . " set admin_logdate = now(), admin_lognum = admin_lognum+1 where admin_id = '" . $login_id . "'");

        if (($login_lognum == 0) || !($login_logdate) || ($login_email_address == 'admin@localhost') || ($login_modified == '0000-00-00 00:00:00')) {
          tep_redirect(tep_href_link(FILENAME_ADMIN_ACCOUNT));
        } else {
          tep_redirect(tep_href_link(FILENAME_DEFAULT));
        }

      }
    }
  }

  @include(DIR_WS_LANGUAGES . $language . '/' . FILENAME_LOGIN);
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
          		<tr class="logo-head" >
              	<td height="50" align="left"><?php echo tep_image(DIR_WS_IMAGES . 'oscommerce.png', 'osCommerce', '204', '50'); ?></td>
            		<td align="right" class="nav-head" nowrap><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . HEADER_TITLE_ADMINISTRATION . '</a>&nbsp;|&nbsp;<a href="' . tep_catalog_href_link() . '">' . HEADER_TITLE_ONLINE_CATALOG . '</a>&nbsp;|&nbsp;<a href="http://www.oscommerce.com" target="_blank">' . HEADER_TITLE_SUPPORT_SITE . '</a>'; ?>&nbsp;&nbsp;</td>
          		</tr>
          		<tr class="main">
		            <td colspan="2" align="center" valign="middle"><?php echo tep_draw_form('login', FILENAME_LOGIN, 'action=process'); ?>
                	<table width="280" border="2" cellspacing="0" cellpadding="2">
                  	<tr>
                    	<td class="login_heading" valign="top">&nbsp;<?php echo HEADING_RETURNING_ADMIN; ?></td>
                    </tr>
                    <tr>
                      <td height="100%" valign="top" align="center">
                      	<table border="0" cellspacing="0" cellpadding="1" class="login_form_bg">
                        	<tr>
                          	<td>
                            	<table width="100%" cellspacing="3" cellpadding="2" class="login_form">
																<?php
																  if ($_GET['login'] == 'fail') {
																    $info_message = TEXT_LOGIN_ERROR;
																  }
                                  if (isset($info_message)) {
																?>
                              	<tr>
                                	<td colspan="2" class="smallText" align="center"><?php echo $info_message; ?></td>
                                </tr>
<?php
  } else {
?>
                                <tr>
                                	<td colspan="2"><?php echo tep_draw_separator('pixel_trans.png', '100%', '10'); ?></td>
                                </tr>
<?php
  }
?>
                                <tr>
                                	<td class="login"><?php echo ENTRY_EMAIL_ADDRESS; ?></td>
                                  <td class="login"><?php echo tep_draw_input_field('email_address', ''); //jsptady ?></td> 
                                </tr>
                                <tr>
                                	<td class="login"><?php echo ENTRY_PASSWORD; ?></td>
                                  <td class="login"><?php echo tep_draw_password_field('password', 'admin'); ?></td>
                                </tr>
                                <tr>
                                	<td colspan="2" align="right" valign="top"><?php echo tep_image_submit('button_confirm.png', IMAGE_BUTTON_LOGIN); ?></td>
                                </tr>
                              </table>
														</td>
													</tr>
                        </table>
                      </td>
                    </tr>
                    <tr>
                    	<td valign="top" align="right"><?php echo '<a class="sub" href="' . tep_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL') . '">' . TEXT_PASSWORD_FORGOTTEN . '</a><span class="sub">&nbsp;</span>'; ?></td>
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