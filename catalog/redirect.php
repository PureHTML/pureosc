<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2020 osCommerce

  Released under the GNU General Public License
*/

require('includes/application_top.php');

switch ($_GET['action']) {
  case 'url':
    if (isset($_GET['goto']) && !empty($_GET['goto'])) {
      $check_query = tep_db_query("select products_url from products_description where products_url = '" . tep_db_input($_GET['goto']) . "' limit 1");
      if (tep_db_num_rows($check_query)) {
        tep_redirect('http://' . $_GET['goto']);
      }
    }
    break;
  case 'manufacturer':
    if (isset($_GET['manufacturers_id']) && !empty($_GET['manufacturers_id'])) {
      $manufacturer_query = tep_db_query("select manufacturers_url from manufacturers_info where manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "' and languages_id = '" . (int)$languages_id . "'");
      if (tep_db_num_rows($manufacturer_query)) {
// url exists in selected language
        $manufacturer = tep_db_fetch_array($manufacturer_query);

        if (!empty($manufacturer['manufacturers_url'])) {
          tep_db_query("update manufacturers_info set url_clicked = url_clicked+1, date_last_click = now() where manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "' and languages_id = '" . (int)$languages_id . "'");

          tep_redirect($manufacturer['manufacturers_url']);
        }
      } else {
// no url exists for the selected language, lets use the default language then
        $manufacturer_query = tep_db_query("select mi.languages_id, mi.manufacturers_url from manufacturers_info mi, languages l where mi.manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "' and mi.languages_id = l.languages_id and l.code = '" . tep_db_input(DEFAULT_LANGUAGE) . "'");
        if (tep_db_num_rows($manufacturer_query)) {
          $manufacturer = tep_db_fetch_array($manufacturer_query);

          if (!empty($manufacturer['manufacturers_url'])) {
            tep_db_query("update manufacturers_info set url_clicked = url_clicked+1, date_last_click = now() where manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "' and languages_id = '" . (int)$manufacturer['languages_id'] . "'");

            tep_redirect($manufacturer['manufacturers_url']);
          }
        }
      }
    }
    break;
}

tep_redirect(tep_href_link('index.php'));