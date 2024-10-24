<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2020 osCommerce

  Released under the GNU General Public License
 */

require 'includes/application_top.php';

require 'includes/classes/currencies.php';
$currencies = new currencies();

$action = ($_GET['action'] ?? '');

if (tep_not_null($action)) {
    // ULTIMATE Seo Urls 5 PRO by FWR Media
    // If the action will affect the cache entries
    if ($action === 'insert' || $action === 'update' || $action === 'setflag') {
        tep_reset_cache_data_usu5('reset');
    }
}

$OSCOM_Hooks->call('categories', 'productPreAction');

if (!empty($action)) {
    switch ($action) {
        case 'setflag':
            if (($_GET['flag'] === '0') || ($_GET['flag'] === '1')) {
                if (isset($_GET['pID'])) {
                    tep_set_product_status($_GET['pID'], $_GET['flag']);
                }

                if (USE_CACHE === 'true') {
                    tep_reset_cache_block('categories');
                    tep_reset_cache_block('also_purchased');
                }
            }

            tep_redirect(tep_href_link('categories.php', 'cPath='.$_GET['cPath'].'&pID='.$_GET['pID']));

            break;
        case 'insert_category':
        case 'update_category':
            if (isset($_POST['categories_id'])) {
                $categories_id = tep_db_prepare_input($_POST['categories_id']);
            }

            $sort_order = tep_db_prepare_input($_POST['sort_order']);

            $sql_data_array = ['sort_order' => (int) $sort_order];

            if ($action === 'insert_category') {
                $insert_sql_data = ['parent_id' => $current_category_id,
                    'date_added' => 'now()'];

                $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

                tep_db_perform('categories', $sql_data_array);

                $categories_id = tep_db_insert_id();
            } elseif ($action === 'update_category') {
                $update_sql_data = ['last_modified' => 'now()'];

                $sql_data_array = array_merge($sql_data_array, $update_sql_data);

                tep_db_perform('categories', $sql_data_array, 'update', "categories_id = '".(int) $categories_id."'");
            }

            $languages = tep_get_languages();

            for ($i = 0, $n = \count($languages); $i < $n; ++$i) {
                $categories_name_array = $_POST['categories_name'];
                $categories_description_array = $_POST['categories_description'];

                $language_id = $languages[$i]['id'];

                $sql_data_array = ['categories_name' => tep_db_prepare_input($categories_name_array[$language_id]),
                    'categories_description' => tep_db_prepare_input($categories_description_array[$language_id])];

                if ($action === 'insert_category') {
                    $insert_sql_data = ['categories_id' => $categories_id,
                        'language_id' => $languages[$i]['id']];

                    $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

                    tep_db_perform('categories_description', $sql_data_array);
                } elseif ($action === 'update_category') {
                    tep_db_perform('categories_description', $sql_data_array, 'update', "categories_id = '".(int) $categories_id."' and language_id = '".(int) $languages[$i]['id']."'");
                }
            }

            $categories_image = new upload('categories_image');
            $categories_image->set_destination(DIR_FS_CATALOG.'images/categories/');

            if ($categories_image->parse() && $categories_image->save()) {
                tep_db_query("update categories set categories_image = '".tep_db_input($categories_image->filename)."' where categories_id = '".(int) $categories_id."'");
            }

            if (USE_CACHE === 'true') {
                tep_reset_cache_block('categories');
                tep_reset_cache_block('also_purchased');
            }

            tep_redirect(tep_href_link('categories.php', 'cPath='.$cPath.'&cID='.$categories_id));

            break;
        case 'delete_category_confirm':
            if (isset($_POST['categories_id']) && is_numeric($_POST['categories_id']) && ((int) $_POST['categories_id'] > 0)) {
                $categories_id = tep_db_prepare_input($_POST['categories_id']);

                $categories = tep_get_category_tree($categories_id, '', '0', '', true);
                $products = [];
                $products_delete = [];

                for ($i = 0, $n = \count($categories); $i < $n; ++$i) {
                    $product_ids_query = tep_db_query("select products_id from products_to_categories where categories_id = '".(int) $categories[$i]['id']."'");

                    while ($product_ids = tep_db_fetch_array($product_ids_query)) {
                        $products[$product_ids['products_id']]['categories'][] = $categories[$i]['id'];
                    }
                }

                foreach ($products as $key => $value) {
                    $category_ids = '';

                    for ($i = 0, $n = \count($value['categories']); $i < $n; ++$i) {
                        $category_ids .= "'".(int) $value['categories'][$i]."', ";
                    }

                    $category_ids = substr($category_ids, 0, -2);

                    $check_query = tep_db_query("select count(*) as total from products_to_categories where products_id = '".(int) $key."' and categories_id not in (".$category_ids.')');
                    $check = tep_db_fetch_array($check_query);

                    if ($check['total'] < '1') {
                        $products_delete[$key] = $key;
                    }
                }

                // removing categories can be a lengthy process
                tep_set_time_limit(0);

                for ($i = 0, $n = \count($categories); $i < $n; ++$i) {
                    tep_remove_category($categories[$i]['id']);
                }

                foreach (array_keys($products_delete) as $key) {
                    tep_remove_product($key);
                }
            }

            if (USE_CACHE === 'true') {
                tep_reset_cache_block('categories');
                tep_reset_cache_block('also_purchased');
            }

            tep_redirect(tep_href_link('categories.php', 'cPath='.$cPath));

            break;
        case 'delete_product_confirm':
            if (isset($_POST['products_id'], $_POST['product_categories']) && \is_array($_POST['product_categories'])) {
                $product_id = tep_db_prepare_input($_POST['products_id']);
                $product_categories = $_POST['product_categories'];

                for ($i = 0, $n = \count($product_categories); $i < $n; ++$i) {
                    tep_db_query("delete from products_to_categories where products_id = '".(int) $product_id."' and categories_id = '".(int) $product_categories[$i]."'");
                }

                $product_categories_query = tep_db_query("select count(*) as total from products_to_categories where products_id = '".(int) $product_id."'");
                $product_categories = tep_db_fetch_array($product_categories_query);

                if ($product_categories['total'] === '0') {
                    tep_remove_product($product_id);
                }
            }

            if (USE_CACHE === 'true') {
                tep_reset_cache_block('categories');
                tep_reset_cache_block('also_purchased');
            }

            $OSCOM_Hooks->call('categories', 'productActionDelete');

            tep_redirect(tep_href_link('categories.php', 'cPath='.$cPath));

            break;
        case 'move_category_confirm':
            if (isset($_POST['categories_id']) && ($_POST['categories_id'] !== $_POST['move_to_category_id'])) {
                $categories_id = tep_db_prepare_input($_POST['categories_id']);
                $new_parent_id = tep_db_prepare_input($_POST['move_to_category_id']);

                $path = explode('_', tep_get_generated_category_path_ids($new_parent_id));

                if (\in_array($categories_id, $path, true)) {
                    $messageStack->add_session(ERROR_CANNOT_MOVE_CATEGORY_TO_PARENT, 'error');

                    tep_redirect(tep_href_link('categories.php', 'cPath='.$cPath.'&cID='.$categories_id));
                } else {
                    tep_db_query("update categories set parent_id = '".(int) $new_parent_id."', last_modified = now() where categories_id = '".(int) $categories_id."'");

                    if (USE_CACHE === 'true') {
                        tep_reset_cache_block('categories');
                        tep_reset_cache_block('also_purchased');
                    }

                    tep_redirect(tep_href_link('categories.php', 'cPath='.$new_parent_id.'&cID='.$categories_id));
                }
            }

            break;
        case 'move_product_confirm':
            $products_id = tep_db_prepare_input($_POST['products_id']);
            $new_parent_id = tep_db_prepare_input($_POST['move_to_category_id']);

            $duplicate_check_query = tep_db_query("select count(*) as total from products_to_categories where products_id = '".(int) $products_id."' and categories_id = '".(int) $new_parent_id."'");
            $duplicate_check = tep_db_fetch_array($duplicate_check_query);

            if ($duplicate_check['total'] < 1) {
                tep_db_query("update products_to_categories set categories_id = '".(int) $new_parent_id."' where products_id = '".(int) $products_id."' and categories_id = '".(int) $current_category_id."'");
            }

            if (USE_CACHE === 'true') {
                tep_reset_cache_block('categories');
                tep_reset_cache_block('also_purchased');
            }

            $OSCOM_Hooks->call('categories', 'productActionMove');

            tep_redirect(tep_href_link('categories.php', 'cPath='.$new_parent_id.'&pID='.$products_id));

            break;
        case 'insert_product':
        case 'update_product':
            if (isset($_GET['pID'])) {
                $products_id = tep_db_prepare_input($_GET['pID']);
            }

            $products_date_available = tep_db_prepare_input($_POST['products_date_available']);

            $products_date_available = (date('Y-m-d') < $products_date_available) ? $products_date_available : 'null';

            $sql_data_array = ['products_quantity' => (int) tep_db_prepare_input($_POST['products_quantity']),
                'products_model' => tep_db_prepare_input($_POST['products_model']),
                'products_price' => tep_db_prepare_input($_POST['products_price']),
                'products_date_available' => $products_date_available,
                'products_weight' => (float) tep_db_prepare_input($_POST['products_weight']),
                'products_status' => tep_db_prepare_input($_POST['products_status']),
                'products_tax_class_id' => tep_db_prepare_input($_POST['products_tax_class_id']),
                'manufacturers_id' => (int) tep_db_prepare_input($_POST['manufacturers_id'])];

            $products_image = new upload('products_image');
            $products_image->set_destination(DIR_FS_CATALOG.'images/products/originals/');

            if ($products_image->parse() && $products_image->save()) {
                tep_resize_image(DIR_FS_CATALOG.'images/products/originals/'.$products_image->filename, DIR_FS_CATALOG.'images/products/thumbs/'.$products_image->filename, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, 90);

                $sql_data_array['products_image'] = tep_db_prepare_input($products_image->filename);
            }

            if ($action === 'insert_product') {
                $insert_sql_data = ['products_date_added' => 'now()'];

                $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

                tep_db_perform('products', $sql_data_array);
                $products_id = tep_db_insert_id();

                tep_db_query("insert into products_to_categories (products_id, categories_id) values ('".(int) $products_id."', '".(int) $current_category_id."')");
            } elseif ($action === 'update_product') {
                $update_sql_data = ['products_last_modified' => 'now()'];

                $sql_data_array = array_merge($sql_data_array, $update_sql_data);

                tep_db_perform('products', $sql_data_array, 'update', "products_id = '".(int) $products_id."'");
            }

            $languages = tep_get_languages();

            for ($i = 0, $n = \count($languages); $i < $n; ++$i) {
                $language_id = $languages[$i]['id'];

                $sql_data_array = ['products_name' => tep_db_prepare_input($_POST['products_name'][$language_id]),
                    'products_description' => tep_db_prepare_input($_POST['products_description'][$language_id]),
                    'products_url' => tep_db_prepare_input($_POST['products_url'][$language_id])];

                if ($action === 'insert_product') {
                    $insert_sql_data = ['products_id' => $products_id,
                        'language_id' => $language_id];

                    $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

                    tep_db_perform('products_description', $sql_data_array);
                } elseif ($action === 'update_product') {
                    tep_db_perform('products_description', $sql_data_array, 'update', "products_id = '".(int) $products_id."' and language_id = '".(int) $language_id."'");
                }
            }

            $pi_sort_order = 0;
            $piArray = [0];

            foreach ($_FILES as $key => $value) {
                // Update existing large product images
                if (preg_match('/^products_image_large_([0-9]+)$/', $key, $matches)) {
                    ++$pi_sort_order;

                    $sql_data_array = ['htmlcontent' => tep_db_prepare_input($_POST['products_image_htmlcontent_'.$matches[1]]),
                        'sort_order' => $pi_sort_order];

                    $t = new upload($key);
                    $t->set_destination(DIR_FS_CATALOG.'images/products/originals/');

                    if ($t->parse() && $t->save()) {
                        tep_resize_image(DIR_FS_CATALOG.'images/products/originals/'.$t->filename, DIR_FS_CATALOG.'images/products/thumbs/'.$t->filename, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, 90);

                        $sql_data_array['image'] = tep_db_prepare_input($t->filename);
                    }

                    tep_db_perform('products_images', $sql_data_array, 'update', "products_id = '".(int) $products_id."' and id = '".(int) $matches[1]."'");

                    $piArray[] = (int) $matches[1];
                } elseif (preg_match('/^products_image_large_new_([0-9]+)$/', $key, $matches)) {
                    // Insert new large product images
                    $sql_data_array = ['products_id' => (int) $products_id,
                        'htmlcontent' => tep_db_prepare_input($_POST['products_image_htmlcontent_new_'.$matches[1]])];

                    $t = new upload($key);
                    $t->set_destination(DIR_FS_CATALOG.'images/products/originals/');

                    if ($t->parse() && $t->save()) {
                        tep_resize_image(DIR_FS_CATALOG.'images/products/originals/'.$t->filename, DIR_FS_CATALOG.'images/products/thumbs/'.$t->filename, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, 90);

                        ++$pi_sort_order;

                        $sql_data_array['image'] = tep_db_prepare_input($t->filename);
                        $sql_data_array['sort_order'] = $pi_sort_order;

                        tep_db_perform('products_images', $sql_data_array);

                        $piArray[] = tep_db_insert_id();
                    }
                }
            }

            $product_images_query = tep_db_query("select image from products_images where products_id = '".(int) $products_id."' and id not in (".implode(',', $piArray).')');

            if (tep_db_num_rows($product_images_query)) {
                while ($product_images = tep_db_fetch_array($product_images_query)) {
                    $duplicate_image_query = tep_db_query("select count(*) as total from products_images where image = '".tep_db_input($product_images['image'])."'");
                    $duplicate_image = tep_db_fetch_array($duplicate_image_query);

                    if ($duplicate_image['total'] < 2) {
                        if (file_exists(DIR_FS_CATALOG.'images/products/originals/'.$product_images['image'])) {
                            @unlink(DIR_FS_CATALOG.'images/products/originals/'.$product_images['image']);
                        }

                        if (file_exists(DIR_FS_CATALOG.'images/products/thumbs/'.$product_images['image'])) {
                            @unlink(DIR_FS_CATALOG.'images/products/thumbs/'.$product_images['image']);
                        }
                    }
                }

                tep_db_query("delete from products_images where products_id = '".(int) $products_id."' and id not in (".implode(',', $piArray).')');
            }

            if (USE_CACHE === 'true') {
                tep_reset_cache_block('categories');
                tep_reset_cache_block('also_purchased');
            }

            $OSCOM_Hooks->call('categories', 'productActionSave');

            tep_redirect(tep_href_link('categories.php', 'cPath='.$cPath.'&pID='.$products_id));

            break;
        case 'copy_to_confirm':
            if (isset($_POST['products_id'], $_POST['categories_id'])) {
                $products_id = tep_db_prepare_input($_POST['products_id']);
                $categories_id = tep_db_prepare_input($_POST['categories_id']);

                if ($_POST['copy_as'] === 'link') {
                    if ($categories_id !== $current_category_id) {
                        $check_query = tep_db_query("select count(*) as total from products_to_categories where products_id = '".(int) $products_id."' and categories_id = '".(int) $categories_id."'");
                        $check = tep_db_fetch_array($check_query);

                        if ($check['total'] < '1') {
                            tep_db_query("insert into products_to_categories (products_id, categories_id) values ('".(int) $products_id."', '".(int) $categories_id."')");
                        }
                    } else {
                        $messageStack->add_session(ERROR_CANNOT_LINK_TO_SAME_CATEGORY, 'error');
                    }
                } elseif ($_POST['copy_as'] === 'duplicate') {
                    $product_query = tep_db_query("select products_quantity, products_model, products_image, products_price, products_date_available, products_weight, products_tax_class_id, manufacturers_id from products where products_id = '".(int) $products_id."'");
                    $product = tep_db_fetch_array($product_query);

                    tep_db_query("insert into products (products_quantity, products_model,products_image, products_price, products_date_added, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id) values ('".tep_db_input($product['products_quantity'])."', '".tep_db_input($product['products_model'])."', '".tep_db_input($product['products_image'])."', '".tep_db_input($product['products_price'])."',  now(), ".(empty($product['products_date_available']) ? 'null' : "'".tep_db_input($product['products_date_available'])."'").", '".tep_db_input($product['products_weight'])."', '0', '".(int) $product['products_tax_class_id']."', '".(int) $product['manufacturers_id']."')");
                    $dup_products_id = tep_db_insert_id();

                    $description_query = tep_db_query("select language_id, products_name, products_description, products_url from products_description where products_id = '".(int) $products_id."'");

                    while ($description = tep_db_fetch_array($description_query)) {
                        tep_db_query("insert into products_description (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('".(int) $dup_products_id."', '".(int) $description['language_id']."', '".tep_db_input($description['products_name'])."', '".tep_db_input($description['products_description'])."', '".tep_db_input($description['products_url'])."', '0')");
                    }

                    $product_images_query = tep_db_query("select image, htmlcontent, sort_order from products_images where products_id = '".(int) $products_id."'");

                    while ($product_images = tep_db_fetch_array($product_images_query)) {
                        tep_db_query("insert into products_images (products_id, image, htmlcontent, sort_order) values ('".(int) $dup_products_id."', '".tep_db_input($product_images['image'])."', '".tep_db_input($product_images['htmlcontent'])."', '".tep_db_input($product_images['sort_order'])."')");
                    }

                    tep_db_query("insert into products_to_categories (products_id, categories_id) values ('".(int) $dup_products_id."', '".(int) $categories_id."')");
                    $products_id = $dup_products_id;
                }

                if (USE_CACHE === 'true') {
                    tep_reset_cache_block('categories');
                    tep_reset_cache_block('also_purchased');
                }
            }

            $OSCOM_Hooks->call('categories', 'productActionCopy');

            tep_redirect(tep_href_link('categories.php', 'cPath='.$categories_id.'&pID='.$products_id));

            break;
    }
}

$OSCOM_Hooks->call('categories', 'productPostAction');

// check if the catalog image directory exists
if (is_dir(DIR_FS_CATALOG.'images/')) {
    if (!tep_is_writable(DIR_FS_CATALOG.'images/')) {
        $messageStack->add(ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE, 'error');
    }
} else {
    $messageStack->add(ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST, 'error');
}

require 'includes/template_top.php';

$base_url = ($request_type === 'SSL') ? HTTPS_SERVER.DIR_WS_HTTPS_ADMIN : HTTP_SERVER.DIR_WS_ADMIN;

if ($action === 'new_product') {
    $parameters = ['products_name' => '',
        'products_description' => '',
        'products_url' => '',
        'products_id' => '',
        'products_quantity' => '',
        'products_model' => '',
        'products_image' => '',
        'products_larger_images' => [],
        'products_price' => '',
        'products_weight' => '',
        'products_date_added' => '',
        'products_last_modified' => '',
        'products_date_available' => '',
        'products_status' => '',
        'products_tax_class_id' => '',
        'manufacturers_id' => ''];

    $pInfo = new objectInfo($parameters);

    if (isset($_GET['pID']) && empty($_POST)) {
        $product_query = tep_db_query("select pd.products_name, pd.products_description, pd.products_url, p.products_id, p.products_quantity, p.products_model, p.products_image, p.products_price, p.products_weight, p.products_date_added, p.products_last_modified, date_format(p.products_date_available, '%Y-%m-%d') as products_date_available, p.products_status, p.products_tax_class_id, p.manufacturers_id from products p, products_description pd where p.products_id = '".(int) $_GET['pID']."' and p.products_id = pd.products_id and pd.language_id = '".(int) $languages_id."'");
        $product = tep_db_fetch_array($product_query);
        class pInfo_objectInfo extends objectInfo
        {
        }
        $pInfo = new pInfo_objectInfo($product); // TODO!

        //        $pInfo->pInfo_objectInfo($product);

        $product_images_query = tep_db_query("select id, image, htmlcontent, sort_order from products_images where products_id = '".(int) $product['products_id']."' order by sort_order");

        while ($product_images = tep_db_fetch_array($product_images_query)) {
            $pInfo->products_larger_images[] = ['id' => $product_images['id'],
                'image' => $product_images['image'],
                'htmlcontent' => $product_images['htmlcontent'],
                'sort_order' => $product_images['sort_order']];
        }
    }

    $manufacturers_array = [['id' => '', 'text' => TEXT_NONE]];
    $manufacturers_query = tep_db_query('select manufacturers_id, manufacturers_name from manufacturers order by manufacturers_name');

    while ($manufacturers = tep_db_fetch_array($manufacturers_query)) {
        $manufacturers_array[] = ['id' => $manufacturers['manufacturers_id'],
            'text' => $manufacturers['manufacturers_name']];
    }

    $tax_class_array = [['id' => '0', 'text' => TEXT_NONE]];
    $tax_class_query = tep_db_query('select tax_class_id, tax_class_title from tax_class order by tax_class_title');

    while ($tax_class = tep_db_fetch_array($tax_class_query)) {
        $tax_class_array[] = ['id' => $tax_class['tax_class_id'],
            'text' => $tax_class['tax_class_title']];
    }

    $languages = tep_get_languages();

    if (!isset($pInfo->products_status)) {
        $pInfo->products_status = '1';
    }

    switch ($pInfo->products_status) {
        case '0': $in_status = false;
            $out_status = true;

            break;
        case '1':
        default: $in_status = true;
            $out_status = false;
    }

    $form_action = (isset($_GET['pID'])) ? 'update_product' : 'insert_product';
    ?>
<script>
var tax_rates = new Array();
<?php
        for ($i = 0, $n = \count($tax_class_array); $i < $n; ++$i) {
            if ($tax_class_array[$i]['id'] > 0) {
                echo 'tax_rates["'.$tax_class_array[$i]['id'].'"] = '.tep_get_tax_rate_value($tax_class_array[$i]['id']).";\n";
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

function updateGross() {
  var taxRate = getTaxRate();
  var grossValue = document.forms["new_product"].products_price.value;

  if (taxRate > 0) {
    grossValue = grossValue * ((taxRate / 100) + 1);
  }

  document.forms["new_product"].products_price_gross.value = doRound(grossValue, 4);
}

function updateNet() {
  var taxRate = getTaxRate();
  var netValue = document.forms["new_product"].products_price_gross.value;

  if (taxRate > 0) {
    netValue = netValue / ((taxRate / 100) + 1);
  }

  document.forms["new_product"].products_price.value = doRound(netValue, 4);
}
</script>

<?php echo tep_draw_form('new_product', 'categories.php', 'cPath='.$cPath.(isset($_GET['pID']) ? '&pID='.$_GET['pID'] : '').'&action='.$form_action, 'post', 'enctype="multipart/form-data"'); ?>

<h1 class="pageHeading"><?php echo sprintf(TEXT_NEW_PRODUCT, empty($current_category_id) ? '' : tep_output_generated_category_path($current_category_id)); ?></h1>

<div id="productTabs" style="overflow: auto;">
  <ul id="productTabsMain">
    <li><?php echo '<a href="'.substr(tep_href_link('categories.php', tep_get_all_get_params()), \strlen($base_url)).'#section_general_content">'.SECTION_HEADING_GENERAL.'</a>'; ?></li>
    <li><?php echo '<a href="'.substr(tep_href_link('categories.php', tep_get_all_get_params()), \strlen($base_url)).'#section_data_content">'.SECTION_HEADING_DATA.'</a>'; ?></li>
    <li><?php echo '<a href="'.substr(tep_href_link('categories.php', tep_get_all_get_params()), \strlen($base_url)).'#section_images_content">'.SECTION_HEADING_IMAGES.'</a>'; ?></li>
  </ul>

  <div id="section_general_content" style="padding: 10px;">
    <div id="productLanguageTabs">
      <ul>

<?php
        for ($i = 0, $n = \count($languages); $i < $n; ++$i) {
            echo '<li><a href="'.substr(tep_href_link('categories.php', tep_get_all_get_params()), \strlen($base_url)).'#section_general_content_'.$languages[$i]['directory'].'">'.$languages[$i]['name'].'</a></li>';
        }

    ?>

      </ul>

<?php
        for ($i = 0, $n = \count($languages); $i < $n; ++$i) {
            ?>

      <div id="section_general_content_<?php echo $languages[$i]['directory']; ?>">
        <table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><?php echo TEXT_PRODUCTS_NAME; ?></td>
            <td class="main"><?php echo tep_draw_input_field('products_name['.$languages[$i]['id'].']', ($pInfo->products_id < 1) ? '' : tep_get_products_name($pInfo->products_id, $languages[$i]['id'])); ?></td>
          </tr>
          <tr>
            <td class="main" valign="top"><?php echo TEXT_PRODUCTS_DESCRIPTION; ?></td>
            <td class="main"><?php echo tep_draw_textarea_summernote('products_description['.$languages[$i]['id'].']', 'soft', '70', '15', ($pInfo->products_id < 1) ? '' : fix_editor_output(tep_get_products_description($pInfo->products_id, $languages[$i]['id']))); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo TEXT_PRODUCTS_URL.'<br /><small>'.TEXT_PRODUCTS_URL_WITHOUT_HTTP.'</small>'; ?></td>
            <td class="main"><?php echo tep_draw_input_field('products_url['.$languages[$i]['id'].']', ($pInfo->products_id < 1) ? '' : tep_get_products_url($pInfo->products_id, $languages[$i]['id'])); ?></td>
          </tr>
        </table>
      </div>

<?php
        }

    ?>

    </div>
  </div>

  <div id="section_data_content" style="padding: 10px;">
    <table border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td class="main"><?php echo TEXT_PRODUCTS_STATUS; ?></td>
        <td class="main"><?php echo tep_draw_radio_field('products_status', '1', $in_status).'&nbsp;'.TEXT_PRODUCT_AVAILABLE.'&nbsp;'.tep_draw_radio_field('products_status', '0', $out_status).'&nbsp;'.TEXT_PRODUCT_NOT_AVAILABLE; ?></td>
      </tr>
      <tr>
        <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td class="main"><?php echo TEXT_PRODUCTS_DATE_AVAILABLE; ?></td>
        <td class="main"><?php echo tep_draw_input_field('products_date_available', $pInfo->products_date_available, 'id="products_date_available"').' <small>(YYYY-MM-DD)</small>'; ?></td>
      </tr>
      <tr>
        <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td class="main"><?php echo TEXT_PRODUCTS_MANUFACTURER; ?></td>
        <td class="main"><?php echo tep_draw_pull_down_menu('manufacturers_id', $manufacturers_array, $pInfo->manufacturers_id); ?></td>
      </tr>
      <tr>
        <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr bgcolor="#ebebff">
        <td class="main"><?php echo TEXT_PRODUCTS_TAX_CLASS; ?></td>
        <td class="main"><?php echo tep_draw_pull_down_menu('products_tax_class_id', $tax_class_array, $pInfo->products_tax_class_id, 'onchange="updateGross()"'); ?></td>
      </tr>
      <tr bgcolor="#ebebff">
        <td class="main"><?php echo TEXT_PRODUCTS_PRICE_NET; ?></td>
        <td class="main"><?php echo tep_draw_input_field('products_price', $pInfo->products_price, 'onkeyup="updateGross()"'); ?></td>
      </tr>
      <tr bgcolor="#ebebff">
        <td class="main"><?php echo TEXT_PRODUCTS_PRICE_GROSS; ?></td>
        <td class="main"><?php echo tep_draw_input_field('products_price_gross', $pInfo->products_price, 'onkeyup="updateNet()"'); ?></td>
      </tr>
      <tr>
        <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
<script>
updateGross();
</script>
      <tr>
        <td class="main"><?php echo TEXT_PRODUCTS_QUANTITY; ?></td>
        <td class="main"><?php echo tep_draw_input_field('products_quantity', $pInfo->products_quantity); ?></td>
      </tr>
      <tr>
        <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td class="main"><?php echo TEXT_PRODUCTS_MODEL; ?></td>
        <td class="main"><?php echo tep_draw_input_field('products_model', $pInfo->products_model); ?></td>
      </tr>
      <tr>
        <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td class="main"><?php echo TEXT_PRODUCTS_WEIGHT; ?></td>
        <td class="main"><?php echo tep_draw_input_field('products_weight', $pInfo->products_weight); ?></td>
      </tr>
    </table>
  </div>

  <div id="section_images_content" style="padding: 10px;">
    <div><?php echo '<strong>'.TEXT_PRODUCTS_MAIN_IMAGE.' <small>('.SMALL_IMAGE_WIDTH.' x '.SMALL_IMAGE_HEIGHT.'px)</small></strong><br />'.tep_draw_file_field('products_image').(!empty($pInfo->products_image) ? '<br /><a href="'.HTTP_CATALOG_SERVER.DIR_WS_CATALOG_IMAGES.'products/originals/'.$pInfo->products_image.'" target="_blank">'.tep_info_image('products/thumbs/'.$pInfo->products_image, $pInfo->products_name, SMALL_IMAGE_WIDTH / 2, SMALL_IMAGE_HEIGHT / 2).'</a>' : ''); ?></div>

    <ul id="piList">
<?php
        $pi_counter = 0;

    foreach ($pInfo->products_larger_images as $pi) {
        ++$pi_counter;

        echo '      <li id="piId'.$pi_counter.'" class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s" style="float: right;"></span><a href="#" onclick="showPiDelConfirm('.$pi_counter.');return false;" class="ui-icon ui-icon-trash" style="float: right;"></a><strong>'.TEXT_PRODUCTS_LARGE_IMAGE.'</strong><br />'.tep_draw_file_field('products_image_large_'.$pi['id']).'<br /><a href="'.HTTP_CATALOG_SERVER.DIR_WS_CATALOG_IMAGES.'products/originals/'.$pi['image'].'" target="_blank">'.tep_info_image('products/thumbs/'.$pi['image'], $pInfo->products_name, SMALL_IMAGE_WIDTH / 2, SMALL_IMAGE_HEIGHT / 2).'</a><br /><br />'.TEXT_PRODUCTS_LARGE_IMAGE_HTML_CONTENT.'<br />'.tep_draw_textarea_field('products_image_htmlcontent_'.$pi['id'], 'soft', '70', '3', $pi['htmlcontent']).'</li>';
    }

    ?>
    </ul>

    <a href="#" onclick="addNewPiForm();return false;"><span class="ui-icon ui-icon-plus" style="float: left;"></span><?php echo TEXT_PRODUCTS_ADD_LARGE_IMAGE; ?></a>

<div id="piDelConfirm" title="<?php echo TEXT_PRODUCTS_LARGE_IMAGE_DELETE_TITLE; ?>">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span><?php echo TEXT_PRODUCTS_LARGE_IMAGE_CONFIRM_DELETE; ?></p>
</div>

<style type="text/css">
#piList { list-style-type: none; margin: 0; padding: 0; }
#piList li { margin: 5px 0; padding: 2px; }
</style>

<script>
$('#piList').sortable({
  containment: 'parent'
});

var piSize = <?php echo $pi_counter; ?>;

function addNewPiForm() {
  piSize++;

  $('#piList').append('<li id="piId' + piSize + '" class="ui-state-default"><span class="ui-icon ui-icon-arrowthick-2-n-s" style="float: right;"></span><a href="#" onclick="showPiDelConfirm(' + piSize + ');return false;" class="ui-icon ui-icon-trash" style="float: right;"></a><strong><?php echo TEXT_PRODUCTS_LARGE_IMAGE; ?></strong><br /><input type="file" name="products_image_large_new_' + piSize + '" /><br /><br /><?php echo TEXT_PRODUCTS_LARGE_IMAGE_HTML_CONTENT; ?><br /><textarea name="products_image_htmlcontent_new_' + piSize + '" wrap="soft" cols="70" rows="3"></textarea></li>');
}

var piDelConfirmId = 0;

$('#piDelConfirm').dialog({
  autoOpen: false,
  resizable: false,
  draggable: false,
  modal: true,
  buttons: {
    'Delete': function() {
      $('#piId' + piDelConfirmId).effect('blind').remove();
      $(this).dialog('close');
    },
    Cancel: function() {
      $(this).dialog('close');
    }
  }
});

function showPiDelConfirm(piId) {
  piDelConfirmId = piId;

  $('#piDelConfirm').dialog('open');
}
</script>
  </div>

<?php
        echo $OSCOM_Hooks->call('categories', 'productTab');
    ?>

</div>

<script>
$(function() {
  $('#productTabs').tabs();
  $('#productLanguageTabs').tabs();
});
</script>

<div style="padding-top: 15px; text-align: right;">
  <?php echo tep_draw_hidden_field('products_date_added', !empty($pInfo->products_date_added) ? $pInfo->products_date_added : date('Y-m-d')).tep_draw_button(IMAGE_SAVE, 'disk', null, 'primary').tep_draw_button(IMAGE_CANCEL, 'close', tep_href_link('categories.php', 'cPath='.$cPath.(isset($_GET['pID']) ? '&pID='.$_GET['pID'] : ''))); ?>
</div>

<script>
$('#products_date_available').datepicker({
  dateFormat: 'yy-mm-dd'
});
</script>

</form>

<?php
} elseif ($action === 'new_product_preview') {
    $product_query = tep_db_query("select p.products_id, pd.language_id, pd.products_name, pd.products_description, pd.products_url, p.products_quantity, p.products_model, p.products_image, p.products_price, p.products_weight, p.products_date_added, p.products_last_modified, p.products_date_available, p.products_status, p.manufacturers_id  from products p, products_description pd where p.products_id = pd.products_id and p.products_id = '".(int) $_GET['pID']."'");
    $product = tep_db_fetch_array($product_query);

    $pInfo = new objectInfo($product);
    $products_image_name = $pInfo->products_image;

    $languages = tep_get_languages();

    for ($i = 0, $n = \count($languages); $i < $n; ++$i) {
        $pInfo->products_name = tep_get_products_name($pInfo->products_id, $languages[$i]['id']);
        $pInfo->products_description = tep_get_products_description($pInfo->products_id, $languages[$i]['id']);
        $pInfo->products_url = tep_get_products_url($pInfo->products_id, $languages[$i]['id']);
        ?>
    <table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo tep_image(tep_catalog_href_link('includes/languages/'.$languages[$i]['directory'].'/images/'.$languages[$i]['image']), $languages[$i]['name']).'&nbsp;'.$pInfo->products_name; ?></td>
            <td class="pageHeading" align="right"><?php echo $currencies->format($pInfo->products_price); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td class="main"><?php echo tep_image(HTTP_CATALOG_SERVER.DIR_WS_CATALOG_IMAGES.$products_image_name, $pInfo->products_name, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, 'align="right" hspace="5" vspace="5"').$pInfo->products_description; ?></td>
      </tr>
<?php
              if ($pInfo->products_url) {
                  ?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td class="main"><?php echo sprintf(TEXT_PRODUCT_MORE_INFORMATION, $pInfo->products_url); ?></td>
      </tr>
<?php
              }

        ?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
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
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
<?php
    }

    if (isset($_GET['origin'])) {
        $pos_params = strpos($_GET['origin'], '?', 0);

        if ($pos_params !== false) {
            $back_url = substr($_GET['origin'], 0, $pos_params);
            $back_url_params = substr($_GET['origin'], $pos_params + 1);
        } else {
            $back_url = $_GET['origin'];
            $back_url_params = '';
        }
    } else {
        $back_url = 'categories.php';
        $back_url_params = 'cPath='.$cPath.'&pID='.$pInfo->products_id;
    }

    ?>
      <tr>
        <td align="right" class="smallText"><?php echo tep_draw_button(IMAGE_BACK, 'triangle-1-w', tep_href_link($back_url, $back_url_params)); ?></td>
      </tr>
    </table>
<?php
} else {
    ?>
    <table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', 1, HEADING_IMAGE_HEIGHT); ?></td>
            <td align="right"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td class="smallText" align="right">
<?php
        echo tep_draw_form('search', 'categories.php', '', 'get');
    echo HEADING_TITLE_SEARCH.' '.tep_draw_input_field('search','', 'autofocus');
    echo tep_hide_session_id().'</form>';
    ?>
                </td>
              </tr>
              <tr>
                <td class="smallText" align="right">
<?php
        echo tep_draw_form('goto', 'categories.php', '', 'get');
    echo HEADING_TITLE_GOTO.' '.tep_draw_pull_down_menu('cPath', tep_get_category_tree(), $current_category_id, 'onchange="this.form.submit();"');
    echo tep_hide_session_id().'</form>';
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

        $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.categories_image, c.parent_id, c.sort_order, c.date_added, c.last_modified from categories c, categories_description cd where c.categories_id = cd.categories_id and cd.language_id = '".(int) $languages_id."' and cd.categories_name like '%".tep_db_input($search)."%' order by c.sort_order, cd.categories_name");
    } else {
        $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.categories_image, c.parent_id, c.sort_order, c.date_added, c.last_modified from categories c, categories_description cd where c.parent_id = '".(int) $current_category_id."' and c.categories_id = cd.categories_id and cd.language_id = '".(int) $languages_id."' order by c.sort_order, cd.categories_name");
    }

    while ($categories = tep_db_fetch_array($categories_query)) {
        ++$categories_count;
        ++$rows;

        // Get parent_id for subcategories if search
        if (isset($_GET['search'])) {
            $cPath = $categories['parent_id'];
        }

        if ((!isset($_GET['cID']) && !isset($_GET['pID']) || (isset($_GET['cID']) && ($_GET['cID'] === $categories['categories_id']))) && !isset($cInfo) && (substr($action, 0, 3) !== 'new')) {
            $category_childs = ['childs_count' => tep_childs_in_category_count($categories['categories_id'])];
            $category_products = ['products_count' => tep_products_in_category_count($categories['categories_id'])];

            $cInfo_array = array_merge($categories, $category_childs, $category_products);
            class cInfo_objectInfo extends objectInfo
            {
            }
            $cInfo = new cInfo_objectInfo($cInfo_array); // TODO!
        }

        if (isset($cInfo) && \is_object($cInfo) && ($categories['categories_id'] === $cInfo->categories_id)) {
            echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\''.tep_href_link('categories.php', tep_get_path($categories['categories_id'])).'\'">'."\n";
        } else {
            echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\''.tep_href_link('categories.php', 'cPath='.$cPath.'&cID='.$categories['categories_id']).'\'">'."\n";
        }

        ?>
                <td class="dataTableContent"><?php echo '<a href="'.tep_href_link('categories.php', tep_get_path($categories['categories_id'])).'">'.tep_image('images/icons/folder.gif', ICON_FOLDER).'</a>&nbsp;<strong>'.$categories['categories_name'].'</strong>'; ?></td>
                <td class="dataTableContent" align="center">&nbsp;</td>
                <td class="dataTableContent" align="right"><?php if (isset($cInfo) && \is_object($cInfo) && ($categories['categories_id'] === $cInfo->categories_id)) {
                    echo tep_image('images/icon_arrow_right.gif', '');
                } else {
                    echo '<a href="'.tep_href_link('categories.php', 'cPath='.$cPath.'&cID='.$categories['categories_id']).'">'.tep_image('images/icon_info.gif', IMAGE_ICON_INFO).'</a>';
                }

        ?>&nbsp;</td>
              </tr>
<?php
    }

    $products_count = 0;

    if (isset($_GET['search'])) {
        $products_query = tep_db_query("select p.products_id, pd.products_name, p.products_quantity, p.products_image, p.products_price, p.products_date_added, p.products_last_modified, p.products_date_available, p.products_status, p2c.categories_id from products p, products_description pd, products_to_categories p2c where p.products_id = pd.products_id and pd.language_id = '".(int) $languages_id."' and p.products_id = p2c.products_id and pd.products_name like '%".tep_db_input($search)."%' order by pd.products_name");
    } else {
        $products_query = tep_db_query("select p.products_id, pd.products_name, p.products_quantity, p.products_image, p.products_price, p.products_date_added, p.products_last_modified, p.products_date_available, p.products_status from products p, products_description pd, products_to_categories p2c where p.products_id = pd.products_id and pd.language_id = '".(int) $languages_id."' and p.products_id = p2c.products_id and p2c.categories_id = '".(int) $current_category_id."' order by pd.products_name");
    }

    while ($products = tep_db_fetch_array($products_query)) {
        ++$products_count;
        ++$rows;

        // Get categories_id for product if search
        if (isset($_GET['search'])) {
            $cPath = $products['categories_id'];
        }

        if ((!isset($_GET['pID']) && !isset($_GET['cID']) || (isset($_GET['pID']) && ($_GET['pID'] === $products['products_id']))) && !isset($pInfo) && !isset($cInfo) && (substr($action, 0, 3) !== 'new')) {
            // find out the rating average from customer reviews
            $reviews_query = tep_db_query("select (avg(reviews_rating) / 5 * 100) as average_rating from reviews where products_id = '".(int) $products['products_id']."'");
            $reviews = tep_db_fetch_array($reviews_query);
            $pInfo_array = array_merge($products, $reviews);
            $pInfo = new objectInfo($pInfo_array);
        }

        if (isset($pInfo) && \is_object($pInfo) && ($products['products_id'] === $pInfo->products_id)) {
            echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\''.tep_href_link('categories.php', 'cPath='.$cPath.'&pID='.$products['products_id'].'&action=new_product_preview').'\'">'."\n";
        } else {
            echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\''.tep_href_link('categories.php', 'cPath='.$cPath.'&pID='.$products['products_id']).'\'">'."\n";
        }

        ?>
                <td class="dataTableContent"><?php echo '<a href="'.tep_href_link('categories.php', 'cPath='.$cPath.'&pID='.$products['products_id'].'&action=new_product_preview').'">'.tep_image('images/icons/preview.gif', ICON_PREVIEW).'</a>&nbsp;'.$products['products_name']; ?></td>
                <td class="dataTableContent" align="center">
<?php
              if ($products['products_status'] === '1') {
                  echo tep_image('images/icon_status_green.gif', IMAGE_ICON_STATUS_GREEN, 10, 10).'&nbsp;&nbsp;<a href="'.tep_href_link('categories.php', 'action=setflag&flag=0&pID='.$products['products_id'].'&cPath='.$cPath).'">'.tep_image('images/icon_status_red_light.gif', IMAGE_ICON_STATUS_RED_LIGHT, 10, 10).'</a>';
              } else {
                  echo '<a href="'.tep_href_link('categories.php', 'action=setflag&flag=1&pID='.$products['products_id'].'&cPath='.$cPath).'">'.tep_image('images/icon_status_green_light.gif', IMAGE_ICON_STATUS_GREEN_LIGHT, 10, 10).'</a>&nbsp;&nbsp;'.tep_image('images/icon_status_red.gif', IMAGE_ICON_STATUS_RED, 10, 10);
              }

        ?></td>
                <td class="dataTableContent" align="right"><?php if (isset($pInfo) && \is_object($pInfo) && ($products['products_id'] === $pInfo->products_id)) {
                    echo tep_image('images/icon_arrow_right.gif', '');
                } else {
                    echo '<a href="'.tep_href_link('categories.php', 'cPath='.$cPath.'&pID='.$products['products_id']).'">'.tep_image('images/icon_info.gif', IMAGE_ICON_INFO).'</a>';
                }

        ?>&nbsp;</td>
              </tr>
<?php
    }

    $cPath_back = '';

    if (isset($cPath_array) && \count($cPath_array) > 0) {
        for ($i = 0, $n = \count($cPath_array) - 1; $i < $n; ++$i) {
            if (empty($cPath_back)) {
                $cPath_back .= $cPath_array[$i];
            } else {
                $cPath_back .= '_'.$cPath_array[$i];
            }
        }
    }

    $cPath_back = (!empty($cPath_back)) ? 'cPath='.$cPath_back.'&' : '';
    ?>
              <tr>
                <td colspan="3"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText"><?php echo TEXT_CATEGORIES.'&nbsp;'.$categories_count.'<br />'.TEXT_PRODUCTS.'&nbsp;'.$products_count; ?></td>
                    <td align="right" class="smallText"><?php if (isset($cPath_array) && (\count($cPath_array) > 0)) {
                        echo tep_draw_button(IMAGE_BACK, 'triangle-1-w', tep_href_link('categories.php', $cPath_back.'cID='.$current_category_id));
                    }

    if (!isset($_GET['search'])) {
        echo tep_draw_button(IMAGE_NEW_CATEGORY, 'plus', tep_href_link('categories.php', 'cPath='.$cPath.'&action=new_category')).tep_draw_button(IMAGE_NEW_PRODUCT, 'plus', tep_href_link('categories.php', 'cPath='.$cPath.'&action=new_product'));
    }

    ?>&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
<?php
       $heading = [];
    $contents = [];

    switch ($action) {
        case 'new_category':
            $heading[] = ['text' => '<strong>'.TEXT_INFO_HEADING_NEW_CATEGORY.'</strong>'];

            $contents = ['form' => tep_draw_form('newcategory', 'categories.php', 'action=insert_category&cPath='.$cPath, 'post', 'enctype="multipart/form-data"')];
            $contents[] = ['text' => TEXT_NEW_CATEGORY_INTRO];

            $category_inputs_string = $category_description_string = '';
            $languages = tep_get_languages();

            for ($i = 0, $n = \count($languages); $i < $n; ++$i) {
                $category_inputs_string .= '<br />'.tep_image(tep_catalog_href_link('includes/languages/'.$languages[$i]['directory'].'/images/'.$languages[$i]['image']), $languages[$i]['name']).'&nbsp;'.tep_draw_input_field('categories_name['.$languages[$i]['id'].']');
                $category_description_string .= '<br />'.tep_image(tep_catalog_href_link('includes/languages/'.$languages[$i]['directory'].'/images/'.$languages[$i]['image']), $languages[$i]['name'], '', '', 'style="vertical-align: top;"').'&nbsp;'.tep_draw_textarea_summernote('categories_description['.$languages[$i]['id'].']', null, '80', '10');
            }

            $contents[] = ['text' => '<br />'.TEXT_CATEGORIES_NAME.$category_inputs_string];
            $contents[] = ['text' => '<br />'.TEXT_CATEGORIES_DESCRIPTION.$category_description_string];
            $contents[] = ['text' => '<br />'.TEXT_CATEGORIES_IMAGE.'<br />'.tep_draw_file_field('categories_image')];
            $contents[] = ['text' => '<br />'.TEXT_SORT_ORDER.'<br />'.tep_draw_input_field('sort_order', '', 'size="2"')];
            $contents[] = ['align' => 'center', 'text' => '<br />'.tep_draw_button(IMAGE_SAVE, 'disk', null, 'primary').tep_draw_button(IMAGE_CANCEL, 'close', tep_href_link('categories.php', 'cPath='.$cPath))];

            break;
        case 'edit_category':
            $heading[] = ['text' => '<strong>'.TEXT_INFO_HEADING_EDIT_CATEGORY.'</strong>'];

            $contents = ['form' => tep_draw_form('categories', 'categories.php', 'action=update_category&cPath='.$cPath, 'post', 'enctype="multipart/form-data"').tep_draw_hidden_field('categories_id', $cInfo->categories_id)];
            $contents[] = ['text' => TEXT_EDIT_INTRO];

            $category_inputs_string = $category_description_string = '';
            $languages = tep_get_languages();

            for ($i = 0, $n = \count($languages); $i < $n; ++$i) {
                $category_inputs_string .= '<br />'.tep_image(tep_catalog_href_link('includes/languages/'.$languages[$i]['directory'].'/images/'.$languages[$i]['image']), $languages[$i]['name']).'&nbsp;'.tep_draw_input_field('categories_name['.$languages[$i]['id'].']', tep_get_category_name($cInfo->categories_id, $languages[$i]['id']));
                $category_description_string .= '<br />'.tep_image(tep_catalog_href_link('includes/languages/'.$languages[$i]['directory'].'/images/'.$languages[$i]['image']), $languages[$i]['name']).'&nbsp;' . tep_draw_textarea_summernote('categories_description['.$languages[$i]['id'].']', null, '', '10', tep_get_category_description($cInfo->categories_id, $languages[$i]['id']), 'style="width: 98%;"');
            }

            $contents[] = ['text' => '<br />'.TEXT_EDIT_CATEGORIES_NAME.$category_inputs_string];
            $contents[] = ['text' => '<br />'.TEXT_EDIT_CATEGORIES_DESCRIPTION.$category_description_string];
            $contents[] = ['text' => '<br />'.tep_info_image('categories/'.$cInfo->categories_image, $cInfo->categories_name).'<br />/categories/'.$cInfo->categories_image];
            $contents[] = ['text' => '<br />'.TEXT_EDIT_CATEGORIES_IMAGE.'<br />'.tep_draw_file_field('categories_image')];
            $contents[] = ['text' => '<br />'.TEXT_EDIT_SORT_ORDER.'<br />'.tep_draw_input_field('sort_order', $cInfo->sort_order, 'size="2"')];
            $contents[] = ['align' => 'center', 'text' => '<br />'.tep_draw_button(IMAGE_SAVE, 'disk', null, 'primary').tep_draw_button(IMAGE_CANCEL, 'close', tep_href_link('categories.php', 'cPath='.$cPath.'&cID='.$cInfo->categories_id))];

            break;
        case 'delete_category':
            $heading[] = ['text' => '<strong>'.TEXT_INFO_HEADING_DELETE_CATEGORY.'</strong>'];

            $contents = ['form' => tep_draw_form('categories', 'categories.php', 'action=delete_category_confirm&cPath='.$cPath).tep_draw_hidden_field('categories_id', $cInfo->categories_id)];
            $contents[] = ['text' => TEXT_DELETE_CATEGORY_INTRO];
            $contents[] = ['text' => '<br /><strong>'.$cInfo->categories_name.'</strong>'];

            if ($cInfo->childs_count > 0) {
                $contents[] = ['text' => '<br />'.sprintf(TEXT_DELETE_WARNING_CHILDS, $cInfo->childs_count)];
            }

            if ($cInfo->products_count > 0) {
                $contents[] = ['text' => '<br />'.sprintf(TEXT_DELETE_WARNING_PRODUCTS, $cInfo->products_count)];
            }

            $contents[] = ['align' => 'center', 'text' => '<br />'.tep_draw_button(IMAGE_DELETE, 'trash', null, 'primary').tep_draw_button(IMAGE_CANCEL, 'close', tep_href_link('categories.php', 'cPath='.$cPath.'&cID='.$cInfo->categories_id))];

            break;
        case 'move_category':
            $heading[] = ['text' => '<strong>'.TEXT_INFO_HEADING_MOVE_CATEGORY.'</strong>'];

            $contents = ['form' => tep_draw_form('categories', 'categories.php', 'action=move_category_confirm&cPath='.$cPath).tep_draw_hidden_field('categories_id', $cInfo->categories_id)];
            $contents[] = ['text' => sprintf(TEXT_MOVE_CATEGORIES_INTRO, $cInfo->categories_name)];
            $contents[] = ['text' => '<br />'.sprintf(TEXT_MOVE, $cInfo->categories_name).'<br />'.tep_draw_pull_down_menu('move_to_category_id', tep_get_category_tree(), $current_category_id)];
            $contents[] = ['align' => 'center', 'text' => '<br />'.tep_draw_button(IMAGE_MOVE, 'arrow-4', null, 'primary').tep_draw_button(IMAGE_CANCEL, 'close', tep_href_link('categories.php', 'cPath='.$cPath.'&cID='.$cInfo->categories_id))];

            break;
        case 'delete_product':
            $heading[] = ['text' => '<strong>'.TEXT_INFO_HEADING_DELETE_PRODUCT.'</strong>'];

            $contents = ['form' => tep_draw_form('products', 'categories.php', 'action=delete_product_confirm&cPath='.$cPath).tep_draw_hidden_field('products_id', $pInfo->products_id)];
            $contents[] = ['text' => TEXT_DELETE_PRODUCT_INTRO];
            $contents[] = ['text' => '<br /><strong>'.$pInfo->products_name.'</strong>'];

            $product_categories_string = '';
            $product_categories = tep_generate_category_path($pInfo->products_id, 'product');

            for ($i = 0, $n = \count($product_categories); $i < $n; ++$i) {
                $category_path = '';

                for ($j = 0, $k = \count($product_categories[$i]); $j < $k; ++$j) {
                    $category_path .= $product_categories[$i][$j]['text'].'&nbsp;&gt;&nbsp;';
                }

                $category_path = substr($category_path, 0, -16);
                $product_categories_string .= tep_draw_checkbox_field('product_categories[]', $product_categories[$i][\count($product_categories[$i]) - 1]['id'], true).'&nbsp;'.$category_path.'<br />';
            }

            $product_categories_string = substr($product_categories_string, 0, -4);

            $contents[] = ['text' => '<br />'.$product_categories_string];
            $contents[] = ['align' => 'center', 'text' => '<br />'.tep_draw_button(IMAGE_DELETE, 'trash', null, 'primary').tep_draw_button(IMAGE_CANCEL, 'close', tep_href_link('categories.php', 'cPath='.$cPath.'&pID='.$pInfo->products_id))];

            break;
        case 'move_product':
            $heading[] = ['text' => '<strong>'.TEXT_INFO_HEADING_MOVE_PRODUCT.'</strong>'];

            $contents = ['form' => tep_draw_form('products', 'categories.php', 'action=move_product_confirm&cPath='.$cPath).tep_draw_hidden_field('products_id', $pInfo->products_id)];
            $contents[] = ['text' => sprintf(TEXT_MOVE_PRODUCTS_INTRO, $pInfo->products_name)];
            $contents[] = ['text' => '<br />'.TEXT_INFO_CURRENT_CATEGORIES.'<br /><strong>'.tep_output_generated_category_path($pInfo->products_id, 'product').'</strong>'];
            $contents[] = ['text' => '<br />'.sprintf(TEXT_MOVE, $pInfo->products_name).'<br />'.tep_draw_pull_down_menu('move_to_category_id', tep_get_category_tree(), $current_category_id)];
            $contents[] = ['align' => 'center', 'text' => '<br />'.tep_draw_button(IMAGE_MOVE, 'arrow-4', null, 'primary').tep_draw_button(IMAGE_CANCEL, 'close', tep_href_link('categories.php', 'cPath='.$cPath.'&pID='.$pInfo->products_id))];

            break;
        case 'copy_to':
            $heading[] = ['text' => '<strong>'.TEXT_INFO_HEADING_COPY_TO.'</strong>'];

            $contents = ['form' => tep_draw_form('copy_to', 'categories.php', 'action=copy_to_confirm&cPath='.$cPath).tep_draw_hidden_field('products_id', $pInfo->products_id)];
            $contents[] = ['text' => TEXT_INFO_COPY_TO_INTRO];
            $contents[] = ['text' => '<br />'.TEXT_INFO_CURRENT_CATEGORIES.'<br /><strong>'.tep_output_generated_category_path($pInfo->products_id, 'product').'</strong>'];
            $contents[] = ['text' => '<br />'.TEXT_CATEGORIES.'<br />'.tep_draw_pull_down_menu('categories_id', tep_get_category_tree(), $current_category_id)];
            $contents[] = ['text' => '<br />'.TEXT_HOW_TO_COPY.'<br />'.tep_draw_radio_field('copy_as', 'link', true).' '.TEXT_COPY_AS_LINK.'<br />'.tep_draw_radio_field('copy_as', 'duplicate').' '.TEXT_COPY_AS_DUPLICATE];
            $contents[] = ['align' => 'center', 'text' => '<br />'.tep_draw_button(IMAGE_COPY, 'copy', null, 'primary').tep_draw_button(IMAGE_CANCEL, 'close', tep_href_link('categories.php', 'cPath='.$cPath.'&pID='.$pInfo->products_id))];

            break;

        default:
            if ($rows > 0) {
                if (isset($cInfo) && \is_object($cInfo)) { // category info box contents
                    $category_path_string = '';
                    $category_path = tep_generate_category_path($cInfo->categories_id);

                    for ($i = (\count($category_path[0]) - 1); $i > 0; --$i) {
                        $category_path_string .= $category_path[0][$i]['id'].'_';
                    }

                    $category_path_string = substr($category_path_string, 0, -1);

                    $heading[] = ['text' => '<strong>'.$cInfo->categories_name.'</strong>'];

                    $contents[] = ['align' => 'center', 'text' => tep_draw_button(IMAGE_EDIT, 'document', tep_href_link('categories.php', 'cPath='.$category_path_string.'&cID='.$cInfo->categories_id.'&action=edit_category')).tep_draw_button(IMAGE_DELETE, 'trash', tep_href_link('categories.php', 'cPath='.$category_path_string.'&cID='.$cInfo->categories_id.'&action=delete_category')).tep_draw_button(IMAGE_MOVE, 'arrow-4', tep_href_link('categories.php', 'cPath='.$category_path_string.'&cID='.$cInfo->categories_id.'&action=move_category'))];
                    $contents[] = ['text' => '<br />'.TEXT_DATE_ADDED.' '.tep_date_short($cInfo->date_added)];

                    if (!empty($cInfo->last_modified)) {
                        $contents[] = ['text' => TEXT_LAST_MODIFIED.' '.tep_date_short($cInfo->last_modified)];
                    }

                    $contents[] = ['text' => '<br />'.tep_info_image('categories/'.$cInfo->categories_image, $cInfo->categories_name, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT).'<br />/categories/'.$cInfo->categories_image];
                    $contents[] = ['text' => '<br />'.TEXT_SUBCATEGORIES.' '.$cInfo->childs_count.'<br />'.TEXT_PRODUCTS.' '.$cInfo->products_count];
                } elseif (isset($pInfo) && \is_object($pInfo)) { // product info box contents
                    $heading[] = ['text' => '<strong>'.tep_get_products_name($pInfo->products_id, $languages_id).'</strong>'];

                    $contents[] = ['align' => 'center', 'text' => tep_draw_button(IMAGE_EDIT, 'document', tep_href_link('categories.php', 'cPath='.$cPath.'&pID='.$pInfo->products_id.'&action=new_product')).tep_draw_button(IMAGE_DELETE, 'trash', tep_href_link('categories.php', 'cPath='.$cPath.'&pID='.$pInfo->products_id.'&action=delete_product')).tep_draw_button(IMAGE_MOVE, 'arrow-4', tep_href_link('categories.php', 'cPath='.$cPath.'&pID='.$pInfo->products_id.'&action=move_product')).tep_draw_button(IMAGE_COPY_TO, 'copy', tep_href_link('categories.php', 'cPath='.$cPath.'&pID='.$pInfo->products_id.'&action=copy_to'))];
                    $contents[] = ['text' => '<br />'.TEXT_DATE_ADDED.' '.tep_date_short($pInfo->products_date_added)];

                    if (!empty($pInfo->products_last_modified)) {
                        $contents[] = ['text' => TEXT_LAST_MODIFIED.' '.tep_date_short($pInfo->products_last_modified)];
                    }

                    if (date('Y-m-d') < $pInfo->products_date_available) {
                        $contents[] = ['text' => TEXT_DATE_AVAILABLE.' '.tep_date_short($pInfo->products_date_available)];
                    }

                    $contents[] = ['text' => '<br />'.tep_info_image('products/thumbs/'.$pInfo->products_image, $pInfo->products_name, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT).'<br />/products/originals/'.$pInfo->products_image];
                    $contents[] = ['text' => '<br />'.TEXT_PRODUCTS_PRICE_INFO.' '.$currencies->format($pInfo->products_price).'<br />'.TEXT_PRODUCTS_QUANTITY_INFO.' '.$pInfo->products_quantity];
                    $contents[] = ['text' => '<br />'.TEXT_PRODUCTS_AVERAGE_RATING.' '.number_format($pInfo->average_rating, 2).'%'];
                }
            } else { // create category/product info
                $heading[] = ['text' => '<strong>'.EMPTY_CATEGORY.'</strong>'];

                $contents[] = ['text' => TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS];
            }

            break;
    }

    if ((!empty($heading)) && (!empty($contents))) {
        echo '            <td width="25%" valign="top">'."\n";

        $box = new box();
        echo $box->infoBox($heading, $contents);

        echo "            </td>\n";
    }

    ?>
          </tr>
        </table></td>
      </tr>
    </table>
<?php
}

require 'includes/template_bottom.php';

require 'includes/application_bottom.php';
?>
