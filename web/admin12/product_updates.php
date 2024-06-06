<?php
/*
  $Id: product_updates.php,v 1.2 2005/02/12 Exp $

  osCommerce
  http://www.oscommerce.com

  Copyright (c) 2006

  Released under the GNU General Public License\
*/

if(!isset($_POST)) {
extract($HTTP_POST_VARS);
extract($HTTP_GET_VARS);
} else {
extract($_POST);
extract($_GET);
}

  require('includes/application_top.php');
  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();

  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if ($_GET['action'] == 'update') {
    foreach ($_POST['event_record'] as $id => $row) {
	$products_query = tep_db_query("SELECT * from " . TABLE_PRODUCTS);
	$products = array();
	while($product = tep_db_fetch_array($products_query))
	{
		$products[$product['products_id']] = array(
												'products_id' => $product['products_id'],
												'products_price' => number_format($product['products_price'], 2),
												'products_model' => $product['products_model'],
												'products_weight' => number_format($product['products_weight'], 1),
												'products_length' => number_format($product['products_length'], 0),
												'products_width' => number_format($product['products_width'], 0),
												'products_height' => number_format($product['products_height'], 0),
												'products_ready_to_ship' => $product['products_ready_to_ship'],
												'products_quantity' => number_format($product['products_quantity'], 0)
											);
	}
	
	if( strcasecmp($products[$row['products_id']]['products_price'], $row['products_price']) != 0 || 
		strcasecmp($products[$row['products_id']]['products_model'], $row['products_model']) != 0 || 
		strcasecmp($products[$row['products_id']]['products_weight'], $row['products_weight']) != 0 || 
		strcasecmp($products[$row['products_id']]['products_length'], $row['products_length']) != 0 || 
		strcasecmp($products[$row['products_id']]['products_width'], $row['products_width']) != 0 || 
		strcasecmp($products[$row['products_id']]['products_height'], $row['products_height']) != 0 || 
		strcasecmp($products[$row['products_id']]['products_ready_to_ship'], $row['products_ready_to_ship']) != 0 || 
		strcasecmp($products[$row['products_id']]['products_quantity'], $row['products_quantity']) != 0
	) {
		
		tep_db_query("UPDATE " . TABLE_PRODUCTS . " SET products_price = '" . $row['products_price'] . "', products_model = '" . $row['products_model'] . "', products_weight = '" . $row['products_weight'] . "', products_length = '" . $row['products_length'] . "', products_width = '" . $row['products_width'] . "', products_height = '" . $row['products_height'] . "', products_ready_to_ship = '" . $row['products_ready_to_ship'] . "', products_quantity = '" . $row['products_quantity'] . "' where products_id = '" . $row['products_id'] . "'");
		$products_updated = true;
	  }
    }
      if ($products_updated == true) {
        $messageStack->add_session(SUCCESS_PRODUCTS_UPDATED, 'success');
      } else {
        $messageStack->add_session(WARNING_PRODUCTS_NOT_UPDATED, 'warning');
      }
    tep_redirect(tep_href_link(FILENAME_PRODUCT_UPDATES));
  }

  /*if ($_GET['action'] == 'export') {
   $csv_output = TABLE_HEADING_PRODUCT_ID . ";" . TABLE_HEADING_PMAN . ";" . TABLE_HEADING_PNAME . ";" . TABLE_HEADING_PMODEL . ";" . TABLE_HEADING_PPRICE . ";" . TABLE_HEADING_PWEIGHT . ";" . TEXT_PRODUCTS_LENGTH . ";" . TEXT_PRODUCTS_WIDTH . ";" . TEXT_PRODUCTS_HEIGHT . ";" 
   // . TEXT_PRODUCTS_READY_TO_SHIP . ";" 
   . TABLE_HEADING_PQTY;
   $csv_output .= "\n";
   $csv_query = tep_db_query("select p.products_id, p.manufacturers_id, p.products_quantity, p.products_price, p.products_weight, products_length, products_width, products_height, products_ready_to_ship, p.products_model, pd.products_name, m.manufacturers_id, m.manufacturers_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_MANUFACTURERS . " m where p.products_id = pd.products_id and p.manufacturers_id = m.manufacturers_id group by pd.products_name order by pd.products_name ASC");
      while ($csv = tep_db_fetch_array($csv_query)) {
       $csv_output .= $csv['products_id'] . ";" . $csv['manufacturers_name'] . ";" . $csv['products_name'] . ";" . $csv['products_model'] . ";" . $currencies->format($csv['products_price']) . ";" . $csv['products_weight'] . ";" . $csv['products_length'] . ";" . $csv['products_width'] . ";" . $csv['products_height'] . ";" 
       // . $csv['products_ready_to_ship'] . ";" 
       . $csv['products_quantity'] . "\n";
      }
   $saveas = 'product_stock-price_report_' . strftime("%m-%d-%Y");
   header("Content-Disposition: attachment; filename=$saveas.csv");
   print $csv_output;
   exit;
  }*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>" />
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css" />
<script type="text/javascript" src="includes/general.js"></script>
</head>
<body>
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
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2"><?php echo tep_draw_form('stockprice', FILENAME_PRODUCT_UPDATES, 'action=update', 'post'); ?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.png', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>

               <?php
          switch ($listing) {
          case "prod":
              $order = "p.products_id";
              break;
          case "prod-desc":
              $order = "p.products_id DESC";
              break;
          case "manu":
              $order = "m.manufacturers_name";
              break;
          case "manu-desc":
              $order = "m.manufacturers_name DESC";
              break;
          case "name":
              $order = "pd.products_name";
              break;
          case "name-desc":
              $order = "pd.products_name DESC";
              break;
		  case "model":
              $order = "p.products_model";
              break;
          case "model-desc":
              $order = "p.products_model DESC";
              break;
		  case "quantity":
              $order = "p.products_quantity";
              break;
          case "quantity-desc":
              $order = "p.products_quantity DESC";
              break;
		  case "weight":
              $order = "p.products_weight";
              break;
          case "weight-desc":
              $order = "p.products_weight DESC";
              break;
		  case "length":
              $order = "products_length";
              break;
          case "length-desc":
              $order = "products_length DESC";
              break;
		      case "width":
              $order = "products_width";
              break;
          case "width-desc":
              $order = "products_width DESC";
              break;
		      case "height":
              $order = "products_height";
              break;
          case "height-desc":
              $order = "products_height DESC";
              break;
		     case "ready_to_ship":
              $order = "products_ready_to_ship";
              break;
          case "ready_to_ship-desc":
              $order = "products_ready_to_ship DESC";
              break;
		  case "price":
              $order = "p.products_price";
              break;
          case "price-desc":
              $order = "p.products_price DESC";
              break;
         default:
              //$order = "p.products_model ASC";
			        $order = "p.products_quantity";
          }
          ?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><a href="<?php echo "$PHP_SELF?listing=prod"; ?>"><?php echo tep_image_button('ic_up.png', ' Sort ' . TABLE_HEADING_PRODUCT_ID . ' --> A-B-C From Top '); ?></a>&nbsp;<a href="<?php echo "$PHP_SELF?listing=prod-desc"; ?>"><?php echo tep_image_button('ic_down.png', ' Sort ' . TABLE_HEADING_PRODUCT_ID . ' --> Z-X-Y From Top '); ?></a><br /><?php echo TABLE_HEADING_PRODUCT_ID; ?></td>
                <td class="dataTableHeadingContent"><a href="<?php echo "$PHP_SELF?listing=manu"; ?>"><?php echo tep_image_button('ic_up.png', ' Sort ' . TABLE_HEADING_PMAN . ' --> A-B-C From Top '); ?></a>&nbsp;<a href="<?php echo "$PHP_SELF?listing=manu-desc"; ?>"><?php echo tep_image_button('ic_down.png', ' Sort ' . TABLE_HEADING_PMAN . ' --> Z-X-Y From Top '); ?></a><br /><?php echo TABLE_HEADING_PMAN; ?></td>
                <td class="dataTableHeadingContent"><a href="<?php echo "$PHP_SELF?listing=name"; ?>"><?php echo tep_image_button('ic_up.png', ' Sort ' . TABLE_HEADING_PNAME . ' --> A-B-C From Top '); ?></a>&nbsp;<a href="<?php echo "$PHP_SELF?listing=name-desc"; ?>"><?php echo tep_image_button('ic_down.png', ' Sort ' . TABLE_HEADING_PNAME. ' --> Z-X-Y From Top '); ?></a><br /><?php echo TABLE_HEADING_PNAME; ?></td>
                <td class="dataTableHeadingContent"><a href="<?php echo "$PHP_SELF?listing=model"; ?>"><?php echo tep_image_button('ic_up.png', ' Sort ' . TABLE_HEADING_PMODEL . ' --> A-B-C From Top '); ?></a>&nbsp;<a href="<?php echo "$PHP_SELF?listing=model-desc"; ?>"><?php echo tep_image_button('ic_down.png', ' Sort ' . TABLE_HEADING_PMODEL . ' --> Z-X-Y From Top '); ?></a><br /><?php echo TABLE_HEADING_PMODEL; ?></td>
                <td class="dataTableHeadingContent"><a href="<?php echo "$PHP_SELF?listing=weight"; ?>"><?php echo tep_image_button('ic_up.png', ' Sort ' . TABLE_HEADING_PWEIGHT . ' --> A-B-C From Top '); ?></a>&nbsp;<a href="<?php echo "$PHP_SELF?listing=weight-desc"; ?>"><?php echo tep_image_button('ic_down.png', ' Sort ' . TABLE_HEADING_PWEIGHT . ' --> Z-X-Y From Top '); ?></a><br /><?php echo TABLE_HEADING_PWEIGHT; ?></td>
                <td class="dataTableHeadingContent"><a href="<?php echo "$PHP_SELF?listing=length"; ?>"><?php echo tep_image_button('ic_up.png', ' Sort ' . TEXT_PRODUCTS_LENGTH . ' --> A-B-C From Top '); ?></a>&nbsp;<a href="<?php echo "$PHP_SELF?listing=length-desc"; ?>"><?php echo tep_image_button('ic_down.png', ' Sort ' . TEXT_PRODUCTS_LENGTH . ' --> Z-X-Y From Top '); ?></a><br /><?php echo TEXT_PRODUCTS_LENGTH; ?></td>
	            <td class="dataTableHeadingContent"><a href="<?php echo "$PHP_SELF?listing=width"; ?>"><?php echo tep_image_button('ic_up.png', ' Sort ' . TEXT_PRODUCTS_WIDTH . ' --> A-B-C From Top '); ?></a>&nbsp;<a href="<?php echo "$PHP_SELF?listing=width-desc"; ?>"><?php echo tep_image_button('ic_down.png', ' Sort ' . TEXT_PRODUCTS_WIDTH . ' --> Z-X-Y From Top '); ?></a><br /><?php echo TEXT_PRODUCTS_WIDTH; ?></td>
	            <td class="dataTableHeadingContent"><a href="<?php echo "$PHP_SELF?listing=height"; ?>"><?php echo tep_image_button('ic_up.png', ' Sort ' . TEXT_PRODUCTS_HEIGHT . ' --> A-B-C From Top '); ?></a>&nbsp;<a href="<?php echo "$PHP_SELF?listing=height-desc"; ?>"><?php echo tep_image_button('ic_down.png', ' Sort ' . TEXT_PRODUCTS_HEIGHT . ' --> Z-X-Y From Top '); ?></a><br /><?php echo TEXT_PRODUCTS_HEIGHT; ?></td>
	            <td class="dataTableHeadingContent"><a href="<?php echo "$PHP_SELF?listing=ready_to_ship"; ?>"><?php echo tep_image_button('ic_up.png', ' Sort ' . TEXT_PRODUCTS_READY_TO_SHIP . ' --> A-B-C From Top '); ?></a>&nbsp;<a href="<?php echo "$PHP_SELF?listing=ready_to_ship-desc"; ?>"><?php echo tep_image_button('ic_down.png', ' Sort ' . TEXT_PRODUCTS_READY_TO_SHIP . ' --> Z-X-Y From Top '); ?></a><br /><?php echo TEXT_PRODUCTS_READY_TO_SHIP; ?></td>
                <td class="dataTableHeadingContent"><a href="<?php echo "$PHP_SELF?listing=price"; ?>"><?php echo tep_image_button('ic_up.png', ' Sort ' . TABLE_HEADING_PPRICE . ' --> A-B-C From Top '); ?></a>&nbsp;<a href="<?php echo "$PHP_SELF?listing=price-desc"; ?>"><?php echo tep_image_button('ic_down.png', ' Sort ' . TABLE_HEADING_PPRICE . ' --> Z-X-Y From Top '); ?></a><br /><?php echo TABLE_HEADING_PPRICE; ?></td>
                <td class="dataTableHeadingContent"><a href="<?php echo "$PHP_SELF?listing=quantity"; ?>"><?php echo tep_image_button('ic_up.png', ' Sort ' . TABLE_HEADING_PQTY . ' --> A-B-C From Top '); ?></a>&nbsp;<a href="<?php echo "$PHP_SELF?listing=quantity-desc"; ?>"><?php echo tep_image_button('ic_down.png', ' Sort ' . TABLE_HEADING_PQTY . ' --> Z-X-Y From Top '); ?></a><br /><?php echo TABLE_HEADING_PQTY; ?></td>
              </tr>

<?php
  $countrows_query = tep_db_query("select * from " . TABLE_PRODUCTS . " where products_status=1");
  $countrows = tep_db_num_rows($countrows_query);
  $updates_raw = "select p.products_id, p.manufacturers_id, p.products_quantity, p.products_weight, products_length, products_width, products_height, products_ready_to_ship, p.products_price, p.products_model, pd.products_name, m.manufacturers_id, m.manufacturers_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_MANUFACTURERS . " m where p.products_status = 1 and p.products_id = pd.products_id and p.manufacturers_id = m.manufacturers_id and  pd.language_id = " . $languages_id . " group by pd.products_name order by " . $order ;

  $updates_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $updates_raw, $countrows);
    $updates = tep_db_query($updates_raw);
      while ($row = tep_db_fetch_array($updates)) {
        $id = $row['products_id'];
        $updates_man = $row['manufacturers_name'];
        $updates_name = $row['products_name'];
        $updates_model = $row['products_model'];
        $updates_weight = number_format($row['products_weight'], 1);
        $updates_lentgh = number_format($row['products_length'], 0);
        $updates_width = number_format($row['products_width'], 0);
        $updates_height = number_format($row['products_height'], 0);
        $updates_ready_to_ship = $row['products_ready_to_ship'];
        $updates_price = number_format($row['products_price'], 2);
        $updates_pqty = number_format($row['products_quantity'], 0);
?>
              <tr class="dataTableRow">
                <td class="dataTableContent"><?php echo $id . "<input type='hidden' name='event_record[" . $id . "][products_id]' value='".$id."' />"; ?></td>
                <td class="dataTableContent"><?php echo $updates_man; ?></td>
                <td class="dataTableContent"><?php echo '<a href="' . tep_catalog_href_link('product_info.php', 'products_id=' . $id) . '">' . $updates_name . '</a>'; ?></td>
                <td class="dataTableContent"><?php echo tep_draw_input_field('event_record[' . $id . '][products_model]', $updates_model, 'size="12" readonly ' ); ?></td>
                <td class="dataTableContent"><?php echo tep_draw_input_field('event_record[' . $id . '][products_weight]', $updates_weight, 'size="6"'); ?></td>
                <td class="dataTableContent"><?php echo tep_draw_input_field('event_record[' . $id . '][products_length]', $updates_lentgh, 'size="6"'); ?></td>
                <td class="dataTableContent"><?php echo tep_draw_input_field('event_record[' . $id . '][products_width]', $updates_width, 'size="6"'); ?></td>
                <td class="dataTableContent"><?php echo tep_draw_input_field('event_record[' . $id . '][products_height]', $updates_height, 'size="6"'); ?></td>
                <td class="dataTableContent"><?php echo tep_draw_input_field('event_record[' . $id . '][products_ready_to_ship]', $updates_ready_to_ship, 'size="6"'); ?></td>
                <td class="dataTableContent"><?php echo tep_draw_input_field('event_record[' . $id . '][products_price]', $updates_price, 'size="6"'); ?></td>
                <td class="dataTableContent"><?php echo tep_draw_input_field('event_record[' . $id . '][products_quantity]', $updates_pqty, 'size="6"'); ?></td>
              </tr>
<?php
  }
?>
              <tr>
                <td colspan="6"><?php echo tep_draw_separator('pixel_trans.png', '1', '5'); ?></td>
              </tr>
              <tr>
                <td colspan="3" align="left"><?php echo tep_image_submit('button_update.png', IMAGE_UPDATE); ?></form></td>
                <td colspan="3" align="right"><?php // echo tep_draw_form('stockprice_report', FILENAME_PRODUCT_UPDATES, 'action=export', 'post') . echo tep_image_submit('button_save.png', IMAGE_SAVECSV) . '</form>'; 
                ?></td>
              </tr>
              <tr>
                <td colspan="6"><?php echo tep_draw_separator('pixel_trans.png', '1', '10'); ?></td>
              </tr>
              <tr>
                <td class="smallText" align="left" colspan="3"><?php echo $updates_split->display_count($countrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></td>
                <td class="smallText" align="right" colspan="3"><?php echo $updates_split->display_links($countrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], tep_get_all_get_params(array('page', 'x', 'y', 'products_id'))); ?>&nbsp;</td>
              </tr>
            </table></td>
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
<br />
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
