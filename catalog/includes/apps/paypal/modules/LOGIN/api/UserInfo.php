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
 * @param mixed $params
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
