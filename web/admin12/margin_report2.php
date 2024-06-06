<?php
/*
  $Id: margin_report2.php,v 3.00 2008/03/16  Exp $
  
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce
  
  percentage margin per order
  order status filter
  order number clickable to link to the order details
   - by mr_absinthe 2008/03/16 
   
  Released under the GNU General Public License
*/
  require('includes/application_top.php');
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_MARGIN_REPORT);
  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();

  // get list of order status
    $orders_statuses = array(); 
    $orders_status_array = array();
    $orders_status_query = tep_db_query("select orders_status_id, orders_status_name from " . TABLE_ORDERS_STATUS . " where language_id = '" . (int)$languages_id . "' order by orders_status_id");
    while ($orders_status = tep_db_fetch_array($orders_status_query)) {
    $orders_statuses[] = array('id' => $orders_status['orders_status_id'],
                               'text' => $orders_status['orders_status_name']);
    $orders_status_array[$orders_status['orders_status_id']] = $orders_status['orders_status_name'];
  }

  $date = mysql_query("SELECT curdate() as time");
  $d2 = mysql_fetch_array($date, MYSQL_ASSOC);

  switch($_GET['report_id']) {
    case 'all':
      $header = TEXT_REPORT_HEADER;
      break;
    case 'daily':
      $date = mysql_query("SELECT curdate() as time");
      $d = mysql_fetch_array($date, MYSQL_ASSOC);
      $header = TEXT_REPORT_HEADER_FROM_DAY;
      break;
    case 'yesterday':
      $date = mysql_query("SELECT DATE_SUB(curdate(), INTERVAL 1 DAY) as time");
      $d = mysql_fetch_array($date, MYSQL_ASSOC);
      $l = 1;
      $header = TEXT_REPORT_HEADER_FROM_YESTERDAY;
      break;
    case 'weekly':
    case 'lastweek':
      if ($_GET['report_id'] == "lastweek") {
    // last week
          $adjust = 7;    
      } else {    
          $adjust = 0;
      }
      $l = 7;  // seven day window length
      $weekday_query = mysql_query("SELECT weekday(now()) as weekday");
      $weekday = mysql_fetch_array($weekday_query);
      $day = 6+($weekday['weekday'] - 6);
    //echo $day;
        switch($day) {
          case '0':
            $date = mysql_query("SELECT curdate() - INTERVAL ".($adjust+1)." DAY as time");
            $date2 = mysql_query("SELECT curdate() - INTERVAL ".($adjust+1-7)." DAY as time");
            break;
          case '1':
            $date = mysql_query("SELECT curdate() - INTERVAL ".($adjust+2)." DAY as time");
            $date2 = mysql_query("SELECT curdate() - INTERVAL ".($adjust+2-7)." DAY as time");
            break;
          case '2':
            $date = mysql_query("SELECT curdate() - INTERVAL ".($adjust+3)." DAY as time");
            $date2 = mysql_query("SELECT curdate() - INTERVAL ".($adjust+3-7)." DAY as time");
            break;
          case '3':
            $date = mysql_query("SELECT curdate() - INTERVAL ".($adjust+4)." DAY as time");
            $date2 = mysql_query("SELECT curdate() - INTERVAL ".($adjust+4-7)." DAY as time");
            break;
          case '4':
            $date = mysql_query("SELECT curdate() - INTERVAL ".($adjust+5)." DAY as time");
            $date2 = mysql_query("SELECT curdate() - INTERVAL ".($adjust+5-7)." DAY as time");
            break;
          case '5':
            $date = mysql_query("SELECT curdate() - INTERVAL ".($adjust+6)." DAY as time");
            $date2 = mysql_query("SELECT curdate() - INTERVAL ".($adjust+6-7)." DAY as time");
            break;
          case '6':
            $date = mysql_query( "SELECT curdate() - INTERVAL ".$adjust." DAY as time");
            $date2 = mysql_query("SELECT curdate() - INTERVAL ".($adjustd-7)." DAY as time");
            break;
        }
      $d = mysql_fetch_array($date, MYSQL_ASSOC);
      $d2 = mysql_fetch_array($date2, MYSQL_ASSOC);
      $header = TEXT_REPORT_HEADER_FROM_WEEK;
      break;
    case 'monthly':
      $date = mysql_query("SELECT FROM_UNIXTIME(" . strtotime(date("F 1, Y")) . ") as time");
      $d = mysql_fetch_array($date, MYSQL_ASSOC);
      $date = mysql_query("SELECT curdate() as time");
      $d2 = mysql_fetch_array($date, MYSQL_ASSOC);
      $header = TEXT_REPORT_HEADER_FROM_MONTH;
      break;
    case 'lastmonth':
      $date = mysql_query("SELECT FROM_UNIXTIME(" . strtotime(date("F 1, Y")) . ") - INTERVAL 1 MONTH as time");
      $d = mysql_fetch_array($date, MYSQL_ASSOC);
      $date = mysql_query("SELECT FROM_UNIXTIME(" . strtotime(date("F 1, Y")) . ") - INTERVAL 0 MONTH as time");
      $d2 = mysql_fetch_array($date, MYSQL_ASSOC);
      $header = TEXT_REPORT_HEADER_FROM_LASTMONTH;
      break;
    case 'quarterly':
      $quarter_query = mysql_query("SELECT QUARTER(now()) as quarter, year(now()) as year");
      $quarter = mysql_fetch_array($quarter_query, MYSQL_ASSOC);
        switch($quarter['quarter']) {
          case '1':
            $d['time'] = $quarter['year'] . '-01-01';
            break;
          case '2':
            $d['time'] = $quarter['year'] . '-04-01';
            break;
          case '3':
            $d['time'] = $quarter['year'] . '-07-01';
            break;
          case '4':
            $d['time'] = $quarter['year'] . '-10-01';
            break;
        }
      $header = TEXT_REPORT_HEADER_FROM_QUARTER;
      break;
    case 'semiannually':
      $year_query = mysql_query("SELECT year(now()) as year, month(now()) as month");
      $year = mysql_fetch_array($year_query, MYSQL_ASSOC);
      if ($year['month'] >= '7') {
        $d['time'] = $year['year'] . '-07-01';
      } else {
        $d['time'] = $year['year'] . '-01-01';
      }
      $header = TEXT_REPORT_HEADER_FROM_SEMIYEAR;
      break;
    case 'annually':
      $year_query = mysql_query("SELECT year(now()) as year");
      $year = mysql_fetch_array($year_query, MYSQL_ASSOC);
      $d['time'] = $year['year'] . '-01-01';
      $header = TEXT_REPORT_HEADER_FROM_YEAR;
      break;
  }

  // show orders with selected status
    if (isset($_GET['status']) && is_numeric($_GET['status']) && ($_GET['status'] > 0)){
    $status = tep_db_prepare_input($_GET['status']);    
    if (isset($_GET['date']) && ($_GET['date'] == 'yes')) {
      $header = TEXT_REPORT_BETWEEN_DAYS . $_GET['sdate'] . ' and ' . $_GET['edate'] . ': ';
      $order_query = mysql_query("select orders_id from " . TABLE_ORDERS . " where date_purchased > '" . $_GET['sdate'] . "' and date_purchased < '" . $_GET['edate'] . "' and orders_status = '" . (int)$status . "' order by orders_id asc");
    } else {
      if ($_GET['report_id'] != '1') {
        $header_date_query = mysql_query("SELECT DATE_FORMAT('" . $d['time'] . "', '%W, %M %d, %Y') as date");
        $header_date = mysql_fetch_array($header_date_query, MYSQL_ASSOC);
        $header .= $header_date['date'];
        if (isset($d2)) {
            // have date range, use it
            $order_query = mysql_query("select orders_id from " . TABLE_ORDERS . " where date_purchased > '" . $d['time'] . "' and date_purchased < '" . $d2['time'] . "' and orders_status = '" . (int)$status . "' order by orders_id asc");
        } else {
            // don't have a d2, business as usual
            $order_query = mysql_query("select orders_id from " . TABLE_ORDERS . " where date_purchased > '" . $d['time'] . "' and date_purchased < now() and orders_status = '" . (int)$status . "' order by orders_id asc");
            
    }        
   }
  }
 }
  // show all orders
      elseif (isset($_GET['date']) && ($_GET['date'] == 'yes')) {
      $header = TEXT_REPORT_BETWEEN_DAYS . $_GET['sdate'] . ' and ' . $_GET['edate'] . ': ';
      $order_query = mysql_query("select orders_id from " . TABLE_ORDERS . " where date_purchased > '" . $_GET['sdate'] . "' and date_purchased < '" . $_GET['edate'] . "' order by orders_id asc");
    } else {
      if ($_GET['report_id'] != '1') {
        $header_date_query = mysql_query("SELECT DATE_FORMAT('" . $d['time'] . "', '%W, %M %d, %Y') as date");
        $header_date = mysql_fetch_array($header_date_query, MYSQL_ASSOC);
        $header .= $header_date['date'];
        if (isset($d2)) {
    // have date range, use it
            $order_query = mysql_query("select orders_id from " . TABLE_ORDERS . " where date_purchased > '" . $d['time'] . "' and date_purchased < '" . $d2['time'] . "' order by orders_id asc");
        } else {
    // don't have a d2, business as usual
            $order_query = mysql_query("select orders_id from " . TABLE_ORDERS . " where date_purchased > '" . $d['time'] . "' and date_purchased < now() order by orders_id asc");
      }
      } else {
        $order_query = mysql_query("select orders_id from " . TABLE_ORDERS . " order by orders_id asc");
        }
    }

    $o = array();
    while ($order = @mysql_fetch_array($order_query, MYSQL_ASSOC)) {
    $o[] = $order['orders_id'];
  }

//echo '<pre>';
//print_r($o);
//echo '</pre>';

    $p = array();
    $total_price = 0;
    $total_cost = 0;
    $total_items_sold = 0;
    $page_contents .= '<table width="100%" cellpadding="2" cellspacing="0"><tr class="dataTableHeadingRow"><td class="dataTableHeadingContent">'. TEXT_ORDER_ID .'</td><td class="dataTableHeadingContent">'. TEXT_ITEMS_SOLD .'</td><td class="dataTableHeadingContent">'. TEXT_SALES_AMOUNT .'</td><td class="dataTableHeadingContent">'. TEXT_COST .'</td><td class="dataTableHeadingContent">'. TEXT_GROSS_PROFIT .'</td><td class="dataTableHeadingContent">'. TABLE_HEADING_MARGIN_PERCENTAGE .'</td></tr>';
    $csv_header = $header . "\n\n" . TEXT_ORDER_ID . "\t" . TEXT_ITEMS_SOLD . "\t" . TEXT_SALES_AMOUNT . "\t" . TEXT_COST . "\t" . TEXT_GROSS_PROFIT . "\t" . TABLE_HEADING_MARGIN_PERCENTAGE;
    $t = '0';
    for($i=0;$i<sizeof($o);$i++) {
      $price = 0;
      $cost = 0;
      $items_sold = 0;
      $prods_query = mysql_query("select op.products_id, op.products_price, op.products_quantity, p.products_cost from " . TABLE_ORDERS_PRODUCTS . " op, " . TABLE_PRODUCTS . " p where op.orders_id = '" . $o[$i] . "' and op.products_id = p.products_id");
      while ($prods = @mysql_fetch_array($prods_query, MYSQL_ASSOC)) {
        $p[] = array($prods['products_id'], $prods['products_price'], $prods['products_cost'], $prods['products_quantity']);
        $price = $price + ($prods['products_price'] * $prods['products_quantity']);
        $cost = $cost + ($prods['products_cost'] * $prods['products_quantity']);
        $items_sold = $items_sold + $prods['products_quantity'];
        $total_price = $total_price + ($prods['products_price'] * $prods['products_quantity']);
        $total_cost = $total_cost + ($prods['products_cost'] * $prods['products_quantity']);
        $total_items_sold = $total_items_sold + $prods['products_quantity'];
    // the following two lines will give us per order margin as well as the total margin
        $margin = tep_round((((($prods['products_price'])-($prods['products_cost']))/($prods['products_price']))*100), 0);
        $total_margin = tep_round((((($total_price)-($total_cost))/($total_price))*100), 2);        
     }
    $page_contents .= '<tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)"><td class="dataTableContent">' . '<a href=' . tep_href_link(FILENAME_ORDERS, '&amp;oID=' . $o[$i] . '&amp;action=edit') . '>' . $o[$i] . '</a></td><td class="dataTableContent">' . $items_sold . '</td><td class="dataTableContent">' . $currencies->format($price) . '</td><td class="dataTableContent">' . $currencies->format($cost) . '</td><td class="dataTableContent">' . $currencies->format(($price - $cost)) . '</td><td class="dataTableContent">' . $margin . '%' . '</td></tr>';
    $csv_data .= $o[$i] . "\t" . $items_sold . "\t" . $currencies->format($price) . "\t" . $currencies->format($cost) . "\t" . $currencies->format(($price - $cost)) . "\t" . $margin . '%' . "\n";
    if ($a == '1') {
      $test .= '<tr><td bgcolor="#E0E0E0">' . $o[$i] . '</td><td bgcolor="#E0E0E0">' . $items_sold . '</td><td bgcolor="#E0E0E0">' . $currencies->format($price) . '</td><td bgcolor="#E0E0E0">' . $currencies->format($cost) . '</td><td bgcolor="#E0E0E0">' . $currencies->format(($price - $cost)) . '</td><td bgcolor="#E0E0E0">' . $margin . '%' . '</td></tr>';
      $a='0';
    } else {
      $test .= '<tr><td bgcolor="#D4D4D4">' . $o[$i] . '</td><td bgcolor="#D4D4D4">' . $items_sold . '</td><td bgcolor="#D4D4D4">' . $currencies->format($price) . '</td><td bgcolor="#D4D4D4">' . $currencies->format($cost) . '</td><td bgcolor="#D4D4D4">' . $currencies->format(($price - $cost)) . '</td><td bgcolor="#D4D4D4">' . $margin . '%' . '</td></tr>';
      $a='1';
      }
    }
    $page_contents .= '</table>';

//echo '<pre>';
//print_r($p);
//echo '</pre>';

    $page_contents .= '<table><tr><td>&nbsp;</td></tr>';
    $page_contents .= '<tr><td class="main">'. TEXT_TOTAL_ITEMS_SOLD . $total_items_sold . '</td></tr>';
    $page_contents .= '<tr><td class="main">'. TEXT_SALES_AMOUNT . ': ' . $currencies->format($total_price) . '</td></tr>';
    $page_contents .= '<tr><td class="main">'. TEXT_TOTAL_COST . $currencies->format($total_cost) . '</td></tr>';
    $page_contents .= '<tr><td class="main">'. TEXT_TOTAL_MARGIN . $total_margin . '%' . '</td></tr>';
    $page_contents .= '<tr><td class="main">'. TEXT_TOTAL_GROSS_PROFIT . $currencies->format(($total_price - $total_cost)) . '</td></tr>';
    $page_contents .= '<tr><td>&nbsp;</td></tr>';

    $contents2 .= '<tr><td bgcolor="#C8FCCA"><font size="2" face="Tahoma, Times, serif"><b>'. TEXT_TOTAL_ITEMS_SOLD .'</b></font></td><td align="left" colspan="4" bgcolor="#FFFFFF">&nbsp;' . $total_items_sold . '</td></tr>'. 
                  '<tr><td bgcolor="#C8FCCA"><font size="2" face="Tahoma, Times, serif"><b>'. TEXT_SALES_AMOUNT . ': ' .'</b></font></td><td align="left" colspan="4" bgcolor="#E0E0E0">&nbsp;' . $currencies->format($total_price) . '</td></tr>'.
                  '<tr><td bgcolor="#C8FCCA"><font size="2" face="Tahoma, Times, serif"><b>'. TEXT_TOTAL_COST .'</b></font></td><td align="left" colspan="4" bgcolor="#FFFFFF">&nbsp;' . $currencies->format($total_cost) . '</td></tr>'.
                  '<tr><td bgcolor="#C8FCCA"><font size="2" face="Tahoma, Times, serif"><b>'. TEXT_TOTAL_MARGIN .'</b></font></td><td align="left" colspan="4" bgcolor="#E0E0E0">&nbsp;' . $total_margin . '%' . '</td></tr>'.
                  '<tr><td bgcolor="#C8FCCA"><font size="2" face="Tahoma, Times, serif"><b>'. TEXT_TOTAL_GROSS_PROFIT .'</b></font></td><td align="left" colspan="4" bgcolor="#FFFFFF">&nbsp;' . $currencies->format(($total_price - $total_cost)) . '</td></tr>';

    $csv_data .= "\n\n";
    $csv_data .= TEXT_TOTAL_ITEMS_SOLD  . "\t"  . $total_items_sold . "\n" . 
                 TEXT_SALES_AMOUNT . "\t"  . $currencies->format($total_price) . "\n" . 
                 TEXT_TOTAL_COST . "\t"  . $currencies->format($total_cost) . "\n" . 
                 TEXT_TOTAL_MARGIN . "\t"  . $total_margin . '%' . "\n" .
                 TEXT_TOTAL_GROSS_PROFIT . "\t"  . $currencies->format(($total_price - $total_cost)) . "\n";

    if (isset($_GET['action']) && ($_GET['action'] == 'export')) {

/********************************************
Set the automatic download section
/********************************************/
/*header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=" . $_GET['file'] . ".xls");
header("Pragma: no-cache");
header("Expires: 0");
print "$csv_header\n$csv_data";
exit();*/

/*header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");*/

      $time_query = tep_db_query("select CURDATE() as time");
      $time = tep_db_fetch_array($time_query);
      if (isset($_GET['date']) && ($_GET['date'] == 'yes')) {
        $filename = $time['time'] . "__-__" . $_GET['sdate'] . '_-_' . $_GET['edate'];
      } else {
        $filename = $time['time'] . "__-__" . $_GET['report_id'];
        }

    header("Content-type: application/octet-stream");
    header("Content-Disposition: attachment; filename=" . $filename . ".xls");
    header("Pragma: no-cache");
    header("Expires: 0");

$t='<table width="750" border="1" cellspacing="0" cellpadding="2">
  <tr align="center">
    <td colspan="6" width="750" bgcolor="#FFFF00">
      <font face="Arial, Helvetica, sans-serif"><strong>' . $header. '
        </strong> </font>    
    </td>
  </tr>
  <tr>
    <td colspan="6"> </td>
  </tr>
  <tr>
    <td width="150" align="right" bgcolor="#C8FCCA">
    <font size="2" face="Tahoma, Times, serif"><em><b>'. TEXT_ORDER_ID .'</b></em></font>    
    </td>
    <td width="100" align="right" bgcolor="#C8FCCA">
    <font size="2" face="Tahoma, Times, serif"><em><b>'. TEXT_ITEMS_SOLD .'</b></em></font>    
    </td>
    <td width="120" align="right" bgcolor="#C8FCCA">
    <font size="2" face="Tahoma, Times, serif"><em><b>'. TEXT_SALES_AMOUNT .'</b></em></font>    
    </td>
    <td width="120" align="right" bgcolor="#C8FCCA">
    <font size="2" face="Tahoma, Times, serif"><em><b>'. TEXT_COST .'</b></em></font>    
    </td>
    <td width="120" align="right" bgcolor="#C8FCCA">
    <font size="2" face="Tahoma, Times, serif"><em><b>'. TEXT_GROSS_PROFIT .'</b></em></font>  
    </td>
    <td width="120" align="right" bgcolor="#C8FCCA">
    <font size="2" face="Tahoma, Times, serif"><em><b>'. TABLE_HEADING_MARGIN_PERCENTAGE .'</b></em></font>
    </td>
  </tr>'
 . $test . 
 '<tr>
    <td colspan="6"></td>
 </tr>'
 . $contents2 . 
 '<tr>
    <td colspan="5"></td>
  </tr>
</table>';
print "$t";
exit();
}

    $page_contents .= '<tr><td align="left" class="dataTableContent">' . tep_draw_form('report', FILENAME_MARGIN_REPORT2, '', 'get') . TEXT_SHOW . '&nbsp;';
      $options = array();
      $options[] = array('id' => 'all', 'text' => TEXT_SELECT_REPORT);
      $options[] = array('id' => 'daily', 'text' => TEXT_SELECT_REPORT_DAILY);
      $options[] = array('id' => 'yesterday', 'text' => TEXT_SELECT_REPORT_YESTERDAY);
      $options[] = array('id' => 'weekly', 'text' => TEXT_SELECT_REPORT_WEEKLY);
      $options[] = array('id' => 'lastweek', 'text' => TEXT_SELECT_REPORT_LASTWEEK);
      $options[] = array('id' => 'monthly', 'text' => TEXT_SELECT_REPORT_MONTHLY);
      $options[] = array('id' => 'lastmonth', 'text' => TEXT_SELECT_REPORT_LASTMONTH);
      $options[] = array('id' => 'quarterly', 'text' => TEXT_SELECT_REPORT_QUARTERLY);
      $options[] = array('id' => 'semiannually', 'text' => TEXT_SELECT_REPORT_SEMIANNUALLY);
      $options[] = array('id' => 'annually', 'text' => TEXT_SELECT_REPORT_ANNUALLY);
    $page_contents .= tep_draw_pull_down_menu('report_id', $options, (isset($_GET['report_id']) ? $_GET['report_id'] : '1'), 'onchange="this.form.submit()"');
  // orders status
    $page_contents .= '<tr><td class="dataTableContent">' . TITLE_STATUS . ' ' . tep_draw_pull_down_menu('status', array_merge(array(array('id' => '', 'text' => TEXT_ALL_ORDERS)), $orders_statuses), '', 'onChange="this.form.submit();"') . '</td></tr>';
    $page_contents .= '</form></td></tr><tr><td>&nbsp;</td></tr>';
    $page_contents .= '<tr><td align="left" class="main"><table><tr><td><a href="' . tep_href_link(FILENAME_MARGIN_REPORT, '', 'NONSSL') . '">' . tep_image_button('button_back.png', BUTTON_BACK_TO_MAIN) . '</a></td><td>' . tep_draw_form('export_to_file', FILENAME_MARGIN_REPORT2, 'get', '') . tep_draw_hidden_field('action', 'export') . tep_draw_hidden_field('report_id', $_GET['report_id']) . '<input type="image" name="submit" src="' . DIR_WS_LANGUAGES . $language . '/images/buttons/button_export.png" alt="' . TEXT_EXPORT_BUTTON . '" width="65" height="22" /></form></td></tr></table></td></tr>';
    $page_contents .= '<tr><td>&nbsp;</td></tr>';
    $page_contents .= '<tr><td align="left" class="main"><table><tr><td class="dataTableContent">' . tep_draw_form('export_to_file_by_date', FILENAME_MARGIN_REPORT2, 'get', '') . tep_draw_hidden_field('action', 'export') . tep_draw_hidden_field('date', 'yes') . TEXT_QUERY_DATES.' </td></tr></table><table><tr><td><input type="text" name="sdate" value="' . TEXT_START_DATE . '"/></td><td><input type="text" name="edate" value="' . TEXT_END_DATE . '"/></td><td><input type="image" name="submit" src="' . DIR_WS_LANGUAGES . $language . '/images/buttons/button_export.png" alt="' . TEXT_EXPORT_BUTTON . '" width="65" height="22"/></form></td></tr></table></td></tr>';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>"/>
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
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo $header; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.png', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo $page_contents; ?></td>
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