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

function OSCOM_PayPal_LOGIN_Api_UserInfo($OSCOM_PayPal, $server, $params)
{
    if ($server === 'live') {
        $api_url = 'https://api.paypal.com/v1/identity/openidconnect/userinfo/?schema=openid&access_token='.$params['access_token'];
    } else {
        $api_url = 'https://api.sandbox.paypal.com/v1/identity/openidconnect/userinfo/?schema=openid&access_token='.$params['access_token'];
    }

    $response = $OSCOM_PayPal->makeApiCall($api_url);
    $response_array = json_decode($response, true);

    return ['res' => $response_array,
        'success' => (\is_array($response_array) && !isset($response_array['error'])),
        'req' => $params];
}
