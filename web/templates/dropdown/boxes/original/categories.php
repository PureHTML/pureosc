<?php
/*
  $Id:

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

  $boxHeading = BOX_HEADING_CATEGORIES;
  $corner_left = 'rounded';
  $corner_right = 'square';
  $box_base_name = 'categories'; // for easy unique box template setup (added BTSv1.2)
  $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)

  function tep_build_tree($entry, $last_member = false, $level = 0, $path = '') {
    global $tree, $categories_string;

	$prefix = '';
    for ($i = 0; $i <= $level; $i++) {
      $prefix .= ' ';
    }

    if (SHOW_COUNTS == 'true') {
      $products_in_category = tep_count_products_in_category($entry);
      if ($products_in_category > 0) {
        $pinc = '&nbsp;(' . $products_in_category . ')';
      } else {
	    $pinc = '';
	  }
    }

    if ($path == '') {
      $new_path = $entry;
    } else {
	  $new_path = $path . '_' . $entry;
    }

    $categories_string .= $prefix . '<li><a href="' . tep_href_link(FILENAME_DEFAULT, 'cPath=' . $new_path) . '">'. addslashes($tree[$entry]['name']) . $pinc .'</a>';

	$array_size = sizeof($tree[$entry]['children']);
    if ($array_size > 0) {
	  $categories_string .= "\n" . '<ul class="1">' . "\n";
	  $children = $tree[$entry]['children'];
	  reset($children);
	  end($children);
	  $end_key = key($children);
	  reset($children);
	  while (list($key, $new_entry) = each($children)) {
	    $new_last_member = ($key == $end_key) ? true : false;
        tep_build_tree($new_entry, $new_last_member, $level + 1, $new_path);
	  }
      $categories_string .= $prefix;
	  $categories_string .= ($last_member == true) ? '</li>'. "\n" . '</ul>' : '</li>';
	  $categories_string .= "\n";
    } else {
	  $categories_string .= ($last_member == true) ? '</li>'. "\n" . '</ul>' : '</li>';
	  $categories_string .= "\n";
    }
  }


  $tree = array();
  $categories_string = '';
  //$categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.parent_id, c.sort_order from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.categories_id = cd.categories_id and cd.language_id='" . $languages_id ."' ");
  $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.parent_id, c.sort_order from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.categories_id = cd.categories_id and cd.language_id='" . (int)$languages_id ."'and c.categories_status = '1'  ");
  $last_root = 0;
  $first_root = 0;
  while ($categories = tep_db_fetch_array($categories_query)) {
    $current_id = $categories['categories_id'];
	$parent_id = $categories['parent_id'];

	if (!isset($tree[$current_id])) {
	  $tree[$current_id] = array();
	  $tree[$current_id]['children'] = array();
	  $tree[$current_id]['next'] = 0;
	}

	$tree[$current_id]['name'] = $categories['categories_name'];
    $tree[$current_id]['parent'] = $parent_id;
	$tree[$current_id]['order'] = $categories['sort_order'];

	if ($parent_id != 0) {
      if (!isset($tree[$parent_id])) {
	    $tree[$parent_id] = array();
	    $tree[$parent_id]['children'] = array();
	  }

	  $tree[$parent_id]['children'][] = $current_id;
	} else {
	  if ($last_root == 0) {
	    $last_root = $current_id;
		$first_root = $current_id;
	  } else {
	    $tree[$last_root]['next'] = $current_id;
		$last_root = $current_id;
	  }
	}
  }

  if ($first_root != 0) {
    $categories_string = '' . "\n";
    $root = $first_root;

    do {
	  $last_member = ($tree[$root]['next'] == 0) ? true : false;
      tep_build_tree($root, $last_member);
	  $root = $tree[$root]['next'];
	} while ($root != 0);
	
	$categories_string .= '';
  } 

  $boxContent = '<div id="dropDownMenu"><ul id="categoriesDropDown">' 
                       . $categories_string . '</div>';

  include (bts_select('boxes', $box_base_name)); // BTS 1.5
?>
<!-- categories_eof //-->