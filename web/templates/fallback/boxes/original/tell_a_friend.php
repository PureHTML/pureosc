<?php
/*
  $Id: tell_a_friend.php,v 1.16 2003/06/10 18:26:33 hpdl Exp $

  modified by paulm_nl 2003/12/23

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- tell_a_friend //-->
<?php

  $boxHeading = BOX_HEADING_TELL_A_FRIEND;
  $corner_left = 'square';
  $corner_right = 'square';
  $boxContent_attributes = ' align="center"';
  $box_base_name = 'tell_a_friend'; // for easy unique box template setup (added BTSv1.2)
  $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)

  $boxContent = '<a href="' . tep_href_link(FILENAME_TELL_A_FRIEND, 'products_id=' . $_GET['products_id']) . '">'
                                        . tep_image(bts_select(images, 'button_tell_a_friend.png'), BOX_HEADING_TELL_A_FRIEND) . '<br />' 
                                        . BOX_HEADING_TELL_A_FRIEND . '</a>';

include (bts_select('boxes', $box_base_name)); // BTS 1.5

  $boxContent_attributes = '';
?>
<!-- tell_a_friend_eof //-->