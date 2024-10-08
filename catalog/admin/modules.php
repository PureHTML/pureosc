<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2020 osCommerce

  Released under the GNU General Public License
 */

require 'includes/application_top.php';

$set = ($_GET['set'] ?? '');

$modules = $cfgModules->getAll();

if (empty($set) || !$cfgModules->exists($set)) {
    $set = $modules[0]['code'];
}

$module_type = $cfgModules->get($set, 'code');
$module_directory = $cfgModules->get($set, 'directory');
$module_language_directory = $cfgModules->get($set, 'language_directory');
$module_key = $cfgModules->get($set, 'key');
\define('HEADING_TITLE', $cfgModules->get($set, 'title'));
$template_integration = $cfgModules->get($set, 'template_integration');

$action = ($_GET['action'] ?? '');

if (!empty($action)) {
    switch ($action) {
        case 'save':
            foreach ($_POST['configuration'] as $key => $value) {
                if (\is_array($value)) {
                    $value = preg_replace('/, --none--/', '', implode(', ', $value));
                }

                tep_db_query("update configuration set configuration_value = '".tep_db_input(tep_db_prepare_input($value))."' where configuration_key = '".tep_db_input(tep_db_prepare_input($key))."'");
            }

            tep_redirect(tep_href_link('modules.php', 'set='.$set.'&module='.$_GET['module']));

            break;
        case 'install':
        case 'remove':
            $file_extension = substr($PHP_SELF, strrpos($PHP_SELF, '.'));
            $class = basename($_GET['module']);

            if (file_exists($module_directory.$class.$file_extension)) {
                include $module_language_directory.$language.'/modules/'.$module_type.'/'.$class.$file_extension;

                include $module_directory.$class.$file_extension;
                $module = new $class();

                if ($action === 'install') {
                    if ($module->check() > 0) { // remove module if already installed
                        $module->remove();
                    }

                    $module->install();

                    $modules_installed = explode(';', \constant($module_key));

                    if (!\in_array($class.$file_extension, $modules_installed, true)) {
                        $modules_installed[] = $class.$file_extension;
                    }

                    tep_db_query("update configuration set configuration_value = '".implode(';', $modules_installed)."' where configuration_key = '".tep_db_input($module_key)."'");
                    tep_redirect(tep_href_link('modules.php', 'set='.$set.'&module='.$class));
                } elseif ($action === 'remove') {
                    $module->remove();

                    $modules_installed = explode(';', \constant($module_key));

                    if (\in_array($class.$file_extension, $modules_installed, true)) {
                        unset($modules_installed[array_search($class.$file_extension, $modules_installed, true)]);
                    }

                    tep_db_query("update configuration set configuration_value = '".implode(';', $modules_installed)."' where configuration_key = '".tep_db_input($module_key)."'");
                    tep_redirect(tep_href_link('modules.php', 'set='.$set));
                }
            }

            tep_redirect(tep_href_link('modules.php', 'set='.$set.'&module='.$class));

            break;
    }
}

require 'includes/template_top.php';

$modules_installed = (\defined($module_key) ? explode(';', \constant($module_key)) : []);
$new_modules_counter = 0;

$file_extension = substr($PHP_SELF, strrpos($PHP_SELF, '.'));
$directory_array = [];

if ($dir = @dir($module_directory)) {
    while ($file = $dir->read()) {
        if (!is_dir($module_directory.$file)) {
            if (substr($file, strrpos($file, '.')) === $file_extension) {
                if (isset($_GET['list']) && ($_GET['list'] = 'new')) {
                    if (!\in_array($file, $modules_installed, true)) {
                        $directory_array[] = $file;
                    }
                } else {
                    if (\in_array($file, $modules_installed, true)) {
                        $directory_array[] = $file;
                    } else {
                        ++$new_modules_counter;
                    }
                }
            }
        }
    }

    sort($directory_array);
    $dir->close();
}

?>

    <table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
<?php
  if (isset($_GET['list'])) {
      echo '            <td class="smallText" align="right">'.tep_draw_button(IMAGE_BACK, 'triangle-1-w', tep_href_link('modules.php', 'set='.$set)).'</td>';
  } else {
      echo '            <td class="smallText" align="right">'.tep_draw_button(IMAGE_MODULE_INSTALL.' ('.$new_modules_counter.')', 'plus', tep_href_link('modules.php', 'set='.$set.'&list=new')).'</td>';
  }

?>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_MODULES; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_SORT_ORDER; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
  $installed_modules = [];

for ($i = 0, $n = \count($directory_array); $i < $n; ++$i) {
    $file = $directory_array[$i];

    include $module_language_directory.$language.'/modules/'.$module_type.'/'.$file;

    include $module_directory.$file;

    $class = substr($file, 0, strrpos($file, '.'));

    if (tep_class_exists($class)) {
        $module = new $class();

        if ($module->check() > 0) {
            if (($module->sort_order > 0) && !isset($installed_modules[$module->sort_order])) {
                $installed_modules[$module->sort_order] = $file;
            } else {
                $installed_modules[] = $file;
            }
        }

        if ((!isset($_GET['module']) || (isset($_GET['module']) && ($_GET['module'] === $class))) && !isset($mInfo)) {
            $module_info = ['code' => $module->code,
                'title' => $module->title,
                'description' => $module->description,
                'status' => $module->check(),
                'signature' => ($module->signature ?? null),
                'api_version' => ($module->api_version ?? null)];

            $module_keys = $module->keys();

            $keys_extra = [];

            for ($j = 0, $k = \count($module_keys); $j < $k; ++$j) {
                $key_value_query = tep_db_query("select configuration_title, configuration_value, configuration_description, use_function, set_function from configuration where configuration_key = '".tep_db_input($module_keys[$j])."'");
                $key_value = tep_db_fetch_array($key_value_query);

                if (!empty($key_value)) {
                    $keys_extra[$module_keys[$j]]['title'] = $key_value['configuration_title'];
                    $keys_extra[$module_keys[$j]]['value'] = $key_value['configuration_value'];
                    $keys_extra[$module_keys[$j]]['description'] = $key_value['configuration_description'];
                    $keys_extra[$module_keys[$j]]['use_function'] = $key_value['use_function'];
                    $keys_extra[$module_keys[$j]]['set_function'] = $key_value['set_function'];
                }
            }

            $module_info['keys'] = $keys_extra;

            $mInfo = new objectInfo($module_info);
        }

        if (isset($mInfo) && \is_object($mInfo) && ($class === $mInfo->code)) {
            if ($module->check() > 0) {
                echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\''.tep_href_link('modules.php', 'set='.$set.'&module='.$class.'&action=edit').'\'">'."\n";
            } else {
                echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">'."\n";
            }
        } else {
            echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\''.tep_href_link('modules.php', 'set='.$set.(isset($_GET['list']) ? '&list=new' : '').'&module='.$class).'\'">'."\n";
        }

        ?>
                <td class="dataTableContent"><?php echo $module->title; ?></td>
                <td class="dataTableContent" align="right"><?php if (\in_array($module->code.$file_extension, $modules_installed, true) && is_numeric($module->sort_order)) {
                    echo $module->sort_order;
                }

        ?></td>
                <td class="dataTableContent" align="right"><?php if (isset($mInfo) && \is_object($mInfo) && ($class === $mInfo->code)) {
                    echo tep_image('images/icon_arrow_right.gif');
                } else {
                    echo '<a href="'.tep_href_link('modules.php', 'set='.$set.(isset($_GET['list']) ? '&list=new' : '').'&module='.$class).'">'.tep_image('images/icon_info.gif', IMAGE_ICON_INFO).'</a>';
                }

        ?>&nbsp;</td>
              </tr>
<?php
    }
}

if (!isset($_GET['list'])) {
    ksort($installed_modules);
    $check_query = tep_db_query("select configuration_value from configuration where configuration_key = '".tep_db_input($module_key)."'");

    if (tep_db_num_rows($check_query)) {
        $check = tep_db_fetch_array($check_query);

        if ($check['configuration_value'] !== implode(';', $installed_modules)) {
            tep_db_query("update configuration set configuration_value = '".implode(';', $installed_modules)."', last_modified = now() where configuration_key = '".tep_db_input($module_key)."'");
        }
    } else {
        tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Installed Modules', '".tep_db_input($module_key)."', '".implode(';', $installed_modules)."', 'This is automatically updated. No need to edit.', '6', '0', now())");
    }

    if ($template_integration === true) {
        $check_query = tep_db_query("select configuration_value from configuration where configuration_key = 'TEMPLATE_BLOCK_GROUPS'");

        if (tep_db_num_rows($check_query)) {
            $check = tep_db_fetch_array($check_query);
            $tbgroups_array = explode(';', $check['configuration_value']);

            if (!\in_array($module_type, $tbgroups_array, true)) {
                $tbgroups_array[] = $module_type;
                sort($tbgroups_array);
                tep_db_query("update configuration set configuration_value = '".implode(';', $tbgroups_array)."', last_modified = now() where configuration_key = 'TEMPLATE_BLOCK_GROUPS'");
            }
        } else {
            tep_db_query("insert into configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Installed Template Block Groups', 'TEMPLATE_BLOCK_GROUPS', '".tep_db_input($module_type)."', 'This is automatically updated. No need to edit.', '6', '0', now())");
        }
    }
}

?>
              <tr>
                <td colspan="3" class="smallText"><?php echo TEXT_MODULE_DIRECTORY.' '.$module_directory; ?></td>
              </tr>
            </table></td>
<?php
  $heading = [];
$contents = [];

switch ($action) {
    case 'edit':
        $keys = '';

        foreach ($mInfo->keys as $key => $value) {
            $keys .= '<strong>'.$value['title'].'</strong><br />'.$value['description'].'<br />';

            if ($value['set_function']) {
                eval('$keys .= '.$value['set_function']."'".tep_output_string_protected($value['value'])."', '".$key."');");
            } else {
                $keys .= tep_draw_input_field('configuration['.$key.']', $value['value']);
            }

            $keys .= '<br /><br />';
        }

        $keys = substr($keys, 0, strrpos($keys, '<br /><br />'));

        $heading[] = ['text' => '<strong>'.$mInfo->title.'</strong>'];

        $contents = ['form' => tep_draw_form('modules', 'modules.php', 'set='.$set.'&module='.$_GET['module'].'&action=save')];
        $contents[] = ['text' => $keys];
        $contents[] = ['align' => 'center', 'text' => '<br />'.tep_draw_button(IMAGE_SAVE, 'disk', null, 'primary').tep_draw_button(IMAGE_CANCEL, 'close', tep_href_link('modules.php', 'set='.$set.'&module='.$_GET['module']))];

        break;

    default:
        $heading[] = ['text' => '<strong>'.$mInfo->title.'</strong>'];

        if (\in_array($mInfo->code.$file_extension, $modules_installed, true) && ($mInfo->status > 0)) {
            $keys = '';

            foreach ($mInfo->keys as $value) {
                $keys .= '<strong>'.$value['title'].'</strong><br />';

                if ($value['use_function']) {
                    $use_function = $value['use_function'];

                    if (preg_match('/->/', $use_function)) {
                        $class_method = explode('->', $use_function);

                        if (!isset(${$class_method[0]}) || !\is_object(${$class_method[0]})) {
                            include 'includes/classes/'.$class_method[0].'.php';
                            ${$class_method[0]} = new $class_method[0]();
                        }

                        $keys .= tep_call_function($class_method[1], $value['value'], ${$class_method[0]});
                    } else {
                        $keys .= tep_call_function($use_function, $value['value']);
                    }
                } else {
                    $keys .= $value['value'];
                }

                $keys .= '<br /><br />';
            }

            $keys = substr($keys, 0, strrpos($keys, '<br /><br />'));

            $contents[] = ['align' => 'center', 'text' => tep_draw_button(IMAGE_EDIT, 'document', tep_href_link('modules.php', 'set='.$set.'&module='.$mInfo->code.'&action=edit')).tep_draw_button(IMAGE_MODULE_REMOVE, 'minus', tep_href_link('modules.php', 'set='.$set.'&module='.$mInfo->code.'&action=remove'))];

            if (isset($mInfo->signature) && ([$scode, $smodule, $sversion, $soscversion] = explode('|', $mInfo->signature))) {
                $contents[] = ['text' => '<br />'.tep_image('images/icon_info.gif', IMAGE_ICON_INFO).'&nbsp;<strong>'.TEXT_INFO_VERSION.'</strong> '.$sversion.' (<a href="http://sig.oscommerce.com/'.$mInfo->signature.'" target="_blank">'.TEXT_INFO_ONLINE_STATUS.'</a>)'];
            }

            if (isset($mInfo->api_version)) {
                $contents[] = ['text' => tep_image('images/icon_info.gif', IMAGE_ICON_INFO).'&nbsp;<strong>'.TEXT_INFO_API_VERSION.'</strong> '.$mInfo->api_version];
            }

            $contents[] = ['text' => '<br />'.$mInfo->description];
            $contents[] = ['text' => '<br />'.$keys];
        } elseif (isset($_GET['list']) && ($_GET['list'] === 'new')) {
            if (isset($mInfo)) {
                $contents[] = ['align' => 'center', 'text' => tep_draw_button(IMAGE_MODULE_INSTALL, 'plus', tep_href_link('modules.php', 'set='.$set.'&module='.$mInfo->code.'&action=install'))];

                if (isset($mInfo->signature) && ([$scode, $smodule, $sversion, $soscversion] = explode('|', $mInfo->signature))) {
                    $contents[] = ['text' => '<br />'.tep_image('images/icon_info.gif', IMAGE_ICON_INFO).'&nbsp;<strong>'.TEXT_INFO_VERSION.'</strong> '.$sversion.' (<a href="http://sig.oscommerce.com/'.$mInfo->signature.'" target="_blank">'.TEXT_INFO_ONLINE_STATUS.'</a>)'];
                }

                if (isset($mInfo->api_version)) {
                    $contents[] = ['text' => tep_image('images/icon_info.gif', IMAGE_ICON_INFO).'&nbsp;<strong>'.TEXT_INFO_API_VERSION.'</strong> '.$mInfo->api_version];
                }

                $contents[] = ['text' => '<br />'.$mInfo->description];
            }
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
