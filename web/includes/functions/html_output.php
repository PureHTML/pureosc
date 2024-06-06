<?php
/*
  $Id: html_output.php,v 1.56 2003/07/09 01:15:48 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

////

////
// Ultimate SEO URLs v2.1
// The HTML href link wrapper function //shop2.0brain:new: (next line) conditions to NO rewrite some pages 
if ((SEO_ENABLED == 'true') && ($GLOBALS['REQUEST_URI']!='/login.php') && ($GLOBALS['REQUEST_URI']!='/address_book.php')) { //run chemo's code + NO rewrite conditions
//if (SEO_ENABLED == 'true' && $page!='/login.php') {
  function tep_href_link($page = '', $parameters = '', $connection = 'NONSSL', $add_session_id = true, $search_engine_safe = true) {
        global $seo_urls;
                if ( !is_object($seo_urls) ){
                        if ( !class_exists('SEO_URL') ){
                                include_once(DIR_WS_CLASSES . 'seo.class.php');                               
                        }
                        global $languages_id;
                        $seo_urls = new SEO_URL($languages_id);
                }
        return $seo_urls->href_link($page, $parameters, $connection, $add_session_id);
  }
} else { //run original code
// The HTML href link wrapper function
  function tep_href_link($page = '', $parameters = '', $connection = 'NONSSL', $add_session_id = true, $search_engine_safe = true) {
    global $request_type, $session_started, $SID;

    if (!tep_not_null($page)) {
      die('<br /><br /><span class="ColorSpanRed"><span class="b">Error!</span></span><br /><br /><span class="b">Unable to determine the page link!<br /><br />');
    }

    if ($connection == 'NONSSL') {
      $link = HTTP_SERVER . DIR_WS_HTTP_CATALOG;
    } elseif ($connection == 'SSL') {
      if (ENABLE_SSL == true) {
        $link = HTTPS_SERVER . DIR_WS_HTTPS_CATALOG;
      } else {
        $link = HTTP_SERVER . DIR_WS_HTTP_CATALOG;
      }
    } else {
      die('<br /><br /><span class="ColorSpanRed"><span class="b">Error!</span></span><br /><br /><span class="b">Unable to determine connection method on a link!<br /><br />Known methods: NONSSL SSL</span><br /><br />');
    }

    if (tep_not_null($parameters)) {
      $link .= $page . '?' . tep_output_string($parameters);
//      $separator = '&';
      $separator = '&amp;';
    } else {
      $link .= $page;
      $separator = '?';
    }

//    while ( (substr($link, -1) == '&') || (substr($link, -1) == '?') ) $link = substr($link, 0, -1);

    while (substr($link, -1) == '?') $link = substr($link, 0, -1);
    while (substr($link, -1, 5) == '&amp;') $link = substr($link, 0, -5);

// Add the session ID when moving from different HTTP and HTTPS servers, or when SID is defined
    if ( ($add_session_id == true) && ($session_started == true) && (SESSION_FORCE_COOKIE_USE == 'False') ) {
      if (tep_not_null($SID)) {
        $_sid = $SID;
      } elseif ( ( ($request_type == 'NONSSL') && ($connection == 'SSL') && (ENABLE_SSL == true) ) || ( ($request_type == 'SSL') && ($connection == 'NONSSL') ) ) {
        if (HTTP_COOKIE_DOMAIN != HTTPS_COOKIE_DOMAIN) {
          $_sid = tep_session_name() . '=' . tep_session_id();
        }
      }
    }

    if ( (SEARCH_ENGINE_FRIENDLY_URLS == 'true') && ($search_engine_safe == true) ) {
      // rimuove le pagine duplicate
      $link = ereg_replace('cPath=[0-9_]+&products_id','products_id',$link);
      $link = ereg_replace('cPath=[0-9_]+&amp;products_id','products_id',$link);
      $link = ereg_replace('manufacturers_id=[0-9]+&products_id','products_id',$link);
      $link = ereg_replace('manufacturers_id=[0-9]+&amp;products_id','products_id',$link);
      // fine filtro antiduplicazione ;)
/*
      $link = str_replace('&amp;', '/', $link);
      $link = str_replace('?', '/', $link);
      $link = str_replace('&', '/', $link);
      $link = str_replace('=', '/', $link);
*/
      $separator = '?';
    }

    if (isset($_sid)) {
      $link .= $separator . tep_output_string($_sid);
    }

    return $link;
  }
  }

// "On the Fly" Auto Thumbnailer using GD Library, servercaching and browsercaching
// Scales product images dynamically, resulting in smaller file sizes, and keeps
// proper image ratio. Used in conjunction with product_thumb.php t/n generator.

function tep_image($src, $alt = '', $width = '', $height = '', $params = '') {
$src = preg_replace('/images\//','',$src);
//alternativne
$src = preg_replace('/Image\//','',$src);

//$image = '<img src="display_image.php?image_name=' . $src . '" width="' . $width  .'" height="' . $height  . '">';
//$image = '<img src="display_image.php?image_name=' . $src . '" height="' . $height  .'">';
//$image = '<img src="' . $src . '" width="' .  $width  .'" height="' . $height  . '">';  //vyska i sirka
$image = '<img src="' . $src . '" width="' .  $width  .'">';  //sirka
return $image;
}

/*
function tep_image($src, $alt = '', $width = '', $height = '', $params = '') { 

  if (! is_file($src)) {
  $src = DIR_WS_IMG_TEMPLATES . "no_image.png";}
  if (! is_file($src)) {
  $src = DIR_WS_IMG_FALLBACK . "no_image.png";}
  
  // Set default image variable and code
  $image = '<img src="' . $src . '" class="img2ma" longdesc="read.html" ';
  
  // Don't calculate if the image is set to a "%" width
  if (strstr($width,'%') == false || strstr($height,'%') == false) { 
    $dont_calculate = 0; 
  } else {
    $dont_calculate = 1;    
  }

  // Dont calculate if a pixel image is being passed (hope you dont have pixels for sale)
  if (!strstr($image, 'pixel')) {
    $dont_calculate = 0;
  } else {
    $dont_calculate = 1;
  } 
  
  // Do we calculate the image size?
  if (CONFIG_CALCULATE_IMAGE_SIZE && !$dont_calculate) { 
    
    // Get the image's information
    if ($image_size = @getimagesize($src)) { 
      
      $ratio = $image_size[1] / $image_size[0];
      
      // Set the width and height to the proper ratio
      if (!$width && $height) { 
        $ratio = $height / $image_size[1]; 
        $width = intval($image_size[0] * $ratio); 
      } elseif ($width && !$height) { 
        $ratio = $width / $image_size[0]; 
        $height = intval($image_size[1] * $ratio); 
      } elseif (!$width && !$height) { 
        $width = $image_size[0]; 
        $height = $image_size[1]; 
      } 
      
      // Scale the image if not the original size
      if ($image_size[0] != $width || $image_size[1] != $height) { 
        $rx = $image_size[0] / $width; 
        $ry = $image_size[1] / $height; 
  
        if ($rx < $ry) { 
          $width = intval($height / $ratio); 
        } else { 
          $height = intval($width * $ratio); 
        } 
  
        $image = '<img class="img2ma" src="product_thumb.php?img='.$src.'&amp;w='.
        tep_output_string($width).'&amp;h='.tep_output_string($height).'" longdesc="read.html" ';
      }
      
    } elseif (IMAGE_REQUIRED == 'false') { 
      return ''; 
    } 
  }
  
  // Add remaining image parameters if they exist
  if ($width) { 
    $image .= ' width="' . tep_output_string($width) . '"'; 
  } 
  
  if ($height) { 
    $image .= ' height="' . tep_output_string($height) . '"'; 
  }     
  
  if (tep_not_null($params)) $image .= ' ' . $params;
  
  $image .= '  alt="' . tep_output_string($alt) . '"';
  
  if (tep_not_null($alt)) {
    $image .= ' title="' . tep_output_string($alt) . '"';
  }
  
  $image .= ' />';   
  
  return $image; 
}
*/
function tep_image_spec($src, $alt = '', $width = '', $height = '', $params = '')   { 

  if (! is_file($src)) {
  $src = DIR_WS_IMG_TEMPLATES . "no_image.png";}
  if (! is_file($src)) {
  $src = DIR_WS_IMG_FALLBACK . "no_image.png";}
  
  // Set default image variable and code
  $image = '<img src="' . $src . '" class="imgXcat" longdesc="read.html" ';
  
  // Don't calculate if the image is set to a "%" width
  if (strstr($width,'%') == false || strstr($height,'%') == false) { 
    $dont_calculate = 0; 
  } else {
    $dont_calculate = 1;    
  }

  // Dont calculate if a pixel image is being passed (hope you dont have pixels for sale)
  if (!strstr($image, 'pixel')) {
    $dont_calculate = 0;
  } else {
    $dont_calculate = 1;
  } 
  
  // Do we calculate the image size?
  if (CONFIG_CALCULATE_IMAGE_SIZE && !$dont_calculate) { 
    
    // Get the image's information
    if ($image_size = @getimagesize($src)) { 
      
      $ratio = $image_size[1] / $image_size[0];
      
      // Set the width and height to the proper ratio
      if (!$width && $height) { 
        $ratio = $height / $image_size[1]; 
        $width = intval($image_size[0] * $ratio); 
      } elseif ($width && !$height) { 
        $ratio = $width / $image_size[0]; 
        $height = intval($image_size[1] * $ratio); 
      } elseif (!$width && !$height) { 
        $width = $image_size[0]; 
        $height = $image_size[1]; 
      } 
      
      // Scale the image if not the original size
      if ($image_size[0] != $width || $image_size[1] != $height) { 
        $rx = $image_size[0] / $width; 
        $ry = $image_size[1] / $height; 
  
        if ($rx < $ry) { 
          $width = intval($height / $ratio); 
        } else { 
          $height = intval($width * $ratio); 
        } 
  
        $image = '<img class="imgXcat" src="product_thumb.php?img='.$src.'&amp;w='.
        tep_output_string($width).'&amp;h='.tep_output_string($height).'" longdesc="read.html" ';
      }
      
    } elseif (IMAGE_REQUIRED == 'false') { 
      return ''; 
    } 
  }
  
  // Add remaining image parameters if they exist
  if ($width) { 
    $image .= ' width="' . tep_output_string($width) . '"'; 
  } 
  
  if ($height) { 
    $image .= ' height="' . tep_output_string($height) . '"'; 
  }     
  
  if (tep_not_null($params)) $image .= ' ' . $params;
  
  $image .= '  alt="' . tep_output_string($alt) . '"';
  
  if (tep_not_null($alt)) {
    $image .= ' title="' . tep_output_string($alt) . '"';
  }
  
  $image .= ' />';   
  
  return $image; 
}

////
// The HTML image wrapper function for accesibility template
  function tep_image_2ma($src, $alt = '', $width = '', $height = '', $parameters = '') {
    if ( (empty($src) || ($src == DIR_WS_IMAGES)) && (IMAGE_REQUIRED == 'false') ) {
      return false; }
    $image = '<img class="img2ma" src="' . tep_output_string($src) . '" alt="" />';
    return $image; }

////
// The HTML image wrapper function for image php4 template categories
  function tep_image_2ma_template ($src, $alt = '', $width = '', $height = '', $parameters = '') {
    if ( (empty($src) || ($src == DIR_WS_IMAGES)) && (IMAGE_REQUIRED == 'false') ) {
      return false; }
    $image = '<img class="img2ma" src="' . tep_output_string($src) . '" alt="' . tep_output_string($alt) . ' " longdesc="read.html" title=" ' . tep_output_string($alt) . ' " />';
    return $image; }
// The HTML image wrapper function for image php4 template categories
  function tep_image_2cat_template ($src, $alt = '', $width = '', $height = '', $parameters = '') {
    if ( (empty($src) || ($src == DIR_WS_IMAGES)) && (IMAGE_REQUIRED == 'false') ) {
      return false; }
    $image = '<img class="img2cat" src="' . tep_output_string($src) . '" alt="' . tep_output_string($alt) . ' " longdesc="read.html" title=" ' . tep_output_string($alt) . ' " />';
    return $image; }
  
/*
////
// The HTML image wrapper function
  function tep_image($src, $alt = '', $width = '', $height = '', $parameters = '') {
    if ( (empty($src) || ($src == DIR_WS_IMAGES)) && (IMAGE_REQUIRED == 'false') ) {
      return false;
    }

// alt is added to the img tag even if it is null to prevent browsers from outputting
// the image filename as default
    $image = '<img src="' . tep_output_string($src) . '" 
                    
                   alt="' . tep_output_string($alt) . ' "
                   longdesc="read.html"';

    if (tep_not_null($alt)) {
      $image .= ' title=" ' . tep_output_string($alt) . ' "';
    }

    if ( (CONFIG_CALCULATE_IMAGE_SIZE == 'true') && (empty($width) || empty($height)) ) {
      if ($image_size = @getimagesize($src)) {
        if (empty($width) && tep_not_null($height)) {
          $ratio = $height / $image_size[1];
          $width = $image_size[0] * $ratio;
        } elseif (tep_not_null($width) && empty($height)) {
          $ratio = $width / $image_size[0];
          $height = $image_size[1] * $ratio;
        } elseif (empty($width) && empty($height)) {
          $width = $image_size[0];
          $height = $image_size[1];
        }
      } elseif (IMAGE_REQUIRED == 'false') {
        return false;
      }
    }

    if (tep_not_null($width) && tep_not_null($height)) {
      $image .= ' width="' . tep_output_string($width) . '" height="' . tep_output_string($height) . '"';
    }

    if (tep_not_null($parameters)) $image .= ' ' . $parameters;

    $image .= ' />';

    return $image;
  }
*/ 
// END "On the Fly"

////
// The HTML form submit button wrapper function
// Outputs a button in the selected language
  function tep_image_submit($image, $alt = '', $parameters = '') {
    global $language;
    // for use button wai
    if ( BUTTON_WAI == 'false' ) { 
    $image_submit = '<input class="img2ma" value="image" type="image" src="';
// modified for BTS m
if ( is_file( DIR_WS_TEMPLATES . 'images/' . $language . '/images/buttons/' . $image)) {
  $image_submit .= ( DIR_WS_TEMPLATES . 'images/' . $language . '/images/buttons/' . $image);
} else {
  $image_submit .= ( 'templates/fallback/' . 'images/' . $language . '/images/buttons/' . $image);
} 
//    $image_submit .= tep_output_string(DIR_WS_LANGUAGES . $language . '/images/buttons/' . $image);
    $image_submit .= '" alt="' . tep_output_string($alt) . '"';
    if (tep_not_null($alt)) $image_submit .= ' title=" ' . tep_output_string($alt) . ' "';

    if (tep_not_null($parameters)) $image_submit .= ' ' . $parameters;
    $image_submit .= ' />';
    } else  {
    $image_submit = '<input class="cssbutton" type="submit" value="' .$alt . '" alt="' . tep_output_string($alt) . '" />';
    }
    return $image_submit;
  }

////
// Output a function button in the selected language
  function tep_image_button($image, $alt = '', $parameters = '') {
    global $language;
    // for use button wai
    if ( BUTTON_WAI == 'false' ) { 
// modified for BTS m
if ( is_file( DIR_WS_BOX_TEMPLATES . 'images/' . $language . '/images/buttons/' . $image)) {
  return tep_image ( DIR_WS_BOX_TEMPLATES . 'images/' . $language . '/images/buttons/' . $image, $alt, '', '', $parameters);
} else {
  return tep_image ( 'templates/fallback/' . 'images/' . $language . '/images/buttons/' . $image, $alt, '', '', $parameters);
} 
//      return tep_image(DIR_WS_LANGUAGES . $language . '/images/buttons/' . $image, $alt, '', '', $parameters);
    } else  {
      $image = '<span class="cssbutton">&nbsp;' . $alt . '&nbsp;</span>';
      return $image;
    }
  }
//totez ale s velkym buttonem
    function tep_image_button_tlusty($image, $alt = '', $parameters = '') {
    global $language;
    // for use button wai
    if ( BUTTON_WAI == 'false' ) { 
// modified for BTS m
if ( is_file( DIR_WS_BOX_TEMPLATES . 'images/' . $language . '/images/buttons/' . $image)) {
  return tep_image ( DIR_WS_BOX_TEMPLATES . 'images/' . $language . '/images/buttons/' . $image, $alt, '', '', $parameters);
} else {
  return tep_image ( 'templates/fallback/' . 'images/' . $language . '/images/buttons/' . $image, $alt, '', '', $parameters);
} 
//      return tep_image(DIR_WS_LANGUAGES . $language . '/images/buttons/' . $image, $alt, '', '', $parameters);
    } else  {
      $image = '<span class="ramTlusty">&nbsp;' . $alt . '&nbsp;</span>';
      return $image;
    }
  }
  
////
// Output a separator either through whitespace, or with an image
  function tep_draw_separator($image = 'pixel_black.png', $width = '100%', $height = '1') {
    return '<hr />'; //tep_image(DIR_WS_IMAGES . $image, 'void', $width, $height);
  }

////
// Output a form
  function tep_draw_form($name, $action, $method = 'post', $parameters = '') {
    $form = '<form name="' . tep_output_string($name) . '" action="' . tep_output_string($action) . '" method="' . tep_output_string($method) . '"';

    if (tep_not_null($parameters)) $form .= ' ' . $parameters;

    $form .= '>';

    return $form;
  }

////
// Output a form input field
  function tep_draw_input_field($name, $value = '', $parameters = '', $type = 'text', $reinsert_value = true) {
    global $_GET, $_POST;

    $field = '<input class="input2ma" alt="' . tep_output_string($name) . '" type="' . tep_output_string($type) . '" name="' . tep_output_string($name) . '" ';

    if ( ($reinsert_value == true) && ( (isset($_GET[$name]) && is_string($_GET[$name])) || (isset($_POST[$name]) && is_string($_POST[$name])) ) ) {
      if (isset($_GET[$name]) && is_string($_GET[$name])) {
        $value = stripslashes($_GET[$name]);
      } elseif (isset($_POST[$name]) && is_string($_POST[$name])) {
        $value = stripslashes($_POST[$name]);
      }
    }

    if (tep_not_null($value)) {
      $field .= ' value="' . tep_output_string($value) . '"';
    }

    if (tep_not_null($parameters)) $field .= ' ' . $parameters;

    $field .= ' />';

    return $field;
  }

////
// Output a form input field
  function tep_draw_input_field_label($label, $text_label_value, $name, $value = '', $parameters = '', $type = 'text', $reinsert_value = true) {
    global $_GET, $_POST;

    $field = '<div class="labelwidth"><label for="' . tep_output_string($name) . '">' . tep_output_string($label) . 
             '</label></div> <input class="input2ma" alt="' . tep_output_string($name) . '" type="' . tep_output_string($type) . '" name="' . tep_output_string($name) . '" id="' . tep_output_string($name) . '" ';

    if ( ($reinsert_value == true) && ( (isset($_GET[$name]) && is_string($_GET[$name])) || (isset($_POST[$name]) && is_string($_POST[$name])) ) ) {
      if (isset($_GET[$name]) && is_string($_GET[$name])) {
        $value = stripslashes($_GET[$name]);
      } elseif (isset($_POST[$name]) && is_string($_POST[$name])) {
        $value = stripslashes($_POST[$name]);
      }
    $wai_label_status = 'off';
    } else  {
    $wai_label_status = 'on';
    }

    if ((tep_not_null($value)) && (tep_output_string($text_label_value) == true ) && (WAI_INPUT_TEXT == 'true') && ($wai_label_status == 'on')) {
      $field .= ' value="' . TEXT_LABEL_INPUT . tep_output_string($value) . '" onfocus="RemoveFormatString(this, \'' . TEXT_LABEL_INPUT . tep_output_string($value) . '\')"';
    }

    if ((tep_not_null($value)) && ((tep_output_string($text_label_value) == false ) || ($wai_label_status == 'off'))) {
      $field .= ' value="' . tep_output_string($value) . '"';
    }

    if (tep_not_null($parameters)) $field .= ' ' . $parameters;

    $field .= ' />';

    return $field;
  }

////
// Output a form password field
  function tep_draw_password_field($name, $value = '', $parameters = 'maxlength="40"') {
    return tep_draw_input_field($name, $value, $parameters, 'password', false);
  }

// Output a form password field label
  function tep_draw_password_field_label($label, $text_label_value, $name, $value = '', $parameters = 'maxlength="40"') {
    return tep_draw_input_field_label($label, $text_label_value, $name, $value, $parameters, 'password', false);
  }

////
// Output a selection field - alias function for tep_draw_checkbox_field() and tep_draw_radio_field()
  function tep_draw_selection_field($name, $type, $value = '', $checked = false, $parameters = '') {
    global $_GET, $_POST;

    $selection = '<input class="input2ma" type="' . tep_output_string($type) . '" name="' . tep_output_string($name) . '"';

    if (tep_not_null($value)) $selection .= ' value="' . tep_output_string($value) . '"';

    if ( ($checked == true) || (isset($_GET[$name]) && is_string($_GET[$name]) && (($_GET[$name] == 'on') || (stripslashes($_GET[$name]) == $value))) || (isset($_POST[$name]) && is_string($_POST[$name]) && (($_POST[$name] == 'on') || (stripslashes($_POST[$name]) == $value))) ) {
      $selection .= ' checked="checked" ';
    }

    if (tep_not_null($parameters)) $selection .= ' ' . $parameters;

    $selection .= ' />';

    return $selection;
  }

////
// Output a form checkbox field
  function tep_draw_checkbox_field($name, $value = '', $checked = false, $parameters = '') {
    return tep_draw_selection_field($name, 'checkbox', $value, $checked, $parameters);
  }

////
// Output a form radio field
  function tep_draw_radio_field($name, $value = '', $checked = false, $parameters = '') {
    return tep_draw_selection_field($name, 'radio', $value, $checked, $parameters);
  }

////
// Output a selection field - alias function for tep_draw_checkbox_field() and tep_draw_radio_field()
  function tep_draw_selection_field_label($label, $id_name, $name, $type, $value = '', $checked = false, $parameters = '') {
    global $_GET, $_POST;

    $selection = '<label for="' . tep_output_string($id_name) . '">' . $label . '<input class="input2ma" type="' . tep_output_string($type) . '" name="' . tep_output_string($name) . '" id="' . tep_output_string($id_name) . '"';

    if (tep_not_null($value)) $selection .= ' value="' . tep_output_string($value) . '"';

    if ( ($checked == true) || (isset($_GET[$name]) && is_string($_GET[$name]) && (($_GET[$name] == 'on') || (stripslashes($_GET[$name]) == $value))) || (isset($_POST[$name]) && is_string($_POST[$name]) && (($_POST[$name] == 'on') || (stripslashes($_POST[$name]) == $value))) ) {
      $selection .= ' checked="checked" ';
    }

    if (tep_not_null($parameters)) $selection .= ' ' . $parameters;

    $selection .= ' /> </label>';

    return $selection;
  }

////
// Output a form checkbox field label
  function tep_draw_checkbox_field_label($label, $id_name, $name, $value = '', $checked = false, $parameters = '') {
    return tep_draw_selection_field_label($label, $id_name, $name, 'checkbox', $value, $checked, $parameters);
  }

////
// Output a form radio field label
  function tep_draw_radio_field_label($label, $id_name, $name, $value = '', $checked = false, $parameters = '') {
    return tep_draw_selection_field_label($label, $id_name, $name, 'radio', $value, $checked, $parameters);
  }

////
// Output a form textarea field
  function tep_draw_textarea_field($name, $width, $height, $text = '', $parameters = '', $reinsert_value = true) {
    global $_GET, $_POST;

    $field = '<textarea  class="input2ma" name="' . tep_output_string($name) . '" cols="' . tep_output_string($width) . '" rows="' . tep_output_string($height) . '"';

    if (tep_not_null($parameters)) $field .= ' ' . $parameters;

    $field .= '>';

    if ( ($reinsert_value == true) && ( (isset($_GET[$name]) && is_string($_GET[$name])) || (isset($_POST[$name]) && is_string($_POST[$name])) ) ) {
      if (isset($_GET[$name]) && is_string($_GET[$name])) {
        $field .= tep_output_string_protected(stripslashes($_GET[$name]));
      } elseif (isset($_POST[$name]) && is_string($_POST[$name])) {
        $field .= tep_output_string_protected(stripslashes($_POST[$name]));
      }
    } elseif (tep_not_null($text)) {
      $field .= tep_output_string_protected($text);
    }

    $field .= '</textarea>';

    return $field;
  }

////
// Output a form hidden field
  function tep_draw_hidden_field($name, $value = '', $parameters = '') {
    global $_GET, $_POST;

    $field = '<input class="input2ma" type="hidden" name="' . tep_output_string($name) . '"';

    if (tep_not_null($value)) {
      $field .= ' value="' . tep_output_string($value) . '"';
    } elseif ( (isset($_GET[$name]) && is_string($_GET[$name])) || (isset($_POST[$name]) && is_string($_POST[$name])) ) {
      if ( (isset($_GET[$name]) && is_string($_GET[$name])) ) {
        $field .= ' value="' . tep_output_string(stripslashes($_GET[$name])) . '"';
      } elseif ( (isset($_POST[$name]) && is_string($_POST[$name])) ) {
        $field .= ' value="' . tep_output_string(stripslashes($_POST[$name])) . '"';
      }
    }

    if (tep_not_null($parameters)) $field .= ' ' . $parameters;

    $field .= ' />';

    return $field;
  }

////
// Hide form elements
  function tep_hide_session_id() {
    global $session_started, $SID;

    if (($session_started == true) && tep_not_null($SID)) {
      return tep_draw_hidden_field(tep_session_name(), tep_session_id());
    }
  }

////
// Output a form pull down menu
  function tep_draw_pull_down_menu($name, $values, $default = '', $parameters = '', $required = false) {
    global $_GET, $_POST;

    $field = '<select name="' . tep_output_string($name) . '"';

    if (tep_not_null($parameters)) $field .= ' ' . $parameters;

    $field .= '>';

    if (empty($default) && ( (isset($_GET[$name]) && is_string($_GET[$name])) || (isset($_POST[$name]) && is_string($_POST[$name])) ) ) {
      if (isset($_GET[$name]) && is_string($_GET[$name])) {
        $default = stripslashes($_GET[$name]);
      } elseif (isset($_POST[$name]) && is_string($_POST[$name])) {
        $default = stripslashes($_POST[$name]);
      }
    }

    for ($i=0, $n=sizeof($values); $i<$n; $i++) {
      $field .= '<option value="' . tep_output_string($values[$i]['id']) . '"';
      if ($default == $values[$i]['id']) {
        $field .= ' selected="selected"';
      }

      $field .= '>' . tep_output_string($values[$i]['text'], array('"' => '&quot;', '\'' => '&#039;', '<' => '&lt;', '>' => '&gt;')) . '</option>';
    }
    $field .= '</select>';

    if ($required == true) $field .= TEXT_FIELD_REQUIRED;

    return $field;
  }

////
// Output a form pull down menu label
  function tep_draw_pull_down_menu_label($label, $id_name, $name, $values, $default = '', $parameters = '', $required = false) {
    global $_GET, $_POST;

    $field = '<label for="' . $id_name . '"> ' . $label . ' <select name="' . tep_output_string($name) . '"';

    if (tep_not_null($parameters)) $field .= ' ' . $parameters;

    $field .= ' id="' . $id_name . '" >';

    if (empty($default) && ( (isset($_GET[$name]) && is_string($_GET[$name])) || (isset($_POST[$name]) && is_string($_POST[$name])) ) ) {
      if (isset($_GET[$name]) && is_string($_GET[$name])) {
        $default = stripslashes($_GET[$name]);
      } elseif (isset($_POST[$name]) && is_string($_POST[$name])) {
        $default = stripslashes($_POST[$name]);
      }
    }

    for ($i=0, $n=sizeof($values); $i<$n; $i++) {
      $field .= '<option value="' . tep_output_string($values[$i]['id']) . '"';
      if ($default == $values[$i]['id']) {
        $field .= ' selected="selected"';
      }

      $field .= '>' . tep_output_string($values[$i]['text'], array('"' => '&quot;', '\'' => '&#039;', '<' => '&lt;', '>' => '&gt;')) . '</option>';
    }
    $field .= '</select></label>';

    if ($required == true) $field .= TEXT_FIELD_REQUIRED;

    return $field;
  }

////
// Creates a pull-down list of countries
  function tep_get_country_list($name, $selected = '', $parameters = '') {
    $countries_array = array(array('id' => '', 'text' => PULL_DOWN_DEFAULT));
    $countries = tep_get_countries();

    for ($i=0, $n=sizeof($countries); $i<$n; $i++) {
      $countries_array[] = array('id' => $countries[$i]['countries_id'], 'text' => $countries[$i]['countries_name']);
    }
    
    if(!$selected)
        $selected=56;    //shop2.0brain: new: predvoleno Czech Republic //todo: dat do konfigurace nacist z default language

    return tep_draw_pull_down_menu($name, $countries_array, $selected, $parameters);
  }
//jsp:ms-word autoclean
  function msword_autoclean($inputtext) {
$searchReplaceArray = array(
  'href="#' => 'class="fnhref" href="'.$_SERVER['REQUEST_URI'].'#', 
  '<sup>' => '',
  '</sup>' => '',
  '<span>' => '',
  '</span>' => ''
);
$result = str_replace(
  array_keys($searchReplaceArray), 
  array_values($searchReplaceArray), 
  $inputtext
);
return $result;
}


?>
