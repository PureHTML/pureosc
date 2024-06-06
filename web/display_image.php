<?php
//jsp:todo cache http://www.anyexample.com/programming/php/php_mysql_example__image_gallery_%28blob_storage%29.xml
  require('includes/application_top.php');
  $_GET['image_name'] = preg_replace('/images\//','',$_GET['image_name']);
  

//stop
    // just so we know it is broken
    error_reporting(E_ALL);
    // some basic sanity checks
    if(isset($_GET['image_name'])) {
        $sql = "SELECT image_data, image_filesize, ext FROM images_stored WHERE image_name='" . $_GET['image_name'] . "'";
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
      $expires = 60*60*24*365;
        header("Pragma: public");
        header("Cache-Control: maxage=".$expires);
        header('Expires: ' . gmdate('D, d M Y H:i:s', time()+$expires) . ' GMT');

//        header('Content-type: img/' . $result['ext']);
     header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
     header("Content-Transfer-Encoding: binary");
header('Accept-Ranges: bytes');
     header('Content-Length: ' . $result['image_filesize']);

        echo $result['image_data'];
    }
    else {
        echo 'id is not numeric or die unknow';
    }

?>