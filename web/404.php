<?php
/*
404.php
(c) shop2.0brain: based on
http://www.oscommerce.com/community/contributions,940
*/

  require("includes/application_top.php");
   // drop what they're looking for in an array 
  $pieces = explode('/', strtolower($REQUEST_URI)); 
  // no doubles
  $pieces = array_unique($pieces); 
//echo $pieces;
//exit;
  /*************************************************
    Depending on the structure your old site had you might want 
    to change the value of $i.  
    if we we're asked www.yoursite.com/oldshop/computer/monitor/bla.html   
    $pieces[0] will hold 'oldshop'   
    so $i should be 1.  
    The default code strips: 'p-', 'c-', '.html'
    
  **************************************************/ 
  $i = 1;  
  $keywords = ''; 
  $length =  count($pieces);
  while ($i < $length) { 
    // former shopping cart used p-MODEL.html
    $dummy = $pieces[$i];
    $patterns[0] = '/-/';
//    $patterns[1] = '/p-/';
//    $patterns[2] = '/c-/';
    // if you want to add more stuff to strip out, then copy the line above
    // and increment the array index. Also be sure to add a new replacement line
    $replacements[0] = ' ';
//    $replacements[1] = '';
//    $replacements[2] = '';
    // This line replaces all the instances of 'patterns' with 'replacements' in dummy.
    $pieces[$i] = preg_replace($patterns, $replacements, $dummy);
    if($i == ($length-1))
    {
      $keywords .= $pieces[$i]; 
    }
    else
    {
      $keywords .= $pieces[$i] . ' OR '; 
    }
    $i++; 
  }
header("Location: /advanced_search_result.php?keywords=$keywords&redirect404=1");
/*
  $search_in_description=1; // Search in the Product Descriptions, yes=1

  $error = 0; // reset error flag to false
  $errorno = 0;


  // Start Code from advanced_search_results.php
  if ($dfrom == DOB_FORMAT_STRING)
    $dfrom_to_check = "";
  else
    $dfrom_to_check = $dfrom;

  if ($dto == DOB_FORMAT_STRING)
    $dto_to_check = "";
  else
    $dto_to_check = $dto;

  if (strlen($dfrom_to_check) > 0) {
    if (!tep_checkdate($dfrom_to_check, DOB_FORMAT_STRING, $dfrom_array)) {
      $errorno += 10;
      $error = 1;
    }
  }  

  if (strlen($dto_to_check) > 0) {
    if (!tep_checkdate($dto_to_check, DOB_FORMAT_STRING, $dto_array)) {
      $errorno += 100;
      $error = 1;
    }
  }  

  if (strlen($dfrom_to_check) > 0 && !(($errorno & 10) == 10) &&
      strlen($dto_to_check) > 0 && !(($errorno & 100) == 100)) {
    if (mktime(0, 0, 0, $dfrom_array[1], $dfrom_array[2], $dfrom_array[0]) > mktime(0, 0, 0, $dto_array[1], $dto_array[2], $dto_array[0])) {
      $errorno += 1000;
      $error = 1;
    }
  }

  if (strlen($pfrom) > 0) {
    $pfrom_to_check = $pfrom;
    if (!settype($pfrom_to_check, "double")) {
      $errorno += 10000;
      $error = 1;
    }
  }

  if (strlen($pto) > 0) {
    $pto_to_check = $pto;
    if (!settype($pto_to_check, "double")) {
      $errorno += 100000;
      $error = 1;
    }
  }

  if (strlen($pfrom) > 0 && !(($errorno & 10000) == 10000) &&
      strlen($pto) > 0 && !(($errorno & 100000) == 100000)) {
    if ($pfrom_to_check > $pto_to_check) {
      $errorno += 1000000;
      $error = 1;
    }
  }

  if (strlen($keywords) > 0) {
    if (!tep_parse_search_string(stripslashes($keywords), $search_keywords)) {
      $errorno += 10000000;
      $error = 1;
    }
  }
  
  if ($error == 1) {
    tep_redirect(tep_href_link(FILENAME_ADVANCED_SEARCH, 'errorno=' . $errorno . '&' . tep_get_all_get_params(array('x', 'y')), 'NONSSL'));
  } else {

    $breadcrumb->add(NAVBAR_TITLE1, tep_href_link(FILENAME_ADVANCED_SEARCH, '', 'NONSSL'));
    $breadcrumb->add(NAVBAR_TITLE2, tep_href_link(FILENAME_ADVANCED_SEARCH_RESULT, 'keywords=' . $keywords . '&search_in_description=' . $search_in_description . '&categories_id=' . $categories_id . '&inc_subcat=' . $inc_subcat . '&manufacturers_id=' . $manufacturers_id . '&pfrom=' . $pfrom . '&pto=' . $pto . '&dfrom=' . $dfrom . '&dto=' . $dto));

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_404);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_404));

  $content = basename($_SERVER['PHP_SELF']);
  while (strstr($content, '.php')) $content = str_replace('.php', '', $content);

  $javascript = 'remove_label.js';
  include (bts_select('main', $content_template)); // BTSv1.5
}
  require(DIR_WS_INCLUDES . 'application_bottom.php');
*/
?>