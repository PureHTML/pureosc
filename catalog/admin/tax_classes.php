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
            $tax_class_title = tep_db_prepare_input($_POST['tax_class_title']);
            $tax_class_description = tep_db_prepare_input($_POST['tax_class_description']);

            tep_db_query("insert into tax_class (tax_class_title, tax_class_description, date_added) values ('".tep_db_input($tax_class_title)."', '".tep_db_input($tax_class_description)."', now())");

            tep_redirect(tep_href_link('tax_classes.php'));

            break;
        case 'save':
            $tax_class_id = tep_db_prepare_input($_GET['tID']);
            $tax_class_title = tep_db_prepare_input($_POST['tax_class_title']);
            $tax_class_description = tep_db_prepare_input($_POST['tax_class_description']);

            tep_db_query("update tax_class set tax_class_id = '".(int) $tax_class_id."', tax_class_title = '".tep_db_input($tax_class_title)."', tax_class_description = '".tep_db_input($tax_class_description)."', last_modified = now() where tax_class_id = '".(int) $tax_class_id."'");

            tep_redirect(tep_href_link('tax_classes.php', 'page='.$_GET['page'].'&tID='.$tax_class_id));

            break;
        case 'deleteconfirm':
            $tax_class_id = tep_db_prepare_input($_GET['tID']);

            tep_db_query("delete from tax_class where tax_class_id = '".(int) $tax_class_id."'");

            tep_redirect(tep_href_link('tax_classes.php', 'page='.$_GET['page']));

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
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_TAX_CLASSES; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
  $classes_query_raw = 'select tax_class_id, tax_class_title, tax_class_description, last_modified, date_added from tax_class order by tax_class_title';
$classes_split = new split_page_results($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $classes_query_raw, $classes_query_numrows);
$classes_query = tep_db_query($classes_query_raw);

while ($classes = tep_db_fetch_array($classes_query)) {
    if ((!isset($_GET['tID']) || (isset($_GET['tID']) && ($_GET['tID'] === $classes['tax_class_id']))) && !isset($tcInfo) && (substr($action, 0, 3) !== 'new')) {
        $tcInfo = new objectInfo($classes);
    }

    if (isset($tcInfo) && \is_object($tcInfo) && ($classes['tax_class_id'] === $tcInfo->tax_class_id)) {
        echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\''.tep_href_link('tax_classes.php', 'page='.$_GET['page'].'&tID='.$tcInfo->tax_class_id.'&action=edit').'\'">'."\n";
    } else {
        echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\''.tep_href_link('tax_classes.php', 'page='.$_GET['page'].'&tID='.$classes['tax_class_id']).'\'">'."\n";
    }

    ?>
                <td class="dataTableContent"><?php echo $classes['tax_class_title']; ?></td>
                <td class="dataTableContent" align="right"><?php if (isset($tcInfo) && \is_object($tcInfo) && ($classes['tax_class_id'] === $tcInfo->tax_class_id)) {
                    echo tep_image('images/icon_arrow_right.gif', '');
                } else {
                    echo '<a href="'.tep_href_link('tax_classes.php', 'page='.$_GET['page'].'&tID='.$classes['tax_class_id']).'">'.tep_image('images/icon_info.gif', IMAGE_ICON_INFO).'</a>';
                }

    ?>&nbsp;</td>
              </tr>
<?php
}

?>
              <tr>
                <td colspan="2"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $classes_split->display_count($classes_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES); ?></td>
                    <td class="smallText" align="right"><?php echo $classes_split->display_links($classes_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']); ?></td>
                  </tr>
<?php
  if (empty($action)) {
      ?>
                  <tr>
                    <td class="smallText" colspan="2" align="right"><?php echo tep_draw_button(IMAGE_NEW_TAX_CLASS, 'plus', tep_href_link('tax_classes.php', 'page='.$_GET['page'].'&action=new')); ?></td>
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
        $heading[] = ['text' => '<strong>'.TEXT_INFO_HEADING_NEW_TAX_CLASS.'</strong>'];

        $contents = ['form' => tep_draw_form('classes', 'tax_classes.php', 'page='.$_GET['page'].'&action=insert')];
        $contents[] = ['text' => TEXT_INFO_INSERT_INTRO];
        $contents[] = ['text' => '<br />'.TEXT_INFO_CLASS_TITLE.'<br />'.tep_draw_input_field('tax_class_title')];
        $contents[] = ['text' => '<br />'.TEXT_INFO_CLASS_DESCRIPTION.'<br />'.tep_draw_input_field('tax_class_description')];
        $contents[] = ['align' => 'center', 'text' => '<br />'.tep_draw_button(IMAGE_SAVE, 'plus', null, 'primary').tep_draw_button(IMAGE_CANCEL, 'close', tep_href_link('tax_classes.php', 'page='.$_GET['page']))];

        break;
    case 'edit':
        $heading[] = ['text' => '<strong>'.TEXT_INFO_HEADING_EDIT_TAX_CLASS.'</strong>'];

        $contents = ['form' => tep_draw_form('classes', 'tax_classes.php', 'page='.$_GET['page'].'&tID='.$tcInfo->tax_class_id.'&action=save')];
        $contents[] = ['text' => TEXT_INFO_EDIT_INTRO];
        $contents[] = ['text' => '<br />'.TEXT_INFO_CLASS_TITLE.'<br />'.tep_draw_input_field('tax_class_title', $tcInfo->tax_class_title)];
        $contents[] = ['text' => '<br />'.TEXT_INFO_CLASS_DESCRIPTION.'<br />'.tep_draw_input_field('tax_class_description', $tcInfo->tax_class_description)];
        $contents[] = ['align' => 'center', 'text' => '<br />'.tep_draw_button(IMAGE_SAVE, 'disk', null, 'primary').tep_draw_button(IMAGE_CANCEL, 'close', tep_href_link('tax_classes.php', 'page='.$_GET['page'].'&tID='.$tcInfo->tax_class_id))];

        break;
    case 'delete':
        $heading[] = ['text' => '<strong>'.TEXT_INFO_HEADING_DELETE_TAX_CLASS.'</strong>'];

        $contents = ['form' => tep_draw_form('classes', 'tax_classes.php', 'page='.$_GET['page'].'&tID='.$tcInfo->tax_class_id.'&action=deleteconfirm')];
        $contents[] = ['text' => TEXT_INFO_DELETE_INTRO];
        $contents[] = ['text' => '<br /><strong>'.$tcInfo->tax_class_title.'</strong>'];
        $contents[] = ['align' => 'center', 'text' => '<br />'.tep_draw_button(IMAGE_DELETE, 'trash', null, 'primary').tep_draw_button(IMAGE_CANCEL, 'close', tep_href_link('tax_classes.php', 'page='.$_GET['page'].'&tID='.$tcInfo->tax_class_id))];

        break;

    default:
        if (isset($tcInfo) && \is_object($tcInfo)) {
            $heading[] = ['text' => '<strong>'.$tcInfo->tax_class_title.'</strong>'];

            $contents[] = ['align' => 'center', 'text' => tep_draw_button(IMAGE_EDIT, 'document', tep_href_link('tax_classes.php', 'page='.$_GET['page'].'&tID='.$tcInfo->tax_class_id.'&action=edit')).tep_draw_button(IMAGE_DELETE, 'trash', tep_href_link('tax_classes.php', 'page='.$_GET['page'].'&tID='.$tcInfo->tax_class_id.'&action=delete'))];
            $contents[] = ['text' => '<br />'.TEXT_INFO_DATE_ADDED.' '.tep_date_short($tcInfo->date_added)];
            $contents[] = ['text' => ''.TEXT_INFO_LAST_MODIFIED.' '.tep_date_short($tcInfo->last_modified)];
            $contents[] = ['text' => '<br />'.TEXT_INFO_CLASS_DESCRIPTION.'<br />'.$tcInfo->tax_class_description];
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
