<?php
/*
  Module: Information Pages Unlimited
          File date: 2007/02/17
          Based on the FAQ script of adgrafics
          Adjusted by Joeri Stegeman (joeri210 at yahoo.com), The Netherlands

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_INFORMATION);

if(!isset($_GET['info_id']) || !tep_not_null($_GET['info_id']) || !is_numeric($_GET['info_id']) ) {
	information_page_not_found();
} else {
	$info_id = intval($_GET['info_id']);
	$information_query = tep_db_query("SELECT information_title, information_description FROM " . TABLE_INFORMATION . " WHERE visible='1' AND information_id='" . (int)$info_id . "' AND language_id = '" . (int)$languages_id . "'");
	$information = tep_db_fetch_array($information_query);
	if(count($information) > 1) {
		$title = stripslashes($information['information_title']);
		$description = stripslashes($information['information_description']);

		// Added as noticed by infopages module
		if (!preg_match("/([\<])([^\>]{1,})*([\>])/i", $description)) 
		{
		  	$description = str_replace("\r\n", "<br />\r\n", $description); 
		}
	  	$breadcrumb->add($title, tep_href_link(FILENAME_INFORMATION, 'info_id=' . $_GET['info_id'], 'NONSSL'));
	} else {
		information_page_not_found();
	} 
}

  $content = basename($_SERVER['PHP_SELF']);
  while (strstr($content, '.php')) $content = str_replace('.php', '', $content);

  $javascript = 'remove_label.js';
  include (bts_select('main', $content_template)); // BTSv1.5

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>