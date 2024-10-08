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

if (!class_exists('OSCOM_PayPal')) {
    include DIR_FS_CATALOG.'includes/apps/paypal/OSCOM_PayPal.php';
}

class paypal_pro_dp
{
    public $code;
    public $title;
    public $description;
    public $enabled;
    public $_app;

    public function __construct()
    {
        global $order;

        $this->_app = new OSCOM_PayPal();
        $this->_app->loadLanguageFile('modules/DP/DP.php');

        $this->signature = 'paypal|paypal_pro_dp|'.$this->_app->getVersion().'|2.3';
        $this->api_version = $this->_app->getApiVersion();

        $this->code = 'paypal_pro_dp';
        $this->title = $this->_app->getDef('module_dp_title');
        $this->public_title = $this->_app->getDef('module_dp_public_title');
        $this->description = '<div align="center">'.$this->_app->drawButton($this->_app->getDef('module_dp_legacy_admin_app_button'), tep_href_link('paypal.php', 'action=configure&module=DP'), 'primary', null, true).'</div>';
        $this->sort_order = \defined('OSCOM_APP_PAYPAL_DP_SORT_ORDER') ? OSCOM_APP_PAYPAL_DP_SORT_ORDER : 0;
        $this->enabled = \defined('OSCOM_APP_PAYPAL_DP_STATUS') && \in_array(OSCOM_APP_PAYPAL_DP_STATUS, ['1', '0'], true) ? true : false;
        $this->order_status = \defined('OSCOM_APP_PAYPAL_DP_ORDER_STATUS_ID') && ((int) OSCOM_APP_PAYPAL_DP_ORDER_STATUS_ID > 0) ? (int) OSCOM_APP_PAYPAL_DP_ORDER_STATUS_ID : 0;

        if (!\defined('MODULE_PAYMENT_INSTALLED') || empty(MODULE_PAYMENT_INSTALLED) || !\in_array('paypal_express.php', explode(';', MODULE_PAYMENT_INSTALLED), true) || !\defined('OSCOM_APP_PAYPAL_EC_STATUS') || !\in_array(OSCOM_APP_PAYPAL_EC_STATUS, ['1', '0'], true)) {
            $this->description .= '<div class="secWarning">'.$this->_app->getDef('module_dp_error_express_module').'</div>';

            $this->enabled = false;
        }

        if (\defined('OSCOM_APP_PAYPAL_DP_STATUS')) {
            if (OSCOM_APP_PAYPAL_DP_STATUS === '0') {
                $this->title .= ' [Sandbox]';
                $this->public_title .= ' ('.$this->code.'; Sandbox)';
            }
        }

        if (!\function_exists('curl_init')) {
            $this->description .= '<div class="secWarning">'.$this->_app->getDef('module_dp_error_curl').'</div>';

            $this->enabled = false;
        }

        if ($this->enabled === true) {
            if (OSCOM_APP_PAYPAL_GATEWAY === '1') { // PayPal
                if (!$this->_app->hasCredentials('DP')) {
                    $this->description .= '<div class="secWarning">'.$this->_app->getDef('module_dp_error_credentials').'</div>';

                    $this->enabled = false;
                }
            } else { // Payflow
                if (!$this->_app->hasCredentials('DP', 'payflow')) {
                    $this->description .= '<div class="secWarning">'.$this->_app->getDef('module_dp_error_credentials_payflow').'</div>';

                    $this->enabled = false;
                }
            }
        }

        if ($this->enabled === true) {
            if (isset($order) && \is_object($order)) {
                $this->update_status();
            }
        }

        $this->cc_types = ['VISA' => 'Visa',
            'MASTERCARD' => 'MasterCard',
            'DISCOVER' => 'Discover Card',
            'AMEX' => 'American Express',
            'MAESTRO' => 'Maestro'];
    }

    public function update_status(): void
    {
        global $order;

        if (($this->enabled === true) && ((int) OSCOM_APP_PAYPAL_DP_ZONE > 0)) {
            $check_flag = false;
            $check_query = tep_db_query("select zone_id from zones_to_geo_zones where geo_zone_id = '".OSCOM_APP_PAYPAL_DP_ZONE."' and zone_country_id = '".(int) $order->delivery['country']['id']."' order by zone_id");

            while ($check = tep_db_fetch_array($check_query)) {
                if ($check['zone_id'] < 1) {
                    $check_flag = true;

                    break;
                }

                if ($check['zone_id'] === $order->delivery['zone_id']) {
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

    public function pre_confirmation_check(): void
    {
        if ($this->templateClassExists()) {
            $GLOBALS['oscTemplate']->addBlock($this->getSubmitCardDetailsJavascript(), 'header_tags');
        }
    }

    public function confirmation()
    {
        global $order;

        $types_array = [];

        foreach ($this->cc_types as $key => $value) {
            if ($this->isCardAccepted($key)) {
                $types_array[] = ['id' => $key,
                    'text' => $value];
            }
        }

        $today = getdate();

        $months_array = [];

        for ($i = 1; $i < 13; ++$i) {
            $months_array[] = ['id' => sprintf('%02d', $i), 'text' => sprintf('%02d', $i)];
        }

        $year_valid_from_array = [];

        for ($i = $today['year'] - 10; $i < $today['year'] + 1; ++$i) {
            $year_valid_from_array[] = ['id' => strftime('%Y', mktime(0, 0, 0, 1, 1, $i)), 'text' => strftime('%Y', mktime(0, 0, 0, 1, 1, $i))];
        }

        $year_expires_array = [];

        for ($i = $today['year']; $i < $today['year'] + 10; ++$i) {
            $year_expires_array[] = ['id' => strftime('%Y', mktime(0, 0, 0, 1, 1, $i)), 'text' => strftime('%Y', mktime(0, 0, 0, 1, 1, $i))];
        }

        $content = '<table id="paypal_table_new_card" border="0" width="100%" cellspacing="0" cellpadding="2">'.
                   '  <tr>'.
                   '    <td width="30%">'.$this->_app->getDef('module_dp_field_card_type').'</td>'.
                   '    <td>'.tep_draw_pull_down_menu('cc_type', $types_array, '', 'id="paypal_card_type"').'</td>'.
                   '  </tr>'.
                   '  <tr>'.
                   '    <td width="30%">'.$this->_app->getDef('module_dp_field_card_owner').'</td>'.
                   '    <td>'.tep_draw_input_field('cc_owner', $order->billing['firstname'].' '.$order->billing['lastname']).'</td>'.
                   '  </tr>'.
                   '  <tr>'.
                   '    <td width="30%">'.$this->_app->getDef('module_dp_field_card_number').'</td>'.
                   '    <td>'.tep_draw_input_field('cc_number_nh-dns', '', 'id="paypal_card_num"').'</td>'.
                   '  </tr>'.
                   '  <tr>'.
                   '    <td width="30%">'.$this->_app->getDef('module_dp_field_card_expires').'</td>'.
                   '    <td>'.tep_draw_pull_down_menu('cc_expires_month', $months_array).'&nbsp;'.tep_draw_pull_down_menu('cc_expires_year', $year_expires_array).'</td>'.
                   '  </tr>'.
                   '  <tr>'.
                   '    <td width="30%">'.$this->_app->getDef('module_dp_field_card_cvc').'</td>'.
                   '    <td>'.tep_draw_input_field('cc_cvc_nh-dns', '', 'size="5" maxlength="4"').' <span id="cardSecurityCodeInfo" title="'.tep_output_string($this->_app->getDef('module_dp_field_card_cvc_info')).'" style="color: #084482; text-decoration: none; border-bottom: 1px dashed #084482; cursor: pointer;">'.$this->_app->getDef('module_dp_field_card_cvc_info_link').'</span></td>'.
                   '  </tr>';

        if ($this->isCardAccepted('MAESTRO')) {
            $content .= '  <tr>'.
                        '    <td width="30%">'.$this->_app->getDef('module_dp_field_card_valid_from').'</td>'.
                        '    <td>'.tep_draw_pull_down_menu('cc_starts_month', $months_array, '', 'id="paypal_card_date_start"').'&nbsp;'.tep_draw_pull_down_menu('cc_starts_year', $year_valid_from_array).'&nbsp;'.$this->_app->getDef('module_dp_field_card_valid_from_info').'</td>'.
                        '  </tr>'.
                        '  <tr>'.
                        '    <td width="30%">'.$this->_app->getDef('module_dp_field_card_issue_number').'</td>'.
                        '    <td>'.tep_draw_input_field('cc_issue_nh-dns', '', 'id="paypal_card_issue" size="3" maxlength="2"').'&nbsp;'.$this->_app->getDef('module_dp_field_card_issue_number_info').'</td>'.
                        '  </tr>';
        }

        $content .= '</table>';

        if (!$this->templateClassExists()) {
            $content .= $this->getSubmitCardDetailsJavascript();
        }

        $confirmation = ['title' => $content];

        return $confirmation;
    }

    public function process_button()
    {
        return false;
    }

    public function before_process(): void
    {
        if (OSCOM_APP_PAYPAL_GATEWAY === '1') {
            $this->before_process_paypal();
        } else {
            $this->before_process_payflow();
        }
    }

    public function before_process_paypal(): void
    {
        global $order, $order_totals, $sendto, $response_array;

        if (isset($_POST['cc_owner']) && !empty($_POST['cc_owner']) && isset($_POST['cc_type']) && $this->isCardAccepted($_POST['cc_type']) && isset($_POST['cc_number_nh-dns']) && !empty($_POST['cc_number_nh-dns'])) {
            $params = ['AMT' => $this->_app->formatCurrencyRaw($order->info['total']),
                'CREDITCARDTYPE' => $_POST['cc_type'],
                'ACCT' => $_POST['cc_number_nh-dns'],
                'EXPDATE' => $_POST['cc_expires_month'].$_POST['cc_expires_year'],
                'CVV2' => $_POST['cc_cvc_nh-dns'],
                'FIRSTNAME' => substr($_POST['cc_owner'], 0, strpos($_POST['cc_owner'], ' ')),
                'LASTNAME' => substr($_POST['cc_owner'], strpos($_POST['cc_owner'], ' ') + 1),
                'STREET' => $order->billing['street_address'],
                'STREET2' => $order->billing['suburb'],
                'CITY' => $order->billing['city'],
                'STATE' => tep_get_zone_code($order->billing['country']['id'], $order->billing['zone_id'], $order->billing['state']),
                'COUNTRYCODE' => $order->billing['country']['iso_code_2'],
                'ZIP' => $order->billing['postcode'],
                'EMAIL' => $order->customer['email_address'],
                'SHIPTOPHONENUM' => $order->customer['telephone'],
                'CURRENCYCODE' => $order->info['currency']];

            if ($_POST['cc_type'] === 'MAESTRO') {
                $params['STARTDATE'] = $_POST['cc_starts_month'].$_POST['cc_starts_year'];
                $params['ISSUENUMBER'] = $_POST['cc_issue_nh-dns'];
            }

            if (is_numeric($sendto) && ($sendto > 0)) {
                $params['SHIPTONAME'] = $order->delivery['firstname'].' '.$order->delivery['lastname'];
                $params['SHIPTOSTREET'] = $order->delivery['street_address'];
                $params['SHIPTOSTREET2'] = $order->delivery['suburb'];
                $params['SHIPTOCITY'] = $order->delivery['city'];
                $params['SHIPTOSTATE'] = tep_get_zone_code($order->delivery['country']['id'], $order->delivery['zone_id'], $order->delivery['state']);
                $params['SHIPTOCOUNTRYCODE'] = $order->delivery['country']['iso_code_2'];
                $params['SHIPTOZIP'] = $order->delivery['postcode'];
            }

            $item_params = [];

            $line_item_no = 0;

            foreach ($order->products as $product) {
                $item_params['L_NAME'.$line_item_no] = $product['name'];
                $item_params['L_AMT'.$line_item_no] = $this->_app->formatCurrencyRaw($product['final_price']);
                $item_params['L_NUMBER'.$line_item_no] = $product['id'];
                $item_params['L_QTY'.$line_item_no] = $product['qty'];

                ++$line_item_no;
            }

            $items_total = $this->_app->formatCurrencyRaw($order->info['subtotal']);

            foreach ($order_totals as $ot) {
                if (!\in_array($ot['code'], ['ot_subtotal', 'ot_shipping', 'ot_tax', 'ot_total'], true)) {
                    $item_params['L_NAME'.$line_item_no] = $ot['title'];
                    $item_params['L_AMT'.$line_item_no] = $this->_app->formatCurrencyRaw($ot['value']);

                    $items_total += $this->_app->formatCurrencyRaw($ot['value']);

                    ++$line_item_no;
                }
            }

            $item_params['ITEMAMT'] = $items_total;
            $item_params['TAXAMT'] = $this->_app->formatCurrencyRaw($order->info['tax']);
            $item_params['SHIPPINGAMT'] = $this->_app->formatCurrencyRaw($order->info['shipping_cost']);

            if ($this->_app->formatCurrencyRaw($item_params['ITEMAMT'] + $item_params['TAXAMT'] + $item_params['SHIPPINGAMT']) === $params['AMT']) {
                $params = array_merge($params, $item_params);
            }

            $response_array = $this->_app->getApiResult('DP', 'DoDirectPayment', $params);

            if (!\in_array($response_array['ACK'], ['Success', 'SuccessWithWarning'], true)) {
                tep_redirect(tep_href_link('shopping_cart.php', 'error_message='.stripslashes($response_array['L_LONGMESSAGE0'])));
            }
        } else {
            tep_redirect(tep_href_link('checkout_confirmation.php', 'error_message='.$this->_app->getDef('module_dp_error_all_fields_required')));
        }
    }

    public function before_process_payflow(): void
    {
        global $cartID, $order, $order_totals, $sendto, $response_array;

        if (isset($_POST['cc_owner']) && !empty($_POST['cc_owner']) && isset($_POST['cc_type']) && $this->isCardAccepted($_POST['cc_type']) && isset($_POST['cc_number_nh-dns']) && !empty($_POST['cc_number_nh-dns'])) {
            $params = ['AMT' => $this->_app->formatCurrencyRaw($order->info['total']),
                'CURRENCY' => $order->info['currency'],
                'BILLTOFIRSTNAME' => substr($_POST['cc_owner'], 0, strpos($_POST['cc_owner'], ' ')),
                'BILLTOLASTNAME' => substr($_POST['cc_owner'], strpos($_POST['cc_owner'], ' ') + 1),
                'BILLTOSTREET' => $order->billing['street_address'],
                'BILLTOSTREET2' => $order->billing['suburb'],
                'BILLTOCITY' => $order->billing['city'],
                'BILLTOSTATE' => tep_get_zone_code($order->billing['country']['id'], $order->billing['zone_id'], $order->billing['state']),
                'BILLTOCOUNTRY' => $order->billing['country']['iso_code_2'],
                'BILLTOZIP' => $order->billing['postcode'],
                'EMAIL' => $order->customer['email_address'],
                'ACCT' => $_POST['cc_number_nh-dns'],
                'EXPDATE' => $_POST['cc_expires_month'].$_POST['cc_expires_year'],
                'CVV2' => $_POST['cc_cvc_nh-dns']];

            if (is_numeric($sendto) && ($sendto > 0)) {
                $params['SHIPTOFIRSTNAME'] = $order->delivery['firstname'];
                $params['SHIPTOLASTNAME'] = $order->delivery['lastname'];
                $params['SHIPTOSTREET'] = $order->delivery['street_address'];
                $params['SHIPTOSTREET2'] = $order->delivery['suburb'];
                $params['SHIPTOCITY'] = $order->delivery['city'];
                $params['SHIPTOSTATE'] = tep_get_zone_code($order->delivery['country']['id'], $order->delivery['zone_id'], $order->delivery['state']);
                $params['SHIPTOCOUNTRY'] = $order->delivery['country']['iso_code_2'];
                $params['SHIPTOZIP'] = $order->delivery['postcode'];
            }

            $item_params = [];

            $line_item_no = 0;

            foreach ($order->products as $product) {
                $item_params['L_NAME'.$line_item_no] = $product['name'];
                $item_params['L_COST'.$line_item_no] = $this->_app->formatCurrencyRaw($product['final_price']);
                $item_params['L_QTY'.$line_item_no] = $product['qty'];

                ++$line_item_no;
            }

            $items_total = $this->_app->formatCurrencyRaw($order->info['subtotal']);

            foreach ($order_totals as $ot) {
                if (!\in_array($ot['code'], ['ot_subtotal', 'ot_shipping', 'ot_tax', 'ot_total'], true)) {
                    $item_params['L_NAME'.$line_item_no] = $ot['title'];
                    $item_params['L_COST'.$line_item_no] = $this->_app->formatCurrencyRaw($ot['value']);
                    $item_params['L_QTY'.$line_item_no] = 1;

                    $items_total += $this->_app->formatCurrencyRaw($ot['value']);

                    ++$line_item_no;
                }
            }

            $item_params['ITEMAMT'] = $items_total;
            $item_params['TAXAMT'] = $this->_app->formatCurrencyRaw($order->info['tax']);
            $item_params['FREIGHTAMT'] = $this->_app->formatCurrencyRaw($order->info['shipping_cost']);

            if ($this->_app->formatCurrencyRaw($item_params['ITEMAMT'] + $item_params['TAXAMT'] + $item_params['FREIGHTAMT']) === $params['AMT']) {
                $params = array_merge($params, $item_params);
            }

            $params['_headers'] = ['X-VPS-REQUEST-ID: '.md5($cartID.tep_session_id().$this->_app->formatCurrencyRaw($order->info['total'])),
                'X-VPS-CLIENT-TIMEOUT: 45',
                'X-VPS-VIT-INTEGRATION-PRODUCT: OSCOM',
                'X-VPS-VIT-INTEGRATION-VERSION: 2.3'];

            $response_array = $this->_app->getApiResult('DP', 'PayflowPayment', $params);

            if ($response_array['RESULT'] !== '0') {
                switch ($response_array['RESULT']) {
                    case '1':
                    case '26':
                        $error_message = $this->_app->getDef('module_dp_error_configuration');

                        break;
                    case '7':
                        $error_message = $this->_app->getDef('module_dp_error_address');

                        break;
                    case '12':
                        $error_message = $this->_app->getDef('module_dp_error_declined');

                        break;
                    case '23':
                    case '24':
                        $error_message = $this->_app->getDef('module_dp_error_invalid_card');

                        break;

                    default:
                        $error_message = $this->_app->getDef('module_dp_error_general');

                        break;
                }

                tep_redirect(tep_href_link('checkout_confirmation.php', 'error_message='.$error_message));
            }
        } else {
            tep_redirect(tep_href_link('checkout_confirmation.php', 'error_message='.$this->_app->getDef('module_dp_error_all_fields_required')));
        }
    }

    public function after_process(): void
    {
        if (OSCOM_APP_PAYPAL_GATEWAY === '1') {
            $this->after_process_paypal();
        } else {
            $this->after_process_payflow();
        }
    }

    public function after_process_paypal(): void
    {
        global $response_array, $insert_id;

        $details = $this->_app->getApiResult('APP', 'GetTransactionDetails', ['TRANSACTIONID' => $response_array['TRANSACTIONID']], (OSCOM_APP_PAYPAL_DP_STATUS === '1') ? 'live' : 'sandbox');

        $result = 'Transaction ID: '.tep_output_string_protected($response_array['TRANSACTIONID'])."\n";

        if (\in_array($details['ACK'], ['Success', 'SuccessWithWarning'], true)) {
            $result .= 'Payer Status: '.tep_output_string_protected($details['PAYERSTATUS'])."\n".
                       'Address Status: '.tep_output_string_protected($details['ADDRESSSTATUS'])."\n".
                       'Payment Status: '.tep_output_string_protected($details['PAYMENTSTATUS'])."\n".
                       'Payment Type: '.tep_output_string_protected($details['PAYMENTTYPE'])."\n".
                       'Pending Reason: '.tep_output_string_protected($details['PENDINGREASON'])."\n";
        }

        $result .= 'AVS Code: '.tep_output_string_protected($response_array['AVSCODE'])."\n".
                   'CVV2 Match: '.tep_output_string_protected($response_array['CVV2MATCH']);

        $sql_data_array = ['orders_id' => $insert_id,
            'orders_status_id' => OSCOM_APP_PAYPAL_TRANSACTIONS_ORDER_STATUS_ID,
            'date_added' => 'now()',
            'customer_notified' => '0',
            'comments' => $result];

        tep_db_perform('orders_status_history', $sql_data_array);
    }

    public function after_process_payflow(): void
    {
        global $insert_id, $response_array;

        $details = $this->_app->getApiResult('APP', 'PayflowInquiry', ['ORIGID' => $response_array['PNREF']], (OSCOM_APP_PAYPAL_DP_STATUS === '1') ? 'live' : 'sandbox');

        $result = 'Transaction ID: '.tep_output_string_protected($response_array['PNREF'])."\n".
                  "Gateway: Payflow\n".
                  'PayPal ID: '.tep_output_string_protected($response_array['PPREF'])."\n".
                  'Response: '.tep_output_string_protected($response_array['RESPMSG'])."\n";

        if (isset($details['RESULT']) && ($details['RESULT'] === '0')) {
            $pending_reason = $details['TRANSSTATE'];
            $payment_status = null;

            switch ($details['TRANSSTATE']) {
                case '3':
                    $pending_reason = 'authorization';
                    $payment_status = 'Pending';

                    break;
                case '4':
                    $pending_reason = 'other';
                    $payment_status = 'In-Progress';

                    break;
                case '6':
                    $pending_reason = 'scheduled';
                    $payment_status = 'Pending';

                    break;
                case '8':
                case '9':
                    $pending_reason = 'None';
                    $payment_status = 'Completed';

                    break;
            }

            if (isset($payment_status)) {
                $result .= 'Payment Status: '.tep_output_string_protected($payment_status)."\n";
            }

            $result .= 'Pending Reason: '.tep_output_string_protected($pending_reason)."\n";
        }

        switch ($response_array['AVSADDR']) {
            case 'Y':
                $result .= "AVS Address: Match\n";

                break;
            case 'N':
                $result .= "AVS Address: No Match\n";

                break;
        }

        switch ($response_array['AVSZIP']) {
            case 'Y':
                $result .= "AVS ZIP: Match\n";

                break;
            case 'N':
                $result .= "AVS ZIP: No Match\n";

                break;
        }

        switch ($response_array['IAVS']) {
            case 'Y':
                $result .= "IAVS: International\n";

                break;
            case 'N':
                $result .= "IAVS: USA\n";

                break;
        }

        switch ($response_array['CVV2MATCH']) {
            case 'Y':
                $result .= "CVV2: Match\n";

                break;
            case 'N':
                $result .= "CVV2: No Match\n";

                break;
        }

        $sql_data_array = ['orders_id' => $insert_id,
            'orders_status_id' => OSCOM_APP_PAYPAL_TRANSACTIONS_ORDER_STATUS_ID,
            'date_added' => 'now()',
            'customer_notified' => '0',
            'comments' => $result];

        tep_db_perform('orders_status_history', $sql_data_array);
    }

    public function get_error()
    {
        return false;
    }

    public function check()
    {
        return tep_db_num_rows(tep_db_query("SELECT configuration_value FROM configuration WHERE configuration_key = 'OSCOM_APP_PAYPAL_DP_STATUS'"));
    }

    public function install(): void
    {
        tep_redirect(tep_href_link('paypal.php', 'action=configure&subaction=install&module=DP'));
    }

    public function remove(): void
    {
        tep_redirect(tep_href_link('paypal.php', 'action=configure&subaction=uninstall&module=DP'));
    }

    public function keys()
    {
        return ['OSCOM_APP_PAYPAL_DP_SORT_ORDER'];
    }

    public function isCardAccepted($card)
    {
        static $cards;

        if (!isset($cards)) {
            $cards = explode(';', OSCOM_APP_PAYPAL_DP_CARDS);
        }

        return isset($this->cc_types[$card]) && \in_array(strtolower($card), $cards, true);
    }

    public function templateClassExists()
    {
        return class_exists('oscTemplate') && isset($GLOBALS['oscTemplate']) && \is_object($GLOBALS['oscTemplate']) && (\get_class($GLOBALS['oscTemplate']) === 'oscTemplate');
    }

    public function getSubmitCardDetailsJavascript()
    {
        return <<<'EOD'
<script>
if ( typeof jQuery == 'undefined' ) {
  document.write('<scr' + 'ipt src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></scr' + 'ipt>');
}
</script>

<script>
$(function() {
  if ( typeof($('#paypal_table_new_card').parent().closest('table').attr('width')) == 'undefined' ) {
    $('#paypal_table_new_card').parent().closest('table').attr('width', '100%');
  }

  paypalShowNewCardFields();

  $('#paypal_card_type').change(function() {
    var selected = $(this).val();

    if ( $('#paypal_card_date_start').length > 0 ) {
      if ( selected == 'MAESTRO' ) {
        $('#paypal_card_date_start').parent().parent().show();
      } else {
        $('#paypal_card_date_start').parent().parent().hide();
      }
    }

    if ( $('#paypal_card_issue').length > 0 ) {
      if ( selected == 'MAESTRO' ) {
        $('#paypal_card_issue').parent().parent().show();
      } else {
        $('#paypal_card_issue').parent().parent().hide();
      }
    }
  });

  $('#cardSecurityCodeInfo').tooltip();
});

function paypalShowNewCardFields() {
  var selected = $('#paypal_card_type').val();

  if ( $('#paypal_card_date_start').length > 0 ) {
    if ( selected != 'MAESTRO' ) {
      $('#paypal_card_date_start').parent().parent().hide();
    }
  }

  if ( $('#paypal_card_issue').length > 0 ) {
    if ( selected != 'MAESTRO' ) {
      $('#paypal_card_issue').parent().parent().hide();
    }
  }
}
</script>
EOD;
    }
}
