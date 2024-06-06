<?php
//jsp:todo cache http://www.anyexample.com/programming/php/php_mysql_example__image_gallery_%28blob_storage%29.xml
  require('includes/application_top.php');
  $_GET['file_name'] = preg_replace('/file\//','',$_GET['file_name']);
//    error_reporting(0);
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 'On');

    // some basic sanity checks
    if(isset($_GET['file_name'])) {
        $sql = "SELECT file_data, file_filesize, ext FROM files_stored WHERE file_name='" . $_GET['file_name'] . "'";
        // the result of the query
        $result = mysql_query("$sql") or die("Invalid query: " . mysql_error());
        $result = tep_db_fetch_array($result);

$ext =  $result['ext'];
      switch ($ext) {
      case "pdf": $ctype="application/pdf"; break;
      case "exe": $ctype="application/octet-stream"; break;
      case "zip": $ctype="application/zip"; break;
      case "doc": $ctype="application/msword"; break;
      case "xls": $ctype="application/vnd.ms-excel"; break;
      case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
      case "gif": $ctype="image/gif"; break;
      case "png": $ctype="image/png"; break;
      case "jpeg":
      case "jpg": $ctype="image/jpeg"; break;
      default: $ctype="image/jpeg";
      }
        header('Content-Type: ' . $ctype);

        // set the header for the file
        // seconds, minutes, hours, days
        $expires = 60*60*24*14;
        header("Pragma: public");
        header("Cache-Control: maxage=".$expires);
        header('Expires: ' . gmdate('D, d M Y H:i:s', time()+$expires) . ' GMT');
     header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
     header('Content-Length: ' . $result['file_filesize']);

        echo $result['file_data'];
        //echo mysql_result($result, 0);
    }
    else {
        echo 'error';
    }

?>