<?php
define(DIRECTORY_TEMPLATE, 'Dynamenu');
/*
  $Id: dm_categories.php,v 1.00 2006/05/07 01:13:58 nate_02631 Exp $
	
  Ties the store category menu into the PHP Layers Menu library, allowing display
	of categories as DTHML drop-down or fly-out menus, collapsable tree-style menus
	or horizontal/vertical indented plain menus.

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2006 Nate Welch http://www.natewelch.com

  Released under the GNU General Public License
*/

// BEGIN Configuration Options

  // Set the value below corresponding to the type of menu you want to render
	// 0 = Horizontal Drop-down; 1 = Vertical Flyout; 2 = Tree Menu;
	// 3 = Plain Horizontal Menu; 4 = Plain Vertical Menu
	// Include the appropriate stylesheet in your store stylesheet, and if rendering
	// types '0' or '1', you must also echo (output) the "menu footer" variable
	// in your store footer as described in the readme (or submenus won't work)
	$menu_type = 1;
	
  // Set to false to display the menu output only. Set to true to display in
	// a regular box. The former is useful for better integrating the menu with your layout.
	$show_dmcats_as_box = true;				
	
  // Set to 'true' to assign TITLE tags to each of the menu's items, 'false' to leave blank
	$menu_use_titles = true;	
	
  // Name of the icon file to be used preceding menu items. Leave blank for no icons.
	// NOTE: Does not apply to plain style menus. Icon should be in the /images directory
	$menu_icon_file = 'tree_split.png';
	
	// Width and height of icons used in menus (does not apply to plain menus).
	$menu_icon_width = 16;
	$menu_icon_height = 16;
	
  // Set the graphic to be used for the forward arrow and down arrow images used in 
	// drop-down and fly-out menus. Images must reside in your catalog's /images directory
	$menu_fwdarrowimg  = 'forward-arrow.png';		
  $menu_downarrowimg = 'down-arrow.png';		
	
	// Indicates whether or not to render your entire category list or just the root categories
	// and the currently selected submenu tree. Rendering the full list is useful for dynamic menu
	// generation where you want the user to have instant access to all categories. The other option
	// is the default oSC behaviour, when the subcats aren't available until the parent is clicked,
	// more suitable for plain-style menus 
	$show_full_tree = true;		
	
	// For tree menus, set to true to have only nodes corresponding to the current category path
	// expanded. If set to false, the tree menu will retain expanded/collapse nodes the user has
	// selected (as well as expanding any for categories they've entered)
	$menu_tree_current_path = true;				
	
  // Set the three numerical values below to adjust the offset of submenus in
  // horizontal drop-down and vertical fly-out menus. Values adjust the following (in order)
  // Top Offset: # of pixels from top border of previous menu the submenu appears
  // Right Offset: # of pixels from right border of previous menu the submenu appears
  // Left Offset: # of pixels from left border of previous menu the submenu appears
  // if the submenu pops to left (i.e. if window border is reached).  Negative values are allowed.
  $menu_layer_offset = array (0,4,4);	
	
	// Show icons on tree menus? If set to false, only expand/collapse icons and connecting lines are shown
	$GLOBALS['dm_tree_folder_icons'] = true;

	// This is the HTML that you would like to appear before/after your categories menu if *not*
	// displaying in a standard "box". This is useful for reconciling tables or clearing
	// floats, depending on your layout needs.	For example if not including in a box in the
	// default osC template, you would need opening/closing <tr><td> tags...
	$before_nobox_html = '';
  $after_nobox_html = '';
	
	// Use this option if you have a *lot* of subcategories in a DHTML style menu and your
	// submenus won't fit on the page.  Set $divide_subcats to the max # of subcategories you want
	// to display.  The menu will show a "more..." link and display the remaining subcategories
	// under that selection. Leave at "0" to not divide your subcategories.
	$divide_subcats = 0;	
	
	// The text you want to display to indicate more subcategories are available
	// This can be set a string or to a language constant you define.
	$divide_subcats_text = '...';	
?>