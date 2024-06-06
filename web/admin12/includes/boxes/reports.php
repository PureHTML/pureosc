<?php
/*
  $Id: reports.php,v 1.5 2003/07/09 01:18:53 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- reports //-->
          <tr>
            <td>
<?php
  $heading = array();
  $contents = array();

  $heading[] = array('text'  => BOX_HEADING_REPORTS,
                     'link'  => tep_href_link(FILENAME_STATS_PRODUCTS_VIEWED, 'selected_box=reports'));

  if ($selected_box == 'reports') {
    $contents[] = array('text'  => 
//Admin begin
//                                   '<a href="' . tep_href_link(FILENAME_STATS_PRODUCTS_VIEWED, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_REPORTS_PRODUCTS_VIEWED . '</a><br />' .
//                                   '<a href="' . tep_href_link(FILENAME_STATS_PRODUCTS_PURCHASED, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_REPORTS_PRODUCTS_PURCHASED . '</a><br />' .
//                                   '<a href="' . tep_href_link(FILENAME_STATS_CUSTOMERS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_REPORTS_ORDERS_TOTAL . '</a>');
                                   tep_admin_files_boxes(FILENAME_STATS_PRODUCTS_VIEWED, BOX_REPORTS_PRODUCTS_VIEWED) .
                                   tep_admin_files_boxes(FILENAME_STATS_PRODUCTS_PURCHASED, BOX_REPORTS_PRODUCTS_PURCHASED) .
                                   tep_admin_files_boxes(FILENAME_STATS_CUSTOMERS, BOX_REPORTS_ORDERS_TOTAL) .
                                   tep_admin_files_boxes(FILENAME_STATS_CREDITS, BOX_REPORTS_CREDITS) .
                                   tep_admin_files_boxes(FILENAME_STORE_STATISTICS, BOX_TOOLS_STORE_STATISTICS) .
                                   tep_admin_files_boxes(FILENAME_ORDERS_STATISTICS, BOX_TOOLS_ORDERS_STATISTICS) .
                                   tep_admin_files_boxes(FILENAME_PRODUCTS_STATISTICS, BOX_TOOLS_PRODUCTS_STATISTICS) .
                                   tep_admin_files_boxes(FILENAME_WHOS_ONLINE, BOX_TOOLS_WHOS_ONLINE) .
                                   tep_admin_files_boxes(FILENAME_MARGIN_REPORT, BOX_REPORTS_MARGIN_REPORT) .
				   tep_admin_files_boxes('supertracker.php', 'Supertracker') .
                                   tep_admin_files_boxes(FILENAME_MISSING_PICS, BOX_REPORTS_MISSING_PICS) .
        '<a href="' . tep_href_link(FILENAME_STATS_MONTHLY_SALES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_REPORTS_MONTHLY_SALES . '</a>');


//Admin end
  }

  $box = new box;
  echo $box->menuBox($heading, $contents);
?>
            </td>
          </tr>
<!-- reports_eof //-->
