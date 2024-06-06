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
//  $info_box_contents = array();
//  $info_box_contents[] = array('text' => sprintf(TABLE_HEADING_NEW_PRODUCTS, strftime('%B')));

//  new contentBoxHeading($info_box_contents);
//echo  '<div class="categoriesH1">' .sprintf(TABLE_HEADING_NEW_PRODUCTS, strftime('%B')) . '</div>';
if ($f==1) $jmenof = 'ukázky';
if ($f==2) $jmenof = 'recenze';
if ($f==3) $jmenof = 'připravujeme';
if ($f==4) $jmenof = 'dotisk';

echo  '<div class="categoriesH1">' . $jmenof . '</div><br />';
if ($f==1) $new_products_query = tep_db_query("select p.products_date_added, unix_timestamp(p.products_date_available) AS upcoming, m.manufacturers_name,  pd.products_description, pd.products_description_long, pd.products_description_long2,  p.products_id, p.products_image, p.products_tax_class_id, pd.products_name, if(s.status, s.specials_new_products_price, p.products_price) as products_price, p.products_price as products_price_original from " . TABLE_MANUFACTURERS . " m, " .  TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c 
where pd.products_description_long !='' AND m.manufacturers_id = p.manufacturers_id AND c.categories_status='1' and p.products_id = p2c.products_id and p2c.categories_id = c.categories_id and p.products_status = '1' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' order by p.products_date_added DESC");
if ($f==2) 
$new_products_query = tep_db_query("select p.products_date_added, unix_timestamp(p.products_date_available) AS upcoming, m.manufacturers_name,  pd.products_description, pd.products_description_long, pd.products_description_long2,  p.products_id, p.products_image, p.products_tax_class_id, pd.products_name, if(s.status, s.specials_new_products_price, p.products_price) as products_price from " . TABLE_MANUFACTURERS . " m, " .  TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c 
where pd.products_description_long2 is not null AND m.manufacturers_id = p.manufacturers_id AND c.categories_status='1' and p.products_id = p2c.products_id and p2c.categories_id = c.categories_id and p.products_status = '1' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' order by p.products_date_added DESC");
//dotisk
if ($f==4) 
//    $new_products_query = tep_db_query("select distinct p.products_id, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_CATEGORIES . " c  where p.products_status = '1' and c.categories_status = '1'  and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' AND products_dotisk > 0 order by p.products_date_added desc, pd.products_name limit " . MAX_DISPLAY_BESTSELLERS);
$new_products_query = tep_db_query("select p.products_date_added, unix_timestamp(p.products_date_available) AS upcoming, m.manufacturers_name,  pd.products_description, pd.products_description_long, pd.products_description_long2,  p.products_id, p.products_image, p.products_tax_class_id, pd.products_name, if(s.status, s.specials_new_products_price, p.products_price) as products_price from " . TABLE_MANUFACTURERS . " m, " .  TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c 
where m.manufacturers_id = p.manufacturers_id AND c.categories_status='1' and p.products_id = p2c.products_id and p2c.categories_id = c.categories_id and p.products_status = '1' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' AND p.products_dotisk > 0 order by p.products_dotisk DESC");



 require(bts_select('column', 'new_products.php')); // BTSv1.5 
 
?>
<!-- new_products_eof //-->
