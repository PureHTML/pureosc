<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2020 osCommerce

  Released under the GNU General Public License
 */

require 'includes/application_top.php';

$lang_dirs = [];

if ($dir = @dir(DIR_FS_CATALOG_LANGUAGES)) {
    while ($file = $dir->read()) {
        if (($file !== '.') && ($file !== '..')) {
            if (is_dir($dir->path.$file)) {
                $lang_dirs[] = [
                    'id' => $file,
                    'text' => $file,
                ];
            }
        }
    }
}

$action = ($_GET['action'] ?? '');

if (!empty($action)) {
    switch ($action) {
        case 'insert':
            $name = tep_db_prepare_input($_POST['name']);
            $code = tep_db_prepare_input(substr($_POST['code'], 0, 2));
            $image = tep_db_prepare_input($_POST['image']);
            $directory = tep_db_prepare_input($_POST['directory']);
            $sort_order = (int) tep_db_prepare_input($_POST['sort_order']);

            tep_db_query("insert into languages (name, code, image, directory, sort_order) values ('".tep_db_input($name)."', '".tep_db_input($code)."', '".tep_db_input($image)."', '".tep_db_input($directory)."', '".tep_db_input($sort_order)."')");
            $insert_id = tep_db_insert_id();

            // create additional categories_description records
            $categories_query = tep_db_query("select c.categories_id, cd.categories_name from categories c left join categories_description cd on c.categories_id = cd.categories_id where cd.language_id = '".(int) $languages_id."'");

            while ($categories = tep_db_fetch_array($categories_query)) {
                tep_db_query("insert into categories_description (categories_id, language_id, categories_name) values ('".(int) $categories['categories_id']."', '".(int) $insert_id."', '".tep_db_input($categories['categories_name'])."')");
            }

            // create additional products_description records
            $products_query = tep_db_query("select p.products_id, pd.products_name, pd.products_description, pd.products_url from products p left join products_description pd on p.products_id = pd.products_id where pd.language_id = '".(int) $languages_id."'");

            while ($products = tep_db_fetch_array($products_query)) {
                tep_db_query("insert into products_description (products_id, language_id, products_name, products_description, products_url) values ('".(int) $products['products_id']."', '".(int) $insert_id."', '".tep_db_input($products['products_name'])."', '".tep_db_input($products['products_description'])."', '".tep_db_input($products['products_url'])."')");
            }

            // create additional products_options records
            $products_options_query = tep_db_query("select products_options_id, products_options_name from products_options where language_id = '".(int) $languages_id."'");

            while ($products_options = tep_db_fetch_array($products_options_query)) {
                tep_db_query("insert into products_options (products_options_id, language_id, products_options_name) values ('".(int) $products_options['products_options_id']."', '".(int) $insert_id."', '".tep_db_input($products_options['products_options_name'])."')");
            }

            // create additional products_options_values records
            $products_options_values_query = tep_db_query("select products_options_values_id, products_options_values_name from products_options_values where language_id = '".(int) $languages_id."'");

            while ($products_options_values = tep_db_fetch_array($products_options_values_query)) {
                tep_db_query("insert into products_options_values (products_options_values_id, language_id, products_options_values_name) values ('".(int) $products_options_values['products_options_values_id']."', '".(int) $insert_id."', '".tep_db_input($products_options_values['products_options_values_name'])."')");
            }

            // create additional manufacturers_info records
            $manufacturers_query = tep_db_query("select m.manufacturers_id, mi.manufacturers_url from manufacturers m left join manufacturers_info mi on m.manufacturers_id = mi.manufacturers_id where mi.languages_id = '".(int) $languages_id."'");

            while ($manufacturers = tep_db_fetch_array($manufacturers_query)) {
                tep_db_query("insert into manufacturers_info (manufacturers_id, languages_id, manufacturers_url) values ('".$manufacturers['manufacturers_id']."', '".(int) $insert_id."', '".tep_db_input($manufacturers['manufacturers_url'])."')");
            }

            // create additional orders_status records
            $orders_status_query = tep_db_query("select orders_status_id, orders_status_name, public_flag, downloads_flag from orders_status where language_id = '".(int) $languages_id."'");

            while ($orders_status = tep_db_fetch_array($orders_status_query)) {
                tep_db_query("insert into orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag) values ('".(int) $orders_status['orders_status_id']."', '".(int) $insert_id."', '".tep_db_input($orders_status['orders_status_name'])."', '".tep_db_input($orders_status['public_flag'])."', '".tep_db_input($orders_status['downloads_flag'])."')");
            }

            // create additional information_pages_content records
            $information_query = tep_db_query("select pages_id, pages_name, pages_content from information_pages_content where language_id = '".(int) $languages_id."'");

            while ($information = tep_db_fetch_array($information_query)) {
                tep_db_query("insert into information_pages_content (pages_id, language_id, pages_name, pages_content) values ('".(int) $information['pages_id']."', '".(int) $insert_id."', '".tep_db_input($information['pages_name'])."', '".tep_db_input($information['pages_content'])."')");
            }

            if (isset($_POST['default']) && ($_POST['default'] === 'on')) {
                tep_db_query("update configuration set configuration_value = '".tep_db_input($code)."' where configuration_key = 'DEFAULT_LANGUAGE'");
            }

            tep_redirect(tep_href_link('languages.php', (isset($_GET['page']) ? 'page='.$_GET['page'].'&' : '').'lID='.$insert_id));

            break;
        case 'save':
            $lID = tep_db_prepare_input($_GET['lID']);
            $name = tep_db_prepare_input($_POST['name']);
            $code = tep_db_prepare_input(substr($_POST['code'], 0, 2));
            $image = tep_db_prepare_input($_POST['image']);
            $directory = tep_db_prepare_input($_POST['directory']);
            $sort_order = (int) tep_db_prepare_input($_POST['sort_order']);

            tep_db_query("update languages set name = '".tep_db_input($name)."', code = '".tep_db_input($code)."', image = '".tep_db_input($image)."', directory = '".tep_db_input($directory)."', sort_order = '".tep_db_input($sort_order)."' where languages_id = '".(int) $lID."'");

            if ($_POST['default'] === 'on') {
                tep_db_query("update configuration set configuration_value = '".tep_db_input($code)."' where configuration_key = 'DEFAULT_LANGUAGE'");
            }

            tep_redirect(tep_href_link('languages.php', 'page='.$_GET['page'].'&lID='.$_GET['lID']));

            break;
        case 'deleteconfirm':
            $lID = tep_db_prepare_input($_GET['lID']);

            $lng_query = tep_db_query("select languages_id from languages where code = '".tep_db_input(DEFAULT_CURRENCY)."'");
            $lng = tep_db_fetch_array($lng_query);

            if ($lng['languages_id'] === $lID) {
                tep_db_query("update configuration set configuration_value = '' where configuration_key = 'DEFAULT_CURRENCY'");
            }

            tep_db_query("delete from categories_description where language_id = '".(int) $lID."'");
            tep_db_query("delete from information_pages_content where language_id = '".(int) $lID."'");
            tep_db_query("delete from products_description where language_id = '".(int) $lID."'");
            tep_db_query("delete from products_options where language_id = '".(int) $lID."'");
            tep_db_query("delete from products_options_values where language_id = '".(int) $lID."'");
            tep_db_query("delete from manufacturers_info where languages_id = '".(int) $lID."'");
            tep_db_query("delete from orders_status where language_id = '".(int) $lID."'");
            tep_db_query("delete from languages where languages_id = '".(int) $lID."'");

            tep_redirect(tep_href_link('languages.php', 'page='.$_GET['page']));

            break;
        case 'delete':
            $lID = tep_db_prepare_input($_GET['lID']);

            $lng_query = tep_db_query("select code from languages where languages_id = '".(int) $lID."'");
            $lng = tep_db_fetch_array($lng_query);

            $remove_language = true;

            if ($lng['code'] === DEFAULT_LANGUAGE) {
                $remove_language = false;
                $messageStack->add(ERROR_REMOVE_DEFAULT_LANGUAGE, 'error');
            }

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
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_LANGUAGE_NAME; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_LANGUAGE_CODE; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
  $languages_query_raw = 'select languages_id, name, code, image, directory, sort_order from languages order by sort_order';
$languages_split = new split_page_results($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $languages_query_raw, $languages_query_numrows);
$languages_query = tep_db_query($languages_query_raw);

while ($languages = tep_db_fetch_array($languages_query)) {
    if ((!isset($_GET['lID']) || (isset($_GET['lID']) && ($_GET['lID'] === $languages['languages_id']))) && !isset($lInfo) && (substr($action, 0, 3) !== 'new')) {
        $lInfo = new objectInfo($languages);
    }

    if (isset($lInfo) && \is_object($lInfo) && ($languages['languages_id'] === $lInfo->languages_id)) {
        echo '                  <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\''.tep_href_link('languages.php', 'page='.$_GET['page'].'&lID='.$lInfo->languages_id.'&action=edit').'\'">'."\n";
    } else {
        echo '                  <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\''.tep_href_link('languages.php', 'page='.$_GET['page'].'&lID='.$languages['languages_id']).'\'">'."\n";
    }

    if (DEFAULT_LANGUAGE === $languages['code']) {
        echo '                <td class="dataTableContent"><strong>'.$languages['name'].' ('.TEXT_DEFAULT.")</strong></td>\n";
    } else {
        echo '                <td class="dataTableContent">'.$languages['name']."</td>\n";
    }

    ?>
                <td class="dataTableContent"><?php echo $languages['code']; ?></td>
                <td class="dataTableContent" align="right"><?php if (isset($lInfo) && \is_object($lInfo) && ($languages['languages_id'] === $lInfo->languages_id)) {
                    echo tep_image('images/icon_arrow_right.gif');
                } else {
                    echo '<a href="'.tep_href_link('languages.php', 'page='.$_GET['page'].'&lID='.$languages['languages_id']).'">'.tep_image('images/icon_info.gif', IMAGE_ICON_INFO).'</a>';
                }

    ?>&nbsp;</td>
              </tr>
<?php
}

?>
              <tr>
                <td colspan="3"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $languages_split->display_count($languages_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_LANGUAGES); ?></td>
                    <td class="smallText" align="right"><?php echo $languages_split->display_links($languages_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']); ?></td>
                  </tr>
<?php
  if (empty($action)) {
      ?>
                  <tr>
                    <td class="smallText" align="right" colspan="2"><?php echo tep_draw_button(IMAGE_NEW_LANGUAGE, 'plus', tep_href_link('languages.php', 'page='.$_GET['page'].'&lID='.$lInfo->languages_id.'&action=new')); ?></td>
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
        $heading[] = ['text' => '<strong>'.TEXT_INFO_HEADING_NEW_LANGUAGE.'</strong>'];

        $contents = ['form' => tep_draw_form('languages', 'languages.php', 'action=insert')];
        $contents[] = ['text' => TEXT_INFO_INSERT_INTRO];
        $contents[] = ['text' => '<br />'.TEXT_INFO_LANGUAGE_NAME.'<br />'.tep_draw_input_field('name')];
        $contents[] = ['text' => '<br />'.TEXT_INFO_LANGUAGE_CODE.'<br />'.tep_draw_input_field('code')];
        $contents[] = ['text' => '<br />'.TEXT_INFO_LANGUAGE_IMAGE.'<br />'.tep_draw_input_field('image', 'icon.gif')];
        $contents[] = ['text' => '<br />'.TEXT_INFO_LANGUAGE_DIRECTORY.'<br />'.tep_draw_pull_down_menu('directory', $lang_dirs)];
        $contents[] = ['text' => '<br />'.TEXT_INFO_LANGUAGE_SORT_ORDER.'<br />'.tep_draw_input_field('sort_order')];
        $contents[] = ['text' => '<br />'.tep_draw_checkbox_field('default').' '.TEXT_SET_DEFAULT];
        $contents[] = ['align' => 'center', 'text' => '<br />'.tep_draw_button(IMAGE_SAVE, 'disk', null, 'primary').tep_draw_button(IMAGE_CANCEL, 'close', tep_href_link('languages.php', 'page='.$_GET['page'].'&lID='.$_GET['lID']))];

        break;
    case 'edit':
        $heading[] = ['text' => '<strong>'.TEXT_INFO_HEADING_EDIT_LANGUAGE.'</strong>'];

        $contents = ['form' => tep_draw_form('languages', 'languages.php', 'page='.$_GET['page'].'&lID='.$lInfo->languages_id.'&action=save')];
        $contents[] = ['text' => TEXT_INFO_EDIT_INTRO];
        $contents[] = ['text' => '<br />'.TEXT_INFO_LANGUAGE_NAME.'<br />'.tep_draw_input_field('name', $lInfo->name)];
        $contents[] = ['text' => '<br />'.TEXT_INFO_LANGUAGE_CODE.'<br />'.tep_draw_input_field('code', $lInfo->code)];
        $contents[] = ['text' => '<br />'.TEXT_INFO_LANGUAGE_IMAGE.'<br />'.tep_draw_input_field('image', $lInfo->image)];
        $contents[] = ['text' => '<br />'.TEXT_INFO_LANGUAGE_DIRECTORY.'<br />'.tep_draw_pull_down_menu('directory', $lang_dirs, $lInfo->directory)];
        $contents[] = ['text' => '<br />'.TEXT_INFO_LANGUAGE_SORT_ORDER.'<br />'.tep_draw_input_field('sort_order', $lInfo->sort_order)];

        if (DEFAULT_LANGUAGE !== $lInfo->code) {
            $contents[] = ['text' => '<br />'.tep_draw_checkbox_field('default').' '.TEXT_SET_DEFAULT];
        }

        $contents[] = ['align' => 'center', 'text' => '<br />'.tep_draw_button(IMAGE_SAVE, 'disk', null, 'primary').tep_draw_button(IMAGE_CANCEL, 'close', tep_href_link('languages.php', 'page='.$_GET['page'].'&lID='.$lInfo->languages_id))];

        break;
    case 'delete':
        $heading[] = ['text' => '<strong>'.TEXT_INFO_HEADING_DELETE_LANGUAGE.'</strong>'];

        $contents[] = ['text' => TEXT_INFO_DELETE_INTRO];
        $contents[] = ['text' => '<br /><strong>'.$lInfo->name.'</strong>'];
        $contents[] = ['align' => 'center', 'text' => '<br />'.(($remove_language) ? tep_draw_button(IMAGE_DELETE, 'trash', tep_href_link('languages.php', 'page='.$_GET['page'].'&lID='.$lInfo->languages_id.'&action=deleteconfirm'), 'primary') : '').tep_draw_button(IMAGE_CANCEL, 'close', tep_href_link('languages.php', 'page='.$_GET['page'].'&lID='.$lInfo->languages_id))];

        break;

    default:
        if (\is_object($lInfo)) {
            $heading[] = ['text' => '<strong>'.$lInfo->name.'</strong>'];

            $contents[] = ['align' => 'center', 'text' => tep_draw_button(IMAGE_EDIT, 'document', tep_href_link('languages.php', 'page='.$_GET['page'].'&lID='.$lInfo->languages_id.'&action=edit')).tep_draw_button(IMAGE_DELETE, 'trash', tep_href_link('languages.php', 'page='.$_GET['page'].'&lID='.$lInfo->languages_id.'&action=delete')).tep_draw_button(IMAGE_DETAILS, 'info', tep_href_link('define_language.php', 'lngdir='.$lInfo->directory))];
            $contents[] = ['text' => '<br />'.TEXT_INFO_LANGUAGE_NAME.' '.$lInfo->name];
            $contents[] = ['text' => TEXT_INFO_LANGUAGE_CODE.' '.$lInfo->code];
            $contents[] = ['text' => '<br />'.tep_image(tep_catalog_href_link('includes/languages/'.$lInfo->directory.'/images/'.$lInfo->image), $lInfo->name)];
            $contents[] = ['text' => '<br />'.TEXT_INFO_LANGUAGE_DIRECTORY.'<br />'.DIR_WS_CATALOG_LANGUAGES.'<strong>'.$lInfo->directory.'</strong>'];
            $contents[] = ['text' => '<br />'.TEXT_INFO_LANGUAGE_SORT_ORDER.' '.$lInfo->sort_order];
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
