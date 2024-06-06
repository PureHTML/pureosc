<?php
/*
  $Id: customers.php,v 1.16 2003/07/09 01:18:53 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- customers //-->
          <tr>
            <td>
<?php
  $heading = array();
  $contents = array();

  $heading[] = array('text'  => BOX_HEADING_CUSTOMERS,
                     'link'  => tep_href_link(FILENAME_CUSTOMERS, 'selected_box=customers'));

  if ($selected_box == 'customers') {
    $contents[] = array('text'  =>
//Admin begin
//                                   '<a href="' . tep_href_link(FILENAME_CUSTOMERS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_CUSTOMERS . '</a><br />' .
//                                   '<a href="' . tep_href_link(FILENAME_ORDERS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CUSTOMERS_ORDERS . '</a>');
                                   tep_admin_files_boxes(FILENAME_CUSTOMERS, BOX_CUSTOMERS_CUSTOMERS) .
                                   tep_admin_files_boxes(FILENAME_ORDERS, BOX_CUSTOMERS_ORDERS) .
                                   tep_admin_files_boxes(FILENAME_BIRTHDAY, BOX_CUSTOMERS_BIRTHDAY) .
                                   tep_admin_files_boxes(FILENAME_CUSTOMERS_POINTS_PENDING, BOX_CUSTOMERS_POINTS_PENDING) .
                                   tep_admin_files_boxes(FILENAME_CUSTOMERS_POINTS_REFERRAL, BOX_CUSTOMERS_POINTS_REFERRAL) .
                                   tep_admin_files_boxes(FILENAME_CUSTOMERS_POINTS, BOX_CUSTOMERS_POINTS) .
                    //TotalB2B start
                    tep_admin_files_boxes('customers_groups.php', BOX_CUSTOMERS_GROUPS) .  
					tep_admin_files_boxes('manudiscount.php', BOX_MANUDISCOUNT) . 
                    //TotalB2B end

                                   ' ');
//Admin end
  }

  $box = new box;
  echo $box->menuBox($heading, $contents);
?>
            </td>
          </tr>
<!-- customers_eof //-->
