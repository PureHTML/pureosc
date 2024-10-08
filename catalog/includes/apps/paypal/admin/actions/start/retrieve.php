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

$params = ['merchant_id' => OSCOM_APP_PAYPAL_START_MERCHANT_ID,
    'secret' => OSCOM_APP_PAYPAL_START_SECRET];

$result_string = $OSCOM_PayPal->makeApiCall('https://www.oscommerce.com/index.php?RPC&Website&Index&PayPalStart&action=retrieve', $params);
$result = [];

if (!empty($result_string) && (substr($result_string, 0, 9) === 'rpcStatus')) {
    $raw = explode("\n", $result_string);

    foreach ($raw as $r) {
        $key = explode('=', $r, 2);

        if (\is_array($key) && (\count($key) === 2) && !empty($key[0]) && !empty($key[1])) {
            $result[$key[0]] = $key[1];
        }
    }

    if (isset($result['rpcStatus']) && ($result['rpcStatus'] === '1') && isset($result['account_type']) && \in_array($result['account_type'], ['live', 'sandbox'], true) && isset($result['api_username'], $result['api_password'], $result['api_signature'])) {
        if ($result['account_type'] === 'live') {
            $param_prefix = 'OSCOM_APP_PAYPAL_LIVE_';
        } else {
            $param_prefix = 'OSCOM_APP_PAYPAL_SANDBOX_';
        }

        $OSCOM_PayPal->saveParameter($param_prefix.'SELLER_EMAIL', str_replace('_api1.', '@', $result['api_username']));
        $OSCOM_PayPal->saveParameter($param_prefix.'SELLER_EMAIL_PRIMARY', str_replace('_api1.', '@', $result['api_username']));
        $OSCOM_PayPal->saveParameter($param_prefix.'MERCHANT_ID', $result['account_id']);
        $OSCOM_PayPal->saveParameter($param_prefix.'API_USERNAME', $result['api_username']);
        $OSCOM_PayPal->saveParameter($param_prefix.'API_PASSWORD', $result['api_password']);
        $OSCOM_PayPal->saveParameter($param_prefix.'API_SIGNATURE', $result['api_signature']);

        $OSCOM_PayPal->deleteParameter('OSCOM_APP_PAYPAL_START_MERCHANT_ID');
        $OSCOM_PayPal->deleteParameter('OSCOM_APP_PAYPAL_START_SECRET');

        $OSCOM_PayPal->addAlert($OSCOM_PayPal->getDef('alert_onboarding_success'), 'success');

        tep_redirect(tep_href_link('paypal.php', 'action=credentials'));
    } else {
        $OSCOM_PayPal->addAlert($OSCOM_PayPal->getDef('alert_onboarding_retrieve_error'), 'error');
    }
} else {
    $OSCOM_PayPal->addAlert($OSCOM_PayPal->getDef('alert_onboarding_retrieve_connection_error'), 'error');
}
