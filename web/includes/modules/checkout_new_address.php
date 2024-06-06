<?php
/*
  $Id: checkout_new_address.php,v 1.4 2003/06/09 22:49:57 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

  if (!isset($process)) $process = false;

  if (ACCOUNT_GENDER == 'true') {
    if (isset($gender)) {
      $male = ($gender == 'm') ? true : false;
      $female = ($gender == 'f') ? true : false;
    } else {
      $male = false;
      $female = false;
    }
?>
  <?php echo ENTRY_GENDER; ?> 
  <?php echo tep_draw_radio_field_label(MALE, 'gender_m', 'gender', 'm', $male) . '&nbsp;&nbsp;' . tep_draw_radio_field_label(FEMALE, 'gender_f', 'gender', 'f', $female) . '&nbsp;' . (tep_not_null(ENTRY_GENDER_TEXT) ? '<span class="inputRequirement">' . ENTRY_GENDER_TEXT . '</span>': ''); ?> <br />
<?php
  }
?>
  <?php echo tep_draw_input_field_label(ENTRY_FIRST_NAME, false, 'firstname') . '&nbsp;' . (tep_not_null(ENTRY_FIRST_NAME_TEXT) ? '<span class="inputRequirement">' . ENTRY_FIRST_NAME_TEXT . '</span>': ''); ?> <br />
  <?php echo tep_draw_input_field_label(ENTRY_LAST_NAME, false, 'lastname') . '&nbsp;' . (tep_not_null(ENTRY_LAST_NAME_TEXT) ? '<span class="inputRequirement">' . ENTRY_LAST_NAME_TEXT . '</span>': ''); ?> <br />

<!--PIVACF start-->
<?php
  if (ACCOUNT_CF == 'true') {
?>
  <?php echo tep_draw_input_field_label(ENTRY_CF, false, 'cf') . '&nbsp;' . ((tep_not_null(ENTRY_CF_TEXT) && (ACCOUNT_CF_REQ == 'true')) ? '<span class="inputRequirement">' . ENTRY_CF_TEXT . '</span>': ''); ?><br />
<?php
  }
?>
<!--PIVACF end-->

<?php
  if (ACCOUNT_COMPANY == 'true') {
?>
  <?php echo tep_draw_input_field_label(ENTRY_COMPANY, false, 'company') . '&nbsp;' . (tep_not_null(ENTRY_COMPANY_TEXT) ? '<span class="inputRequirement">' . ENTRY_COMPANY_TEXT . '</span>': ''); ?> <br />

<!--PIVACF start-->
<?php
  if (ACCOUNT_PIVA == 'true') {
?>
  <?php echo tep_draw_input_field_label(ENTRY_PIVA, false, 'piva') . '&nbsp;' . ((tep_not_null(ENTRY_PIVA_TEXT) && (ACCOUNT_PIVA_REQ == 'true')) ? '<span class="inputRequirement">' . ENTRY_PIVA_TEXT . '</span>': ''); ?><br />
<?php
  }
?>
<!--PIVACF end-->

<?php
  }
?>
  <?php echo tep_draw_input_field_label(ENTRY_STREET_ADDRESS, false, 'street_address') . '&nbsp;' . (tep_not_null(ENTRY_STREET_ADDRESS_TEXT) ? '<span class="inputRequirement">' . ENTRY_STREET_ADDRESS_TEXT . '</span>': ''); ?> <br />
<?php
  if (ACCOUNT_SUBURB == 'true') {
?>
  <?php echo tep_draw_input_field_label(ENTRY_SUBURB, false, 'suburb') . '&nbsp;' . (tep_not_null(ENTRY_SUBURB_TEXT) ? '<span class="inputRequirement">' . ENTRY_SUBURB_TEXT . '</span>': ''); ?> <br />
<?php
  }
?>
  <?php echo tep_draw_input_field_label(ENTRY_POST_CODE, false, 'postcode') . '&nbsp;' . (tep_not_null(ENTRY_POST_CODE_TEXT) ? '<span class="inputRequirement">' . ENTRY_POST_CODE_TEXT . '</span>': ''); ?> <br />
  <?php echo tep_draw_input_field_label(ENTRY_CITY, false, 'city') . '&nbsp;' . (tep_not_null(ENTRY_CITY_TEXT) ? '<span class="inputRequirement">' . ENTRY_CITY_TEXT . '</span>': ''); ?> <br />
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
      echo tep_draw_input_field_label(ENTRY_STATE, false, 'state');
    }

    if (tep_not_null(ENTRY_STATE_TEXT)) echo '&nbsp;<span class="inputRequirement">' . ENTRY_STATE_TEXT;
?>
</span><br />
<?php
  }
?>
  <?php echo ENTRY_COUNTRY; ?> 
  <?php echo tep_get_country_list('country') . '&nbsp;' . (tep_not_null(ENTRY_COUNTRY_TEXT) ? '<span class="inputRequirement">' . ENTRY_COUNTRY_TEXT . '</span>': ''); 
  ?>