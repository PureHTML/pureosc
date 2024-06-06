<?php
/*=======================================================================*\
|| #################### //-- SCRIPT INFO --// ########################### ||
|| #	Script name: meta_tags.php                                      # ||
|| #	Contribution: cDynamic Meta Tags                                # ||
|| #	Version: 1.3                                                    # ||
|| #	Date: April 15 2005                                             # ||
|| # ------------------------------------------------------------------ # ||
|| #################### //-- COPYRIGHT INFO --// ######################## ||
|| #	Copyright (C) 2005 Chris LaRocque								# ||
|| #																	# ||
|| #	This script is free software; you can redistribute it and/or	# ||
|| #	modify it under the terms of the GNU General Public License		# ||
|| #	as published by the Free Software Foundation; either version 2	# ||
|| #	of the License, or (at your option) any later version.			# ||
|| #																	# ||
|| #	This script is distributed in the hope that it will be useful,	# ||
|| #	but WITHOUT ANY WARRANTY; without even the implied warranty of	# ||
|| #	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the	# ||
|| #	GNU General Public License for more details.					# ||
|| #																	# ||
|| #	Script is intended to be used with:								# ||
|| #	osCommerce, Open Source E-Commerce Solutions					# ||
|| #	http://www.oscommerce.com										# ||
|| #	Copyright (c) 2008 osCommerce									# ||
|| ###################################################################### ||
\*========================================================================*/

#--------------------------------------------------------------------------#
############################################################################ 
 
# DO NOT ALTER OR EDIT BELOW THIS LINE UNLESS YOU KNOW WHAT YOU ARE DOING #

# Call required files
@require(DIR_WS_LANGUAGES . $language . '/' . 'meta_tags.php');
require(DIR_WS_FUNCTIONS . 'meta.php');

# Take the PHP_SELF global and replace all the /'s
	# This should work with ALL URL's but best for search engine safe
	$meta_cache_filename = str_replace("/", "_", $_SERVER['PHP_SELF']);
	# Replace all the /'s in the URL parameters.  Should not be needed but just in case...
	$meta_cache_param = str_replace("/", "_", $_SERVER["QUERY_STRING"]);
	# Remove the osCsid from the cache parameters
	$meta_cache_param = preg_replace("/([&]|)osCsid=.{32}/", "", $_SERVER["QUERY_STRING"]);
	#Add the cache language and store it
	$meta_cache_language = '_' . $_SESSION['language'];
	# Set the cache file currency and store it
	$meta_cache_currency = '_' . $_SESSION['currency'];
		
# Create paths and cache names
$meta_cache_file=$meta_cache_filename.'_'.$meta_cache_param.$cache_language.$cache_currency.".meta-cache";
$meta_cache_file_full = $meta_cache_files_path.$meta_cache_file;

#############################################################################################
# Check to see what type of cache if any and run with it...
$cache_type == 1
   ? $meta_cache_code = $cache->get_cache($meta_cache_file)
   : NULL;
   
if ($meta_cache_code){ echo $meta_cache_code;
}else if ($cache_type == 2 && file_exists($meta_cache_file_full)) {
echo base64_decode(gzinflate(file_get_contents($meta_cache_file_full)));
}else{
ob_start();

# Page Parameters  
#####################################################################################################
# product_info.php

# If using Categories & Products get the product info
if (strpos($_SERVER['PHP_SELF'], 'product_info.php')){
$cacherun='true';
$product_info_meta_query = tep_db_query("select pd.products_name, pd.products_description, p.products_model from " . TABLE_PRODUCTS . " p, " .  TABLE_PRODUCTS_DESCRIPTION . " pd WHERE p.products_id = '" . (int)$_GET['products_id'] . "' AND p.products_status = '1' AND pd.products_id = p.products_id AND pd.language_id = '" . (int)$languages_id . "'");
$product_meta_info = tep_db_fetch_array($product_info_meta_query);
# If using Categories & Products get the Manufacturers info
$product_man__info_meta_query = tep_db_query("select m.manufacturers_name from " . TABLE_PRODUCTS . " p, "  . TABLE_MANUFACTURERS . " m," . TABLE_PRODUCTS_DESCRIPTION . " pd WHERE p.products_id = '" . (int)$_GET['products_id'] . "' AND m.manufacturers_id = p.manufacturers_id AND pd.language_id = '" . (int)$languages_id . "'");
$product_man_meta_info = tep_db_fetch_array($product_man__info_meta_query);

# Start getting data for the meta tags
# if model number exists add it to the title
tep_not_null($product_meta_info['products_model'])&& ($show_model_in_title)
  ? $title.=$product_meta_info['products_name'].' - '.$product_meta_info['products_model'].' '
  : $title.=$product_meta_info['products_name'];

# get data for the description
$desc.=$product_meta_info['products_name'];
$man=$product_man_meta_info['manufacturers_name'];
$descfull.=$product_meta_info['products_description'];

tep_not_null($man) && ($show_man_in_title)
  ? $title.= ' ' . TEXT_BYX . ': '.$man.' - '
  : $title.=' - ';
  
tep_not_null($product_meta_info['products_model'])
  ? $desc.=' ('.$product_meta_info['products_model'].')'
  : NULL;
  
tep_not_null($man)
  ? $desc.=' by '. $man
  : NULL;
  
tep_not_null($descfull)
  ? $desc.=' - '. $descfull
  : NULL;
	
# get data for the keywords
tep_not_null($product_meta_info['products_name'])
  ? $key.=$product_meta_info['products_name'].', '
  : NULL;
  
tep_not_null($product_meta_info['products_model'])
  ? $key.=$product_meta_info['products_model'].', '
  : NULL;

# clean up a little
$strip_bread_array = array(HEADER_TITLE_TOP, HEADER_TITLE_CATALOG, $model['products_model']); 
$pre_key=$breadcrumb->trail('`~`~`');
$key.=str_replace($strip_bread_array, '',$pre_key);

# add the manufacturer but strip some things like:
//$key.=str_replace($strip_man_array, '',strtolower($product_man_meta_info['manufacturers_name'].','));

# Final stage for product_info.php
# Title
$metatitle.=$title .' '.STORE_NAME;

tep_not_null(HEAD_TITLE_TAG_ALL)
  ? $metatitle.=' - '. STORE_DESCRIPT
  : NULL;
  
$metatitle=meta_create_title($metatitle);

# Description
$metaDescription.=$desc .' '.STORE_DESCRIPT;

tep_not_null(HEAD_DESC_TAG_ALL)
  ? $metaDescription.=' - '. STORE_METDEX
  : NULL;
  
$metaDescription=meta_create_meta_description($metaDescription); //shop2.0brain:todo
//$metaDescription=substr(strip_tags(str_replace("  ", " ", (str_replace("\t", " ", (str_replace("   ", " ", (str_replace("\n", "", (str_replace("\r", "", $metaDescription)))))))))),  0, 300);
# Keywords
tep_not_null(HEAD_KEY_TAG_ALL)
  ? $key.=' '.STORE_KEYWORD
  : NULL;
  
$metaKeywords=strtolower(meta_create_meta_keywords($key));
#------------------------------------------------------------------------------------------------------#
# index.php with categories
} else if (strpos($_SERVER['PHP_SELF'], 'index.php')) {

# If using Categories & Products get the product info
if ($current_category_id){
$cacherun='true';
	$categories_query = tep_db_query("select categories_name from " . TABLE_CATEGORIES_DESCRIPTION . " WHERE categories_id ='"  .$current_category_id. "' and language_id = '" . (int)$languages_id . "'");
$categories = tep_db_fetch_array($categories_query);

# get sub categories to list keywords when no product
$sub_categories_query = tep_db_query("select cd.categories_name from " . TABLE_CATEGORIES_DESCRIPTION . " cd, " . TABLE_CATEGORIES  . " c   WHERE c.parent_id ='"  .$current_category_id. "' AND cd.categories_id = c.categories_id and cd.language_id = '" . (int)$languages_id . "' LIMIT 20");

# get top level categories to list keywords when no product or sub cats
if ($category_depth != 'products' && $category_depth != 'nested') {
$categories_all_query = tep_db_query("select cd.categories_name from " . TABLE_CATEGORIES_DESCRIPTION . " cd, " . TABLE_CATEGORIES  . " c   WHERE c.parent_id = 0 AND cd.categories_id = c.categories_id and cd.language_id = '" . (int)$languages_id . "' ORDER BY c.sort_order ASC");
}

# Start getting data for the meta tags
$title.=$categories['categories_name'];

# Create description with part of breadcrumb
$strip_bread_array = array(HEADER_TITLE_TOP, HEADER_TITLE_CATALOG); 
$pre_desc=strip_tags($breadcrumb->trail(' - ')); 
$pre_desc=str_replace('"', '”', $pre_desc);
$desc.=str_replace($strip_bread_array, '',$pre_desc).' from '.STORE_NAME;


tep_not_null(HEAD_DESC_TAG_ALL)
  ? $desc.=' - '. STORE_METDEX
  : NULL;
  
$metaDescription=meta_create_meta_description($metaDescription);

$key.=$categories['categories_name'].', ';

# get sub categories to list as keywords when no product
while ($sub_categories = tep_db_fetch_array($sub_categories_query)) {
$key.=$sub_categories['categories_name'].', ';
}

# get the products in this category
if ($category_depth == 'products') {
$products_query = tep_db_query("SELECT pd.products_name FROM " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " .  TABLE_PRODUCTS_TO_CATEGORIES . " pc WHERE pc.categories_id = '".$current_category_id."' AND pc.products_id = p.products_id AND p.products_status = '1' AND p.products_id = pd.products_id AND pd.language_id = '" . (int)$languages_id . "' ORDER BY rand()");
while($products = tep_db_fetch_array($products_query)) {
$key.=$products['products_name'] . ', ';
}
}
  
if ($category_depth != 'products' && $category_depth != 'nested') {
while ($categories_all = tep_db_fetch_array($categories_all_query)) {
$key.=str_replace($categories['categories_name'], '`~`~`',$categories_all['categories_name']).', ';
}
}

# if the page is showing products by manufacturers
} else if ($_GET['manufacturers_id']) {
$title.=$manufacturers['manufacturers_name'];
$desc.= 'Products by ' . $manufacturers['manufacturers_name'] . ' from ' . STORE_OWNER;

// get products by this manufacturer
$listing_man_sql = tep_db_query("select pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "' AND p.products_status = '1' AND pd.products_id = p.products_id ORDER BY rand()");
while($products = tep_db_fetch_array($listing_man_sql)) {
$key.= $products['products_name'] . ', ';
}
}

# index.php default
if (!isset($_GET['manufacturers_id']) && (!$current_category_id)) $default=true;

# Final stage for index.php w/o categories
# Title
tep_not_null($title)
  ? $metatitle.=$title.' - '
  : NULL;
  
$metatitle.=STORE_NAME;
tep_not_null(HEAD_TITLE_TAG_INDEX) && $default==true
  ? $metatitle.=' - '.STORE_METDEX
  : NULL;
  
tep_not_null(HEAD_TITLE_TAG_ALL)
  ? $metatitle.=' - '.STORE_DESCRIPT
  : NULL;
  
$metatitle=meta_create_title($metatitle);

# Description
!tep_not_null($desc)
  ? $metaDescription.=STORE_NAME.' - '
  : NULL;
  
tep_not_null(HEAD_DESC_TAG_ALL) && $default==true
  ? $desc.=STORE_DESCRIPT.' - '
  : NULL;
    
$metaDescription.=$desc;
//tep_not_null($metaDescription)&& $default==true
  //? $metaDescription.=' - '.STORE_DESCRIPT
  //: NULL;
  
tep_not_null(HEAD_DESC_TAG_INDEX) && $default==true
  ? $metaDescription.=' - '.STORE_DESCRIPT
  : NULL;
  
$metaDescription=meta_create_meta_description($metaDescription);

# Keywords
tep_not_null(HEAD_KEY_TAG_INDEX) && $default==true
  ? $key.=STORE_KEYWORD.', '
  : NULL;
  
tep_not_null(HEAD_KEY_TAG_ALL)
  ? $key.=' - '. STORE_KEYWORD
  : NULL;
  
$metaKeywords=strtolower(meta_create_meta_keywords($key));

#------------------------------------------------------------------------------------------------------#
# products_new.php 
} else if (strpos($_SERVER['PHP_SELF'], 'products_new.php')) {
$cacherun='true';
# Build a list of new product names to put in keywords
$products_new_query_raw = tep_db_query("select pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' AND p.products_id = pd.products_id AND pd.language_id = '" . (int)$languages_id . "' ORDER by p.products_date_added DESC");
 while ($products_new = tep_db_fetch_array($products_new_query_raw)) {
   $key.=$products_new['products_name'] . ', ';
	}
	
# Final stage for products_new.php
# Title
$metatitle=HEADING_TITLE.' - '.STORE_NAME;

tep_not_null(HEAD_TITLE_TAG_ALL)
  ? $metatitle.=' - '.STORE_DESCRIPT
  : NULL;
  
$metatitle=meta_create_title($metatitle);

# Description
$metaDescription=STORE_NAME.' - '.HEADING_TITLE;

tep_not_null(HEAD_DESC_TAG_ALL)
  ? $metaDescription.=' - '. STORE_METDEX
  : NULL;
  
$metaDescription=meta_create_meta_description($metaDescription);

# Keywords
tep_not_null(HEAD_KEY_TAG_ALL)
  ? $key.=' - '. STORE_KEYWORD
  : NULL;
  
$metaKeywords=strtolower(meta_create_meta_keywords($key));

#------------------------------------------------------------------------------------------------------#

# specials.php 
} else if (strpos($_SERVER['PHP_SELF'], 'specials.php')) {
$cacherun='true';
# Build a list of ALL specials product names to put in keywords
$specials_query = tep_db_query("select pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_SPECIALS . " s WHERE s.status = '1' AND p.products_status = '1' AND s.products_id = p.products_id AND p.products_id = pd.products_id ORDER by s.specials_date_added DESC ");
 while ($specials = tep_db_fetch_array($specials_query)) {
   $key.=$specials['products_name'] . ', ';
	}
	
# Final stage for specials.php
# Title
$metatitle=HEADING_TITLE.' - '.STORE_NAME;

tep_not_null(HEAD_TITLE_TAG_ALL)
  ? $metatitle.=' - '.STORE_DESCRIPT
  : NULL;
  
$metatitle=meta_create_title($metatitle);

# Description
$metaDescription=STORE_NAME;

tep_not_null(HEAD_DESC_TAG_ALL) 
  ? $metaDescription.=' - '. STORE_METDEX
  : NULL;
  
$metaDescription=meta_create_meta_description($metaDescription);

# Keywords
tep_not_null(HEAD_KEY_TAG_ALL)
  ? $key.=' - '. STORE_KEYWORD
  : NULL;
  
$metaKeywords=strtolower(meta_create_meta_keywords($key));

} else if (
          (strpos($_SERVER['PHP_SELF'], 'shipping.php')) ||
          (strpos($_SERVER['PHP_SELF'], 'privacy.php')) ||
          (strpos($_SERVER['PHP_SELF'], 'conditions.php')) ||
          (strpos($_SERVER['PHP_SELF'], 'contact_us.php')) ||
          (strpos($_SERVER['PHP_SELF'], 'dynamic_sitemap')) ||
          (strpos($_SERVER['PHP_SELF'], 'shipping.php')) ||
          (strpos($_SERVER['PHP_SELF'], 'my_points_help.php'))
          )
          {

$metatitle= HEADING_TITLE . ' - ' . STORE_NAME . ' - ' . STORE_DESCRIPT ;
  
$metatitle=meta_create_title($metatitle);

# Description
$metaDescription= STORE_NAME . ' - ' . HEADING_TITLE ;
tep_not_null(HEAD_DESC_TAG_ALL)
  ? $metaDescription.=' - '. STORE_METDEX
  : NULL;
  
$metaDescription=meta_create_meta_description($metaDescription);

# Keywords
tep_not_null(HEAD_KEY_TAG_ALL)
  ? $key.= (STORE_KEYWORD . ', ' . HEADING_TITLE )
  : NULL;
  
$metaKeywords=strtolower(meta_create_meta_keywords($key));



#------------------------------------------------------------------------------------------------------#
# other pages
} else {
# Title
# pages to use HEADING_TITLE loop
if (HEADING_TITLE != 'HEADING_TITLE') {
$metatitle=HEADING_TITLE;
} else if (HEADING_TITLE_1 != 'HEADING_TITLE_1'){
$metatitle=HEADING_TITLE_1;
} else if (HEADING_TITLE_2 != 'HEADING_TITLE_2'){
$metatitle=HEADING_TITLE_2;
}
// Module: Information Pages Unlimited
if(isset($_GET['info_id']) || tep_not_null($_GET['info_id']) || is_numeric($_GET['info_id']) ) {
  $info_id = intval($_GET['info_id']);
  $information_query = tep_db_query("SELECT information_title, information_description FROM " . TABLE_INFORMATION . " WHERE visible='1' AND information_id='" . (int)$info_id . "' AND language_id = '" . (int)$languages_id . "'");
  $information = tep_db_fetch_array($information_query);
  $metatitle = stripslashes($information['information_title']);
  $metaDescription = stripslashes($information['information_description']);
//shop2.0brain:todo
//  $metaDescription = substr(strip_tags(str_replace("  ", " ", (str_replace("\t", " ", (str_replace("   ", " ", (str_replace("\n", "", (str_replace("\r", "", $information['information_description'])))))))))),  0, 300);
} //Module: Information Pages Unlimited

$metatitle.=' - ' . STORE_NAME;

tep_not_null(HEAD_TITLE_TAG_ALL)
  ? $metatitle.=' - ' . STORE_DESCRIPT
  : NULL;
  
$metatitle=meta_create_title($metatitle);

# Description
if (tep_not_null($metaDescription)) {
$metaDescription.=' - ' . STORE_NAME;
} else {
$metaDescription=STORE_NAME;
}
tep_not_null(HEAD_DESC_TAG_ALL)
  ? $metaDescription.=' - ' . STORE_METDEX
  : NULL;
  
$metaDescription=meta_create_meta_description($metaDescription);

# Keywords
tep_not_null(HEAD_KEY_TAG_ALL)
  ? $key.=' - ' . STORE_KEYWORD
  : NULL;
  
$metaKeywords=strtolower(meta_create_meta_keywords($key));
}

#####################################   OUTPUT THE DATA    ########################################## 
echo '  <title>'.$metatitle.'</title>' . "\n";
//todo: utf8 error
//echo '  <meta name="keywords" content="' . $metaKeywords . '" />' . "\n";
echo '  <meta name="description" content="' . $metaDescription . '" />' . "\n";
// RSS 
  if (!isset($lng) || (isset($lng) && !is_object($lng))) {
  include(DIR_WS_CLASSES . 'language.php');
    $lng = new language;
  }
  reset($lng->catalog_languages);
  while (list($key, $value) = each($lng->catalog_languages)) {
?>
<link rel="alternate" type="application/rss+xml" title="<?php echo STORE_NAME . ' - ' . BOX_INFORMATION_RSS; ?>" href="<?php echo FILENAME_RSS, '?language=' . $key; ?>" />
<?php
  }
// RSS
#####################################################################################################

###################################   BELOW IS CACHE INFO   #########################################
$meta_cache_output = ob_get_contents();
ob_end_flush();

$cache_type == 1  && $cacherun=='true'
  ? $cache->save_cache($meta_cache_file, $meta_cache_output, 'RETURN', 1, 0, $expires)
  : NULL;

if ($cache_type == 2  && $cacherun=='true'){
$meta_cache_output_code = gzdeflate(base64_encode($meta_cache_output),1);

      $fp = fopen($meta_cache_file_full , 'w');
      $fout = fwrite($fp , $meta_cache_output_code);
      fclose($fp);
}}
?>