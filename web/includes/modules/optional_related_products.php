<?php

/*
  $Id: optional_related_products.php, ver 1.0 02/05/2007 Exp $

  Copyright (c) 2008 Anita Cross (http://www.callofthewildphoto.com/)

  Part of Contribution: Optional Related Products Ver 4.0

  Based on code from Optional Relate Products, ver 2.0 05/01/2005
  Copyright (c) 2004-2005 Daniel Bahna (daniel.bahna@gmail.com)

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Released under the GNU General Public License
*/
if (tep_not_null(RELATED_PRODUCTS_VERSION_INSTALLED) && (RELATED_PRODUCTS_VERSION_INSTALLED == '4.0')) {
  $orderBy = 'ORDER BY ';
  $orderBy .= (RELATED_PRODUCTS_RANDOMIZE)?'rand()':'pop_order_id, pop_id';
  $orderBy .= (RELATED_PRODUCTS_MAX_DISP)?' limit ' . RELATED_PRODUCTS_MAX_DISP:'';
  $attributes = "
         select
         pop_products_id_slave,
         products_name,
         products_model,
         products_price,
         products_quantity,
         products_tax_class_id,
         products_image
         from 
         " . TABLE_PRODUCTS_RELATED_PRODUCTS . ", 
         " . TABLE_PRODUCTS_DESCRIPTION . " pa, 
         " . TABLE_PRODUCTS . " pb,
         " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c,
         " . TABLE_CATEGORIES . " c
         where pop_products_id_slave = pa.products_id
         and pop_products_id_slave = p2c.products_id 
         and c.categories_id = p2c.categories_id
         and pa.products_id = pb.products_id
         and c.categories_status=1
         and language_id = '" . (int)$languages_id . "'
         and pop_products_id_master = '".$_GET['products_id']."'
         and products_status='1' " . $orderBy;

  $attribute_query = tep_db_query($attributes);

  if (mysql_num_rows($attribute_query)>0) {
  $count = 0;
?>
<?php new infoBoxHeading(array(array('text' => TEXT_RELATED_PRODUCTS))); ?> 
<div class="InfoBoxContenent2MABox">
<?php
    while ($attributes_values = tep_db_fetch_array($attribute_query)) {
      $products_name_slave = ($attributes_values['products_name']);
      $products_model_slave = ($attributes_values['products_model']);
      $products_qty_slave = ($attributes_values['products_quantity']);
      $products_id_slave = ($attributes_values['pop_products_id_slave']);
      if ($new_price = tep_get_products_special_price($products_id_slave)) {
// Michela modifica per TotalB2B
//        $products_price_slave = $currencies->display_price($new_price, tep_get_tax_rate($attributes_values['products_tax_class_id']));

        $products_price_slave = $currencies->display_price($products_id_slave, $new_price, tep_get_tax_rate($attributes_values['products_tax_class_id']));
      } else {
//        $products_price_slave = $currencies->display_price($attributes_values['products_price'], tep_get_tax_rate($attributes_values['products_tax_class_id']));
        $products_price_slave = $currencies->display_price($products_id_slave, $attributes_values['products_price'], tep_get_tax_rate($attributes_values['products_tax_class_id']));
      }
// Michela modifica per TotalB2B

      echo '<div class="TrentaTre">' . "\n";
      // show thumb image if Enabled
      if (RELATED_PRODUCTS_SHOW_THUMBS == 'True') {
        echo '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products_id_slave) . '">'
             . tep_image(DIR_WS_IMAGES . $attributes_values['products_image'], $attributes_values['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, '').'</a><br />' . "\n";
      }
      $caption = '';
      if (RELATED_PRODUCTS_SHOW_NAME == 'True') {
        $caption .= '<br />' . $products_name_slave;
        if (RELATED_PRODUCTS_SHOW_MODEL == 'True') {
          $caption .= sprintf(RELATED_PRODUCTS_MODEL_COMBO, $products_model_slave);
        }

      } elseif (RELATED_PRODUCTS_SHOW_MODEL == 'True') {
        $caption .=  '<br />' . $products_model_slave . "\n";
      }
      if (RELATED_PRODUCTS_SHOW_PRICE == 'True') {
        $caption .= '<br />' . sprintf(RELATED_PRODUCTS_PRICE_TEXT, $products_price_slave) . "\n";
      }
      if (RELATED_PRODUCTS_SHOW_QUANTITY == 'True') {
        $caption .= '<br />' . sprintf(RELATED_PRODUCTS_QUANTITY_TEXT, $products_qty_slave) . "\n";
      }
      echo '<a href="'
                        . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products_id_slave) . '">'
                        . $caption . '</a>' . "\n";
      if (RELATED_PRODUCTS_SHOW_BUY_NOW== 'True') {
        echo '<a href="'
                        . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action'))
                        . 'action=rp_buy_now&amp;rp_products_id=' . $products_id_slave) . '"><br /><br />'
                        . tep_image_button('button_buy_now.png', IMAGE_BUTTON_BUY_NOW) . '</a>';
      }
      echo '</div><br />' . "\n";
      $count++;
      if ((RELATED_PRODUCTS_USE_ROWS == 'True') && ($count%RELATED_PRODUCTS_PER_ROW == 0)) {
        echo '' . "\n";
      }
    }
    echo '<br class="Clear" /><br /></div>';
}
}
?>