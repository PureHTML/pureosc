<?php
/**
 * Google XML Sitemap Feed Cron Script
 *
 * The Google sitemap service was announced on 2 June 2005 and represents
 * a huge development in terms of crawler technology.  This contribution is
 * designed to create the sitemap XML feed per the specification delineated 
 * by Google.  This cron script will call the code to create the scripts and 
 * eliminate the session auto start issues. 
 * @package Google-XML-Sitemap-Feed
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version 1.2
 * @link http://www.oscommerce-freelancers.com/ osCommerce-Freelancers
 * @link http://www.google.com/webmasters/sitemaps/docs/en/about.html About Google Sitemap 
 * @copyright Copyright 2005, Bobby Easland 
 * @author Bobby Easland 
 * @filesource
 */

	chdir('../');
	/**
	 * Option to compress the files
	 */
	define('GOOGLE_SITEMAP_COMPRESS', 'false');
	/**
	 * Option for change frequency of products
	 */
	define('GOOGLE_SITEMAP_PROD_CHANGE_FREQ', 'weekly');
	/**
	 * Option for change frequency of categories
	 */
	define('GOOGLE_SITEMAP_CAT_CHANGE_FREQ', 'weekly');
	/**
	 * Carried over from application_top.php for compatibility
	 */
	define('GOOGLE_SITEMAP_MAN_CHANGE_FREQ', 'weekly');
	/**
	 * Carried over from application_top.php for compatibility
	 */
	define('GOOGLE_SITEMAP_SPECIALS_CHANGE_FREQ', 'weekly');
	/**
	 * Carried over from application_top.php for compatibility
	 */
  define('GOOGLE_SITEMAP_PAGES_CHANGE_FREQ', 'weekly'); 
	define('DIR_WS_CATALOG', DIR_WS_HTTP_CATALOG);
	require_once('includes/configure.php');
	require_once(DIR_WS_INCLUDES . 'filenames.php');
	require_once(DIR_WS_INCLUDES . 'database_tables.php');
	require_once(DIR_WS_FUNCTIONS . 'database.php');
	tep_db_connect() or die('Unable to connect to database server!');

	$configuration_query = tep_db_query('select configuration_key as cfgKey, configuration_value as cfgValue from ' . TABLE_CONFIGURATION);
	while ($configuration = tep_db_fetch_array($configuration_query)) {
		define($configuration['cfgKey'], $configuration['cfgValue']);
	}

	function tep_not_null($value) {
		if (is_array($value)) {
		  if (sizeof($value) > 0) {
			return true;
		  } else {
			return false;
		  }
		} else {
		  if (($value != '') && (strtolower($value) != 'null') && (strlen(trim($value)) > 0)) {
			return true;
		  } else {
			return false;
		  }
		}
	} # end function

	include_once(DIR_WS_CLASSES . 'language.php');
	$lng = new language();
	$languages_id = $lng->language['id'];

if ( defined('SEO_URLS') && SEO_URLS == 'true' || defined('SEO_ENABLED') && SEO_ENABLED == 'true' ) {

	function tep_session_is_registered( $var ){
		return false;
	}  # end function

	function tep_session_name(){
		return false;
	} # end function
	
	function tep_session_id(){
		return false;
	} # end function

	function tep_parse_input_field_data($data, $parse) {
		return strtr(trim($data), $parse);
	} # end function

	function tep_output_string($string, $translate = false, $protected = false) {
		if ($protected == true) {
		  return htmlspecialchars($string);
		} else {
		  if ($translate == false) {
			return tep_parse_input_field_data($string, array('"' => '&quot;'));
		  } else {
			return tep_parse_input_field_data($string, $translate);
		  }
		}
	} # end function

	
	if ( file_exists(DIR_WS_CLASSES . 'seo.class.php') ){
    if (! defined("tep_get_parent_categories"))
    {
      function tep_get_parent_categories(&$categories, $categories_id) {
        $parent_categories_query = tep_db_query("select parent_id from " . TABLE_CATEGORIES . " where categories_id = '" . (int)$categories_id . "'");
        while ($parent_categories = tep_db_fetch_array($parent_categories_query)) {
          if ($parent_categories['parent_id'] == 0) return true;
          $categories[sizeof($categories)] = $parent_categories['parent_id'];
          if ($parent_categories['parent_id'] != $categories_id) {
            tep_get_parent_categories($categories, $parent_categories['parent_id']);
          }
        }
      }
    }
		require_once(DIR_WS_CLASSES . 'seo.class.php');
		$seo_urls = new SEO_URL($languages_id);
	}
	
	require_once(DIR_WS_FUNCTIONS . 'html_output.php');
	
	if ( file_exists(DIR_WS_CLASSES . 'cache.class.php') ){
		include(DIR_WS_CLASSES . 'cache.class.php');
		$cache = new cache($languages_id);
		if ( file_exists('includes/seo_cache.php') ){
			include('includes/seo_cache.php');
		}
		$cache->get_cache('GLOBAL');
	}
} # end if

$mapfile = ((GOOGLE_XML_SITEMAP_SEO != 'Standard') ? 'sitemap.class_Alternate.php' : 'sitemap.class.php');
require_once('googlesitemap/' . $mapfile);

$google = new GoogleSitemap(DB_SERVER, DB_SERVER_USERNAME, DB_DATABASE, DB_SERVER_PASSWORD);

$submit = true;

echo '<pre>';
if ($google->GenerateProductSitemap()){
	echo 'Generated Google Product Sitemap Successfully' . "\n\n";
} else {
	$submit = false;
	echo 'ERROR: Google Product Sitemap Generation FAILED!' . "\n\n";
}

if ($google->GenerateCategorySitemap()){
	echo 'Generated Google Category Sitemap Successfully' . "\n\n";
} else {
	$submit = false;
	echo 'ERROR: Google Category Sitemap Generation FAILED!' . "\n\n";
}

if (GOOGLE_XML_SITEMAP_CREATE_MANU == 'true') {
  $showManufacturers = true;
  if ($google->GenerateManufacturerSitemap()){
  	echo 'Generated Google Manufacturers Sitemap Successfully' . "\n\n";
  } else {
    $manufacturers_query = tep_db_query("select manufacturers_id from " . TABLE_MANUFACTURERS . " limit 1");
    if (tep_db_num_rows($manufacturers_query) > 0)
    {
      $submit = false;
  	  echo 'ERROR: Google Manufacturers Sitemap Generation FAILED!' . "\n\n";
    }
    else 
    {
      $showManufacturers = false;
  	  echo 'Google Sitemap Manufacturers not generated - no Manufacturers found!' . "\n\n";
    } 
  }
}

if (GOOGLE_XML_SITEMAP_CREATE_SPECIALS == 'true') {
  $showSpecials = true;
  if ($google->GenerateSpecialsSitemap()){
  	echo 'Generated Google Specials Sitemap Successfully' . "\n\n";
  } else {
    $specials_query = tep_db_query("select p.products_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_SPECIALS . " s where p.products_status = '1' and p.products_id = s.products_id and pd.products_id = s.products_id and pd.language_id = '" . (int)$languages_id . "' and s.status = '1' limit 1");
    if (tep_db_num_rows($specials_query) > 0)
    {
  	  $submit = false;
  	  echo 'ERROR: Google Specials Sitemap Generation FAILED!' . "\n\n";
    }
    else 
    {
      $showSpecials = false;
  	  echo 'Google Sitemap Specials not generated - no specials found!' . "\n\n";
    } 
  }
}

if (GOOGLE_XML_SITEMAP_CREATE_PAGES == 'true') {
  if ($google->GeneratePagesSitemap()){
  	echo 'Generated Google Pages Sitemap Successfully' . "\n\n";
  } else {
  	$submit = false;
  	echo 'ERROR: Google Pages Sitemap Generation FAILED!' . "\n\n";
  }
}  

if ($google->GenerateSitemapIndex()){
	echo 'Generated Google Sitemap Index Successfully' . "\n\n";
} else {
	$submit = false;
	echo 'ERROR: Google Sitemap Index Generation FAILED!' . "\n\n";
}



if ($submit){
	echo 'CONGRATULATIONS! All files generated successfully.' . "\n\n";
	echo 'If you have not already submitted the sitemap index to Google click the link below.' . "\n";
	echo 'Before you do I HIGHLY recommend that you view the XML files to make sure the data is correct.' . "\n\n";
	echo $google->GenerateSubmitURL() . "\n\n";
	echo 'For your convenience here is the CRON command for your site:' . "\n";
	echo 'php ' . dirname($_SERVER['SCRIPT_FILENAME']) . '/index.php' . "\n\n";
	echo 'Here is your sitemap index: ' . $google->base_url . 'sitemapindex.xml' . "\n";
	echo 'Here is your product sitemap: ' . $google->base_url . 'sitemapproducts.xml' . "\n";
	echo 'Here is your category sitemap: ' . $google->base_url . 'sitemapcategories.xml' . "\n";
	
  if (GOOGLE_XML_SITEMAP_CREATE_MANU == 'true' && $showManufacturers)
    echo 'Here is your manufacturers sitemap: ' . $google->base_url . 'sitemapmanufacturers.xml' . "\n";

  if (GOOGLE_XML_SITEMAP_CREATE_PAGES == 'true') 
    echo 'Here is your pages sitemap: ' . $google->base_url . 'sitemappages.xml' . "\n";
  
  if (GOOGLE_XML_SITEMAP_CREATE_SPECIALS == 'true' && $showSpecials)
  	echo 'Here is your specials sitemap: ' . $google->base_url . 'sitemapspecials.xml' . "\n";
} else {
	print_r($google->debug);
}

echo '</pre>';
?>