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

function OSCOM_PayPal_Api_DoCapture($OSCOM_PayPal, $server, $extra_params)
{
    if ($server === 'live') {
        $api_url = 'https://api-3t.paypal.com/nvp';
    } else {
        $api_url = 'https://api-3t.sandbox.paypal.com/nvp';
    }

    $params = ['USER' => $OSCOM_PayPal->getApiCredentials($server, 'username'),
        'PWD' => $OSCOM_PayPal->getApiCredentials($server, 'password'),
        'SIGNATURE' => $OSCOM_PayPal->getApiCredentials($server, 'signature'),
        'VERSION' => $OSCOM_PayPal->getApiVersion(),
        'METHOD' => 'DoCapture'];

    if (\is_array($extra_params) && !empty($extra_params)) {
        $params = array_merge($params, $extra_params);
    }

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
