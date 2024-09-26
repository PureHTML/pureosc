#!/usr/bin/php
<?php
const DIR_WS_INCLUDES = 'includes/';
const DIR_WS_FUNCTIONS = 'includes/functions/';
//const DIR_FS_ADMIN = '';
//const DIR_FS_CATALOG = '../';

include('includes/configure.php');
/*
// include the list of project filenames
//require(DIR_WS_INCLUDES.'filenames.php');
  // autoload classes in the classes or modules directories
  require '../vendor/autoload.php';
  require DIR_FS_CATALOG . 'includes/functions/autoloader.php';
  require 'includes/functions/autoloader.php';
  spl_autoload_register('tep_autoload_admin');
  spl_autoload_register('tep_autoload_catalog');
*/
// include the database functions
require('includes/functions/database.php');
require('includes/functions/general.php');

// require(DIR_WS_CLASSES.'logger.php');

// make a connection to the database... now
tep_db_connect() or die('Unable to connect to database server!');

//$db = new Database() or die('Unable to connect to database server!');

// set application wide parameters
$configuration_query = tep_db_query('select configuration_key as cfgKey, configuration_value as cfgValue from configuration');
while ($configuration = tep_db_fetch_array($configuration_query)) {
    define($configuration['cfgKey'], $configuration['cfgValue']);
}

//--------------------------------------------------------------------------------------------------

$prods_query = tep_db_query("select DISTINCT categories.categories_id AS cid from categories, categories_description WHERE categories_name like '2024-06%' AND categories.categories_id=categories_description.categories_id;");

while($prods = tep_db_fetch_array($prods_query)) {
//echo $prods['cid'] . ';';
tep_db_query("UPDATE categories SET parent_id=2268 WHERE categories_id = ". $prods['cid']);
}
