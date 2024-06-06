<?php
/*
  $Id: catalog.php,v 1.21 2003/07/09 01:18:53 hpdl Exp $

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

  $heading[] = array('text'  => BOX_HEADING_CATALOG,
                     'link'  => tep_href_link(FILENAME_CATEGORIES, 'selected_box=catalog'));

  if ($selected_box == 'catalog') {
    $contents[] = array('text'  =>
//Admin begin
//                                   '<a href="' . tep_href_link(FILENAME_CATEGORIES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_CATEGORIES_PRODUCTS . '</a><br />' .
//                                   '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES . '</a><br />' .
//                                   '<a href="' . tep_href_link(FILENAME_MANUFACTURERS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_MANUFACTURERS . '</a><br />' .
//                                   '<a href="' . tep_href_link(FILENAME_REVIEWS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_REVIEWS . '</a><br />' .
//                                   '<a href="' . tep_href_link(FILENAME_SPECIALS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_SPECIALS . '</a><br />' .
//                                   '<a href="' . tep_href_link(FILENAME_PRODUCTS_EXPECTED, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_PRODUCTS_EXPECTED . '</a>');
                                   tep_admin_files_boxes(FILENAME_CATEGORIES, BOX_CATALOG_CATEGORIES_PRODUCTS) .
// Easy populate									
//          original                 '<a href="' . tep_href_link(FILENAME_IMP_EXP_CATALOG, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_CATALOG_IMP_EXP . '</a><br />' .
                                   tep_admin_files_boxes(FILENAME_IMP_EXP_CATALOG, BOX_CATALOG_IMP_EXP) .
// END Easy populate	
                                   tep_admin_files_boxes(FILENAME_PRODUCTS_ATTRIBUTES, BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES) .
                                   tep_admin_files_boxes(FILENAME_MANUFACTURERS, BOX_CATALOG_MANUFACTURERS) .
                                   tep_admin_files_boxes(FILENAME_REVIEWS, BOX_CATALOG_REVIEWS) .
                                   tep_admin_files_boxes(FILENAME_SPECIALS, BOX_CATALOG_SPECIALS) .
                                   tep_admin_files_boxes(FILENAME_PRODUCTS_EXPECTED, BOX_CATALOG_PRODUCTS_EXPECTED) .

        /* Optional Related Products (ORP) */
                                   tep_admin_files_boxes(FILENAME_RELATED_PRODUCTS, BOX_CATALOG_CATEGORIES_RELATED_PRODUCTS) .
        //ORP:end

                                   // easy price
                                   tep_admin_files_boxes(FILENAME_PRODUCT_UPDATES, BOX_CATALOG_PRODUCTS_UPDATE) .
                                   tep_admin_files_boxes(FILENAME_UPLOAD_FILE, BOX_CATALOG_UPLOAD_FILE) .

                                   ' ');
//Admin end
  }

  $box = new box;
  echo $box->menuBox($heading, $contents);
?>
            </td>
          </tr>
<!-- catalog_eof //-->
