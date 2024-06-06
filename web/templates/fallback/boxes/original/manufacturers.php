<div class="AlignLeft">
<?php
/*
  $Id: manufacturers.php,v 1.19 2003/06/09 22:17:13 hpdl Exp $

  modified by paulm_nl 2003/12/23

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/
// #################### Added Enable / Disable Categories ##############
//  $manufacturers_query = tep_db_query("select manufacturers_id, manufacturers_name from " . TABLE_MANUFACTURERS . " order by manufacturers_name");
  $manufacturers_query = tep_db_query("select distinct m.manufacturers_id, m.manufacturers_name from " . TABLE_MANUFACTURERS . " m left join " . TABLE_PRODUCTS . " p on m.manufacturers_id = p.manufacturers_id left join " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c on p.products_id = p2c.products_id left join " . TABLE_CATEGORIES . " c on p2c.categories_id = c.categories_id where c.categories_status = '1' and p.products_status = '1' order by m.manufacturers_name");
// #################### End Added Enable / Disable Categories ##############
  if ($number_of_rows = tep_db_num_rows($manufacturers_query)) {
?>
<!-- manufacturers //-->
<?php
    $boxHeading = BOX_HEADING_MANUFACTURERS;

    $corner_left = 'square';
    $corner_right = 'square';
    $box_base_name = 'manufacturers'; // for easy unique box template setup (added BTSv1.2)
    $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)

    if ($number_of_rows <= MAX_DISPLAY_MANUFACTURERS_IN_A_LIST) {
// Display a list
      $boxContent = '';
      while ($manufacturers = tep_db_fetch_array($manufacturers_query)) {
        $manufacturers_name = ((strlen($manufacturers['manufacturers_name']) > MAX_DISPLAY_MANUFACTURER_NAME_LEN) ? substr($manufacturers['manufacturers_name'], 0, MAX_DISPLAY_MANUFACTURER_NAME_LEN) . '..' : $manufacturers['manufacturers_name']);
        if (isset($_GET['manufacturers_id']) && ($_GET['manufacturers_id'] == $manufacturers['manufacturers_id'])) $manufacturers_name = '<span class="b">' . $manufacturers_name .'</span>';
        $boxContent .= '<a href="' . tep_href_link(FILENAME_DEFAULT, 'manufacturers_id=' . $manufacturers['manufacturers_id']) . '">' . $manufacturers_name . '</a><br />';
      }

     // $boxContent = substr($boxContent, 0, -4); // errore nella visualizzazione

    } else {
// Display a drop-down
      $manufacturers_array = array();
	$manufacturers_array[] = array('id'=>0, 'text'=> 'autoři');
      if ( (MAX_MANUFACTURERS_LIST < 2) && (SEO_ENABLED == 'false') ) {
        $manufacturers_array[] = array('id' => '', 'text' => PULL_DOWN_DEFAULT);
      }

      while ($manufacturers = tep_db_fetch_array($manufacturers_query)) {
        $manufacturers_name = ((strlen($manufacturers['manufacturers_name']) > MAX_DISPLAY_MANUFACTURER_NAME_LEN) ? substr($manufacturers['manufacturers_name'], 0, MAX_DISPLAY_MANUFACTURER_NAME_LEN) . '..' : $manufacturers['manufacturers_name']);
        $manufacturers_array[] = array('id' => $manufacturers['manufacturers_id'],
                                       'text' => $manufacturers_name);
      }

      $boxContent = tep_draw_form('manufacturers', tep_href_link(FILENAME_DEFAULT, '', 'NONSSL'), 'get');
      $boxContent .= tep_draw_pull_down_menu_label('' , 'manufacter_list', 'manufacturers_id', $manufacturers_array, (isset($_GET['manufacturers_id']) ? $_GET['manufacturers_id'] : ''), 'onchange="this.form.submit();" size="' . MAX_MANUFACTURERS_LIST . '" ') . tep_hide_session_id() . '</form>';
    }

include (bts_select('boxes', $box_base_name)); // BTS 1.5

?>
<!-- manufacturers_eof //-->
<?php
  }
?></div>