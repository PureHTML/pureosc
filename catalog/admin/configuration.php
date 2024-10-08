<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2020 osCommerce

  Released under the GNU General Public License
 */

require 'includes/application_top.php';

$action = ($_GET['action'] ?? '');

if (!empty($action)) {
    switch ($action) {
        case 'save':
            $configuration_value = tep_db_prepare_input($_POST['configuration_value']);
            $cID = tep_db_prepare_input($_GET['cID']);

            tep_db_query("update configuration set configuration_value = '".tep_db_input($configuration_value)."', last_modified = now() where configuration_id = '".(int) $cID."'");

            tep_redirect(tep_href_link('configuration.php', 'gID='.$_GET['gID'].'&cID='.$cID));

            break;
    }
}

$gID = (isset($_GET['gID'])) ? $_GET['gID'] : 1;

$cfg_group_query = tep_db_query("select configuration_group_title from configuration_group where configuration_group_id = '".(int) $gID."'");
$cfg_group = tep_db_fetch_array($cfg_group_query);

require 'includes/template_top.php';
?>

    <table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo $cfg_group['configuration_group_title']; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_CONFIGURATION_TITLE; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_CONFIGURATION_VALUE; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
  $configuration_query = tep_db_query("select configuration_id, configuration_title, configuration_value, use_function from configuration where configuration_group_id = '".(int) $gID."' order by sort_order");

while ($configuration = tep_db_fetch_array($configuration_query)) {
    if (!empty($configuration['use_function'])) {
        $use_function = $configuration['use_function'];

        if (preg_match('/->/', $use_function)) {
            $class_method = explode('->', $use_function);

            if (!\is_object(${$class_method[0]})) {
                include 'includes/classes/'.$class_method[0].'.php';
                ${$class_method[0]} = new $class_method[0]();
            }

            $cfgValue = tep_call_function($class_method[1], $configuration['configuration_value'], ${$class_method[0]});
        } else {
            $cfgValue = tep_call_function($use_function, $configuration['configuration_value']);
        }
    } else {
        $cfgValue = $configuration['configuration_value'];
    }

    if ((!isset($_GET['cID']) || (isset($_GET['cID']) && ($_GET['cID'] === $configuration['configuration_id']))) && !isset($cInfo) && (substr($action, 0, 3) !== 'new')) {
        $cfg_extra_query = tep_db_query("select configuration_key, configuration_description, date_added, last_modified, use_function, set_function from configuration where configuration_id = '".(int) $configuration['configuration_id']."'");
        $cfg_extra = tep_db_fetch_array($cfg_extra_query);

        $cInfo_array = array_merge($configuration, $cfg_extra);
        $cInfo = new objectInfo($cInfo_array);
    }

    if ((isset($cInfo) && \is_object($cInfo)) && ($configuration['configuration_id'] === $cInfo->configuration_id)) {
        echo '                  <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\''.tep_href_link('configuration.php', 'gID='.$_GET['gID'].'&cID='.$cInfo->configuration_id.'&action=edit').'\'">'."\n";
    } else {
        echo '                  <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\''.tep_href_link('configuration.php', 'gID='.$_GET['gID'].'&cID='.$configuration['configuration_id']).'\'">'."\n";
    }

    ?>
                <td class="dataTableContent"><?php echo $configuration['configuration_title']; ?></td>
                <td class="dataTableContent"><?php echo htmlspecialchars((string) $cfgValue); ?></td>
                <td class="dataTableContent" align="right"><?php if ((isset($cInfo) && \is_object($cInfo)) && ($configuration['configuration_id'] === $cInfo->configuration_id)) {
                    echo tep_image('images/icon_arrow_right.gif', '');
                } else {
                    echo '<a href="'.tep_href_link('configuration.php', 'gID='.$_GET['gID'].'&cID='.$configuration['configuration_id']).'">'.tep_image('images/icon_info.gif', IMAGE_ICON_INFO).'</a>';
                }

    ?>&nbsp;</td>
              </tr>
<?php
}

?>
            </table></td>
<?php
  $heading = [];
$contents = [];

switch ($action) {
    case 'edit':
        $heading[] = ['text' => '<strong>'.$cInfo->configuration_title.'</strong>'];

        if ($cInfo->set_function) {
            eval('$value_field = '.$cInfo->set_function.'"'.tep_output_string_protected($cInfo->configuration_value).'");');
        } else {
            $value_field = tep_draw_input_field('configuration_value', $cInfo->configuration_value);
        }

        $contents = ['form' => tep_draw_form('configuration', 'configuration.php', 'gID='.$_GET['gID'].'&cID='.$cInfo->configuration_id.'&action=save')];
        $contents[] = ['text' => TEXT_INFO_EDIT_INTRO];
        $contents[] = ['text' => '<br /><strong>'.$cInfo->configuration_title.'</strong><br />'.$cInfo->configuration_description.'<br />'.$value_field];
        $contents[] = ['align' => 'center', 'text' => '<br />'.tep_draw_button(IMAGE_SAVE, 'disk', null, 'primary').tep_draw_button(IMAGE_CANCEL, 'close', tep_href_link('configuration.php', 'gID='.$_GET['gID'].'&cID='.$cInfo->configuration_id))];

        break;

    default:
        if (isset($cInfo) && \is_object($cInfo)) {
            $heading[] = ['text' => '<strong>'.$cInfo->configuration_title.'</strong>'];

            $contents[] = ['align' => 'center', 'text' => tep_draw_button(IMAGE_EDIT, 'document', tep_href_link('configuration.php', 'gID='.$_GET['gID'].'&cID='.$cInfo->configuration_id.'&action=edit'))];
            $contents[] = ['text' => '<br />'.$cInfo->configuration_description];
            $contents[] = ['text' => '<br />'.TEXT_INFO_DATE_ADDED.' '.tep_date_short($cInfo->date_added)];

            if (!empty($cInfo->last_modified)) {
                $contents[] = ['text' => TEXT_INFO_LAST_MODIFIED.' '.tep_date_short($cInfo->last_modified)];
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
