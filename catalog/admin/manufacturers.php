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
            if (isset($_GET['mID'])) {
                $manufacturers_id = tep_db_prepare_input($_GET['mID']);
            }

            $manufacturers_name = tep_db_prepare_input($_POST['manufacturers_name']);

            $sql_data_array = ['manufacturers_name' => $manufacturers_name];

            if ($action === 'insert') {
                $insert_sql_data = ['date_added' => 'now()'];

                $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

                tep_db_perform('manufacturers', $sql_data_array);
                $manufacturers_id = tep_db_insert_id();
            } elseif ($action === 'save') {
                $update_sql_data = ['last_modified' => 'now()'];

                $sql_data_array = array_merge($sql_data_array, $update_sql_data);

                tep_db_perform('manufacturers', $sql_data_array, 'update', "manufacturers_id = '".(int) $manufacturers_id."'");
            }

            $manufacturers_image = new upload('manufacturers_image');
            $manufacturers_image->set_destination(DIR_FS_CATALOG.'images/manufacturers/');

            if ($manufacturers_image->parse() && $manufacturers_image->save()) {
                tep_db_query("update manufacturers set manufacturers_image = '".tep_db_input($manufacturers_image->filename)."' where manufacturers_id = '".(int) $manufacturers_id."'");
            }

            $languages = tep_get_languages();

            for ($i = 0, $n = \count($languages); $i < $n; ++$i) {
                $manufacturers_url_array = $_POST['manufacturers_url'];
                $language_id = $languages[$i]['id'];

                $sql_data_array = ['manufacturers_url' => tep_db_prepare_input($manufacturers_url_array[$language_id])];

                if ($action === 'insert') {
                    $insert_sql_data = ['manufacturers_id' => $manufacturers_id,
                        'languages_id' => $language_id];

                    $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

                    tep_db_perform('manufacturers_info', $sql_data_array);
                } elseif ($action === 'save') {
                    tep_db_perform('manufacturers_info', $sql_data_array, 'update', "manufacturers_id = '".(int) $manufacturers_id."' and languages_id = '".(int) $language_id."'");
                }
            }

            if (USE_CACHE === 'true') {
                tep_reset_cache_block('manufacturers');
            }

            tep_redirect(tep_href_link('manufacturers.php', (isset($_GET['page']) ? 'page='.$_GET['page'].'&' : '').'mID='.$manufacturers_id));

            break;
        case 'deleteconfirm':
            $manufacturers_id = tep_db_prepare_input($_GET['mID']);

            if (isset($_POST['delete_image']) && ($_POST['delete_image'] === 'on')) {
                $manufacturer_query = tep_db_query("select manufacturers_image from manufacturers where manufacturers_id = '".(int) $manufacturers_id."'");
                $manufacturer = tep_db_fetch_array($manufacturer_query);

                $image_location = DIR_FS_DOCUMENT_ROOT.DIR_WS_CATALOG.'images/manufacturers/'.$manufacturer['manufacturers_image'];

                if (file_exists($image_location)) {
                    @unlink($image_location);
                }
            }

            tep_db_query("delete from manufacturers where manufacturers_id = '".(int) $manufacturers_id."'");
            tep_db_query("delete from manufacturers_info where manufacturers_id = '".(int) $manufacturers_id."'");

            if (isset($_POST['delete_products']) && ($_POST['delete_products'] === 'on')) {
                $products_query = tep_db_query("select products_id from products where manufacturers_id = '".(int) $manufacturers_id."'");

                while ($products = tep_db_fetch_array($products_query)) {
                    tep_remove_product($products['products_id']);
                }
            } else {
                tep_db_query("update products set manufacturers_id = '' where manufacturers_id = '".(int) $manufacturers_id."'");
            }

            if (USE_CACHE === 'true') {
                tep_reset_cache_block('manufacturers');
            }

            tep_redirect(tep_href_link('manufacturers.php', 'page='.$_GET['page']));

            break;
    }
}

require 'includes/template_top.php';
?>

    <table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_MANUFACTURERS; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
  $manufacturers_query_raw = 'select manufacturers_id, manufacturers_name, manufacturers_image, date_added, last_modified from manufacturers order by manufacturers_name';
$manufacturers_split = new split_page_results($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $manufacturers_query_raw, $manufacturers_query_numrows);
$manufacturers_query = tep_db_query($manufacturers_query_raw);

while ($manufacturers = tep_db_fetch_array($manufacturers_query)) {
    if ((!isset($_GET['mID']) || (isset($_GET['mID']) && ($_GET['mID'] === $manufacturers['manufacturers_id']))) && !isset($mInfo) && (substr($action, 0, 3) !== 'new')) {
        $manufacturer_products_query = tep_db_query("select count(*) as products_count from products where manufacturers_id = '".(int) $manufacturers['manufacturers_id']."'");
        $manufacturer_products = tep_db_fetch_array($manufacturer_products_query);

        $mInfo_array = array_merge($manufacturers, $manufacturer_products);
        $mInfo = new objectInfo($mInfo_array);
    }

    if (isset($mInfo) && \is_object($mInfo) && ($manufacturers['manufacturers_id'] === $mInfo->manufacturers_id)) {
        echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\''.tep_href_link('manufacturers.php', 'page='.$_GET['page'].'&mID='.$manufacturers['manufacturers_id'].'&action=edit').'\'">'."\n";
    } else {
        echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\''.tep_href_link('manufacturers.php', 'page='.$_GET['page'].'&mID='.$manufacturers['manufacturers_id']).'\'">'."\n";
    }

    ?>
                <td class="dataTableContent"><?php echo $manufacturers['manufacturers_name']; ?></td>
                <td class="dataTableContent" align="right"><?php if (isset($mInfo) && \is_object($mInfo) && ($manufacturers['manufacturers_id'] === $mInfo->manufacturers_id)) {
                    echo tep_image('images/icon_arrow_right.gif');
                } else {
                    echo '<a href="'.tep_href_link('manufacturers.php', 'page='.$_GET['page'].'&mID='.$manufacturers['manufacturers_id']).'">'.tep_image('images/icon_info.gif', IMAGE_ICON_INFO).'</a>';
                }

    ?>&nbsp;</td>
              </tr>
<?php
}

?>
              <tr>
                <td colspan="2"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $manufacturers_split->display_count($manufacturers_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS); ?></td>
                    <td class="smallText" align="right"><?php echo $manufacturers_split->display_links($manufacturers_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']); ?></td>
                  </tr>
                </table></td>
              </tr>
<?php
  if (empty($action)) {
      ?>
              <tr>
                <td align="right" colspan="2" class="smallText"><?php echo tep_draw_button(IMAGE_INSERT, 'plus', tep_href_link('manufacturers.php', 'page='.$_GET['page'].'&mID='.$mInfo->manufacturers_id.'&action=new')); ?></td>
              </tr>
<?php
  }

?>
            </table></td>
<?php
  $heading = [];
$contents = [];

switch ($action) {
    case 'new':
        $heading[] = ['text' => '<strong>'.TEXT_HEADING_NEW_MANUFACTURER.'</strong>'];

        $contents = ['form' => tep_draw_form('manufacturers', 'manufacturers.php', 'action=insert', 'post', 'enctype="multipart/form-data"')];
        $contents[] = ['text' => TEXT_NEW_INTRO];
        $contents[] = ['text' => '<br />'.TEXT_MANUFACTURERS_NAME.'<br />'.tep_draw_input_field('manufacturers_name')];
        $contents[] = ['text' => '<br />'.TEXT_MANUFACTURERS_IMAGE.'<br />'.tep_draw_file_field('manufacturers_image')];

        $manufacturer_inputs_string = '';
        $languages = tep_get_languages();

        for ($i = 0, $n = \count($languages); $i < $n; ++$i) {
            $manufacturer_inputs_string .= '<br />'.tep_image(tep_catalog_href_link('includes/languages/'.$languages[$i]['directory'].'/images/'.$languages[$i]['image']), $languages[$i]['name']).'&nbsp;'.tep_draw_input_field('manufacturers_url['.$languages[$i]['id'].']');
        }

        $contents[] = ['text' => '<br />'.TEXT_MANUFACTURERS_URL.$manufacturer_inputs_string];
        $contents[] = ['align' => 'center', 'text' => '<br />'.tep_draw_button(IMAGE_SAVE, 'disk', null, 'primary').tep_draw_button(IMAGE_CANCEL, 'close', tep_href_link('manufacturers.php', 'page='.$_GET['page'].'&mID='.$_GET['mID']))];

        break;
    case 'edit':
        $heading[] = ['text' => '<strong>'.TEXT_HEADING_EDIT_MANUFACTURER.'</strong>'];

        $contents = ['form' => tep_draw_form('manufacturers', 'manufacturers.php', 'page='.$_GET['page'].'&mID='.$mInfo->manufacturers_id.'&action=save', 'post', 'enctype="multipart/form-data"')];
        $contents[] = ['text' => TEXT_EDIT_INTRO];
        $contents[] = ['text' => '<br />'.TEXT_MANUFACTURERS_NAME.'<br />'.tep_draw_input_field('manufacturers_name', $mInfo->manufacturers_name)];
        $contents[] = ['text' => '<br />'.TEXT_MANUFACTURERS_IMAGE.'<br />'.tep_draw_file_field('manufacturers_image').'<br />'.$mInfo->manufacturers_image];

        $manufacturer_inputs_string = '';
        $languages = tep_get_languages();

        for ($i = 0, $n = \count($languages); $i < $n; ++$i) {
            $manufacturer_inputs_string .= '<br />'.tep_image(tep_catalog_href_link('includes/languages/'.$languages[$i]['directory'].'/images/'.$languages[$i]['image']), $languages[$i]['name']).'&nbsp;'.tep_draw_input_field('manufacturers_url['.$languages[$i]['id'].']', tep_get_manufacturer_url($mInfo->manufacturers_id, $languages[$i]['id']));
        }

        $contents[] = ['text' => '<br />'.TEXT_MANUFACTURERS_URL.$manufacturer_inputs_string];
        $contents[] = ['align' => 'center', 'text' => '<br />'.tep_draw_button(IMAGE_SAVE, 'disk', null, 'primary').tep_draw_button(IMAGE_CANCEL, 'close', tep_href_link('manufacturers.php', 'page='.$_GET['page'].'&mID='.$mInfo->manufacturers_id))];

        break;
    case 'delete':
        $heading[] = ['text' => '<strong>'.TEXT_HEADING_DELETE_MANUFACTURER.'</strong>'];

        $contents = ['form' => tep_draw_form('manufacturers', 'manufacturers.php', 'page='.$_GET['page'].'&mID='.$mInfo->manufacturers_id.'&action=deleteconfirm')];
        $contents[] = ['text' => TEXT_DELETE_INTRO];
        $contents[] = ['text' => '<br /><strong>'.$mInfo->manufacturers_name.'</strong>'];
        $contents[] = ['text' => '<br />'.tep_draw_checkbox_field('delete_image', '', true).' '.TEXT_DELETE_IMAGE];

        if ($mInfo->products_count > 0) {
            $contents[] = ['text' => '<br />'.tep_draw_checkbox_field('delete_products').' '.TEXT_DELETE_PRODUCTS];
            $contents[] = ['text' => '<br />'.sprintf(TEXT_DELETE_WARNING_PRODUCTS, $mInfo->products_count)];
        }

        $contents[] = ['align' => 'center', 'text' => '<br />'.tep_draw_button(IMAGE_DELETE, 'trash', null, 'primary').tep_draw_button(IMAGE_CANCEL, 'close', tep_href_link('manufacturers.php', 'page='.$_GET['page'].'&mID='.$mInfo->manufacturers_id))];

        break;

    default:
        if (isset($mInfo) && \is_object($mInfo)) {
            $heading[] = ['text' => '<strong>'.$mInfo->manufacturers_name.'</strong>'];

            $contents[] = ['align' => 'center', 'text' => tep_draw_button(IMAGE_EDIT, 'document', tep_href_link('manufacturers.php', 'page='.$_GET['page'].'&mID='.$mInfo->manufacturers_id.'&action=edit')).tep_draw_button(IMAGE_DELETE, 'trash', tep_href_link('manufacturers.php', 'page='.$_GET['page'].'&mID='.$mInfo->manufacturers_id.'&action=delete'))];
            $contents[] = ['text' => '<br />'.TEXT_DATE_ADDED.' '.tep_date_short($mInfo->date_added)];

            if (!empty($mInfo->last_modified)) {
                $contents[] = ['text' => TEXT_LAST_MODIFIED.' '.tep_date_short($mInfo->last_modified)];
            }

            $contents[] = ['text' => '<br />'.tep_info_image('manufacturers/'.$mInfo->manufacturers_image, $mInfo->manufacturers_name)];
            $contents[] = ['text' => '<br />'.TEXT_PRODUCTS.' '.$mInfo->products_count];
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
