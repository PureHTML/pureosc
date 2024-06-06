<?php
//jsp:globalni sleva
$globallevakoeficient = 0.8; //sleva 20%
$deliverydate = 3;
/// !!!!!!!!!!!!!!!!!
//        $allow_no_stock                 = "1"; 
	


/*
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com
  
  Released under the GNU General Public License
  Copyright (c) 2003 The Internet Foundry (http://www.theinternetfoundry.com)
  -----------------------------------------------------------------
  OSCommerce Product XML Feed - V2.0A - XML.PHP | ALL PRODUCTS VERSION
  -----------------------------------------------------------------
  Version 2.0A - 17/04/2005
  -----------------------------------------------------------------
  Developed by:		Kenny Boyd, Senior Developer, The Internet Foundry, United Kingdom
  Email & MSN:		kenny@theinternetfoundry.com
  Web:				http://www.theinternetfoundry.com

  Version 2 Feature Ideas & Beta Testing provided by:
  Eyal Shoabi, (admin@volt.co.il - http://www.volt.co.il, Israel)
  -----------------------------------------------------------------
  CHANGELOG 
  17/03/05	v2.0b - Kenny Boyd - Complete rewrite of original All Products addon along with better SQL and  improved configuration
  17/03/05	v2.0a - Kenny Boyd - Complete rewrite of addon to offer Category based products, better SQL and improved configuration
  25/08/04 	v1.1  - Kenny Boyd - added more character checks and some code tidied
  21/01/03	v1.0  - Created by Kenny Boyd as a rework of Patrick Veverka's great OSC Anywhere addon
  -----------------------------------------------------------------
  OFFICAL SUPPORT FORUM
  Please visit:
  http://forums.oscommerce.com/index.php?showtopic=146810
  -----------------------------------------------------------------
  NEW FEATURES 
  + NEW ALL PRODUCTS BASED system to allow output of all products in your shop
  + User Re-nameable XML Tag Names
  + Database Queires entirely rewritten for faster loading
  + All Product Data available by default
  + New Configuration Code allows more control over feed and tag output
  + New Support for displaying Specials Price & TAX/VAT onto products price 
  -----------------------------------------------------------------
  INSTALATTION & CONFIGURATION HELP:
  
  A COMPLETE HTML HELP GUIDE IS INCLUDED IN THE ADDON ZIP FILE
  Please read README.HTM before using this addon.
  -----------------------------------------------------------------
  */

//----------------------------------------------------------------------------------------------
// THE FOLLOWING OPTIONS MUST BE CONFIGURED!
//----------------------------------------------------------------------------------------------

//----------------------------------------------------------------------------------------------
// 	1. Setup OSC Link
//----------------------------------------------------------------------------------------------
//  If you have placed this file in the SAME directory as your OS Commerce shop then 
//  SKIP TO SECTION 2

//  If you have placed this file away from your OS Commerce directory please enter the path
//  to the file "application_top.php" which is in the includes directory of your OSC installation:

	$osc_path	= 	"includes/application_top.php";

//----------------------------------------------------------------------------------------------
//	2. Configure Site Info
//----------------------------------------------------------------------------------------------
//	Enter the url to your website - do not put 'http://' or enter any slashes
	$domain_name 	= 	"www.dvere.com";	// NO SLASHES - EG: www.mysite.com 
//	Enter the folder name of your shop directory, this is normally 'catalog'
//	$catalog_folder	=	"catalog"; // default is 'catalog' - NO SLASHES!
//	If your shop is in your site root (EG: www.mysite.com/index.php) then uncomment the next line.
	$catalog_folder	=	"";    
//	Enter the folder name of your product images directory, this is normally 'images'
	$image_folder	=	"images"; // NO SLASHES!

//----------------------------------------------------------------------------------------------
//	3. Ouput Options:
//----------------------------------------------------------------------------------------------
//	I have rewrote the sql queries to allow easier configuration of which values you wish to be 
//	included in the XML output. These options can easily be turned on or off.
//----------------------------------------------------------------------------------------------
//	For each value you wish to be included in the feed change the value to 1 like:
//	$product_price 			= "1";	// Include Product's Price - (1 = YES | 0 = NO) 
//	For each value you DO NOT want to be included in the feed change the value to 0 like:
//	$product_price 			= "0";	// Include Product's Price - (1 = YES | 0 = NO) 
//----------------------------------------------------------------------------------------------
//jsp:new jazyk:
	$languages_id = 7;
//jsp:new oriznuti popisu
	$substrdescription = 120;
//jsp:new oriznuti nazvu
	$substrtitle = 64;
	$show_creation_time		= "0";  // Include date and time tag that displays when the xml feed was run. - (1 = YES | 0 = NO)
	$product_name 			= "1";	// Include Product's Name/Title - (1 = YES | 0 = NO) 
	$product_price 			= "1";	// Include Product's Price - (1 = YES | 0 = NO) 
	$product_manufacturer	= "1";	// Include Product's Manufacturer Name - (1 = YES | 0 = NO) 
	$product_weight			= "0";  // Include Product's Weight - (1 = YES | 0 = NO) 	
	$product_model			= "0";  // Include Product's Model Number - (1 = YES | 0 = NO) 			
	$product_quantity		= "0";  // Include Quantity In Stock - (1 = YES | 0 = NO) 
	$product_image			= "1";  // Include link to products image? - (1 = YES | 0 = NO) 			
	$product_info_link 		= "1";  // Include link to product_info.php at your website? - (1 = YES | 0 = NO) 
	$product_date_added		= "0";  // Include date product was added - (1 = YES | 0 = NO) 			
	$product_date_modified	= "0";  // Include date product was modified - (1 = YES | 0 = NO) 			
	$product_date_available	= "0";  // Include date product is available - (1 = YES | 0 = NO) 			

// 	By default the XML feed will only display products which are set as active 
//  (green light next to product name in OSC Admin) - If you wish to output INACTIVE products then
//  change the following value to 1 (eg: 	$allow_all = "1"; ), otherwise leave unchanged.
	$allow_all				= "0"; 
// 	By default only products that are in stock and have a quantity of 1 or more will be displayed.
//  If you wish to output OUT OF STOCK (0 quantity) products then change the following value to 1 
//  (eg: 	$allow_no_stock = "1"; ), otherwise leave unchanged.
	$allow_no_stock			= "0"; 
//----------------------------------------------------------------------------------------------
//	4. XML Element Names
//----------------------------------------------------------------------------------------------	
//	This section is provided for users who will use xml parsers that require predetermined tag names
//  or tag names that need to be in other languages apart from English. 
//  DO NOT CHANGE THESE NAMES UNLESS YOU HAVE TO!	
	$xml_tags['master']			= 	"SHOP";	//Master tag: 	orig:<STOREITEMS>
	$xml_tags['time']			= 	"CREATED";		// Feed creation date/time Tag: 				<CREATED>
	$xml_tags['product']		=	"SHOPITEM";// Product Container Tag: <PRODUCT ITEM="xxx">
	$xml_tags['name']			=	"PRODUCT";			// Product's Name/Title in Product Container:	<NAME> 				
	$xml_tags['price']			=	"PRICE_VAT";		// Price tag in Product Container: 				<PRICE>
	$xml_tags['manufacturer']	=	"MANUFACTURER";	// vyrobce
	$xml_tags['weight']			=	"WEIGHT";		// Weight tag in Product Container: 			<WEIGHT>
	$xml_tags['model']			=	"MODEL";		// Model tag in Product Container: 				<MODEL>
	$xml_tags['quantity']		=	"QUANTITY";		// Quantity tag in Product Container: 			<QUANTITY>
	$xml_tags['url']			=	"URL";			// Product Info Page URL in Product Container: 	<URL> 
	$xml_tags['image_url']		=	"IMGURL";	// Product Image URL in Product Container: 		<IMAGE_URL>
	$xml_tags['added']			="ADDED";		// Date Product Added in Product Container: 	<ADDED>
	$xml_tags['modified']		=	"MODIFIED";		// Date Product Modfied in Product Container: 	<MODIFIED>
	$xml_tags['available']		=	"AVAILABLE";	// Date Product Available in Product Container:	<AVAILABLE>
//----------------------------------------------------------------------------------------------
//	5. PRICING
//----------------------------------------------------------------------------------------------	
//	This section controls pricing options. You can set a TAX rate then activate it so that all 
//  default product prices with have the tax added on to the products price. You can also specify
// if you want to disp[lay special discounted prices or not.
//----------------------------------------------------------------------------------------------	
// VAT OPTIONS:
	$pricing_vat_rate		= 	"10";	// Enter Tax Rate to add to Products Price 
										// (e.g: To add 17.5% on all product prices enter "17.5"
										// NOTE: To activate VAT you must TURN ON the next option below!
	
	$pricing_add_vat		=	"1";	// Activate TAX on all product prices - DEFAULT IS OFF || (1 = YES | 0 = NO)
										// To activate TAX change the value to 1 (e.g: $pricing_add_vat = "1";
//----------------------------------------------------------------------------------------------	
// PRICE SPECIALS OPTIONS:
	
	$pricing_show_specials	=	"1";	// Show products special discounted price instead of normal; product price
										// when available - DEFAULT IS OFF || (1 = YES | 0 = NO)
//----------------------------------------------------------------------------------------------
// END OF CONFIGURATION AREA 
//----------------------------------------------------------------------------------------------

////////////////////////////////////////////////////////////////////////////////////////////////
// *** IF YOU NEED TO ADD CUSTOM TAGS AND NEED HELP PLEASE SEE ADVANCED.HTM OR VISIT: 
// *** http://forums.oscommerce.com/index.php?showtopic=146810         *** 
// *** PLEASE DO NOT EDIT PAST THIS POINT UNLESS YOU KNOW WHAT YOU ARE DOING                 ***
////////////////////////////////////////////////////////////////////////////////////////////////
require($osc_path);
//Header( 'Content-Type: text/xml' ); 
Header( 'Content-Type: text/xml; charset=utf-8' ); 
echo '<?xml version="1.0" encoding="utf-8"?>'; 
echo '<' . $xml_tags['master'] . '>';
if ($show_creation_time == 1) {
$timestamp = date("D M j G:i:s T Y"); 
echo '<' . $xml_tags['time'] . ' value="' . $timestamp . '">';
}
	$connection = mysql_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD) or die("OSC XML FEED FAILURE - Couldn't make connection to local database.");
	$db = mysql_select_db(DB_DATABASE, $connection) or exit("OSC XML FEED FAILURE - Error code: " . mysql_errno($connection) . " Error: " . mysql_error($connection)  . ".");
	$product_query 			= "SELECT `products`.`products_id`,`products`.`products_quantity`,`products`.`products_model`,`products`.`products_image`,`products`.`products_price`,`products`.`products_date_added`,`products`.`products_last_modified`,`products`.`products_date_available`,`products`.`products_weight`,`products`.`products_status`,`products`.`manufacturers_id`,`products_description`.`products_name`,`products_description`.`products_url`,  `manufacturers`.`manufacturers_name` FROM `products` INNER JOIN `products_description` ON (`products`.`products_id` = `products_description`.`products_id`)   INNER JOIN `manufacturers` ON (`products`.`manufacturers_id` = `manufacturers`.`manufacturers_id`)";
    if(($allow_all		==	"0") && ($allow_no_stock	==	"0")) {
	$product_query	.= " WHERE (`products`.`products_status` = 1) AND (`products`.`products_quantity` > 0)"; 
	}
	else {
	if($allow_all		==	"0")	{	$product_query	.= " WHERE (`products`.`products_status` = 1)"; 	}
	if($allow_no_stock	==	"0")	{	$product_query	.= " WHERE (`products`.`products_quantity` > 0)"; }
	}
	$product_query_result 	= mysql_query($product_query,$connection) or exit("<hr>code: " . mysql_errno($connection) . " error: " . mysql_error($connection)  . ".");
	$product_query_count	= mysql_numrows($product_query_result);
	if ($product_query_count > 0) {
	while ($row = mysql_fetch_array($product_query_result)) {
	//----------------------------------------------------------------------------------------------
	// START -> insert any custom sql queries for extra tags here
	//----------------------------------------------------------------------------------------------
    $product_info_query = tep_db_query("select p.products_id, pd.products_name, pd.products_description, p.products_model, p.products_quantity, p.products_image, pd.products_url, p.products_price, p.products_tax_class_id, p.products_date_added, p.products_date_available, p.manufacturers_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = '" . $row['products_id'] . "' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "'");
    $product_info = tep_db_fetch_array($product_info_query);

	//----------------------------------------------------------------------------------------------
	// END   -> insert any custom sql queries for extra tags here
	//----------------------------------------------------------------------------------------------
	
		$row['products_price']	= tep_round($row['products_price'], 2);
		if ($pricing_show_specials == 1) {
			$specials_query 		= "SELECT `specials`.`specials_new_products_price` FROM `specials` WHERE  (`specials`.`products_id` = " . $row['products_id'] . ")";
			$specials_result 		=	mysql_query($specials_query,$connection) or exit("<hr>code: " . mysql_errno($connection) . " error: " . mysql_error($connection)  . ".");
			$specials_query_count	= 	mysql_numrows($specials_result);
			if ($specials_query_count > 0) {
				$specials = mysql_fetch_array($specials_result);
				$specials['specials_new_products_price']	= tep_round($specials['specials_new_products_price'], 2);
				$row['products_price']	=	$specials['specials_new_products_price'];	
			}
		}
		if ($pricing_add_vat == 1) { 
		$temp_tax 					= ($row['products_price'] / 100) * $pricing_vat_rate;
		$temp_tax					= tep_round($temp_tax, 2);
		$row['products_price'] 		= $row['products_price'] + $temp_tax;
		}
	// search and replace characters from data which xml will not process
//jsp:zruseno
/*
  	if ($product_name == 1) {
	$row['products_name']	= ereg_replace ("&", " and ", $row['products_name']);
  	$row['products_name']	= ereg_replace ("®", "(R)", $row['products_name']);
  	$row['products_name']	= ereg_replace ("™", "(TM)", $row['products_name']);
 	}
	if ($product_manufacturer == 1) {
	$row['manufacturers_name']	= ereg_replace ("&", " and ", $row['manufacturers_name']);
  	$row['manufacturers_name']	= ereg_replace ("®", "(R)", $row['manufacturers_name']);
  	$row['manufacturers_name']	= ereg_replace ("™", "(TM)", $row['manufacturers_name']);
	}
*/
	// build nested product element
//original:	echo "<" . $xml_tags['product'] ." ITEM='" . $row['products_id'] . "'>";
//seznam:
	echo '<' . $xml_tags['product']  . '>';
 	if ($product_name			== "1")	{ echo	'<' . $xml_tags['name'] . '>' .  $row['products_name'] . ' | ' . $row['manufacturers_name'] . '</' . $xml_tags['name'] . '>';					} 
//jsp:globalni sleva
	if ($product_price			== "1")	{ echo	'<' . $xml_tags['price'] . '>' .  round($row['products_price']*$globallevakoeficient)	 . '</' . $xml_tags['price'] . '>';					} 
//jsp:todo:manufacturernatvrdo
$row['manufacturers_name'] = 'Garamond';
echo	'<' . $xml_tags['manufacturer'] . '>' .  $row['manufacturers_name']	 . '</' . $xml_tags['manufacturer'] . '>';				
	if ($product_weight			== "1")	{ echo	'<' . $xml_tags['weight'] . '>' . $row['products_weight'] . '</' . $xml_tags['weight'] . '>';	} 	
	if ($product_model			== "1")	{ echo	'<' . $xml_tags['model'] . '>' . $row['products_model'] . '</' . $xml_tags['model'] . '>'; 	} 			
	if ($product_quantity		== "1")	{ echo	'<' . $xml_tags['quantity'] . '>' . $row['products_quantity'] . '</' . $xml_tags['quantity'] . '>'; 	} 
		if ($product_info_link		== "1")	{ 
//jsp:orig		if ($catalog_folder			== "")	{ echo	'<' . $xml_tags['url'] . '>http://' . $domain_name . '/product_info.php?products_id=' . $row['products_id'] . '</' . $xml_tags['url'] . '>';	} 	
                    if ($catalog_folder			== "")	{ echo	'<' . $xml_tags['url'] . '>' . tep_href_link(FILENAME_PRODUCT_INFO, 'manufacturers_id=' . $product_info['manufacturers_id'] . '&products_id=' . $product_info['products_id']) . '</' . $xml_tags['url'] . '>';	} 	
		else								{ echo	'<' . $xml_tags['url'] . '>http://' . $domain_name . '/' .  $catalog_folder . '/product_info.php?products_id=' . $row['products_id'] . '</' . $xml_tags['url'] . '>';	} 	
	} 		 			
	if ($product_image			== "1")	{ 
		if ($catalog_folder			== "")	{ echo	'<' . $xml_tags['image_url'] . '>http://' . $domain_name . '/' .  $image_folder . '/' . $row['products_image'] . '</' . $xml_tags['image_url'] . '>';	}
		else								{ echo	'<' . $xml_tags['image_url'] . '>http://' . $domain_name . '/' .  $catalog_folder . '/' .  $image_folder . '/' . $row['products_image'] . '</' . $xml_tags['image_url'] . '>';	}
	} 	
	if ($product_date_added		== "1")	{ echo	'<' . $xml_tags['added'] . '>' . $row['products_date_added'] . '</' . $xml_tags['added'] . '>'; } 			
	if ($product_date_modified	== "1") { echo	'<' . $xml_tags['modified'] . '>' . $row['products_last_modified'] . '</' . $xml_tags['modified'] . '>'; } 			
	if ($product_date_available	== "1")	{ echo	'<' . $xml_tags['available'] . '>' . $row['products_date_available'] . '</' . $xml_tags['available'] . '>'; } 			
	//----------------------------------------------------------------------------------------------
	// START -> insert any extra custom tags here
	//----------------------------------------------------------------------------------------------
//	echo '<DESCRIPTION>' . htmlspecialchars(substr(strip_tags($product_info['products_description']),0, $substrdescription)) . '</DESCRIPTION>';
//	echo '<DESCRIPTION>' . ereg_replace('\.[[:blank:]].*$','.',str_replace('&amp;#160;',' ',htmlspecialchars(substr(strip_tags($product_info['products_description']),0, $substrdescription)))) . '</DESCRIPTION>';
	echo '<DESCRIPTION>' . tep_flatten_product_description_xml(str_replace($breaky, ' ',($product_info['products_description'])), $substrdescription) . '</DESCRIPTION>';

	echo '<VAT>' . $pricing_vat_rate . '</VAT>';
echo '<DELIVERY_DATE>' . $deliverydate  .   '</DELIVERY_DATE>';





	//----------------------------------------------------------------------------------------------
	// END   -> insert any extra custom tags here
	//----------------------------------------------------------------------------------------------
	echo '</' . $xml_tags['product'] . '>';
}
}
// free resources and close connection
mysql_free_result($product_query_result);
mysql_close($connection);
if ($show_creation_time == 1) { echo '</' . $xml_tags['time'] . '>';}
echo '</' . $xml_tags['master'] . '>';
?>