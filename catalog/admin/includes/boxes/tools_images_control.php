<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2020 osCommerce

  Released under the GNU General Public License
*/

  foreach ($cl_box_groups as &$group) {
    if ($group['heading'] == BOX_HEADING_TOOLS) {
      $group['apps'][] = array('code' => 'images.php',
                               'title' => MODULES_ADMIN_MENU_TOOLS_IMAGES_CONTROL,
                               'link' => tep_href_link('images.php'));

      break;
    }
  }