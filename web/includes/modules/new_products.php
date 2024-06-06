<?php
/*
  $Id: new_products.php,v 1.34 2003/06/09 22:49:58 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- new_products //-->
<?php
  $info_box_contents = array();
  $info_box_contents[] = array('text' => sprintf(TABLE_HEADING_NEW_PRODUCTS, strftime('%B')));

//  new contentBoxHeading($info_box_contents);
//echo  '<div class="categoriesH1">' .sprintf(TABLE_HEADING_NEW_PRODUCTS, strftime('%B')) . '</div>';
  //TotalB2B start
  if ( (!isset($new_products_category_id)) || ($new_products_category_id == '0') ) {
// ######################## Added Enable / Disable Categorie ################
//orig:    $new_products_query = tep_db_query("select m.manufacturers_name,  pd.products_description, pd.products_description_long, pd.products_description_long2, p.products_dotisk, p.products_id, p.products_image, p.products_tax_class_id, pd.products_name, if(s.status, s.specials_new_products_price, p.products_price) as products_price from " . TABLE_MANUFACTURERS . " m, " .  TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c where m.manufacturers_id = p.manufacturers_id AND  c.categories_status='1' and p.products_id = p2c.products_id and p2c.categories_id = c.categories_id and p.products_status = '1' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' order by rand() desc limit " . MAX_DISPLAY_NEW_PRODUCTS);
//        $new_products_query = tep_db_query("select unix_timestamp(p.products_date_available) as unixdate, m.manufacturers_name,  pd.products_description, pd.products_description_long, pd.products_description_long2, p.products_dotisk, p.products_id, p.products_image, p.products_tax_class_id, pd.products_name, if(s.status, s.specials_new_products_price, p.products_price) as products_price from " . TABLE_MANUFACTURERS . " m, " .  TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c where m.manufacturers_id = p.manufacturers_id AND  c.categories_status='1' and p.products_id = p2c.products_id and p2c.categories_id = c.categories_id and p.products_status = '1' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and (p.products_date_available is NULL OR p.products_date_available< to_days(now())) AND p.products_quantity>0 order by p.products_date_added desc limit " . MAX_DISPLAY_NEW_PRODUCTS);
//musej bejt na sklade          $new_products_query = tep_db_query("select unix_timestamp(p.products_date_available) as unixdate, m.manufacturers_name,  pd.products_description, pd.products_description_long, pd.products_description_long2, p.products_dotisk, p.products_id, p.products_image, p.products_tax_class_id, pd.products_name, if(s.status, s.specials_new_products_price, p.products_price) as products_price from " . TABLE_MANUFACTURERS . " m, " .  TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c where m.manufacturers_id = p.manufacturers_id AND  c.categories_status='1' and p.products_id = p2c.products_id and p2c.categories_id = c.categories_id and p.products_status = '1' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and (p.products_date_available is NULL OR to_days(p.products_date_available)< to_days(now())) AND p.products_quantity>0 order by UNIX_TIMESTAMP(p.products_date_added) desc limit " . MAX_DISPLAY_NEW_PRODUCTS);
          $new_products_query = tep_db_query("select unix_timestamp(p.products_date_available) as unixdate, m.manufacturers_name,  pd.products_description, pd.products_description_long, pd.products_description_long2, p.products_dotisk, p.products_id, p.products_image, p.products_tax_class_id, pd.products_name, if(s.status, s.specials_new_products_price, p.products_price) as products_price from " . TABLE_MANUFACTURERS . " m, " .  TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c where m.manufacturers_id = p.manufacturers_id AND  c.categories_status='1' and p.products_id = p2c.products_id and p2c.categories_id = c.categories_id and p.products_status = '1' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and (p.products_date_available is NULL OR to_days(p.products_date_available)< to_days(now())) order by UNIX_TIMESTAMP(p.products_date_added) desc limit " . MAX_DISPLAY_NEW_PRODUCTS);

// ######################## End Added Enable / Disable Categorie ################
  } else {
// ######################## Added Enable / Disable Categorie ################
    $new_products_query = tep_db_query("select distinct p.products_id, p.products_image, p.products_tax_class_id, pd.products_name, if(s.status, s.specials_new_products_price, p.products_price) as products_price from " . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c where c.categories_status='1' and p.products_id = p2c.products_id and p2c.categories_id = c.categories_id and c.parent_id = '" . (int)$new_products_category_id . "' and p.products_status = '1' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' order by rand() desc limit " . MAX_DISPLAY_NEW_PRODUCTS);
// ######################## End Added Enable / Disable Categorie ################
  }
  //TotalB2B end

 require(bts_select('column', 'new_products.php')); // BTSv1.5

?>
<!-- new_products_eof //-->