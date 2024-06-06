<?php
  /*
  Module: Information Pages Unlimited
          File date: 2007/02/17
          Based on the FAQ script of adgrafics
          Adjusted by Joeri Stegeman (joeri210 at yahoo.com), The Netherlands

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Released under the GNU General Public License
  */

////
/************************************************
Modified by Robert Fisher aka Thunderace
23 March 2006
Information_children mod
This file now shows highlights and children
in the same manner as osCommerce
************************************************/
function tep_information_show_category() {
	global $sitemapString, $languages_id;
	$information_tree = array();
	$informationString = '';
	$parent_child_selected = '';
	$information_group_id = 1; // ID set by module for Information box

	// Retrieve information from db
	$information_query = tep_db_query("SELECT information_id, information_title, parent_id FROM " . TABLE_INFORMATION . " WHERE visible='1' and language_id='" . (int)$languages_id ."' and information_group_id = '" . (int)$information_group_id . "' ORDER BY sort_order");
	while($information = tep_db_fetch_array($information_query)) {
		$information_tree[$information['information_id']] = array(
			'info_title' 	=> $information['information_title'],
			'parent_id' 	=> $information['parent_id'],
			'info_next_id' 	=> 0
		);
		if ($information_tree[$information['information_id']]['parent_id'] != '0') {
			$child_information[] = array (
				'parent_info_id' => $information['parent_id'],
				'child_info_id'  => $information['information_id']
			);
		}
	}
	$count_child = count($child_information);

	// Test if a child has been requested and set $parent_child_selected
	for ( $i = 1; $i < ($count_child+1); $i++ ) {
		if ((isset($_GET['info_id'])) && ($child_information[$i]['child_info_id'] == $_GET['info_id'])) {
			$parent_child_selected = $child_information[$i]['parent_info_id'];
		}
	}

	// Run through the $information_tree to find all pages
	while ( $element = each ( $information_tree ) )  {
		if (!isset($information_tree[$element['key']]['parent_id']) || ($information_tree[$element['key']]['parent_id'] == 0)) {

			//Set the main title to bold if it was selected or one of its children were selected
			if (((isset($_GET['info_id'])) && ($_GET['info_id'] == $element['key'])) || ($parent_child_selected == $element['key'])) {
				$informationString .= '<a href="' . tep_href_link(FILENAME_INFORMATION, 'info_id=' . $element['key']) . '"><b>' . $information_tree[$element['key']]['info_title'] . '</b></a><br />';
			} else {
				$informationString .= '<a href="' . tep_href_link(FILENAME_INFORMATION, 'info_id=' . $element['key']) . '">' . $information_tree[$element['key']]['info_title'] . '</a><br />';
				//Sitemap only
				$sitemapString .= '<li><a href="' . tep_href_link(FILENAME_INFORMATION, 'info_id=' . $element['key']) . '">' . $information_tree[$element['key']]['info_title'] . '</a></li>' . "\n";
			}

			//Just for sitemap
			$ul = false;
			for ( $i = 1; $i < ($count_child+1); $i++ ) {
				if ($child_information[$i]['parent_info_id'] == $element['key']) {
					if ($ul == false) {
						$sitemapString .= '<ul>' . "\n";
						$ul = true;
					}
					$sitemapString .= '<li><a href="' . tep_href_link(FILENAME_INFORMATION, 'info_id=' . $child_information[$i]['child_info_id']) . '">' . $information_tree[$child_information[$i]['child_info_id']]['info_title'] . '</a></li>' . "\n";
				}
				if (($i == $count_child) && ($ul == true)) {
					$sitemapString .= '</ul>' . "\n";
				}
			}
			//End just for sitemap

			//Show children if they exist
			if (((isset($_GET['info_id'])) && ($_GET['info_id'] == $element['key'])) || ($parent_child_selected == $element['key'])) {
				for ( $i = 0; $i < ($count_child); $i++ ) {
					if ($child_information[$i]['parent_info_id'] == $element['key'])

					//Show a child as bold if it was selected
					if ((isset($_GET['info_id'])) && ($_GET['info_id'] == $child_information[$i]['child_info_id'])) {
						$informationString .= '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_INFORMATION, 'info_id=' . $child_information[$i]['child_info_id']) . '"><b>' . $information_tree[$child_information[$i]['child_info_id']]['info_title'] . '</b></a><br />';
					} else {
						$informationString .= '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_INFORMATION, 'info_id=' . $child_information[$i]['child_info_id']) . '">' . $information_tree[$child_information[$i]['child_info_id']]['info_title'] . '</a><br />';
					}
				}
			}
		}
	}
	return $informationString;
}


////
// Define customer greetings
function tep_information_customer_greeting_define() {
	global $customer_id, $customer_first_name, $languages_id, $category_depth;

	if ( $category_depth == 'top' ) {

		// Retrieve information from db
		$information_group_id = 2; // ID set by module for Entrance messages
		$information_query = tep_db_query("select information_title, information_description from " . TABLE_INFORMATION . " where language_id = '" . (int)$languages_id . "' and information_group_id = '" . (int)$information_group_id . "'");
		while ($information = tep_db_fetch_array($information_query)) {
	//		if($information['information_title'] == 'HEADING_TITLE')
			define($information['information_title'], $information['information_description']);
		}
	}
}

////
// Return a customer greeting
function tep_information_customer_greeting() {
	global $customer_id, $customer_first_name;

	if (tep_session_is_registered('customer_first_name') && tep_session_is_registered('customer_id')) {
		$greeting_string = sprintf(TEXT_GREETING_PERSONAL, tep_output_string_protected($customer_first_name), tep_href_link(FILENAME_PRODUCTS_NEW));
	} else {
		$greeting_string = sprintf(TEXT_GREETING_GUEST, tep_href_link(FILENAME_LOGIN, '', 'SSL'), tep_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL'));
	}

	return $greeting_string;
}
?>
