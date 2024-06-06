<?php
/*
  $Id: upcoming_products.php,v 1.24 2003/06/09 22:49:59 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

  $random_query = tep_db_query("select p.products_id, pd.products_name, pd.products_description, p.products_image  
                                  from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c, " . TABLE_PRODUCTS_DESCRIPTION . " pd 
                                  where c.categories_status='1' and products_status = '1' and p.products_id = p2c.products_id and p2c.categories_id = c.categories_id and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id 
                                  . "' order by rand() desc limit " . '2');

  if (tep_db_num_rows($random_query) > 0) {
?>
<!-- random_products //-->
  <br />
<?php
  $info_box_contents = array();
  $info_box_contents[] = array('text' => TABLE_HEADING_RANDOM_PRODUCTS);
  new contentBoxHeading($info_box_contents);

  $row = 0;
  $col = 0;
  $info_box_contents = array();
    while ($random = tep_db_fetch_array($random_query)) {

    $info_box_contents[$row][$col] = array('params' => 'class="CinquantaL"',
                                           'text' => '<a class="CinquantaL" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random['products_id']) . '">'
                                            . tep_image(DIR_WS_IMAGES . $random['products_image'], $random['products_name'], (SMALL_IMAGE_WIDTH * 2), (SMALL_IMAGE_HEIGHT * 2) ) 
                                            . '<br />'. $random['products_name'] . '</a>' . $random['products_description']
                                            . '<br class="Clear" />');

    $col ++;
      if ($col > 2) {
        $col = 0;
        $row ++;
      }
    }
    
  new contentBox($info_box_contents);
?> 
<br />
<!-- random_products_eof //-->
<?php
  }
?>