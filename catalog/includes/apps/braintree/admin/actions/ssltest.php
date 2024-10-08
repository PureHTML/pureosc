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

$curl_info = curl_version();

$result = [
    'rpcStatus' => 1,
    'curl_version' => $curl_info['version'] ?? '',
    'curl_ssl_version' => $curl_info['ssl_version'] ?? '',
];

$test = $OSCOM_Braintree->makeApiCall('https://www.howsmyssl.com/a/check', null, null, ['returnFull' => true, 'sslVersion' => 0]);

$result['default'] = (isset($test['info']['http_code']) && ((int) $test['info']['http_code'] === 200));

$test = $OSCOM_Braintree->makeApiCall('https://www.howsmyssl.com/a/check', null, null, ['returnFull' => true, 'sslVersion' => 6]);

$result['tlsv12'] = (isset($test['info']['http_code']) && ((int) $test['info']['http_code'] === 200));

echo json_encode($result);

exit;
