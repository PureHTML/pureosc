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

function OSCOM_PayPal_Api_BMCreateButton($OSCOM_PayPal, $server, $extra_params)
{
    if ($server === 'live') {
        $api_url = 'https://api-3t.paypal.com/nvp';
    } else {
        $api_url = 'https://api-3t.sandbox.paypal.com/nvp';
    }

    $params = ['USER' => $OSCOM_PayPal->getCredentials('HS', 'username'),
        'PWD' => $OSCOM_PayPal->getCredentials('HS', 'password'),
        'SIGNATURE' => $OSCOM_PayPal->getCredentials('HS', 'signature'),
        'VERSION' => $OSCOM_PayPal->getApiVersion(),
        'METHOD' => 'BMCreateButton',
        'BUTTONCODE' => 'TOKEN',
        'BUTTONTYPE' => 'PAYMENT'];

    $l_params = ['business' => $OSCOM_PayPal->getCredentials('HS', 'email'),
        'bn' => $OSCOM_PayPal->getIdentifier()];

    if (\is_array($extra_params) && !empty($extra_params)) {
        $l_params = array_merge($l_params, $extra_params);
    }

    $counter = 0;

    foreach ($l_params as $key => $value) {
        $params['L_BUTTONVAR'.$counter] = $key.'='.$value;

        ++$counter;
    }

    unset($l_params);

    $post_string = '';

    foreach ($params as $key => $value) {
        $post_string .= $key.'='.urlencode(tep_utf8_encode(trim($value))).'&';
    }

    $post_string = substr($post_string, 0, -1);

    $response = $OSCOM_PayPal->makeApiCall($api_url, $post_string);
    parse_str($response, $response_array);

    return ['res' => $response_array,
        'success' => \in_array($response_array['ACK'], ['Success', 'SuccessWithWarning'], true),
        'req' => $params];
}
