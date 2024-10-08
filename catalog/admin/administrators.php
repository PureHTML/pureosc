<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2020 osCommerce

  Released under the GNU General Public License
 */

require 'includes/application_top.php';

$htaccess_array = null;
$htpasswd_array = null;
$is_iis = stripos($_SERVER['SERVER_SOFTWARE'], 'iis');

$authuserfile_array = ['##### OSCOMMERCE ADMIN PROTECTION - BEGIN #####',
    'AuthType Basic',
    'AuthName "osCommerce Online Merchant Administration Tool"',
    'AuthUserFile '.DIR_FS_ADMIN.'.htpasswd_oscommerce',
    'Require valid-user',
    '##### OSCOMMERCE ADMIN PROTECTION - END #####'];

if (!$is_iis && file_exists(DIR_FS_ADMIN.'.htpasswd_oscommerce') && tep_is_writable(DIR_FS_ADMIN.'.htpasswd_oscommerce') && file_exists(DIR_FS_ADMIN.'.htaccess') && tep_is_writable(DIR_FS_ADMIN.'.htaccess')) {
    $htaccess_array = [];
    $htpasswd_array = [];

    if (filesize(DIR_FS_ADMIN.'.htaccess') > 0) {
        $fg = fopen(DIR_FS_ADMIN.'.htaccess', 'rb');
        $data = fread($fg, filesize(DIR_FS_ADMIN.'.htaccess'));
        fclose($fg);

        $htaccess_array = explode("\n", $data);
    }

    if (filesize(DIR_FS_ADMIN.'.htpasswd_oscommerce') > 0) {
        $fg = fopen(DIR_FS_ADMIN.'.htpasswd_oscommerce', 'rb');
        $data = fread($fg, filesize(DIR_FS_ADMIN.'.htpasswd_oscommerce'));
        fclose($fg);

        $htpasswd_array = explode("\n", $data);
    }
}

$action = ($_GET['action'] ?? '');

if (!empty($action)) {
    switch ($action) {
        case 'insert':
            require DIR_FS_CATALOG.'includes/functions/password_funcs.php';

            $username = tep_db_prepare_input($_POST['username']);
            $password = tep_db_prepare_input($_POST['password']);

            $check_query = tep_db_query("select id from administrators where user_name = '".tep_db_input($username)."' limit 1");

            if (tep_db_num_rows($check_query) < 1) {
                tep_db_query("insert into administrators (user_name, user_password) values ('".tep_db_input($username)."', '".tep_db_input(tep_encrypt_password($password))."')");

                if (\is_array($htpasswd_array)) {
                    for ($i = 0, $n = \count($htpasswd_array); $i < $n; ++$i) {
                        [$ht_username, $ht_password] = explode(':', $htpasswd_array[$i], 2);

                        if ($ht_username === $username) {
                            unset($htpasswd_array[$i]);
                        }
                    }

                    if (isset($_POST['htaccess']) && ($_POST['htaccess'] === 'true')) {
                        $htpasswd_array[] = $username.':'.tep_crypt_apr_md5($password);
                    }

                    $fp = fopen(DIR_FS_ADMIN.'.htpasswd_oscommerce', 'wb');
                    fwrite($fp, implode("\n", $htpasswd_array));
                    fclose($fp);

                    if (!\in_array('AuthUserFile '.DIR_FS_ADMIN.'.htpasswd_oscommerce', $htaccess_array, true) && !empty($htpasswd_array)) {
                        array_splice($htaccess_array, \count($htaccess_array), 0, $authuserfile_array);
                    } elseif (empty($htpasswd_array)) {
                        for ($i = 0, $n = \count($htaccess_array); $i < $n; ++$i) {
                            if (\in_array($htaccess_array[$i], $authuserfile_array, true)) {
                                unset($htaccess_array[$i]);
                            }
                        }
                    }

                    $fp = fopen(DIR_FS_ADMIN.'.htaccess', 'wb');
                    fwrite($fp, implode("\n", $htaccess_array));
                    fclose($fp);
                }
            } else {
                $messageStack->add_session(ERROR_ADMINISTRATOR_EXISTS, 'error');
            }

            tep_redirect(tep_href_link('administrators.php'));

            break;
        case 'save':
            require DIR_FS_CATALOG.'includes/functions/password_funcs.php';

            $username = tep_db_prepare_input($_POST['username']);
            $password = tep_db_prepare_input($_POST['password']);

            $check_query = tep_db_query("select id, user_name from administrators where id = '".(int) $_GET['aID']."'");
            $check = tep_db_fetch_array($check_query);

            // update username in current session if changed
            if (($check['id'] === $admin['id']) && ($check['user_name'] !== $admin['username'])) {
                $admin['username'] = $username;
            }

            // update username in htpasswd if changed
            if (\is_array($htpasswd_array)) {
                for ($i = 0, $n = \count($htpasswd_array); $i < $n; ++$i) {
                    [$ht_username, $ht_password] = explode(':', $htpasswd_array[$i], 2);

                    if (($check['user_name'] === $ht_username) && ($check['user_name'] !== $username)) {
                        $htpasswd_array[$i] = $username.':'.$ht_password;
                    }
                }
            }

            tep_db_query("update administrators set user_name = '".tep_db_input($username)."' where id = '".(int) $_GET['aID']."'");

            if (!empty($password)) {
                // update password in htpasswd
                if (\is_array($htpasswd_array)) {
                    for ($i = 0, $n = \count($htpasswd_array); $i < $n; ++$i) {
                        [$ht_username, $ht_password] = explode(':', $htpasswd_array[$i], 2);

                        if ($ht_username === $username) {
                            unset($htpasswd_array[$i]);
                        }
                    }

                    if (isset($_POST['htaccess']) && ($_POST['htaccess'] === 'true')) {
                        $htpasswd_array[] = $username.':'.tep_crypt_apr_md5($password);
                    }
                }

                tep_db_query("update administrators set user_password = '".tep_db_input(tep_encrypt_password($password))."' where id = '".(int) $_GET['aID']."'");
            } elseif (!isset($_POST['htaccess']) || ($_POST['htaccess'] !== 'true')) {
                if (\is_array($htpasswd_array)) {
                    for ($i = 0, $n = \count($htpasswd_array); $i < $n; ++$i) {
                        [$ht_username, $ht_password] = explode(':', $htpasswd_array[$i], 2);

                        if ($ht_username === $username) {
                            unset($htpasswd_array[$i]);
                        }
                    }
                }
            }

            // write new htpasswd file
            if (\is_array($htpasswd_array)) {
                $fp = fopen(DIR_FS_ADMIN.'.htpasswd_oscommerce', 'wb');
                fwrite($fp, implode("\n", $htpasswd_array));
                fclose($fp);

                if (!\in_array('AuthUserFile '.DIR_FS_ADMIN.'.htpasswd_oscommerce', $htaccess_array, true) && !empty($htpasswd_array)) {
                    array_splice($htaccess_array, \count($htaccess_array), 0, $authuserfile_array);
                } elseif (empty($htpasswd_array)) {
                    for ($i = 0, $n = \count($htaccess_array); $i < $n; ++$i) {
                        if (\in_array($htaccess_array[$i], $authuserfile_array, true)) {
                            unset($htaccess_array[$i]);
                        }
                    }
                }

                $fp = fopen(DIR_FS_ADMIN.'.htaccess', 'wb');
                fwrite($fp, implode("\n", $htaccess_array));
                fclose($fp);
            }

            tep_redirect(tep_href_link('administrators.php', 'aID='.(int) $_GET['aID']));

            break;
        case 'deleteconfirm':
            $id = tep_db_prepare_input($_GET['aID']);

            $check_query = tep_db_query("select id, user_name from administrators where id = '".(int) $id."'");
            $check = tep_db_fetch_array($check_query);

            if ($admin['id'] === $check['id']) {
                unset($_SESSION['admin']);
            }

            tep_db_query("delete from administrators where id = '".(int) $id."'");

            if (\is_array($htpasswd_array)) {
                for ($i = 0, $n = \count($htpasswd_array); $i < $n; ++$i) {
                    [$ht_username, $ht_password] = explode(':', $htpasswd_array[$i], 2);

                    if ($ht_username === $check['user_name']) {
                        unset($htpasswd_array[$i]);
                    }
                }

                $fp = fopen(DIR_FS_ADMIN.'.htpasswd_oscommerce', 'wb');
                fwrite($fp, implode("\n", $htpasswd_array));
                fclose($fp);

                if (empty($htpasswd_array)) {
                    for ($i = 0, $n = \count($htaccess_array); $i < $n; ++$i) {
                        if (\in_array($htaccess_array[$i], $authuserfile_array, true)) {
                            unset($htaccess_array[$i]);
                        }
                    }

                    $fp = fopen(DIR_FS_ADMIN.'.htaccess', 'wb');
                    fwrite($fp, implode("\n", $htaccess_array));
                    fclose($fp);
                }
            }

            tep_redirect(tep_href_link('administrators.php'));

            break;
    }
}

$secMessageStack = new messageStack();

if (\is_array($htpasswd_array)) {
    if (empty($htpasswd_array)) {
        $secMessageStack->add(sprintf(HTPASSWD_INFO, implode('<br />', $authuserfile_array)), 'error');
    } else {
        $secMessageStack->add(HTPASSWD_SECURED, 'success');
    }
} elseif (!$is_iis) {
    $secMessageStack->add(HTPASSWD_PERMISSIONS, 'error');
}

require 'includes/template_top.php';
?>

    <table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td>
<?php
  echo $secMessageStack->output();
?>
        </td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_ADMINISTRATORS; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_HTPASSWD; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
  $admins_query = tep_db_query('select id, user_name from administrators order by user_name');

while ($admins = tep_db_fetch_array($admins_query)) {
    if ((!isset($_GET['aID']) || (isset($_GET['aID']) && ($_GET['aID'] === $admins['id']))) && !isset($aInfo) && (substr($action, 0, 3) !== 'new')) {
        $aInfo = new objectInfo($admins);
    }

    $htpasswd_secured = tep_image('images/icon_status_red.gif', 'Not Secured', 10, 10);

    if ($is_iis) {
        $htpasswd_secured = 'N/A';
    }

    if (\is_array($htpasswd_array)) {
        for ($i = 0, $n = \count($htpasswd_array); $i < $n; ++$i) {
            [$ht_username, $ht_password] = explode(':', $htpasswd_array[$i], 2);

            if ($ht_username === $admins['user_name']) {
                $htpasswd_secured = tep_image('images/icon_status_green.gif', 'Secured', 10, 10);

                break;
            }
        }
    }

    if ((isset($aInfo) && \is_object($aInfo)) && ($admins['id'] === $aInfo->id)) {
        echo '                  <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\''.tep_href_link('administrators.php', 'aID='.$aInfo->id.'&action=edit').'\'">'."\n";
    } else {
        echo '                  <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\''.tep_href_link('administrators.php', 'aID='.$admins['id']).'\'">'."\n";
    }

    ?>
                <td class="dataTableContent"><?php echo $admins['user_name']; ?></td>
                <td class="dataTableContent" align="center"><?php echo $htpasswd_secured; ?></td>
                <td class="dataTableContent" align="right"><?php if ((isset($aInfo) && \is_object($aInfo)) && ($admins['id'] === $aInfo->id)) {
                    echo tep_image('images/icon_arrow_right.gif', '');
                } else {
                    echo '<a href="'.tep_href_link('administrators.php', 'aID='.$admins['id']).'">'.tep_image('images/icon_info.gif', IMAGE_ICON_INFO).'</a>';
                }

    ?>&nbsp;</td>
              </tr>
<?php
}

?>
              <tr>
                <td class="smallText" colspan="3" align="right"><?php echo tep_draw_button(IMAGE_INSERT, 'plus', tep_href_link('administrators.php', 'action=new')); ?></td>
              </tr>
            </table></td>
<?php
  $heading = [];
$contents = [];

switch ($action) {
    case 'new':
        $heading[] = ['text' => '<strong>'.TEXT_INFO_HEADING_NEW_ADMINISTRATOR.'</strong>'];

        $contents = ['form' => tep_draw_form('administrator', 'administrators.php', 'action=insert', 'post', 'autocomplete="off"')];
        $contents[] = ['text' => TEXT_INFO_INSERT_INTRO];
        $contents[] = ['text' => '<br />'.TEXT_INFO_USERNAME.'<br />'.tep_draw_input_field('username')];
        $contents[] = ['text' => '<br />'.TEXT_INFO_PASSWORD.'<br />'.tep_draw_password_field('password')];

        if (\is_array($htpasswd_array)) {
            $contents[] = ['text' => '<br />'.tep_draw_checkbox_field('htaccess', 'true').' '.TEXT_INFO_PROTECT_WITH_HTPASSWD];
        }

        $contents[] = ['align' => 'center', 'text' => '<br />'.tep_draw_button(IMAGE_SAVE, 'disk', null, 'primary').tep_draw_button(IMAGE_CANCEL, 'close', tep_href_link('administrators.php'))];

        break;
    case 'edit':
        $heading[] = ['text' => '<strong>'.$aInfo->user_name.'</strong>'];

        $contents = ['form' => tep_draw_form('administrator', 'administrators.php', 'aID='.$aInfo->id.'&action=save', 'post', 'autocomplete="off"')];
        $contents[] = ['text' => TEXT_INFO_EDIT_INTRO];
        $contents[] = ['text' => '<br />'.TEXT_INFO_USERNAME.'<br />'.tep_draw_input_field('username', $aInfo->user_name)];
        $contents[] = ['text' => '<br />'.TEXT_INFO_NEW_PASSWORD.'<br />'.tep_draw_password_field('password')];

        if (\is_array($htpasswd_array)) {
            $default_flag = false;

            for ($i = 0, $n = \count($htpasswd_array); $i < $n; ++$i) {
                [$ht_username, $ht_password] = explode(':', $htpasswd_array[$i], 2);

                if ($ht_username === $aInfo->user_name) {
                    $default_flag = true;

                    break;
                }
            }

            $contents[] = ['text' => '<br />'.tep_draw_checkbox_field('htaccess', 'true', $default_flag).' '.TEXT_INFO_PROTECT_WITH_HTPASSWD];
        }

        $contents[] = ['align' => 'center', 'text' => '<br />'.tep_draw_button(IMAGE_SAVE, 'disk', null, 'primary').tep_draw_button(IMAGE_CANCEL, 'close', tep_href_link('administrators.php', 'aID='.$aInfo->id))];

        break;
    case 'delete':
        $heading[] = ['text' => '<strong>'.$aInfo->user_name.'</strong>'];

        $contents = ['form' => tep_draw_form('administrator', 'administrators.php', 'aID='.$aInfo->id.'&action=deleteconfirm')];
        $contents[] = ['text' => TEXT_INFO_DELETE_INTRO];
        $contents[] = ['text' => '<br /><strong>'.$aInfo->user_name.'</strong>'];
        $contents[] = ['align' => 'center', 'text' => '<br />'.tep_draw_button(IMAGE_DELETE, 'trash', null, 'primary').tep_draw_button(IMAGE_CANCEL, 'close', tep_href_link('administrators.php', 'aID='.$aInfo->id))];

        break;

    default:
        if (isset($aInfo) && \is_object($aInfo)) {
            $heading[] = ['text' => '<strong>'.$aInfo->user_name.'</strong>'];

            $contents[] = ['align' => 'center', 'text' => tep_draw_button(IMAGE_EDIT, 'document', tep_href_link('administrators.php', 'aID='.$aInfo->id.'&action=edit')).tep_draw_button(IMAGE_DELETE, 'trash', tep_href_link('administrators.php', 'aID='.$aInfo->id.'&action=delete'))];
        }

        break;
}

if ((!empty($heading)) && (!empty($contents))) {
    echo '            <td width="25%" valign="top">'."\n";

    $box = new box();
    echo $box->infoBox($heading, $contents);

    echo "            </td>\n";
}

?>
          </tr>
        </table></td>
      </tr>
    </table>

<?php
  require 'includes/template_bottom.php';

require 'includes/application_bottom.php';
?>
