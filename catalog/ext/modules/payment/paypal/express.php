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

chdir('../../../../');

require 'includes/application_top.php';

// initialize variables if the customer is not logged in
if (!isset($_SESSION['customer_id'])) {
    $customer_id = 0;
    $customer_default_address_id = 0;
}

require 'includes/modules/payment/paypal_express.php';
$paypal_express = new paypal_express();

if (!$paypal_express->check() || !$paypal_express->enabled) {
    tep_redirect(tep_href_link('shopping_cart.php'));
}

require DIR_FS_CATALOG.'includes/languages/'.$language.'/create_account.php';

if (!isset($_SESSION['sendto'])) {
    if (isset($_SESSION['customer_id'])) {
        $sendto = $customer_default_address_id;
    } else {
        $country = tep_get_countries(STORE_COUNTRY, true);

        $sendto = ['firstname' => '',
            'lastname' => '',
            'company' => '',
            'street_address' => '',
            'suburb' => '',
            'postcode' => '',
            'city' => '',
            'zone_id' => STORE_ZONE,
            'zone_name' => tep_get_zone_name(STORE_COUNTRY, STORE_ZONE, ''),
            'country_id' => STORE_COUNTRY,
            'country_name' => $country['countries_name'],
            'country_iso_code_2' => $country['countries_iso_code_2'],
            'country_iso_code_3' => $country['countries_iso_code_3'],
            'address_format_id' => tep_get_address_format_id(STORE_COUNTRY)];
    }
}

if (!isset($_SESSION['billto'])) {
    $billto = $sendto;
}

// register a random ID in the session to check throughout the checkout procedure
// against alterations in the shopping cart contents
if (!isset($_SESSION['cartID'])) {
    tep_session_register('cartID');
}

$cartID = $cart->cartID;

if (isset($_GET['osC_Action'])) {
    switch ($_GET['osC_Action']) {
        case 'setECError':
            tep_redirect(tep_href_link('shopping_cart.php', 'error_message='.$paypal_express->_app->getDef('module_ec_error_setexpresscheckout_call')));

            break;
        case 'cancel':
            unset($_SESSION['appPayPalEcResult'], $_SESSION['appPayPalEcSecret']);

            if (empty($sendto['firstname']) && empty($sendto['lastname']) && empty($sendto['street_address'])) {
                unset($_SESSION['sendto']);
            }

            if (empty($billto['firstname']) && empty($billto['lastname']) && empty($billto['street_address'])) {
                unset($_SESSION['billto']);
            }

            tep_redirect(tep_href_link('shopping_cart.php'));

            break;
        case 'callbackSet':
            if ((OSCOM_APP_PAYPAL_GATEWAY === '1') && (OSCOM_APP_PAYPAL_EC_INSTANT_UPDATE === '1')) {
                $log_sane = [];

                $counter = 0;

                if (isset($_POST['CURRENCYCODE']) && $currencies->is_set($_POST['CURRENCYCODE']) && ($currency !== $_POST['CURRENCYCODE'])) {
                    $currency = $_POST['CURRENCYCODE'];

                    $log_sane['CURRENCYCODE'] = $_POST['CURRENCYCODE'];
                }

                while (true) {
                    if (isset($_POST['L_NUMBER'.$counter], $_POST['L_QTY'.$counter])) {
                        $cart->add_cart($_POST['L_NUMBER'.$counter], $_POST['L_QTY'.$counter]);

                        $log_sane['L_NUMBER'.$counter] = $_POST['L_NUMBER'.$counter];
                        $log_sane['L_QTY'.$counter] = $_POST['L_QTY'.$counter];
                    } else {
                        break;
                    }

                    ++$counter;
                }

                // exit if there is nothing in the shopping cart
                if ($cart->count_contents() < 1) {
                    exit;
                }

                $sendto = ['firstname' => '',
                    'lastname' => '',
                    'company' => '',
                    'street_address' => $_POST['SHIPTOSTREET'],
                    'suburb' => $_POST['SHIPTOSTREET2'],
                    'postcode' => $_POST['SHIPTOZIP'],
                    'city' => $_POST['SHIPTOCITY'],
                    'zone_id' => '',
                    'zone_name' => $_POST['SHIPTOSTATE'],
                    'country_id' => '',
                    'country_name' => $_POST['SHIPTOCOUNTRY'],
                    'country_iso_code_2' => '',
                    'country_iso_code_3' => '',
                    'address_format_id' => ''];

                $log_sane['SHIPTOSTREET'] = $_POST['SHIPTOSTREET'];
                $log_sane['SHIPTOSTREET2'] = $_POST['SHIPTOSTREET2'];
                $log_sane['SHIPTOZIP'] = $_POST['SHIPTOZIP'];
                $log_sane['SHIPTOCITY'] = $_POST['SHIPTOCITY'];
                $log_sane['SHIPTOSTATE'] = $_POST['SHIPTOSTATE'];
                $log_sane['SHIPTOCOUNTRY'] = $_POST['SHIPTOCOUNTRY'];

                $country_query = tep_db_query("select * from countries where countries_iso_code_2 = '".tep_db_input($sendto['country_name'])."' limit 1");

                if (tep_db_num_rows($country_query)) {
                    $country = tep_db_fetch_array($country_query);

                    $sendto['country_id'] = $country['countries_id'];
                    $sendto['country_name'] = $country['countries_name'];
                    $sendto['country_iso_code_2'] = $country['countries_iso_code_2'];
                    $sendto['country_iso_code_3'] = $country['countries_iso_code_3'];
                    $sendto['address_format_id'] = $country['address_format_id'];
                }

                if ($sendto['country_id'] > 0) {
                    $zone_query = tep_db_query("select * from zones where zone_country_id = '".(int) $sendto['country_id']."' and (zone_name = '".tep_db_input($sendto['zone_name'])."' or zone_code = '".tep_db_input($sendto['zone_name'])."') limit 1");

                    if (tep_db_num_rows($zone_query)) {
                        $zone = tep_db_fetch_array($zone_query);

                        $sendto['zone_id'] = $zone['zone_id'];
                        $sendto['zone_name'] = $zone['zone_name'];
                    }
                }

                $billto = $sendto;

                $quotes_array = [];

                include DIR_FS_CATALOG.'includes/classes/order.php';
                $order = new order();

                if ($cart->get_content_type() !== 'virtual') {
                    $total_weight = $cart->show_weight();
                    $total_count = $cart->count_contents();

                    // load all enabled shipping modules
                    include DIR_FS_CATALOG.'includes/classes/shipping.php';
                    $shipping_modules = new shipping();

                    $free_shipping = false;

                    if (\defined('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING') && (MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING === 'true')) {
                        $pass = false;

                        switch (MODULE_ORDER_TOTAL_SHIPPING_DESTINATION) {
                            case 'national':
                                if ($order->delivery['country_id'] === STORE_COUNTRY) {
                                    $pass = true;
                                }

                                break;
                            case 'international':
                                if ($order->delivery['country_id'] !== STORE_COUNTRY) {
                                    $pass = true;
                                }

                                break;
                            case 'both':
                                $pass = true;

                                break;
                        }

                        if (($pass === true) && ($order->info['total'] >= MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER)) {
                            $free_shipping = true;

                            include DIR_FS_CATALOG.'includes/languages/'.$language.'/modules/order_total/ot_shipping.php';
                        }
                    }

                    if ((tep_count_shipping_modules() > 0) || ($free_shipping === true)) {
                        if ($free_shipping === true) {
                            $quotes_array[] = ['id' => 'free_free',
                                'name' => FREE_SHIPPING_TITLE,
                                'label' => '',
                                'cost' => '0',
                                'tax' => '0'];
                        } else {
                            // get all available shipping quotes
                            $quotes = $shipping_modules->quote();

                            foreach ($quotes as $quote) {
                                if (!isset($quote['error'])) {
                                    foreach ($quote['methods'] as $rate) {
                                        $quotes_array[] = ['id' => $quote['id'].'_'.$rate['id'],
                                            'name' => $quote['module'],
                                            'label' => $rate['title'],
                                            'cost' => $rate['cost'],
                                            'tax' => $quote['tax'] ?? '0'];
                                    }
                                }
                            }
                        }
                    }
                } else {
                    $quotes_array[] = ['id' => 'null',
                        'name' => 'No Shipping',
                        'label' => '',
                        'cost' => '0',
                        'tax' => '0'];
                }

                include DIR_FS_CATALOG.'includes/classes/order_total.php';
                $order_total_modules = new order_total();
                $order_totals = $order_total_modules->process();

                $params = ['METHOD' => 'CallbackResponse',
                    'CALLBACKVERSION' => $paypal_express->api_version];

                if (!empty($quotes_array)) {
                    $params['CURRENCYCODE'] = $currency;
                    $params['OFFERINSURANCEOPTION'] = 'false';

                    $counter = 0;
                    $cheapest_rate = null;
                    $cheapest_counter = $counter;
                    $selected_shipping_id = $_GET['osc_shipping_id'] ?? null;
                    $selected_shipping_counter = null;

                    foreach ($quotes_array as $quote) {
                        $shipping_rate = $paypal_express->_app->formatCurrencyRaw($quote['cost'] + tep_calculate_tax($quote['cost'], $quote['tax']));

                        $params['L_SHIPPINGOPTIONNAME'.$counter] = $quote['name'];
                        $params['L_SHIPPINGOPTIONLABEL'.$counter] = $quote['label'];
                        $params['L_SHIPPINGOPTIONAMOUNT'.$counter] = $shipping_rate;
                        $params['L_SHIPPINGOPTIONISDEFAULT'.$counter] = 'false';

                        if (DISPLAY_PRICE_WITH_TAX === 'false') {
                            $params['L_TAXAMT'.$counter] = $paypal_express->_app->formatCurrencyRaw($order->info['tax']);
                        }

                        if (null === $cheapest_rate || ($shipping_rate < $cheapest_rate)) {
                            $cheapest_rate = $shipping_rate;
                            $cheapest_counter = $counter;
                        }

                        if (isset($selected_shipping_id) && ($selected_shipping_id === $quote['id'])) {
                            $selected_shipping_counter = $counter;
                            $log_sane['OSCOM_CUSTOMER_SELECTED_SHIPPING_RATE_ID'] = $quote['id'];
                        }

                        ++$counter;
                    }

                    if (isset($selected_shipping_counter)) {
                        $params['L_SHIPPINGOPTIONISDEFAULT'.$selected_shipping_counter] = 'true';
                    } elseif (method_exists($shipping_modules, 'get_first')) { // select first shipping method
                        $params['L_SHIPPINGOPTIONISDEFAULT0'] = 'true';
                    } else { // select cheapest shipping method
                        $params['L_SHIPPINGOPTIONISDEFAULT'.$cheapest_counter] = 'true';
                    }
                } else {
                    $params['NO_SHIPPING_OPTION_DETAILS'] = '1';
                }

                $post_string = '';

                foreach ($params as $key => $value) {
                    $post_string .= $key.'='.urlencode(tep_utf8_encode(trim($value))).'&';
                }

                $post_string = substr($post_string, 0, -1);

                $paypal_express->_app->log('EC', 'CallbackResponse', 1, $log_sane, $params, (OSCOM_APP_PAYPAL_EC_STATUS === '1') ? 'live' : 'sandbox');

                echo $post_string;
            }

            tep_session_destroy();

            exit;

            break;
        case 'retrieve':
            if (($cart->count_contents() < 1) || !isset($_GET['token']) || empty($_GET['token']) || !isset($_SESSION['appPayPalEcSecret'])) {
                tep_redirect(tep_href_link('shopping_cart.php'));
            }

            if (!isset($_SESSION['appPayPalEcResult']) || ($appPayPalEcResult['TOKEN'] !== $_GET['token'])) {
                tep_session_register('appPayPalEcResult');

                if (OSCOM_APP_PAYPAL_GATEWAY === '1') { // PayPal
                    $appPayPalEcResult = $paypal_express->_app->getApiResult('EC', 'GetExpressCheckoutDetails', ['TOKEN' => $_GET['token']]);
                } else { // Payflow
                    $appPayPalEcResult = $paypal_express->_app->getApiResult('EC', 'PayflowGetExpressCheckoutDetails', ['TOKEN' => $_GET['token']]);
                }
            }

            $pass = false;

            if (OSCOM_APP_PAYPAL_GATEWAY === '1') { // PayPal
                if (\in_array($appPayPalEcResult['ACK'], ['Success', 'SuccessWithWarning'], true)) {
                    $pass = true;
                }
            } else { // Payflow
                if ($appPayPalEcResult['RESULT'] === '0') {
                    $pass = true;
                }
            }

            if ($pass === true) {
                if (OSCOM_APP_PAYPAL_GATEWAY === '1') { // PayPal
                    if ($appPayPalEcResult['PAYMENTREQUEST_0_CUSTOM'] !== $appPayPalEcSecret) {
                        tep_redirect(tep_href_link('shopping_cart.php'));
                    }
                } else { // Payflow
                    if ($appPayPalEcResult['CUSTOM'] !== $appPayPalEcSecret) {
                        tep_redirect(tep_href_link('shopping_cart.php'));
                    }
                }

                if (!isset($_SESSION['payment'])) {
                    tep_session_register('payment');
                }

                $payment = $paypal_express->code;

                $force_login = false;

                // check if e-mail address exists in database and login or create customer account
                if (!isset($_SESSION['customer_id'])) {
                    $force_login = true;

                    $email_address = tep_db_prepare_input($appPayPalEcResult['EMAIL']);

                    $check_query = tep_db_query("select * from customers where customers_email_address = '".tep_db_input($email_address)."' limit 1");

                    if (tep_db_num_rows($check_query)) {
                        $check = tep_db_fetch_array($check_query);

                        // Force the customer to log into their local account if payerstatus is unverified and a local password is set
                        if (($appPayPalEcResult['PAYERSTATUS'] === 'unverified') && !empty($check['customers_password'])) {
                            $messageStack->add_session('login', $paypal_express->_app->getDef('module_ec_error_local_login_required'), 'warning');

                            $navigation->set_snapshot();

                            $login_url = tep_href_link('login.php');
                            $login_email_address = tep_output_string($appPayPalEcResult['EMAIL']);

                            $output = <<<EOD
<form name="pe" action="{$login_url}" method="post" target="_top">
  <input type="hidden" name="email_address" value="{$login_email_address}" />
</form>
<script>
document.pe.submit();
</script>
EOD;

                            echo $output;

                            exit;
                        }

                        $customer_id = $check['customers_id'];
                        $customers_firstname = $check['customers_firstname'];
                        $customer_default_address_id = $check['customers_default_address_id'];
                    } else {
                        $customers_firstname = tep_db_prepare_input($appPayPalEcResult['FIRSTNAME']);
                        $customers_lastname = tep_db_prepare_input($appPayPalEcResult['LASTNAME']);

                        $sql_data_array = ['customers_firstname' => $customers_firstname,
                            'customers_lastname' => $customers_lastname,
                            'customers_email_address' => $email_address,
                            'customers_telephone' => '',
                            'customers_fax' => '',
                            'customers_newsletter' => '0',
                            'customers_password' => '',
                            'customers_gender' => '']; // v22rc2a compatibility

                        if (isset($appPayPalEcResult['PHONENUM']) && !empty($appPayPalEcResult['PHONENUM'])) {
                            $customers_telephone = tep_db_prepare_input($appPayPalEcResult['PHONENUM']);

                            $sql_data_array['customers_telephone'] = $customers_telephone;
                        }

                        tep_db_perform('customers', $sql_data_array);

                        $customer_id = tep_db_insert_id();

                        tep_db_query("insert into customers_info (customers_info_id, customers_info_number_of_logons, customers_info_date_account_created) values ('".(int) $customer_id."', '0', now())");

                        // Only generate a password and send an email if the Set Password Content Module is not enabled
                        if (!\defined('MODULE_CONTENT_ACCOUNT_SET_PASSWORD_STATUS') || (MODULE_CONTENT_ACCOUNT_SET_PASSWORD_STATUS !== 'True')) {
                            $customer_password = tep_create_random_value(max(ENTRY_PASSWORD_MIN_LENGTH, 8));

                            tep_db_perform('customers', ['customers_password' => tep_encrypt_password($customer_password)], 'update', 'customers_id = "'.(int) $customer_id.'"');

                            // build the message content
                            $name = $customers_firstname.' '.$customers_lastname;
                            $email_text = sprintf(EMAIL_GREET_NONE, $customers_firstname).EMAIL_WELCOME.$paypal_express->_app->getDef('module_ec_email_account_password', ['email_address' => $email_address, 'password' => $customer_password])."\n\n".EMAIL_TEXT.EMAIL_CONTACT.EMAIL_WARNING;
                            tep_mail($name, $email_address, EMAIL_SUBJECT, $email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
                        }
                    }

                    if (SESSION_RECREATE === 'True') {
                        tep_session_recreate();
                    }

                    $customer_first_name = $customers_firstname;
                    tep_session_register('customer_id');
                    tep_session_register('customer_first_name');

                    // reset session token
                    $sessiontoken = md5(tep_rand().tep_rand().tep_rand().tep_rand());
                }

                // check if paypal shipping address exists in the address book
                if (OSCOM_APP_PAYPAL_GATEWAY === '1') { // PayPal
                    $ship_firstname = tep_db_prepare_input(substr($appPayPalEcResult['PAYMENTREQUEST_0_SHIPTONAME'], 0, strpos($appPayPalEcResult['PAYMENTREQUEST_0_SHIPTONAME'], ' ')));
                    $ship_lastname = tep_db_prepare_input(substr($appPayPalEcResult['PAYMENTREQUEST_0_SHIPTONAME'], strpos($appPayPalEcResult['PAYMENTREQUEST_0_SHIPTONAME'], ' ') + 1));
                    $ship_address = tep_db_prepare_input($appPayPalEcResult['PAYMENTREQUEST_0_SHIPTOSTREET']);
                    $ship_suburb = (isset($appPayPalEcResult['PAYMENTREQUEST_0_SHIPTOSTREET2']) ? tep_db_prepare_input($appPayPalEcResult['PAYMENTREQUEST_0_SHIPTOSTREET2']) : '');
                    $ship_city = tep_db_prepare_input($appPayPalEcResult['PAYMENTREQUEST_0_SHIPTOCITY']);
                    $ship_zone = (isset($appPayPalEcResult['PAYMENTREQUEST_0_SHIPTOSTATE']) ? tep_db_prepare_input($appPayPalEcResult['PAYMENTREQUEST_0_SHIPTOSTATE']) : '');
                    $ship_postcode = tep_db_prepare_input($appPayPalEcResult['PAYMENTREQUEST_0_SHIPTOZIP']);
                    $ship_country = tep_db_prepare_input($appPayPalEcResult['PAYMENTREQUEST_0_SHIPTOCOUNTRYCODE']);
                } else { // Payflow
                    $ship_firstname = tep_db_prepare_input(substr($appPayPalEcResult['SHIPTONAME'], 0, strpos($appPayPalEcResult['SHIPTONAME'], ' ')));
                    $ship_lastname = tep_db_prepare_input(substr($appPayPalEcResult['SHIPTONAME'], strpos($appPayPalEcResult['SHIPTONAME'], ' ') + 1));
                    $ship_address = tep_db_prepare_input($appPayPalEcResult['SHIPTOSTREET']);
                    $ship_suburb = tep_db_prepare_input($appPayPalEcResult['SHIPTOSTREET2']);
                    $ship_city = tep_db_prepare_input($appPayPalEcResult['SHIPTOCITY']);
                    $ship_zone = tep_db_prepare_input($appPayPalEcResult['SHIPTOSTATE']);
                    $ship_postcode = tep_db_prepare_input($appPayPalEcResult['SHIPTOZIP']);
                    $ship_country = tep_db_prepare_input($appPayPalEcResult['SHIPTOCOUNTRY']);
                }

                $ship_zone_id = 0;
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

                $check_query = tep_db_query("select address_book_id from address_book where customers_id = '".(int) $customer_id."' and entry_firstname = '".tep_db_input($ship_firstname)."' and entry_lastname = '".tep_db_input($ship_lastname)."' and entry_street_address = '".tep_db_input($ship_address)."' and entry_suburb = '".tep_db_input($ship_suburb)."' and entry_postcode = '".tep_db_input($ship_postcode)."' and entry_city = '".tep_db_input($ship_city)."' and (entry_state = '".tep_db_input($ship_zone)."' or entry_zone_id = '".(int) $ship_zone_id."') and entry_country_id = '".(int) $ship_country_id."' limit 1");

                if (tep_db_num_rows($check_query)) {
                    $check = tep_db_fetch_array($check_query);

                    $sendto = $check['address_book_id'];
                } else {
                    $sql_data_array = ['customers_id' => $customer_id,
                        'entry_firstname' => $ship_firstname,
                        'entry_lastname' => $ship_lastname,
                        'entry_street_address' => $ship_address,
                        'entry_suburb' => $ship_suburb,
                        'entry_postcode' => $ship_postcode,
                        'entry_city' => $ship_city,
                        'entry_country_id' => $ship_country_id,
                        'entry_gender' => '']; // v22rc2a compatibility

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

                $billto = $sendto;

                if (!isset($_SESSION['sendto'])) {
                    tep_session_register('sendto');
                }

                if (!isset($_SESSION['billto'])) {
                    tep_session_register('billto');
                }

                if ($force_login === true) {
                    $customer_country_id = $ship_country_id;
                    $customer_zone_id = $ship_zone_id;
                    tep_session_register('customer_default_address_id');
                    tep_session_register('customer_country_id');
                    tep_session_register('customer_zone_id');
                }

                include DIR_FS_CATALOG.'includes/classes/order.php';
                $order = new order();

                if ($cart->get_content_type() !== 'virtual') {
                    $total_weight = $cart->show_weight();
                    $total_count = $cart->count_contents();

                    // load all enabled shipping modules
                    include DIR_FS_CATALOG.'includes/classes/shipping.php';
                    $shipping_modules = new shipping();

                    $free_shipping = false;

                    if (\defined('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING') && (MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING === 'true')) {
                        $pass = false;

                        switch (MODULE_ORDER_TOTAL_SHIPPING_DESTINATION) {
                            case 'national':
                                if ($order->delivery['country_id'] === STORE_COUNTRY) {
                                    $pass = true;
                                }

                                break;
                            case 'international':
                                if ($order->delivery['country_id'] !== STORE_COUNTRY) {
                                    $pass = true;
                                }

                                break;
                            case 'both':
                                $pass = true;

                                break;
                        }

                        if (($pass === true) && ($order->info['total'] >= MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER)) {
                            $free_shipping = true;

                            include DIR_FS_CATALOG.'includes/languages/'.$language.'/modules/order_total/ot_shipping.php';
                        }
                    }

                    if (!isset($_SESSION['shipping'])) {
                        tep_session_register('shipping');
                        $shipping = false;
                    }

                    if ((tep_count_shipping_modules() > 0) || ($free_shipping === true)) {
                        if ($free_shipping === true) {
                            $shipping = 'free_free';
                        } else {
                            // get all available shipping quotes
                            $quotes = $shipping_modules->quote();

                            $shipping_set = false;

                            if ((OSCOM_APP_PAYPAL_GATEWAY === '1') && (OSCOM_APP_PAYPAL_EC_INSTANT_UPDATE === '1') && ((OSCOM_APP_PAYPAL_EC_STATUS === '0') || ((OSCOM_APP_PAYPAL_EC_STATUS === '1') && (ENABLE_SSL === true))) && (OSCOM_APP_PAYPAL_EC_CHECKOUT_FLOW === '0')) { // Live server requires SSL to be enabled
                                // if available, set the selected shipping rate from PayPals order review page
                                if (isset($appPayPalEcResult['SHIPPINGOPTIONNAME'], $appPayPalEcResult['SHIPPINGOPTIONAMOUNT'])) {
                                    foreach ($quotes as $quote) {
                                        if (!isset($quote['error'])) {
                                            foreach ($quote['methods'] as $rate) {
                                                if ($appPayPalEcResult['SHIPPINGOPTIONNAME'] === trim($quote['module'].' '.$rate['title'])) {
                                                    $shipping_rate = $paypal_express->_app->formatCurrencyRaw($rate['cost'] + tep_calculate_tax($rate['cost'], $quote['tax'] ?? null));

                                                    if ($appPayPalEcResult['SHIPPINGOPTIONAMOUNT'] === $shipping_rate) {
                                                        $shipping = $quote['id'].'_'.$rate['id'];
                                                        $shipping_set = true;

                                                        break 2;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }

                            if ($shipping_set === false) {
                                $shipping_selected = false;

                                $module = null;
                                $method = null;

                                if (\is_array($shipping) && isset($shipping['id']) && (strpos($shipping['id'], '_') !== false)) {
                                    [$module, $method] = explode('_', $shipping['id']);
                                } elseif (\is_string($shipping) && !empty($shipping) && (strpos($shipping, '_') !== false)) {
                                    [$module, $method] = explode('_', $shipping);
                                }

                                foreach ($quotes as $quote) {
                                    if ($quote['id'] === $module) {
                                        foreach ($quote['methods'] as $m) {
                                            if ($m['id'] === $method) {
                                                $shipping = $quote['id'].'_'.$m['id'];
                                                $shipping_selected = true;

                                                break 2;
                                            }
                                        }
                                    }
                                }

                                if ($shipping_selected === false) {
                                    if (method_exists($shipping_modules, 'get_first')) { // select first shipping method
                                        $shipping = $shipping_modules->get_first();
                                    } else { // select cheapest shipping method
                                        $shipping = $shipping_modules->cheapest();
                                    }

                                    $shipping = $shipping['id'];
                                }
                            }
                        }
                    } else {
                        if (\defined('SHIPPING_ALLOW_UNDEFINED_ZONES') && (SHIPPING_ALLOW_UNDEFINED_ZONES === 'False')) {
                            unset($_SESSION['shipping']);

                            $messageStack->add_session('checkout_address', $paypal_express->_app->getDef('module_ec_error_no_shipping_available'), 'error');

                            tep_session_register('appPayPalEcRightTurn');
                            $appPayPalEcRightTurn = true;

                            tep_redirect(tep_href_link('checkout_shipping_address.php'));
                        }
                    }

                    if (strpos($shipping, '_')) {
                        [$module, $method] = explode('_', $shipping);

                        if (\is_object(${$module}) || ($shipping === 'free_free')) {
                            if ($shipping === 'free_free') {
                                $quote[0]['methods'][0]['title'] = FREE_SHIPPING_TITLE;
                                $quote[0]['methods'][0]['cost'] = '0';
                            } else {
                                $quote = $shipping_modules->quote($method, $module);
                            }

                            if (isset($quote['error'])) {
                                unset($_SESSION['shipping']);

                                tep_redirect(tep_href_link('checkout_shipping.php'));
                            } else {
                                if ((isset($quote[0]['methods'][0]['title'])) && (isset($quote[0]['methods'][0]['cost']))) {
                                    $shipping = ['id' => $shipping,
                                        'title' => (($free_shipping === true) ? $quote[0]['methods'][0]['title'] : $quote[0]['module'].' '.$quote[0]['methods'][0]['title']),
                                        'cost' => $quote[0]['methods'][0]['cost']];
                                }
                            }
                        }
                    }
                } else {
                    if (!isset($_SESSION['shipping'])) {
                        tep_session_register('shipping');
                    }

                    $shipping = false;

                    $sendto = false;
                }

                if (isset($_SESSION['shipping'])) {
                    tep_redirect(tep_href_link('checkout_confirmation.php'));
                } else {
                    tep_session_register('appPayPalEcRightTurn');
                    $appPayPalEcRightTurn = true;

                    tep_redirect(tep_href_link('checkout_shipping.php'));
                }
            } else {
                if (OSCOM_APP_PAYPAL_GATEWAY === '1') { // PayPal
                    $messageStack->add_session('header', stripslashes($appPayPalEcResult['L_LONGMESSAGE0']), 'error');
                } else { // Payflow
                    $messageStack->add_session('header', $appPayPalEcResult['OSCOM_ERROR_MESSAGE'], 'error');
                }

                tep_redirect(tep_href_link('shopping_cart.php'));
            }

            break;
    }
} else {
    // if there is nothing in the customers cart, redirect them to the shopping cart page
    if ($cart->count_contents() < 1) {
        tep_redirect(tep_href_link('shopping_cart.php'));
    }

    if (OSCOM_APP_PAYPAL_EC_STATUS === '1') {
        if ((OSCOM_APP_PAYPAL_GATEWAY === '1') && (OSCOM_APP_PAYPAL_EC_CHECKOUT_FLOW === '1')) {
            $paypal_url = 'https://www.paypal.com/checkoutnow?';
        } else {
            $paypal_url = 'https://www.paypal.com/cgi-bin/webscr?cmd=_express-checkout&';
        }
    } else {
        if ((OSCOM_APP_PAYPAL_GATEWAY === '1') && (OSCOM_APP_PAYPAL_EC_CHECKOUT_FLOW === '1')) {
            $paypal_url = 'https://www.sandbox.paypal.com/checkoutnow?';
        } else {
            $paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_express-checkout&';
        }
    }

    include DIR_FS_CATALOG.'includes/classes/order.php';
    $order = new order();

    $params = [];

    if (OSCOM_APP_PAYPAL_GATEWAY === '1') { // PayPal
        $params['PAYMENTREQUEST_0_CURRENCYCODE'] = $order->info['currency'];
    } else { // Payflow
        $params['CURRENCY'] = $order->info['currency'];
        $params['EMAIL'] = $order->customer['email_address'];

        $params['BILLTOFIRSTNAME'] = $order->billing['firstname'];
        $params['BILLTOLASTNAME'] = $order->billing['lastname'];
        $params['BILLTOSTREET'] = $order->billing['street_address'];
        $params['BILLTOSTREET2'] = $order->billing['suburb'];
        $params['BILLTOCITY'] = $order->billing['city'];
        $params['BILLTOSTATE'] = tep_get_zone_code($order->billing['country']['id'], $order->billing['zone_id'], $order->billing['state']);
        $params['BILLTOCOUNTRY'] = $order->billing['country']['iso_code_2'];
        $params['BILLTOZIP'] = $order->billing['postcode'];
    }

    // A billing address is required for digital orders so we use the shipping address PayPal provides
    //      if ($order->content_type == 'virtual') {
    //        $params['NOSHIPPING'] = '1';
    //      }

    $item_params = [];

    $line_item_no = 0;

    foreach ($order->products as $product) {
        if (DISPLAY_PRICE_WITH_TAX === 'true') {
            $product_price = $paypal_express->_app->formatCurrencyRaw($product['final_price'] + tep_calculate_tax($product['final_price'], $product['tax']));
        } else {
            $product_price = $paypal_express->_app->formatCurrencyRaw($product['final_price']);
        }

        if (OSCOM_APP_PAYPAL_GATEWAY === '1') { // PayPal
            $item_params['L_PAYMENTREQUEST_0_NAME'.$line_item_no] = $product['name'];
            $item_params['L_PAYMENTREQUEST_0_AMT'.$line_item_no] = $product_price;
            $item_params['L_PAYMENTREQUEST_0_NUMBER'.$line_item_no] = $product['id'];
            $item_params['L_PAYMENTREQUEST_0_QTY'.$line_item_no] = $product['qty'];
            $item_params['L_PAYMENTREQUEST_0_ITEMURL'.$line_item_no] = tep_href_link('product_info.php', 'products_id='.$product['id'], 'SSL', false);

            if ((DOWNLOAD_ENABLED === 'true') && isset($product['attributes'])) {
                $item_params['L_PAYMENTREQUEST_0_ITEMCATEGORY'.$line_item_no] = $paypal_express->getProductType($product['id'], $product['attributes']);
            } else {
                $item_params['L_PAYMENTREQUEST_0_ITEMCATEGORY'.$line_item_no] = 'Physical';
            }
        } else { // Payflow
            $item_params['L_NAME'.$line_item_no] = $product['name'];
            $item_params['L_COST'.$line_item_no] = $product_price;
            $item_params['L_QTY'.$line_item_no] = $product['qty'];
        }

        ++$line_item_no;
    }

    if (!empty($order->delivery['street_address'])) {
        if (OSCOM_APP_PAYPAL_GATEWAY === '1') { // PayPal
            $params['PAYMENTREQUEST_0_SHIPTONAME'] = $order->delivery['firstname'].' '.$order->delivery['lastname'];
            $params['PAYMENTREQUEST_0_SHIPTOSTREET'] = $order->delivery['street_address'];
            $params['PAYMENTREQUEST_0_SHIPTOSTREET2'] = $order->delivery['suburb'];
            $params['PAYMENTREQUEST_0_SHIPTOCITY'] = $order->delivery['city'];
            $params['PAYMENTREQUEST_0_SHIPTOSTATE'] = tep_get_zone_code($order->delivery['country']['id'], $order->delivery['zone_id'], $order->delivery['state']);
            $params['PAYMENTREQUEST_0_SHIPTOCOUNTRYCODE'] = $order->delivery['country']['iso_code_2'];
            $params['PAYMENTREQUEST_0_SHIPTOZIP'] = $order->delivery['postcode'];
        } else { // Payflow
            $params['SHIPTONAME'] = $order->delivery['firstname'].' '.$order->delivery['lastname'];
            $params['SHIPTOSTREET'] = $order->delivery['street_address'];
            $params['SHIPTOSTREET2'] = $order->delivery['suburb'];
            $params['SHIPTOCITY'] = $order->delivery['city'];
            $params['SHIPTOSTATE'] = tep_get_zone_code($order->delivery['country']['id'], $order->delivery['zone_id'], $order->delivery['state']);
            $params['SHIPTOCOUNTRY'] = $order->delivery['country']['iso_code_2'];
            $params['SHIPTOZIP'] = $order->delivery['postcode'];
        }
    }

    $paypal_item_total = $paypal_express->_app->formatCurrencyRaw($order->info['subtotal']);

    if ((OSCOM_APP_PAYPAL_GATEWAY === '1') && (OSCOM_APP_PAYPAL_EC_INSTANT_UPDATE === '1') && ((OSCOM_APP_PAYPAL_EC_STATUS === '0') || ((OSCOM_APP_PAYPAL_EC_STATUS === '1') && (ENABLE_SSL === true))) && (OSCOM_APP_PAYPAL_EC_CHECKOUT_FLOW === '0')) { // Live server requires SSL to be enabled
        $quotes_array = [];

        if ($cart->get_content_type() !== 'virtual') {
            $total_weight = $cart->show_weight();
            $total_count = $cart->count_contents();

            // load all enabled shipping modules
            include DIR_FS_CATALOG.'includes/classes/shipping.php';
            $shipping_modules = new shipping();

            $free_shipping = false;

            if (\defined('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING') && (MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING === 'true')) {
                $pass = false;

                switch (MODULE_ORDER_TOTAL_SHIPPING_DESTINATION) {
                    case 'national':
                        if ($order->delivery['country_id'] === STORE_COUNTRY) {
                            $pass = true;
                        }

                        break;
                    case 'international':
                        if ($order->delivery['country_id'] !== STORE_COUNTRY) {
                            $pass = true;
                        }

                        break;
                    case 'both':
                        $pass = true;

                        break;
                }

                if (($pass === true) && ($order->info['total'] >= MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER)) {
                    $free_shipping = true;

                    include DIR_FS_CATALOG.'includes/languages/'.$language.'/modules/order_total/ot_shipping.php';
                }
            }

            if ((tep_count_shipping_modules() > 0) || ($free_shipping === true)) {
                if ($free_shipping === true) {
                    $quotes_array[] = ['id' => 'free_free',
                        'name' => FREE_SHIPPING_TITLE,
                        'label' => '',
                        'cost' => '0.00',
                        'tax' => '0'];
                } else {
                    // get all available shipping quotes
                    $quotes = $shipping_modules->quote();

                    foreach ($quotes as $quote) {
                        if (!isset($quote['error'])) {
                            foreach ($quote['methods'] as $rate) {
                                $quotes_array[] = ['id' => $quote['id'].'_'.$rate['id'],
                                    'name' => $quote['module'],
                                    'label' => $rate['title'],
                                    'cost' => $rate['cost'],
                                    'tax' => ($quote['tax'] ?? null)];
                            }
                        }
                    }
                }
            } else {
                if (\defined('SHIPPING_ALLOW_UNDEFINED_ZONES') && (SHIPPING_ALLOW_UNDEFINED_ZONES === 'False')) {
                    unset($_SESSION['shipping']);

                    $messageStack->add_session('checkout_address', $paypal_express->_app->getDef('module_ec_error_no_shipping_available'), 'error');

                    tep_redirect(tep_href_link('checkout_shipping_address.php'));
                }
            }
        }

        $counter = 0;
        $cheapest_rate = null;
        $expensive_rate = 0;
        $cheapest_counter = $counter;
        $default_shipping = null;
        $selected_shipping_id = null;

        foreach ($quotes_array as $quote) {
            $shipping_rate = $paypal_express->_app->formatCurrencyRaw($quote['cost'] + tep_calculate_tax($quote['cost'], $quote['tax']));

            $item_params['L_SHIPPINGOPTIONNAME'.$counter] = trim($quote['name'].' '.$quote['label']);
            $item_params['L_SHIPPINGOPTIONAMOUNT'.$counter] = $shipping_rate;
            $item_params['L_SHIPPINGOPTIONISDEFAULT'.$counter] = 'false';

            if (null === $cheapest_rate || ($shipping_rate < $cheapest_rate)) {
                $cheapest_rate = $shipping_rate;
                $cheapest_counter = $counter;
            }

            if ($shipping_rate > $expensive_rate) {
                $expensive_rate = $shipping_rate;
            }

            if (isset($_SESSION['shipping']) && ($shipping['id'] === $quote['id'])) {
                $default_shipping = $counter;
                $selected_shipping_id = $shipping['id'];
            }

            ++$counter;
        }

        if (!isset($default_shipping) && !empty($quotes_array)) {
            if (method_exists($shipping_modules, 'get_first')) { // select first shipping method
                $cheapest_counter = 0;
            }

            $shipping = ['id' => $quotes_array[$cheapest_counter]['id'],
                'title' => $item_params['L_SHIPPINGOPTIONNAME'.$cheapest_counter],
                'cost' => $paypal_express->_app->formatCurrencyRaw($quotes_array[$cheapest_counter]['cost'])];

            if (!isset($_SESSION['shipping'])) {
                tep_session_register('shipping');
            }

            $default_shipping = $cheapest_counter;
        }

        if (!isset($default_shipping)) {
            $shipping = false;

            if (!isset($_SESSION['shipping'])) {
                tep_session_register('shipping');
            }
        } else {
            $item_params['PAYMENTREQUEST_0_INSURANCEOPTIONOFFERED'] = 'false';
            $item_params['L_SHIPPINGOPTIONISDEFAULT'.$default_shipping] = 'true';

            // Instant Update
            $item_params['CALLBACK'] = tep_href_link('ext/modules/payment/paypal/express.php', 'osC_Action=callbackSet'.(isset($selected_shipping_id) ? '&osc_shipping_id='.$selected_shipping_id : ''), 'SSL', false, false);

            if (strpos($item_params['CALLBACK'], '&amp;') !== false) {
                $item_params['CALLBACK'] = str_replace('&amp;', '&', $item_params['CALLBACK']);
            }

            $item_params['CALLBACKTIMEOUT'] = '6';
            $item_params['CALLBACKVERSION'] = $paypal_express->api_version;

            // set shipping for order total calculations; shipping in $item_params includes taxes
            $order->info['shipping_method'] = $item_params['L_SHIPPINGOPTIONNAME'.$default_shipping];
            $order->info['shipping_cost'] = $item_params['L_SHIPPINGOPTIONAMOUNT'.$default_shipping];

            $order->info['total'] = $order->info['subtotal'] + $order->info['shipping_cost'];

            if (DISPLAY_PRICE_WITH_TAX === 'false') {
                $order->info['total'] += $order->info['tax'];
            }
        }

        include DIR_FS_CATALOG.'includes/classes/order_total.php';
        $order_total_modules = new order_total();
        $order_totals = $order_total_modules->process();

        // Remove shipping tax from total that was added again in ot_shipping
        if (isset($default_shipping)) {
            if (DISPLAY_PRICE_WITH_TAX === 'true') {
                $order->info['shipping_cost'] /= (1.0 + ($quotes_array[$default_shipping]['tax'] / 100));
            }

            $module = substr($shipping['id'], 0, strpos($shipping['id'], '_'));
            $order->info['tax'] -= tep_calculate_tax($order->info['shipping_cost'], $quotes_array[$default_shipping]['tax']);
            $order->info['tax_groups'][tep_get_tax_description($GLOBALS[$module]->tax_class, $order->delivery['country']['id'], $order->delivery['zone_id'])] -= tep_calculate_tax($order->info['shipping_cost'], $quotes_array[$default_shipping]['tax']);
            $order->info['total'] -= tep_calculate_tax($order->info['shipping_cost'], $quotes_array[$default_shipping]['tax']);
        }

        $items_total = $paypal_express->_app->formatCurrencyRaw($order->info['subtotal']);

        foreach ($order_totals as $ot) {
            if (!\in_array($ot['code'], ['ot_subtotal', 'ot_shipping', 'ot_tax', 'ot_total'], true)) {
                $item_params['L_PAYMENTREQUEST_0_NAME'.$line_item_no] = $ot['title'];
                $item_params['L_PAYMENTREQUEST_0_AMT'.$line_item_no] = $paypal_express->_app->formatCurrencyRaw($ot['value']);

                $items_total += $paypal_express->_app->formatCurrencyRaw($ot['value']);

                ++$line_item_no;
            }
        }

        $params['PAYMENTREQUEST_0_AMT'] = $paypal_express->_app->formatCurrencyRaw($order->info['total']);

        $item_params['MAXAMT'] = $paypal_express->_app->formatCurrencyRaw($params['PAYMENTREQUEST_0_AMT'] + $expensive_rate + 100, '', 1); // safely pad higher for dynamic shipping rates (eg, USPS express)
        $item_params['PAYMENTREQUEST_0_ITEMAMT'] = $items_total;
        $item_params['PAYMENTREQUEST_0_SHIPPINGAMT'] = $paypal_express->_app->formatCurrencyRaw($order->info['shipping_cost']);

        $paypal_item_total = $item_params['PAYMENTREQUEST_0_ITEMAMT'] + $item_params['PAYMENTREQUEST_0_SHIPPINGAMT'];

        if (DISPLAY_PRICE_WITH_TAX === 'false') {
            $item_params['PAYMENTREQUEST_0_TAXAMT'] = $paypal_express->_app->formatCurrencyRaw($order->info['tax']);

            $paypal_item_total += $item_params['PAYMENTREQUEST_0_TAXAMT'];
        }
    } else {
        if (OSCOM_APP_PAYPAL_GATEWAY === '1') { // PayPal
            $params['PAYMENTREQUEST_0_AMT'] = $paypal_item_total;
        } else { // Payflow
            $params['AMT'] = $paypal_item_total;
        }
    }

    if (OSCOM_APP_PAYPAL_GATEWAY === '1') { // PayPal
        if ($paypal_express->_app->formatCurrencyRaw($paypal_item_total) === $params['PAYMENTREQUEST_0_AMT']) {
            $params = array_merge($params, $item_params);
        }
    } else { // Payflow
        if ($paypal_express->_app->formatCurrencyRaw($paypal_item_total) === $params['AMT']) {
            $params = array_merge($params, $item_params);
        }
    }

    $appPayPalEcSecret = tep_create_random_value(16, 'digits');

    if (!isset($_SESSION['appPayPalEcSecret'])) {
        tep_session_register('appPayPalEcSecret');
    }

    if (OSCOM_APP_PAYPAL_GATEWAY === '1') { // PayPal
        $params['PAYMENTREQUEST_0_CUSTOM'] = $appPayPalEcSecret;

        // Log In with PayPal token for seamless checkout
        if (isset($_SESSION['paypal_login_access_token'])) {
            $params['IDENTITYACCESSTOKEN'] = $paypal_login_access_token;
        }

        $response_array = $paypal_express->_app->getApiResult('EC', 'SetExpressCheckout', $params);

        if (\in_array($response_array['ACK'], ['Success', 'SuccessWithWarning'], true)) {
            if (isset($_GET['format']) && ($_GET['format'] === 'json')) {
                $result = [
                    'token' => $response_array['TOKEN'],
                ];

                echo json_encode($result);

                exit;
            }

            tep_redirect($paypal_url.'token='.$response_array['TOKEN']);
        } else {
            if (isset($_GET['format']) && ($_GET['format'] === 'json')) {
                $result = [
                    'token' => '',
                ];

                echo json_encode($result);

                exit;
            }

            tep_redirect(tep_href_link('shopping_cart.php', 'error_message='.stripslashes($response_array['L_LONGMESSAGE0'])));
        }
    } else { // Payflow
        $params['CUSTOM'] = $appPayPalEcSecret;

        $params['_headers'] = ['X-VPS-REQUEST-ID: '.md5($cartID.tep_session_id().$paypal_express->_app->formatCurrencyRaw($paypal_item_total)),
            'X-VPS-CLIENT-TIMEOUT: 45',
            'X-VPS-VIT-INTEGRATION-PRODUCT: OSCOM',
            'X-VPS-VIT-INTEGRATION-VERSION: 2.3'];

        $response_array = $paypal_express->_app->getApiResult('EC', 'PayflowSetExpressCheckout', $params);

        if ($response_array['RESULT'] === '0') {
            tep_redirect($paypal_url.'token='.$response_array['TOKEN']);
        } else {
            tep_redirect(tep_href_link('shopping_cart.php', 'error_message='.urlencode($response_array['OSCOM_ERROR_MESSAGE'])));
        }
    }
}

tep_redirect(tep_href_link('shopping_cart.php'));

require DIR_FS_CATALOG.'includes/application_bottom.php';
