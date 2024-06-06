<?php
/*
  $Id: administrator.php,v 1.20 2002/03/16 00:20:11 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- catalog //-->
          <tr>
            <td>
<?php
  $heading = array();
  $contents = array();

  $heading[] = array('text'  => BOX_HEADING_ADMINISTRATOR,
                     'link'  => tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('selected_box')) . 'selected_box=administrator'));

  if ($selected_box == 'administrator') {
    $contents[] = array('text'  => tep_admin_files_boxes(FILENAME_ADMIN_MEMBERS, BOX_ADMINISTRATOR_MEMBERS) .
                                   tep_admin_files_boxes(FILENAME_ADMIN_FILES, BOX_ADMINISTRATOR_BOXES) .
                                   '<a href="' . tep_href_link(FILENAME_ADMIN_ACCOUNT, '', 'SSL') . '" class="headerLink">' . HEADER_TITLE_ACCOUNT . '</a><br />' .
                                   ' ');
  }

  $box = new box;
  echo $box->menuBox($heading, $contents);
?>
            </td>
          </tr>
<!-- catalog_eof //-->
