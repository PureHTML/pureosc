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

class cm_paypal_login
{
    public $code;
    public $group;
    public $title;
    public $description;
    public $sort_order;
    public $enabled = false;
    public $_app;

    public function __construct()
    {
        $this->_app = new OSCOM_PayPal();
        $this->_app->loadLanguageFile('modules/LOGIN/LOGIN.php');

        $this->signature = 'paypal|paypal_login|4.0|2.3';

        $this->code = \get_class($this);
        $this->group = basename(__DIR__);

        $this->title = $this->_app->getDef('module_login_title');
        $this->description = '<div align="center">'.$this->_app->drawButton($this->_app->getDef('module_login_legacy_admin_app_button'), tep_href_link('paypal.php', 'action=configure&module=LOGIN'), 'primary', null, true).'</div>';

        if (\defined('OSCOM_APP_PAYPAL_LOGIN_STATUS')) {
            $this->sort_order = OSCOM_APP_PAYPAL_LOGIN_SORT_ORDER;
            $this->enabled = \in_array(OSCOM_APP_PAYPAL_LOGIN_STATUS, ['1', '0'], true);

            if (OSCOM_APP_PAYPAL_LOGIN_STATUS === '0') {
                $this->title .= ' [Sandbox]';
            }

            if (!\function_exists('curl_init')) {
                $this->description .= '<div class="secWarning">'.$this->_app->getDef('module_login_error_curl').'</div>';

                $this->enabled = false;
            }

            if ($this->enabled === true) {
                if (((OSCOM_APP_PAYPAL_LOGIN_STATUS === '1') && (empty(OSCOM_APP_PAYPAL_LOGIN_LIVE_CLIENT_ID) || empty(OSCOM_APP_PAYPAL_LOGIN_LIVE_SECRET))) || ((OSCOM_APP_PAYPAL_LOGIN_STATUS === '0') && (empty(OSCOM_APP_PAYPAL_LOGIN_SANDBOX_CLIENT_ID) || empty(OSCOM_APP_PAYPAL_LOGIN_SANDBOX_SECRET)))) {
                    $this->description .= '<div class="secWarning">'.$this->_app->getDef('module_login_error_credentials').'</div>';

                    $this->enabled = false;
                }
            }
        }
    }

    public function execute(): void
    {
        global $oscTemplate;

        if (isset($_GET['action'])) {
            if ($_GET['action'] === 'paypal_login') {
                $this->preLogin();
            } elseif ($_GET['action'] === 'paypal_login_process') {
                $this->postLogin();
            }
        }

        $scopes = cm_paypal_login_get_attributes();
        $use_scopes = ['openid'];

        foreach (explode(';', OSCOM_APP_PAYPAL_LOGIN_ATTRIBUTES) as $a) {
            foreach ($scopes as $group => $attributes) {
                foreach ($attributes as $attribute => $scope) {
                    if ($a === $attribute) {
                        if (!\in_array($scope, $use_scopes, true)) {
                            $use_scopes[] = $scope;
                        }
                    }
                }
            }
        }

        $cm_paypal_login = $this;

        ob_start();

        include DIR_FS_CATALOG.'includes/modules/content/'.$this->group.'/templates/paypal_login.php';
        $template = ob_get_clean();

        $oscTemplate->addContent($template, $this->group);
    }

    public function preLogin(): void
    {
        global $paypal_login_access_token, $paypal_login_customer_id, $sendto, $billto, $customer_id;

        $return_url = tep_href_link('login.php');

        if (isset($_GET['code'])) {
            $paypal_login_customer_id = false;

            $params = ['code' => $_GET['code'],
                'redirect_uri' => str_replace('&amp;', '&', tep_href_link('login.php', 'action=paypal_login'))];

            $response_token = $this->_app->getApiResult('LOGIN', 'GrantToken', $params);

            if (!isset($response_token['access_token']) && isset($response_token['refresh_token'])) {
                $params = ['refresh_token' => $response_token['refresh_token']];

                $response_token = $this->_app->getApiResult('LOGIN', 'RefreshToken', $params);
            }

            if (isset($response_token['access_token'])) {
                $params = ['access_token' => $response_token['access_token']];

                $response = $this->_app->getApiResult('LOGIN', 'UserInfo', $params);

                if (isset($response['email'])) {
                    $paypal_login_access_token = $response_token['access_token'];
                    tep_session_register('paypal_login_access_token');

                    $force_login = false;

                    if (!isset($response['given_name'], $response['family_name'])) {
                        preg_match('/(?:\S+\. )?(\S+).*?(\S+)(?: \S+\.)?$/', $response['name'], $result);
                        $response['given_name'] = $result[1];
                        $response['family_name'] = $result[2];
                    }

                    // check if e-mail address exists in database and login or create customer account
                    if (!isset($_SESSION['customer_id'])) {
                        $customer_id = 0;
                        $customer_default_address_id = 0;

                        $force_login = true;

                        $email_address = tep_db_prepare_input($response['email']);

                        $check_query = tep_db_query("select customers_id from customers where customers_email_address = '".tep_db_input($email_address)."' limit 1");

                        if (tep_db_num_rows($check_query) === 1) {
                            $check = tep_db_fetch_array($check_query);

                            $customer_id = (int) $check['customers_id'];
                        } else {
                            $customers_firstname = tep_db_prepare_input($response['given_name']);
                            $customers_lastname = tep_db_prepare_input($response['family_name']);

                            $sql_data_array = ['customers_firstname' => $customers_firstname,
                                'customers_lastname' => $customers_lastname,
                                'customers_email_address' => $email_address,
                                'customers_telephone' => '',
                                'customers_fax' => '',
                                'customers_newsletter' => '0',
                                'customers_password' => ''];

                            if ($this->hasAttribute('phone') && isset($response['phone_number']) && !empty($response['phone_number'])) {
                                $customers_telephone = tep_db_prepare_input($response['phone_number']);

                                $sql_data_array['customers_telephone'] = $customers_telephone;
                            }

                            if ($this->hasAttribute('date_of_birth') && isset($response['birthday']) && !empty($response['birthday'])) {
                                $sql_data_array['customers_dob'] = tep_db_prepare_input($response['birthday']);
                            }

                            tep_db_perform('customers', $sql_data_array);

                            $customer_id = (int) tep_db_insert_id();

                            tep_db_query("insert into customers_info (customers_info_id, customers_info_number_of_logons, customers_info_date_account_created) values ('".(int) $customer_id."', '0', now())");
                        }
                    }

                    // check if paypal shipping address exists in the address book
                    $ship_firstname = tep_db_prepare_input($response['given_name']);
                    $ship_lastname = tep_db_prepare_input($response['family_name']);
                    $ship_address = tep_db_prepare_input($response['address']['street_address']);
                    $ship_city = tep_db_prepare_input($response['address']['locality']);
                    $ship_zone = tep_db_prepare_input($response['address']['region']);
                    $ship_zone_id = 0;
                    $ship_postcode = tep_db_prepare_input($response['address']['postal_code']);
                    $ship_country = tep_db_prepare_input($response['address']['country']);
                    $ship_country_id = 0;
                    $ship_address_format_id = 1;

                    $country_query = tep_db_query("select countries_id, address_format_id from countries where countries_iso_code_2 = '".tep_db_input($ship_country)."' limit 1");

                    if (tep_db_num_rows($country_query)) {
                        $country = tep_db_fetch_array($country_query);

                        $ship_country_id = $country['countries_id'];
                        $ship_address_format_id = $country['address_format_id'];
                    }

                    if ($ship_country_id > 0) {
                        $zone_query = tep_db_query("select zone_id from zones where zone_country_id = '".(int) $ship_country_id."' and (zone_name = '".tep_db_input($ship_zone)."' or zone_code = '".tep_db_input($ship_zone)."') limit 1");

                        if (tep_db_num_rows($zone_query)) {
                            $zone = tep_db_fetch_array($zone_query);

                            $ship_zone_id = $zone['zone_id'];
                        }
                    }

                    $check_query = tep_db_query("select address_book_id from address_book where customers_id = '".(int) $customer_id."' and entry_firstname = '".tep_db_input($ship_firstname)."' and entry_lastname = '".tep_db_input($ship_lastname)."' and entry_street_address = '".tep_db_input($ship_address)."' and entry_postcode = '".tep_db_input($ship_postcode)."' and entry_city = '".tep_db_input($ship_city)."' and (entry_state = '".tep_db_input($ship_zone)."' or entry_zone_id = '".(int) $ship_zone_id."') and entry_country_id = '".(int) $ship_country_id."' limit 1");

                    if (tep_db_num_rows($check_query)) {
                        $check = tep_db_fetch_array($check_query);

                        $sendto = $check['address_book_id'];
                    } else {
                        $sql_data_array = ['customers_id' => $customer_id,
                            'entry_firstname' => $ship_firstname,
                            'entry_lastname' => $ship_lastname,
                            'entry_street_address' => $ship_address,
                            'entry_postcode' => $ship_postcode,
                            'entry_city' => $ship_city,
                            'entry_country_id' => $ship_country_id];

                        if (ACCOUNT_STATE === 'true') {
                            if ($ship_zone_id > 0) {
                                $sql_data_array['entry_zone_id'] = $ship_zone_id;
                                $sql_data_array['entry_state'] = '';
                            } else {
                                $sql_data_array['entry_zone_id'] = '0';
                                $sql_data_array['entry_state'] = $ship_zone;
                            }
                        }

                        tep_db_perform('address_book', $sql_data_array);

                        $address_id = tep_db_insert_id();

                        $sendto = $address_id;

                        if ($customer_default_address_id < 1) {
                            tep_db_query("update customers set customers_default_address_id = '".(int) $address_id."' where customers_id = '".(int) $customer_id."'");
                            $customer_default_address_id = $address_id;
                        }
                    }

                    if (!isset($_SESSION['paypal_login_customer_id'])) {
                        tep_session_register('paypal_login_customer_id');
                    }

                    if ($force_login === true) {
                        $paypal_login_customer_id = $customer_id;
                    } else {
                        $paypal_login_customer_id = false;
                    }

                    $billto = $sendto;

                    if (!isset($_SESSION['sendto'])) {
                        tep_session_register('sendto');
                    }

                    if (!isset($_SESSION['billto'])) {
                        tep_session_register('billto');
                    }

                    $return_url = tep_href_link('login.php', 'action=paypal_login_process');
                }
            }
        }

        echo '<script>window.opener.location.href="'.str_replace('&amp;', '&', $return_url).'";window.close();</script>';

        tep_redirect(str_replace('&amp;', '&', $return_url));
    }

    public function postLogin(): void
    {
        global $paypal_login_customer_id, $login_customer_id, $language, $payment;

        if (isset($_SESSION['paypal_login_customer_id'])) {
            if ($paypal_login_customer_id !== false) {
                $login_customer_id = $paypal_login_customer_id;
            }

            unset($_SESSION['paypal_login_customer_id']);
        }

        // Register PayPal Express Checkout as the default payment method
        if (!isset($_SESSION['payment']) || ($payment !== 'paypal_express')) {
            if (\defined('MODULE_PAYMENT_INSTALLED') && !empty(MODULE_PAYMENT_INSTALLED)) {
                if (\in_array('paypal_express.php', explode(';', MODULE_PAYMENT_INSTALLED), true)) {
                    if (!class_exists('paypal_express')) {
                        include DIR_FS_CATALOG.'includes/modules/payment/paypal_express.php';
                    }

                    $ppe = new paypal_express();

                    if ($ppe->enabled) {
                        $payment = 'paypal_express';
                        tep_session_register('payment');
                    }
                }
            }
        }
    }

    public function isEnabled()
    {
        return $this->enabled;
    }

    public function check()
    {
        return \defined('OSCOM_APP_PAYPAL_LOGIN_STATUS');
    }

    public function install(): void
    {
        tep_redirect(tep_href_link('paypal.php', 'action=configure&subaction=install&module=LOGIN'));
    }

    public function remove(): void
    {
        tep_redirect(tep_href_link('paypal.php', 'action=configure&subaction=uninstall&module=LOGIN'));
    }

    public function keys()
    {
        return ['OSCOM_APP_PAYPAL_LOGIN_CONTENT_WIDTH', 'OSCOM_APP_PAYPAL_LOGIN_SORT_ORDER'];
    }

    public function hasAttribute($attribute)
    {
        return \in_array($attribute, explode(';', OSCOM_APP_PAYPAL_LOGIN_ATTRIBUTES), true);
    }

    public function get_default_attributes()
    {
        $data = [];

        foreach (cm_paypal_login_get_attributes() as $group => $attributes) {
            foreach ($attributes as $attribute => $scope) {
                $data[] = $attribute;
            }
        }

        return $data;
    }
}

function cm_paypal_login_get_attributes()
{
    return ['personal' => ['full_name' => 'profile',
        'date_of_birth' => 'profile',
        'age_range' => 'https://uri.paypal.com/services/paypalattributes',
        'gender' => 'profile'],
        'address' => ['email_address' => 'email',
            'street_address' => 'address',
            'city' => 'address',
            'state' => 'address',
            'country' => 'address',
            'zip_code' => 'address',
            'phone' => 'phone'],
        'account' => ['account_status' => 'https://uri.paypal.com/services/paypalattributes',
            'account_type' => 'https://uri.paypal.com/services/paypalattributes',
            'account_creation_date' => 'https://uri.paypal.com/services/paypalattributes',
            'time_zone' => 'profile',
            'locale' => 'profile',
            'language' => 'profile'],
        'checkout' => ['seamless_checkout' => 'https://uri.paypal.com/services/expresscheckout']];
}
