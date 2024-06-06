<?php
/*
 $Id: category_tree.php,v1.2 2004/05/10 hpdl Exp $
 # corrected the nested lists

 osCommerce, Open Source E-Commerce Solutions
 http://www.oscommerce.com

 Copyright (c) 2008 osCommerce

 Released under the GNU General Public License
*/

class osC_CategoryTree {
var $root_category_id = 0,
$max_level = 0,
$data = array(),
$root_start_string = '',
$root_end_string = '',
$parent_start_string = '',
$parent_end_string = '',
$parent_group_start_string = '<ul class="sitemap">',
$parent_group_end_string = '</ul> ',
$child_start_string = '<li>',
$child_end_string = '</li> ',
$spacer_string = '',
$spacer_multiplier = 1;

function osC_CategoryTree($load_from_database = true) {
global $languages_id;
$categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' and c.categories_status=1 order by c.parent_id, c.sort_order, cd.categories_name");

$this->data = array();

while ($categories = tep_db_fetch_array($categories_query)) {
	$this->data[$categories['parent_id']][$categories['categories_id']] = array('name' => $categories['categories_name'], 'count' => 0);}
} //end class osC_CategoryTree

function buildBranch($parent_id, $level = 0) {
	$result = $this->parent_group_start_string; //starts the <ul> tag

	if (isset($this->data[$parent_id])) {
		foreach ($this->data[$parent_id] as $category_id => $category) {
			$category_link = $category_id;

			$result .= $this->child_start_string; // prints <li>

			if (isset($this->data[$category_id])) {$result .= $this->parent_start_string;} //prints nothing
			
			if ($level == 0) {$result .= $this->root_start_string;} //prints nothing
			
			$result .= str_repeat($this->spacer_string, $this->spacer_multiplier * $level) . '<a title="'. $category['name'] . '" href="' . tep_href_link(FILENAME_DEFAULT, 'cPath=' . $category_link) . '">';
			
			$result .= $category['name'];
			
			$result .= '</a>';
			
			if ($level == 0) {$result .= $this->root_end_string;} //prints nothing
			
			if (isset($this->data[$category_id])) {$result .= $this->parent_end_string;} //prints </ul>
		
			if (isset($this->data[$category_id]) && (($this->max_level == '0') || ($this->max_level > $level+1))) {
			$result .= $this->buildBranch($category_id, $level+1);}

			$result .= $this->child_end_string; //prints </li>
		
		}// end foreach
	} // end if (isset 

	$result .= $this->parent_group_end_string; //<prints </ul>

	return $result;
} //end function

function buildTree() { return $this->buildBranch($this->root_category_id);}}

?>