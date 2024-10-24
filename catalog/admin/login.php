<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2020 osCommerce

  Released under the GNU General Public License
 */

$login_request = true;

require 'includes/application_top.php';

require DIR_FS_CATALOG.'includes/functions/password_funcs.php';

$action = ($_GET['action'] ?? '');

// prepare to logout an active administrator if the login page is accessed again
if (isset($_SESSION['admin'])) {
    $action = 'logoff';
}

if (!empty($action)) {
    switch ($action) {
        case 'process':
            if (isset($_SESSION['redirect_origin'], $redirect_origin['auth_user']) && !isset($_POST['username'])) {
                $username = tep_db_prepare_input($redirect_origin['auth_user']);
                $password = tep_db_prepare_input($redirect_origin['auth_pw']);
            } else {
                $username = tep_db_prepare_input($_POST['username']);
                $password = tep_db_prepare_input($_POST['password']);
            }

            $actionRecorder = new actionRecorderAdmin('ar_admin_login', null, $username);

            if ($actionRecorder->canPerform()) {
                $check_query = tep_db_query("select id, user_name, user_password from administrators where user_name = '".tep_db_input($username)."'");

                if (tep_db_num_rows($check_query) === 1) {
                    $check = tep_db_fetch_array($check_query);

                    if (tep_validate_password($password, $check['user_password'])) {
                        // migrate old hashed password to new phpass password
                        if (tep_password_type($check['user_password']) !== 'phpass') {
                            tep_db_query("update administrators set user_password = '".tep_encrypt_password($password)."' where id = '".(int) $check['id']."'");
                        }

                        tep_session_register('admin');

                        $admin = ['id' => $check['id'],
                            'username' => $check['user_name']];

                        $actionRecorder->_user_id = $admin['id'];
                        $actionRecorder->record();

                        if (isset($_SESSION['redirect_origin'])) {
                            $page = $redirect_origin['page'];

                            $get_string = http_build_query($redirect_origin['get']);

                            unset($_SESSION['redirect_origin']);

                            tep_redirect(tep_href_link($page, $get_string));
                        } else {
                            tep_redirect(tep_href_link('index.php'));
                        }
                    }
                }

                if (isset($_POST['username'])) {
                    $messageStack->add(ERROR_INVALID_ADMINISTRATOR, 'error');
                }
            } else {
                $messageStack->add(sprintf(ERROR_ACTION_RECORDER, \defined('MODULE_ACTION_RECORDER_ADMIN_LOGIN_MINUTES') ? (int) MODULE_ACTION_RECORDER_ADMIN_LOGIN_MINUTES : 5));
            }

            if (isset($_POST['username'])) {
                $actionRecorder->record(false);
            }

            break;
        case 'logoff':
            unset($_SESSION['admin']);

            if (isset($_SERVER['PHP_AUTH_USER']) && !empty($_SERVER['PHP_AUTH_USER']) && isset($_SERVER['PHP_AUTH_PW']) && !empty($_SERVER['PHP_AUTH_PW'])) {
                tep_session_register('auth_ignore');
                $auth_ignore = true;
            }

            tep_redirect(tep_href_link('index.php'));

            break;
        case 'create':
            $check_query = tep_db_query('select id from administrators limit 1');

            if (tep_db_num_rows($check_query) === 0) {
                $username = tep_db_prepare_input($_POST['username']);
                $password = tep_db_prepare_input($_POST['password']);

                if (!empty($username)) {
                    tep_db_query("insert into administrators (user_name, user_password) values ('".tep_db_input($username)."', '".tep_db_input(tep_encrypt_password($password))."')");
                }
            }

            tep_redirect(tep_href_link('login.php'));

            break;
    }
}

$languages = tep_get_languages();
$languages_array = [];
$languages_selected = DEFAULT_LANGUAGE;

for ($i = 0, $n = \count($languages); $i < $n; ++$i) {
    $languages_array[] = ['id' => $languages[$i]['code'],
        'text' => $languages[$i]['name']];

    if ($languages[$i]['directory'] === $language) {
        $languages_selected = $languages[$i]['code'];
    }
}

$admins_check_query = tep_db_query('select id from administrators limit 1');

if (tep_db_num_rows($admins_check_query) < 1) {
    $messageStack->add(TEXT_CREATE_FIRST_ADMINISTRATOR, 'warning');
}

require 'includes/template_top.php';
?>

<table border="0" width="100%" cellspacing="2" cellpadding="2" style="width: 320px; margin: auto;">
  <tr>
    <td><table border="0" width="100%" cellspacing="0" cellpadding="0" height="40">
      <tr>
        <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>

<?php
  if (\count($languages_array) > 1) {
      ?>

        <td class="pageHeading" align="right"><?php echo tep_draw_form('adminlanguage', 'index.php', '', 'get').tep_draw_pull_down_menu('language', $languages_array, $languages_selected, 'onchange="this.form.submit();"').tep_hide_session_id().'</form>'; ?></td>

<?php
  }

?>

      </tr>
    </table></td>
  </tr>
  <tr>
    <td>

<?php
  $heading = [];
$contents = [];

if (tep_db_num_rows($admins_check_query) > 0) {
    $heading[] = ['text' => '<strong>'.HEADING_TITLE.'</strong>'];

    $contents = ['form' => tep_draw_form('login', 'login.php', 'action=process')];
    $contents[] = ['text' => TEXT_USERNAME.'<br />'.tep_draw_input_field('username','', 'autofocus')];
    $contents[] = ['text' => '<br />'.TEXT_PASSWORD.'<br />'.tep_draw_password_field('password')];
    $contents[] = ['align' => 'center', 'text' => '<br />'.tep_draw_button(BUTTON_LOGIN, 'key')];
} else {
    $heading[] = ['text' => '<strong>'.HEADING_TITLE.'</strong>'];

    $contents = ['form' => tep_draw_form('login', 'login.php', 'action=create')];
    $contents[] = ['text' => TEXT_CREATE_FIRST_ADMINISTRATOR];
    $contents[] = ['text' => '<br />'.TEXT_USERNAME.'<br />'.tep_draw_input_field('username')];
    $contents[] = ['text' => '<br />'.TEXT_PASSWORD.'<br />'.tep_draw_password_field('password')];
    $contents[] = ['align' => 'center', 'text' => '<br />'.tep_draw_button(BUTTON_CREATE_ADMINISTRATOR, 'key')];
}

$box = new box();
echo $box->infoBox($heading, $contents);
?>

    </td>
  </tr>
</table>

<?php
  require 'includes/template_bottom.php';

require 'includes/application_bottom.php';
?>
