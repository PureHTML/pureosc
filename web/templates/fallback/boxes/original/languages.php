<?php
/*
  $Id: languages.php,v 1.15 2003/06/09 22:10:48 hpdl Exp $

  modified by paulm_nl 2003/12/23

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- languages //-->
<?php

  $boxHeading = BOX_HEADING_LANGUAGES;
  $corner_left = 'square';
  $corner_right = 'square';
  $boxContent_attributes = ' align="center"';
  $box_base_name = 'languages'; // for easy unique box template setup (added BTSv1.2)
  $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)

  if (!isset($lng) || (isset($lng) && !is_object($lng))) {
    include(DIR_WS_CLASSES . 'language.php');
    $lng = new language;
  }

  $boxContent = '';
  reset($lng->catalog_languages);
  while (list($key, $value) = each($lng->catalog_languages)) {
    $boxContent .= '<a class="'.$key.'" title="'.$value['name'].'" href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('language', 'currency')) . 'language=' . $key, $request_type) . '">'.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$key. '</a>. ';
  }

include (bts_select('boxes', $box_base_name)); // BTS 1.5

  $boxContent_attributes = '';
?>
<!-- languages_eof //-->