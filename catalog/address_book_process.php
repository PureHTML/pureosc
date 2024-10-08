<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2020 osCommerce

  Released under the GNU General Public License
 */

require 'includes/application_top.php';

if (!isset($_SESSION['customer_id'])) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link('login.php'));
}

// needs to be included earlier to set the success message in the messageStack
require 'includes/languages/'.$language.'/address_book_process.php';

if (isset($_GET['action']) && ($_GET['action'] === 'deleteconfirm') && isset($_GET['delete']) && is_numeric($_GET['delete']) && isset($_GET['formid']) && ($_GET['formid'] === md5($sessiontoken))) {
    if ((int) $_GET['delete'] === $customer_default_address_id) {
        $messageStack->add_session('addressbook', WARNING_PRIMARY_ADDRESS_DELETION, 'warning');
    } else {
        tep_db_query("delete from address_book where address_book_id = '".(int) $_GET['delete']."' and customers_id = '".(int) $customer_id."'");

        $messageStack->add_session('addressbook', SUCCESS_ADDRESS_BOOK_ENTRY_DELETED, 'success');
    }

    tep_redirect(tep_href_link('address_book.php'));
}

// error checking when updating or adding an entry
$process = false;

if (isset($_POST['action']) && (($_POST['action'] === 'process') || ($_POST['action'] === 'update')) && isset($_POST['formid']) && ($_POST['formid'] === $sessiontoken)) {
    $process = true;
    $error = false;

    if (ACCOUNT_GENDER === 'true') {
        $gender = tep_db_prepare_input($_POST['gender']);
    }

    if (ACCOUNT_COMPANY === 'true') {
        $company = tep_db_prepare_input($_POST['company']);
    }

    $firstname = tep_db_prepare_input($_POST['firstname']);
    $lastname = tep_db_prepare_input($_POST['lastname']);
    $street_address = tep_db_prepare_input($_POST['street_address']);

    if (ACCOUNT_SUBURB === 'true') {
        $suburb = tep_db_prepare_input($_POST['suburb']);
    }

    $postcode = tep_db_prepare_input($_POST['postcode']);
    $city = tep_db_prepare_input($_POST['city']);
    $country = tep_db_prepare_input($_POST['country']);

    if (ACCOUNT_STATE === 'true') {
        if (isset($_POST['zone_id'])) {
            $zone_id = tep_db_prepare_input($_POST['zone_id']);
        } else {
            $zone_id = false;
        }

        $state = tep_db_prepare_input($_POST['state']);
    }

    if (ACCOUNT_GENDER === 'true') {
        if (($gender !== 'm') && ($gender !== 'f')) {
            $error = true;

            $messageStack->add('addressbook', ENTRY_GENDER_ERROR);
        }
    }

    if (\strlen($firstname) < ENTRY_FIRST_NAME_MIN_LENGTH) {
        $error = true;

        $messageStack->add('addressbook', ENTRY_FIRST_NAME_ERROR);
    }

    if (\strlen($lastname) < ENTRY_LAST_NAME_MIN_LENGTH) {
        $error = true;

        $messageStack->add('addressbook', ENTRY_LAST_NAME_ERROR);
    }

    if (\strlen($street_address) < ENTRY_STREET_ADDRESS_MIN_LENGTH) {
        $error = true;

        $messageStack->add('addressbook', ENTRY_STREET_ADDRESS_ERROR);
    }

    if (\strlen($postcode) < ENTRY_POSTCODE_MIN_LENGTH) {
        $error = true;

        $messageStack->add('addressbook', ENTRY_POST_CODE_ERROR);
    }

    if (\strlen($city) < ENTRY_CITY_MIN_LENGTH) {
        $error = true;

        $messageStack->add('addressbook', ENTRY_CITY_ERROR);
    }

    if (!is_numeric($country)) {
        $error = true;

        $messageStack->add('addressbook', ENTRY_COUNTRY_ERROR);
    }

    if (ACCOUNT_STATE === 'true') {
        $zone_id = 0;
        $check_query = tep_db_query("select count(*) as total from zones where zone_country_id = '".(int) $country."'");
        $check = tep_db_fetch_array($check_query);
        $entry_state_has_zones = ($check['total'] > 0);

        if ($entry_state_has_zones === true) {
            $zone_query = tep_db_query("select distinct zone_id from zones where zone_country_id = '".(int) $country."' and (zone_name = '".tep_db_input($state)."' or zone_code = '".tep_db_input($state)."')");

            if (tep_db_num_rows($zone_query) === 1) {
                $zone = tep_db_fetch_array($zone_query);
                $zone_id = $zone['zone_id'];
            } else {
                $error = true;

                $messageStack->add('addressbook', ENTRY_STATE_ERROR_SELECT);
            }
        } else {
            if (\strlen($state) < ENTRY_STATE_MIN_LENGTH) {
                $error = true;

                $messageStack->add('addressbook', ENTRY_STATE_ERROR);
            }
        }
    }

    if ($error === false) {
        $sql_data_array = ['entry_firstname' => $firstname,
            'entry_lastname' => $lastname,
            'entry_street_address' => $street_address,
            'entry_postcode' => $postcode,
            'entry_city' => $city,
            'entry_country_id' => (int) $country];

        if (ACCOUNT_GENDER === 'true') {
            $sql_data_array['entry_gender'] = $gender;
        }

        if (ACCOUNT_COMPANY === 'true') {
            $sql_data_array['entry_company'] = $company;
        }

        if (ACCOUNT_SUBURB === 'true') {
            $sql_data_array['entry_suburb'] = $suburb;
        }

        if (ACCOUNT_STATE === 'true') {
            if ($zone_id > 0) {
                $sql_data_array['entry_zone_id'] = (int) $zone_id;
                $sql_data_array['entry_state'] = '';
            } else {
                $sql_data_array['entry_zone_id'] = '0';
                $sql_data_array['entry_state'] = $state;
            }
        }

        if ($_POST['action'] === 'update') {
            $check_query = tep_db_query("select address_book_id from address_book where address_book_id = '".(int) $_GET['edit']."' and customers_id = '".(int) $customer_id."' limit 1");

            if (tep_db_num_rows($check_query) === 1) {
                tep_db_perform('address_book', $sql_data_array, 'update', "address_book_id = '".(int) $_GET['edit']."' and customers_id ='".(int) $customer_id."'");

                // reregister session variables
                if ((isset($_POST['primary']) && ($_POST['primary'] === 'on')) || ($_GET['edit'] === $customer_default_address_id)) {
                    $customer_first_name = $firstname;
                    $customer_country_id = $country;
                    $customer_zone_id = (($zone_id > 0) ? (int) $zone_id : '0');
                    $customer_default_address_id = (int) $_GET['edit'];

                    $sql_data_array = ['customers_firstname' => $firstname,
                        'customers_lastname' => $lastname,
                        'customers_default_address_id' => (int) $_GET['edit']];

                    if (ACCOUNT_GENDER === 'true') {
                        $sql_data_array['customers_gender'] = $gender;
                    }

                    tep_db_perform('customers', $sql_data_array, 'update', "customers_id = '".(int) $customer_id."'");
                }

                $messageStack->add_session('addressbook', SUCCESS_ADDRESS_BOOK_ENTRY_UPDATED, 'success');
            }
        } else {
            if (tep_count_customer_address_book_entries() < MAX_ADDRESS_BOOK_ENTRIES) {
                $sql_data_array['customers_id'] = (int) $customer_id;
                tep_db_perform('address_book', $sql_data_array);

                $new_address_book_id = tep_db_insert_id();

                // reregister session variables
                if (isset($_POST['primary']) && ($_POST['primary'] === 'on')) {
                    $customer_first_name = $firstname;
                    $customer_country_id = $country;
                    $customer_zone_id = (($zone_id > 0) ? (int) $zone_id : '0');

                    if (isset($_POST['primary']) && ($_POST['primary'] === 'on')) {
                        $customer_default_address_id = $new_address_book_id;
                    }

                    $sql_data_array = ['customers_firstname' => $firstname,
                        'customers_lastname' => $lastname];

                    if (ACCOUNT_GENDER === 'true') {
                        $sql_data_array['customers_gender'] = $gender;
                    }

                    if (isset($_POST['primary']) && ($_POST['primary'] === 'on')) {
                        $sql_data_array['customers_default_address_id'] = $new_address_book_id;
                    }

                    tep_db_perform('customers', $sql_data_array, 'update', "customers_id = '".(int) $customer_id."'");

                    $messageStack->add_session('addressbook', SUCCESS_ADDRESS_BOOK_ENTRY_UPDATED, 'success');
                }
            }
        }

        tep_redirect(tep_href_link('address_book.php'));
    }
}

if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $entry_query = tep_db_query("select entry_gender, entry_company, entry_firstname, entry_lastname, entry_street_address, entry_suburb, entry_postcode, entry_city, entry_state, entry_zone_id, entry_country_id from address_book where customers_id = '".(int) $customer_id."' and address_book_id = '".(int) $_GET['edit']."'");

    if (!tep_db_num_rows($entry_query)) {
        $messageStack->add_session('addressbook', ERROR_NONEXISTING_ADDRESS_BOOK_ENTRY);

        tep_redirect(tep_href_link('address_book.php'));
    }

    $entry = tep_db_fetch_array($entry_query);
} elseif (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    if ($_GET['delete'] === $customer_default_address_id) {
        $messageStack->add_session('addressbook', WARNING_PRIMARY_ADDRESS_DELETION, 'warning');

        tep_redirect(tep_href_link('address_book.php'));
    } else {
        $check_query = tep_db_query("select count(*) as total from address_book where address_book_id = '".(int) $_GET['delete']."' and customers_id = '".(int) $customer_id."'");
        $check = tep_db_fetch_array($check_query);

        if ($check['total'] < 1) {
            $messageStack->add_session('addressbook', ERROR_NONEXISTING_ADDRESS_BOOK_ENTRY);

            tep_redirect(tep_href_link('address_book.php'));
        }
    }
} else {
    $entry = [];
}

if (!isset($_GET['delete']) && !isset($_GET['edit'])) {
    if (tep_count_customer_address_book_entries() >= MAX_ADDRESS_BOOK_ENTRIES) {
        $messageStack->add_session('addressbook', ERROR_ADDRESS_BOOK_FULL);

        tep_redirect(tep_href_link('address_book.php'));
    }
}

$breadcrumb->add(NAVBAR_TITLE_1, tep_href_link('account.php'));
$breadcrumb->add(NAVBAR_TITLE_2, tep_href_link('address_book.php'));

if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
    $breadcrumb->add(NAVBAR_TITLE_MODIFY_ENTRY, tep_href_link('address_book_process.php', 'edit='.$_GET['edit']));
} elseif (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
    $breadcrumb->add(NAVBAR_TITLE_DELETE_ENTRY, tep_href_link('address_book_process.php', 'delete='.$_GET['delete']));
} else {
    $breadcrumb->add(NAVBAR_TITLE_ADD_ENTRY, tep_href_link('address_book_process.php'));
}

require 'includes/template_top.php';

if (!isset($_GET['delete'])) {
    include 'includes/form_check.js.php';
}

?>

  <h1><?php if (isset($_GET['edit'])) {
      echo HEADING_TITLE_MODIFY_ENTRY;
  } elseif (isset($_GET['delete'])) {
      echo HEADING_TITLE_DELETE_ENTRY;
  } else {
      echo HEADING_TITLE_ADD_ENTRY;
  }

?></h1>

<?php
if ($messageStack->size('addressbook') > 0) {
    echo $messageStack->output('addressbook');
}

?>

<?php
if (isset($_GET['delete'])) {
    ?>

  <p><?php echo DELETE_ADDRESS_DESCRIPTION; ?></p>
  <p><?php echo tep_address_label($customer_id, $_GET['delete'], true, ' ', '<br />'); ?></p>

  <div class="btn-toolbar justify-content-between">
    <?php echo tep_draw_button(IMAGE_BUTTON_BACK, 'triangle-1-w', tep_href_link('address_book.php'), 'btn-light'); ?>
    <?php echo tep_draw_button(IMAGE_BUTTON_DELETE, 'trash', tep_href_link('address_book_process.php', 'delete='.$_GET['delete'].'&action=deleteconfirm&formid='.md5($sessiontoken)), 'btn-primary'); ?>
  </div>

  <?php
} else {
    ?>

  <?php echo tep_draw_form('addressbook', tep_href_link('address_book_process.php', isset($_GET['edit']) ? 'edit='.$_GET['edit'] : ''), 'post', 'onsubmit="return check_form(addressbook);"', true); ?>

  <div class="col-lg-6 mb-5">
    <div class="text-end text-danger small"><?php echo FORM_REQUIRED_INFORMATION; ?></div>

    <?php include 'includes/modules/address_book_details.php'; ?>

    <?php
      if ((isset($_GET['edit']) && $customer_default_address_id !== $_GET['edit']) || !isset($_GET['edit'])) {
          ?>

      <div class="mb-3">
        <?php echo tep_draw_checkbox_field('primary', 'on', false, 'class="form-check-input" id="primary"'); ?>
        <label class="form-check-label" for="primary"><?php echo SET_AS_PRIMARY; ?></label>
      </div>

      <?php
      }

    if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
        ?>

      <div class="btn-toolbar justify-content-between">
        <?php echo tep_draw_button(IMAGE_BUTTON_BACK, 'triangle-1-w', tep_href_link('address_book.php'), 'btn-light'); ?>
        <?php echo tep_draw_hidden_field('action', 'update').tep_draw_hidden_field('edit', $_GET['edit']).tep_draw_button(IMAGE_BUTTON_UPDATE, 'refresh', null, 'btn-primary'); ?>
      </div>

      <?php
    } else {
        if (\count($navigation->snapshot) > 0) {
            $back_link = tep_href_link($navigation->snapshot['page'], tep_array_to_string($navigation->snapshot['get'], [tep_session_name()]), $navigation->snapshot['mode']);
        } else {
            $back_link = tep_href_link('address_book.php');
        }

        ?>

      <div class="btn-toolbar justify-content-between">
        <?php echo tep_draw_button(IMAGE_BUTTON_BACK, 'triangle-1-w', $back_link, 'btn-light'); ?>
        <?php echo tep_draw_hidden_field('action', 'process').tep_draw_button(IMAGE_BUTTON_CONTINUE, 'triangle-1-e', null, 'btn-primary'); ?>
      </div>

      <?php
    }

    ?>

  </div>

  </form>

  <?php
}

?>

<?php
require 'includes/template_bottom.php';

require 'includes/application_bottom.php';
