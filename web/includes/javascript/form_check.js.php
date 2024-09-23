<?php
/*
  $Id: form_check.js.php,v 1.9 2003/05/19 19:50:14 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/
?>
<script><!--
var form = "";
var submitted = false;
var error = false;
var error_message = "";

function check_input(field_name, field_size, message) {
  if (form.elements[field_name] && (form.elements[field_name].type != "hidden")) {
    var field_value = form.elements[field_name].value;

    if ((field_value.length < field_size)||(field_value.indexOf("<?php echo(html_entity_decode(TEXT_LABEL_INPUT . tep_output_string($value))) ?>")>-1)) {
      error_message = error_message + "* " + message +"\n";
      error = true;
    }
  }
}

function check_radio(field_name, message) {
  var isChecked = false;

  if (form.elements[field_name] && (form.elements[field_name].type != "hidden")) {
    var radio = form.elements[field_name];

    for (var i=0; i<radio.length; i++) {
      if (radio[i].checked == true) {
        isChecked = true;
        break;
      }
    }

    if (isChecked == false) {
      error_message = error_message + "* " + message + "\n";
      error = true;
    }
  }
}

function check_select(field_name, field_default, message) {
  if (form.elements[field_name] && (form.elements[field_name].type != "hidden")) {
    var field_value = form.elements[field_name].value;

    if (field_value == field_default) {
      error_message = error_message + "* " + message + "\n";
      error = true;
    }
  }
}

function check_password(field_name_1, field_name_2, field_size, message_1, message_2) {
  if (form.elements[field_name_1] && (form.elements[field_name_1].type != "hidden")) {
    var password = form.elements[field_name_1].value;
    var confirmation = form.elements[field_name_2].value;

    if (password.length < field_size) {
      error_message = error_message + "* " + message_1 + "\n";
      error = true;
    } else if (password != confirmation) {
      error_message = error_message + "* " + message_2 + "\n";
      error = true;
    }
  }
}

function check_password_new(field_name_1, field_name_2, field_name_3, field_size, message_1, message_2, message_3) {
  if (form.elements[field_name_1] && (form.elements[field_name_1].type != "hidden")) {
    var password_current = form.elements[field_name_1].value;
    var password_new = form.elements[field_name_2].value;
    var password_confirmation = form.elements[field_name_3].value;

    if (password_current.length < field_size) {
      error_message = error_message + "* " + message_1 + "\n";
      error = true;
    } else if (password_new.length < field_size) {
      error_message = error_message + "* " + message_2 + "\n";
      error = true;
    } else if (password_new != password_confirmation) {
      error_message = error_message + "* " + message_3 + "\n";
      error = true;
    }
  }
}

function check_form(form_name) {
  if (submitted == true) {
    alert("<?php echo (html_entity_decode(JS_ERROR_SUBMITTED)); ?>");
    return false;
  }

  error = false;
  form = form_name;
  error_message = "<?php echo (html_entity_decode(JS_ERROR)); ?>";

<?php if (ACCOUNT_GENDER == 'true') echo '  check_radio("gender", "' . html_entity_decode(ENTRY_GENDER_ERROR) . '");' . "\n"; ?>

  check_input("firstname", <?php echo ENTRY_FIRST_NAME_MIN_LENGTH; ?>, "<?php echo (html_entity_decode(ENTRY_FIRST_NAME_ERROR)); ?>");
  check_input("lastname", <?php echo ENTRY_LAST_NAME_MIN_LENGTH; ?>, "<?php echo (html_entity_decode(ENTRY_LAST_NAME_ERROR)); ?>");

<?php if (ACCOUNT_DOB == 'true') echo '  check_input("dob", ' . ENTRY_DOB_MIN_LENGTH . ', "' . (html_entity_decode(ENTRY_DATE_OF_BIRTH_ERROR)) . '");' . "\n"; ?>

  check_input("email_address", <?php echo ENTRY_EMAIL_ADDRESS_MIN_LENGTH; ?>, "<?php echo (html_entity_decode(ENTRY_EMAIL_ADDRESS_ERROR)); ?>");
  check_input("street_address", <?php echo ENTRY_STREET_ADDRESS_MIN_LENGTH; ?>, "<?php echo (html_entity_decode(ENTRY_STREET_ADDRESS_ERROR)); ?>");
  check_input("postcode", <?php echo ENTRY_POSTCODE_MIN_LENGTH; ?>, "<?php echo (html_entity_decode(ENTRY_POST_CODE_ERROR)); ?>");
  check_input("city", <?php echo ENTRY_CITY_MIN_LENGTH; ?>, "<?php echo (html_entity_decode(ENTRY_CITY_ERROR)); ?>");

<?php if (ACCOUNT_STATE == 'true') echo '  check_input("state", ' . ENTRY_STATE_MIN_LENGTH . ', "' . html_entity_decode(ENTRY_STATE_ERROR) . '");' . "\n"; ?>

  check_select("country", "", "<?php echo (html_entity_decode(ENTRY_COUNTRY_ERROR)); ?>");

  check_input("telephone", <?php echo ENTRY_TELEPHONE_MIN_LENGTH; ?>, "<?php echo (html_entity_decode(ENTRY_TELEPHONE_NUMBER_ERROR)); ?>");

<?php if ((ACCOUNT_CF_REQ == 'true') && ((int)$country == '105')) echo '  check_input("cf", 0, "' . html_entity_decode(ENTRY_CF_ERROR) . '");' . "\n"; ?>
<?php if ((ACCOUNT_PIVA_REQ == 'true') && ((int)$country == '105')) echo '  check_input("pivae", 0, "' . html_entity_decode(ENTRY_PIVA_ERROR) . '");' . "\n"; ?>

  check_password("password", "confirmation", <?php echo ENTRY_PASSWORD_MIN_LENGTH; ?>, "<?php echo (html_entity_decode(ENTRY_PASSWORD_ERROR)); ?>", "<?php echo (html_entity_decode(ENTRY_PASSWORD_ERROR_NOT_MATCHING)); ?>");
  check_password_new("password_current", "password_new", "password_confirmation", <?php echo (html_entity_decode(ENTRY_PASSWORD_MIN_LENGTH)); ?>, "<?php echo (html_entity_decode(ENTRY_PASSWORD_ERROR)); ?>", "<?php echo (html_entity_decode(ENTRY_PASSWORD_NEW_ERROR)); ?>", "<?php echo (html_entity_decode(ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING)); ?>");

  if (error == true) {
    alert(error_message);
    return false;
  } else {
    submitted = true;
    return true;
  }
}

function RemoveFormatString(TargetElement, FormatString) {
  if (TargetElement.value == FormatString) {
    TargetElement.value = "";
  }

  TargetElement.select();
}

//--></script>
