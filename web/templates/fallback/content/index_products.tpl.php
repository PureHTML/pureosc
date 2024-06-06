    <h1 class="pageHeading"><?php echo HEADING_TITLE; ?></h1>
<?php
// optional Product List Filter
    if (PRODUCT_LIST_FILTER > 0) {
      if (isset($_GET['manufacturers_id'])) {
        $filterlist_sql = "select distinct c.categories_id as id, cd.categories_name as name from " . TABLE_PRODUCTS .
         " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION .
          " cd where p.products_status = '1' and p.products_id = p2c.products_id and p2c.categories_id = c.categories_id and 
          p2c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "'
           and p.manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "' order by cd.categories_name";
      } else {
        $filterlist_sql= "select distinct m.manufacturers_id as id, m.manufacturers_name as name from " .
         TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_MANUFACTURERS . 
         " m where p.products_status = '1' and p.manufacturers_id = m.manufacturers_id and p.products_id = 
         p2c.products_id and p2c.categories_id = '" . (int)$current_category_id . "' order by m.manufacturers_name";
      }
      $filterlist_query = tep_db_query($filterlist_sql);
      if (tep_db_num_rows($filterlist_query) > 1) {
        echo '<br />' . tep_draw_form('filter', FILENAME_DEFAULT, 'get') ;
        
        if (isset($_GET['manufacturers_id'])) {
          echo tep_draw_hidden_field('manufacturers_id', $_GET['manufacturers_id']);
          $options = array(array('id' => '', 'text' => TEXT_ALL_CATEGORIES));
        } else {
          echo tep_draw_hidden_field('cPath', $cPath);
          $options = array(array('id' => '', 'text' => TEXT_ALL_MANUFACTURERS));
        }
        echo tep_draw_hidden_field('sort', $_GET['sort']);
        while ($filterlist = tep_db_fetch_array($filterlist_query)) {
          $options[] = array('id' => $filterlist['id'], 'text' => $filterlist['name']);
        }
        echo tep_draw_pull_down_menu_label(TEXT_SHOW, 'filter_product', 'filter_id', $options, (isset($_GET['filter_id']) ? $_GET['filter_id'] : ''), 'onchange="this.form.submit()"') . tep_hide_session_id();
        echo '</form><br />' . "\n";
      }
    }

// Get the right image for the top-right
    $image = DIR_WS_IMAGES . 'table_background_list.png';
    if (isset($_GET['manufacturers_id'])) {
      $image = tep_db_query("select manufacturers_image from " . TABLE_MANUFACTURERS . " where manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "'");
      $image = tep_db_fetch_array($image);
      $image = $image['manufacturers_image'];
    } elseif ($current_category_id) {
      $image = tep_db_query("select categories_image from " . TABLE_CATEGORIES . " where categories_id = '" . (int)$current_category_id . "'");
      $image = tep_db_fetch_array($image);
      $image = $image['categories_image'];
    }
?>
    <br /> <?php echo tep_image_2ma_template (DIR_WS_IMAGES . $image, HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?><br />
                  <?php  $cat_descript_query = tep_db_query ("select categories_description from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . $current_category_id . "'  and language_id = '" . (int)$languages_id ."'");
                      $cat_descript = tep_db_fetch_array ($cat_descript_query);
                      {
                      echo $cat_descript['categories_description'];
                       } ?>


    <br /> <?php include(bts_select('column', FILENAME_PRODUCT_LISTING)); ?>