<?php
/*
  Group Discount
  by hOZONE, hozone@tiscali.it, http://www.hozone.it

  derived by:
  Discount_Groups_v1.1, by Enrico Drusiani, 2003/5/22
  
  for:
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com
  
  Copyright (c) 2008 osCommerce
  
  Released under the GNU General Public License 
*/

  require('includes/application_top.php');
  
  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (tep_not_null($action)) {
    switch ($action) {

      case 'update':
        $error = false;
	    $customers_groups_id = tep_db_prepare_input($_GET['cID']);
		$customers_groups_name = tep_db_prepare_input($_POST['customers_groups_name']);
		$customers_groups_discount_sign = tep_db_prepare_input($_POST['customers_groups_discount_sign']);
        $customers_groups_discount = tep_db_prepare_input($_POST['customers_groups_discount']);
		$customers_groups_price = tep_db_prepare_input($_POST['customers_groups_price']);
        tep_db_query("update " . TABLE_CUSTOMERS_GROUPS . " set customers_groups_name='" . $customers_groups_name . "', customers_groups_discount='" . $customers_groups_discount_sign . $customers_groups_discount . "', customers_groups_price='" . $customers_groups_price . "'  where customers_groups_id = " . tep_db_input($customers_groups_id) );
        tep_redirect(tep_href_link('customers_groups.php', tep_get_all_get_params(array('cID', 'action')) . 'cID=' . $customers_groups_id));
		break;
        
      case 'deleteconfirm':
        $group_id = tep_db_prepare_input($_GET['cID']);
        tep_db_query("delete from " . TABLE_CUSTOMERS_GROUPS . " where customers_groups_id= " . $group_id); 
        $customers_id_query = tep_db_query("select customers_id from " . TABLE_CUSTOMERS . " where customers_groups_id=" . $group_id);
        while($customers_id = tep_db_fetch_array($customers_id_query)) {
            tep_db_query("UPDATE " . TABLE_CUSTOMERS . " set customers_groups_id=1 where customers_id=" . $customers_id['customers_id']);
        }     
        tep_redirect(tep_href_link('customers_groups.php', tep_get_all_get_params(array('cID', 'action')))); 
        break;
        
      case 'newconfirm' :
        $customers_groups_name = tep_db_prepare_input($_POST['customers_groups_name']);
	    $customers_groups_discount_sign = tep_db_prepare_input($_POST['customers_groups_discount_sign']);
        $customers_groups_discount = tep_db_prepare_input($_POST['customers_groups_discount']);
		$customers_groups_price = tep_db_prepare_input($_POST['customers_groups_price']);
        tep_db_query("insert into " . TABLE_CUSTOMERS_GROUPS . " set customers_groups_name = '" . $customers_groups_name . "', customers_groups_discount = '" . $customers_groups_discount_sign . $customers_groups_discount . "', customers_groups_price = '" . $customers_groups_price . "'");
        tep_redirect(tep_href_link('customers_groups.php', tep_get_all_get_params(array('action'))));
        break;
    }
  }
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>" />

<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css" />
<script type="text/javascript" src="includes/general.js"></script>
</head>
<body onload="SetFocus();">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">

<?php
  if ($_GET['action'] == 'edit') {
    $customers_groups_query = tep_db_query("select c.customers_groups_id, c.customers_groups_name, c.customers_groups_discount, c.customers_groups_price from " . TABLE_CUSTOMERS_GROUPS . " c  where c.customers_groups_id = '" . $_GET['cID'] . "'");
    $customers_groups = tep_db_fetch_array($customers_groups_query);
    $cInfo = new objectInfo($customers_groups);
?>

<script type="text/javascript"><!--
function check_form() {
  var error = 0;

  var customers_groups_name = document.customers.customers_groups_name.value;
  
  if (customers_groups_name == "") {
    error_message = "<?php echo ERROR_CUSTOMERS_GROUPS_NAME; ?>";
    error = 1;
  }

  if (error == 1) {
    alert(error_message);
    return false;
  } else {
    return true;
  }
}
//--></script>

      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.png', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.png', '1', '10'); ?></td>
      </tr>

	  <tr><?php echo tep_draw_form('customers', 'customers_groups.php', tep_get_all_get_params(array('action')) . 'action=update', 'post', 'onSubmit="return check_form();"'); ?>
        <td class="formAreaTitle"><?php echo CATEGORY_PERSONAL; ?></td>
      </tr>

      <tr>
        <td class="formArea"><table border="0" cellspacing="2" cellpadding="2">
          <tr>
            <td class="main"><?php echo ENTRY_GROUPS_NAME; ?></td>
            <td class="main"><?php echo tep_draw_input_field('customers_groups_name', $cInfo->customers_groups_name, 'maxlength="32"', false); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo ENTRY_DEFAULT_DISCOUNT; ?></td>
            <td class="main">
			   <select name="customers_groups_discount_sign">
			        <option name="minus" value="-" <?php if (strstr($cInfo->customers_groups_discount,"-")) echo "selected=\"selected\"" ?>>-</option>
					<option name="plus" value="+"  <?php if (strstr($cInfo->customers_groups_discount,"+")) echo "selected=\"selected\"" ?>>+</option>
			   </select>&nbsp;<?php echo tep_draw_input_field('customers_groups_discount', substr($cInfo->customers_groups_discount,1,strlen($cInfo->customers_groups_discount)), 'maxlength="9"', false); ?>&nbsp;%
			</td>
		  </tr>
		  <tr>
            <td class="main"><?php echo ENTRY_DEFAULT_PRICE; ?></td>
            <td class="main"><?php
		       for ($i=1; $i<=tep_xppp_getpricesnum(); $i++) {
                   $price_array[] = array('id' => $i,
                              'text' => $i);
               }
               echo tep_draw_pull_down_menu('customers_groups_price', $price_array, $cInfo->customers_groups_price);
               ?>
		    </td>
		  </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.png', '1', '10'); ?></td>
      </tr>
      <tr>
        <td align="right" class="main"><?php echo tep_image_submit('button_update.png', IMAGE_UPDATE) . ' <a href="' . tep_href_link('customers_groups.php', tep_get_all_get_params(array('action','cID'))) .'">' . tep_image_button('button_cancel.png', IMAGE_CANCEL) . '</a>'; ?></td>
      </tr>
      </form>

	  <tr>
        <td><?php echo tep_draw_separator('pixel_trans.png', '1', '70'); ?></td>
      </tr>

<?php
  } else if($_GET['action'] == 'newdiscount') {
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.png', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.png', '1', '10'); ?></td>
      </tr>
      
<?php
  } else if($_GET['action'] == 'new') {
     
?>
<script type="text/javascript"><!--
function check_form() {
  var error = 0;

  var customers_groups_name = document.customers.customers_groups_name.value;
  
  if (customers_groups_name == "") {
    error_message = "<?php echo ERROR_CUSTOMERS_GROUPS_NAME; ?>";
    error = 1;
  }

  if (error == 1) {
    alert(error_message);
    return false;
  } else {
    return true;
  }
}
//--></script>

      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.png', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.png', '1', '10'); ?></td>
      </tr>
      <tr><?php echo tep_draw_form('customers', 'customers_groups.php', tep_get_all_get_params(array('action')) . 'action=newconfirm', 'post', 'onSubmit="return check_form();"'); ?>
        <td class="formAreaTitle"><?php echo CATEGORY_PERSONAL; ?></td>
      </tr>
      <tr>
        <td class="formArea"><table border="0" cellspacing="2" cellpadding="2">
          <tr>
            <td class="main"><?php echo ENTRY_GROUPS_NAME; ?></td>
            <td class="main"><?php echo tep_draw_input_field('customers_groups_name', '', 'maxlength="32"', false); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo ENTRY_DEFAULT_DISCOUNT; ?></td>
            <td class="main">
                 <select name="customers_groups_discount_sign"><option name="minus" value="-" selected="selected">-</option><option name="plus" value="+">+</option></select>&nbsp;<?php echo tep_draw_input_field('customers_groups_discount', '0', 'maxlength="9"', false); ?>&nbsp;%
			</td>
          </tr>
		  <tr>
            <td class="main"><?php echo ENTRY_DEFAULT_PRICE; ?></td>
            <td class="main"><?php
		       for ($i=1; $i<=tep_xppp_getpricesnum(); $i++) {
                   $price_array[] = array('id' => $i,
                              'text' => $i);
               }
               echo tep_draw_pull_down_menu('customers_groups_price', $price_array, '1');
               ?>
			</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.png', '1', '10'); ?></td>
      </tr>
      <tr>
        <td align="right" class="main"><?php echo tep_image_submit('button_update.png', IMAGE_UPDATE) . ' <a href="' . tep_href_link('customers_groups.php', tep_get_all_get_params(array('action','cID'))) .'">' . tep_image_button('button_cancel.png', IMAGE_CANCEL) . '</a>'; ?></td>
      </tr>
      </form>
<?php 
  } else {
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr><?php echo tep_draw_form('search', 'customers_groups.php', '', 'get'); ?>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.png', 1, HEADING_IMAGE_HEIGHT); ?></td>
            <td class="smallText" align="right"><?php echo HEADING_TITLE_SEARCH . ' ' . tep_draw_input_field('search'); ?></td>
          </form></tr>
        </table></td>
      </tr>
      <tr>

          <?php
          switch ($listing) {
              case "id-asc":
              $order = "g.customers_groups_id";
              break;
              case "group":
              $order = "g.customers_groups_name";
              break;
              case "group-desc":
              $order = "g.customers_groups_name DESC";
              break;
              case "discount":
              $order = "g.customers_groups_discount";
              break;
              case "discount-desc":
              $order = "g.customers_groups_discount DESC";
              break;
              default:
              $order = "g.customers_groups_id ASC";
          }
          ?>
	    <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
               <tr class="dataTableHeadingRow">
			       <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_NAME; ?>&nbsp;<a href="<?php echo "$PHP_SELF?listing=group"; ?>"><b>Asc</b></a>&nbsp;<a href="<?php echo "$PHP_SELF?listing=group-desc"; ?>"><b>Desc</b></a></td>
                   <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_DISCOUNT; ?>&nbsp;<a href="<?php echo "$PHP_SELF?listing=discount"; ?>"><b>Asc</b></a>&nbsp;<a href="<?php echo "$PHP_SELF?listing=discount-desc"; ?>"><b>Desc</b></a></td>
                   <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_PRICE; ?>&nbsp;</td>
				   <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
			   </tr>

<?php
    $search = '';
    if ( ($_GET['search']) && (tep_not_null($_GET['search'])) ) {
      $keywords = tep_db_input(tep_db_prepare_input($_GET['search']));
      $search = "where g.customers_groups_name like '%" . $keywords . "%'";
    }

    $customers_groups_query_raw = "select g.customers_groups_id, g.customers_groups_name, g.customers_groups_discount, g.customers_groups_price from " . TABLE_CUSTOMERS_GROUPS . " g  " . $search . " order by $order";
    $customers_groups_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $customers_groups_query_raw, $customers_groups_query_numrows);
    $customers_groups_query = tep_db_query($customers_groups_query_raw);

    while ($customers_groups = tep_db_fetch_array($customers_groups_query)) {
      $info_query = tep_db_query("select customers_info_date_account_created as date_account_created, customers_info_date_account_last_modified as date_account_last_modified, customers_info_date_of_last_logon as date_last_logon, customers_info_number_of_logons as number_of_logons from " . TABLE_CUSTOMERS_INFO . " where customers_info_id = '" . $customers_groups['customers_groups_id'] . "'");
      $info = tep_db_fetch_array($info_query);

      if (((!$_GET['cID']) || (@$_GET['cID'] == $customers_groups['customers_groups_id'])) && (!$cInfo)) {
        $cInfo = new objectInfo($customers_groups);
      }

      if ( (is_object($cInfo)) && ($customers_groups['customers_groups_id'] == $cInfo->customers_groups_id) ) {
        echo '          <tr class="dataTableRowSelected" onmouseover="this.style.cursor=\'hand\'" onclick="document.location.href=\'' . tep_href_link('customers_groups.php', tep_get_all_get_params(array('cID', 'action')) . 'cID=' . $cInfo->customers_groups_id . '&amp;action=edit') . '\'">' . "\n";
      } else {
        echo '          <tr class="dataTableRow" onmouseover="this.className=\'dataTableRowOver\';this.style.cursor=\'hand\'" onmouseout="this.className=\'dataTableRow\'" onclick="document.location.href=\'' . tep_href_link('customers_groups.php', tep_get_all_get_params(array('cID')) . 'cID=' . $customers_groups['customers_groups_id']) . '\'">' . "\n";
      }
?>
                <td class="dataTableContent"><?php echo $customers_groups['customers_groups_name']; ?></td>
                <td class="dataTableContent" align="right"><?php echo $customers_groups['customers_groups_discount']; ?>%</td>
				<td class="dataTableContent" align="right"><?php echo ENTRY_PRICE . " " . $customers_groups['customers_groups_price']; ?></td>
                <td class="dataTableContent" align="right"><?php if ( (is_object($cInfo)) && ($customers_groups['customers_groups_id'] == $cInfo->customers_groups_id) ) { echo tep_image(DIR_WS_IMAGES . 'icon_arrow_right.png', ''); } else { echo '<a href="' . tep_href_link('customers_groups.php', tep_get_all_get_params(array('cID')) . 'cID=' . $customers_groups['customers_groups_id']) . '">' . tep_image(DIR_WS_IMAGES . 'icon_info.png', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
    }
?>
              <tr>
                <td colspan="4"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $customers_groups_split->display_count($customers_groups_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_CUSTOMERS); ?></td>
                    <td class="smallText" align="right"><?php echo $customers_groups_split->display_links($customers_groups_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], tep_get_all_get_params(array('page', 'info', 'x', 'y', 'cID'))); ?></td>
                  </tr>
<?php
    if (tep_not_null($_GET['search'])) {
?>
                  <tr>
                    <td align="right" colspan="2"><?php echo '<a href="' . tep_href_link('customers_groups.php') . '">' . tep_image_button('button_reset.png', IMAGE_RESET) . '</a>'; ?></td>
                  </tr>
<?php
    } else {
?>
			      <tr>
                    <td align="right" colspan="2" class="smallText"><?php echo '<a href="' . tep_href_link('customers_groups.php', 'page=' . $_GET['page'] . '&amp;action=new') . '">' . tep_image_button('button_insert.png', IMAGE_INSERT) . '</a>'; ?></td>
                  </tr>
<?php
	}
?>
                </table></td>
              </tr>
            </table></td>
<?php
  $heading = array();
  $contents = array();
  switch ($_GET['action']) {
    case 'confirm':
        if ($_GET['cID'] != 1) {
            $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_GROUP . '</b>');
            $contents = array('form' => tep_draw_form('customers_groups', 'customers_groups.php', tep_get_all_get_params(array('cID', 'action')) . 'cID=' . $cInfo->customers_groups_id . '&amp;action=deleteconfirm'));
            $contents[] = array('text' => TEXT_DELETE_INTRO . '<br /><br /><b>' . $cInfo->customers_groups_name . ' </b>');
            if ($cInfo->number_of_reviews > 0) $contents[] = array('text' => '<br />' . tep_draw_checkbox_field('delete_reviews', 'on', true) . ' ' . sprintf(TEXT_DELETE_REVIEWS, $cInfo->number_of_reviews));
            $contents[] = array('align' => 'center', 'text' => '<br />' . tep_image_submit('button_delete.png', IMAGE_DELETE) . ' <a href="' . tep_href_link('customers_groups.php', tep_get_all_get_params(array('cID', 'action')) . 'cID=' . $cInfo->customers_groups_id) . '">' . tep_image_button('button_cancel.png', IMAGE_CANCEL) . '</a>');
        } else {
            $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_GROUP . '</b>');
            $contents[] = array('text' => 'Non e\' consentito cancellare il gruppo:<br /><br /><b>' . $cInfo->customers_groups_name . ' </b>');
        }
      break;
    default:
      if (is_object($cInfo)) {
        $heading[] = array('text' => '<b>' . $cInfo->customers_groups_name . ' </b>');
        $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link('customers_groups.php', tep_get_all_get_params(array('cID', 'action')) . 'cID=' . $cInfo->customers_groups_id . '&amp;action=edit') . '">' . tep_image_button('button_edit.png', IMAGE_EDIT) . '</a> <a href="' . tep_href_link('customers_groups.php', tep_get_all_get_params(array('cID', 'action')) . 'cID=' . $cInfo->customers_groups_id . '&amp;action=confirm') . '">' . tep_image_button('button_delete.png', IMAGE_DELETE) . '</a>');

      }
      break;
  }

  if ( (tep_not_null($heading)) && (tep_not_null($contents)) ) {
    echo '            <td width="25%" valign="top">' . "\n";

    $box = new box;
    echo $box->infoBox($heading, $contents);

    echo '            </td>' . "\n";
  }
?>
          </tr>
        </table></td>
      </tr>
<?php
  }
?>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br />
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>