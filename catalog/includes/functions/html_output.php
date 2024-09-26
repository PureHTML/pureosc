<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2020 osCommerce

  Released under the GNU General Public License
*/


  /**
  * ULTIMATE Seo Urls 5 PRO by FWR Media
  * Replacement for osCommerce href link wrapper function
  */
  require_once DIR_WS_MODULES . 'ultimate_seo_urls5/main/usu5.php';
  
  function tep_href_link( $page = '', $parameters = '', $connection = 'NONSSL', $add_session_id = true, $search_engine_safe = true ) {
    return Usu_Main::i()->hrefLink( $page, $parameters, $connection, $add_session_id, $search_engine_safe );
  }
  
// The HTML image wrapper function
function tep_image($src, $alt = '', $width = '', $height = '', $parameters = '') {
  if ((empty($src) || ($src == DIR_WS_IMAGES)) && (IMAGE_REQUIRED == 'false')) {
    return false;
  }

  if (!is_file($src)) {
    $src = 'images/no_picture.gif';
  }
  // alt is added to the img tag even if it is null to prevent browsers from outputting
  // the image filename as default
  $image = '<img src="' . tep_output_string($src) . '" alt="' . tep_output_string($alt) . '"';

  if (!empty($alt)) {
    $image .= ' title="' . tep_output_string($alt) . '"';
  }

  if ((CONFIG_CALCULATE_IMAGE_SIZE == 'true') && (empty($width) || empty($height))) {
    if ($image_size = @getimagesize($src)) {
      if (empty($width) && !empty($height)) {
        $ratio = $height / $image_size[1];
        $width = intval($image_size[0] * $ratio);
      } elseif (!empty($width) && empty($height)) {
        $ratio = $width / $image_size[0];
        $height = intval($image_size[1] * $ratio);
      } elseif (empty($width) && empty($height)) {
        $width = $image_size[0];
        $height = $image_size[1];
      }
    } elseif (IMAGE_REQUIRED == 'false') {
      return false;
    }
  }

  if (!empty($width) && !empty($height)) {
    $image .= ' width="' . tep_output_string($width) . '" height="' . tep_output_string($height) . '"';
  }

  if (!empty($parameters)) {
    $image .= ' ' . $parameters;
  }

  $image .= ' loading="lazy">';

  return $image;
}

// The HTML form submit button wrapper function
// Outputs a button in the selected language
function tep_image_submit($image, $alt = '', $parameters = '') {
  global $language;

  $image_submit = '<input type="image" src="' . tep_output_string('includes/languages/' . $language . '/images/buttons/' . $image) . '" alt="' . tep_output_string($alt) . '"';

  if (!empty($alt)) {
    $image_submit .= ' title=" ' . tep_output_string($alt) . ' "';
  }

  if (!empty($parameters)) {
    $image_submit .= ' ' . $parameters;
  }

  $image_submit .= '>';

  return $image_submit;
}

// Output a function button in the selected language
function tep_image_button($image, $alt = '', $parameters = '') {
  global $language;

  return tep_image('includes/languages/' . $language . '/images/buttons/' . $image, $alt, '', '', $parameters);
}

// Output a separator either through whitespace, or with an image
function tep_draw_separator($image = 'pixel_black.gif', $width = '100%', $height = '1') {
  return tep_image('images/' . $image, '', $width, $height);
}

// Output a form
function tep_draw_form($name, $action, $method = 'post', $parameters = '', $tokenize = false) {
  global $sessiontoken;

  $form = '<form name="' . tep_output_string($name) . '" action="' . tep_output_string($action) . '" method="' . tep_output_string($method) . '"';

  if (!empty($parameters)) {
    $form .= ' ' . $parameters;
  }

  $form .= '>';

  if (($tokenize == true) && isset($sessiontoken)) {
    $form .= '<input type="hidden" name="formid" value="' . tep_output_string($sessiontoken) . '">';
  }

  return $form;
}

// Output a form input field
function tep_draw_input_field($name, $value = '', $parameters = '', $type = 'text', $reinsert_value = true) {
  $field = '<input type="' . tep_output_string($type) . '" name="' . tep_output_string($name) . '"';

  if (($reinsert_value == true) && ((isset($_GET[$name]) && is_string($_GET[$name])) || (isset($_POST[$name]) && is_string($_POST[$name])))) {
    if (isset($_GET[$name]) && is_string($_GET[$name])) {
      $value = stripslashes($_GET[$name]);
    } elseif (isset($_POST[$name]) && is_string($_POST[$name])) {
      $value = stripslashes($_POST[$name]);
    }
  }

  if (!empty($value)) {
    $field .= ' value="' . tep_output_string($value) . '"';
  }

  if (!empty($parameters)) {
    $field .= ' ' . $parameters;
  }

  $field .= '>';

  return $field;
}

// Output a form password field
function tep_draw_password_field($name, $value = '', $parameters = 'maxlength="40"') {
  return tep_draw_input_field($name, $value, $parameters, 'password', false);
}

// Output a selection field - alias function for tep_draw_checkbox_field() and tep_draw_radio_field()
function tep_draw_selection_field($name, $type, $value = '', $checked = false, $parameters = '') {
  $selection = '<input type="' . tep_output_string($type) . '" name="' . tep_output_string($name) . '"';

  if (!empty($value)) {
    $selection .= ' value="' . tep_output_string($value) . '"';
  }

  if (($checked == true) || (isset($_GET[$name]) && is_string($_GET[$name]) && (($_GET[$name] == 'on') || (stripslashes($_GET[$name]) == $value))) || (isset($_POST[$name]) && is_string($_POST[$name]) && (($_POST[$name] == 'on') || (stripslashes($_POST[$name]) == $value)))) {
    $selection .= ' checked="checked"';
  }

  if (!empty($parameters)) {
    $selection .= ' ' . $parameters;
  }

  $selection .= '>';

  return $selection;
}

// Output a form checkbox field
function tep_draw_checkbox_field($name, $value = '', $checked = false, $parameters = '') {
  return tep_draw_selection_field($name, 'checkbox', $value, $checked, $parameters);
}

// Output a form radio field
function tep_draw_radio_field($name, $value = '', $checked = false, $parameters = '') {
  return tep_draw_selection_field($name, 'radio', $value, $checked, $parameters);
}

// Output a form textarea field
// The $wrap parameter is no longer used in the core xhtml template
function tep_draw_textarea_field($name, $text = '', $parameters = '', $reinsert_value = true) {
  $field = '<textarea name="' . tep_output_string($name) . '"';

  if (!empty($parameters)) {
    $field .= ' ' . $parameters;
  }

  $field .= '>';

  if (($reinsert_value == true) && ((isset($_GET[$name]) && is_string($_GET[$name])) || (isset($_POST[$name]) && is_string($_POST[$name])))) {
    if (isset($_GET[$name]) && is_string($_GET[$name])) {
      $field .= tep_output_string_protected(stripslashes($_GET[$name]));
    } elseif (isset($_POST[$name]) && is_string($_POST[$name])) {
      $field .= tep_output_string_protected(stripslashes($_POST[$name]));
    }
  } elseif (!empty($text)) {
    $field .= tep_output_string_protected($text);
  }

  $field .= '</textarea>';

  return $field;
}

// Output a form hidden field
function tep_draw_hidden_field($name, $value = '', $parameters = '') {
  $field = '<input type="hidden" name="' . tep_output_string($name) . '"';

  if (!empty($value)) {
    $field .= ' value="' . tep_output_string($value) . '"';
  } elseif ((isset($_GET[$name]) && is_string($_GET[$name])) || (isset($_POST[$name]) && is_string($_POST[$name]))) {
    if ((isset($_GET[$name]) && is_string($_GET[$name]))) {
      $field .= ' value="' . tep_output_string(stripslashes($_GET[$name])) . '"';
    } elseif ((isset($_POST[$name]) && is_string($_POST[$name]))) {
      $field .= ' value="' . tep_output_string(stripslashes($_POST[$name])) . '"';
    }
  }

  if (!empty($parameters)) {
    $field .= ' ' . $parameters;
  }

  $field .= '>';

  return $field;
}

// Hide form elements
function tep_hide_session_id() {
  global $session_started, $SID;

  $field = '';

  if (($session_started == true) && !empty($SID) && (SESSION_FORCE_COOKIE_USE == 'False')) {
    $field = tep_draw_hidden_field(tep_session_name(), tep_session_id());
  }

  return $field;
}

// Output a form pull down menu
function tep_draw_pull_down_menu($name, $values, $default = '', $parameters = '', $required = false) {
  $field = '<select name="' . tep_output_string($name) . '"';

  if (!empty($parameters)) {
    $field .= ' ' . $parameters;
  }

  $field .= '>';

  if (empty($default) && ((isset($_GET[$name]) && is_string($_GET[$name])) || (isset($_POST[$name]) && is_string($_POST[$name])))) {
    if (isset($_GET[$name]) && is_string($_GET[$name])) {
      $default = stripslashes($_GET[$name]);
    } elseif (isset($_POST[$name]) && is_string($_POST[$name])) {
      $default = stripslashes($_POST[$name]);
    }
  }

  for ($i = 0, $n = sizeof($values); $i < $n; $i++) {
    $field .= '<option value="' . tep_output_string($values[$i]['id']) . '"';
    if ($default == $values[$i]['id']) {
      $field .= ' selected="selected"';
    }

    $field .= '>' . tep_output_string($values[$i]['text'], array('"' => '&quot;', '\'' => '&#039;', '<' => '&lt;', '>' => '&gt;')) . '</option>';
  }
  $field .= '</select>';

  if ($required == true) {
    $field .= TEXT_FIELD_REQUIRED;
  }

  return $field;
}

// Creates a pull-down list of countries
function tep_get_country_list($name, $selected = '', $parameters = '') {
  $countries_array = array(array('id' => '', 'text' => PULL_DOWN_DEFAULT));
  $countries = tep_get_countries();

  for ($i = 0, $n = sizeof($countries); $i < $n; $i++) {
    $countries_array[] = array('id' => $countries[$i]['countries_id'], 'text' => $countries[$i]['countries_name']);
  }

  return tep_draw_pull_down_menu($name, $countries_array, $selected, $parameters);
}

// Output a Bootstrap Button
function tep_draw_button($title = null, $icon = null, $link = null, $priority = 'btn-primary', $params = null) {
  $types = array('submit', 'button', 'reset');

  if (!isset($params['type'])) {
    $params['type'] = 'submit';
  }

  if (!in_array($params['type'], $types)) {
    $params['type'] = 'submit';
  }

  if (($params['type'] == 'submit') && isset($link)) {
    $params['type'] = 'button';
  }

  if (($params['type'] == 'button') && isset($link)) {
    $button = '<a class="btn ' . tep_output_string($priority) . '" href="' . $link . '"';
  } else {
    $button = '<button class="btn ' . tep_output_string($priority) . '" type="' . tep_output_string($params['type']) . '"';
  }

  if (isset($params['params'])) {
    $button .= ' ' . $params['params'];
  }

  $button .= '>';

  if (isset($icon)) {
    if (!isset($params['iconpos'])) {
      $params['iconpos'] = 'left';
    }
    if ($params['iconpos'] == 'left') {
      $button .= '<i class="ms-1 icon-' . $icon . '"></i>' . $title;
    } else {
      $button .= $title . '<i class="ms-1 icon-' . $icon . '"></i>';
    }
  } else {
    $button .= $title;
  }

  if (($params['type'] == 'button') && isset($link)) {
    $button .= '</a>';
  } else {
    $button .= '</button>';
  }

  return $button;
}
