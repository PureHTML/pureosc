<?php
/*
  $Id: tools.php,v 1.21 2003/07/09 01:18:53 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- tools //-->
          <tr>
            <td>
<?php
  $heading = array();
  $contents = array();

  $heading[] = array('text'  => BOX_HEADING_TOOLS,
                     'link'  => tep_href_link(FILENAME_BACKUP, 'selected_box=tools'));

  if ($selected_box == 'tools') {
    $contents[] = array('text'  => 
//Admin begin
//                                   '<a href="' . tep_href_link(FILENAME_BACKUP) . '" class="menuBoxContentLink">' . BOX_TOOLS_BACKUP . '</a><br />' .
//                                   '<a href="' . tep_href_link(FILENAME_BANNER_MANAGER) . '" class="menuBoxContentLink">' . BOX_TOOLS_BANNER_MANAGER . '</a><br />' .
//                                   '<a href="' . tep_href_link(FILENAME_CACHE) . '" class="menuBoxContentLink">' . BOX_TOOLS_CACHE . '</a><br />' .
//                                   '<a href="' . tep_href_link(FILENAME_DEFINE_LANGUAGE) . '" class="menuBoxContentLink">' . BOX_TOOLS_DEFINE_LANGUAGE . '</a><br />' .
//                                   '<a href="' . tep_href_link(FILENAME_FILE_MANAGER) . '" class="menuBoxContentLink">' . BOX_TOOLS_FILE_MANAGER . '</a><br />' .
//                                   '<a href="' . tep_href_link(FILENAME_MAIL) . '" class="menuBoxContentLink">' . BOX_TOOLS_MAIL . '</a><br />' .
//                                   '<a href="' . tep_href_link(FILENAME_NEWSLETTERS) . '" class="menuBoxContentLink">' . BOX_TOOLS_NEWSLETTER_MANAGER . '</a><br />' .
//                                   '<a href="' . tep_href_link(FILENAME_SERVER_INFO) . '" class="menuBoxContentLink">' . BOX_TOOLS_SERVER_INFO . '</a><br />' .
//                                   '<a href="' . tep_href_link(FILENAME_WHOS_ONLINE) . '" class="menuBoxContentLink">' . BOX_TOOLS_WHOS_ONLINE . '</a>');
                                   tep_admin_files_boxes(FILENAME_BACKUP, BOX_TOOLS_BACKUP) .
                                   '<a href="' . tep_href_link('link_manage.php') . '" class="menuBoxContentLink">Reciprocal Links</a><br>' .
                                   tep_admin_files_boxes(FILENAME_BANNER_MANAGER, BOX_TOOLS_BANNER_MANAGER) . 
                                   tep_admin_files_boxes(FILENAME_CACHE, BOX_TOOLS_CACHE) .
                                   tep_admin_files_boxes(FILENAME_DEFINE_LANGUAGE, BOX_TOOLS_DEFINE_LANGUAGE) .
                                   tep_admin_files_boxes(FILENAME_FILE_MANAGER, BOX_TOOLS_FILE_MANAGER) .
                                   tep_admin_files_boxes(FILENAME_MAIL, BOX_TOOLS_MAIL) .
                                   tep_admin_files_boxes(FILENAME_NEWSLETTERS, BOX_TOOLS_NEWSLETTER_MANAGER) .
                                   tep_admin_files_boxes(FILENAME_SERVER_INFO, BOX_TOOLS_SERVER_INFO) .
                                   tep_admin_files_boxes(FILENAME_SITEMAP, BOX_TOOLS_SITEMAP) .
                                   tep_admin_files_boxes(FILENAME_GOOGLE_SITEMAP, BOX_GOOGLE_SITEMAP ) .
                                   tep_admin_files_boxes(FILENAME_SEO_ASSISTANT, BOX_TOOLS_SEO_ASSISTANT ) .
                                   tep_admin_files_boxes(FILENAME_OSWAI_UPDATE, BOX_OSWAI_UPDATE ) .


                                   tep_admin_files_boxes(FILENAME_ADMIN_NOTES, BOX_TOOLS_ADMIN_NOTES ) .
                                   tep_admin_files_boxes(FILENAME_EVENTS_MANAGER, BOX_TOOLS_EVENTS_MANAGER ) .

                                   ' ');
//Admin end
  }

  $box = new box;
  echo $box->menuBox($heading, $contents);
?>
            </td>
          </tr>
<!-- tools_eof //-->
