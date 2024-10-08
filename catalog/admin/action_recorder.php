<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2020 osCommerce

  Released under the GNU General Public License
 */

require 'includes/application_top.php';

$file_extension = substr($PHP_SELF, strrpos($PHP_SELF, '.'));
$directory_array = [];

if ($dir = @dir(DIR_FS_CATALOG_MODULES.'action_recorder/')) {
    while ($file = $dir->read()) {
        if (!is_dir(DIR_FS_CATALOG_MODULES.'action_recorder/'.$file)) {
            if (substr($file, strrpos($file, '.')) === $file_extension) {
                $directory_array[] = $file;
            }
        }
    }

    sort($directory_array);
    $dir->close();
}

for ($i = 0, $n = \count($directory_array); $i < $n; ++$i) {
    $file = $directory_array[$i];

    if (file_exists(DIR_FS_CATALOG_LANGUAGES.$language.'/modules/action_recorder/'.$file)) {
        include DIR_FS_CATALOG_LANGUAGES.$language.'/modules/action_recorder/'.$file;
    }

    include DIR_FS_CATALOG_MODULES.'action_recorder/'.$file;

    $class = substr($file, 0, strrpos($file, '.'));

    if (tep_class_exists($class)) {
        ${$class} = new $class();
    }
}

$modules_array = [];
$modules_list_array = [['id' => '', 'text' => TEXT_ALL_MODULES]];

$modules_query = tep_db_query('select distinct module from action_recorder order by module');

while ($modules = tep_db_fetch_array($modules_query)) {
    $modules_array[] = $modules['module'];

    $modules_list_array[] = ['id' => $modules['module'],
        'text' => (\is_object(${$modules['module']}) ? ${$modules['module']}->title : $modules['module'])];
}

$action = ($_GET['action'] ?? '');

if (!empty($action)) {
    switch ($action) {
        case 'expire':
            $expired_entries = 0;

            if (isset($_GET['module']) && \in_array($_GET['module'], $modules_array, true)) {
                if (\is_object(${$_GET['module']})) {
                    $expired_entries += ${$_GET['module']}->expireEntries();
                } else {
                    $delete_query = tep_db_query("delete from action_recorder where module = '".tep_db_input($_GET['module'])."'");
                    $expired_entries += tep_db_affected_rows();
                }
            } else {
                foreach ($modules_array as $module) {
                    if (\is_object(${$module})) {
                        $expired_entries += ${$module}->expireEntries();
                    }
                }
            }

            $messageStack->add_session(sprintf(SUCCESS_EXPIRED_ENTRIES, $expired_entries), 'success');

            tep_redirect(tep_href_link('action_recorder.php'));

            break;
    }
}

require 'includes/template_top.php';
?>

    <table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2" height="40">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td align="right"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td class="smallText" align="right">
<?php
  echo tep_draw_form('search', 'action_recorder.php', '', 'get');
echo TEXT_FILTER_SEARCH.' '.tep_draw_input_field('search');
echo tep_draw_hidden_field('module').tep_hide_session_id().'</form>';
?>
                </td>
              </tr>
              <tr>
                <td class="smallText" align="right">
<?php
  echo tep_draw_form('filter', 'action_recorder.php', '', 'get');
echo tep_draw_pull_down_menu('module', $modules_list_array, null, 'onchange="this.form.submit();"');
echo tep_draw_hidden_field('search').tep_hide_session_id().'</form>';
?>
                </td>
              </tr>
            </table></td>
            <td class="smallText" align="right"><?php echo tep_draw_button(IMAGE_DELETE, 'trash', tep_href_link('action_recorder.php', 'action=expire'.(isset($_GET['module']) && \in_array($_GET['module'], $modules_array, true) ? '&module='.$_GET['module'] : '')), 'primary'); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent" width="20">&nbsp;</td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_MODULE; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_CUSTOMER; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_DATE_ADDED; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
  $filter = [];

if (isset($_GET['module']) && \in_array($_GET['module'], $modules_array, true)) {
    $filter[] = " module = '".tep_db_input($_GET['module'])."' ";
}

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $filter[] = " identifier like '%".tep_db_input($_GET['search'])."%' ";
}

$actions_query_raw = 'select * from action_recorder '.(!empty($filter) ? ' where '.implode(' and ', $filter) : '').' order by date_added desc';
$actions_split = new split_page_results($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $actions_query_raw, $actions_query_numrows);
$actions_query = tep_db_query($actions_query_raw);

while ($actions = tep_db_fetch_array($actions_query)) {
    $module = $actions['module'];

    $module_title = $actions['module'];

    if (\is_object(${$module})) {
        $module_title = ${$module}->title;
    }

    if ((!isset($_GET['aID']) || (isset($_GET['aID']) && ($_GET['aID'] === $actions['id']))) && !isset($aInfo)) {
        $actions_extra_query = tep_db_query("select identifier from action_recorder where id = '".(int) $actions['id']."'");
        $actions_extra = tep_db_fetch_array($actions_extra_query);

        $aInfo_array = array_merge($actions, $actions_extra, ['module' => $module_title]);
        $aInfo = new objectInfo($aInfo_array);
    }

    if ((isset($aInfo) && \is_object($aInfo)) && ($actions['id'] === $aInfo->id)) {
        echo '                  <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">'."\n";
    } else {
        echo '                  <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\''.tep_href_link('action_recorder.php', tep_get_all_get_params(['aID']).'aID='.$actions['id']).'\'">'."\n";
    }

    ?>
                <td class="dataTableContent" align="center"><?php echo tep_image('images/icons/'.(($actions['success'] === '1') ? 'tick.gif' : 'cross.gif')); ?></td>
                <td class="dataTableContent"><?php echo $module_title; ?></td>
                <td class="dataTableContent"><?php echo tep_output_string_protected($actions['user_name']).' ['.(int) $actions['user_id'].']'; ?></td>
                <td class="dataTableContent" align="right"><?php echo tep_datetime_short($actions['date_added']); ?></td>
                <td class="dataTableContent" align="right"><?php if ((isset($aInfo) && \is_object($aInfo)) && ($actions['id'] === $aInfo->id)) {
                    echo tep_image('images/icon_arrow_right.gif', '');
                } else {
                    echo '<a href="'.tep_href_link('action_recorder.php', tep_get_all_get_params(['aID']).'aID='.$actions['id']).'">'.tep_image('images/icon_info.gif', IMAGE_ICON_INFO).'</a>';
                }

    ?>&nbsp;</td>
              </tr>
<?php
}

?>
              <tr>
                <td colspan="5"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $actions_split->display_count($actions_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_ENTRIES); ?></td>
                    <td class="smallText" align="right"><?php echo $actions_split->display_links($actions_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], (isset($_GET['module']) && \in_array($_GET['module'], $modules_array, true) && \is_object(${$_GET['module']}) ? 'module='.$_GET['module'] : null).'&'.(isset($_GET['search']) && !empty($_GET['search']) ? 'search='.$_GET['search'] : null)); ?></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
<?php
  $heading = [];
$contents = [];

switch ($action) {
    default:
        if (isset($aInfo) && \is_object($aInfo)) {
            $heading[] = ['text' => '<strong>'.$aInfo->module.'</strong>'];

            $contents[] = ['text' => TEXT_INFO_IDENTIFIER.'<br /><br />'.(!empty($aInfo->identifier) ? '<a href="'.tep_href_link('action_recorder.php', 'search='.$aInfo->identifier).'"><u>'.tep_output_string_protected($aInfo->identifier).'</u></a>' : '(empty)')];
            $contents[] = ['text' => '<br />'.TEXT_INFO_DATE_ADDED.' '.tep_datetime_short($aInfo->date_added)];
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
