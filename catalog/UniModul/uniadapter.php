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

// Pouzivani bez souhlasu autora neni povoleno
// #Ver:PRV089-22-g45d1515b:2021-09-02#

require_once DIR_FS_CATALOG.'/UniModul/UniModul.php';

// if (class_exists("uniadapter")) {
//  return;
// }

BeginUniErr();

if (!\function_exists('isZencart')) {
    function isZencart()
    {
        return !\function_exists('tep_db_query');
    }

    if (isZencart()) {
        function tep_db_query($sql)
        {
            global $db;

            return $db->Execute($sql);
        }
        function tep_db_num_rows($query)
        {
            return $query->RecordCount();
        }

        function tep_db_insert_id()
        {
            global $db;

            return $db->insert_ID();
        }
    } else {
        \define('DB_PREFIX', '');    // TODO: check

        function zen_cfg_select_option($select_array, $key_value, $key = '')
        {
            return tep_cfg_select_option($select_array, $key_value, $key);
        }

        function zen_get_zone_class_title($zone_class_id)
        {
            return tep_get_zone_class_title($zone_class_id);
        }

        function zen_cfg_pull_down_zone_classes($zone_class_id, $key = '')
        {
            return tep_cfg_pull_down_zone_classes($zone_class_id, $key);
        }

        function zen_cfg_pull_down_order_statuses($order_status_id, $key = '')
        {
            return tep_cfg_pull_down_order_statuses($order_status_id, $key);
        }

        function zen_get_order_status_name($order_status_id, $language_id = '')
        {
            return tep_get_order_status_name($order_status_id, $language_id);
        }

        function zen_href_link($page = '', $parameters = '', $connection = 'NONSSL', $add_session_id = true)
        {
            return tep_href_link_original($page, $parameters, $connection, $add_session_id);
        }

        function zen_draw_hidden_field($name, $value = '', $parameters = '')
        {
            return tep_draw_hidden_field($name, $value, $parameters);
        }

        function zen_redirect($url)
        {
            return tep_redirect($url);
        }

        function zen_mail($to_name, $to_address, $email_subject, $email_text, $from_email_name, $from_email_address, $block = [], $module = 'default', $attachments_list = '')
        {
            return tep_mail($to_name, $to_address, $email_subject, $email_text, $from_email_name, $from_email_address);
        }
    }
}

EndUniErr();

class uniadapter
{
    public $code;
    public $title;
    public $description;
    public $enabled;
    public $payment;
    public $uniModul;
    private $configInfo; // nutne pro fci keys()

    public function __construct($uniModulName = null)
    {
        if ($uniModulName === null) {
            return;
        }

        BeginUniErr();
        $uniFact = new UniModulFactory();
        $configInfo = $uniFact->getConfigInfo($uniModulName, $this->getLangCode());
        $this->configInfo = $configInfo;
        $configSetting = $this->getConfigData($configInfo, $uniModulName);
        $this->uniModul = $uniFact->createUniModul($uniModulName, $configSetting);

        global $order;
        $this->code = \get_class($this); // $uniModulName;  // >><< LOW CASE

        $this->title = $this->uniModul->dictionary->get('payment_method_name', $this->getLangCode());
        $this->description = $this->uniModul->dictionary->get('payment_method_name', $this->getLangCode());

        $this->sort_order = \defined($this->getShortConfigName('SORT_ORDER')) ? \constant($this->getShortConfigName('SORT_ORDER')) : 0;
        $this->enabled = (\defined($this->getShortConfigName('STATUS')) && \constant($this->getShortConfigName('STATUS')) === 'True') ? true : false;

        $this->order_status = 1; // ????? MODULE_PAYMENT_PAYPAL_ORDER_STATUS_ID;

        if (\is_object($order)) {
            $this->update_status();
        }

        // $this->email_footer = MODULE_PAYMENT_PAYU_TEXT_EMAIL_FOOTER;

        EndUniErr();
    }

    // class methods
    public function update_status(): void
    {
        BeginUniErr();
        global $db;
        global $order;

        if (($this->enabled === true) && ((int) \constant($this->getShortConfigName('ZONE')) > 0)) {
            $check_flag = false;
            $check = tep_db_query('select zone_id from '.TABLE_ZONES_TO_GEO_ZONES." where geo_zone_id = '".\constant($this->getShortConfigName('SORT_ORDER'))."' and zone_country_id = '".$order->billing['country']['id']."' order by zone_id");

            while (!$check->EOF) {
                if ($check->fields['zone_id'] < 1) {
                    $check_flag = true;

                    break;
                }

                if ($check->fields['zone_id'] === $order->billing['zone_id']) {
                    $check_flag = true;

                    break;
                }

                $check->MoveNext();
            }

            if ($check_flag === false) {
                $this->enabled = false;
            }
        }

        EndUniErr();
    }

    public function javascript_validation()
    {
        return false;
    }

    // funkce přidává radio buttonky pro výběr platebního modulu - asi pokud modul obsahuje podmoduly tak má smysl jich vložit víc
    public function selection()
    {
        BeginUniErr();
        $orderToPayInfo = $this->getOrderToPayInfo();
        $prePayGWInfo = $this->uniModul->queryPrePayGWInfo($orderToPayInfo);

        if ($prePayGWInfo->isPossible) {    // mohlo by to byt i v update_status
            $webRoot = str_replace('index.php?main_page=index', '', zen_href_link(FILENAME_DEFAULT, '', 'SSL'));
            $imgElm = "<img src='".$webRoot."includes/modules/payment/payu/payu.gif' alt='PayU'/> ";

            // TODO: Doplnit obrazek
            return EndUniErr(['id' => $this->code, 'module' => $this->uniModul->dictionary->get('payment_method_name', $this->getLangCode())]);
        }

        return EndUniErr(null);
    }

    public function pre_confirmation_check()
    {
        return false;
    }

    // ./includes/templates/template_default/templates/tpl_checkout_confirmation_default.php
    // Loaded automatically by index.php?main_page=checkout_confirmation.<br />
    // Displays final checkout details, cart, payment and shipping info details.
    public function confirmation()
    {
        // ASI MUZE BYT FALSE - DLE DOKUMENTACE PAYPAL
        // return array('title' => MODULE_PAYMENT_PAYU_TEXT_DESCRIPTION.'XXXXX');
        return false;
    }

    // ./includes/templates/template_default/templates/tpl_checkout_confirmation_default.php
    // Functions to execute before finishing the form
    // Examples: add extra hidden fields to the form
    public function process_button(): void
    {
        BeginUniErr();

        $orderToPayInfo = $this->getOrderToPayInfo();
        $prePayGWInfo = $this->uniModul->queryPrePayGWInfo($orderToPayInfo);

        if (!$prePayGWInfo->isPossible) {
            echo 'This payment method cannot be used';  // nemelo by se sem vubec dostat, protoze se metoda ani nenabidne
            ResetUniErr();

            exit;
        }

        // echo "<input type='hidden' name='uniModul' value='". $this->uniModul->name."'>";
        echo "<input type='hidden' name='CheckoutButtonConfirmation' value='1'>";

        if ($prePayGWInfo->forexMessage !== null) {
            echo '<p>'.$prePayGWInfo->forexMessage.'</p>';
        }

        if ($prePayGWInfo->selectCsPayBrand) {
            echo '<p/><b>'.$this->uniModul->dictionary->get('ccBrand_title', $this->getLangCode()).<<<'EOD'
</b><div style="padding-left:10ex">
				<input type="radio" name="brand" value="VISA" checked> VISA<br>
				<input type="radio" name="brand" value="MasterCard"> Master Card<br>
				<input type="radio" name="brand" value="VisaElectron"> Visa Electron<br>
				<input type="radio" name="brand" value="Maestro"> Maestro<br>
				</div><div style="clear:both"></div>
EOD;
        }

        EndUniErr();

        // return "\r\n".$formflds."\r\n";
        // form se da i vratit z funkce, ale echo je taky ok
    }

    public function before_process()
    {
        BeginUniErr();

        if (isset($_REQUEST['CheckoutButtonConfirmation'])) {
            $orderToPayInfo = $this->getOrderToPayInfo();
            $prePayGWInfo = $this->uniModul->queryPrePayGWInfo($orderToPayInfo);

            if (!$prePayGWInfo->isPossible) {
                echo 'This payment method cannot be used';  // nemelo by se sem vubec dostat, protoze se metoda ani nenabidne
                ResetUniErr();

                exit;
            }

            $redirectAction = $this->uniModul->gatewayOrderRedirectAction($orderToPayInfo);

            if ($redirectAction->orderReplyStatus !== null) {   // okamzita odpoved muze byt i zaroven s redirektem - napr. Cetelem
                $frontend_redir = $redirectAction->redirectUrl === null && $redirectAction->redirectForm === null;
                // $this->procesReplyStatus($redirectAction->orderReplyStatus, $frontend_redir);
            }

            if ($redirectAction->redirectForm !== null) {
                $this->uniModul->formRedirect($redirectAction->redirectForm);
                ResetUniErr();

                exit;
            }

            if ($redirectAction->redirectUrl !== null) {
                header('Location: '.$redirectAction->redirectUrl);
                ResetUniErr();

                exit;
            }
        } else { // navrat z brany
            // KONTROLA ZE OK
            global $orderReplyStatus; // kvuli after_process
            $orderReplyStatus = $this->uniModul->gatewayReceiveReply($this->getLangCode());

            [$newState, $guiOk] = $this->getNewState($orderReplyStatus->orderStatus);

            if ($guiOk) {
                $this->transaction_id = $orderReplyStatus->gwOrderNumber; // Objevi se v hlavicce mailu pro provozovatele obchodu
                global $order;
                $order->info['order_status'] = $newState;
            } else {
                $ertext = UNIMODULE_PAYMENT_ERR.' '.$orderReplyStatus->resultText;
                $_SESSION['unimodul']['ertext'] = $ertext;
                ResetUniErr();
                zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, 'payment_error='.$this->code.'&unierror=1', 'SSL', true, false));
            }
        }

        return EndUniErr(false);
    }

    public function after_process()
    {
        BeginUniErr();

        global $insert_id;
        global $orderReplyStatus;

        $this->uniModul->updateShopOrderNumber($orderReplyStatus, $insert_id);

        return EndUniErr(false);
    }

    public function get_error()
    {
        BeginUniErr();

        if ($_GET['unierror'] === 1) {
            $error = ['title' => 'UNIMODUL' /* ???nikde se to nepouzije */,
                'error' => $_SESSION['unimodul']['ertext']];

            return EndUniErr($error);
        }

        EndUniErr();
    }

    public function check()
    {
        BeginUniErr();

        if (!isset($this->uniModul)) {
            return false; // preskocit uniadapter holy
        }

        global $db;

        if (!isset($this->_check)) {
            $check_query = tep_db_query('select configuration_value from '.TABLE_CONFIGURATION." where configuration_key = '".$this->getShortConfigName('STATUS')."'");
            $this->_check = tep_db_num_rows($check_query);
        }

        return EndUniErr($this->_check);
    }

    /**
     * Build admin-page components.
     *
     * @param int $zf_order_id
     *
     * @return string
     */
    public function admin_notification($zf_order_id)
    {
        BeginUniErr();
        global $db;
        $output = '';
        $sql = 'select * from '.TABLE_PAYU_TRANS." where order_id = '".$zf_order_id."' and state = 1 order by date_paid";
        $lp_api = tep_db_query($sql);

        if (tep_db_num_rows($lp_api) > 0) {
            $output = <<<'EOD'
<td> <b style='color:green'>PayU</b><br/>
			Zaplaceno dne
EOD.$lp_api->fields['date_paid']
            .'<br/>  PayU ORDERNUMBER je '.$lp_api->fields['payu_order_number'].'</b><br/>'
            .$lp_api->fields['note'].' </td>';
        }

        return EndUniErr($output);
    }

    public function install(): void
    {
        BeginUniErr();
        global $db;

        // specificka cfg pro eshop
        tep_db_query('insert into '.TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable ".$this->uniModul->dictionary->get('payment_method_name', 'en')." Module', '".$this->getShortConfigName('STATUS')."', 'True', '".$this->uniModul->name."', '6', '1', 'zen_cfg_select_option(array(\\'True\\', \\'False\\'), ', now());");

        tep_db_query('insert into '.TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort order of display.', '".$this->getShortConfigName('SORT_ORDER')."', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");

        tep_db_query('insert into '.TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Payment Zone', '".$this->getShortConfigName('ZONE')."', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '2', 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(', now())");

        // cfg z UniModulu
        foreach ($this->configInfo->configFields as $configField) {
            $fldname = $this->getShortConfigName($configField->name);

            if ($configField->type === ConfigFieldType::$text) {
                tep_db_query('insert into '.TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('".$configField->label."', '".$fldname."', '', '', '6', '0', now())");
            } elseif ($configField->type === ConfigFieldType::$choice) {
                $opts = [];
                $cmt = '';

                foreach ($configField->choiceItems as $val => $lab) {
                    $opts[] = $val;
                    $cmt .= ($cmt === '' ? '' : ', ').$lab.' .. '.$val;
                }

                $opts_php = addslashes(var_export($opts, true));
                $cmt = "'".addslashes($cmt)."'";

                tep_db_query('insert into '.TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('".$configField->label."', '".$fldname."', 'True', {$cmt}, '6', '1', 'zen_cfg_select_option(".$opts_php.", ', now());");
            } elseif ($configField->type === ConfigFieldType::$orderStatus) {
                tep_db_query('insert into '.TABLE_CONFIGURATION." (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('".$configField->label."', '".$fldname."', '2', '', '6', '44', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
            }
        }

        $sql = file_get_contents(DIR_FS_CATALOG.'/UniModul/UniModul.sql');
        tep_db_query($sql);
        EndUniErr();
    }

    public function remove(): void
    {
        BeginUniErr();
        global $db;
        tep_db_query('delete from '.TABLE_CONFIGURATION." where configuration_key in ('".implode("', '", $this->keys())."')");
        EndUniErr();
    }

    public function keys()
    {
        BeginUniErr();
        $ks = [$this->getShortConfigName('STATUS'), $this->getShortConfigName('ZONE'), $this->getShortConfigName('SORT_ORDER')];

        foreach ($this->configInfo->configFields as $configField) {
            if (\in_array($configField->type, [ConfigFieldType::$text, ConfigFieldType::$choice, ConfigFieldType::$orderStatus], true)) {
                $ks[] = $this->getShortConfigName($configField->name);
            }
        }

        return EndUniErr($ks);
    }

    public function getLangCode()
    {
        global $languages_id, $uniLangCode;

        if (empty($uniLangCode)) {
            $lang_query = tep_db_query('select code from '.TABLE_LANGUAGES." where languages_id = '".(int) $languages_id."'");
            $lang = tep_db_fetch_array($lang_query);
            $uniLangCode = $lang['code'];
        }

        return $uniLangCode;
    }

    private function getConfigData($configInfo, $uniModulName)
    {
        $configData = [];

        foreach ($configInfo->configFields as $configField) {
            $cname = $this->getShortConfigName($configField->name, $uniModulName);
            $configData[$configField->name] = \defined($cname) ? \constant($cname) : null;
        }

        $uniModulConfig = new UniModulConfig();
        $uniModulConfig->mysql_server = DB_SERVER;
        $uniModulConfig->mysql_dbname = DB_DATABASE;
        $uniModulConfig->mysql_login = DB_SERVER_USERNAME;
        $uniModulConfig->mysql_password = DB_SERVER_PASSWORD;
        BeginUniErr(E_UNIERR_DEFAULT & ~\E_NOTICE);
        $uniModulConfig->uniModulDirUrl = zen_href_link('UniModul/', '', 'SSL');
        EndUniErr();
        $uniModulConfig->adapterName = 'OsCommerce';

        // DB_PREFIX ..
        $cfgs = create_initialize_object('ConfigSetting', ['configData' => $configData, 'uniModulConfig' => $uniModulConfig]);

        return $cfgs;
    }

    private function getShortConfigName($name, $uniModulName = null)
    {
        if ($uniModulName === null) {  // protoze pri konstrukci jeste uniModul neni dosazen
            $uniModulName = $this->uniModul->name;
        }

        $nn = 'MODULE_PAYMENT_'.$uniModulName.'_'.$name;

        // $nn = substr($nn, 0, 32);  // max omezeni na delku cfg itemu
        return strtoupper($nn);
    }

    private function getOrderToPayInfo()
    {
        global $order, $db;

        $order_currency = $order->info['currency'];

        if ($order_currency === 'Kč') {
            $order_currency = 'CZK';
        }

        $order_total = $order->info['total'] * $order->info['currency_value'];

        require_once DIR_WS_CLASSES.'currencies.php';
        $currencies = new currencies();
        $currencyRates = [];

        foreach ($currencies->currencies as $curiso => $cur) {
            $currencyRates[$curiso] = $cur['value'];
        }

        $description = '';

        foreach ($order->products as $p) {
            if ($description !== '') {
                $description .= ', ';
            }

            $description .= $p['name'];
        }

        $orderToPayInfo = new OrderToPayInfo();
        $orderToPayInfo->amount = $order_total;
        $orderToPayInfo->currency = $order_currency;
        $orderToPayInfo->language = $this->getLangCode();
        $orderToPayInfo->description = $description;

        $customerData = new CustomerData();
        $customerData->first_name = $order->customer['firstname'];
        $customerData->last_name = $order->customer['lastname'].' '.$customerData->last_name = $order->customer['company'];
        $customerData->email = $order->customer['email_address'];
        $customerData->phone = $order->customer['telephone'];
        $customerData->street = $order->customer['street_address'].' '.$order->customer['suburb'];
        $customerData->city = $order->customer['city'];
        $customerData->post_code = $order->customer['postcode'];
        $customerData->country = $order->customer['country']['iso_code_2'];
        $orderToPayInfo->customerData = $customerData;

        $replyUrl = zen_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL');
        $orderToPayInfo->replyUrl = $replyUrl;
        $orderToPayInfo->currencyRates = $currencyRates;
        // $orderToPayInfo->uniAdapterData = $_SESSION;

        return $orderToPayInfo;
    }

    private function getNewState($orderStatus)
    {
        switch ($orderStatus) {
            case OrderStatus::$successful:
                $newState = \constant($this->getShortConfigName('orderStatusSuccessfull'));
                $guiOk = true;

                break;
            case OrderStatus::$pending:
            case OrderStatus::$initiated:  // ? co jineho s takovou odpovedi
                $newState = \constant($this->getShortConfigName('orderStatusPending'));
                $guiOk = true;

                break;
            case OrderStatus::$failedFinal:
                $newState = \constant($this->getShortConfigName('orderStatusFailed'));
                $guiOk = false;   // ?? nevim jak to nastavit pri neuspechu, takze asi newState zbytecny

                break;
            case OrderStatus::$failedRetriable:
            case OrderStatus::$invalidReply:
                $newState = null;
                $guiOk = false;

                // no break
            default:
        }

        return [$newState, $guiOk];
    }
}
