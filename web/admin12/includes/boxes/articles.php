<?php
/*
  $Id: articles.php, v1.0 2003/12/04 12:00:00 ra Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

?>
<!-- articles //-->
          <tr>
            <td>
<?php
  $heading = array();
  $contents = array();

  $heading[] = array('text'  => BOX_HEADING_ARTICLES,
                     'link'  => tep_href_link(FILENAME_ARTICLES, 'selected_box=articles'));

  if ($selected_box == 'articles') {
      $contents[] = array('text' => '<a href="' . tep_href_link(FILENAME_ARTICLES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_TOPICS_ARTICLES . '</a><br>' .
                                    '<a href="' . tep_href_link(FILENAME_ARTICLES_CONFIG, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_ARTICLES_CONFIG . '</a><br>' .
                                    '<a href="' . tep_href_link(FILENAME_AUTHORS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_ARTICLES_AUTHORS . '</a><br>' .
                                    '<a href="' . tep_href_link(FILENAME_ARTICLE_REVIEWS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_ARTICLES_REVIEWS . '</a><br>' .
                                    '<a href="' . tep_href_link(FILENAME_ARTICLES_XSELL, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_ARTICLES_XSELL . '</a>');
  }

  $box = new box;
  echo $box->menuBox($heading, $contents);
?>
            </td>
          </tr>
<!-- articles_eof //-->