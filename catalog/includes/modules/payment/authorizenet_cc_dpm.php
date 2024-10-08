<?php

declare(strict_types=1);

/**
 * PureOSC, Open Source E-Commerce Solutions
 * https://pureosc.com
 *
 * Copyright (c) 2024 PureOSC
 *
 * Released under the GNU General Public License
 *
 * This file is part of the PureOSC package
 *
 *  (c) 2024 Šimon Formánek <mail@simonformanek.cz>
 *
 * https://pureosc.com/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * This file is part of the DvereCOM package.
 *
 *  (c) Šimon Formánek <mail@simonformanek.cz>
 * This file is part of the MultiFlexi package
 *
 * https://pureosc.com/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
class authorizenet_cc_dpm
{
    public $code;
    public $title;
    public $description;
    public $enabled;

    public function __construct()
    {
        global $order;

        $this->signature = 'authorizenet|authorizenet_cc_dpm|1.1|2.3';
        $this->api_version = '3.1';

        $this->code = 'authorizenet_cc_dpm';
        $this->title = MODULE_PAYMENT_AUTHORIZENET_CC_DPM_TEXT_TITLE;
        $this->public_title = MODULE_PAYMENT_AUTHORIZENET_CC_DPM_TEXT_PUBLIC_TITLE;
        $this->description = MODULE_PAYMENT_AUTHORIZENET_CC_DPM_TEXT_DESCRIPTION;
        $this->sort_order = \defined('MODULE_PAYMENT_AUTHORIZENET_CC_DPM_SORT_ORDER') ? MODULE_PAYMENT_AUTHORIZENET_CC_DPM_SORT_ORDER : 0;
        $this->enabled = \defined('MODULE_PAYMENT_AUTHORIZENET_CC_DPM_STATUS') && (MODULE_PAYMENT_AUTHORIZENET_CC_DPM_STATUS === 'True') ? true : false;
        $this->order_status = \defined('MODULE_PAYMENT_AUTHORIZENET_CC_DPM_ORDER_STATUS_ID') && ((int) MODULE_PAYMENT_AUTHORIZENET_CC_DPM_ORDER_STATUS_ID > 0) ? (int) MODULE_PAYMENT_AUTHORIZENET_CC_DPM_ORDER_STATUS_ID : 0;

        if (\defined('MODULE_PAYMENT_AUTHORIZENET_CC_DPM_STATUS')) {
            if ((MODULE_PAYMENT_AUTHORIZENET_CC_DPM_TRANSACTION_SERVER === 'Test') || (MODULE_PAYMENT_AUTHORIZENET_CC_DPM_TRANSACTION_MODE === 'Test')) {
                $this->title .= ' [Test]';
                $this->public_title .= ' ('.$this->code.'; Test)';
            }

            if (MODULE_PAYMENT_AUTHORIZENET_CC_DPM_TRANSACTION_SERVER === 'Live') {
                $this->form_action_url = 'https://secure.authorize.net/gateway/transact.dll';
            } else {
                $this->form_action_url = 'https://test.authorize.net/gateway/transact.dll';
            }
        }

        if ($this->enabled === true) {
            if (empty(MODULE_PAYMENT_AUTHORIZENET_CC_DPM_LOGIN_ID) || empty(MODULE_PAYMENT_AUTHORIZENET_CC_DPM_TRANSACTION_KEY)) {
                $this->description = '<div class="secWarning">'.MODULE_PAYMENT_AUTHORIZENET_CC_DPM_ERROR_ADMIN_CONFIGURATION.'</div>'.$this->description;

                $this->enabled = false;
            }
        }

        if ($this->enabled === true) {
            if (isset($order) && \is_object($order)) {
                $this->update_status();
            }
        }
    }

    public function update_status(): void
    {
        global $order;

        if (($this->enabled === true) && ((int) MODULE_PAYMENT_AUTHORIZENET_CC_DPM_ZONE > 0)) {
            $check_flag = false;
            $check_query = tep_db_query("select zone_id from zones_to_geo_zones where geo_zone_id = '".MODULE_PAYMENT_AUTHORIZENET_CC_DPM_ZONE."' and zone_country_id = '".(int) $order->billing['country']['id']."' order by zone_id");

            while ($check = tep_db_fetch_array($check_query)) {
                if ($check['zone_id'] < 1) {
                    $check_flag = true;

                    break;
                }

                if ($check['zone_id'] === $order->billing['zone_id']) {
                    $check_flag = true;

                    break;
                }
            }

            if ($check_flag === false) {
                $this->enabled = false;
            }
        }
    }

    public function javascript_validation()
    {
        return false;
    }

    public function selection()
    {
        return ['id' => $this->code,
            'module' => $this->public_title];
    }

    public function pre_confirmation_check()
    {
        return false;
    }

    public function confirmation()
    {
        global $order;

        $expiry_field = '<select id="cc_expires_month">';

        for ($i = 1; $i < 13; ++$i) {
            $expiry_field .= '<option value="'.sprintf('%02d', $i).'">'.sprintf('%02d', $i).'</option>';
        }

        $expiry_field .= '</select>&nbsp;<select id="cc_expires_year">';

        $today = getdate();

        for ($i = $today['year']; $i < $today['year'] + 10; ++$i) {
            $expiry_field .= '<option value="'.strftime('%y', mktime(0, 0, 0, 1, 1, $i)).'">'.strftime('%Y', mktime(0, 0, 0, 1, 1, $i)).'</option>';
        }

        $expiry_field .= '</select>'.tep_draw_hidden_field('x_exp_date');

        $js = <<<'EOD'
<script>
if ( typeof jQuery == 'undefined' ) {
  document.write('<scr' + 'ipt src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></scr' + 'ipt>');
}
</script>

<script>
$(function() {
  $('form[name="checkout_confirmation"]').submit(function() {
    $('form[name="checkout_confirmation"] input[name="x_exp_date"]').val($('#cc_expires_month').val() + $('#cc_expires_year').val());
  });
});
</script>
EOD;

        $expiry_field .= $js;

        $confirmation = ['fields' => [['title' => MODULE_PAYMENT_AUTHORIZENET_CC_DPM_CREDIT_CARD_OWNER_FIRSTNAME,
            'field' => tep_draw_input_field('x_first_name', $order->billing['firstname'])],
            ['title' => MODULE_PAYMENT_AUTHORIZENET_CC_DPM_CREDIT_CARD_OWNER_LASTNAME,
                'field' => tep_draw_input_field('x_last_name', $order->billing['lastname'])],
            ['title' => MODULE_PAYMENT_AUTHORIZENET_CC_DPM_CREDIT_CARD_NUMBER,
                'field' => tep_draw_input_field('x_card_num')],
            ['title' => MODULE_PAYMENT_AUTHORIZENET_CC_DPM_CREDIT_CARD_EXPIRES,
                'field' => $expiry_field],
            ['title' => MODULE_PAYMENT_AUTHORIZENET_CC_DPM_CREDIT_CARD_CCV,
                'field' => tep_draw_input_field('x_card_code', '', 'size="5" maxlength="4"')]]];

        return $confirmation;
    }

    public function process_button()
    {
        global $customer_id, $order, $sendto, $currency;

        $tstamp = time();
        $sequence = mt_rand(1, 1000);

        $params = ['x_login' => substr(MODULE_PAYMENT_AUTHORIZENET_CC_DPM_LOGIN_ID, 0, 20),
            'x_version' => $this->api_version,
            'x_show_form' => 'PAYMENT_FORM',
            'x_delim_data' => 'FALSE',
            'x_relay_response' => 'TRUE',
            'x_relay_url' => tep_href_link('checkout_process.php', '', 'SSL', false),
            'x_company' => substr($order->billing['company'], 0, 50),
            'x_address' => substr($order->billing['street_address'], 0, 60),
            'x_city' => substr($order->billing['city'], 0, 40),
            'x_state' => substr($order->billing['state'], 0, 40),
            'x_zip' => substr($order->billing['postcode'], 0, 20),
            'x_country' => substr($order->billing['country']['title'], 0, 60),
            'x_phone' => substr(preg_replace('/[^0-9]/', '', $order->customer['telephone']), 0, 25),
            'x_cust_id' => substr($customer_id, 0, 20),
            'x_customer_ip' => tep_get_ip_address(),
            'x_email' => substr($order->customer['email_address'], 0, 255),
            'x_description' => substr(STORE_NAME, 0, 255),
            'x_amount' => $this->format_raw($order->info['total']),
            'x_currency_code' => substr($currency, 0, 3),
            'x_method' => 'CC',
            'x_type' => MODULE_PAYMENT_AUTHORIZENET_CC_DPM_TRANSACTION_METHOD === 'Capture' ? 'AUTH_CAPTURE' : 'AUTH_ONLY',
            'x_freight' => $this->format_raw($order->info['shipping_cost']),
            'x_fp_sequence' => $sequence,
            'x_fp_timestamp' => $tstamp,
            'x_fp_hash' => $this->_hmac(MODULE_PAYMENT_AUTHORIZENET_CC_DPM_TRANSACTION_KEY, MODULE_PAYMENT_AUTHORIZENET_CC_DPM_LOGIN_ID.'^'.$sequence.'^'.$tstamp.'^'.$this->format_raw($order->info['total']).'^'.$currency),
            'x_cancel_url' => tep_href_link('shopping_cart.php'),
            'x_cancel_url_text' => MODULE_PAYMENT_AUTHORIZENET_CC_DPM_TEXT_RETURN_BUTTON];

        if (is_numeric($sendto) && ($sendto > 0)) {
            $params['x_ship_to_first_name'] = substr($order->delivery['firstname'], 0, 50);
            $params['x_ship_to_last_name'] = substr($order->delivery['lastname'], 0, 50);
            $params['x_ship_to_company'] = substr($order->delivery['company'], 0, 50);
            $params['x_ship_to_address'] = substr($order->delivery['street_address'], 0, 60);
            $params['x_ship_to_city'] = substr($order->delivery['city'], 0, 40);
            $params['x_ship_to_state'] = substr($order->delivery['state'], 0, 40);
            $params['x_ship_to_zip'] = substr($order->delivery['postcode'], 0, 20);
            $params['x_ship_to_country'] = substr($order->delivery['country']['title'], 0, 60);
        }

        if (MODULE_PAYMENT_AUTHORIZENET_CC_DPM_TRANSACTION_MODE === 'Test') {
            $params['x_test_request'] = 'TRUE';
        }

        $tax_value = 0;

        foreach ($order->info['tax_groups'] as $value) {
            if ($value > 0) {
                $tax_value += $this->format_raw($value);
            }
        }

        if ($tax_value > 0) {
            $params['x_tax'] = $this->format_raw($tax_value);
        }

        $process_button_string = '';

        foreach ($params as $key => $value) {
            $process_button_string .= tep_draw_hidden_field($key, $value);
        }

        for ($i = 0, $n = \count($order->products); $i < $n; ++$i) {
            $process_button_string .= tep_draw_hidden_field('x_line_item', ($i + 1).'<|>'.substr($order->products[$i]['name'], 0, 31).'<|><|>'.$order->products[$i]['qty'].'<|>'.$this->format_raw($order->products[$i]['final_price']).'<|>'.($order->products[$i]['tax'] > 0 ? 'YES' : 'NO'));
        }

        $process_button_string .= tep_draw_hidden_field(tep_session_name(), tep_session_id());

        return $process_button_string;
    }

    public function before_process(): void
    {
        global $order, $authorizenet_cc_dpm_error;

        $error = false;
        $authorizenet_cc_dpm_error = false;

        $check_array = ['x_response_code',
            'x_response_reason_text',
            'x_trans_id',
            'x_amount'];

        foreach ($check_array as $check) {
            if (!isset($_POST[$check]) || !\is_string($_POST[$check]) || ($_POST[$check] === '')) {
                $error = 'general';

                break;
            }
        }

        if ($error === false) {
            if (($_POST['x_response_code'] === '1') || ($_POST['x_response_code'] === '4')) {
                if (!empty(MODULE_PAYMENT_AUTHORIZENET_CC_DPM_MD5_HASH) && (!isset($_POST['x_MD5_Hash']) || (strtoupper($_POST['x_MD5_Hash']) !== strtoupper(md5(MODULE_PAYMENT_AUTHORIZENET_CC_DPM_MD5_HASH.MODULE_PAYMENT_AUTHORIZENET_CC_DPM_LOGIN_ID.$_POST['x_trans_id'].$this->format_raw($order->info['total'])))))) {
                    $error = 'verification';
                } elseif ($_POST['x_amount'] !== $this->format_raw($order->info['total'])) {
                    $error = 'verification';
                }

                if (($error === false) && ($_POST['x_response_code'] === '4')) {
                    if (MODULE_PAYMENT_AUTHORIZENET_CC_DPM_REVIEW_ORDER_STATUS_ID > 0) {
                        $order->info['order_status'] = MODULE_PAYMENT_AUTHORIZENET_CC_DPM_REVIEW_ORDER_STATUS_ID;
                    }
                }
            } elseif ($_POST['x_response_code'] === '2') {
                $error = 'declined';
            } else {
                $error = 'general';
            }
        }

        if ($error !== false) {
            $this->sendDebugEmail();

            $authorizenet_cc_dpm_error = $_POST['x_response_reason_text'];
            tep_session_register('authorizenet_cc_dpm_error');

            tep_redirect(tep_href_link('checkout_payment.php', 'payment_error='.$this->code.'&error='.$error));
        }

        if (isset($_SESSION['authorizenet_cc_dpm_error'])) {
            unset($_SESSION['authorizenet_cc_dpm_error']);
        }
    }

    public function after_process(): void
    {
        global $insert_id;

        $response = ['Response: '.tep_db_prepare_input($_POST['x_response_reason_text']).' ('.tep_db_prepare_input($_POST['x_response_reason_code']).')',
            'Transaction ID: '.tep_db_prepare_input($_POST['x_trans_id'])];

        $avs_response = '?';

        if (isset($_POST['x_avs_code']) && \is_string($_POST['x_avs_code']) && !empty($_POST['x_avs_code'])) {
            if (\defined('MODULE_PAYMENT_AUTHORIZENET_CC_DPM_TEXT_AVS_'.$_POST['x_avs_code'])) {
                $avs_response = \constant('MODULE_PAYMENT_AUTHORIZENET_CC_DPM_TEXT_AVS_'.$_POST['x_avs_code']).' ('.$_POST['x_avs_code'].')';
            } else {
                $avs_response = $_POST['x_avs_code'];
            }
        }

        $response[] = 'AVS: '.tep_db_prepare_input($avs_response);

        $cvv2_response = '?';

        if (isset($_POST['x_cvv2_resp_code']) && \is_string($_POST['x_cvv2_resp_code']) && !empty($_POST['x_cvv2_resp_code'])) {
            if (\defined('MODULE_PAYMENT_AUTHORIZENET_CC_DPM_TEXT_CVV2_'.$_POST['x_cvv2_resp_code'])) {
                $cvv2_response = \constant('MODULE_PAYMENT_AUTHORIZENET_CC_DPM_TEXT_CVV2_'.$_POST['x_cvv2_resp_code']).' ('.$_POST['x_cvv2_resp_code'].')';
            } else {
                $cvv2_response = $_POST['x_cvv2_resp_code'];
            }
        }

        $response[] = 'Card Code: '.tep_db_prepare_input($cvv2_response);

        $cavv_response = '?';

        if (isset($_POST['x_cavv_response']) && \is_string($_POST['x_cavv_response']) && !empty($_POST['x_cavv_response'])) {
            if (\defined('MODULE_PAYMENT_AUTHORIZENET_CC_DPM_TEXT_CAVV_'.$_POST['x_cavv_response'])) {
                $cavv_response = \constant('MODULE_PAYMENT_AUTHORIZENET_CC_DPM_TEXT_CAVV_'.$_POST['x_cavv_response']).' ('.$_POST['x_cavv_response'].')';
            } else {
                $cavv_response = $_POST['x_cavv_response'];
            }
        }

        $response[] = 'Card Holder: '.tep_db_prepare_input($cavv_response);

        $sql_data_array = ['orders_id' => $insert_id,
            'orders_status_id' => MODULE_PAYMENT_AUTHORIZENET_CC_DPM_TRANSACTION_ORDER_STATUS_ID,
            'date_added' => 'now()',
            'customer_notified' => '0',
            'comments' => implode("\n", $response)];

        tep_db_perform('orders_status_history', $sql_data_array);

        if (ENABLE_SSL !== true) {
            global $cart;

            $cart->reset(true);

            // unregister session variables used during checkout
            unset($_SESSION['sendto'], $_SESSION['billto'], $_SESSION['shipping'], $_SESSION['payment'], $_SESSION['comments']);

            $redirect_url = tep_href_link('checkout_success.php');

            echo <<<EOD
<form name="redirect" action="{$redirect_url}" method="post" target="_top">
<noscript>
  <p>The transaction is being finalized. Please click continue to finalize your order.</p>
  <p><input type="submit" value="Continue" /></p>
</noscript>
</form>
<script>
document.redirect.submit();
</script>
EOD;

            exit;
        }
    }

    public function get_error()
    {
        global $authorizenet_cc_dpm_error;

        $error_message = MODULE_PAYMENT_AUTHORIZENET_CC_DPM_ERROR_GENERAL;

        switch ($_GET['error']) {
            case 'verification':
                $error_message = MODULE_PAYMENT_AUTHORIZENET_CC_DPM_ERROR_VERIFICATION;

                break;
            case 'declined':
                $error_message = MODULE_PAYMENT_AUTHORIZENET_CC_DPM_ERROR_DECLINED;

                break;

            default:
                $error_message = MODULE_PAYMENT_AUTHORIZENET_CC_DPM_ERROR_GENERAL;

                break;
        }

        if (($_GET['error'] !== 'verification') && isset($_SESSION['authorizenet_cc_dpm_error'])) {
            $error_message = $authorizenet_cc_dpm_error;

            unset($_SESSION['authorizenet_cc_dpm_error']);
        }

        $error = ['title' => MODULE_PAYMENT_AUTHORIZENET_CC_DPM_ERROR_TITLE,
            'error' => $error_message];

        return $error;
    }

    public function check()
    {
        if (!isset($this->_check)) {
            $check_query = tep_db_query("select configuration_value from configuration where configuration_key = 'MODULE_PAYMENT_AUTHORIZENET_CC_DPM_STATUS'");
            $this->_check = tep_db_num_rows($check_query);
        }

        return $this->_check;
    }

    public function install($parameter = null): void
    {
        $params = $this->getParams();

        if (isset($parameter)) {
            if (isset($params[$parameter])) {
                $params = [$parameter => $params[$parameter]];
            } else {
                $params = [];
            }
        }

        foreach ($params as $key => $data) {
            $sql_data_array = ['configuration_title' => $data['title'],
                'configuration_key' => $key,
                'configuration_value' => ($data['value'] ?? ''),
                'configuration_description' => $data['desc'],
                'configuration_group_id' => '6',
                'sort_order' => '0',
                'date_added' => 'now()'];

            if (isset($data['set_func'])) {
                $sql_data_array['set_function'] = $data['set_func'];
            }

            if (isset($data['use_func'])) {
                $sql_data_array['use_function'] = $data['use_func'];
            }

            tep_db_perform('configuration', $sql_data_array);
        }
    }

    public function remove(): void
    {
        tep_db_query("delete from configuration where configuration_key in ('".implode("', '", $this->keys())."')");
    }

    public function keys()
    {
        $keys = array_keys($this->getParams());

        if ($this->check()) {
            foreach ($keys as $key) {
                if (!\defined($key)) {
                    $this->install($key);
                }
            }
        }

        return $keys;
    }

    public function getParams()
    {
        if (!\defined('MODULE_PAYMENT_AUTHORIZENET_CC_DPM_TRANSACTION_ORDER_STATUS_ID')) {
            $check_query = tep_db_query("select orders_status_id from orders_status where orders_status_name = 'Authorize.net [Transactions]' limit 1");

            if (tep_db_num_rows($check_query) < 1) {
                $status_query = tep_db_query('select max(orders_status_id) as status_id from orders_status');
                $status = tep_db_fetch_array($status_query);

                $status_id = $status['status_id'] + 1;

                $languages = tep_get_languages();

                foreach ($languages as $lang) {
                    tep_db_query("insert into orders_status (orders_status_id, language_id, orders_status_name) values ('".$status_id."', '".$lang['id']."', 'Authorize.net [Transactions]')");
                }

                $flags_query = tep_db_query('describe orders_status public_flag');

                if (tep_db_num_rows($flags_query) === 1) {
                    tep_db_query("update orders_status set public_flag = 0 and downloads_flag = 0 where orders_status_id = '".(int) $status_id."'");
                }
            } else {
                $check = tep_db_fetch_array($check_query);

                $status_id = $check['orders_status_id'];
            }
        } else {
            $status_id = MODULE_PAYMENT_AUTHORIZENET_CC_DPM_TRANSACTION_ORDER_STATUS_ID;
        }

        return ['MODULE_PAYMENT_AUTHORIZENET_CC_DPM_STATUS' => ['title' => 'Enable Authorize.net Direct Post Method',
            'desc' => 'Do you want to accept Authorize.net Direct Post Method payments?',
            'value' => 'True',
            'set_func' => 'tep_cfg_select_option(array(\'True\', \'False\'), '],
            'MODULE_PAYMENT_AUTHORIZENET_CC_DPM_LOGIN_ID' => ['title' => 'API Login ID',
                'desc' => 'The API Login ID used for the Authorize.net service'],
            'MODULE_PAYMENT_AUTHORIZENET_CC_DPM_TRANSACTION_KEY' => ['title' => 'API Transaction Key',
                'desc' => 'The API Transaction Key used for the Authorize.net service'],
            'MODULE_PAYMENT_AUTHORIZENET_CC_DPM_MD5_HASH' => ['title' => 'MD5 Hash',
                'desc' => 'The MD5 Hash value to verify transactions with'],
            'MODULE_PAYMENT_AUTHORIZENET_CC_DPM_TRANSACTION_METHOD' => ['title' => 'Transaction Method',
                'desc' => 'The processing method to use for each transaction.',
                'value' => 'Authorization',
                'set_func' => 'tep_cfg_select_option(array(\'Authorization\', \'Capture\'), '],
            'MODULE_PAYMENT_AUTHORIZENET_CC_DPM_ORDER_STATUS_ID' => ['title' => 'Set Order Status',
                'desc' => 'Set the status of orders made with this payment module to this value',
                'value' => '0',
                'use_func' => 'tep_get_order_status_name',
                'set_func' => 'tep_cfg_pull_down_order_statuses('],
            'MODULE_PAYMENT_AUTHORIZENET_CC_DPM_REVIEW_ORDER_STATUS_ID' => ['title' => 'Review Order Status',
                'desc' => 'Set the status of orders flagged as being under review to this value',
                'value' => '0',
                'use_func' => 'tep_get_order_status_name',
                'set_func' => 'tep_cfg_pull_down_order_statuses('],
            'MODULE_PAYMENT_AUTHORIZENET_CC_DPM_TRANSACTION_ORDER_STATUS_ID' => ['title' => 'Transaction Order Status',
                'desc' => 'Include transaction information in this order status level',
                'value' => $status_id,
                'use_func' => 'tep_get_order_status_name',
                'set_func' => 'tep_cfg_pull_down_order_statuses('],
            'MODULE_PAYMENT_AUTHORIZENET_CC_DPM_ZONE' => ['title' => 'Payment Zone',
                'desc' => 'If a zone is selected, only enable this payment method for that zone.',
                'value' => '0',
                'set_func' => 'tep_cfg_pull_down_zone_classes(',
                'use_func' => 'tep_get_zone_class_title'],
            'MODULE_PAYMENT_AUTHORIZENET_CC_DPM_TRANSACTION_SERVER' => ['title' => 'Transaction Server',
                'desc' => 'Perform transactions on the live or test server. The test server should only be used by developers with Authorize.net test accounts.',
                'value' => 'Live',
                'set_func' => 'tep_cfg_select_option(array(\'Live\', \'Test\'), '],
            'MODULE_PAYMENT_AUTHORIZENET_CC_DPM_TRANSACTION_MODE' => ['title' => 'Transaction Mode',
                'desc' => 'Transaction mode used for processing orders',
                'value' => 'Live',
                'set_func' => 'tep_cfg_select_option(array(\'Live\', \'Test\'), '],
            'MODULE_PAYMENT_AUTHORIZENET_CC_DPM_DEBUG_EMAIL' => ['title' => 'Debug E-Mail Address',
                'desc' => 'All parameters of an invalid transaction will be sent to this email address.'],
            'MODULE_PAYMENT_AUTHORIZENET_CC_DPM_SORT_ORDER' => ['title' => 'Sort order of display.',
                'desc' => 'Sort order of display. Lowest is displayed first.',
                'value' => '0']];
    }

    public function _hmac($key, $data)
    {
        if (\function_exists('hash_hmac')) {
            return hash_hmac('md5', $data, $key);
        }

        if (\function_exists('mhash') && \defined('MHASH_MD5')) {
            return bin2hex(mhash(\MHASH_MD5, $data, $key));
        }

        // RFC 2104 HMAC implementation for php.
        // Creates an md5 HMAC.
        // Eliminates the need to install mhash to compute a HMAC
        // Hacked by Lance Rushing

        $b = 64; // byte length for md5

        if (\strlen($key) > $b) {
            $key = pack('H*', md5($key));
        }

        $key = str_pad($key, $b, \chr(0x00));
        $ipad = str_pad('', $b, \chr(0x36));
        $opad = str_pad('', $b, \chr(0x5C));
        $k_ipad = $key ^ $ipad;
        $k_opad = $key ^ $opad;

        return md5($k_opad.pack('H*', md5($k_ipad.$data)));
    }

    // format prices without currency formatting
    public function format_raw($number, $currency_code = '', $currency_value = '')
    {
        global $currencies, $currency;

        if (empty($currency_code) || !$this->is_set($currency_code)) {
            $currency_code = $currency;
        }

        if (empty($currency_value) || !is_numeric($currency_value)) {
            $currency_value = $currencies->currencies[$currency_code]['value'];
        }

        return number_format(tep_round($number * $currency_value, $currencies->currencies[$currency_code]['decimal_places']), $currencies->currencies[$currency_code]['decimal_places'], '.', '');
    }

    public function sendDebugEmail($response = []): void
    {
        if (!empty(MODULE_PAYMENT_AUTHORIZENET_CC_DPM_DEBUG_EMAIL)) {
            $email_body = '';

            if (!empty($response)) {
                $email_body .= "RESPONSE:\n\n".print_r($response, true)."\n\n";
            }

            if (!empty($_POST)) {
                $email_body .= '$_POST:'."\n\n".print_r($_POST, true)."\n\n";
            }

            if (!empty($_GET)) {
                $email_body .= '$_GET:'."\n\n".print_r($_GET, true)."\n\n";
            }

            if (!empty($email_body)) {
                tep_mail('', MODULE_PAYMENT_AUTHORIZENET_CC_DPM_DEBUG_EMAIL, 'Authorize.net DPM Debug E-Mail', trim($email_body), STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
            }
        }
    }
}
