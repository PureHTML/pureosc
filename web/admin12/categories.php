<?php
//nastaveni kategorie filtru pro sekundarni kategorie:
//jsp:config
$categorystart = 461;  //produkty //462 = zanacky

/*
  $Id: categories.php,v 1.146 2003/07/11 14:40:27 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();

  $action = (isset($_GET['action']) ? $_GET['action'] : '');

// seo url
 if ( eregi("(insert|update|setflag)", $action) ) include_once('includes/reset_seo_cache.php');

// BOF: KategorienAdmin / OLISWISS
    $admin_access_query = tep_db_query("select admin_groups_id, admin_cat_access, admin_right_access from " . TABLE_ADMIN . " where admin_id=" . $login_id);
    $admin_access_array = tep_db_fetch_array($admin_access_query);
    $admin_groups_id = $admin_access_array['admin_groups_id'];
    $admin_cat_access = $admin_access_array['admin_cat_access'];
    $admin_cat_access_array_cats = explode(",",$admin_cat_access);
    $admin_right_access = $admin_access_array['admin_right_access'];
// EOF: KategorienAdmin / OLISWISS

  if (tep_not_null($action)) {
    switch ($action) {
      case 'setflag':
        if ( ($_GET['flag'] == '0') || ($_GET['flag'] == '1') ) {
          if (isset($_GET['pID'])) {
            tep_set_product_status($_GET['pID'], $_GET['flag']);
          }

          if (USE_CACHE == 'true') {
            tep_reset_cache_block('categories');
            tep_reset_cache_block('also_purchased');
          }
        }

        tep_redirect(tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $_GET['cPath'] . '&pID=' . $_GET['pID']));
        break;
// ####################### Added Categories Enable / Disable ###############
      case 'setflag_cat':
        if ( ($_GET['flag'] == '0') || ($_GET['flag'] == '1') ) {
          if (isset($_GET['cID'])) {
            tep_set_categories_status($_GET['cID'], $_GET['flag']);
          }

          if (USE_CACHE == 'true') {
            tep_reset_cache_block('categories');
            tep_reset_cache_block('also_purchased');
          }
        }

    tep_redirect(tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $_GET['cPath'] . '&cID=' . $_GET['cID']));
    break;
// ####################### End Categories Enable / Disable ###############
      case 'insert_category':
      case 'update_category':
        if (isset($_POST['categories_id'])) $categories_id = tep_db_prepare_input($_POST['categories_id']);
        $sort_order = tep_db_prepare_input($_POST['sort_order']);

// ####################### Added Categories Enable / Disable ###############
//      $sql_data_array = array('sort_order' => (int)$sort_order);
        $categories_status = tep_db_prepare_input($_POST['categories_status']);
        $sql_data_array = array('sort_order' => (int)$sort_order, 'categories_status' => $categories_status);
// ####################### End Added Categories Enable / Disable ###############

        if ($action == 'insert_category') {
          $insert_sql_data = array('parent_id' => $current_category_id,
                                   'date_added' => 'now()');

          $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

          tep_db_perform(TABLE_CATEGORIES, $sql_data_array);

          $categories_id = tep_db_insert_id();
          
// BOF: KategorienAdmin / OLI
    if (in_array("ALL",$admin_cat_access_array_cats)== false) {
      array_push($admin_cat_access_array_cats,$categories_id);
      $admin_cat_access = implode(",",$admin_cat_access_array_cats);
          $sql_data_array = array('admin_cat_access' => tep_db_prepare_input($admin_cat_access));
          tep_db_perform(TABLE_ADMIN, $sql_data_array, 'update', 'admin_id = \'' . $login_id . '\'');
        }
// EOF: KategorienAdmin / OLI 
          
        } elseif ($action == 'update_category') {
          $update_sql_data = array('last_modified' => 'now()');

          $sql_data_array = array_merge($sql_data_array, $update_sql_data);

          tep_db_perform(TABLE_CATEGORIES, $sql_data_array, 'update', "categories_id = '" . (int)$categories_id . "'");
        }

        $languages = tep_get_languages();
        for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
          $categories_name_array = $_POST['categories_name'];

          $language_id = $languages[$i]['id'];

          $sql_data_array = array('categories_name' => tep_db_prepare_input($categories_name_array[$language_id]));
	// - START - Category Descriptions
          $categories_heading_title_array = $HTTP_POST_VARS['categories_heading_title'];
          $categories_description_array = $HTTP_POST_VARS['categories_description'];
          $sql_data_array['categories_heading_title'] =  tep_db_prepare_input($categories_heading_title_array[$language_id]);
          $sql_data_array['categories_description'] =  tep_db_prepare_input($categories_description_array[$language_id]);
	// --- END - Category Descriptions


          if ($action == 'insert_category') {
            $insert_sql_data = array('categories_id' => $categories_id,
                                     'language_id' => $languages[$i]['id']);

            $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

            tep_db_perform(TABLE_CATEGORIES_DESCRIPTION, $sql_data_array);
          } elseif ($action == 'update_category') {
            tep_db_perform(TABLE_CATEGORIES_DESCRIPTION, $sql_data_array, 'update', "categories_id = '" . (int)$categories_id . "' and language_id = '" . (int)$languages[$i]['id'] . "'");
          }
        }

        $categories_image = new upload('categories_image');
        $categories_image->set_destination(DIR_FS_CATALOG_IMAGES);

        if ($categories_image->parse() && $categories_image->save()) {
          tep_db_query("update " . TABLE_CATEGORIES . " set categories_image = '" . tep_db_input($categories_image->filename) . "' where categories_id = '" . (int)$categories_id . "'"); 
        }
        // correct BUG www.oscommerce.com
//        if ($categories_image = new upload('categories_image', DIR_FS_CATALOG_IMAGES)) {
//          tep_db_query("update " . TABLE_CATEGORIES . " set categories_image = '" . tep_db_input($categories_image->filename) . "' where categories_id = '" . (int)$categories_id . "'");
//        }

// JUST SPIFFY Category Descriptions
         $text_cat_descript= tep_db_prepare_input($_POST['text_cat_descript']);
         $sql_data_array = array('category_description' => $text_cat_descript);
         $cat_descript_query = tep_db_query ("select category_description from " . TABLE_CAT_DESCRIPT . " where categories_id = '" . (int)$categories_id . "'");
         if (!tep_db_num_rows($cat_descript_query)) {
            $insert_sql_data = array('categories_id' => $categories_id);
            $sql_data_array = array_merge($sql_data_array, $insert_sql_data);
            tep_db_perform(TABLE_CAT_DESCRIPT, $sql_data_array);
         } else {
           tep_db_perform(TABLE_CAT_DESCRIPT, $sql_data_array, 'update', "categories_id = '" . (int)$categories_id . "'");
         }
// END JUST SPIFFY Category Descriptions

        if (USE_CACHE == 'true') {
          tep_reset_cache_block('categories');
          tep_reset_cache_block('also_purchased');
        }

        tep_redirect(tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&cID=' . $categories_id));
        break;
      case 'delete_category_confirm':
        if (isset($_POST['categories_id'])) {
          $categories_id = tep_db_prepare_input($_POST['categories_id']);

// BOF: KategorienAdmin / OLI 
        //$categories = tep_get_category_tree($categories_id, '', '0', '',true);
          $categories = tep_get_category_tree($categories_id, '', '0', '', '',true);
// EOF: KategorienAdmin / OLI 

          $products = array();
          $products_delete = array();

          for ($i=0, $n=sizeof($categories); $i<$n; $i++) {
            $product_ids_query = tep_db_query("select products_id from " . TABLE_PRODUCTS_TO_CATEGORIES . " where categories_id = '" . (int)$categories[$i]['id'] . "'");

            while ($product_ids = tep_db_fetch_array($product_ids_query)) {
              $products[$product_ids['products_id']]['categories'][] = $categories[$i]['id'];
            }
          }

          reset($products);
          while (list($key, $value) = each($products)) {
            $category_ids = '';

            for ($i=0, $n=sizeof($value['categories']); $i<$n; $i++) {
              $category_ids .= "'" . (int)$value['categories'][$i] . "', ";
            }
            $category_ids = substr($category_ids, 0, -2);

            $check_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_TO_CATEGORIES . " where products_id = '" . (int)$key . "' and categories_id not in (" . $category_ids . ")");
            $check = tep_db_fetch_array($check_query);
            if ($check['total'] < '1') {
              $products_delete[$key] = $key;
            }
          }

// removing categories can be a lengthy process
          tep_set_time_limit(0);
          for ($i=0, $n=sizeof($categories); $i<$n; $i++) {
            tep_remove_category($categories[$i]['id']);
// JUST SPIFFY Category Descriptions
         tep_db_query ("delete from " . TABLE_CAT_DESCRIPT . " where categories_id = '" . $categories[$i]['id'] . "'");
// END JUST SPIFFY Category Descriptions
          }

          reset($products_delete);
          while (list($key) = each($products_delete)) {
            tep_remove_product($key);
          }
        }

        if (USE_CACHE == 'true') {
          tep_reset_cache_block('categories');
          tep_reset_cache_block('also_purchased');
        }

        tep_redirect(tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath));
        break;
      case 'delete_product_confirm':
        if (isset($_POST['products_id']) && isset($_POST['product_categories']) && is_array($_POST['product_categories'])) {
          $product_id = tep_db_prepare_input($_POST['products_id']);
          $product_categories = $_POST['product_categories'];

          for ($i=0, $n=sizeof($product_categories); $i<$n; $i++) {
            tep_db_query("delete from " . TABLE_PRODUCTS_TO_CATEGORIES . " where products_id = '" . (int)$product_id . "' and categories_id = '" . (int)$product_categories[$i] . "'");
          }

          $product_categories_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_TO_CATEGORIES . " where products_id = '" . (int)$product_id . "'");
          $product_categories = tep_db_fetch_array($product_categories_query);

          if ($product_categories['total'] == '0') {
            tep_remove_product($product_id);

        /* Optional Related Products (ORP) */
          $products_related_product = tep_db_fetch_array(tep_db_query("SHOW TABLES LIKE '" . TABLE_PRODUCTS_RELATED_PRODUCTS . "'"));
          if (tep_not_null($products_related_product)) {
            tep_db_query("delete from " . TABLE_PRODUCTS_RELATED_PRODUCTS . " where pop_products_id_master = '" . (int)$product_id . "'");
            tep_db_query("delete from " . TABLE_PRODUCTS_RELATED_PRODUCTS . " where pop_products_id_slave = '" . (int)$product_id . "'");
          }
        //ORP: end

          }
        }

        if (USE_CACHE == 'true') {
          tep_reset_cache_block('categories');
          tep_reset_cache_block('also_purchased');
        }

        tep_redirect(tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath));
        break;
      case 'move_category_confirm':
        if (isset($_POST['categories_id']) && ($_POST['categories_id'] != $_POST['move_to_category_id'])) {
          $categories_id = tep_db_prepare_input($_POST['categories_id']);
          $new_parent_id = tep_db_prepare_input($_POST['move_to_category_id']);

          $path = explode('_', tep_get_generated_category_path_ids($new_parent_id));

          if (in_array($categories_id, $path)) {
            $messageStack->add_session(ERROR_CANNOT_MOVE_CATEGORY_TO_PARENT, 'error');

            tep_redirect(tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&cID=' . $categories_id));
          } else {
            tep_db_query("update " . TABLE_CATEGORIES . " set parent_id = '" . (int)$new_parent_id . "', last_modified = now() where categories_id = '" . (int)$categories_id . "'");

            if (USE_CACHE == 'true') {
              tep_reset_cache_block('categories');
              tep_reset_cache_block('also_purchased');
            }

            tep_redirect(tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $new_parent_id . '&cID=' . $categories_id));
          }
        }

        break;
      case 'move_product_confirm':
        $products_id = tep_db_prepare_input($_POST['products_id']);
        $new_parent_id = tep_db_prepare_input($_POST['move_to_category_id']);

        $duplicate_check_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_TO_CATEGORIES . " where products_id = '" . (int)$products_id . "' and categories_id = '" . (int)$new_parent_id . "'");
        $duplicate_check = tep_db_fetch_array($duplicate_check_query);
        if ($duplicate_check['total'] < 1) tep_db_query("update " . TABLE_PRODUCTS_TO_CATEGORIES . " set categories_id = '" . (int)$new_parent_id . "' where products_id = '" . (int)$products_id . "' and categories_id = '" . (int)$current_category_id . "'");

        if (USE_CACHE == 'true') {
          tep_reset_cache_block('categories');
          tep_reset_cache_block('also_purchased');
        }

        tep_redirect(tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $new_parent_id . '&pID=' . $products_id));
        break;
      case 'insert_product':
      case 'update_product':
        if (isset($_POST['edit_x']) || isset($_POST['edit_y'])) {
          $action = 'new_product';
        } else {
          if (isset($_GET['pID'])) $products_id = tep_db_prepare_input($_GET['pID']);
          $products_date_available = tep_db_prepare_input($_POST['products_date_available']);

          $products_date_available = (date('Y-m-d') < $products_date_available) ? $products_date_available : 'null';

          $sql_data_array = array('products_quantity' => (int)tep_db_prepare_input($_POST['products_quantity']),
                                  'products_model' => tep_db_prepare_input($_POST['products_model']),
                                  'products_price' => tep_db_prepare_input($_POST['products_price']),
                                  'products_cost' => tep_db_prepare_input($_POST['products_cost']),
                                  'products_date_available' => $products_date_available,
                                  'products_weight' => (float)tep_db_prepare_input($_POST['products_weight']),
                                  // attribute 
                                  'products_codebar' => tep_db_prepare_input($_POST['products_codebar']),                    
                                  'products_height' => (float)tep_db_prepare_input($_POST['products_height']),
                                  'products_length' => (float)tep_db_prepare_input($_POST['products_length']),
                                  'products_width' => (float)tep_db_prepare_input($_POST['products_width']),
                                  'products_ready_to_ship' => tep_db_prepare_input($_POST['products_ready_to_ship']),
                                  // attribute end
                                  'products_status' => tep_db_prepare_input($_POST['products_status']),
                                  'products_tax_class_id' => tep_db_prepare_input($_POST['products_tax_class_id']),
                                  'manufacturers_id' => (int)tep_db_prepare_input($_POST['manufacturers_id']),
                                  'products_to_rss' => tep_db_prepare_input($_POST['products_to_rss']));

         //TotalB2B start
         $prices_num = tep_xppp_getpricesnum();
         for ($i=2; $i<=$prices_num; $i++) {
            if (tep_db_prepare_input($_POST['checkbox_products_price_' . $i]) != "true")
               $sql_data_array['products_price_' . $i] = 'null';
            else
               $sql_data_array['products_price_' . $i] = tep_db_prepare_input($_POST['products_price_' . $i]);
         }
         //TotalB2B end

          if (isset($_POST['products_image']) && tep_not_null($_POST['products_image']) && ($_POST['products_image'] != 'none')) {
            $sql_data_array['products_image'] = tep_db_prepare_input($_POST['products_image']);
          }

          if ($action == 'insert_product') {
            $insert_sql_data = array('products_date_added' => 'now()');

            $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

            tep_db_perform(TABLE_PRODUCTS, $sql_data_array);
            $products_id = tep_db_insert_id();

            tep_db_query("insert into " . TABLE_PRODUCTS_TO_CATEGORIES . " (products_id, categories_id) values ('" . (int)$products_id . "', '" . (int)$current_category_id . "')");
          } elseif ($action == 'update_product') {
            $update_sql_data = array('products_last_modified' => 'now()');

            $sql_data_array = array_merge($sql_data_array, $update_sql_data);

            tep_db_perform(TABLE_PRODUCTS, $sql_data_array, 'update', "products_id = '" . (int)$products_id . "'");
          }

//060417/zepitt/multi images extra/modif # 1
//sql instructions to create or update product
unset($sql_data_array);

for($nb=1; $nb <= NB_IMAGE_EXTRA ; $nb++) {
  $var_delete_image = "delete_image".$nb;
  $product_img_to_delete = tep_db_query("select products_image".$nb . " FROM " . TABLE_PRODUCTS_IMAGES . " WHERE products_id = '" . (int)$products_id . "'");
  $product_img_to_delete_x = tep_db_fetch_array($product_img_to_delete);
  $var_products_image = "products_image".$nb;
  if ($_POST[$var_delete_image] == 'yes') {
    @unlink(DIR_FS_CATALOG_IMAGES . 'images_extra/' . $product_img_to_delete_x['products_image' . $nb]);
    $sql_data_array[$var_products_image] = tep_db_prepare_input($_POST['none']);
  }
  else if (isset($_POST[$var_products_image]) && tep_not_null($_POST[$var_products_image]) && ($_POST[$var_products_image] != 'none')) {
    $sql_data_array[$var_products_image] = tep_db_prepare_input($_POST[$var_products_image]);
  }
}
$insert_sql_data = array('products_id' => $products_id);
if(isset($sql_data_array)) $sql_data_array = array_merge($sql_data_array, $insert_sql_data);
if(isset($sql_data_array)) tep_db_perform(TABLE_PRODUCTS_IMAGES, $sql_data_array, 'replace');
//060417/zepitt/multi images extra EOF

          $languages = tep_get_languages();
          for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
            $language_id = $languages[$i]['id'];

            $sql_data_array = array('products_name' => tep_db_prepare_input($_POST['products_name'][$language_id]),
                                    'products_description' => tep_db_prepare_input($_POST['products_description'][$language_id]),
                                    'products_url' => tep_db_prepare_input($_POST['products_url'][$language_id]));

            if ($action == 'insert_product') {
              $insert_sql_data = array('products_id' => $products_id,
                                       'language_id' => $language_id);

              $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

              tep_db_perform(TABLE_PRODUCTS_DESCRIPTION, $sql_data_array);
            } elseif ($action == 'update_product') {
              tep_db_perform(TABLE_PRODUCTS_DESCRIPTION, $sql_data_array, 'update', "products_id = '" . (int)$products_id . "' and language_id = '" . (int)$language_id . "'");
            }
          }

          if (USE_CACHE == 'true') {
            tep_reset_cache_block('categories');
            tep_reset_cache_block('also_purchased');
          }

          tep_redirect(tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $products_id));
        }
        break;
      case 'copy_to_confirm':
        if (isset($_POST['products_id']) && isset($_POST['categories_id'])) {
          $products_id = tep_db_prepare_input($_POST['products_id']);
          $categories_id = tep_db_prepare_input($_POST['categories_id']);

          if ($_POST['copy_as'] == 'link') {
            if ($categories_id != $current_category_id) {
              $check_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_TO_CATEGORIES . " where products_id = '" . (int)$products_id . "' and categories_id = '" . (int)$categories_id . "'");
              $check = tep_db_fetch_array($check_query);
              if ($check['total'] < '1') {
                tep_db_query("insert into " . TABLE_PRODUCTS_TO_CATEGORIES . " (products_id, categories_id) values ('" . (int)$products_id . "', '" . (int)$categories_id . "')");
              }
            } else {
              $messageStack->add_session(ERROR_CANNOT_LINK_TO_SAME_CATEGORY, 'error');
            }
//060417/zepitt/multi images extra/modif #02
// update sql copy or duplicate an item
          } elseif ($_POST['copy_as'] == 'duplicate') {
            
            //TotalB2B start
            $products_price_list = tep_xppp_getpricelist("");
     
      $product_query = tep_db_query("SELECT p.products_quantity, p.products_model,
                p.products_image, p." . $products_price_list . ", products_cost,
        p.products_date_available, p.products_weight,
        p.products_codebar,
        p.products_length, p.products_width, p.products_height, p.products_ready_to_ship, 
                p.products_tax_class_id, p.manufacturers_id, 
                pi.products_image1, pi.products_image2, pi.products_image3, pi.products_image4, pi.products_image5, 
                pi.products_image6, pi.products_image7, pi.products_image8, pi.products_image9
                , p.products_to_rss
                FROM (".TABLE_PRODUCTS." p LEFT JOIN ".TABLE_PRODUCTS_IMAGES." pi ON p.products_id = pi.products_id) 
                WHERE p.products_id = '".(int)$products_id."'");

      $product = tep_db_fetch_array($product_query);

            $prices_num = tep_xppp_getpricesnum();
            for($i=2; $i<=$prices_num; $i++) {
               if ($product['products_price_' . $i] == NULL) $products_instval .= "NULL, ";
               else $products_instval .= "'" . tep_db_input($product['products_price_' . $i]) . "', ";
            }
            $products_instval .= "'" . tep_db_input($product['products_price']) . "' ";
//jsp:fix .... missing this:     tep_db_input($product['products_cost']) . "', '" ..

      tep_db_query("INSERT INTO " . TABLE_PRODUCTS . " 
          (products_quantity, products_codebar, products_length, products_width, products_height, products_ready_to_ship,
        products_model, products_image, ". $products_price_list . ", products_cost, products_date_added, products_date_available, 
          products_weight, products_status, products_tax_class_id, manufacturers_id, products_to_rss) 
          VALUES ('" . 
          tep_db_input($product['products_quantity']) . "', '" . 
          tep_db_input($product['products_cost']) . "', '" . 
        tep_db_input($product['products_codebar']) . "', '" .
        tep_db_input($product['products_length']) . "', '" .
        tep_db_input($product['products_width']) . "', '" .
        tep_db_input($product['products_height']) . "', '" .
        tep_db_input($product['products_ready_to_ship']) . "', '" .
          tep_db_input($product['products_model']) . "', '" . 
        tep_db_input($product['products_image']) . "', " .
        $products_instval 
        . ", now(), '" .
        tep_db_input($product['products_date_available']) .  "', '" .
        tep_db_input($product['products_weight'])  . "', '" .
     //    tep_db_input($product['products_price']) . "',  now(), '" . 
          (int)$product['products_status'] . "', '" . 
          (int)$product['products_tax_class_id'] . "', '" . 
        (int)$product['products_to_rss'] . "', '" .
          (int)$product['manufacturers_id'] . "')");
            $dup_products_id = tep_db_insert_id();
            //TotalB2B end
     
      tep_db_query("INSERT INTO " . TABLE_PRODUCTS_IMAGES . " 
          (products_id, products_image1, products_image2, products_image3, products_image4, products_image5, 
          products_image6, products_image7, products_image8, products_image9) 
          VALUES ('" . 
          (int)$dup_products_id . "', '" . 
          tep_db_input($product['products_image1']) . "', '" . 
          tep_db_input($product['products_image2']) . "', '" . 
          tep_db_input($product['products_image3']) . "', '" . 
          tep_db_input($product['products_image4']) . "', '" . 
          tep_db_input($product['products_image5']) . "', '" . 
          tep_db_input($product['products_image6']) . "', '" . 
          tep_db_input($product['products_image7']) . "', '" . 
          tep_db_input($product['products_image8']) . "', '" . 
          tep_db_input($product['products_image9']) . "')");
      
//060417/zepitt/multi images extra EOF

            $description_query = tep_db_query("select language_id, products_name, products_description, products_url from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$products_id . "'");
            while ($description = tep_db_fetch_array($description_query)) {
              tep_db_query("insert into " . TABLE_PRODUCTS_DESCRIPTION . " (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('" . (int)$dup_products_id . "', '" . (int)$description['language_id'] . "', '" . tep_db_input($description['products_name']) . "', '" . tep_db_input($description['products_description']) . "', '" . tep_db_input($description['products_url']) . "', '0')");
            }

            tep_db_query("insert into " . TABLE_PRODUCTS_TO_CATEGORIES . " (products_id, categories_id) values ('" . (int)$dup_products_id . "', '" . (int)$categories_id . "')");
            $products_id = $dup_products_id;
          }

          if (USE_CACHE == 'true') {
            tep_reset_cache_block('categories');
            tep_reset_cache_block('also_purchased');
          }
        }

        tep_redirect(tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $categories_id . '&pID=' . $products_id));
        break;
      case 'new_product_preview':
// copy image only if modified
        $products_image = new upload('products_image');
        $products_image->set_destination(DIR_FS_CATALOG_IMAGES);
        if ($products_image->parse() && $products_image->save()) {
          $products_image_name = $products_image->filename;
        } else {
          $products_image_name = (isset($_POST['products_previous_image']) ? $_POST['products_previous_image'] : '');
        }

//060417/zepitt/multi images extra #03
// update images for preview

for($nb=1; $nb <= NB_IMAGE_EXTRA ; $nb++) {
    $var_products_image = "products_image".$nb;
    $var_products_image_name = "products_image".$nb."_name";
    $var_products_previous_image = "products_previous_image".$nb;
    $var_delete_image = "delete_image".$nb;
    
    $$var_products_image = new upload($var_products_image);
    $$var_products_image->set_destination(DIR_FS_CATALOG . 'images/images_extra/');
    if ($_POST[$var_delete_image] == 'yes') { $$var_products_image_name = ""; }
    else {
        if ($$var_products_image->parse() && $$var_products_image->save()) {
          $$var_products_image_name = $$var_products_image->filename;
        } else {
            $$var_products_image_name = (isset($_POST[$var_products_previous_image]) ? $_POST[$var_products_previous_image] : '');
      }
    }
}
//060417/zepitt/multi images extra EOF
        break;
    }
  }

// check if the catalog image directory exists
  if (is_dir(DIR_FS_CATALOG_IMAGES)) {
    if (!is_writeable(DIR_FS_CATALOG_IMAGES)) $messageStack->add(ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE, 'error');
  } else {

//060417/zepitt/multi images extra #04
  }
    if (is_dir(DIR_FS_CATALOG . 'images/images_extra/')) {
    if (!is_writeable(DIR_FS_CATALOG . 'images/images_extra/')) $messageStack->add(ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE, 'error');
  } else {
    $messageStack->add(ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST, 'error');
  }
//060417/zepitt/multi images extra EOF
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>"/>
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css" />
<script type="text/javascript" src="includes/general.js"></script>
<?php if (WEB_EDITOR_LIST == 'htmlarea'){ ?>
    <script type="text/javascript">
          _editor_url = "includes/javascript/htmlarea/";
          _editor_lang = "en";
    </script>
    <script type="text/javascript" src="includes/javascript/htmlarea/htmlarea.js"></script>
<?php } elseif (WEB_EDITOR_LIST == 'tiny_mce') { ?>
<script type="text/javascript" src="includes/javascript/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({
    mode : "textareas",
    theme : "advanced",
    plugins : "style,layer,table,save,advhr,advimage,advlink,iespell,insertdatetime,preview,zoom,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras",
    theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,fontselect,fontsizeselect",
    theme_advanced_buttons2 : "cut,copy,paste,|,search,replace,|,bullist,numlist,|,outdent,indent,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,preview,|,forecolor,backcolor",
    theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
    theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars",
    theme_advanced_toolbar_location : "top",
    theme_advanced_toolbar_align : "left",
    theme_advanced_path_location : "bottom",
    extended_valid_elements : "a[name|href|target|title|onclick],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],hr[class|width|size|noshade],font[face|size|color|style],span[class|align|style]",
    template_external_list_url : "example_template_list.js"
});
</script>
<?php } ?>
</head>
<?php if (WEB_EDITOR_LIST == 'htmlarea'){ ?>
<body style="margin:0;" onload="SetFocus();HTMLArea.replace('description0');HTMLArea.replace('description1');HTMLArea.replace('description2');HTMLArea.replace('description3');HTMLArea.replace('description4');HTMLArea.replace('description5');">
<?php } else { ?>
<body style="margin:0;" onload="SetFocus();">
<?php } ?>
<div id="spiffycalendar" class="text"></div>
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
    <td width="100%" valign="top">
<?php
  if ($action == 'new_product') {
    $parameters = array('products_name' => '',
                       'products_description' => '',
                       'products_url' => '',
                       'products_id' => '',
                       'products_quantity' => '',
                       'products_model' => '',
                       'products_image' => '',
                       //060417/zepitt/multi images extra #05
                       'products_image1' => '', 
                       'products_image2' => '', 
                       'products_image3' => '', 
                       'products_image4' => '', 
                       'products_image5' => '', 
                       'products_image6' => '', 
                       'products_image7' => '', 
                       'products_image8' => '', 
                       'products_image9' => '', 
                       //060417/zepitt/multi images extra EOF
                       'products_price' => '',
                       'products_cost' => '',
                       'products_weight' => '',
                       'products_length' => '',
                       // attribute
                       'products_codebar' => '',
                       'products_width' => '',
                       'products_height' => '',
                       'products_ready_to_ship' => '',
                       'products_date_added' => '',
                       'products_last_modified' => '',
                       'products_date_available' => '',
                       'products_status' => '',
                       'products_tax_class_id' => '',
                       'manufacturers_id' => '',
                       'products_to_rss' => '');

//TotalB2B start
  $prices_num = tep_xppp_getpricesnum();
    for ($i=2; $i<=$prices_num; $i++) {
  $parameters['products_price_' . $i] = '';
}
    //TotalB2B start

    $pInfo = new objectInfo($parameters);


//060417/zepitt/multi images extra #06
    if (isset($_GET['pID']) && empty($_POST)) {

      //TotalB2B start
      $products_price_list = tep_xppp_getpricelist("p");


      $product_query = tep_db_query("SELECT pd.products_name, pd.products_description,
                pd.products_url, p.products_id, p.products_quantity, p.products_model,
                p.products_image, " . $products_price_list . ", p.products_cost, p.products_weight, p.products_date_added,
                p.products_last_modified, date_format(p.products_date_available, '%Y-%m-%d') as
                products_date_available, p.products_status, p.products_tax_class_id,
                p.manufacturers_id, 
                p.products_to_rss, 
                p.products_codebar,
        p.products_length, p.products_width, p.products_height, p.products_ready_to_ship, 
                pi.products_image1, pi.products_image2, pi.products_image3, pi.products_image3, pi.products_image4, pi.products_image5, 
                pi.products_image6, pi.products_image7, pi.products_image8, pi.products_image9
                FROM (".TABLE_PRODUCTS." p LEFT JOIN ".TABLE_PRODUCTS_IMAGES." pi ON p.products_id = pi.products_id) 
                INNER JOIN ".TABLE_PRODUCTS_DESCRIPTION." pd ON p.products_id = pd.products_id
                WHERE p.products_id = '" . (int)$_GET['pID'] . "' 
                AND pd.language_id = '".(int)$languages_id."'");
      //TotalB2B end

//060417/zepitt/multi images extra EOF  

      $product = tep_db_fetch_array($product_query);

      $pInfo->objectInfo($product);
    } elseif (tep_not_null($_POST)) {
      $pInfo->objectInfo($_POST);
      $products_name = $_POST['products_name'];
      $products_description = $_POST['products_description'];
      $products_url = $_POST['products_url'];
    }

    $manufacturers_array = array(array('id' => '', 'text' => TEXT_NONE));
    $manufacturers_query = tep_db_query("select manufacturers_id, manufacturers_name from " . TABLE_MANUFACTURERS . " order by manufacturers_name");
    while ($manufacturers = tep_db_fetch_array($manufacturers_query)) {
      $manufacturers_array[] = array('id' => $manufacturers['manufacturers_id'],
                                     'text' => $manufacturers['manufacturers_name']);
    }

    $tax_class_array = array(array('id' => '0', 'text' => TEXT_NONE));
    $tax_class_query = tep_db_query("select tax_class_id, tax_class_title from " . TABLE_TAX_CLASS . " order by tax_class_title");
    while ($tax_class = tep_db_fetch_array($tax_class_query)) {
      $tax_class_array[] = array('id' => $tax_class['tax_class_id'],
                                 'text' => $tax_class['tax_class_title']);
    }

    $languages = tep_get_languages();

    if (!isset($pInfo->products_status)) $pInfo->products_status = '1';
    switch ($pInfo->products_status) {
      case '0': $in_status = false; $out_status = true; break;
      case '1':
      default: $in_status = true; $out_status = false;
    }
?>
<link rel="stylesheet" type="text/css" href="includes/javascript/spiffyCal/spiffyCal_v2_1.css" />
<script type="text/javascript" src="includes/javascript/spiffyCal/spiffyCal_v2_1.js"></script>
<script type="text/javascript"><!--
  var dateAvailable = new ctlSpiffyCalendarBox("dateAvailable", "new_product", "products_date_available","btnDate1","<?php echo $pInfo->products_date_available; ?>",scBTNMODE_CUSTOMBLUE);
//--></script>
<script type="text/javascript"><!--
var tax_rates = new Array();
<?php
    for ($i=0, $n=sizeof($tax_class_array); $i<$n; $i++) {
      if ($tax_class_array[$i]['id'] > 0) {
        echo 'tax_rates["' . $tax_class_array[$i]['id'] . '"] = ' . tep_get_tax_rate_value($tax_class_array[$i]['id']) . ';' . "\n";
      }
    }
?>

function doRound(x, places) {
  return Math.round(x * Math.pow(10, places)) / Math.pow(10, places);
}

function getTaxRate() {
  var selected_value = document.forms["new_product"].products_tax_class_id.selectedIndex;
  var parameterVal = document.forms["new_product"].products_tax_class_id[selected_value].value;

  if ( (parameterVal > 0) && (tax_rates[parameterVal] > 0) ) {
    return tax_rates[parameterVal];
  } else {
    return 0;
  }
}

//TotalB2B start
function updateGross(products_price_t) {
  var taxRate = getTaxRate(products_price_t);
  var grossValue = document.forms["new_product"].elements[products_price_t].value;

  if (taxRate > 0) {
    grossValue = grossValue * ((taxRate / 100) + 1);
  }

  var products_price_gross_t = products_price_t + "_gross";
  
  document.forms["new_product"].elements[products_price_gross_t].value = doRound(grossValue, 4);
}

function updateNet(products_price_t) {
  var taxRate = getTaxRate();
  var products_price_gross_t = products_price_t + "_gross";
  var netValue = document.forms["new_product"].elements[products_price_gross_t].value;

  if (taxRate > 0) {
    netValue = netValue / ((taxRate / 100) + 1);
  }

  document.forms["new_product"].elements[products_price_t].value = doRound(netValue, 4);
}
//TotalB2B end

//--></script>
    <?php echo tep_draw_form('new_product', FILENAME_CATEGORIES, 'cPath=' . $cPath . (isset($_GET['pID']) ? '&amp;pID=' . $_GET['pID'] : '') . '&amp;action=new_product_preview', 'post', 'enctype="multipart/form-data"'); ?>
    <table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo TEXT_NEW_PRODUCT . '&nbsp;' . sprintf(tep_output_generated_category_path($current_category_id)); ?> >.</b></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.png', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.png', '1', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><?php echo TEXT_PRODUCTS_STATUS; ?></td>
            <td class="main"><?php echo tep_draw_separator('pixel_trans.png', '24', '15') . '&nbsp;' . tep_draw_radio_field('products_status', '1', $in_status) . '&nbsp;' . TEXT_PRODUCT_AVAILABLE . '&nbsp;' . tep_draw_radio_field('products_status', '0', $out_status) . '&nbsp;' . TEXT_PRODUCT_NOT_AVAILABLE; ?></td>
          </tr>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.png', '1', '10'); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo TEXT_PRODUCTS_DATE_AVAILABLE; ?><br /><small>(YYYY-MM-DD)</small></td>
            <td class="main"><?php echo tep_draw_separator('pixel_trans.png', '24', '15') . '&nbsp;'; ?><script type="text/javascript">dateAvailable.writeControl(); dateAvailable.dateFormat="yyyy-MM-dd";</script></td>
          </tr>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.png', '1', '10'); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo TEXT_PRODUCTS_MANUFACTURER; ?></td>
            <td class="main"><?php echo tep_draw_separator('pixel_trans.png', '24', '15') . '&nbsp;' . tep_draw_pull_down_menu('manufacturers_id', $manufacturers_array, $pInfo->manufacturers_id); ?></td>
          </tr>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.png', '1', '10'); ?></td>
          </tr>
<?php
    for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
?>
          <tr>
            <td class="main"><?php if ($i == 0) echo TEXT_PRODUCTS_NAME; ?></td>
            <td class="main"><?php echo tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . tep_draw_input_field('products_name[' . $languages[$i]['id'] . ']', (isset($products_name[$languages[$i]['id']]) ? stripslashes($products_name[$languages[$i]['id']]) : tep_get_products_name($pInfo->products_id, $languages[$i]['id']))); ?></td>
          </tr>
<?php
    }
?>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.png', '1', '10'); ?></td>
          </tr>
          
          <!--TotalB2B start-->
          <tr bgcolor="#ebebff">
            <td class="main"><?php echo TEXT_PRODUCTS_TAX_CLASS; ?></td>
            <td class="main"><?php
              $prices_num = tep_xppp_getpricesnum();
              $gross_update = 'updateGross(\'products_price\');';
              for ($i=2; $i<=$prices_num; $i++)
                  $gross_update .= 'updateGross(\'products_price_'. $i . '\');';
              echo tep_draw_separator('pixel_trans.png', '24', '15') . '&nbsp;' . tep_draw_pull_down_menu('products_tax_class_id', $tax_class_array, $pInfo->products_tax_class_id, 'onchange="' . $gross_update .'"'); ?></td>
          </tr>
          <tr bgcolor="#ebebff">
            <td class="main" colspan="2"><br /><?php echo ENTRY_PRODUCTS_PRICE . " 1";?></td>
          </tr>
          <tr bgcolor="#ebebff">
            <td class="main"><?php echo TEXT_PRODUCTS_PRICE_NET; ?></td>
            <td class="main"><?php echo tep_draw_separator('pixel_trans.png', '24', '15') . '&nbsp;' . tep_draw_input_field('products_price', $pInfo->products_price, 'onKeyUp="updateGross(\'products_price\')"'); ?></td>
          </tr>
          <tr bgcolor="#ebebff">
            <td class="main"><?php echo TEXT_PRODUCTS_PRICE_COST; ?></td>
            <td class="main"><?php echo tep_draw_separator('pixel_trans.png', '24', '15') . '&nbsp;' . tep_draw_input_field('products_cost', $pInfo->products_cost, ''); ?></td>
          </tr>
          <tr bgcolor="#ebebff">
            <td class="main"><?php echo TEXT_PRODUCTS_PRICE_GROSS; ?></td>
            <td class="main"><?php echo tep_draw_separator('pixel_trans.png', '24', '15') . '&nbsp;' . tep_draw_input_field('products_price_gross', $pInfo->products_price, 'OnKeyUp="updateNet(\'products_price\')"'); ?></td>
          </tr>

          <?php
              $prices_num = tep_xppp_getpricesnum();
              for ($i=2; $i<=$prices_num; $i++) {?>

          <tr bgcolor="#ebebff">
            <td class="main" colspan="2"><br /><?php echo ENTRY_PRODUCTS_PRICE . " " . $i;?>&nbsp;<input type="checkbox" name="<?php echo "checkbox_products_price_" . $i;?>" <?php
                $products_price_X = "products_price_" . $i;
                if ($pInfo->$products_price_X != NULL) echo " checked "; ?> value="true" onclick="if (!<?php echo "products_price_" . $i;?>.disabled) { <?php echo "products_price_" . $i;?>.disabled = true;  <?php echo "products_price_". $i . "_gross";?>.disabled = true; } else { <?php echo "products_price_" . $i;?>.disabled = false;  <?php echo "products_price_". $i . "_gross";?>.disabled = false; } "></td>
          </tr>
          <tr bgcolor="#ebebff">
            <td class="main"><?php echo TEXT_PRODUCTS_PRICE_NET; ?></td>
            <td class="main"><?php
                $products_price_X = "products_price_" . $i;
                if ($pInfo->$products_price_X == NULL) {
                  echo tep_draw_separator('pixel_trans.png', '24', '15') . '&nbsp;' . tep_draw_input_field('products_price_' . $i, $pInfo->$products_price_X, 'onKeyUp="updateGross(\'products_price_' . $i .'\')", disabled');
                } else {
                  echo tep_draw_separator('pixel_trans.png', '24', '15') . '&nbsp;' . tep_draw_input_field('products_price_' . $i, $pInfo->$products_price_X, 'onKeyUp="updateGross(\'products_price_' . $i .'\')"');
                } ?></td>
          </tr>
          <tr bgcolor="#ebebff">
            <td class="main"><?php echo TEXT_PRODUCTS_PRICE_GROSS; ?></td>
            <td class="main"><?php
                $products_price_X = "products_price_" . $i;
                if ($pInfo->$products_price_X == NULL) {
                  echo tep_draw_separator('pixel_trans.png', '24', '15') . '&nbsp;' . tep_draw_input_field('products_price_'. $i . '_gross', $pInfo->$products_price_X, 'OnKeyUp="updateNet(\'products_price_' . $i .'\')", disabled');
                } else {
                  echo tep_draw_separator('pixel_trans.png', '24', '15') . '&nbsp;' . tep_draw_input_field('products_price_'. $i . '_gross', $pInfo->$products_price_X, 'OnKeyUp="updateNet(\'products_price_' . $i .'\')"');
                } ?>
            </td>
          </tr>

          <?php } ?>

          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.png', '1', '10'); ?></td>
          </tr>

<script type="text/javascript">
updateGross('products_price');
<?php
  $prices_num = tep_xppp_getpricesnum();
  for ($i=2; $i<=$prices_num; $i++) echo 'updateGross(\'products_price_' . $i . '\');';
?>
</script>
          <!--TotalB2B end-->

<?php
    for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
?>
          <tr>
            <td class="main" valign="top"><?php if ($i == 0) echo TEXT_PRODUCTS_DESCRIPTION; ?></td>
            <td><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="main" valign="top"><?php echo tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>&nbsp;</td>
    <?php /*    <td class="main"><?php echo tep_draw_textarea_field('products_description[' . $languages[$i]['id'] . ']', 'soft', '70', '15', (isset($products_description[$languages[$i]['id']]) ? stripslashes($products_description[$languages[$i]['id']]) : tep_get_products_description($pInfo->products_id, $languages[$i]['id']))); ?></td>
    modifica per HTMLAREA */ ?>
                <td class="main">
                  <?php if (WEB_EDITOR_LIST == 'fckeditor'){
                    echo tep_draw_fckeditor('products_description[' . $languages[$i]['id'] . ']', (isset($products_description[$languages[$i]['id']]) ? stripslashes($products_description[$languages[$i]['id']]) : tep_get_products_description($pInfo->products_id, $languages[$i]['id'])), 'id="description'.$i.'"');
                  } else {
                    echo tep_draw_textarea_field('products_description[' . $languages[$i]['id'] . ']', 'soft', '92', '15', (isset($products_description[$languages[$i]['id']]) ? stripslashes($products_description[$languages[$i]['id']]) : tep_get_products_description($pInfo->products_id, $languages[$i]['id'])), 'id="description'.$i.'"');
                  } ?>
                </td>
              </tr>
            </table></td>
          </tr>
<?php
    }
?>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.png', '1', '10'); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo TEXT_PRODUCTS_QUANTITY; ?></td>
            <td class="main"><?php echo tep_draw_separator('pixel_trans.png', '24', '15') . '&nbsp;' . tep_draw_input_field('products_quantity', $pInfo->products_quantity); ?></td>
          </tr>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.png', '1', '10'); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo TEXT_PRODUCTS_MODEL; ?></td>
            <td class="main"><?php echo tep_draw_separator('pixel_trans.png', '24', '15') . '&nbsp;' . tep_draw_input_field('products_model', $pInfo->products_model); ?></td>
          </tr>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.png', '1', '10'); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo TEXT_PRODUCTS_IMAGE; ?></td>
<?php
//060417/zepitt/multi images extra #07
// input form
?>
    <td class="main"><?php echo tep_draw_separator('pixel_trans.png', '24', '15') . '&nbsp;'.
        tep_draw_file_field('products_image').
        tep_draw_separator('pixel_trans.png', '24', '15').'&nbsp;'.
        $pInfo->products_image.tep_draw_hidden_field('products_previous_image', $pInfo->products_image);?>
    </td> 
</tr>
<tr>
    <td colspan="2"><?php echo tep_draw_separator('pixel_trans.png', '1', '10'); ?></td>
</tr>

<?php
for($nb=1; $nb <= NB_IMAGE_EXTRA ; $nb++) {
    $var_products_image = "products_image".$nb;
    $var_products_previous_image = "products_previous_image".$nb;
    $var_delete_image = "delete_image".$nb;
    ?>
    <tr>
  <td class="main"><?php echo TEXT_PRODUCTS_IMAGE_EXTRA.$nb; ?></td>
    <td class="main"><?php echo tep_draw_separator('pixel_trans.png', '24', '15').'&nbsp;'.
      tep_draw_file_field($var_products_image).
      tep_draw_separator('pixel_trans.png', '24', '15').'&nbsp;'.
      $pInfo->$var_products_image.tep_draw_hidden_field($var_products_previous_image, $pInfo->$var_products_image);?>
      <?php if($pInfo->$var_products_image) echo tep_draw_separator('pixel_trans.png', '24', '15').tep_draw_checkbox_field($var_delete_image, 'yes', false).TEXT_DELETE_IMAGE;?>
  </td>
  </tr>

<?php
}
//060417/zepitt/multi images extra EOF
?>


<?php
    for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
?>
          <tr>
            <td class="main"><?php if ($i == 0) echo TEXT_PRODUCTS_URL . '<br /><small>' . TEXT_PRODUCTS_URL_WITHOUT_HTTP . '</small>'; ?></td>
            <td class="main"><?php echo tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . tep_draw_input_field('products_url[' . $languages[$i]['id'] . ']', (isset($products_url[$languages[$i]['id']]) ? stripslashes($products_url[$languages[$i]['id']]) : tep_get_products_url($pInfo->products_id, $languages[$i]['id']))); ?></td>
          </tr>
<?php
    }
?>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.png', '1', '10'); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo TEXT_PRODUCTS_WEIGHT; ?></td>
            <td class="main"><?php echo tep_draw_separator('pixel_trans.png', '24', '15') . '&nbsp;' . tep_draw_input_field('products_weight', $pInfo->products_weight); ?></td>
          </tr>
         <?php // attribute ?>
          <tr>
            <td class="main"><?php echo TEXT_PRODUCTS_CODEBAR; ?></td>
            <td class="main"><?php echo tep_draw_separator('pixel_trans.png', '24', '15') . '&nbsp;' . tep_draw_input_field('products_codebar', $pInfo->products_codebar); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo TEXT_PRODUCTS_LENGTH; ?></td>
            <td class="main"><?php echo tep_draw_separator('pixel_trans.png', '24', '15') . '&nbsp;' . tep_draw_input_field('products_length', $pInfo->products_length); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo TEXT_PRODUCTS_WIDTH; ?></td>
            <td class="main"><?php echo tep_draw_separator('pixel_trans.png', '24', '15') . '&nbsp;' . tep_draw_input_field('products_width', $pInfo->products_width); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo TEXT_PRODUCTS_HEIGHT; ?></td>
            <td class="main"><?php echo tep_draw_separator('pixel_trans.png', '24', '15') . '&nbsp;' . tep_draw_input_field('products_height', $pInfo->products_height); ?></td>
          </tr>
          <tr>
            <td class="main"><?php //echo TEXT_PRODUCTS_READY_TO_SHIP; ?></td>
            <td class="main"><?php //echo tep_draw_separator('pixel_trans.png', '24', '15') . '&nbsp;' . tep_draw_checkbox_field('products_ready_to_ship', '1', (($product['products_ready_to_ship'] == '1') ? true : false)); ?></td>
          </tr>
         <?php // attribute end ?>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.png', '1', '10'); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo TEXT_PRODUCTS_RSS; ?></td>
            <td class="main"><?php echo tep_draw_separator('pixel_trans.png', '24', '15') . tep_draw_checkbox_field('products_to_rss', '1', $pInfo->products_to_rss); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.png', '1', '10'); ?></td>
      </tr>
      <tr>
        <td class="main" align="right"><?php echo tep_draw_hidden_field('products_date_added', (tep_not_null($pInfo->products_date_added) ? $pInfo->products_date_added : date('Y-m-d'))) . tep_image_submit('button_preview.png', IMAGE_PREVIEW) . '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . (isset($_GET['pID']) ? '&amp;pID=' . $_GET['pID'] : '')) . '">' . tep_image_button('button_cancel.png', IMAGE_CANCEL) . '</a>'; ?></td>
      </tr>
    </table></form>
<?php
  } elseif ($action == 'new_product_preview') {
    if (tep_not_null($_POST)) {
      $pInfo = new objectInfo($_POST);
      $products_name = $_POST['products_name'];
      $products_description = $_POST['products_description'];
      $products_url = $_POST['products_url'];
      $products_to_rss = $_POST['products_to_rss'];
    } else {

//060417/zepitt/multi images extra #08
      //TotalB2B start
      $products_price_list = tep_xppp_getpricelist("p");

      $product_query = tep_db_query("SELECT p.products_id, pd.language_id,
                pd.products_name, pd.products_description, pd.products_url, p.products_quantity,
                p.products_model, p.products_image, 
        p.products_codebar,
        p.products_to_rss,
        p.products_length, p.products_width, p.products_height, p.products_ready_to_ship, 
                pi.products_image1, pi.products_image2, pi.products_image3, pi.products_image4, pi.products_image5, 
                pi.products_image6, pi.products_image7, pi.products_image8, pi.products_image9,
                " . $products_price_list . ", p.products_weight,
                p.products_date_added, p.products_last_modified, p.products_date_available,
                p.products_status, p.manufacturers_id  
                FROM (".TABLE_PRODUCTS." p LEFT JOIN ".TABLE_PRODUCTS_IMAGES." pi ON p.products_id = pi.products_id) 
                INNER JOIN ".TABLE_PRODUCTS_DESCRIPTION." pd ON p.products_id = pd.products_id
                WHERE p.products_id = '" . (int)$_GET['pID'] . "'");
      //TotalB2B end

      $product = tep_db_fetch_array($product_query);

      $pInfo = new objectInfo($product);
      $products_image_name = $pInfo->products_image;
      $products_image1_name = $pInfo->products_image1;
      $products_image2_name = $pInfo->products_image2;
      $products_image3_name = $pInfo->products_image3;
      $products_image4_name = $pInfo->products_image4;
      $products_image5_name = $pInfo->products_image5;
      $products_image6_name = $pInfo->products_image6;
      $products_image7_name = $pInfo->products_image7;
      $products_image8_name = $pInfo->products_image8;
      $products_image9_name = $pInfo->products_image9;
//060417/zepitt/multi images extra EOF  
    }

    $form_action = (isset($_GET['pID'])) ? 'update_product' : 'insert_product';

    echo tep_draw_form($form_action, FILENAME_CATEGORIES, 'cPath=' . $cPath . (isset($_GET['pID']) ? '&amp;pID=' . $_GET['pID'] : '') . '&amp;action=' . $form_action, 'post', 'enctype="multipart/form-data"');

    $languages = tep_get_languages();
    for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
      if (isset($_GET['read']) && ($_GET['read'] == 'only')) {
        $pInfo->products_name = tep_get_products_name($pInfo->products_id, $languages[$i]['id']);
        $pInfo->products_description = tep_get_products_description($pInfo->products_id, $languages[$i]['id']);
        $pInfo->products_url = tep_get_products_url($pInfo->products_id, $languages[$i]['id']);
      } else {
        $pInfo->products_name = tep_db_prepare_input($products_name[$languages[$i]['id']]);
        $pInfo->products_description = tep_db_prepare_input($products_description[$languages[$i]['id']]);
        $pInfo->products_url = tep_db_prepare_input($products_url[$languages[$i]['id']]);
      }
?>
    <table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . $pInfo->products_name; ?>
          <?php echo $currencies->format($pInfo->products_price); ?></td>
            
            <!--TotalB2B start-->
            <td class="pageHeading" align="right"><?php
                $prices_num = tep_xppp_getpricesnum();
                echo ENTRY_PRODUCTS_PRICE . " 1: " . $currencies->format($pInfo->products_price);
                for ($b=2; $b<=$prices_num; $b++) {
                   $products_price_X = "products_price_" . $b;
                   echo "<br />" . ENTRY_PRODUCTS_PRICE . " " . $b. ": ";
                   if (tep_not_null($_POST)) {
                     if (tep_db_prepare_input($_POST['checkbox_products_price_' . $b]) != "true") echo ENTRY_PRODUCTS_PRICE_DISABLED;                   
                     else echo $currencies->format($pInfo->$products_price_X);
                   } else {
                     if ($product['products_price_' . $b] == NULL) echo ENTRY_PRODUCTS_PRICE_DISABLED;
                     else echo $currencies->format($pInfo->$products_price_X);
                   }
                }
            ?></td>
            <!--TotalB2B end-->

          </tr>
        </table></td>
      </tr>
      <tr>
        <td class="main">
<?php
//060417/zepitt/multi images extra #09
// preview
?>

<?php
echo tep_image(DIR_WS_CATALOG_IMAGES . $products_image_name, $pInfo->products_name, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, 'align="right" hspace="5" vspace="5"');

for($nb=1; $nb <= NB_IMAGE_EXTRA ; $nb++) {
    $var_products_image_name = "products_image".$nb."_name";
    
    if ($$var_products_image_name) echo tep_image(DIR_WS_CATALOG . 'images/images_extra/' . $$var_products_image_name, $pInfo->products_name, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, 'align="right" hspace="5" vspace="5"');
}
?>



<?php echo $pInfo->products_description; ?>

                        </td>
      </tr>
<?php
//060417/zepitt/multi images extra EOF

      if ($pInfo->products_url) {
?>
      <tr>
        <td class="main"><?php echo sprintf(TEXT_PRODUCT_MORE_INFORMATION, $pInfo->products_url); ?></td>
      </tr>
<?php
      }
?>
<?php
      if ($pInfo->products_date_available > date('Y-m-d')) {
?>
      <tr>
        <td align="center" class="smallText"><?php echo sprintf(TEXT_PRODUCT_DATE_AVAILABLE, tep_date_long($pInfo->products_date_available)); ?></td>
      </tr>
<?php
      } else {
?>
      <tr>
        <td align="center" class="smallText"><?php echo sprintf(TEXT_PRODUCT_DATE_ADDED, tep_date_long($pInfo->products_date_added)); ?></td>
      </tr>
<?php
      }
?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.png', '1', '10'); ?></td>
      </tr>
<?php
    }

    if (isset($_GET['read']) && ($_GET['read'] == 'only')) {
      if (isset($_GET['origin'])) {
        $pos_params = strpos($_GET['origin'], '?', 0);
        if ($pos_params != false) {
          $back_url = substr($_GET['origin'], 0, $pos_params);
          $back_url_params = substr($_GET['origin'], $pos_params + 1);
        } else {
          $back_url = $_GET['origin'];
          $back_url_params = '';
        }
      } else {
        $back_url = FILENAME_CATEGORIES;
        $back_url_params = 'cPath=' . $cPath . '&pID=' . $pInfo->products_id;
      }
?>
      <tr>
        <td align="right"><?php echo '<a href="' . tep_href_link($back_url, $back_url_params, 'NONSSL') . '">' . tep_image_button('button_back.png', IMAGE_BACK) . '</a>'; ?></td>
      </tr>
<?php
    } else {
?>
      <tr>
        <td align="right" class="smallText">
<?php
/* Re-Post all POST'ed variables */
      reset($_POST);
      while (list($key, $value) = each($_POST)) {
        if (!is_array($_POST[$key])) {
          echo tep_draw_hidden_field($key, htmlspecialchars(stripslashes($value)));
        }
      }
      $languages = tep_get_languages();
      for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
        echo tep_draw_hidden_field('products_name[' . $languages[$i]['id'] . ']', htmlspecialchars(stripslashes($products_name[$languages[$i]['id']])));
        echo tep_draw_hidden_field('products_description[' . $languages[$i]['id'] . ']', htmlspecialchars(stripslashes($products_description[$languages[$i]['id']])));
        echo tep_draw_hidden_field('products_url[' . $languages[$i]['id'] . ']', htmlspecialchars(stripslashes($products_url[$languages[$i]['id']])));
      }
      echo tep_draw_hidden_field('products_image', stripslashes($products_image_name));

//060417/zepitt/multi images extra #10
  echo tep_draw_hidden_field('products_image1', stripslashes($products_image1_name));
  echo tep_draw_hidden_field('products_image2', stripslashes($products_image2_name));
  echo tep_draw_hidden_field('products_image3', stripslashes($products_image3_name));
  echo tep_draw_hidden_field('products_image4', stripslashes($products_image4_name));
  echo tep_draw_hidden_field('products_image5', stripslashes($products_image5_name));
  echo tep_draw_hidden_field('products_image6', stripslashes($products_image6_name));
  echo tep_draw_hidden_field('products_image7', stripslashes($products_image7_name));
  echo tep_draw_hidden_field('products_image8', stripslashes($products_image8_name));
  echo tep_draw_hidden_field('products_image9', stripslashes($products_image9_name));
//060417/zepitt/multi images extra EOF


      echo tep_image_submit('button_back.png', IMAGE_BACK, 'name="edit"') . '&nbsp;&nbsp;';

      if (isset($_GET['pID'])) {
        echo tep_image_submit('button_update.png', IMAGE_UPDATE);
      } else {
        echo tep_image_submit('button_insert.png', IMAGE_INSERT);
      }
      echo '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . (isset($_GET['pID']) ? '&amp;pID=' . $_GET['pID'] : '')) . '">' . tep_image_button('button_cancel.png', IMAGE_CANCEL) . '</a>';
?></td>
      </tr>
    </table></form>
<?php
    }
  } else {
?>
    <table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.png', 1, HEADING_IMAGE_HEIGHT); ?></td>
            <td align="right"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td class="smallText" align="right">
<?php
// BOF: KategorienAdmin / OLISWISS
  if ($admin_groups_id == 1) {
    echo tep_draw_form('search', FILENAME_CATEGORIES, '', 'get');
    echo HEADING_TITLE_SEARCH . ' ' . tep_draw_input_field('search');
    echo tep_hide_session_id() . '</form>';
  }
// EOF: KategorienAdmin / OLISWISS
?>
                </td>
              </tr>
              <tr>
                <td class="smallText" align="right">
<?php
// BOF: KategorienAdmin / OLISWISS
//  echo tep_draw_form('goto', FILENAME_CATEGORIES, '', 'get');
//  echo HEADING_TITLE_GOTO . ' ' . tep_draw_pull_down_menu('cPath', tep_get_category_tree(), $current_category_id, 'onchange="this.form.submit();"');
//  echo '</form>';
  if (is_array($admin_cat_access_array_cats) && (in_array("ALL",$admin_cat_access_array_cats)== false) && (pos($admin_cat_access_array_cats)!= "")) {
    echo tep_draw_form('goto', FILENAME_CATEGORIES, '', 'get');
    echo HEADING_TITLE_GOTO . ' ' . tep_draw_pull_down_menu('cPath', tep_get_category_tree('','','','',$admin_cat_access_array_cats), $current_category_id, 'onchange="this.form.submit();"');
    echo tep_hide_session_id() . '</form>';
  } else if (in_array("ALL",$admin_cat_access_array_cats)== true) { //nur Top-ADMIN
    echo tep_draw_form('goto', FILENAME_CATEGORIES, '', 'get');
    echo HEADING_TITLE_GOTO . ' ' . tep_draw_pull_down_menu('cPath', tep_get_category_tree(), $current_category_id, 'onchange="this.form.submit();"');
    echo tep_hide_session_id() . '</form>';
  }
// EOF: KategorienAdmin / OLISWISS
?>
                </td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_CATEGORIES_PRODUCTS; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_STATUS; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
    $categories_count = 0;
    $rows = 0;
    if (isset($_GET['search'])) {
      $search = tep_db_prepare_input($_GET['search']);

      $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.categories_image, c.parent_id, c.sort_order, c.date_added, c.last_modified from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' and cd.categories_name like '%" . tep_db_input($search) . "%' order by c.sort_order, cd.categories_name");
    } else {
// BOF: KategorienAdmin / OLISWISS
    if ($admin_cat_access == "ALL") {
// #################### Added Categorie Enable / Disable ##################
//      $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.categories_image, c.parent_id, c.sort_order, c.date_added, c.last_modified from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '" . (int)$current_category_id . "' and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' order by c.sort_order, cd.categories_name");
      $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.categories_image, c.parent_id, c.sort_order, c.date_added, c.last_modified, c.categories_status from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '" . (int)$current_category_id . "' and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' order by c.sort_order, cd.categories_name");
// #################### End Added Categorie Enable / Disable ##################
    } else if ($admin_cat_access == ""){
      $categories_query = tep_db_query("");
    } else {
// #################### Added Categorie Enable / Disable ##################
//      $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.categories_image, c.parent_id, c.sort_order, c.date_added, c.last_modified from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '" . (int)$current_category_id . "' and (c.parent_id or c.categories_id in (" . $admin_cat_access . ")) and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' order by c.sort_order, cd.categories_name");
      $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.categories_image, c.parent_id, c.sort_order, c.date_added, c.last_modified, c.categories_status from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '" . (int)$current_category_id . "' and (c.parent_id or c.categories_id in (" . $admin_cat_access . ")) and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' order by c.sort_order, cd.categories_name");
// #################### End Added Categorie Enable / Disable ##################
    }
// EOF: KategorienAdmin / OLISWISS
    }
    while ($categories = tep_db_fetch_array($categories_query)) {
      $categories_count++;
      $rows++;

// Get parent_id for subcategories if search
      if (isset($_GET['search'])) $cPath= $categories['parent_id'];

      if ((!isset($_GET['cID']) && !isset($_GET['pID']) || (isset($_GET['cID']) && ($_GET['cID'] == $categories['categories_id']))) && !isset($cInfo) && (substr($action, 0, 3) != 'new')) {
        $category_childs = array('childs_count' => tep_childs_in_category_count($categories['categories_id']));
        $category_products = array('products_count' => tep_products_in_category_count($categories['categories_id']));

        $cInfo_array = array_merge($categories, $category_childs, $category_products);
        $cInfo = new objectInfo($cInfo_array);
      }
      
// BOF: KategorienAdmin / OLISWISS
     if ($admin_groups_id == 1 || in_array($categories['categories_id'],$admin_cat_access_array_cats) || $categories['parent_id'] != 0) {
       if ($admin_groups_id == 1 || in_array($_GET['cPath'],$admin_cat_access_array_cats) || in_array($categories['categories_id'],$admin_cat_access_array_cats)) {
// EOF: KategorienAdmin / OLISWISS

      if (isset($cInfo) && is_object($cInfo) && ($categories['categories_id'] == $cInfo->categories_id) ) {
        echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_CATEGORIES, tep_get_path($categories['categories_id'])) . '\'">' . "\n";
      } else {
        echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&amp;cID=' . $categories['categories_id']) . '\'">' . "\n";
      }
?>
                <td class="dataTableContent"><?php echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, tep_get_path($categories['categories_id'])) . '">' . tep_image(DIR_WS_ICONS . 'folder.png', ICON_FOLDER) . '</a>&nbsp;<b>' . $categories['categories_name'] . '</b>'; ?></td>
<!-- // ################" Added Categories Disable #############
                <td class="dataTableContent" align="center">&nbsp;</td>
-->
                <td class="dataTableContent" align="center">
<?php
      if ($categories['categories_status'] == '1') {
        echo tep_image(DIR_WS_IMAGES . 'icon_status_green.png', IMAGE_ICON_STATUS_GREEN, 10, 10) . '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_CATEGORIES, 'action=setflag_cat&amp;flag=0&amp;cID=' . $categories['categories_id'] . '&amp;cPath=' . $cPath) . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_red_light.png', IMAGE_ICON_STATUS_RED_LIGHT, 10, 10) . '</a>';
      } else {
        echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'action=setflag_cat&amp;flag=1&amp;cID=' . $categories['categories_id'] . '&amp;cPath=' . $cPath) . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_green_light.png', IMAGE_ICON_STATUS_GREEN_LIGHT, 10, 10) . '</a>&nbsp;&nbsp;' . tep_image(DIR_WS_IMAGES . 'icon_status_red.png', IMAGE_ICON_STATUS_RED, 10, 10);
      }
?>
                </td>
<!-- // ################" End Added Categories Disable ############# -->
                <td class="dataTableContent" align="right"><a href="categories_descriptiontext.php?id=<?= $categories['categories_id'] . '&lang=' . (int)$languages_id;?>">editovatPopis</a><?php echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&amp;cID=' . $categories['categories_id'] . '&amp;action=edit_category') . '">' . tep_image(DIR_WS_ICONS . 'edit.png', IMAGE_EDIT) . '</a>'; ?>&nbsp;&nbsp;<?php echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&amp;cID=' . $categories['categories_id'] . '&amp;action=move_category') . '">' . tep_image(DIR_WS_ICONS . 'move.png', IMAGE_MOVE) . '</a>'; ?>&nbsp;&nbsp;<?php echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&amp;cID=' . $categories['categories_id'] . '&amp;action=delete_category') . '">' . tep_image(DIR_WS_ICONS . 'delete.png', ICON_DELETE) . '</a>'; ?>&nbsp;&nbsp;<?php if (isset($cInfo) && is_object($cInfo) && ($categories['categories_id'] == $cInfo->categories_id) ) { echo tep_image(DIR_WS_IMAGES . 'icon_arrow_right.png', ''); } else { echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&amp;cID=' . $categories['categories_id']) . '">' . tep_image(DIR_WS_IMAGES . 'icon_info.png', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
// BOF: KategorienAdmin / OLISWISS
       }
     }
// EOF: KategorienAdmin / OLISWISS


//060417/zepitt/multi images extra/modif #11
    }

    $products_count = 0;
    if (isset($_GET['search'])) {
            //find an item with search function
            $products_query = tep_db_query("SELECT 
                p.products_id, pd.products_name, p.products_quantity, p.products_image, p.products_dotisk, p.products_kniha_mesice,
        p.products_codebar,
        p.products_length, p.products_width, p.products_height, p.products_ready_to_ship, 
                pi.products_image1, pi.products_image2, pi.products_image3, pi.products_image4, pi.products_image5,
                pi.products_image6, pi.products_image7, pi.products_image8, pi.products_image9, 
                p.products_price, p.products_cost, p.products_date_added, p.products_last_modified, p.products_date_available, p.products_status,
                p2c.categories_id, p.products_to_rss 
                FROM (".TABLE_PRODUCTS." p LEFT JOIN ".TABLE_PRODUCTS_IMAGES." pi ON p.products_id = pi.products_id) 
                INNER JOIN ".TABLE_PRODUCTS_DESCRIPTION." pd ON p.products_id = pd.products_id
                INNER JOIN ".TABLE_PRODUCTS_TO_CATEGORIES." p2c ON p.products_id = p2c.products_id
                WHERE pd.language_id = '" . (int)$languages_id . "' 
                AND pd.products_name like '%" . tep_db_input($search) . "%' 
                ORDER BY pd.products_name");     
            } else {
            //find an item with tree structure
            $products_query = tep_db_query("SELECT 
                p.products_id, pd.products_name, p.products_quantity, p.products_image, p.products_dotisk, p.products_kniha_mesice,
        p.products_codebar,
        p.products_length, p.products_width, p.products_height, p.products_ready_to_ship, 
                pi.products_image1, pi.products_image2, pi.products_image3, pi.products_image4, pi.products_image5,
                pi.products_image6, pi.products_image7, pi.products_image8, pi.products_image9, 
                p.products_price, p.products_cost, p.products_date_added, p.products_last_modified, p.products_date_available, p.products_status, p.products_to_rss
                FROM (".TABLE_PRODUCTS." p LEFT JOIN ".TABLE_PRODUCTS_IMAGES." pi ON p.products_id = pi.products_id) 
                INNER JOIN ".TABLE_PRODUCTS_DESCRIPTION." pd ON p.products_id = pd.products_id
                INNER JOIN ".TABLE_PRODUCTS_TO_CATEGORIES." p2c ON p.products_id = p2c.products_id
                WHERE pd.language_id = '" . (int)$languages_id . "' 
                AND p2c.categories_id = '" . (int)$current_category_id . "' 
                ORDER BY pd.products_name");
            }
//060417/zepitt/multi images extra EOF
    while ($products = tep_db_fetch_array($products_query)) {
      $products_count++;
      $rows++;

// Get categories_id for product if search
      if (isset($_GET['search'])) $cPath = $products['categories_id'];

      if ( (!isset($_GET['pID']) && !isset($_GET['cID']) || (isset($_GET['pID']) && ($_GET['pID'] == $products['products_id']))) && !isset($pInfo) && !isset($cInfo) && (substr($action, 0, 3) != 'new')) {
// find out the rating average from customer reviews
        $reviews_query = tep_db_query("select (avg(reviews_rating) / 5 * 100) as average_rating from " . TABLE_REVIEWS . " where products_id = '" . (int)$products['products_id'] . "'");
        $reviews = tep_db_fetch_array($reviews_query);
        $pInfo_array = array_merge($products, $reviews);
        $pInfo = new objectInfo($pInfo_array);
      }
      
// BOF: KategorienAdmin / OLISWISS
     if ($admin_groups_id == 1 || in_array($categories['categories_id'],$admin_cat_access_array_cats) || $cPath != 0) {
// EOF: KategorienAdmin / OLISWISS

      if (isset($pInfo) && is_object($pInfo) && ($products['products_id'] == $pInfo->products_id) ) {
        echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&amp;pID=' . $products['products_id'] . '&amp;action=new_product_preview&amp;read=only') . '\'">' . "\n";
      } else {
        echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&amp;pID=' . $products['products_id']) . '\'">' . "\n";
      }
?>
                <td class="dataTableContent"><?php echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&amp;pID=' . $products['products_id'] . '&amp;action=new_product_preview&amp;read=only') . '">' . tep_image(DIR_WS_ICONS . 'preview.png', ICON_PREVIEW) . '</a>&nbsp;' . $products['products_name']; ?></td>
                <td class="dataTableContent" align="center">xxx
<?php
      if ($products['products_status'] == '1') {
        echo tep_image(DIR_WS_IMAGES . 'icon_status_green.png', IMAGE_ICON_STATUS_GREEN, 10, 10) . '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_CATEGORIES, 'action=setflag&amp;flag=0&amp;pID=' . $products['products_id'] . '&amp;cPath=' . $cPath) . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_red_light.png', IMAGE_ICON_STATUS_RED_LIGHT, 10, 10) . '</a>';
      } else {
        echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'action=setflag&amp;flag=1&amp;pID=' . $products['products_id'] . '&amp;cPath=' . $cPath) . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_green_light.png', IMAGE_ICON_STATUS_GREEN_LIGHT, 10, 10) . '</a>&nbsp;&nbsp;' . tep_image(DIR_WS_IMAGES . 'icon_status_red.png', IMAGE_ICON_STATUS_RED, 10, 10);
      }
?>

<?php
echo    '<a href="products_description.php?id=' . $products['products_id'] . '&jaz=' . $languages_id . '">text/popis</a> |';
echo    '<a href="products_sort_order.php?id=' . $products['products_id'] . '">pořadí</a> ';
?>
| HOMEPAGE/aktualita : <a href=setHPtrvale.php?id=<? echo $products['products_id']; ?>>NASTAVIT</a> | <a href=setHPtrvaleNO.php?id=<? echo $products['products_id']; ?>>ZRUŠIT</a>
<?
//if ($products['products_dotisk']!=0) echo '<a href=products_dotisk.php?id=' . $products['products_id'] . '&dotisk=0>zrus dotisk</a>'; else echo '<a href=products_dotisk.php?id=' . $products['products_id'] . '&dotisk=1>nastav dotisk</a>';?> | 
<!--
    <a href="edit_dateadded.php?id=<? echo $products['products_id']; ?>">dat.vyd.</a> | 

    <a href="products_description_long.php?id=<? echo $products['products_id'] . '&jaz=' . $languages_id;?>">ukazka</a> |
    <a href="products_description_long_order.php?id=<? echo $products['products_id']; ?>">Uk.HP</a> |  
    <a href="products_description_long2.php?id=<? echo $products['products_id'] . '&jaz=' . $languages_id;?>">recenze</a> |
    <? if ($products['products_kniha_mesice']==1) echo '<a href=products_kniha_mesice.php?id=' . $products['products_id'] . '&status=0>zrus KnihaMes</a>'; else echo '<a href=products_kniha_mesice.php?id=' . $products['products_id'] . '&status=1>nastav KnihaMes</a>';?>  
//-->
</td>
                <td class="dataTableContent" align="right"><?php echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&amp;pID=' . $products['products_id'] . '&amp;action=new_product') . '">' . tep_image(DIR_WS_ICONS . 'edit.png', IMAGE_EDIT) . '</a>'; ?>&nbsp;&nbsp;<?php echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&amp;pID=' . $products['products_id'] . '&amp;action=move_product') . '">' . tep_image(DIR_WS_ICONS . 'move.png', IMAGE_MOVE) . '</a>'; ?>&nbsp;&nbsp;<?php echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&amp;pID=' . $products['products_id'] . '&amp;action=copy_to') . '">' . tep_image(DIR_WS_ICONS . 'copy.png', IMAGE_COPY) . '</a>'; ?>&nbsp;&nbsp;<?php echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&amp;pID=' . $products['products_id'] . '&amp;action=delete_product') . '">' . tep_image(DIR_WS_ICONS . 'delete.png', IMAGE_DELETE) . '</a>'; ?>&nbsp;&nbsp;<?php if (isset($pInfo) && is_object($pInfo) && ($products['products_id'] == $pInfo->products_id)) { echo tep_image(DIR_WS_IMAGES . 'icon_arrow_right.png', ''); } else { echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&amp;pID=' . $products['products_id']) . '">' . tep_image(DIR_WS_IMAGES . 'icon_info.png', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php

// BOF: KategorienAdmin / OLISWISS
      }
// EOF: KategorienAdmin / OLISWISS

    }

    $cPath_back = '';
    if (sizeof($cPath_array) > 0) {
      for ($i=0, $n=sizeof($cPath_array)-1; $i<$n; $i++) {
        if (empty($cPath_back)) {
          $cPath_back .= $cPath_array[$i];
        } else {
          $cPath_back .= '_' . $cPath_array[$i];
        }
      }
    }

    $cPath_back = (tep_not_null($cPath_back)) ? 'cPath=' . $cPath_back . '&' : '';
?>
              <tr>
                <td colspan="3"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                  
<?php // BOF: KategorienAdmin / OLISWISS
    if($admin_groups_id == 1){
?>
                  
                    <td class="smallText"><?php echo TEXT_CATEGORIES . '&nbsp;' . $categories_count . '<br />' . TEXT_PRODUCTS . '&nbsp;' . $products_count; ?></td>
                    <td align="right" class="smallText"><?php if (sizeof($cPath_array) > 0) echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, $cPath_back . 'cID=' . $current_category_id) . '">' . tep_image_button('button_back.png', IMAGE_BACK) . '</a>&nbsp;'; if (!isset($_GET['search'])) echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&amp;action=new_category') . '">' . tep_image_button('button_new_category.png', IMAGE_NEW_CATEGORY) . '</a>&nbsp;<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&amp;action=new_product') . '">' . tep_image_button('button_new_product.png', IMAGE_NEW_PRODUCT) . '</a>'; ?>&nbsp;</td>

<?php
    } else {
?>
                    <td></td>
                    <td align="right" class="smallText">
                    <?php if (sizeof($cPath_array) > 0) echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, $cPath_back . 'cID=' . $current_category_id) . '">' . tep_image_button('button_back.png', IMAGE_BACK) . '</a>&nbsp;';
                    if (!isset($_GET['search']) && strstr($admin_right_access,"CNEW")) echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&amp;action=new_category') . '">' . tep_image_button('button_new_category.png', IMAGE_NEW_CATEGORY) . '</a>&nbsp;'; 
                    if (!isset($_GET['search']) && strstr($admin_right_access,"PNEW") && $cInfo->parent_id !='0') echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&amp;action=new_product') . '">' . tep_image_button('button_new_product.png', IMAGE_NEW_PRODUCT) . '</a>'; ?>&nbsp;</td>
<?php
    }
// EOF: KategorienAdmin / OLISWISS
?>

                  </tr>
                </table></td>
              </tr>
            </table></td>
<?php
    $heading = array();
    $contents = array();
    switch ($action) {
      case 'new_category':
        $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_NEW_CATEGORY . '</b>');

        $contents = array('form' => tep_draw_form('newcategory', FILENAME_CATEGORIES, 'action=insert_category&amp;cPath=' . $cPath, 'post', 'enctype="multipart/form-data"'));
        $contents[] = array('text' => TEXT_NEW_CATEGORY_INTRO);

        $category_inputs_string = '';
        $languages = tep_get_languages();
        for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
          $category_inputs_string .= '<br />' . tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . tep_draw_input_field('categories_name[' . $languages[$i]['id'] . ']');
        }

        $contents[] = array('text' => '<br />' . TEXT_CATEGORIES_NAME . $category_inputs_string);
        $contents[] = array('text' => '<br />' . TEXT_CATEGORIES_IMAGE . '<br />' . tep_draw_file_field('categories_image'));
        $contents[] = array('text' => '<br />' . TEXT_SORT_ORDER . '<br />' . tep_draw_input_field('sort_order', '', 'size="2"'));
	// - START - Category Descriptions
        $category_inputs_string_title = $category_inputs_string_description = '';
        for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
          $category_inputs_string_title .= '<br>' . tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . tep_draw_input_field('categories_heading_title[' . $languages[$i]['id'] . ']');
          $category_inputs_string_description .= '<br>' . tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . tep_draw_textarea_field('categories_description[' . $languages[$i]['id'] . ']', 'soft', 50, 15);
        }
        $contents[] = array('text' => '<br>' . TEXT_EDIT_CATEGORIES_HEADING_TITLE . $category_inputs_string_title);
        $contents[] = array('text' => '<br>' . TEXT_EDIT_CATEGORIES_DESCRIPTION . $category_inputs_string_description);
	// --- END - Category Descriptions

        $contents[] = array('align' => 'center', 'text' => '<br />' . tep_image_submit('button_save.png', IMAGE_SAVE) . ' <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath) . '">' . tep_image_button('button_cancel.png', IMAGE_CANCEL) . '</a>');
        break;
      case 'edit_category':
        $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_EDIT_CATEGORY . '</b>');

        $contents = array('form' => tep_draw_form('categories', FILENAME_CATEGORIES, 'action=update_category&amp;cPath=' . $cPath, 'post', 'enctype="multipart/form-data"') . tep_draw_hidden_field('categories_id', $cInfo->categories_id));
        $contents[] = array('text' => TEXT_EDIT_INTRO);

        $category_inputs_string = '';
        $languages = tep_get_languages();
        for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
          $category_inputs_string .= '<br />' . tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . tep_draw_input_field('categories_name[' . $languages[$i]['id'] . ']', tep_get_category_name($cInfo->categories_id, $languages[$i]['id']));
        }
        
// JUST SPIFFY Category Descriptions
$cat_descript_query = tep_db_query ("select category_description from " . TABLE_CAT_DESCRIPT . " where categories_id = '" . $cInfo->categories_id . "'");
$cat_descript = tep_db_fetch_array($cat_descript_query);
// END JUST SPIFFY Category Descriptions

        $contents[] = array('text' => '<br />' . TEXT_EDIT_CATEGORIES_NAME . $category_inputs_string);
        $contents[] = array('text' => '<br />' . tep_image(DIR_WS_CATALOG_IMAGES . $cInfo->categories_image, $cInfo->categories_name) . '<br />' . DIR_WS_CATALOG_IMAGES . '<br /><b>' . $cInfo->categories_image . '</b>');
        $contents[] = array('text' => '<br />' . TEXT_EDIT_CATEGORIES_IMAGE . '<br />' . tep_draw_file_field('categories_image'));
        $contents[] = array('text' => '<br />' . TEXT_EDIT_SORT_ORDER . '<br />' . tep_draw_input_field('sort_order', $cInfo->sort_order, 'size="2"'));
	// - START - Category Descriptions
        $cat_descriptions = array();
        $cat_description_query = tep_db_query ("select language_id,categories_heading_title,categories_description from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . $cInfo->categories_id . "'");
		while ($cat_description = tep_db_fetch_array($cat_description_query)) {
			$cat_descriptions['categories_heading_title'][$cat_description['language_id']] = $cat_description['categories_heading_title'];
			$cat_descriptions['categories_description'][$cat_description['language_id']] = $cat_description['categories_description'];
		}
        for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
          $category_inputs_string_title .= '<br>' . tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . tep_draw_input_field('categories_heading_title[' . $languages[$i]['id'] . ']', $cat_descriptions ['categories_heading_title'][$languages[$i]['id']]);
          $category_inputs_string_description .= '<br>' . tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name'],0,0,'ALIGN="top"') . '&nbsp;' . tep_draw_textarea_field('categories_description[' . $languages[$i]['id'] . ']', 'soft', 50, 15, $cat_descriptions ['categories_description'][$languages[$i]['id']]);
		}
        $contents[] = array('text' => '<br>' . TEXT_EDIT_CATEGORIES_HEADING_TITLE . $category_inputs_string_title);
//shop2.0brain:todo
//                    echo tep_draw_fckeditor('categories_description[' . $languages[$i]['id'] . ']', (isset($categories_description[$languages[$i]['id']]) ? stripslashes($categories_description[$languages[$i]['id']]) : tep_get_categories_description($pInfo->categories_id, $languages[$i]['id'])), 'id="description'.$i.'"');
        $contents[] = array('text' => '<br>' . TEXT_EDIT_CATEGORIES_DESCRIPTION . $category_inputs_string_description);
	// --- END - Category Descriptions
// ###################### Added Categories Enable / Disable #################
//        $contents[] = array('align' => 'center', 'text' => '<br />' . tep_image_submit('button_save.png', IMAGE_SAVE) . ' <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&amp;cID=' . $cInfo->categories_id) . '">' . tep_image_button('button_cancel.png', IMAGE_CANCEL) . '</a>');
        $contents[] = array('text' => '<br />' . TEXT_EDIT_STATUS . '<br />' . tep_draw_input_field('categories_status', $cInfo->categories_status, 'size="2"') . '1=Enabled 0=Disabled');
    $contents[] = array('align' => 'center', 'text' => '<br />' . tep_image_submit('button_save.png', IMAGE_SAVE) . ' <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&amp;cID=' . $cInfo->categories_id) . '">' . tep_image_button('button_cancel.png', IMAGE_CANCEL) . '</a>');
// ##################### End Added Categories Enable / Disable ###################

        break;
      case 'delete_category':
        $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_CATEGORY . '</b>');

        $contents = array('form' => tep_draw_form('categories', FILENAME_CATEGORIES, 'action=delete_category_confirm&amp;cPath=' . $cPath) . tep_draw_hidden_field('categories_id', $cInfo->categories_id));
        $contents[] = array('text' => TEXT_DELETE_CATEGORY_INTRO);
        $contents[] = array('text' => '<br /><b>' . $cInfo->categories_name . '</b>');
        if ($cInfo->childs_count > 0) $contents[] = array('text' => '<br />' . sprintf(TEXT_DELETE_WARNING_CHILDS, $cInfo->childs_count));
        if ($cInfo->products_count > 0) $contents[] = array('text' => '<br />' . sprintf(TEXT_DELETE_WARNING_PRODUCTS, $cInfo->products_count));
        $contents[] = array('align' => 'center', 'text' => '<br />' . tep_image_submit('button_delete.png', IMAGE_DELETE) . ' <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&amp;cID=' . $cInfo->categories_id) . '">' . tep_image_button('button_cancel.png', IMAGE_CANCEL) . '</a>');
        break;
      case 'move_category':
        $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_MOVE_CATEGORY . '</b>');

        $contents = array('form' => tep_draw_form('categories', FILENAME_CATEGORIES, 'action=move_category_confirm&amp;cPath=' . $cPath) . tep_draw_hidden_field('categories_id', $cInfo->categories_id));
        $contents[] = array('text' => sprintf(TEXT_MOVE_CATEGORIES_INTRO, $cInfo->categories_name));
        $contents[] = array('text' => '<br />' . sprintf(TEXT_MOVE, $cInfo->categories_name) . '<br />' . tep_draw_pull_down_menu('move_to_category_id', tep_get_category_tree(), $current_category_id));
        $contents[] = array('align' => 'center', 'text' => '<br />' . tep_image_submit('button_move.png', IMAGE_MOVE) . ' <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&amp;cID=' . $cInfo->categories_id) . '">' . tep_image_button('button_cancel.png', IMAGE_CANCEL) . '</a>');
        break;
      case 'delete_product':
        $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_PRODUCT . '</b>');

        $contents = array('form' => tep_draw_form('products', FILENAME_CATEGORIES, 'action=delete_product_confirm&amp;cPath=' . $cPath) . tep_draw_hidden_field('products_id', $pInfo->products_id));
        $contents[] = array('text' => TEXT_DELETE_PRODUCT_INTRO);
        $contents[] = array('text' => '<br /><b>' . $pInfo->products_name . '</b>');

        $product_categories_string = '';
        $product_categories = tep_generate_category_path($pInfo->products_id, 'product');
        for ($i = 0, $n = sizeof($product_categories); $i < $n; $i++) {
          $category_path = '';
          for ($j = 0, $k = sizeof($product_categories[$i]); $j < $k; $j++) {
            $category_path .= $product_categories[$i][$j]['text'] . '&nbsp;&gt;&nbsp;';
          }
          $category_path = substr($category_path, 0, -16);
          $product_categories_string .= tep_draw_checkbox_field('product_categories[]', $product_categories[$i][sizeof($product_categories[$i])-1]['id'], true) . '&nbsp;' . $category_path . '<br />';
        }
        $product_categories_string = substr($product_categories_string, 0, -4);

        $contents[] = array('text' => '<br />' . $product_categories_string);
        $contents[] = array('align' => 'center', 'text' => '<br />' . tep_image_submit('button_delete.png', IMAGE_DELETE) . ' <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&amp;pID=' . $pInfo->products_id) . '">' . tep_image_button('button_cancel.png', IMAGE_CANCEL) . '</a>');
        break;
      case 'move_product':
        $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_MOVE_PRODUCT . '</b>');

        $contents = array('form' => tep_draw_form('products', FILENAME_CATEGORIES, 'action=move_product_confirm&amp;cPath=' . $cPath) . tep_draw_hidden_field('products_id', $pInfo->products_id));
        $contents[] = array('text' => sprintf(TEXT_MOVE_PRODUCTS_INTRO, $pInfo->products_name));
        $contents[] = array('text' => '<br />' . TEXT_INFO_CURRENT_CATEGORIES . '<br /><b>' . tep_output_generated_category_path($pInfo->products_id, 'product') . '</b>');

/*
$contents[] = array('text' => '<br />' . sprintf(TEXT_MOVE, $pInfo->products_name) . '<br />' . tep_draw_pull_down_menu('move_to_category_id', tep_get_category_tree(), $current_category_id));
*/
// BOF: KategorienAdmin / OLISWISS
  if (is_array($admin_cat_access_array_cats) && (in_array("ALL",$admin_cat_access_array_cats)== false) && (pos($admin_cat_access_array_cats)!= "")) {
    $contents[] = array('text' => '<br />' . sprintf(TEXT_MOVE, $pInfo->products_name) . '<br />' . tep_draw_pull_down_menu('move_to_category_id', tep_get_category_tree('','','0','',$admin_cat_access_array_cats), $current_category_id));
  } else if (in_array("ALL",$admin_cat_access_array_cats)== true) { //nur Top-ADMIN
    $contents[] = array('text' => '<br />' . sprintf(TEXT_MOVE, $pInfo->products_name) . '<br />' . tep_draw_pull_down_menu('move_to_category_id', tep_get_category_tree(), $current_category_id));
  }
// EOF: KategorienAdmin / OLISWISS

        $contents[] = array('align' => 'center', 'text' => '<br />' . tep_image_submit('button_move.png', IMAGE_MOVE) . ' <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&amp;pID=' . $pInfo->products_id) . '">' . tep_image_button('button_cancel.png', IMAGE_CANCEL) . '</a>');
        break;
      case 'copy_to':
        $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_COPY_TO . '</b>');

        $contents = array('form' => tep_draw_form('copy_to', FILENAME_CATEGORIES, 'action=copy_to_confirm&amp;cPath=' . $cPath) . tep_draw_hidden_field('products_id', $pInfo->products_id));
        $contents[] = array('text' => TEXT_INFO_COPY_TO_INTRO);
        $contents[] = array('text' => '<br />' . TEXT_INFO_CURRENT_CATEGORIES . '<br /><b>' . tep_output_generated_category_path($pInfo->products_id, 'product') . '</b>');

/*
$contents[] = array('text' => '<br />' . TEXT_CATEGORIES . '<br />' . tep_draw_pull_down_menu('categories_id', tep_get_category_tree(), $current_category_id));
*/

// BOF: KategorienAdmin / OLISWISS
  if (is_array($admin_cat_access_array_cats) && (in_array("ALL",$admin_cat_access_array_cats)== false) && (pos($admin_cat_access_array_cats)!= "")) {
    $contents[] = array('text' => '<br />' . TEXT_CATEGORIES . '<br />' . tep_draw_pull_down_menu('categories_id', tep_get_category_tree('','','0','',$admin_cat_access_array_cats), $current_category_id));
  } else if (in_array("ALL",$admin_cat_access_array_cats)== true) { //nur Top-ADMIN
    $contents[] = array('text' => '<br />' . TEXT_CATEGORIES . '<br />' . tep_draw_pull_down_menu('categories_id', tep_get_category_tree(), $current_category_id));
  }
// EOF: KategorienAdmin / OLISWISS 

        $contents[] = array('text' => '<br />' . TEXT_HOW_TO_COPY . '<br />' . tep_draw_radio_field('copy_as', 'link', true) . ' ' . TEXT_COPY_AS_LINK . '<br />' . tep_draw_radio_field('copy_as', 'duplicate') . ' ' . TEXT_COPY_AS_DUPLICATE);
        $contents[] = array('align' => 'center', 'text' => '<br />' . tep_image_submit('button_copy.png', IMAGE_COPY) . ' <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&amp;pID=' . $pInfo->products_id) . '">' . tep_image_button('button_cancel.png', IMAGE_CANCEL) . '</a>');
        break;
      default:
        if ($rows > 0) {
          if (isset($cInfo) && is_object($cInfo)) { // category info box contents
            $category_path_string = '';
            $category_path = tep_generate_category_path($cInfo->categories_id);
            for ($i=(sizeof($category_path[0])-1); $i>0; $i--) {
              $category_path_string .= $category_path[0][$i]['id'] . '_';
            }
            $category_path_string = substr($category_path_string, 0, -1);

            $heading[] = array('text' => '<b>' . $cInfo->categories_name . '</b>');

// BOF: KategorienAdmin / OLISWISS
//            $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $category_path_string . '&cID=' . $cInfo->categories_id . '&action=edit_category') . '">' . tep_image_button('button_edit.png', IMAGE_EDIT) . '</a> <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $category_path_string . '&cID=' . $cInfo->categories_id . '&action=delete_category') . '">' . tep_image_button('button_delete.png', IMAGE_DELETE) . '</a> <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $category_path_string . '&cID=' . $cInfo->categories_id . '&action=move_category') . '">' . tep_image_button('button_move.png', IMAGE_MOVE) . '</a>');
        if ($admin_groups_id == 1) {
              $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $category_path_string . '&amp;cID=' . $cInfo->categories_id . '&amp;action=edit_category') . '">' . tep_image_button('button_edit.png', IMAGE_EDIT) . '</a> <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $category_path_string . '&amp;cID=' . $cInfo->categories_id . '&amp;action=delete_category') . '">' . tep_image_button('button_delete.png', IMAGE_DELETE) . '</a> <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $category_path_string . '&amp;cID=' . $cInfo->categories_id . '&amp;action=move_category') . '">' . tep_image_button('button_move.png', IMAGE_MOVE) . '</a>');
        } else {
          if (strstr($admin_right_access,"CEDIT")) {  
            $c_right_string .= ' <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $category_path_string . '&amp;cID=' . $cInfo->categories_id . '&amp;action=edit_category') . '">' . tep_image_button('button_edit.png', IMAGE_EDIT) . '</a>';
          }
          if (strstr($admin_right_access,"CDELETE")) {
              $c_right_string .= ' <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $category_path_string . '&amp;cID=' . $cInfo->categories_id . '&amp;action=delete_category') . '">' . tep_image_button('button_delete.png', IMAGE_DELETE) . '</a>';
          }
          if (strstr($admin_right_access,"CMOVE")) {
            $c_right_string .= ' <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $category_path_string . '&amp;cID=' . $cInfo->categories_id . '&amp;action=move_category') . '">' . tep_image_button('button_move.png', IMAGE_MOVE) . '</a>';
          }
        $contents[] = array('align' => 'center', 'text' => $c_right_string);
        }
// EOF: KategorienAdmin / OLISWISS  

            $contents[] = array('text' => '<br />' . TEXT_DATE_ADDED . ' ' . tep_date_short($cInfo->date_added));
            if (tep_not_null($cInfo->last_modified)) $contents[] = array('text' => TEXT_LAST_MODIFIED . ' ' . tep_date_short($cInfo->last_modified));
            $contents[] = array('text' => '<br />' . tep_info_image($cInfo->categories_image, $cInfo->categories_name, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT) . '<br />' . $cInfo->categories_image);
            $contents[] = array('text' => '<br />' . TEXT_SUBCATEGORIES . ' ' . $cInfo->childs_count . '<br />' . TEXT_PRODUCTS . ' ' . $cInfo->products_count);
          } elseif (isset($pInfo) && is_object($pInfo)) { // product info box contents
            $heading[] = array('text' => '<b>' . tep_get_products_name($pInfo->products_id, $languages_id) . '</b>');

// $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&amp;pID=' . $pInfo->products_id . '&amp;action=new_product') . '">' . tep_image_button('button_edit.png', IMAGE_EDIT) . '</a> <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&amp;pID=' . $pInfo->products_id . '&amp;action=delete_product') . '">' . tep_image_button('button_delete.png', IMAGE_DELETE) . '</a> <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&amp;pID=' . $pInfo->products_id . '&amp;action=move_product') . '">' . tep_image_button('button_move.png', IMAGE_MOVE) . '</a> <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&amp;pID=' . $pInfo->products_id . '&amp;action=copy_to') . '">' . tep_image_button('button_copy_to.png', IMAGE_COPY_TO) . '</a>');

// BOF: KategorienAdmin / OLISWISS
        if ($admin_groups_id == 1) {
              $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&amp;pID=' . $pInfo->products_id . '&amp;action=new_product') . '">' . tep_image_button('button_edit.png', IMAGE_EDIT) . '</a> <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&amp;pID=' . $pInfo->products_id . '&amp;action=delete_product') . '">' . tep_image_button('button_delete.png', IMAGE_DELETE) . '</a> <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&amp;pID=' . $pInfo->products_id . '&amp;action=move_product') . '">' . tep_image_button('button_move.png', IMAGE_MOVE) . '</a> <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&amp;pID=' . $pInfo->products_id . '&amp;action=copy_to') . '">' . tep_image_button('button_copy_to.png', IMAGE_COPY_TO) 
              . '</a>'
        /* Optional Related Products (ORP) */
             .'<a href="' . tep_href_link(FILENAME_RELATED_PRODUCTS, 'products_id_view=' . $pInfo->products_id) . '" >' . tep_image_button('button_related_products.png', IMAGE_RELATED_PRODUCTS) . '</a>'
             ); //ORP: end
        } else {
          if (strstr($admin_right_access,"PEDIT")) {  
            $p_right_string .= ' <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&amp;pID=' . $pInfo->products_id . '&amp;action=new_product') . '">' . tep_image_button('button_edit.png', IMAGE_EDIT) . '</a>';
          }
          if (strstr($admin_right_access,"PDELETE")) {
              $p_right_string .= ' <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&amp;pID=' . $pInfo->products_id . '&amp;action=delete_product') . '">' . tep_image_button('button_delete.png', IMAGE_DELETE) . '</a>';
          }
          if (strstr($admin_right_access,"PMOVE")) {
            $p_right_string .= ' <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&amp;pID=' . $pInfo->products_id . '&amp;action=move_product') . '">' . tep_image_button('button_move.png', IMAGE_MOVE) . '</a>';
          }
          if (strstr($admin_right_access,"PCOPY")) {
            $p_right_string .= ' <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&amp;pID=' . $pInfo->products_id . '&amp;action=copy_to') . '">' . tep_image_button('button_copy_to.png', IMAGE_COPY_TO) . '</a>';
          }
        $contents[] = array('align' => 'center', 'text' => $p_right_string);
        }
// EOF: KategorienAdmin / OLISWISS

            $contents[] = array('text' => '<br />' . TEXT_DATE_ADDED . ' ' . tep_date_short($pInfo->products_date_added));
            if (tep_not_null($pInfo->products_last_modified)) $contents[] = array('text' => TEXT_LAST_MODIFIED . ' ' . tep_date_short($pInfo->products_last_modified));
            if (date('Y-m-d') < $pInfo->products_date_available) $contents[] = array('text' => TEXT_DATE_AVAILABLE . ' ' . tep_date_short($pInfo->products_date_available));
            $contents[] = array('text' => '<br />' . tep_info_image($pInfo->products_image, $pInfo->products_name, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '<br />' . $pInfo->products_image);

//060417/zepitt/multi images extra modif # 12
for($nb=1; $nb <= NB_IMAGE_EXTRA ; $nb++) {
    $products_image = "products_image".$nb;
    $contents[] = array('text' => '<br />' . $nb . ' - ' . tep_info_image_extra($pInfo->$products_image, $pInfo->products_name, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '<br />' . $pInfo->$products_image);
}
//060417/zepitt/multi images extra EOF

            $contents[] = array('text' => '<br />' . TEXT_PRODUCTS_COST_INFO . ' ' . $currencies->format($pInfo->products_cost) . '<br />' . TEXT_PRODUCTS_PRICE_INFO . ' ' . $currencies->format($pInfo->products_price) . '<br /><br />' . TEXT_PRODUCTS_PROFIT_INFO . ' ' . $currencies->format($pInfo->products_price-$pInfo->products_cost) . '<br /><br />' . TEXT_PRODUCTS_QUANTITY_INFO . ' ' . $pInfo->products_quantity);
            $contents[] = array('text' => '<br />' . TEXT_PRODUCTS_AVERAGE_RATING . ' ' . number_format($pInfo->average_rating, 2) . '%');
          }
        } else { // create category/product info
          $heading[] = array('text' => '<b>' . EMPTY_CATEGORY . '</b>');

          $contents[] = array('text' => TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS);
        }
        break;
    }

    if ( (tep_not_null($heading)) && (tep_not_null($contents)) ) {
      echo '            <td width="25%" valign="top">' . "\n";

      $box = new box;
      echo $box->infoBox($heading, $contents);

      echo '            </td>' . "\n";
    }
?>
          </tr>
        </table></td>
      </tr>
    </table>
<?php
  }
?>
    </td>
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