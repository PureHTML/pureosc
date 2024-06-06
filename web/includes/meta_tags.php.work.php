<?php
//pevna cast Title -> KW firma
$static_q = tep_db_query("SELECT information_description from information WHERE information_id = 14");
$static = tep_db_fetch_array($static_q);
$statictitle = substr(strip_tags($static['information_description']),0,256);



if ($current_category_id) {
$mcd_q = tep_db_query("SELECT categories_description, categories_heading_title, categories_name  from categories_description WHERE categories_id = $current_category_id");
$mcd = tep_db_fetch_array($mcd_q);

$metadescr = substr(strip_tags($mcd['categories_description']),0,255);

if ($mcd['categories_heading_title']) {
$metatitle = substr(strip_tags($mcd['categories_heading_title']),0,255);
    } else {
$metatitle = substr(strip_tags($mcd['categories_name']),0,255);
    }

}

if ($products_id) {

$mproducts_q = tep_db_query("SELECT products_name, products_description from products_description WHERE products_id = $products_id");
$mproducts = tep_db_fetch_array($mproducts_q);

$metadescr = substr(strip_tags($mproducts['products_description']),0,255);
$metatitle = substr(strip_tags($mproducts['products_name']),0,255);

}



//default values
if (!$metatitle) {
$title_q = tep_db_query("SELECT information_description from information WHERE information_id = 9");
$title = tep_db_fetch_array($title_q);
$metatitle = substr(strip_tags($title['information_description']),0,256);
}

if (!$metadescr) {
$metadescr_q = tep_db_query("SELECT information_description from information WHERE information_id = 8");
$metadescr = tep_db_fetch_array($metadescr_q);
$metadescr = substr(strip_tags($metadescr['information_description']),0,128);
}
if (!$metakeywords) {
$metakeywords_q = tep_db_query("SELECT information_description from information WHERE information_id = 10");
$metakeywords = tep_db_fetch_array($metakeywords_q);
$metakeywords = substr(strip_tags($metakeywords['information_description']),0,64);
}

echo '<title>' . $metatitle . ' | ' .  $statictitle . '</title>
<meta name="description" content="' . $metadescr .'" />
<meta name="keywords" content="' . $metakeywords . '" />';


?>