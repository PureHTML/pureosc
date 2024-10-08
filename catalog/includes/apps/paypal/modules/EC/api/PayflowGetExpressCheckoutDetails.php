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
 *
 * @param mixed $OSCOM_PayPal
 * @param mixed $server
 * @param mixed $extra_params
 */
function OSCOM_PayPal_EC_Api_PayflowGetExpressCheckoutDetails($OSCOM_PayPal, $server, $extra_params)
{
    if ($server === 'live') {
        $api_url = 'https://payflowpro.paypal.com';
    } else {
        $api_url = 'https://pilot-payflowpro.paypal.com';
    }

    $params = ['USER' => $OSCOM_PayPal->hasCredentials('DP', 'payflow_user') ? $OSCOM_PayPal->getCredentials('DP', 'payflow_user') : $OSCOM_PayPal->getCredentials('DP', 'payflow_vendor'),
        'VENDOR' => $OSCOM_PayPal->getCredentials('DP', 'payflow_vendor'),
        'PARTNER' => $OSCOM_PayPal->getCredentials('DP', 'payflow_partner'),
        'PWD' => $OSCOM_PayPal->getCredentials('DP', 'payflow_password'),
        'TENDER' => 'P',
        'TRXTYPE' => (OSCOM_APP_PAYPAL_DP_TRANSACTION_METHOD === '1') ? 'S' : 'A',
        'ACTION' => 'G'];

    if (\is_array($extra_params) && !empty($extra_params)) {
        $params = array_merge($params, $extra_params);
    }

    $post_string = '';

    foreach ($params as $key => $value) {
        $post_string .= $key.'['.\strlen(trim($value)).']='.trim($value).'&';
    }

    $post_string = substr($post_string, 0, -1);

    $response = $OSCOM_PayPal->makeApiCall($api_url, $post_string, $headers);
    parse_str($response, $response_array);

    if ($response_array['RESULT'] !== '0') {
        switch ($response_array['RESULT']) {
            case '1':
            case '26':
                $error_message = $OSCOM_PayPal->getDef('module_ec_error_configuration');

                break;
            case '7':
                $error_message = $OSCOM_PayPal->getDef('module_ec_error_address');

                break;
            case '12':
                $error_message = $OSCOM_PayPal->getDef('module_ec_error_declined');

                break;
            case '1000':
                $error_message = $OSCOM_PayPal->getDef('module_ec_error_express_disabled');

                break;

            default:
                $error_message = $OSCOM_PayPal->getDef('module_ec_error_general');

                break;
        }

        $response_array['OSCOM_ERROR_MESSAGE'] = $error_message;
    }

    return ['res' => $response_array,
        'success' => ($response_array['RESULT'] === '0'),
        'req' => $params];
}
