<?php

declare(strict_types=1);

/**
 * This file is part of the DvereCOM package
 *
 *  (c) Šimon Formánek <mail@simonformanek.cz>
 * This file is part of the MultiFlexi package
 *
 * https://pureosc.com/
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

function OSCOM_PayPal_EC_Api_DoExpressCheckoutPayment($OSCOM_PayPal, $server, $extra_params)
{
    if ($server === 'live') {
        $api_url = 'https://api-3t.paypal.com/nvp';
    } else {
        $api_url = 'https://api-3t.sandbox.paypal.com/nvp';
    }

    $params = ['VERSION' => $OSCOM_PayPal->getApiVersion(),
        'METHOD' => 'DoExpressCheckoutPayment',
        'PAYMENTREQUEST_0_PAYMENTACTION' => ((OSCOM_APP_PAYPAL_EC_TRANSACTION_METHOD === '1') || !$OSCOM_PayPal->hasCredentials('EC') ? 'Sale' : 'Authorization'),
        'BUTTONSOURCE' => $OSCOM_PayPal->getIdentifier()];

    if ($OSCOM_PayPal->hasCredentials('EC')) {
        $params['USER'] = $OSCOM_PayPal->getCredentials('EC', 'username');
        $params['PWD'] = $OSCOM_PayPal->getCredentials('EC', 'password');
        $params['SIGNATURE'] = $OSCOM_PayPal->getCredentials('EC', 'signature');
    } else {
        $params['SUBJECT'] = $OSCOM_PayPal->getCredentials('EC', 'email');
    }

    if (\is_array($extra_params) && !empty($extra_params)) {
        $params = array_merge($params, $extra_params);
    }

    $post_string = '';

    foreach ($params as $key => $value) {
        $post_string .= $key.'='.urlencode(utf8_encode(trim($value))).'&';
    }

    $post_string = substr($post_string, 0, -1);

    $response = $OSCOM_PayPal->makeApiCall($api_url, $post_string);
    parse_str($response, $response_array);

    return ['res' => $response_array,
        'success' => \in_array($response_array['ACK'], ['Success', 'SuccessWithWarning'], true),
        'req' => $params];
}
