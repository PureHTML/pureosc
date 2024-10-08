<?php

declare(strict_types=1);

/**
 * osCommerce, Open Source E-Commerce Solutions
 * http://www.oscommerce.com
 *
 * Copyright (c) 2020 osCommerce
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
 * @param mixed      $OSCOM_PayPal
 * @param mixed      $server
 * @param null|mixed $extra_params
 */
function OSCOM_PayPal_EC_Api_GetPalDetails($OSCOM_PayPal, $server, $extra_params = null)
{
    if ($server === 'live') {
        $api_url = 'https://api-3t.paypal.com/nvp';
    } else {
        $api_url = 'https://api-3t.sandbox.paypal.com/nvp';
    }

    $params = ['VERSION' => $OSCOM_PayPal->getApiVersion(),
        'METHOD' => 'GetPalDetails',
        'USER' => $OSCOM_PayPal->getCredentials('EC', 'username'),
        'PWD' => $OSCOM_PayPal->getCredentials('EC', 'password'),
        'SIGNATURE' => $OSCOM_PayPal->getCredentials('EC', 'signature')];

    $post_string = '';

    foreach ($params as $key => $value) {
        $post_string .= $key.'='.urlencode(tep_utf8_encode(trim($value))).'&';
    }

    $post_string = substr($post_string, 0, -1);

    $response = $OSCOM_PayPal->makeApiCall($api_url, $post_string);
    parse_str($response, $response_array);

    return ['res' => $response_array,
        'success' => isset($response_array['PAL']),
        'req' => $params];
}
