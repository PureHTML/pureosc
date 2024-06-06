
<?php
/*
  $Id: ask_question.php,v 1.5 2002/01/11 22:04:06 dgw_ Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- information //-->
<?php

  $boxHeading = BOX_HEADING_ASK_QUESTION;
  $corner_left = 'square';
  $corner_right = 'square';
  $boxContent_attributes = ' align="center"';
  $box_base_name = 'ask_box'; // for easy unique box template setup (added BTSv1.2)
  $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)

  $boxContent = '<a href="' . tep_href_link(FILENAME_ASK_QUESTION, 'products_id=' . $_GET['products_id']) . '">'
                                        . tep_image(bts_select(images, 'box_ask_question.png'), BOX_HEADING_TELL_A_FRIEND) . '<br />' 
                                        . IMAGE_BUTTON_ASK_QUESTION . '</a>';

include (bts_select('boxes', $box_base_name)); // BTS 1.5

  $boxContent_attributes = '';
?>
<!-- information_eof //-->