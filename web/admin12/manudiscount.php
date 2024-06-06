<?php
/*
  Manufacturer Discount
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
	    $manudiscount_id = tep_db_prepare_input($_GET['cID']);
		$manudiscount_name = tep_db_prepare_input($_POST['manudiscount_name']);
		$manudiscount_discount_sign = tep_db_prepare_input($_POST['manudiscount_discount_sign']);
        $manudiscount_discount = tep_db_prepare_input($_POST['manudiscount_discount']);
		$manudiscount_manufacturers_id = tep_db_prepare_input($_POST['manudiscount_manufacturers_id']);
		$checkbox_customers_groups = tep_db_prepare_input($_POST['checkbox_customers_groups']);
        $manudiscount_groups_id = tep_db_prepare_input($_POST['manudiscount_groups_id']);
		if ($checkbox_customers_groups == false) $manudiscount_groups_id = 0;
		$checkbox_customers = tep_db_prepare_input($_POST['checkbox_customers']);
        $manudiscount_customers_id = tep_db_prepare_input($_POST['manudiscount_customers_id']);
		if ($checkbox_customers == false) $manudiscount_customers_id = 0;
        tep_db_query("update " . TABLE_MANUDISCOUNT . " set manudiscount_name='" . $manudiscount_name . "', manudiscount_discount='" . $manudiscount_discount_sign . $manudiscount_discount . "', manudiscount_groups_id='" . $manudiscount_groups_id . "', manudiscount_customers_id='" . $manudiscount_customers_id . "',manudiscount_manufacturers_id='" . $manudiscount_manufacturers_id . "' where manudiscount_id = " . tep_db_input($manudiscount_id) );
        tep_redirect(tep_href_link('manudiscount.php', tep_get_all_get_params(array('cID', 'action')) . 'cID=' . $manudiscount_id));
		break;
        
      case 'deleteconfirm':
        tep_db_query("delete from " . TABLE_MANUDISCOUNT . " where manudiscount_id= " . tep_db_prepare_input($_GET['cID'])); 
        tep_redirect(tep_href_link('manudiscount.php', tep_get_all_get_params(array('cID', 'action')))); 
        break;
        
      case 'newconfirm' :
		$manudiscount_name = tep_db_prepare_input($_POST['manudiscount_name']);
		$manudiscount_discount_sign = tep_db_prepare_input($_POST['manudiscount_discount_sign']);
        $manudiscount_discount = tep_db_prepare_input($_POST['manudiscount_discount']);
		$manudiscount_manufacturers_id = tep_db_prepare_input($_POST['manudiscount_manufacturers_id']);
		$checkbox_customers_groups = tep_db_prepare_input($_POST['checkbox_customers_groups']);
        $manudiscount_groups_id = tep_db_prepare_input($_POST['manudiscount_groups_id']);
		if ($checkbox_customers_groups == false) $manudiscount_groups_id = 0;
		$checkbox_customers = tep_db_prepare_input($_POST['checkbox_customers']);
        $manudiscount_customers_id = tep_db_prepare_input($_POST['manudiscount_customers_id']);
		if ($checkbox_customers == false) $manudiscount_customers_id = 0;
        tep_db_query("insert into " . TABLE_MANUDISCOUNT . " set manudiscount_name = '" . $manudiscount_name . "', manudiscount_discount = '" . $manudiscount_discount_sign . $manudiscount_discount . "', manudiscount_groups_id = '" . $manudiscount_groups_id . "', manudiscount_customers_id = '" . $manudiscount_customers_id . "', manudiscount_manufacturers_id = '" . $manudiscount_manufacturers_id . "'");
        tep_redirect(tep_href_link('manudiscount.php', tep_get_all_get_params(array('action'))));
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
    $manudiscount_query = tep_db_query("select c.manudiscount_id, c.manudiscount_name, c.manudiscount_discount, c.manudiscount_groups_id, c.manudiscount_customers_id, c.manudiscount_manufacturers_id from " . TABLE_MANUDISCOUNT . " c  where c.manudiscount_id = '" . $_GET['cID'] . "'");
    $manudiscount = tep_db_fetch_array($manudiscount_query);
    $cInfo = new objectInfo($manudiscount);
?>

<script type="text/javascript"><!--
function check_form() {
  var error = 0;

  var manudiscount_name = document.customers.manudiscount_name.value;
  
  if (manudiscount_name == "") {
    error_message = "<?php echo ERROR_MANUDISCOUNT_NAME; ?>";
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

	  <tr><?php echo tep_draw_form('customers', 'manudiscount.php', tep_get_all_get_params(array('action')) . 'action=update', 'post', 'onSubmit="return check_form();"'); ?>
        <td class="formAreaTitle"><?php echo CATEGORY_PERSONAL; ?></td>
      </tr>

      <tr>
        <td class="formArea"><table border="0" cellspacing="2" cellpadding="2">
          <tr>
            <td class="main"><?php echo ENTRY_MANUDISCOUNT_NAME; ?></td>
            <td class="main"><?php echo tep_draw_input_field('manudiscount_name', $cInfo->manudiscount_name, 'maxlength="32"', false); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo ENTRY_DEFAULT_DISCOUNT; ?></td>
            <td class="main">
			   <select name="manudiscount_discount_sign">
			        <option name="minus" value="-" <?php if (strstr($cInfo->manudiscount_discount,"-")) echo "selected=\"selected\"" ?>>-</option>
					<option name="plus" value="+"  <?php if (strstr($cInfo->manudiscount_discount,"+")) echo "selected=\"selected\"" ?>>+</option>
			   </select>&nbsp;<?php echo tep_draw_input_field('manudiscount_discount', substr($cInfo->manudiscount_discount,1,strlen($cInfo->manudiscount_discount)), 'maxlength="9"', false); ?>&nbsp;%
			</td>
		  </tr>
		  <tr>
            <td class="main"><?php echo ENTRY_CUSTOMERS_NAME; ?></td>
			<td class="main"><?php
		          $customers_query = tep_db_query("select distinct customers_firstname, customers_lastname, customers_id from " . TABLE_CUSTOMERS . " order by customers_lastname, customers_firstname");
                  $input_customers=array();$all_customers=array();$sde=0;
                  while ($existing_customers = tep_db_fetch_array($customers_query)) {
                     $input_customers[$sde++]=array("id"=>$existing_customers['customers_id'],
	                                             "text"=>$existing_customers['customers_lastname'] . " " . $existing_customers['customers_firstname'] );
	              }
				  if ($cInfo->manudiscount_customers_id != 0 ){
					  echo tep_draw_pull_down_menu('manudiscount_customers_id', $input_customers, $cInfo->manudiscount_customers_id);
                      ?><input type="checkbox" name="checkbox_customers" checked value="false" onclick="if (manudiscount_customers_id.disabled && checkbox_customers.checked) {manudiscount_customers_id.disabled = false; manudiscount_groups_id.disabled = true; checkbox_customers_groups.checked = false} else {manudiscount_customers_id.disabled = true; manudiscount_groups_id.disabled = true;}"><?php
				  } else {
					  echo tep_draw_pull_down_menu('manudiscount_customers_id', $input_customers, $cInfo->manudiscount_customers_id, 'disabled');
                      ?><input type="checkbox" name="checkbox_customers" value="false" onclick="if (manudiscount_customers_id.disabled && checkbox_customers.checked) {manudiscount_customers_id.disabled = false; manudiscount_groups_id.disabled = true; checkbox_customers_groups.checked = false} else {manudiscount_customers_id.disabled = true; manudiscount_groups_id.disabled = true;}"><?php
				  } ?>
		    </td>
          </tr>
		  <tr>
            <td class="main"><?php echo ENTRY_GROUPS_NAME; ?></td>
			<td class="main"><?php
		          $customers_groups_query = tep_db_query("select distinct customers_groups_name, customers_groups_id from " . TABLE_CUSTOMERS_GROUPS . " order by customers_groups_name");
                  $input_groups=array();$all_groups=array();$sde=0;
                  while ($existing_groups = tep_db_fetch_array($customers_groups_query)) {
                     $input_groups[$sde++]=array("id"=>$existing_groups['customers_groups_id'],
	                                             "text"=>$existing_groups['customers_groups_name']);
	              }
				  if ($manudiscount['manudiscount_groups_id'] != 0) {
				      echo tep_draw_pull_down_menu('manudiscount_groups_id', $input_groups, $cInfo->manudiscount_groups_id);
					  ?><input type="checkbox" name="checkbox_customers_groups" checked value="false" onclick="if (manudiscount_groups_id.disabled && checkbox_customers_groups.checked) {checkbox_customers_groups.value = true; manudiscount_groups_id.disabled = false; manudiscount_customers_id.disabled = true; checkbox_customers.checked = false} else {checkbox_customers_groups.value = false; manudiscount_groups_id.disabled = true; manudiscount_customers_id.disabled = true; }"><?php 
				  } else {
					  echo tep_draw_pull_down_menu('manudiscount_groups_id', $input_groups, $cInfo->manudiscount_groups_id, 'disabled');
					  ?><input type="checkbox" name="checkbox_customers_groups" value="false" onclick="if (manudiscount_groups_id.disabled && checkbox_customers_groups.checked) {checkbox_customers_groups.value = true; manudiscount_groups_id.disabled = false; manudiscount_customers_id.disabled = true; checkbox_customers.checked = false} else {checkbox_customers_groups.value = false; manudiscount_groups_id.disabled = true; manudiscount_customers_id.disabled = true; }"><?php 
				  }?>
		    </td>
          </tr>
		  <tr>
            <td class="main"><?php echo ENTRY_MANUFACTURERS_NAME; ?></td>
			<td class="main"><?php
		          $customers_groups_query = tep_db_query("select distinct manufacturers_name, manufacturers_id from " . TABLE_MANUFACTURERS . " order by manufacturers_name");
                  $input_groups=array();$all_groups=array();$sde=0;
                  while ($existing_groups = tep_db_fetch_array($customers_groups_query)) {
                     $input_groups[$sde++]=array("id"=>$existing_groups['manufacturers_id'],
	                                             "text"=>$existing_groups['manufacturers_name']);
	              }
				  echo tep_draw_pull_down_menu('manudiscount_manufacturers_id', $input_groups, $cInfo->manudiscount_manufacturers_id);
               ?>
		    </td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.png', '1', '10'); ?></td>
      </tr>
      <tr>
        <td align="right" class="main"><?php echo tep_image_submit('button_update.png', IMAGE_UPDATE) . ' <a href="' . tep_href_link('manudiscount.php', tep_get_all_get_params(array('action','cID'))) .'">' . tep_image_button('button_cancel.png', IMAGE_CANCEL) . '</a>'; ?></td>
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

  var manudiscount_name = document.customers.manudiscount_name.value;
  
  if (manudiscount_name == "") {
    error_message = "<?php echo ERROR_MANUDISCOUNT_NAME; ?>";
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
      <tr><?php echo tep_draw_form('customers', 'manudiscount.php', tep_get_all_get_params(array('action')) . 'action=newconfirm', 'post', 'onSubmit="return check_form();"'); ?>
        <td class="formAreaTitle"><?php echo CATEGORY_PERSONAL; ?></td>
      </tr>
      <tr>
        <td class="formArea"><table border="0" cellspacing="2" cellpadding="2">
          <tr>
            <td class="main"><?php echo ENTRY_MANUDISCOUNT_NAME; ?></td>
            <td class="main"><?php echo tep_draw_input_field('manudiscount_name', '', 'maxlength="32"', false); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo ENTRY_DEFAULT_DISCOUNT; ?></td>
            <td class="main">
                 <select name="manudiscount_discount_sign"><option name="minus" value="-" selected="selected">-</option><option name="plus" value="+">+</option></select>&nbsp;<?php echo tep_draw_input_field('manudiscount_discount', '0', 'maxlength="9"', false); ?>&nbsp;%
			</td>
          </tr>
		  <tr>
            <td class="main"><?php echo ENTRY_CUSTOMERS_NAME; ?></td>
			<td class="main"><?php
		          $customers_query = tep_db_query("select distinct customers_firstname, customers_lastname, customers_id from " . TABLE_CUSTOMERS . " order by customers_lastname, customers_firstname");
                  $input_customers=array();$all_customers=array();$sde=0;
                  while ($existing_customers = tep_db_fetch_array($customers_query)) {
                     $input_customers[$sde++]=array("id"=>$existing_customers['customers_id'],
	                                             "text"=>$existing_customers['customers_lastname'] . " " . $existing_customers['customers_firstname'] );
	              }
				  echo tep_draw_pull_down_menu('manudiscount_customers_id', $input_customers, $cInfo->manudiscount_customers_id, 'disabled');
                  ?><input type="checkbox" name="checkbox_customers" value="false" onclick="if (manudiscount_customers_id.disabled && checkbox_customers.checked) {manudiscount_customers_id.disabled = false; manudiscount_groups_id.disabled = true; checkbox_customers_groups.checked = false} else {manudiscount_customers_id.disabled = true; manudiscount_groups_id.disabled = true;}">
		    </td>
          </tr>
		  <tr>
            <td class="main"><?php echo ENTRY_GROUPS_NAME; ?></td>
			<td class="main"><?php
		          $customers_groups_query = tep_db_query("select distinct customers_groups_name, customers_groups_id from " . TABLE_CUSTOMERS_GROUPS . " order by customers_groups_name");
                  $input_groups=array();$all_groups=array();$sde=0;
                  while ($existing_groups = tep_db_fetch_array($customers_groups_query)) {
                     $input_groups[$sde++]=array("id"=>$existing_groups['customers_groups_id'],
	                                             "text"=>$existing_groups['customers_groups_name']);
	              }
				  echo tep_draw_pull_down_menu('manudiscount_groups_id', $input_groups, $cInfo->manudiscount_groups_id, 'disabled');
                  ?><input type="checkbox" name="checkbox_customers_groups" value="false" onclick="if (manudiscount_groups_id.disabled && checkbox_customers_groups.checked) {checkbox_customers_groups.value = true; manudiscount_groups_id.disabled = false; manudiscount_customers_id.disabled = true; checkbox_customers.checked = false} else {checkbox_customers_groups.value = false; manudiscount_groups_id.disabled = true; manudiscount_customers_id.disabled = true; }">
		    </td>
          </tr>
		  <tr>
            <td class="main"><?php echo ENTRY_MANUFACTURERS_NAME; ?></td>
			<td class="main"><?php
		          $customers_groups_query = tep_db_query("select distinct manufacturers_name, manufacturers_id from " . TABLE_MANUFACTURERS . " order by manufacturers_name");
                  $input_groups=array();$all_groups=array();$sde=0;
                  while ($existing_groups = tep_db_fetch_array($customers_groups_query)) {
                     $input_groups[$sde++]=array("id"=>$existing_groups['manufacturers_id'],
	                                             "text"=>$existing_groups['manufacturers_name']);
	              }
				  echo tep_draw_pull_down_menu('manudiscount_manufacturers_id', $input_groups);
               ?>
		    </td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.png', '1', '10'); ?></td>
      </tr>
      <tr>
        <td align="right" class="main"><?php echo tep_image_submit('button_update.png', IMAGE_UPDATE) . ' <a href="' . tep_href_link('manudiscount.php', tep_get_all_get_params(array('action','cID'))) .'">' . tep_image_button('button_cancel.png', IMAGE_CANCEL) . '</a>'; ?></td>
      </tr>
      </form>
<?php 
  } else {
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr><?php echo tep_draw_form('search', 'manudiscount.php', '', 'get'); ?>
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
              $order = "g.manudiscount_id";
              break;
              case "group":
              $order = "g.manudiscount_name";
              break;
              case "group-desc":
              $order = "g.manudiscount_name DESC";
              break;
              case "discount":
              $order = "g.manudiscount_discount";
              break;
              case "discount-desc":
              $order = "g.manudiscount_discount DESC";
              break;
              default:
              $order = "g.manudiscount_id ASC";
          }
          ?>
	    <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
               <tr class="dataTableHeadingRow">
			       <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_NAME; ?>&nbsp;<a href="<?php echo "$PHP_SELF?listing=group"; ?>"><b>Asc</b></a>&nbsp;<a href="<?php echo "$PHP_SELF?listing=group-desc"; ?>"><b>Desc</b></a></td>
                   <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_DISCOUNT; ?>&nbsp;<a href="<?php echo "$PHP_SELF?listing=discount"; ?>"><b>Asc</b></a>&nbsp;<a href="<?php echo "$PHP_SELF?listing=discount-desc"; ?>"><b>Desc</b></a></td>
				   <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_CUSTOMERS; ?>&nbsp;</td>
                   <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_GROUPS; ?>&nbsp;</td>
				   <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_MANUFACTURERS; ?>&nbsp;</td>
				   <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
			   </tr>

<?php
    $search = '';
    if ( ($_GET['search']) && (tep_not_null($_GET['search'])) ) {
      $keywords = tep_db_input(tep_db_prepare_input($_GET['search']));
      $search = "and g.manudiscount_name like '%" . $keywords . "%'";
    }

    $manudiscount_query_raw = "select g.manudiscount_id, g.manudiscount_name, g.manudiscount_discount,  gm.manufacturers_name as manudiscount_manufacturers_name, g.manudiscount_customers_id, g.manudiscount_groups_id from " . TABLE_MANUDISCOUNT . " g, " .  TABLE_MANUFACTURERS . " gm where g.manudiscount_manufacturers_id = gm.manufacturers_id " . $search . " order by " . $order;
    $manudiscount_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $manudiscount_query_raw, $manudiscount_query_numrows);
    $manudiscount_query = tep_db_query($manudiscount_query_raw);

    while ($manudiscount = tep_db_fetch_array($manudiscount_query)) {

      if (((!$_GET['cID']) || (@$_GET['cID'] == $manudiscount['manudiscount_id'])) && (!$cInfo)) {
        $cInfo = new objectInfo($manudiscount);
      }
      
	  if ($manudiscount['manudiscount_customers_id'] != 0) {
		  $customers_query = tep_db_query("select distinct customers_firstname, customers_lastname, customers_id from " . TABLE_CUSTOMERS . " where customers_id = '" . $manudiscount['manudiscount_customers_id'] . "'");
		  $customers = tep_db_fetch_array($customers_query);
		  $manudiscount_customers_name = $customers['customers_lastname'] . " " . $customers['customers_firstname'];
          $manudiscount_groups_name = "&nbsp;";
	  } else if ($manudiscount['manudiscount_groups_id'] !=0) {
	      $customers_groups_query = tep_db_query("select distinct customers_groups_name, customers_groups_id from " . TABLE_CUSTOMERS_GROUPS . " where customers_groups_id = '" .$manudiscount['manudiscount_groups_id'] . "'");
		  $customers_groups = tep_db_fetch_array($customers_groups_query);
          $manudiscount_groups_name =  $customers_groups['customers_groups_name'];
		  $manudiscount_customers_name =  "&nbsp;";
	  } else {
		  $manudiscount_customers_name =  "&nbsp;";
		  $manudiscount_groups_name = "&nbsp;";
	  }
      if ( (is_object($cInfo)) && ($manudiscount['manudiscount_id'] == $cInfo->manudiscount_id) ) {
        echo '          <tr class="dataTableRowSelected" onmouseover="this.style.cursor=\'hand\'" onclick="document.location.href=\'' . tep_href_link('manudiscount.php', tep_get_all_get_params(array('cID', 'action')) . 'cID=' . $cInfo->manudiscount_id . '&action=edit') . '\'">' . "\n";
      } else {
        echo '          <tr class="dataTableRow" onmouseover="this.className=\'dataTableRowOver\';this.style.cursor=\'hand\'" onmouseout="this.className=\'dataTableRow\'" onclick="document.location.href=\'' . tep_href_link('manudiscount.php', tep_get_all_get_params(array('cID')) . 'cID=' . $manudiscount['manudiscount_id']) . '\'">' . "\n";
      }
?>
                <td class="dataTableContent"><?php echo $manudiscount['manudiscount_name']; ?></td>
                <td class="dataTableContent" align="right"><?php echo $manudiscount['manudiscount_discount']; ?>%</td>
				<td class="dataTableContent" align="right"><?php echo $manudiscount_customers_name; ?></td>
				<td class="dataTableContent" align="right"><?php echo $manudiscount_groups_name; ?></td>
				<td class="dataTableContent" align="right"><?php echo $manudiscount['manudiscount_manufacturers_name']; ?></td>
                <td class="dataTableContent" align="right"><?php if ( (is_object($cInfo)) && ($manudiscount['manudiscount_id'] == $cInfo->manudiscount_id) ) { echo tep_image(DIR_WS_IMAGES . 'icon_arrow_right.png', ''); } else { echo '<a href="' . tep_href_link('manudiscount.php', tep_get_all_get_params(array('cID')) . 'cID=' . $manudiscount['manudiscount_id']) . '">' . tep_image(DIR_WS_IMAGES . 'icon_info.png', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
    }
?>
              <tr>
                <td colspan="6"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $manudiscount_split->display_count($manudiscount_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_CUSTOMERS); ?></td>
                    <td class="smallText" align="right"><?php echo $manudiscount_split->display_links($manudiscount_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], tep_get_all_get_params(array('page', 'info', 'x', 'y', 'cID'))); ?></td>
                  </tr>
<?php
    if (tep_not_null($_GET['search'])) {
?>
                  <tr>
                    <td align="right" colspan="2"><?php echo '<a href="' . tep_href_link('manudiscount.php') . '">' . tep_image_button('button_reset.png', IMAGE_RESET) . '</a>'; ?></td>
                  </tr>
<?php
    } else {
?>
			      <tr>
                    <td align="right" colspan="2" class="smallText"><?php echo '<a href="' . tep_href_link('manudiscount.php', 'page=' . $_GET['page'] . '&amp;action=new') . '">' . tep_image_button('button_insert.png', IMAGE_INSERT) . '</a>'; ?></td>
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
            $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_MANUDISCOUNT . '</b>');
            $contents = array('form' => tep_draw_form('manudiscount', 'manudiscount.php', tep_get_all_get_params(array('cID', 'action')) . 'cID=' . $cInfo->manudiscount_id . '&action=deleteconfirm'));
            $contents[] = array('text' => TEXT_DELETE_INTRO . '<br /><br /><b>' . $cInfo->manudiscount_name . ' </b>');
            $contents[] = array('align' => 'center', 'text' => '<br />' . tep_image_submit('button_delete.png', IMAGE_DELETE) . ' <a href="' . tep_href_link('manudiscount.php', tep_get_all_get_params(array('cID', 'action')) . 'cID=' . $cInfo->manudiscount_id) . '">' . tep_image_button('button_cancel.png', IMAGE_CANCEL) . '</a>');
      break;
    default:
      if (is_object($cInfo)) {
        $heading[] = array('text' => '<b>' . $cInfo->manudiscount_name . ' </b>');
        $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link('manudiscount.php', tep_get_all_get_params(array('cID', 'action')) . 'cID=' . $cInfo->manudiscount_id . '&action=edit') . '">' . tep_image_button('button_edit.png', IMAGE_EDIT) . '</a> <a href="' . tep_href_link('manudiscount.php', tep_get_all_get_params(array('cID', 'action')) . 'cID=' . $cInfo->manudiscount_id . '&action=confirm') . '">' . tep_image_button('button_delete.png', IMAGE_DELETE) . '</a>');

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