<?php
/*
  $Id: dynamic_sitemap.php,v 1.0 2005/06/29 
  written by Jack_mcs at www.osocmmerce-solution.com

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/
 require DIR_WS_FUNCTIONS . 'dynamic_sitemap.php';
 
 $path = bts_select(boxes_original);
 $pathFileName = DIR_WS_INCLUDES . 'filenames.php';
 $pathLanguage = DIR_WS_LANGUAGES . $language . '.php';
 $boxText = array();
 
 /********************* Find the infoboxes to add ***********************/
 if ($handle = opendir($path))
 {
	 if (!tep_session_is_registered('customer_id'))
	 		$excluded_query = tep_db_query('select exclude_file from '.TABLE_SITEMAP_EXCLUDE.' where exclude_type != "0" and is_box="1"');
	 else
	 		$excluded_query = tep_db_query('select exclude_file from '.TABLE_SITEMAP_EXCLUDE.' where exclude_type = "1" and is_box="1"');
	 $excluded_array = array();
	 if (tep_db_num_rows($excluded_query))
	  while($ex = tep_db_fetch_array($excluded_query))
   			$excluded_array[] = $ex['exclude_file'];

 
    $found = false;
    $ctr = 0;
    while (false !== ($file = readdir($handle))) 
    {     
       if (substr($file, -4, 4) !== ".php")
          continue;
       elseif (in_array($file ,$excluded_array))
          continue;

       $file = $path . '/' . $file; 
       $fp = file($file);
       
       for ($idx = 0; $idx < count($fp); ++$idx)
       {
         if ($posStart = strpos($fp[$idx], "BOX_HEADING") !== FALSE)
         {                 
             $parts = explode(" ", $fp[$idx]);
             for ($i = 0; $i < count($parts); ++$i)
             {
                if (strpos($parts[$i], "BOX_HEADING") === FALSE)
                  continue;
                $parts = explode(")", $parts[$i]);  //$parts has full box heading text
                $name = explode("_", $parts[0]);    //ignore the BOX_HEADING part
                for ($x = 3; $x < count($name); ++$x) //name may be more than one word
                {
                  if (tep_not_null($name[$x]))
                    $name[2] .= ' ' . $name[$x];
                }
                $name[2] = strtolower($name[2]);
                $name[2] = ucfirst($name[2]);
                $boxHeading[$ctr]['heading'][$ctr] = $name[2];
             }
         }  
         else if ($posStart = strpos($fp[$idx], "FILENAME") !== FALSE)
         {
           $str = str_replace("'<a href=\"' . tep_href_link(", "", $fp[$idx]);
           $str = str_replace("\$info_box_contents[] = array('text' => ", "", $str);
           
           $parts = explode(")", $str);
           $parts[0] = trim($parts[0]);
           
           $boxParts = explode(".", $parts[1]);
           $boxParts[2] = trim($boxParts[2]);      
           
           if (tep_not_null($boxParts[2]))
           {     
              $boxHeading[$ctr]['filename'][] = getFileName($pathFileName, $parts[0]);
              $boxHeading[$ctr]['boxtext'][] = getBoxText($pathLanguage, $boxParts[2]);
           }
           else
           { 
              if (tep_not_null($box_heading))
              {
                echo 'Invalid code for this module found in the following infobox: '.$boxHeading[$ctr]['heading'][$ctr].'<br />';
                array_pop($boxHeading);
                $ctr--;
              }
           }
         }               
       } 
       $ctr++;
    }
    closedir($handle); 
 } 
 
 /********************* Find the pages to add ***********************/
 $ctr = 0;
	($dir = opendir('.')) || die("Failed to open dir");
 $files = array();

 	 if (!tep_session_is_registered('customer_id'))
	 		$excluded_query = tep_db_query('select exclude_file from '.TABLE_SITEMAP_EXCLUDE.' where exclude_type != "0" and is_box="0"');
	 else
	 		$excluded_query = tep_db_query('select exclude_file from '.TABLE_SITEMAP_EXCLUDE.' where exclude_type = "1" and is_box="0"');
	 $excluded_array = array();
	 if (tep_db_num_rows($excluded_query))
	  while($ex = tep_db_fetch_array($excluded_query))
   			$excluded_array[] = $ex['exclude_file'];

 while(false !== ($file = readdir($dir))) 
 {
    if((! is_dir($file) && substr($file, -4, 4) === ".php") && !in_array($file ,$excluded_array))//only look at php files and skip that are excluded
    {
        $engFile = DIR_WS_LANGUAGES . $language . '/' . $file;
        if (file_exists($engFile) && IsViewable($file)) 
        {

           $fp = file($engFile);
  
           for ($idx = 0; $idx < count($fp); ++$idx)
           {
             if (strpos($fp[$idx], "define('HEADING_TITLE") !== FALSE)
             {
                $fp[$idx] = stripslashes($fp[$idx]);
                $p_start = strpos($fp[$idx], ",");
                $p_start = strpos($fp[$idx], "'", $p_start);
                $p_stop = strpos($fp[$idx], "'", $p_start + 2);
                $files['name'][] = str_replace('%s', '', ucfirst(substr($fp[$idx], $p_start + 1, $p_stop - $p_start - 1)));
                $files['path'][] = $file;
                break;
             }
           }  
        }  
    } 
 }
?>
