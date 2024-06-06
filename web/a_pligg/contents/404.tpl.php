<table>
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
		//shop2.0brain:todo opravit nasledujic radek
              //require(DIR_WS_BOXES . 'information.php');
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
//next line old mysql4
//  $from_str = "from " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS . " m using(manufacturers_id), " . TABLE_PRODUCTS_DESCRIPTION . " pd left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_CATEGORIES . " c, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c";
$from_str = "from (" . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd) left join " . TABLE_MANUFACTURERS . " m using(manufacturers_id) left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_CATEGORIES . " c, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c";
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

//  require(DIR_WS_MODULES . FILENAME_PRODUCT_LISTING);
  require(bts_select('column', FILENAME_PRODUCT_LISTING));

?>
        </td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td class="main"><?php echo '<a href="' . tep_href_link(FILENAME_ADVANCED_SEARCH, tep_get_all_get_params(array('sort', 'page', 'x', 'y')), 'NONSSL', true, false) . '">' . tep_image_button('button_back.gif', IMAGE_BUTTON_BACK) . '</a>'; ?></td>
      </tr>
    </table>
<!-- body_text_eof //-->
