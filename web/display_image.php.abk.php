<?php
//jsp:todo cache http://www.anyexample.com/programming/php/php_mysql_example__image_gallery_%28blob_storage%29.xml
//require('includes/application_top.php');
//require('includes/configure.php');
//  require('includes/application_top.php');
  include('includes/application_top.php');

  $_GET['image_name'] = preg_replace('/images\//','',$_GET['image_name']);
  

//stop
    // just so we know it is broken
    error_reporting(E_ALL);
    // some basic sanity checks
    if(isset($_GET['image_name'])) {
        //connect to the db
//stop        $link = mysql_connect("localhost", "username", "password") or die("Could not connect: " . mysql_error());
 
        // select our database
//stop        mysql_select_db("images_mysql") or die(mysql_error());
/* 
        // get the image from the db
        $image_stored_id_determine_query = tep_db_query("SELECT image_stored_id from . " . TABLE_PRODUCTS . " WHERE products_id = '" . (int)$_GET['products_id'] . "'");
            $image_stored_id_determine = tep_db_fetch_array($image_stored_id_determine_query);
            if (tep_not_null($image_stored_id_determine['image_stored_id'])) {
*/
        $sql = "SELECT image_data FROM images_stored WHERE image_name='" . $_GET['image_name'] . "'";
//} 
        // the result of the query
        $result = mysql_query("$sql") or die("Invalid query: " . mysql_error());
 
        // set the header for the image
        header("Content-type: image/jpeg");
        echo mysql_result($result, 0);
 
        // close the db link
        mysql_close($link);

    }
    else {
        echo 'id is not numeric or die unknow';
    }

?>