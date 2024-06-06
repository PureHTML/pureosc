<?php
/*
  $Id: address_book_details.php,v 1.10 2003/06/09 22:49:56 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce, shop2.0brain

  Released under the GNU General Public License
*/

  if (!isset($process)) $process = false;
?>
  <span class="b"><?php echo NEW_ADDRESS_TITLE; ?></span>
  <span class="inputRequirement"><?php echo FORM_REQUIRED_INFORMATION; ?> </span>
  <div class="InfoBoxContenent2MA">
<?php
  if (ACCOUNT_GENDER == 'true') {
    $male = $female = false;
    if (isset($gender)) {
      $male = ($gender == 'm') ? true : false;
      $female = !$male;
    } elseif (isset($entry['entry_gender'])) {
      $male = ($entry['entry_gender'] == 'm') ? true : false;
      $female = !$male;
    }
?>
  <?php echo ENTRY_GENDER; ?> 
  <?php echo tep_draw_radio_field_label(MALE, 'gender_m', 'gender', 'm', $male) . '&nbsp;&nbsp;' . tep_draw_radio_field_label(FEMALE, 'gender_f', 'gender', 'f', $female) . '&nbsp;' . (tep_not_null(ENTRY_GENDER_TEXT) ? '<span class="inputRequirement">' . ENTRY_GENDER_TEXT . '</span>': ''); ?> <br />
<?php
  }
?>
  <?php echo tep_draw_input_field_label(ENTRY_FIRST_NAME, false, 'firstname', $entry['entry_firstname']) . '&nbsp;' . (tep_not_null(ENTRY_FIRST_NAME_TEXT) ? '<span class="inputRequirement">' . ENTRY_FIRST_NAME_TEXT . '</span>': ''); ?> <br />
  <?php echo tep_draw_input_field_label(ENTRY_LAST_NAME, false, 'lastname', $entry['entry_lastname']) . '&nbsp;' . (tep_not_null(ENTRY_LAST_NAME_TEXT) ? '<span class="inputRequirement">' . ENTRY_LAST_NAME_TEXT . '</span>': ''); ?> <br />
  
  
<?php
  if (ACCOUNT_COMPANY == 'true') {
?>
  <?php echo tep_draw_input_field_label(ENTRY_COMPANY, false, 'company', $entry['entry_company']) . '&nbsp;' . (tep_not_null(ENTRY_COMPANY_TEXT) ? '<span class="inputRequirement">' . ENTRY_COMPANY_TEXT . '</span>': ''); ?> <br />

<?php // PIVACF SOF //shop2.0brain: czech ICO
  if (ACCOUNT_CF == 'true') {
?>
  <?php echo tep_draw_input_field_label(ENTRY_CF, false, 'cf', $entry['entry_cf']) . '&nbsp;' . ((tep_not_null(ENTRY_CF_TEXT) && (ACCOUNT_CF_REQ == 'true')) ? '<span class="inputRequirement">' . ENTRY_CF_TEXT . '</span>': ''); ?> <br />
<?php
  }
// PIVACF BOF
?>  

<?php // PIVACF SOF //shop2.0brain: czech DIC
  }
?>
<?php
  if (ACCOUNT_PIVA == 'true') {
?>
  <?php echo tep_draw_input_field_label(ENTRY_PIVA, false, 'piva', $entry['entry_piva']) . '&nbsp;' . ((tep_not_null(ENTRY_PIVA_TEXT) && (ACCOUNT_PIVA_REQ == 'true')) ? '<span class="inputRequirement">' . ENTRY_PIVA_TEXT . '</span>': ''); ?> <br />
<?php // PIVACF EOF
  }
?>
  <?php echo tep_draw_input_field_label(ENTRY_STREET_ADDRESS, false, 'street_address', $entry['entry_street_address']) . '&nbsp;' . (tep_not_null(ENTRY_STREET_ADDRESS_TEXT) ? '<span class="inputRequirement">' . ENTRY_STREET_ADDRESS_TEXT . '</span>': ''); ?> <br />
<?php
  if (ACCOUNT_SUBURB == 'true') {
?>
  <?php echo tep_draw_input_field_label(ENTRY_SUBURB, false, 'suburb', $entry['entry_suburb']) . '&nbsp;' . (tep_not_null(ENTRY_SUBURB_TEXT) ? '<span class="inputRequirement">' . ENTRY_SUBURB_TEXT . '</span>': ''); ?> <br />
<?php
  }
?>
  <?php echo tep_draw_input_field_label(ENTRY_POST_CODE, false, 'postcode', $entry['entry_postcode']) . '&nbsp;' . (tep_not_null(ENTRY_POST_CODE_TEXT) ? '<span class="inputRequirement">' . ENTRY_POST_CODE_TEXT . '</span>': ''); ?> <br />
  <?php echo tep_draw_input_field_label(ENTRY_CITY, false, 'city', $entry['entry_city']) . '&nbsp;' . (tep_not_null(ENTRY_CITY_TEXT) ? '<span class="inputRequirement">' . ENTRY_CITY_TEXT . '</span>': ''); ?> <br />
<?php
  if (ACCOUNT_STATE == 'true') {
    if ($process == true) {
      if ($entry_state_has_zones == true) {
        $zones_array = array();
        $zones_query = tep_db_query("select zone_name from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "' order by zone_name");
        while ($zones_values = tep_db_fetch_array($zones_query)) {
          $zones_array[] = array('id' => $zones_values['zone_name'], 'text' => $zones_values['zone_name']);
        }
        echo tep_draw_pull_down_menu_label(ENTRY_STATE, 'list_state', 'state', $zones_array);
      } else {
        echo tep_draw_input_field_label(ENTRY_STATE, false, 'state');
      }
    } else {
      echo tep_draw_input_field_label(ENTRY_STATE, false, 'state', tep_get_zone_name($entry['entry_country_id'], $entry['entry_zone_id'], $entry['entry_state']));
    }

    if (tep_not_null(ENTRY_STATE_TEXT)) echo '&nbsp;<span class="inputRequirement">' . ENTRY_STATE_TEXT .'</span>';
?> <br />
<?php
  }
?>
  <?php echo ENTRY_COUNTRY; ?> 
  <?php echo tep_get_country_list('country', $entry['entry_country_id']) . '&nbsp;' . (tep_not_null(ENTRY_COUNTRY_TEXT) ? '<span class="inputRequirement">' . ENTRY_COUNTRY_TEXT . '</span>': ''); ?> <br />
<?php
  if ((isset($_GET['edit']) && ($customer_default_address_id != $_GET['edit'])) || (isset($_GET['edit']) == false) ) {
?>
  <?php echo tep_draw_checkbox_field_label(SET_AS_PRIMARY, 'primary', 'primary', 'on', false, ''); ?> <br />
<?php
  }
?> </div><br />
