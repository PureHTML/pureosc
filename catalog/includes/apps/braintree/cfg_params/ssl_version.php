<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2017 osCommerce

  Released under the GNU General Public License
*/

class OSCOM_Braintree_Cfg_ssl_version {
  public $default = '0';
  public $title;
  public $description;
  public $sort_order = 350;

  public function __construct() {
    global $OSCOM_Braintree;

    $this->title = $OSCOM_Braintree->getDef('cfg_ssl_version_title');
    $this->description = $OSCOM_Braintree->getDef('cfg_ssl_version_desc');
  }

  public function getSetField() {
    global $OSCOM_Braintree;

    $info_url = 'https://library.oscommerce.com/Package&braintree&oscom23&ssl_version';

    $test_button = $OSCOM_Braintree->drawButton($OSCOM_Braintree->getDef('cfg_ssl_version_button_connection_test'), '#', 'warning', 'data-button="sslVersionTestButton"');
    $info_button = addslashes($OSCOM_Braintree->drawButton($OSCOM_Braintree->getDef('cfg_ssl_version_button_more_info'), $info_url, 'info'));

    $dialog_connection_test_title = addslashes($OSCOM_Braintree->getDef('cfg_ssl_version_dialog_connection_test_title'));
    $dialog_connection_test_button_more_info = addslashes($OSCOM_Braintree->getDef('cfg_ssl_version_dialog_button_more_info'));
    $dialog_connection_test_button_close = addslashes($OSCOM_Braintree->getDef('cfg_ssl_version_dialog_button_close'));
    $dialog_connection_test_processing = addslashes($OSCOM_Braintree->getDef('cfg_ssl_version_dialog_processing'));
    $dialog_connection_test_curl_version = addslashes($OSCOM_Braintree->getDef('cfg_ssl_version_dialog_curl_version'));
    $dialog_connection_test_curl_ssl_version = addslashes($OSCOM_Braintree->getDef('cfg_ssl_version_dialog_curl_ssl_version'));
    $dialog_connection_test_default_setting = addslashes($OSCOM_Braintree->getDef('cfg_ssl_version_dialog_default_setting'));
    $dialog_connection_test_tlsv12_setting = addslashes($OSCOM_Braintree->getDef('cfg_ssl_version_dialog_tlsv12_setting'));
    $dialog_connection_test_success = addslashes($OSCOM_Braintree->getDef('cfg_ssl_version_dialog_success'));
    $dialog_connection_test_failed = addslashes($OSCOM_Braintree->getDef('cfg_ssl_version_dialog_failed'));
    $dialog_connection_test_default_failed = addslashes($OSCOM_Braintree->getDef('cfg_ssl_version_dialog_default_failed'));
    $dialog_connection_test_tlsv12_failed = addslashes($OSCOM_Braintree->getDef('cfg_ssl_version_dialog_tlsv12_failed'));
    $dialog_connection_test_general_error = addslashes($OSCOM_Braintree->getDef('cfg_ssl_version_dialog_general_error'));

    $has_json = function_exists('json_encode') ? 'true' : 'false';

    $input = '<input type="radio" id="sslVersionSelectionDefault" name="ssl_version" value="0"' . (OSCOM_APP_PAYPAL_BRAINTREE_SSL_VERSION == '0' ? ' checked="checked"' : '') . '><label for="sslVersionSelectionDefault">' . $OSCOM_Braintree->getDef('cfg_ssl_version_default') . '</label>' .
             '<input type="radio" id="sslVersionSelectionTls12" name="ssl_version" value="1"' . (OSCOM_APP_PAYPAL_BRAINTREE_SSL_VERSION == '1' ? ' checked="checked"' : '') . '><label for="sslVersionSelectionTls12">' . $OSCOM_Braintree->getDef('cfg_ssl_version_tls12') . '</label>';

    $connection_test_url = tep_href_link('braintree.php', 'action=ssltest');

    $result = <<<EOT
<div>
  <p>
    <label>{$this->title}</label>

    {$this->description}

    <small id="sslTestButton">{$test_button}</small>
  </p>

  <div id="sslVersionSelection">
    {$input}
  </div>
</div>

<div id="dialogSslTest" title="{$dialog_connection_test_title}"></div>

<script>
$(function() {
  $('#dialogSslTest').dialog({
    autoOpen: false,
    modal: true,
    buttons: {
      '{$dialog_connection_test_button_more_info}': function() {
        window.open('{$info_url}');
      },
      '{$dialog_connection_test_button_close}': function() {
        $(this).dialog('close');
      }
    }
  });

  $('#sslVersionSelection').buttonset();

  if ('{$has_json}' == 'true') {
    $('a[data-button="sslVersionTestButton"]').click(function(e) {
      e.preventDefault();

      $('#dialogSslTest').html('<p>{$dialog_connection_test_processing}</p>');

      $('#dialogSslTest').dialog('open');

      $.getJSON('{$connection_test_url}', function (data) {
        if ( (typeof data == 'object') && ('rpcStatus' in data) && (data.rpcStatus == 1) ) {
          var content = '<p>{$dialog_connection_test_curl_version} ' + data.curl_version + '<br />{$dialog_connection_test_curl_ssl_version} ' + data.curl_ssl_version + '</p><p>{$dialog_connection_test_default_setting} ';

          if (data.default == true) {
            content += '<span style="color: green; font-weight: bold;">{$dialog_connection_test_success}</span>';
          } else {
            content += '<span style="color: red; font-weight: bold;">{$dialog_connection_test_failed}</span>';
          }

          content += '<br />{$dialog_connection_test_tlsv12_setting} ';

          if (data.tlsv12 == true) {
            content += '<span style="color: green; font-weight: bold;">{$dialog_connection_test_success}</span>';
          } else {
            content += '<span style="color: red; font-weight: bold;">{$dialog_connection_test_failed}</span>';
          }

          content += '</p>';

          if (data.tlsv12 != true) {
            content += '<p>{$dialog_connection_test_tlsv12_failed}</p>';
          } else if (data.default != true) {
            content += '<p>{$dialog_connection_test_default_failed}</p>';
          }

          $('#dialogSslTest').html(content);
        } else {
          $('#dialogSslTest').html('<p>{$dialog_connection_test_general_error}</p>');
        }
      }).fail(function() {
        $('#dialogSslTest').html('<p>{$dialog_connection_test_general_error}</p>');
      });
    });
  } else {
    $('#sslTestButton').html('{$info_button}');
  }
});
</script>
EOT;

    return $result;
  }
}
