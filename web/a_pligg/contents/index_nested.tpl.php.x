            <h1 class="pageHeading">
            <?php echo tep_image_2ma_template(DIR_WS_IMAGES . $category['categories_image'], $category['categories_name'], HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?>
            <?php //echo HEADING_TITLE; 
	    ?></h1>
	    <br style="font-size:5px">
	    <div class="AlignLeft">
                  <?php  $cat_descript_query = tep_db_query ("select categories_description from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . $current_category_id . "'  and language_id = '" . (int)$languages_id ."'");
                      $cat_descript = tep_db_fetch_array ($cat_descript_query);
                      {
                      echo $cat_descript['categories_description'];
                       } ?></div><br />

<?php
    if (isset($cPath) && strpos('_', $cPath)) {
// check to see if there are deeper categories within the current category
      $category_links = array_reverse($cPath_array);
      for($i=0, $n=sizeof($category_links); $i<$n; $i++) {
// ################## Added Enable Disable Categorie #################
//        $categories_query = tep_db_query("select count(*) as total from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '" . (int)$category_links[$i] . "' and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "'");
        $categories_query = tep_db_query("select count(*) as total from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.categories_status = '1' and c.parent_id = '" . (int)$category_links[$i] . "' and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "'");
        $categories = tep_db_fetch_array($categories_query);
        if ($categories['total'] < 1) {
          // do nothing, go through the loop
        } else {
// ################## Added Enable Disable Categorie #################
//          $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.categories_image, c.parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '" . (int)$category_links[$i] . "' and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' order by sort_order, cd.categories_name");
		$categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.categories_image, c.parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.categories_status = '1' and c.parent_id = '" . (int)$category_links[$i] . "' and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' order by sort_order, cd.categories_name");
// ################## End Added Enable Disable Categorie #################
          break; // we've found the deepest category the customer is in
        }
      }
    } else {
// ################## End Added Enable Disable Categorie #################
//      $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.categories_image, c.parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '" . (int)$current_category_id . "' and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' order by sort_order, cd.categories_name");
      $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.categories_image, c.parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.categories_status = '1' and c.parent_id = '" . (int)$current_category_id . "' and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' order by sort_order, cd.categories_name");
// ################## End Added Enable Disable Categorie #################
    }

  $number_of_categories = tep_db_num_rows($categories_query);

    while ($categories = tep_db_fetch_array($categories_query)) {
    $cPath_new = tep_get_path($categories['categories_id']);
      echo '<div align="left"><a href="' . tep_href_link(FILENAME_DEFAULT, $cPath_new) . '">' . $categories['categories_name'] . '</a></div>';

    }

// needed for the new products module shown below
    $new_products_category_id = $current_category_id;
?>
    <br class="Clear" /><br />
    <?php //include(DIR_WS_MODULES . FILENAME_NEW_PRODUCTS); ?>
