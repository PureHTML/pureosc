<?php
/*
  $Id: 404.php,v 1.2 2003/02/04 04:51:46 webdesign Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_404);

   // drop what they're looking for in an array 
  $pieces = explode('/', strtolower($REQUEST_URI)); 
  // no doubles
  $pieces = array_unique($pieces); 
  /*************************************************
    Depending on the structure your old site had you might want 
    to change the value of $i.  
    if we we're asked www.yoursite.com/oldshop/computer/monitor/bla.html   
    $pieces[0] will hold 'oldshop'   
    so $i should be 1.  
    The default code strips: 'p-', 'c-', '.html'
    
  **************************************************/ 
  $i = 1;  
  $keywords = ''; 
  $length =  count($pieces);
  while ($i < $length) { 
    // former shopping cart used p-MODEL.html
    $dummy = $pieces[$i];
    $patterns[0] = '/.html/';
    $patterns[1] = '/p-/';
    $patterns[2] = '/c-/';
    // if you want to add more stuff to strip out, then copy the line above
    // and increment the array index. Also be sure to add a new replacement line
    $replacements[0] = '';
    $replacements[1] = '';
    $replacements[2] = '';
    // This line replaces all the instances of 'patterns' with 'replacements' in dummy.
    $pieces[$i] = preg_replace($patterns, $replacements, $dummy);
    if($i == ($length-1))
    {
      $keywords .= $pieces[$i]; 
    }
    else
    {
      $keywords .= $pieces[$i] . ' OR '; 
    }
    $i++; 
  }

  $search_in_description=1; // Search in the Product Descriptions, yes=1

  $error = 0; // reset error flag to false
  $errorno = 0;


  // Start Code from advanced_search_results.php
  if ($dfrom == DOB_FORMAT_STRING)
    $dfrom_to_check = "";
  else
    $dfrom_to_check = $dfrom;

  if ($dto == DOB_FORMAT_STRING)
    $dto_to_check = "";
  else
    $dto_to_check = $dto;

  if (strlen($dfrom_to_check) > 0) {
    if (!tep_checkdate($dfrom_to_check, DOB_FORMAT_STRING, $dfrom_array)) {
      $errorno += 10;
      $error = 1;
    }
  }  

  if (strlen($dto_to_check) > 0) {
    if (!tep_checkdate($dto_to_check, DOB_FORMAT_STRING, $dto_array)) {
      $errorno += 100;
      $error = 1;
    }
  }  

  if (strlen($dfrom_to_check) > 0 && !(($errorno & 10) == 10) &&
      strlen($dto_to_check) > 0 && !(($errorno & 100) == 100)) {
    if (mktime(0, 0, 0, $dfrom_array[1], $dfrom_array[2], $dfrom_array[0]) > mktime(0, 0, 0, $dto_array[1], $dto_array[2], $dto_array[0])) {
      $errorno += 1000;
      $error = 1;
    }
  }

  if (strlen($pfrom) > 0) {
    $pfrom_to_check = $pfrom;
    if (!settype($pfrom_to_check, "double")) {
      $errorno += 10000;
      $error = 1;
    }
  }

  if (strlen($pto) > 0) {
    $pto_to_check = $pto;
    if (!settype($pto_to_check, "double")) {
      $errorno += 100000;
      $error = 1;
    }
  }

  if (strlen($pfrom) > 0 && !(($errorno & 10000) == 10000) &&
      strlen($pto) > 0 && !(($errorno & 100000) == 100000)) {
    if ($pfrom_to_check > $pto_to_check) {
      $errorno += 1000000;
      $error = 1;
    }
  }

  if (strlen($keywords) > 0) {
    if (!tep_parse_search_string(stripslashes($keywords), $search_keywords)) {
      $errorno += 10000000;
      $error = 1;
    }
  }
  
  if ($error == 1) {
    tep_redirect(tep_href_link(FILENAME_ADVANCED_SEARCH, 'errorno=' . $errorno . '&' . tep_get_all_get_params(array('x', 'y')), 'NONSSL'));
  } else {

    $breadcrumb->add(NAVBAR_TITLE1, tep_href_link(FILENAME_ADVANCED_SEARCH, '', 'NONSSL'));
    $breadcrumb->add(NAVBAR_TITLE2, tep_href_link(FILENAME_ADVANCED_SEARCH_RESULT, 'keywords=' . $keywords . '&search_in_description=' . $search_in_description . '&categories_id=' . $categories_id . '&inc_subcat=' . $inc_subcat . '&manufacturers_id=' . $manufacturers_id . '&pfrom=' . $pfrom . '&pto=' . $pto . '&dfrom=' . $dfrom . '&dto=' . $dto));
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<base href="<?php echo (getenv('HTTPS') == 'on' ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="3" cellpadding="3">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="2">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">
            <?php echo HEADING_TITLE; ?>
            </td>
            <td class="pageHeading" align="right"><?php echo tep_image(DIR_WS_IMAGES . HEADING_IMAGE, HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
<!-- error_message_text //-->
          <tr>
            <td class="main" valign="top">
            <?php echo MISSING_PAGE_TEXT; ?>
            </td>
            <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="2">
            <?php 
              // you can add more info boxes here if you have them
              //require(DIR_WS_BOXES . 'customer_service.php');
              //echo "<br>";
              require(DIR_WS_BOXES . 'information.php');
            ?>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td>
<?php
  // create column list
  $define_list = array('PRODUCT_LIST_MODEL' => PRODUCT_LIST_MODEL,
                       'PRODUCT_LIST_NAME' => PRODUCT_LIST_NAME,
                       'PRODUCT_LIST_MANUFACTURER' => PRODUCT_LIST_MANUFACTURER, 
                       'PRODUCT_LIST_PRICE' => PRODUCT_LIST_PRICE, 
                       'PRODUCT_LIST_QUANTITY' => PRODUCT_LIST_QUANTITY, 
                       'PRODUCT_LIST_WEIGHT' => PRODUCT_LIST_WEIGHT, 
                       'PRODUCT_LIST_IMAGE' => PRODUCT_LIST_IMAGE, 
                       'PRODUCT_LIST_BUY_NOW' => PRODUCT_LIST_BUY_NOW);
  asort($define_list);

  $column_list = array();
  reset($define_list);
  while (list($column, $value) = each($define_list)) {
    if ($value) $column_list[] = $column;
  }

  $select_column_list = '';

  for ($col=0; $col<sizeof($column_list); $col++) {
    if ( ($column_list[$col] == 'PRODUCT_LIST_BUY_NOW') || ($column_list[$col] == 'PRODUCT_LIST_NAME') || ($column_list[$col] == 'PRODUCT_LIST_PRICE') ) {
      continue;
    }

    if ($select_column_list != '') {
      $select_column_list .= ', ';
    }

    switch ($column_list[$col]) {
      case 'PRODUCT_LIST_MODEL':        $select_column_list .= 'p.products_model';
                                        break;
      case 'PRODUCT_LIST_MANUFACTURER': $select_column_list .= 'm.manufacturers_name';
                                        break;
      case 'PRODUCT_LIST_QUANTITY':     $select_column_list .= 'p.products_quantity';
                                        break;
      case 'PRODUCT_LIST_IMAGE':        $select_column_list .= 'p.products_image';
                                        break;
      case 'PRODUCT_LIST_WEIGHT':
        $select_column_list .= 'p.products_weight';
        break;
    }
  }

  if ($select_column_list != '') {
    $select_column_list .= ', ';
  }

  $select_str = "select distinct " . $select_column_list . " m.manufacturers_id, p.products_id, pd.products_name, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price ";
  if ( (DISPLAY_PRICE_WITH_TAX == true) && ($pfrom || $pto) ) {
    $select_str .= ", SUM(tr.tax_rate) as tax_rate ";
  }

  $from_str = "from " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS . " m using(manufacturers_id), " . TABLE_PRODUCTS_DESCRIPTION . " pd left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_CATEGORIES . " c, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c";
  if ( (DISPLAY_PRICE_WITH_TAX == true) && ($pfrom || $pto) ) {
    if (!tep_session_is_registered('customer_country_id')) $customer_country_id = STORE_COUNTRY;
    if (!tep_session_is_registered('customer_zone_id')) $customer_zone_id = STORE_ZONE;
    $from_str .= " left join " . TABLE_TAX_RATES . " tr on p.products_tax_class_id = tr.tax_class_id left join " . TABLE_ZONES_TO_GEO_ZONES . " gz on tr.tax_zone_id = gz.geo_zone_id and (gz.zone_country_id is null or gz.zone_country_id = '0' or gz.zone_country_id = '" . $customer_country_id . "') and (gz.zone_id is null or gz.zone_id = '0' or gz.zone_id = '" . $customer_zone_id . "')";
  }
  $where_str = " where p.products_status = '1' and p.products_id = pd.products_id and pd.language_id = '" . $languages_id . "' and p.products_id = p2c.products_id and p2c.categories_id = c.categories_id ";
  if ($categories_id) {
    if ($inc_subcat == "1") {
      $subcategories_array = array();
      tep_get_subcategories($subcategories_array, $categories_id);
      $where_str .= " and p2c.products_id = p.products_id and p2c.products_id = pd.products_id and (p2c.categories_id = '" . $categories_id . "'";
      for ($i=0; $i<sizeof($subcategories_array); $i++ ) {
        $where_str .= " or p2c.categories_id = '" . $subcategories_array[$i] . "'";
      }
      $where_str .= ")";
    }
    else {
      $where_str .= " and p2c.products_id = p.products_id and p2c.products_id = pd.products_id and pd.language_id = '" . $languages_id . "' and p2c.categories_id = '" . $categories_id . "'";
    }
  }
  if ($manufacturers_id) {
    $where_str .= " and m.manufacturers_id = '" . $manufacturers_id . "'";
  }
  if ($keywords)
  {
    if (tep_parse_search_string( StripSlashes($keywords), $search_keywords))
    {
//  MODIFIED 1-30-2002 BY M.BROWNING : mbrowning@pdltd.com
//  COMPLETE REWRITE OF SEARCH COMPILATION ALGORITHM.  IT WAS TOTALLY BROKEN.
//  REGARDLESS OF WHICH CONDITION (AND / OR) WAS SET AS THE DEFAULT CONCATENATION
//  OPERATOR.  In Prior algorithm, if one word appeared in Product Name, and another
//  in Product Model, then it met the condition.  WHAT was REALLY MEANT TO HAPPEN WAS
//  that ALL keywords must appear in Name or all in Description (etc) for the
//  criteria to be satisfied.

      $strProdNameSearch = '';
      $strProdModelSearch = '';
      $strProdDescSearch = '';
      $strMfgSearch = '';

      for ($i=0; $i < sizeof($search_keywords); $i++)
      {
          switch ($search_keywords[$i])
          {
              case '(':
              case ')':
              case 'and':
              case 'or':
              {
                  $strProdNameSearch  .= " $search_keywords[$i] ";
                  $strProdModelSearch .= " $search_keywords[$i] ";
                  $strProdDescSearch  .= " $search_keywords[$i] ";
                  $strMfgSearch       .= " $search_keywords[$i] ";
                  break;
              }
              default:
              {
                  $strProdNameSearch  .= " pd.products_name like '%$search_keywords[$i]%' ";
                  $strProdModelSearch .= " p.products_model like '%$search_keywords[$i]%' ";
                  $strProdDescSearch  .= " m.manufacturers_name like '%$search_keywords[$i]%' ";
                  $strMfgSearch       .= " pd.products_description like '%$search_keywords[$i]%' ";
                  break;
              }
          }
      }

      $where_str  .= " AND  ( ($strProdNameSearch) OR ($strProdModelSearch)"
                  .  " OR ($strProdDescSearch) OR ($strMfgSearch) ) ";	
	}
  }
  if ($dfrom && $dfrom != DOB_FORMAT_STRING) {
    $where_str .= " and p.products_date_added >= '" . tep_date_raw($dfrom_to_check) . "'";
  }
  if ($dto && $dto != DOB_FORMAT_STRING) {
    $where_str .= " and p.products_date_added <= '" . tep_date_raw($dto_to_check) . "'";
  }

  $rate = $currencies->get_value($currency);
  if ($rate) {
    $pfrom = $pfrom / $rate;
    $pto = $pto / $rate;
  }
  if (DISPLAY_PRICE_WITH_TAX == true) {
    if ($pfrom) $where_str .= " and (IF(s.status, s.specials_new_products_price, p.products_price) * (1 + (tr.tax_rate / 100) ) >= " . $pfrom . ")";
    if ($pto)   $where_str .= " and (IF(s.status, s.specials_new_products_price, p.products_price) * (1 + (tr.tax_rate / 100) ) <= " . $pto . ")";
  } else {
    if ($pfrom) $where_str .= " and (IF(s.status, s.specials_new_products_price, p.products_price) >= " . $pfrom . ")";
    if ($pto)   $where_str .= " and (IF(s.status, s.specials_new_products_price, p.products_price) <= " . $pto . ")";
  }
  if ( (DISPLAY_PRICE_WITH_TAX == true) && ($pfrom || $pto) ) {
    $where_str .= " group by p.products_id, tr.tax_priority";
  }

  if ( (!$HTTP_GET_VARS['sort']) || (!ereg('[1-8][ad]', $HTTP_GET_VARS['sort'])) || (substr($HTTP_GET_VARS['sort'], 0 , 1) > sizeof($column_list)) ) {
    for ($col=0; $col<sizeof($column_list); $col++) {
      if ($column_list[$col] == 'PRODUCT_LIST_NAME') {
        $HTTP_GET_VARS['sort'] = $col+1 . 'a';
        $order_str = ' order by pd.products_name';
        break;
      }
    }
  } else {
    $sort_col = substr($HTTP_GET_VARS['sort'], 0 , 1);
    $sort_order = substr($HTTP_GET_VARS['sort'], 1);
    $order_str = ' order by ';
    switch ($column_list[$sort_col-1]) {
      case 'PRODUCT_LIST_MODEL':        $order_str .= "p.products_model " . ($sort_order == 'd' ? "desc" : "") . ", pd.products_name";
                                        break;
      case 'PRODUCT_LIST_NAME':         $order_str .= "pd.products_name " . ($sort_order == 'd' ? "desc" : "");
                                        break;
      case 'PRODUCT_LIST_MANUFACTURER': $order_str .= "m.manufacturers_name " . ($sort_order == 'd' ? "desc" : "") . ", pd.products_name";
                                        break;
      case 'PRODUCT_LIST_QUANTITY':     $order_str .= "p.products_quantity " . ($sort_order == 'd' ? "desc" : "") . ", pd.products_name";
                                        break;
      case 'PRODUCT_LIST_IMAGE':        $order_str .= "pd.products_name";
                                        break;
      case 'PRODUCT_LIST_WEIGHT':       $order_str .= "p.products_weight " . ($sort_order == 'd' ? "desc" : "") . ", pd.products_name";
                                        break;
      case 'PRODUCT_LIST_PRICE':        $order_str .= "final_price " . ($sort_order == 'd' ? "desc" : "") . ", pd.products_name";
                                        break;
    }
  }

  $listing_sql = $select_str . $from_str . $where_str . $order_str;

  require(DIR_WS_MODULES . FILENAME_PRODUCT_LISTING);
?>
        </td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td class="main"><?php echo '<a href="' . tep_href_link(FILENAME_ADVANCED_SEARCH, tep_get_all_get_params(array('sort', 'page', 'x', 'y')), 'NONSSL', true, false) . '">' . tep_image_button('button_back.gif', IMAGE_BUTTON_BACK) . '</a>'; ?></td>
      </tr>
    </table></td>
<!-- body_text_eof //-->
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="2">
<!-- right_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_right.php'); ?>
<!-- right_navigation_eof //-->
    </table></td>
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php
  }

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
