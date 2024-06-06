<?php
/*
  $Id: rss.php,v 1.22 2007/04/13 13:04:02 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

require('includes/application_top.php');

$navigation->remove_current_page();

$connection = tep_db_connect() or die('Unable to connect to database server!');

// If the language is not specified
if ($_GET['language'] == '') {
  $lang_query = tep_db_query('select languages_id, code from ' . TABLE_LANGUAGES . ' where directory = \'' . $language . '\'');
} else {
  $cur_language = tep_db_output($_GET['language']);
  $lang_query = tep_db_query('select languages_id, code from ' . TABLE_LANGUAGES . ' where code = \'' . $cur_language . '\'');
}

// Recover the code (fr, en, etc) and the id (1, 2, etc) of the current language
if (tep_db_num_rows($lang_query)) {
  $lang_a = tep_db_fetch_array($lang_query);
    $lang_code = $lang_a['code'];
    $lang_id = $lang_a['languages_id'];
}

// If the default of your catalog is not what you want in your RSS feed, then
// please change this three constants:
// Enter an appropriate title for your website
define(RSS_TITLE, STORE_NAME);
// Enter your main shopping cart link
define(WEBLINK, HTTP_SERVER);
// Enter a description of your shopping cart
define(DESCRIPTION, TITLE);
/////////////////////////////////////////////////////////////
//That's it.  No More Editing (Unless you renamed DB tables or need to switch
//to SEO links (Apache Rewrite URL)
/////////////////////////////////////////////////////////////

$store_name = STORE_NAME;
$rss_title = RSS_TITLE;
$weblink = WEBLINK;
$description = DESCRIPTION;
$email_address = STORE_OWNER_EMAIL_ADDRESS;

// Encoding to UTF-8
$store_name =  utf8_encode ($store_name);
$rss_title =  utf8_encode ($rss_title);
$weblink =  utf8_encode ($weblink);
$description =  utf8_encode ($description);
$email_address =  utf8_encode ($email_address);

// Begin sending of the data
Header('Content-Type: application/xml');
echo '<?xml version="1.0" encoding="UTF-8" ?>' . "\n";
echo '<?xml-stylesheet href="http://www.w3.org/2000/08/w3c-synd/style.css" type="text/css"?>' . "\n";
echo '<!-- RSS for ' . $store_name . ', generated on ' . date(r) . ' -->' . "\n";
?>
<rss version="2.0"
  xmlns:ecommerce="http://shopping.discovery.com/erss/"
  xmlns:media="http://search.yahoo.com/mrss/">
<channel>
<title><?php echo $rss_title; ?></title>
<link><?php echo $weblink;?></link>
<description><?php echo $description; ?></description>
<webMaster><?php echo $email_address; ?></webMaster>
<language><?php echo $lang_code; ?></language>
<lastBuildDate><?php echo date(r); ?></lastBuildDate>
<image>
  <url><?php echo $weblink . '/images/rss_logo.jpg';?></url>
  <title><?php echo $rss_title; ?></title>
  <link><?php echo $weblink;?></link>
  <description><?php echo $description; ?></description>
</image>
<docs>http://blogs.law.harvard.edu/tech/rss</docs>
<?php

// Create SQL statement
$category = preg_replace('/[^0-9_]/', '', $_GET['cPath']);
$ecommerce = $_GET['ecommerce'];
if ($category != '') {
  // Check to see if we are in a subcategory
  if (strrpos($category, '_') > 0) {
    $category = substr($category, strrpos($category, '_') + 1, strlen($category));
  }
  $catTable = ", " . TABLE_PRODUCTS_TO_CATEGORIES . " pc ";
  $catWhere = 'p.products_id = pc.products_id AND pc.categories_id = \'' . $category . '\' AND ';
}

$sql = "SELECT p.products_id, p.products_model, p.products_date_added, pd.products_name, pd.products_description,
               m.manufacturers_name, cd.categories_name
        FROM " . TABLE_PRODUCTS . " p
             $catTable
        LEFT JOIN " . TABLE_PRODUCTS_DESCRIPTION . " pd
               ON pd.products_id = p.products_id
              AND pd.language_id = '$lang_id'
        LEFT JOIN " . TABLE_MANUFACTURERS . " m
               ON m.manufacturers_id = p.manufacturers_id
        LEFT JOIN " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c
               ON p2c.products_id=p.products_id
        LEFT JOIN " . TABLE_CATEGORIES_DESCRIPTION . " cd
               ON p2c.categories_id = cd.categories_id
              AND cd.language_id = '$lang_id'
        WHERE $catWhere
              p.products_status=1 AND 
              p.products_to_rss=1
        GROUP BY p.products_id
        ORDER BY p.products_id DESC
        LIMIT " . MAX_RSS_ARTICLES;

// Execute SQL query and get result
$sql_result = tep_db_query($sql) or die("Couldn't execute query: $sql");

// Format results by row
while ($row = tep_db_fetch_array($sql_result)) {
  $id = $row['products_id'];

  // RSS Links for Ultimate SEO (Gareth Houston 10 May 2005)
  $link = tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $id, 'NONSSL', false);

  $model = $row['products_model'];
  $added = date(r,strtotime($row['products_date_added']));

  // Setting and cleaning the data
  $name = $row['products_name'];
  $desc = $row['products_description'];

  // Encoding to UTF-8
  $name = utf8_encode ($name);
  $desc = utf8_encode ($desc);
  $link = utf8_encode ($link);

  $manufacturer = $row['manufacturers_name'];
  $manufacturer = utf8_encode ($manufacturer);
  
  $cat_name = $row['categories_name'];

  // Encoding to UTF-8
  $cat_name = utf8_encode ($cat_name);

  // Writing the output
  echo '<item>' . "\n";
  echo '  <title>' . $name . '</title>' . "\n";
  echo '  <category>' . $cat_name . '</category>' . "\n";
  echo '  <link>' . $link . '</link>' . "\n";
  echo '  <description>'; // . "\n";
  echo $desc;
  echo '</description>' . "\n";
  echo '  <guid>' . $link . '</guid>' . "\n";
  echo '  <pubDate>' . $added . '</pubDate>' . "\n";
  if($ecommerce!='') {
    echo '  <ecommerce:SKU>' . $id . '</ecommerce:SKU>' . "\n";
    echo '  <ecommerce:manufacturer>' . $manufacturer . '</ecommerce:manufacturer>' . "\n";
  }
  echo '</item>' . "\n";
}
// Free resources and close connection
tep_db_free_result($sql_result);
tep_db_close();
?>
</channel>
</rss>
