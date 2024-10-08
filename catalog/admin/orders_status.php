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
        case 'insert':
        case 'save':
            if (isset($_GET['oID'])) {
                $orders_status_id = tep_db_prepare_input($_GET['oID']);
            }

            $languages = tep_get_languages();

            for ($i = 0, $n = \count($languages); $i < $n; ++$i) {
                $orders_status_name_array = $_POST['orders_status_name'];
                $language_id = $languages[$i]['id'];

                $sql_data_array = ['orders_status_name' => tep_db_prepare_input($orders_status_name_array[$language_id]),
                    'public_flag' => ((isset($_POST['public_flag']) && ($_POST['public_flag'] === '1')) ? '1' : '0'),
                    'downloads_flag' => ((isset($_POST['downloads_flag']) && ($_POST['downloads_flag'] === '1')) ? '1' : '0')];

                if ($action === 'insert') {
                    if (empty($orders_status_id)) {
                        $next_id_query = tep_db_query('select max(orders_status_id) as orders_status_id from orders_status');
                        $next_id = tep_db_fetch_array($next_id_query);
                        $orders_status_id = $next_id['orders_status_id'] + 1;
                    }

                    $insert_sql_data = ['orders_status_id' => $orders_status_id,
                        'language_id' => $language_id];

                    $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

                    tep_db_perform('orders_status', $sql_data_array);
                } elseif ($action === 'save') {
                    tep_db_perform('orders_status', $sql_data_array, 'update', "orders_status_id = '".(int) $orders_status_id."' and language_id = '".(int) $language_id."'");
                }
            }

            if (isset($_POST['default']) && ($_POST['default'] === 'on')) {
                tep_db_query("update configuration set configuration_value = '".tep_db_input($orders_status_id)."' where configuration_key = 'DEFAULT_ORDERS_STATUS_ID'");
            }

            tep_redirect(tep_href_link('orders_status.php', 'page='.$_GET['page'].'&oID='.$orders_status_id));

            break;
        case 'deleteconfirm':
            $oID = tep_db_prepare_input($_GET['oID']);

            $orders_status_query = tep_db_query("select configuration_value from configuration where configuration_key = 'DEFAULT_ORDERS_STATUS_ID'");
            $orders_status = tep_db_fetch_array($orders_status_query);

            if ($orders_status['configuration_value'] === $oID) {
                tep_db_query("update configuration set configuration_value = '' where configuration_key = 'DEFAULT_ORDERS_STATUS_ID'");
            }

            tep_db_query("delete from orders_status where orders_status_id = '".tep_db_input($oID)."'");

            tep_redirect(tep_href_link('orders_status.php', 'page='.$_GET['page']));

            break;
        case 'delete':
            $oID = tep_db_prepare_input($_GET['oID']);

            $status_query = tep_db_query("select count(*) as count from orders where orders_status = '".(int) $oID."'");
            $status = tep_db_fetch_array($status_query);

            $remove_status = true;

            if ($oID === DEFAULT_ORDERS_STATUS_ID) {
                $remove_status = false;
                $messageStack->add(ERROR_REMOVE_DEFAULT_ORDER_STATUS, 'error');
            } elseif ($status['count'] > 0) {
                $remove_status = false;
                $messageStack->add(ERROR_STATUS_USED_IN_ORDERS, 'error');
            } else {
                $history_query = tep_db_query("select count(*) as count from orders_status_history where orders_status_id = '".(int) $oID."'");
                $history = tep_db_fetch_array($history_query);

                if ($history['count'] > 0) {
                    $remove_status = false;
                    $messageStack->add(ERROR_STATUS_USED_IN_HISTORY, 'error');
                }
            }

            break;
    }
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
        <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_ORDERS_STATUS; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_PUBLIC_STATUS; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_DOWNLOADS_STATUS; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
  $orders_status_query_raw = "select * from orders_status where language_id = '".(int) $languages_id."' order by orders_status_id";
$orders_status_split = new split_page_results($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $orders_status_query_raw, $orders_status_query_numrows);
$orders_status_query = tep_db_query($orders_status_query_raw);

while ($orders_status = tep_db_fetch_array($orders_status_query)) {
    if ((!isset($_GET['oID']) || (isset($_GET['oID']) && ($_GET['oID'] === $orders_status['orders_status_id']))) && !isset($oInfo) && (substr($action, 0, 3) !== 'new')) {
        $oInfo = new objectInfo($orders_status);
    }

    if (isset($oInfo) && \is_object($oInfo) && ($orders_status['orders_status_id'] === $oInfo->orders_status_id)) {
        echo '                  <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\''.tep_href_link('orders_status.php', 'page='.$_GET['page'].'&oID='.$oInfo->orders_status_id.'&action=edit').'\'">'."\n";
    } else {
        echo '                  <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\''.tep_href_link('orders_status.php', 'page='.$_GET['page'].'&oID='.$orders_status['orders_status_id']).'\'">'."\n";
    }

    if (DEFAULT_ORDERS_STATUS_ID === $orders_status['orders_status_id']) {
        echo '                <td class="dataTableContent"><strong>'.$orders_status['orders_status_name'].' ('.TEXT_DEFAULT.")</strong></td>\n";
    } else {
        echo '                <td class="dataTableContent">'.$orders_status['orders_status_name']."</td>\n";
    }

    ?>
                <td class="dataTableContent" align="center"><?php echo tep_image('images/icons/'.(($orders_status['public_flag'] === '1') ? 'tick.gif' : 'cross.gif')); ?></td>
                <td class="dataTableContent" align="center"><?php echo tep_image('images/icons/'.(($orders_status['downloads_flag'] === '1') ? 'tick.gif' : 'cross.gif')); ?></td>
                <td class="dataTableContent" align="right"><?php if (isset($oInfo) && \is_object($oInfo) && ($orders_status['orders_status_id'] === $oInfo->orders_status_id)) {
                    echo tep_image('images/icon_arrow_right.gif', '');
                } else {
                    echo '<a href="'.tep_href_link('orders_status.php', 'page='.$_GET['page'].'&oID='.$orders_status['orders_status_id']).'">'.tep_image('images/icon_info.gif', IMAGE_ICON_INFO).'</a>';
                }

    ?>&nbsp;</td>
              </tr>
<?php
}

?>
              <tr>
                <td colspan="4"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $orders_status_split->display_count($orders_status_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS); ?></td>
                    <td class="smallText" align="right"><?php echo $orders_status_split->display_links($orders_status_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']); ?></td>
                  </tr>
<?php
  if (empty($action)) {
      ?>
                  <tr>
                    <td class="smallText" colspan="2" align="right"><?php echo tep_draw_button(IMAGE_INSERT, 'plus', tep_href_link('orders_status.php', 'page='.$_GET['page'].'&action=new')); ?></td>
                  </tr>
<?php
  }

?>
                </table></td>
              </tr>
            </table></td>
<?php
  $heading = [];
$contents = [];

switch ($action) {
    case 'new':
        $heading[] = ['text' => '<strong>'.TEXT_INFO_HEADING_NEW_ORDERS_STATUS.'</strong>'];

        $contents = ['form' => tep_draw_form('status', 'orders_status.php', 'page='.$_GET['page'].'&action=insert')];
        $contents[] = ['text' => TEXT_INFO_INSERT_INTRO];

        $orders_status_inputs_string = '';
        $languages = tep_get_languages();

        for ($i = 0, $n = \count($languages); $i < $n; ++$i) {
            $orders_status_inputs_string .= '<br />'.tep_image(tep_catalog_href_link('includes/languages/'.$languages[$i]['directory'].'/images/'.$languages[$i]['image']), $languages[$i]['name']).'&nbsp;'.tep_draw_input_field('orders_status_name['.$languages[$i]['id'].']');
        }

        $contents[] = ['text' => '<br />'.TEXT_INFO_ORDERS_STATUS_NAME.$orders_status_inputs_string];
        $contents[] = ['text' => '<br />'.tep_draw_checkbox_field('public_flag', '1').' '.TEXT_SET_PUBLIC_STATUS];
        $contents[] = ['text' => tep_draw_checkbox_field('downloads_flag', '1').' '.TEXT_SET_DOWNLOADS_STATUS];
        $contents[] = ['text' => '<br />'.tep_draw_checkbox_field('default').' '.TEXT_SET_DEFAULT];
        $contents[] = ['align' => 'center', 'text' => '<br />'.tep_draw_button(IMAGE_SAVE, 'disk', null, 'primary').tep_draw_button(IMAGE_CANCEL, 'close', tep_href_link('orders_status.php', 'page='.$_GET['page']))];

        break;
    case 'edit':
        $heading[] = ['text' => '<strong>'.TEXT_INFO_HEADING_EDIT_ORDERS_STATUS.'</strong>'];

        $contents = ['form' => tep_draw_form('status', 'orders_status.php', 'page='.$_GET['page'].'&oID='.$oInfo->orders_status_id.'&action=save')];
        $contents[] = ['text' => TEXT_INFO_EDIT_INTRO];

        $orders_status_inputs_string = '';
        $languages = tep_get_languages();

        for ($i = 0, $n = \count($languages); $i < $n; ++$i) {
            $orders_status_inputs_string .= '<br />'.tep_image(tep_catalog_href_link('includes/languages/'.$languages[$i]['directory'].'/images/'.$languages[$i]['image']), $languages[$i]['name']).'&nbsp;'.tep_draw_input_field('orders_status_name['.$languages[$i]['id'].']', tep_get_orders_status_name($oInfo->orders_status_id, $languages[$i]['id']));
        }

        $contents[] = ['text' => '<br />'.TEXT_INFO_ORDERS_STATUS_NAME.$orders_status_inputs_string];
        $contents[] = ['text' => '<br />'.tep_draw_checkbox_field('public_flag', '1', $oInfo->public_flag).' '.TEXT_SET_PUBLIC_STATUS];
        $contents[] = ['text' => tep_draw_checkbox_field('downloads_flag', '1', $oInfo->downloads_flag).' '.TEXT_SET_DOWNLOADS_STATUS];

        if (DEFAULT_ORDERS_STATUS_ID !== $oInfo->orders_status_id) {
            $contents[] = ['text' => '<br />'.tep_draw_checkbox_field('default').' '.TEXT_SET_DEFAULT];
        }

        $contents[] = ['align' => 'center', 'text' => '<br />'.tep_draw_button(IMAGE_SAVE, 'disk', null, 'primary').tep_draw_button(IMAGE_CANCEL, 'close', tep_href_link('orders_status.php', 'page='.$_GET['page'].'&oID='.$oInfo->orders_status_id))];

        break;
    case 'delete':
        $heading[] = ['text' => '<strong>'.TEXT_INFO_HEADING_DELETE_ORDERS_STATUS.'</strong>'];

        $contents = ['form' => tep_draw_form('status', 'orders_status.php', 'page='.$_GET['page'].'&oID='.$oInfo->orders_status_id.'&action=deleteconfirm')];
        $contents[] = ['text' => TEXT_INFO_DELETE_INTRO];
        $contents[] = ['text' => '<br /><strong>'.$oInfo->orders_status_name.'</strong>'];

        if ($remove_status) {
            $contents[] = ['align' => 'center', 'text' => '<br />'.tep_draw_button(IMAGE_DELETE, 'trash', null, 'primary').tep_draw_button(IMAGE_CANCEL, 'close', tep_href_link('orders_status.php', 'page='.$_GET['page'].'&oID='.$oInfo->orders_status_id))];
        }

        break;

    default:
        if (isset($oInfo) && \is_object($oInfo)) {
            $heading[] = ['text' => '<strong>'.$oInfo->orders_status_name.'</strong>'];

            $contents[] = ['align' => 'center', 'text' => tep_draw_button(IMAGE_EDIT, 'document', tep_href_link('orders_status.php', 'page='.$_GET['page'].'&oID='.$oInfo->orders_status_id.'&action=edit')).tep_draw_button(IMAGE_DELETE, 'trash', tep_href_link('orders_status.php', 'page='.$_GET['page'].'&oID='.$oInfo->orders_status_id.'&action=delete'))];

            $orders_status_inputs_string = '';
            $languages = tep_get_languages();

            for ($i = 0, $n = \count($languages); $i < $n; ++$i) {
                $orders_status_inputs_string .= '<br />'.tep_image(tep_catalog_href_link('includes/languages/'.$languages[$i]['directory'].'/images/'.$languages[$i]['image']), $languages[$i]['name']).'&nbsp;'.tep_get_orders_status_name($oInfo->orders_status_id, $languages[$i]['id']);
            }

            $contents[] = ['text' => $orders_status_inputs_string];
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
