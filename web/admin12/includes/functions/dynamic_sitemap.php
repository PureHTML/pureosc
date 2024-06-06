<?php
/*
  $Id: dynamic_sitemap.php,v 1.0 2005/06/29 
  written by Jack_mcs at www.osocmmerce-solution.com

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/
 
 function getFileName($file, $define)        //retrieve the defined filename
 { 
	 $fp = file($file);
   for ($idx = 0; $idx < count($fp); ++$idx)
   {
      if (strpos($fp[$idx], $define) !== FALSE)
      {
          $parts = explode("'", $fp[$idx]);   
          return $parts[3];     
      }
   }    
   return false;
 }
 function getBoxText($file, $define)          //retrieve the defined box name
 {
   $fp = file($file);
   for ($idx = 0; $idx < count($fp); ++$idx)
   {
      if (strpos($fp[$idx], "define") === FALSE)
        continue;
 
      if (strpos($fp[$idx], $define) !== FALSE)
      {
          $parts = explode("'", $fp[$idx]);
          return $parts[3];     
      }
   }
   return NULL;
 }
 function IsViewable($file)
 {
   $fp = file($file);
   for ($idx = 0; $idx < count($fp); ++$idx)
   {
      if (strpos($fp[$idx], "include (bts_select(") !== FALSE)
        return true;
   }  
   return false;
 }
 
?>