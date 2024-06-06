<?php
/*
  $Id: specials.php,v 1.41 2003/06/29 22:50:52 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();

  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (tep_not_null($action)) {
    switch ($action) {
      case 'setflag':
        tep_set_specials_status($_GET['id'], $_GET['flag']);

        tep_redirect(tep_href_link(FILENAME_SPECIALS, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . 'sID=' . $_GET['id'], 'NONSSL'));
        break;
      case 'insert':
        $products_id = tep_db_prepare_input($_POST['products_id']);
        $products_price = tep_db_prepare_input($_POST['products_price']);
        $specials_price = tep_db_prepare_input($_POST['specials_price']);
        $day = tep_db_prepare_input($_POST['day']);
        $month = tep_db_prepare_input($_POST['month']);
        $year = tep_db_prepare_input($_POST['year']);

        //TotalB2B start
		$checkbox_customers_groups = tep_db_prepare_input($_POST['checkbox_customers_groups']);
        $customers_groups = tep_db_prepare_input($_POST['customers_groups']);
		if ($checkbox_customers_groups == false) $customers_groups = 0;
		$checkbox_customers = tep_db_prepare_input($_POST['checkbox_customers']);
        $customers = tep_db_prepare_input($_POST['customers']);
		if ($checkbox_customers == false) $customers = 0;
        //TotalB2B end

        if (substr($specials_price, -1) == '%') {
          $new_special_insert_query = tep_db_query("select products_id, products_price from " . TABLE_PRODUCTS . " where products_id = '" . (int)$products_id . "'");
          $new_special_insert = tep_db_fetch_array($new_special_insert_query);

          $products_price = $new_special_insert['products_price'];
          $specials_price = ($products_price - (($specials_price / 100) * $products_price));
        }

        $expires_date = '';
        if (tep_not_null($day) && tep_not_null($month) && tep_not_null($year)) {
          $expires_date = $year;
          $expires_date .= (strlen($month) == 1) ? '0' . $month : $month;
          $expires_date .= (strlen($day) == 1) ? '0' . $day : $day;
        }

        //TotalB2B start
     // tep_db_query("insert into " . TABLE_SPECIALS . " (products_id, specials_new_products_price, specials_date_added, expires_date, status) values ('" . (int)$products_id . "', '" . tep_db_input($specials_price) . "', now(), '" . tep_db_input($expires_date) . "', '1')");
		tep_db_query("insert into " . TABLE_SPECIALS . " (products_id, specials_new_products_price, specials_date_added, expires_date, status, customers_groups_id, customers_id) values ('" . (int)$products_id . "', '" . tep_db_input($specials_price) . "', now(), '" . tep_db_input($expires_date) . "', '1', ".(int)$customers_groups.", ".(int)$customers.")");
        //TotalB2B end

        tep_redirect(tep_href_link(FILENAME_SPECIALS, 'page=' . $_GET['page']));
        break;
      case 'update':
        $specials_id = tep_db_prepare_input($_POST['specials_id']);
        $products_price = tep_db_prepare_input($_POST['products_price']);
        $specials_price = tep_db_prepare_input($_POST['specials_price']);
        $day = tep_db_prepare_input($_POST['day']);
        $month = tep_db_prepare_input($_POST['month']);
        $year = tep_db_prepare_input($_POST['year']);

        //TotalB2B start
		$checkbox_customers_groups = tep_db_prepare_input($_POST['checkbox_customers_groups']);
        $customers_groups = tep_db_prepare_input($_POST['customers_groups']);
		if ($checkbox_customers_groups == false) $customers_groups = 0;
		$checkbox_customers = tep_db_prepare_input($_POST['checkbox_customers']);
        $customers = tep_db_prepare_input($_POST['customers']);
		if ($checkbox_customers == false) $customers = 0;
        //TotalB2B end

        if (substr($specials_price, -1) == '%') $specials_price = ($products_price - (($specials_price / 100) * $products_price));

        $expires_date = '';
        if (tep_not_null($day) && tep_not_null($month) && tep_not_null($year)) {
          $expires_date = $year;
          $expires_date .= (strlen($month) == 1) ? '0' . $month : $month;
          $expires_date .= (strlen($day) == 1) ? '0' . $day : $day;
        }

		//TotalB2B start
     // tep_db_query("update " . TABLE_SPECIALS . " set specials_new_products_price = '" . tep_db_input($specials_price) . "', specials_last_modified = now(), expires_date = '" . tep_db_input($expires_date) . "' where specials_id = '" . (int)$specials_id . "'");
        tep_db_query("update " . TABLE_SPECIALS . " set specials_new_products_price = '" . tep_db_input($specials_price) . "', specials_last_modified = now(), expires_date = '" . tep_db_input($expires_date) . "', customers_groups_id = " . (int)$customers_groups . ", customers_id = " . (int)$customers. " where specials_id = '" . (int)$specials_id . "'");
        //TotalB2B end

        tep_redirect(tep_href_link(FILENAME_SPECIALS, 'page=' . $_GET['page'] . '&sID=' . $specials_id));
        break;
      case 'deleteconfirm':
        $specials_id = tep_db_prepare_input($_GET['sID']);

        tep_db_query("delete from " . TABLE_SPECIALS . " where specials_id = '" . (int)$specials_id . "'");

        tep_redirect(tep_href_link(FILENAME_SPECIALS, 'page=' . $_GET['page']));
        break;
    }
  }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>"/>
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css"/>
<script type="text/javascript" src="includes/general.js"></script>
<?php
  if ( ($action == 'new') || ($action == 'edit') ) {
?>
<link rel="stylesheet" type="text/css" href="includes/javascript/calendar.css" />
<script type="text/javascript" src="includes/javascript/calendarcode.js"></script>
<?php
  }
?>
</head>
<body style="margin:0;" onload="SetFocus();">
<div id="popupcalendar" class="text"></div>
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
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.png', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
<?php
  if ( ($action == 'new') || ($action == 'edit') ) {
    $form_action = 'insert';
	  
	//TotalB2B start
    $specials_array = array();
    $specials_query = tep_db_query("select p.products_id, s.customers_groups_id from " .  TABLE_PRODUCTS . " p, " . TABLE_SPECIALS . " s where s.products_id = p.products_id");
    while ($specials = tep_db_fetch_array($specials_query)) {
      $specials_array[] = (int)$specials['products_id'].":".(int)$specials['customers_groups_id'];
    }
	$specials_query = tep_db_query("select p.products_id, s.customers_id from " .  TABLE_PRODUCTS . " p, " . TABLE_SPECIALS . " s where s.products_id = p.products_id");
    while ($specials = tep_db_fetch_array($specials_query)) {
      $specials_array[] = (int)$specials['products_id'].":".(int)$specials['customers_id'];
    }
    $customers_groups_query = tep_db_query("select distinct customers_groups_name, customers_groups_id from " . TABLE_CUSTOMERS_GROUPS . " order by customers_groups_name");
    $input_groups=array();$all_groups=array();$sde=0;
    while ($existing_groups = tep_db_fetch_array($customers_groups_query)) {
      $input_groups[$sde++]=array("id"=>$existing_groups['customers_groups_id'],
	                      "text"=>$existing_groups['customers_groups_name']);
	  $all_groups[$existing_groups['customers_groups_id']]=$existing_groups['customers_groups_name'];
    }
	$customers_query = tep_db_query("select distinct customers_firstname, customers_lastname, customers_id from " . TABLE_CUSTOMERS . " order by customers_lastname, customers_firstname");
	$input_customers=array();$all_customers=array();$sde=0;
    while ($existing_customers = tep_db_fetch_array($customers_query)) {
      $input_customers[$sde++]=array("id"=>$existing_customers['customers_id'],
	                      "text"=>$existing_customers['customers_lastname'] . " " . $existing_customers['customers_firstname']);
	  $all_customers[$existing_customers['customers_id']]=$existing_customers['customers_lastname'] . " " . $existing_customers['customers_firstname'];
    }
    //TotalB2B end
	  
    if ( ($action == 'edit') && isset($_GET['sID']) ) {
      $form_action = 'update';

//TotalB2B start
   // $product_query = tep_db_query("select p.products_id, pd.products_name, p.products_price, s.specials_new_products_price, s.expires_date from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_SPECIALS . " s where p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and p.products_id = s.products_id and s.specials_id = '" . (int)$_GET['sID'] . "'");
      $product_query = tep_db_query("select p.products_id, pd.products_name, s.customers_groups_id, s.customers_id, p.products_price, s.specials_new_products_price, s.expires_date from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_SPECIALS . " s where p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and p.products_id = s.products_id and s.specials_id = '" . (int)$_GET['sID'] . "'");
//TotalB2B end

      $product = tep_db_fetch_array($product_query);

      $sInfo = new objectInfo($product);
    } else {
      $sInfo = new objectInfo(array());

// create an array of products on special, which will be excluded from the pull down menu of products
// (when creating a new product on special)
      $specials_array = array();
      $specials_query = tep_db_query("select p.products_id from " . TABLE_PRODUCTS . " p, " . TABLE_SPECIALS . " s where s.products_id = p.products_id");
      while ($specials = tep_db_fetch_array($specials_query)) {
        $specials_array[] = $specials['products_id'];
      }
    }
?>
      <tr><form name="new_special" <?php echo 'action="' . tep_href_link(FILENAME_SPECIALS, tep_get_all_get_params(array('action', 'info', 'sID')) . 'action=' . $form_action, 'NONSSL') . '"'; ?> method="post"><?php if ($form_action == 'update') echo tep_draw_hidden_field('specials_id', $_GET['sID']); ?>
        <td><br /><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><?php echo TEXT_SPECIALS_PRODUCT; ?>&nbsp;</td>
            <td class="main"><?php echo (isset($sInfo->products_name)) ? $sInfo->products_name . ' <small>(' . $currencies->format($sInfo->products_price) . ')</small>' : tep_draw_products_pull_down('products_id', 'style="font-size:10px"', $specials_array); echo tep_draw_hidden_field('products_price', (isset($sInfo->products_price) ? $sInfo->products_price : '')); ?></td>
          </tr>

		  <!--TotalB2B start-->
		  <tr>
            <td class="main"><?php echo TEXT_SPECIALS_CUSTOMERS; ?>&nbsp;</td>
            <td class="main">
				<?php
			        if ($sInfo->customers_id != 0) {
			           echo tep_draw_pull_down_menu('customers', $input_customers, (isset($sInfo->customers_id)?$sInfo->customers_id:''),'');
					   ?><input type="checkbox" name="checkbox_customers" checked value="false" onclick="if (customers.disabled && checkbox_customers.checked) {customers.disabled = false; customers_groups.disabled = true; checkbox_customers_groups.checked = false} else {customers.disabled = true; customers_groups.disabled = true;}" /><?php
		            } else {
					   echo tep_draw_pull_down_menu('customers', $input_customers, (isset($sInfo->customers_id)?$sInfo->customers_id:''),'disabled');
					   ?><input type="checkbox" name="checkbox_customers" value="false" onclick="if (customers.disabled && checkbox_customers.checked) {customers.disabled = false; customers_groups.disabled = true; checkbox_customers_groups.checked = false} else {customers.disabled = true; customers_groups.disabled = true;}" /><?php
					}
		        ?>
		    </td>
          </tr>
		  <tr>
            <td class="main"><?php echo TEXT_SPECIALS_GROUPS; ?>&nbsp;</td>
            <td class="main">
				<?php
			       if ($sInfo->customers_groups_id != 0) {
			          echo tep_draw_pull_down_menu('customers_groups', $input_groups, (isset($sInfo->customers_groups_id)?$sInfo->customers_groups_id:''),'');
		              ?><input type="checkbox" name="checkbox_customers_groups" checked value="false" onclick="if (customers_groups.disabled && checkbox_customers_groups.checked) {checkbox_customers_groups.value = true; customers_groups.disabled = false; customers.disabled = true; checkbox_customers.checked = false} else {checkbox_customers_groups.value = false; customers_groups.disabled = true; customers.disabled = true; }" /><?php
				   } else {
                      echo tep_draw_pull_down_menu('customers_groups', $input_groups, (isset($sInfo->customers_groups_id)?$sInfo->customers_groups_id:''),'disabled');
				      ?><input type="checkbox" name="checkbox_customers_groups" value="false" onclick="if (customers_groups.disabled && checkbox_customers_groups.checked) {checkbox_customers_groups.value = true; customers_groups.disabled = false; customers.disabled = true; checkbox_customers.checked = false} else {checkbox_customers_groups.value = false; customers_groups.disabled = true; customers.disabled = true; }" /><?php
				   }
				?>
		   </td>
          </tr>
          <!--TotalB2B end-->

          <tr>
            <td class="main"><?php echo TEXT_SPECIALS_SPECIAL_PRICE; ?>&nbsp;</td>
            <td class="main"><?php echo tep_draw_input_field('specials_price', (isset($sInfo->specials_new_products_price) ? $sInfo->specials_new_products_price : '')); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo TEXT_SPECIALS_EXPIRES_DATE; ?>&nbsp;</td>
            <td class="main"><?php echo tep_draw_input_field('day', (isset($sInfo->expires_date) ? substr($sInfo->expires_date, 8, 2) : ''), 'size="2" maxlength="2" class="cal-TextBox"') . tep_draw_input_field('month', (isset($sInfo->expires_date) ? substr($sInfo->expires_date, 5, 2) : ''), 'size="2" maxlength="2" class="cal-TextBox"') . tep_draw_input_field('year', (isset($sInfo->expires_date) ? substr($sInfo->expires_date, 0, 4) : ''), 'size="4" maxlength="4" class="cal-TextBox"'); ?><a class="so-BtnLink" href="javascript:calClick();return false;" onmouseover="calSwapImg('BTN_date', 'img_Date_OVER',true);" onmouseout="calSwapImg('BTN_date', 'img_Date_UP',true);" onclick="calSwapImg('BTN_date', 'img_Date_DOWN');showCalendar('new_special','dteWhen','BTN_date');return false;"><?php echo tep_image(DIR_WS_IMAGES . 'cal_date_up.png', 'Calendar', '22', '17', 'align="absmiddle" name="BTN_date"'); ?></a></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><br /><?php echo TEXT_SPECIALS_PRICE_TIP; ?></td>
            <td class="main" align="right" valign="top"><br /><?php echo (($form_action == 'insert') ? tep_image_submit('button_insert.png', IMAGE_INSERT) : tep_image_submit('button_update.png', IMAGE_UPDATE)). '&nbsp;&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_SPECIALS, 'page=' . $_GET['page'] . (isset($_GET['sID']) ? '&amp;sID=' . $_GET['sID'] : '')) . '">' . tep_image_button('button_cancel.png', IMAGE_CANCEL) . '</a>'; ?></td>
          </tr>
        </table></td>
      </form></tr>
<?php
  } else {
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">

			  <!--TotalB2B start-->
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCTS; ?>&nbsp;<a href="<?php echo "$PHP_SELF"; ?>"><b>N</b></a></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_PRODUCTS_PRICE; ?>&nbsp;<a href="<?php echo "$PHP_SELF?listing=customers"; ?>"><b>C</b></a>&nbsp;<a href="<?php echo "$PHP_SELF?listing=groups"; ?>"><b>G</b></a></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_STATUS; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>

	   <?php
          switch ($listing) {
              case "customers":
              $order = "s.customers_id DESC, s.customers_groups_id, pd.products_name";
              break;
              case "groups":
              $order = "s.customers_groups_id DESC, s.customers_id, pd.products_name";
              break;
              default:
              $order = "pd.products_name, s.customers_groups_id, s.customers_id";
          }
          ?>
        <!--TotalB2B stop-->

<?php
    //TotalB2B start
    $all_groups=array();
    $customers_groups_query = tep_db_query("select distinct customers_groups_name, customers_groups_id from " . TABLE_CUSTOMERS_GROUPS . " order by customers_groups_id ");
    while ($existing_groups =  tep_db_fetch_array($customers_groups_query)) {
      $all_groups[$existing_groups['customers_groups_id']]=$existing_groups['customers_groups_name'];
    }
	$all_customers=array();
	$customers_query = tep_db_query("select distinct customers_firstname, customers_lastname, customers_id from " . TABLE_CUSTOMERS . " order by customers_id");
    while ($existing_customers = tep_db_fetch_array($customers_query)) {
      $all_customers[$existing_customers['customers_id']]=$existing_customers['customers_lastname'] . " " . $existing_customers['customers_firstname'];
    }
    $specials_query_raw = "select p.products_id, pd.products_name, p.products_price, s.specials_id, s.customers_groups_id, s.customers_id, s.specials_new_products_price, s.specials_date_added, s.specials_last_modified, s.expires_date, s.date_status_change, s.status from " . TABLE_PRODUCTS . " p, " . TABLE_SPECIALS . " s, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and p.products_id = s.products_id order by " . $order;
 // $specials_query_raw = "select p.products_id, pd.products_name, p.products_price, s.specials_id, s.specials_new_products_price, s.specials_date_added, s.specials_last_modified, s.expires_date, s.date_status_change, s.status from " . TABLE_PRODUCTS . " p, " . TABLE_SPECIALS . " s, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and p.products_id = s.products_id order by pd.products_name";
    //TotalB2B end

    $specials_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $specials_query_raw, $specials_query_numrows);
    $specials_query = tep_db_query($specials_query_raw);
    while ($specials = tep_db_fetch_array($specials_query)) {
      if ((!isset($_GET['sID']) || (isset($_GET['sID']) && ($_GET['sID'] == $specials['specials_id']))) && !isset($sInfo)) {
        $products_query = tep_db_query("select products_image from " . TABLE_PRODUCTS . " where products_id = '" . (int)$specials['products_id'] . "'");
        $products = tep_db_fetch_array($products_query);
        $sInfo_array = array_merge($specials, $products);
        $sInfo = new objectInfo($sInfo_array);
      }

      //TotalB2B start
      if (isset($sInfo) && is_object($sInfo) && ($specials['specials_id'] == $sInfo->specials_id)) {
        echo '                  <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_SPECIALS, 'listing=' . $listing . '&amp;page=' . $_GET['page'] . '&amp;sID=' . $sInfo->specials_id . '&amp;action=edit') . '\'">' . "\n";
      } else {
        echo '                  <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_SPECIALS, 'listing=' . $listing . '&amp;page=' . $_GET['page'] . '&amp;sID=' . $specials['specials_id']) . '\'">' . "\n";
      }
      //TotalB2B end

?>
                <td  class="dataTableContent"><?php echo $specials['products_name']; ?></td>
                
				<!--TotalB2B start-->
			    <td class="dataTableContent" align="right">
				    <span class="oldPrice">
				      <?php echo $currencies->format($specials['products_price']); ?></span>
					<span class="specialPrice">
					  <?php echo $currencies->format($specials['specials_new_products_price']);
				            if ($specials['customers_groups_id'] != 0) {
					          echo " ( [G] -> " . $all_groups[$specials['customers_groups_id']];
							} else if ($specials['customers_id'] != 0) {
							  echo " ( [C] -> " . $all_customers[$specials['customers_id']];
							} else {
							  echo " ( ";
							}
							echo " )";?>
				   </span></td>
                <!--TotalB2B end-->

                <td  class="dataTableContent" align="right">
<?php
      if ($specials['status'] == '1') {
        echo tep_image(DIR_WS_IMAGES . 'icon_status_green.png', IMAGE_ICON_STATUS_GREEN, 10, 10) . '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_SPECIALS, 'action=setflag&amp;flag=0&amp;id=' . $specials['specials_id'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_red_light.png', IMAGE_ICON_STATUS_RED_LIGHT, 10, 10) . '</a>';
      } else {
        echo '<a href="' . tep_href_link(FILENAME_SPECIALS, 'action=setflag&amp;flag=1&amp;id=' . $specials['specials_id'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_green_light.png', IMAGE_ICON_STATUS_GREEN_LIGHT, 10, 10) . '</a>&nbsp;&nbsp;' . tep_image(DIR_WS_IMAGES . 'icon_status_red.png', IMAGE_ICON_STATUS_RED, 10, 10);
      }
?></td>
                <td class="dataTableContent" align="right"><?php echo '<a href="' . tep_href_link(FILENAME_SPECIALS, 'page=' . $_GET['page'] . '&amp;sID=' . $specials['specials_id'] . '&amp;action=edit') . '">' . tep_image(DIR_WS_ICONS . 'edit.png', IMAGE_EDIT) . '</a>';?>&nbsp;&nbsp;<?php echo '<a href="' . tep_href_link(FILENAME_SPECIALS, 'page=' . $_GET['page'] . '&amp;sID=' . $specials['specials_id'] . '&amp;action=delete') . '">' . tep_image(DIR_WS_ICONS . 'delete.png', ICON_DELETE) . '</a>';?>&nbsp;&nbsp;<?php if (isset($sInfo) && is_object($sInfo) && ($specials['specials_id'] == $sInfo->specials_id)) { echo tep_image(DIR_WS_IMAGES . 'icon_arrow_right.png', ''); } else { echo '<a href="' . tep_href_link(FILENAME_SPECIALS, 'page=' . $_GET['page'] . '&amp;sID=' . $specials['specials_id']) . '">' . tep_image(DIR_WS_IMAGES . 'icon_info.png', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
      </tr>
<?php
    }
?>
              <tr>
                <td colspan="4"><table border="0" width="100%" cellpadding="0"cellspacing="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $specials_split->display_count($specials_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_SPECIALS); ?></td>
                    <td class="smallText" align="right"><?php echo $specials_split->display_links($specials_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']); ?></td>
                  </tr>
<?php
  if (empty($action)) {
?>
                  <tr>
                    <td colspan="2" align="right"><?php echo '<a href="' . tep_href_link(FILENAME_SPECIALS, 'page=' . $_GET['page'] . '&amp;action=new') . '">' . tep_image_button('button_new_product.png', IMAGE_NEW_PRODUCT) . '</a>'; ?></td>
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

  switch ($action) {
    case 'delete':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_SPECIALS . '</b>');

      $contents = array('form' => tep_draw_form('specials', FILENAME_SPECIALS, 'page=' . $_GET['page'] . '&amp;sID=' . $sInfo->specials_id . '&amp;action=deleteconfirm'));
      $contents[] = array('text' => TEXT_INFO_DELETE_INTRO);
      $contents[] = array('text' => '<br /><b>' . $sInfo->products_name . '</b>');
      $contents[] = array('align' => 'center', 'text' => '<br />' . tep_image_submit('button_delete.png', IMAGE_DELETE) . '&nbsp;<a href="' . tep_href_link(FILENAME_SPECIALS, 'page=' . $_GET['page'] . '&amp;sID=' . $sInfo->specials_id) . '">' . tep_image_button('button_cancel.png', IMAGE_CANCEL) . '</a>');
      break;
    default:
      if (is_object($sInfo)) {
        $heading[] = array('text' => '<b>' . $sInfo->products_name . '</b>');

        $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_SPECIALS, 'page=' . $_GET['page'] . '&amp;sID=' . $sInfo->specials_id . '&amp;action=edit') . '">' . tep_image_button('button_edit.png', IMAGE_EDIT) . '</a> <a href="' . tep_href_link(FILENAME_SPECIALS, 'page=' . $_GET['page'] . '&amp;sID=' . $sInfo->specials_id . '&amp;action=delete') . '">' . tep_image_button('button_delete.png', IMAGE_DELETE) . '</a>');
        $contents[] = array('text' => '<br />' . TEXT_INFO_DATE_ADDED . ' ' . tep_date_short($sInfo->specials_date_added));
        $contents[] = array('text' => '' . TEXT_INFO_LAST_MODIFIED . ' ' . tep_date_short($sInfo->specials_last_modified));
        $contents[] = array('align' => 'center', 'text' => '<br />' . tep_info_image($sInfo->products_image, $sInfo->products_name, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT));
        $contents[] = array('text' => '<br />' . TEXT_INFO_ORIGINAL_PRICE . ' ' . $currencies->format($sInfo->products_price));
        $contents[] = array('text' => '' . TEXT_INFO_NEW_PRICE . ' ' . $currencies->format($sInfo->specials_new_products_price));
        $contents[] = array('text' => '' . TEXT_INFO_PERCENTAGE . ' ' . number_format(100 - (($sInfo->specials_new_products_price / $sInfo->products_price) * 100)) . '%');

        $contents[] = array('text' => '<br />' . TEXT_INFO_EXPIRES_DATE . ' <b>' . tep_date_short($sInfo->expires_date) . '</b>');
        $contents[] = array('text' => '' . TEXT_INFO_STATUS_CHANGE . ' ' . tep_date_short($sInfo->date_status_change));
      }
      break;
  }
  if ( (tep_not_null($heading)) && (tep_not_null($contents)) ) {
    echo '            <td width="25%" valign="top">' . "\n";

    $box = new box;
    echo $box->infoBox($heading, $contents);

    echo '            </td>' . "\n";
  }
}
?>
          </tr>
        </table></td>
      </tr>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
