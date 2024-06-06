<?php
/*
  $Id: margin_report.php,v 3.00 2008/03/15  Exp $
  
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce
  
  percentage margin per order & order status filter by mr_absinthe 2008/03/15

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();

  class tableBox {
    var $table_border = '0';
    var $table_width = '100%';
    var $table_cellspacing = '0';
    var $table_cellpadding = '2';
    var $table_parameters = '';
    var $table_row_parameters = '';
    var $table_data_parameters = '';

// class constructor
    function tableBox($contents, $direct_output = false) {
      $tableBox_string = '<table border="' . tep_output_string($this->table_border) . '" width="' . tep_output_string($this->table_width) . '" cellspacing="' . tep_output_string($this->table_cellspacing) . '" cellpadding="' . tep_output_string($this->table_cellpadding) . '"';
      if (tep_not_null($this->table_parameters)) $tableBox_string .= ' ' . $this->table_parameters;
      $tableBox_string .= '>' . "\n";

      for ($i=0, $n=sizeof($contents); $i<$n; $i++) {

        if (isset($contents[$i]['form']) && tep_not_null($contents[$i]['form'])) $tableBox_string .= $contents[$i]['form'] . "\n";
        if ($i == '0') {
          $tableBox_string .= '  <tr class="dataTableHeadingRow"';
          if (tep_not_null($this->table_row_parameters)) $tableBox_string .= ' ' . $this->table_row_parameters;
          $tableBox_string .= '>' . "\n";
        } else {
          $tableBox_string .= '  <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">';
        }

        if (isset($contents[$i][0]) && is_array($contents[$i][0])) {
          for ($x=0, $n2=sizeof($contents[$i]); $x<$n2; $x++) {
if ($i != '0') {
            if (isset($contents[$i][$x]['text']) && tep_not_null($contents[$i][$x]['text'])) {
              $tableBox_string .= '    <td class="dataTableContent"';
              if (isset($contents[$i][$x]['align']) && tep_not_null($contents[$i][$x]['align'])) $tableBox_string .= ' align="' . tep_output_string($contents[$i][$x]['align']) . '"';
              $tableBox_string .= '>';
              if (isset($contents[$i][$x]['form']) && tep_not_null($contents[$i][$x]['form'])) $tableBox_string .= $contents[$i][$x]['form'];
              $tableBox_string .= $contents[$i][$x]['text'];
              if (isset($contents[$i][$x]['form']) && tep_not_null($contents[$i][$x]['form'])) $tableBox_string .= '</form>';
              $tableBox_string .= '</td>' . "\n";
            }
} else {
            if (isset($contents[$i][$x]['text']) && tep_not_null($contents[$i][$x]['text'])) {
              $tableBox_string .= '    <td class="dataTableHeadingContent"';
              if (isset($contents[$i][$x]['align']) && tep_not_null($contents[$i][$x]['align'])) $tableBox_string .= ' align="' . tep_output_string($contents[$i][$x]['align']) . '"';
              $tableBox_string .= '>';
              if (isset($contents[$i][$x]['form']) && tep_not_null($contents[$i][$x]['form'])) $tableBox_string .= $contents[$i][$x]['form'];
              $tableBox_string .= $contents[$i][$x]['text'];
              if (isset($contents[$i][$x]['form']) && tep_not_null($contents[$i][$x]['form'])) $tableBox_string .= '</form>';
              $tableBox_string .= '</td>' . "\n";
            }
}
          }
        } else {
if ($i != '0') {
          $tableBox_string .= '    <td class="dataTableContent">' . $contents[$i]['text'] . '</td>' . "\n";
} else {
          $tableBox_string .= '    <td';
          if (isset($contents[$i]['align']) && tep_not_null($contents[$i]['align'])) $tableBox_string .= ' align="' . tep_output_string($contents[$i]['align']) . '"';
          if (isset($contents[$i]['params']) && tep_not_null($contents[$i]['params'])) {
            $tableBox_string .= ' ' . $contents[$i]['params'];
          } elseif (tep_not_null($this->table_data_parameters)) {
            $tableBox_string .= ' ' . $this->table_data_parameters;
          }
          $tableBox_string .= '>' . $contents[$i]['text'] . '</td>' . "\n";
}
        }

        $tableBox_string .= '  </tr>' . "\n";
        if (isset($contents[$i]['form']) && tep_not_null($contents[$i]['form'])) $tableBox_string .= '</form>' . "\n";
      }

      $tableBox_string .= '</table>' . "\n";

      if ($direct_output == true) echo $tableBox_string;

      return $tableBox_string;
    }
  }

  class productListingBox extends tableBox {
    function productListingBox($contents) {
      $this->tableBox($contents, true);
    }
  }

  class splitPageResults2 {
    var $sql_query, $number_of_rows, $current_page_number, $number_of_pages, $number_of_rows_per_page, $page_name;

/* class constructor */
    function splitPageResults2($query, $max_rows, $count_key = '*', $page_holder = 'page') {
      global $_GET, $_POST;

      $this->sql_query = $query;
      $this->page_name = $page_holder;

      if (isset($_GET[$page_holder])) {
        $page = $_GET[$page_holder];
      } elseif (isset($_POST[$page_holder])) {
        $page = $_POST[$page_holder];
      } else {
        $page = '';
      }

      if (empty($page) || !is_numeric($page)) $page = 1;
      $this->current_page_number = $page;

      $this->number_of_rows_per_page = $max_rows;

      $pos_to = strlen($this->sql_query);
      $pos_from = strpos($this->sql_query, ' from', 0);

      $pos_group_by = strpos($this->sql_query, ' group by', $pos_from);
      if (($pos_group_by < $pos_to) && ($pos_group_by != false)) $pos_to = $pos_group_by;

      $pos_having = strpos($this->sql_query, ' having', $pos_from);
      if (($pos_having < $pos_to) && ($pos_having != false)) $pos_to = $pos_having;

      $pos_order_by = strpos($this->sql_query, ' order by', $pos_from);
      if (($pos_order_by < $pos_to) && ($pos_order_by != false)) $pos_to = $pos_order_by;

      if (strpos($this->sql_query, 'distinct') || strpos($this->sql_query, 'group by')) {
        $count_string = 'distinct ' . tep_db_input($count_key);
      } else {
        $count_string = tep_db_input($count_key);
      }

      $count_query = tep_db_query("select count(" . $count_string . ") as total " . substr($this->sql_query, $pos_from, ($pos_to - $pos_from)));
      $count = tep_db_fetch_array($count_query);

      $this->number_of_rows = $count['total'];

      $this->number_of_pages = ceil($this->number_of_rows / $this->number_of_rows_per_page);

      if ($this->current_page_number > $this->number_of_pages) {
        $this->current_page_number = $this->number_of_pages;
      }

      $offset = ($this->number_of_rows_per_page * ($this->current_page_number - 1));

      $this->sql_query .= " limit " . $offset . ", " . $this->number_of_rows_per_page;
    }

// display split-page-number-links
    function display_links2($max_page_links, $parameters = '') {
      global $PHP_SELF, $request_type;
      $request_type='NONSSL';

      $display_links_string = '';

      $class = 'class="pageResults"';

      if (tep_not_null($parameters) && (substr($parameters, -1) != '&')) $parameters .= '&amp;';

// previous button - not displayed on first page
      if ($this->current_page_number > 1) $display_links_string .= '<a href="' . tep_href_link(basename($PHP_SELF), $parameters . $this->page_name . '=' . ($this->current_page_number - 1), $request_type) . '" class="pageResults" title=" ' . PREVNEXT_TITLE_PREVIOUS_PAGE . ' "><u>' . PREVNEXT_BUTTON_PREV . '</u></a>&nbsp;&nbsp;';

// check if number_of_pages > $max_page_links
      $cur_window_num = intval($this->current_page_number / $max_page_links);
      if ($this->current_page_number % $max_page_links) $cur_window_num++;

      $max_window_num = intval($this->number_of_pages / $max_page_links);
      if ($this->number_of_pages % $max_page_links) $max_window_num++;

// previous window of pages
      if ($cur_window_num > 1) $display_links_string .= '<a href="' . tep_href_link(basename($PHP_SELF), $parameters . $this->page_name . '=' . (($cur_window_num - 1) * $max_page_links), $request_type) . '" class="pageResults" title=" ' . sprintf(PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE, $max_page_links) . ' ">...</a>';

// page nn button
      for ($jump_to_page = 1 + (($cur_window_num - 1) * $max_page_links); ($jump_to_page <= ($cur_window_num * $max_page_links)) && ($jump_to_page <= $this->number_of_pages); $jump_to_page++) {
        if ($jump_to_page == $this->current_page_number) {
          $display_links_string .= '&nbsp;<b>' . $jump_to_page . '</b>&nbsp;';
        } else {
          $display_links_string .= '&nbsp;<a href="' . tep_href_link(basename($PHP_SELF), $parameters . $this->page_name . '=' . $jump_to_page, $request_type) . '" class="pageResults" title=" ' . sprintf(PREVNEXT_TITLE_PAGE_NO, $jump_to_page) . ' "><u>' . $jump_to_page . '</u></a>&nbsp;';
        }
      }

// next window of pages
      if ($cur_window_num < $max_window_num) $display_links_string .= '<a href="' . tep_href_link(basename($PHP_SELF), $parameters . $this->page_name . '=' . (($cur_window_num) * $max_page_links + 1), $request_type) . '" class="pageResults" title=" ' . sprintf(PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE, $max_page_links) . ' ">...</a>&nbsp;';

// next button
      if (($this->current_page_number < $this->number_of_pages) && ($this->number_of_pages != 1)) $display_links_string .= '&nbsp;<a href="' . tep_href_link(basename($PHP_SELF), $parameters . 'page=' . ($this->current_page_number + 1), $request_type) . '" class="pageResults" title=" ' . PREVNEXT_TITLE_NEXT_PAGE . ' "><u>' . PREVNEXT_BUTTON_NEXT . '</u></a>&nbsp;';

      return $display_links_string;
    }

    function display_count2($text_output) {
      $to_num = ($this->number_of_rows_per_page * $this->current_page_number);
      if ($to_num > $this->number_of_rows) $to_num = $this->number_of_rows;

      $from_num = ($this->number_of_rows_per_page * ($this->current_page_number - 1));

      if ($to_num == 0) {
        $from_num = 0;
      } else {
        $from_num++;
      }

      return sprintf($text_output, $from_num, $to_num, $this->number_of_rows);
    }
  }

// Return table heading with sorting capabilities
  function tep_create_sort_heading($sortby, $colnum, $heading) {
    global $PHP_SELF;

    $sort_prefix = '';
    $sort_suffix = '';

    if ($sortby) {
      $sort_prefix = '<a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('page', 'info', 'sort')) . 'page=1&amp;sort=' . $colnum . ($sortby == $colnum . 'a' ? 'd' : 'a')) . '" title="' . tep_output_string(TEXT_SORT_PRODUCTS . ($sortby == $colnum . 'd' || substr($sortby, 0, 1) != $colnum ? TEXT_ASCENDINGLY : TEXT_DESCENDINGLY) . TEXT_BY . $heading) . '">' ;
      $sort_suffix = (substr($sortby, 0, 1) == $colnum ? (substr($sortby, 1, 1) == 'a' ? '+' : '-') : '') . '</a>';
    }

    return $sort_prefix . $heading . $sort_suffix;
  }

  if ((isset($_GET['action'])) && ($_GET['action'] == 'export')) {

    if (isset($_GET['manufacturers_id']) && ($_GET['manufacturers_id'] != '') && (!isset($_GET['filter_id']))) {
      $manufacturer_query = tep_db_query("select manufacturers_name as name from " . TABLE_MANUFACTURERS . " where manufacturers_id = '" . $_GET['manufacturers_id'] . "'");
      $manufacturer = tep_db_query($manufacturer_query);
      $xls_header = 'Margin Report: ' . $manufacturer['name'];
    } elseif (isset($_GET['manufacturers_id']) && ($_GET['manufacturers_id'] != '') && (isset($_GET['filter_id']) && ($_GET['filter_id'] != ''))) {
      $manufacturer_query = tep_db_query("select manufacturers_name as name from " . TABLE_MANUFACTURERS . " where manufacturers_id = '" . $_GET['manufacturers_id'] . "'");
      $manufacturer = tep_db_fetch_array($manufacturer_query);
      $category_query = tep_db_query("select categories_name as name from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . $_GET['filter_id'] . "'");
      $category = tep_db_fetch_array($category_query);
      $xls_header = 'Margin Report: ' . $manufacturer['name'] . ' - ' . $category['name'];
    } else {
      $xls_header = 'Margin Report: All Products';
      }

    $sql = stripslashes($_GET['sql']);
    //echo $sql;
    $csv_query = mysql_query($sql);

$xls .= '<table width="1050" border="1" cellspacing="0" cellpadding="2">
  <tr align="center">
    <td colspan="6" width="1050" bgcolor="#FFFF00">
      <font face="Arial, Helvetica, sans-serif"><strong>' . $xls_header. '
        </strong> </font>    
    </td>
  </tr>
  <tr>
    <td colspan="6"> </td>
  </tr>
  <tr>
    <td width="250" align="right" bgcolor="#00CCFF">
    <font size="4" face="Times New Roman, Times, serif"><em>'. TEXT_PRODUCTS_NAME .'</em></font>    
    </td>
    <td width="160" align="right" bgcolor="#00CCFF">
    <font size="4" face="Times New Roman, Times, serif"><em>'. TEXT_PRODUCTS_COST .'</em></font>    
    </td>
    <td width="160" align="right" bgcolor="#00CCFF">
    <font size="4" face="Times New Roman, Times, serif"><em>'. TEXT_PRODUCTS_PRICE .'</em></font>    
    </td>
    <td width="160" align="right" bgcolor="#00CCFF">
    <font size="4" face="Times New Roman, Times, serif"><em>'. TEXT_SPECIAL_PRICE .'</em></font>    
    </td>
    <td width="160" align="right" bgcolor="#00CCFF">
    <font size="4" face="Times New Roman, Times, serif"><em>'. TEXT_MARGIN_MONEY .'</em></font>    
    </td>
    <td width="160" align="right" bgcolor="#00CCFF">
    <font size="4" face="Times New Roman, Times, serif"><em>'. TEXT_MARGIN_PERCENTAGE .'</em></font>    
    </td>
  </tr>';

$a = '1';
while ($csv_results = tep_db_fetch_array($csv_query)) {
  if ($a == '1') {
    if ($csv_results['specials_price'] == '' || $csv_results['specials_price'] == 'NULL') {
      $xls .= '<tr><td bgcolor="#C0C0C0">' . tep_get_products_name($csv_results['products_id']) . '</td><td bgcolor="#C0C0C0">' .$currencies->format($csv_results['products_cost']) . '</td><td bgcolor="#C0C0C0">' . $currencies->format($csv_results['products_price']) . '</td><td bgcolor="#C0C0C0"> </td><td bgcolor="#C0C0C0">' . $currencies->format($csv_results['margin_dollars']) . '</td><td bgcolor="#C0C0C0">' . number_format($csv_results['margin_percentage'], '2', '.', ',') . '</td></tr>';
    } else {
      $xls .= '<tr><td bgcolor="#C0C0C0">' . tep_get_products_name($csv_results['products_id']) . '</td><td bgcolor="#C0C0C0">' .$currencies->format($csv_results['products_cost']) . '</td><td bgcolor="#C0C0C0">' . $currencies->format($csv_results['products_price']) . '</td><td bgcolor="#C0C0C0">' . $currencies->format($csv_results['specials_price']) . '</td><td bgcolor="#C0C0C0">' . $currencies->format($csv_results['margin_dollars']) . '</td><td bgcolor="#C0C0C0">' . number_format($csv_results['margin_percentage'], '2', '.', ',') . '</td></tr>';
    }
    $a='0';
  } else {
    if ($csv_results['specials_price'] == '' || $csv_results['specials_price'] == 'NULL') {
      $xls .= '<tr><td bgcolor="#969696">' . tep_get_products_name($csv_results['products_id']) . '</td><td bgcolor="#969696">' .$currencies->format($csv_results['products_cost']) . '</td><td bgcolor="#969696">' . $currencies->format($csv_results['products_price']) . '</td><td bgcolor="#969696"> </td><td bgcolor="#969696">' . $currencies->format($csv_results['margin_dollars']) . '</td><td bgcolor="#969696">' . number_format($csv_results['margin_percentage'], '2', '.', ',') . '</td></tr>';
    } else {
      $xls .= '<tr><td bgcolor="#969696">' . tep_get_products_name($csv_results['products_id']) . '</td><td bgcolor="#969696">' .$currencies->format($csv_results['products_cost']) . '</td><td bgcolor="#969696">' . $currencies->format($csv_results['products_price']) . '</td><td bgcolor="#969696">' . $currencies->format($csv_results['specials_price']) . '</td><td bgcolor="#969696">' . $currencies->format($csv_results['margin_dollars']) . '</td><td bgcolor="#969696">' . number_format($csv_results['margin_percentage'], '2', '.', ',') . '</td></tr>';
    }
    $a='1';
  }
}
$xls .= '<tr>
</table>';
/////////////////////////////////////////////////////////////////////////////////

if ((isset($_GET['file'])) && ($_GET['file'] != '') && ($_GET['file'] != 'example_filename')) {
//////////////////////////////////////////////////////////////
// Please change this to the folder you want to use.
$extension = '.xls';
//////////////////////////////////////////////////////////////
$filename = $_GET['file'] . $extension;

header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=" . $filename);
header("Pragma: no-cache");
header("Expires: 0");
print "$xls";
exit();

} else {
echo 'Please enter a valid filename and check your location.';
}
}
//////////////////////////////////////////////////////////////////////////////////
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
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.png', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
<?php
      if (isset($_GET['manufacturers_id'])) {
        $filterlist_sql = "select distinct c.categories_id as id, cd.categories_name as name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where p.products_status = '1' and p.products_id = p2c.products_id and p2c.categories_id = c.categories_id and p2c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' and p.manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "' order by cd.categories_name";
      } else {
        $filterlist_sql= "select distinct m.manufacturers_id as id, m.manufacturers_name as name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_MANUFACTURERS . " m where p.products_status = '1' and p.manufacturers_id = m.manufacturers_id and p.products_id = p2c.products_id order by m.manufacturers_name";
      }
      $filterlist_query = tep_db_query($filterlist_sql);
  
      if (tep_db_num_rows($filterlist_query) > 1) {
        echo '            <td align="right" class="main">' . tep_draw_form('filter', FILENAME_MARGIN_REPORT, '', 'get') . TEXT_SHOW . '&nbsp;';
        if (isset($_GET['manufacturers_id'])) {
          echo tep_draw_hidden_field('manufacturers_id', $_GET['manufacturers_id']);
          $options = array(array('id' => '', 'text' => TEXT_ALL_CATEGORIES_BY_MANUFACTURER));
        } else {
          echo tep_draw_hidden_field('cPath', $cPath);
          $options = array(array('id' => '', 'text' => TEXT_ALL_MANUFACTURERS));
        }
        echo tep_draw_hidden_field('sort', $_GET['sort']);
        while ($filterlist = tep_db_fetch_array($filterlist_query)) {
          $options[] = array('id' => $filterlist['id'], 'text' => $filterlist['name']);
        }
        if (!isset($_GET['manufacturers_id'])) echo tep_draw_pull_down_menu('manufacturers_id', $options, (isset($_GET['filter_id']) ? $_GET['filter_id'] : ''), 'onchange="this.form.submit()"');
        if (isset($_GET['manufacturers_id'])) echo tep_draw_pull_down_menu('filter_id', $options, (isset($_GET['filter_id']) ? $_GET['filter_id'] : ''), 'onchange="this.form.submit()"');
        echo '</form></td>' . "\n";
      }
?>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top">
<?php
    $define_list = array('PRODUCT_LIST_PRODUCT' => '1',
                         'PRODUCT_LIST_COST' => '2',
                         'PRODUCT_LIST_PRICE' => '3',
                         'PRODUCT_LIST_SPECIAL_PRICE' => '4',
                         'PRODUCT_LIST_MARGIN_DOLLARS' => '5',
                         'PRODUCT_LIST_MARGIN_PERCENTAGE' => '6');

    asort($define_list);
    $column_list = array();
    reset($define_list);
    while (list($key, $value) = each($define_list)) {
      if ($value > 0) $column_list[] = $key;
    }
    
// show the products of a specified manufacturer
    if (isset($_GET['manufacturers_id'])) {
      if (isset($_GET['filter_id']) && tep_not_null($_GET['filter_id'])) {
// We are asked to show only a specific category
        $listing_sql = "select p.products_id, p.products_price as products_price, p.products_cost, pd.products_name, IF(s.status, s.specials_new_products_price, NULL) as specials_price, if(s.status, s.specials_new_products_price-p.products_cost, p.products_price-p.products_cost) as margin_dollars, if(s.status, (s.specials_new_products_price-p.products_cost)/s.specials_new_products_price*100, (p.products_price-p.products_cost)/p.products_price*100) as margin_percentage, p2c.categories_id as category, c.parent_id as parent from (" . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c, " . TABLE_MANUFACTURERS . " m, " . TABLE_PRODUCTS_DESCRIPTION . " pd) left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id where pd.language_id = '" . (int)$languages_id . "' and p.products_id = pd.products_id and p2c.products_id = p.products_id and c.categories_id = p2c.categories_id and p2c.categories_id = '" . (int)$_GET['filter_id'] . "' and p.manufacturers_id = m.manufacturers_id and m.manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "'";
      } else {
// We show them all
        $listing_sql = "select p.products_id, p.products_price as products_price, p.products_cost, pd.products_name, IF(s.status, s.specials_new_products_price, NULL) as specials_price, if(s.status, s.specials_new_products_price-p.products_cost, p.products_price-p.products_cost) as margin_dollars, if(s.status, (s.specials_new_products_price-p.products_cost)/s.specials_new_products_price*100, (p.products_price-p.products_cost)/p.products_price*100) as margin_percentage, p2c.categories_id as category, c.parent_id as parent from (" . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c, " . TABLE_MANUFACTURERS . " m, " . TABLE_PRODUCTS_DESCRIPTION . " pd) left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id where pd.language_id = '" . (int)$languages_id . "' and p.products_id = pd.products_id and p2c.products_id = p.products_id and c.categories_id = p2c.categories_id and p.manufacturers_id = m.manufacturers_id and m.manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "'";
      }
    } elseif (isset($_GET['filter_id']) && tep_not_null($_GET['filter_id'])) {
// show the products in a given category
// We are asked to show only specific category
        $listing_sql = "select p.products_id, p.products_price as products_price, p.products_cost, pd.products_name, IF(s.status, s.specials_new_products_price, NULL) as specials_price, if(s.status, s.specials_new_products_price-p.products_cost, p.products_price-p.products_cost) as margin_dollars, if(s.status, (s.specials_new_products_price-p.products_cost)/s.specials_new_products_price*100, (p.products_price-p.products_cost)/p.products_price*100) as margin_percentage, p2c.categories_id as category, c.parent_id as parent from (" . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c, " . TABLE_PRODUCTS_DESCRIPTION . " pd) left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id where pd.language_id = '" . (int)$languages_id . "' and p.products_id = pd.products_id and p2c.products_id = p.products_id and c.categories_id = p2c.categories_id and p2c.categories_id = '" . (int)$_GET['filter_id'] . "'";
    } elseif (isset($_GET['report_id']) && tep_not_null($_GET['report_id'])) {
// Show the products from the time frame defined by the report variable.
      $listing_sql = "select p.products_id, p.products_price as products_price, p.products_cost, pd.products_name, IF(s.status, s.specials_new_products_price, NULL) as specials_price, if(s.status, s.specials_new_products_price-p.products_cost, p.products_price-p.products_cost) as margin_dollars, if(s.status, (s.specials_new_products_price-p.products_cost)/s.specials_new_products_price*100, (p.products_price-p.products_cost)/p.products_price*100) as margin_percentage, p2c.categories_id as category, c.parent_id as parent from (" . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c, " . TABLE_PRODUCTS_DESCRIPTION . " pd) left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id where pd.language_id = '" . (int)$languages_id . "' and p.products_id = pd.products_id and p2c.products_id = p.products_id and c.categories_id = p2c.categories_id and p2c.categories_id = '" . (int)$_GET['filter_id'] . "'";
    } else {
// We show them all
        $listing_sql = "select " . $select_column_list . " p.products_id, p.products_price as products_price, p.products_cost, pd.products_name, IF(s.status, s.specials_new_products_price, NULL) as specials_price, if(s.status, s.specials_new_products_price-p.products_cost, p.products_price-p.products_cost) as margin_dollars, if(s.status, (s.specials_new_products_price-p.products_cost)/s.specials_new_products_price*100, (p.products_price-p.products_cost)/p.products_price*100) as margin_percentage, p2c.categories_id as category, c.parent_id as parent from (" . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c, " . TABLE_PRODUCTS_DESCRIPTION . " pd) left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id where pd.language_id = '" . (int)$languages_id . "' and p.products_id = pd.products_id and p2c.products_id = p.products_id and c.categories_id = p2c.categories_id";
}    

    if ( (!isset($_GET['sort'])) || (!ereg('[1-8][ad]', $_GET['sort'])) || (substr($_GET['sort'], 0, 1) > sizeof($column_list)) ) {
      for ($i=0, $n=sizeof($column_list); $i<$n; $i++) {
        if ($column_list[$i] == 'PRODUCT_LIST_PRODUCT') {
          $_GET['sort'] = $i+1 . 'a';
          $listing_sql .= " order by pd.products_name";
          break;
        }
      }
    } else {
      $sort_col = substr($_GET['sort'], 0 , 1);
      $sort_order = substr($_GET['sort'], 1);
      $listing_sql .= ' order by ';
      switch ($column_list[$sort_col-1]) {
        case 'PRODUCT_LIST_PRODUCT':
          $listing_sql .= "pd.products_name " . ($sort_order == 'd' ? 'desc' : '');
          break;
        case 'PRODUCT_LIST_COST':
          $listing_sql .= "p.products_cost " . ($sort_order == 'd' ? 'desc' : '');
          break;
        case 'PRODUCT_LIST_PRICE':
          $listing_sql .= "p.products_price " . ($sort_order == 'd' ? 'desc' : '');
          break;
        case 'PRODUCT_LIST_SPECIAL_PRICE':
          $listing_sql .= "specials_price " . ($sort_order == 'd' ? 'desc' : '');
          break;
        case 'PRODUCT_LIST_MARGIN_DOLLARS':
          $listing_sql .= "margin_dollars " . ($sort_order == 'd' ? 'desc' : '');
          break;
        case 'PRODUCT_LIST_MARGIN_PERCENTAGE':
          $listing_sql .= "margin_percentage " . ($sort_order == 'd' ? 'desc' : '');
          break;
      }
    }


  $listing_split = new splitPageResults2($listing_sql, MAX_DISPLAY_SEARCH_RESULTS);

  if (($listing_split->number_of_rows > 0) && ( (PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3') ) ) {

?>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr>
    <td class="smallText"><?php echo $listing_split->display_count2(TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></td>
    <td class="smallText" align="right"><?php echo TEXT_RESULT_PAGES . ' ' . $listing_split->display_links2(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('info', 'x', 'y'))); ?></td>
  </tr>
</table>
<?php
  }

  $list_box_contents = array();

  for ($col=0, $n=sizeof($column_list); $col<$n; $col++) {
    switch ($column_list[$col]) {
      case 'PRODUCT_LIST_PRODUCT':
        $lc_text = TABLE_HEADING_PRODUCT;
        $lc_align = '';
        break;
      case 'PRODUCT_LIST_COST':
        $lc_text = TABLE_HEADING_COST;
        $lc_align = '';
        break;
      case 'PRODUCT_LIST_PRICE':
        $lc_text = TABLE_HEADING_PRICE;
        $lc_align = '';
        break;
      case 'PRODUCT_LIST_SPECIAL_PRICE':
        $lc_text = TABLE_HEADING_SPECIAL_PRICE;
        $lc_align = 'right';
        break;
      case 'PRODUCT_LIST_MARGIN_DOLLARS':
        $lc_text = TABLE_HEADING_MARGIN_DOLLARS;
        $lc_align = 'right';
        break;
      case 'PRODUCT_LIST_MARGIN_PERCENTAGE':
        $lc_text = TABLE_HEADING_MARGIN_PERCENTAGE;
        $lc_align = 'right';
        break;
    }

      $lc_text = tep_create_sort_heading($_GET['sort'], $col+1, $lc_text);


    $list_box_contents[0][] = array('align' => $lc_align,
                                    'params' => 'class="dataTableHeadingRow"',
                                    'text' => '&nbsp;' . $lc_text . '&nbsp;');
  }

  if ($listing_split->number_of_rows > 0) {
    $rows = 0;
    $listing_query = tep_db_query($listing_split->sql_query);
    while ($listing = tep_db_fetch_array($listing_query)) {
      $rows++;

      if (($rows/2) == floor($rows/2)) {
        $list_box_contents[] = array('params' => 'class="dataTableContent"');
      } else {
        $list_box_contents[] = array('params' => 'class="dataTableContent"');
      }

      $cur_row = sizeof($list_box_contents) - 1;

      for ($col=0, $n=sizeof($column_list); $col<$n; $col++) {
        $lc_align = '';

        switch ($column_list[$col]) {
          case 'PRODUCT_LIST_PRODUCT':
            $lc_align = '';
            if ($listing['parent'] == '0') {
            $lc_text = '&nbsp;<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $listing['category'] . '&amp;pID=' . $listing['products_id'] . '&amp;action=new_product') . '">' . $listing['products_name'] . '</a>&nbsp;';
            } else {
            $lc_text = '&nbsp;<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $listing['parent'] . '_' . $listing['category'] . '&amp;pID=' . $listing['products_id'] . '&amp;action=new_product') . '">' . $listing['products_name'] . '</a>&nbsp;';
            }
            break;
          case 'PRODUCT_LIST_COST':
            $lc_align = '';
            $lc_text = '&nbsp;' . $currencies->format($listing['products_cost']) . '&nbsp;';
            break;
          case 'PRODUCT_LIST_PRICE':
            $lc_align = '';
            if (tep_not_null($listing['specials_price'])) {
              $lc_text = '&nbsp;<s>' . $currencies->format($listing['products_price']) . '&nbsp;</s>';
            } else {
              $lc_text = '&nbsp;' . $currencies->format($listing['products_price']) . '&nbsp;';
            }
            break;
          case 'PRODUCT_LIST_SPECIAL_PRICE':
            $lc_align = 'right';
            if (tep_not_null($listing['specials_price'])) {
              $lc_text = '&nbsp;' . '<span class="specialprice">' . $currencies->format($listing['specials_price']) . '</span>&nbsp;';
            } else {
              $lc_text = '&nbsp;' . ' ' . '&nbsp;';
            }
            break;
          case 'PRODUCT_LIST_MARGIN_DOLLARS':
            $lc_align = 'right';
            if ($listing['products_price'] > $listing['products_cost']) {
            $lc_text = '&nbsp;' . $currencies->format($listing['margin_dollars']) . '&nbsp;';
            } else {
            $lc_text = '&nbsp;' . '<span class="belowCost">' . $currencies->format($listing['margin_dollars']) . '</span>' . '&nbsp;';
            }
            break;
          case 'PRODUCT_LIST_MARGIN_PERCENTAGE':
            $lc_align = 'right';
            if ($listing['products_price'] > $listing['products_cost']) {
            $lc_text = '&nbsp;' . number_format($listing['margin_percentage'], '2', '.', ',') . '%' . '&nbsp;';
            } else {
            $lc_text = '&nbsp;' . '<span class="belowCost">' . number_format($listing['margin_percentage'], '2', '.', ',') . '%</span>' . '&nbsp;';
            }
            break;
        }

        $list_box_contents[$cur_row][] = array('align' => $lc_align,
                                               'params' => 'class="dataTableRow"',
                                               'text'  => $lc_text);
      }
    }

    new productListingBox($list_box_contents);
  } else {
    $list_box_contents = array();

    $list_box_contents[0] = array('params' => 'class="productListing-odd"');
    $list_box_contents[0][] = array('params' => 'class="productListing-data"',
                                   'text' => TEXT_NO_PRODUCTS);
                                   
    new productListingBox($list_box_contents);
  }

  if ( ($listing_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3')) ) {
?>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr>
    <td><?php echo tep_draw_separator('pixel_trans.png', '1', '5'); ?></td>
  </tr>
  <tr>
    <td class="smallText"><?php echo $listing_split->display_count2(TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></td>
    <td class="smallText" align="right"><?php echo TEXT_RESULT_PAGES . ' ' . $listing_split->display_links2(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('info', 'x', 'y'))); ?></td>
  </tr>
</table>
<?php
  }
?>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr>
                 <?php if (isset($_GET['manufacturers_id'])) { ?>
                <td align="left"><?php echo '<a href="' . tep_href_link(FILENAME_MARGIN_REPORT, '', 'NONSSL') . '">' . tep_image_button('button_back.png', BUTTON_BACK_TO_MAIN) . '</a>'; ?></td>
              <?php } else { 

        echo '<td align="left" class="main">' . tep_draw_form('report', FILENAME_MARGIN_REPORT2, '', 'get') . TEXT_SHOW . '&nbsp;';
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
        echo tep_draw_pull_down_menu('report_id', $options, (isset($_GET['report_id']) ? $_GET['report_id'] : '1'), 'onchange="this.form.submit()"');
        echo '</form></td>' . "\n";
      }

  if (isset($_GET['manufacturers_id']) && ($_GET['manufacturers_id'] != '') && (!isset($_GET['filter_id']))) {
    $get_vars = tep_draw_hidden_field('manufacturers_id', $_GET['manufacturers_id']);
  } elseif (isset($_GET['manufacturers_id']) && ($_GET['manufacturers_id'] != '') && (isset($_GET['filter_id']) && ($_GET['filter_id'] != ''))) {
    $get_vars = tep_draw_hidden_field('manufacturers_id', $_GET['manufacturers_id']) . tep_draw_hidden_field('filter_id', $_GET['filter_id']);
  } else {
    $get_vars = '';
    }

?>
              <td align="right">
                <table>
                  <tr>
                    <td>
                    <?php echo tep_draw_form('export_to_file', FILENAME_MARGIN_REPORT, 'get', '') . tep_draw_hidden_field('action', 'export') . $get_vars . tep_draw_hidden_field('sql', $listing_sql); ?>
                    <input type="text" name="file" value="filename" />
                    </td>
                    <td>
                    <?php echo '<input type="image" name="submit" src="' . DIR_WS_LANGUAGES . $language . '/images/buttons/button_export.png" alt="' . TEXT_EXPORT_BUTTON . '" />'; ?>
                    </form>
                    </td>
                  </tr>
                </table>
              </td>
          </tr>
        </table>
        </td>
      </tr>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
</table>

<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br />
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>