<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2020 osCommerce

  Released under the GNU General Public License
 */

require 'includes/application_top.php';

$saction = ($_GET['saction'] ?? '');

if (!empty($saction)) {
    switch ($saction) {
        case 'insert_sub':
            $zID = tep_db_prepare_input($_GET['zID']);
            $zone_country_id = tep_db_prepare_input($_POST['zone_country_id']);
            $zone_id = tep_db_prepare_input($_POST['zone_id']);

            tep_db_query("insert into zones_to_geo_zones (zone_country_id, zone_id, geo_zone_id, date_added) values ('".(int) $zone_country_id."', '".(int) $zone_id."', '".(int) $zID."', now())");
            $new_subzone_id = tep_db_insert_id();

            tep_redirect(tep_href_link('geo_zones.php', 'zpage='.$_GET['zpage'].'&zID='.$_GET['zID'].'&action=list&spage='.$_GET['spage'].'&sID='.$new_subzone_id));

            break;
        case 'save_sub':
            $sID = tep_db_prepare_input($_GET['sID']);
            $zID = tep_db_prepare_input($_GET['zID']);
            $zone_country_id = tep_db_prepare_input($_POST['zone_country_id']);
            $zone_id = tep_db_prepare_input($_POST['zone_id']);

            tep_db_query("update zones_to_geo_zones set geo_zone_id = '".(int) $zID."', zone_country_id = '".(int) $zone_country_id."', zone_id = ".(!empty($zone_id) ? "'".(int) $zone_id."'" : 'null').", last_modified = now() where association_id = '".(int) $sID."'");

            tep_redirect(tep_href_link('geo_zones.php', 'zpage='.$_GET['zpage'].'&zID='.$_GET['zID'].'&action=list&spage='.$_GET['spage'].'&sID='.$_GET['sID']));

            break;
        case 'deleteconfirm_sub':
            $sID = tep_db_prepare_input($_GET['sID']);

            tep_db_query("delete from zones_to_geo_zones where association_id = '".(int) $sID."'");

            tep_redirect(tep_href_link('geo_zones.php', 'zpage='.$_GET['zpage'].'&zID='.$_GET['zID'].'&action=list&spage='.$_GET['spage']));

            break;
    }
}

$action = ($_GET['action'] ?? '');

if (!empty($action)) {
    switch ($action) {
        case 'insert_zone':
            $geo_zone_name = tep_db_prepare_input($_POST['geo_zone_name']);
            $geo_zone_description = tep_db_prepare_input($_POST['geo_zone_description']);

            tep_db_query("insert into geo_zones (geo_zone_name, geo_zone_description, date_added) values ('".tep_db_input($geo_zone_name)."', '".tep_db_input($geo_zone_description)."', now())");
            $new_zone_id = tep_db_insert_id();

            tep_redirect(tep_href_link('geo_zones.php', 'zpage='.$_GET['zpage'].'&zID='.$new_zone_id));

            break;
        case 'save_zone':
            $zID = tep_db_prepare_input($_GET['zID']);
            $geo_zone_name = tep_db_prepare_input($_POST['geo_zone_name']);
            $geo_zone_description = tep_db_prepare_input($_POST['geo_zone_description']);

            tep_db_query("update geo_zones set geo_zone_name = '".tep_db_input($geo_zone_name)."', geo_zone_description = '".tep_db_input($geo_zone_description)."', last_modified = now() where geo_zone_id = '".(int) $zID."'");

            tep_redirect(tep_href_link('geo_zones.php', 'zpage='.$_GET['zpage'].'&zID='.$_GET['zID']));

            break;
        case 'deleteconfirm_zone':
            $zID = tep_db_prepare_input($_GET['zID']);

            tep_db_query("delete from geo_zones where geo_zone_id = '".(int) $zID."'");
            tep_db_query("delete from zones_to_geo_zones where geo_zone_id = '".(int) $zID."'");

            tep_redirect(tep_href_link('geo_zones.php', 'zpage='.$_GET['zpage']));

            break;
    }
}

require 'includes/template_top.php';

if (isset($_GET['zID']) && (($saction === 'edit') || ($saction === 'new'))) {
    ?>
<script>
function resetZoneSelected(theForm) {
  if (theForm.state.value != '') {
    theForm.zone_id.selectedIndex = '0';
    if (theForm.zone_id.options.length > 0) {
      theForm.state.value = '<?php echo JS_STATE_SELECT; ?>';
    }
  }
}

function update_zone(theForm) {
  var NumState = theForm.zone_id.options.length;
  var SelectedCountry = "";

  while(NumState > 0) {
    NumState--;
    theForm.zone_id.options[NumState] = null;
  }

  SelectedCountry = theForm.zone_country_id.options[theForm.zone_country_id.selectedIndex].value;

<?php echo tep_js_zone_list('SelectedCountry', 'theForm', 'zone_id'); ?>

}
</script>
<?php
}

?>

    <table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE;

if (isset($_GET['zone'])) {
    echo '<br /><span class="smallText">'.tep_get_geo_zone_name($_GET['zone']).'</span>';
}

?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top">
<?php
 if ($action === 'list') {
     ?>
            <table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_COUNTRY; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_COUNTRY_ZONE; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
         $rows = 0;
     $zones_query_raw = 'select a.association_id, a.zone_country_id, c.countries_name, a.zone_id, a.geo_zone_id, a.last_modified, a.date_added, z.zone_name from zones_to_geo_zones a left join countries c on a.zone_country_id = c.countries_id left join zones z on a.zone_id = z.zone_id where a.geo_zone_id = '.(int) $_GET['zID'].' order by association_id';
     $zones_split = new split_page_results($_GET['spage'], MAX_DISPLAY_SEARCH_RESULTS, $zones_query_raw, $zones_query_numrows);
     $zones_query = tep_db_query($zones_query_raw);

     while ($zones = tep_db_fetch_array($zones_query)) {
         ++$rows;

         if ((!isset($_GET['sID']) || (isset($_GET['sID']) && ($_GET['sID'] === $zones['association_id']))) && !isset($sInfo) && (substr($action, 0, 3) !== 'new')) {
             $sInfo = new objectInfo($zones);
         }

         if (isset($sInfo) && \is_object($sInfo) && ($zones['association_id'] === $sInfo->association_id)) {
             echo '                  <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\''.tep_href_link('geo_zones.php', 'zpage='.$_GET['zpage'].'&zID='.$_GET['zID'].'&action=list&spage='.$_GET['spage'].'&sID='.$sInfo->association_id.'&saction=edit').'\'">'."\n";
         } else {
             echo '                  <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\''.tep_href_link('geo_zones.php', 'zpage='.$_GET['zpage'].'&zID='.$_GET['zID'].'&action=list&spage='.$_GET['spage'].'&sID='.$zones['association_id']).'\'">'."\n";
         }

         ?>
                <td class="dataTableContent"><?php echo ($zones['countries_name']) ? $zones['countries_name'] : TEXT_ALL_COUNTRIES; ?></td>
                <td class="dataTableContent"><?php echo ($zones['zone_id']) ? $zones['zone_name'] : PLEASE_SELECT; ?></td>
                <td class="dataTableContent" align="right"><?php if (isset($sInfo) && \is_object($sInfo) && ($zones['association_id'] === $sInfo->association_id)) {
                    echo tep_image('images/icon_arrow_right.gif', '');
                } else {
                    echo '<a href="'.tep_href_link('geo_zones.php', 'zpage='.$_GET['zpage'].'&zID='.$_GET['zID'].'&action=list&spage='.$_GET['spage'].'&sID='.$zones['association_id']).'">'.tep_image('images/icon_info.gif', IMAGE_ICON_INFO).'</a>';
                }

         ?>&nbsp;</td>
              </tr>
<?php
     }

     ?>
              <tr>
                <td colspan="3"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $zones_split->display_count($zones_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['spage'], TEXT_DISPLAY_NUMBER_OF_COUNTRIES); ?></td>
                    <td class="smallText" align="right"><?php echo $zones_split->display_links($zones_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['spage'], 'zpage='.$_GET['zpage'].'&zID='.$_GET['zID'].'&action=list', 'spage'); ?></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td class="smallText" align="right" colspan="3"><?php if (empty($saction)) {
                    echo tep_draw_button(IMAGE_BACK, 'triangle-1-w', tep_href_link('geo_zones.php', 'zpage='.$_GET['zpage'].'&zID='.$_GET['zID'])).tep_draw_button(IMAGE_INSERT, 'plus', tep_href_link('geo_zones.php', 'zpage='.$_GET['zpage'].'&zID='.$_GET['zID'].'&action=list&spage='.$_GET['spage'].'&'.(isset($sInfo) ? 'sID='.$sInfo->association_id.'&' : '').'saction=new'));
                }

     ?></td>
              </tr>
            </table>
<?php
 } else {
     ?>
            <table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_TAX_ZONES; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
         $zones_query_raw = 'select geo_zone_id, geo_zone_name, geo_zone_description, last_modified, date_added from geo_zones order by geo_zone_name';
     $zones_split = new split_page_results($_GET['zpage'], MAX_DISPLAY_SEARCH_RESULTS, $zones_query_raw, $zones_query_numrows);
     $zones_query = tep_db_query($zones_query_raw);

     while ($zones = tep_db_fetch_array($zones_query)) {
         if ((!isset($_GET['zID']) || (isset($_GET['zID']) && ($_GET['zID'] === $zones['geo_zone_id']))) && !isset($zInfo) && (substr($action, 0, 3) !== 'new')) {
             $num_zones_query = tep_db_query("select count(*) as num_zones from zones_to_geo_zones where geo_zone_id = '".(int) $zones['geo_zone_id']."' group by geo_zone_id");
             $num_zones = tep_db_fetch_array($num_zones_query);

             if ($num_zones['num_zones'] > 0) {
                 $zones['num_zones'] = $num_zones['num_zones'];
             } else {
                 $zones['num_zones'] = 0;
             }

             $zInfo = new objectInfo($zones);
         }

         if (isset($zInfo) && \is_object($zInfo) && ($zones['geo_zone_id'] === $zInfo->geo_zone_id)) {
             echo '                  <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\''.tep_href_link('geo_zones.php', 'zpage='.$_GET['zpage'].'&zID='.$zInfo->geo_zone_id.'&action=list').'\'">'."\n";
         } else {
             echo '                  <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\''.tep_href_link('geo_zones.php', 'zpage='.$_GET['zpage'].'&zID='.$zones['geo_zone_id']).'\'">'."\n";
         }

         ?>
                <td class="dataTableContent"><?php echo '<a href="'.tep_href_link('geo_zones.php', 'zpage='.$_GET['zpage'].'&zID='.$zones['geo_zone_id'].'&action=list').'">'.tep_image('images/icons/folder.gif', ICON_FOLDER).'</a>&nbsp;'.$zones['geo_zone_name']; ?></td>
                <td class="dataTableContent" align="right"><?php if (isset($zInfo) && \is_object($zInfo) && ($zones['geo_zone_id'] === $zInfo->geo_zone_id)) {
                    echo tep_image('images/icon_arrow_right.gif');
                } else {
                    echo '<a href="'.tep_href_link('geo_zones.php', 'zpage='.$_GET['zpage'].'&zID='.$zones['geo_zone_id']).'">'.tep_image('images/icon_info.gif', IMAGE_ICON_INFO).'</a>';
                }

         ?>&nbsp;</td>
              </tr>
<?php
     }

     ?>
              <tr>
                <td colspan="2"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText"><?php echo $zones_split->display_count($zones_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['zpage'], TEXT_DISPLAY_NUMBER_OF_TAX_ZONES); ?></td>
                    <td class="smallText" align="right"><?php echo $zones_split->display_links($zones_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['zpage'], '', 'zpage'); ?></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td class="smallText" align="right" colspan="2"><?php if (!$action) {
                    echo tep_draw_button(IMAGE_INSERT, 'plus', tep_href_link('geo_zones.php', 'zpage='.$_GET['zpage'].'&zID='.$zInfo->geo_zone_id.'&action=new_zone'));
                }

     ?></td>
              </tr>
            </table>
<?php
 }

?>
            </td>
<?php
  $heading = [];
$contents = [];

if ($action === 'list') {
    switch ($saction) {
        case 'new':
            $heading[] = ['text' => '<strong>'.TEXT_INFO_HEADING_NEW_SUB_ZONE.'</strong>'];

            $contents = ['form' => tep_draw_form('zones', 'geo_zones.php', 'zpage='.$_GET['zpage'].'&zID='.$_GET['zID'].'&action=list&spage='.$_GET['spage'].'&'.(isset($_GET['sID']) ? 'sID='.$_GET['sID'].'&' : '').'saction=insert_sub')];
            $contents[] = ['text' => TEXT_INFO_NEW_SUB_ZONE_INTRO];
            $contents[] = ['text' => '<br />'.TEXT_INFO_COUNTRY.'<br />'.tep_draw_pull_down_menu('zone_country_id', tep_get_countries(TEXT_ALL_COUNTRIES), '', 'onchange="update_zone(this.form);"')];
            $contents[] = ['text' => '<br />'.TEXT_INFO_COUNTRY_ZONE.'<br />'.tep_draw_pull_down_menu('zone_id', tep_prepare_country_zones_pull_down())];
            $contents[] = ['align' => 'center', 'text' => '<br />'.tep_draw_button(IMAGE_SAVE, 'disk', null, 'primary').tep_draw_button(IMAGE_CANCEL, 'close', tep_href_link('geo_zones.php', 'zpage='.$_GET['zpage'].'&zID='.$_GET['zID'].'&action=list&spage='.$_GET['spage'].'&'.(isset($_GET['sID']) ? 'sID='.$_GET['sID'] : '')))];

            break;
        case 'edit':
            $heading[] = ['text' => '<strong>'.TEXT_INFO_HEADING_EDIT_SUB_ZONE.'</strong>'];

            $contents = ['form' => tep_draw_form('zones', 'geo_zones.php', 'zpage='.$_GET['zpage'].'&zID='.$_GET['zID'].'&action=list&spage='.$_GET['spage'].'&sID='.$sInfo->association_id.'&saction=save_sub')];
            $contents[] = ['text' => TEXT_INFO_EDIT_SUB_ZONE_INTRO];
            $contents[] = ['text' => '<br />'.TEXT_INFO_COUNTRY.'<br />'.tep_draw_pull_down_menu('zone_country_id', tep_get_countries(TEXT_ALL_COUNTRIES), $sInfo->zone_country_id, 'onchange="update_zone(this.form);"')];
            $contents[] = ['text' => '<br />'.TEXT_INFO_COUNTRY_ZONE.'<br />'.tep_draw_pull_down_menu('zone_id', tep_prepare_country_zones_pull_down($sInfo->zone_country_id), $sInfo->zone_id)];
            $contents[] = ['align' => 'center', 'text' => '<br />'.tep_draw_button(IMAGE_SAVE, 'disk', null, 'primary').tep_draw_button(IMAGE_CANCEL, 'close', tep_href_link('geo_zones.php', 'zpage='.$_GET['zpage'].'&zID='.$_GET['zID'].'&action=list&spage='.$_GET['spage'].'&sID='.$sInfo->association_id))];

            break;
        case 'delete':
            $heading[] = ['text' => '<strong>'.TEXT_INFO_HEADING_DELETE_SUB_ZONE.'</strong>'];

            $contents = ['form' => tep_draw_form('zones', 'geo_zones.php', 'zpage='.$_GET['zpage'].'&zID='.$_GET['zID'].'&action=list&spage='.$_GET['spage'].'&sID='.$sInfo->association_id.'&saction=deleteconfirm_sub')];
            $contents[] = ['text' => TEXT_INFO_DELETE_SUB_ZONE_INTRO];
            $contents[] = ['text' => '<br /><strong>'.$sInfo->countries_name.'</strong>'];
            $contents[] = ['align' => 'center', 'text' => '<br />'.tep_draw_button(IMAGE_DELETE, 'trash', null, 'primary').tep_draw_button(IMAGE_CANCEL, 'close', tep_href_link('geo_zones.php', 'zpage='.$_GET['zpage'].'&zID='.$_GET['zID'].'&action=list&spage='.$_GET['spage'].'&sID='.$sInfo->association_id))];

            break;

        default:
            if (isset($sInfo) && \is_object($sInfo)) {
                $heading[] = ['text' => '<strong>'.$sInfo->countries_name.'</strong>'];

                $contents[] = ['align' => 'center', 'text' => tep_draw_button(IMAGE_EDIT, 'document', tep_href_link('geo_zones.php', 'zpage='.$_GET['zpage'].'&zID='.$_GET['zID'].'&action=list&spage='.$_GET['spage'].'&sID='.$sInfo->association_id.'&saction=edit')).tep_draw_button(IMAGE_DELETE, 'trash', tep_href_link('geo_zones.php', 'zpage='.$_GET['zpage'].'&zID='.$_GET['zID'].'&action=list&spage='.$_GET['spage'].'&sID='.$sInfo->association_id.'&saction=delete'))];
                $contents[] = ['text' => '<br />'.TEXT_INFO_DATE_ADDED.' '.tep_date_short($sInfo->date_added)];

                if (!empty($sInfo->last_modified)) {
                    $contents[] = ['text' => TEXT_INFO_LAST_MODIFIED.' '.tep_date_short($sInfo->last_modified)];
                }
            }

            break;
    }
} else {
    switch ($action) {
        case 'new_zone':
            $heading[] = ['text' => '<strong>'.TEXT_INFO_HEADING_NEW_ZONE.'</strong>'];

            $contents = ['form' => tep_draw_form('zones', 'geo_zones.php', 'zpage='.$_GET['zpage'].'&zID='.$_GET['zID'].'&action=insert_zone')];
            $contents[] = ['text' => TEXT_INFO_NEW_ZONE_INTRO];
            $contents[] = ['text' => '<br />'.TEXT_INFO_ZONE_NAME.'<br />'.tep_draw_input_field('geo_zone_name')];
            $contents[] = ['text' => '<br />'.TEXT_INFO_ZONE_DESCRIPTION.'<br />'.tep_draw_input_field('geo_zone_description')];
            $contents[] = ['align' => 'center', 'text' => '<br />'.tep_draw_button(IMAGE_SAVE, 'disk', null, 'primary').tep_draw_button(IMAGE_CANCEL, 'close', tep_href_link('geo_zones.php', 'zpage='.$_GET['zpage'].'&zID='.$_GET['zID']))];

            break;
        case 'edit_zone':
            $heading[] = ['text' => '<strong>'.TEXT_INFO_HEADING_EDIT_ZONE.'</strong>'];

            $contents = ['form' => tep_draw_form('zones', 'geo_zones.php', 'zpage='.$_GET['zpage'].'&zID='.$zInfo->geo_zone_id.'&action=save_zone')];
            $contents[] = ['text' => TEXT_INFO_EDIT_ZONE_INTRO];
            $contents[] = ['text' => '<br />'.TEXT_INFO_ZONE_NAME.'<br />'.tep_draw_input_field('geo_zone_name', $zInfo->geo_zone_name)];
            $contents[] = ['text' => '<br />'.TEXT_INFO_ZONE_DESCRIPTION.'<br />'.tep_draw_input_field('geo_zone_description', $zInfo->geo_zone_description)];
            $contents[] = ['align' => 'center', 'text' => '<br />'.tep_draw_button(IMAGE_SAVE, 'disk', null, 'primary').tep_draw_button(IMAGE_CANCEL, 'close', tep_href_link('geo_zones.php', 'zpage='.$_GET['zpage'].'&zID='.$zInfo->geo_zone_id))];

            break;
        case 'delete_zone':
            $heading[] = ['text' => '<strong>'.TEXT_INFO_HEADING_DELETE_ZONE.'</strong>'];

            $contents = ['form' => tep_draw_form('zones', 'geo_zones.php', 'zpage='.$_GET['zpage'].'&zID='.$zInfo->geo_zone_id.'&action=deleteconfirm_zone')];
            $contents[] = ['text' => TEXT_INFO_DELETE_ZONE_INTRO];
            $contents[] = ['text' => '<br /><strong>'.$zInfo->geo_zone_name.'</strong>'];
            $contents[] = ['align' => 'center', 'text' => '<br />'.tep_draw_button(IMAGE_DELETE, 'trash', null, 'primary').tep_draw_button(IMAGE_CANCEL, 'close', tep_href_link('geo_zones.php', 'zpage='.$_GET['zpage'].'&zID='.$zInfo->geo_zone_id))];

            break;

        default:
            if (isset($zInfo) && \is_object($zInfo)) {
                $heading[] = ['text' => '<strong>'.$zInfo->geo_zone_name.'</strong>'];

                $contents[] = ['align' => 'center', 'text' => tep_draw_button(IMAGE_EDIT, 'document', tep_href_link('geo_zones.php', 'zpage='.$_GET['zpage'].'&zID='.$zInfo->geo_zone_id.'&action=edit_zone')).tep_draw_button(IMAGE_DELETE, 'trash', tep_href_link('geo_zones.php', 'zpage='.$_GET['zpage'].'&zID='.$zInfo->geo_zone_id.'&action=delete_zone')).tep_draw_button(IMAGE_DETAILS, 'info', tep_href_link('geo_zones.php', 'zpage='.$_GET['zpage'].'&zID='.$zInfo->geo_zone_id.'&action=list'))];
                $contents[] = ['text' => '<br />'.TEXT_INFO_NUMBER_ZONES.' '.$zInfo->num_zones];
                $contents[] = ['text' => '<br />'.TEXT_INFO_DATE_ADDED.' '.tep_date_short($zInfo->date_added)];

                if (!empty($zInfo->last_modified)) {
                    $contents[] = ['text' => TEXT_INFO_LAST_MODIFIED.' '.tep_date_short($zInfo->last_modified)];
                }

                $contents[] = ['text' => '<br />'.TEXT_INFO_ZONE_DESCRIPTION.'<br />'.$zInfo->geo_zone_description];
            }

            break;
    }
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
