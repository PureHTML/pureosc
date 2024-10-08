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

if (class_exists('ZipArchive') && \function_exists('json_encode') && \function_exists('openssl_verify')) {
    $btUpdateReleasesResult = ['rpcStatus' => -1];

    $btUpdateReleasesResponse = @json_decode($OSCOM_Braintree->makeApiCall('https://apps.oscommerce.com/index.php?RPC&GetUpdates&braintree&app&2_3&'.str_replace('.', '_', number_format($OSCOM_Braintree->getVersion(), 3))), true);

    if (\is_array($btUpdateReleasesResponse) && isset($btUpdateReleasesResponse['rpcStatus']) && ($btUpdateReleasesResponse['rpcStatus'] === 1)) {
        $btUpdateReleasesResult['rpcStatus'] = 1;

        if (isset($btUpdateReleasesResponse['app']['releases'])) {
            $btMaxVersion = 0;

            foreach ($btUpdateReleasesResponse['app']['releases'] as $btUpdateRelease) {
                if (is_numeric($btUpdateRelease['version'])) {
                    $btUpdateReleasesResult['releases'][] = $btUpdateRelease;

                    if ($btUpdateRelease['version'] > $btMaxVersion) {
                        $btMaxVersion = $btUpdateRelease['version'];
                    }
                }
            }
        }
    }

    echo json_encode($btUpdateReleasesResult);
} else {
    $btUpdateReleasesResult = 'rpcStatus=-1';

    $btUpdateReleasesResponse = $OSCOM_Braintree->makeApiCall('https://apps.oscommerce.com/index.php?RPC&GetUpdates&braintree&app&2_3&'.str_replace('.', '_', number_format($OSCOM_Braintree->getVersion(), 3)).'&format=simple');

    if (!empty($btUpdateReleasesResponse) && (strpos($btUpdateReleasesResponse, 'rpcStatus') !== false)) {
        parse_str($btUpdateReleasesResponse, $btUpdateRelease);

        if (isset($btUpdateRelease['rpcStatus']) && ($btUpdateRelease['rpcStatus'] === '1')) {
            $btUpdateReleasesResult = "rpcStatus=1\n";

            if (isset($btUpdateRelease['version']) && is_numeric($btUpdateRelease['version'])) {
                $btUpdateReleasesResult .= 'release='.$btUpdateRelease['version'];

                $btMaxVersion = $btUpdateRelease['version'];
            }
        }
    }

    echo $btUpdateReleasesResult;
}

$OSCOM_Braintree->saveParameter('OSCOM_APP_PAYPAL_BRAINTREE_VERSION_CHECK', date('j').(isset($btMaxVersion) && ($btMaxVersion > 0) ? '-'.$btMaxVersion : ''));

exit;
