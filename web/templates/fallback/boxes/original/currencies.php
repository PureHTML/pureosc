<?php
/*
  $Id: currencies.php,v 1.16 2003/02/12 20:27:31 hpdl Exp $

  modified by paulm_nl 2003/12/23

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- currencies //-->
<?php
    $boxHeading = BOX_HEADING_CURRENCIES;
    $corner_left = 'square';
    $corner_right = 'square';
    $box_base_name = 'currencies'; // for easy unique box template setup (added BTSv1.2)
    $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)
    $boxContent_attributes = ' align="center"';

  if (!isset($currencies) || (isset($currencies) && !is_object($currencies))) {
    include(DIR_WS_CLASSES . 'currencies.php');
    $currencies = new language;
  }

  $languages_string = '';
  reset($currencies->currencies);
  while (list($key, $value) = each($currencies->currencies)) {
    $languages_string .= '<a class="'.$key.'" title="'. $value['title'] .'" href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('language', 'currency')) . 'currency=' . $key, $request_type) . '">'.'&nbsp;&nbsp;&nbsp;'.$key.'&nbsp;'. '</a>. ';
  }

    $boxContent = $languages_string;

include (bts_select('boxes', $box_base_name)); // BTS 1.5

  $boxContent_attributes = '';
?>
<!-- currencies_eof //-->