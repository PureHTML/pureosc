<?php
include (bts_select('column', 'configure.php'));
  /*
  Limit certain branches of the menu by hiding the subcategories of any category.
  Use this option if you want to hide certain parts of the menu. Enter the category_id of the last 
  category you want to see in any branch. 
  example : Your category structure is :
  root
  |_1
  | |_2
  | | |_3
  | | |_4
  | |_5
  |_6
    |_7
    |_8
  
  $hide_subcategories_of = array(2,6);
  Your menu structure will be :
  root
  |_1
  | |_2
  | |_5
  |_6 
  */ 
  $hide_subcategories_of = array();
  
// END Configuration Options


// Misc setting to make folder icon clickable to expand tree menu nodes
$GLOBALS['dm_tree_titleclick'] = true;	

// Initialize HTML and info_box class if displaying inside a box
if ($show_dmcats_as_box) {
    echo '';
    $info_box_contents = array();
    $info_box_contents[] = array('text' => BOX_HEADING_CATEGORIES);
    new infoBoxHeading($info_box_contents, true, false);					
}

// Generate the menu data output (uses configuration options above)
$categories_string = tep_make_cat_dmlist();

// Include required libraries based on menu type
require_once (bts_select('column', 'dynamenu/lib/PHPLIB.php'));
require_once (bts_select('column', 'dynamenu/lib/layersmenu-common.inc.php'));

if ($menu_type < 2) { // Setup for DHTML style menus

    ?>
        <script>
            <!--
                <?php require_once (bts_select('column', 'dynamenu/libjs/layersmenu-browser_detection.js')); ?>
            // -->
        </script>
        <script>
            <!--
                <?php require_once (bts_select('column', 'dynamenu/libjs/layersmenu-library.js')); ?>
            // -->
        </script>
        <script>
            <!--
                <?php require_once (bts_select('column', 'dynamenu/libjs/layersmenu.js')); ?>
            // -->
        </script>
    <?php
		
    require_once (bts_select('column', 'dynamenu/lib/layersmenu.inc.php'));
    $mid = new LayersMenu($menu_layer_offset[0],$menu_layer_offset[1],$menu_layer_offset[2],1);

} elseif ($menu_type > 2) { // Setup for plain style menus

    require_once (bts_select('column', 'dynamenu/lib/plainmenu.inc.php'));
    $mid = new PlainMenu();

} else {  // Setup for tree style menus
		
		?>
        <script>
            <!--
                <?php require_once (bts_select('column', 'dynamenu/libjs/layersmenu-browser_detection.js')); ?>
								
								<?php
								
								   if ($menu_tree_current_path) {
									     echo "\n".'var menu_tree_current_path = true';   		   
									 } else {
									     echo "\n".'var menu_tree_current_path = false'; 									 
									 }
								
								?>
        // -->
        </script>
        <script>
            <!--
                <?php require_once (bts_select('column', 'dynamenu/libjs/layerstreemenu-cookies.js')); ?>
            // -->
        </script>
    <?php

        require_once (bts_select('column', 'dynamenu/lib/treemenu.inc.php'));
        $mid = new TreeMenu();

}

// Set menu config variables
$mid->setDirroot('./');
$mid->setLibjsdir('./templates/' . DIRECTORY_TEMPLATE . '/dynamenu/libjs/');

if ($menu_type !=2) {
    $mid->setTpldir('./templates/' . DIRECTORY_TEMPLATE . '/dynamenu/templates/');
}
		
$mid->setImgdir('./templates/' . DIRECTORY_TEMPLATE . '/images/');
$mid->setImgwww('templates/' . DIRECTORY_TEMPLATE . '/images/');
$mid->setIcondir('./templates/' . DIRECTORY_TEMPLATE . '/images/');
$mid->setIconwww('templates/' . DIRECTORY_TEMPLATE . '/images/');
$mid->setIconsize($menu_icon_width, $menu_icon_height);

// Generate menus
$mid->setMenuStructureString($categories_string);
$mid->parseStructureForMenu('catmenu');

switch ($menu_type) {
    case 0: // Horizontal drop-down
        $mid->setDownArrowImg($menu_downarrowimg);
        $mid->setForwardArrowImg($menu_fwdarrowimg);
        $mid->setHorizontalMenuTpl('layersmenu-horizontal_menu.ihtml');						
        $mid->setSubMenuTpl('layersmenu-horiz_sub_menu.ihtml');							
			  $mid->newHorizontalMenu('catmenu');	
				$mid->printHeader();
        $categories_menu = $mid->getMenu('catmenu');
				$GLOBALS['dmfooter'] = $mid->getFooter();								
        break;
    case 1:  // Vertical fly-out
        $mid->setDownArrowImg($menu_downarrowimg);
        $mid->setForwardArrowImg($menu_fwdarrowimg);
        $mid->setVerticalMenuTpl('layersmenu-vertical_menu.ihtml');				
        $mid->setSubMenuTpl('layersmenu-vert_sub_menu.ihtml');							
				$mid->newVerticalMenu('catmenu');
				$mid->printHeader();
        $categories_menu = $mid->getMenu('catmenu');
				$GLOBALS['dmfooter'] = $mid->getFooter();												
        break;
    case 2:  // Tree menu
		    $categories_menu = $mid->newTreeMenu('catmenu');
        break;
    case 3:  // Horizontal plain menu
        $mid->setPlainMenuTpl('layersmenu-horizontal_plain_menu.ihtml');		
        $categories_menu = $mid->newHorizontalPlainMenu('catmenu');							
        break;
    case 4:  // Vertical plain menu
        $mid->setPlainMenuTpl('layersmenu-plain_menu.ihtml');		
        $categories_menu = $mid->newPlainMenu('catmenu');						
        break;	 	 
}	


// Output list inside a box if specified, otherwise just output unordered list
if ($show_dmcats_as_box) {
    $info_box_contents = array();
    $info_box_contents[] = array('text' => $categories_menu);
    new infoBox($info_box_contents);
		echo '';	
} else {
		echo $before_nobox_html;	
    echo $categories_menu;
		echo $after_nobox_html;
}

// Create the root category list
function tep_make_cat_dmlist($rootcatid = 0, $maxlevel = 0){

    global $cPath_array, $show_full_tree, $languages_id;
		
    global $idname_for_menu, $cPath_array, $show_full_tree, $languages_id;

    // Modify category query if not fetching all categories (limit to root cats and selected subcat tree)
		if (!$show_full_tree) {
        $parent_query	= 'AND (c.parent_id = "0"';	
				
				if (isset($cPath_array)) {
				
				    $cPath_array_temp = $cPath_array;
				
				    foreach($cPath_array_temp AS $key => $value) {
						    $parent_query	.= ' OR c.parent_id = "'.$value.'"';
						}
						
						unset($cPath_array_temp);
				}	
				
        $parent_query .= ')';				
		} else {
        $parent_query	= '';	
		}		

		$result = tep_db_query('select c.categories_id, cd.categories_name, c.parent_id from ' . TABLE_CATEGORIES . ' c, ' . TABLE_CATEGORIES_DESCRIPTION . ' cd where c.categories_id = cd.categories_id and cd.language_id="' . (int)$languages_id .'" '.$parent_query.'order by sort_order, cd.categories_name');
    
		while ($row = tep_db_fetch_array($result)) {				
        $table[$row['parent_id']][$row['categories_id']] = $row['categories_name'];
    }

    $output .= tep_make_cat_dmbranch($rootcatid, $table, 0, $maxlevel);

    return $output;
}

// Create the branches off the category list
function tep_make_cat_dmbranch($parcat, $table, $level, $maxlevel) {

    global $cPath_array, $menu_use_titles, $menu_icon_file, $divide_subcats, $divide_subcats_text, $hide_subcategories_of;
		
		$lvl_adjust = 1;
		
    $list = $table[$parcat];
	
    // Build data for menu
		while(list($key,$val) = each($list)){
        
				if (isset($cPath_array) && in_array($key, $cPath_array)) {
            $this_expanded = '1';
            $this_selected = 'dmselected';						
        } else {
            $this_expanded = '';
            $this_selected = '';									
		    }	

        if (!$level) {
				    unset($GLOBALS['cPath_set']);
						$GLOBALS['cPath_set'][0] = $key;
            $cPath_new = 'cPath=' . $key;

        } else {
						$GLOBALS['cPath_set'][$level] = $key;		
            $cPath_new = 'cPath=' . implode("_", array_slice($GLOBALS['cPath_set'], 0, ($level+1)));
						
						$this_subcat_count++;
        }
				
				if ($menu_use_titles) {
				    $this_title = $val;
				} else {
				    $this_title = '';				
				}				

        if (SHOW_COUNTS == 'true') {
            $products_in_category = tep_count_products_in_category($key);
            if ($products_in_category > 0) {
                $val .= '&nbsp;(' . $products_in_category . ')';
            }
        }
				
				// Output for file to be parsed by PHP Layers Menu
				// Each line (terminated by a newline "\n" is a pipe delimited string with the following fields:
				// [dots]|[text]|[link]|[title]|[icon]|[target]|[expanded]
				// dots - number of dots signifies the level of the link '.' root level items, '..' first submenu, etc....
				// text - text for link; title - tooltip for link; icon - icon for link; target - "dmselected" CSS class if item is selected
				// expanded - signifies if the node is expanded or collapsed by default (applies only to tree style menus)
				
				// Add "more" submenu if dividing subcategories
				if ($this_subcat_count > $divide_subcats && $divide_subcats) {
            $output .= str_repeat(".", $level+$lvl_adjust).'|'.$divide_subcats_text.'||'.$this_title.'|'.$menu_icon_file.'|'.$this_selected.'|'.$this_expanded."\n";							 
				    $this_subcat_count = 1;
						$lvl_adjust ++;
				}
				
        $output .= str_repeat(".", $level+$lvl_adjust).'|'.$val.'|'.tep_href_link(FILENAME_DEFAULT, $cPath_new).'|'.$this_title.'|'.$menu_icon_file.'|'.$this_selected.'|'.$this_expanded."\n";							 
				
				//if ((isset($table[$key])) AND (($maxlevel > $level + 1) OR ($maxlevel == '0'))) {				
        
        // do we continue
        // changed this to be a check to see if the cid is in the list "$hide_subcategories_of"			
        
        if (!in_array($key,$hide_subcategories_of) AND ((isset($table[$key])) AND (($maxlevel > $level + 1) OR ($maxlevel == '0')))) {
            $output .= tep_make_cat_dmbranch($key,$table,$level + $lvl_adjust,$maxlevel);
        }
    
		} // End while loop

    return $output;
}	

?>
